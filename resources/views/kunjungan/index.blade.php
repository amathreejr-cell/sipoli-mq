<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="text-xl font-semibold text-slate-800">
                Data Kunjungan
            </h2>
            <p class="mt-1 text-sm text-slate-500">
                Kelola dan pantau seluruh pelayanan kunjungan santri.
            </p>
        </div>
    </x-slot>

    <div class="min-h-screen bg-slate-50 py-6">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            {{-- HEADER --}}
            <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                <div>
                    <div class="flex items-center gap-3">
                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-indigo-100 text-indigo-600">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-6 w-6"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="1.8">
                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a3 3 0 006 0M9 5a3 3 0 016 0M9 12h6M9 16h4" />
                            </svg>
                        </div>

                        <div>
                            <h1 class="text-2xl font-bold tracking-tight text-slate-800">
                                Kunjungan
                            </h1>
                            <p class="text-sm text-slate-500">
                                Riwayat pelayanan poliklinik santri
                            </p>
                        </div>
                    </div>
                </div>

                @if (in_array(auth()->user()->role, ['admin', 'petugas']))
                    <a href="{{ route('kunjungan.create') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700 hover:shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 4v16m8-8H4" />
                        </svg>
                        Kunjungan Baru
                    </a>
                @endif

            </div>


            {{-- SUCCESS --}}
            @if (session('success'))
                <div class="mb-5 flex items-start gap-3 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="mt-0.5 h-5 w-5 shrink-0"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M5 13l4 4L19 7" />
                    </svg>

                    <span>{{ session('success') }}</span>
                </div>
            @endif


            {{-- ERROR --}}
            @if (session('error'))
                <div class="mb-5 flex items-start gap-3 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="mt-0.5 h-5 w-5 shrink-0"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 9v4m0 4h.01M10.29 3.86l-8.18 14A2 2 0 003.83 21h16.34a2 2 0 001.72-3.14l-8.18-14a2 2 0 00-3.42 0z" />
                    </svg>

                    <span>{{ session('error') }}</span>
                </div>
            @endif


            {{-- FILTER --}}
            <div class="mb-6 rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div class="border-b border-slate-100 px-5 py-4 sm:px-6">
                    <div class="flex items-center gap-3">

                        <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-slate-100 text-slate-600">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="1.8">
                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M21 21l-4.35-4.35m2.35-5.65a8 8 0 11-16 0 8 8 0 0116 0z" />
                            </svg>
                        </div>

                        <div>
                            <h3 class="text-sm font-semibold text-slate-800">
                                Pencarian & Filter
                            </h3>
                            <p class="text-xs text-slate-500">
                                Cari berdasarkan santri, nomor induk, atau kode kunjungan.
                            </p>
                        </div>

                    </div>
                </div>

                <form method="GET" action="{{ route('kunjungan.index') }}" class="p-5 sm:p-6">

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-3">

                        {{-- SEARCH --}}
                        <div class="md:col-span-2">
                            <label for="search"
                                class="mb-1.5 block text-sm font-medium text-slate-700">
                                Cari Kunjungan
                            </label>

                            <div class="relative">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="1.8">
                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M21 21l-4.35-4.35m2.35-5.65a8 8 0 11-16 0 8 8 0 0116 0z" />
                                    </svg>
                                </div>

                                <input
                                    type="text"
                                    name="search"
                                    id="search"
                                    value="{{ request('search') }}"
                                    placeholder="Nama santri, nomor induk, kode kunjungan..."
                                    class="block w-full rounded-xl border-slate-200 py-2.5 pl-10 pr-4 text-sm text-slate-700 shadow-sm outline-none transition focus:border-indigo-500 focus:ring-indigo-500"
                                >
                            </div>
                        </div>


                        {{-- STATUS --}}
                        <div>
                            <label for="status"
                                class="mb-1.5 block text-sm font-medium text-slate-700">
                                Status
                            </label>

                            <select
                                name="status"
                                id="status"
                                class="block w-full rounded-xl border-slate-200 py-2.5 text-sm text-slate-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            >
                                <option value="">Semua Status</option>

                                <option value="menunggu"
                                    {{ request('status') === 'menunggu' ? 'selected' : '' }}>
                                    Menunggu
                                </option>

                                <option value="diperiksa"
                                    {{ request('status') === 'diperiksa' ? 'selected' : '' }}>
                                    Diperiksa
                                </option>

                                <option value="selesai"
                                    {{ request('status') === 'selesai' ? 'selected' : '' }}>
                                    Selesai
                                </option>

                                <option value="dibatalkan"
                                    {{ request('status') === 'dibatalkan' ? 'selected' : '' }}>
                                    Dibatalkan
                                </option>
                            </select>
                        </div>

                    </div>


                    {{-- BUTTON --}}
                    <div class="mt-4 flex flex-wrap items-center gap-2">

                        <button
                            type="submit"
                            class="inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-indigo-700"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-4 w-4"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2">
                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M21 21l-4.35-4.35m2.35-5.65a8 8 0 11-16 0 8 8 0 0116 0z" />
                            </svg>
                            Cari
                        </button>

                        @if (request('search') || request('status'))
                            <a
                                href="{{ route('kunjungan.index') }}"
                                class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-medium text-slate-600 transition hover:bg-slate-50"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="2">
                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Reset
                            </a>
                        @endif

                    </div>

                </form>
            </div>


            {{-- DATA KUNJUNGAN --}}
            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                {{-- CARD HEADER --}}
                <div class="flex flex-col gap-3 border-b border-slate-100 px-5 py-5 sm:flex-row sm:items-center sm:justify-between sm:px-6">

                    <div>
                        <h3 class="text-base font-semibold text-slate-800">
                            Daftar Kunjungan
                        </h3>

                        <p class="mt-1 text-sm text-slate-500">
                            @if ($kunjungans->total())
                                Menampilkan
                                <span class="font-medium text-slate-700">
                                    {{ $kunjungans->firstItem() }}–{{ $kunjungans->lastItem() }}
                                </span>
                                dari
                                <span class="font-medium text-slate-700">
                                    {{ $kunjungans->total() }}
                                </span>
                                kunjungan.
                            @else
                                Belum terdapat data kunjungan.
                            @endif
                        </p>
                    </div>

                    @if ($kunjungans->total())
                        <div class="flex items-center gap-2 rounded-lg bg-slate-50 px-3 py-2 text-xs text-slate-500">
                            <span class="h-2 w-2 rounded-full bg-indigo-500"></span>
                            Data pelayanan
                        </div>
                    @endif

                </div>


                {{-- LIST --}}
                @if ($kunjungans->count())

                    <div class="divide-y divide-slate-100">

                        @foreach ($kunjungans as $kunjungan)

                            <div class="px-5 py-5 transition hover:bg-slate-50/70 sm:px-6">

                                <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

                                    {{-- LEFT --}}
                                    <div class="min-w-0 flex-1">

                                        <div class="flex flex-wrap items-center gap-2">

                                            {{-- CODE --}}
                                            <span class="rounded-lg bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-600">
                                                {{ $kunjungan->kode_kunjungan }}
                                            </span>


                                            {{-- STATUS --}}
                                            @if ($kunjungan->status === 'menunggu')

                                                <span class="inline-flex items-center gap-1.5 rounded-full bg-amber-50 px-2.5 py-1 text-xs font-semibold text-amber-700">
                                                    <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                                                    Menunggu
                                                </span>

                                            @elseif ($kunjungan->status === 'diperiksa')

                                                <span class="inline-flex items-center gap-1.5 rounded-full bg-blue-50 px-2.5 py-1 text-xs font-semibold text-blue-700">
                                                    <span class="h-1.5 w-1.5 rounded-full bg-blue-500"></span>
                                                    Diperiksa
                                                </span>

                                            @elseif ($kunjungan->status === 'selesai')

                                                <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700">
                                                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                                    Selesai
                                                </span>

                                            @else

                                                <span class="inline-flex items-center gap-1.5 rounded-full bg-red-50 px-2.5 py-1 text-xs font-semibold text-red-700">
                                                    <span class="h-1.5 w-1.5 rounded-full bg-red-500"></span>
                                                    Dibatalkan
                                                </span>

                                            @endif

                                        </div>


                                        {{-- SANTRI --}}
                                        <div class="mt-3">
                                            <h4 class="truncate text-base font-semibold text-slate-800">
                                                {{ $kunjungan->santri?->nama ?? '-' }}
                                            </h4>

                                            <p class="mt-0.5 text-sm text-slate-500">
                                                No. Induk:
                                                <span class="font-medium text-slate-600">
                                                    {{ $kunjungan->santri?->nomor_induk ?? '-' }}
                                                </span>
                                            </p>
                                        </div>


                                        {{-- META --}}
                                        <div class="mt-3 flex flex-wrap gap-x-5 gap-y-2 text-xs text-slate-500">

                                            <div class="flex items-center gap-1.5">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="h-4 w-4 text-slate-400"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke="currentColor"
                                                    stroke-width="1.8">
                                                    <path stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>

                                                {{ $kunjungan->tanggal?->format('d M Y') ?? '-' }}
                                            </div>


                                            <div class="flex items-center gap-1.5">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="h-4 w-4 text-slate-400"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke="currentColor"
                                                    stroke-width="1.8">
                                                    <path stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M12 8v4l3 2m6-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>

                                                {{ $kunjungan->waktu ?? '-' }}
                                            </div>


                                            <div class="flex items-center gap-1.5">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="h-4 w-4 text-slate-400"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke="currentColor"
                                                    stroke-width="1.8">
                                                    <path stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM5 21a7 7 0 0114 0" />
                                                </svg>

                                                {{ $kunjungan->petugas?->name ?? '-' }}
                                            </div>

                                        </div>


                                        {{-- KELUHAN --}}
                                        @if ($kunjungan->keluhan)

                                            <div class="mt-3 flex items-start gap-2 rounded-xl bg-slate-50 px-3 py-2.5">

                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="mt-0.5 h-4 w-4 shrink-0 text-slate-400"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke="currentColor"
                                                    stroke-width="1.8">
                                                    <path stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M8 10h8M8 14h5M5 4h14a2 2 0 012 2v9a2 2 0 01-2 2h-4l-3 3-3-3H5a2 2 0 01-2-2V6a2 2 0 012-2z" />
                                                </svg>

                                                <p class="text-sm leading-5 text-slate-600">
                                                    {{ \Illuminate\Support\Str::limit($kunjungan->keluhan, 80) }}
                                                </p>

                                            </div>

                                        @endif

                                    </div>


                                    {{-- ACTION --}}
                                    <div class="flex shrink-0 items-center gap-2 lg:ml-6">

                                        <a
                                            href="{{ route('kunjungan.show', $kunjungan) }}"
                                            class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-indigo-600 shadow-sm transition hover:border-indigo-200 hover:bg-indigo-50"
                                        >
                                            Detail

                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="h-4 w-4"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor"
                                                stroke-width="2">
                                                <path stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M9 5l7 7-7 7" />
                                            </svg>
                                        </a>

                                    </div>

                                </div>

                            </div>

                        @endforeach

                    </div>


                    {{-- PAGINATION --}}
                    <div class="border-t border-slate-100 px-5 py-4 sm:px-6">
                        {{ $kunjungans->links() }}
                    </div>

                @else

                    {{-- EMPTY STATE --}}
                    <div class="px-6 py-16 text-center">

                        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-slate-100 text-slate-400">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-8 w-8"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="1.5">
                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a3 3 0 006 0M9 5a3 3 0 016 0M9 12h6M9 16h4" />
                            </svg>

                        </div>

                        <h3 class="mt-4 text-sm font-semibold text-slate-800">
                            Belum ada data kunjungan
                        </h3>

                        <p class="mx-auto mt-1 max-w-sm text-sm text-slate-500">
                            Belum ditemukan data kunjungan yang sesuai dengan pencarian atau filter.
                        </p>

                        @if (request('search') || request('status'))

                            <a
                                href="{{ route('kunjungan.index') }}"
                                class="mt-4 inline-flex items-center rounded-xl bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-indigo-700"
                            >
                                Reset Pencarian
                            </a>

                        @endif

                    </div>

                @endif

            </div>

        </div>
    </div>

</x-app-layout>