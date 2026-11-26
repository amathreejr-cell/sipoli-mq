<x-app-layout>

    {{-- =========================================================
        CHART.JS & PLUGINS
    ========================================================== --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>

    <div class="space-y-6">

        {{-- =====================================================
            HEADER HERO DASHBOARD
        ====================================================== --}}
        <div class="relative overflow-hidden rounded-3xl bg-slate-900 border border-slate-800 shadow-xl">
            {{-- Ambient Gradient Teal/Cyan --}}
            <div class="absolute -right-10 -top-10 h-64 w-64 rounded-full bg-teal-500/15 blur-3xl"></div>
            <div class="absolute right-1/3 -bottom-10 h-48 w-48 rounded-full bg-cyan-500/10 blur-2xl"></div>

            <div class="relative px-6 py-7 sm:px-8">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-5">

                    <div class="flex items-center gap-4">
                        {{-- Logo SIPOLI MQ Showcase --}}
                        <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-gradient-to-tr from-teal-500 to-cyan-400 p-0.5 shadow-md shadow-teal-500/20">
                            <div class="flex h-full w-full items-center justify-center rounded-[14px] bg-white p-2">
                                <img src="{{ asset('images/logo-sipoli-1.png') }}" alt="SIPOLI MQ" class="h-full w-auto object-contain">
                            </div>
                        </div>

                        <div>
                            <div class="flex items-center gap-2">
                                <h1 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight">
                                    Dashboard SIPOLI <span class="text-teal-400">MQ</span>
                                </h1>
                                <span class="rounded-full bg-teal-500/20 px-2.5 py-0.5 text-[10px] font-bold text-teal-300 ring-1 ring-inset ring-teal-400/30">
                                    v1.0
                                </span>
                            </div>
                            <p class="mt-1 text-sm text-slate-400">
                                Ringkasan pelayanan kesehatan & operasional Poliklinik Madrasatul Qur'an
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <span class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-white/10 border border-white/10 text-xs font-semibold text-slate-200 backdrop-blur-md">
                            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                            {{ now()->translatedFormat('l, d F Y') }}
                        </span>
                    </div>

                </div>
            </div>
        </div>


        {{-- =====================================================
            STATISTIK PELAYANAN BERDASARKAN GENDER
        ====================================================== --}}
        <section class="bg-white rounded-3xl border border-slate-200/80 shadow-sm p-6 sm:p-7 space-y-6">

            {{-- HEADER STATISTIK --}}
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div class="flex items-start gap-3.5">
                    <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-teal-50 text-teal-600 ring-1 ring-teal-600/10">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3v18h18M8 15l4-4 4 4 5-7" />
                        </svg>
                    </div>

                    <div>
                        <h3 class="text-lg font-bold text-slate-900 tracking-tight">
                            Statistik Pelayanan Berdasarkan Gender
                        </h3>
                        <p class="mt-0.5 text-xs sm:text-sm text-slate-500">
                            Distribusi kunjungan dan tindakan santri berdasarkan jenis kelamin
                        </p>
                    </div>
                </div>

                {{-- FILTER PERIODE --}}
                <form method="GET" action="{{ route('dashboard') }}" class="flex items-center gap-2.5">
                    @foreach (request()->except('periode_gender') as $key => $value)
                        @if (!is_array($value))
                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        @endif
                    @endforeach

                    <label for="periode_gender" class="text-xs font-semibold text-slate-500 whitespace-nowrap">
                        Periode:
                    </label>

                    <select id="periode_gender" name="periode_gender" onchange="this.form.submit()"
                        class="w-full sm:w-auto rounded-xl border border-slate-200 bg-slate-50 px-3.5 py-2 text-xs font-semibold text-slate-700 outline-none transition focus:border-teal-500 focus:bg-white focus:ring-4 focus:ring-teal-500/10">
                        <option value="hari" @selected($periodeGender === 'hari')>Hari Ini</option>
                        <option value="minggu" @selected($periodeGender === 'minggu')>Minggu Ini</option>
                        <option value="bulan" @selected($periodeGender === 'bulan')>Bulan Ini</option>
                        <option value="tahun" @selected($periodeGender === 'tahun')>Tahun Ini</option>
                    </select>
                </form>
            </div>

            <div class="border-t border-slate-100"></div>

            {{-- 4 KARTU RINGKASAN STATISTIK --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">

                {{-- Kunjungan --}}
                <div class="group rounded-2xl border border-slate-200/80 bg-slate-50/50 p-5 transition duration-200 hover:-translate-y-0.5 hover:border-teal-300 hover:bg-white hover:shadow-md">
                    <div class="flex items-center justify-between gap-3">
                        <p class="text-xs font-bold uppercase tracking-wider text-slate-500">Kunjungan</p>
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-teal-50 text-teal-600 transition group-hover:bg-teal-600 group-hover:text-white">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                            </svg>
                        </div>
                    </div>
                    <p class="mt-3 text-3xl font-extrabold tracking-tight text-slate-900">
                        {{ number_format($statistikGender['kunjungan']['global']) }}
                    </p>
                    <p class="text-[11px] text-slate-400">Total catatan kunjungan</p>

                    <div class="mt-4 space-y-2 border-t border-slate-200/60 pt-3">
                        <div class="flex items-center justify-between text-xs">
                            <div class="flex items-center gap-1.5">
                                <span class="h-2 w-2 rounded-full bg-cyan-500"></span>
                                <span class="text-slate-600 font-medium">Santri Putra</span>
                            </div>
                            <span class="font-bold text-slate-800">{{ number_format($statistikGender['kunjungan']['laki']) }}</span>
                        </div>
                        <div class="flex items-center justify-between text-xs">
                            <div class="flex items-center gap-1.5">
                                <span class="h-2 w-2 rounded-full bg-rose-400"></span>
                                <span class="text-slate-600 font-medium">Santri Putri</span>
                            </div>
                            <span class="font-bold text-slate-800">{{ number_format($statistikGender['kunjungan']['perempuan']) }}</span>
                        </div>
                    </div>
                </div>

                {{-- Diagnosa --}}
                <div class="group rounded-2xl border border-slate-200/80 bg-slate-50/50 p-5 transition duration-200 hover:-translate-y-0.5 hover:border-cyan-300 hover:bg-white hover:shadow-md">
                    <div class="flex items-center justify-between gap-3">
                        <p class="text-xs font-bold uppercase tracking-wider text-slate-500">Diagnosa</p>
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-cyan-50 text-cyan-600 transition group-hover:bg-cyan-600 group-hover:text-white">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a3 3 0 006 0M9 13h6M9 17h4" />
                            </svg>
                        </div>
                    </div>
                    <p class="mt-3 text-3xl font-extrabold tracking-tight text-slate-900">
                        {{ number_format($statistikGender['diagnosa']['global']) }}
                    </p>
                    <p class="text-[11px] text-slate-400">Total catatan diagnosa</p>

                    <div class="mt-4 space-y-2 border-t border-slate-200/60 pt-3">
                        <div class="flex items-center justify-between text-xs">
                            <div class="flex items-center gap-1.5">
                                <span class="h-2 w-2 rounded-full bg-cyan-500"></span>
                                <span class="text-slate-600 font-medium">Santri Putra</span>
                            </div>
                            <span class="font-bold text-slate-800">{{ number_format($statistikGender['diagnosa']['laki']) }}</span>
                        </div>
                        <div class="flex items-center justify-between text-xs">
                            <div class="flex items-center gap-1.5">
                                <span class="h-2 w-2 rounded-full bg-rose-400"></span>
                                <span class="text-slate-600 font-medium">Santri Putri</span>
                            </div>
                            <span class="font-bold text-slate-800">{{ number_format($statistikGender['diagnosa']['perempuan']) }}</span>
                        </div>
                    </div>
                </div>

                {{-- Obat --}}
                <div class="group rounded-2xl border border-slate-200/80 bg-slate-50/50 p-5 transition duration-200 hover:-translate-y-0.5 hover:border-amber-300 hover:bg-white hover:shadow-md">
                    <div class="flex items-center justify-between gap-3">
                        <p class="text-xs font-bold uppercase tracking-wider text-slate-500">Mendapat Obat</p>
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-amber-50 text-amber-600 transition group-hover:bg-amber-600 group-hover:text-white">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 14c0 1.1-.9 2-2 2H7c-1.1 0-2-.9-2-2V8c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2v6z"></path>
                                <path d="M12 11v6m-3-3h6"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="mt-3 text-3xl font-extrabold tracking-tight text-slate-900">
                        {{ number_format($statistikGender['obat']['global']) }}
                    </p>
                    <p class="text-[11px] text-slate-400">Total resep didistribusikan</p>

                    <div class="mt-4 space-y-2 border-t border-slate-200/60 pt-3">
                        <div class="flex items-center justify-between text-xs">
                            <div class="flex items-center gap-1.5">
                                <span class="h-2 w-2 rounded-full bg-cyan-500"></span>
                                <span class="text-slate-600 font-medium">Santri Putra</span>
                            </div>
                            <span class="font-bold text-slate-800">{{ number_format($statistikGender['obat']['laki']) }}</span>
                        </div>
                        <div class="flex items-center justify-between text-xs">
                            <div class="flex items-center gap-1.5">
                                <span class="h-2 w-2 rounded-full bg-rose-400"></span>
                                <span class="text-slate-600 font-medium">Santri Putri</span>
                            </div>
                            <span class="font-bold text-slate-800">{{ number_format($statistikGender['obat']['perempuan']) }}</span>
                        </div>
                    </div>
                </div>

                {{-- Rujukan --}}
                <div class="group rounded-2xl border border-slate-200/80 bg-slate-50/50 p-5 transition duration-200 hover:-translate-y-0.5 hover:border-emerald-300 hover:bg-white hover:shadow-md">
                    <div class="flex items-center justify-between gap-3">
                        <p class="text-xs font-bold uppercase tracking-wider text-slate-500">Rujukan Faskes</p>
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600 transition group-hover:bg-emerald-600 group-hover:text-white">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v8m-4-4h8"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="mt-3 text-3xl font-extrabold tracking-tight text-slate-900">
                        {{ number_format($statistikGender['rujukan']['global']) }}
                    </p>
                    <p class="text-[11px] text-slate-400">Total rujukan lanjutan</p>

                    <div class="mt-4 space-y-2 border-t border-slate-200/60 pt-3">
                        <div class="flex items-center justify-between text-xs">
                            <div class="flex items-center gap-1.5">
                                <span class="h-2 w-2 rounded-full bg-cyan-500"></span>
                                <span class="text-slate-600 font-medium">Santri Putra</span>
                            </div>
                            <span class="font-bold text-slate-800">{{ number_format($statistikGender['rujukan']['laki']) }}</span>
                        </div>
                        <div class="flex items-center justify-between text-xs">
                            <div class="flex items-center gap-1.5">
                                <span class="h-2 w-2 rounded-full bg-rose-400"></span>
                                <span class="text-slate-600 font-medium">Santri Putri</span>
                            </div>
                            <span class="font-bold text-slate-800">{{ number_format($statistikGender['rujukan']['perempuan']) }}</span>
                        </div>
                    </div>
                </div>

            </div>

            {{-- GRAFIK PERBANDINGAN GENDER --}}
            <div class="rounded-2xl border border-slate-200 bg-white overflow-hidden shadow-sm">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 border-b border-slate-100 bg-slate-50/60 px-5 py-4">
                    <div class="flex items-center gap-2.5">
                        <span class="h-2.5 w-2.5 rounded-full bg-teal-500"></span>
                        <h4 class="text-sm font-bold text-slate-800">
                            Grafik Perbandingan Pelayanan Santri
                        </h4>
                    </div>

                    <div class="flex items-center gap-4">
                        <div class="flex items-center gap-1.5">
                            <span class="h-2.5 w-2.5 rounded-full bg-cyan-500"></span>
                            <span class="text-xs font-semibold text-slate-600">Santri Putra</span>
                        </div>
                        <div class="flex items-center gap-1.5">
                            <span class="h-2.5 w-2.5 rounded-full bg-rose-400"></span>
                            <span class="text-xs font-semibold text-slate-600">Santri Putri</span>
                        </div>
                    </div>
                </div>

                <div class="p-4 md:p-6">
                    <div class="relative h-72 sm:h-80 w-full">
                        <canvas id="grafikGender"></canvas>
                    </div>
                </div>
            </div>

        </section>


        {{-- =====================================================
            STATUS PELAYANAN HARI INI
        ====================================================== --}}
        <div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between">
                <div>
                    <h2 class="text-base font-bold text-slate-900 tracking-tight">
                        Status Pelayanan Hari Ini
                    </h2>
                    <p class="text-xs text-slate-500">
                        Monitoring alur antrean dan penanganan santri hari ini
                    </p>
                </div>
                <span class="rounded-full bg-teal-50 px-3 py-1 text-xs font-bold text-teal-700">Realtime</span>
            </div>

            <div class="grid grid-cols-2 lg:grid-cols-4 divide-x divide-y lg:divide-y-0 divide-slate-100">
                <div class="p-5 sm:p-6">
                    <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Total Kunjungan</p>
                    <p class="mt-2 text-2xl sm:text-3xl font-extrabold text-slate-900">{{ $kunjunganHariIni }}</p>
                </div>

                <div class="p-5 sm:p-6">
                    <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Menunggu</p>
                    <p class="mt-2 text-2xl sm:text-3xl font-extrabold text-amber-500">{{ $menungguHariIni }}</p>
                </div>

                <div class="p-5 sm:p-6">
                    <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Sedang Diperiksa</p>
                    <p class="mt-2 text-2xl sm:text-3xl font-extrabold text-teal-600">{{ $diperiksaHariIni }}</p>
                </div>

                <div class="p-5 sm:p-6">
                    <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Selesai Ditangani</p>
                    <p class="mt-2 text-2xl sm:text-3xl font-extrabold text-emerald-600">{{ $selesaiHariIni }}</p>
                </div>
            </div>
        </div>


        {{-- =====================================================
            TREN KUNJUNGAN & STOK OBAT
        ====================================================== --}}
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

            {{-- Tren Kunjungan --}}
            <div class="xl:col-span-2 bg-white rounded-3xl border border-slate-200/80 shadow-sm overflow-hidden flex flex-col justify-between">
                <div class="px-6 py-5 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <h2 class="text-base font-bold text-slate-900 tracking-tight">Tren Kunjungan Poliklinik</h2>
                        <p class="mt-0.5 text-xs text-slate-500">Pergerakan data kunjungan santri pada periode terpilih</p>
                    </div>

                    <form method="GET" action="{{ route('dashboard') }}">
                        <input type="hidden" name="periode_diagnosa" value="{{ $periodeDiagnosa }}">
                        <select name="periode_kunjungan" onchange="this.form.submit()"
                            class="rounded-xl border border-slate-200 bg-slate-50 px-3 py-1.5 text-xs font-semibold text-slate-700 outline-none transition focus:border-teal-500 focus:bg-white focus:ring-2 focus:ring-teal-500/10">
                            <option value="hari" {{ $periodeKunjungan === 'hari' ? 'selected' : '' }}>Hari Ini</option>
                            <option value="minggu" {{ $periodeKunjungan === 'minggu' ? 'selected' : '' }}>Minggu Ini</option>
                            <option value="bulan" {{ $periodeKunjungan === 'bulan' ? 'selected' : '' }}>Bulan Ini</option>
                            <option value="tahun" {{ $periodeKunjungan === 'tahun' ? 'selected' : '' }}>Tahun Ini</option>
                        </select>
                    </form>
                </div>

                <div class="p-6">
                    <div class="relative h-72 w-full">
                        <canvas id="grafikKunjungan"></canvas>
                    </div>
                </div>
            </div>

            {{-- Pemantauan Stok Obat --}}
            <div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm overflow-hidden flex flex-col">
                <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between">
                    <div>
                        <h2 class="text-base font-bold text-slate-900 tracking-tight">Perhatian Stok Obat</h2>
                        <p class="mt-0.5 text-xs text-slate-500">Stok obat menipis atau habis</p>
                    </div>
                    <a href="{{ route('obat.index') }}" class="text-xs font-bold text-teal-600 hover:text-teal-700 hover:underline">
                        Lihat Semua
                    </a>
                </div>

                <div class="p-6 flex-1 flex flex-col justify-center">
                    @if ($obatHabis->isEmpty() && $obatStokMenipis->isEmpty())
                        <div class="py-8 text-center">
                            <div class="w-12 h-12 mx-auto rounded-2xl bg-teal-50 text-teal-600 flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <p class="mt-3 text-sm font-bold text-slate-800">Inventaris Obat Aman</p>
                            <p class="mt-1 text-xs text-slate-400">Seluruh stok obat berada di atas batas minimum.</p>
                        </div>
                    @else
                        <div class="space-y-4">
                            @foreach ($obatHabis as $obat)
                                <div class="rounded-2xl border border-rose-100 bg-rose-50/40 p-3.5">
                                    <div class="flex items-center justify-between gap-3">
                                        <div class="min-w-0">
                                            <p class="text-xs font-bold text-slate-800 truncate">{{ $obat->nama }}</p>
                                            <p class="text-[11px] text-slate-500">Stok 0 · Min. {{ $obat->stok_minimum }}</p>
                                        </div>
                                        <span class="rounded-full bg-rose-100 px-2.5 py-0.5 text-[10px] font-bold text-rose-700">Habis</span>
                                    </div>
                                    <div class="mt-2 h-1.5 bg-rose-200/50 rounded-full overflow-hidden">
                                        <div class="h-full w-0 bg-rose-500 rounded-full"></div>
                                    </div>
                                </div>
                            @endforeach

                            @foreach ($obatStokMenipis as $obat)
                                @php
                                    $persentaseStok = $obat->stok_minimum > 0 ? min(100, ($obat->stok / $obat->stok_minimum) * 100) : 0;
                                @endphp
                                <div class="rounded-2xl border border-amber-100 bg-amber-50/40 p-3.5">
                                    <div class="flex items-center justify-between gap-3">
                                        <div class="min-w-0">
                                            <p class="text-xs font-bold text-slate-800 truncate">{{ $obat->nama }}</p>
                                            <p class="text-[11px] text-slate-500">Tersisa {{ $obat->stok }} · Min. {{ $obat->stok_minimum }}</p>
                                        </div>
                                        <span class="rounded-full bg-amber-100 px-2.5 py-0.5 text-[10px] font-bold text-amber-700">Menipis</span>
                                    </div>
                                    <div class="mt-2 h-1.5 bg-amber-200/50 rounded-full overflow-hidden">
                                        <div class="h-full bg-amber-500 rounded-full" style="width: {{ $persentaseStok }}%"></div>
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
        <div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h2 class="text-base font-bold text-slate-900 tracking-tight">Statistik Diagnosa Terbanyak</h2>
                    <p class="mt-0.5 text-xs text-slate-500">Frekuensi keluhan & jenis diagnosa santri yang tercatat</p>
                </div>

                <form method="GET" action="{{ route('dashboard') }}">
                    <input type="hidden" name="periode_kunjungan" value="{{ $periodeKunjungan }}">
                    <select name="periode_diagnosa" onchange="this.form.submit()"
                        class="rounded-xl border border-slate-200 bg-slate-50 px-3 py-1.5 text-xs font-semibold text-slate-700 outline-none transition focus:border-teal-500 focus:bg-white focus:ring-2 focus:ring-teal-500/10">
                        <option value="hari" {{ $periodeDiagnosa === 'hari' ? 'selected' : '' }}>Hari Ini</option>
                        <option value="minggu" {{ $periodeDiagnosa === 'minggu' ? 'selected' : '' }}>Minggu Ini</option>
                        <option value="bulan" {{ $periodeDiagnosa === 'bulan' ? 'selected' : '' }}>Bulan Ini</option>
                        <option value="top5" {{ $periodeDiagnosa === 'top5' ? 'selected' : '' }}>Top 5</option>
                    </select>
                </form>
            </div>

            <div class="p-6">
                <div class="relative h-72 w-full">
                    <canvas id="grafikDiagnosa"></canvas>
                </div>
            </div>
        </div>


        {{-- =====================================================
            AKTIVITAS & RUJUKAN TERBARU
        ====================================================== --}}
        <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">

            {{-- Kunjungan Terbaru --}}
            <div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between">
                    <div>
                        <h2 class="text-base font-bold text-slate-900 tracking-tight">Kunjungan Terbaru</h2>
                        <p class="mt-0.5 text-xs text-slate-500">Aktivitas penanganan santri terakhir</p>
                    </div>
                    <a href="{{ route('kunjungan.index') }}" class="text-xs font-bold text-teal-600 hover:text-teal-700 hover:underline">
                        Lihat Semua
                    </a>
                </div>

                <div class="divide-y divide-slate-100">
                    @forelse ($kunjunganTerbaru as $kunjungan)
                        <a href="{{ route('kunjungan.show', $kunjungan) }}" class="block px-6 py-4 hover:bg-slate-50/70 transition">
                            <div class="flex items-start justify-between gap-4">
                                <div class="min-w-0">
                                    <div class="flex items-center gap-2.5">
                                        <div class="w-8 h-8 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center shrink-0">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </div>
                                        <div class="min-w-0">
                                            <p class="text-xs sm:text-sm font-bold text-slate-800 truncate">
                                                {{ $kunjungan->santri?->nama ?? '-' }}
                                            </p>
                                            <p class="text-[11px] text-slate-400">
                                                NIS: {{ $kunjungan->santri?->nomor_induk ?? '-' }}
                                            </p>
                                        </div>
                                    </div>
                                    <p class="text-xs text-slate-600 mt-2 truncate pl-10.5">
                                        Keluhan: {{ \Illuminate\Support\Str::limit($kunjungan->keluhan ?? '-', 55) }}
                                    </p>
                                </div>

                                <div class="text-right shrink-0">
                                    <p class="text-[11px] text-slate-400">
                                        {{ $kunjungan->tanggal?->format('d/m/Y') }}
                                    </p>
                                    <span class="inline-flex mt-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-bold
                                        @if ($kunjungan->status === 'selesai') bg-emerald-50 text-emerald-700
                                        @elseif ($kunjungan->status === 'diperiksa') bg-teal-50 text-teal-700
                                        @elseif ($kunjungan->status === 'menunggu') bg-amber-50 text-amber-700
                                        @else bg-slate-100 text-slate-600 @endif">
                                        {{ ucfirst($kunjungan->status) }}
                                    </span>
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="px-6 py-10 text-center text-xs text-slate-400">Belum ada kunjungan terbaru.</div>
                    @endforelse
                </div>
            </div>

            {{-- Rujukan Terbaru --}}
            <div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between">
                    <div>
                        <h2 class="text-base font-bold text-slate-900 tracking-tight">Rujukan Medis Terbaru</h2>
                        <p class="mt-0.5 text-xs text-slate-500">Riwayat rujukan faskes luar</p>
                    </div>
                </div>

                <div class="divide-y divide-slate-100">
                    @forelse ($rujukanTerbaru as $rujukan)
                        <div class="px-6 py-4">
                            <div class="flex items-start justify-between gap-4">
                                <div class="min-w-0">
                                    <div class="flex items-center gap-2.5">
                                        <div class="w-8 h-8 rounded-xl bg-cyan-50 text-cyan-600 flex items-center justify-center shrink-0">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 21s8-4.5 8-10V5l-8-3-8 3v6c0 5.5 8 10 8 10z" />
                                            </svg>
                                        </div>
                                        <div class="min-w-0">
                                            <p class="text-xs sm:text-sm font-bold text-slate-800 truncate">
                                                {{ $rujukan->kunjungan?->santri?->nama ?? '-' }}
                                            </p>
                                            <p class="text-[11px] text-slate-400">
                                                {{ $rujukan->masterRujukan?->nama_fasilitas ?? 'Fasilitas Kesehatan' }}
                                            </p>
                                        </div>
                                    </div>
                                    @if ($rujukan->alasan)
                                        <p class="text-xs text-slate-500 mt-2 truncate pl-10.5">
                                            Alasan: {{ \Illuminate\Support\Str::limit($rujukan->alasan, 55) }}
                                        </p>
                                    @endif
                                </div>

                                <div class="text-right shrink-0">
                                    <p class="text-[11px] text-slate-400">
                                        {{ $rujukan->tanggal_rujukan?->format('d/m/Y') ?? '-' }}
                                    </p>
                                    <span class="inline-flex mt-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-bold
                                        @if ($rujukan->status === 'selesai') bg-emerald-50 text-emerald-700
                                        @elseif ($rujukan->status === 'dirujuk') bg-teal-50 text-teal-700
                                        @elseif ($rujukan->status === 'direncanakan') bg-amber-50 text-amber-700
                                        @else bg-slate-100 text-slate-600 @endif">
                                        {{ ucfirst($rujukan->status) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="px-6 py-10 text-center text-xs text-slate-400">Belum ada catatan rujukan.</div>
                    @endforelse
                </div>
            </div>

        </div>

    </div>


    {{-- =========================================================
        CHART JAVASCRIPT (DISELARASKAN DENGAN PALET TEAL & CYAN)
    ========================================================== --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            /* 1. GRAFIK KUNJUNGAN (TEAL THEME) */
            const canvasKunjungan = document.getElementById('grafikKunjungan');
            if (canvasKunjungan) {
                const grafikKunjunganData = @json($grafikKunjungan);
                const ctxKunjungan = canvasKunjungan.getContext('2d');

                const gradientKunjungan = ctxKunjungan.createLinearGradient(0, 0, 0, 300);
                gradientKunjungan.addColorStop(0, 'rgba(13, 148, 136, 0.25)');
                gradientKunjungan.addColorStop(1, 'rgba(13, 148, 136, 0.0)');

                new Chart(ctxKunjungan, {
                    type: 'line',
                    data: {
                        labels: grafikKunjunganData.map(item => item.label),
                        datasets: [{
                            data: grafikKunjunganData.map(item => item.total),
                            borderColor: '#0d9488',
                            backgroundColor: gradientKunjungan,
                            borderWidth: 2.5,
                            tension: 0.35,
                            fill: true,
                            pointRadius: 4,
                            pointBackgroundColor: '#0d9488',
                            pointHoverRadius: 6
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        interaction: { intersect: false, mode: 'index' },
                        scales: {
                            x: { grid: { display: false }, ticks: { color: '#94a3b8', font: { size: 11 } } },
                            y: { beginAtZero: true, ticks: { precision: 0, color: '#94a3b8' }, grid: { color: '#f1f5f9' } }
                        },
                        plugins: { legend: { display: false } }
                    }
                });
            }

            /* 2. GRAFIK DIAGNOSA (CYAN THEME) */
            const canvasDiagnosa = document.getElementById('grafikDiagnosa');
            if (canvasDiagnosa) {
                const grafikDiagnosaData = @json($grafikDiagnosa);
                new Chart(canvasDiagnosa.getContext('2d'), {
                    type: 'bar',
                    plugins: [ChartDataLabels],
                    data: {
                        labels: grafikDiagnosaData.map(item => item.label),
                        datasets: [{
                            data: grafikDiagnosaData.map(item => item.total),
                            backgroundColor: '#0891b2',
                            borderRadius: 8,
                            borderWidth: 0
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            x: { grid: { display: false }, ticks: { color: '#94a3b8', font: { size: 11 } } },
                            y: { beginAtZero: true, ticks: { precision: 0, color: '#94a3b8' }, grid: { color: '#f1f5f9' } }
                        },
                        plugins: {
                            legend: { display: false },
                            datalabels: {
                                anchor: 'end',
                                align: 'top',
                                color: '#0f766e',
                                formatter: val => val,
                                font: { weight: 'bold', size: 11 }
                            }
                        }
                    }
                });
            }

            /* 3. GRAFIK GENDER (PUTRA: CYAN-500, PUTRI: ROSE-400) */
            const canvasGender = document.getElementById('grafikGender');
            if (canvasGender) {
                const statistikGender = @json($statistikGender);
                new Chart(canvasGender.getContext('2d'), {
                    type: 'bar',
                    data: {
                        labels: ['Kunjungan', 'Diagnosa', 'Pelayanan Obat', 'Rujukan'],
                        datasets: [
                            {
                                label: 'Santri Putra',
                                data: [
                                    statistikGender.kunjungan.laki,
                                    statistikGender.diagnosa.laki,
                                    statistikGender.obat.laki,
                                    statistikGender.rujukan.laki
                                ],
                                backgroundColor: '#06b6d4',
                                borderRadius: 6
                            },
                            {
                                label: 'Santri Putri',
                                data: [
                                    statistikGender.kunjungan.perempuan,
                                    statistikGender.diagnosa.perempuan,
                                    statistikGender.obat.perempuan,
                                    statistikGender.rujukan.perempuan
                                ],
                                backgroundColor: '#fb7185',
                                borderRadius: 6
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { position: 'top', labels: { boxWidth: 12, font: { weight: '600' } } },
                            tooltip: { mode: 'index', intersect: false }
                        },
                        scales: {
                            x: { grid: { display: false }, ticks: { color: '#94a3b8', font: { size: 11 } } },
                            y: { beginAtZero: true, ticks: { precision: 0, color: '#94a3b8' }, grid: { color: '#f1f5f9' } }
                        }
                    }
                });
            }

        });
    </script>
</x-app-layout>