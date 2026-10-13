<?php

namespace App\Http\Controllers;

use App\Models\Angkatan;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AngkatanController extends Controller
{
    public function index(): View
    {
        $angkatans = Angkatan::orderByDesc('tahun_masuk')
            ->paginate(10);

        return view('angkatan.index', compact('angkatans'));
    }

    public function create(): View
    {
        return view('angkatan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:100'],
            'tahun_masuk' => ['required', 'integer', 'min:2000', 'max:2100'],
            'tahun_lulus' => ['nullable', 'integer', 'min:2000', 'max:2100'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        Angkatan::create($validated);

        return redirect()
            ->route('angkatan.index')
            ->with('success', 'Data angkatan berhasil ditambahkan.');
    }

    public function show(Angkatan $angkatan): View
    {
        $angkatan->load([
            'santris' => function ($query) {
                $query->orderBy('nama');
            },
        ]);

        return view('angkatan.show', compact('angkatan'));
    }

    public function edit(Angkatan $angkatan): View
    {
        return view('angkatan.edit', compact('angkatan'));
    }

    public function update(Request $request, Angkatan $angkatan)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:100'],
            'tahun_masuk' => ['required', 'integer', 'min:2000', 'max:2100'],
            'tahun_lulus' => ['nullable', 'integer', 'min:2000', 'max:2100'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        $angkatan->update($validated);

        return redirect()
            ->route('angkatan.show', $angkatan)
            ->with('success', 'Data angkatan berhasil diperbarui.');
    }

    public function destroy(Angkatan $angkatan)
    {
        $angkatan->update([
            'is_active' => false,
        ]);

        return redirect()
            ->route('angkatan.index')
            ->with('success', 'Angkatan berhasil dinonaktifkan.');
    }
}
