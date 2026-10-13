<x-app-layout>

    {{-- =========================================================
        CHART.JS
    ========================================================== --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>


    <div class="max-w-7xl mx-auto space-y-6">

        {{-- =====================================================
            HEADER
        ====================================================== --}}
        <div class="relative overflow-hidden rounded-3xl bg-slate-900 shadow-lg">

            <div class="absolute inset-0 bg-gradient-to-br from-indigo-600/20 via-transparent to-teal-500/10"></div>

            <div class="relative px-6 py-7 sm:px-8">

                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-5">

                    <div class="flex items-center gap-4">

                        <div class="w-12 h-12 rounded-2xl bg-white/10 border border-white/10
                                    flex items-center justify-center text-indigo-300">

                            <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a3 3 0 006 0M9 13h6M9 17h4" />

                            </svg>

                        </div>

                        <div>

                            <h1 class="text-2xl sm:text-3xl font-bold text-white tracking-tight">
                                Dashboard SIPOLI-MQ
                            </h1>

                            <p class="mt-1 text-sm text-slate-400">
                                Ringkasan pelayanan Poliklinik Madrasatul Qur'an
                            </p>

                        </div>

                    </div>

                    <div>
                        <span class="inline-flex items-center gap-2 px-3 py-2 rounded-xl
                                     bg-white/10 border border-white/10
                                     text-xs font-medium text-slate-200">

                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>

                            {{ now()->translatedFormat('l, d F Y') }}

                        </span>
                    </div>

                </div>

            </div>
        </div>


        {{-- =====================================================
            STATISTIK UTAMA
        ====================================================== --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

            {{-- Total Kunjungan --}}
            <div class="group bg-white rounded-2xl border border-slate-200
                        shadow-sm hover:shadow-md transition-all duration-200">

                <div class="p-6">

                    <div class="flex items-start justify-between">

                        <div>

                            <p class="text-sm font-medium text-slate-500">
                                Total Kunjungan
                            </p>

                            <p class="mt-3 text-3xl font-bold text-slate-900">
                                {{ number_format($totalKunjungan) }}
                            </p>

                            <p class="mt-1 text-xs text-slate-400">
                                Seluruh data pelayanan
                            </p>

                        </div>

                        <div class="w-12 h-12 rounded-2xl bg-indigo-50
                                    text-indigo-600 flex items-center justify-center
                                    group-hover:bg-indigo-100 transition">

                            <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a3 3 0 006 0M9 13h6M9 17h4" />

                            </svg>

                        </div>

                    </div>

                </div>
            </div>


            {{-- Total Rujukan --}}
            <div class="group bg-white rounded-2xl border border-slate-200
                        shadow-sm hover:shadow-md transition-all duration-200">

                <div class="p-6">

                    <div class="flex items-start justify-between">

                        <div>

                            <p class="text-sm font-medium text-slate-500">
                                Total Rujukan
                            </p>

                            <p class="mt-3 text-3xl font-bold text-slate-900">
                                {{ number_format($totalRujukan) }}
                            </p>

                            <p class="mt-1 text-xs text-slate-400">
                                Seluruh data rujukan
                            </p>

                        </div>

                        <div class="w-12 h-12 rounded-2xl bg-amber-50
                                    text-amber-600 flex items-center justify-center
                                    group-hover:bg-amber-100 transition">

                            <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M12 21s8-4.5 8-10V5l-8-3-8 3v6c0 5.5 8 10 8 10zM9 12h6M12 9v6" />

                            </svg>

                        </div>

                    </div>

                </div>
            </div>

        </div>


        {{-- =====================================================
            PELAYANAN HARI INI
        ====================================================== --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

            <div class="px-6 py-5 border-b border-slate-100">

                <h2 class="text-base font-semibold text-slate-900">
                    Pelayanan Hari Ini
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Ringkasan aktivitas pelayanan hari ini
                </p>

            </div>

            <div class="grid grid-cols-2 lg:grid-cols-4 divide-x divide-y lg:divide-y-0 divide-slate-100">

                <div class="p-5 sm:p-6">

                    <p class="text-sm text-slate-500">
                        Kunjungan
                    </p>

                    <p class="mt-2 text-2xl font-bold text-slate-900">
                        {{ $kunjunganHariIni }}
                    </p>

                </div>


                <div class="p-5 sm:p-6">

                    <p class="text-sm text-slate-500">
                        Selesai
                    </p>

                    <p class="mt-2 text-2xl font-bold text-emerald-600">
                        {{ $selesaiHariIni }}
                    </p>

                </div>


                <div class="p-5 sm:p-6">

                    <p class="text-sm text-slate-500">
                        Diperiksa
                    </p>

                    <p class="mt-2 text-2xl font-bold text-indigo-600">
                        {{ $diperiksaHariIni }}
                    </p>

                </div>


                <div class="p-5 sm:p-6">

                    <p class="text-sm text-slate-500">
                        Menunggu
                    </p>

                    <p class="mt-2 text-2xl font-bold text-amber-600">
                        {{ $menungguHariIni }}
                    </p>

                </div>

            </div>

        </div>


        {{-- =====================================================
            GRAFIK KUNJUNGAN + STOK OBAT
        ====================================================== --}}
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

            {{-- Grafik Kunjungan --}}
            <div class="xl:col-span-2 bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

                <div class="px-6 py-5 border-b border-slate-100">

                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

                        <div>

                            <h2 class="text-base font-semibold text-slate-900">
                                Tren Kunjungan
                            </h2>

                            <p class="mt-1 text-sm text-slate-500">
                                Statistik kunjungan berdasarkan periode
                            </p>

                        </div>

                        <form method="GET" action="{{ route('dashboard') }}">

                            <input type="hidden"
                                name="periode_diagnosa"
                                value="{{ $periodeDiagnosa }}">

                            <select
                                name="periode_kunjungan"
                                onchange="this.form.submit()"
                                class="w-full sm:w-auto rounded-xl border-slate-300
                                       text-sm text-slate-600
                                       focus:border-indigo-500 focus:ring-indigo-500">

                                <option value="hari"
                                    {{ $periodeKunjungan === 'hari' ? 'selected' : '' }}>
                                    Hari Ini
                                </option>

                                <option value="minggu"
                                    {{ $periodeKunjungan === 'minggu' ? 'selected' : '' }}>
                                    Minggu Ini
                                </option>

                                <option value="bulan"
                                    {{ $periodeKunjungan === 'bulan' ? 'selected' : '' }}>
                                    Bulan Ini
                                </option>

                                <option value="tahun"
                                    {{ $periodeKunjungan === 'tahun' ? 'selected' : '' }}>
                                    Tahun Ini
                                </option>

                            </select>

                        </form>

                    </div>

                </div>

                <div class="p-6">

                    <div class="relative h-72">
                        <canvas id="grafikKunjungan"></canvas>
                    </div>

                </div>

            </div>


            {{-- Stok Obat --}}
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

                <div class="px-6 py-5 border-b border-slate-100">

                    <div class="flex items-start justify-between gap-3">

                        <div>

                            <h2 class="text-base font-semibold text-slate-900">
                                Stok Obat
                            </h2>

                            <p class="mt-1 text-sm text-slate-500">
                                Obat yang perlu diperhatikan
                            </p>

                        </div>

                        <a href="{{ route('obat.index') }}"
                            class="text-xs font-semibold text-indigo-600 hover:text-indigo-700 whitespace-nowrap">

                            Lihat semua

                        </a>

                    </div>

                </div>


                <div class="p-6">

                    @if ($obatHabis->isEmpty() && $obatStokMenipis->isEmpty())

                        <div class="py-10 text-center">

                            <div class="w-12 h-12 mx-auto rounded-2xl
                                        bg-emerald-50 text-emerald-600
                                        flex items-center justify-center">

                                <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">

                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.8"
                                        d="M5 13l4 4L19 7" />

                                </svg>

                            </div>

                            <p class="mt-3 text-sm font-semibold text-slate-700">
                                Stok obat aman
                            </p>

                            <p class="mt-1 text-xs text-slate-400">
                                Tidak ada obat yang perlu diperhatikan.
                            </p>

                        </div>

                    @else

                        <div class="space-y-5">

                            {{-- Obat Habis --}}
                            @foreach ($obatHabis as $obat)

                                <div>

                                    <div class="flex items-center justify-between gap-3">

                                        <div class="min-w-0">

                                            <p class="text-sm font-semibold text-slate-800 truncate">
                                                {{ $obat->nama }}
                                            </p>

                                            <p class="mt-1 text-xs text-slate-500">
                                                Stok {{ $obat->stok }}
                                                · Minimum {{ $obat->stok_minimum }}
                                            </p>

                                        </div>

                                        <span class="flex-shrink-0 text-xs font-semibold
                                                     text-red-600 bg-red-50
                                                     px-2.5 py-1 rounded-full">

                                            Habis

                                        </span>

                                    </div>

                                    <div class="mt-3 h-1.5 bg-slate-100 rounded-full overflow-hidden">

                                        <div class="h-full w-0 bg-red-500 rounded-full"></div>

                                    </div>

                                </div>

                            @endforeach


                            {{-- Obat Menipis --}}
                            @foreach ($obatStokMenipis as $obat)

                                @php
                                    $persentaseStok =
                                        $obat->stok_minimum > 0
                                            ? min(100, ($obat->stok / $obat->stok_minimum) * 100)
                                            : 0;
                                @endphp

                                <div>

                                    <div class="flex items-center justify-between gap-3">

                                        <div class="min-w-0">

                                            <p class="text-sm font-semibold text-slate-800 truncate">
                                                {{ $obat->nama }}
                                            </p>

                                            <p class="mt-1 text-xs text-slate-500">
                                                Stok {{ $obat->stok }}
                                                · Minimum {{ $obat->stok_minimum }}
                                            </p>

                                        </div>

                                        <span class="flex-shrink-0 text-xs font-semibold
                                                     text-amber-600 bg-amber-50
                                                     px-2.5 py-1 rounded-full">

                                            Menipis

                                        </span>

                                    </div>

                                    <div class="mt-3 h-1.5 bg-slate-100 rounded-full overflow-hidden">

                                        <div class="h-full bg-amber-400 rounded-full"
                                            style="width: {{ $persentaseStok }}%">
                                        </div>

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    @endif

                </div>

            </div>

        </div>


        {{-- =====================================================
            GRAFIK DIAGNOSA
        ====================================================== --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

            <div class="px-6 py-5 border-b border-slate-100">

                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

                    <div>

                        <h2 class="text-base font-semibold text-slate-900">
                            Diagnosa
                        </h2>

                        <p class="mt-1 text-sm text-slate-500">
                            Statistik diagnosa berdasarkan periode
                        </p>

                    </div>

                    <form method="GET" action="{{ route('dashboard') }}">

                        <input type="hidden"
                            name="periode_kunjungan"
                            value="{{ $periodeKunjungan }}">

                        <select
                            name="periode_diagnosa"
                            onchange="this.form.submit()"
                            class="w-full sm:w-auto rounded-xl border-slate-300
                                   text-sm text-slate-600
                                   focus:border-indigo-500 focus:ring-indigo-500">

                            <option value="hari"
                                {{ $periodeDiagnosa === 'hari' ? 'selected' : '' }}>
                                Hari Ini
                            </option>

                            <option value="minggu"
                                {{ $periodeDiagnosa === 'minggu' ? 'selected' : '' }}>
                                Minggu Ini
                            </option>

                            <option value="bulan"
                                {{ $periodeDiagnosa === 'bulan' ? 'selected' : '' }}>
                                Bulan Ini
                            </option>

                            <option value="top5"
                                {{ $periodeDiagnosa === 'top5' ? 'selected' : '' }}>
                                Top 5
                            </option>

                        </select>

                    </form>

                </div>

            </div>

            <div class="p-6">

                <div class="relative h-72">
                    <canvas id="grafikDiagnosa"></canvas>
                </div>

            </div>

        </div>


        {{-- =====================================================
            AKTIVITAS TERBARU
        ====================================================== --}}
        <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">

            {{-- Kunjungan Terbaru --}}
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

                <div class="px-6 py-5 border-b border-slate-100">

                    <div class="flex items-center justify-between gap-4">

                        <div>

                            <h2 class="text-base font-semibold text-slate-900">
                                Kunjungan Terbaru
                            </h2>

                            <p class="mt-1 text-sm text-slate-500">
                                Aktivitas pelayanan terakhir
                            </p>

                        </div>

                        <a href="{{ route('kunjungan.index') }}"
                            class="text-xs font-semibold text-indigo-600 hover:text-indigo-700 whitespace-nowrap">

                            Lihat semua

                        </a>

                    </div>

                </div>


                <div class="divide-y divide-slate-100">

                    @forelse ($kunjunganTerbaru as $kunjungan)

                        <a href="{{ route('kunjungan.show', $kunjungan) }}"
                            class="block px-6 py-4 hover:bg-slate-50 transition">

                            <div class="flex items-start justify-between gap-4">

                                <div class="min-w-0">

                                    <div class="flex items-center gap-2">

                                        <div class="w-8 h-8 rounded-lg bg-indigo-50
                                                    text-indigo-600 flex items-center justify-center
                                                    flex-shrink-0">

                                            <svg class="w-4 h-4" fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24">

                                                <path stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="1.8"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />

                                            </svg>

                                        </div>

                                        <div class="min-w-0">

                                            <p class="text-sm font-semibold text-slate-800 truncate">
                                                {{ $kunjungan->santri?->nama ?? '-' }}
                                            </p>

                                            <p class="text-xs text-slate-400">
                                                {{ $kunjungan->santri?->nomor_induk ?? '-' }}
                                            </p>

                                        </div>

                                    </div>

                                    <p class="text-sm text-slate-500 mt-3 truncate">
                                        {{ \Illuminate\Support\Str::limit($kunjungan->keluhan ?? '-', 55) }}
                                    </p>

                                </div>


                                <div class="text-right flex-shrink-0">

                                    <p class="text-xs text-slate-400">
                                        {{ $kunjungan->tanggal?->format('d-m-Y') }}
                                    </p>

                                    <span class="inline-flex mt-2 px-2.5 py-1 rounded-full
                                                 text-[11px] font-medium
                                        @if ($kunjungan->status === 'selesai')
                                            bg-emerald-50 text-emerald-700
                                        @elseif ($kunjungan->status === 'diperiksa')
                                            bg-indigo-50 text-indigo-700
                                        @elseif ($kunjungan->status === 'menunggu')
                                            bg-amber-50 text-amber-700
                                        @else
                                            bg-slate-100 text-slate-600
                                        @endif">

                                        {{ ucfirst($kunjungan->status) }}

                                    </span>

                                </div>

                            </div>

                        </a>

                    @empty

                        <div class="px-6 py-10 text-center">

                            <p class="text-sm text-slate-400">
                                Belum ada kunjungan.
                            </p>

                        </div>

                    @endforelse

                </div>

            </div>


            {{-- Rujukan Terbaru --}}
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

                <div class="px-6 py-5 border-b border-slate-100">

                    <div>

                        <h2 class="text-base font-semibold text-slate-900">
                            Rujukan Terbaru
                        </h2>

                        <p class="mt-1 text-sm text-slate-500">
                            Riwayat rujukan terbaru
                        </p>

                    </div>

                </div>


                <div class="divide-y divide-slate-100">

                    @forelse ($rujukanTerbaru as $rujukan)

                        <div class="px-6 py-4">

                            <div class="flex items-start justify-between gap-4">

                                <div class="min-w-0">

                                    <div class="flex items-center gap-2">

                                        <div class="w-8 h-8 rounded-lg bg-amber-50
                                                    text-amber-600 flex items-center justify-center
                                                    flex-shrink-0">

                                            <svg class="w-4 h-4" fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24">

                                                <path stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="1.8"
                                                    d="M12 21s8-4.5 8-10V5l-8-3-8 3v6c0 5.5 8 10 8 10z" />

                                            </svg>

                                        </div>

                                        <div class="min-w-0">

                                            <p class="text-sm font-semibold text-slate-800 truncate">
                                                {{ $rujukan->kunjungan?->santri?->nama ?? '-' }}
                                            </p>

                                            <p class="text-xs text-slate-400">
                                                {{ $rujukan->kunjungan?->santri?->nomor_induk ?? '-' }}
                                            </p>

                                        </div>

                                    </div>

                                    <p class="text-sm text-slate-500 mt-3 truncate">
                                        {{ $rujukan->masterRujukan?->nama_fasilitas ?? '-' }}
                                    </p>

                                    @if ($rujukan->alasan)

                                        <p class="text-xs text-slate-400 mt-1">
                                            {{ \Illuminate\Support\Str::limit($rujukan->alasan, 55) }}
                                        </p>

                                    @endif

                                </div>


                                <div class="text-right flex-shrink-0">

                                    <p class="text-xs text-slate-400">
                                        {{ $rujukan->tanggal_rujukan?->format('d-m-Y') ?? '-' }}
                                    </p>

                                    <span class="inline-flex mt-2 px-2.5 py-1 rounded-full
                                                 text-[11px] font-medium
                                        @if ($rujukan->status === 'selesai')
                                            bg-emerald-50 text-emerald-700
                                        @elseif ($rujukan->status === 'dirujuk')
                                            bg-indigo-50 text-indigo-700
                                        @elseif ($rujukan->status === 'direncanakan')
                                            bg-amber-50 text-amber-700
                                        @else
                                            bg-slate-100 text-slate-600
                                        @endif">

                                        {{ ucfirst($rujukan->status) }}

                                    </span>

                                </div>

                            </div>

                        </div>

                    @empty

                        <div class="px-6 py-10 text-center">

                            <p class="text-sm text-slate-400">
                                Belum ada data rujukan.
                            </p>

                        </div>

                    @endforelse

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
        CHART SCRIPT
    ========================================================== --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            /* =====================================================
               GRAFIK KUNJUNGAN
            ====================================================== */

            const canvasKunjungan =
                document.getElementById('grafikKunjungan');

            if (canvasKunjungan) {

                const grafikKunjunganData =
                    @json($grafikKunjungan);

                new Chart(canvasKunjungan.getContext('2d'), {

                    type: 'line',

                    data: {

                        labels: grafikKunjunganData.map(
                            item => item.label
                        ),

                        datasets: [{

                            data: grafikKunjunganData.map(
                                item => item.total
                            ),

                            borderColor: '#4f46e5',

                            backgroundColor: 'rgba(79, 70, 229, 0.08)',

                            borderWidth: 2,

                            tension: 0.35,

                            fill: true,

                            pointRadius: 3,

                            pointHoverRadius: 5

                        }]

                    },

                    options: {

                        responsive: true,

                        maintainAspectRatio: false,

                        interaction: {
                            intersect: false,
                            mode: 'index'
                        },

                        scales: {

                            x: {

                                grid: {
                                    display: false
                                },

                                ticks: {
                                    color: '#94a3b8'
                                }

                            },

                            y: {

                                beginAtZero: true,

                                ticks: {
                                    precision: 0,
                                    color: '#94a3b8'
                                },

                                grid: {
                                    color: '#f1f5f9'
                                }

                            }

                        },

                        plugins: {

                            legend: {
                                display: false
                            }

                        }

                    }

                });

            }


            /* =====================================================
               GRAFIK DIAGNOSA
            ====================================================== */

            const canvasDiagnosa =
                document.getElementById('grafikDiagnosa');

            if (canvasDiagnosa) {

                const grafikDiagnosaData =
                    @json($grafikDiagnosa);

                new Chart(canvasDiagnosa.getContext('2d'), {

                    type: 'bar',

                    plugins: [ChartDataLabels],

                    data: {

                        labels: grafikDiagnosaData.map(
                            item => item.label
                        ),

                        datasets: [{

                            data: grafikDiagnosaData.map(
                                item => item.total
                            ),

                            backgroundColor: '#6366f1',

                            borderRadius: 6,

                            borderWidth: 0

                        }]

                    },

                    options: {

                        responsive: true,

                        maintainAspectRatio: false,

                        scales: {

                            x: {

                                grid: {
                                    display: false
                                },

                                ticks: {
                                    color: '#94a3b8'
                                }

                            },

                            y: {

                                beginAtZero: true,

                                ticks: {
                                    precision: 0,
                                    color: '#94a3b8'
                                },

                                grid: {
                                    color: '#f1f5f9'
                                }

                            }

                        },

                        plugins: {

                            legend: {
                                display: false
                            },

                            datalabels: {

                                anchor: 'end',

                                align: 'top',

                                color: '#475569',

                                formatter: value => value,

                                font: {
                                    weight: '600'
                                }

                            }

                        }

                    }

                });

            }

        });
    </script>

</x-app-layout>