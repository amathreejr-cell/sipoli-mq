<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-xl font-bold text-gray-800">
                Detail Tindakan
            </h2>
            <p class="mt-1 text-sm text-gray-500">
                Informasi tindakan dan riwayat penggunaannya dalam pelayanan.
            </p>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Alert Success --}}
            @if (session('success'))
                <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 p-4">
                    <div class="flex items-start gap-3">
                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-emerald-100 text-emerald-600">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
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

            {{-- Alert Error --}}
            @if (session('error'))
                <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4">
                    <div class="flex items-start gap-3">
                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-red-100 text-red-600">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </div>

                        <div>
                            <p class="font-semibold text-red-800">
                                Terjadi Kesalahan
                            </p>
                            <p class="mt-1 text-sm text-red-700">
                                {{ session('error') }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif


            {{-- Header Tindakan --}}
            <div class="mb-6 overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
                <div class="bg-gradient-to-r from-emerald-50 to-white px-6 py-6 sm:px-8">
                    <div class="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">

                        <div class="flex items-center gap-4">
                            <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600">
                                <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a3 3 0 006 0M9 5h6M9 13h6M9 17h4" />
                                </svg>
                            </div>

                            <div>
                                <p class="text-sm font-medium text-emerald-600">
                                    Data Tindakan
                                </p>

                                <h3 class="mt-1 text-xl font-bold text-gray-900">
                                    {{ $tindakan->nama }}
                                </h3>

                                <p class="mt-1 text-sm text-gray-500">
                                    Kode tindakan:
                                    <span class="font-semibold text-gray-700">
                                        {{ $tindakan->kode }}
                                    </span>
                                </p>
                            </div>
                        </div>

                        {{-- Status --}}
                        @if ($tindakan->is_active)
                            <span class="inline-flex w-fit items-center gap-2 rounded-full bg-emerald-100 px-3 py-1.5 text-sm font-semibold text-emerald-700">
                                <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                                Aktif
                            </span>
                        @else
                            <span class="inline-flex w-fit items-center gap-2 rounded-full bg-gray-100 px-3 py-1.5 text-sm font-semibold text-gray-600">
                                <span class="h-2 w-2 rounded-full bg-gray-400"></span>
                                Nonaktif
                            </span>
                        @endif

                    </div>
                </div>
            </div>


            {{-- Informasi Tindakan --}}
            <div class="mb-6 rounded-2xl border border-gray-200 bg-white shadow-sm">
                <div class="border-b border-gray-100 px-6 py-5 sm:px-8">
                    <div class="flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a3 3 0 006 0M9 13h6M9 17h4" />
                            </svg>
                        </div>

                        <div>
                            <h3 class="font-bold text-gray-900">
                                Informasi Tindakan
                            </h3>
                            <p class="text-sm text-gray-500">
                                Detail data tindakan yang tersimpan.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-6 px-6 py-6 sm:grid-cols-2 sm:px-8">

                    {{-- Kode --}}
                    <div class="rounded-xl bg-gray-50 p-4">
                        <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                            Kode Tindakan
                        </p>

                        <p class="mt-2 inline-flex rounded-lg bg-emerald-100 px-3 py-1.5 text-sm font-bold text-emerald-700">
                            {{ $tindakan->kode }}
                        </p>
                    </div>

                    {{-- Nama --}}
                    <div class="rounded-xl bg-gray-50 p-4">
                        <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                            Nama Tindakan
                        </p>

                        <p class="mt-2 font-semibold text-gray-900">
                            {{ $tindakan->nama }}
                        </p>
                    </div>

                    {{-- Status --}}
                    <div class="rounded-xl bg-gray-50 p-4">
                        <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                            Status
                        </p>

                        <div class="mt-2">
                            @if ($tindakan->is_active)
                                <span class="inline-flex items-center gap-2 rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700">
                                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                    Aktif
                                </span>
                            @else
                                <span class="inline-flex items-center gap-2 rounded-full bg-gray-200 px-3 py-1 text-xs font-semibold text-gray-600">
                                    <span class="h-1.5 w-1.5 rounded-full bg-gray-400"></span>
                                    Nonaktif
                                </span>
                            @endif
                        </div>
                    </div>

                    {{-- Penggunaan --}}
                    <div class="rounded-xl bg-gray-50 p-4">
                        <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                            Jumlah Penggunaan
                        </p>

                        <p class="mt-2 font-semibold text-gray-900">
                            {{ $tindakan->kunjungans->count() }}
                            <span class="font-normal text-gray-500">
                                kunjungan
                            </span>
                        </p>
                    </div>

                    {{-- Deskripsi --}}
                    <div class="rounded-xl bg-gray-50 p-4 sm:col-span-2">
                        <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                            Deskripsi
                        </p>

                        <p class="mt-2 text-sm leading-6 text-gray-700">
                            {{ $tindakan->deskripsi ?? '-' }}
                        </p>
                    </div>

                </div>
            </div>


            {{-- Riwayat Penggunaan --}}
            <div class="rounded-2xl border border-gray-200 bg-white shadow-sm">
                <div class="border-b border-gray-100 px-6 py-5 sm:px-8">
                    <div class="flex items-center justify-between gap-4">
                        <div class="flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h10a2 2 0 012 2v12a2 2 0 01-2 2z" />
                                </svg>
                            </div>

                            <div>
                                <h3 class="font-bold text-gray-900">
                                    Riwayat Penggunaan Tindakan
                                </h3>
                                <p class="text-sm text-gray-500">
                                    Daftar kunjungan yang menggunakan tindakan ini.
                                </p>
                            </div>
                        </div>

                        <span class="hidden rounded-full bg-blue-50 px-3 py-1 text-xs font-semibold text-blue-700 sm:inline-flex">
                            {{ $tindakan->kunjungans->count() }} Penggunaan
                        </span>
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
                                    Kode Kunjungan
                                </th>

                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                    Santri
                                </th>

                                <th class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wider text-gray-500">
                                    Aksi
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100">

                            @forelse ($tindakan->kunjungans as $index => $kunjungan)
                                <tr class="transition hover:bg-gray-50">

                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                                        {{ $index + 1 }}
                                    </td>

                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-700">
                                        {{ $kunjungan->tanggal?->format('d-m-Y') ?? '-' }}
                                    </td>

                                    <td class="whitespace-nowrap px-6 py-4">
                                        <span class="inline-flex rounded-lg bg-gray-100 px-2.5 py-1 text-xs font-semibold text-gray-700">
                                            {{ $kunjungan->kode_kunjungan }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4">
                                        <div class="font-medium text-gray-900">
                                            {{ $kunjungan->santri->nama ?? '-' }}
                                        </div>
                                    </td>

                                    <td class="whitespace-nowrap px-6 py-4 text-right">
                                        <a
                                            href="#"
                                            class="inline-flex items-center gap-1.5 rounded-lg px-3 py-2 text-sm font-medium text-gray-600 transition hover:bg-gray-100 hover:text-gray-900"
                                        >
                                            Detail

                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5l7 7-7 7" />
                                            </svg>
                                        </a>
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center">
                                        <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-gray-100 text-gray-400">
                                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                                    d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h10a2 2 0 012 2v12a2 2 0 01-2 2z" />
                                            </svg>
                                        </div>

                                        <p class="mt-3 text-sm font-medium text-gray-700">
                                            Belum ada riwayat penggunaan
                                        </p>

                                        <p class="mt-1 text-sm text-gray-500">
                                            Tindakan ini belum digunakan pada kunjungan.
                                        </p>
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>


            {{-- Tombol Aksi --}}
            <div class="mt-6 flex flex-wrap items-center gap-3">

                <a
                    href="{{ route('tindakan.index') }}"
                    class="inline-flex items-center gap-2 rounded-xl border border-gray-300 bg-white px-4 py-2.5 text-sm font-semibold text-gray-700 shadow-sm transition hover:bg-gray-50"
                >
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 19l-7-7 7-7" />
                    </svg>

                    Kembali
                </a>

                @if (in_array(auth()->user()->role, ['admin', 'petugas']))
                    <a
                        href="{{ route('tindakan.edit', $tindakan) }}"
                        class="inline-flex items-center gap-2 rounded-xl bg-gray-800 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-gray-700"
                    >
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z" />
                        </svg>

                        Edit
                    </a>
                @endif

                @if (auth()->user()->role === 'admin' && $tindakan->is_active)
                    <form
                        method="POST"
                        action="{{ route('tindakan.destroy', $tindakan) }}"
                        onsubmit="return confirm('Apakah Anda yakin ingin menonaktifkan tindakan ini?')"
                    >
                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="inline-flex items-center gap-2 rounded-xl bg-red-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-red-500"
                        >
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-7 0h10" />
                            </svg>

                            Nonaktifkan
                        </button>
                    </form>
                @endif

            </div>

        </div>
    </div>
</x-app-layout>