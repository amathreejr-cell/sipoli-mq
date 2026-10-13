<x-app-layout>

    <div class="max-w-3xl mx-auto space-y-6">

        {{-- HEADER --}}
        <div>

            <a
                href="{{ route('users.index') }}"
                class="inline-flex items-center text-sm text-gray-500 hover:text-gray-700 mb-3">

                <svg class="w-4 h-4 mr-1"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24">

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M15 19l-7-7 7-7"/>

                </svg>

                Kembali ke Manajemen Pengguna

            </a>

            <h1 class="text-2xl font-bold text-gray-800">
                Tambah Pengguna
            </h1>

            <p class="mt-1 text-sm text-gray-500">
                Buat akun baru untuk pengguna SIPOLI-MQ.
            </p>

        </div>


        {{-- FORM --}}
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm">

            <form
                method="POST"
                action="{{ route('users.store') }}">

                @csrf

                <div class="p-6 space-y-5">

                    {{-- NAMA --}}
                    <div>

                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Nama Lengkap
                        </label>

                        <input
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            required
                            autofocus
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                            placeholder="Contoh: Ahmad Fauzi">

                        @error('name')

                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    {{-- EMAIL --}}
                    <div>

                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Email
                        </label>

                        <input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                            placeholder="contoh@domain.com">

                        @error('email')

                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    {{-- ROLE --}}
                    <div>

                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Role
                        </label>

                        <select
                            name="role"
                            required
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">

                            <option value="">
                                Pilih Role
                            </option>

                            <option
                                value="admin"
                                @selected(old('role') === 'admin')>
                                Admin
                            </option>

                            <option
                                value="petugas"
                                @selected(old('role') === 'petugas')>
                                Petugas
                            </option>

                            <option
                                value="pimpinan"
                                @selected(old('role') === 'pimpinan')>
                                Pimpinan
                            </option>

                        </select>

                        @error('role')

                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                        <p class="mt-1 text-xs text-gray-400">
                            Role menentukan hak akses pengguna di SIPOLI-MQ.
                        </p>

                    </div>


                    {{-- PASSWORD --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <div>

                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Password
                            </label>

                            <input
                                type="password"
                                name="password"
                                required
                                minlength="8"
                                class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">

                            @error('password')

                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>


                        <div>

                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Konfirmasi Password
                            </label>

                            <input
                                type="password"
                                name="password_confirmation"
                                required
                                minlength="8"
                                class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">

                        </div>

                    </div>


                    <div class="rounded-lg bg-blue-50 border border-blue-200 p-4">

                        <div class="flex">

                            <svg
                                class="w-5 h-5 text-blue-600 mr-3 flex-shrink-0"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24">

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M12 22a10 10 0 100-20 10 10 0 000 20z"/>

                            </svg>

                            <div>

                                <p class="text-sm font-medium text-blue-800">
                                    Informasi
                                </p>

                                <p class="text-xs text-blue-700 mt-1">
                                    Pengguna baru otomatis dibuat dalam status aktif.
                                </p>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- FOOTER --}}
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end gap-3">

                    <a
                        href="{{ route('users.index') }}"
                        class="px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">

                        Batal

                    </a>

                    <button
                        type="submit"
                        class="px-5 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">

                        Simpan Pengguna

                    </button>

                </div>

            </form>

        </div>

    </div>

</x-app-layout>