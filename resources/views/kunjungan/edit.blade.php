<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="text-xl font-semibold text-slate-800">
                Edit Kunjungan
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                Perbarui data dasar kunjungan pelayanan santri.
            </p>
        </div>
    </x-slot>


    <div class="min-h-screen bg-slate-50 py-6">

        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">

            {{-- BREADCRUMB --}}
            <div class="mb-5 flex items-center gap-2 text-sm text-slate-500">

                <a href="{{ route('kunjungan.index') }}"
                    class="transition hover:text-indigo-600">
                    Kunjungan
                </a>

                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-4 w-4 text-slate-400"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M9 5l7 7-7 7" />
                </svg>

                <a href="{{ route('kunjungan.show', $kunjungan) }}"
                    class="transition hover:text-indigo-600">
                    Detail
                </a>

                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-4 w-4 text-slate-400"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M9 5l7 7-7 7" />
                </svg>

                <span class="font-medium text-slate-700">
                    Edit
                </span>

            </div>


            {{-- MAIN CARD --}}
            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                {{-- HEADER --}}
                <div class="border-b border-slate-100 px-5 py-5 sm:px-7">

                    <div class="flex items-start gap-4">

                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-amber-100 text-amber-600">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-6 w-6"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="1.8">
                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M16.862 3.487a2.1 2.1 0 013.001 3.001L7.5 18.85 3 20l1.15-4.5L16.862 3.487z" />
                            </svg>

                        </div>

                        <div class="min-w-0">

                            <h1 class="text-lg font-semibold text-slate-800">
                                Perbarui Data Kunjungan
                            </h1>

                            <div class="mt-1 flex flex-wrap items-center gap-2">

                                <span class="text-sm text-slate-500">
                                    Kode:
                                </span>

                                <span class="rounded-lg bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-700">
                                    {{ $kunjungan->kode_kunjungan }}
                                </span>

                            </div>

                        </div>

                    </div>

                </div>


                <form method="POST"
                    action="{{ route('kunjungan.update', $kunjungan) }}">

                    @csrf
                    @method('PUT')


                    <div class="p-5 sm:p-7">

                        {{-- ======================================== --}}
                        {{-- DATA KUNJUNGAN --}}
                        {{-- ======================================== --}}

                        <div class="mb-7">

                            <div class="mb-5 flex items-center gap-3">

                                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-indigo-100 text-indigo-600">

                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="1.8">
                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a3 3 0 006 0" />
                                    </svg>

                                </div>

                                <div>

                                    <h3 class="text-sm font-semibold text-slate-800">
                                        Informasi Kunjungan
                                    </h3>

                                    <p class="text-xs text-slate-500">
                                        Data dasar kunjungan yang dapat diperbarui.
                                    </p>

                                </div>

                            </div>


                            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">

                                {{-- SANTRI --}}
                                <div>

                                    <label for="santri_id"
                                        class="mb-1.5 block text-sm font-medium text-slate-700">
                                        Santri
                                    </label>

                                    <select
                                        name="santri_id"
                                        id="santri_id"
                                        required
                                        class="block w-full rounded-xl border-slate-200 py-2.5 text-sm text-slate-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    >

                                        @foreach ($santris as $santri)

                                            <option
                                                value="{{ $santri->id }}"
                                                {{ old('santri_id', $kunjungan->santri_id) == $santri->id ? 'selected' : '' }}
                                            >
                                                {{ $santri->nomor_induk }} — {{ $santri->nama }}
                                            </option>

                                        @endforeach

                                    </select>

                                    @error('santri_id')
                                        <p class="mt-1.5 text-xs text-red-600">
                                            {{ $message }}
                                        </p>
                                    @enderror

                                </div>


                                {{-- PETUGAS --}}
                                <div>

                                    <label for="petugas_id"
                                        class="mb-1.5 block text-sm font-medium text-slate-700">
                                        Petugas
                                    </label>

                                    <select
                                        name="petugas_id"
                                        id="petugas_id"
                                        required
                                        class="block w-full rounded-xl border-slate-200 py-2.5 text-sm text-slate-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    >

                                        @foreach ($petugas as $user)

                                            <option
                                                value="{{ $user->id }}"
                                                {{ old('petugas_id', $kunjungan->petugas_id) == $user->id ? 'selected' : '' }}
                                            >
                                                {{ $user->name }}
                                            </option>

                                        @endforeach

                                    </select>

                                    @error('petugas_id')
                                        <p class="mt-1.5 text-xs text-red-600">
                                            {{ $message }}
                                        </p>
                                    @enderror

                                </div>


                                {{-- TANGGAL --}}
                                <div>

                                    <label for="tanggal"
                                        class="mb-1.5 block text-sm font-medium text-slate-700">
                                        Tanggal
                                    </label>

                                    <input
                                        type="date"
                                        name="tanggal"
                                        id="tanggal"
                                        value="{{ old('tanggal', $kunjungan->tanggal?->format('Y-m-d')) }}"
                                        required
                                        class="block w-full rounded-xl border-slate-200 py-2.5 text-sm text-slate-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    >

                                    @error('tanggal')
                                        <p class="mt-1.5 text-xs text-red-600">
                                            {{ $message }}
                                        </p>
                                    @enderror

                                </div>


                                {{-- WAKTU --}}
                                <div>

                                    <label for="waktu"
                                        class="mb-1.5 block text-sm font-medium text-slate-700">
                                        Waktu
                                    </label>

                                    <input
                                        type="time"
                                        name="waktu"
                                        id="waktu"
                                        value="{{ old('waktu', $kunjungan->waktu) }}"
                                        required
                                        class="block w-full rounded-xl border-slate-200 py-2.5 text-sm text-slate-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    >

                                    @error('waktu')
                                        <p class="mt-1.5 text-xs text-red-600">
                                            {{ $message }}
                                        </p>
                                    @enderror

                                </div>

                            </div>

                        </div>


                        {{-- ======================================== --}}
                        {{-- KELUHAN & CATATAN --}}
                        {{-- ======================================== --}}

                        <div class="mb-7 border-t border-slate-100 pt-7">

                            <div class="mb-5 flex items-center gap-3">

                                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-rose-100 text-rose-600">

                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="1.8">
                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M8 10h8M8 14h5M5 4h14a2 2 0 012 2v9a2 2 0 01-2 2h-4l-3 3-3-3H5a2 2 0 01-2-2V6a2 2 0 012-2z" />
                                    </svg>

                                </div>

                                <div>

                                    <h3 class="text-sm font-semibold text-slate-800">
                                        Keluhan & Catatan
                                    </h3>

                                    <p class="text-xs text-slate-500">
                                        Perbarui informasi yang disampaikan saat kunjungan.
                                    </p>

                                </div>

                            </div>


                            {{-- KELUHAN --}}
                            <div class="mb-5">

                                <label for="keluhan"
                                    class="mb-1.5 block text-sm font-medium text-slate-700">
                                    Keluhan
                                </label>

                                <textarea
                                    name="keluhan"
                                    id="keluhan"
                                    rows="4"
                                    required
                                    placeholder="Tuliskan keluhan santri..."
                                    class="block w-full rounded-xl border-slate-200 text-sm text-slate-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                >{{ old('keluhan', $kunjungan->keluhan) }}</textarea>

                                @error('keluhan')
                                    <p class="mt-1.5 text-xs text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>


                            {{-- CATATAN --}}
                            <div>

                                <label for="catatan"
                                    class="mb-1.5 block text-sm font-medium text-slate-700">
                                    Catatan
                                </label>

                                <textarea
                                    name="catatan"
                                    id="catatan"
                                    rows="3"
                                    placeholder="Catatan tambahan jika diperlukan..."
                                    class="block w-full rounded-xl border-slate-200 text-sm text-slate-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                >{{ old('catatan', $kunjungan->catatan) }}</textarea>

                                @error('catatan')
                                    <p class="mt-1.5 text-xs text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>

                        </div>


                        {{-- ======================================== --}}
                        {{-- STATUS --}}
                        {{-- ======================================== --}}

                        <div class="border-t border-slate-100 pt-7">

                            <div class="mb-5 flex items-center gap-3">

                                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-slate-100 text-slate-600">

                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="1.8">
                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 3c-2.755 0-5.29.927-7.328 2.484A11.953 11.953 0 003 12c0 2.755.927 5.29 2.484 7.328A11.953 11.953 0 0012 21c2.755 0 5.29-.927 7.328-2.484A11.953 11.953 0 0021 12c0-2.755-.927-5.29-2.382-6.484z" />
                                    </svg>

                                </div>

                                <div>

                                    <h3 class="text-sm font-semibold text-slate-800">
                                        Status Kunjungan
                                    </h3>

                                    <p class="text-xs text-slate-500">
                                        Tentukan status proses kunjungan.
                                    </p>

                                </div>

                            </div>


                            <select
                                name="status"
                                id="status"
                                required
                                class="block w-full rounded-xl border-slate-200 py-2.5 text-sm text-slate-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            >

                                <option value="menunggu"
                                    {{ old('status', $kunjungan->status) === 'menunggu' ? 'selected' : '' }}>
                                    Menunggu
                                </option>

                                <option value="diperiksa"
                                    {{ old('status', $kunjungan->status) === 'diperiksa' ? 'selected' : '' }}>
                                    Diperiksa
                                </option>

                                <option value="selesai"
                                    {{ old('status', $kunjungan->status) === 'selesai' ? 'selected' : '' }}>
                                    Selesai
                                </option>

                                <option value="dibatalkan"
                                    {{ old('status', $kunjungan->status) === 'dibatalkan' ? 'selected' : '' }}>
                                    Dibatalkan
                                </option>

                            </select>

                            @error('status')
                                <p class="mt-1.5 text-xs text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror


                            {{-- WARNING --}}
                            @if ($kunjungan->status === 'selesai')

                                <div class="mt-4 flex items-start gap-3 rounded-xl border border-amber-200 bg-amber-50 px-4 py-3">

                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="mt-0.5 h-5 w-5 shrink-0 text-amber-600"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="1.8">
                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M12 9v4m0 4h.01M10.29 3.86l-8.18 14A2 2 0 003.83 21h16.34a2 2 0 001.72-3.14l-8.18-14a2 2 0 00-3.42 0z" />
                                    </svg>

                                    <div>

                                        <p class="text-sm font-semibold text-amber-800">
                                            Kunjungan sudah selesai
                                        </p>

                                        <p class="mt-0.5 text-xs leading-5 text-amber-700">
                                            Perubahan data kunjungan yang sudah selesai sebaiknya dilakukan dengan hati-hati agar tidak mengubah alur rekam medis.
                                        </p>

                                    </div>

                                </div>

                            @endif

                        </div>

                    </div>


                    {{-- ACTION --}}
                    <div class="flex flex-col-reverse gap-3 border-t border-slate-100 bg-slate-50/60 px-5 py-5 sm:flex-row sm:items-center sm:justify-between sm:px-7">

                        <a
                            href="{{ route('kunjungan.show', $kunjungan) }}"
                            class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-50"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-4 w-4"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2">
                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>

                            Batal
                        </a>


                        <button
                            type="submit"
                            class="inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700 hover:shadow-md"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-4 w-4"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2">
                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M5 13l4 4L19 7" />
                            </svg>

                            Simpan Perubahan
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>