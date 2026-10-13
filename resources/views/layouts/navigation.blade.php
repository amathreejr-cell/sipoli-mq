<!-- Mobile Overlay -->
<div x-show="sidebarOpen" x-transition.opacity @click="sidebarOpen = false"
    class="fixed inset-0 z-40 bg-slate-900/50 lg:hidden" style="display: none;"></div>


<!-- SIDEBAR -->
<aside
    class="fixed inset-y-0 left-0 z-50 w-64 bg-slate-900 text-white transform transition-transform duration-300 lg:translate-x-0"
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">

    <!-- Logo -->
    <div class="h-16 px-5 flex items-center border-b border-slate-800">

        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 min-w-0">

            <img src="{{ asset('images/logo-sipoli-1.png') }}" alt="SIPOLI-MQ" class="h-9 w-auto flex-shrink-0">

            <div class="min-w-0">

                <div class="text-sm font-bold tracking-wide">
                    SIPOLI-MQ
                </div>

                <div class="text-[10px] text-slate-400 truncate">
                    Poliklinik Madrasatul Qur'an
                </div>

            </div>

        </a>

    </div>


    <!-- Navigation Content -->
    <div class="h-[calc(100vh-4rem)] overflow-y-auto px-3 py-5">

        <!-- MENU UTAMA -->
        <div class="mb-6">

            <p class="px-3 mb-2 text-[10px] font-semibold uppercase tracking-wider text-slate-500">
                Menu Utama
            </p>


            <!-- Dashboard -->
            <a href="{{ route('dashboard') }}"
                class="flex items-center gap-3 px-3 py-2.5 mb-1 rounded-lg text-sm transition
                {{ request()->routeIs('dashboard')
                    ? 'bg-indigo-600 text-white shadow-sm'
                    : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">

                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                        d="M3 12l9-9 9 9M5 10v10a1 1 0 001 1h4v-6h4v6h4a1 1 0 001-1V10" />
                </svg>

                <span>Dashboard</span>

            </a>


            <!-- Santri -->
            <a href="{{ route('santri.index') }}"
                class="flex items-center gap-3 px-3 py-2.5 mb-1 rounded-lg text-sm transition
                {{ request()->routeIs('santri.*')
                    ? 'bg-indigo-600 text-white shadow-sm'
                    : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">

                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                        d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2M9 11a4 4 0 100-8 4 4 0 000 8zM22 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75" />
                </svg>

                <span>Santri</span>

            </a>


            <!-- Kunjungan -->
            <a href="{{ route('kunjungan.index') }}"
                class="flex items-center gap-3 px-3 py-2.5 mb-1 rounded-lg text-sm transition
                {{ request()->routeIs('kunjungan.*')
                    ? 'bg-indigo-600 text-white shadow-sm'
                    : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">

                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a3 3 0 006 0M9 5h6M9 13h6M9 17h4" />
                </svg>

                <span>Kunjungan</span>

            </a>


            <!-- Rekam Medis -->
            <a href="{{ route('rekam-medis.index') }}"
                class="flex items-center gap-3 px-3 py-2.5 mb-1 rounded-lg text-sm transition
                {{ request()->routeIs('rekam-medis.*')
                    ? 'bg-indigo-600 text-white shadow-sm'
                    : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">

                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                        d="M9 12h6M9 16h6M9 8h6M5 4h14a2 2 0 012 2v12a2 2 0 01-2 2H5a2 2 0 01-2-2V6a2 2 0 012-2z" />
                </svg>

                <span>Rekam Medis</span>

            </a>


            <!-- Laporan -->
            <a href="{{ route('laporan.index') }}"
                class="flex items-center gap-3 px-3 py-2.5 mb-1 rounded-lg text-sm transition
                {{ request()->routeIs('laporan.*')
                    ? 'bg-indigo-600 text-white shadow-sm'
                    : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">

                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                        d="M4 19V5M4 19h16M8 16v-5M12 16V8M16 16v-7M20 16V4" />
                </svg>

                <span>Laporan</span>

            </a>

        </div>


        <!-- DOKUMEN -->
        <div>

            <p class="px-3 mb-2 text-[10px] font-semibold uppercase tracking-wider text-slate-500">
                Dokumen
            </p>


            <!-- Obat -->
            <a href="{{ route('obat.index') }}"
                class="flex items-center gap-3 px-3 py-2.5 mb-1 rounded-lg text-sm transition
                {{ request()->routeIs('obat.*')
                    ? 'bg-indigo-600 text-white shadow-sm'
                    : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">

                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                        d="M9 3h6v18H9zM6 7h3M15 7h3M6 12h3M15 12h3M6 17h3M15 17h3" />
                </svg>

                <span>Obat</span>

            </a>


            <!-- Diagnosa -->
            <a href="{{ route('diagnosa.index') }}"
                class="flex items-center gap-3 px-3 py-2.5 mb-1 rounded-lg text-sm transition
                {{ request()->routeIs('diagnosa.*')
                    ? 'bg-indigo-600 text-white shadow-sm'
                    : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">

                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                        d="M9 3v2M15 3v2M4 9h16M5 6h14a1 1 0 011 1v12a1 1 0 01-1 1H5a1 1 0 01-1-1V7a1 1 0 011-1zM9 13h6M9 17h4" />
                </svg>

                <span>Diagnosa</span>

            </a>


            <!-- Tindakan -->
            <a href="{{ route('tindakan.index') }}"
                class="flex items-center gap-3 px-3 py-2.5 mb-1 rounded-lg text-sm transition
                {{ request()->routeIs('tindakan.*')
                    ? 'bg-indigo-600 text-white shadow-sm'
                    : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">

                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                        d="M14.7 6.3a4 4 0 00-5.4 5.4L4 17v3h3l5.3-5.3a4 4 0 005.4-5.4l-2.1 2.1-2.1-2.1 2.1-2.1z" />
                </svg>

                <span>Tindakan</span>

            </a>


            <!-- Rujukan -->
            <a href="{{ route('master-rujukan.index') }}"
                class="flex items-center gap-3 px-3 py-2.5 mb-1 rounded-lg text-sm transition
                {{ request()->routeIs('master-rujukan.*')
                    ? 'bg-indigo-600 text-white shadow-sm'
                    : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">

                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                        d="M12 21s8-4.5 8-10V5l-8-3-8 3v6c0 5.5-8 10-8 10zM9 12h6M12 9v6" />
                </svg>

                <span>Rujukan</span>

            </a>

        </div>

        <!-- USER MANAGEMENT -->
        @if (auth()->user()->role === 'admin')
            <div>

                <br>
                <p class="px-3 mb-2 text-[10px] font-semibold uppercase tracking-wider text-slate-500">
                    PENGATURAN
                </p>

                <a href="{{ route('users.index') }}"
                    class="flex items-center gap-3 px-3 py-2.5 mb-1 rounded-lg text-sm transition
                {{ request()->routeIs('users.*')
                    ? 'bg-indigo-600 text-white shadow-sm'
                    : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">

                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />

                    </svg>

                    <span>
                        Manajemen Pengguna
                    </span>

                </a>

            </div>
        @endif

        <!-- USER -->
        <div class="mt-8 pt-4 border-t border-slate-800">

            <div class="px-3 mb-3">

                <p class="text-sm font-medium text-white truncate">
                    {{ Auth::user()->name }}
                </p>

                <p class="text-xs text-slate-500 mt-0.5">
                    {{ ucfirst(Auth::user()->role) }}
                </p>

            </div>


            <!-- Profil -->
            <a href="{{ route('profile.edit') }}"
                class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-slate-300 hover:bg-slate-800 hover:text-white transition">

                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                        d="M12 12a4 4 0 100-8 4 4 0 000 8zM4 21a8 8 0 0116 0" />
                </svg>

                <span>Profil</span>

            </a>


            <!-- Logout -->
            <form method="POST" action="{{ route('logout') }}">

                @csrf

                <button type="submit"
                    class="w-full flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-slate-300 hover:bg-slate-800 hover:text-white transition">

                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                            d="M17 16l4-4m0 0l-4-4m4 4H7M7 4v1a2 2 0 002 2h1M7 20h3a2 2 0 002-2v-1" />
                    </svg>

                    <span>Keluar</span>

                </button>

            </form>

        </div>

    </div>

</aside>
