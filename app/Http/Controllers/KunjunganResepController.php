<?php

namespace App\Http\Controllers;

use App\Models\Kunjungan;
use App\Models\Obat;
use App\Models\Resep;
use App\Models\MutasiStok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class KunjunganResepController extends Controller
{
    public function create(Kunjungan $kunjungan): View|RedirectResponse
    {
        if ($kunjungan->status === 'dibatalkan') {
            return redirect()
                ->route('kunjungan.show', $kunjungan)
                ->with(
                    'error',
                    'Resep untuk kunjungan yang dibatalkan tidak dapat diubah.'
                );
        }

        if (
            $kunjungan->status === 'selesai'
            && Auth::user()->role !== 'admin'
        ) {
            return redirect()
                ->route('kunjungan.show', $kunjungan)
                ->with(
                    'error',
                    'Hanya Admin yang dapat mengoreksi resep kunjungan yang sudah selesai.'
                );
        }

        if (!$kunjungan->pemeriksaan) {
            return redirect()
                ->route('pemeriksaan.create', $kunjungan)
                ->with('error', 'Silakan selesaikan pemeriksaan terlebih dahulu.');
        }

        if ($kunjungan->diagnosas()->count() === 0) {
            return redirect()
                ->route('kunjungan-diagnosa.create', $kunjungan)
                ->with('error', 'Silakan tentukan diagnosa terlebih dahulu.');
        }

        if ($kunjungan->tindakans()->count() === 0) {
            return redirect()
                ->route('kunjungan-tindakan.create', $kunjungan)
                ->with('error', 'Silakan tentukan tindakan terlebih dahulu.');
        }

        if ($kunjungan->perlu_rujukan !== false) {
            return redirect()
                ->route('kunjungan-keputusan.create', $kunjungan)
                ->with('error', 'Silakan tentukan bahwa kunjungan tidak memerlukan rujukan terlebih dahulu.');
        }

        if ($kunjungan->perlu_obat !== true) {
            return redirect()
                ->route('kunjungan-keputusan.create', $kunjungan)
                ->with('error', 'Kunjungan ini tidak memerlukan obat.');
        }

        $resepSudahDikeluarkan = MutasiStok::query()
            ->whereHas('resepDetail', function ($query) use ($kunjungan) {
                $query->whereHas('resep', function ($resepQuery) use ($kunjungan) {
                    $resepQuery->where('kunjungan_id', $kunjungan->id);
                });
            })
            ->where('jenis', 'keluar')
            ->exists();

        if (
            $resepSudahDikeluarkan
            && Auth::user()->role !== 'admin'
        ) {
            return redirect()
                ->route('kunjungan.show', $kunjungan)
                ->with(
                    'error',
                    'Resep yang obatnya sudah dikeluarkan tidak dapat diedit.'
                );
        }

        $obats = Obat::query()
            ->where('is_active', true)
            ->orderBy('nama')
            ->get();

        $resep = $kunjungan->resep()
            ->with('details.obat')
            ->first();

        $resepDetails = $resep
            ? $resep->details->map(function ($detail) {
                return [
                    'id' => $detail->obat_id,
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

        return view('kunjungan-resep.create', compact(
            'kunjungan',
            'obats',
            'resep',
            'resepDetails'
        ));
    }

    public function store(Request $request, Kunjungan $kunjungan)
    {
        if ($kunjungan->status === 'dibatalkan') {
            return redirect()
                ->route('kunjungan.show', $kunjungan)
                ->with(
                    'error',
                    'Resep untuk kunjungan yang dibatalkan tidak dapat diubah.'
                );
        }

        if (
            $kunjungan->status === 'selesai'
            && Auth::user()->role !== 'admin'
        ) {
            return redirect()
                ->route('kunjungan.show', $kunjungan)
                ->with(
                    'error',
                    'Hanya Admin yang dapat mengoreksi resep kunjungan yang sudah selesai.'
                );
        }

        if (!$kunjungan->pemeriksaan) {
            return redirect()
                ->route('pemeriksaan.create', $kunjungan)
                ->with('error', 'Silakan selesaikan pemeriksaan terlebih dahulu.');
        }

        if ($kunjungan->diagnosas()->count() === 0) {
            return redirect()
                ->route('kunjungan-diagnosa.create', $kunjungan)
                ->with('error', 'Silakan tentukan diagnosa terlebih dahulu.');
        }

        if ($kunjungan->tindakans()->count() === 0) {
            return redirect()
                ->route('kunjungan-tindakan.create', $kunjungan)
                ->with('error', 'Silakan tentukan tindakan terlebih dahulu.');
        }

        if ($kunjungan->perlu_rujukan !== false) {
            return redirect()
                ->route('kunjungan-keputusan.create', $kunjungan)
                ->with('error', 'Silakan tentukan bahwa kunjungan tidak memerlukan rujukan terlebih dahulu.');
        }

        if ($kunjungan->perlu_obat !== true) {
            return redirect()
                ->route('kunjungan-keputusan.create', $kunjungan)
                ->with('error', 'Kunjungan ini tidak memerlukan obat.');
        }

        $resepSudahDikeluarkan = MutasiStok::query()
            ->whereHas('resepDetail', function ($query) use ($kunjungan) {
                $query->whereHas('resep', function ($resepQuery) use ($kunjungan) {
                    $resepQuery->where('kunjungan_id', $kunjungan->id);
                });
            })
            ->where('jenis', 'keluar')
            ->exists();


        if ($resepSudahDikeluarkan) {
            return redirect()
                ->route('kunjungan.show', $kunjungan)
                ->with(
                    'error',
                    'Resep tidak dapat diubah karena obat sudah dikeluarkan. Silakan lakukan koreksi melalui prosedur koreksi resep dan stok.'
                );
        }


        $validated = $request->validate([
            'obat_ids' => ['required', 'array', 'min:1'],
            'obat_ids.*' => ['exists:obats,id'],

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

            'catatan' => ['nullable', 'string'],
        ]);

        DB::transaction(function () use ($validated, $kunjungan) {

            $resep = Resep::updateOrCreate(
                ['kunjungan_id' => $kunjungan->id],
                [
                    'nomor_resep' =>
                    'RSP-' . now()->format('YmdHis') . '-' . random_int(100, 999),

                    'catatan' => $validated['catatan'] ?? null,
                ]
            );

            $resep->details()->delete();

            foreach ($validated['obat_ids'] as $obatId) {

                $resep->details()->create([
                    'obat_id' => $obatId,
                    'jumlah' => $validated['jumlah'][$obatId],
                    'dosis' => $validated['dosis'][$obatId],
                    'frekuensi' => $validated['frekuensi'][$obatId],
                    'aturan_pakai' => $validated['aturan_pakai'][$obatId],
                    'keterangan' => $validated['keterangan'][$obatId] ?? null,
                ]);
            }
        });

        return redirect()
            ->route('kunjungan-ringkasan.show', $kunjungan)
            ->with('success', 'Resep berhasil disimpan. Silakan periksa ringkasan pelayanan.');
    }
}
