<x-app-layout>

    <div class="space-y-6">

        {{-- =====================================================
            HEADER HALAMAN KUNJUNGAN
        ====================================================== --}}
        <div
            class="relative overflow-hidden rounded-3xl border border-slate-200/80 bg-white p-6 shadow-sm sm:px-8 sm:py-7">
            {{-- Aksen Latar Lembut --}}
            <div class="pointer-events-none absolute -right-10 -top-10 h-44 w-44 rounded-full bg-teal-500/10 blur-3xl">
            </div>
            <div
                class="pointer-events-none absolute -bottom-10 right-1/4 h-36 w-36 rounded-full bg-cyan-500/10 blur-2xl">
            </div>

            <div class="relative flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">
                <div class="flex items-center gap-4">
                    {{-- Badge Icon Medis --}}
                    <div
                        class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-gradient-to-tr from-teal-500 to-cyan-500 p-0.5 shadow-md shadow-teal-500/20">
                        <div
                            class="flex h-full w-full items-center justify-center rounded-[14px] bg-white text-teal-600">
                            <svg class="h-7 w-7" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 7v3m-1.5-1.5h3" />
                            </svg>
                        </div>
                    </div>

                    <div>
                        <div class="flex items-center gap-2">
                            <span
                                class="rounded-md bg-teal-50 px-2 py-0.5 text-[10px] font-bold uppercase tracking-wider text-teal-700 ring-1 ring-inset ring-teal-600/20">
                                Pelayanan Klinis
                            </span>
                        </div>
                        <h1 class="mt-1 text-2xl font-extrabold tracking-tight text-slate-900 sm:text-3xl">
                            Pendaftaran Kunjungan
                        </h1>
                        <p class="mt-0.5 text-xs text-slate-500 sm:text-sm">
                            Kelola antrean dan rekam jejak pemeriksaan santri di Poliklinik MQ
                        </p>
                    </div>
                </div>

                {{-- Action Button --}}
                @if (in_array(auth()->user()->role, ['admin', 'petugas']))
                    <a href="{{ route('kunjungan.create') }}"
                        class="inline-flex w-fit items-center gap-2.5 rounded-xl bg-gradient-to-r from-teal-600 to-cyan-600 px-5 py-3 text-xs sm:text-sm font-bold text-white shadow-md shadow-teal-600/20 transition-all hover:from-teal-700 hover:to-cyan-700 hover:shadow-lg focus:outline-none focus:ring-4 focus:ring-teal-500/20 active:scale-[0.99]">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.5"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                        </svg>
                        <span>Pendaftaran Baru</span>
                    </a>
                @endif
            </div>
        </div>

        
        {{-- =====================================================
            PENCARIAN & FILTER
        ====================================================== --}}
        <div class="rounded-3xl border border-slate-200/80 bg-white p-5 shadow-sm sm:p-6">
            <div class="flex items-center gap-2.5 pb-4 border-b border-slate-100 text-slate-800">
                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-teal-50 text-teal-600">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 21l-4.35-4.35m2.35-5.65a8 8 0 11-16 0 8 8 0 0116 0z" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-sm font-bold text-slate-800">Filter Pencarian</h2>
                    <p class="text-[11px] text-slate-400">Saring riwayat kunjungan santri</p>
                </div>
            </div>

            <form method="GET" action="{{ route('kunjungan.index') }}" class="mt-4">
                <div class="grid grid-cols-1 gap-4 md:grid-cols-12 items-end">

                    {{-- Input Keyword --}}
                    <div class="md:col-span-7">
                        <label for="search"
                            class="mb-1.5 block text-xs font-bold text-slate-700 uppercase tracking-wider">
                            Kata Kunci
                        </label>
                        <div class="relative">
                            <div
                                class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 21l-4.35-4.35m2.35-5.65a8 8 0 11-16 0 8 8 0 0116 0z" />
                                </svg>
                            </div>
                            <input type="text" name="search" id="search" value="{{ request('search') }}"
                                placeholder="Cari santri, INDUK, atau kode kunjungan..."
                                class="w-full rounded-xl border border-slate-200 bg-slate-50/60 py-2.5 pl-10 pr-4 text-xs sm:text-sm text-slate-800 outline-none transition focus:border-teal-500 focus:bg-white focus:ring-4 focus:ring-teal-500/10">
                        </div>
                    </div>

                    {{-- Select Status --}}
                    <div class="md:col-span-3">
                        <label for="status"
                            class="mb-1.5 block text-xs font-bold text-slate-700 uppercase tracking-wider">
                            Status Pelayanan
                        </label>
                        <select name="status" id="status"
                            class="w-full rounded-xl border border-slate-200 bg-slate-50/60 py-2.5 px-3.5 text-xs sm:text-sm font-medium text-slate-700 outline-none transition focus:border-teal-500 focus:bg-white focus:ring-4 focus:ring-teal-500/10">
                            <option value="">Semua Status</option>
                            <option value="menunggu" {{ request('status') === 'menunggu' ? 'selected' : '' }}>Menunggu
                            </option>
                            <option value="diperiksa" {{ request('status') === 'diperiksa' ? 'selected' : '' }}>
                                Diperiksa</option>
                            <option value="selesai" {{ request('status') === 'selesai' ? 'selected' : '' }}>Selesai
                            </option>
                            <option value="dibatalkan" {{ request('status') === 'dibatalkan' ? 'selected' : '' }}>
                                Dibatalkan</option>
                        </select>
                    </div>

                    {{-- Submit & Reset Buttons --}}
                    <div class="md:col-span-2 flex items-center gap-2">
                        <button type="submit"
                            class="flex-1 inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-teal-600 to-cyan-600 py-2.5 px-4 text-xs font-bold text-white shadow-sm transition hover:bg-slate-800">
                            Cari
                        </button>

                        @if (request('search') || request('status'))
                            <a href="{{ route('kunjungan.index') }}" title="Reset Pencarian"
                                class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white p-2.5 text-slate-500 transition hover:bg-slate-50 hover:text-rose-600">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.5"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </a>
                        @endif
                    </div>

                </div>
            </form>
        </div>

        {{-- =====================================================
            TABEL / DAFTAR KUNJUNGAN
        ====================================================== --}}
        <div class="overflow-hidden rounded-3xl border border-slate-200/80 bg-white shadow-sm">

            {{-- Header Card --}}
            <div
                class="px-5 py-4 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
                <div>
                    <h2 class="text-base font-bold text-slate-800">Riwayat Antrean & Kunjungan</h2>
                    <p class="text-xs text-slate-400">
                        @if ($kunjungans->total())
                            Menampilkan data ke-{{ $kunjungans->firstItem() }} sampai {{ $kunjungans->lastItem() }}
                            dari total {{ $kunjungans->total() }} kunjungan.
                        @else
                            Tidak ada kunjungan yang tercatat.
                        @endif
                    </p>
                </div>

                @if ($kunjungans->total())
                    <span
                        class="inline-flex items-center gap-1.5 rounded-full bg-teal-50 px-3 py-1 text-xs font-semibold text-teal-700 ring-1 ring-inset ring-teal-600/20">
                        <span class="h-1.5 w-1.5 rounded-full bg-teal-500 animate-pulse"></span>
                        Data Terkini
                    </span>
                @endif
            </div>

            {{-- List Content --}}
            @if ($kunjungans->count())
                <div class="divide-y divide-slate-100">
                    @foreach ($kunjungans as $kunjungan)
                        <div class="px-6 py-5 transition hover:bg-slate-50/70">
                            <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

                                {{-- Detail Informasi --}}
                                <div class="min-w-0 flex-1">
                                    <div class="flex flex-wrap items-center gap-2">
                                        {{-- Kode Kunjungan --}}
                                        <span
                                            class="rounded-lg bg-slate-100 px-2.5 py-1 text-xs font-mono font-bold text-slate-700">
                                            {{ $kunjungan->kode_kunjungan }}
                                        </span>

                                        {{-- Status Pill --}}
                                        @if ($kunjungan->status === 'menunggu')
                                            <span
                                                class="inline-flex items-center gap-1.5 rounded-full bg-amber-50 px-2.5 py-0.5 text-[11px] font-bold text-amber-700 ring-1 ring-inset ring-amber-600/20">
                                                <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                                                Menunggu
                                            </span>
                                        @elseif ($kunjungan->status === 'diperiksa')
                                            <span
                                                class="inline-flex items-center gap-1.5 rounded-full bg-cyan-50 px-2.5 py-0.5 text-[11px] font-bold text-cyan-700 ring-1 ring-inset ring-cyan-600/20">
                                                <span
                                                    class="h-1.5 w-1.5 rounded-full bg-cyan-500 animate-pulse"></span>
                                                Diperiksa
                                            </span>
                                        @elseif ($kunjungan->status === 'selesai')
                                            <span
                                                class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-2.5 py-0.5 text-[11px] font-bold text-emerald-700 ring-1 ring-inset ring-emerald-600/20">
                                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                                Selesai
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center gap-1.5 rounded-full bg-rose-50 px-2.5 py-0.5 text-[11px] font-bold text-rose-700 ring-1 ring-inset ring-rose-600/20">
                                                <span class="h-1.5 w-1.5 rounded-full bg-rose-500"></span>
                                                Dibatalkan
                                            </span>
                                        @endif
                                    </div>

                                    {{-- Identitas Santri --}}
                                    <div class="mt-2.5">
                                        <h3 class="truncate text-base font-extrabold text-slate-800">
                                            {{ $kunjungan->santri?->nama ?? '-' }}
                                        </h3>
                                        <p class="text-xs text-slate-500 font-medium">
                                            NIS: <span
                                                class="font-mono text-slate-700 font-bold">{{ $kunjungan->santri?->nomor_induk ?? '-' }}</span>
                                        </p>
                                    </div>

                                    {{-- Metadata --}}
                                    <div class="mt-3 flex flex-wrap gap-x-5 gap-y-1.5 text-xs text-slate-500">
                                        <div class="flex items-center gap-1.5">
                                            <svg class="h-4 w-4 text-teal-600" fill="none" stroke="currentColor"
                                                stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            <span>{{ $kunjungan->tanggal?->format('d M Y') ?? '-' }}</span>
                                        </div>

                                        <div class="flex items-center gap-1.5">
                                            <svg class="h-4 w-4 text-cyan-600" fill="none" stroke="currentColor"
                                                stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 8v4l3 2m6-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span>{{ $kunjungan->waktu ?? '-' }} WIB</span>
                                        </div>

                                        <div class="flex items-center gap-1.5">
                                            <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor"
                                                stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM5 21a7 7 0 0114 0" />
                                            </svg>
                                            <span>Petugas: <strong
                                                    class="text-slate-700 font-semibold">{{ $kunjungan->petugas?->name ?? '-' }}</strong></span>
                                        </div>
                                    </div>

                                    {{-- Keluhan Utama --}}
                                    @if ($kunjungan->keluhan)
                                        <div
                                            class="mt-3 rounded-2xl bg-slate-50/80 p-3 border border-slate-100 flex items-start gap-2.5">
                                            <svg class="h-4 w-4 text-teal-600 mt-0.5 shrink-0" fill="none"
                                                stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M8 10h8M8 14h5M5 4h14a2 2 0 012 2v9a2 2 0 01-2 2h-4l-3 3-3-3H5a2 2 0 01-2-2V6a2 2 0 012-2z" />
                                            </svg>
                                            <p class="text-xs leading-relaxed text-slate-600">
                                                <span class="font-bold text-slate-700">Keluhan:</span>
                                                {{ \Illuminate\Support\Str::limit($kunjungan->keluhan, 90) }}
                                            </p>
                                        </div>
                                    @endif
                                </div>

                                {{-- Action Buttons --}}
                                <div class="flex shrink-0 items-center gap-2 lg:ml-6">
                                    <a href="{{ route('kunjungan.show', $kunjungan) }}"
                                        class="inline-flex items-center gap-1.5 rounded-xl border border-teal-200 bg-teal-50/50 px-4 py-2.5 text-xs font-bold text-teal-700 transition hover:bg-teal-600 hover:text-white hover:border-teal-600">
                                        <span>Detail</span>
                                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor"
                                            stroke-width="2.5" viewBox="0 0 24 24">
                                            <polyline points="9 18 15 12 9 6"></polyline>
                                        </svg>
                                    </a>

                                    @if (auth()->user()->role === 'admin')
                                        <form action="{{ route('kunjungan.hapus-permanen', $kunjungan) }}"
                                            method="POST"
                                            onsubmit="return confirm('PERINGATAN: Hapus permanen kunjungan {{ $kunjungan->kode_kunjungan }}? Data rekam medis terkait juga akan dihapus. Tindakan ini tidak dapat dibatalkan.');"
                                            class="m-0">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center justify-center rounded-xl border border-rose-200 bg-white px-3 py-2.5 text-xs font-bold text-rose-600 transition hover:bg-rose-50 hover:border-rose-300">
                                                Hapus
                                            </button>
                                        </form>
                                    @endif
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Pagination Links --}}
                <div class="border-t border-slate-100 bg-slate-50/50 px-6 py-4">
                    {{ $kunjungans->links() }}
                </div>
            @else
                {{-- Empty State --}}
                <div class="px-6 py-16 text-center">
                    <div
                        class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-teal-50 text-teal-600">
                        <svg class="h-8 w-8" fill="none" stroke="currentColor" stroke-width="1.8"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>

                    <h3 class="mt-4 text-base font-bold text-slate-800">
                        Tidak Ada Data Kunjungan
                    </h3>
                    <p class="mx-auto mt-1 max-w-sm text-xs sm:text-sm text-slate-500">
                        Data yang Anda cari tidak ditemukan atau belum ada kunjungan baru yang terdaftar.
                    </p>

                    @if (request('search') || request('status'))
                        <div class="mt-5">
                            <a href="{{ route('kunjungan.index') }}"
                                class="inline-flex items-center gap-2 rounded-xl bg-slate-900 px-4 py-2.5 text-xs font-bold text-white transition hover:bg-slate-800">
                                Reset Pencarian
                            </a>
                        </div>
                    @endif
                </div>
            @endif

        </div>

    </div>

</x-app-layout>
