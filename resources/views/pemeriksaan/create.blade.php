<x-app-layout>

    <x-slot name="header">
        <div>
            <p class="text-sm text-gray-500">Pelayanan Poliklinik</p>
            <h2 class="text-2xl font-bold text-gray-800">
                Pemeriksaan Santri
            </h2>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- ================================= --}}
            {{-- ALERT --}}
            {{-- ================================= --}}

            @if (session('success'))
                <div class="mb-5 rounded-xl border border-green-200 bg-green-50 px-5 py-4 text-sm text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-5 rounded-xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-700">
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-5 rounded-xl border border-red-200 bg-red-50 px-5 py-4">
                    <p class="mb-2 text-sm font-semibold text-red-700">
                        Periksa kembali data pemeriksaan:
                    </p>

                    <ul class="list-disc space-y-1 pl-5 text-sm text-red-600">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            {{-- ================================= --}}
            {{-- STEPPER --}}
            {{-- ================================= --}}

            <div class="mb-6 overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-100">

                <div class="overflow-x-auto px-4 py-5 sm:px-6">

                    <div class="flex min-w-[900px] items-center">

                        {{-- 1. Kunjungan --}}
                        <div class="flex shrink-0 items-center">

                            <div class="flex h-9 w-9 items-center justify-center rounded-full bg-green-600 text-sm font-bold text-white">
                                ✓
                            </div>

                            <div class="ml-2">
                                <p class="text-xs font-semibold text-green-600">
                                    01
                                </p>
                                <p class="text-sm font-medium text-gray-700">
                                    Kunjungan
                                </p>
                            </div>

                        </div>

                        <div class="mx-3 h-px flex-1 bg-green-200"></div>


                        {{-- 2. Pemeriksaan --}}
                        <div class="flex shrink-0 items-center">

                            <div class="flex h-9 w-9 items-center justify-center rounded-full bg-indigo-600 text-sm font-bold text-white shadow-md shadow-indigo-200">
                                2
                            </div>

                            <div class="ml-2">
                                <p class="text-xs font-semibold text-indigo-600">
                                    02
                                </p>
                                <p class="text-sm font-semibold text-indigo-600">
                                    Pemeriksaan
                                </p>
                            </div>

                        </div>

                        <div class="mx-3 h-px flex-1 bg-gray-200"></div>


                        {{-- 3. Diagnosa --}}
                        <div class="flex shrink-0 items-center">

                            <div class="flex h-9 w-9 items-center justify-center rounded-full bg-gray-100 text-sm font-bold text-gray-500">
                                3
                            </div>

                            <div class="ml-2">
                                <p class="text-xs font-medium text-gray-400">
                                    03
                                </p>
                                <p class="text-sm text-gray-500">
                                    Diagnosa
                                </p>
                            </div>

                        </div>

                        <div class="mx-3 h-px flex-1 bg-gray-200"></div>


                        {{-- 4. Tindakan --}}
                        <div class="flex shrink-0 items-center">

                            <div class="flex h-9 w-9 items-center justify-center rounded-full bg-gray-100 text-sm font-bold text-gray-500">
                                4
                            </div>

                            <div class="ml-2">
                                <p class="text-xs font-medium text-gray-400">
                                    04
                                </p>
                                <p class="text-sm text-gray-500">
                                    Tindakan
                                </p>
                            </div>

                        </div>

                        <div class="mx-3 h-px flex-1 bg-gray-200"></div>


                        {{-- 5. Keputusan --}}
                        <div class="flex shrink-0 items-center">

                            <div class="flex h-9 w-9 items-center justify-center rounded-full bg-gray-100 text-sm font-bold text-gray-500">
                                5
                            </div>

                            <div class="ml-2">
                                <p class="text-xs font-medium text-gray-400">
                                    05
                                </p>
                                <p class="text-sm text-gray-500">
                                    Keputusan
                                </p>
                            </div>

                        </div>

                        <div class="mx-3 h-px flex-1 bg-gray-200"></div>


                        {{-- 6. Rujukan / Obat --}}
                        <div class="flex shrink-0 items-center">

                            <div class="flex h-9 w-9 items-center justify-center rounded-full bg-gray-100 text-sm font-bold text-gray-500">
                                6
                            </div>

                            <div class="ml-2">
                                <p class="text-xs font-medium text-gray-400">
                                    06
                                </p>
                                <p class="text-sm text-gray-500">
                                    Rujukan / Obat
                                </p>
                            </div>

                        </div>

                        <div class="mx-3 h-px flex-1 bg-gray-200"></div>


                        {{-- 7. Ringkasan --}}
                        <div class="flex shrink-0 items-center">

                            <div class="flex h-9 w-9 items-center justify-center rounded-full bg-gray-100 text-sm font-bold text-gray-500">
                                7
                            </div>

                            <div class="ml-2">
                                <p class="text-xs font-medium text-gray-400">
                                    07
                                </p>
                                <p class="text-sm text-gray-500">
                                    Ringkasan
                                </p>
                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- ================================= --}}
            {{-- INFORMASI KUNJUNGAN --}}
            {{-- ================================= --}}

            <div class="mb-6 overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-100">

                <div class="border-b border-gray-100 px-6 py-5">

                    <div class="flex items-center gap-3">

                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-50 text-blue-600">

                            <svg class="h-6 w-6" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a3 3 0 006 0M9 5h6"/>

                            </svg>

                        </div>

                        <div>
                            <h3 class="font-bold text-gray-800">
                                Informasi Kunjungan
                            </h3>

                            <p class="text-sm text-gray-500">
                                Data dasar sebelum pemeriksaan
                            </p>
                        </div>

                    </div>

                </div>


                <div class="grid grid-cols-1 gap-5 px-6 py-6 sm:grid-cols-2 lg:grid-cols-4">

                    <div class="rounded-xl bg-gray-50 p-4">

                        <p class="text-xs font-medium uppercase tracking-wide text-gray-400">
                            Kode Kunjungan
                        </p>

                        <p class="mt-2 font-bold text-gray-800">
                            {{ $kunjungan->kode_kunjungan }}
                        </p>

                    </div>


                    <div class="rounded-xl bg-gray-50 p-4">

                        <p class="text-xs font-medium uppercase tracking-wide text-gray-400">
                            Tanggal
                        </p>

                        <p class="mt-2 font-bold text-gray-800">
                            {{ $kunjungan->tanggal?->format('d-m-Y') }}
                        </p>

                    </div>


                    <div class="rounded-xl bg-gray-50 p-4">

                        <p class="text-xs font-medium uppercase tracking-wide text-gray-400">
                            Nama Santri
                        </p>

                        <p class="mt-2 font-bold text-gray-800">
                            {{ $kunjungan->santri?->nama }}
                        </p>

                    </div>


                    <div class="rounded-xl bg-gray-50 p-4">

                        <p class="text-xs font-medium uppercase tracking-wide text-gray-400">
                            Nomor Induk
                        </p>

                        <p class="mt-2 font-bold text-gray-800">
                            {{ $kunjungan->santri?->nomor_induk }}
                        </p>

                    </div>


                    <div class="rounded-xl border border-amber-100 bg-amber-50 p-4 sm:col-span-2 lg:col-span-4">

                        <div class="flex items-start gap-3">

                            <svg class="mt-0.5 h-5 w-5 shrink-0 text-amber-600"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M12 9v4m0 4h.01M10.3 3.9l-8 14A2 2 0 004 21h16a2 2 0 001.7-3.1l-8-14a2 2 0 00-3.4 0z"/>

                            </svg>

                            <div>

                                <p class="text-xs font-semibold uppercase tracking-wide text-amber-700">
                                    Keluhan
                                </p>

                                <p class="mt-1 whitespace-pre-line text-sm leading-6 text-gray-700">
                                    {{ $kunjungan->keluhan }}
                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- ================================= --}}
            {{-- FORM PEMERIKSAAN --}}
            {{-- ================================= --}}

            <form method="POST"
                action="{{ route('pemeriksaan.store', $kunjungan) }}">

                @csrf

                <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-100">

                    {{-- HEADER --}}
                    <div class="border-b border-gray-100 px-6 py-5">

                        <div class="flex items-center gap-3">

                            <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600">

                                <svg class="h-6 w-6"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24">

                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.8"
                                        d="M3 12h3l2-7 4 14 2-7h7"/>

                                </svg>

                            </div>

                            <div>
                                <h3 class="font-bold text-gray-800">
                                    Hasil Pemeriksaan
                                </h3>

                                <p class="text-sm text-gray-500">
                                    Masukkan hasil pemeriksaan tanda vital dan kondisi fisik santri
                                </p>
                            </div>

                        </div>

                    </div>


                    <div class="p-6">


                        {{-- =============================== --}}
                        {{-- TANDA VITAL --}}
                        {{-- =============================== --}}

                        <div class="mb-6">

                            <div class="mb-4">
                                <h4 class="text-sm font-bold uppercase tracking-wide text-gray-700">
                                    Tanda Vital & Pengukuran
                                </h4>

                                <p class="mt-1 text-sm text-gray-500">
                                    Isi data sesuai hasil pemeriksaan.
                                </p>
                            </div>


                            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">


                                {{-- Tekanan Darah --}}
                                <div>

                                    <label for="tekanan_darah"
                                        class="mb-2 block text-sm font-semibold text-gray-700">

                                        Tekanan Darah
                                        <span class="text-red-500">*</span>

                                    </label>

                                    <div class="relative">

                                        <input
                                            type="text"
                                            name="tekanan_darah"
                                            id="tekanan_darah"
                                            value="{{ old('tekanan_darah', $pemeriksaan?->tekanan_darah) }}"
                                            placeholder="120/80"
                                            required
                                            class="block w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3 text-sm shadow-sm focus:border-indigo-500 focus:bg-white focus:ring-indigo-500">

                                    </div>

                                    <p class="mt-1.5 text-xs text-gray-400">
                                        Contoh: 120/80 mmHg
                                    </p>

                                    @error('tekanan_darah')
                                        <p class="mt-1 text-sm text-red-600">
                                            {{ $message }}
                                        </p>
                                    @enderror

                                </div>


                                {{-- Suhu --}}
                                <div>

                                    <label for="suhu"
                                        class="mb-2 block text-sm font-semibold text-gray-700">

                                        Suhu
                                        <span class="text-red-500">*</span>

                                    </label>

                                    <div class="relative">

                                        <input
                                            type="number"
                                            step="0.1"
                                            name="suhu"
                                            id="suhu"
                                            value="{{ old('suhu', $pemeriksaan?->suhu) }}"
                                            placeholder="36.5"
                                            required
                                            class="block w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3 pr-14 text-sm shadow-sm focus:border-indigo-500 focus:bg-white focus:ring-indigo-500">

                                        <span class="absolute right-4 top-1/2 -translate-y-1/2 text-xs font-medium text-gray-400">
                                            °C
                                        </span>

                                    </div>

                                    @error('suhu')
                                        <p class="mt-1 text-sm text-red-600">
                                            {{ $message }}
                                        </p>
                                    @enderror

                                </div>


                                {{-- Nadi --}}
                                <div>

                                    <label for="nadi"
                                        class="mb-2 block text-sm font-semibold text-gray-700">

                                        Nadi

                                    </label>

                                    <div class="relative">

                                        <input
                                            type="number"
                                            name="nadi"
                                            id="nadi"
                                            value="{{ old('nadi', $pemeriksaan?->nadi) }}"
                                            placeholder="80"
                                            class="block w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3 pr-20 text-sm shadow-sm focus:border-indigo-500 focus:bg-white focus:ring-indigo-500">

                                        <span class="absolute right-4 top-1/2 -translate-y-1/2 text-xs font-medium text-gray-400">
                                            x/menit
                                        </span>

                                    </div>

                                    @error('nadi')
                                        <p class="mt-1 text-sm text-red-600">
                                            {{ $message }}
                                        </p>
                                    @enderror

                                </div>


                                {{-- Pernapasan --}}
                                <div>

                                    <label for="pernapasan"
                                        class="mb-2 block text-sm font-semibold text-gray-700">

                                        Pernapasan

                                    </label>

                                    <div class="relative">

                                        <input
                                            type="number"
                                            name="pernapasan"
                                            id="pernapasan"
                                            value="{{ old('pernapasan', $pemeriksaan?->pernapasan) }}"
                                            placeholder="20"
                                            class="block w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3 pr-20 text-sm shadow-sm focus:border-indigo-500 focus:bg-white focus:ring-indigo-500">

                                        <span class="absolute right-4 top-1/2 -translate-y-1/2 text-xs font-medium text-gray-400">
                                            x/menit
                                        </span>

                                    </div>

                                    @error('pernapasan')
                                        <p class="mt-1 text-sm text-red-600">
                                            {{ $message }}
                                        </p>
                                    @enderror

                                </div>


                                {{-- Berat Badan --}}
                                <div>

                                    <label for="berat_badan"
                                        class="mb-2 block text-sm font-semibold text-gray-700">

                                        Berat Badan

                                    </label>

                                    <div class="relative">

                                        <input
                                            type="number"
                                            step="0.01"
                                            name="berat_badan"
                                            id="berat_badan"
                                            value="{{ old('berat_badan', $pemeriksaan?->berat_badan) }}"
                                            placeholder="45.50"
                                            class="block w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3 pr-14 text-sm shadow-sm focus:border-indigo-500 focus:bg-white focus:ring-indigo-500">

                                        <span class="absolute right-4 top-1/2 -translate-y-1/2 text-xs font-medium text-gray-400">
                                            kg
                                        </span>

                                    </div>

                                    @error('berat_badan')
                                        <p class="mt-1 text-sm text-red-600">
                                            {{ $message }}
                                        </p>
                                    @enderror

                                </div>


                                {{-- Tinggi Badan --}}
                                <div>

                                    <label for="tinggi_badan"
                                        class="mb-2 block text-sm font-semibold text-gray-700">

                                        Tinggi Badan

                                    </label>

                                    <div class="relative">

                                        <input
                                            type="number"
                                            step="0.01"
                                            name="tinggi_badan"
                                            id="tinggi_badan"
                                            value="{{ old('tinggi_badan', $pemeriksaan?->tinggi_badan) }}"
                                            placeholder="155.00"
                                            class="block w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3 pr-14 text-sm shadow-sm focus:border-indigo-500 focus:bg-white focus:ring-indigo-500">

                                        <span class="absolute right-4 top-1/2 -translate-y-1/2 text-xs font-medium text-gray-400">
                                            cm
                                        </span>

                                    </div>

                                    @error('tinggi_badan')
                                        <p class="mt-1 text-sm text-red-600">
                                            {{ $message }}
                                        </p>
                                    @enderror

                                </div>

                            </div>

                        </div>


                        {{-- PEMISAH --}}
                        <div class="my-7 border-t border-gray-100"></div>


                        {{-- =============================== --}}
                        {{-- PEMERIKSAAN FISIK --}}
                        {{-- =============================== --}}

                        <div class="mb-6">

                            <label for="pemeriksaan_fisik"
                                class="mb-2 block text-sm font-semibold text-gray-700">

                                Pemeriksaan Fisik

                            </label>

                            <textarea
                                name="pemeriksaan_fisik"
                                id="pemeriksaan_fisik"
                                rows="5"
                                placeholder="Tuliskan hasil pemeriksaan fisik santri..."
                                class="block w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3 text-sm shadow-sm focus:border-indigo-500 focus:bg-white focus:ring-indigo-500">{{ old('pemeriksaan_fisik', $pemeriksaan?->pemeriksaan_fisik) }}</textarea>

                            <p class="mt-1.5 text-xs text-gray-400">
                                Deskripsikan kondisi fisik atau temuan pemeriksaan yang relevan.
                            </p>

                            @error('pemeriksaan_fisik')
                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- =============================== --}}
                        {{-- CATATAN --}}
                        {{-- =============================== --}}

                        <div>

                            <label for="catatan"
                                class="mb-2 block text-sm font-semibold text-gray-700">

                                Catatan Pemeriksaan

                            </label>

                            <textarea
                                name="catatan"
                                id="catatan"
                                rows="4"
                                placeholder="Tambahkan catatan pemeriksaan jika diperlukan..."
                                class="block w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3 text-sm shadow-sm focus:border-indigo-500 focus:bg-white focus:ring-indigo-500">{{ old('catatan', $pemeriksaan?->catatan) }}</textarea>

                            @error('catatan')
                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                    </div>


                    {{-- ================================= --}}
                    {{-- FOOTER ACTION --}}
                    {{-- ================================= --}}

                    <div class="flex flex-col-reverse gap-3 border-t border-gray-100 bg-gray-50/70 px-6 py-5 sm:flex-row sm:items-center sm:justify-between">

                        <a href="{{ route('kunjungan.show', $kunjungan) }}"
                            class="inline-flex items-center justify-center rounded-xl border border-gray-200 bg-white px-5 py-2.5 text-sm font-semibold text-gray-700 shadow-sm hover:bg-gray-50">

                            ← Kembali

                        </a>


                        <button type="submit"
                            class="inline-flex items-center justify-center rounded-xl bg-indigo-600 px-6 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700">

                            Simpan & Lanjut ke Diagnosa

                            <svg class="ml-2 h-4 w-4"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M9 5l7 7-7 7"/>

                            </svg>

                        </button>

                    </div>

                </div>

            </form>

        </div>
    </div>

</x-app-layout>