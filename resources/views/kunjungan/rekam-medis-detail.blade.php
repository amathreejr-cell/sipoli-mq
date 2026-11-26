
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekam Medis - {{ $kunjungan->santri?->nama ?? 'Santri' }}</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 30px 16px;
            background: #f3f4f6;
            color: #222;
            font-family: Arial, sans-serif;
            font-size: 13px;
            line-height: 1.6;
        }

        .document {
            max-width: 850px;
            margin: auto;
            padding: 35px 42px;
            background: white;
            border: 1px solid #ddd;
        }

        .header {
            text-align: center;
            padding-bottom: 18px;
            border-bottom: 2px solid #222;
            margin-bottom: 22px;
        }

        .header h1 {
            margin: 0;
            font-size: 20px;
            text-transform: uppercase;
        }

        .header p {
            margin: 4px 0 0;
            color: #555;
        }

        .title {
            text-align: center;
            margin: 20px 0;
            font-size: 16px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .section {
            margin-bottom: 22px;
        }

        .section h2 {
            font-size: 13px;
            text-transform: uppercase;
            padding-bottom: 6px;
            margin: 0 0 10px;
            border-bottom: 1px solid #aaa;
        }

        .info {
            display: grid;
            grid-template-columns: 155px 1fr;
            gap: 5px 12px;
        }

        .label {
            color: #555;
        }

        .value {
            font-weight: 600;
            overflow-wrap: anywhere;
        }

        .vitals {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
        }

        .vital {
            padding: 9px 0;
            border-bottom: 1px solid #ddd;
        }

        .vital-label {
            display: block;
            color: #555;
            font-size: 12px;
        }

        .vital-value {
            font-weight: bold;
        }

        .content {
            white-space: pre-line;
            overflow-wrap: anywhere;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            text-align: left;
            vertical-align: top;
            border: 1px solid #ccc;
        }

        th {
            background: #f5f5f5;
            font-weight: bold;
        }

        .empty {
            color: #666;
            font-style: italic;
        }

        .footer {
            margin-top: 35px;
            padding-top: 12px;
            border-top: 1px solid #ccc;
            text-align: center;
            color: #666;
            font-size: 11px;
        }

        @media (max-width: 600px) {
            .document {
                padding: 22px 18px;
            }

            .info {
                grid-template-columns: 115px 1fr;
            }

            .vitals {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media print {
            @page {
                size: A4;
                margin: 15mm;
            }

            body {
                padding: 0;
                background: white;
                font-size: 11px;
            }

            .document {
                max-width: none;
                padding: 0;
                border: none;
            }

            .section, tr, .vital {
                break-inside: avoid;
            }
        }
    </style>
</head>

<body>
    <main class="document">

        <header class="header">
            <h1>Poliklinik Madrasatul Qur'an</h1>
            <p>Pondok Pesantren Madrasatul Qur'an Tebuireng</p>
        </header>

        <div class="title">Rekam Medis Pasien</div>

        {{-- IDENTITAS SANTRI --}}
        <section class="section">
            <h2>Identitas Santri</h2>

            <div class="info">
                <div class="label">Nomor Rekam Medis</div>
                <div class="value">
                    {{ $kunjungan->santri?->nomor_induk ?? '-' }}
                </div>

                <div class="label">Nama Lengkap</div>
                <div class="value">
                    {{ $kunjungan->santri?->nama ?? '-' }}
                </div>

                <div class="label">Jenis Kelamin</div>
                <div class="value">
                    {{ $kunjungan->santri?->jenis_kelamin ?? '-' }}
                </div>

                <div class="label">Tempat, Tanggal Lahir</div>
                <div class="value">
                    {{ $kunjungan->santri?->tempat_lahir ?? '-' }},
                    {{ $kunjungan->santri?->tanggal_lahir?->format('d-m-Y') ?? '-' }}
                </div>

                <div class="label">Kamar</div>
                <div class="value">
                    {{ $kunjungan->santri?->kamar ?? '-' }}
                </div>

                <div class="label">Sekolah / Kelas</div>
                <div class="value">
                    {{ $kunjungan->santri?->sekolah ?? '-' }}
                    / {{ $kunjungan->santri?->kelas ?? '-' }}
                </div>
            </div>
        </section>

        {{-- INFORMASI KUNJUNGAN --}}
        <section class="section">
            <h2>Informasi Kunjungan</h2>

            <div class="info">
                <div class="label">Kode Kunjungan</div>
                <div class="value">{{ $kunjungan->kode_kunjungan }}</div>

                <div class="label">Tanggal Kunjungan</div>
                <div class="value">
                    {{ $kunjungan->tanggal?->format('d-m-Y') ?? '-' }}
                </div>

                <div class="label">Waktu</div>
                <div class="value">{{ $kunjungan->waktu ?? '-' }}</div>

                <div class="label">Petugas Pemeriksa</div>
                <div class="value">{{ $kunjungan->petugas?->name ?? '-' }}</div>
            </div>

            <p><strong>Keluhan:</strong></p>
            <div class="content">{{ $kunjungan->keluhan ?: '-' }}</div>

            @if ($kunjungan->catatan)
                <p><strong>Catatan Kunjungan:</strong></p>
                <div class="content">{{ $kunjungan->catatan }}</div>
            @endif
        </section>

        {{-- RIWAYAT ALERGI --}}
        <section class="section">
            <h2>Riwayat Alergi</h2>

            @if ($kunjungan->santri?->alergis?->count())
                <table>
                    <thead>
                        <tr>
                            <th>Jenis</th>
                            <th>Pemicu</th>
                            <th>Reaksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kunjungan->santri->alergis as $alergi)
                            <tr>
                                <td>{{ $alergi->jenis }}</td>
                                <td>{{ $alergi->nama }}</td>
                                <td>{{ $alergi->reaksi ?: '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="empty">Tidak ada data alergi yang tercatat.</div>
            @endif
        </section>

        {{-- HASIL PEMERIKSAAN --}}
        <section class="section">
            <h2>Hasil Pemeriksaan</h2>

            @if ($kunjungan->pemeriksaan)
                @php
                    $p = $kunjungan->pemeriksaan;
                @endphp

                <div class="vitals">
                    <div class="vital">
                        <span class="vital-label">Tekanan Darah</span>
                        <span class="vital-value">{{ $p->tekanan_darah ?: '-' }}</span>
                    </div>

                    <div class="vital">
                        <span class="vital-label">Suhu</span>
                        <span class="vital-value">{{ $p->suhu ?? '-' }}</span>
                    </div>

                    <div class="vital">
                        <span class="vital-label">Nadi</span>
                        <span class="vital-value">{{ $p->nadi ?? '-' }}</span>
                    </div>

                    <div class="vital">
                        <span class="vital-label">Pernapasan</span>
                        <span class="vital-value">{{ $p->pernapasan ?? '-' }}</span>
                    </div>

                    <div class="vital">
                        <span class="vital-label">Berat Badan</span>
                        <span class="vital-value">{{ $p->berat_badan ?? '-' }}</span>
                    </div>

                    <div class="vital">
                        <span class="vital-label">Tinggi Badan</span>
                        <span class="vital-value">{{ $p->tinggi_badan ?? '-' }}</span>
                    </div>
                </div>

                <p><strong>Pemeriksaan Fisik:</strong></p>
                <div class="content">{{ $p->pemeriksaan_fisik ?: '-' }}</div>
            @else
                <div class="empty">Belum ada data pemeriksaan.</div>
            @endif
        </section>

        {{-- DIAGNOSIS --}}
        <section class="section">
            <h2>Diagnosis</h2>

            @if ($kunjungan->diagnosas->count())
                <table>
                    <thead>
                        <tr>
                            <th style="width: 35%">Kode Diagnosis</th>
                            <th>Nama Diagnosis</th>
                            <th>Catatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kunjungan->diagnosas as $diagnosa)
                            <tr>
                                <td>{{ $diagnosa->kode }}</td>
                                <td>{{ $diagnosa->nama }}</td>
                                <td>{{ $diagnosa->pivot->catatan ?: '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="empty">Belum ada diagnosis.</div>
            @endif
        </section>

        {{-- TINDAKAN --}}
        <section class="section">
            <h2>Tindakan Medis</h2>

            @if ($kunjungan->tindakans->count())
                <table>
                    <thead>
                        <tr>
                            <th style="width: 35%">Kode Tindakan</th>
                            <th>Nama Tindakan</th>
                            <th>Catatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kunjungan->tindakans as $tindakan)
                            <tr>
                                <td>{{ $tindakan->kode }}</td>
                                <td>{{ $tindakan->nama }}</td>
                                <td>{{ $tindakan->pivot->catatan ?: '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="empty">Tidak ada tindakan yang tercatat.</div>
            @endif
        </section>

        {{-- RESEP --}}
        <section class="section">
            <h2>Obat dan Resep</h2>

            @if ($kunjungan->resep)
                <p>
                    <strong>Nomor Resep:</strong>
                    {{ $kunjungan->resep->nomor_resep ?? '-' }}
                </p>

                @if ($kunjungan->resep->details->count())
                    <table>
                        <thead>
                            <tr>
                                <th>Nama Obat</th>
                                <th>Jumlah</th>
                                <th>Dosis</th>
                                <th>Frekuensi</th>
                                <th>Aturan Pakai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kunjungan->resep->details as $detail)
                                <tr>
                                    <td>{{ $detail->obat?->nama ?? '-' }}</td>
                                    <td>
                                        {{ $detail->jumlah }}
                                        {{ $detail->obat?->satuan ?? '' }}
                                    </td>
                                    <td>{{ $detail->dosis ?? '-' }}</td>
                                    <td>{{ $detail->frekuensi ?? '-' }}</td>
                                    <td>{{ $detail->aturan_pakai ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="empty">Belum ada detail obat.</div>
                @endif
            @else
                <div class="empty">Tidak ada resep pada kunjungan ini.</div>
            @endif
        </section>

        {{-- RUJUKAN --}}
        <section class="section">
            <h2>Rujukan</h2>

            @if ($kunjungan->rujukan)
                <div class="info">
                    <div class="label">Tanggal Rujukan</div>
                    <div class="value">
                        {{ $kunjungan->rujukan->tanggal_rujukan?->format('d-m-Y') ?? '-' }}
                    </div>

                    <div class="label">Fasilitas Tujuan</div>
                    <div class="value">
                        {{ $kunjungan->rujukan->masterRujukan?->nama_fasilitas ?? '-' }}
                    </div>

                    <div class="label">Alasan Rujukan</div>
                    <div class="value">
                        {{ $kunjungan->rujukan->alasan ?? '-' }}
                    </div>

                    <div class="label">Status Rujukan</div>
                    <div class="value">
                        {{ ucfirst($kunjungan->rujukan->status ?? '-') }}
                    </div>
                </div>
            @else
                <div class="empty">Tidak ada rujukan pada kunjungan ini.</div>
            @endif
        </section>

        <footer class="footer">
            Dokumen rekam medis Poliklinik Madrasatul Qur'an Tebuireng
        </footer>

    </main>
</body>
</html>
