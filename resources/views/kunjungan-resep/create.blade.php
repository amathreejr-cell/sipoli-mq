<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="text-xl font-bold text-gray-900">
                Resep & Obat
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Pilih obat dan lengkapi aturan pemberiannya kepada santri.
            </p>
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

                        @php
                            $steps = [
                                ['label' => 'Kunjungan', 'number' => 1],
                                ['label' => 'Pemeriksaan', 'number' => 2],
                                ['label' => 'Diagnosa', 'number' => 3],
                                ['label' => 'Tindakan', 'number' => 4],
                                ['label' => 'Keputusan', 'number' => 5],
                            ];
                        @endphp


                        @foreach ($steps as $step)

                            <div class="flex items-center">

                                <span class="flex items-center justify-center
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


                        {{-- 6 --}}
                        <div class="flex items-center">

                            <span class="flex items-center justify-center
                                         w-9 h-9 rounded-full
                                         bg-indigo-600 text-white
                                         text-sm font-bold shadow-sm">
                                6
                            </span>

                            <span class="ml-2 text-sm font-bold text-indigo-600">
                                Rujukan / Obat
                            </span>

                        </div>


                        <div class="w-12 h-px bg-gray-200 mx-3"></div>


                        {{-- 7 --}}
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

                        <div>
                            <p class="text-xs font-medium uppercase tracking-wide text-gray-400">
                                Kode Kunjungan
                            </p>

                            <p class="mt-1 font-semibold text-gray-900">
                                {{ $kunjungan->kode_kunjungan }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs font-medium uppercase tracking-wide text-gray-400">
                                Nama Santri
                            </p>

                            <p class="mt-1 font-semibold text-gray-900">
                                {{ $kunjungan->santri?->nama }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs font-medium uppercase tracking-wide text-gray-400">
                                Nomor Induk
                            </p>

                            <p class="mt-1 font-semibold text-gray-900">
                                {{ $kunjungan->santri?->nomor_induk }}
                            </p>
                        </div>

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
                FORM RESEP
            ========================================================== --}}
            <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">

                <div class="px-6 py-5 border-b border-gray-100">

                    <div class="flex items-start gap-3">

                        <div class="w-10 h-10 rounded-xl bg-emerald-50
                                    flex items-center justify-center">

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
                                Obat / Resep
                            </h3>

                            <p class="mt-1 text-sm text-gray-500">
                                Cari dan pilih obat yang akan diberikan kepada santri.
                            </p>
                        </div>

                    </div>

                </div>


                <div class="p-6">

                    <form
                        method="POST"
                        action="{{ route('kunjungan-resep.store', $kunjungan) }}">

                        @csrf


                        {{-- SEARCH --}}
                        <div>

                            <label
                                for="obat_search"
                                class="block text-sm font-semibold text-gray-700 mb-2">

                                Cari Obat

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
                                    id="obat_search"
                                    placeholder="Ketik kode atau nama obat..."
                                    autocomplete="off"
                                    class="block w-full pl-10 pr-4 py-3
                                           rounded-xl border-gray-300
                                           focus:border-indigo-500
                                           focus:ring-indigo-500
                                           shadow-sm">

                            </div>


                            <p class="mt-2 text-xs text-gray-400">
                                Ketik minimal 2 karakter untuk mencari obat.
                            </p>

                        </div>


                        {{-- HASIL --}}
                        <div
                            id="obat_results"
                            class="mt-2 border border-gray-200
                                   rounded-xl overflow-hidden
                                   shadow-sm hidden bg-white">
                        </div>


                        {{-- OBAT TERPILIH --}}
                        <div class="mt-8">

                            <div class="flex items-center justify-between mb-3">

                                <div>
                                    <p class="text-sm font-semibold text-gray-800">
                                        Obat Terpilih
                                    </p>

                                    <p class="text-xs text-gray-400 mt-1">
                                        Lengkapi jumlah dan aturan penggunaan setiap obat.
                                    </p>
                                </div>

                                <span
                                    id="selected_count"
                                    class="inline-flex items-center px-2.5 py-1
                                           rounded-full bg-indigo-50
                                           text-indigo-700 text-xs font-semibold">
                                    0 obat
                                </span>

                            </div>


                            <div
                                id="selected_obats"
                                class="space-y-4">
                            </div>


                            <div
                                id="empty_selected"
                                class="border border-dashed border-gray-300
                                       rounded-xl p-6 text-center">

                                <div class="w-10 h-10 mx-auto rounded-full
                                            bg-gray-100
                                            flex items-center justify-center">

                                    <svg class="w-5 h-5 text-gray-400"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24">

                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M12 9v3m0 4h.01M12 3a9 9 0 110 18 9 9 0 010 18z" />

                                    </svg>

                                </div>

                                <p class="mt-3 text-sm text-gray-500">
                                    Belum ada obat yang dipilih.
                                </p>

                                <p class="text-xs text-gray-400 mt-1">
                                    Gunakan kolom pencarian untuk menambahkan obat.
                                </p>

                            </div>

                        </div>


                        {{-- CATATAN --}}
                        <div class="mt-8">

                            <label
                                for="catatan"
                                class="block text-sm font-semibold text-gray-700 mb-2">

                                Catatan Resep

                            </label>


                            <textarea
                                name="catatan"
                                id="catatan"
                                rows="4"
                                placeholder="Catatan tambahan jika diperlukan..."
                                class="block w-full rounded-xl
                                       border-gray-300
                                       focus:border-indigo-500
                                       focus:ring-indigo-500
                                       shadow-sm">{{ old('catatan', $resep?->catatan) }}</textarea>

                            @error('catatan')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        @error('obat_ids')

                            <div class="mt-4 rounded-xl bg-red-50
                                        border border-red-200 p-4">

                                <p class="text-sm text-red-700">
                                    {{ $message }}
                                </p>

                            </div>

                        @enderror


                        {{-- FOOTER --}}
                        <div class="flex items-center justify-between
                                    mt-8 pt-6 border-t border-gray-100">

                            <a
                                href="{{ route('kunjungan-keputusan.create', $kunjungan) }}"
                                class="inline-flex items-center px-4 py-2.5
                                       rounded-xl border border-gray-300
                                       bg-white text-gray-700
                                       text-sm font-medium
                                       hover:bg-gray-50">

                                ← Kembali ke Keputusan

                            </a>


                            <button
                                type="submit"
                                class="inline-flex items-center px-5 py-2.5
                                       rounded-xl bg-indigo-600
                                       text-white text-sm font-semibold
                                       hover:bg-indigo-700
                                       focus:outline-none
                                       focus:ring-2 focus:ring-indigo-500
                                       focus:ring-offset-2">

                                Simpan & Lanjut ke Ringkasan

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
            document.getElementById('obat_search');

        const resultsContainer =
            document.getElementById('obat_results');

        const selectedContainer =
            document.getElementById('selected_obats');

        const emptySelected =
            document.getElementById('empty_selected');

        const selectedCount =
            document.getElementById('selected_count');

        const obats =
            @json($obats);

        let selectedObats =
            @json($resepDetails);


        function updateSelectedCount() {

            const total = selectedObats.length;

            selectedCount.textContent =
                `${total} obat`;

        }


        function renderSelected() {

            selectedContainer.innerHTML = '';

            updateSelectedCount();


            if (selectedObats.length === 0) {

                emptySelected.classList.remove('hidden');

                return;

            }


            emptySelected.classList.add('hidden');


            selectedObats.forEach(obat => {

                const wrapper =
                    document.createElement('div');


                wrapper.className =
                    'p-5 bg-gray-50 border border-gray-200 rounded-xl';


                wrapper.innerHTML = `

                    <div class="flex items-start justify-between gap-4 mb-5">

                        <div>

                            <div class="font-semibold text-gray-800">
                                ${obat.kode ?? ''} - ${obat.nama ?? ''}
                            </div>

                            ${
                                obat.satuan
                                    ? `
                                        <div class="text-sm text-gray-500 mt-1">
                                            Satuan: ${obat.satuan}
                                        </div>
                                      `
                                    : ''
                            }

                        </div>


                        <button
                            type="button"
                            class="text-sm font-medium text-red-600
                                   hover:text-red-800"
                            onclick="removeObat(${obat.id})">

                            Hapus

                        </button>

                    </div>


                    <input
                        type="hidden"
                        name="obat_ids[]"
                        value="${obat.id}"
                    >


                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        {{-- Jumlah --}}
                        <div>

                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Jumlah
                            </label>

                            <input
                                type="number"
                                name="jumlah[${obat.id}]"
                                min="1"
                                value="${obat.jumlah ?? 1}"
                                required
                                class="block w-full rounded-xl
                                       border-gray-300
                                       focus:border-indigo-500
                                       focus:ring-indigo-500
                                       shadow-sm">

                        </div>


                        {{-- Dosis --}}
                        <div>

                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Dosis
                            </label>

                            <input
                                type="text"
                                name="dosis[${obat.id}]"
                                placeholder="Contoh: 500 mg"
                                value="${obat.dosis ?? ''}"
                                required
                                class="block w-full rounded-xl
                                       border-gray-300
                                       focus:border-indigo-500
                                       focus:ring-indigo-500
                                       shadow-sm">

                        </div>


                        {{-- Frekuensi --}}
                        <div>

                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Frekuensi
                            </label>

                            <select
                                name="frekuensi[${obat.id}]"
                                required
                                class="block w-full rounded-xl
                                       border-gray-300
                                       focus:border-indigo-500
                                       focus:ring-indigo-500
                                       shadow-sm">

                                <option value="">
                                    Pilih frekuensi
                                </option>

                                <option value="1x sehari"
                                    ${obat.frekuensi === '1x sehari' ? 'selected' : ''}>
                                    1x sehari
                                </option>

                                <option value="2x sehari"
                                    ${obat.frekuensi === '2x sehari' ? 'selected' : ''}>
                                    2x sehari
                                </option>

                                <option value="3x sehari"
                                    ${obat.frekuensi === '3x sehari' ? 'selected' : ''}>
                                    3x sehari
                                </option>

                                <option value="4x sehari"
                                    ${obat.frekuensi === '4x sehari' ? 'selected' : ''}>
                                    4x sehari
                                </option>

                                <option value="Jika diperlukan"
                                    ${obat.frekuensi === 'Jika diperlukan' ? 'selected' : ''}>
                                    Jika diperlukan
                                </option>

                            </select>

                        </div>


                        {{-- Aturan Pakai --}}
                        <div>

                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Aturan Pakai
                            </label>

                            <select
                                name="aturan_pakai[${obat.id}]"
                                required
                                class="block w-full rounded-xl
                                       border-gray-300
                                       focus:border-indigo-500
                                       focus:ring-indigo-500
                                       shadow-sm">

                                <option value="">
                                    Pilih aturan pakai
                                </option>

                                <option value="Sebelum makan"
                                    ${obat.aturan_pakai === 'Sebelum makan' ? 'selected' : ''}>
                                    Sebelum makan
                                </option>

                                <option value="Sesudah makan"
                                    ${obat.aturan_pakai === 'Sesudah makan' ? 'selected' : ''}>
                                    Sesudah makan
                                </option>

                                <option value="Bersama makanan"
                                    ${obat.aturan_pakai === 'Bersama makanan' ? 'selected' : ''}>
                                    Bersama makanan
                                </option>

                                <option value="Saat diperlukan"
                                    ${obat.aturan_pakai === 'Saat diperlukan' ? 'selected' : ''}>
                                    Saat diperlukan
                                </option>

                            </select>

                        </div>

                    </div>


                    {{-- Keterangan --}}
                    <div class="mt-4">

                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Keterangan
                        </label>

                        <input
                            type="text"
                            name="keterangan[${obat.id}]"
                            placeholder="Keterangan tambahan..."
                            value="${obat.keterangan ?? ''}"
                            class="block w-full rounded-xl
                                   border-gray-300
                                   focus:border-indigo-500
                                   focus:ring-indigo-500
                                   shadow-sm">

                    </div>

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
                obats

                    .filter(obat => {

                        return (
                            obat.kode
                                .toLowerCase()
                                .includes(search)

                            ||

                            obat.nama
                                .toLowerCase()
                                .includes(search)
                        );

                    })

                    .filter(obat => {

                        return !selectedObats.some(
                            selected =>
                                selected.id === obat.id
                        );

                    })

                    .slice(0, 10);


            if (results.length === 0) {

                resultsContainer.innerHTML = `

                    <div class="p-4 text-sm text-gray-500">
                        Obat tidak ditemukan.
                    </div>

                `;

                resultsContainer.classList.remove('hidden');

                return;

            }


            results.forEach(obat => {

                const button =
                    document.createElement('button');

                button.type = 'button';

                button.className =
                    'block w-full text-left p-4 ' +
                    'hover:bg-gray-50 ' +
                    'border-b last:border-b-0 ' +
                    'transition';


                button.innerHTML = `

                    <div class="flex items-center gap-3">

                        <div class="w-9 h-9 rounded-lg
                                    bg-emerald-50
                                    flex items-center justify-center">

                            <span class="text-emerald-600 font-bold">
                                +
                            </span>

                        </div>


                        <div>

                            <div class="font-semibold text-gray-800">
                                ${obat.kode} - ${obat.nama}
                            </div>

                            ${
                                obat.satuan
                                    ? `
                                        <div class="text-sm text-gray-500 mt-1">
                                            Satuan: ${obat.satuan}
                                        </div>
                                      `
                                    : ''
                            }

                        </div>

                    </div>

                `;


                button.addEventListener('click', () => {

                    selectedObats.push({

                        id: obat.id,

                        kode: obat.kode,

                        nama: obat.nama,

                        satuan: obat.satuan,

                        jumlah: 1,

                        dosis: '',

                        frekuensi: '',

                        aturan_pakai: '',

                        keterangan: ''

                    });


                    searchInput.value = '';

                    resultsContainer.classList.add('hidden');

                    renderSelected();

                });


                resultsContainer.appendChild(button);

            });


            resultsContainer.classList.remove('hidden');

        }


        function removeObat(id) {

            selectedObats =
                selectedObats.filter(
                    obat => obat.id !== id
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