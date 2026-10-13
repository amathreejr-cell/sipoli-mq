<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Pilihan Rujukan
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            {{-- Stepper --}}
            <div class="bg-white shadow-sm sm:rounded-lg mb-6">
                <div class="p-4 overflow-x-auto">
                    <div class="flex items-center min-w-max text-sm">

                        {{-- 1 Kunjungan --}}
                        <div class="flex items-center">
                            <span class="flex items-center justify-center w-8 h-8 rounded-full bg-green-600 text-white font-semibold">
                                ✓
                            </span>
                            <span class="ml-2 font-medium text-gray-700">
                                Kunjungan
                            </span>
                        </div>

                        <div class="flex-1 h-px bg-gray-300 mx-3 w-10"></div>

                        {{-- 2 Pemeriksaan --}}
                        <div class="flex items-center">
                            <span class="flex items-center justify-center w-8 h-8 rounded-full bg-green-600 text-white font-semibold">
                                ✓
                            </span>
                            <span class="ml-2 font-medium text-gray-700">
                                Pemeriksaan
                            </span>
                        </div>

                        <div class="flex-1 h-px bg-gray-300 mx-3 w-10"></div>

                        {{-- 3 Diagnosa --}}
                        <div class="flex items-center">
                            <span class="flex items-center justify-center w-8 h-8 rounded-full bg-green-600 text-white font-semibold">
                                ✓
                            </span>
                            <span class="ml-2 font-medium text-gray-700">
                                Diagnosa
                            </span>
                        </div>

                        <div class="flex-1 h-px bg-gray-300 mx-3 w-10"></div>

                        {{-- 4 Tindakan --}}
                        <div class="flex items-center">
                            <span class="flex items-center justify-center w-8 h-8 rounded-full bg-green-600 text-white font-semibold">
                                ✓
                            </span>
                            <span class="ml-2 font-medium text-gray-700">
                                Tindakan
                            </span>
                        </div>

                        <div class="flex-1 h-px bg-gray-300 mx-3 w-10"></div>

                        {{-- 5 Obat --}}
                        <div class="flex items-center">
                            <span class="flex items-center justify-center w-8 h-8 rounded-full bg-green-600 text-white font-semibold">
                                ✓
                            </span>
                            <span class="ml-2 font-medium text-gray-700">
                                Obat
                            </span>
                        </div>

                        <div class="flex-1 h-px bg-gray-300 mx-3 w-10"></div>

                        {{-- 6 Rujukan --}}
                        <div class="flex items-center">
                            <span class="flex items-center justify-center w-8 h-8 rounded-full bg-blue-600 text-white font-semibold">
                                6
                            </span>
                            <span class="ml-2 font-medium text-blue-600">
                                Rujukan
                            </span>
                        </div>

                        <div class="flex-1 h-px bg-gray-300 mx-3 w-10"></div>

                        {{-- 7 Ringkasan --}}
                        <div class="flex items-center text-gray-400">
                            <span class="flex items-center justify-center w-8 h-8 rounded-full bg-gray-200 font-semibold">
                                7
                            </span>
                            <span class="ml-2">
                                Ringkasan
                            </span>
                        </div>

                    </div>
                </div>
            </div>

            {{-- Informasi Kunjungan --}}
            <div class="bg-white shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">

                    <h3 class="text-lg font-semibold text-gray-800 mb-4">
                        Informasi Kunjungan
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <div>
                            <p class="text-sm text-gray-500">Kode Kunjungan</p>
                            <p class="font-medium">
                                {{ $kunjungan->kode_kunjungan }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">Nama Santri</p>
                            <p class="font-medium">
                                {{ $kunjungan->santri?->nama }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">Nomor Induk</p>
                            <p class="font-medium">
                                {{ $kunjungan->santri?->nomor_induk }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">Keluhan</p>
                            <p class="font-medium">
                                {{ $kunjungan->keluhan }}
                            </p>
                        </div>

                    </div>

                </div>
            </div>

            {{-- Pilihan --}}
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">

                    <h3 class="text-lg font-semibold text-gray-800 mb-2">
                        Apakah Perlu Rujukan?
                    </h3>

                    <p class="text-sm text-gray-500 mb-6">
                        Tentukan apakah santri perlu dirujuk ke fasilitas kesehatan lain.
                    </p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        {{-- Tidak perlu rujukan --}}
                        <a href="#"
                            class="block border border-gray-200 rounded-lg p-6 hover:bg-gray-50 transition">
                            <h4 class="text-lg font-semibold text-gray-800">
                                Tidak Perlu Rujukan
                            </h4>

                            <p class="mt-2 text-sm text-gray-500">
                                Lanjutkan langsung ke halaman ringkasan kunjungan.
                            </p>

                            <div class="mt-4 text-sm font-medium text-blue-600">
                                Lanjut ke Ringkasan →
                            </div>
                        </a>

                        {{-- Perlu rujukan --}}
                        <a href="{{ route('rujukan.create', $kunjungan) }}"
                            class="block border border-gray-200 rounded-lg p-6 hover:bg-gray-50 transition">
                            <h4 class="text-lg font-semibold text-gray-800">
                                Perlu Rujukan
                            </h4>

                            <p class="mt-2 text-sm text-gray-500">
                                Isi data fasilitas kesehatan tujuan dan informasi rujukan.
                            </p>

                            <div class="mt-4 text-sm font-medium text-blue-600">
                                Buat Rujukan →
                            </div>
                        </a>

                    </div>

                    <div class="mt-8">
                        <a href="{{ route('kunjungan-resep.create', $kunjungan) }}"
                            class="inline-flex px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">
                            ← Kembali ke Obat
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>