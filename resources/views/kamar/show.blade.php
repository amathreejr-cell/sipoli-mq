<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Kamar
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

            {{-- Informasi Kamar --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">

                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">
                                {{ $kamar->nama }}
                            </h3>

                            <p class="text-sm text-gray-500 mt-1">
                                {{ $kamar->kode }}
                            </p>
                        </div>

                        @if ($kamar->is_active)
                            <span class="px-3 py-1 text-xs rounded bg-green-100 text-green-700">
                                Aktif
                            </span>
                        @else
                            <span class="px-3 py-1 text-xs rounded bg-gray-100 text-gray-700">
                                Nonaktif
                            </span>
                        @endif
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>
                            <p class="text-sm text-gray-500">
                                Kode Kamar
                            </p>

                            <p class="mt-1 text-sm font-medium text-gray-900">
                                {{ $kamar->kode }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">
                                Nama Kamar
                            </p>

                            <p class="mt-1 text-sm font-medium text-gray-900">
                                {{ $kamar->nama }}
                            </p>
                        </div>

                        <div class="md:col-span-2">
                            <p class="text-sm text-gray-500">
                                Keterangan
                            </p>

                            <p class="mt-1 text-sm text-gray-900">
                                {{ $kamar->keterangan ?? '-' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">
                                Jumlah Santri
                            </p>

                            <p class="mt-1 text-lg font-semibold text-gray-900">
                                {{ $kamar->santris->count() }}
                            </p>
                        </div>

                    </div>

                </div>
            </div>

            {{-- Daftar Santri --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">

                    <h3 class="text-lg font-semibold text-gray-800 mb-6">
                        Santri di Kamar Ini
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
                                        Jenis Kelamin
                                    </th>

                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">
                                        Status
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200">

                                @forelse ($kamar->santris as $index => $santri)
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
                                            {{ $santri->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}
                                        </td>

                                        <td class="px-4 py-3 text-sm">
                                            @if ($santri->status === 'aktif')
                                                <span class="px-2 py-1 text-xs rounded bg-green-100 text-green-700">
                                                    Aktif
                                                </span>
                                            @else
                                                <span class="px-2 py-1 text-xs rounded bg-gray-100 text-gray-700">
                                                    Nonaktif
                                                </span>
                                            @endif
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td
                                            colspan="5"
                                            class="px-4 py-6 text-center text-sm text-gray-500"
                                        >
                                            Belum ada santri di kamar ini.
                                        </td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>

                    <div class="flex gap-3 mt-6">

                        <a
                            href="{{ route('kamar.index') }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300"
                        >
                            Kembali
                        </a>

                        @if (in_array(auth()->user()->role, ['admin', 'petugas']))
                            <a
                                href="{{ route('kamar.edit', $kamar) }}"
                                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700"
                            >
                                Edit Kamar
                            </a>
                        @endif

                        @if (auth()->user()->role === 'admin' && $kamar->is_active)
                            <form
                                action="{{ route('kamar.destroy', $kamar) }}"
                                method="POST"
                                onsubmit="return confirm('Yakin ingin menonaktifkan kamar ini?')"
                            >
                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700"
                                >
                                    Nonaktifkan
                                </button>
                            </form>
                        @endif

                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>