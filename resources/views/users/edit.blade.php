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
                Edit Pengguna
            </h1>

            <p class="mt-1 text-sm text-gray-500">
                Perbarui informasi dan role pengguna.
            </p>

        </div>


        {{-- USER INFO --}}
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-5">

            <div class="flex items-center">

                <div class="w-12 h-12 rounded-full bg-indigo-100 text-indigo-700 flex items-center justify-center font-semibold text-lg">

                    {{ strtoupper(substr($user->name, 0, 1)) }}

                </div>

                <div class="ml-4">

                    <h2 class="font-semibold text-gray-800">
                        {{ $user->name }}
                    </h2>

                    <p class="text-sm text-gray-500">
                        {{ $user->email }}
                    </p>

                </div>

            </div>

        </div>


        {{-- FORM --}}
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm">

            <form
                method="POST"
                action="{{ route('users.update', $user) }}">

                @csrf
                @method('PUT')

                <div class="p-6 space-y-5">

                    {{-- NAMA --}}
                    <div>

                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Nama Lengkap
                        </label>

                        <input
                            type="text"
                            name="name"
                            value="{{ old('name', $user->name) }}"
                            required
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">

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
                            value="{{ old('email', $user->email) }}"
                            required
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">

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

                            <option
                                value="admin"
                                @selected(old('role', $user->role) === 'admin')>
                                Admin
                            </option>

                            <option
                                value="petugas"
                                @selected(old('role', $user->role) === 'petugas')>
                                Petugas
                            </option>

                            <option
                                value="pimpinan"
                                @selected(old('role', $user->role) === 'pimpinan')>
                                Pimpinan
                            </option>

                        </select>

                        @error('role')

                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    {{-- ACCOUNT STATUS --}}
                    <div class="rounded-lg bg-gray-50 border border-gray-200 p-4">

                        <div class="flex items-center justify-between">

                            <div>

                                <p class="text-sm font-medium text-gray-700">
                                    Status Akun
                                </p>

                                <p class="text-xs text-gray-500 mt-1">
                                    Status akun dapat diubah dari halaman daftar pengguna.
                                </p>

                            </div>

                            @if ($user->is_active)

                                <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700">
                                    Aktif
                                </span>

                            @else

                                <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-700">
                                    Nonaktif
                                </span>

                            @endif

                        </div>

                    </div>


                    {{-- LAST LOGIN --}}
                    <div class="rounded-lg bg-gray-50 border border-gray-200 p-4">

                        <p class="text-sm font-medium text-gray-700">
                            Login Terakhir
                        </p>

                        <p class="text-sm text-gray-500 mt-1">

                            @if ($user->last_login_at)

                                {{ $user->last_login_at->format('d F Y H:i') }}

                            @else

                                Belum pernah login

                            @endif

                        </p>

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

                        Simpan Perubahan

                    </button>

                </div>

            </form>

        </div>

    </div>

</x-app-layout>