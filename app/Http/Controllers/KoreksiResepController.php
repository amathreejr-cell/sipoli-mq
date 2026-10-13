<?php

namespace App\Http\Controllers;

use App\Models\KoreksiResep;
use App\Models\Kunjungan;
use App\Models\MutasiStok;
use App\Models\Obat;
use App\Models\Resep;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class KoreksiResepController extends Controller
{
    public function create(Kunjungan $kunjungan): View|RedirectResponse
    {
        abort_unless(Auth::user()?->role === 'admin', 403);

        if ($kunjungan->status !== 'selesai') {
            return redirect()
                ->route('kunjungan.show', $kunjungan)
                ->with('error', 'Koreksi resep hanya tersedia untuk kunjungan yang sudah selesai.');
        }

        $resep = $kunjungan->resep()
            ->with(['details.obat', 'koreksiReseps'])
            ->first();

        if (!$resep) {
            return redirect()
                ->route('kunjungan.show', $kunjungan)
                ->with('error', 'Resep tidak ditemukan.');
        }

        $sudahDikeluarkan = MutasiStok::query()
            ->where('jenis', 'keluar')
            ->whereHas('resepDetail', function ($query) use ($resep) {
                $query->where('resep_id', $resep->id);
            })
            ->exists();

        if (!$sudahDikeluarkan) {
            return redirect()
                ->route('kunjungan-resep.create', $kunjungan)
                ->with('error', 'Resep ini belum memiliki catatan pengeluaran obat.');
        }

        $koreksiTerakhir = $resep->koreksiReseps()
            ->orderByDesc('dikoreksi_pada')
            ->orderByDesc('id')
            ->first();

        $resepAktif = $koreksiTerakhir
            ? $koreksiTerakhir->resep_sesudah
            : $resep->details->map(function ($detail) {
                return [
                    'obat_id' => $detail->obat_id,
                    'kode' => $detail->obat?->kode,
                    'nama' => $detail->obat?->nama,
                    'satuan' => $detail->obat?->satuan,
                    'jumlah' => $detail->jumlah,
                    'dosis' => $detail->dosis,
                    'frekuensi' => $detail->frekuensi,
                    'aturan_pakai' => $detail->aturan_pakai,
                    'keterangan' => $detail->keterangan,
                ];
            })->values()->all();

        $obats = Obat::query()
            ->where('is_active', true)
            ->orderBy('nama')
            ->get();

        return view('kunjungan-resep.koreksi', compact(
            'kunjungan',
            'resep',
            'resepAktif',
            'obats'
        ));
    }

    public function store(
        Request $request,
        Kunjungan $kunjungan
    ): RedirectResponse {
        abort_unless(Auth::user()?->role === 'admin', 403);

        $validated = $request->validate([
            'alasan' => ['required', 'string', 'min:10', 'max:2000'],

            'obat_ids' => ['required', 'array', 'min:1'],
            'obat_ids.*' => ['required', 'integer', 'distinct', 'exists:obats,id'],

            'jumlah' => ['required', 'array'],
            'jumlah.*' => ['required', 'integer', 'min:1'],

            'dosis' => ['required', 'array'],
            'dosis.*' => ['required', 'string', 'max:100'],

            'frekuensi' => ['required', 'array'],
            'frekuensi.*' => ['required', 'string', 'max:100'],

            'aturan_pakai' => ['required', 'array'],
            'aturan_pakai.*' => ['required', 'string', 'max:150'],

            'keterangan' => ['nullable', 'array'],
            'keterangan.*' => ['nullable', 'string', 'max:255'],
        ]);

        $hasil = DB::transaction(function () use (
            $validated,
            $kunjungan
        ) {
            $kunjunganTerkunci = Kunjungan::query()
                ->whereKey($kunjungan->id)
                ->lockForUpdate()
                ->firstOrFail();

            if ($kunjunganTerkunci->status !== 'selesai') {
                throw ValidationException::withMessages([
                    'alasan' => 'Kunjungan tidak lagi berstatus selesai. Muat ulang halaman sebelum melanjutkan.',
                ]);
            }

            $resep = Resep::query()
                ->where('kunjungan_id', $kunjunganTerkunci->id)
                ->lockForUpdate()
                ->firstOrFail();

            $sudahDikeluarkan = MutasiStok::query()
                ->where('jenis', 'keluar')
                ->whereHas('resepDetail', function ($query) use ($resep) {
                    $query->where('resep_id', $resep->id);
                })
                ->exists();

            if (!$sudahDikeluarkan) {
                throw ValidationException::withMessages([
                    'alasan' => 'Koreksi hanya tersedia jika pengeluaran obat tercatat.',
                ]);
            }

            $koreksiTerakhir = $resep->koreksiReseps()
                ->orderByDesc('dikoreksi_pada')
                ->orderByDesc('id')
                ->lockForUpdate()
                ->first();

            $sebelum = $koreksiTerakhir
                ? $koreksiTerakhir->resep_sesudah
                : $resep->details()
                ->with('obat')
                ->get()
                ->map(function ($detail) {
                    return [
                        'obat_id' => $detail->obat_id,
                        'kode' => $detail->obat?->kode,
                        'nama' => $detail->obat?->nama,
                        'satuan' => $detail->obat?->satuan,
                        'jumlah' => $detail->jumlah,
                        'dosis' => $detail->dosis,
                        'frekuensi' => $detail->frekuensi,
                        'aturan_pakai' => $detail->aturan_pakai,
                        'keterangan' => $detail->keterangan,
                    ];
                })->values()->all();

            $obatData = Obat::query()
                ->whereIn('id', $validated['obat_ids'])
                ->get()
                ->keyBy('id');


            $sesudah = [];

            foreach ($validated['obat_ids'] as $index => $obatId) {
                foreach (
                    ['jumlah', 'dosis', 'frekuensi', 'aturan_pakai']
                    as $field
                ) {
                    if (!array_key_exists($index, $validated[$field])) {
                        throw ValidationException::withMessages([
                            $field => 'Data resep tidak lengkap. Periksa kembali isian obat.',
                        ]);
                    }
                }

                $obat = $obatData->get($obatId);

                if (!$obat) {
                    throw ValidationException::withMessages([
                        'obat_ids' => 'Salah satu obat tidak ditemukan.',
                    ]);
                }

                $sesudah[] = [
                    'obat_id' => (int) $obatId,
                    'kode' => $obat->kode,
                    'nama' => $obat->nama,
                    'satuan' => $obat->satuan,
                    'jumlah' => (int) $validated['jumlah'][$index],
                    'dosis' => $validated['dosis'][$index],
                    'frekuensi' => $validated['frekuensi'][$index],
                    'aturan_pakai' => $validated['aturan_pakai'][$index],
                    'keterangan' => $validated['keterangan'][$index] ?? null,
                ];
            }


            KoreksiResep::create([
                'resep_id' => $resep->id,
                'user_id' => Auth::id(),
                'alasan' => $validated['alasan'],
                'resep_sebelum' => $sebelum,
                'resep_sesudah' => $sesudah,
                'dikoreksi_pada' => now(),
            ]);

            return true;
        }, 3);

        if ($hasil) {
            return redirect()
                ->route('kunjungan.show', $kunjungan)
                ->with(
                    'success',
                    'Koreksi resep berhasil dicatat. Resep asli dan mutasi stok tetap dipertahankan; stok tidak berubah otomatis.'
                );
        }

        return redirect()->route('kunjungan.show', $kunjungan);
    }
}
