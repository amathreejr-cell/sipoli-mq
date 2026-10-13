<x-app-layout>

    <x-slot name="header">
        <div>
            <p class="text-sm text-gray-500">Pelayanan Poliklinik</p>
            <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                Ringkasan Kunjungan
            </h2>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- =========================================================
                STEPPER
            ========================================================== --}}
            <div class="bg-white border border-gray-200 rounded-2xl shadow-sm mb-6">

                <div class="px-5 py-5 overflow-x-auto">

                    <div class="flex items-center min-w-max">

                        @php
                            $steps = [
                                ['label' => 'Kunjungan', 'number' => 1],
                                ['label' => 'Pemeriksaan', 'number' => 2],
                                ['label' => 'Diagnosa', 'number' => 3],
                                ['label' => 'Tindakan', 'number' => 4],
                                ['label' => 'Keputusan', 'number' => 5],
                                ['label' => 'Rujukan / Obat', 'number' => 6],
                            ];
                        @endphp


                        @foreach ($steps as $step)
                            <div class="flex items-center">

                                <span
                                    class="flex items-center justify-center
                                             w-9 h-9 rounded-full
                                             bg-emerald-500 text-white
                                             text-sm font-bold">
                                    ✓
                                </span>

                                <span class="ml-2 text-sm font-semibold text-gray-700">
                                    {{ $step['label'] }}
                                </span>

                            </div>

                            <div class="w-12 h-px bg-emerald-300 mx-3"></div>
                        @endforeach


                        {{-- 7 --}}
                        <div class="flex items-center">

                            <span
                                class="flex items-center justify-center
                                         w-9 h-9 rounded-full
                                         bg-indigo-600 text-white
                                         text-sm font-bold shadow-sm">
                                7
                            </span>

                            <span class="ml-2 text-sm font-bold text-indigo-600">
                                Ringkasan
                            </span>

                        </div>

                    </div>

                </div>

            </div>


            {{-- =========================================================
                HEADER
            ========================================================== --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm mb-6 overflow-hidden">

                <div class="p-6">

                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5">

                        <div class="flex items-start gap-4">

                            <div
                                class="w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-xl">
                                ✓
                            </div>

                            <div>
                                <p class="text-sm font-medium text-indigo-600">
                                    Tahap Akhir Pelayanan
                                </p>

                                <h1 class="text-2xl font-bold text-gray-900 mt-1">
                                    Ringkasan Pelayanan
                                </h1>

                                <p class="text-sm text-gray-500 mt-1">
                                    Periksa kembali seluruh data sebelum menyelesaikan kunjungan.
                                </p>
                            </div>

                        </div>


                        {{-- Kode --}}
                        <div class="bg-gray-50 rounded-xl px-4 py-3">

                            <p class="text-xs text-gray-500">
                                Kode Kunjungan
                            </p>

                            <p class="font-bold text-gray-900 mt-1">
                                {{ $kunjungan->kode_kunjungan }}
                            </p>

                        </div>

                    </div>

                </div>

            </div>


            {{-- =========================================================
                IDENTITAS SANTRI
            ========================================================== --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm mb-6 overflow-hidden">

                <div class="px-6 py-5 border-b border-gray-100">

                    <div class="flex items-center gap-3">

                        <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
                            👤
                        </div>

                        <div>
                            <h3 class="font-semibold text-gray-900">
                                Identitas Santri
                            </h3>

                            <p class="text-sm text-gray-500">
                                Informasi dasar santri
                            </p>
                        </div>

                    </div>

                </div>


                <div class="p-6">

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">

                        <div>
                            <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">
                                Nomor Induk
                            </p>

                            <p class="mt-1 font-semibold text-gray-900">
                                {{ $kunjungan->santri?->nomor_induk ?? '-' }}
                            </p>
                        </div>


                        <div>
                            <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">
                                Nama
                            </p>

                            <p class="mt-1 font-semibold text-gray-900">
                                {{ $kunjungan->santri?->nama ?? '-' }}
                            </p>
                        </div>


                        <div>
                            <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">
                                Kamar
                            </p>

                            <p class="mt-1 text-gray-700">
                                {{ $kunjungan->santri?->kamar ?? '-' }}
                            </p>
                        </div>


                        <div>
                            <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">
                                Sekolah / Kelas
                            </p>

                            <p class="mt-1 text-gray-700">
                                {{ $kunjungan->santri?->sekolah ?? '-' }}
                                /
                                {{ $kunjungan->santri?->kelas ?? '-' }}
                            </p>
                        </div>

                    </div>

                </div>

            </div>


            {{-- =========================================================
                KUNJUNGAN
            ========================================================== --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm mb-6 overflow-hidden">

                <div class="px-6 py-5 border-b border-gray-100">

                    <div class="flex items-center gap-3">

                        <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center">
                            📋
                        </div>

                        <div>
                            <h3 class="font-semibold text-gray-900">
                                Kunjungan
                            </h3>

                            <p class="text-sm text-gray-500">
                                Informasi awal kunjungan
                            </p>
                        </div>

                    </div>

                </div>


                <div class="p-6">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                        <div>
                            <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">
                                Kode Kunjungan
                            </p>

                            <p class="mt-1 font-semibold text-gray-900">
                                {{ $kunjungan->kode_kunjungan }}
                            </p>
                        </div>


                        <div>
                            <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">
                                Tanggal
                            </p>

                            <p class="mt-1 text-gray-700">
                                {{ $kunjungan->tanggal?->format('d/m/Y') ?? '-' }}
                            </p>
                        </div>


                        <div class="md:col-span-2">

                            <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">
                                Keluhan
                            </p>

                            <div class="mt-2 rounded-xl bg-gray-50 p-4">
                                <p class="text-gray-800">
                                    {{ $kunjungan->keluhan ?: '-' }}
                                </p>
                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- =========================================================
                PEMERIKSAAN
            ========================================================== --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm mb-6 overflow-hidden">

                <div class="px-6 py-5 border-b border-gray-100">

                    <div class="flex items-center gap-3">

                        <div
                            class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                            🩺
                        </div>

                        <div>
                            <h3 class="font-semibold text-gray-900">
                                Pemeriksaan
                            </h3>

                            <p class="text-sm text-gray-500">
                                Hasil pemeriksaan fisik dan tanda vital
                            </p>
                        </div>

                    </div>

                </div>


                <div class="p-6">

                    @if ($kunjungan->pemeriksaan)
                        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">

                            <div class="rounded-xl bg-gray-50 p-4">
                                <p class="text-xs text-gray-500">Tekanan Darah</p>
                                <p class="font-semibold mt-1">
                                    {{ $kunjungan->pemeriksaan->tekanan_darah ?: '-' }}
                                </p>
                            </div>

                            <div class="rounded-xl bg-gray-50 p-4">
                                <p class="text-xs text-gray-500">Suhu</p>
                                <p class="font-semibold mt-1">
                                    {{ $kunjungan->pemeriksaan->suhu ?? '-' }}
                                </p>
                            </div>

                            <div class="rounded-xl bg-gray-50 p-4">
                                <p class="text-xs text-gray-500">Nadi</p>
                                <p class="font-semibold mt-1">
                                    {{ $kunjungan->pemeriksaan->nadi ?? '-' }}
                                </p>
                            </div>

                            <div class="rounded-xl bg-gray-50 p-4">
                                <p class="text-xs text-gray-500">Pernapasan</p>
                                <p class="font-semibold mt-1">
                                    {{ $kunjungan->pemeriksaan->pernapasan ?? '-' }}
                                </p>
                            </div>

                            <div class="rounded-xl bg-gray-50 p-4">
                                <p class="text-xs text-gray-500">Berat Badan</p>
                                <p class="font-semibold mt-1">
                                    {{ $kunjungan->pemeriksaan->berat_badan ?? '-' }}
                                </p>
                            </div>

                            <div class="rounded-xl bg-gray-50 p-4">
                                <p class="text-xs text-gray-500">Tinggi Badan</p>
                                <p class="font-semibold mt-1">
                                    {{ $kunjungan->pemeriksaan->tinggi_badan ?? '-' }}
                                </p>
                            </div>

                        </div>


                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mt-5">

                            <div>
                                <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">
                                    Pemeriksaan Fisik
                                </p>

                                <div class="mt-2 rounded-xl bg-gray-50 p-4">
                                    <p class="text-gray-800 whitespace-pre-line">
                                        {{ $kunjungan->pemeriksaan->pemeriksaan_fisik ?: '-' }}
                                    </p>
                                </div>
                            </div>


                            <div>
                                <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">
                                    Catatan
                                </p>

                                <div class="mt-2 rounded-xl bg-gray-50 p-4">
                                    <p class="text-gray-800 whitespace-pre-line">
                                        {{ $kunjungan->pemeriksaan->catatan ?: '-' }}
                                    </p>
                                </div>
                            </div>

                        </div>
                    @else
                        <p class="text-sm text-gray-500">
                            Tidak ada data pemeriksaan.
                        </p>
                    @endif

                </div>

            </div>


            {{-- =========================================================
                DIAGNOSA
            ========================================================== --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm mb-6 overflow-hidden">

                <div class="px-6 py-5 border-b border-gray-100">

                    <div class="flex items-center gap-3">

                        <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center">
                            🔎
                        </div>

                        <div>
                            <h3 class="font-semibold text-gray-900">
                                Diagnosa
                            </h3>

                            <p class="text-sm text-gray-500">
                                Diagnosa yang dicatat pada kunjungan
                            </p>
                        </div>

                    </div>

                </div>


                <div class="p-6">

                    @if ($kunjungan->diagnosas->count())

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                            @foreach ($kunjungan->diagnosas as $diagnosa)
                                <div class="rounded-xl border border-gray-200 p-4">

                                    <div class="flex items-start gap-3">

                                        <span
                                            class="w-9 h-9 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center text-sm font-bold">
                                            D
                                        </span>

                                        <div>

                                            <p class="font-semibold text-gray-900">
                                                {{ $diagnosa->kode }}
                                            </p>

                                            <p class="text-sm text-gray-700 mt-1">
                                                {{ $diagnosa->nama }}
                                            </p>

                                            @if ($diagnosa->pivot->catatan)
                                                <p class="text-xs text-gray-500 mt-2">
                                                    {{ $diagnosa->pivot->catatan }}
                                                </p>
                                            @endif

                                        </div>

                                    </div>

                                </div>
                            @endforeach

                        </div>
                    @else
                        <p class="text-sm text-gray-500">
                            Tidak ada diagnosa.
                        </p>

                    @endif

                </div>

            </div>


            {{-- =========================================================
                TINDAKAN
            ========================================================== --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm mb-6 overflow-hidden">

                <div class="px-6 py-5 border-b border-gray-100">

                    <div class="flex items-center gap-3">

                        <div
                            class="w-10 h-10 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center">
                            ✚
                        </div>

                        <div>
                            <h3 class="font-semibold text-gray-900">
                                Tindakan
                            </h3>

                            <p class="text-sm text-gray-500">
                                Tindakan pelayanan yang diberikan
                            </p>
                        </div>

                    </div>

                </div>


                <div class="p-6">

                    @if ($kunjungan->tindakans->count())

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                            @foreach ($kunjungan->tindakans as $tindakan)
                                <div class="rounded-xl border border-gray-200 p-4">

                                    <div class="flex items-start gap-3">

                                        <span
                                            class="w-9 h-9 rounded-lg bg-purple-50 text-purple-600 flex items-center justify-center text-sm font-bold">
                                            T
                                        </span>

                                        <div>

                                            <p class="font-semibold text-gray-900">
                                                {{ $tindakan->kode }}
                                            </p>

                                            <p class="text-sm text-gray-700 mt-1">
                                                {{ $tindakan->nama }}
                                            </p>

                                            @if ($tindakan->pivot->catatan)
                                                <p class="text-xs text-gray-500 mt-2">
                                                    {{ $tindakan->pivot->catatan }}
                                                </p>
                                            @endif

                                        </div>

                                    </div>

                                </div>
                            @endforeach

                        </div>
                    @else
                        <p class="text-sm text-gray-500">
                            Tidak ada tindakan.
                        </p>

                    @endif

                </div>

            </div>


            {{-- =========================================================
                KEPUTUSAN PELAYANAN
            ========================================================== --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm mb-6 overflow-hidden">

                <div class="px-6 py-5 border-b border-gray-100">

                    <div class="flex items-center gap-3">

                        <div
                            class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center">
                            ✓
                        </div>

                        <div>
                            <h3 class="font-semibold text-gray-900">
                                Keputusan Pelayanan
                            </h3>

                            <p class="text-sm text-gray-500">
                                Keputusan tindak lanjut pelayanan
                            </p>
                        </div>

                    </div>

                </div>


                <div class="p-6">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                        {{-- Rujukan --}}
                        <div class="rounded-xl border border-gray-200 p-5">

                            <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">
                                Perlu Rujukan
                            </p>

                            <div class="mt-2">

                                @if ($kunjungan->perlu_rujukan === true)
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-red-50 text-red-700">
                                        Ya
                                    </span>
                                @elseif ($kunjungan->perlu_rujukan === false)
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-green-50 text-green-700">
                                        Tidak
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-gray-100 text-gray-600">
                                        Belum ditentukan
                                    </span>
                                @endif

                            </div>

                        </div>


                        {{-- Obat --}}
                        <div class="rounded-xl border border-gray-200 p-5">

                            <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">
                                Perlu Obat
                            </p>

                            <div class="mt-2">

                                @if ($kunjungan->perlu_obat === true)
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-blue-50 text-blue-700">
                                        Ya
                                    </span>
                                @elseif ($kunjungan->perlu_obat === false)
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-green-50 text-green-700">
                                        Tidak
                                    </span>
                                @elseif ($kunjungan->perlu_rujukan === true)
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-gray-100 text-gray-600">
                                        Tidak ditentukan
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-gray-100 text-gray-600">
                                        Belum ditentukan
                                    </span>
                                @endif

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- =========================================================
                OBAT / RESEP
            ========================================================== --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm mb-6 overflow-hidden">

                <div class="px-6 py-5 border-b border-gray-100">

                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">

                        <div class="flex items-center gap-3">

                            <div
                                class="w-10 h-10 rounded-xl bg-cyan-50 text-cyan-600 flex items-center justify-center">
                                💊
                            </div>

                            <div>
                                <h3 class="font-semibold text-gray-900">
                                    Obat / Resep
                                </h3>

                                <p class="text-sm text-gray-500">
                                    Obat yang diresepkan kepada santri
                                </p>
                            </div>

                        </div>

                        @if ($kunjungan->status !== 'selesai' && in_array(auth()->user()->role, ['admin', 'petugas']))
                            <a href="{{ route('kunjungan-resep.create', $kunjungan) }}"
                                class="inline-flex items-center justify-center px-4 py-2 rounded-xl bg-gray-900 text-white text-sm font-medium hover:bg-gray-800 transition">
                                Edit Resep
                            </a>
                        @elseif ($kunjungan->status === 'selesai' && auth()->user()->role === 'admin' && $kunjungan->resep)
                            <a href="{{ route('kunjungan-resep.koreksi.create', $kunjungan) }}"
                                class="inline-flex items-center justify-center px-4 py-2 rounded-xl bg-amber-600 text-white text-sm font-medium hover:bg-amber-700 transition">
                                Koreksi Resep
                            </a>
                        @endif

                    </div>

                </div>


                <div class="p-6">

                    @if ($kunjungan->resep && $resepAktif->isNotEmpty())
                        <div class="overflow-x-auto">
                            <table class="min-w-full">
                                <thead>
                                    <tr class="border-b border-gray-200 text-left">
                                        <th class="py-3 pr-5 text-xs font-semibold text-gray-500 uppercase">Obat</th>
                                        <th class="py-3 pr-5 text-xs font-semibold text-gray-500 uppercase">Jumlah</th>
                                        <th class="py-3 pr-5 text-xs font-semibold text-gray-500 uppercase">Dosis</th>
                                        <th class="py-3 pr-5 text-xs font-semibold text-gray-500 uppercase">Frekuensi
                                        </th>
                                        <th class="py-3 text-xs font-semibold text-gray-500 uppercase">Aturan Pakai
                                        </th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($resepAktif as $detail)
                                        <tr class="border-b border-gray-100 last:border-0">
                                            <td class="py-4 pr-5">
                                                <p class="font-semibold text-gray-900">
                                                    {{ $detail['nama'] ?? '-' }}
                                                </p>

                                                @if (!empty($detail['keterangan']))
                                                    <p class="mt-1 text-xs text-gray-500">
                                                        {{ $detail['keterangan'] }}
                                                    </p>
                                                @endif
                                            </td>

                                            <td class="py-4 pr-5 text-gray-700">
                                                {{ $detail['jumlah'] ?? '-' }}
                                            </td>

                                            <td class="py-4 pr-5 text-gray-700">
                                                {{ $detail['dosis'] ?? '-' }}
                                            </td>

                                            <td class="py-4 pr-5 text-gray-700">
                                                {{ $detail['frekuensi'] ?? '-' }}
                                            </td>

                                            <td class="py-4 text-gray-700">
                                                {{ $detail['aturan_pakai'] ?? '-' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        @if ($kunjungan->resep->catatan)
                            <div class="mt-5 rounded-xl bg-gray-50 p-4">
                                <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">
                                    Catatan Resep
                                </p>
                                <p class="mt-2 text-gray-800 whitespace-pre-line">
                                    {{ $kunjungan->resep->catatan }}
                                </p>
                            </div>
                        @endif
                    @else
                        <div class="rounded-xl bg-gray-50 p-5">
                            <p class="text-sm text-gray-500">
                                Tidak ada obat / resep.
                            </p>
                        </div>
                    @endif

                    @if ($riwayatKoreksiResep->isNotEmpty())
                        <div class="mt-6 rounded-xl border border-amber-200 bg-amber-50 p-5">
                            <h4 class="font-semibold text-amber-900">
                                Riwayat Koreksi Resep
                            </h4>

                            <div class="mt-4 space-y-4">
                                @foreach ($riwayatKoreksiResep as $koreksi)
                                    <div class="border-b border-amber-200 pb-4 last:border-0 last:pb-0">
                                        <p class="font-medium text-gray-900">
                                            Koreksi #{{ $koreksi->id }}
                                        </p>

                                        <p class="mt-1 text-sm text-gray-600">
                                            {{ $koreksi->dikoreksi_pada?->format('d/m/Y H:i') ?? '-' }}
                                            ·
                                            {{ $koreksi->user?->name ?? 'Admin tidak diketahui' }}
                                        </p>

                                        <p class="mt-2 text-sm font-medium text-gray-700">
                                            Alasan koreksi
                                        </p>
                                        <p class="text-sm text-gray-700 whitespace-pre-line">
                                            {{ $koreksi->alasan }}
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                </div>

            </div>


            {{-- =========================================================
                RUJUKAN
            ========================================================== --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm mb-6 overflow-hidden">

                <div class="px-6 py-5 border-b border-gray-100">

                    <div class="flex items-center gap-3">

                        <div class="w-10 h-10 rounded-xl bg-red-50 text-red-600 flex items-center justify-center">
                            🏥
                        </div>

                        <div>
                            <h3 class="font-semibold text-gray-900">
                                Rujukan
                            </h3>

                            <p class="text-sm text-gray-500">
                                Informasi fasilitas kesehatan tujuan
                            </p>
                        </div>

                    </div>

                </div>


                <div class="p-6">

                    @if ($kunjungan->rujukan)

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                            <div>
                                <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">
                                    Fasilitas Tujuan
                                </p>

                                <p class="mt-1 font-semibold text-gray-900">
                                    {{ $kunjungan->rujukan->masterRujukan?->nama_fasilitas ?? '-' }}
                                </p>
                            </div>


                            <div>
                                <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">
                                    Tanggal Rujukan
                                </p>

                                <p class="mt-1 text-gray-700">
                                    {{ $kunjungan->rujukan->tanggal_rujukan?->format('d/m/Y') ?? '-' }}
                                </p>
                            </div>


                            <div>
                                <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">
                                    Status
                                </p>

                                <p class="mt-1">
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-indigo-50 text-indigo-700">
                                        {{ ucfirst($kunjungan->rujukan->status) }}
                                    </span>
                                </p>
                            </div>


                            <div class="md:col-span-2">

                                <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">
                                    Alasan
                                </p>

                                <div class="mt-2 rounded-xl bg-gray-50 p-4">
                                    <p class="text-gray-800 whitespace-pre-line">
                                        {{ $kunjungan->rujukan->alasan }}
                                    </p>
                                </div>

                            </div>


                            @if ($kunjungan->rujukan->keterangan)
                                <div class="md:col-span-2">

                                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">
                                        Keterangan
                                    </p>

                                    <div class="mt-2 rounded-xl bg-gray-50 p-4">
                                        <p class="text-gray-800 whitespace-pre-line">
                                            {{ $kunjungan->rujukan->keterangan }}
                                        </p>
                                    </div>

                                </div>
                            @endif

                        </div>
                    @else
                        <div class="rounded-xl bg-gray-50 p-5">

                            <p class="text-sm text-gray-500">
                                Tidak ada rujukan.
                            </p>

                        </div>

                    @endif

                </div>

            </div>


            {{-- =========================================================
                INFORMASI PELAYANAN
            ========================================================== --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm mb-6 overflow-hidden">

                <div class="px-6 py-5 border-b border-gray-100">

                    <div class="flex items-center gap-3">

                        <div class="w-10 h-10 rounded-xl bg-gray-100 text-gray-600 flex items-center justify-center">
                            ℹ
                        </div>

                        <div>
                            <h3 class="font-semibold text-gray-900">
                                Informasi Pelayanan
                            </h3>

                            <p class="text-sm text-gray-500">
                                Petugas dan status kunjungan
                            </p>
                        </div>

                    </div>

                </div>


                <div class="p-6">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                        <div>
                            <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">
                                Petugas
                            </p>

                            <p class="mt-1 font-semibold text-gray-900">
                                {{ $kunjungan->petugas?->name ?? '-' }}
                            </p>
                        </div>


                        <div>
                            <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">
                                Status Kunjungan
                            </p>

                            <p class="mt-1">

                                @if ($kunjungan->status === 'selesai')
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-green-50 text-green-700">
                                        Selesai
                                    </span>
                                @elseif ($kunjungan->status === 'diperiksa')
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-amber-50 text-amber-700">
                                        Diperiksa
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-gray-100 text-gray-700">
                                        {{ ucfirst($kunjungan->status) }}
                                    </span>
                                @endif

                            </p>

                        </div>

                    </div>

                </div>

            </div>


            {{-- =========================================================
                TOMBOL SELESAI
            ========================================================== --}}
            @if ($kunjungan->status !== 'selesai')

                <div class="bg-white rounded-2xl border border-indigo-100 shadow-sm overflow-hidden">

                    <div class="p-6">

                        <div class="rounded-2xl bg-indigo-50 border border-indigo-100 p-5 mb-5">

                            <div class="flex items-start gap-3">

                                <div
                                    class="w-10 h-10 rounded-xl bg-white text-indigo-600 flex items-center justify-center flex-shrink-0">
                                    ✓
                                </div>

                                <div>
                                    <h3 class="font-semibold text-indigo-900">
                                        Kunjungan Siap Diselesaikan
                                    </h3>

                                    <p class="text-sm text-indigo-700 mt-1">
                                        Pastikan seluruh data pelayanan sudah benar sebelum
                                        menyimpan kunjungan sebagai selesai.
                                    </p>
                                </div>

                            </div>

                        </div>

                        {{-- Kembali ke halaman sebelumnya --}}
                        <div class="flex flex-col-reverse sm:flex-row sm:items-center sm:justify-between gap-3">

                            @if ($kunjungan->perlu_rujukan === true && $kunjungan->rujukan)
                                <a href="{{ route('rujukan.create', $kunjungan) }}"
                                    class="inline-flex items-center justify-center px-5 py-2.5 rounded-xl bg-white border border-gray-300 text-sm font-medium text-gray-700 hover:bg-gray-100 transition">
                                    ← Kembali ke Rujukan
                                </a>
                            @elseif ($kunjungan->perlu_rujukan === false && $kunjungan->perlu_obat === true && $kunjungan->resep)
                                <a href="{{ route('kunjungan-resep.create', $kunjungan) }}"
                                    class="inline-flex items-center justify-center px-5 py-2.5 rounded-xl bg-white border border-gray-300 text-sm font-medium text-gray-700 hover:bg-gray-100 transition">
                                    ← Kembali ke Resep / Obat
                                </a>
                            @else
                                <a href="{{ route('kunjungan-tindakan.create', $kunjungan) }}"
                                    class="inline-flex items-center justify-center px-5 py-2.5 rounded-xl bg-white border border-gray-300 text-sm font-medium text-gray-700 hover:bg-gray-100 transition">
                                    ← Kembali ke Tindakan
                                </a>
                            @endif

                            <form id="finishVisitForm" method="POST"
                                action="{{ route('kunjungan-ringkasan.selesai', $kunjungan) }}">
                                @csrf

                                <div class="flex justify-end">

                                    <button type="button" id="finishVisitButton"
                                        class="inline-flex items-center justify-center px-7 py-3 rounded-xl bg-indigo-600 text-white font-semibold hover:bg-indigo-700 transition shadow-sm">
                                        Simpan Kunjungan
                                    </button>

                                </div>

                            </form>

                        </div>

                    </div>

                </div>
            @else
                <div class="bg-green-50 border border-green-200 rounded-2xl p-5">

                    <div class="flex items-center gap-3">

                        <div class="w-10 h-10 rounded-xl bg-green-100 text-green-700 flex items-center justify-center">
                            ✓
                        </div>

                        <div>
                            <p class="font-semibold text-green-900">
                                Kunjungan telah selesai
                            </p>

                            <p class="text-sm text-green-700">
                                Data kunjungan ini sudah tersimpan.
                            </p>
                        </div>

                    </div>

                </div>

            @endif

        </div>
    </div>


    {{-- =========================================================
        MODAL KONFIRMASI
    ========================================================== --}}
    <div id="confirmModal" class="fixed inset-0 z-50 hidden" aria-hidden="true">

        <div id="confirmBackdrop" class="absolute inset-0 bg-gray-900/50 backdrop-blur-sm"></div>


        <div class="relative min-h-screen flex items-center justify-center px-4">

            <div id="confirmCard"
                class="w-full max-w-md bg-white rounded-3xl shadow-2xl p-6 transform scale-95 opacity-0 transition-all duration-200">

                <div class="text-center">

                    <div
                        class="mx-auto w-16 h-16 rounded-full bg-indigo-50 text-indigo-600 flex items-center justify-center text-2xl mb-5">
                        ?
                    </div>

                    <h3 class="text-xl font-bold text-gray-900">
                        Selesaikan Kunjungan?
                    </h3>

                    <p class="text-sm text-gray-500 mt-2 leading-relaxed">
                        Apakah Anda yakin ingin menyelesaikan kunjungan ini?
                        Setelah disimpan, kunjungan akan berstatus
                        <strong class="text-gray-700">selesai</strong>.
                    </p>

                </div>


                <div class="grid grid-cols-2 gap-3 mt-7">

                    <button type="button" id="cancelFinish"
                        class="w-full px-4 py-3 rounded-xl bg-gray-100 text-gray-700 font-semibold hover:bg-gray-200 transition">
                        Tidak
                    </button>

                    <button type="button" id="confirmFinish"
                        class="w-full px-4 py-3 rounded-xl bg-indigo-600 text-white font-semibold hover:bg-indigo-700 transition">
                        Ya, Selesaikan
                    </button>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
        ANIMASI BERHASIL
    ========================================================== --}}
    <div id="successOverlay" class="fixed inset-0 z-[60] hidden bg-white">

        <div class="min-h-screen flex items-center justify-center px-6">

            <div id="successContent" class="text-center opacity-0 scale-90 transition-all duration-500">

                <div class="relative mx-auto w-24 h-24 mb-7">

                    <div class="absolute inset-0 rounded-full bg-green-100 animate-ping opacity-40"></div>

                    <div
                        class="relative w-24 h-24 rounded-full bg-green-500 text-white flex items-center justify-center shadow-lg">

                        <svg class="w-12 h-12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 12.5L9.5 17L19 7.5" />
                        </svg>

                    </div>

                </div>


                <h2 class="text-2xl sm:text-3xl font-bold text-gray-900">
                    Kunjungan Anda Telah Kami Simpan
                </h2>

                <p class="text-gray-500 mt-3">
                    Data pelayanan berhasil disimpan sebagai kunjungan selesai.
                </p>


                <div class="flex items-center justify-center gap-2 mt-6 text-sm text-gray-400">

                    <span class="w-2 h-2 rounded-full bg-gray-400 animate-bounce"></span>

                    <span class="w-2 h-2 rounded-full bg-gray-400 animate-bounce"
                        style="animation-delay: .15s"></span>

                    <span class="w-2 h-2 rounded-full bg-gray-400 animate-bounce" style="animation-delay: .3s"></span>

                    <span class="ml-1">
                        Mengalihkan ke detail kunjungan...
                    </span>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
        JAVASCRIPT KONFIRMASI + ANIMASI
    ========================================================== --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const finishButton = document.getElementById('finishVisitButton');
            const confirmModal = document.getElementById('confirmModal');
            const confirmCard = document.getElementById('confirmCard');
            const cancelFinish = document.getElementById('cancelFinish');
            const confirmFinish = document.getElementById('confirmFinish');
            const finishForm = document.getElementById('finishVisitForm');

            const successOverlay = document.getElementById('successOverlay');
            const successContent = document.getElementById('successContent');

            function openConfirmModal() {

                confirmModal.classList.remove('hidden');

                requestAnimationFrame(() => {
                    confirmCard.classList.remove('scale-95', 'opacity-0');
                    confirmCard.classList.add('scale-100', 'opacity-100');
                });

                document.body.classList.add('overflow-hidden');
            }


            function closeConfirmModal() {

                confirmCard.classList.remove('scale-100', 'opacity-100');
                confirmCard.classList.add('scale-95', 'opacity-0');

                setTimeout(() => {

                    confirmModal.classList.add('hidden');

                    document.body.classList.remove('overflow-hidden');

                }, 180);
            }


            function showSuccessAnimation() {

                confirmModal.classList.add('hidden');

                successOverlay.classList.remove('hidden');

                document.body.classList.add('overflow-hidden');

                requestAnimationFrame(() => {

                    successContent.classList.remove(
                        'opacity-0',
                        'scale-90'
                    );

                    successContent.classList.add(
                        'opacity-100',
                        'scale-100'
                    );

                });

                /*
                 * Beri waktu agar animasi sukses terlihat
                 * sebelum form benar-benar dikirim.
                 */
                setTimeout(() => {

                    finishForm.submit();

                }, 1800);
            }


            if (finishButton) {

                finishButton.addEventListener('click', function() {

                    openConfirmModal();

                });

            }


            if (cancelFinish) {

                cancelFinish.addEventListener('click', function() {

                    closeConfirmModal();

                });

            }


            if (confirmFinish) {

                confirmFinish.addEventListener('click', function() {

                    confirmFinish.disabled = true;

                    confirmFinish.textContent = 'Menyimpan...';

                    showSuccessAnimation();

                });

            }


            /*
             * Klik area luar modal = tutup
             */
            if (confirmModal) {

                confirmModal.addEventListener('click', function(event) {

                    if (event.target === confirmModal) {

                        closeConfirmModal();

                    }

                });

            }


            /*
             * ESC = tutup modal
             */
            document.addEventListener('keydown', function(event) {

                if (
                    event.key === 'Escape' &&
                    !confirmModal.classList.contains('hidden')
                ) {

                    closeConfirmModal();

                }

            });

        });
    </script>

</x-app-layout>
