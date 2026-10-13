<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="text-xl font-bold text-gray-800">
                Stok Masuk
            </h2>
            <p class="mt-1 text-sm text-gray-500">
                Tambahkan stok obat dan catat sebagai mutasi stok masuk.
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
                                    d="M12 4v16m8-8H4"
                                />
                            </svg>
                        </div>

                        <div>
                            <p class="text-sm font-medium text-emerald-600">
                                Manajemen Stok
                            </p>

                            <h3 class="mt-1 text-xl font-bold text-gray-900">
                                Tambah Stok Obat
                            </h3>

                            <p class="mt-1 text-sm text-gray-500">
                                Catat penambahan stok obat sebagai mutasi stok masuk.
                            </p>
                        </div>

                    </div>

                </div>
            </div>


            {{-- Form --}}
            <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

                <div class="border-b border-gray-100 px-6 py-5 sm:px-8">

                    <div class="flex items-center gap-3">

                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
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
                                    d="M20 7l-8 4-8-4m16 0l-8-4-8 4m16 0v10l-8 4-8-4V7"
                                />
                            </svg>
                        </div>

                        <div>
                            <h3 class="font-bold text-gray-900">
                                Informasi Stok
                            </h3>

                            <p class="text-sm text-gray-500">
                                Pilih obat dan masukkan jumlah stok yang diterima.
                            </p>
                        </div>

                    </div>

                </div>


                <form
                    method="POST"
                    action="{{ route('obat.stok-masuk.store') }}"
                >
                    @csrf

                    <div class="space-y-6 px-6 py-6 sm:px-8">

                        {{-- Obat --}}
                        <div>
                            <label
                                for="obat_id"
                                class="block text-sm font-semibold text-gray-700"
                            >
                                Obat
                                <span class="text-red-500">*</span>
                            </label>

                            <select
                                name="obat_id"
                                id="obat_id"
                                required
                                class="mt-2 block w-full rounded-xl border-gray-300 px-4 py-2.5 text-sm shadow-sm transition focus:border-emerald-500 focus:ring-emerald-500"
                            >
                                <option value="">
                                    -- Pilih Obat --
                                </option>

                                @foreach ($obats as $obat)
                                    <option
                                        value="{{ $obat->id }}"
                                        {{ old('obat_id') == $obat->id ? 'selected' : '' }}
                                    >
                                        {{ $obat->nama }}
                                        — Stok saat ini: {{ $obat->stok }}
                                        {{ $obat->satuan }}
                                    </option>
                                @endforeach
                            </select>

                            <p class="mt-2 text-xs text-gray-500">
                                Stok saat ini ditampilkan untuk membantu memastikan jumlah stok yang ditambahkan.
                            </p>

                            @error('obat_id')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>


                        {{-- Jumlah --}}
                        <div>
                            <label
                                for="jumlah"
                                class="block text-sm font-semibold text-gray-700"
                            >
                                Jumlah Stok Masuk
                                <span class="text-red-500">*</span>
                            </label>

                            <div class="relative mt-2">

                                <input
                                    type="number"
                                    name="jumlah"
                                    id="jumlah"
                                    value="{{ old('jumlah') }}"
                                    min="1"
                                    required
                                    class="block w-full rounded-xl border-gray-300 px-4 py-2.5 pr-16 text-sm shadow-sm transition focus:border-emerald-500 focus:ring-emerald-500"
                                    placeholder="Contoh: 50"
                                >

                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-4 text-xs font-medium text-gray-400">
                                    Unit
                                </div>

                            </div>

                            <p class="mt-2 text-xs text-gray-500">
                                Masukkan jumlah obat yang diterima.
                            </p>

                            @error('jumlah')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>


                        {{-- Keterangan --}}
                        <div>
                            <label
                                for="keterangan"
                                class="block text-sm font-semibold text-gray-700"
                            >
                                Keterangan
                            </label>

                            <textarea
                                name="keterangan"
                                id="keterangan"
                                rows="4"
                                class="mt-2 block w-full rounded-xl border-gray-300 px-4 py-3 text-sm shadow-sm transition focus:border-emerald-500 focus:ring-emerald-500"
                                placeholder="Contoh: Pengadaan obat bulan September"
                            >{{ old('keterangan') }}</textarea>

                            <p class="mt-2 text-xs text-gray-500">
                                Tambahkan informasi sumber atau alasan penambahan stok jika diperlukan.
                            </p>

                            @error('keterangan')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>


                        {{-- Informasi --}}
                        <div class="rounded-xl border border-blue-100 bg-blue-50 p-4">

                            <div class="flex items-start gap-3">

                                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-blue-100 text-blue-600">
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
                                            d="M13 16h-1v-4h-1m1-4h.01M12 22a10 10 0 100-20 10 10 0 000 20z"
                                        />
                                    </svg>
                                </div>

                                <div>
                                    <p class="text-sm font-semibold text-blue-800">
                                        Pencatatan Mutasi
                                    </p>

                                    <p class="mt-1 text-xs leading-5 text-blue-700">
                                        Setelah disimpan, jumlah stok obat akan diperbarui dan
                                        transaksi akan tercatat sebagai mutasi stok masuk.
                                    </p>
                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- Footer --}}
                    <div class="flex flex-wrap items-center justify-end gap-3 border-t border-gray-100 bg-gray-50 px-6 py-4 sm:px-8">

                        <a
                            href="{{ route('obat.mutasi-stok.index') }}"
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

                            Batal
                        </a>

                        <button
                            type="submit"
                            class="inline-flex items-center gap-2 rounded-xl bg-emerald-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2"
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

                            Simpan Stok
                        </button>

                    </div>

                </form>

            </div>

        </div>
    </div>

</x-app-layout>