<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="text-xl font-bold text-slate-800">
                Identitas Poliklinik
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                Kelola identitas yang digunakan pada surat dan dokumen SIPOLI-MQ.
            </p>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">

            {{-- Success --}}
            @if (session('success'))
                <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Validation Errors --}}
            @if ($errors->any())
                <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4">
                    <div class="font-semibold text-red-800">
                        Periksa kembali data berikut:
                    </div>

                    <ul class="mt-2 list-inside list-disc space-y-1 text-sm text-red-700">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form
                action="{{ route('pengaturan.identitas.update') }}"
                method="POST"
                enctype="multipart/form-data"
                class="space-y-6"
            >

                @csrf
                @method('PUT')

                {{-- Identitas --}}
                <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                    <div class="border-b border-slate-200 px-6 py-5">
                        <h3 class="font-bold text-slate-800">
                            Identitas Poliklinik
                        </h3>

                        <p class="mt-1 text-sm text-slate-500">
                            Data ini akan digunakan pada kop dokumen SIPOLI-MQ.
                        </p>
                    </div>

                    <div class="space-y-5 p-6">

                        {{-- Nama --}}
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-700">
                                Nama Poliklinik
                            </label>

                            <input
                                type="text"
                                name="nama"
                                value="{{ old('nama', $identitas?->nama) }}"
                                required
                                class="w-full rounded-xl border-slate-300 focus:border-indigo-500 focus:ring-indigo-500"
                                placeholder="Nama Poliklinik"
                            >
                        </div>

                        {{-- Alamat --}}
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-700">
                                Alamat
                            </label>

                            <textarea
                                name="alamat"
                                rows="3"
                                class="w-full rounded-xl border-slate-300 focus:border-indigo-500 focus:ring-indigo-500"
                                placeholder="Alamat lengkap poliklinik"
                            >{{ old('alamat', $identitas?->alamat) }}</textarea>
                        </div>

                        {{-- Telepon & Email --}}
                        <div class="grid gap-5 md:grid-cols-2">

                            <div>
                                <label class="mb-2 block text-sm font-semibold text-slate-700">
                                    Nomor Telepon
                                </label>

                                <input
                                    type="text"
                                    name="telepon"
                                    value="{{ old('telepon', $identitas?->telepon) }}"
                                    class="w-full rounded-xl border-slate-300 focus:border-indigo-500 focus:ring-indigo-500"
                                    placeholder="085xxxxxxxxx"
                                >
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-semibold text-slate-700">
                                    Email
                                </label>

                                <input
                                    type="email"
                                    name="email"
                                    value="{{ old('email', $identitas?->email) }}"
                                    class="w-full rounded-xl border-slate-300 focus:border-indigo-500 focus:ring-indigo-500"
                                    placeholder="poliklinik@example.com"
                                >
                            </div>

                        </div>

                    </div>
                </div>

                {{-- Logo --}}
                <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                    <div class="border-b border-slate-200 px-6 py-5">
                        <h3 class="font-bold text-slate-800">
                            Logo
                        </h3>

                        <p class="mt-1 text-sm text-slate-500">
                            Logo akan digunakan pada kop surat dan dokumen PDF.
                        </p>
                    </div>

                    <div class="p-6">

                        @if ($identitas?->logo)
                            <div class="mb-5 flex items-center gap-4">

                                <div class="flex h-24 w-24 items-center justify-center rounded-xl border border-slate-200 bg-slate-50 p-3">
                                    <img
                                        src="{{ asset('storage/' . $identitas->logo) }}"
                                        alt="Logo Poliklinik"
                                        class="max-h-full max-w-full object-contain"
                                    >
                                </div>

                                <div>
                                    <p class="text-sm font-semibold text-slate-700">
                                        Logo saat ini
                                    </p>

                                    <p class="mt-1 text-xs text-slate-500">
                                        Upload logo baru untuk menggantinya.
                                    </p>
                                </div>

                            </div>
                        @endif

                        <input
                            type="file"
                            name="logo"
                            accept=".jpg,.jpeg,.png,.webp"
                            class="block w-full rounded-xl border border-slate-300 bg-white text-sm
                                   file:mr-4 file:border-0 file:bg-indigo-600
                                   file:px-4 file:py-2.5 file:font-semibold file:text-white
                                   hover:file:bg-indigo-700"
                        >

                        <p class="mt-2 text-xs text-slate-400">
                            JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.
                        </p>

                    </div>
                </div>

                {{-- Penandatangan --}}
                <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                    <div class="border-b border-slate-200 px-6 py-5">
                        <h3 class="font-bold text-slate-800">
                            Penandatangan Dokumen
                        </h3>

                        <p class="mt-1 text-sm text-slate-500">
                            Nama dan jabatan yang akan ditampilkan pada dokumen.
                        </p>
                    </div>

                    <div class="grid gap-5 p-6 md:grid-cols-2">

                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-700">
                                Nama Penandatangan
                            </label>

                            <input
                                type="text"
                                name="nama_penandatangan"
                                value="{{ old('nama_penandatangan', $identitas?->nama_penandatangan) }}"
                                class="w-full rounded-xl border-slate-300 focus:border-indigo-500 focus:ring-indigo-500"
                                placeholder="Nama lengkap"
                            >
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-700">
                                Jabatan
                            </label>

                            <input
                                type="text"
                                name="jabatan_penandatangan"
                                value="{{ old('jabatan_penandatangan', $identitas?->jabatan_penandatangan) }}"
                                class="w-full rounded-xl border-slate-300 focus:border-indigo-500 focus:ring-indigo-500"
                                placeholder="Contoh: Kepala Poliklinik"
                            >
                        </div>

                    </div>
                </div>

                {{-- Buttons --}}
                <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

                    <a
                        href="{{ route('dashboard') }}"
                        class="inline-flex items-center justify-center rounded-xl bg-slate-100 px-5 py-2.5 text-sm font-semibold text-slate-700 hover:bg-slate-200"
                    >
                        Batal
                    </a>

                    <button
                        type="submit"
                        class="inline-flex items-center justify-center rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-indigo-700"
                    >
                        Simpan Perubahan
                    </button>

                </div>

            </form>

        </div>
    </div>

</x-app-layout>