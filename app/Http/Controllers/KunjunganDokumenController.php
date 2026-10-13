<?php

namespace App\Http\Controllers;

use App\Models\IdentitasPoliklinik;
use App\Models\Kunjungan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Response;

class KunjunganDokumenController extends Controller
{
    /**
     * Cetak Surat Izin Berobat.
     */
    public function suratIzin(Kunjungan $kunjungan): Response
    {
        if ($kunjungan->status !== 'selesai') {
            abort(403, 'Surat izin hanya dapat dibuat setelah kunjungan selesai.');
        }

        $kunjungan->load([
            'santri',
            'petugas',
        ]);

        $identitas = IdentitasPoliklinik::first();

        if (!$identitas) {
            abort(404, 'Identitas poliklinik belum dikonfigurasi.');
        }

        $bulanRomawi = [
            1 => 'I',
            2 => 'II',
            3 => 'III',
            4 => 'IV',
            5 => 'V',
            6 => 'VI',
            7 => 'VII',
            8 => 'VIII',
            9 => 'IX',
            10 => 'X',
            11 => 'XI',
            12 => 'XII',
        ];

        $nomorSurat = str_pad($kunjungan->id, 3, '0', STR_PAD_LEFT)
            . '/IZIN/POLIKLINIK-MQ/'
            . $bulanRomawi[$kunjungan->tanggal->month]
            . '/'
            . $kunjungan->tanggal->year;

        $pdf = Pdf::loadView(
            'kunjungan.dokumen.surat-izin',
            compact(
                'kunjungan',
                'identitas',
                'nomorSurat'
            )
        );

        $pdf->setPaper('A4', 'portrait');

        return $pdf->stream(
            'surat-izin-' . $kunjungan->santri->nomor_induk . '.pdf'
        );
    }

    public function suratRujukan(Kunjungan $kunjungan): Response
    {
        if ($kunjungan->status !== 'selesai') {
            abort(403, 'Surat rujukan hanya dapat dibuat setelah kunjungan selesai.');
        }

        $kunjungan->load([
            'santri',
            'petugas',
            'diagnosas',
            'tindakans',
            'rujukan.masterRujukan',
        ]);

        if (!$kunjungan->rujukan) {
            abort(404, 'Data rujukan belum tersedia.');
        }

        $identitas = IdentitasPoliklinik::first();

        if (!$identitas) {
            abort(404, 'Identitas poliklinik belum dikonfigurasi.');
        }

        $bulanRomawi = [
            1 => 'I',
            2 => 'II',
            3 => 'III',
            4 => 'IV',
            5 => 'V',
            6 => 'VI',
            7 => 'VII',
            8 => 'VIII',
            9 => 'IX',
            10 => 'X',
            11 => 'XI',
            12 => 'XII',
        ];

        $nomorSurat = str_pad($kunjungan->id, 3, '0', STR_PAD_LEFT)
            . '/RUJUKAN/POLIKLINIK-MQ/'
            . $bulanRomawi[$kunjungan->tanggal->month]
            . '/'
            . $kunjungan->tanggal->year;

        $pdf = Pdf::loadView(
            'kunjungan.dokumen.surat-rujukan',
            compact(
                'kunjungan',
                'identitas',
                'nomorSurat'
            )
        );

        $pdf->setPaper('A4', 'portrait');

        return $pdf->stream(
            'surat-rujukan-' .
                $kunjungan->santri->nomor_induk .
                '.pdf'
        );
    }

    public function rekamMedis(Kunjungan $kunjungan): Response
{
    if ($kunjungan->status !== 'selesai') {
        abort(403, 'Rekam medis hanya dapat dicetak setelah kunjungan selesai.');
    }

    $kunjungan->load([
        'santri',
        'petugas',
        'pemeriksaan',
        'diagnosas',
        'tindakans',
        'resep.details.obat',
        'rujukan.masterRujukan',
    ]);

    $identitas = IdentitasPoliklinik::first();

    if (!$identitas) {
        abort(404, 'Identitas poliklinik belum dikonfigurasi.');
    }

    $bulanRomawi = [
        1 => 'I',
        2 => 'II',
        3 => 'III',
        4 => 'IV',
        5 => 'V',
        6 => 'VI',
        7 => 'VII',
        8 => 'VIII',
        9 => 'IX',
        10 => 'X',
        11 => 'XI',
        12 => 'XII',
    ];

    $nomorDokumen = str_pad($kunjungan->id, 3, '0', STR_PAD_LEFT)
        . '/REKMED/POLIKLINIK-MQ/'
        . $bulanRomawi[$kunjungan->tanggal->month]
        . '/'
        . $kunjungan->tanggal->year;

    $pdf = Pdf::loadView(
        'kunjungan.dokumen.rekam-medis',
        compact(
            'kunjungan',
            'identitas',
            'nomorDokumen'
        )
    );

    $pdf->setPaper('A4', 'portrait');

    return $pdf->stream(
        'rekam-medis-' .
        $kunjungan->santri->nomor_induk .
        '.pdf'
    );
}
}
