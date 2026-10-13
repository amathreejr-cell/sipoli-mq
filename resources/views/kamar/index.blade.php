<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Data Kamar
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-6 bg-white border border-gray-200 shadow-sm sm:rounded-lg">
                    <div class="p-4 text-sm text-gray-700">
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">

                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">
                                Daftar Kamar
                            </h3>
                            <p class="text-sm text-gray-500 mt-1">
                                Data kamar/asrama santri.
                            </p>
                        </div>

                        @if (in_array(auth()->user()->role, ['admin', 'petugas']))
                            <a
                                href="{{ route('kamar.create') }}"
                                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700"
                            >
                                Tambah Kamar
                            </a>
                        @endif
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">
                                        Kode
                                    </th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">
                                        Nama Kamar
                                    </th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">
                                        Keterangan
                                    </th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">
                                        Status
                                    </th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200">
                                @forelse ($kamars as $kamar)
                                    <tr>
                                        <td class="px-4 py-3 text-sm text-gray-700">
                                            {{ $kamar->kode }}
                                        </td>

                                        <td class="px-4 py-3 text-sm font-medium text-gray-900">
                                            {{ $kamar->nama }}
                                        </td>

                                        <td class="px-4 py-3 text-sm text-gray-700">
                                            {{ $kamar->keterangan ?? '-' }}
                                        </td>

                                        <td class="px-4 py-3 text-sm">
                                            @if ($kamar->is_active)
                                                <span class="px-2 py-1 text-xs rounded bg-green-100 text-green-700">
                                                    Aktif
                                                </span>
                                            @else
                                                <span class="px-2 py-1 text-xs rounded bg-gray-100 text-gray-700">
                                                    Nonaktif
                                                </span>
                                            @endif
                                        </td>

                                        <td class="px-4 py-3 text-sm">
                                            <a
                                                href="{{ route('kamar.show', $kamar) }}"
                                                class="text-gray-700 hover:underline"
                                            >
                                                Detail
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td
                                            colspan="5"
                                            class="px-4 py-6 text-center text-sm text-gray-500"
                                        >
                                            Belum ada data kamar.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6">
                        {{ $kamars->links() }}
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>