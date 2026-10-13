<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Wali Santri
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">

                    <form method="POST" action="{{ route('wali-santri.update', $waliSantri) }}">
                        @csrf
                        @method('PUT')

                        {{-- Nama --}}
                        <div class="mb-4">
                            <label
                                for="nama"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Nama Wali
                            </label>

                            <input
                                type="text"
                                name="nama"
                                id="nama"
                                value="{{ old('nama', $waliSantri->nama) }}"
                                required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                            >

                            @error('nama')
                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Hubungan --}}
                        <div class="mb-4">
                            <label
                                for="hubungan"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Hubungan
                            </label>

                            <select
                                name="hubungan"
                                id="hubungan"
                                required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                            >
                                <option value="">-- Pilih Hubungan --</option>

                                <option
                                    value="Ayah"
                                    {{ old('hubungan', $waliSantri->hubungan) == 'Ayah' ? 'selected' : '' }}
                                >
                                    Ayah
                                </option>

                                <option
                                    value="Ibu"
                                    {{ old('hubungan', $waliSantri->hubungan) == 'Ibu' ? 'selected' : '' }}
                                >
                                    Ibu
                                </option>

                                <option
                                    value="Wali"
                                    {{ old('hubungan', $waliSantri->hubungan) == 'Wali' ? 'selected' : '' }}
                                >
                                    Wali
                                </option>
                            </select>

                            @error('hubungan')
                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Nomor HP --}}
                        <div class="mb-4">
                            <label
                                for="no_hp"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Nomor HP
                            </label>

                            <input
                                type="text"
                                name="no_hp"
                                id="no_hp"
                                value="{{ old('no_hp', $waliSantri->no_hp) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                                placeholder="Contoh: 081234567890"
                            >

                            @error('no_hp')
                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Alamat --}}
                        <div class="mb-6">
                            <label
                                for="alamat"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Alamat
                            </label>

                            <textarea
                                name="alamat"
                                id="alamat"
                                rows="4"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                            >{{ old('alamat', $waliSantri->alamat) }}</textarea>

                            @error('alamat')
                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Tombol --}}
                        <div class="flex items-center gap-3">

                            <a
                                href="{{ route('wali-santri.show', $waliSantri) }}"
                                class="inline-flex items-center px-4 py-2 bg-gray-200 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300"
                            >
                                Batal
                            </a>

                            <button
                                type="submit"
                                class="inline-flex items-center px-4 py-2 bg-gray-800 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700"
                            >
                                Simpan Perubahan
                            </button>

                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>