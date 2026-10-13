<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\View\View;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    public function index(): View
    {
        $obats = Obat::orderBy('nama')
            ->paginate(10);

        return view('obat.index', compact('obats'));
    }

    public function create(): View
    {
        return view('obat.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode' => ['required', 'string', 'max:50', 'unique:obats,kode'],
            'nama' => ['required', 'string', 'max:150'],
            'bentuk' => ['required', 'string', 'max:50'],
            'satuan' => ['required', 'string', 'max:50'],
            'stok' => ['required', 'integer', 'min:0'],
            'stok_minimum' => ['required', 'integer', 'min:0'],
            'keterangan' => ['nullable', 'string'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        Obat::create($validated);

        return redirect()
            ->route('obat.index')
            ->with('success', 'Data obat berhasil ditambahkan.');
    }

    public function show(Obat $obat): View
    {
        $obat->load([
            'resepDetails' => function ($query) {
                $query->with([
                    'resep.kunjungan.santri'
                ])->latest();
            }
        ]);

        return view('obat.show', compact('obat'));
    }

    public function edit(Obat $obat): View
    {
        return view('obat.edit', compact('obat'));
    }

    public function update(Request $request, Obat $obat)
    {
        $validated = $request->validate([
            'kode' => [
                'required',
                'string',
                'max:50',
                'unique:obats,kode,' . $obat->id,
            ],
            'nama' => ['required', 'string', 'max:150'],
            'bentuk' => ['required', 'string', 'max:50'],
            'satuan' => ['required', 'string', 'max:50'],
            'stok' => ['required', 'integer', 'min:0'],
            'stok_minimum' => ['required', 'integer', 'min:0'],
            'keterangan' => ['nullable', 'string'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        $obat->update($validated);

        return redirect()
            ->route('obat.show', $obat)
            ->with('success', 'Data obat berhasil diperbarui.');
    }

    public function destroy(Obat $obat)
    {
        $obat->update([
            'is_active' => false,
        ]);

        return redirect()
            ->route('obat.index')
            ->with('success', 'Obat berhasil dinonaktifkan.');
    }
}
