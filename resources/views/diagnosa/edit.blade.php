<x-app-layout>

    <x-slot name="header">
        <div>
            <p class="text-sm text-gray-500">Master Data</p>
            <h2 class="text-2xl font-bold text-gray-800">
                Edit Diagnosa
            </h2>
        </div>
    </x-slot>


    <div class="py-6">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- ========================= --}}
            {{-- HEADER --}}
            {{-- ========================= --}}

            <div class="mb-6 rounded-2xl bg-white shadow-sm ring-1 ring-gray-100">

                <div class="flex items-center gap-4 px-6 py-6">

                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-purple-50 text-purple-600">

                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M9 3h6m-7 4h8m-9 4h10m-9 4h8m-7 4h6"
                            />
                        </svg>

                    </div>

                    <div>
                        <h3 class="text-lg font-bold text-gray-800">
                            Edit Data Diagnosa
                        </h3>

                        <p class="mt-1 text-sm text-gray-500">
                            Perbarui informasi diagnosa yang tersimpan dalam SIPOLI-MQ.
                        </p>
                    </div>

                </div>

            </div>


            {{-- ========================= --}}
            {{-- FORM --}}
            {{-- ========================= --}}

            <div class="rounded-2xl bg-white shadow-sm ring-1 ring-gray-100">

                <form method="POST" action="{{ route('diagnosa.update', $diagnosa) }}">

                    @csrf
                    @method('PUT')


                    <div class="space-y-6 p-6">


                        {{-- KODE --}}
                        <div>

                            <label
                                for="kode"
                                class="block text-sm font-semibold text-gray-700"
                            >
                                Kode Diagnosa
                                <span class="text-red-500">*</span>
                            </label>

                            <p class="mt-1 text-xs text-gray-500">
                                Masukkan kode diagnosa.
                            </p>

                            <input
                                type="text"
                                name="kode"
                                id="kode"
                                value="{{ old('kode', $diagnosa->kode) }}"
                                required
                                class="mt-2 block w-full rounded-xl border-gray-300 px-4 py-3 text-sm shadow-sm transition focus:border-indigo-500 focus:ring-indigo-500"
                            >

                            @error('kode')
                                <p class="mt-2 flex items-center gap-1 text-sm text-red-600">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M12 8v4m0 4h.01"
                                        />
                                    </svg>

                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- NAMA --}}
                        <div>

                            <label
                                for="nama"
                                class="block text-sm font-semibold text-gray-700"
                            >
                                Nama Diagnosa
                                <span class="text-red-500">*</span>
                            </label>

                            <p class="mt-1 text-xs text-gray-500">
                                Nama atau jenis diagnosa yang akan digunakan.
                            </p>

                            <input
                                type="text"
                                name="nama"
                                id="nama"
                                value="{{ old('nama', $diagnosa->nama) }}"
                                required
                                class="mt-2 block w-full rounded-xl border-gray-300 px-4 py-3 text-sm shadow-sm transition focus:border-indigo-500 focus:ring-indigo-500"
                            >

                            @error('nama')
                                <p class="mt-2 flex items-center gap-1 text-sm text-red-600">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M12 8v4m0 4h.01"
                                        />
                                    </svg>

                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- DESKRIPSI --}}
                        <div>

                            <label
                                for="deskripsi"
                                class="block text-sm font-semibold text-gray-700"
                            >
                                Deskripsi
                            </label>

                            <p class="mt-1 text-xs text-gray-500">
                                Tambahkan keterangan mengenai diagnosa jika diperlukan.
                            </p>

                            <textarea
                                name="deskripsi"
                                id="deskripsi"
                                rows="5"
                                class="mt-2 block w-full resize-y rounded-xl border-gray-300 px-4 py-3 text-sm shadow-sm transition focus:border-indigo-500 focus:ring-indigo-500"
                            >{{ old('deskripsi', $diagnosa->deskripsi) }}</textarea>

                            @error('deskripsi')
                                <p class="mt-2 flex items-center gap-1 text-sm text-red-600">

                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M12 8v4m0 4h.01"
                                        />
                                    </svg>

                                    {{ $message }}

                                </p>
                            @enderror

                        </div>


                        {{-- STATUS --}}
                        <div class="rounded-xl border border-gray-100 bg-gray-50 p-4">

                            <label class="flex cursor-pointer items-start gap-3">

                                <input
                                    type="checkbox"
                                    name="is_active"
                                    value="1"
                                    {{ old('is_active', $diagnosa->is_active) ? 'checked' : '' }}
                                    class="mt-0.5 h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                >

                                <div>

                                    <p class="text-sm font-semibold text-gray-800">
                                        Diagnosa Aktif
                                    </p>

                                    <p class="mt-1 text-xs leading-5 text-gray-500">
                                        Diagnosa yang aktif dapat digunakan dalam proses pemeriksaan santri.
                                    </p>

                                </div>

                            </label>

                            @error('is_active')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                    </div>


                    {{-- ========================= --}}
                    {{-- FOOTER BUTTON --}}
                    {{-- ========================= --}}

                    <div class="flex flex-col-reverse gap-3 border-t border-gray-100 bg-gray-50/70 px-6 py-5 sm:flex-row sm:items-center sm:justify-between">

                        <a
                            href="{{ route('diagnosa.show', $diagnosa) }}"
                            class="inline-flex items-center justify-center gap-2 rounded-lg border border-gray-200 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 transition hover:bg-gray-50"
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
                            class="inline-flex items-center justify-center gap-2 rounded-lg bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700"
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


            {{-- ========================= --}}
            {{-- INFO --}}
            {{-- ========================= --}}

            <div class="mt-5 rounded-xl border border-blue-100 bg-blue-50 px-4 py-4">

                <div class="flex items-start gap-3">

                    <svg class="mt-0.5 h-5 w-5 shrink-0 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M12 8h.01M11 12h1v4h1m-1-13a9 9 0 100 18 9 9 0 000-18z"
                        />
                    </svg>

                    <div>

                        <p class="text-sm font-semibold text-blue-800">
                            Informasi
                        </p>

                        <p class="mt-1 text-xs leading-5 text-blue-700">
                            Perubahan data diagnosa akan digunakan pada pencatatan pemeriksaan dan rekam medis santri.
                        </p>

                    </div>

                </div>

            </div>

        </div>
    </div>

</x-app-layout>