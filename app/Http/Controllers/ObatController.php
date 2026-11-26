<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\View\View;
use Illuminate\Http\Request;

class ObatController extends Controller
{


    public function index(Request $request)
    {
        $perPage = (int) $request->input('per_page', 10);

        if (! in_array($perPage, [10, 25, 50, 100], true)) {
            $perPage = 10;
        }

        $search = trim($request->input('search', ''));

        // Statistik dihitung dari seluruh data obat.
        $statistik = Obat::query()
            ->selectRaw('COUNT(*) as total_obat')
            ->selectRaw('SUM(CASE WHEN stok <= 0 THEN 1 ELSE 0 END) as jumlah_habis')
            ->selectRaw('SUM(CASE WHEN stok > 0 AND stok <= stok_minimum THEN 1 ELSE 0 END) as jumlah_menipis')
            ->first();

        $jumlahObat = (int) $statistik->total_obat;
        $jumlahHabis = (int) $statistik->jumlah_habis;
        $jumlahMenipis = (int) $statistik->jumlah_menipis;
        $jumlahAman = max(0, $jumlahObat - $jumlahHabis - $jumlahMenipis);

        // Pencarian dan pagination daftar obat.
        $obats = Obat::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('kode', 'like', "%{$search}%")
                        ->orWhere('nama', 'like', "%{$search}%")
                        ->orWhere('bentuk', 'like', "%{$search}%")
                        ->orWhere('satuan', 'like', "%{$search}%");
                });
            })
            ->orderBy('nama')
            ->paginate($perPage)
            ->withQueryString();

        return view('obat.index', compact(
            'obats',
            'search',
            'perPage',
            'jumlahObat',
            'jumlahHabis',
            'jumlahMenipis',
            'jumlahAman'
        ));
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
