<x-app-layout>

    <x-slot name="header">

            <div class="min-h-20 py-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

                <div class="flex items-center gap-3">

                    <div class="w-11 h-11 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                d="M9 12h6m-6 4h6M9 8h6m5 13H4a2 2 0 01-2-2V5a2 2 0 012-2h16a2 2 0 012 2v14a2 2 0 01-2 2z" />
                        </svg>
                    </div>

                    <div>
                        <h1 class="text-xl font-bold text-slate-900">
                            Rekam Medis
                        </h1>

                        <p class="text-sm text-slate-500 mt-0.5">
                            Riwayat pelayanan kesehatan santri
                        </p>
                    </div>

                </div>

            </div>

    </x-slot>

    <div x-data="{
        modal: null,
    
        openModal(name) {
            this.modal = name;
            document.body.classList.add('overflow-hidden');
        },
    
        closeModal() {
            this.modal = null;
            document.body.classList.remove('overflow-hidden');
        }
    }" @keydown.escape.window="closeModal()">

        <div class="min-h-screen">

            {{-- MAIN --}}
            <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

                {{-- ALERT --}}
                @if (session('success'))
                    <div class="mb-5 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3">
                        <p class="text-sm font-medium text-emerald-700">
                            {{ session('success') }}
                        </p>
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-5 rounded-xl border border-red-200 bg-red-50 px-4 py-3">
                        <p class="text-sm font-medium text-red-700">
                            {{ session('error') }}
                        </p>
                    </div>
                @endif


                {{-- INTRO --}}
                <div class="mb-6">

                    <div class="flex items-center gap-2 mb-2">

                        <span
                            class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full
                               bg-emerald-50 border border-emerald-200
                               text-emerald-700 text-xs font-semibold">

                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>

                            Arsip Pelayanan

                        </span>

                    </div>

                    <h2 class="text-lg font-bold text-slate-900">
                        Riwayat Rekam Medis Santri
                    </h2>

                    <p class="text-sm text-slate-500 mt-1 max-w-2xl">
                        Telusuri riwayat pelayanan kesehatan santri yang telah selesai
                        berdasarkan nama atau nomor induk.
                    </p>

                </div>


                {{-- SEARCH --}}
                <div class="bg-white border border-slate-200 rounded-2xl shadow-sm mb-6">

                    <form method="GET" action="{{ route('rekam-medis.index') }}" class="p-4">

                        <div class="flex flex-col sm:flex-row gap-3">

                            <div class="relative flex-1">

                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">

                                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">

                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                            d="m21 21-4.35-4.35m2.35-5.65a8 8 0 1 1-16 0 8 8 0 0 1 16 0z" />

                                    </svg>

                                </div>

                                <input type="text" name="q" value="{{ $keyword }}"
                                    placeholder="Cari nama santri atau nomor induk..."
                                    class="w-full pl-10 pr-4 py-2.5 rounded-xl
                                       border-slate-300
                                       text-sm
                                       focus:border-indigo-500
                                       focus:ring-indigo-500">

                            </div>


                            <button type="submit"
                                class="inline-flex items-center justify-center gap-2
                                   px-5 py-2.5 rounded-xl
                                   bg-indigo-600 text-white
                                   text-sm font-semibold
                                   hover:bg-indigo-700 transition">

                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="m21 21-4.35-4.35m2.35-5.65a8 8 0 1 1-16 0 8 8 0 0 1 16 0z" />

                                </svg>

                                Cari

                            </button>


                            @if ($keyword)
                                <a href="{{ route('rekam-medis.index') }}"
                                    class="inline-flex items-center justify-center
                                       px-5 py-2.5 rounded-xl
                                       bg-slate-100 text-slate-700
                                       text-sm font-medium
                                       hover:bg-slate-200 transition">

                                    Reset

                                </a>
                            @endif

                        </div>

                    </form>

                </div>


                {{-- SUMMARY --}}
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">

                    <div class="bg-white border border-slate-200 rounded-2xl p-4 shadow-sm">

                        <div class="flex items-center gap-3">

                            <div
                                class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600
                                    flex items-center justify-center">

                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                        d="M9 12h6m-6 4h6M9 8h6m5 13H4a2 2 0 01-2-2V5a2 2 0 012-2h16a2 2 0 012 2v14a2 2 0 01-2 2z" />

                                </svg>

                            </div>

                            <div>

                                <p class="text-xs text-slate-400">
                                    Data Ditampilkan
                                </p>

                                <p class="text-xl font-bold text-slate-900">
                                    {{ $kunjungans->total() }}
                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="bg-white border border-slate-200 rounded-2xl p-4 shadow-sm">

                        <div class="flex items-center gap-3">

                            <div
                                class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600
                                    flex items-center justify-center">

                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                        d="M5 13l4 4L19 7" />

                                </svg>

                            </div>

                            <div>

                                <p class="text-xs text-slate-400">
                                    Status
                                </p>

                                <p class="text-sm font-bold text-emerald-700 mt-1">
                                    Selesai
                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="bg-white border border-slate-200 rounded-2xl p-4 shadow-sm">

                        <div class="flex items-center gap-3">

                            <div
                                class="w-10 h-10 rounded-xl bg-sky-50 text-sky-600
                                    flex items-center justify-center">

                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                        d="M8 7V3m8 4V3m-9 8h10M5 5h14a2 2 0 012 2v12a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2z" />

                                </svg>

                            </div>

                            <div>

                                <p class="text-xs text-slate-400">
                                    Halaman
                                </p>

                                <p class="text-sm font-bold text-slate-900 mt-1">
                                    {{ $kunjungans->currentPage() }}
                                    /
                                    {{ $kunjungans->lastPage() }}
                                </p>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- LIST --}}
                <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">

                    {{-- HEADER LIST --}}
                    <div
                        class="px-5 py-4 border-b border-slate-100
                            flex flex-col sm:flex-row
                            sm:items-center sm:justify-between gap-2">

                        <div>

                            <h3 class="font-bold text-slate-900">
                                Riwayat Pelayanan
                            </h3>

                            <p class="text-xs text-slate-400 mt-1">
                                Riwayat kunjungan yang telah selesai.
                            </p>

                        </div>

                        @if ($kunjungans->total() > 0)
                            <p class="text-xs text-slate-400">

                                Menampilkan

                                <span class="font-semibold text-slate-600">
                                    {{ $kunjungans->firstItem() }}–{{ $kunjungans->lastItem() }}
                                </span>

                                dari

                                <span class="font-semibold text-slate-600">
                                    {{ $kunjungans->total() }}
                                </span>

                                data

                            </p>
                        @endif

                    </div>


                    @if ($kunjungans->count())

                        {{-- DESKTOP --}}
                        <div class="hidden lg:block overflow-x-auto">

                            <table class="min-w-full">

                                <thead class="bg-slate-50 border-b border-slate-100">

                                    <tr>

                                        <th
                                            class="px-5 py-3 text-left text-xs font-semibold
                                               uppercase tracking-wide text-slate-400">
                                            Tanggal
                                        </th>

                                        <th
                                            class="px-5 py-3 text-left text-xs font-semibold
                                               uppercase tracking-wide text-slate-400">
                                            Santri
                                        </th>

                                        <th
                                            class="px-5 py-3 text-left text-xs font-semibold
                                               uppercase tracking-wide text-slate-400">
                                            Keluhan
                                        </th>

                                        <th
                                            class="px-5 py-3 text-left text-xs font-semibold
                                               uppercase tracking-wide text-slate-400">
                                            Diagnosa
                                        </th>

                                        <th
                                            class="px-5 py-3 text-left text-xs font-semibold
                                               uppercase tracking-wide text-slate-400">
                                            Tindakan
                                        </th>

                                        <th
                                            class="px-5 py-3 text-right text-xs font-semibold
                                               uppercase tracking-wide text-slate-400">
                                            Aksi
                                        </th>

                                    </tr>

                                </thead>


                                <tbody class="divide-y divide-slate-100">

                                    @foreach ($kunjungans as $kunjungan)
                                        <tr class="hover:bg-slate-50 transition">

                                            {{-- TANGGAL --}}
                                            <td class="px-5 py-4 whitespace-nowrap">

                                                <p class="font-semibold text-slate-800">
                                                    {{ $kunjungan->tanggal?->format('d M Y') ?? '-' }}
                                                </p>

                                                <p class="text-xs text-slate-400 mt-1">
                                                    {{ $kunjungan->waktu ?? '-' }}
                                                </p>

                                            </td>


                                            {{-- SANTRI --}}
                                            <td class="px-5 py-4">

                                                <p class="font-semibold text-slate-800">
                                                    {{ $kunjungan->santri?->nama ?? '-' }}
                                                </p>

                                                <p class="text-xs text-slate-400 mt-1">
                                                    {{ $kunjungan->santri?->nomor_induk ?? '-' }}
                                                </p>

                                            </td>


                                            {{-- KELUHAN --}}
                                            <td class="px-5 py-4 max-w-xs">

                                                <p class="text-sm text-slate-600"
                                                    title="{{ $kunjungan->keluhan ?? '-' }}">

                                                    {{ \Illuminate\Support\Str::limit($kunjungan->keluhan ?? '-', 40) }}

                                                </p>

                                            </td>


                                            {{-- DIAGNOSA --}}
                                            <td class="px-5 py-4">

                                                @if ($kunjungan->diagnosas->count())
                                                    <div class="flex flex-wrap gap-1.5">

                                                        @foreach ($kunjungan->diagnosas->take(2) as $diagnosa)
                                                            <span
                                                                class="inline-flex px-2 py-1 rounded-lg
                                                                   bg-indigo-50 text-indigo-700
                                                                   text-xs font-medium">

                                                                {{ $diagnosa->nama }}

                                                            </span>
                                                        @endforeach

                                                        @if ($kunjungan->diagnosas->count() > 2)
                                                            <span
                                                                class="inline-flex px-2 py-1 rounded-lg
                                                                   bg-slate-100 text-slate-500
                                                                   text-xs font-medium">

                                                                +{{ $kunjungan->diagnosas->count() - 2 }}

                                                            </span>
                                                        @endif

                                                    </div>
                                                @else
                                                    <span class="text-xs text-slate-400">
                                                        -
                                                    </span>
                                                @endif

                                            </td>


                                            {{-- TINDAKAN --}}
                                            <td class="px-5 py-4">

                                                @if ($kunjungan->tindakans->count())
                                                    <div class="flex flex-wrap gap-1.5">

                                                        @foreach ($kunjungan->tindakans->take(2) as $tindakan)
                                                            <span
                                                                class="inline-flex px-2 py-1 rounded-lg
                                                                   bg-sky-50 text-sky-700
                                                                   text-xs font-medium">

                                                                {{ $tindakan->nama }}

                                                            </span>
                                                        @endforeach

                                                        @if ($kunjungan->tindakans->count() > 2)
                                                            <span
                                                                class="inline-flex px-2 py-1 rounded-lg
                                                                   bg-slate-100 text-slate-500
                                                                   text-xs font-medium">

                                                                +{{ $kunjungan->tindakans->count() - 2 }}

                                                            </span>
                                                        @endif

                                                    </div>
                                                @else
                                                    <span class="text-xs text-slate-400">
                                                        -
                                                    </span>
                                                @endif

                                            </td>


                                            {{-- AKSI --}}
                                            <td class="px-5 py-4">

                                                <div class="flex justify-end">

                                                    <button type="button"
                                                        onclick="openKunjunganModal('{{ route('kunjungan.show', [$kunjungan, 'modal' => 1]) }}','Detail Kunjungan')"
                                                        class="px-3 py-1.5 rounded-lg bg-slate-100 text-slate-700 text-xs font-semibold hover:bg-slate-200 transition">
                                                        Detail
                                                    </button>

                                                </div>

                                            </td>

                                        </tr>
                                    @endforeach

                                </tbody>

                            </table>

                        </div>


                        {{-- MOBILE --}}
                        <div class="lg:hidden divide-y divide-slate-100">

                            @foreach ($kunjungans as $kunjungan)
                                <div class="p-4">

                                    {{-- TOP --}}
                                    <div class="flex items-start justify-between gap-3">

                                        <div>

                                            <p class="font-bold text-slate-800">
                                                {{ $kunjungan->santri?->nama ?? '-' }}
                                            </p>

                                            <p class="text-xs text-slate-400 mt-1">
                                                {{ $kunjungan->santri?->nomor_induk ?? '-' }}
                                            </p>

                                        </div>

                                        <span
                                            class="inline-flex items-center px-2.5 py-1 rounded-full
                                               bg-emerald-50 border border-emerald-200
                                               text-emerald-700 text-xs font-semibold">

                                            Selesai

                                        </span>

                                    </div>


                                    {{-- INFO --}}
                                    <div class="grid grid-cols-2 gap-4 mt-4">

                                        <div>

                                            <p class="text-xs text-slate-400">
                                                Tanggal
                                            </p>

                                            <p class="text-sm font-semibold text-slate-700 mt-1">
                                                {{ $kunjungan->tanggal?->format('d M Y') ?? '-' }}
                                            </p>

                                        </div>

                                        <div>

                                            <p class="text-xs text-slate-400">
                                                Kode Kunjungan
                                            </p>

                                            <p class="text-sm font-semibold text-slate-700 mt-1">
                                                {{ $kunjungan->kode_kunjungan }}
                                            </p>

                                        </div>

                                    </div>


                                    {{-- KELUHAN --}}
                                    <div class="mt-4">

                                        <p class="text-xs text-slate-400">
                                            Keluhan
                                        </p>

                                        <p class="text-sm text-slate-600 mt-1">
                                            {{ $kunjungan->keluhan ?: '-' }}
                                        </p>

                                    </div>


                                    {{-- DIAGNOSA --}}
                                    <div class="mt-4">

                                        <p class="text-xs text-slate-400 mb-2">
                                            Diagnosa
                                        </p>

                                        @if ($kunjungan->diagnosas->count())
                                            <div class="flex flex-wrap gap-1.5">

                                                @foreach ($kunjungan->diagnosas as $diagnosa)
                                                    <span
                                                        class="inline-flex px-2 py-1 rounded-lg
                                                           bg-indigo-50 text-indigo-700
                                                           text-xs font-medium">

                                                        {{ $diagnosa->nama }}

                                                    </span>
                                                @endforeach

                                            </div>
                                        @else
                                            <span class="text-xs text-slate-400">
                                                Belum ada data
                                            </span>
                                        @endif

                                    </div>


                                    {{-- TINDAKAN --}}
                                    <div class="mt-4">

                                        <p class="text-xs text-slate-400 mb-2">
                                            Tindakan
                                        </p>

                                        @if ($kunjungan->tindakans->count())
                                            <div class="flex flex-wrap gap-1.5">

                                                @foreach ($kunjungan->tindakans as $tindakan)
                                                    <span
                                                        class="inline-flex px-2 py-1 rounded-lg
                                                           bg-sky-50 text-sky-700
                                                           text-xs font-medium">

                                                        {{ $tindakan->nama }}

                                                    </span>
                                                @endforeach

                                            </div>
                                        @else
                                            <span class="text-xs text-slate-400">
                                                Belum ada data
                                            </span>
                                        @endif

                                    </div>


                                    {{-- ACTION --}}
                                    <div class="mt-5">

                                        <button type="button"
                                            onclick="openKunjunganModal('{{ route('kunjungan.show', [$kunjungan, 'modal' => 1]) }}','Detail Kunjungan')"
                                            class="flex-1 text-center px-3 py-2 rounded-lg bg-slate-100 text-slate-700 text-sm font-semibold hover:bg-slate-200 transition">
                                            Lihat Detail Rekam Medis
                                        </button>

                                    </div>

                                </div>
                            @endforeach

                        </div>


                        {{-- PAGINATION --}}
                        <div class="px-5 py-4 border-t border-slate-100">

                            {{ $kunjungans->links() }}

                        </div>
                    @else
                        {{-- EMPTY STATE --}}
                        <div class="px-6 py-16 text-center">

                            <div
                                class="w-16 h-16 mx-auto rounded-2xl
                                   bg-slate-100 text-slate-400
                                   flex items-center justify-center">

                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M9 12h6m-6 4h6M9 8h6m5 13H4a2 2 0 01-2-2V5a2 2 0 012-2h16a2 2 0 012 2v14a2 2 0 01-2 2z" />

                                </svg>

                            </div>

                            <h3 class="mt-4 text-base font-bold text-slate-800">
                                Tidak ada rekam medis
                            </h3>

                            <p class="mt-1 text-sm text-slate-500 max-w-md mx-auto">

                                @if ($keyword)
                                    Tidak ditemukan riwayat pelayanan untuk
                                    pencarian
                                    <span class="font-semibold text-slate-700">
                                        "{{ $keyword }}"
                                    </span>.
                                @else
                                    Belum terdapat kunjungan yang berstatus selesai.
                                @endif

                            </p>

                            @if ($keyword)
                                <a href="{{ route('rekam-medis.index') }}"
                                    class="inline-flex items-center mt-5
                                       px-4 py-2 rounded-xl
                                       bg-slate-100 text-slate-700
                                       text-sm font-semibold
                                       hover:bg-slate-200 transition">

                                    Tampilkan Semua

                                </a>
                            @endif

                        </div>

                    @endif

                </div>

            </main>

        </div>
    </div>

    {{-- MODAL KUNJUNGAN --}}
    <div id="kunjunganModal" class="fixed inset-0 z-[9999] hidden" aria-hidden="true">
        {{-- Overlay --}}
        <div class="absolute inset-0 bg-slate-950/70 backdrop-blur-sm" onclick="closeKunjunganModal()">
        </div>

        {{-- Container --}}
        <div class="relative flex h-screen w-full items-center justify-center p-2 sm:p-5">

            <div
                class="relative flex h-full max-h-[96vh] w-full max-w-[1400px] flex-col overflow-hidden rounded-2xl bg-slate-50 shadow-2xl">

                {{-- HEADER --}}
                <div class="flex shrink-0 items-center justify-between border-b border-slate-200 bg-white px-5 py-3.5">

                    <div class="flex items-center gap-3">

                        <div
                            class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-600 text-white shadow-sm">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a3 3 0 006 0M9 5h6" />
                            </svg>
                        </div>

                        <div>
                            <h2 id="kunjunganModalTitle" class="text-base font-bold text-slate-800">
                                Kunjungan
                            </h2>

                            <p class="text-xs text-slate-500">
                                Sistem Informasi Poliklinik Madrasatul Qur'an
                            </p>
                        </div>

                    </div>

                    <button type="button" onclick="closeKunjunganModal()"
                        class="flex h-9 w-9 items-center justify-center rounded-xl text-slate-400 transition hover:bg-slate-100 hover:text-slate-700">

                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>

                    </button>

                </div>

                {{-- LOADING --}}
                <div id="kunjunganModalLoading"
                    class="absolute inset-0 top-[69px] z-20 hidden items-center justify-center bg-white/95">

                    <div class="text-center">

                        <div
                            class="mx-auto h-9 w-9 animate-spin rounded-full border-4 border-slate-200 border-t-indigo-600">
                        </div>

                        <p class="mt-3 text-sm font-medium text-slate-600">
                            Memuat data...
                        </p>

                    </div>

                </div>

                {{-- CONTENT --}}
                <div class="min-h-0 flex-1 overflow-hidden">

                    <iframe id="kunjunganModalFrame" src="about:blank" class="h-full w-full border-0"
                        loading="lazy">
                    </iframe>

                </div>

            </div>
        </div>
    </div>

    <script>
        function openKunjunganModal(url, title = 'Kunjungan') {

            const modal = document.getElementById('kunjunganModal');
            const frame = document.getElementById('kunjunganModalFrame');
            const titleElement = document.getElementById('kunjunganModalTitle');
            const loading = document.getElementById('kunjunganModalLoading');

            titleElement.textContent = title;

            loading.classList.remove('hidden');
            loading.classList.add('flex');

            modal.classList.remove('hidden');
            modal.setAttribute('aria-hidden', 'false');

            document.body.classList.add('overflow-hidden');

            frame.onload = function() {
                loading.classList.add('hidden');
                loading.classList.remove('flex');
            };

            frame.src = url;
        }

        function closeKunjunganModal() {

            const modal = document.getElementById('kunjunganModal');
            const frame = document.getElementById('kunjunganModalFrame');

            modal.classList.add('hidden');
            modal.setAttribute('aria-hidden', 'true');

            document.body.classList.remove('overflow-hidden');

            frame.src = 'about:blank';
        }

        document.addEventListener('keydown', function(event) {

            if (event.key === 'Escape') {
                closeKunjunganModal();
            }

        });
    </script>

</x-app-layout>
