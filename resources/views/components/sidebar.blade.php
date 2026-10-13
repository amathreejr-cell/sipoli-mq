<aside
    id="sidebar"
    class="fixed inset-y-0 left-0 z-40 w-64 bg-slate-900 text-white
           flex flex-col justify-between
           transition-transform duration-300
           -translate-x-full lg:translate-x-0
           lg:static lg:inset-0 shrink-0
           border-r border-slate-800">

    {{-- Logo --}}
    <div>

        <div class="h-20 px-6 flex items-center justify-between border-b border-slate-800/80">

            <div class="flex items-center gap-3">

                {{-- Icon --}}
                <div class="w-10 h-10 rounded-xl
                            bg-gradient-to-tr from-teal-600 to-cyan-500
                            p-2 flex items-center justify-center
                            shadow-lg shadow-teal-500/20">

                    <svg viewBox="0 0 100 100"
                         fill="none"
                         class="w-full h-full"
                         xmlns="http://www.w3.org/2000/svg">

                        <path
                            d="M35 12H65V35H88V65H65V88H35V65H12V35H35V12Z"
                            fill="white"
                            fill-opacity="0.22"
                            stroke="white"
                            stroke-width="6"
                            stroke-linejoin="round"/>

                        <path
                            d="M32 80C32 58 48 54 58 40C64 31 72 26 82 22"
                            stroke="white"
                            stroke-width="8"
                            stroke-linecap="round"/>

                        <path
                            d="M72 18L84 21L82 33"
                            stroke="white"
                            stroke-width="8"
                            stroke-linecap="round"
                            stroke-linejoin="round"/>

                    </svg>
                </div>

                {{-- Brand --}}
                <div>

                    <div class="flex items-center gap-1.5">
                        <span class="font-extrabold text-lg tracking-tight">
                            SIPOLI
                            <span class="text-teal-500">MQ</span>
                        </span>
                    </div>

                    <p class="text-[10px] text-slate-400 font-medium tracking-wide">
                        SISTEM INFORMASI POLIKLINIK
                    </p>

                </div>

            </div>

            {{-- Close Mobile --}}
            <button
                onclick="toggleSidebar()"
                class="lg:hidden text-slate-400 hover:text-white p-1">

                <i data-lucide="x" class="w-5 h-5"></i>

            </button>

        </div>


        {{-- Navigation --}}
        <nav class="px-4 py-6 space-y-1.5 overflow-y-auto max-h-[calc(100vh-190px)]">

            {{-- MENU UTAMA --}}
            <p class="px-3 text-[11px] font-bold text-slate-400
                      uppercase tracking-wider mb-2">
                Menu Utama
            </p>


            {{-- Dashboard --}}
            <a
                href="{{ route('dashboard') }}"
                class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl
                       bg-teal-600/20 text-teal-400
                       border border-teal-500/30
                       font-semibold text-sm transition">

                <i data-lucide="layout-dashboard" class="w-4 h-4"></i>

                <span>Dashboard</span>

            </a>


            {{-- Antrean --}}
            <a
                href="#queueSection"
                class="flex items-center justify-between
                       px-3.5 py-2.5 rounded-xl
                       text-slate-300
                       hover:bg-slate-800 hover:text-white
                       font-medium text-sm transition">

                <div class="flex items-center gap-3">

                    <i data-lucide="users-2"
                       class="w-4 h-4 text-slate-400"></i>

                    <span>Antrean Poliklinik</span>

                </div>

                <span
                    class="bg-teal-500/20 text-teal-300
                           text-[11px] px-2 py-0.5
                           rounded-full font-bold">

                    Live

                </span>

            </a>


            {{-- Pendaftaran --}}
            <a
                href="#"
                class="flex items-center gap-3
                       px-3.5 py-2.5 rounded-xl
                       text-slate-300
                       hover:bg-slate-800 hover:text-white
                       font-medium text-sm transition">

                <i data-lucide="user-plus"
                   class="w-4 h-4 text-slate-400"></i>

                <span>Pendaftaran Pasien</span>

            </a>


            {{-- Rekam Medis --}}
            <a
                href="#"
                class="flex items-center gap-3
                       px-3.5 py-2.5 rounded-xl
                       text-slate-300
                       hover:bg-slate-800 hover:text-white
                       font-medium text-sm transition">

                <i data-lucide="clipboard-list"
                   class="w-4 h-4 text-slate-400"></i>

                <span>Rekam Medis</span>

            </a>


            {{-- FASILITAS & DATA --}}
            <p
                class="px-3 text-[11px] font-bold text-slate-400
                       uppercase tracking-wider mt-6 mb-2">

                Fasilitas & Data

            </p>


            {{-- Dokter --}}
            <a
                href="#"
                class="flex items-center gap-3
                       px-3.5 py-2.5 rounded-xl
                       text-slate-300
                       hover:bg-slate-800 hover:text-white
                       font-medium text-sm transition">

                <i data-lucide="stethoscope"
                   class="w-4 h-4 text-slate-400"></i>

                <span>Jadwal Dokter</span>

            </a>


            {{-- Obat --}}
            <a
                href="#"
                class="flex items-center gap-3
                       px-3.5 py-2.5 rounded-xl
                       text-slate-300
                       hover:bg-slate-800 hover:text-white
                       font-medium text-sm transition">

                <i data-lucide="pill"
                   class="w-4 h-4 text-slate-400"></i>

                <span>Obat & Farmasi</span>

            </a>


            {{-- Laporan --}}
            <a
                href="#"
                class="flex items-center gap-3
                       px-3.5 py-2.5 rounded-xl
                       text-slate-300
                       hover:bg-slate-800 hover:text-white
                       font-medium text-sm transition">

                <i data-lucide="bar-chart-3"
                   class="w-4 h-4 text-slate-400"></i>

                <span>Laporan & Statistik</span>

            </a>


            {{-- Pengaturan --}}
            <a
                href="#"
                class="flex items-center gap-3
                       px-3.5 py-2.5 rounded-xl
                       text-slate-300
                       hover:bg-slate-800 hover:text-white
                       font-medium text-sm transition">

                <i data-lucide="settings"
                   class="w-4 h-4 text-slate-400"></i>

                <span>Pengaturan</span>

            </a>

        </nav>

    </div>


    {{-- USER --}}
    <div class="p-4 border-t border-slate-800/80 bg-slate-950/40">

        <div class="flex items-center gap-3">

            <div class="relative">

                <div
                    class="w-10 h-10 rounded-full
                           bg-teal-600 flex items-center justify-center
                           font-bold text-white">

                    {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}

                </div>

                <span
                    class="absolute bottom-0 right-0
                           w-2.5 h-2.5 rounded-full
                           bg-emerald-500
                           border-2 border-slate-900">
                </span>

            </div>


            <div class="flex-1 min-w-0">

                <p class="text-xs font-bold text-white truncate">

                    {{ auth()->user()->name ?? 'Pengguna' }}

                </p>

                <p class="text-[11px] text-slate-400 truncate">

                    {{ auth()->user()->role ?? 'Petugas' }}

                </p>

            </div>


            {{-- Logout --}}
            <form method="POST" action="{{ route('logout') }}">

                @csrf

                <button
                    type="submit"
                    title="Keluar Akun"
                    class="text-slate-400
                           hover:text-rose-400
                           transition p-1.5 rounded-lg
                           hover:bg-slate-800">

                    <i data-lucide="log-out"
                       class="w-4 h-4"></i>

                </button>

            </form>

        </div>

    </div>

</aside>


{{-- Mobile Overlay --}}
<div
    id="sidebarBackdrop"
    onclick="toggleSidebar()"
    class="fixed inset-0
           bg-slate-900/50 backdrop-blur-sm
           z-30 hidden lg:hidden">
</div>


{{-- Mobile Button --}}
<button
    onclick="toggleSidebar()"
    class="lg:hidden fixed top-4 left-4 z-50
           p-2.5 rounded-xl
           bg-slate-900 text-white
           shadow-lg">

    <i data-lucide="menu" class="w-5 h-5"></i>

</button>


<script>
    function toggleSidebar() {

        const sidebar = document.getElementById('sidebar');
        const backdrop = document.getElementById('sidebarBackdrop');

        sidebar.classList.toggle('-translate-x-full');
        backdrop.classList.toggle('hidden');

    }
</script>

<script>
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }
</script>