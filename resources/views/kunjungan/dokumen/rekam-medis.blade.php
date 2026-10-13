<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <style>
        @page {
            size: A4;
            margin: 14mm 18mm 16mm 18mm;
        }

        * {
            box-sizing: border-box;
            font-family: DejaVu Serif, serif;
        }

        body {
            margin: 0;
            color: #1f2937;
            font-size: 9pt;
            line-height: 1.4;
        }

        /* =========================
           WATERMARK
        ========================= */

        .watermark {
            position: fixed;
            top: 50%;
            left: 50%;
            width: 430px;
            height: 430px;
            margin-left: -215px;
            margin-top: -215px;
            text-align: center;
            opacity: 0.055;
            z-index: -1;
        }

        .watermark img {
            width: 360px;
            height: 360px;
            object-fit: contain;
        }

        .watermark-text {
            position: absolute;
            top: 190px;
            left: -20px;
            width: 470px;
            font-size: 17pt;
            font-weight: bold;
            letter-spacing: 2px;
            transform: rotate(-35deg);
            white-space: nowrap;
        }

        /* =========================
           KOP
        ========================= */

        .kop {
            width: 100%;
            border-bottom: 2px solid #111827;
            padding-bottom: 6px;
        }

        .kop-inner {
            width: 100%;
            border-collapse: collapse;
        }

        .logo-cell {
            width: 90px;
            vertical-align: middle;
            text-align: left;
        }

        .logo {
            width: 78px;
            height: 78px;
            object-fit: contain;
        }

        .kop-text {
            text-align: center;
            vertical-align: middle;
            padding: 0 6px;
        }

        .nama-pondok {
            font-size: 12pt;
            font-weight: bold;
            text-transform: uppercase;
            line-height: 1.25;
        }

        .nama-poliklinik {
            margin-top: 0;
            font-size: 14pt;
            font-weight: bold;
            text-transform: uppercase;
            line-height: 1.25;
        }

        .alamat {
            margin-top: 2px;
            font-size: 8pt;
            line-height: 1.3;
        }

        .kontak {
            font-size: 8pt;
            line-height: 1.3;
        }

        /* =========================
           JUDUL
        ========================= */

        .judul-wrapper {
            margin-top: 13px;
            text-align: center;
        }

        .judul {
            font-size: 13pt;
            font-weight: bold;
            text-transform: uppercase;
            text-decoration: underline;
        }

        .nomor {
            margin-top: 2px;
            font-size: 8.5pt;
        }

        /* =========================
           SECTION
        ========================= */

        .section {
            margin-top: 10px;
        }

        .section-title {
            padding: 5px 8px;
            background: #f3f4f6;
            border-left: 4px solid #374151;
            font-weight: bold;
            font-size: 9.5pt;
        }

        /* =========================
           TABLE
        ========================= */

        table {
            border-collapse: collapse;
        }

        .data-table {
            width: 100%;
            margin-top: 5px;
        }

        .data-table td {
            padding: 3px 5px;
            vertical-align: top;
        }

        .data-table .label {
            width: 125px;
            font-weight: bold;
        }

        .data-table .separator {
            width: 12px;
        }

        /* =========================
           PEMERIKSAAN
        ========================= */

        .vital-table {
            width: 100%;
            margin-top: 6px;
            border: 1px solid #d1d5db;
        }

        .vital-table td {
            border: 1px solid #d1d5db;
            padding: 5px;
        }

        .vital-label {
            font-weight: bold;
            background: #f9fafb;
            width: 22%;
        }

        /* =========================
           DIAGNOSA / TINDAKAN / OBAT
        ========================= */

        .list-table {
            width: 100%;
            margin-top: 5px;
            border: 1px solid #d1d5db;
        }

        .list-table th {
            background: #f3f4f6;
            font-weight: bold;
            text-align: left;
        }

        .list-table th,
        .list-table td {
            border: 1px solid #d1d5db;
            padding: 5px;
            vertical-align: top;
        }

        .empty {
            color: #6b7280;
            font-style: italic;
        }

        /* =========================
           RUJUKAN
        ========================= */

        .rujukan-box {
            margin-top: 6px;
            border: 1px solid #d1d5db;
            padding: 7px 10px;
        }

        /* =========================
           FOOTER
        ========================= */

        .footer {
            position: fixed;
            bottom: -8mm;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 7pt;
            color: #6b7280;
        }

        .footer-line {
            border-top: 1px solid #d1d5db;
            margin-bottom: 3px;
        }

        /* =========================
           SIGNATURE
        ========================= */

        .signature {
            width: 100%;
            margin-top: 18px;
        }

        .signature td {
            vertical-align: top;
        }

        .signature-right {
            width: 45%;
            text-align: center;
        }

        .signature-space {
            height: 42px;
        }

        .signature-name {
            font-weight: bold;
            text-decoration: underline;
        }
    </style>
</head>

