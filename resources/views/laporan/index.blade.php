<x-app-layout>

    <div class="space-y-6">

        {{-- HEADER --}}
        <div class="mb-6 overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
            <div class="bg-gradient-to-r from-amber-50 to-white px-6 py-6 sm:px-8">

                <div class="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">

                    <div class="flex items-center gap-4">

                        <div
                            class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-amber-100 text-amber-600">
                            <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 17v-2m3 2v-4m3 4v-6m2 9H7a2 2 0 01-2-2V5a2 2 0 012-2h10a2 2 0 012 2v13a2 2 0 01-2 2z" />
                            </svg>
                        </div>

                        <div>
                            <p class="text-sm font-medium text-amber-600">
                                Laporan
                            </p>

                            <h3 class="mt-1 text-xl font-bold text-gray-900">
                                Laporan Pelayanan
                            </h3>

                            <p class="mt-1 text-sm text-gray-500">
                                Rekap pelayanan poliklinik berdasarkan periode
                            </p>
                        </div>

                    </div>

                    <div class="flex flex-wrap gap-2 sm:justify-end">

                        <a href="{{ route('laporan.pdf', request()->query()) }}" target="_blank"
                            class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-red-600 text-white text-sm font-medium hover:bg-red-700">

                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 10v6m0 0l-3-3m3 3l3-3M5 4h9l5 5v11a2 2 0 01-2 2H5a2 2 0 01-2-2V6a2 2 0 012-2z" />

                            </svg>

                            Export PDF

                        </a>

                        <a href="{{ route('laporan.excel', request()->query()) }}"
                            class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-emerald-600 text-white text-sm font-medium hover:bg-emerald-700">

                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 4h16v16H4zM8 8l8 8M16 8l-8 8" />

                            </svg>

                            Export Excel

                        </a>

                    </div>

                </div>

            </div>
        </div>


        {{-- FILTER --}}
        <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm">

            <form method="GET" action="{{ route('laporan.index') }}"
                class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">

                <div>

                    <label class="block text-sm font-medium text-slate-700 mb-1">
                        Tanggal Mulai
                    </label>

                    <input type="date" name="tanggal_mulai" value="{{ $tanggalMulai }}"
                        class="w-full rounded-xl border-slate-300 focus:border-indigo-500 focus:ring-indigo-500">

                </div>

                <div>

                    <label class="block text-sm font-medium text-slate-700 mb-1">
                        Tanggal Selesai
                    </label>

                    <input type="date" name="tanggal_selesai" value="{{ $tanggalSelesai }}"
                        class="w-full rounded-xl border-slate-300 focus:border-indigo-500 focus:ring-indigo-500">

                </div>

                <button type="submit"
                    class="h-11 px-5 rounded-xl bg-indigo-600 text-white font-medium hover:bg-indigo-700">

                    Tampilkan Laporan

                </button>

            </form>

        </div>


        {{-- TOTAL --}}
        <div class="bg-gradient-to-r from-indigo-600 to-indigo-700 rounded-2xl p-6 text-white shadow-sm">

            <p class="text-sm text-indigo-100">
                Total Kunjungan
            </p>

            <div class="mt-1 text-3xl font-bold">
                {{ number_format($kunjungans->count()) }}
            </div>

            <p class="mt-1 text-sm text-indigo-100">

                {{ \Carbon\Carbon::parse($tanggalMulai)->locale('id')->translatedFormat('d F Y') }}

                –

                {{ \Carbon\Carbon::parse($tanggalSelesai)->locale('id')->translatedFormat('d F Y') }}

            </p>

        </div>


        {{-- A. PER TANGGAL --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

            <div class="px-6 py-5 border-b border-slate-200">

                <h2 class="font-bold text-slate-800">
                    A. Rekap Kunjungan Per Tanggal
                </h2>

                <p class="text-sm text-slate-500 mt-1">
                    Jumlah kunjungan berdasarkan tanggal pelayanan.
                </p>

            </div>

            <div class="overflow-x-auto">

                <table class="w-full text-sm">

                    <thead class="bg-slate-50">

                        <tr>

                            <th class="px-6 py-3 text-left">Tanggal</th>

                            <th class="px-6 py-3 text-center">
                                Laki-laki
                            </th>

                            <th class="px-6 py-3 text-center">
                                Perempuan
                            </th>

                            <th class="px-6 py-3 text-center">
                                Total
                            </th>

                        </tr>

                    </thead>

                    <tbody class="divide-y divide-slate-100">

                        @foreach ($statistik['perTanggal'] as $item)
                            <tr>

                                <td class="px-6 py-3">
                                    {{ $item['label'] }}
                                </td>

                                <td class="px-6 py-3 text-center">
                                    {{ $item['laki_laki'] }}
                                </td>

                                <td class="px-6 py-3 text-center">
                                    {{ $item['perempuan'] }}
                                </td>

                                <td class="px-6 py-3 text-center font-bold">
                                    {{ $item['total'] }}
                                </td>

                            </tr>
                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>


        {{-- B. TINDAKAN --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

            <div class="px-6 py-5 border-b border-slate-200">

                <h2 class="font-bold text-slate-800">
                    B. Kunjungan Berdasarkan Tindakan
                </h2>

                <p class="text-sm text-slate-500 mt-1">
                    Rekap pelayanan yang diberikan kepada santri.
                </p>

            </div>

            <div class="overflow-x-auto">

                <table class="w-full text-sm">

                    <thead class="bg-slate-50">

                        <tr>

                            <th class="px-5 py-3 text-left">Kode</th>
                            <th class="px-5 py-3 text-left">Tindakan</th>
                            <th class="px-5 py-3 text-center">Laki-laki</th>
                            <th class="px-5 py-3 text-center">Perempuan</th>
                            <th class="px-5 py-3 text-center">Total</th>

                        </tr>

                    </thead>

                    <tbody class="divide-y divide-slate-100">

                        @foreach ($statistik['perTindakan'] as $item)
                            <tr>

                                <td class="px-5 py-3">
                                    {{ $item['kode'] ?: '-' }}
                                </td>

                                <td class="px-5 py-3 font-medium">
                                    {{ $item['nama'] }}
                                </td>

                                <td class="px-5 py-3 text-center">
                                    {{ $item['laki_laki'] }}
                                </td>

                                <td class="px-5 py-3 text-center">
                                    {{ $item['perempuan'] }}
                                </td>

                                <td class="px-5 py-3 text-center font-bold">
                                    {{ $item['total'] }}
                                </td>

                            </tr>
                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>


        {{-- C. JENIS KELAMIN --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

            <div class="px-6 py-5 border-b border-slate-200">

                <h2 class="font-bold text-slate-800">
                    C. Kunjungan Berdasarkan Jenis Kelamin
                </h2>

            </div>

            <table class="w-full text-sm">

                <thead class="bg-slate-50">

                    <tr>
                        <th class="px-6 py-3 text-left">
                            Jenis Kelamin
                        </th>

                        <th class="px-6 py-3 text-center">
                            Jumlah
                        </th>
                    </tr>

                </thead>

                <tbody class="divide-y divide-slate-100">

                    <tr>

                        <td class="px-6 py-3">
                            Laki-laki
                        </td>

                        <td class="px-6 py-3 text-center font-bold">
                            {{ $statistik['perJenisKelamin']['Laki-laki'] }}
                        </td>

                    </tr>

                    <tr>

                        <td class="px-6 py-3">
                            Perempuan
                        </td>

                        <td class="px-6 py-3 text-center font-bold">
                            {{ $statistik['perJenisKelamin']['Perempuan'] }}
                        </td>

                    </tr>

                    <tr class="bg-slate-50 font-bold">

                        <td class="px-6 py-3">
                            Total
                        </td>

                        <td class="px-6 py-3 text-center">
                            {{ $statistik['totalKunjungan'] }}
                        </td>

                    </tr>

                </tbody>

            </table>

        </div>


        {{-- D. DIAGNOSA --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

            <div class="px-6 py-5 border-b border-slate-200">

                <h2 class="font-bold text-slate-800">
                    D. Kunjungan Berdasarkan Diagnosa
                </h2>

                <p class="text-sm text-slate-500 mt-1">
                    Setiap diagnosa dihitung berdasarkan jenis kelamin pasien.
                </p>

            </div>

            <div class="overflow-x-auto">

                <table class="w-full text-sm">

                    <thead class="bg-slate-50">

                        <tr>

                            <th class="px-5 py-3 text-left">Kode</th>

                            <th class="px-5 py-3 text-left">
                                Diagnosa
                            </th>

                            <th class="px-5 py-3 text-center">
                                Laki-laki
                            </th>

                            <th class="px-5 py-3 text-center">
                                Perempuan
                            </th>

                            <th class="px-5 py-3 text-center">
                                Total
                            </th>

                        </tr>

                    </thead>

                    <tbody class="divide-y divide-slate-100">

                        @foreach ($statistik['perDiagnosa'] as $item)
                            <tr>

                                <td class="px-5 py-3">
                                    {{ $item['kode'] ?: '-' }}
                                </td>

                                <td class="px-5 py-3 font-medium">
                                    {{ $item['nama'] }}
                                </td>

                                <td class="px-5 py-3 text-center">
                                    {{ $item['laki_laki'] }}
                                </td>

                                <td class="px-5 py-3 text-center">
                                    {{ $item['perempuan'] }}
                                </td>

                                <td class="px-5 py-3 text-center font-bold">
                                    {{ $item['total'] }}
                                </td>

                            </tr>
                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>


        {{-- E. JAM OPERASIONAL --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

            <div class="px-6 py-5 border-b border-slate-200">

                <h2 class="font-bold text-slate-800">
                    E. Kunjungan Berdasarkan Jam Operasional
                </h2>

                <p class="text-sm text-slate-500 mt-1">
                    Pagi 07.00–14.00 · Sore 14.30–19.30 ·
                    selain itu dihitung sebagai luar jam operasional.
                </p>

            </div>

            <div class="overflow-x-auto">

                <table class="w-full text-sm">

                    <thead class="bg-slate-50">

                        <tr>

                            <th class="px-5 py-3 text-left">
                                Jam Pelayanan
                            </th>

                            <th class="px-5 py-3 text-center">
                                Laki-laki
                            </th>

                            <th class="px-5 py-3 text-center">
                                Perempuan
                            </th>

                            <th class="px-5 py-3 text-center">
                                Total
                            </th>

                            <th class="px-5 py-3 text-center">
                                Persentase
                            </th>

                        </tr>

                    </thead>

                    <tbody class="divide-y divide-slate-100">

                        @foreach ($statistik['jamOperasional'] as $nama => $item)
                            @php
                                $persentase =
                                    $statistik['totalKunjungan'] > 0
                                        ? round(($item['total'] / $statistik['totalKunjungan']) * 100, 2)
                                        : 0;
                            @endphp

                            <tr>

                                <td class="px-5 py-3 font-medium">

                                    {{ $nama }}

                                    @if ($nama === 'Pagi')
                                        <span class="text-xs text-slate-400">
                                            (07.00–14.00)
                                        </span>
                                    @elseif ($nama === 'Sore')
                                        <span class="text-xs text-slate-400">
                                            (14.30–19.30)
                                        </span>
                                    @else
                                        <span class="text-xs text-slate-400">
                                            (di luar jam kerja)
                                        </span>
                                    @endif

                                </td>

                                <td class="px-5 py-3 text-center">
                                    {{ $item['laki_laki'] }}
                                </td>

                                <td class="px-5 py-3 text-center">
                                    {{ $item['perempuan'] }}
                                </td>

                                <td class="px-5 py-3 text-center font-bold">
                                    {{ $item['total'] }}
                                </td>

                                <td class="px-5 py-3 text-center">
                                    {{ $persentase }}%
                                </td>

                            </tr>
                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</x-app-layout>
