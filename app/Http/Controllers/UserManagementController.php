<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class UserManagementController extends Controller
{
    public function index(Request $request): View
    {
        $keyword = $request->string('q')->toString();

        $users = User::query()
            ->when($keyword !== '', function ($query) use ($keyword) {
                $query->where(function ($query) use ($keyword) {
                    $query
                        ->where('name', 'like', "%{$keyword}%")
                        ->orWhere('email', 'like', "%{$keyword}%")
                        ->orWhere('role', 'like', "%{$keyword}%");
                });
            })
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        return view('users.index', compact(
            'users',
            'keyword'
        ));
    }

    public function create(): View
    {
        return view('users.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email',
            ],

            'role' => [
                'required',
                Rule::in([
                    'admin',
                    'petugas',
                    'pimpinan',
                ]),
            ],

            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],
        ]);

        $validated['is_active'] = true;

        User::create($validated);

        return redirect()
            ->route('users.index')
            ->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function edit(User $user): View
    {
        return view('users.edit', compact('user'));
    }

    public function update(
        Request $request,
        User $user
    ): RedirectResponse {

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')
                    ->ignore($user->id),
            ],

            'role' => [
                'required',
                Rule::in([
                    'admin',
                    'petugas',
                    'pimpinan',
                ]),
            ],
        ]);

        // Jangan sampai sistem kehilangan Admin terakhir.
        if (
            $user->role === 'admin'
            && $validated['role'] !== 'admin'
            && User::where('role', 'admin')->count() <= 1
        ) {
            return back()
                ->withInput()
                ->with(
                    'error',
                    'Role Admin terakhir tidak dapat diubah.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Admin tidak boleh menurunkan role dirinya sendiri
        |--------------------------------------------------------------------------
        */

        if (
            Auth::id() === $user->id
            && $validated['role'] !== 'admin'
        ) {
            return back()
                ->withInput()
                ->with(
                    'error',
                    'Anda tidak dapat mengubah role akun Admin yang sedang digunakan.'
                );
        }

        $user->update($validated);

        return redirect()
            ->route('users.index')
            ->with('success', 'Data pengguna berhasil diperbarui.');
    }

    public function resetPassword(
        Request $request,
        User $user
    ): RedirectResponse {

        $validated = $request->validate([
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],
        ]);

        $user->update([
            'password' => $validated['password'],
        ]);

        return redirect()
            ->route('users.index')
            ->with(
                'success',
                'Password ' . $user->name . ' berhasil direset.'
            );
    }

    public function toggleStatus(User $user): RedirectResponse
    {
        if (Auth::id() === $user->id) {
            return back()->with(
                'error',
                'Anda tidak dapat mengubah status akun yang sedang digunakan.'
            );
        }

        // Jangan menonaktifkan Admin terakhir.
        if (
            $user->role === 'admin'
            && $user->is_active
            && User::where('role', 'admin')
            ->where('is_active', true)
            ->count() <= 1
        ) {
            return back()->with(
                'error',
                'Admin aktif terakhir tidak dapat dinonaktifkan.'
            );
        }

        $user->update([
            'is_active' => !$user->is_active,
        ]);

        $status = $user->is_active
            ? 'diaktifkan'
            : 'dinonaktifkan';

        return redirect()
            ->route('users.index')
            ->with(
                'success',
                "Pengguna {$user->name} berhasil {$status}."
            );
    }

    public function destroy(User $user): RedirectResponse
    {
        if (Auth::id() === $user->id) {
            return back()->with(
                'error',
                'Anda tidak dapat menghapus akun yang sedang digunakan.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Jangan sampai Admin terakhir terhapus
        |--------------------------------------------------------------------------
        */

        if (
            $user->role === 'admin'
            && User::where('role', 'admin')->count() <= 1
        ) {
            return back()->with(
                'error',
                'Admin terakhir tidak dapat dihapus.'
            );
        }

        $nama = $user->name;

        $user->delete();

        return redirect()
            ->route('users.index')
            ->with(
                'success',
                "Pengguna {$nama} berhasil dihapus."
            );
    }
}
