<x-app-layout>

    <x-slot name="header">
        <div>
            <p class="text-sm text-gray-500">Master Data</p>
            <h2 class="text-2xl font-bold text-gray-800">
                Detail Diagnosa
            </h2>
        </div>
    </x-slot>


    <div class="py-6">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- ========================= --}}
            {{-- ALERT --}}
            {{-- ========================= --}}

            @if (session('success'))
                <div class="mb-5 flex items-center gap-3 rounded-xl border border-green-200 bg-green-50 px-5 py-4 text-sm text-green-700">

                    <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M9 12l2 2 4-4m5.5 0A8.5 8.5 0 1112 3.5 8.5 8.5 0 0120.5 12z"
                        />
                    </svg>

                    <span>{{ session('success') }}</span>

                </div>
            @endif


            @if (session('error'))
                <div class="mb-5 flex items-center gap-3 rounded-xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-700">

                    <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 8v4m0 4h.01M10.3 3.9l-8 14A2 2 0 004 21h16a2 2 0 001.7-3.1l-8-14a2 2 0 00-3.4 0z"
                        />
                    </svg>

                    <span>{{ session('error') }}</span>

                </div>
            @endif


            {{-- ========================= --}}
            {{-- HEADER DIAGNOSA --}}
            {{-- ========================= --}}

            <div class="mb-6 overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-100">

                <div class="flex flex-col gap-5 px-6 py-6 sm:flex-row sm:items-center sm:justify-between">

                    <div class="flex items-start gap-4">

                        <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-purple-50 text-purple-600">

                            <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M9 3h6m-7 4h8m-9 4h10m-9 4h8m-7 4h6"
                                />
                            </svg>

                        </div>

                        <div>

                            <div class="flex flex-wrap items-center gap-3">

                                <h3 class="text-xl font-bold text-gray-800">
                                    {{ $diagnosa->nama }}
                                </h3>

                                @if ($diagnosa->is_active)

                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-green-50 px-3 py-1.5 text-xs font-semibold text-green-700">
                                        <span class="h-1.5 w-1.5 rounded-full bg-green-500"></span>
                                        Aktif
                                    </span>

                                @else

                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-gray-100 px-3 py-1.5 text-xs font-semibold text-gray-500">
                                        <span class="h-1.5 w-1.5 rounded-full bg-gray-400"></span>
                                        Nonaktif
                                    </span>

                                @endif

                            </div>

                            <div class="mt-2">

                                <span class="inline-flex rounded-lg bg-purple-50 px-3 py-1.5 text-xs font-bold text-purple-700">
                                    {{ $diagnosa->kode }}
                                </span>

                            </div>

                        </div>

                    </div>


                    {{-- AKSI HEADER --}}

                    <div class="flex flex-wrap items-center gap-2">

                        <a
                            href="{{ route('diagnosa.index') }}"
                            class="inline-flex items-center gap-2 rounded-lg border border-gray-200 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 transition hover:bg-gray-50"
                        >
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M15 19l-7-7 7-7"
                                />
                            </svg>

                            Kembali
                        </a>


                        @if (in_array(auth()->user()->role, ['admin', 'petugas']))

                            <a
                                href="{{ route('diagnosa.edit', $diagnosa) }}"
                                class="inline-flex items-center gap-2 rounded-lg bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-indigo-700"
                            >

                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.5-9.5a2.12 2.12 0 013 3L12 14l-4 1 1-4 8.5-8.5z"
                                    />
                                </svg>

                                Edit

                            </a>

                        @endif


                        @if (auth()->user()->role === 'admin' && $diagnosa->is_active)

                            <form
                                method="POST"
                                action="{{ route('diagnosa.destroy', $diagnosa) }}"
                                onsubmit="return confirm('Apakah Anda yakin ingin menonaktifkan diagnosa ini?')"
                            >

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="inline-flex items-center gap-2 rounded-lg bg-red-50 px-4 py-2.5 text-sm font-semibold text-red-600 transition hover:bg-red-100"
                                >

                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M6 7h12m-9 4v6m6-6v6M9 7V4h6v3m-8 0l1 13h8l1-13"
                                        />
                                    </svg>

                                    Nonaktifkan

                                </button>

                            </form>

                        @endif

                    </div>

                </div>

            </div>


            {{-- ========================= --}}
            {{-- INFORMASI DIAGNOSA --}}
            {{-- ========================= --}}

            <div class="mb-6 rounded-2xl bg-white shadow-sm ring-1 ring-gray-100">

                <div class="flex items-center gap-3 border-b border-gray-100 px-6 py-5">

                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-purple-50 text-purple-600">

                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M9 3h6m-7 4h8m-9 4h10m-9 4h8m-7 4h6"
                            />
                        </svg>

                    </div>

                    <div>

                        <h3 class="font-bold text-gray-800">
                            Informasi Diagnosa
                        </h3>

                        <p class="text-sm text-gray-500">
                            Informasi detail diagnosa
                        </p>

                    </div>

                </div>


                <div class="p-6">

                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                        {{-- KODE --}}
                        <div class="rounded-xl bg-gray-50 p-4">

                            <p class="text-xs font-medium uppercase tracking-wide text-gray-400">
                                Kode Diagnosa
                            </p>

                            <p class="mt-2">
                                <span class="inline-flex rounded-lg bg-purple-50 px-3 py-1.5 text-sm font-bold text-purple-700">
                                    {{ $diagnosa->kode }}
                                </span>
                            </p>

                        </div>


                        {{-- NAMA --}}
                        <div class="rounded-xl bg-gray-50 p-4">

                            <p class="text-xs font-medium uppercase tracking-wide text-gray-400">
                                Nama Diagnosa
                            </p>

                            <p class="mt-2 font-semibold text-gray-800">
                                {{ $diagnosa->nama }}
                            </p>

                        </div>


                        {{-- STATUS --}}
                        <div class="rounded-xl bg-gray-50 p-4">

                            <p class="text-xs font-medium uppercase tracking-wide text-gray-400">
                                Status
                            </p>

                            <div class="mt-2">

                                @if ($diagnosa->is_active)

                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-green-50 px-3 py-1.5 text-xs font-semibold text-green-700">
                                        <span class="h-1.5 w-1.5 rounded-full bg-green-500"></span>
                                        Aktif
                                    </span>

                                @else

                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-gray-100 px-3 py-1.5 text-xs font-semibold text-gray-500">
                                        <span class="h-1.5 w-1.5 rounded-full bg-gray-400"></span>
                                        Nonaktif
                                    </span>

                                @endif

                            </div>

                        </div>


                        {{-- JUMLAH PENGGUNAAN --}}
                        <div class="rounded-xl bg-gray-50 p-4">

                            <p class="text-xs font-medium uppercase tracking-wide text-gray-400">
                                Jumlah Penggunaan
                            </p>

                            <div class="mt-2 flex items-center gap-2">

                                <span class="text-2xl font-bold text-gray-800">
                                    {{ $diagnosa->kunjungans->count() }}
                                </span>

                                <span class="text-sm text-gray-500">
                                    kunjungan
                                </span>

                            </div>

                        </div>


                        {{-- DESKRIPSI --}}
                        <div class="rounded-xl bg-gray-50 p-4 md:col-span-2">

                            <p class="text-xs font-medium uppercase tracking-wide text-gray-400">
                                Deskripsi
                            </p>

                            <p class="mt-2 whitespace-pre-line text-sm leading-6 text-gray-700">
                                {{ $diagnosa->deskripsi ?? '-' }}
                            </p>

                        </div>

                    </div>

                </div>

            </div>


            {{-- ========================= --}}
            {{-- RIWAYAT PENGGUNAAN --}}
            {{-- ========================= --}}

            <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-100">

                <div class="border-b border-gray-100 px-6 py-5">

                    <div class="flex items-center gap-3">

                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-blue-600">

                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M3 12a9 9 0 1018 0 9 9 0 00-18 0zm9-5v5l3 2"
                                />
                            </svg>

                        </div>

                        <div>

                            <h3 class="font-bold text-gray-800">
                                Riwayat Penggunaan Diagnosa
                            </h3>

                            <p class="text-sm text-gray-500">
                                Riwayat kunjungan yang menggunakan diagnosa ini
                            </p>

                        </div>

                    </div>

                </div>


                <div class="p-6">

                    <div class="overflow-hidden rounded-xl border border-gray-100">

                        <div class="overflow-x-auto">

                            <table class="min-w-full">

                                <thead class="bg-gray-50">

                                    <tr class="border-b border-gray-100">

                                        <th class="px-4 py-4 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
                                            No
                                        </th>

                                        <th class="px-4 py-4 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
                                            Tanggal
                                        </th>

                                        <th class="px-4 py-4 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
                                            Kode Kunjungan
                                        </th>

                                        <th class="px-4 py-4 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
                                            Santri
                                        </th>

                                        <th class="px-4 py-4 text-right text-xs font-semibold uppercase tracking-wide text-gray-500">
                                            Aksi
                                        </th>

                                    </tr>

                                </thead>


                                <tbody class="divide-y divide-gray-100">

                                    @forelse ($diagnosa->kunjungans as $index => $kunjungan)

                                        <tr class="transition hover:bg-gray-50">

                                            {{-- NO --}}
                                            <td class="px-4 py-4 text-sm text-gray-500">
                                                {{ $index + 1 }}
                                            </td>


                                            {{-- TANGGAL --}}
                                            <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-600">

                                                <div class="flex items-center gap-2">

                                                    <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            stroke-width="1.8"
                                                            d="M8 7V3m8 4V3M4 9h16M5 5h14a1 1 0 011 1v13a1 1 0 01-1 1H5a1 1 0 01-1-1V6a1 1 0 011-1z"
                                                        />
                                                    </svg>

                                                    {{ $kunjungan->tanggal?->format('d-m-Y') ?? '-' }}

                                                </div>

                                            </td>


                                            {{-- KODE KUNJUNGAN --}}
                                            <td class="whitespace-nowrap px-4 py-4">

                                                <span class="inline-flex rounded-lg bg-indigo-50 px-3 py-1.5 text-xs font-semibold text-indigo-700">
                                                    {{ $kunjungan->kode_kunjungan }}
                                                </span>

                                            </td>


                                            {{-- SANTRI --}}
                                            <td class="px-4 py-4">

                                                <p class="font-semibold text-gray-800">
                                                    {{ $kunjungan->santri->nama ?? '-' }}
                                                </p>

                                                @if ($kunjungan->santri?->nomor_induk)
                                                    <p class="mt-0.5 text-xs text-gray-500">
                                                        {{ $kunjungan->santri->nomor_induk }}
                                                    </p>
                                                @endif

                                            </td>


                                            {{-- AKSI --}}
                                            <td class="whitespace-nowrap px-4 py-4 text-right">

                                                <a
                                                    href="#"
                                                    class="inline-flex items-center gap-1.5 rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-700 transition hover:border-indigo-200 hover:bg-indigo-50 hover:text-indigo-700"
                                                >

                                                    Detail

                                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M9 5l7 7-7 7"
                                                        />
                                                    </svg>

                                                </a>

                                            </td>

                                        </tr>

                                    @empty

                                        <tr>

                                            <td
                                                colspan="5"
                                                class="px-6 py-14 text-center"
                                            >

                                                <div class="mx-auto flex max-w-sm flex-col items-center">

                                                    <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gray-100 text-gray-400">

                                                        <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                stroke-width="1.7"
                                                                d="M3 12a9 9 0 1018 0 9 9 0 00-18 0zm9-5v5l3 2"
                                                            />
                                                        </svg>

                                                    </div>

                                                    <h4 class="mt-4 font-semibold text-gray-700">
                                                        Belum ada riwayat penggunaan
                                                    </h4>

                                                    <p class="mt-1 text-sm text-gray-500">
                                                        Diagnosa ini belum digunakan pada kunjungan.
                                                    </p>

                                                </div>

                                            </td>

                                        </tr>

                                    @endforelse

                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>

            </div>


        </div>
    </div>

</x-app-layout>