<?php

namespace App\Http\Controllers;

use App\Models\Kunjungan;
use App\Models\MutasiStok;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class KunjunganRingkasanController extends Controller
{

    public function show(Kunjungan $kunjungan): View|RedirectResponse
    {
        $kunjungan->load([
            'santri',
            'petugas',
            'pemeriksaan',
            'diagnosas',
            'tindakans',
            'resep.details.obat',
            'resep.koreksiReseps.user',
            'rujukan.masterRujukan',
        ]);

        if ($kunjungan->status !== 'selesai') {
            if (!$kunjungan->pemeriksaan) {
                return redirect()
                    ->route('pemeriksaan.create', $kunjungan)
                    ->with('error', 'Silakan lengkapi pemeriksaan terlebih dahulu.');
            }

            if ($kunjungan->diagnosas->isEmpty()) {
                return redirect()
                    ->route('kunjungan-diagnosa.create', $kunjungan)
                    ->with('error', 'Silakan tentukan diagnosa terlebih dahulu.');
            }

            if ($kunjungan->tindakans->isEmpty()) {
                return redirect()
                    ->route('kunjungan-tindakan.create', $kunjungan)
                    ->with('error', 'Silakan tentukan tindakan terlebih dahulu.');
            }

            if (is_null($kunjungan->perlu_rujukan)) {
                return redirect()
                    ->route('kunjungan-keputusan.create', $kunjungan)
                    ->with('error', 'Silakan tentukan keputusan pelayanan terlebih dahulu.');
            }

            if (
                $kunjungan->perlu_rujukan === false
                && is_null($kunjungan->perlu_obat)
            ) {
                return redirect()
                    ->route('kunjungan-keputusan.create', $kunjungan)
                    ->with('error', 'Silakan tentukan kebutuhan obat terlebih dahulu.');
            }

            if (
                $kunjungan->perlu_rujukan === true
                && !$kunjungan->rujukan
            ) {
                return redirect()
                    ->route('rujukan.create', $kunjungan)
                    ->with('error', 'Silakan lengkapi data rujukan terlebih dahulu.');
            }

            if (
                $kunjungan->perlu_rujukan === false
                && $kunjungan->perlu_obat === true
                && (
                    !$kunjungan->resep
                    || $kunjungan->resep->details->isEmpty()
                )
            ) {
                return redirect()
                    ->route('kunjungan-resep.create', $kunjungan)
                    ->with('error', 'Silakan lengkapi resep obat terlebih dahulu.');
            }
        }

        $riwayatKoreksiResep = $kunjungan->resep
            ? $kunjungan->resep->koreksiReseps
            ->sortByDesc('id')
            ->values()
            : collect();

        $koreksiTerakhir = $riwayatKoreksiResep->first();

        if ($koreksiTerakhir) {
            $resepAktif = collect($koreksiTerakhir->resep_sesudah);
        } else {
            $resepAktif = $kunjungan->resep
                ? $kunjungan->resep->details->map(function ($detail) {
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
                })->values()
                : collect();
        }

        return view(
            'kunjungan-ringkasan.show',
            compact(
                'kunjungan',
                'resepAktif',
                'riwayatKoreksiResep'
            )
        );
    }



    public function selesai(Kunjungan $kunjungan): RedirectResponse
    {
        try {
            $hasil = DB::transaction(function () use ($kunjungan) {

                // Kunci kunjungan agar dua permintaan tidak
                // menyelesaikan kunjungan yang sama bersamaan.
                $kunjungan = Kunjungan::query()
                    ->lockForUpdate()
                    ->findOrFail($kunjungan->id);

                if ($kunjungan->status === 'selesai') {
                    return 'sudah_selesai';
                }

                if ($kunjungan->status === 'dibatalkan') {
                    throw new \DomainException(
                        'Kunjungan yang dibatalkan tidak dapat diselesaikan.'
                    );
                }

                if ($kunjungan->status !== 'diperiksa') {
                    throw new \DomainException(
                        'Kunjungan harus berada pada status diperiksa sebelum diselesaikan.'
                    );
                }

                // Muat ulang data setelah baris kunjungan terkunci.
                $kunjungan->load([
                    'pemeriksaan',
                    'diagnosas',
                    'tindakans',
                    'resep.details.obat',
                    'rujukan',
                ]);

                // Validasi tahapan pelayanan.
                if (!$kunjungan->pemeriksaan) {
                    throw new \DomainException(
                        'Pemeriksaan belum dicatat.'
                    );
                }

                if ($kunjungan->diagnosas->isEmpty()) {
                    throw new \DomainException(
                        'Diagnosa belum dicatat.'
                    );
                }

                if ($kunjungan->tindakans->isEmpty()) {
                    throw new \DomainException(
                        'Tindakan belum dicatat.'
                    );
                }

                if (is_null($kunjungan->perlu_rujukan)) {
                    throw new \DomainException(
                        'Keputusan pelayanan belum ditentukan.'
                    );
                }

                if (
                    $kunjungan->perlu_rujukan === false
                    && is_null($kunjungan->perlu_obat)
                ) {
                    throw new \DomainException(
                        'Keputusan kebutuhan obat belum ditentukan.'
                    );
                }

                if (
                    $kunjungan->perlu_rujukan === true
                    && !$kunjungan->rujukan
                ) {
                    throw new \DomainException(
                        'Data rujukan belum dicatat.'
                    );
                }

                if (
                    $kunjungan->perlu_rujukan === false
                    && $kunjungan->perlu_obat === true
                    && (
                        !$kunjungan->resep
                        || $kunjungan->resep->details->isEmpty()
                    )
                ) {
                    throw new \DomainException(
                        'Resep obat belum dicatat.'
                    );
                }

                // Stok keluar hanya untuk pelayanan yang memerlukan obat.
                if (
                    $kunjungan->perlu_rujukan === false
                    && $kunjungan->perlu_obat === true
                ) {
                    foreach ($kunjungan->resep->details as $detail) {

                        // Kunjungan terkunci; cek mutasi yang sudah ada.
                        $sudahKeluar = MutasiStok::query()
                            ->where('resep_detail_id', $detail->id)
                            ->where('jenis', 'keluar')
                            ->exists();

                        if ($sudahKeluar) {
                            continue;
                        }

                        // Kunci obat sebelum memeriksa dan mengurangi stok.
                        $obat = $detail->obat()
                            ->lockForUpdate()
                            ->first();

                        if (!$obat) {
                            throw new \DomainException(
                                "Obat untuk detail resep {$detail->id} tidak ditemukan."
                            );
                        }

                        $jumlah = (int) $detail->jumlah;
                        $stokSebelum = (int) $obat->stok;

                        if ($jumlah < 1) {
                            throw new \DomainException(
                                "Jumlah obat untuk resep {$detail->id} tidak valid."
                            );
                        }

                        if ($stokSebelum < $jumlah) {
                            throw new \DomainException(
                                "Stok {$obat->nama} tidak mencukupi. " .
                                    "Stok tersedia: {$stokSebelum}, " .
                                    "dibutuhkan: {$jumlah}."
                            );
                        }

                        $stokSesudah = $stokSebelum - $jumlah;

                        $obat->update([
                            'stok' => $stokSesudah,
                        ]);

                        MutasiStok::create([
                            'obat_id' => $obat->id,
                            'resep_detail_id' => $detail->id,
                            'jenis' => 'keluar',
                            'jumlah' => $jumlah,
                            'stok_sebelum' => $stokSebelum,
                            'stok_sesudah' => $stokSesudah,
                            'keterangan' =>
                            'Pengeluaran obat untuk kunjungan ' .
                                $kunjungan->kode_kunjungan,
                            'user_id' => Auth::id(),
                        ]);
                    }
                }

                // Status selesai disimpan bersama mutasi stok.
                $kunjungan->update([
                    'status' => 'selesai',
                ]);

                return 'berhasil';
            }, 3);
        } catch (\DomainException $e) {
            return redirect()
                ->route('kunjungan-ringkasan.show', $kunjungan)
                ->with('error', $e->getMessage());
        }

        if ($hasil === 'sudah_selesai') {
            return redirect()
                ->route('kunjungan.show', $kunjungan)
                ->with('error', 'Kunjungan ini sudah selesai.');
        }

        return redirect()
            ->route('kunjungan.show', $kunjungan)
            ->with(
                'success',
                'Pelayanan kunjungan berhasil diselesaikan.'
            );
    }
}
