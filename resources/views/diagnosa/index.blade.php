<x-app-layout>

    <x-slot name="header">
        <div>
            <p class="text-sm text-gray-500">Master Data</p>
            <h2 class="text-2xl font-bold text-gray-800">
                Data Diagnosa
            </h2>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

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
            {{-- HEADER CARD --}}
            {{-- ========================= --}}

            <div class="mb-6 rounded-2xl bg-white shadow-sm ring-1 ring-gray-100">

                <div class="flex flex-col gap-5 px-6 py-6 sm:flex-row sm:items-center sm:justify-between">

                    <div class="flex items-center gap-4">

                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-purple-50 text-purple-600">

                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M9 3h6m-7 4h8m-9 4h10m-9 4h8m-7 4h6"
                                />
                            </svg>

                        </div>

                        <div>
                            <h3 class="text-lg font-bold text-gray-800">
                                Daftar Diagnosa
                            </h3>

                            <p class="mt-1 text-sm text-gray-500">
                                Data diagnosis yang digunakan dalam pemeriksaan santri.
                            </p>
                        </div>

                    </div>


                    {{-- TOMBOL TAMBAH --}}

                    @if (in_array(auth()->user()->role, ['admin', 'petugas']))
                        <a
                            href="{{ route('diagnosa.create') }}"
                            class="inline-flex items-center justify-center gap-2 rounded-lg bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700"
                        >

                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 4v16m8-8H4"
                                />
                            </svg>

                            Tambah Diagnosa

                        </a>
                    @endif

                </div>

            </div>


            {{-- ========================= --}}
            {{-- DATA TABLE --}}
            {{-- ========================= --}}

            <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-100">

                <div class="border-b border-gray-100 px-6 py-5">

                    <div class="flex items-center justify-between">

                        <div>
                            <h3 class="font-bold text-gray-800">
                                Daftar Data
                            </h3>

                            <p class="mt-1 text-sm text-gray-500">
                                Daftar diagnosa yang tersedia di SIPOLI-MQ.
                            </p>
                        </div>

                        @if ($diagnosas->total() > 0)
                            <div class="hidden rounded-lg bg-gray-50 px-3 py-2 text-sm text-gray-600 sm:block">
                                Total:
                                <span class="font-semibold text-gray-800">
                                    {{ $diagnosas->total() }}
                                </span>
                            </div>
                        @endif

                    </div>

                </div>


                <div class="overflow-x-auto">

                    <table class="min-w-full">

                        <thead class="bg-gray-50">

                            <tr class="border-b border-gray-100">

                                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
                                    No
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
                                    Kode
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
                                    Nama Diagnosa
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
                                    Deskripsi
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
                                    Status
                                </th>

                                <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wide text-gray-500">
                                    Aksi
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y divide-gray-100">

                            @forelse ($diagnosas as $index => $diagnosa)

                                <tr class="transition hover:bg-gray-50">

                                    {{-- NO --}}
                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                                        {{ $diagnosas->firstItem() + $index }}
                                    </td>


                                    {{-- KODE --}}
                                    <td class="whitespace-nowrap px-6 py-4">

                                        <span class="inline-flex rounded-lg bg-purple-50 px-3 py-1.5 text-xs font-bold text-purple-700">
                                            {{ $diagnosa->kode }}
                                        </span>

                                    </td>


                                    {{-- NAMA --}}
                                    <td class="px-6 py-4">

                                        <p class="font-semibold text-gray-800">
                                            {{ $diagnosa->nama }}
                                        </p>

                                    </td>


                                    {{-- DESKRIPSI --}}
                                    <td class="max-w-md px-6 py-4">

                                        <p class="line-clamp-2 text-sm text-gray-500">
                                            {{ $diagnosa->deskripsi ?? '-' }}
                                        </p>

                                    </td>


                                    {{-- STATUS --}}
                                    <td class="whitespace-nowrap px-6 py-4">

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

                                    </td>


                                    {{-- AKSI --}}
                                    <td class="whitespace-nowrap px-6 py-4 text-right">

                                        <a
                                            href="{{ route('diagnosa.show', $diagnosa) }}"
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
                                        colspan="6"
                                        class="px-6 py-14 text-center"
                                    >

                                        <div class="mx-auto flex max-w-sm flex-col items-center">

                                            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gray-100 text-gray-400">

                                                <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="1.7"
                                                        d="M9 3h6m-7 4h8m-9 4h10m-9 4h8m-7 4h6"
                                                    />
                                                </svg>

                                            </div>

                                            <h4 class="mt-4 font-semibold text-gray-700">
                                                Belum ada data diagnosa
                                            </h4>

                                            <p class="mt-1 text-sm text-gray-500">
                                                Data diagnosa belum tersedia.
                                            </p>

                                            @if (in_array(auth()->user()->role, ['admin', 'petugas']))
                                                <a
                                                    href="{{ route('diagnosa.create') }}"
                                                    class="mt-4 text-sm font-semibold text-indigo-600 hover:text-indigo-700"
                                                >
                                                    + Tambah Diagnosa
                                                </a>
                                            @endif

                                        </div>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>


                {{-- PAGINATION --}}

                @if ($diagnosas->hasPages())

                    <div class="border-t border-gray-100 px-6 py-4">
                        {{ $diagnosas->links() }}
                    </div>

                @endif

            </div>

        </div>
    </div>

</x-app-layout>