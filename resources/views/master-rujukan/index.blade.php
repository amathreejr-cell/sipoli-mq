<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="text-xl font-bold text-gray-800">
                Master Rujukan
            </h2>
            <p class="mt-1 text-sm text-gray-500">
                Kelola daftar fasilitas kesehatan tujuan rujukan.
            </p>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Header --}}
            <div class="mb-6 overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
                <div class="bg-gradient-to-r from-blue-50 to-white px-6 py-6 sm:px-8">
                    <div class="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">

                        <div class="flex items-center gap-4">
                            <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-blue-100 text-blue-600">
                                <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.8"
                                        d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"
                                    />
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.8"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"
                                    />
                                </svg>
                            </div>

                            <div>
                                <p class="text-sm font-medium text-blue-600">
                                    Master Data
                                </p>

                                <h3 class="mt-1 text-xl font-bold text-gray-900">
                                    Master Rujukan
                                </h3>

                                <p class="mt-1 text-sm text-gray-500">
                                    Daftar fasilitas kesehatan tujuan rujukan.
                                </p>
                            </div>
                        </div>

                        <a
                            href="{{ route('master-rujukan.create') }}"
                            class="inline-flex w-fit items-center gap-2 rounded-xl bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700"
                        >
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 4v16m8-8H4"
                                />
                            </svg>

                            Tambah Rujukan
                        </a>

                    </div>
                </div>
            </div>


            {{-- Alert Success --}}
            @if (session('success'))
                <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 p-4">
                    <div class="flex items-start gap-3">

                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-emerald-100 text-emerald-600">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M5 13l4 4L19 7"
                                />
                            </svg>
                        </div>

                        <div>
                            <p class="font-semibold text-emerald-800">
                                Berhasil
                            </p>

                            <p class="mt-1 text-sm text-emerald-700">
                                {{ session('success') }}
                            </p>
                        </div>

                    </div>
                </div>
            @endif


            {{-- Statistik --}}
            <div class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-2">

                <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">
                    <div class="flex items-center gap-4">

                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"
                                />
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"
                                />
                            </svg>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">
                                Total Fasilitas
                            </p>

                            <p class="mt-1 text-2xl font-bold text-gray-900">
                                {{ $masterRujukans->total() }}
                            </p>
                        </div>

                    </div>
                </div>


                <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">
                    <div class="flex items-center gap-4">

                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M5 13l4 4L19 7"
                                />
                            </svg>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">
                                Data Ditampilkan
                            </p>

                            <p class="mt-1 text-2xl font-bold text-gray-900">
                                {{ $masterRujukans->count() }}
                            </p>
                        </div>

                    </div>
                </div>

            </div>


            {{-- Tabel --}}
            <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

                <div class="border-b border-gray-100 px-6 py-5 sm:px-8">
                    <div class="flex items-center gap-3">

                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h10a2 2 0 012 2v12a2 2 0 01-2 2z"
                                />
                            </svg>
                        </div>

                        <div>
                            <h3 class="font-bold text-gray-900">
                                Daftar Fasilitas Rujukan
                            </h3>

                            <p class="text-sm text-gray-500">
                                Fasilitas kesehatan yang tersedia sebagai tujuan rujukan.
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
                                    Nama Fasilitas
                                </th>

                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                    Alamat
                                </th>

                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                    No. Telepon
                                </th>

                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                    Status
                                </th>

                                <th class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wider text-gray-500">
                                    Aksi
                                </th>

                            </tr>
                        </thead>


                        <tbody class="divide-y divide-gray-100">

                            @forelse($masterRujukans as $masterRujukan)

                                <tr class="transition hover:bg-gray-50">

                                    {{-- No --}}
                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                                        {{ $masterRujukans->firstItem() + $loop->index }}
                                    </td>


                                    {{-- Nama --}}
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">

                                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-blue-50 text-blue-600">
                                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="1.8"
                                                        d="M12 2a7 7 0 017 7c0 5-7 13-7 13S5 14 5 9a7 7 0 017-7z"
                                                    />
                                                    <circle
                                                        cx="12"
                                                        cy="9"
                                                        r="2.5"
                                                        stroke-width="1.8"
                                                    />
                                                </svg>
                                            </div>

                                            <div>
                                                <p class="font-semibold text-gray-900">
                                                    {{ $masterRujukan->nama_fasilitas }}
                                                </p>
                                            </div>

                                        </div>
                                    </td>


                                    {{-- Alamat --}}
                                    <td class="max-w-xs px-6 py-4">
                                        <p class="truncate text-sm text-gray-600">
                                            {{ $masterRujukan->alamat ?? '-' }}
                                        </p>
                                    </td>


                                    {{-- Telepon --}}
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <span class="text-sm text-gray-600">
                                            {{ $masterRujukan->no_telepon ?? '-' }}
                                        </span>
                                    </td>


                                    {{-- Status --}}
                                    <td class="whitespace-nowrap px-6 py-4">

                                        @if ($masterRujukan->is_active)
                                            <span class="inline-flex items-center gap-2 rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700">
                                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                                Aktif
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-2 rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-600">
                                                <span class="h-1.5 w-1.5 rounded-full bg-gray-400"></span>
                                                Nonaktif
                                            </span>
                                        @endif

                                    </td>


                                    {{-- Aksi --}}
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <div class="flex items-center justify-end gap-2">

                                            {{-- Detail --}}
                                            <a
                                                href="{{ route('master-rujukan.show', $masterRujukan) }}"
                                                class="inline-flex items-center gap-1.5 rounded-lg border border-gray-200 bg-white px-3 py-2 text-xs font-semibold text-gray-700 transition hover:bg-gray-50"
                                            >
                                                Detail
                                            </a>


                                            {{-- Edit --}}
                                            <a
                                                href="{{ route('master-rujukan.edit', $masterRujukan) }}"
                                                class="inline-flex items-center gap-1.5 rounded-lg bg-amber-50 px-3 py-2 text-xs font-semibold text-amber-700 transition hover:bg-amber-100"
                                            >
                                                Edit
                                            </a>


                                            {{-- Nonaktifkan --}}
                                            @if ($masterRujukan->is_active)
                                                <form
                                                    action="{{ route('master-rujukan.destroy', $masterRujukan) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Nonaktifkan fasilitas rujukan ini?')"
                                                >
                                                    @csrf
                                                    @method('DELETE')

                                                    <button
                                                        type="submit"
                                                        class="inline-flex items-center gap-1.5 rounded-lg bg-red-50 px-3 py-2 text-xs font-semibold text-red-700 transition hover:bg-red-100"
                                                    >
                                                        Nonaktifkan
                                                    </button>
                                                </form>
                                            @endif

                                        </div>
                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="6" class="px-6 py-14 text-center">

                                        <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-gray-100 text-gray-400">
                                            <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="1.8"
                                                    d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"
                                                />
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="1.8"
                                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"
                                                />
                                            </svg>
                                        </div>

                                        <p class="mt-4 text-sm font-semibold text-gray-700">
                                            Belum ada fasilitas rujukan
                                        </p>

                                        <p class="mt-1 text-sm text-gray-500">
                                            Tambahkan fasilitas kesehatan tujuan rujukan terlebih dahulu.
                                        </p>

                                        <a
                                            href="{{ route('master-rujukan.create') }}"
                                            class="mt-4 inline-flex items-center gap-2 rounded-xl bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-700"
                                        >
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M12 4v16m8-8H4"
                                                />
                                            </svg>

                                            Tambah Rujukan
                                        </a>

                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>
                </div>


                {{-- Pagination --}}
                @if ($masterRujukans->hasPages())
                    <div class="border-t border-gray-100 px-6 py-4 sm:px-8">
                        {{ $masterRujukans->links() }}
                    </div>
                @endif

            </div>

        </div>
    </div>

</x-app-layout>