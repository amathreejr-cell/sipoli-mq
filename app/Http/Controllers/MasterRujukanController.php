<?php

namespace App\Http\Controllers;

use App\Models\MasterRujukan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MasterRujukanController extends Controller
{
    public function index(): View
    {
        $masterRujukans = MasterRujukan::query()
            ->orderBy('nama_fasilitas')
            ->paginate(10);

        return view(
            'master-rujukan.index',
            compact('masterRujukans')
        );
    }

    public function create(): View
    {
        return view('master-rujukan.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama_fasilitas' => [
                'required',
                'string',
                'max:200',
            ],
            'alamat' => [
                'nullable',
                'string',
            ],
            'no_telepon' => [
                'nullable',
                'string',
                'max:30',
            ],
            'is_active' => [
                'sometimes',
                'boolean',
            ],
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        MasterRujukan::create($validated);

        return redirect()
            ->route('master-rujukan.index')
            ->with(
                'success',
                'Fasilitas rujukan berhasil ditambahkan.'
            );
    }

    public function show(
        MasterRujukan $masterRujukan
    ): View {
        return view(
            'master-rujukan.show',
            compact('masterRujukan')
        );
    }

    public function edit(
        MasterRujukan $masterRujukan
    ): View {
        return view(
            'master-rujukan.edit',
            compact('masterRujukan')
        );
    }

    public function update(
        Request $request,
        MasterRujukan $masterRujukan
    ): RedirectResponse {
        $validated = $request->validate([
            'nama_fasilitas' => [
                'required',
                'string',
                'max:200',
            ],
            'alamat' => [
                'nullable',
                'string',
            ],
            'no_telepon' => [
                'nullable',
                'string',
                'max:30',
            ],
            'is_active' => [
                'sometimes',
                'boolean',
            ],
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        $masterRujukan->update($validated);

        return redirect()
            ->route('master-rujukan.index')
            ->with(
                'success',
                'Fasilitas rujukan berhasil diperbarui.'
            );
    }

    public function destroy(
        MasterRujukan $masterRujukan
    ): RedirectResponse {
        $masterRujukan->update([
            'is_active' => false,
        ]);

        return redirect()
            ->route('master-rujukan.index')
            ->with(
                'success',
                'Fasilitas rujukan berhasil dinonaktifkan.'
            );
    }
}
