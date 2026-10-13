<?php

namespace App\Http\Controllers;

use App\Models\Kunjungan;
use App\Models\Tindakan;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class KunjunganTindakanController extends Controller
{
    public function create(Kunjungan $kunjungan): View|RedirectResponse
    {
        if (
            in_array($kunjungan->status, ['selesai', 'dibatalkan'])
            && Auth::user()->role !== 'admin'
        ) {
            return redirect()
                ->route('kunjungan.show', $kunjungan)
                ->with('error', 'Kunjungan yang sudah selesai atau dibatalkan tidak dapat diedit.');
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

        $tindakans = Tindakan::query()
            ->where('is_active', true)
            ->orderBy('nama')
            ->get();

        $kunjungan->load('tindakans');

        return view('kunjungan-tindakan.create', compact(
            'kunjungan',
            'tindakans'
        ));
    }

    public function store(Request $request, Kunjungan $kunjungan)
    {
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

        $validated = $request->validate([
            'tindakan_ids' => ['required', 'array', 'min:1'],
            'tindakan_ids.*' => ['exists:tindakans,id'],
            'catatan' => ['nullable', 'string'],
        ]);

        $syncData = [];

        foreach ($validated['tindakan_ids'] as $tindakanId) {
            $syncData[$tindakanId] = [
                'catatan' => $validated['catatan'] ?? null,
            ];
        }

        $kunjungan->tindakans()->sync($syncData);

        return redirect()
            ->route('kunjungan-keputusan.create', $kunjungan)
            ->with('success', 'Tindakan berhasil disimpan. Silakan tentukan tindak lanjut pelayanan.');
    }
}
