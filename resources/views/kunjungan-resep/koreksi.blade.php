<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-xl font-semibold text-gray-800">
                Koreksi Resep
            </h2>
            <p class="mt-1 text-sm text-gray-500">
                Kunjungan: {{ $kunjungan->kode_kunjungan }}
            </p>
        </div>
    </x-slot>

    <div class="mx-auto max-w-6xl px-4 py-6 sm:px-6 lg:px-8">

        <div class="mb-6 rounded-lg border border-amber-200 bg-amber-50 p-4">
            <h3 class="font-semibold text-amber-900">
                Perhatian: Koreksi Resep
            </h3>
            <p class="mt-1 text-sm text-amber-800">
                Resep asli akan tetap disimpan sebagai riwayat.
                Koreksi ini tidak mengubah stok obat secara otomatis.
                Pastikan alasan koreksi ditulis dengan jelas.
            </p>
        </div>

        @if ($errors->any())
            <div class="mb-5 rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                <p class="mb-2 font-semibold">
                    Periksa kembali data berikut:
                </p>
                <ul class="list-inside list-disc">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form
            action="{{ route('kunjungan-resep.koreksi.store', $kunjungan) }}"
            method="POST"
            id="form-koreksi-resep"
        >
            @csrf

            <div class="mb-6 rounded-lg bg-white p-5 shadow-sm">
                <label for="alasan" class="mb-2 block text-sm font-semibold text-gray-700">
                    Alasan Koreksi <span class="text-red-600">*</span>
                </label>

                <textarea
                    name="alasan"
                    id="alasan"
                    rows="3"
                    required
                    minlength="10"
                    maxlength="2000"
                    class="w-full rounded-lg border-gray-300 text-sm focus:border-indigo-500 focus:ring-indigo-500"
                    placeholder="Jelaskan alasan perubahan resep..."
                >{{ old('alasan') }}</textarea>

                <p class="mt-1 text-xs text-gray-500">
                    Minimal 10 karakter.
                </p>
            </div>

            <div class="rounded-lg bg-white p-5 shadow-sm">
                <div class="mb-5 flex flex-wrap items-center justify-between gap-3">
                    <div>
                        <h3 class="font-semibold text-gray-800">
                            Detail Resep
                        </h3>
                        <p class="mt-1 text-sm text-gray-500">
                            Periksa kembali obat, jumlah, dosis, dan aturan pakai.
                        </p>
                    </div>

                    <button
                        type="button"
                        id="tambah-obat"
                        class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700"
                    >
                        + Tambah Obat
                    </button>
                </div>

                <div id="daftar-obat" class="space-y-5">
                    @forelse ($resepAktif as $index => $detail)
                        <div
                            class="baris-obat rounded-lg border border-gray-200 p-4"
                            data-row
                        >
                            <div class="mb-4 flex items-center justify-between">
                                <h4 class="judul-baris font-medium text-gray-700">
                                    Obat {{ $index + 1 }}
                                </h4>

                                <button
                                    type="button"
                                    class="hapus-obat text-sm font-medium text-red-600 hover:text-red-800"
                                >
                                    Hapus
                                </button>
                            </div>

                            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                <div class="md:col-span-2">
                                    <label class="mb-1 block text-sm text-gray-600">
                                        Nama Obat
                                    </label>

                                    <select
                                        name="obat_ids[{{ $index }}]"
                                        required
                                        class="w-full rounded-lg border-gray-300 text-sm"
                                    >
                                        <option value="">Pilih obat</option>

                                        @if (! $obats->contains('id', $detail['obat_id']))
                                            <option
                                                value="{{ $detail['obat_id'] }}"
                                                selected
                                            >
                                                {{ $detail['nama'] ?? 'Obat tidak ditemukan' }}
                                                (data lama)
                                            </option>
                                        @endif

                                        @foreach ($obats as $obat)
                                            <option
                                                value="{{ $obat->id }}"
                                                @selected((string) $detail['obat_id'] === (string) $obat->id)
                                            >
                                                {{ $obat->nama }}
                                                — Stok: {{ $obat->stok }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label class="mb-1 block text-sm text-gray-600">
                                        Jumlah
                                    </label>
                                    <input
                                        type="number"
                                        name="jumlah[{{ $index }}]"
                                        min="1"
                                        required
                                        value="{{ $detail['jumlah'] }}"
                                        class="w-full rounded-lg border-gray-300 text-sm"
                                    >
                                </div>

                                <div>
                                    <label class="mb-1 block text-sm text-gray-600">
                                        Dosis
                                    </label>
                                    <input
                                        type="text"
                                        name="dosis[{{ $index }}]"
                                        maxlength="100"
                                        required
                                        value="{{ $detail['dosis'] }}"
                                        class="w-full rounded-lg border-gray-300 text-sm"
                                    >
                                </div>

                                <div>
                                    <label class="mb-1 block text-sm text-gray-600">
                                        Frekuensi
                                    </label>
                                    <input
                                        type="text"
                                        name="frekuensi[{{ $index }}]"
                                        maxlength="100"
                                        required
                                        value="{{ $detail['frekuensi'] }}"
                                        class="w-full rounded-lg border-gray-300 text-sm"
                                    >
                                </div>

                                <div>
                                    <label class="mb-1 block text-sm text-gray-600">
                                        Aturan Pakai
                                    </label>
                                    <input
                                        type="text"
                                        name="aturan_pakai[{{ $index }}]"
                                        maxlength="150"
                                        required
                                        value="{{ $detail['aturan_pakai'] }}"
                                        class="w-full rounded-lg border-gray-300 text-sm"
                                    >
                                </div>

                                <div class="md:col-span-2">
                                    <label class="mb-1 block text-sm text-gray-600">
                                        Keterangan
                                    </label>
                                    <input
                                        type="text"
                                        name="keterangan[{{ $index }}]"
                                        maxlength="255"
                                        value="{{ $detail['keterangan'] ?? '' }}"
                                        class="w-full rounded-lg border-gray-300 text-sm"
                                    >
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500">
                            Tidak ada detail resep yang bisa dikoreksi.
                        </p>
                    @endforelse
                </div>

                <div class="mt-6 flex flex-wrap justify-end gap-3 border-t pt-5">
                    <a
                        href="{{ route('kunjungan.show', $kunjungan) }}"
                        class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50"
                    >
                        Batal
                    </a>

                    <button
                        type="submit"
                        class="rounded-lg bg-indigo-600 px-5 py-2 text-sm font-semibold text-white hover:bg-indigo-700"
                    >
                        Simpan Koreksi
                    </button>
                </div>
            </div>
        </form>
    </div>

    <template id="template-obat">
        <div class="baris-obat rounded-lg border border-gray-200 p-4" data-row>
            <div class="mb-4 flex items-center justify-between">
                <h4 class="judul-baris font-medium text-gray-700">Obat</h4>
                <button
                    type="button"
                    class="hapus-obat text-sm font-medium text-red-600 hover:text-red-800"
                >
                    Hapus
                </button>
            </div>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div class="md:col-span-2">
                    <label class="mb-1 block text-sm text-gray-600">Nama Obat</label>
                    <select name="obat_ids[__INDEX__]" required
                        class="w-full rounded-lg border-gray-300 text-sm">
                        <option value="">Pilih obat</option>
                        @foreach ($obats as $obat)
                            <option value="{{ $obat->id }}">
                                {{ $obat->nama }} — Stok: {{ $obat->stok }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="mb-1 block text-sm text-gray-600">Jumlah</label>
                    <input type="number" name="jumlah[__INDEX__]" min="1" required
                        class="w-full rounded-lg border-gray-300 text-sm">
                </div>

                <div>
                    <label class="mb-1 block text-sm text-gray-600">Dosis</label>
                    <input type="text" name="dosis[__INDEX__]" maxlength="100" required
                        class="w-full rounded-lg border-gray-300 text-sm">
                </div>

                <div>
                    <label class="mb-1 block text-sm text-gray-600">Frekuensi</label>
                    <input type="text" name="frekuensi[__INDEX__]" maxlength="100" required
                        class="w-full rounded-lg border-gray-300 text-sm">
                </div>

                <div>
                    <label class="mb-1 block text-sm text-gray-600">Aturan Pakai</label>
                    <input type="text" name="aturan_pakai[__INDEX__]" maxlength="150" required
                        class="w-full rounded-lg border-gray-300 text-sm">
                </div>

                <div class="md:col-span-2">
                    <label class="mb-1 block text-sm text-gray-600">Keterangan</label>
                    <input type="text" name="keterangan[__INDEX__]" maxlength="255"
                        class="w-full rounded-lg border-gray-300 text-sm">
                </div>
            </div>
        </div>
    </template>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const daftar = document.getElementById('daftar-obat');
            const tombolTambah = document.getElementById('tambah-obat');
            const template = document.getElementById('template-obat');

            function perbaruiNomor() {
                daftar.querySelectorAll('[data-row]').forEach((baris, index) => {
                    baris.querySelector('.judul-baris').textContent =
                        'Obat ' + (index + 1);
                });
            }

            tombolTambah.addEventListener('click', function () {
                const index = Date.now().toString() + Math.floor(Math.random() * 1000);
                const html = template.innerHTML.replaceAll('__INDEX__', index);
                daftar.insertAdjacentHTML('beforeend', html);
                perbaruiNomor();
            });

            daftar.addEventListener('click', function (event) {
                const tombol = event.target.closest('.hapus-obat');

                if (!tombol) return;

                const baris = tombol.closest('[data-row]');

                if (daftar.querySelectorAll('[data-row]').length <= 1) {
                    alert('Minimal satu obat harus dicantumkan.');
                    return;
                }

                baris.remove();
                perbaruiNomor();
            });
        });
    </script>
</x-app-layout>
