<?php

namespace App\Http\Controllers;

use App\Models\MutasiStok;
use App\Models\Obat;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class MutasiStokController extends Controller
{
    /**
     * Menampilkan riwayat mutasi stok.
     */
    public function index(): View
    {
        $mutasis = MutasiStok::query()
            ->with([
                'obat',
                'user',
            ])
            ->orderByDesc('created_at')
            ->paginate(15);

        return view(
            'mutasi-stok.index',
            compact('mutasis')
        );
    }

    /**
     * Menampilkan form stok masuk.
     */
    public function create(): View
    {
        $obats = Obat::query()
            ->where('is_active', true)
            ->orderBy('nama')
            ->get();

        return view(
            'mutasi-stok.create',
            compact('obats')
        );
    }

    /**
     * Menyimpan stok masuk dan mencatat mutasi.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'obat_id' => [
                'required',
                'integer',
                'exists:obats,id',
            ],
            'jumlah' => [
                'required',
                'integer',
                'min:1',
            ],
            'keterangan' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ]);

        DB::transaction(function () use ($validated) {
            // Kunci data obat selama proses perubahan stok.
            $obat = Obat::query()
                ->lockForUpdate()
                ->findOrFail($validated['obat_id']);

            // Pastikan obat masih aktif ketika stok ditambahkan.
            if (!$obat->is_active) {
                throw ValidationException::withMessages([
                    'obat_id' =>
                        'Obat sudah tidak aktif dan tidak dapat menerima stok masuk.',
                ]);
            }

            $stokSebelum = (int) $obat->stok;
            $jumlahMasuk = (int) $validated['jumlah'];
            $stokSesudah = $stokSebelum + $jumlahMasuk;

            // Perbarui stok obat.
            $obat->update([
                'stok' => $stokSesudah,
            ]);

            // Catat mutasi dalam transaksi yang sama.
            MutasiStok::create([
                'obat_id' => $obat->id,
                'resep_detail_id' => null,
                'jenis' => 'masuk',
                'jumlah' => $jumlahMasuk,
                'stok_sebelum' => $stokSebelum,
                'stok_sesudah' => $stokSesudah,
                'keterangan' => $validated['keterangan'] ?? null,
                'user_id' => Auth::id(),
            ]);
        });

        return redirect()
            ->route('obat.index')
            ->with(
                'success',
                'Stok obat berhasil ditambahkan.'
            );
    }
}
