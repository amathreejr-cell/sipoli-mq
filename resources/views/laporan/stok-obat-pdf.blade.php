
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Persediaan dan Pemakaian Obat</title>
    <style>
        @page { margin: 22px; }
        body { font-family: DejaVu Sans, sans-serif; font-size: 8px; color: #1e293b; }
        h2 { text-align: center; margin: 0 0 5px; font-size: 15px; }
        .subjudul { text-align: center; margin-bottom: 14px; color: #64748b; }
        .periode { margin-bottom: 12px; line-height: 1.6; }
        h3 { font-size: 11px; margin: 16px 0 7px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #cbd5e1; padding: 5px 4px; }
        th { background: #e2e8f0; }
        .angka { text-align: right; }
        .tengah { text-align: center; }
        .catatan { margin-top: 12px; line-height: 1.5; color: #475569; }
    </style>
</head>
<body>
    <h2>LAPORAN PERSEDIAAN DAN PEMAKAIAN OBAT</h2>
    <div class="subjudul">Sistem Informasi Poliklinik Madrasatul Qur'an (SIPOLI-MQ)</div>

    <div class="periode">
        Periode:
        {{ \Carbon\Carbon::parse($tanggalMulai)->format('d/m/Y') }}
        sampai
        {{ \Carbon\Carbon::parse($tanggalSelesai)->format('d/m/Y') }}<br>
        Tanggal cetak: {{ now()->format('d/m/Y H:i') }}
    </div>

    <h3>A. Rekap Persediaan dan Pemakaian Obat</h3>
    <table>
        <thead>
            <tr>
                <th class="tengah">No.</th>
                <th>Kode</th>
                <th>Nama Obat</th>
                <th>Satuan</th>
                <th>Stok Lama</th>
                <th>Masuk</th>
                <th>Jumlah Stok</th>
                <th>Putra</th>
                <th>Putri</th>
                <th>Keluar Lainnya</th>
                <th>Total Keluar</th>
                <th>Sisa</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($laporan as $item)
                <tr>
                    <td class="tengah">{{ $loop->iteration }}</td>
                    <td>{{ $item['kode'] ?: '-' }}</td>
                    <td>{{ $item['nama'] }}</td>
                    <td>{{ $item['satuan'] ?: '-' }}</td>
                    <td class="angka">{{ $item['stok_awal'] }}</td>
                    <td class="angka">{{ $item['stok_masuk'] }}</td>
                    <td class="angka">{{ $item['jumlah_stok'] }}</td>
                    <td class="angka">{{ $item['terpakai_putra'] }}</td>
                    <td class="angka">{{ $item['terpakai_putri'] }}</td>
                    <td class="angka">{{ $item['keluar_lainnya'] }}</td>
                    <td class="angka">{{ $item['total_keluar'] }}</td>
                    <td class="angka">{{ $item['sisa_stok'] }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="12" class="tengah">Tidak ada data obat.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <h3>B. Rincian Pengeluaran Obat</h3>
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Tanggal</th>
                <th>Kode</th>
                <th>Nama Obat</th>
                <th>Jumlah</th>
                <th>Santri</th>
                <th>Jenis Kelamin</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($rincian as $item)
                <tr>
                    <td class="tengah">{{ $loop->iteration }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y H:i') }}</td>
                    <td>{{ $item->kode ?: '-' }}</td>
                    <td>{{ $item->nama_obat }}</td>
                    <td class="angka">{{ $item->jumlah }} {{ $item->satuan }}</td>
                    <td>{{ $item->nama_santri ?: 'Transaksi nonresep' }}</td>
                    <td>
                        @if ($item->jenis_kelamin === 'L')
                            Putra
                        @elseif ($item->jenis_kelamin === 'P')
                            Putri
                        @else
                            -
                        @endif
                    </td>
                    <td>{{ $item->keterangan ?: '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="tengah">Tidak ada transaksi pengeluaran.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="catatan">
        Stok lama dihitung dari saldo stok dan riwayat mutasi yang tercatat.
        Pemakaian putra dan putri dihitung dari transaksi keluar yang terhubung dengan resep santri.
    </div>
</body>
</html>
