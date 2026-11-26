<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPOLI MQ - Sistem Informasi Poliklinik Terpadu</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * {
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        }

        .portal-bg {
            background-color: #f8fafc;
            background-image: 
                radial-gradient(at 0% 0%, rgba(20, 184, 166, 0.12) 0px, transparent 50%),
                radial-gradient(at 100% 0%, rgba(6, 182, 212, 0.10) 0px, transparent 50%),
                radial-gradient(at 50% 100%, rgba(15, 118, 110, 0.08) 0px, transparent 50%);
        }

        .grid-ambient {
            background-size: 40px 40px;
            background-image:
                linear-gradient(to right, rgba(15, 118, 110, 0.035) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(15, 118, 110, 0.035) 1px, transparent 1px);
        }

        .gradient-brand {
            background: linear-gradient(135deg, #0f766e 0%, #0d9488 45%, #0891b2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .floating-hero {
            animation: heroFloat 6s ease-in-out infinite;
        }

        @keyframes heroFloat {
            0%, 100% {
                transform: translateY(0px) rotate(0deg);
            }
            50% {
                transform: translateY(-8px) rotate(0.5deg);
            }
        }
    </style>
</head>

<body class="portal-bg grid-ambient text-slate-800 antialiased min-h-screen flex flex-col justify-between selection:bg-teal-500 selection:text-white">

    {{-- =========================================================
         NAVIGATION BAR
    ========================================================== --}}
    <nav class="border-b border-slate-200/60 bg-white/70 backdrop-blur-md sticky top-0 z-50">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4">
            
            {{-- BRAND IDENTITY --}}
            <div class="flex items-center gap-3.5">
                <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-gradient-to-tr from-teal-600 to-cyan-500 p-0.5 shadow-md shadow-teal-500/20">
                    <div class="flex h-full w-full items-center justify-center rounded-[14px] bg-white">
                        <img src="{{ asset('images/logo-sipoli-1.png') }}" alt="SIPOLI MQ" class="h-7 w-auto object-contain">
                    </div>
                </div>
                <div>
                    <div class="flex items-center gap-2">
                        <span class="text-base font-extrabold tracking-tight text-slate-900">
                            SIPOLI <span class="text-teal-600">MQ</span>
                        </span>
                        <span class="rounded-full bg-teal-50 px-2 py-0.5 text-[10px] font-bold text-teal-700 ring-1 ring-inset ring-teal-600/20">
                            v1.0
                        </span>
                    </div>
                    <p class="text-[11px] font-medium text-slate-500 leading-none mt-0.5">
                        Layanan Kesehatan Santri Madrasatul Qur an
                    </p>
                </div>
            </div>

            {{-- ACTION CORNER --}}
            <div class="flex items-center gap-3">
                <div class="hidden sm:inline-flex items-center gap-2 rounded-full border border-emerald-200/80 bg-emerald-50/70 px-3 py-1 text-xs font-semibold text-emerald-700">
                    <span class="h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    Server Terhubung
                </div>

                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" 
                           class="inline-flex items-center gap-2 rounded-xl bg-slate-900 px-4 py-2.5 text-xs font-semibold text-white shadow-sm transition hover:bg-slate-800 focus:ring-2 focus:ring-slate-900 focus:ring-offset-2">
                            <span>Panel Dashboard</span>
                            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                        </a>
                    @else
                        <a href="{{ route('login') }}" 
                           class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-teal-600 to-cyan-600 px-4 py-2.5 text-xs font-semibold text-white shadow-md shadow-teal-600/20 transition hover:from-teal-700 hover:to-cyan-700">
                            <span>Masuk</span>
                            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
                                <polyline points="10 17 15 12 10 7"></polyline>
                                <line x1="15" y1="12" x2="3" y2="12"></line>
                            </svg>
                        </a>
                    @endauth
                @endif
            </div>

        </div>
    </nav>

    {{-- =========================================================
         HERO SECTION (SHOWCASE UTAMA)
    ========================================================== --}}
    <main class="flex-1 max-w-7xl mx-auto px-6 py-12 lg:py-16 w-full flex flex-col justify-center">
        
        <div class="grid items-center gap-12 lg:grid-cols-12 lg:gap-8">
            
            {{-- TEXT CONTENT (7 COLS) --}}
            <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                
                <div class="inline-flex items-center gap-2 rounded-full border border-teal-200 bg-white/80 px-3.5 py-1.5 text-xs font-semibold text-teal-800 shadow-sm backdrop-blur-sm">
                    <span class="flex h-2 w-2 rounded-full bg-teal-500"></span>
                    Sentra Rekam Medis & Layanan Klinik Digital
                </div>

                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight text-slate-900 leading-[1.12]">
                    Solusi Terpadu <br class="hidden sm:inline">
                    Kesehatan Santri MQ <br>
                    <span class="gradient-brand">Lebih Tanggap & Tertata</span>
                </h1>

                <p class="max-w-xl mx-auto lg:mx-0 text-slate-600 text-sm sm:text-base leading-relaxed">
                    Sistem otomasi pendataan kunjungan harian, rekam medis berkala, monitoring distribusi resep obat, serta rujukan fasilitas kesehatan secara akurat dalam satu sistem terintegrasi.
                </p>

                {{-- BUTTONS & QUICK LINK --}}
                <div class="pt-2 flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" 
                           class="w-full sm:w-auto inline-flex items-center justify-center gap-2.5 rounded-2xl bg-slate-900 px-7 py-3.5 text-sm font-bold text-white shadow-lg transition hover:bg-slate-800 hover:-translate-y-0.5">
                            <span>Buka Dashboard Utama</span>
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </a>
                    @else
                        <a href="{{ route('login') }}" 
                           class="w-full sm:w-auto inline-flex items-center justify-center gap-2.5 rounded-2xl bg-gradient-to-r from-teal-600 via-teal-500 to-cyan-600 px-7 py-3.5 text-sm font-bold text-white shadow-xl shadow-teal-600/25 transition hover:shadow-teal-600/35 hover:-translate-y-0.5 focus:outline-none focus:ring-4 focus:ring-teal-500/20">
                            <span>Masuk ke Akun Anda</span>
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </a>
                    @endauth

                    <div class="text-xs font-semibold text-slate-500 flex items-center gap-2 px-3 py-2">
                        <svg class="h-4 w-4 text-teal-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                        </svg>
                        Autentikasi Terenkripsi
                    </div>
                </div>

                {{-- TRUST METRICS --}}
                <div class="pt-6 border-t border-slate-200/70 grid grid-cols-3 gap-4 text-center lg:text-left">
                    <div>
                        <p class="text-xl sm:text-2xl font-black text-slate-800 tracking-tight">100%</p>
                        <p class="text-xs text-slate-500 font-medium">Data Terpusat</p>
                    </div>
                    <div>
                        <p class="text-xl sm:text-2xl font-black text-slate-800 tracking-tight">Realtime</p>
                        <p class="text-xs text-slate-500 font-medium">Pencatatan Rekam</p>
                    </div>
                    <div>
                        <p class="text-xl sm:text-2xl font-black text-slate-800 tracking-tight">Multi-Role</p>
                        <p class="text-xs text-slate-500 font-medium">Admin & Petugas</p>
                    </div>
                </div>

            </div>

            {{-- VISUAL SHOWCASE STAGE (5 COLS) --}}
            <div class="lg:col-span-5 relative flex items-center justify-center">
                
                {{-- Glow Backlight --}}
                <div class="absolute -inset-4 rounded-full bg-gradient-to-tr from-teal-400/25 to-cyan-400/25 blur-3xl"></div>

                {{-- Mockup Showcase Frame --}}
                <div class="floating-hero relative w-full max-w-sm rounded-3xl border border-white/80 bg-white/70 p-6 shadow-2xl backdrop-blur-xl ring-1 ring-slate-900/5">
                    
                    {{-- Logo Hero Center Stage --}}
                    <div class="relative overflow-hidden rounded-2xl bg-gradient-to-b from-teal-500/10 via-cyan-500/5 to-white p-8 text-center border border-teal-100">
                        <div class="mx-auto flex h-28 w-28 items-center justify-center rounded-2xl bg-white p-4 shadow-lg shadow-teal-900/5 ring-1 ring-slate-100">
                            <img src="{{ asset('images/logo-sipoli-1.png') }}" alt="SIPOLI MQ Logo" class="h-full w-auto object-contain">
                        </div>
                        <h3 class="mt-5 text-lg font-extrabold tracking-tight text-slate-900">SIPOLI MQ</h3>
                        <p class="text-xs text-slate-500 font-medium">Sistem Informasi Poliklinik Madrastaul Qur an</p>
                    </div>

                    {{-- Dynamic Status Pill --}}
                    <div class="mt-5 space-y-2.5">
                        <div class="flex items-center justify-between rounded-xl border border-slate-100 bg-white/80 p-3 shadow-sm">
                            <div class="flex items-center gap-2.5">
                                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-teal-50 text-teal-600">
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="9" cy="7" r="4"></circle>
                                    </svg>
                                </div>
                                <span class="text-xs font-bold text-slate-700">Pelayanan Santri</span>
                            </div>
                            <span class="text-[10px] font-bold text-teal-600 bg-teal-50 px-2 py-0.5 rounded-md">Siap Digunakan</span>
                        </div>

                        <div class="flex items-center justify-between rounded-xl border border-slate-100 bg-white/80 p-3 shadow-sm">
                            <div class="flex items-center gap-2.5">
                                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-cyan-50 text-cyan-600">
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                </div>
                                <span class="text-xs font-bold text-slate-700">Database Obat & Medis</span>
                            </div>
                            <span class="text-[10px] font-bold text-cyan-600 bg-cyan-50 px-2 py-0.5 rounded-md">Tersinkron</span>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </main>

    {{-- =========================================================
         FOOTER
    ========================================================== --}}
    <footer class="border-t border-slate-200/60 bg-white/60 backdrop-blur-sm py-4 px-6">
        <div class="max-w-7xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-2 text-xs text-slate-500">
            <div class="flex items-center gap-2">
                <span class="font-bold text-slate-800">SIPOLI MQ</span>
                <span>•</span>
                <span>Pusat Layanan Kesehatan Terpadu</span>
            </div>
            <div>
                &copy; {{ date('Y') }} Hak Cipta Terpelihara • Madrasatul Qur an
            </div>
        </div>
    </footer>

</body>
</html>