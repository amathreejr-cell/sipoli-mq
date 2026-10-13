<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-xl font-bold text-gray-800">
                Edit Tindakan
            </h2>
            <p class="mt-1 text-sm text-gray-500">
                Perbarui informasi tindakan pelayanan yang tersimpan.
            </p>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Header --}}
            <div class="mb-6 overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
                <div class="bg-gradient-to-r from-emerald-50 to-white px-6 py-6 sm:px-8">
                    <div class="flex items-center gap-4">

                        <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600">
                            <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"
                                />
                            </svg>
                        </div>

                        <div>
                            <p class="text-sm font-medium text-emerald-600">
                                Master Data
                            </p>

                            <h3 class="mt-1 text-xl font-bold text-gray-900">
                                Edit Tindakan
                            </h3>

                            <p class="mt-1 text-sm text-gray-500">
                                {{ $tindakan->kode }} — {{ $tindakan->nama }}
                            </p>
                        </div>

                    </div>
                </div>
            </div>


            {{-- Form --}}
            <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

                <div class="border-b border-gray-100 px-6 py-5 sm:px-8">
                    <h3 class="font-bold text-gray-900">
                        Informasi Tindakan
                    </h3>

                    <p class="mt-1 text-sm text-gray-500">
                        Silakan perbarui data tindakan sesuai kebutuhan.
                    </p>
                </div>

                <form
                    method="POST"
                    action="{{ route('tindakan.update', $tindakan) }}"
                >
                    @csrf
                    @method('PUT')

                    <div class="space-y-6 px-6 py-6 sm:px-8">

                        {{-- Kode --}}
                        <div>
                            <label
                                for="kode"
                                class="block text-sm font-semibold text-gray-700"
                            >
                                Kode Tindakan
                                <span class="text-red-500">*</span>
                            </label>

                            <input
                                type="text"
                                name="kode"
                                id="kode"
                                value="{{ old('kode', $tindakan->kode) }}"
                                required
                                autocomplete="off"
                                class="mt-2 block w-full rounded-xl border-gray-300 px-4 py-2.5 text-sm shadow-sm transition focus:border-emerald-500 focus:ring-emerald-500"
                            >

                            @error('kode')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>


                        {{-- Nama --}}
                        <div>
                            <label
                                for="nama"
                                class="block text-sm font-semibold text-gray-700"
                            >
                                Nama Tindakan
                                <span class="text-red-500">*</span>
                            </label>

                            <input
                                type="text"
                                name="nama"
                                id="nama"
                                value="{{ old('nama', $tindakan->nama) }}"
                                required
                                autocomplete="off"
                                class="mt-2 block w-full rounded-xl border-gray-300 px-4 py-2.5 text-sm shadow-sm transition focus:border-emerald-500 focus:ring-emerald-500"
                            >

                            @error('nama')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>


                        {{-- Deskripsi --}}
                        <div>
                            <label
                                for="deskripsi"
                                class="block text-sm font-semibold text-gray-700"
                            >
                                Deskripsi
                            </label>

                            <textarea
                                name="deskripsi"
                                id="deskripsi"
                                rows="5"
                                class="mt-2 block w-full rounded-xl border-gray-300 px-4 py-3 text-sm shadow-sm transition focus:border-emerald-500 focus:ring-emerald-500"
                            >{{ old('deskripsi', $tindakan->deskripsi) }}</textarea>

                            <p class="mt-2 text-xs text-gray-500">
                                Jelaskan secara singkat fungsi atau keterangan tindakan.
                            </p>

                            @error('deskripsi')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>


                        {{-- Status --}}
                        <div class="rounded-xl border border-gray-200 bg-gray-50 p-4">
                            <div class="flex items-start gap-3">

                                <div class="pt-0.5">
                                    <input
                                        type="checkbox"
                                        name="is_active"
                                        value="1"
                                        id="is_active"
                                        {{ old('is_active', $tindakan->is_active) ? 'checked' : '' }}
                                        class="h-4 w-4 rounded border-gray-300 text-emerald-600 focus:ring-emerald-500"
                                    >
                                </div>

                                <div>
                                    <label
                                        for="is_active"
                                        class="cursor-pointer text-sm font-semibold text-gray-800"
                                    >
                                        Tindakan Aktif
                                    </label>

                                    <p class="mt-1 text-xs leading-5 text-gray-500">
                                        Tindakan yang aktif dapat digunakan dalam proses pelayanan
                                        dan pencatatan kunjungan.
                                    </p>
                                </div>

                            </div>

                            @error('is_active')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                    </div>


                    {{-- Footer Form --}}
                    <div class="flex flex-wrap items-center justify-end gap-3 border-t border-gray-100 bg-gray-50 px-6 py-4 sm:px-8">

                        <a
                            href="{{ route('tindakan.show', $tindakan) }}"
                            class="inline-flex items-center gap-2 rounded-xl border border-gray-300 bg-white px-4 py-2.5 text-sm font-semibold text-gray-700 shadow-sm transition hover:bg-gray-50"
                        >
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M15 19l-7-7 7-7"
                                />
                            </svg>

                            Batal
                        </a>

                        <button
                            type="submit"
                            class="inline-flex items-center gap-2 rounded-xl bg-emerald-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2"
                        >
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M5 13l4 4L19 7"
                                />
                            </svg>

                            Simpan Perubahan
                        </button>

                    </div>

                </form>
            </div>

        </div>
    </div>
</x-app-layout>