<x-app-layout>

    <x-slot name="header">
        <div>
            <p class="text-sm text-gray-500">Master Data</p>
            <h2 class="text-2xl font-bold text-gray-800">
                Data Tindakan
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


            {{-- ========================= --}}
            {{-- HEADER CARD --}}
            {{-- ========================= --}}

            <div class="mb-6 rounded-2xl bg-white shadow-sm ring-1 ring-gray-100">

                <div class="flex flex-col gap-5 px-6 py-6 sm:flex-row sm:items-center sm:justify-between">

                    <div class="flex items-center gap-4">

                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">

                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M12 3v18M3 12h18"
                                />
                            </svg>

                        </div>

                        <div>

                            <h3 class="text-lg font-bold text-gray-800">
                                Daftar Tindakan
                            </h3>

                            <p class="mt-1 text-sm text-gray-500">
                                Data tindakan yang dapat diberikan dalam pelayanan poliklinik.
                            </p>

                        </div>

                    </div>


                    {{-- TAMBAH TINDAKAN --}}

                    @if (in_array(auth()->user()->role, ['admin', 'petugas']))

                        <a
                            href="{{ route('tindakan.create') }}"
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

                            Tambah Tindakan

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
                                Daftar tindakan yang tersedia di SIPOLI-MQ.
                            </p>

                        </div>


                        @if ($tindakans->total() > 0)

                            <div class="hidden rounded-lg bg-gray-50 px-3 py-2 text-sm text-gray-600 sm:block">

                                Total:
                                <span class="font-semibold text-gray-800">
                                    {{ $tindakans->total() }}
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
                                    Nama Tindakan
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

                            @forelse ($tindakans as $index => $tindakan)

                                <tr class="transition hover:bg-gray-50">

                                    {{-- NO --}}
                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                                        {{ $tindakans->firstItem() + $index }}
                                    </td>


                                    {{-- KODE --}}
                                    <td class="whitespace-nowrap px-6 py-4">

                                        <span class="inline-flex rounded-lg bg-emerald-50 px-3 py-1.5 text-xs font-bold text-emerald-700">
                                            {{ $tindakan->kode }}
                                        </span>

                                    </td>


                                    {{-- NAMA --}}
                                    <td class="px-6 py-4">

                                        <p class="font-semibold text-gray-800">
                                            {{ $tindakan->nama }}
                                        </p>

                                    </td>


                                    {{-- DESKRIPSI --}}
                                    <td class="max-w-md px-6 py-4">

                                        <p class="line-clamp-2 text-sm text-gray-500">
                                            {{ $tindakan->deskripsi ?? '-' }}
                                        </p>

                                    </td>


                                    {{-- STATUS --}}
                                    <td class="whitespace-nowrap px-6 py-4">

                                        @if ($tindakan->is_active)

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
                                            href="{{ route('tindakan.show', $tindakan) }}"
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
                                                        d="M12 3v18M3 12h18"
                                                    />
                                                </svg>

                                            </div>

                                            <h4 class="mt-4 font-semibold text-gray-700">
                                                Belum ada data tindakan
                                            </h4>

                                            <p class="mt-1 text-sm text-gray-500">
                                                Data tindakan belum tersedia.
                                            </p>


                                            @if (in_array(auth()->user()->role, ['admin', 'petugas']))

                                                <a
                                                    href="{{ route('tindakan.create') }}"
                                                    class="mt-4 text-sm font-semibold text-indigo-600 hover:text-indigo-700"
                                                >
                                                    + Tambah Tindakan
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

                @if ($tindakans->hasPages())

                    <div class="border-t border-gray-100 px-6 py-4">
                        {{ $tindakans->links() }}
                    </div>

                @endif

            </div>

        </div>
    </div>

</x-app-layout>