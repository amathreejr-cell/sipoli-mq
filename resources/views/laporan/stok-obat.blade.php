
<x-app-layout>
    <div class="space-y-6">

        <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="flex flex-col gap-4 bg-gradient-to-r from-blue-50 to-white p-6 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm font-medium text-blue-600">Laporan</p>
                    <h1 class="mt-1 text-2xl font-bold text-slate-900">
                        Laporan Persediaan dan Pemakaian Obat
                    </h1>
                    <p class="mt-1 text-sm text-slate-500">
                        Rekap stok, obat masuk, pemakaian putra-putri, dan sisa persediaan.
                    </p>
                </div>

                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('laporan.stok-obat.pdf', request()->query()) }}"
                       class="rounded-xl bg-red-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-red-700">
                        Unduh PDF
                    </a>
                    <a href="{{ route('laporan.stok-obat.excel', request()->query()) }}"
                       class="rounded-xl bg-emerald-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-emerald-700">
                        Ekspor Excel
                    </a>
                    <a href="{{ route('laporan.mutasi-stok') }}"
                       class="rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 hover:bg-slate-50">
                        Riwayat Mutasi
                    </a>
                </div>
            </div>
        </div>

        {{-- FILTER --}}
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <h2 class="font-semibold text-slate-800">Filter Laporan</h2>

            <form method="GET" action="{{ route('laporan.stok-obat') }}"
                  class="mt-4 grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-5">

                <div>
                    <label for="tanggal_mulai" class="mb-1 block text-sm font-medium text-slate-700">
                        Tanggal Mulai
                    </label>
                    <input type="date" id="tanggal_mulai" name="tanggal_mulai"
                           value="{{ $tanggalMulai }}" required
                           class="w-full rounded-xl border-slate-300 text-sm">
                </div>

                <div>
                    <label for="tanggal_selesai" class="mb-1 block text-sm font-medium text-slate-700">
                        Tanggal Selesai
                    </label>
                    <input type="date" id="tanggal_selesai" name="tanggal_selesai"
                           value="{{ $tanggalSelesai }}" required
                           class="w-full rounded-xl border-slate-300 text-sm">
                </div>

                <div>
                    <label for="obat_id" class="mb-1 block text-sm font-medium text-slate-700">
                        Pilih Obat
                    </label>
                    <select id="obat_id" name="obat_id" class="w-full rounded-xl border-slate-300 text-sm">
                        <option value="">Semua Obat</option>
                        @foreach ($daftarObat as $obat)
                            <option value="{{ $obat->id }}"
                                @selected((string) request('obat_id') === (string) $obat->id)>
                                {{ $obat->nama }}{{ $obat->kode ? ' - '.$obat->kode : '' }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="cari" class="mb-1 block text-sm font-medium text-slate-700">
                        Cari Obat
                    </label>
                    <input type="text" id="cari" name="cari"
                           value="{{ request('cari') }}"
                           placeholder="Nama atau kode obat"
                           class="w-full rounded-xl border-slate-300 text-sm">
                </div>

                <div class="flex items-end gap-2">
                    <button type="submit"
                            class="rounded-xl bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-indigo-700">
                        Tampilkan
                    </button>
                    <a href="{{ route('laporan.stok-obat') }}"
                       class="rounded-xl border border-slate-200 px-4 py-2.5 text-sm font-semibold text-slate-600 hover:bg-slate-50">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        {{-- RINGKASAN --}}
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <p class="text-sm text-slate-500">Jenis Obat</p>
                <p class="mt-2 text-3xl font-bold text-slate-800">
                    {{ number_format($totalJenisObat) }}
                </p>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <p class="text-sm text-slate-500">Total Stok Awal</p>
                <p class="mt-2 text-3xl font-bold text-slate-800">
                    {{ number_format($totalStokAwal) }}
                </p>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <p class="text-sm text-slate-500">Total Obat Masuk</p>
                <p class="mt-2 text-3xl font-bold text-emerald-600">
                    {{ number_format($totalStokMasuk) }}
                </p>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <p class="text-sm text-slate-500">Total Sisa Stok</p>
                <p class="mt-2 text-3xl font-bold text-indigo-600">
                    {{ number_format($totalSisa) }}
                </p>
            </div>
        </div>

        {{-- REKAP STOK --}}
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-200 p-5">
                <h2 class="font-bold text-slate-800">A. Rekap Persediaan dan Pemakaian Obat</h2>
                <p class="mt-1 text-sm text-slate-500">
                    Periode {{ \Carbon\Carbon::parse($tanggalMulai)->format('d/m/Y') }}
                    sampai {{ \Carbon\Carbon::parse($tanggalSelesai)->format('d/m/Y') }}
                </p>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-slate-50 text-slate-600">
                        <tr>
                            <th class="whitespace-nowrap px-4 py-3 text-left">No.</th>
                            <th class="whitespace-nowrap px-4 py-3 text-left">Kode</th>
                            <th class="min-w-44 px-4 py-3 text-left">Nama Obat</th>
                            <th class="whitespace-nowrap px-4 py-3 text-left">Satuan</th>
                            <th class="whitespace-nowrap px-4 py-3 text-right">Stok Lama</th>
                            <th class="whitespace-nowrap px-4 py-3 text-right">Stok Baru / Masuk</th>
                            <th class="whitespace-nowrap px-4 py-3 text-right">Jumlah Stok</th>
                            <th class="whitespace-nowrap px-4 py-3 text-right">Terpakai Putra</th>
                            <th class="whitespace-nowrap px-4 py-3 text-right">Terpakai Putri</th>
                            <th class="whitespace-nowrap px-4 py-3 text-right">Keluar Lainnya</th>
                            <th class="whitespace-nowrap px-4 py-3 text-right">Total Keluar</th>
                            <th class="whitespace-nowrap px-4 py-3 text-right">Sisa Obat</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($laporan as $item)
                            <tr class="hover:bg-slate-50">
                                <td class="px-4 py-3">{{ $loop->iteration }}</td>
                                <td class="whitespace-nowrap px-4 py-3">{{ $item['kode'] ?: '-' }}</td>
                                <td class="px-4 py-3 font-medium text-slate-800">
                                    {{ $item['nama'] }}
                                    @if ($item['bentuk'])
                                        <p class="text-xs font-normal text-slate-400">{{ $item['bentuk'] }}</p>
                                    @endif
                                </td>
                                <td class="px-4 py-3">{{ $item['satuan'] ?: '-' }}</td>
                                <td class="px-4 py-3 text-right">{{ number_format($item['stok_awal']) }}</td>
                                <td class="px-4 py-3 text-right text-emerald-700">{{ number_format($item['stok_masuk']) }}</td>
                                <td class="px-4 py-3 text-right font-semibold">{{ number_format($item['jumlah_stok']) }}</td>
                                <td class="px-4 py-3 text-right">{{ number_format($item['terpakai_putra']) }}</td>
                                <td class="px-4 py-3 text-right">{{ number_format($item['terpakai_putri']) }}</td>
                                <td class="px-4 py-3 text-right">{{ number_format($item['keluar_lainnya']) }}</td>
                                <td class="px-4 py-3 text-right text-red-600">{{ number_format($item['total_keluar']) }}</td>
                                <td class="px-4 py-3 text-right font-bold text-indigo-700">{{ number_format($item['sisa_stok']) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="12" class="px-5 py-10 text-center text-slate-500">
                                    Tidak ada data obat untuk filter yang dipilih.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                    @if ($laporan->isNotEmpty())
                        <tfoot class="bg-slate-50 font-bold text-slate-800">
                            <tr>
                                <td colspan="4" class="px-4 py-3">TOTAL</td>
                                <td class="px-4 py-3 text-right">{{ number_format($totalStokAwal) }}</td>
                                <td class="px-4 py-3 text-right">{{ number_format($totalStokMasuk) }}</td>
                                <td class="px-4 py-3 text-right">{{ number_format($totalStokAwal + $totalStokMasuk) }}</td>
                                <td class="px-4 py-3 text-right">{{ number_format($totalPutra) }}</td>
                                <td class="px-4 py-3 text-right">{{ number_format($totalPutri) }}</td>
                                <td class="px-4 py-3 text-right">{{ number_format($laporan->sum('keluar_lainnya')) }}</td>
                                <td class="px-4 py-3 text-right">{{ number_format($totalKeluar) }}</td>
                                <td class="px-4 py-3 text-right">{{ number_format($totalSisa) }}</td>
                            </tr>
                        </tfoot>
                    @endif
                </table>
            </div>
        </div>

        {{-- RINCIAN PENGELUARAN --}}
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-200 p-5">
                <h2 class="font-bold text-slate-800">B. Rincian Pengeluaran Obat</h2>
                <p class="mt-1 text-sm text-slate-500">
                    Transaksi obat keluar pada periode yang dipilih.
                </p>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-slate-50 text-slate-600">
                        <tr>
                            <th class="whitespace-nowrap px-4 py-3 text-left">No.</th>
                            <th class="whitespace-nowrap px-4 py-3 text-left">Tanggal</th>
                            <th class="whitespace-nowrap px-4 py-3 text-left">Kode Obat</th>
                            <th class="px-4 py-3 text-left">Nama Obat</th>
                            <th class="px-4 py-3 text-right">Jumlah Keluar</th>
                            <th class="px-4 py-3 text-left">Santri</th>
                            <th class="px-4 py-3 text-left">Jenis Kelamin</th>
                            <th class="px-4 py-3 text-left">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($rincian as $item)
                            <tr class="hover:bg-slate-50">
                                <td class="px-4 py-3">{{ $loop->iteration }}</td>
                                <td class="whitespace-nowrap px-4 py-3">
                                    {{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y H:i') }}
                                </td>
                                <td class="px-4 py-3">{{ $item->kode ?: '-' }}</td>
                                <td class="px-4 py-3 font-medium">{{ $item->nama_obat }}</td>
                                <td class="px-4 py-3 text-right font-semibold">{{ number_format($item->jumlah) }} {{ $item->satuan }}</td>
                                <td class="px-4 py-3">{{ $item->nama_santri ?: 'Transaksi nonresep' }}</td>
                                <td class="px-4 py-3">
                                    @if ($item->jenis_kelamin === 'L')
                                        Putra
                                    @elseif ($item->jenis_kelamin === 'P')
                                        Putri
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="px-4 py-3">{{ $item->keterangan ?: '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-5 py-10 text-center text-slate-500">
                                    Tidak ada transaksi pengeluaran pada periode ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="rounded-2xl border border-blue-100 bg-blue-50 p-4 text-sm leading-6 text-blue-900">
            <strong>Catatan:</strong> pemakaian putra dan putri dihitung dari transaksi keluar yang
            terhubung dengan resep dan kunjungan santri. Transaksi keluar tanpa hubungan resep
            ditampilkan sebagai <em>Keluar Lainnya</em>. Stok lama dihitung berdasarkan riwayat
            mutasi yang tercatat; hasil historis memerlukan catatan mutasi yang lengkap.
        </div>
    </div>
</x-app-layout>
