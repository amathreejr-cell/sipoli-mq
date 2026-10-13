<?php

namespace App\Http\Controllers;

use App\Models\Kunjungan;
use App\Models\Pemeriksaan;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PemeriksaanController extends Controller
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

        $pemeriksaan = $kunjungan->pemeriksaan;

        return view(
            'pemeriksaan.create',
            compact('kunjungan', 'pemeriksaan')
        );
    }

    public function store(Request $request, Kunjungan $kunjungan)
    {
        if (
            in_array($kunjungan->status, ['selesai', 'dibatalkan'])
            && Auth::user()->role !== 'admin'
        ) {
            return redirect()
                ->route('kunjungan.show', $kunjungan)
                ->with('error', 'Kunjungan yang sudah selesai atau dibatalkan tidak dapat diedit.');
        }


        $validated = $request->validate([
            'tekanan_darah' => ['required', 'string', 'max:20'],
            'suhu' => ['required', 'numeric', 'between:30,45'],
            'nadi' => ['nullable', 'integer', 'min:0', 'max:250'],
            'pernapasan' => ['nullable', 'integer', 'min:0', 'max:100'],
            'berat_badan' => ['nullable', 'numeric', 'min:0', 'max:300'],
            'tinggi_badan' => ['nullable', 'numeric', 'min:0', 'max:250'],
            'pemeriksaan_fisik' => ['nullable', 'string'],
            'catatan' => ['nullable', 'string'],
        ]);

        $validated['kunjungan_id'] = $kunjungan->id;

        Pemeriksaan::updateOrCreate(
            ['kunjungan_id' => $kunjungan->id],
            $validated
        );

        if ($kunjungan->status !== 'selesai') {
            $kunjungan->update([
                'status' => 'diperiksa',
            ]);
        }

        if (
            Auth::user()->role === 'admin'
            && $kunjungan->status === 'selesai'
        ) {
            return redirect()
                ->route('kunjungan.show', $kunjungan)
                ->with('success', 'Pemeriksaan berhasil diperbarui.');
        }

        return redirect()
            ->route('kunjungan-diagnosa.create', $kunjungan)
            ->with('success', 'Pemeriksaan berhasil disimpan. Silakan tentukan diagnosa.');
    }
}
