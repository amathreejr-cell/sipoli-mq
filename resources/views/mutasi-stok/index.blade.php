<x-app-layout>

    <div class="space-y-6">

            {{-- Header --}}
            <div class="mb-6 overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
                <div class="bg-gradient-to-r from-amber-50 to-white px-6 py-6 sm:px-8">

                    <div class="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">

                        <div class="flex items-center gap-4">

                            <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-amber-100 text-amber-600">
                                <svg
                                    class="h-7 w-7"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.8"
                                        d="M7 7h10M7 12h10M7 17h10M5 7h.01M5 12h.01M5 17h.01"
                                    />
                                </svg>
                            </div>

                            <div>
                                <p class="text-sm font-medium text-amber-600">
                                    Manajemen Stok
                                </p>

                                <h3 class="mt-1 text-xl font-bold text-gray-900">
                                    Riwayat Mutasi Stok
                                </h3>

                                <p class="mt-1 text-sm text-gray-500">
                                    Riwayat perubahan stok obat di poliklinik.
                                </p>
                            </div>

                        </div>


                        @if (in_array(auth()->user()->role, ['admin', 'petugas']))
                            <a
                                href="{{ route('obat.stok-masuk.create') }}"
                                class="inline-flex w-fit items-center gap-2 rounded-xl bg-emerald-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700"
                            >
                                <svg
                                    class="h-5 w-5"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 4v16m8-8H4"
                                    />
                                </svg>

                                Stok Masuk
                            </a>
                        @endif

                    </div>

                </div>
            </div>


            {{-- Ringkasan --}}
            <div class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-2">

                {{-- Total Mutasi --}}
                <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">
                    <div class="flex items-center gap-4">

                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-amber-50 text-amber-600">
                            <svg
                                class="h-5 w-5"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M7 7h10M7 12h10M7 17h10"
                                />
                            </svg>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">
                                Total Riwayat
                            </p>

                            <p class="mt-1 text-2xl font-bold text-gray-900">
                                {{ $mutasis->total() }}
                            </p>
                        </div>

                    </div>
                </div>


                {{-- Data Ditampilkan --}}
                <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">
                    <div class="flex items-center gap-4">

                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                            <svg
                                class="h-5 w-5"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h10a2 2 0 012 2v12a2 2 0 01-2 2z"
                                />
                            </svg>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">
                                Data Halaman Ini
                            </p>

                            <p class="mt-1 text-2xl font-bold text-gray-900">
                                {{ $mutasis->count() }}
                            </p>
                        </div>

                    </div>
                </div>

            </div>


            {{-- Tabel --}}
            <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

                <div class="border-b border-gray-100 px-6 py-5 sm:px-8">

                    <div class="flex items-center gap-3">

                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-amber-50 text-amber-600">
                            <svg
                                class="h-5 w-5"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M7 7h10M7 12h10M7 17h10M5 7h.01M5 12h.01M5 17h.01"
                                />
                            </svg>
                        </div>

                        <div>
                            <h3 class="font-bold text-gray-900">
                                Daftar Mutasi Stok
                            </h3>

                            <p class="text-sm text-gray-500">
                                Catatan setiap perubahan stok obat.
                            </p>
                        </div>

                    </div>

                </div>


                <div class="overflow-x-auto">
                    <table class="min-w-full">

                        <thead class="bg-gray-50">
                            <tr>

                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                    No
                                </th>

                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                    Tanggal
                                </th>

                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                    Obat
                                </th>

                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                    Jenis
                                </th>

                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                    Jumlah
                                </th>

                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                    Stok
                                </th>

                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                    Keterangan
                                </th>

                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                    Petugas
                                </th>

                            </tr>
                        </thead>


                        <tbody class="divide-y divide-gray-100">

                            @forelse ($mutasis as $index => $mutasi)

                                <tr class="transition hover:bg-gray-50">

                                    {{-- No --}}
                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                                        {{ $mutasis->firstItem() + $index }}
                                    </td>


                                    {{-- Tanggal --}}
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <div class="flex items-center gap-2">

                                            <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-gray-100 text-gray-500">
                                                <svg
                                                    class="h-4 w-4"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    viewBox="0 0 24 24"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="1.8"
                                                        d="M8 7V3m8 4V3M4 11h16M5 5h14a1 1 0 011 1v14a1 1 0 01-1 1H5a1 1 0 01-1-1V6a1 1 0 011-1z"
                                                    />
                                                </svg>
                                            </div>

                                            <span class="text-sm text-gray-700">
                                                {{ $mutasi->created_at?->format('d-m-Y H:i') }}
                                            </span>

                                        </div>
                                    </td>


                                    {{-- Obat --}}
                                    <td class="px-6 py-4">
                                        <p class="font-semibold text-gray-900">
                                            {{ $mutasi->obat?->nama ?? '-' }}
                                        </p>
                                    </td>


                                    {{-- Jenis --}}
                                    <td class="whitespace-nowrap px-6 py-4">

                                        @if ($mutasi->jenis === 'masuk')

                                            <span class="inline-flex items-center gap-2 rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700">
                                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                                Masuk
                                            </span>

                                        @elseif ($mutasi->jenis === 'keluar')

                                            <span class="inline-flex items-center gap-2 rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                                                <span class="h-1.5 w-1.5 rounded-full bg-red-500"></span>
                                                Keluar
                                            </span>

                                        @else

                                            <span class="inline-flex items-center gap-2 rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold text-amber-700">
                                                <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                                                Penyesuaian
                                            </span>

                                        @endif

                                    </td>


                                    {{-- Jumlah --}}
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <span class="font-semibold text-gray-900">
                                            {{ $mutasi->jumlah }}
                                        </span>
                                    </td>


                                    {{-- Stok --}}
                                    <td class="whitespace-nowrap px-6 py-4">

                                        <div class="flex items-center gap-2">

                                            <span class="rounded-lg bg-gray-100 px-2.5 py-1 text-xs font-semibold text-gray-700">
                                                {{ $mutasi->stok_sebelum }}
                                            </span>

                                            <svg
                                                class="h-4 w-4 text-gray-400"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M9 5l7 7-7 7"
                                                />
                                            </svg>

                                            <span class="rounded-lg bg-blue-50 px-2.5 py-1 text-xs font-semibold text-blue-700">
                                                {{ $mutasi->stok_sesudah }}
                                            </span>

                                        </div>

                                    </td>


                                    {{-- Keterangan --}}
                                    <td class="max-w-xs px-6 py-4">
                                        <p class="truncate text-sm text-gray-600">
                                            {{ $mutasi->keterangan ?? '-' }}
                                        </p>
                                    </td>


                                    {{-- Petugas --}}
                                    <td class="whitespace-nowrap px-6 py-4">

                                        <div class="flex items-center gap-2">

                                            <div class="flex h-8 w-8 items-center justify-center rounded-full bg-gray-100 text-xs font-semibold text-gray-600">
                                                {{ strtoupper(substr($mutasi->user?->name ?? '-', 0, 1)) }}
                                            </div>

                                            <span class="text-sm text-gray-700">
                                                {{ $mutasi->user?->name ?? '-' }}
                                            </span>

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td
                                        colspan="8"
                                        class="px-6 py-14 text-center"
                                    >

                                        <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-gray-100 text-gray-400">

                                            <svg
                                                class="h-7 w-7"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="1.8"
                                                    d="M7 7h10M7 12h10M7 17h10"
                                                />
                                            </svg>

                                        </div>

                                        <p class="mt-4 text-sm font-semibold text-gray-700">
                                            Belum ada riwayat mutasi stok
                                        </p>

                                        <p class="mt-1 text-sm text-gray-500">
                                            Perubahan stok obat akan tercatat di halaman ini.
                                        </p>

                                        @if (in_array(auth()->user()->role, ['admin', 'petugas']))
                                            <a
                                                href="{{ route('obat.stok-masuk.create') }}"
                                                class="mt-4 inline-flex items-center gap-2 rounded-xl bg-emerald-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-emerald-700"
                                            >
                                                <svg
                                                    class="h-4 w-4"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    viewBox="0 0 24 24"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M12 4v16m8-8H4"
                                                    />
                                                </svg>

                                                Stok Masuk
                                            </a>
                                        @endif

                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>
                </div>


                {{-- Pagination --}}
                @if ($mutasis->hasPages())
                    <div class="border-t border-gray-100 px-6 py-4 sm:px-8">
                        {{ $mutasis->links() }}
                    </div>
                @endif

            </div>
    </div>

</x-app-layout>