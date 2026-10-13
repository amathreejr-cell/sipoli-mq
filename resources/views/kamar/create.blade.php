<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Kamar
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">

                    <h3 class="text-lg font-semibold text-gray-800 mb-6">
                        Form Data Kamar
                    </h3>

                    <form method="POST" action="{{ route('kamar.store') }}">
                        @csrf

                        <div class="mb-4">
                            <x-input-label for="kode" value="Kode Kamar" />

                            <x-text-input
                                id="kode"
                                name="kode"
                                type="text"
                                class="block mt-1 w-full"
                                value="{{ old('kode') }}"
                                required
                                autofocus
                            />

                            <x-input-error
                                :messages="$errors->get('kode')"
                                class="mt-2"
                            />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="nama" value="Nama Kamar" />

                            <x-text-input
                                id="nama"
                                name="nama"
                                type="text"
                                class="block mt-1 w-full"
                                value="{{ old('nama') }}"
                                required
                            />

                            <x-input-error
                                :messages="$errors->get('nama')"
                                class="mt-2"
                            />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="keterangan" value="Keterangan" />

                            <textarea
                                id="keterangan"
                                name="keterangan"
                                rows="4"
                                class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            >{{ old('keterangan') }}</textarea>

                            <x-input-error
                                :messages="$errors->get('keterangan')"
                                class="mt-2"
                            />
                        </div>

                        <div class="mb-6">
                            <label for="is_active" class="inline-flex items-center">
                                <input
                                    id="is_active"
                                    type="checkbox"
                                    name="is_active"
                                    value="1"
                                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                    {{ old('is_active', true) ? 'checked' : '' }}
                                >

                                <span class="ms-2 text-sm text-gray-600">
                                    Kamar Aktif
                                </span>
                            </label>
                        </div>

                        <div class="flex gap-3">
                            <a
                                href="{{ route('kamar.index') }}"
                                class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300"
                            >
                                Batal
                            </a>

                            <button
                                type="submit"
                                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700"
                            >
                                Simpan Kamar
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>