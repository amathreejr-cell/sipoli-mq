<x-app-layout>
    <main class="space-y-6">

        {{-- ALERT SUKSES --}}
        @if (session('success'))
            <div class="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                {{ session('success') }}
            </div>
        @endif

        {{-- ALERT ERROR --}}
        @if ($errors->any())
            <div class="rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                <p class="mb-1 font-semibold">Terjadi kesalahan:</p>
                <ul class="list-inside list-disc space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- HEADER --}}
        <section class="overflow-hidden rounded-2xl border border-red-100 bg-white shadow-sm">
            <div class="bg-gradient-to-r from-red-50 to-white px-6 py-6 sm:px-8">
                <div class="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">
                    <div class="flex items-center gap-4">
                        <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-red-100 text-red-600">
                            <svg class="h-7 w-7" fill="none" stroke="currentColor"
                                stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 6h18M8 6V4h8v2m-9 0 1 14h8l1-14M10 10v6m4-6v6" />
                            </svg>
                        </div>

                        <div>
                            <p class="text-sm font-medium text-red-600">
                                Manajemen Santri
                            </p>
                            <h1 class="mt-1 text-xl font-bold text-gray-900">
                                Penghapusan Massal Santri
                            </h1>
                            <p class="mt-1 text-sm text-gray-500">
                                Hapus data santri berdasarkan daftar Nomor Induk dari Excel.
                            </p>
                        </div>
                    </div>

                    <a href="{{ route('santri.index') }}"
                        class="inline-flex w-fit items-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor"
                            stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 19l-7-7 7-7" />
                        </svg>
                        Kembali ke Santri
                    </a>
                </div>
            </div>
        </section>

        {{-- PERINGATAN --}}
        <section class="rounded-2xl border border-amber-200 bg-amber-50 p-5">
            <div class="flex items-start gap-3">
                <svg class="mt-0.5 h-6 w-6 shrink-0 text-amber-600"
                    fill="none" stroke="currentColor" stroke-width="1.8"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 9v4m0 4h.01M10.3 3.9 1.9 18.4A1.8 1.8 0 0 0 3.5 21h17a1.8 1.8 0 0 0 1.6-2.6L13.7 3.9a2 2 0 0 0-3.4 0Z" />
                </svg>

                <div>
                    <h2 class="font-bold text-amber-800">
                        Perhatian: Penghapusan Permanen
                    </h2>
                    <p class="mt-1 text-sm leading-6 text-amber-800">
                        Data santri dan rekam medis terkait akan dihapus secara permanen.
                        Pastikan daftar benar dan buat backup database sebelum melanjutkan.
                        Data master obat, diagnosis, tindakan, serta riwayat mutasi stok
                        tidak ikut dihapus.
                    </p>
                </div>
            </div>
        </section>

        {{-- UPLOAD EXCEL --}}
        <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-200 px-5 py-4 sm:px-6">
                <h2 class="font-bold text-slate-900">
                    1. Upload File Excel
                </h2>
                <p class="mt-1 text-sm text-slate-500">
                    Unggah daftar Nomor Induk santri yang akan dihapus.
                </p>
            </div>

            <div class="p-5 sm:p-6">
                <div class="mb-5 rounded-xl bg-slate-50 p-4">
                    <p class="text-sm font-semibold text-slate-700">
                        Format kolom Excel
                    </p>

                    <div class="mt-3 inline-flex rounded-lg border border-slate-200 bg-white px-4 py-2.5">
                        <span class="font-mono text-sm font-bold text-emerald-700">
                            nomor_induk
                        </span>
                    </div>

                    <p class="mt-2 text-xs leading-5 text-slate-500">
                        Format file XLSX, XLS, atau CSV. Maksimal 500 Nomor Induk
                        dan ukuran file 2 MB. Simpan Nomor Induk sebagai teks
                        jika mengandung angka nol di bagian depan.
                    </p>
                </div>

                <form action="{{ route('santri.penghapusan-massal.upload') }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf

                    <label for="file" class="mb-2 block text-sm font-semibold text-slate-700">
                        Pilih file
                    </label>

                    <input type="file" name="file" id="file"
                        accept=".xlsx,.xls,.csv" required
                        class="block w-full rounded-xl border border-slate-300 bg-white text-sm text-slate-700
                        file:mr-4 file:border-0 file:bg-slate-100 file:px-4 file:py-3
                        file:text-sm file:font-semibold file:text-slate-700
                        hover:file:bg-slate-200">

                    <button type="submit"
                        class="mt-4 inline-flex items-center gap-2 rounded-xl bg-emerald-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor"
                            stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 16V4m0 0L7 9m5-5 5 5M5 16v3a1 1 0 001 1h12a1 1 0 001-1v-3" />
                        </svg>
                        Upload dan Periksa
                    </button>
                </form>
            </div>
        </section>

        {{-- PRATINJAU --}}
        @if ($sudahUpload)
            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div class="border-b border-slate-200 px-5 py-4 sm:px-6">
                    <h2 class="font-bold text-slate-900">
                        2. Pratinjau Data Santri
                    </h2>
                    <p class="mt-1 text-sm text-slate-500">
                        Periksa data yang cocok sebelum melakukan penghapusan.
                    </p>
                </div>

                <div class="p-5 sm:p-6">

                    {{-- RINGKASAN --}}
                    <div class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div class="rounded-2xl border border-emerald-100 bg-emerald-50 p-5">
                            <p class="text-sm font-semibold text-emerald-700">
                                Santri Ditemukan
                            </p>
                            <p class="mt-2 text-3xl font-extrabold text-emerald-800">
                                {{ $santriDitemukan->count() }}
                            </p>
                            <p class="mt-1 text-xs text-emerald-700">
                                Data yang cocok dengan Nomor Induk
                            </p>
                        </div>

                        <div class="rounded-2xl border border-amber-100 bg-amber-50 p-5">
                            <p class="text-sm font-semibold text-amber-700">
                                Nomor Tidak Ditemukan
                            </p>
                            <p class="mt-2 text-3xl font-extrabold text-amber-800">
                                {{ count($nomorTidakDitemukan) }}
                            </p>
                            <p class="mt-1 text-xs text-amber-700">
                                Tidak akan diproses
                            </p>
                        </div>
                    </div>

                    {{-- TABEL DESKTOP --}}
                    <div class="hidden overflow-x-auto md:block">
                        <table class="w-full text-left text-sm">
                            <thead class="border-b border-slate-200 bg-slate-50">
                                <tr>
                                    <th class="px-4 py-3 font-bold text-slate-500">No.</th>
                                    <th class="px-4 py-3 font-bold text-slate-500">Nomor Induk</th>
                                    <th class="px-4 py-3 font-bold text-slate-500">Nama Santri</th>
                                    <th class="px-4 py-3 font-bold text-slate-500">Kamar</th>
                                    <th class="px-4 py-3 font-bold text-slate-500">Status</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-slate-100">
                                @forelse ($santriDitemukan as $index => $santri)
                                    <tr class="transition hover:bg-slate-50">
                                        <td class="px-4 py-4 text-slate-500">
                                            {{ $index + 1 }}
                                        </td>
                                        <td class="px-4 py-4 font-medium text-slate-700">
                                            {{ $santri->nomor_induk }}
                                        </td>
                                        <td class="px-4 py-4 font-semibold text-slate-900">
                                            {{ $santri->nama }}
                                        </td>
                                        <td class="px-4 py-4 text-slate-600">
                                            {{ $santri->kamar ?: '-' }}
                                        </td>
                                        <td class="px-4 py-4">
                                            <span class="inline-flex rounded-full bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-600">
                                                {{ ucfirst($santri->status ?? '-') }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-4 py-12 text-center text-slate-500">
                                            Tidak ada santri yang cocok dengan Nomor Induk dalam file.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- KARTU MOBILE --}}
                    <div class="divide-y divide-slate-100 md:hidden">
                        @forelse ($santriDitemukan as $santri)
                            <div class="py-4">
                                <p class="font-bold text-slate-900">
                                    {{ $santri->nama }}
                                </p>
                                <p class="mt-1 text-sm text-slate-500">
                                    Nomor Induk: {{ $santri->nomor_induk }}
                                </p>
                                <div class="mt-2 flex flex-wrap gap-2 text-xs">
                                    <span class="rounded-full bg-slate-100 px-3 py-1 text-slate-600">
                                        Kamar: {{ $santri->kamar ?: '-' }}
                                    </span>
                                    <span class="rounded-full bg-slate-100 px-3 py-1 text-slate-600">
                                        {{ ucfirst($santri->status ?? '-') }}
                                    </span>
                                </div>
                            </div>
                        @empty
                            <p class="py-8 text-center text-sm text-slate-500">
                                Tidak ada santri yang cocok.
                            </p>
                        @endforelse
                    </div>

                    {{-- NOMOR TIDAK DITEMUKAN --}}
                    @if (count($nomorTidakDitemukan) > 0)
                        <div class="mt-6 rounded-xl border border-amber-200 bg-amber-50 p-4">
                            <h3 class="font-bold text-amber-800">
                                Nomor Induk Tidak Ditemukan
                            </h3>
                            <p class="mt-1 text-sm text-amber-700">
                                Nomor berikut akan dilewati dan tidak dihapus.
                            </p>

                            <ul class="mt-3 grid grid-cols-1 gap-1 text-sm text-amber-800 sm:grid-cols-2 lg:grid-cols-3">
                                @foreach ($nomorTidakDitemukan as $nomor)
                                    <li class="break-all">{{ $nomor }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- KONFIRMASI --}}
                    @if ($santriDitemukan->isNotEmpty())
                        <div class="mt-6 border-t border-slate-200 pt-6">
                            <h3 class="font-bold text-slate-900">
                                3. Konfirmasi Penghapusan
                            </h3>
                            <p class="mt-1 text-sm leading-6 text-slate-500">
                                Pastikan semua data telah diperiksa. Proses ini tidak
                                menyediakan fitur pemulihan otomatis.
                            </p>

                            <form action="{{ route('santri.penghapusan-massal.hapus') }}"
                                method="POST"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus permanen semua santri yang ditemukan beserta rekam medis terkait? Tindakan ini tidak dapat dibatalkan.');"
                                class="mt-5">
                                @csrf

                                <label class="flex items-start gap-3 rounded-xl border border-red-100 bg-red-50 p-4">
                                    <input type="checkbox" name="konfirmasi" value="1"
                                        required
                                        class="mt-1 rounded border-red-300 text-red-600 focus:ring-red-500">

                                    <span class="text-sm leading-6 text-red-800">
                                        Saya telah memeriksa daftar, memastikan backup tersedia,
                                        dan memahami bahwa penghapusan data ini bersifat permanen.
                                    </span>
                                </label>

                                <div class="mt-5 flex flex-wrap gap-3">
                                    <button type="submit"
                                        class="inline-flex items-center gap-2 rounded-xl bg-red-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-red-700">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor"
                                            stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M3 6h18M8 6V4h8v2m-9 0 1 14h8l1-14" />
                                        </svg>
                                        Hapus Permanen
                                    </button>

                                    <button type="submit"
                                        formaction="{{ route('santri.penghapusan-massal.batal') }}"
                                        formnovalidate
                                        class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                                        Batalkan
                                    </button>
                                </div>
                            </form>
                        </div>
                    @endif

                </div>
            </section>
        @endif

    </main>
</x-app-layout>
