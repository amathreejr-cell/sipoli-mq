<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Data Wali Santri
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
                                Daftar Wali Santri
                            </h3>

                            <p class="text-sm text-gray-500 mt-1">
                                Data orang tua atau wali santri.
                            </p>
                        </div>

                        @if (in_array(auth()->user()->role, ['admin', 'petugas']))
                            <a
                                href="{{ route('wali-santri.create') }}"
                                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700"
                            >
                                Tambah Wali Santri
                            </a>
                        @endif
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">

                            <thead>
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">
                                        No
                                    </th>

                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">
                                        Nama
                                    </th>

                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">
                                        Hubungan
                                    </th>

                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">
                                        No. HP
                                    </th>

                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">
                                        Jumlah Santri
                                    </th>

                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200">

                                @forelse ($waliSantris as $index => $wali)
                                    <tr>

                                        <td class="px-4 py-3 text-sm text-gray-700">
                                            {{ $waliSantris->firstItem() + $index }}
                                        </td>

                                        <td class="px-4 py-3 text-sm font-medium text-gray-900">
                                            {{ $wali->nama }}
                                        </td>

                                        <td class="px-4 py-3 text-sm text-gray-700">
                                            {{ $wali->hubungan }}
                                        </td>

                                        <td class="px-4 py-3 text-sm text-gray-700">
                                            {{ $wali->no_hp ?? '-' }}
                                        </td>

                                        <td class="px-4 py-3 text-sm text-gray-700">
                                            {{ $wali->santris_count }}
                                        </td>

                                        <td class="px-4 py-3 text-sm">
                                            <a
                                                href="{{ route('wali-santri.show', $wali) }}"
                                                class="text-gray-700 hover:underline"
                                            >
                                                Detail
                                            </a>
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td
                                            colspan="6"
                                            class="px-4 py-6 text-center text-sm text-gray-500"
                                        >
                                            Belum ada data wali santri.
                                        </td>
                                    </tr>
                                @endforelse

                            </tbody>

                        </table>
                    </div>

                    <div class="mt-6">
                        {{ $waliSantris->links() }}
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>