<body>

    {{-- WATERMARK --}}
    <div class="watermark">

        @if ($identitas->logo)
            <img
                src="{{ public_path('storage/' . $identitas->logo) }}"
                alt="Watermark">
        @endif

        <div class="watermark-text">
            SIPOLI-MQ • DOKUMEN RESMI
        </div>

    </div>


    {{-- KOP --}}
    <div class="kop">

        <table class="kop-inner">

            <tr>

                <td class="logo-cell">

                    @if ($identitas->logo)
                        <img
                            src="{{ public_path('storage/' . $identitas->logo) }}"
                            class="logo"
                            alt="Logo">
                    @endif

                </td>

                <td class="kop-text">

                    <div class="nama-poliklinik">
                        {{ $identitas->nama }}
                    </div>

                    @if ($identitas->alamat)
                        <div class="alamat">
                            {{ $identitas->alamat }}
                        </div>
                    @endif

                    @if ($identitas->telepon || $identitas->email)

                        <div class="kontak">

                            @if ($identitas->telepon)
                                Telp. {{ $identitas->telepon }}
                            @endif

                            @if ($identitas->telepon && $identitas->email)
                                &nbsp; | &nbsp;
                            @endif

                            @if ($identitas->email)
                                Email: {{ $identitas->email }}
                            @endif

                        </div>

                    @endif

                </td>

            </tr>

        </table>

    </div>


    {{-- JUDUL --}}
    <div class="judul-wrapper">

        <div class="judul">
            Rekam Medis
        </div>

        <div class="nomor">
            Nomor: {{ $nomorDokumen }}
        </div>

    </div>


    {{-- IDENTITAS SANTRI --}}
    <div class="section">

        <div class="section-title">
            IDENTITAS SANTRI
        </div>

        <table class="data-table">

            <tr>
                <td class="label">Nama</td>
                <td class="separator">:</td>
                <td>{{ $kunjungan->santri->nama }}</td>
            </tr>

            <tr>
                <td class="label">Nomor Induk</td>
                <td class="separator">:</td>
                <td>{{ $kunjungan->santri->nomor_induk }}</td>
            </tr>

            <tr>
                <td class="label">Kamar</td>
                <td class="separator">:</td>
                <td>{{ $kunjungan->santri->kamar ?: '-' }}</td>
            </tr>

            <tr>
                <td class="label">Sekolah</td>
                <td class="separator">:</td>
                <td>{{ $kunjungan->santri->sekolah ?: '-' }}</td>
            </tr>

            <tr>
                <td class="label">Kelas</td>
                <td class="separator">:</td>
                <td>{{ $kunjungan->santri->kelas ?: '-' }}</td>
            </tr>

        </table>

    </div>


    {{-- KUNJUNGAN --}}
    <div class="section">

        <div class="section-title">
            INFORMASI KUNJUNGAN
        </div>

        <table class="data-table">

            <tr>
                <td class="label">Tanggal</td>
                <td class="separator">:</td>
                <td>
                    {{ $kunjungan->tanggal?->translatedFormat('d F Y') }}
                </td>
            </tr>

            <tr>
                <td class="label">Waktu</td>
                <td class="separator">:</td>
                <td>{{ $kunjungan->waktu }}</td>
            </tr>

            <tr>
                <td class="label">Petugas</td>
                <td class="separator">:</td>
                <td>{{ $kunjungan->petugas->name ?? '-' }}</td>
            </tr>

            <tr>
                <td class="label">Keluhan</td>
                <td class="separator">:</td>
                <td>{{ $kunjungan->keluhan ?: '-' }}</td>
            </tr>

            @if ($kunjungan->catatan)

                <tr>
                    <td class="label">Catatan</td>
                    <td class="separator">:</td>
                    <td>{{ $kunjungan->catatan }}</td>
                </tr>

            @endif

        </table>

    </div>


    {{-- PEMERIKSAAN --}}
    <div class="section">

        <div class="section-title">
            HASIL PEMERIKSAAN
        </div>

        @if ($kunjungan->pemeriksaan)

            <table class="vital-table">

                <tr>
                    <td class="vital-label">Tekanan Darah</td>
                    <td>{{ $kunjungan->pemeriksaan->tekanan_darah ?: '-' }}</td>

                    <td class="vital-label">Suhu</td>
                    <td>{{ $kunjungan->pemeriksaan->suhu ?: '-' }} °C</td>
                </tr>

                <tr>
                    <td class="vital-label">Nadi</td>
                    <td>{{ $kunjungan->pemeriksaan->nadi ?: '-' }} /menit</td>

                    <td class="vital-label">Pernapasan</td>
                    <td>{{ $kunjungan->pemeriksaan->pernapasan ?: '-' }} /menit</td>
                </tr>

                <tr>
                    <td class="vital-label">Berat Badan</td>
                    <td>{{ $kunjungan->pemeriksaan->berat_badan ?: '-' }} kg</td>

                    <td class="vital-label">Tinggi Badan</td>
                    <td>{{ $kunjungan->pemeriksaan->tinggi_badan ?: '-' }} cm</td>
                </tr>

            </table>

            @if ($kunjungan->pemeriksaan->pemeriksaan_fisik)

                <table class="data-table">

                    <tr>
                        <td class="label">Pemeriksaan Fisik</td>
                        <td class="separator">:</td>
                        <td>
                            {{ $kunjungan->pemeriksaan->pemeriksaan_fisik }}
                        </td>
                    </tr>

                </table>

            @endif

        @else

            <div class="empty">
                Data pemeriksaan tidak tersedia.
            </div>

        @endif

    </div>


    {{-- DIAGNOSA --}}
    <div class="section">

        <div class="section-title">
            DIAGNOSA
        </div>

        @if ($kunjungan->diagnosas->count())

            <table class="list-table">

                <thead>
                    <tr>
                        <th width="40">No.</th>
                        <th>Kode</th>
                        <th>Diagnosa</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach ($kunjungan->diagnosas as $index => $diagnosa)

                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $diagnosa->kode ?: '-' }}</td>
                            <td>{{ $diagnosa->nama }}</td>
                        </tr>

                    @endforeach

                </tbody>

            </table>

        @else

            <div class="empty">
                Tidak ada diagnosa.
            </div>

        @endif

    </div>


    {{-- TINDAKAN --}}
    <div class="section">

        <div class="section-title">
            TINDAKAN
        </div>

        @if ($kunjungan->tindakans->count())

            <table class="list-table">

                <thead>
                    <tr>
                        <th width="40">No.</th>
                        <th>Kode</th>
                        <th>Tindakan</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach ($kunjungan->tindakans as $index => $tindakan)

                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $tindakan->kode ?: '-' }}</td>
                            <td>{{ $tindakan->nama }}</td>
                        </tr>

                    @endforeach

                </tbody>

            </table>

        @else

            <div class="empty">
                Tidak ada tindakan.
            </div>

        @endif

    </div>


    {{-- OBAT --}}
    @if ($kunjungan->resep && $kunjungan->resep->details->count())

        <div class="section">

            <div class="section-title">
                RESEP / OBAT
            </div>

            <table class="list-table">

                <thead>

                    <tr>
                        <th width="40">No.</th>
                        <th>Obat</th>
                        <th width="70">Jumlah</th>
                        <th>Aturan Pakai</th>
                    </tr>

                </thead>

                <tbody>

                    @foreach ($kunjungan->resep->details as $index => $detail)

                        <tr>

                            <td>{{ $index + 1 }}</td>

                            <td>
                                {{ $detail->obat->nama ?? '-' }}
                            </td>

                            <td>
                                {{ $detail->jumlah ?? '-' }}
                            </td>

                            <td>
                                {{ $detail->aturan_pakai ?? '-' }}
                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    @endif


    {{-- RUJUKAN --}}
    @if ($kunjungan->rujukan)

        <div class="section">

            <div class="section-title">
                RUJUKAN
            </div>

            <div class="rujukan-box">

                <table class="data-table">

                    <tr>
                        <td class="label">Fasilitas Tujuan</td>
                        <td class="separator">:</td>
                        <td>
                            <strong>
                                {{ $kunjungan->rujukan->masterRujukan->nama_fasilitas ?? '-' }}
                            </strong>
                        </td>
                    </tr>

                    @if ($kunjungan->rujukan->masterRujukan?->alamat)

                        <tr>
                            <td class="label">Alamat</td>
                            <td class="separator">:</td>
                            <td>
                                {{ $kunjungan->rujukan->masterRujukan->alamat }}
                            </td>
                        </tr>

                    @endif

                    <tr>
                        <td class="label">Alasan</td>
                        <td class="separator">:</td>
                        <td>
                            {{ $kunjungan->rujukan->alasan ?: '-' }}
                        </td>
                    </tr>

                    @if ($kunjungan->rujukan->keterangan)

                        <tr>
                            <td class="label">Keterangan</td>
                            <td class="separator">:</td>
                            <td>
                                {{ $kunjungan->rujukan->keterangan }}
                            </td>
                        </tr>

                    @endif

                </table>

            </div>

        </div>

    @endif


    {{-- TANDA TANGAN --}}
    <table class="signature">

        <tr>

            <td>
                &nbsp;
            </td>

            <td class="signature-right">

                Jombang,
                {{ $kunjungan->tanggal?->translatedFormat('d F Y') }}

                <br>

                {{ $identitas->jabatan_penandatangan ?: 'Petugas Poliklinik' }}

                <div class="signature-space"></div>

                <div class="signature-name">
                    {{ $identitas->nama_penandatangan ?: ($kunjungan->petugas->name ?? '-') }}
                </div>

            </td>

        </tr>

    </table>


    {{-- FOOTER --}}
    <div class="footer">

        <div class="footer-line"></div>

        Dokumen diterbitkan melalui SIPOLI-MQ •
        {{ $identitas->nama }}

    </div>

</body>

</html>