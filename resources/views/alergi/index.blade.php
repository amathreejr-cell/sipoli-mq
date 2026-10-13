<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Data Alergi Santri
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-6 bg-white border border-green-200 shadow-sm sm:rounded-lg">
                    <div class="p-4 text-sm text-green-600">
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">

                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">
                                Daftar Alergi
                            </h3>

                            <p class="text-sm text-gray-500">
                                Data alergi yang tercatat pada santri.
                            </p>
                        </div>

                        @if (in_array(auth()->user()->role, ['admin', 'petugas']))
                            <a
                                href="{{ route('alergi.create') }}"
                                class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700"
                            >
                                + Tambah Alergi
                            </a>
                        @endif
                    </div>

                    @if ($alergis->count())
                        <div class="overflow-x-auto">

                            <table class="min-w-full divide-y divide-gray-200">

                                <thead>
                                    <tr class="text-left text-sm text-gray-600">
                                        <th class="px-4 py-3">No</th>
                                        <th class="px-4 py-3">Santri</th>
                                        <th class="px-4 py-3">Jenis</th>
                                        <th class="px-4 py-3">Nama Alergi</th>
                                        <th class="px-4 py-3">Reaksi</th>
                                        <th class="px-4 py-3">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody class="divide-y divide-gray-200">

                                    @foreach ($alergis as $alergi)
                                        <tr class="text-sm">

                                            <td class="px-4 py-3">
                                                {{ $alergis->firstItem() + $loop->index }}
                                            </td>

                                            <td class="px-4 py-3 font-medium text-gray-800">
                                                {{ $alergi->santri?->nama ?? '-' }}
                                            </td>

                                            <td class="px-4 py-3">
                                                {{ $alergi->jenis }}
                                            </td>

                                            <td class="px-4 py-3">
                                                {{ $alergi->nama }}
                                            </td>

                                            <td class="px-4 py-3">
                                                {{ $alergi->reaksi ?: '-' }}
                                            </td>

                                            <td class="px-4 py-3">
                                                <a
                                                    href="{{ route('alergi.show', $alergi) }}"
                                                    class="text-indigo-600 hover:text-indigo-900"
                                                >
                                                    Detail
                                                </a>
                                            </td>

                                        </tr>
                                    @endforeach

                                </tbody>

                            </table>

                        </div>

                        <div class="mt-6">
                            {{ $alergis->links() }}
                        </div>

                    @else
                        <div class="py-8 text-center">
                            <p class="text-gray-500">
                                Belum ada data alergi.
                            </p>
                        </div>
                    @endif

                </div>
            </div>

        </div>
    </div>
</x-app-layout>