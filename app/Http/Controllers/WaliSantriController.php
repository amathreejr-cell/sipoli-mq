<?php

namespace App\Http\Controllers;

use App\Models\WaliSantri;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WaliSantriController extends Controller
{
    public function index(): View
    {
        $waliSantris = WaliSantri::withCount('santris')
            ->orderBy('nama')
            ->paginate(10);

        return view('wali-santri.index', compact('waliSantris'));
    }

    public function create(): View
    {
        return view('wali-santri.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:150'],
            'hubungan' => ['required', 'string', 'max:50'],
            'no_hp' => ['nullable', 'string', 'max:20'],
            'alamat' => ['nullable', 'string'],
        ]);

        WaliSantri::create($validated);

        return redirect()
            ->route('wali-santri.index')
            ->with('success', 'Data wali santri berhasil ditambahkan.');
    }

    public function show(WaliSantri $waliSantri): View
    {
        $waliSantri->load([
            'santris' => function ($query) {
                $query->with(['kamar', 'angkatan'])
                    ->orderBy('nama');
            }
        ]);

        return view('wali-santri.show', compact('waliSantri'));
    }

    public function edit(WaliSantri $waliSantri): View
    {
        return view('wali-santri.edit', compact('waliSantri'));
    }

    public function update(Request $request, WaliSantri $waliSantri)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:150'],
            'hubungan' => ['required', 'string', 'max:50'],
            'no_hp' => ['nullable', 'string', 'max:20'],
            'alamat' => ['nullable', 'string'],
        ]);

        $waliSantri->update($validated);

        return redirect()
            ->route('wali-santri.show', $waliSantri)
            ->with('success', 'Data wali santri berhasil diperbarui.');
    }

    public function destroy(WaliSantri $waliSantri)
    {
        if ($waliSantri->santris()->exists()) {
            return redirect()
                ->route('wali-santri.show', $waliSantri)
                ->with('error', 'Wali santri tidak dapat dihapus karena masih terhubung dengan data santri.');
        }

        $waliSantri->delete();

        return redirect()
            ->route('wali-santri.index')
            ->with('success', 'Data wali santri berhasil dihapus.');
    }
}
