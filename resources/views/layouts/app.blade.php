<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SIPOLI MQ') }} | Layanan Kesehatan Santri</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * {
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="font-sans antialiased bg-slate-100/70 text-slate-800 selection:bg-teal-500 selection:text-white"
    x-data="{ sidebarOpen: false }">

    <!-- Sidebar Navigation Component -->
    @include('layouts.navigation')

    <!-- Main Application Wrapper (Menyesuaikan lebar sidebar w-72 -> lg:ml-72) -->
    <div class="min-h-screen flex flex-col transition-all duration-300 lg:ml-72">

        <!-- Top Header Navigation -->
        <header class="sticky top-0 z-30 h-20 bg-white/80 border-b border-slate-200/80 backdrop-blur-md">
            <div class="h-full px-4 sm:px-6 lg:px-8 flex items-center justify-between gap-4">

                <!-- Sisi Kiri: Tombol Menu Mobile & Konteks Halaman -->
                <div class="flex items-center gap-3">
                    <!-- Mobile Hamburger Button -->
                    <button type="button" @click="sidebarOpen = true"
                        class="lg:hidden inline-flex items-center justify-center w-10 h-10 rounded-xl text-slate-600 hover:text-teal-600 hover:bg-teal-50 transition border border-slate-200"
                        aria-label="Buka menu">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>

                    <!-- Konteks Instansi -->
                    <div class="hidden sm:block">
                        <div class="flex items-center gap-2">
                            <span class="text-xs font-bold text-slate-900 tracking-tight">SIPOLI <span
                                    class="text-teal-600">MQ</span></span>
                            <span class="h-1 w-1 rounded-full bg-slate-300"></span>
                            <p class="text-xs font-medium text-slate-500">
                                Poliklinik Madrasatul Qur an
                            </p>
                        </div>
                        <p class="text-[11px] text-slate-400">
                            Sistem Pelayanan Rekam Medis & Kesehatan Santri
                        </p>
                    </div>
                </div>

                <!-- Sisi Kanan: Realtime Clock & Widget Profil Pengguna -->
                <div class="flex items-center gap-3 sm:gap-5">

                    <!-- Jam & Tanggal Realtime (Alpine.js) -->
                    <div class="flex items-center gap-2.5 rounded-2xl border border-slate-200/80 bg-slate-50/80 px-3.5 py-1.5 shadow-sm"
                        x-data="{
                            time: '',
                            date: '',
                            updateClock() {
                                const now = new Date();
                                this.time = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' }).replace(/\./g, ':');
                                this.date = now.toLocaleDateString('id-ID', { weekday: 'short', day: 'numeric', month: 'short', year: 'numeric' });
                            }
                        }" x-init="updateClock();
                        setInterval(() => updateClock(), 1000)">

                        <div class="flex h-8 w-8 items-center justify-center rounded-xl bg-teal-50 text-teal-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                        </div>

                        <div class="text-left leading-tight">
                            <div class="flex items-center gap-1.5">
                                <span class="font-mono text-xs font-extrabold text-slate-800"
                                    x-text="time">--:--:--</span>
                                <span class="text-[10px] font-bold text-teal-600 bg-teal-50 px-1 rounded">WIB</span>
                            </div>
                            <p class="text-[10px] font-medium text-slate-400 mt-0.5 hidden xs:block" x-text="date">
                                Memuat tanggal...</p>
                        </div>
                    </div>

                    <!-- Pembatas Vertikal -->
                    <div class="h-8 w-px bg-slate-200 hidden sm:block"></div>

                    <!-- Dropdown Profil Pengguna -->
                    <div class="relative" x-data="{ openProfile: false }">

                        <!-- Tombol Pemicu Dropdown -->
                        <button type="button" @click="openProfile = !openProfile"
                            class="flex items-center gap-3 p-1 rounded-2xl transition hover:bg-slate-50 focus:outline-none group">

                            <div class="hidden md:block text-right">
                                <p
                                    class="text-xs font-bold text-slate-800 group-hover:text-teal-600 transition truncate max-w-[140px]">
                                    {{ Auth::user()->name }}
                                </p>
                                <span
                                    class="inline-block text-[10px] font-semibold text-teal-600 bg-teal-50 px-2 py-0.5 rounded-full mt-0.5">
                                    {{ ucfirst(Auth::user()->role) }}
                                </span>
                            </div>

                            <div class="relative">
                                <div
                                    class="w-10 h-10 rounded-2xl bg-gradient-to-tr from-teal-500 to-cyan-500 p-0.5 shadow-md shadow-teal-500/20 group-hover:scale-105 transition-transform">
                                    <div
                                        class="w-full h-full rounded-[14px] bg-white flex items-center justify-center font-bold text-teal-700 text-sm">
                                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                    </div>
                                </div>
                                <span
                                    class="absolute -bottom-0.5 -right-0.5 h-3 w-3 rounded-full border-2 border-white bg-emerald-500"></span>
                            </div>

                            <!-- Indikator Chevron -->
                            <svg class="h-4 w-4 text-slate-400 transition-transform duration-200 group-hover:text-slate-600 hidden sm:block"
                                :class="{ 'rotate-180 text-teal-600': openProfile }" fill="none"
                                stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m6 9 6 6 6-6" />
                            </svg>
                        </button>

                        <!-- Menu Dropdown -->
                        <div x-show="openProfile" x-cloak @click.outside="openProfile = false"
                            x-transition:enter="transition ease-out duration-150"
                            x-transition:enter-start="opacity-0 scale-95 -translate-y-1"
                            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-100"
                            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                            x-transition:leave-end="opacity-0 scale-95 -translate-y-1"
                            class="absolute right-0 mt-2 w-56 origin-top-right rounded-2xl border border-slate-200/80 bg-white p-1.5 shadow-xl shadow-slate-900/10 focus:outline-none z-50">

                            <!-- Info Pengguna di Dropdown (Tampil khusus mobile/layar kecil) -->
                            <div class="px-3 py-2.5 border-b border-slate-100 md:hidden">
                                <p class="text-xs font-bold text-slate-800 truncate">
                                    {{ Auth::user()->name }}
                                </p>
                                <p class="text-[10px] font-medium text-slate-400 mt-0.5">
                                    {{ ucfirst(Auth::user()->role) }}
                                </p>
                            </div>

                            <div class="py-1 space-y-0.5">
                                <!-- Opsi Edit Profil -->
                                <a href="{{ route('profile.edit') }}"
                                    class="flex items-center gap-2.5 rounded-xl px-3 py-2 text-xs font-semibold text-slate-700 transition hover:bg-teal-50 hover:text-teal-700 group">
                                    <div
                                        class="flex h-7 w-7 items-center justify-center rounded-lg bg-slate-100 text-slate-500 group-hover:bg-teal-100/60 group-hover:text-teal-700 transition-colors">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                    <span>Edit Profil</span>
                                </a>

                                <!-- Opsi Logout -->
                                <form method="POST" action="{{ route('logout') }}" class="m-0">
                                    @csrf
                                    <button type="submit"
                                        class="flex w-full items-center gap-2.5 rounded-xl px-3 py-2 text-xs font-semibold text-rose-600 transition hover:bg-rose-50 hover:text-rose-700 group">
                                        <div
                                            class="flex h-7 w-7 items-center justify-center rounded-lg bg-rose-50 text-rose-500 group-hover:bg-rose-100 transition-colors">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor"
                                                stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M17 16l4-4m0 0l-4-4m4 4H7M7 4v1a2 2 0 002 2h1M7 20h3a2 2 0 002-2v-1" />
                                            </svg>
                                        </div>
                                        <span>Keluar (Log Out)</span>
                                    </button>
                                </form>
                            </div>

                        </div>

                    </div>

                </div>

            </div>
        </header>

        <!-- Page Heading (Opsional jika view memiliki $header) -->
        @isset($header)
            <div class="bg-white border-b border-slate-200/80 shadow-xs">
                <div class="px-4 sm:px-6 lg:px-8 py-5">
                    {{ $header }}
                </div>
            </div>
        @endisset

        <!-- Page Content Area -->
        <main class="flex-1 p-4 sm:p-6 lg:p-8 max-w-7xl w-full mx-auto">

            <!-- Flash Alert: Success -->
            @if (session('success'))
                <div class="mb-6 flex items-center gap-3 rounded-2xl bg-emerald-50 border border-emerald-200/80 p-4 text-sm text-emerald-800 shadow-sm"
                    x-data="{ show: true }" x-show="show" x-transition>
                    <div
                        class="flex h-8 w-8 shrink-0 items-center justify-center rounded-xl bg-emerald-100 text-emerald-600">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.5"
                            viewBox="0 0 24 24">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                    </div>
                    <div class="flex-1 font-medium">
                        {{ session('success') }}
                    </div>
                    <button type="button" @click="show = false" class="text-emerald-500 hover:text-emerald-700">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path d="M18 6L6 18M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            @endif

            <!-- Flash Alert: Error -->
            @if (session('error'))
                <div class="mb-6 flex items-center gap-3 rounded-2xl bg-rose-50 border border-rose-200/80 p-4 text-sm text-rose-800 shadow-sm"
                    x-data="{ show: true }" x-show="show" x-transition>
                    <div
                        class="flex h-8 w-8 shrink-0 items-center justify-center rounded-xl bg-rose-100 text-rose-600">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.5"
                            viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="12" y1="8" x2="12" y2="12"></line>
                            <line x1="12" y1="16" x2="12.01" y2="16"></line>
                        </svg>
                    </div>
                    <div class="flex-1 font-medium">
                        {{ session('error') }}
                    </div>
                    <button type="button" @click="show = false" class="text-rose-500 hover:text-rose-700">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path d="M18 6L6 18M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            @endif

            <!-- Slot Konten Halaman -->
            {{ $slot }}

        </main>

        <!-- Global Dashboard Footer -->
        <footer class="mt-auto border-t border-slate-200/80 bg-white/60 py-4 px-6 text-center text-xs text-slate-400">
            &copy; {{ date('Y') }} SIPOLI MQ • Sistem Informasi Poliklinik Madrasatul Qur'an
        </footer>

    </div>

</body>

</html>
