<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <style>
        @page {
            size: A4 portrait;
            margin: 14mm 16mm 17mm 16mm;
        }

        * {
            box-sizing: border-box;
            font-family: DejaVu Serif, serif;
        }

        body {
            margin: 0;
            color: #1f2937;
            font-size: 8.5pt;
            line-height: 1.35;
        }

        /* =========================
           WATERMARK
        ========================= */

        .watermark {
            position: fixed;
            top: 50%;
            left: 50%;
            width: 420px;
            height: 420px;
            margin-left: -210px;
            margin-top: -210px;
            text-align: center;
            opacity: 0.045;
            z-index: -1;
        }

        .watermark img {
            width: 350px;
            height: 350px;
            object-fit: contain;
        }

        .watermark-text {
            position: absolute;
            top: 185px;
            left: -25px;
            width: 470px;
            font-size: 16pt;
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
            padding-bottom: 7px;
        }

        .kop-table {
            width: 100%;
            border-collapse: collapse;
        }

        .logo-cell {
            width: 82px;
            vertical-align: middle;
        }

        .logo {
            width: 72px;
            height: 72px;
            object-fit: contain;
        }

        .kop-text {
            vertical-align: middle;
            text-align: left;
            padding-left: 8px;
        }

        .nama {
            font-size: 15pt;
            font-weight: bold;
            text-transform: uppercase;
            line-height: 1.2;
        }

        .alamat,
        .kontak {
            font-size: 7.8pt;
            line-height: 1.3;
        }

        .alamat {
            margin-top: 2px;
        }

        /* =========================
           JUDUL
        ========================= */

        .judul {
            margin-top: 13px;
            text-align: center;
        }

        .judul h1 {
            margin: 0;
            font-size: 13pt;
            text-transform: uppercase;
            text-decoration: underline;
        }

        .periode {
            margin-top: 3px;
            font-size: 8pt;
        }

        /* =========================
           RINGKASAN
        ========================= */

        .summary {
            width: 100%;
            margin-top: 10px;
            border-collapse: collapse;
        }

        .summary td {
            border: 1px solid #cbd5e1;
            padding: 5px 6px;
            text-align: center;
        }

        .summary .number {
            font-size: 13pt;
            font-weight: bold;
        }

        .summary .label {
            font-size: 7pt;
            color: #475569;
        }

        /* =========================
           SECTION
        ========================= */

        .section {
            margin-top: 13px;
        }

        .section-title {
            background: #f1f5f9;
            border-left: 4px solid #334155;
            padding: 6px 8px;
            font-size: 9pt;
            font-weight: bold;
            text-transform: uppercase;
        }

        .section-description {
            margin: 4px 0 6px 0;
            font-size: 7.5pt;
            color: #64748b;
        }

        /* =========================
           TABLE
        ========================= */

        .report-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .report-table thead {
            display: table-header-group;
        }

        .report-table tr {
            page-break-inside: avoid;
        }

        .report-table th {
            background: #e2e8f0;
            border: 1px solid #cbd5e1;
            padding: 5px 4px;
            font-size: 7.5pt;
            font-weight: bold;
            text-align: center;
        }

        .report-table td {
            border: 1px solid #cbd5e1;
            padding: 4px;
            vertical-align: top;
            word-wrap: break-word;
            overflow-wrap: break-word;
            font-size: 7.8pt;
        }

        .text-left {
            text-align: left;
        }

        .text-center {
            text-align: center;
        }

        .total-row td {
            background: #f8fafc;
            font-weight: bold;
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
            font-size: 6.5pt;
            color: #64748b;
        }

        .footer-line {
            border-top: 1px solid #cbd5e1;
            margin-bottom: 3px;
        }

        /* =========================
           SIGNATURE
        ========================= */

        .signature {
            width: 100%;
            margin-top: 18px;
            border-collapse: collapse;
        }

        .signature-right {
            width: 42%;
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

    {{-- =========================
         WATERMARK
    ========================= --}}

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


    {{-- =========================
         KOP SURAT
    ========================= --}}

    <div class="kop">

        <table class="kop-table">

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

                    <div class="nama">
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


    {{-- =========================
         JUDUL
    ========================= --}}

    <div class="judul">

        <h1>
            Laporan Pelayanan Poliklinik
        </h1>

        <div class="periode">

            Periode:

            {{ \Carbon\Carbon::parse($tanggalMulai)
                ->locale('id')
                ->translatedFormat('d F Y') }}

            s/d

            {{ \Carbon\Carbon::parse($tanggalSelesai)
                ->locale('id')
                ->translatedFormat('d F Y') }}

        </div>

    </div>


    {{-- =========================
         RINGKASAN
    ========================= --}}

    <table class="summary">

        <tr>

            <td>

                <div class="number">
                    {{ $statistik['totalKunjungan'] }}
                </div>

                <div class="label">
                    TOTAL KUNJUNGAN
                </div>

            </td>

            <td>

                <div class="number">
                    {{ $statistik['perJenisKelamin']['Laki-laki'] }}
                </div>

                <div class="label">
                    LAKI-LAKI
                </div>

            </td>

            <td>

                <div class="number">
                    {{ $statistik['perJenisKelamin']['Perempuan'] }}
                </div>

                <div class="label">
                    PEREMPUAN
                </div>

            </td>

        </tr>

    </table>


    {{-- =========================
         A. PER TANGGAL
    ========================= --}}

    <div class="section">

        <div class="section-title">
            A. Rekap Kunjungan Per Tanggal
        </div>

        <div class="section-description">
            Rekapitulasi jumlah kunjungan berdasarkan tanggal pelayanan.
        </div>

        <table class="report-table">

            <colgroup>
                <col style="width: 46%;">
                <col style="width: 18%;">
                <col style="width: 18%;">
                <col style="width: 18%;">
            </colgroup>

            <thead>

                <tr>

                    <th class="text-left">
                        Tanggal
                    </th>

                    <th>
                        Laki-laki
                    </th>

                    <th>
                        Perempuan
                    </th>

                    <th>
                        Total
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse ($statistik['perTanggal'] as $item)

                    <tr>

                        <td>
                            {{ $item['label'] }}
                        </td>

                        <td class="text-center">
                            {{ $item['laki_laki'] }}
                        </td>

                        <td class="text-center">
                            {{ $item['perempuan'] }}
                        </td>

                        <td class="text-center">
                            {{ $item['total'] }}
                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="4" class="text-center">
                            Tidak ada data kunjungan.
                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>


    {{-- =========================
         B. JAM OPERASIONAL
    ========================= --}}

    <div class="section">

        <div class="section-title">
            B. Kunjungan Berdasarkan Jam Operasional
        </div>

        <div class="section-description">
            Pagi 07.00–14.00 · Sore 14.30–19.30 ·
            selain waktu tersebut dihitung sebagai luar jam operasional.
        </div>

        <table class="report-table">

            <colgroup>
                <col style="width: 40%;">
                <col style="width: 15%;">
                <col style="width: 15%;">
                <col style="width: 15%;">
                <col style="width: 15%;">
            </colgroup>

            <thead>

                <tr>

                    <th class="text-left">
                        Jam Pelayanan
                    </th>

                    <th>
                        Laki-laki
                    </th>

                    <th>
                        Perempuan
                    </th>

                    <th>
                        Total
                    </th>

                    <th>
                        Persentase
                    </th>

                </tr>

            </thead>

            <tbody>

                @foreach ($statistik['jamOperasional'] as $nama => $item)

                    @php

                        $persentase = $statistik['totalKunjungan'] > 0
                            ? round(
                                ($item['total'] / $statistik['totalKunjungan']) * 100,
                                2
                            )
                            : 0;

                    @endphp

                    <tr>

                        <td>

                            <strong>
                                {{ $nama }}
                            </strong>

                            <br>

                            @if ($nama === 'Pagi')

                                <span style="font-size: 7pt; color: #64748b;">
                                    07.00–14.00
                                </span>

                            @elseif ($nama === 'Sore')

                                <span style="font-size: 7pt; color: #64748b;">
                                    14.30–19.30
                                </span>

                            @else

                                <span style="font-size: 7pt; color: #64748b;">
                                    Di luar jam kerja
                                </span>

                            @endif

                        </td>

                        <td class="text-center">
                            {{ $item['laki_laki'] }}
                        </td>

                        <td class="text-center">
                            {{ $item['perempuan'] }}
                        </td>

                        <td class="text-center">
                            {{ $item['total'] }}
                        </td>

                        <td class="text-center">
                            {{ $persentase }}%
                        </td>

                    </tr>

                @endforeach

            </tbody>

        </table>

    </div>


    {{-- =========================
         C. TINDAKAN
    ========================= --}}

    <div class="section">

        <div class="section-title">
            C. Kunjungan Berdasarkan Tindakan
        </div>

        <div class="section-description">
            Rekapitulasi jenis tindakan pelayanan yang diberikan.
        </div>

        <table class="report-table">

            <colgroup>
                <col style="width: 15%;">
                <col style="width: 43%;">
                <col style="width: 14%;">
                <col style="width: 14%;">
                <col style="width: 14%;">
            </colgroup>

            <thead>

                <tr>

                    <th>
                        Kode
                    </th>

                    <th class="text-left">
                        Tindakan
                    </th>

                    <th>
                        Laki-laki
                    </th>

                    <th>
                        Perempuan
                    </th>

                    <th>
                        Total
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse ($statistik['perTindakan'] as $item)

                    <tr>

                        <td class="text-center">
                            {{ $item['kode'] ?: '-' }}
                        </td>

                        <td>
                            {{ $item['nama'] }}
                        </td>

                        <td class="text-center">
                            {{ $item['laki_laki'] }}
                        </td>

                        <td class="text-center">
                            {{ $item['perempuan'] }}
                        </td>

                        <td class="text-center">
                            {{ $item['total'] }}
                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="5" class="text-center">
                            Tidak ada data tindakan.
                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>


    {{-- =========================
         D. JENIS KELAMIN
    ========================= --}}

    <div class="section">

        <div class="section-title">
            D. Kunjungan Berdasarkan Jenis Kelamin
        </div>

        <table class="report-table">

            <colgroup>
                <col style="width: 70%;">
                <col style="width: 30%;">
            </colgroup>

            <thead>

                <tr>

                    <th class="text-left">
                        Jenis Kelamin
                    </th>

                    <th>
                        Jumlah
                    </th>

                </tr>

            </thead>

            <tbody>

                <tr>

                    <td>
                        Laki-laki
                    </td>

                    <td class="text-center">
                        {{ $statistik['perJenisKelamin']['Laki-laki'] }}
                    </td>

                </tr>

                <tr>

                    <td>
                        Perempuan
                    </td>

                    <td class="text-center">
                        {{ $statistik['perJenisKelamin']['Perempuan'] }}
                    </td>

                </tr>

                <tr class="total-row">

                    <td>
                        Total
                    </td>

                    <td class="text-center">
                        {{ $statistik['totalKunjungan'] }}
                    </td>

                </tr>

            </tbody>

        </table>

    </div>


    {{-- =========================
         E. DIAGNOSA
    ========================= --}}

    <div class="section">

        <div class="section-title">
            E. Kunjungan Berdasarkan Diagnosa
        </div>

        <div class="section-description">
            Rekapitulasi diagnosa berdasarkan jenis kelamin santri.
        </div>

        <table class="report-table">

            <colgroup>
                <col style="width: 14%;">
                <col style="width: 42%;">
                <col style="width: 14%;">
                <col style="width: 14%;">
                <col style="width: 16%;">
            </colgroup>

            <thead>

                <tr>

                    <th>
                        Kode
                    </th>

                    <th class="text-left">
                        Diagnosa
                    </th>

                    <th>
                        Laki-laki
                    </th>

                    <th>
                        Perempuan
                    </th>

                    <th>
                        Total
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse ($statistik['perDiagnosa'] as $item)

                    <tr>

                        <td class="text-center">
                            {{ $item['kode'] ?: '-' }}
                        </td>

                        <td>
                            {{ $item['nama'] }}
                        </td>

                        <td class="text-center">
                            {{ $item['laki_laki'] }}
                        </td>

                        <td class="text-center">
                            {{ $item['perempuan'] }}
                        </td>

                        <td class="text-center">
                            {{ $item['total'] }}
                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="5" class="text-center">
                            Tidak ada data diagnosa.
                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>


    {{-- =========================
         TANDA TANGAN
    ========================= --}}

    <table class="signature">

        <tr>

            <td></td>

            <td class="signature-right">

                Jombang,
                {{ now()->locale('id')->translatedFormat('d F Y') }}

                <br>

                {{ $identitas->jabatan_penandatangan ?: 'Penanggung Jawab Poliklinik' }}

                <div class="signature-space"></div>

                <div class="signature-name">

                    {{ $identitas->nama_penandatangan ?: '-' }}

                </div>

            </td>

        </tr>

    </table>


    {{-- =========================
         FOOTER
    ========================= --}}

    <div class="footer">

        <div class="footer-line"></div>

        Dokumen diterbitkan melalui SIPOLI-MQ •
        {{ $identitas->nama }}

    </div>

</body>

</html>