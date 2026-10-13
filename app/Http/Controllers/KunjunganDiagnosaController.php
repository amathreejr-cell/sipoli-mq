<?php

namespace App\Http\Controllers;

use App\Models\Diagnosa;
use App\Models\Kunjungan;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class KunjunganDiagnosaController extends Controller
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

        $diagnosas = Diagnosa::query()
            ->where('is_active', true)
            ->orderBy('nama')
            ->get();

        $kunjungan->load('diagnosas');

        return view('kunjungan-diagnosa.create', compact(
            'kunjungan',
            'diagnosas'
        ));
    }

    public function store(Request $request, Kunjungan $kunjungan)
    {
        if (
            !$kunjungan->pemeriksaan
            && Auth::user()->role !== 'admin'
        ) {
            return redirect()
                ->route('pemeriksaan.create', $kunjungan)
                ->with('error', 'Silakan selesaikan pemeriksaan terlebih dahulu.');
        }

        $validated = $request->validate([
            'diagnosa_ids' => ['required', 'array', 'min:1'],
            'diagnosa_ids.*' => ['exists:diagnosas,id'],
            'catatan' => ['nullable', 'string'],
        ]);

        $syncData = [];

        foreach ($validated['diagnosa_ids'] as $diagnosaId) {
            $syncData[$diagnosaId] = [
                'catatan' => $validated['catatan'] ?? null,
            ];
        }

        $kunjungan->diagnosas()->sync($syncData);

        return redirect()
            ->route('kunjungan-tindakan.create', $kunjungan)
            ->with('success', 'Diagnosa berhasil disimpan. Silakan tentukan tindakan.');
    }
}
