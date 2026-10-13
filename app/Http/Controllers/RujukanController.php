<?php

namespace App\Http\Controllers;

use App\Models\Kunjungan;
use App\Models\MasterRujukan;
use App\Models\Rujukan;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class RujukanController extends Controller
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

        if ($kunjungan->perlu_rujukan !== true) {
            return redirect()
                ->route('kunjungan-keputusan.create', $kunjungan)
                ->with('error', 'Kunjungan ini tidak memerlukan rujukan.');
        }

        $masterRujukans = MasterRujukan::query()
            ->where('is_active', true)
            ->orderBy('nama_fasilitas')
            ->get();

        $rujukan = $kunjungan->rujukan;

        return view('rujukan.create', compact(
            'kunjungan',
            'masterRujukans',
            'rujukan'
        ));
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

        if ($kunjungan->perlu_rujukan !== true) {
            return redirect()
                ->route('kunjungan-keputusan.create', $kunjungan)
                ->with('error', 'Kunjungan ini tidak memerlukan rujukan.');
        }

        $validated = $request->validate([
            'rujukan_id' => [
                'required',
                'exists:master_rujukan,id',
            ],

            'tanggal_rujukan' => [
                'required',
                'date',
            ],

            'alasan' => [
                'required',
                'string',
            ],

            'keterangan' => [
                'nullable',
                'string',
            ],

            'status' => [
                'required',
                'in:direncanakan,dirujuk,selesai,dibatalkan',
            ],
        ]);

        $validated['kunjungan_id'] = $kunjungan->id;

        Rujukan::updateOrCreate(
            ['kunjungan_id' => $kunjungan->id],
            $validated
        );

        return redirect()
            ->route('kunjungan-ringkasan.show', $kunjungan)
            ->with('success', 'Rujukan berhasil disimpan. Silakan periksa ringkasan pelayanan.');
    }
}
