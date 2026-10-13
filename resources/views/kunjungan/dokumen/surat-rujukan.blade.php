<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <style>
        @page {
            size: A4;
            margin: 15mm 20mm 17mm 20mm;
        }

        * {
            box-sizing: border-box;
            font-family: DejaVu Serif, serif;
        }

        body {
            margin: 0;
            color: #1f2937;
            font-size: 10pt;
            line-height: 1.45;
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
            opacity: 0.06;
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
            margin-top: 17px;
            text-align: center;
        }

        .judul {
            font-size: 13pt;
            font-weight: bold;
            text-transform: uppercase;
            text-decoration: underline;
            line-height: 1.3;
        }

        .nomor {
            margin-top: 2px;
            font-size: 9pt;
        }

        /* =========================
           ISI
        ========================= */

        .pembuka {
            margin-top: 17px;
            text-align: justify;
        }

        .identitas {
            width: 100%;
            border-collapse: collapse;
            margin-top: 8px;
            margin-bottom: 10px;
        }

        .identitas td {
            padding: 2px 0;
            vertical-align: top;
        }

        .identitas .label {
            width: 115px;
        }

        .identitas .separator {
            width: 12px;
        }

        .identitas .value {
            font-weight: 600;
        }

        .isi {
            text-align: justify;
        }

        .isi p {
            margin: 0 0 7px 0;
        }

        /* =========================
           RUJUKAN
        ========================= */

        .rujukan-box {
            margin-top: 10px;
            padding: 9px 12px;
            border: 1px solid #d1d5db;
            background: #fafafa;
        }

        .rujukan-title {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .rujukan {
            width: 100%;
            border-collapse: collapse;
        }

        .rujukan td {
            padding: 2px 0;
            vertical-align: top;
        }

        .rujukan .label {
            width: 125px;
        }

        .rujukan .separator {
            width: 12px;
        }

        /* =========================
           PENUTUP
        ========================= */

        .penutup {
            margin-top: 12px;
            text-align: justify;
        }

        /* =========================
           TANDA TANGAN
        ========================= */

        .signature {
            width: 100%;
            border-collapse: collapse;
            margin-top: 22px;
        }

        .signature td {
            vertical-align: top;
        }

        .signature-left {
            width: 52%;
        }

        .signature-right {
            width: 48%;
            text-align: center;
        }

        .signature-space {
            height: 48px;
        }

        .signature-name {
            font-weight: bold;
            text-decoration: underline;
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
    </style>
</head>

<body>

    {{-- WATERMARK --}}
    <div class="watermark">
        @if ($identitas->logo)
            <img src="{{ public_path('storage/' . $identitas->logo) }}" alt="Watermark">
        @endif

        <div class="watermark-text">
            SIPOLI-MQ • DOKUMEN RESMI
        </div>
    </div>


    {{-- KOP SURAT --}}
    <div class="kop">
        <table class="kop-inner">
            <tr>

                <td class="logo-cell">
                    @if ($identitas->logo)
                        <img src="{{ public_path('storage/' . $identitas->logo) }}" class="logo" alt="Logo">
                    @endif
                </td>

                <td class="kop-text">

                    <div class="nama-poliklinik">
                        UNIT POLIKLINIK
                    </div>
                    <div class="nama-poliklinik">
                        PONDOK PESANTREN MADRASATUL QUR AN
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
            Surat Rujukan
        </div>

        <div class="nomor">
            Nomor: {{ $nomorSurat }}
        </div>

    </div>


    {{-- PEMBUKA --}}
    <div class="pembuka">
        Dengan ini menerangkan bahwa santri berikut:
    </div>


    {{-- IDENTITAS SANTRI --}}
    <table class="identitas">

        <tr>
            <td class="label">Nama</td>
            <td class="separator">:</td>
            <td class="value">
                {{ $kunjungan->santri->nama }}
            </td>
        </tr>

        <tr>
            <td class="label">Nomor Induk</td>
            <td class="separator">:</td>
            <td class="value">
                {{ $kunjungan->santri->nomor_induk }}
            </td>
        </tr>

        <tr>
            <td class="label">Kamar</td>
            <td class="separator">:</td>
            <td>
                {{ $kunjungan->santri->kamar ?: '-' }}
            </td>
        </tr>

        <tr>
            <td class="label">Sekolah</td>
            <td class="separator">:</td>
            <td>
                {{ $kunjungan->santri->sekolah ?: '-' }}
            </td>
        </tr>

        <tr>
            <td class="label">Kelas</td>
            <td class="separator">:</td>
            <td>
                {{ $kunjungan->santri->kelas ?: '-' }}
            </td>
        </tr>

    </table>


    {{-- ISI --}}
    <div class="isi">

        <p>
            Telah mendapatkan pelayanan kesehatan di
            <strong>{{ $identitas->nama }}</strong>
            pada:
        </p>

    </div>


    {{-- INFORMASI PELAYANAN --}}
    <div class="rujukan-box">

        <div class="rujukan-title">
            Informasi Pelayanan
        </div>

        <table class="rujukan">

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
                <td>
                    {{ $kunjungan->waktu }}
                </td>
            </tr>

            <tr>
                <td class="label">Petugas</td>
                <td class="separator">:</td>
                <td>
                    {{ $kunjungan->petugas->name ?? '-' }}
                </td>
            </tr>

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

        </table>

    </div>


    {{-- ALASAN RUJUKAN --}}
    <div class="isi" style="margin-top: 12px;">

        <p>
            <strong>Alasan Rujukan:</strong>
        </p>

        <p>
            {{ $kunjungan->rujukan->alasan ?: '-' }}
        </p>

        @if ($kunjungan->rujukan->keterangan)
            <p>
                <strong>Keterangan:</strong>
            </p>

            <p>
                {{ $kunjungan->rujukan->keterangan }}
            </p>
        @endif

    </div>


    {{-- PENUTUP --}}
    <div class="penutup">

        Demikian surat rujukan ini dibuat untuk dapat dipergunakan
        sebagaimana mestinya. Atas perhatian dan kerja samanya,
        kami sampaikan terima kasih.

    </div>


    {{-- TANDA TANGAN --}}
    <table class="signature">

        <tr>

            <td class="signature-left">
                &nbsp;
            </td>

            <td class="signature-right">

                Jombang,
                {{ $kunjungan->tanggal?->translatedFormat('d F Y') }}

                <br>

                {{ $identitas->jabatan_penandatangan ?: 'Petugas Poliklinik' }}

                <div class="signature-space"></div>

                <div class="signature-name">
                    {{ $identitas->nama_penandatangan ?: $kunjungan->petugas->name ?? '-' }}
                </div>

            </td>

        </tr>

    </table>


    {{-- FOOTER --}}
    <div class="footer">

        <div class="footer-line"></div>

        Dokumen diterbitkan melalui SIPOLI-MQ • Sistem Informasi Poliklinik
        {{ $identitas->nama }}

    </div>

</body>

</html>
