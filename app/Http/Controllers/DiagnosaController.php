<?php

namespace App\Http\Controllers;

use App\Models\Diagnosa;
use Illuminate\View\View;
use Illuminate\Http\Request;

class DiagnosaController extends Controller
{
    public function index(): View
    {
        $diagnosas = Diagnosa::orderBy('nama')
            ->paginate(10);

        return view('diagnosa.index', compact('diagnosas'));
    }

    public function create(): View
    {
        return view('diagnosa.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode' => ['required', 'string', 'max:50', 'unique:diagnosas,kode'],
            'nama' => ['required', 'string', 'max:150'],
            'deskripsi' => ['nullable', 'string'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        Diagnosa::create($validated);

        return redirect()
            ->route('diagnosa.index')
            ->with('success', 'Data diagnosa berhasil ditambahkan.');
    }

    public function show(Diagnosa $diagnosa): View
    {
        $diagnosa->load([
            'kunjungans' => function ($query) {
                $query->with('santri')
                    ->orderByDesc('tanggal')
                    ->orderByDesc('waktu');
            }
        ]);

        return view('diagnosa.show', compact('diagnosa'));
    }

    public function edit(Diagnosa $diagnosa): View
    {
        return view('diagnosa.edit', compact('diagnosa'));
    }

    public function update(Request $request, Diagnosa $diagnosa)
    {
        $validated = $request->validate([
            'kode' => [
                'required',
                'string',
                'max:50',
                'unique:diagnosas,kode,' . $diagnosa->id,
            ],
            'nama' => ['required', 'string', 'max:150'],
            'deskripsi' => ['nullable', 'string'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        $diagnosa->update($validated);

        return redirect()
            ->route('diagnosa.show', $diagnosa)
            ->with('success', 'Data diagnosa berhasil diperbarui.');
    }

    public function destroy(Diagnosa $diagnosa)
    {
        $diagnosa->update([
            'is_active' => false,
        ]);

        return redirect()
            ->route('diagnosa.index')
            ->with('success', 'Diagnosa berhasil dinonaktifkan.');
    }
}
