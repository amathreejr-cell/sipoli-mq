<x-app-layout>
    
    <main class="space-y-6">

        {{-- ALERT --}}
        @if (session('success'))
            <div class="mb-5 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mb-5 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                {{ session('error') }}
            </div>
        @endif

        <div class="mb-6 overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
            <div class="bg-gradient-to-r from-green-50 to-white px-6 py-6 sm:px-8">

                <div class="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">

                    <div class="flex items-center gap-4">

                        <div
                            class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-green-100 text-green-600">
                            <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <!-- Menggunakan ketebalan 1.8 yang sama dengan ikon awal Anda -->
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M10.5 20.5l10-10a4.95 4.95 0 10-7-7l-10 10a4.95 4.95 0 007 7z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M8.5 8.5l7 7" />
                            </svg>
                        </div>

                        <div>
                            <p class="text-sm font-medium text-green-600">
                                Obat
                            </p>

                            <h3 class="mt-1 text-xl font-bold text-gray-900">
                                Data Obat
                            </h3>

                            <p class="mt-1 text-sm text-gray-500">
                                Master data dan persediaan obat poliklinik. </p>
                        </div>

                    </div>

                    <div class="flex flex-wrap gap-2 sm:justify-end">

                    <a href="{{ route('obat.mutasi-stok.index') }}"
                        class="inline-flex w-fit items-center gap-2 rounded-xl bg-red-500 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-red-700">
                        Mutasi Stok
                    </a>

                    @if (in_array(auth()->user()->role, ['admin', 'petugas']))
                        <a href="{{ route('obat.create') }}"
                            class="inline-flex w-fit items-center gap-2 rounded-xl bg-emerald-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>

                            Tambah Obat
                        </a>
                    @endif

                    </div>

                </div>

            </div>
        </div>


        {{-- RINGKASAN --}}
        @php
            $jumlahObat = $obats->count();

            $jumlahHabis = $obats->where('stok', '<=', 0)->count();

            $jumlahMenipis = $obats
                ->filter(fn($obat) => $obat->stok > 0 && $obat->stok <= $obat->stok_minimum)
                ->count();
        @endphp

        <section class="mb-6 grid grid-cols-2 gap-4 lg:grid-cols-4">

            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                    Total Obat
                </p>

                <p class="mt-3 text-3xl font-extrabold text-slate-900">
                    {{ $jumlahObat }}
                </p>

                <p class="mt-1 text-xs text-slate-400">
                    Data obat terdaftar
                </p>
            </div>


            <div class="rounded-2xl border border-emerald-100 bg-white p-5 shadow-sm">
                <p class="text-xs font-bold uppercase tracking-wider text-emerald-600">
                    Stok Aman
                </p>

                <p class="mt-3 text-3xl font-extrabold text-slate-900">
                    {{ max(0, $jumlahObat - $jumlahHabis - $jumlahMenipis) }}
                </p>

                <p class="mt-1 text-xs text-slate-400">
                    Di atas stok minimum
                </p>
            </div>


            <div class="rounded-2xl border border-amber-100 bg-white p-5 shadow-sm">
                <p class="text-xs font-bold uppercase tracking-wider text-amber-600">
                    Stok Menipis
                </p>

                <p class="mt-3 text-3xl font-extrabold text-slate-900">
                    {{ $jumlahMenipis }}
                </p>

                <p class="mt-1 text-xs text-slate-400">
                    Perlu diperhatikan
                </p>
            </div>


            <div class="rounded-2xl border border-red-100 bg-white p-5 shadow-sm">
                <p class="text-xs font-bold uppercase tracking-wider text-red-600">
                    Stok Habis
                </p>

                <p class="mt-3 text-3xl font-extrabold text-slate-900">
                    {{ $jumlahHabis }}
                </p>

                <p class="mt-1 text-xs text-slate-400">
                    Tidak tersedia
                </p>
            </div>

        </section>


        {{-- TABEL --}}
        <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-200 px-5 py-4">
                <div>
                    <h2 class="font-bold text-slate-900">
                        Daftar Obat
                    </h2>

                    <p class="mt-1 text-xs text-slate-400">
                        Pantau jumlah persediaan dan batas minimum setiap obat.
                    </p>
                </div>
            </div>


            {{-- DESKTOP --}}
            <div class="hidden overflow-x-auto md:block">

                <table class="w-full text-left text-sm">

                    <thead class="border-b border-slate-200 bg-slate-50">
                        <tr>
                            <th class="px-5 py-3 text-xs font-bold uppercase tracking-wider text-slate-500">
                                Obat
                            </th>

                            <th class="px-5 py-3 text-xs font-bold uppercase tracking-wider text-slate-500">
                                Stok
                            </th>

                            <th class="px-5 py-3 text-xs font-bold uppercase tracking-wider text-slate-500">
                                Minimum
                            </th>

                            <th class="px-5 py-3 text-xs font-bold uppercase tracking-wider text-slate-500">
                                Kondisi
                            </th>

                            <th class="px-5 py-3 text-right text-xs font-bold uppercase tracking-wider text-slate-500">
                                Aksi
                            </th>
                        </tr>
                    </thead>


                    <tbody class="divide-y divide-slate-100">

                        @forelse ($obats as $obat)
                            @php
                                $stok = (int) $obat->stok;
                                $minimum = (int) $obat->stok_minimum;

                                if ($stok <= 0) {
                                    $kondisi = 'habis';
                                } elseif ($stok <= $minimum) {
                                    $kondisi = 'menipis';
                                } else {
                                    $kondisi = 'aman';
                                }

                                $persentase = $minimum > 0 ? min(100, ($stok / $minimum) * 100) : ($stok > 0 ? 100 : 0);
                            @endphp

                            <tr class="transition hover:bg-slate-50">

                                {{-- NAMA --}}
                                <td class="px-5 py-4">

                                    <p class="font-semibold text-slate-900">
                                        {{ $obat->nama }}
                                    </p>

                                    @if (!empty($obat->satuan))
                                        <p class="mt-0.5 text-xs text-slate-400">
                                            Satuan: {{ $obat->satuan }}
                                        </p>
                                    @endif

                                </td>


                                {{-- STOK --}}
                                <td class="px-5 py-4">

                                    <div class="flex items-center gap-3">

                                        <span class="text-lg font-extrabold text-slate-900">
                                            {{ $stok }}
                                        </span>

                                        @if ($stok <= 0)
                                            <span class="text-xs text-slate-400">
                                                unit
                                            </span>
                                        @endif

                                    </div>

                                    <div class="mt-2 h-1.5 w-28 overflow-hidden rounded-full bg-slate-100">

                                        <div class="h-full rounded-full
                                            {{ $kondisi === 'habis' ? 'bg-red-500' : ($kondisi === 'menipis' ? 'bg-amber-500' : 'bg-emerald-500') }}"
                                            style="width: {{ $persentase }}%">
                                        </div>

                                    </div>

                                </td>


                                {{-- MINIMUM --}}
                                <td class="px-5 py-4">

                                    <span class="font-medium text-slate-700">
                                        {{ $minimum }}
                                    </span>

                                </td>


                                {{-- KONDISI --}}
                                <td class="px-5 py-4">

                                    @if ($kondisi === 'habis')
                                        <span
                                            class="inline-flex rounded-full bg-red-50 px-2.5 py-1 text-xs font-bold text-red-700">
                                            Habis
                                        </span>
                                    @elseif ($kondisi === 'menipis')
                                        <span
                                            class="inline-flex rounded-full bg-amber-50 px-2.5 py-1 text-xs font-bold text-amber-700">
                                            Menipis
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-bold text-emerald-700">
                                            Aman
                                        </span>
                                    @endif

                                </td>


                                {{-- AKSI --}}
                                <td class="px-5 py-4 text-right">

                                    <div class="flex justify-end gap-2">

                                        <a href="{{ route('obat.show', $obat) }}"
                                            class="rounded-lg border border-slate-200 px-3 py-1.5 text-xs font-semibold text-slate-700 hover:bg-slate-50">
                                            Detail
                                        </a>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="5" class="px-5 py-16 text-center">

                                    <div
                                        class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-slate-100 text-slate-400">
                                        —
                                    </div>

                                    <h3 class="mt-4 font-semibold text-slate-800">
                                        Belum ada data obat
                                    </h3>

                                    <p class="mt-1 text-sm text-slate-400">
                                        Tambahkan obat untuk mulai mengelola persediaan.
                                    </p>

                                    @if (in_array(auth()->user()->role, ['admin', 'petugas']))
                                        <a href="{{ route('obat.create') }}"
                                            class="mt-4 inline-flex rounded-lg bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-800">
                                            + Tambah Obat
                                        </a>
                                    @endif

                                </td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- MOBILE --}}
            <div class="divide-y divide-slate-100 md:hidden">

                @forelse ($obats as $obat)
                    @php
                        $stok = (int) $obat->stok;
                        $minimum = (int) $obat->stok_minimum;

                        if ($stok <= 0) {
                            $kondisi = 'habis';
                        } elseif ($stok <= $minimum) {
                            $kondisi = 'menipis';
                        } else {
                            $kondisi = 'aman';
                        }
                    @endphp

                    <div class="p-4">

                        <div class="flex items-start justify-between gap-3">

                            <div>
                                <p class="font-bold text-slate-900">
                                    {{ $obat->nama }}
                                </p>

                                @if (!empty($obat->satuan))
                                    <p class="mt-0.5 text-xs text-slate-400">
                                        {{ $obat->satuan }}
                                    </p>
                                @endif
                            </div>


                            @if ($kondisi === 'habis')
                                <span class="rounded-full bg-red-50 px-2.5 py-1 text-xs font-bold text-red-700">
                                    Habis
                                </span>
                            @elseif ($kondisi === 'menipis')
                                <span class="rounded-full bg-amber-50 px-2.5 py-1 text-xs font-bold text-amber-700">
                                    Menipis
                                </span>
                            @else
                                <span
                                    class="rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-bold text-emerald-700">
                                    Aman
                                </span>
                            @endif

                        </div>


                        <div class="mt-4 grid grid-cols-2 gap-3">

                            <div class="rounded-lg bg-slate-50 p-3">
                                <p class="text-xs text-slate-400">
                                    Stok Saat Ini
                                </p>

                                <p class="mt-1 text-xl font-extrabold text-slate-900">
                                    {{ $stok }}
                                </p>
                            </div>

                            <div class="rounded-lg bg-slate-50 p-3">
                                <p class="text-xs text-slate-400">
                                    Stok Minimum
                                </p>

                                <p class="mt-1 text-xl font-extrabold text-slate-900">
                                    {{ $minimum }}
                                </p>
                            </div>

                        </div>


                        <div class="mt-4 flex gap-2">

                            <a href="{{ route('obat.show', $obat) }}"
                                class="flex-1 rounded-lg border border-slate-200 px-4 py-2 text-center text-sm font-semibold text-slate-700 hover:bg-slate-50">
                                Detail
                            </a>

                            @if (in_array(auth()->user()->role, ['admin', 'petugas']))
                                <a href="{{ route('obat.edit', $obat) }}"
                                    class="flex-1 rounded-lg bg-slate-900 px-4 py-2 text-center text-sm font-semibold text-white hover:bg-slate-800">
                                    Edit
                                </a>
                            @endif

                        </div>

                    </div>

                @empty

                    <div class="px-5 py-16 text-center">

                        <div
                            class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-slate-100 text-slate-400">
                            —
                        </div>

                        <h3 class="mt-4 font-semibold text-slate-800">
                            Belum ada data obat
                        </h3>

                        <p class="mt-1 text-sm text-slate-400">
                            Belum ada obat yang terdaftar.
                        </p>

                    </div>
                @endforelse

            </div>

        </section>

    </main>
    </div>
</x-app-layout>
