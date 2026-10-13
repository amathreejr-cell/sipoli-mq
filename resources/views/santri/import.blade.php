<x-app-layout>

    <x-slot name="header">
        <div class="flex flex-col gap-2">
            <h2 class="text-xl font-bold text-slate-800">
                Import Data Santri
            </h2>

            <p class="text-sm text-slate-500">
                Tambahkan banyak data santri sekaligus menggunakan file Excel.
            </p>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Alert --}}
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

            @if ($errors->any())
                <div class="mb-5 rounded-xl border border-red-200 bg-red-50 p-4">
                    <div class="font-semibold text-red-800 mb-2">
                        Import tidak dapat dilakukan.
                    </div>

                    <ul class="list-disc list-inside space-y-1 text-sm text-red-700">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Main Card --}}
            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                {{-- Header --}}
                <div class="border-b border-slate-200 bg-gradient-to-r from-indigo-600 to-indigo-700 px-6 py-5 text-white">
                    <div class="flex items-center gap-3">

                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-white/15">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                        </div>

                        <div>
                            <h3 class="text-lg font-bold">
                                Upload Excel
                            </h3>

                            <p class="text-sm text-indigo-100">
                                Import data santri secara massal
                            </p>
                        </div>

                    </div>
                </div>

                <div class="p-6">

                    {{-- Template --}}
                    <div class="mb-6 rounded-xl border border-indigo-100 bg-indigo-50 p-4">

                        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                            <div>
                                <h4 class="font-semibold text-indigo-900">
                                    Belum memiliki template?
                                </h4>

                                <p class="mt-1 text-sm text-indigo-700">
                                    Download template Excel SIPOLI-MQ terlebih dahulu.
                                </p>
                            </div>

                            <a href="{{ route('santri.import.template') }}"
                                class="inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-indigo-700">

                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5l5 5v11a2 2 0 01-2 2z" />
                                </svg>

                                Download Template
                            </a>

                        </div>

                    </div>

                    {{-- Form --}}
                    <form action="{{ route('santri.import') }}"
                        method="POST"
                        enctype="multipart/form-data">

                        @csrf

                        <div class="rounded-xl border-2 border-dashed border-slate-300 bg-slate-50 p-8 text-center">

                            <svg class="mx-auto h-12 w-12 text-slate-400"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.5"
                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 0116.9 6L17 6a5 5 0 011 9.9M12 12v9m0-9l-3 3m3-3l3 3" />

                            </svg>

                            <h4 class="mt-4 text-base font-semibold text-slate-800">
                                Pilih File Excel
                            </h4>

                            <p class="mt-1 text-sm text-slate-500">
                                Format yang diterima: .xlsx
                            </p>

                            <div class="mt-5">
                                <input
                                    type="file"
                                    name="file"
                                    accept=".xlsx"
                                    required
                                    class="block w-full cursor-pointer rounded-xl border border-slate-300 bg-white text-sm text-slate-600
                                           file:mr-4 file:border-0 file:bg-indigo-600
                                           file:px-4 file:py-2.5 file:text-sm file:font-semibold
                                           file:text-white hover:file:bg-indigo-700">

                            </div>

                            <p class="mt-2 text-xs text-slate-400">
                                Maksimal ukuran file 5 MB.
                            </p>

                        </div>

                        {{-- Info --}}
                        <div class="mt-6 grid gap-4 md:grid-cols-3">

                            <div class="rounded-xl bg-slate-50 p-4">
                                <div class="text-sm font-semibold text-slate-800">
                                    Nomor Induk
                                </div>
                                <div class="mt-1 text-xs text-slate-500">
                                    Harus unik dan tidak boleh sudah terdaftar.
                                </div>
                            </div>

                            <div class="rounded-xl bg-slate-50 p-4">
                                <div class="text-sm font-semibold text-slate-800">
                                    Jenis Kelamin
                                </div>
                                <div class="mt-1 text-xs text-slate-500">
                                    Gunakan L untuk laki-laki dan P untuk perempuan.
                                </div>
                            </div>

                            <div class="rounded-xl bg-slate-50 p-4">
                                <div class="text-sm font-semibold text-slate-800">
                                    Status
                                </div>
                                <div class="mt-1 text-xs text-slate-500">
                                    Gunakan aktif atau nonaktif.
                                </div>
                            </div>

                        </div>

                        {{-- Button --}}
                        <div class="mt-8 flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

                            <a href="{{ route('santri.index') }}"
                                class="inline-flex items-center justify-center rounded-xl bg-slate-100 px-5 py-2.5 text-sm font-semibold text-slate-700 hover:bg-slate-200">
                                Batal
                            </a>

                            <button type="submit"
                                class="inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-indigo-700">

                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 0116.9 6L17 6a5 5 0 011 9.9M12 12v9m0-9l3-3m-3 3l-3-3" />
                                </svg>

                                Import Data Santri
                            </button>

                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

</x-app-layout>