<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Obat
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-6 bg-white border border-gray-200 shadow-sm sm:rounded-lg">
                    <div class="p-4 text-sm text-gray-700">
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            {{-- Informasi Obat --}}
            <div class="bg-white shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">

                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">
                                {{ $obat->nama }}
                            </h3>

                            <p class="text-sm text-gray-500">
                                Kode: {{ $obat->kode }}
                            </p>
                        </div>

                        <div>
                            @if ($obat->is_active)
                                <span class="px-3 py-1 text-sm rounded-full bg-green-100 text-green-700">
                                    Aktif
                                </span>
                            @else
                                <span class="px-3 py-1 text-sm rounded-full bg-gray-100 text-gray-600">
                                    Nonaktif
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <div>
                            <p class="text-sm text-gray-500">Bentuk</p>
                            <p class="font-medium text-gray-800">
                                {{ $obat->bentuk }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">Satuan</p>
                            <p class="font-medium text-gray-800">
                                {{ $obat->satuan }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">Stok</p>
                            <p class="font-medium text-gray-800">
                                {{ $obat->stok }}

                                @if ($obat->stok <= $obat->stok_minimum)
                                    <span class="ml-2 text-sm text-red-600">
                                        Stok Minimum
                                    </span>
                                @endif
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">Stok Minimum</p>
                            <p class="font-medium text-gray-800">
                                {{ $obat->stok_minimum }}
                            </p>
                        </div>

                        <div class="md:col-span-2">
                            <p class="text-sm text-gray-500">Keterangan</p>
                            <p class="font-medium text-gray-800">
                                {{ $obat->keterangan ?: '-' }}
                            </p>
                        </div>

                    </div>

                    <div class="flex items-center gap-3 mt-6">

                        <a href="{{ route('obat.index') }}"
                            class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">
                            Kembali
                        </a>

                        @if (in_array(auth()->user()->role, ['admin', 'petugas']))
                            <a href="{{ route('obat.edit', $obat) }}"
                                class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                                Edit
                            </a>
                        @endif

                        @if (auth()->user()->role === 'admin' && $obat->is_active)
                            <form method="POST" action="{{ route('obat.destroy', $obat) }}"
                                onsubmit="return confirm('Nonaktifkan obat ini?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                    class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                                    Nonaktifkan
                                </button>
                            </form>
                        @endif

                    </div>

                </div>
            </div>

            {{-- Riwayat Penggunaan --}}
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">

                    <h3 class="text-lg font-semibold text-gray-800 mb-4">
                        Riwayat Penggunaan Obat
                    </h3>

                    @if ($obat->resepDetails->count())
                        <div class="overflow-x-auto">

                            <table class="min-w-full divide-y divide-gray-200">
                                <thead>
                                    <tr class="text-left text-sm text-gray-600">
                                        <th class="px-4 py-3">Tanggal</th>
                                        <th class="px-4 py-3">Santri</th>
                                        <th class="px-4 py-3">Jumlah</th>
                                        <th class="px-4 py-3">Dosis</th>
                                        <th class="px-4 py-3">Frekuensi</th>
                                        <th class="px-4 py-3">Aturan Pakai</th>
                                    </tr>
                                </thead>

                                <tbody class="divide-y divide-gray-200">

                                    @foreach ($obat->resepDetails as $detail)
                                        @php
                                            $kunjungan = $detail->resep?->kunjungan;
                                            $santri = $kunjungan?->santri;
                                        @endphp

                                        <tr class="text-sm">

                                            <td class="px-4 py-3">
                                                {{ $kunjungan?->tanggal?->format('d-m-Y') ?? '-' }}
                                            </td>

                                            <td class="px-4 py-3">
                                                {{ $santri?->nama ?? '-' }}
                                            </td>

                                            <td class="px-4 py-3">
                                                {{ $detail->jumlah }}
                                                {{ $obat->satuan }}
                                            </td>

                                            <td class="px-4 py-3">
                                                {{ $detail->dosis }}
                                            </td>

                                            <td class="px-4 py-3">
                                                {{ $detail->frekuensi }}
                                            </td>

                                            <td class="px-4 py-3">
                                                {{ $detail->aturan_pakai }}
                                            </td>

                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>

                        </div>
                    @else
                        <p class="text-sm text-gray-500">
                            Belum ada riwayat penggunaan obat.
                        </p>
                    @endif

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
