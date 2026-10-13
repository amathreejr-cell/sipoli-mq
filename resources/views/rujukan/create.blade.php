<x-app-layout>

    <x-slot name="header">
        <div>
            <p class="text-sm text-gray-500">Pelayanan Poliklinik</p>
            <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                Rujukan Santri
            </h2>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Stepper --}}
            <div class="bg-white border border-gray-200 rounded-2xl shadow-sm mb-6">

                <div class="px-5 py-5 overflow-x-auto">

                    <div class="flex items-center min-w-max">

                        @php
                            $steps = [
                                ['label' => 'Kunjungan', 'number' => 1],
                                ['label' => 'Pemeriksaan', 'number' => 2],
                                ['label' => 'Diagnosa', 'number' => 3],
                                ['label' => 'Tindakan', 'number' => 4],
                                ['label' => 'Keputusan', 'number' => 5],
                            ];
                        @endphp


                        @foreach ($steps as $step)

                            <div class="flex items-center">

                                <span class="flex items-center justify-center
                                             w-9 h-9 rounded-full
                                             bg-emerald-500 text-white
                                             text-sm font-bold">
                                    ✓
                                </span>

                                <span class="ml-2 text-sm font-semibold text-gray-700">
                                    {{ $step['label'] }}
                                </span>

                            </div>

                            <div class="w-12 h-px bg-emerald-300 mx-3"></div>

                        @endforeach


                        {{-- 6 --}}
                        <div class="flex items-center">

                            <span class="flex items-center justify-center
                                         w-9 h-9 rounded-full
                                         bg-indigo-600 text-white
                                         text-sm font-bold shadow-sm">
                                6
                            </span>

                            <span class="ml-2 text-sm font-bold text-indigo-600">
                                Rujukan / Obat
                            </span>

                        </div>


                        <div class="w-12 h-px bg-gray-200 mx-3"></div>


                        {{-- 7 --}}
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


            {{-- Error --}}
            @if($errors->any())
                <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 p-4">
                    <div class="flex gap-3">
                        <div class="text-red-600 text-lg">⚠</div>

                        <div>
                            <p class="font-semibold text-red-800">
                                Data belum dapat disimpan
                            </p>

                            <ul class="mt-2 list-disc list-inside text-sm text-red-700 space-y-1">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif


            {{-- Header halaman --}}
            <div class="mb-6">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

                    <div>
                        <div class="flex items-center gap-2 mb-2">
                            <span class="inline-flex items-center justify-center w-9 h-9 rounded-xl bg-indigo-100 text-indigo-600">
                                ↗
                            </span>

                            <span class="text-sm font-medium text-indigo-600">
                                Keputusan Pelayanan
                            </span>
                        </div>

                        <h1 class="text-2xl font-bold text-gray-900">
                            Data Rujukan
                        </h1>

                        <p class="mt-1 text-sm text-gray-500">
                            Lengkapi data rujukan apabila santri perlu mendapatkan
                            pelayanan di fasilitas kesehatan lain.
                        </p>
                    </div>

                </div>
            </div>


            {{-- Data Kunjungan --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm mb-6 overflow-hidden">

                <div class="px-6 py-5 border-b border-gray-100">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
                            👤
                        </div>

                        <div>
                            <h3 class="font-semibold text-gray-900">
                                Data Kunjungan
                            </h3>

                            <p class="text-sm text-gray-500">
                                Informasi santri yang sedang diproses
                            </p>
                        </div>
                    </div>
                </div>

                <div class="p-6">

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">

                        <div>
                            <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">
                                Kode Kunjungan
                            </p>

                            <p class="mt-1 font-semibold text-gray-900">
                                {{ $kunjungan->kode_kunjungan }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">
                                Santri
                            </p>

                            <p class="mt-1 font-semibold text-gray-900">
                                {{ $kunjungan->santri->nama }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">
                                Nomor Induk
                            </p>

                            <p class="mt-1 text-gray-700">
                                {{ $kunjungan->santri->nomor_induk }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">
                                Keluhan
                            </p>

                            <p class="mt-1 text-gray-700">
                                {{ $kunjungan->keluhan }}
                            </p>
                        </div>

                    </div>

                </div>
            </div>


            {{-- Form Rujukan --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">

                <div class="px-6 py-5 border-b border-gray-100">
                    <div class="flex items-start gap-3">

                        <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center">
                            🏥
                        </div>

                        <div>
                            <h3 class="font-semibold text-gray-900">
                                Informasi Rujukan
                            </h3>

                            <p class="text-sm text-gray-500 mt-1">
                                Tentukan fasilitas tujuan dan lengkapi informasi
                                rujukan santri.
                            </p>
                        </div>

                    </div>
                </div>


                <form
                    action="{{ route('rujukan.store', $kunjungan) }}"
                    method="POST"
                >
                    @csrf

                    <div class="p-6 space-y-6">

                        {{-- Fasilitas Tujuan --}}
                        <div>
                            <label
                                for="rujukan_id"
                                class="block text-sm font-semibold text-gray-700 mb-2"
                            >
                                Fasilitas Tujuan
                                <span class="text-red-500">*</span>
                            </label>

                            <select
                                id="rujukan_id"
                                name="rujukan_id"
                                required
                                class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                            >
                                <option value="">
                                    -- Pilih Fasilitas Rujukan --
                                </option>

                                @foreach($masterRujukans as $masterRujukan)
                                    <option
                                        value="{{ $masterRujukan->id }}"
                                        {{ old('rujukan_id', $rujukan?->rujukan_id) == $masterRujukan->id ? 'selected' : '' }}
                                    >
                                        {{ $masterRujukan->nama_fasilitas }}
                                    </option>
                                @endforeach
                            </select>

                            @if($masterRujukans->isEmpty())
                                <div class="mt-3 rounded-xl bg-red-50 border border-red-200 p-3">
                                    <p class="text-sm text-red-700">
                                        Belum ada fasilitas rujukan aktif.
                                        Silakan tambahkan fasilitas terlebih dahulu.
                                    </p>
                                </div>
                            @endif

                            @error('rujukan_id')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>


                        {{-- Tanggal + Status --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            {{-- Tanggal --}}
                            <div>
                                <label
                                    for="tanggal_rujukan"
                                    class="block text-sm font-semibold text-gray-700 mb-2"
                                >
                                    Tanggal Rujukan
                                    <span class="text-red-500">*</span>
                                </label>

                                <input
                                    type="date"
                                    id="tanggal_rujukan"
                                    name="tanggal_rujukan"
                                    value="{{ old('tanggal_rujukan', $rujukan?->tanggal_rujukan?->format('Y-m-d') ?? now()->format('Y-m-d')) }}"
                                    required
                                    class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                >

                                @error('tanggal_rujukan')
                                    <p class="mt-2 text-sm text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>


                            {{-- Status --}}
                            <div>
                                <label
                                    for="status"
                                    class="block text-sm font-semibold text-gray-700 mb-2"
                                >
                                    Status Rujukan
                                    <span class="text-red-500">*</span>
                                </label>

                                <select
                                    id="status"
                                    name="status"
                                    required
                                    class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                >
                                    <option
                                        value="direncanakan"
                                        {{ old('status', $rujukan?->status ?? 'direncanakan') === 'direncanakan' ? 'selected' : '' }}
                                    >
                                        Direncanakan
                                    </option>

                                    <option
                                        value="dirujuk"
                                        {{ old('status', $rujukan?->status) === 'dirujuk' ? 'selected' : '' }}
                                    >
                                        Dirujuk
                                    </option>

                                    <option
                                        value="selesai"
                                        {{ old('status', $rujukan?->status) === 'selesai' ? 'selected' : '' }}
                                    >
                                        Selesai
                                    </option>

                                    <option
                                        value="dibatalkan"
                                        {{ old('status', $rujukan?->status) === 'dibatalkan' ? 'selected' : '' }}
                                    >
                                        Dibatalkan
                                    </option>
                                </select>

                                @error('status')
                                    <p class="mt-2 text-sm text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                        </div>


                        {{-- Alasan --}}
                        <div>
                            <label
                                for="alasan"
                                class="block text-sm font-semibold text-gray-700 mb-2"
                            >
                                Alasan Rujukan
                                <span class="text-red-500">*</span>
                            </label>

                            <textarea
                                id="alasan"
                                name="alasan"
                                rows="4"
                                required
                                placeholder="Jelaskan alasan santri perlu dirujuk..."
                                class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                            >{{ old('alasan', $rujukan?->alasan) }}</textarea>

                            @error('alasan')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>


                        {{-- Keterangan --}}
                        <div>
                            <label
                                for="keterangan"
                                class="block text-sm font-semibold text-gray-700 mb-2"
                            >
                                Keterangan
                            </label>

                            <textarea
                                id="keterangan"
                                name="keterangan"
                                rows="3"
                                placeholder="Keterangan tambahan jika ada..."
                                class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                            >{{ old('keterangan', $rujukan?->keterangan) }}</textarea>

                            @error('keterangan')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                    </div>


                    {{-- Footer --}}
                    <div class="px-6 py-5 bg-gray-50 border-t border-gray-100">

                        <div class="flex flex-col-reverse sm:flex-row sm:items-center sm:justify-between gap-3">

                            <a
                                href="{{ route('kunjungan-keputusan.create', $kunjungan) }}"
                                class="inline-flex items-center justify-center px-5 py-2.5 rounded-xl bg-white border border-gray-300 text-sm font-medium text-gray-700 hover:bg-gray-100 transition"
                            >
                                ← Kembali ke Keputusan
                            </a>

                            <button
                                type="submit"
                                class="inline-flex items-center justify-center px-6 py-2.5 rounded-xl bg-indigo-600 text-white text-sm font-semibold hover:bg-indigo-700 transition shadow-sm"
                            >
                                Simpan & Lanjut ke Ringkasan →
                            </button>

                        </div>

                    </div>

                </form>

            </div>

        </div>
    </div>

</x-app-layout>