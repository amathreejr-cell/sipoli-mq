<x-app-layout>

    <x-slot name="header">

        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div class="flex items-center gap-3">

                <div
                    class="flex h-11 w-11 items-center justify-center rounded-2xl
                            bg-indigo-50 text-indigo-600">

                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />

                    </svg>

                </div>

                <div>

                    <h2 class="text-xl font-bold text-slate-800">
                        Data Santri
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Kelola data santri SIPOLI-MQ
                    </p>

                </div>

            </div>

            @if (in_array(auth()->user()->role, ['admin', 'petugas']))
                <div class="flex flex-col gap-2 sm:flex-row">

                    <a href="{{ route('santri.import.form') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-emerald-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-emerald-700">

                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>

                        Import Excel
                    </a>

                    <button type="button"
                        @click="window.dispatchEvent(new CustomEvent('open-santri-modal', { detail: 'create' }))"
                        class="inline-flex items-center justify-center gap-2 rounded-xl
                           bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white
                           shadow-sm transition hover:bg-indigo-700">

                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />

                        </svg>

                        Tambah Santri

                    </button>

                </div>
            @endif

        </div>

    </x-slot>


    {{-- =========================================================
        ALPINE MODAL CONTROLLER
    ========================================================== --}}

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
    
    }" @open-santri-modal.window="openModal($event.detail)"
        @keydown.escape.window="closeModal()">


        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">


            {{-- =====================================================
                FLASH MESSAGE
            ====================================================== --}}

            @if (session('success'))
                <div
                    class="mb-5 flex items-start gap-3 rounded-2xl border border-emerald-200
                            bg-emerald-50 px-4 py-3.5 text-sm text-emerald-700">

                    <div
                        class="mt-0.5 flex h-7 w-7 shrink-0 items-center justify-center
                                rounded-lg bg-emerald-100 text-emerald-600">

                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />

                        </svg>

                    </div>

                    <div>
                        <p class="font-semibold">
                            Berhasil
                        </p>

                        <p class="mt-0.5">
                            {{ session('success') }}
                        </p>
                    </div>

                </div>
            @endif


            @if (session('error'))
                <div
                    class="mb-5 flex items-start gap-3 rounded-2xl border border-red-200
                            bg-red-50 px-4 py-3.5 text-sm text-red-700">

                    <div
                        class="mt-0.5 flex h-7 w-7 shrink-0 items-center justify-center
                                rounded-lg bg-red-100 text-red-600">

                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M10.29 3.86l-8.18 14a2 2 0 001.71 2.64h16.36a2 2 0 001.71-2.64l-8.18-14a2 2 0 00-3.42 0z" />

                        </svg>

                    </div>

                    <div>
                        <p class="font-semibold">
                            Perhatian
                        </p>

                        <p class="mt-0.5">
                            {{ session('error') }}
                        </p>
                    </div>

                </div>
            @endif


            {{-- =====================================================
                FILTER
            ====================================================== --}}

            <div
                class="mb-6 overflow-hidden rounded-2xl border border-slate-200
                        bg-white shadow-sm">

                <div class="border-b border-slate-100 bg-slate-50/70 px-5 py-4">

                    <div class="flex items-center gap-3">

                        <div
                            class="flex h-9 w-9 items-center justify-center rounded-xl
                                    bg-white text-slate-600 shadow-sm">

                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m21 21-4.35-4.35m2.35-5.65a8 8 0 11-16 0 8 8 0 0116 0z" />

                            </svg>

                        </div>

                        <div>

                            <h3 class="text-sm font-semibold text-slate-800">
                                Pencarian & Filter
                            </h3>

                            <p class="mt-0.5 text-xs text-slate-500">
                                Cari berdasarkan nama, nomor induk, atau status
                            </p>

                        </div>

                    </div>

                </div>


                <form method="GET" action="{{ route('santri.index') }}" class="p-5">

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-3">


                        {{-- Search --}}
                        <div>

                            <label for="search" class="mb-1.5 block text-sm font-medium text-slate-700">

                                Cari Santri

                            </label>

                            <div class="relative">

                                <div
                                    class="pointer-events-none absolute inset-y-0 left-0
                                            flex items-center pl-3 text-slate-400">

                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="m21 21-4.35-4.35m2.35-5.65a8 8 0 11-16 0 8 8 0 0116 0z" />

                                    </svg>

                                </div>

                                <input id="search" name="search" type="text" value="{{ request('search') }}"
                                    placeholder="Nama atau nomor induk"
                                    class="block w-full rounded-xl border-slate-300 py-2.5 pl-9
                                           text-sm shadow-sm focus:border-indigo-500
                                           focus:ring-indigo-500">

                            </div>

                        </div>


                        {{-- Status --}}
                        <div>

                            <label for="status" class="mb-1.5 block text-sm font-medium text-slate-700">

                                Status

                            </label>

                            <select id="status" name="status"
                                class="block w-full rounded-xl border-slate-300 py-2.5
                                       text-sm shadow-sm focus:border-indigo-500
                                       focus:ring-indigo-500">

                                <option value="">
                                    Semua Status
                                </option>

                                <option value="aktif" @selected(request('status') === 'aktif')>
                                    Aktif
                                </option>

                                <option value="nonaktif" @selected(request('status') === 'nonaktif')>
                                    Nonaktif
                                </option>

                            </select>

                        </div>


                        {{-- Buttons --}}
                        <div class="flex items-end gap-2">

                            <button type="submit"
                                class="inline-flex flex-1 items-center justify-center gap-2
                                       rounded-xl bg-slate-800 px-4 py-2.5
                                       text-sm font-semibold text-white
                                       transition hover:bg-slate-900">

                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="m21 21-4.35-4.35m2.35-5.65a8 8 0 11-16 0 8 8 0 0116 0z" />

                                </svg>

                                Cari

                            </button>


                            <a href="{{ route('santri.index') }}"
                                class="inline-flex items-center justify-center rounded-xl
                                       bg-slate-100 px-4 py-2.5 text-sm font-semibold
                                       text-slate-600 transition hover:bg-slate-200">

                                Reset

                            </a>

                        </div>

                    </div>

                </form>

            </div>


            {{-- =====================================================
                DAFTAR SANTRI
            ====================================================== --}}

            {{-- =====================================================
            DESKTOP TABLE
            ====================================================== --}}
            <div class="hidden md:block overflow-x-auto">

                <table class="min-w-full divide-y divide-slate-200">

                    <thead class="bg-slate-50">
                        <tr>

                            <th
                                class="px-5 py-3.5 text-left text-[11px] font-bold uppercase
                           tracking-wider text-slate-500">
                                No
                            </th>

                            <th
                                class="px-5 py-3.5 text-left text-[11px] font-bold uppercase
                           tracking-wider text-slate-500">
                                Santri
                            </th>

                            <th
                                class="px-5 py-3.5 text-left text-[11px] font-bold uppercase
                           tracking-wider text-slate-500">
                                Jenis Kelamin
                            </th>

                            <th
                                class="px-5 py-3.5 text-left text-[11px] font-bold uppercase
                           tracking-wider text-slate-500">
                                Kamar
                            </th>

                            <th
                                class="px-5 py-3.5 text-left text-[11px] font-bold uppercase
                           tracking-wider text-slate-500">
                                Sekolah
                            </th>

                            <th
                                class="px-5 py-3.5 text-left text-[11px] font-bold uppercase
                           tracking-wider text-slate-500">
                                Kelas
                            </th>

                            <th
                                class="px-5 py-3.5 text-left text-[11px] font-bold uppercase
                           tracking-wider text-slate-500">
                                Status
                            </th>

                            <th
                                class="px-5 py-3.5 text-right text-[11px] font-bold uppercase
                           tracking-wider text-slate-500">
                                Aksi
                            </th>

                        </tr>
                    </thead>


                    <tbody class="divide-y divide-slate-100 bg-white">

                        @forelse ($santris as $index => $santri)
                            <tr class="group transition hover:bg-indigo-50/30">

                                {{-- No --}}
                                <td class="whitespace-nowrap px-5 py-4 text-sm text-slate-400">
                                    {{ $santris->firstItem() + $index }}
                                </td>


                                {{-- Santri --}}
                                <td class="px-5 py-4">

                                    <div class="flex items-center gap-3">

                                        <div
                                            class="flex h-10 w-10 shrink-0 items-center
                                        justify-center rounded-xl bg-indigo-50
                                        text-sm font-bold text-indigo-600">

                                            {{ strtoupper(substr($santri->nama, 0, 1)) }}

                                        </div>

                                        <div class="min-w-0">

                                            <p class="truncate font-semibold text-slate-800">
                                                {{ $santri->nama }}
                                            </p>

                                            <p class="mt-0.5 text-xs text-slate-400">
                                                {{ $santri->nomor_induk }}
                                            </p>

                                        </div>

                                    </div>

                                </td>


                                {{-- Jenis Kelamin --}}
                                <td class="whitespace-nowrap px-5 py-4 text-sm text-slate-600">
                                    {{ $santri->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}
                                </td>


                                {{-- Kamar --}}
                                <td class="whitespace-nowrap px-5 py-4">

                                    <span
                                        class="rounded-lg bg-slate-100 px-2.5 py-1
                                     text-xs font-medium text-slate-600">

                                        {{ $santri->kamar ?? '-' }}

                                    </span>

                                </td>


                                {{-- Sekolah --}}
                                <td class="max-w-[180px] truncate px-5 py-4 text-sm text-slate-600">
                                    {{ $santri->sekolah ?? '-' }}
                                </td>


                                {{-- Kelas --}}
                                <td class="whitespace-nowrap px-5 py-4 text-sm text-slate-600">
                                    {{ $santri->kelas ?? '-' }}
                                </td>


                                {{-- Status --}}
                                <td class="whitespace-nowrap px-5 py-4">

                                    @if ($santri->status === 'aktif')
                                        <span
                                            class="inline-flex items-center gap-1.5 rounded-full
                                         bg-emerald-50 px-2.5 py-1 text-xs font-semibold
                                         text-emerald-700">

                                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>

                                            Aktif

                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center gap-1.5 rounded-full
                                         bg-slate-100 px-2.5 py-1 text-xs font-semibold
                                         text-slate-600">

                                            <span class="h-1.5 w-1.5 rounded-full bg-slate-400"></span>

                                            Nonaktif

                                        </span>
                                    @endif

                                </td>


                                {{-- Aksi --}}
                                <td class="whitespace-nowrap px-5 py-4">

                                    <div class="flex justify-end gap-1">

                                        <button type="button" @click="openModal('show-{{ $santri->id }}')"
                                            class="flex h-9 w-9 items-center justify-center rounded-xl
                                       text-slate-400 transition hover:bg-indigo-50
                                       hover:text-indigo-600"
                                            title="Detail">

                                            <svg class="h-4 w-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">

                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />

                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.46 12C3.73 7.94 7.52 5 12 5s8.27 2.94 9.54 7c-1.27 4.06-5.06 7-9.54 7s-8.27-2.94-9.54-7z" />

                                            </svg>

                                        </button>


                                        @if (in_array(auth()->user()->role, ['admin', 'petugas']))
                                            <button type="button" @click="openModal('edit-{{ $santri->id }}')"
                                                class="flex h-9 w-9 items-center justify-center rounded-xl
                                           text-slate-400 transition hover:bg-amber-50
                                           hover:text-amber-600"
                                                title="Edit">

                                                <svg class="h-4 w-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">

                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M11 4H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-5" />

                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1-9.5-9.5z" />

                                                </svg>

                                            </button>
                                        @endif

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="8" class="px-5 py-16 text-center">

                                    <div class="mx-auto flex max-w-sm flex-col items-center">

                                        <div
                                            class="flex h-14 w-14 items-center justify-center
                                        rounded-2xl bg-slate-100 text-slate-400">

                                            <svg class="h-7 w-7" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">

                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="1.8"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />

                                            </svg>

                                        </div>

                                        <p class="mt-4 text-sm font-semibold text-slate-700">
                                            Data santri tidak ditemukan
                                        </p>

                                        <p class="mt-1 text-xs text-slate-400">
                                            Coba ubah kata pencarian atau filter.
                                        </p>

                                    </div>

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- =====================================================
            MOBILE CARDS
            ====================================================== --}}
            <div class="space-y-3 p-3 md:hidden">

                @forelse ($santris as $index => $santri)
                    <div
                        class="rounded-2xl border border-slate-200 bg-white
                    p-4 shadow-sm transition active:scale-[0.99]">

                        {{-- Header Card --}}
                        <div class="flex items-start justify-between gap-3">

                            <div class="flex min-w-0 items-center gap-3">

                                <div
                                    class="flex h-11 w-11 shrink-0 items-center
                                justify-center rounded-xl bg-indigo-50
                                font-bold text-indigo-600">

                                    {{ strtoupper(substr($santri->nama, 0, 1)) }}

                                </div>

                                <div class="min-w-0">

                                    <h4 class="truncate text-sm font-bold text-slate-800">
                                        {{ $santri->nama }}
                                    </h4>

                                    <p class="mt-0.5 text-xs text-slate-400">
                                        {{ $santri->nomor_induk }}
                                    </p>

                                </div>

                            </div>


                            @if ($santri->status === 'aktif')
                                <span
                                    class="shrink-0 rounded-full bg-emerald-50
                                 px-2.5 py-1 text-[10px] font-bold text-emerald-700">

                                    Aktif

                                </span>
                            @else
                                <span
                                    class="shrink-0 rounded-full bg-slate-100
                                 px-2.5 py-1 text-[10px] font-bold text-slate-600">

                                    Nonaktif

                                </span>
                            @endif

                        </div>


                        {{-- Info --}}
                        <div class="mt-4 grid grid-cols-2 gap-2">

                            <div class="rounded-xl bg-slate-50 px-3 py-2.5">

                                <p class="text-[10px] font-semibold uppercase tracking-wide text-slate-400">
                                    Kamar
                                </p>

                                <p class="mt-1 text-xs font-semibold text-slate-700">
                                    {{ $santri->kamar ?? '-' }}
                                </p>

                            </div>


                            <div class="rounded-xl bg-slate-50 px-3 py-2.5">

                                <p class="text-[10px] font-semibold uppercase tracking-wide text-slate-400">
                                    Kelas
                                </p>

                                <p class="mt-1 text-xs font-semibold text-slate-700">
                                    {{ $santri->kelas ?? '-' }}
                                </p>

                            </div>


                            <div class="rounded-xl bg-slate-50 px-3 py-2.5">

                                <p class="text-[10px] font-semibold uppercase tracking-wide text-slate-400">
                                    Kelamin
                                </p>

                                <p class="mt-1 text-xs font-semibold text-slate-700">
                                    {{ $santri->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}
                                </p>

                            </div>


                            <div class="rounded-xl bg-slate-50 px-3 py-2.5">

                                <p class="text-[10px] font-semibold uppercase tracking-wide text-slate-400">
                                    Sekolah
                                </p>

                                <p class="mt-1 truncate text-xs font-semibold text-slate-700">
                                    {{ $santri->sekolah ?? '-' }}
                                </p>

                            </div>

                        </div>


                        {{-- Actions --}}
                        <div class="mt-3 flex gap-2 border-t border-slate-100 pt-3">

                            <button type="button" @click="openModal('show-{{ $santri->id }}')"
                                class="flex flex-1 items-center justify-center gap-2 rounded-xl
                           bg-indigo-50 px-3 py-2.5 text-xs font-semibold
                           text-indigo-600 transition hover:bg-indigo-100">

                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />

                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.46 12C3.73 7.94 7.52 5 12 5s8.27 2.94 9.54 7c-1.27 4.06-5.06 7-9.54 7s-8.27-2.94-9.54-7z" />

                                </svg>

                                Detail

                            </button>


                            @if (in_array(auth()->user()->role, ['admin', 'petugas']))
                                <button type="button" @click="openModal('edit-{{ $santri->id }}')"
                                    class="flex flex-1 items-center justify-center gap-2 rounded-xl
                               bg-amber-50 px-3 py-2.5 text-xs font-semibold
                               text-amber-600 transition hover:bg-amber-100">

                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 4H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-5" />

                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1-9.5-9.5z" />

                                    </svg>

                                    Edit

                                </button>
                            @endif

                        </div>

                    </div>

                @empty

                    <div class="px-4 py-14 text-center">

                        <div
                            class="mx-auto flex h-14 w-14 items-center justify-center
                        rounded-2xl bg-slate-100 text-slate-400">

                            <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />

                            </svg>

                        </div>

                        <p class="mt-4 text-sm font-semibold text-slate-700">
                            Data santri tidak ditemukan
                        </p>

                        <p class="mt-1 text-xs text-slate-400">
                            Coba ubah kata pencarian atau filter.
                        </p>

                    </div>
                @endforelse

            </div>


            {{-- =====================================================
            PAGINATION
            ====================================================== --}}
            <div class="border-t border-slate-100 px-4 py-4 sm:px-5">

                {{ $santris->links() }}

            </div>


            {{-- =====================================================
            MODAL CREATE
            ====================================================== --}}

            <div x-show="modal === 'create'" x-cloak class="fixed inset-0 z-[100] overflow-y-auto"
                style="display: none;">

                <div class="fixed inset-0 bg-slate-950/60 backdrop-blur-sm" @click="closeModal()">
                </div>

                <div class="relative flex min-h-screen items-center justify-center p-4">

                    <div x-show="modal === 'create'" x-transition @click.stop
                        class="relative w-full max-w-3xl overflow-hidden
                           rounded-3xl bg-white shadow-2xl">


                        {{-- Header --}}
                        <div
                            class="flex items-center justify-between border-b border-slate-100
                                bg-slate-50/70 px-6 py-5">

                            <div class="flex items-center gap-3">

                                <div
                                    class="flex h-10 w-10 items-center justify-center
                                        rounded-xl bg-indigo-100 text-indigo-600">

                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4" />

                                    </svg>

                                </div>

                                <div>

                                    <h3 class="text-lg font-bold text-slate-800">
                                        Tambah Santri
                                    </h3>

                                    <p class="mt-1 text-sm text-slate-500">
                                        Tambahkan data santri baru ke SIPOLI-MQ
                                    </p>

                                </div>

                            </div>


                            <button type="button" @click="closeModal()"
                                class="rounded-xl p-2 text-slate-400 transition
                                   hover:bg-slate-100 hover:text-slate-600">

                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />

                                </svg>

                            </button>

                        </div>


                        <div class="max-h-[75vh] overflow-y-auto p-6">

                            <form method="POST" action="{{ route('santri.store') }}">

                                @csrf

                                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">


                                    {{-- Nomor Induk --}}
                                    <div>

                                        <label class="mb-1.5 block text-sm font-medium text-slate-700">
                                            Nomor Induk
                                        </label>

                                        <input type="text" name="nomor_induk" value="{{ old('nomor_induk') }}"
                                            required
                                            class="w-full rounded-xl border-slate-300 text-sm
                                               shadow-sm focus:border-indigo-500
                                               focus:ring-indigo-500">

                                        @error('nomor_induk')
                                            <p class="mt-1 text-xs text-red-600">
                                                {{ $message }}
                                            </p>
                                        @enderror

                                    </div>


                                    {{-- Nama --}}
                                    <div>

                                        <label class="mb-1.5 block text-sm font-medium text-slate-700">
                                            Nama Lengkap
                                        </label>

                                        <input type="text" name="nama" value="{{ old('nama') }}" required
                                            class="w-full rounded-xl border-slate-300 text-sm
                                               shadow-sm focus:border-indigo-500
                                               focus:ring-indigo-500">

                                        @error('nama')
                                            <p class="mt-1 text-xs text-red-600">
                                                {{ $message }}
                                            </p>
                                        @enderror

                                    </div>


                                    {{-- Tempat Lahir --}}
                                    <div>

                                        <label class="mb-1.5 block text-sm font-medium text-slate-700">
                                            Tempat Lahir
                                        </label>

                                        <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir') }}"
                                            class="w-full rounded-xl border-slate-300 text-sm
                                               shadow-sm focus:border-indigo-500
                                               focus:ring-indigo-500">

                                    </div>


                                    {{-- Tanggal Lahir --}}
                                    <div>

                                        <label class="mb-1.5 block text-sm font-medium text-slate-700">
                                            Tanggal Lahir
                                        </label>

                                        <input type="date" name="tanggal_lahir"
                                            value="{{ old('tanggal_lahir') }}"
                                            class="w-full rounded-xl border-slate-300 text-sm
                                               shadow-sm focus:border-indigo-500
                                               focus:ring-indigo-500">

                                    </div>


                                    {{-- Jenis Kelamin --}}
                                    <div>

                                        <label class="mb-1.5 block text-sm font-medium text-slate-700">
                                            Jenis Kelamin
                                        </label>

                                        <select name="jenis_kelamin" required
                                            class="w-full rounded-xl border-slate-300 text-sm
                                               shadow-sm focus:border-indigo-500
                                               focus:ring-indigo-500">

                                            <option value="">
                                                Pilih Jenis Kelamin
                                            </option>

                                            <option value="L" @selected(old('jenis_kelamin') === 'L')>
                                                Laki-laki
                                            </option>

                                            <option value="P" @selected(old('jenis_kelamin') === 'P')>
                                                Perempuan
                                            </option>

                                        </select>

                                    </div>


                                    {{-- Kamar --}}
                                    <div>

                                        <label class="mb-1.5 block text-sm font-medium text-slate-700">
                                            Kamar
                                        </label>

                                        <input type="text" name="kamar" value="{{ old('kamar') }}"
                                            placeholder="Contoh: MS-12"
                                            class="w-full rounded-xl border-slate-300 text-sm
                                               shadow-sm focus:border-indigo-500
                                               focus:ring-indigo-500">

                                    </div>


                                    {{-- Sekolah --}}
                                    <div>

                                        <label class="mb-1.5 block text-sm font-medium text-slate-700">
                                            Sekolah
                                        </label>

                                        <input type="text" name="sekolah" value="{{ old('sekolah') }}"
                                            placeholder="Contoh: SMP Al Furqan MQ"
                                            class="w-full rounded-xl border-slate-300 text-sm
                                               shadow-sm focus:border-indigo-500
                                               focus:ring-indigo-500">

                                    </div>


                                    {{-- Kelas --}}
                                    <div>

                                        <label class="mb-1.5 block text-sm font-medium text-slate-700">
                                            Kelas
                                        </label>

                                        <input type="text" name="kelas" value="{{ old('kelas') }}"
                                            placeholder="Contoh: 2"
                                            class="w-full rounded-xl border-slate-300 text-sm
                                               shadow-sm focus:border-indigo-500
                                               focus:ring-indigo-500">

                                    </div>


                                    {{-- Alamat --}}
                                    <div class="md:col-span-2">

                                        <label class="mb-1.5 block text-sm font-medium text-slate-700">
                                            Alamat
                                        </label>

                                        <textarea name="alamat" rows="3"
                                            class="w-full rounded-xl border-slate-300 text-sm
                                               shadow-sm focus:border-indigo-500
                                               focus:ring-indigo-500">{{ old('alamat') }}</textarea>

                                    </div>


                                    {{-- Status --}}
                                    <div>

                                        <label class="mb-1.5 block text-sm font-medium text-slate-700">
                                            Status
                                        </label>

                                        <select name="status" required
                                            class="w-full rounded-xl border-slate-300 text-sm
                                               shadow-sm focus:border-indigo-500
                                               focus:ring-indigo-500">

                                            <option value="aktif" @selected(old('status', 'aktif') === 'aktif')>
                                                Aktif
                                            </option>

                                            <option value="nonaktif" @selected(old('status') === 'nonaktif')>
                                                Nonaktif
                                            </option>

                                        </select>

                                    </div>

                                </div>


                                <div
                                    class="mt-6 flex justify-end gap-3
                                        border-t border-slate-100 pt-5">

                                    <button type="button" @click="closeModal()"
                                        class="rounded-xl bg-slate-100 px-4 py-2.5
                                           text-sm font-semibold text-slate-600
                                           hover:bg-slate-200">

                                        Batal

                                    </button>

                                    <button type="submit"
                                        class="rounded-xl bg-indigo-600 px-5 py-2.5
                                           text-sm font-semibold text-white shadow-sm
                                           hover:bg-indigo-700">

                                        Simpan Santri

                                    </button>

                                </div>

                            </form>

                        </div>

                    </div>

                </div>

            </div>


            {{-- =====================================================
            MODAL DETAIL
        ====================================================== --}}

            @foreach ($santris as $santri)
                <div x-show="modal === 'show-{{ $santri->id }}'" x-cloak
                    class="fixed inset-0 z-[100] overflow-y-auto" style="display: none;">

                    <div class="fixed inset-0 bg-slate-950/60 backdrop-blur-sm" @click="closeModal()">
                    </div>

                    <div class="relative flex min-h-screen items-center justify-center p-4">

                        <div x-show="modal === 'show-{{ $santri->id }}'" x-transition @click.stop
                            class="relative w-full max-w-3xl overflow-hidden
                               rounded-3xl bg-white shadow-2xl">


                            {{-- Header --}}
                            <div
                                class="flex items-center justify-between border-b border-slate-100
                                    bg-slate-50/70 px-6 py-5">

                                <div class="flex items-center gap-3">

                                    <div
                                        class="flex h-10 w-10 items-center justify-center
                                            rounded-xl bg-indigo-100 text-indigo-600">

                                        <svg class="h-5 w-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">

                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />

                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.46 12C3.73 7.94 7.52 5 12 5s8.27 2.94 9.54 7c-1.27 4.06-5.06 7-9.54 7s-8.27-2.94-9.54-7z" />

                                        </svg>

                                    </div>

                                    <div>

                                        <h3 class="text-lg font-bold text-slate-800">
                                            Detail Santri
                                        </h3>

                                        <p class="mt-1 text-sm text-slate-500">
                                            Informasi lengkap data santri
                                        </p>

                                    </div>

                                </div>


                                <button type="button" @click="closeModal()"
                                    class="rounded-xl p-2 text-slate-400 transition
                                       hover:bg-slate-100 hover:text-slate-600">

                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />

                                    </svg>

                                </button>

                            </div>


                            <div class="max-h-[75vh] overflow-y-auto p-6">


                                {{-- Informasi Utama --}}
                                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                                    <div class="rounded-2xl bg-slate-50 p-4">

                                        <p
                                            class="text-[11px] font-semibold uppercase
                                              tracking-wider text-slate-400">
                                            Nomor Induk
                                        </p>

                                        <p class="mt-1.5 font-semibold text-slate-800">
                                            {{ $santri->nomor_induk }}
                                        </p>

                                    </div>


                                    <div class="rounded-2xl bg-slate-50 p-4">

                                        <p
                                            class="text-[11px] font-semibold uppercase
                                              tracking-wider text-slate-400">
                                            Nama
                                        </p>

                                        <p class="mt-1.5 font-semibold text-slate-800">
                                            {{ $santri->nama }}
                                        </p>

                                    </div>


                                    <div class="rounded-2xl bg-slate-50 p-4">

                                        <p
                                            class="text-[11px] font-semibold uppercase
                                              tracking-wider text-slate-400">
                                            Tempat, Tanggal Lahir
                                        </p>

                                        <p class="mt-1.5 font-semibold text-slate-800">
                                            {{ $santri->tempat_lahir ?? '-' }},
                                            {{ $santri->tanggal_lahir?->format('d-m-Y') ?? '-' }}
                                        </p>

                                    </div>


                                    <div class="rounded-2xl bg-slate-50 p-4">

                                        <p
                                            class="text-[11px] font-semibold uppercase
                                              tracking-wider text-slate-400">
                                            Jenis Kelamin
                                        </p>

                                        <p class="mt-1.5 font-semibold text-slate-800">
                                            {{ $santri->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}
                                        </p>

                                    </div>


                                    <div class="rounded-2xl bg-slate-50 p-4">

                                        <p
                                            class="text-[11px] font-semibold uppercase
                                              tracking-wider text-slate-400">
                                            Kamar
                                        </p>

                                        <p class="mt-1.5 font-semibold text-slate-800">
                                            {{ $santri->kamar ?? '-' }}
                                        </p>

                                    </div>


                                    <div class="rounded-2xl bg-slate-50 p-4">

                                        <p
                                            class="text-[11px] font-semibold uppercase
                                              tracking-wider text-slate-400">
                                            Sekolah
                                        </p>

                                        <p class="mt-1.5 font-semibold text-slate-800">
                                            {{ $santri->sekolah ?? '-' }}
                                        </p>

                                    </div>


                                    <div class="rounded-2xl bg-slate-50 p-4">

                                        <p
                                            class="text-[11px] font-semibold uppercase
                                              tracking-wider text-slate-400">
                                            Kelas
                                        </p>

                                        <p class="mt-1.5 font-semibold text-slate-800">
                                            {{ $santri->kelas ?? '-' }}
                                        </p>

                                    </div>


                                    <div class="rounded-2xl bg-slate-50 p-4">

                                        <p
                                            class="text-[11px] font-semibold uppercase
                                              tracking-wider text-slate-400">
                                            Status
                                        </p>

                                        <div class="mt-1.5">

                                            @if ($santri->status === 'aktif')
                                                <span
                                                    class="inline-flex items-center gap-1.5
                                                         rounded-full bg-emerald-50
                                                         px-2.5 py-1 text-xs font-semibold
                                                         text-emerald-700">

                                                    <span
                                                        class="h-1.5 w-1.5 rounded-full
                                                             bg-emerald-500"></span>

                                                    Aktif

                                                </span>
                                            @else
                                                <span
                                                    class="inline-flex items-center gap-1.5
                                                         rounded-full bg-slate-100
                                                         px-2.5 py-1 text-xs font-semibold
                                                         text-slate-600">

                                                    <span
                                                        class="h-1.5 w-1.5 rounded-full
                                                             bg-slate-400"></span>

                                                    Nonaktif

                                                </span>
                                            @endif

                                        </div>

                                    </div>


                                    <div class="rounded-2xl bg-slate-50 p-4 sm:col-span-2">

                                        <p
                                            class="text-[11px] font-semibold uppercase
                                              tracking-wider text-slate-400">
                                            Alamat
                                        </p>

                                        <p class="mt-1.5 font-semibold text-slate-800">
                                            {{ $santri->alamat ?? '-' }}
                                        </p>

                                    </div>

                                </div>


                                {{-- =================================================
                                ALERGI
                            ================================================== --}}

                                <div class="mt-6 overflow-hidden rounded-2xl border border-slate-200">

                                    <div
                                        class="flex items-center justify-between
                                            border-b border-slate-100 bg-slate-50/70
                                            px-4 py-3">

                                        <div>

                                            <h4 class="text-sm font-semibold text-slate-800">
                                                Riwayat Alergi
                                            </h4>

                                            <p class="mt-0.5 text-xs text-slate-500">
                                                Riwayat alergi yang tercatat
                                            </p>

                                        </div>

                                    </div>


                                    <div class="overflow-x-auto">

                                        @if ($santri->alergis->count())
                                            <table class="min-w-full divide-y divide-slate-200">

                                                <thead class="bg-white">

                                                    <tr>

                                                        <th
                                                            class="px-4 py-3 text-left text-[11px]
                                                               font-semibold uppercase
                                                               tracking-wider text-slate-500">
                                                            Jenis
                                                        </th>

                                                        <th
                                                            class="px-4 py-3 text-left text-[11px]
                                                               font-semibold uppercase
                                                               tracking-wider text-slate-500">
                                                            Nama
                                                        </th>

                                                        <th
                                                            class="px-4 py-3 text-left text-[11px]
                                                               font-semibold uppercase
                                                               tracking-wider text-slate-500">
                                                            Reaksi
                                                        </th>

                                                        <th
                                                            class="px-4 py-3 text-left text-[11px]
                                                               font-semibold uppercase
                                                               tracking-wider text-slate-500">
                                                            Keterangan
                                                        </th>

                                                    </tr>

                                                </thead>


                                                <tbody class="divide-y divide-slate-100">

                                                    @foreach ($santri->alergis as $alergi)
                                                        <tr class="hover:bg-slate-50">

                                                            <td class="px-4 py-3 text-sm text-slate-600">
                                                                {{ $alergi->jenis }}
                                                            </td>

                                                            <td class="px-4 py-3 text-sm font-medium text-slate-700">
                                                                {{ $alergi->nama }}
                                                            </td>

                                                            <td class="px-4 py-3 text-sm text-slate-600">
                                                                {{ $alergi->reaksi ?? '-' }}
                                                            </td>

                                                            <td class="px-4 py-3 text-sm text-slate-600">
                                                                {{ $alergi->keterangan ?? '-' }}
                                                            </td>

                                                        </tr>
                                                    @endforeach

                                                </tbody>

                                            </table>
                                        @else
                                            <p class="px-4 py-6 text-center text-sm text-slate-500">
                                                Belum ada data alergi.
                                            </p>
                                        @endif

                                    </div>

                                </div>

                            </div>


                            {{-- =================================================
                            FOOTER
                        ================================================== --}}

                            <div
                                class="flex flex-wrap justify-end gap-3
                                    border-t border-slate-100 bg-slate-50/50
                                    px-6 py-4">


                                @if (auth()->user()->role === 'admin' && $santri->status === 'aktif')
                                    <form action="{{ route('santri.destroy', $santri) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menonaktifkan santri ini?')">

                                        @csrf

                                        @method('DELETE')

                                        <button type="submit"
                                            class="inline-flex items-center gap-2 rounded-xl
                                               bg-red-50 px-4 py-2.5 text-sm font-semibold
                                               text-red-600 transition hover:bg-red-100">

                                            <svg class="h-4 w-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">

                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-9 0h14" />

                                            </svg>

                                            Nonaktifkan

                                        </button>

                                    </form>
                                @endif


                                @if (in_array(auth()->user()->role, ['admin', 'petugas']))
                                    <button type="button" @click="openModal('edit-{{ $santri->id }}')"
                                        class="inline-flex items-center gap-2 rounded-xl
                                           bg-indigo-600 px-4 py-2.5 text-sm font-semibold
                                           text-white transition hover:bg-indigo-700">

                                        <svg class="h-4 w-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">

                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.5-8.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z" />

                                        </svg>

                                        Edit Santri

                                    </button>
                                @endif


                                <button type="button" @click="closeModal()"
                                    class="rounded-xl bg-white px-4 py-2.5 text-sm
                                       font-semibold text-slate-600
                                       ring-1 ring-inset ring-slate-200
                                       transition hover:bg-slate-50">

                                    Tutup

                                </button>

                            </div>

                        </div>

                    </div>

                </div>
            @endforeach


            {{-- =====================================================
            MODAL EDIT
        ====================================================== --}}

            @foreach ($santris as $santri)
                <div x-show="modal === 'edit-{{ $santri->id }}'" x-cloak
                    class="fixed inset-0 z-[100] overflow-y-auto" style="display: none;">

                    <div class="fixed inset-0 bg-slate-950/60 backdrop-blur-sm" @click="closeModal()">
                    </div>

                    <div class="relative flex min-h-screen items-center justify-center p-4">

                        <div x-show="modal === 'edit-{{ $santri->id }}'" x-transition @click.stop
                            class="relative w-full max-w-3xl overflow-hidden
                               rounded-3xl bg-white shadow-2xl">


                            {{-- Header --}}
                            <div
                                class="flex items-center justify-between border-b border-slate-100
                                    bg-slate-50/70 px-6 py-5">

                                <div class="flex items-center gap-3">

                                    <div
                                        class="flex h-10 w-10 items-center justify-center
                                            rounded-xl bg-amber-100 text-amber-600">

                                        <svg class="h-5 w-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">

                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.5-8.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z" />

                                        </svg>

                                    </div>

                                    <div>

                                        <h3 class="text-lg font-bold text-slate-800">
                                            Edit Santri
                                        </h3>

                                        <p class="mt-1 text-sm text-slate-500">
                                            Perbarui data santri
                                        </p>

                                    </div>

                                </div>


                                <button type="button" @click="closeModal()"
                                    class="rounded-xl p-2 text-slate-400 transition
                                       hover:bg-slate-100 hover:text-slate-600">

                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />

                                    </svg>

                                </button>

                            </div>


                            <div class="max-h-[75vh] overflow-y-auto p-6">

                                <form method="POST" action="{{ route('santri.update', $santri) }}">

                                    @csrf

                                    @method('PUT')

                                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">


                                        {{-- Nomor Induk --}}
                                        <div>

                                            <label class="mb-1.5 block text-sm font-medium text-slate-700">
                                                Nomor Induk
                                            </label>

                                            <input type="text" name="nomor_induk"
                                                value="{{ $santri->nomor_induk }}" required
                                                class="w-full rounded-xl border-slate-300 text-sm
                                                   shadow-sm focus:border-indigo-500
                                                   focus:ring-indigo-500">

                                        </div>


                                        {{-- Nama --}}
                                        <div>

                                            <label class="mb-1.5 block text-sm font-medium text-slate-700">
                                                Nama Lengkap
                                            </label>

                                            <input type="text" name="nama" value="{{ $santri->nama }}"
                                                required
                                                class="w-full rounded-xl border-slate-300 text-sm
                                                   shadow-sm focus:border-indigo-500
                                                   focus:ring-indigo-500">

                                        </div>


                                        {{-- Tempat Lahir --}}
                                        <div>

                                            <label class="mb-1.5 block text-sm font-medium text-slate-700">
                                                Tempat Lahir
                                            </label>

                                            <input type="text" name="tempat_lahir"
                                                value="{{ $santri->tempat_lahir }}"
                                                class="w-full rounded-xl border-slate-300 text-sm
                                                   shadow-sm focus:border-indigo-500
                                                   focus:ring-indigo-500">

                                        </div>


                                        {{-- Tanggal Lahir --}}
                                        <div>

                                            <label class="mb-1.5 block text-sm font-medium text-slate-700">
                                                Tanggal Lahir
                                            </label>

                                            <input type="date" name="tanggal_lahir"
                                                value="{{ $santri->tanggal_lahir?->format('Y-m-d') }}"
                                                class="w-full rounded-xl border-slate-300 text-sm
                                                   shadow-sm focus:border-indigo-500
                                                   focus:ring-indigo-500">

                                        </div>


                                        {{-- Jenis Kelamin --}}
                                        <div>

                                            <label class="mb-1.5 block text-sm font-medium text-slate-700">
                                                Jenis Kelamin
                                            </label>

                                            <select name="jenis_kelamin" required
                                                class="w-full rounded-xl border-slate-300 text-sm
                                                   shadow-sm focus:border-indigo-500
                                                   focus:ring-indigo-500">

                                                <option value="L" @selected($santri->jenis_kelamin === 'L')>
                                                    Laki-laki
                                                </option>

                                                <option value="P" @selected($santri->jenis_kelamin === 'P')>
                                                    Perempuan
                                                </option>

                                            </select>

                                        </div>


                                        {{-- Kamar --}}
                                        <div>

                                            <label class="mb-1.5 block text-sm font-medium text-slate-700">
                                                Kamar
                                            </label>

                                            <input type="text" name="kamar" value="{{ $santri->kamar }}"
                                                class="w-full rounded-xl border-slate-300 text-sm
                                                   shadow-sm focus:border-indigo-500
                                                   focus:ring-indigo-500">

                                        </div>


                                        {{-- Sekolah --}}
                                        <div>

                                            <label class="mb-1.5 block text-sm font-medium text-slate-700">
                                                Sekolah
                                            </label>

                                            <input type="text" name="sekolah" value="{{ $santri->sekolah }}"
                                                class="w-full rounded-xl border-slate-300 text-sm
                                                   shadow-sm focus:border-indigo-500
                                                   focus:ring-indigo-500">

                                        </div>


                                        {{-- Kelas --}}
                                        <div>

                                            <label class="mb-1.5 block text-sm font-medium text-slate-700">
                                                Kelas
                                            </label>

                                            <input type="text" name="kelas" value="{{ $santri->kelas }}"
                                                class="w-full rounded-xl border-slate-300 text-sm
                                                   shadow-sm focus:border-indigo-500
                                                   focus:ring-indigo-500">

                                        </div>


                                        {{-- Alamat --}}
                                        <div class="md:col-span-2">

                                            <label class="mb-1.5 block text-sm font-medium text-slate-700">
                                                Alamat
                                            </label>

                                            <textarea name="alamat" rows="3"
                                                class="w-full rounded-xl border-slate-300 text-sm
                                                   shadow-sm focus:border-indigo-500
                                                   focus:ring-indigo-500">{{ $santri->alamat }}</textarea>

                                        </div>


                                        {{-- Status --}}
                                        <div>

                                            <label class="mb-1.5 block text-sm font-medium text-slate-700">
                                                Status
                                            </label>

                                            <select name="status" required
                                                class="w-full rounded-xl border-slate-300 text-sm
                                                   shadow-sm focus:border-indigo-500
                                                   focus:ring-indigo-500">

                                                <option value="aktif" @selected($santri->status === 'aktif')>
                                                    Aktif
                                                </option>

                                                <option value="nonaktif" @selected($santri->status === 'nonaktif')>
                                                    Nonaktif
                                                </option>

                                            </select>

                                        </div>

                                    </div>


                                    <div
                                        class="mt-6 flex justify-end gap-3
                                            border-t border-slate-100 pt-5">

                                        <button type="button" @click="closeModal()"
                                            class="rounded-xl bg-slate-100 px-4 py-2.5
                                               text-sm font-semibold text-slate-600
                                               hover:bg-slate-200">

                                            Batal

                                        </button>

                                        <button type="submit"
                                            class="rounded-xl bg-indigo-600 px-5 py-2.5
                                               text-sm font-semibold text-white
                                               shadow-sm hover:bg-indigo-700">

                                            Simpan Perubahan

                                        </button>

                                    </div>

                                </form>

                            </div>

                        </div>

                    </div>

                </div>
            @endforeach

        </div>

</x-app-layout>
