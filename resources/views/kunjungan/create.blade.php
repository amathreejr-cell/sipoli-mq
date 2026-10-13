<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="text-xl font-semibold text-slate-800">
                Kunjungan Baru
            </h2>
            <p class="mt-1 text-sm text-slate-500">
                Catat kunjungan pelayanan kesehatan santri.
            </p>
        </div>
    </x-slot>


    <div class="min-h-screen bg-slate-50 py-6">

        <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">

            {{-- BREADCRUMB --}}
            <div class="mb-5 flex items-center gap-2 text-sm text-slate-500">

                <a href="{{ route('kunjungan.index') }}"
                    class="transition hover:text-indigo-600">
                    Kunjungan
                </a>

                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-4 w-4 text-slate-400"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M9 5l7 7-7 7" />
                </svg>

                <span class="font-medium text-slate-700">
                    Kunjungan Baru
                </span>

            </div>


            {{-- MAIN CARD --}}
            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                {{-- HEADER --}}
                <div class="border-b border-slate-100 bg-white px-5 py-5 sm:px-7">

                    <div class="flex items-start gap-4">

                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-indigo-100 text-indigo-600">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-6 w-6"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="1.8">
                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                        </div>

                        <div>
                            <h1 class="text-lg font-semibold text-slate-800">
                                Data Kunjungan
                            </h1>

                            <p class="mt-1 text-sm text-slate-500">
                                Cari dan pilih santri terlebih dahulu sebelum mencatat pelayanan.
                            </p>
                        </div>

                    </div>

                </div>


                <div class="p-5 sm:p-7">

                    {{-- ============================================= --}}
                    {{-- CARI SANTRI --}}
                    {{-- ============================================= --}}

                    <div class="mb-7">

                        <div class="mb-2 flex items-center justify-between">

                            <label for="search_santri"
                                class="block text-sm font-semibold text-slate-700">
                                Cari Santri
                            </label>

                            <span class="text-xs text-slate-400">
                                Nama / Nomor Induk
                            </span>

                        </div>


                        <div class="relative">

                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="1.8">
                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M21 21l-4.35-4.35m2.35-5.65a8 8 0 11-16 0 8 8 0 0116 0z" />
                                </svg>

                            </div>

                            <input
                                type="text"
                                id="search_santri"
                                placeholder="Ketik nama atau nomor induk santri..."
                                autocomplete="off"
                                class="block w-full rounded-xl border-slate-200 py-3 pl-11 pr-4 text-sm text-slate-700 shadow-sm transition focus:border-indigo-500 focus:ring-indigo-500"
                            >

                        </div>


                        {{-- HASIL PENCARIAN --}}
                        <div
                            id="hasil_santri"
                            class="mt-2 hidden overflow-hidden rounded-xl border border-slate-200 bg-white shadow-lg"
                        ></div>

                    </div>


                    {{-- ============================================= --}}
                    {{-- DATA SANTRI --}}
                    {{-- ============================================= --}}

                    <div
                        id="data_santri"
                        class="mb-7 hidden overflow-hidden rounded-2xl border border-indigo-100 bg-indigo-50/40"
                    >

                        <div class="border-b border-indigo-100 bg-indigo-50/70 px-5 py-4">

                            <div class="flex items-center gap-3">

                                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-indigo-100 text-indigo-600">

                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="1.8">
                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM5 21a7 7 0 0114 0" />
                                    </svg>

                                </div>

                                <div>
                                    <h3 class="text-sm font-semibold text-slate-800">
                                        Data Santri
                                    </h3>

                                    <p class="text-xs text-slate-500">
                                        Identitas santri yang dipilih.
                                    </p>
                                </div>

                            </div>

                        </div>


                        <div class="p-5">

                            <input type="hidden"
                                name="santri_id"
                                id="santri_id">


                            <div class="grid grid-cols-1 gap-x-6 gap-y-5 sm:grid-cols-2">

                                {{-- NOMOR INDUK --}}
                                <div>
                                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                                        Nomor Induk
                                    </p>

                                    <p id="nomor_induk"
                                        class="mt-1 font-semibold text-slate-800">
                                        -
                                    </p>
                                </div>


                                {{-- NAMA --}}
                                <div>
                                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                                        Nama
                                    </p>

                                    <p id="nama_santri"
                                        class="mt-1 font-semibold text-slate-800">
                                        -
                                    </p>
                                </div>


                                {{-- TTL --}}
                                <div>
                                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                                        Tempat, Tanggal Lahir
                                    </p>

                                    <p id="ttl_santri"
                                        class="mt-1 font-medium text-slate-700">
                                        -
                                    </p>
                                </div>


                                {{-- JENIS KELAMIN --}}
                                <div>
                                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                                        Jenis Kelamin
                                    </p>

                                    <p id="jenis_kelamin"
                                        class="mt-1 font-medium text-slate-700">
                                        -
                                    </p>
                                </div>


                                {{-- KAMAR --}}
                                <div>
                                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                                        Kamar
                                    </p>

                                    <p id="kamar_santri"
                                        class="mt-1 font-medium text-slate-700">
                                        -
                                    </p>
                                </div>


                                {{-- SEKOLAH --}}
                                <div>
                                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                                        Sekolah
                                    </p>

                                    <p id="sekolah_santri"
                                        class="mt-1 font-medium text-slate-700">
                                        -
                                    </p>
                                </div>


                                {{-- KELAS --}}
                                <div>
                                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                                        Kelas
                                    </p>

                                    <p id="kelas_santri"
                                        class="mt-1 font-medium text-slate-700">
                                        -
                                    </p>
                                </div>


                                {{-- STATUS --}}
                                <div>
                                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                                        Status
                                    </p>

                                    <p id="status_santri"
                                        class="mt-1 font-medium text-slate-700">
                                        -
                                    </p>
                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- ============================================= --}}
                    {{-- RIWAYAT KUNJUNGAN --}}
                    {{-- ============================================= --}}

                    <div
                        id="riwayat_kunjungan"
                        class="mb-7 hidden overflow-hidden rounded-2xl border border-slate-200 bg-white"
                    >

                        <div class="border-b border-slate-100 px-5 py-4">

                            <div class="flex items-center gap-3">

                                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-slate-100 text-slate-600">

                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="1.8">
                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M12 8v4l3 2m6-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>

                                </div>

                                <div>
                                    <h3 class="text-sm font-semibold text-slate-800">
                                        Riwayat Kunjungan Terakhir
                                    </h3>

                                    <p class="mt-0.5 text-xs text-slate-500">
                                        Maksimal 5 kunjungan terakhir santri.
                                    </p>
                                </div>

                            </div>

                        </div>


                        <div class="p-5">

                            <div
                                id="loading_riwayat"
                                class="hidden rounded-xl bg-slate-50 py-5 text-center text-sm text-slate-500"
                            >
                                <div class="flex items-center justify-center gap-2">

                                    <svg class="h-4 w-4 animate-spin"
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24">
                                        <circle
                                            class="opacity-25"
                                            cx="12"
                                            cy="12"
                                            r="10"
                                            stroke="currentColor"
                                            stroke-width="4">
                                        </circle>

                                        <path
                                            class="opacity-75"
                                            fill="currentColor"
                                            d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z">
                                        </path>
                                    </svg>

                                    Memuat riwayat kunjungan...
                                </div>
                            </div>


                            <div id="isi_riwayat"></div>

                        </div>

                    </div>


                    {{-- ============================================= --}}
                    {{-- FORM KUNJUNGAN --}}
                    {{-- ============================================= --}}

                    <form method="POST"
                        action="{{ route('kunjungan.store') }}">

                        @csrf

                        <input type="hidden"
                            name="santri_id"
                            id="form_santri_id">


                        {{-- SECTION TITLE --}}
                        <div class="mb-5 flex items-center gap-3">

                            <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-emerald-100 text-emerald-600">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="1.8">
                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M9 12h6m-6 4h6M7 4h10a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2z" />
                                </svg>

                            </div>

                            <div>
                                <h3 class="text-sm font-semibold text-slate-800">
                                    Informasi Kunjungan
                                </h3>

                                <p class="text-xs text-slate-500">
                                    Masukkan informasi awal pelayanan.
                                </p>
                            </div>

                        </div>


                        {{-- TANGGAL & WAKTU --}}
                        <div class="mb-6 grid grid-cols-1 gap-5 sm:grid-cols-2">

                            {{-- TANGGAL --}}
                            <div>

                                <label for="tanggal"
                                    class="mb-1.5 block text-sm font-medium text-slate-700">
                                    Tanggal
                                </label>

                                <input
                                    type="date"
                                    name="tanggal"
                                    id="tanggal"
                                    value="{{ old('tanggal', $tanggalSekarang) }}"
                                    required
                                    class="block w-full rounded-xl border-slate-200 py-2.5 text-sm text-slate-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                >

                                @error('tanggal')
                                    <p class="mt-1.5 text-xs text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>


                            {{-- WAKTU --}}
                            <div>

                                <label for="waktu"
                                    class="mb-1.5 block text-sm font-medium text-slate-700">
                                    Waktu
                                </label>

                                <input
                                    type="time"
                                    name="waktu"
                                    id="waktu"
                                    value="{{ old('waktu', $waktuSekarang) }}"
                                    required
                                    class="block w-full rounded-xl border-slate-200 py-2.5 text-sm text-slate-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                >

                                @error('waktu')
                                    <p class="mt-1.5 text-xs text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>

                        </div>


                        {{-- KELUHAN --}}
                        <div class="mb-6">

                            <label for="keluhan"
                                class="mb-1.5 block text-sm font-medium text-slate-700">
                                Keluhan
                            </label>

                            <textarea
                                name="keluhan"
                                id="keluhan"
                                rows="4"
                                required
                                placeholder="Tuliskan keluhan yang disampaikan santri..."
                                class="block w-full rounded-xl border-slate-200 text-sm text-slate-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            >{{ old('keluhan') }}</textarea>

                            @error('keluhan')
                                <p class="mt-1.5 text-xs text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- CATATAN --}}
                        <div class="mb-7">

                            <label for="catatan"
                                class="mb-1.5 block text-sm font-medium text-slate-700">
                                Catatan
                            </label>

                            <textarea
                                name="catatan"
                                id="catatan"
                                rows="3"
                                placeholder="Catatan tambahan jika diperlukan..."
                                class="block w-full rounded-xl border-slate-200 text-sm text-slate-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            >{{ old('catatan') }}</textarea>

                            @error('catatan')
                                <p class="mt-1.5 text-xs text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- ACTION --}}
                        <div class="flex flex-col-reverse gap-3 border-t border-slate-100 pt-5 sm:flex-row sm:items-center sm:justify-between">

                            <a
                                href="{{ route('kunjungan.index') }}"
                                class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-50"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="2">
                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                </svg>

                                Batal
                            </a>


                            <button
                                type="submit"
                                class="inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700 hover:shadow-md"
                            >
                                Simpan Kunjungan

                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="2">
                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- JAVASCRIPT --}}
    {{-- ========================================================= --}}

    <script>

        const searchInput = document.getElementById('search_santri');
        const hasilSantri = document.getElementById('hasil_santri');
        const dataSantri = document.getElementById('data_santri');


        /*
        |--------------------------------------------------------------------------
        | PILIH SANTRI
        |--------------------------------------------------------------------------
        */

        function pilihSantri(santri) {

            const riwayatKunjungan =
                document.getElementById('riwayat_kunjungan');

            const loadingRiwayat =
                document.getElementById('loading_riwayat');

            const isiRiwayat =
                document.getElementById('isi_riwayat');


            // ID santri
            document.getElementById('santri_id').value = santri.id;

            document.getElementById('form_santri_id').value = santri.id;


            // Data santri
            document.getElementById('nomor_induk').textContent =
                santri.nomor_induk ?? '-';

            document.getElementById('nama_santri').textContent =
                santri.nama ?? '-';

            document.getElementById('ttl_santri').textContent =
                (santri.tempat_lahir ?? '-') +
                ', ' +
                (santri.tanggal_lahir ?? '-');

            document.getElementById('jenis_kelamin').textContent =
                santri.jenis_kelamin ?? '-';

            document.getElementById('kamar_santri').textContent =
                santri.kamar ?? '-';

            document.getElementById('sekolah_santri').textContent =
                santri.sekolah ?? '-';

            document.getElementById('kelas_santri').textContent =
                santri.kelas ?? '-';

            document.getElementById('status_santri').textContent =
                santri.status ?? '-';


            // Isi input pencarian
            searchInput.value = santri.nama ?? '';


            // Tutup hasil pencarian
            hasilSantri.classList.add('hidden');
            hasilSantri.innerHTML = '';


            // Tampilkan data santri
            dataSantri.classList.remove('hidden');


            // Tampilkan riwayat
            riwayatKunjungan.classList.remove('hidden');

            loadingRiwayat.classList.remove('hidden');

            isiRiwayat.innerHTML = '';


            /*
            |--------------------------------------------------------------------------
            | AMBIL RIWAYAT KUNJUNGAN
            |--------------------------------------------------------------------------
            */

            fetch(`/santri/${santri.id}/riwayat-kunjungan`)

                .then(response => {

                    if (!response.ok) {
                        throw new Error(
                            'Gagal mengambil riwayat kunjungan.'
                        );
                    }

                    return response.json();

                })

                .then(data => {

                    loadingRiwayat.classList.add('hidden');


                    if (
                        !data.kunjungans ||
                        data.kunjungans.length === 0
                    ) {

                        isiRiwayat.innerHTML = `
                            <div class="rounded-xl bg-slate-50 px-4 py-5 text-center text-sm text-slate-500">
                                Belum ada riwayat kunjungan untuk santri ini.
                            </div>
                        `;

                        return;
                    }


                    isiRiwayat.innerHTML =
                        data.kunjungans.map(kunjungan => `

                        <div class="mb-3 rounded-xl border border-slate-200 bg-slate-50/70 p-4 last:mb-0">

                            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

                                <div>

                                    <div class="flex items-center gap-2">

                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-4 w-4 text-slate-400"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                            stroke-width="1.8">
                                            <path stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>

                                        <p class="font-semibold text-slate-800">
                                            ${kunjungan.tanggal ?? '-'}
                                        </p>

                                    </div>

                                    <p class="mt-1 text-xs text-slate-500">
                                        ${kunjungan.waktu ?? '-'}
                                    </p>

                                </div>


                                <span class="inline-flex w-fit items-center gap-1.5 rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700">

                                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>

                                    ${kunjungan.status ?? '-'}

                                </span>

                            </div>


                            <div class="mt-4 grid grid-cols-1 gap-3 sm:grid-cols-2">

                                <div>

                                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                                        Keluhan
                                    </p>

                                    <p class="mt-1 text-sm text-slate-700">
                                        ${kunjungan.keluhan ?? '-'}
                                    </p>

                                </div>


                                <div>

                                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                                        Diagnosa
                                    </p>

                                    <p class="mt-1 text-sm text-slate-700">
                                        ${
                                            kunjungan.diagnosa?.length
                                                ? kunjungan.diagnosa.join(', ')
                                                : '-'
                                        }
                                    </p>

                                </div>


                                <div>

                                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                                        Tindakan
                                    </p>

                                    <p class="mt-1 text-sm text-slate-700">
                                        ${
                                            kunjungan.tindakan?.length
                                                ? kunjungan.tindakan.join(', ')
                                                : '-'
                                        }
                                    </p>

                                </div>

                            </div>


                            <div class="mt-4">

                                <a
                                    href="/kunjungan/${kunjungan.id}?from=create&santri_id=${santri.id}"
                                    class="inline-flex items-center gap-1.5 text-sm font-semibold text-indigo-600 hover:text-indigo-800"
                                >
                                    Lihat Detail

                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-4 w-4"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="2">
                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M9 5l7 7-7 7" />
                                    </svg>

                                </a>

                            </div>

                        </div>

                    `).join('');

                })

                .catch(error => {

                    console.error(error);

                    loadingRiwayat.classList.add('hidden');

                    isiRiwayat.innerHTML = `
                        <div class="rounded-xl border border-red-100 bg-red-50 px-4 py-4 text-sm text-red-600">
                            Riwayat kunjungan gagal dimuat.
                        </div>
                    `;

                });
        }


        /*
        |--------------------------------------------------------------------------
        | PENCARIAN SANTRI
        |--------------------------------------------------------------------------
        */

        searchInput.addEventListener('input', function () {

            const keyword = this.value.trim();


            if (keyword.length < 2) {

                hasilSantri.classList.add('hidden');

                hasilSantri.innerHTML = '';

                return;
            }


            fetch(
                `/santri/search?q=${encodeURIComponent(keyword)}`
            )

                .then(response => {

                    if (!response.ok) {
                        throw new Error(
                            'Pencarian santri gagal.'
                        );
                    }

                    return response.json();

                })

                .then(data => {

                    hasilSantri.innerHTML = '';


                    if (data.length === 0) {

                        hasilSantri.innerHTML = `
                            <div class="px-4 py-4 text-center text-sm text-slate-500">
                                Santri tidak ditemukan.
                            </div>
                        `;

                        hasilSantri.classList.remove('hidden');

                        return;
                    }


                    data.forEach(santri => {

                        const item =
                            document.createElement('button');

                        item.type = 'button';

                        item.className =
                            'block w-full border-b border-slate-100 px-4 py-3 text-left transition last:border-b-0 hover:bg-indigo-50';


                        item.innerHTML = `

                            <div class="flex items-center gap-3">

                                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-indigo-100 text-sm font-semibold text-indigo-600">
                                    ${santri.nama
                                        ? santri.nama.charAt(0).toUpperCase()
                                        : '?'}
                                </div>

                                <div class="min-w-0">

                                    <div class="truncate font-semibold text-slate-800">
                                        ${santri.nama}
                                    </div>

                                    <div class="mt-0.5 text-xs text-slate-500">
                                        ${santri.nomor_induk}
                                        ${santri.kamar
                                            ? ' • ' + santri.kamar
                                            : ''}
                                    </div>

                                </div>

                            </div>

                        `;


                        item.addEventListener(
                            'click',
                            function () {
                                pilihSantri(santri);
                            }
                        );


                        hasilSantri.appendChild(item);

                    });


                    hasilSantri.classList.remove('hidden');

                })

                .catch(error => {

                    console.error(
                        'Pencarian gagal:',
                        error
                    );

                });

        });


        /*
        |--------------------------------------------------------------------------
        | RESTORE SANTRI DARI URL
        |--------------------------------------------------------------------------
        */

        document.addEventListener(
            'DOMContentLoaded',
            function () {

                const urlParams =
                    new URLSearchParams(
                        window.location.search
                    );

                const santriIdDariUrl =
                    urlParams.get('santri_id');


                if (!santriIdDariUrl) {
                    return;
                }


                fetch(
                    `/santri/${santriIdDariUrl}/data`
                )

                    .then(response => {

                        if (!response.ok) {

                            throw new Error(
                                'Data santri tidak ditemukan.'
                            );

                        }

                        return response.json();

                    })

                    .then(santri => {

                        pilihSantri(santri);

                    })

                    .catch(error => {

                        console.error(
                            'Gagal restore santri:',
                            error
                        );

                    });

            }
        );

    </script>

</x-app-layout>