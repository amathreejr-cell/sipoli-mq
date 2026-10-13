<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Masuk | SIPOLI MQ</title>

    {{-- CSS & JS lokal melalui Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * {
            font-family:
                Inter,
                ui-sans-serif,
                system-ui,
                -apple-system,
                BlinkMacSystemFont,
                "Segoe UI",
                sans-serif;
        }

        body {
            min-height: 100vh;
        }

        .login-bg {
            background:
                radial-gradient(circle at 10% 10%,
                    rgba(20, 184, 166, 0.10),
                    transparent 28%),
                radial-gradient(circle at 90% 90%,
                    rgba(6, 182, 212, 0.10),
                    transparent 30%),
                linear-gradient(135deg,
                    #f8fafc 0%,
                    #f0fdfa 50%,
                    #f8fafc 100%);
        }

        .grid-pattern {
            background-size: 32px 32px;

            background-image:
                linear-gradient(to right,
                    rgba(15, 118, 110, 0.045) 1px,
                    transparent 1px),
                linear-gradient(to bottom,
                    rgba(15, 118, 110, 0.045) 1px,
                    transparent 1px);
        }

        .gradient-text {
            background: linear-gradient(135deg,
                    #0f766e 0%,
                    #0d9488 45%,
                    #0891b2 100%);

            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .input-focus:focus {
            box-shadow: 0 0 0 4px rgba(20, 184, 166, 0.10);
        }

        .floating {
            animation: floating 5s ease-in-out infinite;
        }

        @keyframes floating {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-7px);
            }
        }

        .shadow-soft {
            box-shadow: 0 20px 50px -20px rgba(15, 23, 42, 0.18);
        }

        .shadow-card {
            box-shadow: 0 25px 60px -25px rgba(15, 23, 42, 0.22);
        }

        /* Icon helper */
        .icon {
            width: 1.25rem;
            height: 1.25rem;
            flex-shrink: 0;
        }

        .icon-sm {
            width: 1rem;
            height: 1rem;
            flex-shrink: 0;
        }

        .icon-xs {
            width: 0.875rem;
            height: 0.875rem;
            flex-shrink: 0;
        }

        .icon-current {
            color: currentColor;
        }
    </style>
</head>

<body class="login-bg grid-pattern text-slate-800 antialiased">

    {{-- =========================================================
         HEADER
    ========================================================== --}}
    <header class="border-b border-slate-200/70 bg-white/75 backdrop-blur-xl">

        <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8">

            {{-- BRAND --}}
            <div class="flex items-center gap-3">

                <img src="{{ asset('images/logo-sipoli-1.png') }}" alt="SIPOLI MQ"
                    class="h-10 w-auto object-contain sm:h-12">

                <div class="hidden sm:block">

                    <div class="flex items-center gap-2">

                        <span class="text-base font-extrabold tracking-tight text-slate-900">
                            SIPOLI
                            <span class="text-teal-600">MQ</span>
                        </span>

                        <span
                            class="rounded-md bg-teal-50 px-1.5 py-0.5 text-[9px] font-bold uppercase tracking-wider text-teal-700">
                            v1.0
                        </span>

                    </div>

                    <p class="text-[11px] font-medium text-slate-500">
                        Sistem Informasi Poliklinik MQ
                    </p>

                </div>

            </div>

            {{-- STATUS --}}
            <div class="flex items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1.5">

                <span class="relative flex h-2 w-2">
                    <span
                        class="absolute inline-flex h-full w-full animate-ping rounded-full bg-emerald-400 opacity-60"></span>
                    <span class="relative inline-flex h-2 w-2 rounded-full bg-emerald-500"></span>
                </span>

                <span class="text-[11px] font-semibold text-emerald-700 sm:text-xs">
                    Sistem Aktif
                </span>

            </div>

        </div>

    </header>


    {{-- =========================================================
         MAIN
    ========================================================== --}}
    <main class="flex min-h-[calc(100vh-145px)] items-center px-4 py-8 sm:px-6 lg:px-8 lg:py-12">

        <div class="mx-auto grid w-full max-w-6xl items-center gap-10 lg:grid-cols-2 lg:gap-16">


            {{-- =================================================
                 LEFT CONTENT
            ================================================== --}}
            <section class="hidden lg:block">

                {{-- Badge --}}
                <div
                    class="inline-flex items-center gap-2 rounded-full border border-teal-200 bg-teal-50 px-3.5 py-2 text-xs font-semibold text-teal-700">

                    <svg class="icon-sm" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                        <path d="m9 12 2 2 4-4"></path>
                    </svg>

                    Sistem Pelayanan Kesehatan Santri

                </div>


                {{-- Heading --}}
                <div class="mt-5">

                    <h1 class="text-4xl font-extrabold leading-[1.15] tracking-tight text-slate-900 xl:text-5xl">

                        Layanan Kesehatan

                        <span class="gradient-text">
                            Terintegrasi
                        </span>

                        untuk Santri

                    </h1>

                    <p class="mt-5 max-w-xl text-sm leading-7 text-slate-600 xl:text-base">

                        SIPOLI MQ membantu petugas mengelola data santri,
                        kunjungan, pemeriksaan, rekam medis, obat,
                        rujukan, dan laporan pelayanan secara terstruktur.

                    </p>

                </div>


                {{-- FEATURES --}}
                <div class="mt-8 grid grid-cols-2 gap-4">

                    {{-- Data Santri --}}
                    <div
                        class="rounded-2xl border border-slate-200 bg-white/80 p-4 shadow-soft backdrop-blur-sm transition hover:-translate-y-1 hover:border-teal-200">

                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-teal-50 text-teal-600">

                            <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>

                        </div>

                        <h3 class="mt-3 text-sm font-bold text-slate-800">
                            Data Santri
                        </h3>

                        <p class="mt-1 text-xs leading-5 text-slate-500">
                            Identitas santri tersimpan secara terstruktur.
                        </p>

                    </div>


                    {{-- Kunjungan --}}
                    <div
                        class="rounded-2xl border border-slate-200 bg-white/80 p-4 shadow-soft backdrop-blur-sm transition hover:-translate-y-1 hover:border-cyan-200">

                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-cyan-50 text-cyan-600">

                            <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="4" width="18" height="18" rx="2"></rect>
                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                <line x1="3" y1="10" x2="21" y2="10"></line>
                                <line x1="12" y1="14" x2="12" y2="19"></line>
                                <line x1="9.5" y1="16.5" x2="14.5" y2="16.5"></line>
                            </svg>

                        </div>

                        <h3 class="mt-3 text-sm font-bold text-slate-800">
                            Kunjungan
                        </h3>

                        <p class="mt-1 text-xs leading-5 text-slate-500">
                            Pencatatan pelayanan kesehatan lebih mudah.
                        </p>

                    </div>


                    {{-- Rekam Medis --}}
                    <div
                        class="rounded-2xl border border-slate-200 bg-white/80 p-4 shadow-soft backdrop-blur-sm transition hover:-translate-y-1 hover:border-indigo-200">

                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600">

                            <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                <polyline points="14 2 14 8 20 8"></polyline>
                                <line x1="8" y1="13" x2="16" y2="13"></line>
                                <line x1="8" y1="17" x2="16" y2="17"></line>
                                <line x1="8" y1="9" x2="10" y2="9"></line>
                            </svg>

                        </div>

                        <h3 class="mt-3 text-sm font-bold text-slate-800">
                            Rekam Medis
                        </h3>

                        <p class="mt-1 text-xs leading-5 text-slate-500">
                            Riwayat pelayanan dapat ditelusuri dengan mudah.
                        </p>

                    </div>


                    {{-- Keamanan --}}
                    <div
                        class="rounded-2xl border border-slate-200 bg-white/80 p-4 shadow-soft backdrop-blur-sm transition hover:-translate-y-1 hover:border-emerald-200">

                        <div
                            class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">

                            <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                                <path d="m9 12 2 2 4-4"></path>
                            </svg>

                        </div>

                        <h3 class="mt-3 text-sm font-bold text-slate-800">
                            Akses Terproteksi
                        </h3>

                        <p class="mt-1 text-xs leading-5 text-slate-500">
                            Akses sistem berdasarkan hak pengguna.
                        </p>

                    </div>

                </div>


                {{-- INFO --}}
                <div
                    class="mt-6 flex items-center justify-between rounded-2xl bg-gradient-to-r from-teal-900 to-slate-900 p-4 text-white shadow-lg">

                    <div class="flex items-center gap-3">

                        <div
                            class="flex h-10 w-10 items-center justify-center rounded-xl border border-teal-400/30 bg-teal-500/15 text-teal-300">

                            <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path
                                    d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78L12 21.23l8.84-8.84a5.5 5.5 0 0 0 0-7.78z">
                                </path>
                            </svg>

                        </div>

                        <div>

                            <p class="text-[10px] font-medium uppercase tracking-wider text-slate-400">
                                SIPOLI MQ
                            </p>

                            <p class="text-sm font-semibold">
                                Pelayanan kesehatan santri
                            </p>

                        </div>

                    </div>

                    <span
                        class="rounded-lg border border-teal-500/30 bg-teal-500/15 px-2.5 py-1 text-[10px] font-semibold text-teal-300">
                        Terintegrasi
                    </span>

                </div>

            </section>


            {{-- =================================================
                 LOGIN
            ================================================== --}}
            <section class="mx-auto w-full max-w-md">

                <div class="relative overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-card">

                    {{-- TOP LINE --}}
                    <div
                        class="absolute inset-x-0 top-0 h-1 bg-gradient-to-r from-teal-500 via-cyan-500 to-indigo-500">
                    </div>


                    <div class="p-6 sm:p-8">

                        {{-- LOGIN HEADER --}}
                        <div class="text-center">

                            <div class="mx-auto flex h-20 items-center justify-center sm:h-24">

                                <img src="{{ asset('images/logo-sipoli-1.png') }}" alt="SIPOLI MQ"
                                    class="floating h-full w-auto object-contain">

                            </div>

                            <h2 class="mt-4 text-2xl font-extrabold tracking-tight text-slate-900">
                                Masuk ke SIPOLI MQ
                            </h2>

                            <p class="mt-1.5 text-xs leading-5 text-slate-500 sm:text-sm">
                                Gunakan akun terdaftar untuk mengakses sistem.
                            </p>

                        </div>


                        {{-- SESSION STATUS --}}
                        @if (session('status'))
                            <div
                                class="mt-5 flex items-start gap-2.5 rounded-xl border border-emerald-200 bg-emerald-50 p-3 text-sm text-emerald-700">

                                <svg class="icon-xs mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                </svg>

                                <span>
                                    {{ session('status') }}
                                </span>

                            </div>
                        @endif


                        {{-- LOGIN FORM --}}
                        <form method="POST" action="{{ route('login') }}" class="mt-6 space-y-5">

                            @csrf


                            {{-- USERNAME --}}
                            <div>

                                @if ($errors->any())
                                    <div
                                        class="mb-4 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                                        {{ $errors->first('login') }}
                                    </div>
                                @endif

                                <label for="login" class="mb-2 block text-xs font-bold text-slate-700">
                                    Username
                                </label>

                                <div class="relative">

                                    <div
                                        class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">

                                        <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="12" cy="7" r="4"></circle>
                                        </svg>

                                    </div>

                                    <input id="login" type="text" name="login" value="{{ old('login') }}"
                                        required autofocus autocomplete="username" placeholder="Masukkan username"
                                        class="input-focus w-full rounded-xl border border-slate-300 bg-white py-3 pl-11 pr-4 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-teal-500">

                                </div>

                                @error('login')
                                    <div class="mt-2 flex items-center gap-1.5 text-xs text-rose-600">

                                        <svg class="icon-xs" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <line x1="12" y1="8" x2="12" y2="12"></line>
                                            <line x1="12" y1="16" x2="12.01" y2="16"></line>
                                        </svg>

                                        {{ $message }}

                                    </div>
                                @enderror

                            </div>


                            {{-- PASSWORD --}}
                            <div>

                                <div class="mb-2 flex items-center justify-between">

                                    <label for="password" class="block text-xs font-bold text-slate-700">
                                        Kata Sandi
                                    </label>

                                    @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}"
                                            class="text-xs font-semibold text-teal-600 transition hover:text-teal-700 hover:underline">

                                            Lupa kata sandi?

                                        </a>
                                    @endif

                                </div>


                                <div class="relative">

                                    <div
                                        class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">

                                        <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <rect x="3" y="11" width="18" height="11" rx="2"></rect>
                                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                        </svg>

                                    </div>


                                    <input id="password" type="password" name="password" required
                                        autocomplete="current-password" placeholder="Masukkan kata sandi"
                                        class="input-focus w-full rounded-xl border border-slate-300 bg-white py-3 pl-11 pr-12 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-teal-500">


                                    <button type="button" onclick="togglePassword()"
                                        class="absolute inset-y-0 right-0 flex items-center pr-3.5 text-slate-400 transition hover:text-teal-600 focus:outline-none"
                                        title="Lihat / sembunyikan kata sandi">

                                        <svg id="passwordIcon" class="icon" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path
                                                d="M2.06 12.35a1 1 0 0 1 0-.7C3.74 7.48 7.6 5 12 5c4.4 0 8.26 2.48 9.94 6.65a1 1 0 0 1 0 .7C20.26 16.52 16.4 19 12 19c-4.4 0-8.26-2.48-9.94-6.65z">
                                            </path>
                                            <circle cx="12" cy="12" r="3"></circle>
                                        </svg>

                                    </button>

                                </div>


                                @error('password')
                                    <div class="mt-2 flex items-center gap-1.5 text-xs text-rose-600">

                                        <svg class="icon-xs" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <line x1="12" y1="8" x2="12" y2="12"></line>
                                            <line x1="12" y1="16" x2="12.01" y2="16"></line>
                                        </svg>

                                        {{ $message }}

                                    </div>
                                @enderror

                            </div>


                            {{-- REMEMBER --}}
                            <div class="flex items-center justify-between gap-3 pt-0.5">

                                <label for="remember_me"
                                    class="flex cursor-pointer select-none items-center gap-2 text-xs text-slate-600">

                                    <input id="remember_me" type="checkbox" name="remember"
                                        class="h-4 w-4 rounded border-slate-300 text-teal-600 focus:ring-teal-500">

                                    <span>
                                        Ingat saya
                                    </span>

                                </label>


                                <span
                                    class="flex items-center gap-1 text-[10px] font-medium text-slate-400 sm:text-xs">

                                    <svg class="icon-xs" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                                    </svg>

                                    Akses Terproteksi

                                </span>

                            </div>


                            {{-- SUBMIT --}}
                            <button type="submit" id="loginButton"
                                class="mt-1 flex w-full items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-teal-600 to-cyan-600 px-4 py-3.5 text-sm font-bold text-white shadow-lg shadow-teal-600/20 transition-all hover:from-teal-700 hover:to-cyan-700 hover:shadow-xl focus:outline-none focus:ring-4 focus:ring-teal-500/20 active:scale-[0.99]">

                                <span id="loginText">
                                    Masuk ke Sistem
                                </span>

                                <svg id="loginIcon" class="icon-sm" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                    <polyline points="12 5 19 12 12 19"></polyline>
                                </svg>

                            </button>

                        </form>


                        {{-- ROLE ACCESS --}}
                        <div class="mt-7 border-t border-slate-100 pt-6">

                            <div class="mb-4 flex items-center justify-between">

                                <span class="text-[10px] font-bold uppercase tracking-widest text-slate-400">
                                    Hak Akses Sistem
                                </span>

                                <span class="rounded-md bg-teal-50 px-2 py-1 text-[9px] font-bold text-teal-600">
                                    TERPROTEKSI
                                </span>

                            </div>


                            <div class="space-y-2.5">

                                {{-- ADMIN --}}
                                <div
                                    class="flex items-center gap-3 rounded-xl border border-slate-100 bg-slate-50 p-3">

                                    <div
                                        class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-teal-50 text-teal-600">

                                        <svg class="icon-sm" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                                            <path d="m9 12 2 2 4-4"></path>
                                        </svg>

                                    </div>

                                    <div class="min-w-0">

                                        <p class="text-xs font-bold text-slate-700">
                                            Admin
                                        </p>

                                        <p class="mt-0.5 text-[10px] leading-4 text-slate-500">
                                            Pengelolaan data dan administrasi sistem
                                        </p>

                                    </div>

                                </div>


                                {{-- PETUGAS --}}
                                <div
                                    class="flex items-center gap-3 rounded-xl border border-slate-100 bg-slate-50 p-3">

                                    <div
                                        class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-cyan-50 text-cyan-600">

                                        <svg class="icon-sm" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path
                                                d="M19 14c0 1.1-.9 2-2 2H7c-1.1 0-2-.9-2-2V8c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2v6z">
                                            </path>
                                            <path d="M8 6V4h8v2"></path>
                                            <path d="M12 16v4"></path>
                                            <path d="M8 20h8"></path>
                                        </svg>

                                    </div>

                                    <div class="min-w-0">

                                        <p class="text-xs font-bold text-slate-700">
                                            Petugas
                                        </p>

                                        <p class="mt-0.5 text-[10px] leading-4 text-slate-500">
                                            Pencatatan dan pelayanan kunjungan santri
                                        </p>

                                    </div>

                                </div>


                                {{-- PIMPINAN --}}
                                <div
                                    class="flex items-center gap-3 rounded-xl border border-slate-100 bg-slate-50 p-3">

                                    <div
                                        class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600">

                                        <svg class="icon-sm" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <line x1="18" y1="20" x2="18" y2="10">
                                            </line>
                                            <line x1="12" y1="20" x2="12" y2="4">
                                            </line>
                                            <line x1="6" y1="20" x2="6" y2="14">
                                            </line>
                                        </svg>

                                    </div>

                                    <div class="min-w-0">

                                        <p class="text-xs font-bold text-slate-700">
                                            Pimpinan
                                        </p>

                                        <p class="mt-0.5 text-[10px] leading-4 text-slate-500">
                                            Monitoring dan laporan pelayanan
                                        </p>

                                    </div>

                                </div>

                            </div>

                        </div>


                        {{-- FOOTNOTE --}}
                        <div class="mt-6 text-center text-[10px] leading-4 text-slate-400">
                            Pastikan Anda menggunakan akun resmi SIPOLI MQ.
                        </div>

                    </div>

                </div>

            </section>

        </div>

    </main>


    {{-- =========================================================
         FOOTER
    ========================================================== --}}
    <footer class="border-t border-slate-200/70 bg-white/60 px-4 py-4 backdrop-blur-sm sm:px-6">

        <div
            class="mx-auto flex max-w-7xl flex-col items-center justify-between gap-2 text-[10px] text-slate-500 sm:flex-row sm:text-xs">

            <div class="flex items-center gap-2">

                <span class="font-bold text-slate-700">
                    SIPOLI MQ
                </span>

                <span>•</span>

                <span>
                    Sistem Informasi Poliklinik MQ
                </span>

            </div>

            <div class="flex items-center gap-3">

                <span>
                    Akses Internal
                </span>

                <span>•</span>

                <span>
                    &copy; {{ date('Y') }} SIPOLI MQ
                </span>

            </div>

        </div>

    </footer>


    {{-- =========================================================
         SCRIPT
    ========================================================== --}}
    <script>
        // =====================================================
        // TOGGLE PASSWORD
        // =====================================================

        function togglePassword() {

            const password = document.getElementById('password');
            const icon = document.getElementById('passwordIcon');

            if (password.type === 'password') {

                password.type = 'text';

                icon.innerHTML = `
                    <path
                        d="M3 3l18 18">
                    </path>

                    <path
                        d="M10.58 10.58a2 2 0 0 0 2.83 2.83">
                    </path>

                    <path
                        d="M9.88 4.24A9.77 9.77 0 0 1 12 4c4.42 0 8.28 2.58 10 8a11.75 11.75 0 0 1-4.12 5.19">
                    </path>

                    <path
                        d="M6.61 6.61A11.75 11.75 0 0 0 2 12c1.72 5.42 5.58 8 10 8a9.77 9.77 0 0 0 4.24-.88">
                    </path>
                `;

            } else {

                password.type = 'password';

                icon.innerHTML = `
                    <path
                        d="M2.06 12.35a1 1 0 0 1 0-.7C3.74 7.48 7.6 5 12 5c4.4 0 8.26 2.48 9.94 6.65a1 1 0 0 1 0 .7C20.26 16.52 16.4 19 12 19c-4.4 0-8.26-2.48-9.94-6.65z">
                    </path>

                    <circle
                        cx="12"
                        cy="12"
                        r="3">
                    </circle>
                `;

            }
        }


        // =====================================================
        // LOGIN LOADING
        // =====================================================

        document
            .querySelector('form')
            .addEventListener('submit', function() {

                const button =
                    document.getElementById('loginButton');

                const text =
                    document.getElementById('loginText');

                const icon =
                    document.getElementById('loginIcon');

                button.disabled = true;

                button.classList.add(
                    'opacity-80',
                    'cursor-not-allowed'
                );

                text.textContent =
                    'Memverifikasi...';

                icon.classList.add('hidden');

            });
    </script>

</body>

</html>
