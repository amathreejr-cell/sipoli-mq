<x-app-layout>

    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.4.3/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.4.3/dist/js/tom-select.complete.min.js"></script>

    <a href="{{ route('kunjungan.show', $kunjungan) }}"
        class="inline-flex items-center text-sm text-gray-500 hover:text-gray-700 mb-3">
        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
        Kembali ke Kunjungan
    </a>

    <div class="space-y-6">
        <div class="mb-6 overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
            <div class="bg-gradient-to-r from-blue-50 to-white px-6 py-6 sm:px-8">
                <div class="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">

                    <div class="flex items-center gap-4">
                        <div
                            class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-blue-100 text-blue-600">
                            <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <!-- Simbol Kertas Dokumen Rujukan -->
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                <!-- Simbol Tambah Medis di Pojok Atas Dokumen -->
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M12 7v3m-1.5-1.5h3" />
                            </svg>

                        </div>

                        <div>
                            <p class="text-sm font-medium text-blue-600">
                                Pelayanan Poliklinik
                            </p>

                            <h3 class="mt-1 text-xl font-bold text-gray-900">
                                Pemeriksaan Terpadu
                            </h3>

                            <p class="mt-1 text-sm text-gray-500">
                                Formulir pemeriksaan terpadu untuk kunjungan santri
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="space-y-6">

            @if ($errors->any())
                <div class="rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                    <p class="mb-2 font-semibold">Data belum dapat disimpan:</p>
                    <ul class="list-disc space-y-1 pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <h3 class="text-lg font-bold text-slate-800">Informasi Kunjungan</h3>
                <div class="mt-4 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                    <div>
                        <p class="text-sm text-slate-500">Kode Kunjungan</p>
                        <p class="font-semibold">{{ $kunjungan->kode_kunjungan }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-slate-500">Nama Santri</p>
                        <p class="font-semibold">{{ $kunjungan->santri?->nama ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-slate-500">Nomor Induk</p>
                        <p class="font-semibold">{{ $kunjungan->santri?->nomor_induk ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-slate-500">Keluhan</p>
                        <p class="font-semibold">{{ $kunjungan->keluhan ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ route('pemeriksaan-terpadu.store', $kunjungan) }}"
                id="formPemeriksaanTerpadu" class="space-y-6">
                @csrf

                {{-- 1. Pemeriksaan fisik --}}
                <section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <h3 class="text-lg font-bold text-slate-800">1. Pemeriksaan Fisik</h3>
                    <div class="mt-4 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                        <div>
                            <label class="mb-1 block text-sm font-medium">Tekanan Darah *</label>
                            <input name="tekanan_darah" required maxlength="20" placeholder="Contoh: 120/80"
                                value="{{ old('tekanan_darah', $kunjungan->pemeriksaan?->tekanan_darah) }}"
                                class="w-full rounded-lg border-slate-300">
                        </div>
                        <div>
                            <label class="mb-1 block text-sm font-medium">Suhu (°C) *</label>
                            <input type="number" name="suhu" required min="30" max="45" step="0.1"
                                value="{{ old('suhu', $kunjungan->pemeriksaan?->suhu) }}"
                                class="w-full rounded-lg border-slate-300">
                        </div>
                        <div>
                            <label class="mb-1 block text-sm font-medium">Nadi (kali/menit)</label>
                            <input type="number" name="nadi" min="0" max="250"
                                value="{{ old('nadi', $kunjungan->pemeriksaan?->nadi) }}"
                                class="w-full rounded-lg border-slate-300">
                        </div>
                        <div>
                            <label class="mb-1 block text-sm font-medium">Pernapasan (kali/menit)</label>
                            <input type="number" name="pernapasan" min="0" max="100"
                                value="{{ old('pernapasan', $kunjungan->pemeriksaan?->pernapasan) }}"
                                class="w-full rounded-lg border-slate-300">
                        </div>
                        <div>
                            <label class="mb-1 block text-sm font-medium">Berat Badan (kg)</label>
                            <input type="number" name="berat_badan" min="0" max="300" step="0.1"
                                value="{{ old('berat_badan', $kunjungan->pemeriksaan?->berat_badan) }}"
                                class="w-full rounded-lg border-slate-300">
                        </div>
                        <div>
                            <label class="mb-1 block text-sm font-medium">Tinggi Badan (cm)</label>
                            <input type="number" name="tinggi_badan" min="0" max="250" step="0.1"
                                value="{{ old('tinggi_badan', $kunjungan->pemeriksaan?->tinggi_badan) }}"
                                class="w-full rounded-lg border-slate-300">
                        </div>
                    </div>
                    <div class="mt-4">
                        <label class="mb-1 block text-sm font-medium">Pemeriksaan Fisik</label>
                        <textarea name="pemeriksaan_fisik" rows="3" class="w-full rounded-lg border-slate-300">{{ old('pemeriksaan_fisik', $kunjungan->pemeriksaan?->pemeriksaan_fisik) }}</textarea>
                    </div>
                    <div class="mt-4">
                        <label class="mb-1 block text-sm font-medium">Catatan Pemeriksaan</label>
                        <textarea name="catatan_pemeriksaan" rows="2" class="w-full rounded-lg border-slate-300">{{ old('catatan_pemeriksaan', $kunjungan->pemeriksaan?->catatan) }}</textarea>
                    </div>
                </section>


                {{-- 2. Diagnosa --}}
                <section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <h3 class="text-lg font-bold text-slate-800">2. Diagnosa</h3>
                    <p class="mt-1 text-sm text-slate-500">
                        Ketik minimal 2 huruf untuk mencari diagnosa. Anda dapat memilih lebih dari satu.
                    </p>

                    <div class="mt-4">
                        <label for="diagnosa_ids" class="mb-1 block text-sm font-medium">
                            Pilih Diagnosa
                        </label>

                        <select id="diagnosa_ids" name="diagnosa_ids[]" multiple>
                            @foreach ($diagnosas as $diagnosa)
                                <option value="{{ $diagnosa->id }}" @selected(in_array((string) $diagnosa->id, array_map('strval', old('diagnosa_ids', $kunjungan->diagnosas->pluck('id')->all()))))>
                                    {{ $diagnosa->nama }}{{ $diagnosa->kode ? ' (' . $diagnosa->kode . ')' : '' }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mt-4">
                        <label class="mb-1 block text-sm font-medium">Catatan Diagnosa</label>
                        <textarea name="catatan_diagnosa" rows="2" class="w-full rounded-lg border-slate-300">{{ old('catatan_diagnosa', $kunjungan->catatan_diagnosa ?? '') }}</textarea>
                    </div>
                </section>



                {{-- 3. Tindakan --}}
                <section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <h3 class="text-lg font-bold text-slate-800">3. Tindakan</h3>
                    <p class="mt-1 text-sm text-slate-500">
                        Ketik minimal 2 huruf untuk mencari tindakan. Anda dapat memilih lebih dari satu.
                    </p>

                    <div class="mt-4">
                        <label for="tindakan_ids" class="mb-1 block text-sm font-medium">
                            Pilih Tindakan
                        </label>

                        <select id="tindakan_ids" name="tindakan_ids[]" multiple>
                            @foreach ($tindakans as $tindakan)
                                <option value="{{ $tindakan->id }}" @selected(in_array((string) $tindakan->id, array_map('strval', old('tindakan_ids', $kunjungan->tindakans->pluck('id')->all()))))>
                                    {{ $tindakan->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mt-4">
                        <label class="mb-1 block text-sm font-medium">Catatan Tindakan</label>
                        <textarea name="catatan_tindakan" rows="2" class="w-full rounded-lg border-slate-300">{{ old('catatan_tindakan', $kunjungan->catatan_tindakan ?? '') }}</textarea>
                    </div>
                </section>


                {{-- 4. Data Rujukan --}}
                <section id="bagianRujukan" class="rounded-2xl border border-amber-200 bg-white p-5 shadow-sm">
                    <h3 class="text-lg font-bold text-slate-800">4. Data Rujukan</h3>
                    <p class="mt-1 text-sm text-slate-500">
                        Isi jika santri dirujuk. Bagian ini bersifat opsional.
                    </p>

                    <div class="mt-4 grid gap-4 sm:grid-cols-2">
                        <div>
                            <label for="rujukan_id" class="mb-1 block text-sm font-medium">
                                Fasilitas Rujukan
                            </label>
                            <select name="rujukan_id" id="rujukan_id">
                                <option value="">Cari fasilitas rujukan...</option>
                                @foreach ($masterRujukans as $fasilitas)
                                    <option value="{{ $fasilitas->id }}" @selected((string) old('rujukan_id', $kunjungan->rujukan?->rujukan_id) === (string) $fasilitas->id)>
                                        {{ $fasilitas->nama_fasilitas }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="mb-1 block text-sm font-medium">Tanggal Rujukan</label>
                            <input type="date" name="tanggal_rujukan" id="tanggal_rujukan"
                                value="{{ old('tanggal_rujukan', $kunjungan->rujukan?->tanggal_rujukan?->format('Y-m-d') ?? now()->toDateString()) }}"
                                class="w-full rounded-lg border-slate-300">
                        </div>

                        <div>
                            <label class="mb-1 block text-sm font-medium">Status Rujukan</label>
                            <select name="status_rujukan" id="status_rujukan"
                                class="w-full rounded-lg border-slate-300">
                                <option value="">Pilih status</option>
                                @foreach ([
        'direncanakan' => 'Direncanakan',
        'dirujuk' => 'Dirujuk',
        'selesai' => 'Selesai',
        'dibatalkan' => 'Dibatalkan',
    ] as $value => $label)
                                    <option value="{{ $value }}" @selected(old('status_rujukan', $kunjungan->rujukan?->status ?? 'direncanakan') === $value)>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="mb-1 block text-sm font-medium">Alasan Rujukan</label>
                            <textarea name="alasan_rujukan" id="alasan_rujukan" rows="2" class="w-full rounded-lg border-slate-300">{{ old('alasan_rujukan', $kunjungan->rujukan?->alasan) }}</textarea>
                        </div>

                        <div class="sm:col-span-2">
                            <label class="mb-1 block text-sm font-medium">Keterangan Rujukan</label>
                            <textarea name="keterangan_rujukan" rows="2" class="w-full rounded-lg border-slate-300">{{ old('keterangan_rujukan', $kunjungan->rujukan?->keterangan) }}</textarea>
                        </div>
                    </div>
                </section>



                {{-- 5. Resep Obat --}}
                <section id="bagianResep" class="rounded-2xl border border-emerald-200 bg-white p-5 shadow-sm">
                    <h3 class="text-lg font-bold text-slate-800">5. Resep Obat</h3>
                    <p class="mt-1 text-sm text-slate-500">
                        Ketik minimal 2 huruf untuk mencari obat. Pilih satu atau beberapa obat.
                    </p>

                    <div class="mt-4">
                        <label for="obat_ids" class="mb-1 block text-sm font-medium">
                            Pilih Obat
                        </label>

                        <select id="obat_ids" name="obat_ids[]" multiple>
                            @foreach ($obats as $obat)
                                <option value="{{ $obat->id }}" data-stok="{{ $obat->stok }}"
                                    data-satuan="{{ $obat->satuan ?? '' }}" @selected(in_array((string) $obat->id, array_map('strval', old('obat_ids', $kunjungan->resep?->details?->pluck('obat_id')->all() ?? []))))>
                                    {{ $obat->nama }} — Stok: {{ $obat->stok }} {{ $obat->satuan ?? '' }}
                                </option>
                            @endforeach
                        </select>
                    </div>


                    <div id="detailObatTerpilih" class="mt-4 space-y-4">
                        @foreach ($obats as $obat)
                            <div id="detailObat{{ $obat->id }}"
                                class="detail-obat hidden rounded-xl border border-slate-200 p-4"
                                data-obat="{{ $obat->id }}">

                                <h4 class="mb-3 font-semibold text-slate-800">
                                    {{ $obat->nama }}
                                </h4>

                                <div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-3">
                                    <div>
                                        <label class="mb-1 block text-sm font-medium">Jumlah *</label>
                                        <input type="number" name="jumlah[{{ $obat->id }}]" min="1"
                                            max="{{ $obat->stok }}" value="{{ old('jumlah.' . $obat->id, 1) }}"
                                            class="w-full rounded-lg border-slate-300">
                                        <p class="mt-1 text-xs text-slate-500">
                                            Stok tersedia: {{ $obat->stok }} {{ $obat->satuan }}
                                        </p>
                                    </div>

                                    <div>
                                        <label class="mb-1 block text-sm font-medium">Dosis *</label>
                                        <input name="dosis[{{ $obat->id }}]" maxlength="100"
                                            value="{{ old('dosis.' . $obat->id) }}" placeholder="Contoh: 1 tablet"
                                            class="w-full rounded-lg border-slate-300">
                                    </div>

                                    <div>
                                        <label class="mb-1 block text-sm font-medium">Frekuensi *</label>
                                        <input name="frekuensi[{{ $obat->id }}]" maxlength="100"
                                            value="{{ old('frekuensi.' . $obat->id) }}"
                                            placeholder="Contoh: 3 kali sehari"
                                            class="w-full rounded-lg border-slate-300">
                                    </div>

                                    <div>
                                        <label class="mb-1 block text-sm font-medium">Aturan Pakai *</label>
                                        <input name="aturan_pakai[{{ $obat->id }}]" maxlength="150"
                                            value="{{ old('aturan_pakai.' . $obat->id) }}"
                                            placeholder="Contoh: Sesudah makan"
                                            class="w-full rounded-lg border-slate-300">
                                    </div>

                                    <div class="sm:col-span-2">
                                        <label class="mb-1 block text-sm font-medium">Keterangan</label>
                                        <input name="keterangan[{{ $obat->id }}]" maxlength="255"
                                            value="{{ old('keterangan.' . $obat->id) }}"
                                            class="w-full rounded-lg border-slate-300">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>


                    <div class="mt-4">
                        <label class="mb-1 block text-sm font-medium">Catatan Resep</label>
                        <textarea name="catatan_resep" rows="2" class="w-full rounded-lg border-slate-300">{{ old('catatan_resep', $kunjungan->resep?->catatan) }}</textarea>
                    </div>
                </section>


                <div class="flex flex-col-reverse justify-between gap-3 sm:flex-row">
                    <a href="{{ route('kunjungan.show', $kunjungan) }}"
                        class="inline-flex items-center justify-center rounded-lg border border-slate-300 px-5 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50">
                        Kembali
                    </a>

                    <button type="button" id="tombolSimpan"
                        class="inline-flex items-center justify-center rounded-lg bg-indigo-600 px-6 py-3 text-sm font-semibold text-white hover:bg-indigo-700 transition">
                        Simpan dan Selesaikan Pemeriksaan
                    </button>
                </div>
            </form>
        </div>
    </div>


    {{-- MODAL KONFIRMASI PENYIMPANAN --}}
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
                        Simpan Pemeriksaan?
                    </h3>

                    <p class="text-sm text-gray-500 mt-2 leading-relaxed">
                        Apakah Anda yakin ingin menyimpan seluruh data pemeriksaan,
                        diagnosa, tindakan, rujukan, dan resep obat ini?
                    </p>
                </div>

                <div class="grid grid-cols-2 gap-3 mt-7">
                    <button type="button" id="cancelFinish"
                        class="w-full px-4 py-3 rounded-xl bg-gray-100 text-gray-700 font-semibold hover:bg-gray-200 transition">
                        Tidak
                    </button>

                    <button type="button" id="confirmFinish"
                        class="w-full px-4 py-3 rounded-xl bg-indigo-600 text-white font-semibold hover:bg-indigo-700 transition">
                        Ya, Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- ANIMASI BERHASIL --}}
    <div id="successOverlay" class="fixed inset-0 z-[60] hidden bg-white">

        <div class="min-h-screen flex items-center justify-center px-6">
            <div id="successContent" class="text-center opacity-0 scale-90 transition-all duration-500">

                <div class="relative mx-auto w-24 h-24 mb-7">
                    <div class="absolute inset-0 rounded-full bg-green-100 animate-ping opacity-40">
                    </div>

                    <div
                        class="relative w-24 h-24 rounded-full bg-green-500 text-white flex items-center justify-center shadow-lg">
                        <svg class="w-12 h-12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 12.5L9.5 17L19 7.5" />
                        </svg>
                    </div>
                </div>

                <h2 class="text-2xl sm:text-3xl font-bold text-gray-900">
                    Pemeriksaan Berhasil Disimpan
                </h2>

                <p class="text-gray-500 mt-3">
                    Data pelayanan santri sedang diproses.
                </p>

                <div class="flex items-center justify-center gap-2 mt-6 text-sm text-gray-400">
                    <span class="w-2 h-2 rounded-full bg-gray-400 animate-bounce"></span>
                    <span class="w-2 h-2 rounded-full bg-gray-400 animate-bounce"
                        style="animation-delay: .15s"></span>
                    <span class="w-2 h-2 rounded-full bg-gray-400 animate-bounce" style="animation-delay: .3s"></span>
                    <span class="ml-1">Menyimpan data pemeriksaan...</span>
                </div>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {


            const form = document.getElementById('formPemeriksaanTerpadu');
            const tombolSimpan = document.getElementById('tombolSimpan');

            const confirmModal = document.getElementById('confirmModal');
            const confirmCard = document.getElementById('confirmCard');
            const cancelFinish = document.getElementById('cancelFinish');
            const confirmFinish = document.getElementById('confirmFinish');
            const confirmBackdrop = document.getElementById('confirmBackdrop');

            const successOverlay = document.getElementById('successOverlay');
            const successContent = document.getElementById('successContent');

            let sedangMemproses = false;

            function bukaModal() {
                confirmModal.classList.remove('hidden');
                confirmModal.setAttribute('aria-hidden', 'false');

                requestAnimationFrame(() => {
                    confirmCard.classList.remove('scale-95', 'opacity-0');
                    confirmCard.classList.add('scale-100', 'opacity-100');
                });

                document.body.classList.add('overflow-hidden');
            }

            function tutupModal() {
                confirmCard.classList.remove('scale-100', 'opacity-100');
                confirmCard.classList.add('scale-95', 'opacity-0');

                setTimeout(() => {
                    confirmModal.classList.add('hidden');
                    confirmModal.setAttribute('aria-hidden', 'true');
                    document.body.classList.remove('overflow-hidden');
                }, 180);
            }

            function tampilkanAnimasiBerhasil() {
                confirmModal.classList.add('hidden');

                successOverlay.classList.remove('hidden');
                document.body.classList.add('overflow-hidden');

                requestAnimationFrame(() => {
                    successContent.classList.remove('opacity-0', 'scale-90');
                    successContent.classList.add('opacity-100', 'scale-100');
                });

                setTimeout(() => {
                    // Memicu proses submit Laravel melalui event submit normal.
                    form.requestSubmit();
                }, 1800);
            }

            // Klik tombol simpan: validasi form dahulu, lalu konfirmasi.
            tombolSimpan.addEventListener('click', function() {
                if (sedangMemproses) return;

                if (!form.reportValidity()) return;

                bukaModal();
            });

            // Batalkan konfirmasi.
            cancelFinish.addEventListener('click', tutupModal);
            confirmBackdrop.addEventListener('click', tutupModal);

            // Konfirmasi penyimpanan.
            confirmFinish.addEventListener('click', function() {
                if (sedangMemproses) return;

                // Pastikan validasi tetap terpenuhi sebelum animasi.
                if (!form.reportValidity()) {
                    tutupModal();
                    return;
                }

                sedangMemproses = true;
                confirmFinish.disabled = true;
                confirmFinish.textContent = 'Memproses...';

                tampilkanAnimasiBerhasil();
            });

            // Tutup modal dengan tombol Escape.
            document.addEventListener('keydown', function(event) {
                if (
                    event.key === 'Escape' &&
                    !confirmModal.classList.contains('hidden') &&
                    !sedangMemproses
                ) {
                    tutupModal();
                }
            });

            // Konfigurasi dropdown pencarian.
            const konfigurasi = {
                create: false,
                maxOptions: 100,
                placeholder: 'Ketik minimal 2 huruf untuk mencari...',
                searchField: ['text'],
                plugins: ['remove_button'],
                closeAfterSelect: false,
                render: {
                    no_results: function() {
                        return '<div class="p-2 text-sm text-slate-500">Data tidak ditemukan.</div>';
                    }
                }
            };

            ['diagnosa_ids', 'tindakan_ids', 'obat_ids'].forEach(function(id) {
                const elemen = document.getElementById(id);

                if (elemen) {
                    new TomSelect(elemen, {
                        ...konfigurasi,
                        maxOptions: 100,
                        shouldLoad: function(query) {
                            return query.length >= 2;
                        }
                    });
                }
            });

            // Dropdown fasilitas rujukan: hanya satu pilihan.
            const dropdownRujukan = new TomSelect('#rujukan_id', {
                create: false,
                maxOptions: 100,
                placeholder: 'Ketik minimal 2 huruf untuk mencari fasilitas...',
                shouldLoad: function(query) {
                    return query.length >= 2;
                },
                render: konfigurasi.render
            });

            // Detail rujukan bersifat opsional.
            const inputRujukan = document.getElementById('rujukan_id');
            const inputTanggal = document.getElementById('tanggal_rujukan');
            const inputStatus = document.getElementById('status_rujukan');
            const inputAlasan = document.getElementById('alasan_rujukan');

            function aturRujukan() {
                const aktif = Boolean(inputRujukan.value);

                inputTanggal.required = aktif;
                inputStatus.required = aktif;
                inputAlasan.required = aktif;
            }

            dropdownRujukan.on('change', aturRujukan);

            // Tampilkan detail hanya untuk obat yang dipilih.
            const dropdownObat = document.getElementById('obat_ids');
            const detailObat = document.querySelectorAll('.detail-obat');

            function aturDetailObat() {
                const terpilih = Array.from(dropdownObat.selectedOptions)
                    .map(option => option.value);

                detailObat.forEach(function(bagian) {
                    const aktif = terpilih.includes(bagian.dataset.obat);

                    bagian.classList.toggle('hidden', !aktif);

                    bagian.querySelectorAll('input').forEach(function(input) {
                        input.required = aktif && !input.name.startsWith('keterangan[');
                        input.disabled = !aktif;
                    });
                });
            }

            dropdownObat.addEventListener('change', aturDetailObat);

            // Mencegah pengiriman formulir berulang kali.

            form.addEventListener('submit', function(event) {
                // Mencegah pengiriman ganda.
                if (form.dataset.submitted === 'true') {
                    event.preventDefault();
                    return;
                }

                form.dataset.submitted = 'true';
                sedangMemproses = true;

                tombolSimpan.disabled = true;
                tombolSimpan.textContent = 'Menyimpan data...';
                tombolSimpan.classList.add('opacity-70', 'cursor-not-allowed');
            });


            aturRujukan();
            aturDetailObat();
        });
    </script>

</x-app-layout>
