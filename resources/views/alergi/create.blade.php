<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Alergi Santri
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">

                    <form method="POST" action="{{ route('alergi.store') }}">
                        @csrf

                        {{-- Santri --}}
                        <div class="mb-4">
                            <label for="santri_id" class="block text-sm font-medium text-gray-700">
                                Santri
                            </label>

                            <select
                                name="santri_id"
                                id="santri_id"
                                required
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                            >
                                <option value="">-- Pilih Santri --</option>

                                @foreach ($santris as $santri)
                                    <option
                                        value="{{ $santri->id }}"
                                        {{ old('santri_id') == $santri->id ? 'selected' : '' }}
                                    >
                                        {{ $santri->nomor_induk }} - {{ $santri->nama }}
                                    </option>
                                @endforeach
                            </select>

                            @error('santri_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Jenis --}}
                        <div class="mb-4">
                            <label for="jenis" class="block text-sm font-medium text-gray-700">
                                Jenis Alergi
                            </label>

                            <select
                                name="jenis"
                                id="jenis"
                                required
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                            >
                                <option value="">-- Pilih Jenis --</option>
                                <option value="Makanan" {{ old('jenis') === 'Makanan' ? 'selected' : '' }}>
                                    Makanan
                                </option>
                                <option value="Obat" {{ old('jenis') === 'Obat' ? 'selected' : '' }}>
                                    Obat
                                </option>
                                <option value="Lingkungan" {{ old('jenis') === 'Lingkungan' ? 'selected' : '' }}>
                                    Lingkungan
                                </option>
                                <option value="Lainnya" {{ old('jenis') === 'Lainnya' ? 'selected' : '' }}>
                                    Lainnya
                                </option>
                            </select>

                            @error('jenis')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Nama Alergi --}}
                        <div class="mb-4">
                            <label for="nama" class="block text-sm font-medium text-gray-700">
                                Nama Alergi / Pemicu
                            </label>

                            <input
                                type="text"
                                name="nama"
                                id="nama"
                                value="{{ old('nama') }}"
                                placeholder="Contoh: Udang, Paracetamol, Debu"
                                required
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                            >

                            @error('nama')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Reaksi --}}
                        <div class="mb-4">
                            <label for="reaksi" class="block text-sm font-medium text-gray-700">
                                Reaksi
                            </label>

                            <input
                                type="text"
                                name="reaksi"
                                id="reaksi"
                                value="{{ old('reaksi') }}"
                                placeholder="Contoh: Gatal, ruam, sesak"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                            >

                            @error('reaksi')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Keterangan --}}
                        <div class="mb-6">
                            <label for="keterangan" class="block text-sm font-medium text-gray-700">
                                Keterangan
                            </label>

                            <textarea
                                name="keterangan"
                                id="keterangan"
                                rows="4"
                                placeholder="Catatan tambahan mengenai alergi..."
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                            >{{ old('keterangan') }}</textarea>

                            @error('keterangan')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Tombol --}}
                        <div class="flex items-center gap-3">
                            <a
                                href="{{ route('alergi.index') }}"
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