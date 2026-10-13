<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="text-xl font-bold text-gray-800">
                Edit Fasilitas Rujukan
            </h2>
            <p class="mt-1 text-sm text-gray-500">
                Perbarui informasi fasilitas kesehatan tujuan rujukan.
            </p>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Header --}}
            <div class="mb-6 overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
                <div class="bg-gradient-to-r from-blue-50 to-white px-6 py-6 sm:px-8">

                    <div class="flex items-center gap-4">

                        <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-blue-100 text-blue-600">
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
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"
                                />
                            </svg>
                        </div>

                        <div>
                            <p class="text-sm font-medium text-blue-600">
                                Master Rujukan
                            </p>

                            <h3 class="mt-1 text-xl font-bold text-gray-900">
                                Edit Fasilitas Rujukan
                            </h3>

                            <p class="mt-1 text-sm text-gray-500">
                                {{ $masterRujukan->nama_fasilitas }}
                            </p>
                        </div>

                    </div>

                </div>
            </div>


            {{-- Error Validation --}}
            @if($errors->any())
                <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4">

                    <div class="flex items-start gap-3">

                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-red-100 text-red-600">
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
                                    d="M12 9v4m0 4h.01M10.29 3.86l-8.82 15A2 2 0 003.2 22h17.6a2 2 0 001.73-3.14l-8.82-15a2 2 0 00-3.46 0z"
                                />
                            </svg>
                        </div>

                        <div>
                            <p class="font-semibold text-red-800">
                                Periksa kembali data
                            </p>

                            <ul class="mt-2 list-disc space-y-1 pl-5 text-sm text-red-700">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>

                    </div>

                </div>
            @endif


            {{-- Form --}}
            <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

                <div class="border-b border-gray-100 px-6 py-5 sm:px-8">

                    <div class="flex items-center gap-3">

                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
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
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0H5m14 0h2M7 21H3m6-12h2m-2 4h2m4-4h2m-2 4h2M9 3v2m6-2v2"
                                />
                            </svg>
                        </div>

                        <div>
                            <h3 class="font-bold text-gray-900">
                                Informasi Fasilitas
                            </h3>

                            <p class="text-sm text-gray-500">
                                Perbarui data fasilitas rujukan di bawah ini.
                            </p>
                        </div>

                    </div>

                </div>


                <form
                    action="{{ route('master-rujukan.update', $masterRujukan) }}"
                    method="POST"
                >
                    @csrf
                    @method('PUT')

                    <div class="space-y-6 px-6 py-6 sm:px-8">

                        {{-- Nama Fasilitas --}}
                        <div>
                            <label
                                for="nama_fasilitas"
                                class="block text-sm font-semibold text-gray-700"
                            >
                                Nama Fasilitas
                                <span class="text-red-500">*</span>
                            </label>

                            <input
                                type="text"
                                id="nama_fasilitas"
                                name="nama_fasilitas"
                                value="{{ old('nama_fasilitas', $masterRujukan->nama_fasilitas) }}"
                                required
                                maxlength="200"
                                autocomplete="off"
                                class="mt-2 block w-full rounded-xl border-gray-300 px-4 py-2.5 text-sm shadow-sm transition focus:border-blue-500 focus:ring-blue-500"
                            >

                            @error('nama_fasilitas')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>


                        {{-- Alamat --}}
                        <div>
                            <label
                                for="alamat"
                                class="block text-sm font-semibold text-gray-700"
                            >
                                Alamat
                            </label>

                            <textarea
                                id="alamat"
                                name="alamat"
                                rows="4"
                                class="mt-2 block w-full rounded-xl border-gray-300 px-4 py-3 text-sm shadow-sm transition focus:border-blue-500 focus:ring-blue-500"
                            >{{ old('alamat', $masterRujukan->alamat) }}</textarea>

                            <p class="mt-2 text-xs text-gray-500">
                                Masukkan alamat lengkap fasilitas kesehatan jika tersedia.
                            </p>

                            @error('alamat')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>


                        {{-- Nomor Telepon --}}
                        <div>
                            <label
                                for="no_telepon"
                                class="block text-sm font-semibold text-gray-700"
                            >
                                Nomor Telepon
                            </label>

                            <div class="relative mt-2">

                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
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
                                            d="M3 5a2 2 0 012-2h2.28a2 2 0 011.94 1.515L10 7a2 2 0 01-.45 1.82l-1.27 1.27a16 16 0 006.63 6.63l1.27-1.27A2 2 0 0118 15l2.485.78A2 2 0 0122 17.72V20a2 2 0 01-2 2C10.06 22 2 13.94 2 4a2 2 0 012-2h2.28"
                                        />
                                    </svg>
                                </div>

                                <input
                                    type="text"
                                    id="no_telepon"
                                    name="no_telepon"
                                    value="{{ old('no_telepon', $masterRujukan->no_telepon) }}"
                                    maxlength="30"
                                    autocomplete="tel"
                                    class="block w-full rounded-xl border-gray-300 py-2.5 pl-11 pr-4 text-sm shadow-sm transition focus:border-blue-500 focus:ring-blue-500"
                                    placeholder="Contoh: 0321-123456"
                                >

                            </div>

                            @error('no_telepon')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>


                        {{-- Status --}}
                        <div class="rounded-xl border border-blue-100 bg-blue-50 p-4">

                            <div class="flex items-start gap-3">

                                <div class="pt-0.5">
                                    <input
                                        type="checkbox"
                                        name="is_active"
                                        value="1"
                                        id="is_active"
                                        {{ old('is_active', $masterRujukan->is_active) ? 'checked' : '' }}
                                        class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                                    >
                                </div>

                                <div>
                                    <label
                                        for="is_active"
                                        class="cursor-pointer text-sm font-semibold text-gray-800"
                                    >
                                        Fasilitas Aktif
                                    </label>

                                    <p class="mt-1 text-xs leading-5 text-gray-600">
                                        Fasilitas yang aktif dapat dipilih sebagai tujuan
                                        rujukan dalam pelayanan santri.
                                    </p>
                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- Footer --}}
                    <div class="flex flex-wrap items-center justify-end gap-3 border-t border-gray-100 bg-gray-50 px-6 py-4 sm:px-8">

                        <a
                            href="{{ route('master-rujukan.index') }}"
                            class="inline-flex items-center gap-2 rounded-xl border border-gray-300 bg-white px-4 py-2.5 text-sm font-semibold text-gray-700 shadow-sm transition hover:bg-gray-50"
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
                                    d="M15 19l-7-7 7-7"
                                />
                            </svg>

                            Kembali
                        </a>

                        <button
                            type="submit"
                            class="inline-flex items-center gap-2 rounded-xl bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
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