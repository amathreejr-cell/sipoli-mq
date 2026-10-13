<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Wali Santri
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-6 bg-white border border-gray-200 shadow-sm sm:rounded-lg">
                    <div class="p-4 text-sm text-gray-700">
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 bg-white border border-red-200 shadow-sm sm:rounded-lg">
                    <div class="p-4 text-sm text-red-600">
                        {{ session('error') }}
                    </div>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">

                    {{-- Informasi Wali --}}
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">
                            Informasi Wali
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                            <div>
                                <p class="text-sm text-gray-500">
                                    Nama Wali
                                </p>
                                <p class="font-medium text-gray-900">
                                    {{ $waliSantri->nama }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-gray-500">
                                    Hubungan
                                </p>
                                <p class="font-medium text-gray-900">
                                    {{ $waliSantri->hubungan }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-gray-500">
                                    Nomor HP
                                </p>
                                <p class="font-medium text-gray-900">
                                    {{ $waliSantri->no_hp ?? '-' }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-gray-500">
                                    Jumlah Santri
                                </p>
                                <p class="font-medium text-gray-900">
                                    {{ $waliSantri->santris->count() }} santri
                                </p>
                            </div>

                            <div class="md:col-span-2">
                                <p class="text-sm text-gray-500">
                                    Alamat
                                </p>
                                <p class="font-medium text-gray-900">
                                    {{ $waliSantri->alamat ?? '-' }}
                                </p>
                            </div>

                        </div>
                    </div>

                    {{-- Santri yang Terhubung --}}
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">
                            Santri yang Terhubung
                        </h3>

                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">

                                <thead>
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">
                                            No
                                        </th>

                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">
                                            Nomor Induk
                                        </th>

                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">
                                            Nama Santri
                                        </th>

                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">
                                            Kamar
                                        </th>

                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">
                                            Angkatan
                                        </th>

                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>

                                <tbody class="divide-y divide-gray-200">

                                    @forelse ($waliSantri->santris as $index => $santri)
                                        <tr>

                                            <td class="px-4 py-3 text-sm text-gray-700">
                                                {{ $index + 1 }}
                                            </td>

                                            <td class="px-4 py-3 text-sm text-gray-700">
                                                {{ $santri->nomor_induk }}
                                            </td>

                                            <td class="px-4 py-3 text-sm font-medium text-gray-900">
                                                {{ $santri->nama }}
                                            </td>

                                            <td class="px-4 py-3 text-sm text-gray-700">
                                                {{ $santri->kamar->nama ?? '-' }}
                                            </td>

                                            <td class="px-4 py-3 text-sm text-gray-700">
                                                {{ $santri->angkatan->nama ?? '-' }}
                                            </td>

                                            <td class="px-4 py-3 text-sm">
                                                <a href="{{ route('santri.show', $santri) }}"
                                                    class="text-gray-700 hover:underline">
                                                    Detail
                                                </a>
                                            </td>

                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="px-4 py-6 text-center text-sm text-gray-500">
                                                Belum ada santri yang terhubung dengan wali ini.
                                            </td>
                                        </tr>
                                    @endforelse

                                </tbody>

                            </table>
                        </div>
                    </div>

                    {{-- Tombol --}}
                    <div class="mt-6 flex items-center gap-3">

                        <a href="{{ route('wali-santri.index') }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-200 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300">
                            Kembali
                        </a>

                        @if (in_array(auth()->user()->role, ['admin', 'petugas']))
                            <a href="{{ route('wali-santri.edit', $waliSantri) }}"
                                class="inline-flex items-center px-4 py-2 bg-gray-800 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                                Edit
                            </a>
                        @endif

                        @if (auth()->user()->role === 'admin')
                            <form method="POST" action="{{ route('wali-santri.destroy', $waliSantri) }}"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus data wali santri ini?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                    class="inline-flex items-center px-4 py-2 bg-red-600 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500">
                                    Hapus
                                </button>
                            </form>
                        @endif

                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
