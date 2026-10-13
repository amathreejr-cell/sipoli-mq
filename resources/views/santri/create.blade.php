<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Tambah Santri
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Tambahkan data santri baru ke SIPOLI-MQ
                </p>
            </div>

            <a
                href="{{ route('santri.index') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300"
            >
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">

                    <form method="POST" action="{{ route('santri.store') }}">
                        @csrf

                        {{-- Nomor Induk --}}
                        <div>
                            <x-input-label
                                for="nomor_induk"
                                value="Nomor Induk"
                            />

                            <x-text-input
                                id="nomor_induk"
                                class="block mt-1 w-full"
                                type="text"
                                name="nomor_induk"
                                :value="old('nomor_induk')"
                                required
                                autofocus
                            />

                            <x-input-error
                                :messages="$errors->get('nomor_induk')"
                                class="mt-2"
                            />
                        </div>

                        {{-- Nama --}}
                        <div class="mt-4">
                            <x-input-label
                                for="nama"
                                value="Nama Lengkap"
                            />

                            <x-text-input
                                id="nama"
                                class="block mt-1 w-full"
                                type="text"
                                name="nama"
                                :value="old('nama')"
                                required
                            />

                            <x-input-error
                                :messages="$errors->get('nama')"
                                class="mt-2"
                            />
                        </div>

                        {{-- Tempat Lahir --}}
                        <div class="mt-4">
                            <x-input-label
                                for="tempat_lahir"
                                value="Tempat Lahir"
                            />

                            <x-text-input
                                id="tempat_lahir"
                                class="block mt-1 w-full"
                                type="text"
                                name="tempat_lahir"
                                :value="old('tempat_lahir')"
                            />

                            <x-input-error
                                :messages="$errors->get('tempat_lahir')"
                                class="mt-2"
                            />
                        </div>

                        {{-- Jenis Kelamin --}}
                        <div class="mt-4">
                            <x-input-label
                                for="jenis_kelamin"
                                value="Jenis Kelamin"
                            />

                            <select
                                id="jenis_kelamin"
                                name="jenis_kelamin"
                                class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                required
                            >
                                <option value="">-- Pilih Jenis Kelamin --</option>

                                <option
                                    value="L"
                                    @selected(old('jenis_kelamin') === 'L')
                                >
                                    Laki-laki
                                </option>

                                <option
                                    value="P"
                                    @selected(old('jenis_kelamin') === 'P')
                                >
                                    Perempuan
                                </option>
                            </select>

                            <x-input-error
                                :messages="$errors->get('jenis_kelamin')"
                                class="mt-2"
                            />
                        </div>

                        {{-- Tanggal Lahir --}}
                        <div class="mt-4">
                            <x-input-label
                                for="tanggal_lahir"
                                value="Tanggal Lahir"
                            />

                            <x-text-input
                                id="tanggal_lahir"
                                class="block mt-1 w-full"
                                type="date"
                                name="tanggal_lahir"
                                :value="old('tanggal_lahir')"
                            />

                            <x-input-error
                                :messages="$errors->get('tanggal_lahir')"
                                class="mt-2"
                            />
                        </div>

                        {{-- Kamar --}}
                        <div class="mt-4">
                            <x-input-label
                                for="kamar"
                                value="Kamar"
                            />

                            <x-text-input
                                id="kamar"
                                class="block mt-1 w-full"
                                type="text"
                                name="kamar"
                                :value="old('kamar')"
                                placeholder="Contoh: MS-12"
                            />

                            <x-input-error
                                :messages="$errors->get('kamar')"
                                class="mt-2"
                            />
                        </div>

                        {{-- Sekolah --}}
                        <div class="mt-4">
                            <x-input-label
                                for="sekolah"
                                value="Sekolah"
                            />

                            <x-text-input
                                id="sekolah"
                                class="block mt-1 w-full"
                                type="text"
                                name="sekolah"
                                :value="old('sekolah')"
                                placeholder="Contoh: SMP Al Furqan MQ"
                            />

                            <x-input-error
                                :messages="$errors->get('sekolah')"
                                class="mt-2"
                            />
                        </div>

                        {{-- Kelas --}}
                        <div class="mt-4">
                            <x-input-label
                                for="kelas"
                                value="Kelas"
                            />

                            <x-text-input
                                id="kelas"
                                class="block mt-1 w-full"
                                type="text"
                                name="kelas"
                                :value="old('kelas')"
                                placeholder="Contoh: 2"
                            />

                            <x-input-error
                                :messages="$errors->get('kelas')"
                                class="mt-2"
                            />
                        </div>

                        {{-- Alamat --}}
                        <div class="mt-4">
                            <x-input-label
                                for="alamat"
                                value="Alamat"
                            />

                            <textarea
                                id="alamat"
                                name="alamat"
                                rows="3"
                                class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                            >{{ old('alamat') }}</textarea>

                            <x-input-error
                                :messages="$errors->get('alamat')"
                                class="mt-2"
                            />
                        </div>

                        {{-- Status --}}
                        <div class="mt-4">
                            <x-input-label
                                for="status"
                                value="Status"
                            />

                            <select
                                id="status"
                                name="status"
                                class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                required
                            >
                                <option
                                    value="aktif"
                                    @selected(old('status', 'aktif') === 'aktif')
                                >
                                    Aktif
                                </option>

                                <option
                                    value="nonaktif"
                                    @selected(old('status') === 'nonaktif')
                                >
                                    Nonaktif
                                </option>
                            </select>

                            <x-input-error
                                :messages="$errors->get('status')"
                                class="mt-2"
                            />
                        </div>

                        {{-- Tombol --}}
                        <div class="flex items-center justify-end mt-6 gap-3">

                            <a
                                href="{{ route('santri.index') }}"
                                class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300"
                            >
                                Batal
                            </a>

                            <x-primary-button>
                                Simpan Santri
                            </x-primary-button>

                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>