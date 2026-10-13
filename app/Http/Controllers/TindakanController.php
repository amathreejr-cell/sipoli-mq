<?php

namespace App\Http\Controllers;

use App\Models\Tindakan;
use Illuminate\View\View;
use Illuminate\Http\Request;

class TindakanController extends Controller
{
    public function index(): View
    {
        $tindakans = Tindakan::orderBy('nama')
            ->paginate(10);

        return view('tindakan.index', compact('tindakans'));
    }

    public function create(): View
    {
        return view('tindakan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode' => ['required', 'string', 'max:50', 'unique:tindakans,kode'],
            'nama' => ['required', 'string', 'max:150'],
            'deskripsi' => ['nullable', 'string'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        Tindakan::create($validated);

        return redirect()
            ->route('tindakan.index')
            ->with('success', 'Data tindakan berhasil ditambahkan.');
    }

    public function show(Tindakan $tindakan): View
    {
        $tindakan->load([
            'kunjungans' => function ($query) {
                $query->with('santri')
                    ->orderByDesc('tanggal')
                    ->orderByDesc('waktu');
            }
        ]);

        return view('tindakan.show', compact('tindakan'));
    }

    public function edit(Tindakan $tindakan): View
    {
        return view('tindakan.edit', compact('tindakan'));
    }

    public function update(Request $request, Tindakan $tindakan)
    {
        $validated = $request->validate([
            'kode' => [
                'required',
                'string',
                'max:50',
                'unique:tindakans,kode,' . $tindakan->id,
            ],
            'nama' => ['required', 'string', 'max:150'],
            'deskripsi' => ['nullable', 'string'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        $tindakan->update($validated);

        return redirect()
            ->route('tindakan.show', $tindakan)
            ->with('success', 'Data tindakan berhasil diperbarui.');
    }

    public function destroy(Tindakan $tindakan)
    {
        $tindakan->update([
            'is_active' => false,
        ]);

        return redirect()
            ->route('tindakan.index')
            ->with('success', 'Tindakan berhasil dinonaktifkan.');
    }
}
