<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Obat
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">

                    <form method="POST" action="{{ route('obat.store') }}">
                        @csrf

                        {{-- Kode --}}
                        <div class="mb-4">
                            <label for="kode" class="block text-sm font-medium text-gray-700">
                                Kode Obat
                            </label>

                            <input
                                type="text"
                                name="kode"
                                id="kode"
                                value="{{ old('kode') }}"
                                required
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                placeholder="Contoh: OBT-001"
                            >

                            @error('kode')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Nama --}}
                        <div class="mb-4">
                            <label for="nama" class="block text-sm font-medium text-gray-700">
                                Nama Obat
                            </label>

                            <input
                                type="text"
                                name="nama"
                                id="nama"
                                value="{{ old('nama') }}"
                                required
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                placeholder="Contoh: Paracetamol"
                            >

                            @error('nama')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Bentuk --}}
                        <div class="mb-4">
                            <label for="bentuk" class="block text-sm font-medium text-gray-700">
                                Bentuk
                            </label>

                            <input
                                type="text"
                                name="bentuk"
                                id="bentuk"
                                value="{{ old('bentuk') }}"
                                placeholder="Contoh: Tablet, Kapsul, Sirup"
                                required
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                            >

                            @error('bentuk')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Satuan --}}
                        <div class="mb-4">
                            <label for="satuan" class="block text-sm font-medium text-gray-700">
                                Satuan
                            </label>

                            <input
                                type="text"
                                name="satuan"
                                id="satuan"
                                value="{{ old('satuan') }}"
                                placeholder="Contoh: Tablet, Botol, Strip"
                                required
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                            >

                            @error('satuan')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Stok --}}
                        <div class="mb-4">
                            <label for="stok" class="block text-sm font-medium text-gray-700">
                                Stok
                            </label>

                            <input
                                type="number"
                                name="stok"
                                id="stok"
                                value="{{ old('stok', 0) }}"
                                min="0"
                                required
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                            >

                            @error('stok')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Stok Minimum --}}
                        <div class="mb-4">
                            <label for="stok_minimum" class="block text-sm font-medium text-gray-700">
                                Stok Minimum
                            </label>

                            <input
                                type="number"
                                name="stok_minimum"
                                id="stok_minimum"
                                value="{{ old('stok_minimum', 10) }}"
                                min="0"
                                required
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                            >

                            <p class="mt-1 text-xs text-gray-500">
                                Digunakan sebagai batas peringatan stok minimum.
                            </p>

                            @error('stok_minimum')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Keterangan --}}
                        <div class="mb-4">
                            <label for="keterangan" class="block text-sm font-medium text-gray-700">
                                Keterangan
                            </label>

                            <textarea
                                name="keterangan"
                                id="keterangan"
                                rows="3"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                            >{{ old('keterangan') }}</textarea>

                            @error('keterangan')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Status --}}
                        <div class="mb-6">
                            <label class="inline-flex items-center">
                                <input
                                    type="checkbox"
                                    name="is_active"
                                    value="1"
                                    {{ old('is_active', true) ? 'checked' : '' }}
                                    class="rounded border-gray-300 text-indigo-600 shadow-sm"
                                >

                                <span class="ml-2 text-sm text-gray-700">
                                    Obat Aktif
                                </span>
                            </label>
                        </div>

                        {{-- Tombol --}}
                        <div class="flex items-center gap-3">
                            <a
                                href="{{ route('obat.index') }}"
                                class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300"
                            >
                                Batal
                            </a>

                            <button
                                type="submit"
                                class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700"
                            >
                                Simpan
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>