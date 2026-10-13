<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="text-xl font-bold text-gray-900">
                Keputusan Pelayanan
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Tentukan tindak lanjut pelayanan berdasarkan hasil pemeriksaan.
            </p>
        </div>
    </x-slot>


    <div class="py-6">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- =========================================================
                STEPPER
            ========================================================== --}}
            <div class="bg-white border border-gray-200 rounded-2xl shadow-sm mb-6">

                <div class="px-5 py-5 overflow-x-auto">

                    <div class="flex items-center min-w-max">

                        {{-- 1 Kunjungan --}}
                        <div class="flex items-center">

                            <span class="flex items-center justify-center
                                         w-9 h-9 rounded-full
                                         bg-emerald-500 text-white
                                         text-sm font-bold">
                                ✓
                            </span>

                            <span class="ml-2 text-sm font-semibold text-gray-700">
                                Kunjungan
                            </span>

                        </div>


                        <div class="w-12 h-px bg-emerald-300 mx-3"></div>


                        {{-- 2 Pemeriksaan --}}
                        <div class="flex items-center">

                            <span class="flex items-center justify-center
                                         w-9 h-9 rounded-full
                                         bg-emerald-500 text-white
                                         text-sm font-bold">
                                ✓
                            </span>

                            <span class="ml-2 text-sm font-semibold text-gray-700">
                                Pemeriksaan
                            </span>

                        </div>


                        <div class="w-12 h-px bg-emerald-300 mx-3"></div>


                        {{-- 3 Diagnosa --}}
                        <div class="flex items-center">

                            <span class="flex items-center justify-center
                                         w-9 h-9 rounded-full
                                         bg-emerald-500 text-white
                                         text-sm font-bold">
                                ✓
                            </span>

                            <span class="ml-2 text-sm font-semibold text-gray-700">
                                Diagnosa
                            </span>

                        </div>


                        <div class="w-12 h-px bg-emerald-300 mx-3"></div>


                        {{-- 4 Tindakan --}}
                        <div class="flex items-center">

                            <span class="flex items-center justify-center
                                         w-9 h-9 rounded-full
                                         bg-emerald-500 text-white
                                         text-sm font-bold">
                                ✓
                            </span>

                            <span class="ml-2 text-sm font-semibold text-gray-700">
                                Tindakan
                            </span>

                        </div>


                        <div class="w-12 h-px bg-indigo-300 mx-3"></div>


                        {{-- 5 Keputusan --}}
                        <div class="flex items-center">

                            <span class="flex items-center justify-center
                                         w-9 h-9 rounded-full
                                         bg-indigo-600 text-white
                                         text-sm font-bold shadow-sm">
                                5
                            </span>

                            <span class="ml-2 text-sm font-bold text-indigo-600">
                                Keputusan
                            </span>

                        </div>


                        <div class="w-12 h-px bg-gray-200 mx-3"></div>


                        {{-- 6 Rujukan / Obat --}}
                        <div class="flex items-center text-gray-400">

                            <span class="flex items-center justify-center
                                         w-9 h-9 rounded-full
                                         bg-gray-100
                                         text-sm font-semibold">
                                6
                            </span>

                            <span class="ml-2 text-sm font-medium">
                                Rujukan / Obat
                            </span>

                        </div>


                        <div class="w-12 h-px bg-gray-200 mx-3"></div>


                        {{-- 7 Ringkasan --}}
                        <div class="flex items-center text-gray-400">

                            <span class="flex items-center justify-center
                                         w-9 h-9 rounded-full
                                         bg-gray-100
                                         text-sm font-semibold">
                                7
                            </span>

                            <span class="ml-2 text-sm font-medium">
                                Ringkasan
                            </span>

                        </div>

                    </div>

                </div>

            </div>


            {{-- =========================================================
                INFORMASI KUNJUNGAN
            ========================================================== --}}
            <div class="bg-white border border-gray-200 rounded-2xl shadow-sm mb-6 overflow-hidden">

                <div class="px-6 py-5 border-b border-gray-100">

                    <div class="flex items-center gap-3">

                        <div class="w-10 h-10 rounded-xl bg-indigo-50
                                    flex items-center justify-center">

                            <svg class="w-5 h-5 text-indigo-600"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />

                            </svg>

                        </div>

                        <div>

                            <h3 class="text-base font-bold text-gray-900">
                                Informasi Kunjungan
                            </h3>

                            <p class="text-sm text-gray-500">
                                Data dasar pelayanan santri
                            </p>

                        </div>

                    </div>

                </div>


                <div class="p-6">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                        <div>

                            <p class="text-xs font-medium uppercase
                                      tracking-wide text-gray-400">
                                Kode Kunjungan
                            </p>

                            <p class="mt-1 font-semibold text-gray-900">
                                {{ $kunjungan->kode_kunjungan }}
                            </p>

                        </div>


                        <div>

                            <p class="text-xs font-medium uppercase
                                      tracking-wide text-gray-400">
                                Nama Santri
                            </p>

                            <p class="mt-1 font-semibold text-gray-900">
                                {{ $kunjungan->santri?->nama }}
                            </p>

                        </div>


                        <div>

                            <p class="text-xs font-medium uppercase
                                      tracking-wide text-gray-400">
                                Nomor Induk
                            </p>

                            <p class="mt-1 font-semibold text-gray-900">
                                {{ $kunjungan->santri?->nomor_induk }}
                            </p>

                        </div>


                        <div>

                            <p class="text-xs font-medium uppercase
                                      tracking-wide text-gray-400">
                                Keluhan
                            </p>

                            <p class="mt-1 font-medium text-gray-700">
                                {{ $kunjungan->keluhan ?: '-' }}
                            </p>

                        </div>

                    </div>

                </div>

            </div>


            {{-- =========================================================
                KEPUTUSAN PELAYANAN
            ========================================================== --}}
            <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">

                <div class="px-6 py-5 border-b border-gray-100">

                    <div class="flex items-start gap-3">

                        <div class="w-10 h-10 rounded-xl bg-amber-50
                                    flex items-center justify-center
                                    flex-shrink-0">

                            <svg class="w-5 h-5 text-amber-600"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M8 9l3 3-3 3m5-6h3m-8 9h8a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v11a2 2 0 002 2z" />

                            </svg>

                        </div>

                        <div>

                            <h3 class="text-base font-bold text-gray-900">
                                Keputusan Pelayanan
                            </h3>

                            <p class="mt-1 text-sm text-gray-500">
                                Tentukan tindak lanjut pelayanan untuk santri ini.
                            </p>

                        </div>

                    </div>

                </div>


                <div class="p-6">

                    {{-- =================================================
                        ERROR
                    ================================================== --}}
                    @if ($errors->any())

                        <div class="mb-6 rounded-xl bg-red-50
                                    border border-red-200 p-4">

                            <div class="flex gap-3">

                                <svg class="w-5 h-5 text-red-500 flex-shrink-0"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24">

                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 8v4m0 4h.01M12 3a9 9 0 110 18 9 9 0 010-18z" />

                                </svg>

                                <ul class="list-disc list-inside text-sm text-red-700">

                                    @foreach ($errors->all() as $error)

                                        <li>
                                            {{ $error }}
                                        </li>

                                    @endforeach

                                </ul>

                            </div>

                        </div>

                    @endif


                    {{-- =================================================
                        PILIHAN 1 — RUJUKAN
                    ================================================== --}}
                    <form
                        method="POST"
                        action="{{ route('kunjungan-keputusan.store', $kunjungan) }}"
                        class="mb-5">

                        @csrf

                        <input
                            type="hidden"
                            name="perlu_rujukan"
                            value="1">


                        <div class="border border-blue-200
                                    bg-blue-50/40
                                    rounded-2xl p-5">

                            <div class="flex items-start gap-4">

                                <div class="w-11 h-11 rounded-xl
                                            bg-blue-100
                                            flex items-center justify-center
                                            flex-shrink-0">

                                    <svg class="w-5 h-5 text-blue-600"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24">

                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />

                                    </svg>

                                </div>


                                <div class="flex-1">

                                    <h4 class="font-bold text-gray-900">
                                        Perlu Rujukan
                                    </h4>

                                    <p class="mt-1 text-sm text-gray-600">
                                        Santri perlu dirujuk ke fasilitas kesehatan lain.
                                    </p>


                                    <button
                                        type="submit"
                                        class="mt-5 inline-flex items-center
                                               justify-center px-5 py-2.5
                                               rounded-xl bg-blue-600
                                               text-white text-sm font-semibold
                                               hover:bg-blue-700
                                               focus:outline-none
                                               focus:ring-2
                                               focus:ring-blue-500
                                               focus:ring-offset-2
                                               transition">

                                        Lanjut ke Rujukan

                                        <span class="ml-2">
                                            →
                                        </span>

                                    </button>

                                </div>

                            </div>

                        </div>

                    </form>


                    {{-- =================================================
                        PILIHAN 2 — TIDAK RUJUK
                    ================================================== --}}
                    <form
                        method="POST"
                        action="{{ route('kunjungan-keputusan.store', $kunjungan) }}">

                        @csrf

                        <input
                            type="hidden"
                            name="perlu_rujukan"
                            value="0">


                        <div class="border border-gray-200
                                    rounded-2xl p-5">

                            <div class="flex items-start gap-4">

                                <div class="w-11 h-11 rounded-xl
                                            bg-emerald-50
                                            flex items-center justify-center
                                            flex-shrink-0">

                                    <svg class="w-5 h-5 text-emerald-600"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24">

                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M5 13l4 4L19 7" />

                                    </svg>

                                </div>


                                <div class="flex-1">

                                    <h4 class="font-bold text-gray-900">
                                        Tidak Perlu Rujukan
                                    </h4>

                                    <p class="mt-1 text-sm text-gray-600">
                                        Pelayanan dapat dilanjutkan di poliklinik.
                                    </p>


                                    {{-- PERLU OBAT --}}
                                    <div class="mt-5">

                                        <label
                                            for="perlu_obat"
                                            class="block text-sm font-semibold text-gray-700 mb-2">

                                            Apakah santri perlu mendapatkan obat?

                                        </label>


                                        <select
                                            name="perlu_obat"
                                            id="perlu_obat"
                                            required
                                            class="block w-full rounded-xl
                                                   border-gray-300
                                                   focus:border-indigo-500
                                                   focus:ring-indigo-500
                                                   shadow-sm">

                                            <option value="">
                                                -- Pilih keputusan obat --
                                            </option>

                                            <option
                                                value="1"
                                                {{ old('perlu_obat', $kunjungan->perlu_obat) === true ? 'selected' : '' }}>

                                                Ya, Perlu Obat

                                            </option>

                                            <option
                                                value="0"
                                                {{ old('perlu_obat', $kunjungan->perlu_obat) === false ? 'selected' : '' }}>

                                                Tidak Perlu Obat

                                            </option>

                                        </select>

                                        <p class="mt-2 text-xs text-gray-400">
                                            Pilihan ini menentukan apakah proses dilanjutkan ke resep obat.
                                        </p>

                                    </div>


                                    <button
                                        type="submit"
                                        class="mt-5 inline-flex items-center
                                               justify-center px-5 py-2.5
                                               rounded-xl bg-indigo-600
                                               text-white text-sm font-semibold
                                               hover:bg-indigo-700
                                               focus:outline-none
                                               focus:ring-2
                                               focus:ring-indigo-500
                                               focus:ring-offset-2
                                               transition">

                                        Simpan Keputusan

                                        <span class="ml-2">
                                            →
                                        </span>

                                    </button>

                                </div>

                            </div>

                        </div>

                    </form>


                    {{-- =================================================
                        KEMBALI
                    ================================================== --}}
                    <div class="mt-8 pt-6 border-t border-gray-100">

                        <a
                            href="{{ route('kunjungan-tindakan.create', $kunjungan) }}"
                            class="inline-flex items-center
                                   px-4 py-2.5
                                   rounded-xl
                                   border border-gray-300
                                   bg-white
                                   text-gray-700
                                   text-sm font-medium
                                   hover:bg-gray-50
                                   transition">

                            ← Kembali ke Tindakan

                        </a>

                    </div>

                </div>

            </div>

        </div>
    </div>

</x-app-layout>