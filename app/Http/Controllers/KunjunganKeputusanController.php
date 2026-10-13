<?php

namespace App\Http\Controllers;

use App\Models\Kunjungan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class KunjunganKeputusanController extends Controller
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

        if ($kunjungan->tindakans()->count() === 0) {
            return redirect()
                ->route('kunjungan-tindakan.create', $kunjungan)
                ->with('error', 'Silakan tentukan tindakan terlebih dahulu.');
        }

        return view(
            'kunjungan-keputusan.create',
            compact('kunjungan')
        );
    }

    public function store(Request $request, Kunjungan $kunjungan): RedirectResponse
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

        if ($kunjungan->tindakans()->count() === 0) {
            return redirect()
                ->route('kunjungan-tindakan.create', $kunjungan)
                ->with('error', 'Silakan tentukan tindakan terlebih dahulu.');
        }
        
        if (
            $kunjungan->status === 'selesai'
            && Auth::user()->role !== 'admin'
        ) {
            return redirect()
                ->route('kunjungan.show', $kunjungan)
                ->with('error', 'Kunjungan yang sudah selesai tidak dapat diedit.');
        }

        $validated = $request->validate([
            'perlu_rujukan' => ['required', 'boolean'],
            'perlu_obat' => ['nullable', 'boolean'],
        ]);

        // Jika perlu rujukan, keputusan obat tidak diperlukan.
        if ($validated['perlu_rujukan'] === true) {
            $validated['perlu_obat'] = null;
        }

        // Jika tidak perlu rujukan, petugas wajib menentukan
        // apakah pasien membutuhkan obat atau tidak.
        if (
            $validated['perlu_rujukan'] === false
            && !array_key_exists('perlu_obat', $validated)
        ) {
            return back()
                ->withErrors([
                    'perlu_obat' => 'Silakan tentukan apakah pasien membutuhkan obat.',
                ])
                ->withInput();
        }

        $kunjungan->update([
            'perlu_rujukan' => $validated['perlu_rujukan'],
            'perlu_obat' => $validated['perlu_obat'] ?? null,
        ]);

        if ($kunjungan->perlu_rujukan) {
            return redirect()
                ->route('rujukan.create', $kunjungan)
                ->with('success', 'Keputusan pelayanan disimpan. Silakan lengkapi data rujukan.');
        }

        if ($kunjungan->perlu_obat) {
            return redirect()
                ->route('kunjungan-resep.create', $kunjungan)
                ->with('success', 'Keputusan pelayanan disimpan. Silakan lengkapi obat.');
        }

        return redirect()
            ->route('kunjungan-ringkasan.show', $kunjungan)
            ->with('success', 'Keputusan pelayanan disimpan. Silakan periksa ringkasan.');
    }
}
