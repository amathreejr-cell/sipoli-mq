<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Detail Santri
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Informasi lengkap data santri
                </p>
            </div>

            <div class="flex items-center gap-2">
                <a href="{{ route('santri.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300">
                    Kembali
                </a>

                @if (in_array(auth()->user()->role, ['admin', 'petugas']))
                    <a href="{{ route('santri.edit', $santri) }}"
                        class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                        Edit Santri
                    </a>
                @endif

                @if (auth()->user()->role === 'admin' && $santri->status === 'aktif')
                    <form action="{{ route('santri.destroy', $santri) }}" method="POST"
                        onsubmit="return confirm('Yakin ingin menonaktifkan santri ini?')">
                        @csrf
                        @method('DELETE')

                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700">
                            Nonaktifkan
                        </button>
                    </form>
                @endif
            </div>
        </div>
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

            {{-- Informasi Santri --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">

                    <h3 class="text-lg font-semibold text-gray-800 mb-6">
                        Informasi Santri
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        {{-- Nomor Induk --}}
                        <div>
                            <p class="text-sm text-gray-500">
                                Nomor Induk
                            </p>

                            <p class="font-medium text-gray-900 mt-1">
                                {{ $santri->nomor_induk }}
                            </p>
                        </div>

                        {{-- Nama --}}
                        <div>
                            <p class="text-sm text-gray-500">
                                Nama
                            </p>

                            <p class="font-medium text-gray-900 mt-1">
                                {{ $santri->nama }}
                            </p>
                        </div>

                        {{-- Tempat Lahir --}}
                        <div>
                            <p class="text-sm text-gray-500">
                                Tempat Lahir
                            </p>

                            <p class="font-medium text-gray-900 mt-1">
                                {{ $santri->tempat_lahir ?? '-' }}
                            </p>
                        </div>

                        {{-- Jenis Kelamin --}}
                        <div>
                            <p class="text-sm text-gray-500">
                                Jenis Kelamin
                            </p>

                            <p class="font-medium text-gray-900 mt-1">
                                {{ $santri->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}
                            </p>
                        </div>

                        {{-- Tanggal Lahir --}}
                        <div>
                            <p class="text-sm text-gray-500">
                                Tanggal Lahir
                            </p>

                            <p class="font-medium text-gray-900 mt-1">
                                {{ $santri->tanggal_lahir?->format('d-m-Y') ?? '-' }}
                            </p>
                        </div>

                        {{-- Status --}}
                        <div>
                            <p class="text-sm text-gray-500">
                                Status
                            </p>

                            <p class="font-medium text-gray-900 mt-1 capitalize">
                                {{ $santri->status }}
                            </p>
                        </div>

                    </div>

                </div>
            </div>

            {{-- Data Pendidikan dan Kamar --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">

                    <h3 class="text-lg font-semibold text-gray-800 mb-6">
                        Data Santri
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        {{-- Kamar --}}
                        <div>
                            <p class="text-sm text-gray-500">
                                Kamar
                            </p>

                            <p class="font-medium text-gray-900 mt-1">
                                {{ $santri->kamar ?? '-' }}
                            </p>
                        </div>

                        {{-- Sekolah --}}
                        <div>
                            <p class="text-sm text-gray-500">
                                Sekolah
                            </p>

                            <p class="font-medium text-gray-900 mt-1">
                                {{ $santri->sekolah ?? '-' }}
                            </p>
                        </div>

                        {{-- Kelas --}}
                        <div>
                            <p class="text-sm text-gray-500">
                                Kelas
                            </p>

                            <p class="font-medium text-gray-900 mt-1">
                                {{ $santri->kelas ?? '-' }}
                            </p>
                        </div>

                        {{-- Alamat --}}
                        <div class="md:col-span-2">
                            <p class="text-sm text-gray-500">
                                Alamat
                            </p>

                            <p class="font-medium text-gray-900 mt-1">
                                {{ $santri->alamat ?? '-' }}
                            </p>
                        </div>

                    </div>

                </div>
            </div>

            {{-- Data Alergi --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">

                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-semibold text-gray-800">
                            Riwayat Alergi
                        </h3>

                        @if (in_array(auth()->user()->role, ['admin', 'petugas']))
                            <a href="{{ route('alergi.create') }}"
                                class="text-sm text-indigo-600 hover:text-indigo-900">
                                Tambah Alergi
                            </a>
                        @endif
                    </div>

                    @if ($santri->alergis->count())

                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">

                                <thead>
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                            Jenis
                                        </th>

                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                            Nama
                                        </th>

                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                            Reaksi
                                        </th>

                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                            Keterangan
                                        </th>
                                    </tr>
                                </thead>

                                <tbody class="divide-y divide-gray-200">

                                    @foreach ($santri->alergis as $alergi)

                                        <tr>
                                            <td class="px-4 py-3 text-sm text-gray-700">
                                                {{ $alergi->jenis }}
                                            </td>

                                            <td class="px-4 py-3 text-sm text-gray-700">
                                                {{ $alergi->nama }}
                                            </td>

                                            <td class="px-4 py-3 text-sm text-gray-700">
                                                {{ $alergi->reaksi ?? '-' }}
                                            </td>

                                            <td class="px-4 py-3 text-sm text-gray-700">
                                                {{ $alergi->keterangan ?? '-' }}
                                            </td>
                                        </tr>

                                    @endforeach

                                </tbody>

                            </table>
                        </div>

                    @else

                        <p class="text-sm text-gray-500">
                            Belum ada data alergi.
                        </p>

                    @endif

                </div>
            </div>

        </div>
    </div>
</x-app-layout>