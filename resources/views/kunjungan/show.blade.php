<x-app-layout>

    <x-slot name="header">
        <div>
            <p class="text-sm text-gray-500">Pelayanan Poliklinik</p>
            <h2 class="text-2xl font-bold text-gray-800">
                Detail Kunjungan
            </h2>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- ========================= --}}
            {{-- ALERT --}}
            {{-- ========================= --}}

            @if (session('success'))
                <div
                    class="mb-5 flex items-center gap-3 rounded-xl border border-green-200 bg-green-50 px-5 py-4 text-sm text-green-700">
                    <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m5.5 0A8.5 8.5 0 1112 3.5 8.5 8.5 0 0120.5 12z" />
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if (session('error'))
                <div
                    class="mb-5 flex items-center gap-3 rounded-xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-700">
                    <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M10.3 3.9l-8 14A2 2 0 004 21h16a2 2 0 001.7-3.1l-8-14a2 2 0 00-3.4 0z" />
                    </svg>
                    <span>{{ session('error') }}</span>
                </div>
            @endif


            {{-- ========================= --}}
            {{-- HEADER KUNJUNGAN --}}
            {{-- ========================= --}}

            <div class="mb-6 overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-100">

                <div class="border-b border-gray-100 px-6 py-6">
                    <div class="flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">

                        <div class="flex items-start gap-4">

                            <div
                                class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-600">
                                <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                        d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01" />
                                </svg>
                            </div>

                            <div>
                                <div class="flex flex-wrap items-center gap-3">
                                    <h3 class="text-xl font-bold text-gray-800">
                                        {{ $kunjungan->kode_kunjungan }}
                                    </h3>

                                    @if ($kunjungan->status === 'menunggu')
                                        <span
                                            class="rounded-full bg-yellow-100 px-3 py-1 text-xs font-semibold text-yellow-700">
                                            Menunggu
                                        </span>
                                    @elseif ($kunjungan->status === 'diperiksa')
                                        <span
                                            class="rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700">
                                            Diperiksa
                                        </span>
                                    @elseif ($kunjungan->status === 'selesai')
                                        <span
                                            class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                            Selesai
                                        </span>
                                    @else
                                        <span
                                            class="rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                                            Dibatalkan
                                        </span>
                                    @endif
                                </div>

                                <p class="mt-1 text-sm text-gray-500">
                                    Detail pelayanan dan rekam pemeriksaan santri
                                </p>
                            </div>

                        </div>


                        {{-- AKSI --}}
                        <div class="flex flex-wrap items-center gap-2">

                            @if ($kunjungan->status !== 'diperiksa')

                                @if (request('from') === 'create' && request('santri_id'))
                                    <a href="{{ route('kunjungan.create', ['santri_id' => request('santri_id')]) }}"
                                        class="rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                                        ← Kembali
                                    </a>
                                @else
                                    <a href="{{ route('kunjungan.index') }}"
                                        class="rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                                        ← Kembali
                                    </a>
                                @endif

                            @endif


                            @if (auth()->user()->role === 'admin' || (auth()->user()->role === 'petugas' && $kunjungan->status !== 'selesai'))
                                <a href="{{ route('kunjungan.edit', $kunjungan) }}"
                                    class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">
                                    Edit Kunjungan
                                </a>
                            @endif

                            @if ($kunjungan->status === 'selesai')
                                <a href="{{ route('kunjungan.surat-izin', $kunjungan) }}" target="_blank"
                                    class="inline-flex items-center gap-2 rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">

                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                            d="M6 9V2h12v7M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2M6 14h12v8H6v-8z" />
                                    </svg>

                                    Cetak Surat Izin
                                </a>
                            @endif

                            @if ($kunjungan->status === 'selesai' && $kunjungan->rujukan)
                                <a href="{{ route('kunjungan.surat-rujukan', $kunjungan) }}" target="_blank"
                                    class="inline-flex items-center gap-2 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-amber-700 transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 18h10M7 14h10M7 10h10M5 3h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2z" />
                                    </svg>
                                    Cetak Surat Rujukan
                                </a>
                            @endif

                            @if ($kunjungan->status === 'selesai')
                                <a href="{{ route('kunjungan.rekam-medis', $kunjungan) }}" target="_blank"
                                    class="inline-flex items-center gap-2 px-4 py-2 bg-slate-700 text-white rounded-lg hover:bg-slate-800 transition">

                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h6l5 5v11a2 2 0 01-2 2z" />
                                    </svg>

                                    Cetak Rekam Medis
                                </a>
                            @endif

                            @if ($kunjungan->status === 'selesai')
                                <a href="https://wa.me/?text={{ urlencode(
                                    "Assalamu'alaikum.\n\n" .
                                        'Berikut kami sampaikan Surat Izin Berobat santri dari ' .
                                        "Poliklinik Pondok Pesantren Madrasatul Qur'an Tebuireng.\n\n" .
                                        'Nama Santri: ' .
                                        ($kunjungan->santri?->nama ?? '-') .
                                        "\n" .
                                        'Nomor Induk: ' .
                                        ($kunjungan->santri?->nomor_induk ?? '-') .
                                        "\n" .
                                        'Tanggal: ' .
                                        ($kunjungan->tanggal?->format('d-m-Y') ?? '-') .
                                        "\n\n" .
                                        "Mohon surat izin dilampirkan pada pesan ini.\n\n" .
                                        'Terima kasih.',
                                ) }}"
                                    target="_blank"
                                    class="inline-flex items-center gap-2 rounded-lg bg-green-600 px-4 py-2 text-sm font-semibold text-white hover:bg-green-700">

                                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M20.52 3.48A11.86 11.86 0 0012.06 0C5.52 0 .2 5.32.2 11.86c0 2.09.55 4.13 1.6 5.93L.1 24l6.35-1.67a11.84 11.84 0 005.61 1.43h.01c6.54 0 11.86-5.32 11.86-11.86 0-3.17-1.23-6.15-3.41-8.42z" />
                                    </svg>

                                    Kirim via WhatsApp
                                </a>
                            @endif

                            @if (in_array(auth()->user()->role, ['admin', 'petugas']))
                                @if ($kunjungan->status === 'menunggu')
                                    <a href="{{ route('pemeriksaan.create', $kunjungan) }}"
                                        class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">
                                        Mulai Pemeriksaan
                                    </a>
                                @endif
                            @endif


                            @if (auth()->user()->role === 'admin' && $kunjungan->status !== 'dibatalkan')
                                <form method="POST" action="{{ route('kunjungan.destroy', $kunjungan) }}"
                                    onsubmit="return confirm('Batalkan kunjungan ini?')">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        class="rounded-lg bg-red-50 px-4 py-2 text-sm font-semibold text-red-600 hover:bg-red-100">
                                        Batalkan
                                    </button>

                                </form>
                            @endif

                        </div>

                    </div>
                </div>


                {{-- INFORMASI DASAR --}}
                <div class="grid grid-cols-1 gap-6 bg-gray-50/70 px-6 py-5 sm:grid-cols-2 lg:grid-cols-4">

                    <div>
                        <p class="text-xs font-medium uppercase tracking-wide text-gray-400">
                            Santri
                        </p>
                        <p class="mt-1 font-semibold text-gray-800">
                            {{ $kunjungan->santri?->nama ?? '-' }}
                        </p>
                        <p class="text-sm text-gray-500">
                            {{ $kunjungan->santri?->nomor_induk ?? '-' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs font-medium uppercase tracking-wide text-gray-400">
                            Petugas
                        </p>
                        <p class="mt-1 font-semibold text-gray-800">
                            {{ $kunjungan->petugas?->name ?? '-' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs font-medium uppercase tracking-wide text-gray-400">
                            Tanggal
                        </p>
                        <p class="mt-1 font-semibold text-gray-800">
                            {{ $kunjungan->tanggal?->format('d-m-Y') ?? '-' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs font-medium uppercase tracking-wide text-gray-400">
                            Waktu
                        </p>
                        <p class="mt-1 font-semibold text-gray-800">
                            {{ $kunjungan->waktu ?? '-' }}
                        </p>
                    </div>

                </div>


                {{-- KELUHAN --}}
                <div class="border-t border-gray-100 px-6 py-5">

                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">
                                Keluhan
                            </p>

                            <p class="mt-2 whitespace-pre-line text-sm leading-6 text-gray-700">
                                {{ $kunjungan->keluhan ?: '-' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">
                                Catatan
                            </p>

                            <p class="mt-2 whitespace-pre-line text-sm leading-6 text-gray-700">
                                {{ $kunjungan->catatan ?: '-' }}
                            </p>
                        </div>

                    </div>

                </div>

            </div>


            {{-- ========================= --}}
            {{-- DATA SANTRI --}}
            {{-- ========================= --}}

            <div class="mb-6 rounded-2xl bg-white shadow-sm ring-1 ring-gray-100">

                <div class="flex items-center gap-3 border-b border-gray-100 px-6 py-5">

                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2M9 11a4 4 0 100-8 4 4 0 000 8zm7-1a3 3 0 100-6m4 17v-2a4 4 0 00-3-3.87" />
                        </svg>
                    </div>

                    <div>
                        <h3 class="font-bold text-gray-800">Data Santri</h3>
                        <p class="text-sm text-gray-500">
                            Informasi identitas santri
                        </p>
                    </div>

                </div>

                <div class="grid grid-cols-1 gap-x-8 gap-y-5 px-6 py-6 sm:grid-cols-2 lg:grid-cols-3">

                    <div>
                        <p class="text-xs text-gray-400">Nama</p>
                        <p class="mt-1 font-semibold text-gray-800">
                            {{ $kunjungan->santri?->nama ?? '-' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs text-gray-400">Nomor Induk</p>
                        <p class="mt-1 font-semibold text-gray-800">
                            {{ $kunjungan->santri?->nomor_induk ?? '-' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs text-gray-400">Jenis Kelamin</p>
                        <p class="mt-1 font-semibold text-gray-800">
                            {{ $kunjungan->santri?->jenis_kelamin ?? '-' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs text-gray-400">Tempat Lahir</p>
                        <p class="mt-1 font-semibold text-gray-800">
                            {{ $kunjungan->santri?->tempat_lahir ?? '-' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs text-gray-400">Tanggal Lahir</p>
                        <p class="mt-1 font-semibold text-gray-800">
                            {{ $kunjungan->santri?->tanggal_lahir?->format('d-m-Y') ?? '-' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs text-gray-400">Kamar</p>
                        <p class="mt-1 font-semibold text-gray-800">
                            {{ $kunjungan->santri?->kamar ?? '-' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs text-gray-400">Sekolah</p>
                        <p class="mt-1 font-semibold text-gray-800">
                            {{ $kunjungan->santri?->sekolah ?? '-' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs text-gray-400">Kelas</p>
                        <p class="mt-1 font-semibold text-gray-800">
                            {{ $kunjungan->santri?->kelas ?? '-' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs text-gray-400">Status Santri</p>
                        <p class="mt-1 font-semibold text-gray-800">
                            {{ ucfirst($kunjungan->santri?->status ?? '-') }}
                        </p>
                    </div>

                </div>

            </div>


            {{-- ========================= --}}
            {{-- ALERGI --}}
            {{-- ========================= --}}

            <div class="mb-6 rounded-2xl bg-white shadow-sm ring-1 ring-gray-100">

                <div class="flex items-center gap-3 border-b border-gray-100 px-6 py-5">

                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-red-50 text-red-600">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                d="M12 9v4m0 4h.01M10.3 3.9l-8 14A2 2 0 004 21h16a2 2 0 001.7-3.1l-8-14a2 2 0 00-3.4 0z" />
                        </svg>
                    </div>

                    <div>
                        <h3 class="font-bold text-gray-800">Riwayat Alergi</h3>
                        <p class="text-sm text-gray-500">
                            Informasi alergi yang tercatat
                        </p>
                    </div>

                </div>

                <div class="p-6">

                    @if ($kunjungan->santri?->alergis?->count())

                        <div class="overflow-hidden rounded-xl border border-red-100">

                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-red-100">

                                    <thead class="bg-red-50">
                                        <tr
                                            class="text-left text-xs font-semibold uppercase tracking-wide text-red-700">
                                            <th class="px-4 py-3">Jenis</th>
                                            <th class="px-4 py-3">Pemicu</th>
                                            <th class="px-4 py-3">Reaksi</th>
                                        </tr>
                                    </thead>

                                    <tbody class="divide-y divide-gray-100 bg-white">

                                        @foreach ($kunjungan->santri->alergis as $alergi)
                                            <tr class="text-sm text-gray-700">

                                                <td class="px-4 py-3 font-medium">
                                                    {{ $alergi->jenis }}
                                                </td>

                                                <td class="px-4 py-3">
                                                    {{ $alergi->nama }}
                                                </td>

                                                <td class="px-4 py-3">
                                                    {{ $alergi->reaksi ?: '-' }}
                                                </td>

                                            </tr>
                                        @endforeach

                                    </tbody>

                                </table>
                            </div>

                        </div>
                    @else
                        <div class="rounded-xl bg-gray-50 px-4 py-4 text-sm text-gray-500">
                            Tidak ada data alergi yang tercatat.
                        </div>

                    @endif

                </div>

            </div>


            {{-- ========================= --}}
            {{-- PEMERIKSAAN --}}
            {{-- ========================= --}}

            <div class="mb-6 rounded-2xl bg-white shadow-sm ring-1 ring-gray-100">

                <div
                    class="flex flex-col gap-3 border-b border-gray-100 px-6 py-5 sm:flex-row sm:items-center sm:justify-between">

                    <div class="flex items-center gap-3">

                        <div
                            class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M4 19V5m0 14h16M8 16v-5m4 5V7m4 9v-8" />
                            </svg>
                        </div>

                        <div>
                            <h3 class="font-bold text-gray-800">Pemeriksaan</h3>
                            <p class="text-sm text-gray-500">
                                Hasil pemeriksaan awal
                            </p>
                        </div>

                    </div>

                    @if (auth()->user()->role === 'admin' || (auth()->user()->role === 'petugas' && $kunjungan->status !== 'selesai'))
                        <a href="{{ route('pemeriksaan.create', $kunjungan) }}"
                            class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">
                            Edit Pemeriksaan
                        </a>
                    @endif

                </div>

                <div class="p-6">

                    @if ($kunjungan->pemeriksaan)

                        <div class="grid grid-cols-2 gap-4 md:grid-cols-4">

                            @php
                                $pemeriksaanCards = [
                                    [
                                        'label' => 'Tekanan Darah',
                                        'value' => $kunjungan->pemeriksaan->tekanan_darah ?: '-',
                                    ],
                                    ['label' => 'Suhu', 'value' => $kunjungan->pemeriksaan->suhu ?? '-'],
                                    ['label' => 'Nadi', 'value' => $kunjungan->pemeriksaan->nadi ?? '-'],
                                    ['label' => 'Pernapasan', 'value' => $kunjungan->pemeriksaan->pernapasan ?? '-'],
                                    ['label' => 'Berat Badan', 'value' => $kunjungan->pemeriksaan->berat_badan ?? '-'],
                                    [
                                        'label' => 'Tinggi Badan',
                                        'value' => $kunjungan->pemeriksaan->tinggi_badan ?? '-',
                                    ],
                                ];
                            @endphp

                            @foreach ($pemeriksaanCards as $card)
                                <div class="rounded-xl bg-gray-50 p-4">
                                    <p class="text-xs font-medium uppercase tracking-wide text-gray-400">
                                        {{ $card['label'] }}
                                    </p>
                                    <p class="mt-2 text-lg font-bold text-gray-800">
                                        {{ $card['value'] }}
                                    </p>
                                </div>
                            @endforeach

                        </div>

                        <div class="mt-5 rounded-xl bg-gray-50 p-4">
                            <p class="text-xs font-medium uppercase tracking-wide text-gray-400">
                                Pemeriksaan Fisik
                            </p>

                            <p class="mt-2 whitespace-pre-line text-sm leading-6 text-gray-700">
                                {{ $kunjungan->pemeriksaan->pemeriksaan_fisik ?: '-' }}
                            </p>
                        </div>
                    @else
                        <div class="rounded-xl bg-gray-50 px-4 py-4 text-sm text-gray-500">
                            Belum ada data pemeriksaan.
                        </div>

                    @endif

                </div>

            </div>


            {{-- ========================= --}}
            {{-- DIAGNOSA --}}
            {{-- ========================= --}}

            <div class="mb-6 rounded-2xl bg-white shadow-sm ring-1 ring-gray-100">

                <div
                    class="flex flex-col gap-3 border-b border-gray-100 px-6 py-5 sm:flex-row sm:items-center sm:justify-between">

                    <div class="flex items-center gap-3">

                        <div
                            class="flex h-10 w-10 items-center justify-center rounded-xl bg-purple-50 text-purple-600">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M9 3h6m-7 4h8m-9 4h10m-9 4h8m-7 4h6" />
                            </svg>
                        </div>

                        <div>
                            <h3 class="font-bold text-gray-800">Diagnosa</h3>
                            <p class="text-sm text-gray-500">
                                Hasil diagnosa pelayanan
                            </p>
                        </div>

                    </div>

                    @if (auth()->user()->role === 'admin' || (auth()->user()->role === 'petugas' && $kunjungan->status !== 'selesai'))
                        <a href="{{ route('kunjungan-diagnosa.create', $kunjungan) }}"
                            class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">
                            Edit Diagnosa
                        </a>
                    @endif

                </div>

                <div class="p-6">

                    @if ($kunjungan->diagnosas->count())

                        <div class="space-y-3">

                            @foreach ($kunjungan->diagnosas as $diagnosa)
                                <div class="rounded-xl border border-gray-100 bg-gray-50 p-4">

                                    <div class="flex items-start gap-3">

                                        <div
                                            class="mt-0.5 flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-purple-100 text-purple-600">
                                            <span class="text-xs font-bold">D</span>
                                        </div>

                                        <div>
                                            <p class="font-semibold text-gray-800">
                                                {{ $diagnosa->kode }} - {{ $diagnosa->nama }}
                                            </p>

                                            @if ($diagnosa->pivot->catatan)
                                                <p class="mt-1 text-sm text-gray-500">
                                                    {{ $diagnosa->pivot->catatan }}
                                                </p>
                                            @endif
                                        </div>

                                    </div>

                                </div>
                            @endforeach

                        </div>
                    @else
                        <div class="rounded-xl bg-gray-50 px-4 py-4 text-sm text-gray-500">
                            Belum ada diagnosa.
                        </div>

                    @endif

                </div>

            </div>


            {{-- ========================= --}}
            {{-- TINDAKAN --}}
            {{-- ========================= --}}

            <div class="mb-6 rounded-2xl bg-white shadow-sm ring-1 ring-gray-100">

                <div
                    class="flex flex-col gap-3 border-b border-gray-100 px-6 py-5 sm:flex-row sm:items-center sm:justify-between">

                    <div class="flex items-center gap-3">

                        <div
                            class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M12 3v18M3 12h18" />
                            </svg>
                        </div>

                        <div>
                            <h3 class="font-bold text-gray-800">Tindakan</h3>
                            <p class="text-sm text-gray-500">
                                Tindakan yang diberikan
                            </p>
                        </div>

                    </div>

                    @if (auth()->user()->role === 'admin' || (auth()->user()->role === 'petugas' && $kunjungan->status !== 'selesai'))
                        <a href="{{ route('kunjungan-tindakan.create', $kunjungan) }}"
                            class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">
                            Edit Tindakan
                        </a>
                    @endif

                </div>

                <div class="p-6">

                    @if ($kunjungan->tindakans->count())

                        <div class="space-y-3">

                            @foreach ($kunjungan->tindakans as $tindakan)
                                <div class="rounded-xl border border-gray-100 bg-gray-50 p-4">

                                    <div class="flex items-start gap-3">

                                        <div
                                            class="mt-0.5 flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-emerald-100 text-emerald-600">
                                            <span class="text-xs font-bold">T</span>
                                        </div>

                                        <div>
                                            <p class="font-semibold text-gray-800">
                                                {{ $tindakan->kode }} - {{ $tindakan->nama }}
                                            </p>

                                            @if ($tindakan->pivot->catatan)
                                                <p class="mt-1 text-sm text-gray-500">
                                                    {{ $tindakan->pivot->catatan }}
                                                </p>
                                            @endif
                                        </div>

                                    </div>

                                </div>
                            @endforeach

                        </div>
                    @else
                        <div class="rounded-xl bg-gray-50 px-4 py-4 text-sm text-gray-500">
                            Belum ada tindakan.
                        </div>

                    @endif

                </div>

            </div>


            {{-- ========================= --}}
            {{-- RESEP / OBAT --}}
            {{-- ========================= --}}

            <div class="mb-6 rounded-2xl bg-white shadow-sm ring-1 ring-gray-100">

                <div
                    class="flex flex-col gap-3 border-b border-gray-100 px-6 py-5 sm:flex-row sm:items-center sm:justify-between">

                    <div class="flex items-center gap-3">

                        <div
                            class="flex h-10 w-10 items-center justify-center rounded-xl bg-orange-50 text-orange-600">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M8 3h8a2 2 0 012 2v14a2 2 0 01-2 2H8a2 2 0 01-2-2V5a2 2 0 012-2zm0 5h8m-8 4h8m-8 4h5" />
                            </svg>
                        </div>

                        <div>
                            <h3 class="font-bold text-gray-800">Resep / Obat</h3>
                            <p class="text-sm text-gray-500">
                                Obat yang diresepkan pada kunjungan
                            </p>
                        </div>

                    </div>

                    @if (auth()->user()->role === 'admin' || (auth()->user()->role === 'petugas' && $kunjungan->status !== 'selesai'))
                        <a href="{{ route('kunjungan-resep.create', $kunjungan) }}"
                            class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">
                            {{ $kunjungan->resep ? 'Edit Obat' : 'Tambah Obat' }}
                        </a>
                    @endif

                </div>

                <div class="p-6">

                    @if ($kunjungan->resep)

                        <div class="mb-5 rounded-xl bg-gray-50 p-4">
                            <p class="text-xs font-medium uppercase tracking-wide text-gray-400">
                                Nomor Resep
                            </p>

                            <p class="mt-1 font-bold text-gray-800">
                                {{ $kunjungan->resep->nomor_resep }}
                            </p>
                        </div>


                        @if ($kunjungan->resep->details->count())

                            <div class="overflow-hidden rounded-xl border border-gray-100">

                                <div class="overflow-x-auto">

                                    <table class="min-w-full divide-y divide-gray-100">

                                        <thead class="bg-gray-50">
                                            <tr
                                                class="text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
                                                <th class="px-4 py-3">Obat</th>
                                                <th class="px-4 py-3">Jumlah</th>
                                                <th class="px-4 py-3">Dosis</th>
                                                <th class="px-4 py-3">Frekuensi</th>
                                                <th class="px-4 py-3">Aturan Pakai</th>
                                            </tr>
                                        </thead>

                                        <tbody class="divide-y divide-gray-100 bg-white">

                                            @foreach ($kunjungan->resep->details as $detail)
                                                <tr class="text-sm text-gray-700">

                                                    <td class="px-4 py-4 font-semibold text-gray-800">
                                                        {{ $detail->obat?->nama ?? '-' }}
                                                    </td>

                                                    <td class="px-4 py-4">
                                                        {{ $detail->jumlah }}
                                                        {{ $detail->obat?->satuan ?? '' }}
                                                    </td>

                                                    <td class="px-4 py-4">
                                                        {{ $detail->dosis }}
                                                    </td>

                                                    <td class="px-4 py-4">
                                                        {{ $detail->frekuensi }}
                                                    </td>

                                                    <td class="px-4 py-4">
                                                        {{ $detail->aturan_pakai }}
                                                    </td>

                                                </tr>
                                            @endforeach

                                        </tbody>

                                    </table>

                                </div>

                            </div>
                        @else
                            <div class="rounded-xl bg-gray-50 px-4 py-4 text-sm text-gray-500">
                                Belum ada detail obat.
                            </div>

                        @endif
                    @else
                        <div class="rounded-xl bg-gray-50 px-4 py-4 text-sm text-gray-500">
                            Tidak ada resep pada kunjungan ini.
                        </div>

                    @endif

                </div>

            </div>


            {{-- ========================= --}}
            {{-- RUJUKAN --}}
            {{-- ========================= --}}

            <div class="mb-6 rounded-2xl bg-white shadow-sm ring-1 ring-gray-100">

                <div
                    class="flex flex-col gap-3 border-b border-gray-100 px-6 py-5 sm:flex-row sm:items-center sm:justify-between">

                    <div class="flex items-center gap-3">

                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-cyan-50 text-cyan-600">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M4 12h16m-6-6l6 6-6 6" />
                            </svg>
                        </div>

                        <div>
                            <h3 class="font-bold text-gray-800">Rujukan</h3>
                            <p class="text-sm text-gray-500">
                                Informasi rujukan pelayanan
                            </p>
                        </div>

                    </div>

                    @if (auth()->user()->role === 'admin' || (auth()->user()->role === 'petugas' && $kunjungan->status !== 'selesai'))
                        <a href="{{ route('rujukan.create', $kunjungan) }}"
                            class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">
                            {{ $kunjungan->rujukan ? 'Edit Rujukan' : 'Tambah Rujukan' }}
                        </a>
                    @endif

                </div>

                <div class="p-6">

                    @if ($kunjungan->rujukan)
                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">

                            <div class="rounded-xl bg-gray-50 p-4">
                                <p class="text-xs font-medium uppercase tracking-wide text-gray-400">
                                    Tanggal Rujukan
                                </p>
                                <p class="mt-1 font-semibold text-gray-800">
                                    {{ $kunjungan->rujukan->tanggal_rujukan?->format('d-m-Y') ?? '-' }}
                                </p>
                            </div>

                            <div class="rounded-xl bg-gray-50 p-4">
                                <p class="text-xs font-medium uppercase tracking-wide text-gray-400">
                                    Status
                                </p>
                                <p class="mt-1 font-semibold text-gray-800">
                                    {{ ucfirst($kunjungan->rujukan->status) }}
                                </p>
                            </div>

                            <div class="rounded-xl bg-gray-50 p-4">
                                <p class="text-xs font-medium uppercase tracking-wide text-gray-400">
                                    Fasilitas Tujuan
                                </p>
                                <p class="mt-1 font-semibold text-gray-800">
                                    {{ $kunjungan->rujukan->masterRujukan?->nama_fasilitas ?? '-' }}
                                </p>
                            </div>

                            <div class="rounded-xl bg-gray-50 p-4">
                                <p class="text-xs font-medium uppercase tracking-wide text-gray-400">
                                    Alasan
                                </p>
                                <p class="mt-1 font-semibold text-gray-800">
                                    {{ $kunjungan->rujukan->alasan ?? '-' }}
                                </p>
                            </div>

                        </div>
                    @else
                        <div class="rounded-xl bg-gray-50 px-4 py-4 text-sm text-gray-500">
                            Tidak ada rujukan pada kunjungan ini.
                        </div>
                    @endif

                </div>

            </div>


        </div>
    </div>

</x-app-layout>
