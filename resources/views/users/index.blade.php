<x-app-layout>

    <div class="space-y-6">

        {{-- HEADER --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

            <div>
                <h1 class="text-2xl font-bold text-gray-800">
                    Manajemen Pengguna
                </h1>

                <p class="mt-1 text-sm text-gray-500">
                    Kelola akun, role, status, dan akses pengguna SIPOLI-MQ.
                </p>
            </div>

            <a
                href="{{ route('users.create') }}"
                class="inline-flex items-center justify-center px-4 py-2.5 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">

                <svg class="w-5 h-5 mr-2"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24">

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 4v16m8-8H4"/>

                </svg>

                Tambah Pengguna

            </a>

        </div>


        {{-- SEARCH --}}
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-5">

            <form
                method="GET"
                action="{{ route('users.index') }}"
                class="flex flex-col md:flex-row gap-3">

                <div class="flex-1 relative">

                    <svg
                        class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="m21 21-4.35-4.35m2.35-5.65a8 8 0 1 1-16 0 8 8 0 0 1 16 0z"/>

                    </svg>

                    <input
                        type="text"
                        name="q"
                        value="{{ $keyword }}"
                        placeholder="Cari nama, email, atau role..."
                        class="w-full pl-10 pr-4 py-2.5 rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">

                </div>

                <button
                    type="submit"
                    class="px-5 py-2.5 bg-gray-800 text-white rounded-lg hover:bg-gray-900 transition">

                    Cari

                </button>

                @if ($keyword)

                    <a
                        href="{{ route('users.index') }}"
                        class="px-5 py-2.5 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 text-center">

                        Reset

                    </a>

                @endif

            </form>

        </div>


        {{-- TABLE --}}
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">

            <div class="px-6 py-4 border-b border-gray-200">

                <div class="flex items-center justify-between">

                    <div>

                        <h2 class="text-lg font-semibold text-gray-800">
                            Daftar Pengguna
                        </h2>

                        <p class="text-sm text-gray-500 mt-1">
                            {{ $users->total() }} pengguna terdaftar.
                        </p>

                    </div>

                </div>

            </div>


            <div class="overflow-x-auto">

                <table class="min-w-full divide-y divide-gray-200">

                    <thead class="bg-gray-50">

                        <tr>

                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">
                                Pengguna
                            </th>

                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">
                                Role
                            </th>

                            <th class="px-6 py-3 text-center text-xs font-semibold text-gray-500 uppercase">
                                Status
                            </th>

                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">
                                Login Terakhir
                            </th>

                            <th class="px-6 py-3 text-right text-xs font-semibold text-gray-500 uppercase">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-gray-100">

                        @forelse ($users as $user)

                            <tr class="hover:bg-gray-50">

                                {{-- USER --}}
                                <td class="px-6 py-4">

                                    <div class="flex items-center">

                                        <div class="w-10 h-10 rounded-full bg-indigo-100 text-indigo-700 flex items-center justify-center font-semibold">

                                            {{ strtoupper(substr($user->name, 0, 1)) }}

                                        </div>

                                        <div class="ml-3">

                                            <div class="font-medium text-gray-800">
                                                {{ $user->name }}

                                                @if (auth()->id() === $user->id)

                                                    <span class="ml-1 text-xs text-indigo-600">
                                                        (Anda)
                                                    </span>

                                                @endif

                                            </div>

                                            <div class="text-sm text-gray-500">
                                                {{ $user->email }}
                                            </div>

                                        </div>

                                    </div>

                                </td>


                                {{-- ROLE --}}
                                <td class="px-6 py-4">

                                    @if ($user->role === 'admin')

                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-purple-100 text-purple-700">
                                            Admin
                                        </span>

                                    @elseif ($user->role === 'petugas')

                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-700">
                                            Petugas
                                        </span>

                                    @else

                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-700">
                                            Pimpinan
                                        </span>

                                    @endif

                                </td>


                                {{-- STATUS --}}
                                <td class="px-6 py-4 text-center">

                                    @if ($user->is_active)

                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">

                                            <span class="w-1.5 h-1.5 rounded-full bg-green-500 mr-1.5"></span>

                                            Aktif

                                        </span>

                                    @else

                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700">

                                            <span class="w-1.5 h-1.5 rounded-full bg-red-500 mr-1.5"></span>

                                            Nonaktif

                                        </span>

                                    @endif

                                </td>


                                {{-- LAST LOGIN --}}
                                <td class="px-6 py-4 text-sm text-gray-500">

                                    @if ($user->last_login_at)

                                        {{ $user->last_login_at->format('d/m/Y H:i') }}

                                    @else

                                        <span class="text-gray-400">
                                            Belum pernah login
                                        </span>

                                    @endif

                                </td>


                                {{-- ACTION --}}
                                <td class="px-6 py-4">

                                    <div class="flex items-center justify-end gap-2">

                                        {{-- EDIT --}}
                                        <a
                                            href="{{ route('users.edit', $user) }}"
                                            title="Edit pengguna"
                                            class="p-2 text-indigo-600 bg-indigo-50 rounded-lg hover:bg-indigo-100">

                                            <svg class="w-4 h-4"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24">

                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M11 5h2m-7 7h2m8-7h2m-6 10h6M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>

                                            </svg>

                                        </a>


                                        {{-- RESET PASSWORD --}}
                                        <button
                                            type="button"
                                            onclick="openResetModal({{ $user->id }}, '{{ addslashes($user->name) }}')"
                                            title="Reset password"
                                            class="p-2 text-amber-600 bg-amber-50 rounded-lg hover:bg-amber-100">

                                            <svg class="w-4 h-4"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24">

                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M15 7a3 3 0 11-6 0 3 3 0 016 0zM5.5 20a6.5 6.5 0 0113 0M19 8v4m0 0l2-2m-2 2l-2-2"/>

                                            </svg>

                                        </button>


                                        {{-- STATUS --}}
                                        @if (auth()->id() !== $user->id)

                                            <form
                                                method="POST"
                                                action="{{ route('users.toggle-status', $user) }}">

                                                @csrf
                                                @method('PATCH')

                                                <button
                                                    type="submit"
                                                    title="{{ $user->is_active ? 'Nonaktifkan' : 'Aktifkan' }}"
                                                    class="p-2 {{ $user->is_active
                                                        ? 'text-red-600 bg-red-50 hover:bg-red-100'
                                                        : 'text-green-600 bg-green-50 hover:bg-green-100' }} rounded-lg">

                                                    @if ($user->is_active)

                                                        <svg class="w-4 h-4"
                                                            fill="none"
                                                            stroke="currentColor"
                                                            viewBox="0 0 24 24">

                                                            <path
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M18.364 5.636A9 9 0 115.636 18.364M9 9l6 6"/>

                                                        </svg>

                                                    @else

                                                        <svg class="w-4 h-4"
                                                            fill="none"
                                                            stroke="currentColor"
                                                            viewBox="0 0 24 24">

                                                            <path
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M5 13l4 4L19 7"/>

                                                        </svg>

                                                    @endif

                                                </button>

                                            </form>

                                        @endif


                                        {{-- DELETE --}}
                                        @if (auth()->id() !== $user->id)

                                            <form
                                                method="POST"
                                                action="{{ route('users.destroy', $user) }}"
                                                onsubmit="return confirm('Hapus pengguna {{ addslashes($user->name) }}? Data akun ini akan dihapus dan tidak dapat digunakan lagi.')">

                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    title="Hapus pengguna"
                                                    class="p-2 text-red-600 bg-red-50 rounded-lg hover:bg-red-100">

                                                    <svg class="w-4 h-4"
                                                        fill="none"
                                                        stroke="currentColor"
                                                        viewBox="0 0 24 24">

                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-8 0h10"/>

                                                    </svg>

                                                </button>

                                            </form>

                                        @endif

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="5" class="px-6 py-12 text-center">

                                    <div class="text-gray-400">

                                        <svg
                                            class="w-12 h-12 mx-auto mb-3"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24">

                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="1.5"
                                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>

                                        </svg>

                                        <p class="font-medium">
                                            Tidak ada pengguna ditemukan.
                                        </p>

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- PAGINATION --}}
            @if ($users->hasPages())

                <div class="px-6 py-4 border-t border-gray-200">

                    {{ $users->links() }}

                </div>

            @endif

        </div>

    </div>


    {{-- RESET PASSWORD MODAL --}}
    <div
        id="resetPasswordModal"
        class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 px-4">

        <div class="bg-white rounded-xl shadow-xl w-full max-w-md">

            <div class="px-6 py-5 border-b border-gray-200">

                <h3 class="text-lg font-semibold text-gray-800">
                    Reset Password
                </h3>

                <p class="text-sm text-gray-500 mt-1">
                    Buat password baru untuk
                    <span id="resetUserName" class="font-medium text-gray-700"></span>.
                </p>

            </div>


            <form
                id="resetPasswordForm"
                method="POST">

                @csrf
                @method('PUT')

                <div class="p-6 space-y-4">

                    <div>

                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Password Baru
                        </label>

                        <input
                            type="password"
                            name="password"
                            required
                            minlength="8"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">

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

                    <div class="rounded-lg bg-amber-50 border border-amber-200 p-3">

                        <p class="text-xs text-amber-700">
                            Pastikan password baru diberikan kepada pengguna yang bersangkutan.
                        </p>

                    </div>

                </div>


                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end gap-3">

                    <button
                        type="button"
                        onclick="closeResetModal()"
                        class="px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">

                        Batal

                    </button>

                    <button
                        type="submit"
                        class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">

                        Reset Password

                    </button>

                </div>

            </form>

        </div>

    </div>


    <script>

        function openResetModal(userId, userName)
        {
            const modal = document.getElementById('resetPasswordModal');
            const form = document.getElementById('resetPasswordForm');
            const name = document.getElementById('resetUserName');

            form.action = `/pengaturan/pengguna/${userId}/reset-password`;

            name.textContent = userName;

            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }


        function closeResetModal()
        {
            const modal = document.getElementById('resetPasswordModal');

            modal.classList.add('hidden');
            modal.classList.remove('flex');

            document
                .getElementById('resetPasswordForm')
                .reset();
        }


        document
            .getElementById('resetPasswordModal')
            .addEventListener('click', function (event) {

                if (event.target === this) {
                    closeResetModal();
                }

            });

    </script>

</x-app-layout>