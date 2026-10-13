<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Alergi
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            {{-- Pesan sukses --}}
            @if (session('success'))
                <div class="mb-6 bg-white border border-green-200 shadow-sm sm:rounded-lg">
                    <div class="p-4 text-sm text-green-600">
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            {{-- Detail --}}
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">

                    <h3 class="text-lg font-semibold text-gray-800 mb-6">
                        Informasi Alergi
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                        <div>
                            <p class="text-sm text-gray-500">Santri</p>
                            <p class="font-medium text-gray-800">
                                {{ $alergi->santri?->nama ?? '-' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">Nomor Induk</p>
                            <p class="font-medium text-gray-800">
                                {{ $alergi->santri?->nomor_induk ?? '-' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">Jenis Alergi</p>
                            <p class="font-medium text-gray-800">
                                {{ $alergi->jenis }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">Nama Alergi / Pemicu</p>
                            <p class="font-medium text-gray-800">
                                {{ $alergi->nama }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">Reaksi</p>
                            <p class="font-medium text-gray-800">
                                {{ $alergi->reaksi ?: '-' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">Tanggal Dicatat</p>
                            <p class="font-medium text-gray-800">
                                {{ $alergi->created_at?->format('d-m-Y H:i') ?? '-' }}
                            </p>
                        </div>

                        <div class="md:col-span-2">
                            <p class="text-sm text-gray-500">Keterangan</p>
                            <p class="font-medium text-gray-800">
                                {{ $alergi->keterangan ?: '-' }}
                            </p>
                        </div>

                    </div>

                    {{-- Tombol --}}
                    <div class="flex items-center gap-3 mt-6">

                        <a
                            href="{{ route('alergi.index') }}"
                            class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300"
                        >
                            Kembali
                        </a>

                        @if (in_array(auth()->user()->role, ['admin', 'petugas']))
                            <a
                                href="{{ route('alergi.edit', $alergi) }}"
                                class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700"
                            >
                                Edit
                            </a>
                        @endif

                        @if (auth()->user()->role === 'admin')
                            <form
                                method="POST"
                                action="{{ route('alergi.destroy', $alergi) }}"
                                onsubmit="return confirm('Hapus data alergi ini?')"
                            >
                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700"
                                >
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