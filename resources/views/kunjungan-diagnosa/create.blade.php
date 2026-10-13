<x-app-layout>

    <x-slot name="header">
        <div>
            <p class="text-sm text-gray-500">Pelayanan Poliklinik</p>
            <h2 class="text-2xl font-bold text-gray-800">
                Diagnosa Santri
            </h2>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- ================================= --}}
            {{-- ALERT --}}
            {{-- ================================= --}}

            @if (session('success'))
                <div class="mb-5 rounded-xl border border-green-200 bg-green-50 px-5 py-4 text-sm text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-5 rounded-xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-700">
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-5 rounded-xl border border-red-200 bg-red-50 px-5 py-4">

                    <p class="mb-2 text-sm font-semibold text-red-700">
                        Periksa kembali data diagnosa:
                    </p>

                    <ul class="list-disc space-y-1 pl-5 text-sm text-red-600">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>

                </div>
            @endif


            {{-- ================================= --}}
            {{-- STEPPER 7 TAHAP --}}
            {{-- ================================= --}}

            <div class="mb-6 overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-100">

                <div class="overflow-x-auto px-4 py-5 sm:px-6">

                    <div class="flex min-w-[900px] items-center">

                        {{-- 1 KUNJUNGAN --}}
                        <div class="flex shrink-0 items-center">

                            <div class="flex h-9 w-9 items-center justify-center rounded-full bg-green-600 text-sm font-bold text-white">
                                ✓
                            </div>

                            <div class="ml-2">
                                <p class="text-xs font-semibold text-green-600">01</p>
                                <p class="text-sm font-medium text-gray-700">
                                    Kunjungan
                                </p>
                            </div>

                        </div>

                        <div class="mx-3 h-px flex-1 bg-green-200"></div>


                        {{-- 2 PEMERIKSAAN --}}
                        <div class="flex shrink-0 items-center">

                            <div class="flex h-9 w-9 items-center justify-center rounded-full bg-green-600 text-sm font-bold text-white">
                                ✓
                            </div>

                            <div class="ml-2">
                                <p class="text-xs font-semibold text-green-600">02</p>
                                <p class="text-sm font-medium text-gray-700">
                                    Pemeriksaan
                                </p>
                            </div>

                        </div>

                        <div class="mx-3 h-px flex-1 bg-green-200"></div>


                        {{-- 3 DIAGNOSA --}}
                        <div class="flex shrink-0 items-center">

                            <div class="flex h-9 w-9 items-center justify-center rounded-full bg-indigo-600 text-sm font-bold text-white shadow-md shadow-indigo-200">
                                3
                            </div>

                            <div class="ml-2">
                                <p class="text-xs font-semibold text-indigo-600">03</p>
                                <p class="text-sm font-semibold text-indigo-600">
                                    Diagnosa
                                </p>
                            </div>

                        </div>

                        <div class="mx-3 h-px flex-1 bg-gray-200"></div>


                        {{-- 4 TINDAKAN --}}
                        <div class="flex shrink-0 items-center">

                            <div class="flex h-9 w-9 items-center justify-center rounded-full bg-gray-100 text-sm font-bold text-gray-500">
                                4
                            </div>

                            <div class="ml-2">
                                <p class="text-xs font-medium text-gray-400">04</p>
                                <p class="text-sm text-gray-500">
                                    Tindakan
                                </p>
                            </div>

                        </div>

                        <div class="mx-3 h-px flex-1 bg-gray-200"></div>


                        {{-- 5 KEPUTUSAN --}}
                        <div class="flex shrink-0 items-center">

                            <div class="flex h-9 w-9 items-center justify-center rounded-full bg-gray-100 text-sm font-bold text-gray-500">
                                5
                            </div>

                            <div class="ml-2">
                                <p class="text-xs font-medium text-gray-400">05</p>
                                <p class="text-sm text-gray-500">
                                    Keputusan
                                </p>
                            </div>

                        </div>

                        <div class="mx-3 h-px flex-1 bg-gray-200"></div>


                        {{-- 6 RUJUKAN / OBAT --}}
                        <div class="flex shrink-0 items-center">

                            <div class="flex h-9 w-9 items-center justify-center rounded-full bg-gray-100 text-sm font-bold text-gray-500">
                                6
                            </div>

                            <div class="ml-2">
                                <p class="text-xs font-medium text-gray-400">06</p>
                                <p class="text-sm text-gray-500">
                                    Rujukan / Obat
                                </p>
                            </div>

                        </div>

                        <div class="mx-3 h-px flex-1 bg-gray-200"></div>


                        {{-- 7 RINGKASAN --}}
                        <div class="flex shrink-0 items-center">

                            <div class="flex h-9 w-9 items-center justify-center rounded-full bg-gray-100 text-sm font-bold text-gray-500">
                                7
                            </div>

                            <div class="ml-2">
                                <p class="text-xs font-medium text-gray-400">07</p>
                                <p class="text-sm text-gray-500">
                                    Ringkasan
                                </p>
                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- ================================= --}}
            {{-- INFORMASI KUNJUNGAN --}}
            {{-- ================================= --}}

            <div class="mb-6 overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-100">

                <div class="border-b border-gray-100 px-6 py-5">

                    <div class="flex items-center gap-3">

                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-50 text-blue-600">

                            <svg class="h-6 w-6"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a3 3 0 006 0M9 5h6"/>

                            </svg>

                        </div>

                        <div>

                            <h3 class="font-bold text-gray-800">
                                Informasi Kunjungan
                            </h3>

                            <p class="text-sm text-gray-500">
                                Data dasar pelayanan santri
                            </p>

                        </div>

                    </div>

                </div>


                <div class="grid grid-cols-1 gap-5 px-6 py-6 sm:grid-cols-2 lg:grid-cols-4">

                    <div class="rounded-xl bg-gray-50 p-4">

                        <p class="text-xs font-medium uppercase tracking-wide text-gray-400">
                            Kode Kunjungan
                        </p>

                        <p class="mt-2 font-bold text-gray-800">
                            {{ $kunjungan->kode_kunjungan }}
                        </p>

                    </div>


                    <div class="rounded-xl bg-gray-50 p-4">

                        <p class="text-xs font-medium uppercase tracking-wide text-gray-400">
                            Nama Santri
                        </p>

                        <p class="mt-2 font-bold text-gray-800">
                            {{ $kunjungan->santri?->nama }}
                        </p>

                    </div>


                    <div class="rounded-xl bg-gray-50 p-4">

                        <p class="text-xs font-medium uppercase tracking-wide text-gray-400">
                            Nomor Induk
                        </p>

                        <p class="mt-2 font-bold text-gray-800">
                            {{ $kunjungan->santri?->nomor_induk }}
                        </p>

                    </div>


                    <div class="rounded-xl bg-gray-50 p-4">

                        <p class="text-xs font-medium uppercase tracking-wide text-gray-400">
                            Tanggal
                        </p>

                        <p class="mt-2 font-bold text-gray-800">
                            {{ $kunjungan->tanggal?->format('d-m-Y') }}
                        </p>

                    </div>


                    <div class="rounded-xl border border-amber-100 bg-amber-50 p-4 sm:col-span-2 lg:col-span-4">

                        <div class="flex items-start gap-3">

                            <svg class="mt-0.5 h-5 w-5 shrink-0 text-amber-600"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M12 9v4m0 4h.01M10.3 3.9l-8 14A2 2 0 004 21h16a2 2 0 001.7-3.1l-8-14a2 2 0 00-3.4 0z"/>

                            </svg>

                            <div>

                                <p class="text-xs font-semibold uppercase tracking-wide text-amber-700">
                                    Keluhan
                                </p>

                                <p class="mt-1 whitespace-pre-line text-sm leading-6 text-gray-700">
                                    {{ $kunjungan->keluhan ?: '-' }}
                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- ================================= --}}
            {{-- FORM DIAGNOSA --}}
            {{-- ================================= --}}

            <form method="POST"
                action="{{ route('kunjungan-diagnosa.store', $kunjungan) }}">

                @csrf

                <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-100">


                    {{-- HEADER --}}
                    <div class="border-b border-gray-100 px-6 py-5">

                        <div class="flex items-center gap-3">

                            <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-purple-50 text-purple-600">

                                <svg class="h-6 w-6"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24">

                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.8"
                                        d="M9 3h6m-7 4h8m-9 4h10m-9 4h8m-7 4h6"/>

                                </svg>

                            </div>

                            <div>

                                <h3 class="font-bold text-gray-800">
                                    Diagnosa
                                </h3>

                                <p class="text-sm text-gray-500">
                                    Cari dan pilih satu atau beberapa diagnosa.
                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="p-6">


                        {{-- ================================= --}}
                        {{-- PENCARIAN DIAGNOSA --}}
                        {{-- ================================= --}}

                        <div>

                            <label for="diagnosa_search"
                                class="mb-2 block text-sm font-semibold text-gray-700">

                                Cari Diagnosa

                            </label>

                            <div class="relative">

                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">

                                    <svg class="h-5 w-5 text-gray-400"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24">

                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="1.8"
                                            d="M21 21l-4.35-4.35m2.1-5.4a7.5 7.5 0 11-15 0 7.5 7.5 0 0115 0z"/>

                                    </svg>

                                </div>

                                <input
                                    type="text"
                                    id="diagnosa_search"
                                    placeholder="Ketik kode atau nama diagnosa..."
                                    autocomplete="off"
                                    class="block w-full rounded-xl border-gray-200 bg-gray-50 py-3 pl-11 pr-4 text-sm shadow-sm focus:border-indigo-500 focus:bg-white focus:ring-indigo-500">

                            </div>

                            <p class="mt-1.5 text-xs text-gray-400">
                                Ketik minimal 2 karakter untuk mencari diagnosa.
                            </p>

                        </div>


                        {{-- ================================= --}}
                        {{-- HASIL PENCARIAN --}}
                        {{-- ================================= --}}

                        <div id="diagnosa_results"
                            class="mt-2 hidden overflow-hidden rounded-xl border border-gray-200 bg-white shadow-lg">
                        </div>


                        {{-- ================================= --}}
                        {{-- DIAGNOSA TERPILIH --}}
                        {{-- ================================= --}}

                        <div class="mt-7">

                            <div class="mb-3 flex items-center justify-between">

                                <div>

                                    <h4 class="text-sm font-bold text-gray-800">
                                        Diagnosa Terpilih
                                    </h4>

                                    <p class="mt-0.5 text-xs text-gray-400">
                                        Diagnosa yang akan disimpan pada kunjungan ini.
                                    </p>

                                </div>

                                <span id="selected_count"
                                    class="rounded-full bg-indigo-50 px-3 py-1 text-xs font-semibold text-indigo-600">
                                    0 dipilih
                                </span>

                            </div>


                            <div id="selected_diagnosas"
                                class="space-y-3">
                            </div>


                            <div id="empty_selected"
                                class="rounded-xl border border-dashed border-gray-200 bg-gray-50 px-5 py-6 text-center">

                                <div class="mx-auto flex h-10 w-10 items-center justify-center rounded-full bg-gray-100">

                                    <svg class="h-5 w-5 text-gray-400"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24">

                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="1.8"
                                            d="M12 9v4m0 4h.01M12 3a9 9 0 100 18 9 9 0 000-18z"/>

                                    </svg>

                                </div>

                                <p class="mt-2 text-sm font-medium text-gray-500">
                                    Belum ada diagnosa yang dipilih.
                                </p>

                                <p class="mt-1 text-xs text-gray-400">
                                    Gunakan kolom pencarian di atas untuk memilih diagnosa.
                                </p>

                            </div>

                        </div>


                        {{-- ================================= --}}
                        {{-- CATATAN --}}
                        {{-- ================================= --}}

                        <div class="mt-7">

                            <label for="catatan"
                                class="mb-2 block text-sm font-semibold text-gray-700">

                                Catatan Diagnosa

                            </label>

                            <textarea
                                name="catatan"
                                id="catatan"
                                rows="4"
                                placeholder="Catatan tambahan jika diperlukan..."
                                class="block w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3 text-sm shadow-sm focus:border-indigo-500 focus:bg-white focus:ring-indigo-500">{{ old('catatan') }}</textarea>

                            @error('catatan')
                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        @error('diagnosa_ids')
                            <div class="mt-4 rounded-lg bg-red-50 px-4 py-3 text-sm text-red-600">
                                {{ $message }}
                            </div>
                        @enderror


                    </div>


                    {{-- ================================= --}}
                    {{-- FOOTER --}}
                    {{-- ================================= --}}

                    <div class="flex flex-col-reverse gap-3 border-t border-gray-100 bg-gray-50/70 px-6 py-5 sm:flex-row sm:items-center sm:justify-between">

                        <a href="{{ route('kunjungan.show', $kunjungan) }}"
                            class="inline-flex items-center justify-center rounded-xl border border-gray-200 bg-white px-5 py-2.5 text-sm font-semibold text-gray-700 shadow-sm hover:bg-gray-50">

                            ← Kembali

                        </a>


                        <button type="submit"
                            class="inline-flex items-center justify-center rounded-xl bg-indigo-600 px-6 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700">

                            Simpan & Lanjut ke Tindakan

                            <svg class="ml-2 h-4 w-4"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M9 5l7 7-7 7"/>

                            </svg>

                        </button>

                    </div>

                </div>

            </form>

        </div>
    </div>


    {{-- ================================= --}}
    {{-- JAVASCRIPT DIAGNOSA --}}
    {{-- ================================= --}}

    <script>

        const searchInput = document.getElementById('diagnosa_search');

        const resultsContainer =
            document.getElementById('diagnosa_results');

        const selectedContainer =
            document.getElementById('selected_diagnosas');

        const emptySelected =
            document.getElementById('empty_selected');

        const selectedCount =
            document.getElementById('selected_count');


        const diagnosas = @json($diagnosas);

        let selectedDiagnosas =
            @json($kunjungan->diagnosas);


        // =================================
        // RENDER DIAGNOSA TERPILIH
        // =================================

        function renderSelected() {

            selectedContainer.innerHTML = '';


            selectedCount.textContent =
                `${selectedDiagnosas.length} dipilih`;


            if (selectedDiagnosas.length === 0) {

                emptySelected.classList.remove('hidden');

                return;

            }


            emptySelected.classList.add('hidden');


            selectedDiagnosas.forEach(diagnosa => {

                const wrapper =
                    document.createElement('div');


                wrapper.className =
                    'flex items-start justify-between gap-4 rounded-xl border border-indigo-100 bg-indigo-50/50 p-4';


                wrapper.innerHTML = `

                    <div class="flex min-w-0 items-start gap-3">

                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-indigo-100 text-indigo-600">

                            <span class="text-xs font-bold">
                                D
                            </span>

                        </div>

                        <div class="min-w-0">

                            <div class="font-semibold text-gray-800">
                                ${diagnosa.kode} - ${diagnosa.nama}
                            </div>

                            ${
                                diagnosa.deskripsi
                                    ? `
                                        <div class="mt-1 text-sm leading-5 text-gray-500">
                                            ${diagnosa.deskripsi}
                                        </div>
                                      `
                                    : ''
                            }

                            <input
                                type="hidden"
                                name="diagnosa_ids[]"
                                value="${diagnosa.id}"
                            >

                        </div>

                    </div>


                    <button
                        type="button"
                        class="shrink-0 rounded-lg px-3 py-1.5 text-xs font-semibold text-red-600 hover:bg-red-50 hover:text-red-700"
                        onclick="removeDiagnosa(${diagnosa.id})">

                        Hapus

                    </button>

                `;


                selectedContainer.appendChild(wrapper);

            });

        }


        // =================================
        // RENDER HASIL PENCARIAN
        // =================================

        function renderResults(keyword) {

            resultsContainer.innerHTML = '';


            if (keyword.length < 2) {

                resultsContainer.classList.add('hidden');

                return;

            }


            const search =
                keyword.toLowerCase();


            const results =
                diagnosas

                    .filter(diagnosa => {

                        return (

                            diagnosa.kode
                                .toLowerCase()
                                .includes(search)

                            ||

                            diagnosa.nama
                                .toLowerCase()
                                .includes(search)

                        );

                    })

                    .filter(diagnosa => {

                        return !selectedDiagnosas.some(

                            selected =>
                                selected.id === diagnosa.id

                        );

                    })

                    .slice(0, 10);


            if (results.length === 0) {

                resultsContainer.innerHTML = `

                    <div class="px-5 py-5 text-center">

                        <p class="text-sm font-medium text-gray-500">
                            Diagnosa tidak ditemukan.
                        </p>

                        <p class="mt-1 text-xs text-gray-400">
                            Coba gunakan kode atau nama diagnosa lain.
                        </p>

                    </div>

                `;

                resultsContainer.classList.remove('hidden');

                return;

            }


            results.forEach((diagnosa, index) => {

                const button =
                    document.createElement('button');


                button.type = 'button';


                button.className =
                    'block w-full border-b border-gray-100 px-5 py-4 text-left transition hover:bg-indigo-50 last:border-b-0';


                button.innerHTML = `

                    <div class="flex items-start gap-3">

                        <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-gray-100 text-gray-500">

                            <span class="text-xs font-bold">
                                D
                            </span>

                        </div>

                        <div class="min-w-0">

                            <div class="font-semibold text-gray-800">
                                ${diagnosa.kode} - ${diagnosa.nama}
                            </div>

                            ${
                                diagnosa.deskripsi
                                    ? `
                                        <div class="mt-1 text-sm text-gray-500">
                                            ${diagnosa.deskripsi}
                                        </div>
                                      `
                                    : ''
                            }

                        </div>

                    </div>

                `;


                button.addEventListener('click', () => {

                    selectedDiagnosas.push(diagnosa);

                    searchInput.value = '';

                    resultsContainer.classList.add('hidden');

                    renderSelected();

                    searchInput.focus();

                });


                resultsContainer.appendChild(button);

            });


            resultsContainer.classList.remove('hidden');

        }


        // =================================
        // HAPUS DIAGNOSA
        // =================================

        function removeDiagnosa(id) {

            selectedDiagnosas =
                selectedDiagnosas.filter(

                    diagnosa =>
                        diagnosa.id !== id

                );


            renderSelected();

        }


        // =================================
        // SEARCH
        // =================================

        searchInput.addEventListener(
            'input',
            function () {

                renderResults(
                    this.value.trim()
                );

            }
        );


        // =================================
        // TUTUP HASIL SEARCH
        // =================================

        document.addEventListener(
            'click',
            function (event) {

                if (

                    !searchInput.contains(
                        event.target
                    )

                    &&

                    !resultsContainer.contains(
                        event.target
                    )

                ) {

                    resultsContainer.classList.add(
                        'hidden'
                    );

                }

            }
        );


        // =================================
        // INITIAL
        // =================================

        renderSelected();

    </script>

</x-app-layout>