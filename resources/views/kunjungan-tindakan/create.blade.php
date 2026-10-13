<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-bold text-gray-900">
                    Tindakan
                </h2>
                <p class="mt-1 text-sm text-gray-500">
                    Tentukan tindakan pelayanan yang diberikan kepada santri.
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- =========================================================
                STEPPER
            ========================================================== --}}
            <div class="bg-white border border-gray-200 rounded-2xl shadow-sm mb-6">
                <div class="px-5 py-5 overflow-x-auto">
                    <div class="flex items-center min-w-max">

                        {{-- 1. Kunjungan --}}
                        <div class="flex items-center">
                            <span class="flex items-center justify-center
                                w-9 h-9 rounded-full
                                bg-emerald-500 text-white
                                text-sm font-bold shadow-sm">
                                ✓
                            </span>

                            <span class="ml-2 text-sm font-semibold text-gray-700">
                                Kunjungan
                            </span>
                        </div>

                        <div class="w-12 h-px bg-emerald-300 mx-3"></div>

                        {{-- 2. Pemeriksaan --}}
                        <div class="flex items-center">
                            <span class="flex items-center justify-center
                                w-9 h-9 rounded-full
                                bg-emerald-500 text-white
                                text-sm font-bold shadow-sm">
                                ✓
                            </span>

                            <span class="ml-2 text-sm font-semibold text-gray-700">
                                Pemeriksaan
                            </span>
                        </div>

                        <div class="w-12 h-px bg-emerald-300 mx-3"></div>

                        {{-- 3. Diagnosa --}}
                        <div class="flex items-center">
                            <span class="flex items-center justify-center
                                w-9 h-9 rounded-full
                                bg-emerald-500 text-white
                                text-sm font-bold shadow-sm">
                                ✓
                            </span>

                            <span class="ml-2 text-sm font-semibold text-gray-700">
                                Diagnosa
                            </span>
                        </div>

                        <div class="w-12 h-px bg-indigo-300 mx-3"></div>

                        {{-- 4. Tindakan --}}
                        <div class="flex items-center">
                            <span class="flex items-center justify-center
                                w-9 h-9 rounded-full
                                bg-indigo-600 text-white
                                text-sm font-bold shadow-sm">
                                4
                            </span>

                            <span class="ml-2 text-sm font-bold text-indigo-600">
                                Tindakan
                            </span>
                        </div>

                        <div class="w-12 h-px bg-gray-200 mx-3"></div>

                        {{-- 5. Keputusan --}}
                        <div class="flex items-center text-gray-400">
                            <span class="flex items-center justify-center
                                w-9 h-9 rounded-full
                                bg-gray-100
                                text-sm font-semibold">
                                5
                            </span>

                            <span class="ml-2 text-sm font-medium">
                                Keputusan
                            </span>
                        </div>

                        <div class="w-12 h-px bg-gray-200 mx-3"></div>

                        {{-- 6. Rujukan / Resep & Obat --}}
                        <div class="flex items-center text-gray-400">
                            <span class="flex items-center justify-center
                                w-9 h-9 rounded-full
                                bg-gray-100
                                text-sm font-semibold">
                                6
                            </span>

                            <span class="ml-2 text-sm font-medium">
                                Rujukan / Obat
                            </span>
                        </div>

                        <div class="w-12 h-px bg-gray-200 mx-3"></div>

                        {{-- 7. Ringkasan --}}
                        <div class="flex items-center text-gray-400">
                            <span class="flex items-center justify-center
                                w-9 h-9 rounded-full
                                bg-gray-100
                                text-sm font-semibold">
                                7
                            </span>

                            <span class="ml-2 text-sm font-medium">
                                Ringkasan
                            </span>
                        </div>

                    </div>
                </div>
            </div>


            {{-- =========================================================
                INFORMASI KUNJUNGAN
            ========================================================== --}}
            <div class="bg-white border border-gray-200 rounded-2xl shadow-sm mb-6 overflow-hidden">

                <div class="px-6 py-5 border-b border-gray-100">
                    <div class="flex items-center gap-3">

                        <div class="w-10 h-10 rounded-xl bg-indigo-50
                                    flex items-center justify-center">

                            <svg class="w-5 h-5 text-indigo-600"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />

                            </svg>

                        </div>

                        <div>
                            <h3 class="text-base font-bold text-gray-900">
                                Informasi Kunjungan
                            </h3>

                            <p class="text-sm text-gray-500">
                                Data dasar pelayanan santri
                            </p>
                        </div>

                    </div>
                </div>

                <div class="p-6">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                        {{-- Kode --}}
                        <div>
                            <p class="text-xs font-medium uppercase tracking-wide text-gray-400">
                                Kode Kunjungan
                            </p>

                            <p class="mt-1 font-semibold text-gray-900">
                                {{ $kunjungan->kode_kunjungan }}
                            </p>
                        </div>

                        {{-- Nama --}}
                        <div>
                            <p class="text-xs font-medium uppercase tracking-wide text-gray-400">
                                Nama Santri
                            </p>

                            <p class="mt-1 font-semibold text-gray-900">
                                {{ $kunjungan->santri?->nama }}
                            </p>
                        </div>

                        {{-- Nomor Induk --}}
                        <div>
                            <p class="text-xs font-medium uppercase tracking-wide text-gray-400">
                                Nomor Induk
                            </p>

                            <p class="mt-1 font-semibold text-gray-900">
                                {{ $kunjungan->santri?->nomor_induk }}
                            </p>
                        </div>

                        {{-- Keluhan --}}
                        <div>
                            <p class="text-xs font-medium uppercase tracking-wide text-gray-400">
                                Keluhan
                            </p>

                            <p class="mt-1 font-medium text-gray-700">
                                {{ $kunjungan->keluhan ?: '-' }}
                            </p>
                        </div>

                    </div>

                </div>
            </div>


            {{-- =========================================================
                FORM TINDAKAN
            ========================================================== --}}
            <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">

                <div class="px-6 py-5 border-b border-gray-100">

                    <div class="flex items-start gap-3">

                        <div class="w-10 h-10 rounded-xl bg-emerald-50
                                    flex items-center justify-center flex-shrink-0">

                            <svg class="w-5 h-5 text-emerald-600"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M19.428 15.341A8 8 0 116.66 4.572M12 8v4l3 2" />

                            </svg>

                        </div>

                        <div>
                            <h3 class="text-base font-bold text-gray-900">
                                Pilih Tindakan
                            </h3>

                            <p class="mt-1 text-sm text-gray-500">
                                Cari dan pilih satu atau beberapa tindakan yang diberikan.
                            </p>
                        </div>

                    </div>

                </div>


                <div class="p-6">

                    <form method="POST"
                        action="{{ route('kunjungan-tindakan.store', $kunjungan) }}">

                        @csrf


                        {{-- =================================================
                            SEARCH TINDAKAN
                        ================================================== --}}
                        <div>

                            <label for="tindakan_search"
                                class="block text-sm font-semibold text-gray-700 mb-2">

                                Cari Tindakan

                            </label>

                            <div class="relative">

                                <div class="absolute inset-y-0 left-0 pl-3
                                            flex items-center pointer-events-none">

                                    <svg class="w-5 h-5 text-gray-400"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24">

                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M21 21l-4.35-4.35m1.35-5.65a7 7 0 11-14 0 7 7 0 0114 0z" />

                                    </svg>

                                </div>

                                <input
                                    type="text"
                                    id="tindakan_search"
                                    placeholder="Ketik kode atau nama tindakan..."
                                    autocomplete="off"
                                    class="block w-full pl-10 pr-4 py-3
                                           rounded-xl border-gray-300
                                           focus:border-indigo-500
                                           focus:ring-indigo-500
                                           shadow-sm">

                            </div>

                            <p class="mt-2 text-xs text-gray-400">
                                Ketik minimal 2 karakter untuk mencari tindakan.
                            </p>

                        </div>


                        {{-- =================================================
                            HASIL PENCARIAN
                        ================================================== --}}
                        <div id="tindakan_results"
                            class="mt-2 border border-gray-200
                                   rounded-xl overflow-hidden
                                   shadow-sm hidden bg-white">
                        </div>


                        {{-- =================================================
                            TINDAKAN TERPILIH
                        ================================================== --}}
                        <div class="mt-8">

                            <div class="flex items-center justify-between mb-3">

                                <div>
                                    <p class="text-sm font-semibold text-gray-800">
                                        Tindakan Terpilih
                                    </p>

                                    <p class="text-xs text-gray-400 mt-1">
                                        Tindakan yang akan dicatat dalam rekam medis.
                                    </p>
                                </div>

                                <span id="selected_count"
                                    class="inline-flex items-center px-2.5 py-1
                                           rounded-full bg-indigo-50
                                           text-indigo-700 text-xs font-semibold">
                                    0 tindakan
                                </span>

                            </div>


                            <div id="selected_tindakans"
                                class="space-y-3">
                            </div>


                            <div id="empty_selected"
                                class="border border-dashed border-gray-300
                                       rounded-xl p-6 text-center">

                                <div class="w-10 h-10 mx-auto rounded-full
                                            bg-gray-100 flex items-center justify-center">

                                    <svg class="w-5 h-5 text-gray-400"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24">

                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M12 9v3m0 4h.01M12 3a9 9 0 110 18 9 9 0 010-18z" />

                                    </svg>

                                </div>

                                <p class="mt-3 text-sm text-gray-500">
                                    Belum ada tindakan yang dipilih.
                                </p>

                                <p class="text-xs text-gray-400 mt-1">
                                    Gunakan kolom pencarian di atas untuk menambahkan tindakan.
                                </p>

                            </div>

                        </div>


                        {{-- =================================================
                            CATATAN
                        ================================================== --}}
                        <div class="mt-8">

                            <label for="catatan"
                                class="block text-sm font-semibold text-gray-700 mb-2">

                                Catatan Tindakan

                            </label>

                            <textarea
                                name="catatan"
                                id="catatan"
                                rows="4"
                                placeholder="Tambahkan catatan tindakan jika diperlukan..."
                                class="block w-full rounded-xl border-gray-300
                                       focus:border-indigo-500
                                       focus:ring-indigo-500
                                       shadow-sm">{{ old('catatan') }}</textarea>

                            @error('catatan')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- Validation --}}
                        @error('tindakan_ids')
                            <div class="mt-4 rounded-xl bg-red-50 border border-red-200 p-4">

                                <div class="flex gap-3">

                                    <svg class="w-5 h-5 text-red-500 flex-shrink-0"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24">

                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M12 8v4m0 4h.01M12 3a9 9 0 110 18 9 9 0 010-18z" />

                                    </svg>

                                    <p class="text-sm text-red-700">
                                        {{ $message }}
                                    </p>

                                </div>

                            </div>
                        @enderror


                        {{-- =================================================
                            FOOTER BUTTON
                        ================================================== --}}
                        <div class="flex items-center justify-between
                                    mt-8 pt-6 border-t border-gray-100">

                            <a href="{{ route('kunjungan-diagnosa.create', $kunjungan) }}"
                                class="inline-flex items-center px-4 py-2.5
                                       rounded-xl border border-gray-300
                                       bg-white text-gray-700
                                       text-sm font-medium
                                       hover:bg-gray-50 transition">

                                ← Kembali ke Diagnosa

                            </a>


                            <button type="submit"
                                class="inline-flex items-center px-5 py-2.5
                                       rounded-xl bg-indigo-600
                                       text-white text-sm font-semibold
                                       shadow-sm
                                       hover:bg-indigo-700
                                       focus:outline-none
                                       focus:ring-2
                                       focus:ring-indigo-500
                                       focus:ring-offset-2
                                       transition">

                                Simpan & Lanjut ke Keputusan

                                <span class="ml-2">
                                    →
                                </span>

                            </button>

                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>


    {{-- =============================================================
        JAVASCRIPT
    ============================================================= --}}
    <script>

        const searchInput =
            document.getElementById('tindakan_search');

        const resultsContainer =
            document.getElementById('tindakan_results');

        const selectedContainer =
            document.getElementById('selected_tindakans');

        const emptySelected =
            document.getElementById('empty_selected');

        const selectedCount =
            document.getElementById('selected_count');

        const tindakans =
            @json($tindakans);

        let selectedTindakans =
            @json($kunjungan->tindakans);


        function updateSelectedCount() {

            const total = selectedTindakans.length;

            selectedCount.textContent =
                `${total} tindakan`;

        }


        function renderSelected() {

            selectedContainer.innerHTML = '';

            updateSelectedCount();

            if (selectedTindakans.length === 0) {

                emptySelected.classList.remove('hidden');

                return;
            }

            emptySelected.classList.add('hidden');


            selectedTindakans.forEach(tindakan => {

                const wrapper =
                    document.createElement('div');

                wrapper.className =
                    'flex items-start justify-between gap-4 p-4 ' +
                    'bg-gray-50 border border-gray-200 rounded-xl';


                wrapper.innerHTML = `

                    <div class="flex items-start gap-3">

                        <div class="w-9 h-9 rounded-lg
                                    bg-emerald-50
                                    flex items-center justify-center
                                    flex-shrink-0">

                            <svg class="w-4 h-4 text-emerald-600"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M5 13l4 4L19 7" />

                            </svg>

                        </div>

                        <div>

                            <div class="font-semibold text-gray-800">
                                ${tindakan.kode} - ${tindakan.nama}
                            </div>

                            ${
                                tindakan.deskripsi
                                    ? `<div class="text-sm text-gray-500 mt-1">
                                            ${tindakan.deskripsi}
                                       </div>`
                                    : ''
                            }

                            <input
                                type="hidden"
                                name="tindakan_ids[]"
                                value="${tindakan.id}"
                            >

                        </div>

                    </div>


                    <button
                        type="button"
                        class="text-sm font-medium text-red-600
                               hover:text-red-800
                               flex-shrink-0"
                        onclick="removeTindakan(${tindakan.id})">

                        Hapus

                    </button>

                `;


                selectedContainer.appendChild(wrapper);

            });

        }


        function renderResults(keyword) {

            resultsContainer.innerHTML = '';


            if (keyword.length < 2) {

                resultsContainer.classList.add('hidden');

                return;

            }


            const search =
                keyword.toLowerCase();


            const results =
                tindakans

                    .filter(tindakan => {

                        return (
                            tindakan.kode
                                .toLowerCase()
                                .includes(search)

                            ||

                            tindakan.nama
                                .toLowerCase()
                                .includes(search)
                        );

                    })

                    .filter(tindakan => {

                        return !selectedTindakans.some(
                            selected =>
                                selected.id === tindakan.id
                        );

                    })

                    .slice(0, 10);


            if (results.length === 0) {

                resultsContainer.innerHTML = `

                    <div class="p-4 text-sm text-gray-500">
                        Tindakan tidak ditemukan.
                    </div>

                `;

                resultsContainer.classList.remove('hidden');

                return;
            }


            results.forEach(tindakan => {

                const button =
                    document.createElement('button');

                button.type = 'button';

                button.className =
                    'block w-full text-left p-4 ' +
                    'hover:bg-gray-50 ' +
                    'border-b last:border-b-0 ' +
                    'transition';


                button.innerHTML = `

                    <div class="flex items-start gap-3">

                        <div class="w-8 h-8 rounded-lg
                                    bg-indigo-50
                                    flex items-center justify-center
                                    flex-shrink-0">

                            <span class="text-xs font-bold text-indigo-600">
                                +
                            </span>

                        </div>

                        <div>

                            <div class="font-semibold text-gray-800">
                                ${tindakan.kode} - ${tindakan.nama}
                            </div>

                            ${
                                tindakan.deskripsi
                                    ? `<div class="text-sm text-gray-500 mt-1">
                                            ${tindakan.deskripsi}
                                       </div>`
                                    : ''
                            }

                        </div>

                    </div>

                `;


                button.addEventListener(
                    'click',
                    () => {

                        selectedTindakans.push(tindakan);

                        searchInput.value = '';

                        resultsContainer.classList.add('hidden');

                        renderSelected();

                    }
                );


                resultsContainer.appendChild(button);

            });


            resultsContainer.classList.remove('hidden');

        }


        function removeTindakan(id) {

            selectedTindakans =
                selectedTindakans.filter(
                    tindakan =>
                        tindakan.id !== id
                );

            renderSelected();

        }


        searchInput.addEventListener(
            'input',
            function () {

                renderResults(
                    this.value.trim()
                );

            }
        );


        document.addEventListener(
            'click',
            function (event) {

                if (
                    !searchInput.contains(event.target)
                    &&
                    !resultsContainer.contains(event.target)
                ) {

                    resultsContainer.classList.add('hidden');

                }

            }
        );


        renderSelected();

    </script>

</x-app-layout>