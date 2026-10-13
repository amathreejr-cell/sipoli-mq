<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="text-xl font-bold text-gray-800">
                Detail Fasilitas Rujukan
            </h2>
            <p class="mt-1 text-sm text-gray-500">
                Informasi fasilitas kesehatan tujuan rujukan.
            </p>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Header Fasilitas --}}
            <div class="mb-6 overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

                <div class="bg-gradient-to-r from-blue-50 to-white px-6 py-6 sm:px-8">

                    <div class="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">

                        <div class="flex items-center gap-4">

                            <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-blue-100 text-blue-600">
                                <svg
                                    class="h-7 w-7"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.8"
                                        d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"
                                    />
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.8"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"
                                    />
                                </svg>
                            </div>

                            <div>
                                <p class="text-sm font-medium text-blue-600">
                                    Master Rujukan
                                </p>

                                <h3 class="mt-1 text-xl font-bold text-gray-900">
                                    {{ $masterRujukan->nama_fasilitas }}
                                </h3>

                                <p class="mt-1 text-sm text-gray-500">
                                    Fasilitas kesehatan tujuan rujukan
                                </p>
                            </div>

                        </div>


                        {{-- Status --}}
                        @if($masterRujukan->is_active)
                            <span class="inline-flex w-fit items-center gap-2 rounded-full bg-emerald-100 px-3 py-1.5 text-sm font-semibold text-emerald-700">
                                <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                                Aktif
                            </span>
                        @else
                            <span class="inline-flex w-fit items-center gap-2 rounded-full bg-gray-100 px-3 py-1.5 text-sm font-semibold text-gray-600">
                                <span class="h-2 w-2 rounded-full bg-gray-400"></span>
                                Nonaktif
                            </span>
                        @endif

                    </div>

                </div>
            </div>


            {{-- Informasi Fasilitas --}}
            <div class="mb-6 overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

                <div class="border-b border-gray-100 px-6 py-5 sm:px-8">

                    <div class="flex items-center gap-3">

                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                            <svg
                                class="h-5 w-5"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0H5m14 0h2M7 21H3m6-12h2m-2 4h2m4-4h2m-2 4h2M9 3v2m6-2v2"
                                />
                            </svg>
                        </div>

                        <div>
                            <h3 class="font-bold text-gray-900">
                                Informasi Fasilitas
                            </h3>

                            <p class="text-sm text-gray-500">
                                Detail data fasilitas kesehatan.
                            </p>
                        </div>

                    </div>

                </div>


                <div class="divide-y divide-gray-100">

                    {{-- Nama Fasilitas --}}
                    <div class="grid grid-cols-1 gap-2 px-6 py-5 sm:grid-cols-3 sm:gap-6 sm:px-8">

                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                                Nama Fasilitas
                            </p>
                        </div>

                        <div class="sm:col-span-2">
                            <p class="font-semibold text-gray-900">
                                {{ $masterRujukan->nama_fasilitas }}
                            </p>
                        </div>

                    </div>


                    {{-- Alamat --}}
                    <div class="grid grid-cols-1 gap-2 px-6 py-5 sm:grid-cols-3 sm:gap-6 sm:px-8">

                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                                Alamat
                            </p>
                        </div>

                        <div class="sm:col-span-2">
                            <div class="flex items-start gap-3">

                                <svg
                                    class="mt-0.5 h-5 w-5 shrink-0 text-gray-400"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.8"
                                        d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"
                                    />
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.8"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"
                                    />
                                </svg>

                                <p class="text-sm leading-6 text-gray-700">
                                    {{ $masterRujukan->alamat ?? '-' }}
                                </p>

                            </div>
                        </div>

                    </div>


                    {{-- Nomor Telepon --}}
                    <div class="grid grid-cols-1 gap-2 px-6 py-5 sm:grid-cols-3 sm:gap-6 sm:px-8">

                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                                Nomor Telepon
                            </p>
                        </div>

                        <div class="sm:col-span-2">

                            @if ($masterRujukan->no_telepon)
                                <div class="flex items-center gap-3">

                                    <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-blue-50 text-blue-600">
                                        <svg
                                            class="h-4 w-4"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="1.8"
                                                d="M3 5a2 2 0 012-2h2.28a2 2 0 011.94 1.515L10 7a2 2 0 01-.45 1.82l-1.27 1.27a16 16 0 006.63 6.63l1.27-1.27A2 2 0 0118 15l2.485.78A2 2 0 0122 17.72V20a2 2 0 01-2 2C10.06 22 2 13.94 2 4a2 2 0 012-2h2.28"
                                            />
                                        </svg>
                                    </div>

                                    <p class="text-sm font-medium text-gray-800">
                                        {{ $masterRujukan->no_telepon }}
                                    </p>

                                </div>
                            @else
                                <p class="text-sm text-gray-500">
                                    -
                                </p>
                            @endif

                        </div>

                    </div>


                    {{-- Status --}}
                    <div class="grid grid-cols-1 gap-2 px-6 py-5 sm:grid-cols-3 sm:gap-6 sm:px-8">

                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                                Status
                            </p>
                        </div>

                        <div class="sm:col-span-2">

                            @if($masterRujukan->is_active)
                                <span class="inline-flex items-center gap-2 rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700">
                                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                    Aktif
                                </span>
                            @else
                                <span class="inline-flex items-center gap-2 rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-600">
                                    <span class="h-1.5 w-1.5 rounded-full bg-gray-400"></span>
                                    Nonaktif
                                </span>
                            @endif

                        </div>

                    </div>


                    {{-- Ditambahkan --}}
                    <div class="grid grid-cols-1 gap-2 px-6 py-5 sm:grid-cols-3 sm:gap-6 sm:px-8">

                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                                Ditambahkan
                            </p>
                        </div>

                        <div class="sm:col-span-2">

                            <div class="flex items-center gap-3">

                                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-gray-100 text-gray-500">
                                    <svg
                                        class="h-4 w-4"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="1.8"
                                            d="M8 7V3m8 4V3M4 11h16M5 5h14a1 1 0 011 1v14a1 1 0 01-1 1H5a1 1 0 01-1-1V6a1 1 0 011-1z"
                                        />
                                    </svg>
                                </div>

                                <p class="text-sm text-gray-700">
                                    {{ $masterRujukan->created_at?->format('d M Y H:i') ?? '-' }}
                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- Tombol Aksi --}}
            <div class="flex flex-wrap items-center gap-3">

                <a
                    href="{{ route('master-rujukan.index') }}"
                    class="inline-flex items-center gap-2 rounded-xl border border-gray-300 bg-white px-4 py-2.5 text-sm font-semibold text-gray-700 shadow-sm transition hover:bg-gray-50"
                >
                    <svg
                        class="h-4 w-4"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M15 19l-7-7 7-7"
                        />
                    </svg>

                    Kembali
                </a>


                @if(in_array(auth()->user()->role, ['admin', 'petugas']))
                    <a
                        href="{{ route('master-rujukan.edit', $masterRujukan) }}"
                        class="inline-flex items-center gap-2 rounded-xl bg-gray-800 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-gray-700"
                    >
                        <svg
                            class="h-4 w-4"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"
                            />
                        </svg>

                        Edit
                    </a>
                @endif

            </div>

        </div>
    </div>

</x-app-layout>