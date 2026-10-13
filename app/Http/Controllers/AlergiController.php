<?php

namespace App\Http\Controllers;

use App\Models\Alergi;
use App\Models\Santri;
use Illuminate\View\View;
use Illuminate\Http\Request;

class AlergiController extends Controller
{
    public function index(): View
    {
        $alergis = Alergi::with('santri')
            ->latest()
            ->paginate(10);

        return view('alergi.index', compact('alergis'));
    }

    public function create(): View
    {
        $santris = Santri::where('status', 'aktif')
            ->orderBy('nama')
            ->get();

        return view('alergi.create', compact('santris'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'santri_id' => ['required', 'exists:santri,id'],
            'jenis' => ['required', 'string', 'max:50'],
            'nama' => ['required', 'string', 'max:150'],
            'reaksi' => ['nullable', 'string', 'max:255'],
            'keterangan' => ['nullable', 'string'],
        ]);

        $alergi = Alergi::create($validated);

        return redirect()
            ->route('alergi.show', $alergi)
            ->with('success', 'Data alergi berhasil ditambahkan.');
    }

    public function show(Alergi $alergi): View
    {
        $alergi->load('santri');

        return view('alergi.show', compact('alergi'));
    }

    public function edit(Alergi $alergi): View
    {
        $santris = Santri::where('status', 'aktif')
            ->orderBy('nama')
            ->get();

        return view('alergi.edit', compact('alergi', 'santris'));
    }

    public function update(Request $request, Alergi $alergi)
    {
        $validated = $request->validate([
            'santri_id' => ['required', 'exists:santri,id'],
            'jenis' => ['required', 'string', 'max:50'],
            'nama' => ['required', 'string', 'max:150'],
            'reaksi' => ['nullable', 'string', 'max:255'],
            'keterangan' => ['nullable', 'string'],
        ]);

        $alergi->update($validated);

        return redirect()
            ->route('alergi.show', $alergi)
            ->with('success', 'Data alergi berhasil diperbarui.');
    }

    public function destroy(Alergi $alergi)
    {
        $santriId = $alergi->santri_id;

        $alergi->delete();

        return redirect()
            ->route('santri.show', $santriId)
            ->with('success', 'Data alergi berhasil dihapus.');
    }
}
