<x-app-layout>
    <div class="py-8">
        <div class="mx-auto max-w-6xl space-y-6 px-4 sm:px-6 lg:px-8">

            {{-- Header --}}
            <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
                <div>
                    <p class="text-sm font-medium text-indigo-600">
                        SIPOLI-MQ / Pemeriksaan
                    </p>

                    <h1 class="mt-1 text-2xl font-bold text-slate-800">
                        Edit Pemeriksaan Terpadu
                    </h1>

                    <p class="mt-1 text-sm text-slate-500">
                        Perbarui data pemeriksaan, diagnosis, dan tindakan.
                    </p>
                </div>

                <a href="{{ route('kunjungan.show', $kunjungan) }}"
                   class="inline-flex items-center justify-center rounded-lg border
                          border-slate-300 px-4 py-2 text-sm font-medium
                          text-slate-700 hover:bg-slate-50">
                    Kembali ke Detail Kunjungan
                </a>
            </div>

            {{-- Notifikasi kesalahan --}}
            @if ($errors->any())
                <div class="rounded-xl border border-red-200 bg-red-50 p-4">
                    <p class="font-semibold text-red-800">
                        Data belum dapat disimpan.
                    </p>

                    <ul class="mt-2 list-inside list-disc text-sm text-red-700">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Informasi kunjungan --}}
            <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="mb-4 flex items-center justify-between">
                    <h2 class="font-semibold text-slate-800">
                        Informasi Kunjungan
                    </h2>

                    @if ($kunjungan->status === 'selesai')
                        <span class="rounded-full bg-green-100 px-3 py-1
                                     text-xs font-semibold text-green-700">
                            Selesai
                        </span>
                    @else
                        <span class="rounded-full bg-blue-100 px-3 py-1
                                     text-xs font-semibold text-blue-700">
                            {{ ucfirst($kunjungan->status) }}
                        </span>
                    @endif
                </div>

                <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                    <div>
                        <p class="text-xs text-slate-500">Kode Kunjungan</p>
                        <p class="mt-1 font-medium text-slate-800">
                            {{ $kunjungan->kode_kunjungan }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs text-slate-500">Nama Santri</p>
                        <p class="mt-1 font-medium text-slate-800">
                            {{ $kunjungan->santri->nama ?? '-' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs text-slate-500">Tanggal Kunjungan</p>
                        <p class="mt-1 font-medium text-slate-800">
                            {{ $kunjungan->tanggal?->format('d-m-Y') ?? '-' }}
                        </p>
                    </div>

                    <div class="sm:col-span-2 lg:col-span-3">
                        <p class="text-xs text-slate-500">Keluhan Awal</p>
                        <p class="mt-1 text-sm text-slate-700">
                            {{ $kunjungan->keluhan ?: '-' }}
                        </p>
                    </div>
                </div>
            </div>

            <form action="{{ route('pemeriksaan-terpadu.update', $kunjungan) }}"
                  method="POST"
                  class="space-y-6">

                @csrf
                @method('PUT')

                {{-- Pemeriksaan fisik --}}
                <section class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
                    <div class="mb-5">
                        <h2 class="text-lg font-semibold text-slate-800">
                            Pemeriksaan Fisik
                        </h2>
                        <p class="mt-1 text-sm text-slate-500">
                            Data awal akan diisi otomatis dari pemeriksaan sebelumnya.
                        </p>
                    </div>

                    @php
                        $pemeriksaan = $kunjungan->pemeriksaan;
                    @endphp

                    <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">

                        <div>
                            <label for="tekanan_darah"
                                   class="mb-1.5 block text-sm font-medium text-slate-700">
                                Tekanan Darah *
                            </label>
                            <input id="tekanan_darah"
                                   name="tekanan_darah"
                                   type="text"
                                   required
                                   maxlength="20"
                                   value="{{ old('tekanan_darah', $pemeriksaan?->tekanan_darah) }}"
                                   placeholder="Contoh: 120/80"
                                   class="w-full rounded-lg border-slate-300 text-sm
                                          focus:border-indigo-500 focus:ring-indigo-500">
                            @error('tekanan_darah')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="suhu"
                                   class="mb-1.5 block text-sm font-medium text-slate-700">
                                Suhu Tubuh (°C) *
                            </label>
                            <input id="suhu"
                                   name="suhu"
                                   type="number"
                                   step="0.1"
                                   min="30"
                                   max="45"
                                   required
                                   value="{{ old('suhu', $pemeriksaan?->suhu) }}"
                                   class="w-full rounded-lg border-slate-300 text-sm
                                          focus:border-indigo-500 focus:ring-indigo-500">
                            @error('suhu')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="nadi"
                                   class="mb-1.5 block text-sm font-medium text-slate-700">
                                Nadi (kali/menit)
                            </label>
                            <input id="nadi"
                                   name="nadi"
                                   type="number"
                                   min="0"
                                   max="250"
                                   value="{{ old('nadi', $pemeriksaan?->nadi) }}"
                                   class="w-full rounded-lg border-slate-300 text-sm
                                          focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label for="pernapasan"
                                   class="mb-1.5 block text-sm font-medium text-slate-700">
                                Pernapasan (kali/menit)
                            </label>
                            <input id="pernapasan"
                                   name="pernapasan"
                                   type="number"
                                   min="0"
                                   max="100"
                                   value="{{ old('pernapasan', $pemeriksaan?->pernapasan) }}"
                                   class="w-full rounded-lg border-slate-300 text-sm
                                          focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label for="berat_badan"
                                   class="mb-1.5 block text-sm font-medium text-slate-700">
                                Berat Badan (kg)
                            </label>
                            <input id="berat_badan"
                                   name="berat_badan"
                                   type="number"
                                   step="0.1"
                                   min="0"
                                   max="300"
                                   value="{{ old('berat_badan', $pemeriksaan?->berat_badan) }}"
                                   class="w-full rounded-lg border-slate-300 text-sm
                                          focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label for="tinggi_badan"
                                   class="mb-1.5 block text-sm font-medium text-slate-700">
                                Tinggi Badan (cm)
                            </label>
                            <input id="tinggi_badan"
                                   name="tinggi_badan"
                                   type="number"
                                   step="0.1"
                                   min="0"
                                   max="250"
                                   value="{{ old('tinggi_badan', $pemeriksaan?->tinggi_badan) }}"
                                   class="w-full rounded-lg border-slate-300 text-sm
                                          focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <div class="sm:col-span-2 lg:col-span-3">
                            <label for="pemeriksaan_fisik"
                                   class="mb-1.5 block text-sm font-medium text-slate-700">
                                Hasil Pemeriksaan Fisik
                            </label>
                            <textarea id="pemeriksaan_fisik"
                                      name="pemeriksaan_fisik"
                                      rows="3"
                                      class="w-full rounded-lg border-slate-300 text-sm
                                             focus:border-indigo-500 focus:ring-indigo-500">{{ old('pemeriksaan_fisik', $pemeriksaan?->pemeriksaan_fisik) }}</textarea>
                        </div>

                        <div class="sm:col-span-2 lg:col-span-3">
                            <label for="catatan_pemeriksaan"
                                   class="mb-1.5 block text-sm font-medium text-slate-700">
                                Catatan Pemeriksaan
                            </label>
                            <textarea id="catatan_pemeriksaan"
                                      name="catatan_pemeriksaan"
                                      rows="3"
                                      class="w-full rounded-lg border-slate-300 text-sm
                                             focus:border-indigo-500 focus:ring-indigo-500">{{ old('catatan_pemeriksaan', $pemeriksaan?->catatan) }}</textarea>
                        </div>
                    </div>
                </section>

                {{-- Diagnosis --}}
                <section class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
                    <h2 class="text-lg font-semibold text-slate-800">
                        Diagnosis *
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Pilih satu atau lebih diagnosis yang sesuai.
                    </p>

                    @php
                        $diagnosaTerpilih = old(
                            'diagnosa_ids',
                            $kunjungan->diagnosas->pluck('id')->all()
                        );

                        $catatanDiagnosa = old(
                            'catatan_diagnosa',
                            $kunjungan->diagnosas->first()?->pivot?->catatan
                        );
                    @endphp

                    <div class="mt-4 grid gap-3 sm:grid-cols-2 lg:grid-cols-3">
                        @forelse ($diagnosas as $diagnosa)
                            <label class="flex cursor-pointer items-start gap-3 rounded-lg
                                          border border-slate-200 p-3 hover:bg-slate-50">
                                <input type="checkbox"
                                       name="diagnosa_ids[]"
                                       value="{{ $diagnosa->id }}"
                                       @checked(in_array($diagnosa->id, $diagnosaTerpilih))
                                       class="mt-1 rounded border-slate-300 text-indigo-600
                                              focus:ring-indigo-500">

                                <span class="text-sm text-slate-700">
                                    {{ $diagnosa->nama }}
                                    @if (!$diagnosa->is_active)
                                        <span class="block text-xs text-amber-600">
                                            Data tidak aktif
                                        </span>
                                    @endif
                                </span>
                            </label>
                        @empty
                            <p class="text-sm text-slate-500">
                                Belum ada data diagnosis.
                            </p>
                        @endforelse
                    </div>

                    @error('diagnosa_ids')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror

                    <div class="mt-5">
                        <label for="catatan_diagnosa"
                               class="mb-1.5 block text-sm font-medium text-slate-700">
                            Catatan Diagnosis
                        </label>
                        <textarea id="catatan_diagnosa"
                                  name="catatan_diagnosa"
                                  rows="2"
                                  class="w-full rounded-lg border-slate-300 text-sm
                                         focus:border-indigo-500 focus:ring-indigo-500">{{ $catatanDiagnosa }}</textarea>
                    </div>
                </section>

                {{-- Tindakan --}}
                <section class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
                    <h2 class="text-lg font-semibold text-slate-800">
                        Tindakan *
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Pilih tindakan yang dilakukan kepada santri.
                    </p>

                    @php
                        $tindakanTerpilih = old(
                            'tindakan_ids',
                            $kunjungan->tindakans->pluck('id')->all()
                        );

                        $catatanTindakan = old(
                            'catatan_tindakan',
                            $kunjungan->tindakans->first()?->pivot?->catatan
                        );
                    @endphp

                    <div class="mt-4 grid gap-3 sm:grid-cols-2 lg:grid-cols-3">
                        @forelse ($tindakans as $tindakan)
                            <label class="flex cursor-pointer items-start gap-3 rounded-lg
                                          border border-slate-200 p-3 hover:bg-slate-50">
                                <input type="checkbox"
                                       name="tindakan_ids[]"
                                       value="{{ $tindakan->id }}"
                                       @checked(in_array($tindakan->id, $tindakanTerpilih))
                                       class="mt-1 rounded border-slate-300 text-indigo-600
                                              focus:ring-indigo-500">

                                <span class="text-sm text-slate-700">
                                    {{ $tindakan->nama }}
                                    @if (!$tindakan->is_active)
                                        <span class="block text-xs text-amber-600">
                                            Data tidak aktif
                                        </span>
                                    @endif
                                </span>
                            </label>
                        @empty
                            <p class="text-sm text-slate-500">
                                Belum ada data tindakan.
                            </p>
                        @endforelse
                    </div>

                    @error('tindakan_ids')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror

                    <div class="mt-5">
                        <label for="catatan_tindakan"
                               class="mb-1.5 block text-sm font-medium text-slate-700">
                            Catatan Tindakan
                        </label>
                        <textarea id="catatan_tindakan"
                                  name="catatan_tindakan"
                                  rows="2"
                                  class="w-full rounded-lg border-slate-300 text-sm
                                         focus:border-indigo-500 focus:ring-indigo-500">{{ $catatanTindakan }}</textarea>
                    </div>
                </section>

                {{-- Resep: hanya ditampilkan --}}
                <section class="rounded-xl border border-amber-200 bg-amber-50 p-5">
                    <h2 class="font-semibold text-amber-900">
                        Informasi Resep Obat
                    </h2>

                    <p class="mt-1 text-sm text-amber-800">
                        Resep tidak diubah melalui formulir ini agar riwayat pengeluaran
                        dan stok obat tetap konsisten.
                    </p>

                    @if ($kunjungan->resep && $kunjungan->resep->details->isNotEmpty())
                        <div class="mt-4 overflow-x-auto rounded-lg border border-amber-200 bg-white">
                            <table class="min-w-full divide-y divide-slate-200 text-sm">
                                <thead class="bg-slate-100 text-left text-slate-600">
                                    <tr>
                                        <th class="px-4 py-3">Nama Obat</th>
                                        <th class="px-4 py-3">Jumlah</th>
                                        <th class="px-4 py-3">Dosis</th>
                                        <th class="px-4 py-3">Frekuensi</th>
                                        <th class="px-4 py-3">Aturan Pakai</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100">
                                    @foreach ($kunjungan->resep->details as $detail)
                                        <tr>
                                            <td class="px-4 py-3">
                                                {{ $detail->obat->nama ?? '-' }}
                                            </td>
                                            <td class="px-4 py-3">{{ $detail->jumlah }}</td>
                                            <td class="px-4 py-3">{{ $detail->dosis }}</td>
                                            <td class="px-4 py-3">{{ $detail->frekuensi }}</td>
                                            <td class="px-4 py-3">{{ $detail->aturan_pakai }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="mt-3 text-sm text-amber-800">
                            Tidak ada detail resep obat yang tersimpan.
                        </p>
                    @endif
                </section>

                {{-- Rujukan: hanya ditampilkan --}}
                <section class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
                    <h2 class="font-semibold text-slate-800">
                        Informasi Rujukan
                    </h2>

                    @if ($kunjungan->rujukan)
                        <div class="mt-3 grid gap-4 sm:grid-cols-2">
                            <div>
                                <p class="text-xs text-slate-500">Tanggal Rujukan</p>
                                <p class="mt-1 text-sm text-slate-800">
                                    {{ $kunjungan->rujukan->tanggal_rujukan
                                        ? \Illuminate\Support\Carbon::parse(
                                            $kunjungan->rujukan->tanggal_rujukan
                                        )->format('d-m-Y')
                                        : '-' }}
                                </p>
                            </div>

                            <div>
                                <p class="text-xs text-slate-500">Status Rujukan</p>
                                <p class="mt-1 text-sm text-slate-800">
                                    {{ ucfirst($kunjungan->rujukan->status ?? '-') }}
                                </p>
                            </div>

                            <div class="sm:col-span-2">
                                <p class="text-xs text-slate-500">Alasan Rujukan</p>
                                <p class="mt-1 text-sm text-slate-800">
                                    {{ $kunjungan->rujukan->alasan ?: '-' }}
                                </p>
                            </div>
                        </div>
                    @else
                        <p class="mt-2 text-sm text-slate-500">
                            Tidak ada data rujukan yang tersimpan.
                        </p>
                    @endif
                </section>

                {{-- Tombol aksi --}}
                <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
                    <a href="{{ route('kunjungan.show', $kunjungan) }}"
                       class="inline-flex justify-center rounded-lg border border-slate-300
                              px-5 py-2.5 text-sm font-medium text-slate-700
                              hover:bg-slate-50">
                        Batal
                    </a>

                    <button type="submit"
                            class="inline-flex justify-center rounded-lg bg-indigo-600
                                   px-5 py-2.5 text-sm font-semibold text-white
                                   hover:bg-indigo-700 focus:outline-none
                                   focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>