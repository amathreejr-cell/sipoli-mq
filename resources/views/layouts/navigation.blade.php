<!-- Mobile Overlay -->
<div x-show="sidebarOpen" x-transition.opacity @click="sidebarOpen = false"
    class="fixed inset-0 z-40 bg-slate-950/60 backdrop-blur-sm lg:hidden" style="display: none;"></div>

<!-- SIDEBAR -->
<aside
    class="fixed inset-y-0 left-0 z-50 flex w-64 flex-col border-r border-slate-800/80 bg-slate-900 text-slate-300 transition-transform duration-300 ease-in-out lg:translate-x-0"
    :class="sidebarOpen ? 'translate-x-0 shadow-2xl' : '-translate-x-full'">

    <!-- Brand Header -->
    <div class="flex h-20 shrink-0 items-center border-b border-slate-800/80 px-6">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3.5 min-w-0 group">
            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-gradient-to-tr from-teal-500 to-cyan-400 p-0.5 shadow-md shadow-teal-500/20 transition-transform group-hover:scale-105">
                <div class="flex h-full w-full items-center justify-center rounded-[14px] bg-white p-2">
                    <img src="{{ asset('images/logo-sipoli-1.png') }}" alt="SIPOLI MQ" class="h-full w-auto object-contain">
                </div>
            </div>
            <div class="min-w-0">
                <div class="flex items-center gap-1.5">
                    <span class="text-base font-extrabold tracking-tight text-white">SIPOLI</span>
                    <span class="text-base font-extrabold text-teal-400">MQ</span>
                    <span class="rounded bg-teal-500/10 px-1.5 py-0.5 text-[9px] font-bold text-teal-300 ring-1 ring-inset ring-teal-500/20">v1.0</span>
                </div>
                <p class="truncate text-[11px] font-medium text-slate-400">
                    Poliklinik Madrasatul Qur an
                </p>
            </div>
        </a>
    </div>

    <!-- Navigation Scroll Area -->
    <div class="flex-1 overflow-y-auto px-4 py-6 space-y-6 scrollbar-thin scrollbar-thumb-slate-800">

        <!-- MENU UTAMA -->
        <div>
            <p class="px-3 mb-2.5 text-[11px] font-bold uppercase tracking-wider text-slate-500">
                Pelayanan Klinis
            </p>

            <div class="space-y-1">
                <!-- Dashboard -->
                <a href="{{ route('dashboard') }}"
                    class="group relative flex items-center gap-3 rounded-xl px-3.5 py-2.5 text-sm font-semibold transition-all
                    {{ request()->routeIs('dashboard')
                        ? 'bg-gradient-to-r from-teal-500/20 to-cyan-500/10 text-teal-300 shadow-sm ring-1 ring-teal-500/30'
                        : 'text-slate-400 hover:bg-slate-800/60 hover:text-slate-200' }}">
                    <svg class="h-5 w-5 shrink-0 transition-colors {{ request()->routeIs('dashboard') ? 'text-teal-400' : 'text-slate-500 group-hover:text-slate-300' }}"
                        fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l9-9 9 9M5 10v10a1 1 0 001 1h4v-6h4v6h4a1 1 0 001-1V10" />
                    </svg>
                    <span>Dashboard</span>
                    @if (request()->routeIs('dashboard'))
                        <span class="ml-auto h-2 w-2 rounded-full bg-teal-400 shadow-[0_0_8px_rgba(45,212,191,0.8)]"></span>
                    @endif
                </a>

                <!-- Kunjungan -->
                <a href="{{ route('kunjungan.index') }}"
                    class="group relative flex items-center gap-3 rounded-xl px-3.5 py-2.5 text-sm font-semibold transition-all
                    {{ request()->routeIs('kunjungan.*')
                        ? 'bg-gradient-to-r from-teal-500/20 to-cyan-500/10 text-teal-300 shadow-sm ring-1 ring-teal-500/30'
                        : 'text-slate-400 hover:bg-slate-800/60 hover:text-slate-200' }}">
                    <svg class="h-5 w-5 shrink-0 transition-colors {{ request()->routeIs('kunjungan.*') ? 'text-teal-400' : 'text-slate-500 group-hover:text-slate-300' }}"
                        fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <rect x="3" y="4" width="18" height="18" rx="2"></rect>
                        <line x1="16" y1="2" x2="16" y2="6"></line>
                        <line x1="8" y1="2" x2="8" y2="6"></line>
                        <line x1="3" y1="10" x2="21" y2="10"></line>
                    </svg>
                    <span>Pendaftaran Kunjungan</span>
                    @if (request()->routeIs('kunjungan.*'))
                        <span class="ml-auto h-2 w-2 rounded-full bg-teal-400 shadow-[0_0_8px_rgba(45,212,191,0.8)]"></span>
                    @endif
                </a>

                <!-- Rekam Medis -->
                <a href="{{ route('rekam-medis.index') }}"
                    class="group relative flex items-center gap-3 rounded-xl px-3.5 py-2.5 text-sm font-semibold transition-all
                    {{ request()->routeIs('rekam-medis.*')
                        ? 'bg-gradient-to-r from-teal-500/20 to-cyan-500/10 text-teal-300 shadow-sm ring-1 ring-teal-500/30'
                        : 'text-slate-400 hover:bg-slate-800/60 hover:text-slate-200' }}">
                    <svg class="h-5 w-5 shrink-0 transition-colors {{ request()->routeIs('rekam-medis.*') ? 'text-teal-400' : 'text-slate-500 group-hover:text-slate-300' }}"
                        fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" />
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line x1="9" y1="13" x2="15" y2="13"></line>
                        <line x1="9" y1="17" x2="13" y2="17"></line>
                    </svg>
                    <span>Rekam Medis Santri</span>
                    @if (request()->routeIs('rekam-medis.*'))
                        <span class="ml-auto h-2 w-2 rounded-full bg-teal-400 shadow-[0_0_8px_rgba(45,212,191,0.8)]"></span>
                    @endif
                </a>
            </div>
        </div>

        <!-- LAPORAN & REKAP (COLLAPSIBLE) -->
        <div x-data="{ open: {{ request()->routeIs('laporan.*') ? 'true' : 'false' }} }">
            <p class="px-3 mb-2.5 text-[11px] font-bold uppercase tracking-wider text-slate-500">
                Laporan & Monitoring
            </p>

            <button type="button" @click="open = !open"
                class="group flex w-full items-center justify-between rounded-xl px-3.5 py-2.5 text-sm font-semibold transition-all
                {{ request()->routeIs('laporan.*')
                    ? 'bg-slate-800/80 text-teal-300'
                    : 'text-slate-400 hover:bg-slate-800/60 hover:text-slate-200' }}">
                <span class="flex items-center gap-3">
                    <svg class="h-5 w-5 shrink-0 transition-colors {{ request()->routeIs('laporan.*') ? 'text-teal-400' : 'text-slate-500 group-hover:text-slate-300' }}"
                        fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                    <span>Laporan Rekap</span>
                </span>
                <svg class="h-4 w-4 text-slate-500 transition-transform duration-200" :class="{ 'rotate-180 text-teal-400': open }"
                    fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m6 9 6 6 6-6" />
                </svg>
            </button>

            <!-- Submenu -->
            <div x-show="open" x-transition x-cloak class="mt-1 ml-4 space-y-1 border-l border-slate-800 pl-3">
                <a href="{{ route('laporan.index') }}"
                    class="flex items-center gap-2.5 rounded-lg px-3 py-2 text-xs font-semibold transition-colors
                    {{ request()->routeIs('laporan.index')
                        ? 'text-teal-300 font-bold bg-teal-500/10'
                        : 'text-slate-400 hover:text-white hover:bg-slate-800/40' }}">
                    <span class="h-1.5 w-1.5 rounded-full {{ request()->routeIs('laporan.index') ? 'bg-teal-400' : 'bg-slate-600' }}"></span>
                    <span>Laporan Pelayanan</span>
                </a>

                <a href="{{ route('laporan.stok-obat') }}"
                    class="flex items-center gap-2.5 rounded-lg px-3 py-2 text-xs font-semibold transition-colors
                    {{ request()->routeIs('laporan.stok-obat')
                        ? 'text-teal-300 font-bold bg-teal-500/10'
                        : 'text-slate-400 hover:text-white hover:bg-slate-800/40' }}">
                    <span class="h-1.5 w-1.5 rounded-full {{ request()->routeIs('laporan.stok-obat') ? 'bg-teal-400' : 'bg-slate-600' }}"></span>
                    <span>Laporan Stok Obat</span>
                </a>
            </div>
        </div>

        <!-- MASTER DATA -->
        <div>
            <p class="px-3 mb-2.5 text-[11px] font-bold uppercase tracking-wider text-slate-500">
                Master Data
            </p>

            <div class="space-y-1">
                <!-- Santri -->
                <a href="{{ route('santri.index') }}"
                    class="group flex items-center gap-3 rounded-xl px-3.5 py-2.5 text-sm font-semibold transition-all
                    {{ request()->routeIs('santri.*')
                        ? 'bg-gradient-to-r from-teal-500/20 to-cyan-500/10 text-teal-300 shadow-sm ring-1 ring-teal-500/30'
                        : 'text-slate-400 hover:bg-slate-800/60 hover:text-slate-200' }}">
                    <svg class="h-5 w-5 shrink-0 transition-colors {{ request()->routeIs('santri.*') ? 'text-teal-400' : 'text-slate-500 group-hover:text-slate-300' }}"
                        fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span>Data Santri</span>
                </a>

                <!-- Obat -->
                <a href="{{ route('obat.index') }}"
                    class="group flex items-center gap-3 rounded-xl px-3.5 py-2.5 text-sm font-semibold transition-all
                    {{ request()->routeIs('obat.*')
                        ? 'bg-gradient-to-r from-teal-500/20 to-cyan-500/10 text-teal-300 shadow-sm ring-1 ring-teal-500/30'
                        : 'text-slate-400 hover:bg-slate-800/60 hover:text-slate-200' }}">
                    <svg class="h-5 w-5 shrink-0 transition-colors {{ request()->routeIs('obat.*') ? 'text-teal-400' : 'text-slate-500 group-hover:text-slate-300' }}"
                        fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 14c0 1.1-.9 2-2 2H7c-1.1 0-2-.9-2-2V8c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2v6z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 11v6m-3-3h6" />
                    </svg>
                    <span>Data Obat</span>
                </a>

                <!-- Diagnosa -->
                <a href="{{ route('diagnosa.index') }}"
                    class="group flex items-center gap-3 rounded-xl px-3.5 py-2.5 text-sm font-semibold transition-all
                    {{ request()->routeIs('diagnosa.*')
                        ? 'bg-gradient-to-r from-teal-500/20 to-cyan-500/10 text-teal-300 shadow-sm ring-1 ring-teal-500/30'
                        : 'text-slate-400 hover:bg-slate-800/60 hover:text-slate-200' }}">
                    <svg class="h-5 w-5 shrink-0 transition-colors {{ request()->routeIs('diagnosa.*') ? 'text-teal-400' : 'text-slate-500 group-hover:text-slate-300' }}"
                        fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a3 3 0 006 0M9 13h6M9 17h4" />
                    </svg>
                    <span>Daftar Diagnosa</span>
                </a>

                <!-- Tindakan -->
                <a href="{{ route('tindakan.index') }}"
                    class="group flex items-center gap-3 rounded-xl px-3.5 py-2.5 text-sm font-semibold transition-all
                    {{ request()->routeIs('tindakan.*')
                        ? 'bg-gradient-to-r from-teal-500/20 to-cyan-500/10 text-teal-300 shadow-sm ring-1 ring-teal-500/30'
                        : 'text-slate-400 hover:bg-slate-800/60 hover:text-slate-200' }}">
                    <svg class="h-5 w-5 shrink-0 transition-colors {{ request()->routeIs('tindakan.*') ? 'text-teal-400' : 'text-slate-500 group-hover:text-slate-300' }}"
                        fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.7 6.3a4 4 0 00-5.4 5.4L4 17v3h3l5.3-5.3a4 4 0 005.4-5.4l-2.1 2.1-2.1-2.1 2.1-2.1z" />
                    </svg>
                    <span>Tindakan Medis</span>
                </a>

                <!-- Rujukan -->
                <a href="{{ route('master-rujukan.index') }}"
                    class="group flex items-center gap-3 rounded-xl px-3.5 py-2.5 text-sm font-semibold transition-all
                    {{ request()->routeIs('master-rujukan.*')
                        ? 'bg-gradient-to-r from-teal-500/20 to-cyan-500/10 text-teal-300 shadow-sm ring-1 ring-teal-500/30'
                        : 'text-slate-400 hover:bg-slate-800/60 hover:text-slate-200' }}">
                    <svg class="h-5 w-5 shrink-0 transition-colors {{ request()->routeIs('master-rujukan.*') ? 'text-teal-400' : 'text-slate-500 group-hover:text-slate-300' }}"
                        fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                    </svg>
                    <span>Faskes Rujukan</span>
                </a>
            </div>
        </div>

        <!-- PENGATURAN SISTEM (ADMIN KHUSUS) -->
        @if (auth()->user()->role === 'admin')
            <div>
                <p class="px-3 mb-2.5 text-[11px] font-bold uppercase tracking-wider text-slate-500">
                    Sistem & Hak Akses
                </p>

                <a href="{{ route('users.index') }}"
                    class="group flex items-center gap-3 rounded-xl px-3.5 py-2.5 text-sm font-semibold transition-all
                    {{ request()->routeIs('users.*')
                        ? 'bg-gradient-to-r from-teal-500/20 to-cyan-500/10 text-teal-300 shadow-sm ring-1 ring-teal-500/30'
                        : 'text-slate-400 hover:bg-slate-800/60 hover:text-slate-200' }}">
                    <svg class="h-5 w-5 shrink-0 transition-colors {{ request()->routeIs('users.*') ? 'text-teal-400' : 'text-slate-500 group-hover:text-slate-300' }}"
                        fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <circle cx="12" cy="12" r="3" />
                    </svg>
                    <span>Manajemen Pengguna</span>
                </a>
            </div>
        @endif

    </div>

    <!-- User Profile & Action Box -->
    <div class="border-t border-slate-800/80 p-4">
        <div class="rounded-2xl border border-slate-800 bg-slate-950/50 p-3.5 shadow-sm">
            <div class="flex items-center gap-3">
                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-gradient-to-tr from-teal-500 to-cyan-500 font-bold text-white shadow-sm shadow-teal-500/20">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div class="min-w-0 flex-1">
                    <p class="truncate text-xs font-bold text-white">
                        {{ Auth::user()->name }}
                    </p>
                    <div class="flex items-center gap-1.5">
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>
                        <p class="text-[10px] font-medium text-slate-400 uppercase tracking-wider">
                            {{ ucfirst(Auth::user()->role) }}
                        </p>
                    </div>
                </div>

                <!-- Profile Link -->
                <a href="{{ route('profile.edit') }}" title="Pengaturan Profil"
                    class="rounded-lg p-1.5 text-slate-400 transition hover:bg-slate-800 hover:text-white">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </a>

                <!-- Logout Button -->
                <form method="POST" action="{{ route('logout') }}" class="m-0">
                    @csrf
                    <button type="submit" title="Keluar dari Aplikasi"
                        class="rounded-lg p-1.5 text-slate-400 transition hover:bg-rose-500/10 hover:text-rose-400">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7M7 4v1a2 2 0 002 2h1M7 20h3a2 2 0 002-2v-1" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>

</aside>