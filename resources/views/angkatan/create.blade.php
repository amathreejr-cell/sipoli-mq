<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Angkatan
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">

                    <h3 class="text-lg font-semibold text-gray-800 mb-6">
                        Form Data Angkatan
                    </h3>

                    <form
                        method="POST"
                        action="{{ route('angkatan.store') }}"
                    >
                        @csrf

                        {{-- Nama Angkatan --}}
                        <div class="mb-4">
                            <x-input-label
                                for="nama"
                                value="Nama Angkatan"
                            />

                            <x-text-input
                                id="nama"
                                name="nama"
                                type="text"
                                class="block mt-1 w-full"
                                value="{{ old('nama') }}"
                                placeholder="Contoh: Angkatan 2026"
                                required
                                autofocus
                            />

                            <x-input-error
                                :messages="$errors->get('nama')"
                                class="mt-2"
                            />
                        </div>

                        {{-- Tahun Masuk --}}
                        <div class="mb-4">
                            <x-input-label
                                for="tahun_masuk"
                                value="Tahun Masuk"
                            />

                            <x-text-input
                                id="tahun_masuk"
                                name="tahun_masuk"
                                type="number"
                                class="block mt-1 w-full"
                                value="{{ old('tahun_masuk') }}"
                                min="2000"
                                max="2100"
                                placeholder="Contoh: 2026"
                                required
                            />

                            <x-input-error
                                :messages="$errors->get('tahun_masuk')"
                                class="mt-2"
                            />
                        </div>

                        {{-- Tahun Lulus --}}
                        <div class="mb-4">
                            <x-input-label
                                for="tahun_lulus"
                                value="Tahun Lulus"
                            />

                            <x-text-input
                                id="tahun_lulus"
                                name="tahun_lulus"
                                type="number"
                                class="block mt-1 w-full"
                                value="{{ old('tahun_lulus') }}"
                                min="2000"
                                max="2100"
                                placeholder="Opsional"
                            />

                            <x-input-error
                                :messages="$errors->get('tahun_lulus')"
                                class="mt-2"
                            />
                        </div>

                        {{-- Status --}}
                        <div class="mb-6">
                            <label
                                for="is_active"
                                class="inline-flex items-center"
                            >
                                <input
                                    id="is_active"
                                    type="checkbox"
                                    name="is_active"
                                    value="1"
                                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                    {{ old('is_active', true) ? 'checked' : '' }}
                                >

                                <span class="ms-2 text-sm text-gray-600">
                                    Angkatan Aktif
                                </span>
                            </label>
                        </div>

                        {{-- Tombol --}}
                        <div class="flex gap-3">

                            <a
                                href="{{ route('angkatan.index') }}"
                                class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300"
                            >
                                Batal
                            </a>

                            <button
                                type="submit"
                                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700"
                            >
                                Simpan Angkatan
                            </button>

                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>