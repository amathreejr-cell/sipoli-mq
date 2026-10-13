<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SIPOLI MQ - Dashboard Pelayanan Poliklinik Terpadu</title>

  <!-- Google Fonts: Plus Jakarta Sans -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Lucide Icons -->
  <script src="https://unpkg.com/lucide@latest"></script>

  <!-- Chart.js CDN -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <script>
    tailwind.config = {
      darkMode: 'class',
      theme: {
        extend: {
          fontFamily: {
            sans: ['"Plus Jakarta Sans"', 'system-ui', 'sans-serif'],
          },
          colors: {
            brand: {
              50: '#f0fdfa',
              100: '#ccfbf1',
              200: '#99f6e4',
              500: '#14b8a6',
              600: '#0d9488',
              700: '#0f766e',
              800: '#115e59',
              900: '#134e4a',
            },
            medical: {
              navy: '#0f172a',
              card: '#ffffff',
              slate: '#64748b'
            }
          },
          boxShadow: {
            'subtle': '0 4px 20px -2px rgba(15, 23, 42, 0.05), 0 2px 6px -2px rgba(15, 23, 42, 0.03)',
            'card-hover': '0 10px 25px -5px rgba(13, 148, 136, 0.12), 0 8px 10px -6px rgba(13, 148, 136, 0.08)',
          }
        }
      }
    }
  </script>

  <style>
    body {
      font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
    }
    /* Custom Scrollbar */
    ::-webkit-scrollbar {
      width: 6px;
      height: 6px;
    }
    ::-webkit-scrollbar-track {
      background: #f1f5f9;
    }
    ::-webkit-scrollbar-thumb {
      background: #cbd5e1;
      border-radius: 999px;
    }
    ::-webkit-scrollbar-thumb:hover {
      background: #94a3b8;
    }
    .badge-pulse {
      box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
      animation: pulse-ring 1.8s infinite;
    }
    @keyframes pulse-ring {
      0% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7); }
      70% { box-shadow: 0 0 0 6px rgba(16, 185, 129, 0); }
      100% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
    }
  </style>
</head>

<body class="bg-slate-50 text-slate-800 antialiased min-h-screen flex flex-col selection:bg-brand-500 selection:text-white">

  <div id="toastNotification" class="fixed top-5 right-5 z-50 transform transition-all duration-300 translate-y-[-140%] opacity-0 pointer-events-none flex items-center gap-3 bg-white border border-slate-200/90 shadow-2xl px-4 py-3 rounded-2xl max-w-md">
    <div id="toastIconContainer" class="w-9 h-9 rounded-xl flex items-center justify-center bg-teal-50 text-teal-600 shrink-0">
      <i data-lucide="bell" id="toastIcon" class="w-5 h-5"></i>
    </div>
    <div class="flex-1 text-sm">
      <p id="toastTitle" class="font-bold text-slate-800">Pemberitahuan</p>
      <p id="toastMessage" class="text-xs text-slate-500">Antrean dipanggil.</p>
    </div>
    <button onclick="dismissToast()" class="text-slate-400 hover:text-slate-600 p-1">
      <i data-lucide="x" class="w-4 h-4"></i>
    </button>
  </div>

  <!-- Layout Container -->
  <div class="flex h-screen overflow-hidden">

    <aside id="sidebar" class="fixed inset-y-0 left-0 z-40 w-64 bg-slate-900 text-white flex flex-col justify-between transition-transform duration-300 -translate-x-full lg:translate-x-0 lg:static lg:inset-0 shrink-0 border-r border-slate-800">
      
      <!-- Logo Header -->
      <div>
        <div class="h-20 px-6 flex items-center justify-between border-b border-slate-800/80">
          <div class="flex items-center gap-3">
            <!-- Brand SVG Vector Icon -->
            <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-brand-600 to-cyan-500 p-2 flex items-center justify-center shadow-lg shadow-teal-500/20">
              <svg viewBox="0 0 100 100" fill="none" class="w-full h-full stroke-current" xmlns="http://www.w3.org/2000/svg">
                <path d="M35 12H65V35H88V65H65V88H35V65H12V35H35V12Z" fill="white" fill-opacity="0.22" stroke="white" stroke-width="6" stroke-linejoin="round"/>
                <path d="M32 80C32 58 48 54 58 40C64 31 72 26 82 22" stroke="#FFFFFF" stroke-width="8" stroke-linecap="round"/>
                <path d="M72 18L84 21L82 33" stroke="#FFFFFF" stroke-width="8" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </div>
            <div>
              <div class="flex items-center gap-1.5">
                <span class="font-extrabold text-lg tracking-tight text-white leading-none">SIPOLI <span class="text-brand-500">MQ</span></span>
              </div>
              <p class="text-[10px] text-slate-400 font-medium tracking-wide">SISTEM INFORMASI POLIKLINIK</p>
            </div>
          </div>
          <!-- Close button on mobile -->
          <button onclick="toggleSidebar()" class="lg:hidden text-slate-400 hover:text-white p-1">
            <i data-lucide="x" class="w-5 h-5"></i>
          </button>
        </div>

        <!-- Navigation Menu -->
        <nav class="px-4 py-6 space-y-1.5 overflow-y-auto max-h-[calc(100vh-190px)]">
          <p class="px-3 text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-2">Menu Utama</p>
          
          <a href="#" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl bg-brand-600/20 text-brand-400 border border-brand-500/30 font-semibold text-sm transition">
            <i data-lucide="layout-dashboard" class="w-4 h-4"></i>
            <span>Dashboard Poli</span>
          </a>

          <a href="#queueSection" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-slate-300 hover:bg-slate-800 hover:text-white font-medium text-sm transition">
            <div class="flex items-center gap-3">
              <i data-lucide="users-2" class="w-4 h-4 text-slate-400"></i>
              <span>Antrean Poliklinik</span>
            </div>
            <span class="bg-brand-500/20 text-brand-300 text-[11px] px-2 py-0.5 rounded-full font-bold">Live</span>
          </a>

          <a href="javascript:void(0)" onclick="openNewPatientModal()" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-slate-300 hover:bg-slate-800 hover:text-white font-medium text-sm transition">
            <i data-lucide="user-plus" class="w-4 h-4 text-slate-400"></i>
            <span>Pendaftaran Pasien</span>
          </a>

          <a href="#patientListSection" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-slate-300 hover:bg-slate-800 hover:text-white font-medium text-sm transition">
            <i data-lucide="clipboard-list" class="w-4 h-4 text-slate-400"></i>
            <span>Rekam Medis (EMR)</span>
          </a>

          <p class="px-3 text-[11px] font-bold text-slate-400 uppercase tracking-wider mt-6 mb-2">Fasilitas & Data</p>

          <a href="#doctorSection" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-slate-300 hover:bg-slate-800 hover:text-white font-medium text-sm transition">
            <i data-lucide="stethoscope" class="w-4 h-4 text-slate-400"></i>
            <span>Jadwal Dokter Poli</span>
          </a>

          <a href="javascript:void(0)" onclick="showToast('Modul Farmasi', 'Modul depo e-resep farmasi siap terhubung.', 'info')" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-slate-300 hover:bg-slate-800 hover:text-white font-medium text-sm transition">
            <i data-lucide="pill" class="w-4 h-4 text-slate-400"></i>
            <span>Farmasi & Resep</span>
          </a>

          <a href="javascript:void(0)" onclick="showToast('Laporan Kunjungan', 'Mengunduh rekapitulasi data harian...', 'info')" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-slate-300 hover:bg-slate-800 hover:text-white font-medium text-sm transition">
            <i data-lucide="bar-chart-3" class="w-4 h-4 text-slate-400"></i>
            <span>Laporan & Statistik</span>
          </a>

          <a href="javascript:void(0)" onclick="showToast('Pengaturan', 'Fitur konfigurasi akses hak admin.', 'info')" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-slate-300 hover:bg-slate-800 hover:text-white font-medium text-sm transition">
            <i data-lucide="settings" class="w-4 h-4 text-slate-400"></i>
            <span>Pengaturan Sistem</span>
          </a>
        </nav>
      </div>

      <div class="p-4 border-t border-slate-800/80 bg-slate-950/40">
        <div class="flex items-center gap-3">
          <div class="relative">
            <img src="https://images.unsplash.com/photo-1622253692010-333f2da6031d?w=120&auto=format&fit=crop&q=80" alt="Avatar Dokter" class="w-10 h-10 rounded-full object-cover border-2 border-brand-500">
            <span class="absolute bottom-0 right-0 w-2.5 h-2.5 rounded-full bg-emerald-500 border-2 border-slate-900"></span>
          </div>
          <div class="flex-1 min-w-0">
            <p class="text-xs font-bold text-white truncate">dr. Rahmat Pratama, Sp.PD</p>
            <p class="text-[11px] text-slate-400 truncate">Dokter Penanggung Jawab</p>
          </div>
          <button onclick="window.location.href='index.html'" title="Keluar Akun" class="text-slate-400 hover:text-rose-400 transition p-1.5 rounded-lg hover:bg-slate-800">
            <i data-lucide="log-out" class="w-4 h-4"></i>
          </button>
        </div>
      </div>
    </aside>

    <!-- Overlay backdrop for mobile sidebar -->
    <div id="sidebarBackdrop" onclick="toggleSidebar()" class="fixed inset-0 bg-slate-900/50 backdrop-blur-xs z-30 hidden lg:hidden"></div>

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col min-w-0 overflow-y-auto">

      <header class="h-20 bg-white border-b border-slate-200/90 px-4 sm:px-8 flex items-center justify-between sticky top-0 z-20 shadow-xs">
        <div class="flex items-center gap-3">
          <button onclick="toggleSidebar()" class="lg:hidden p-2 rounded-xl text-slate-600 hover:bg-slate-100">
            <i data-lucide="menu" class="w-5 h-5"></i>
          </button>

          <!-- Search Pasien Input -->
          <div class="relative hidden sm:block w-72 md:w-80">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
              <i data-lucide="search" class="w-4 h-4"></i>
            </div>
            <input 
              type="text" 
              id="globalSearchInput" 
              oninput="handleGlobalSearch(this.value)"
              placeholder="Cari pasien (Nama, No. RM, NIK)..." 
              class="w-full pl-9 pr-4 py-2 text-xs rounded-xl bg-slate-50 border border-slate-200 focus:bg-white focus:border-brand-500 focus:ring-3 focus:ring-brand-500/15 outline-none transition"
            >
          </div>
        </div>

        <div class="flex items-center gap-3 sm:gap-4">
          <!-- Realtime Date & Clock Badge -->
          <div class="hidden md:flex items-center gap-2 px-3 py-1.5 rounded-xl bg-slate-100 border border-slate-200 text-xs font-medium text-slate-700">
            <i data-lucide="calendar" class="w-3.5 h-3.5 text-brand-600"></i>
            <span id="currentDateDisplay">Memuat tanggal...</span>
            <span class="text-slate-300">|</span>
            <i data-lucide="clock" class="w-3.5 h-3.5 text-brand-600"></i>
            <span id="currentTimeDisplay" class="font-mono font-bold text-slate-900">00:00:00 WIB</span>
          </div>

          <!-- Quick Action Buttons -->
          <button onclick="callNextDirectly()" class="flex items-center gap-2 px-3.5 py-2 rounded-xl bg-slate-900 hover:bg-slate-800 active:scale-98 text-white text-xs font-semibold shadow transition">
            <i data-lucide="volume-2" class="w-3.5 h-3.5 text-teal-400"></i>
            <span class="hidden sm:inline">Panggil Berikutnya</span>
          </button>

          <button onclick="openNewPatientModal()" class="flex items-center gap-2 px-3.5 py-2 rounded-xl bg-gradient-to-r from-brand-600 to-cyan-600 hover:from-brand-700 hover:to-cyan-700 active:scale-98 text-white text-xs font-semibold shadow-md shadow-teal-500/20 transition">
            <i data-lucide="plus" class="w-3.5 h-3.5"></i>
            <span>+ Pasien Baru</span>
          </button>

          <!-- Notification Bell -->
          <div class="relative">
            <button onclick="toggleNotifDropdown()" class="w-9 h-9 rounded-xl border border-slate-200 flex items-center justify-center text-slate-600 hover:bg-slate-100 transition relative">
              <i data-lucide="bell" class="w-4 h-4"></i>
              <span class="absolute top-1.5 right-1.5 w-2 h-2 rounded-full bg-rose-500 badge-pulse"></span>
            </button>
            <!-- Dropdown Mock -->
            <div id="notifDropdown" class="hidden absolute right-0 mt-2 w-72 bg-white rounded-2xl shadow-xl border border-slate-200/90 py-2 z-30">
              <div class="px-4 py-2 border-b border-slate-100 flex items-center justify-between">
                <span class="text-xs font-bold text-slate-800">Notifikasi Pelayanan</span>
                <span class="text-[10px] text-teal-600 font-semibold bg-teal-50 px-2 py-0.5 rounded">2 Baru</span>
              </div>
              <div class="divide-y divide-slate-100 text-xs text-slate-600">
                <div class="px-4 py-2.5 hover:bg-slate-50 cursor-pointer">
                  <p class="font-semibold text-slate-800">Resep Farmasi Siap</p>
                  <p class="text-[11px] text-slate-500">Pasien Ny. Siti Aminah siap pengambilan obat di loket.</p>
                </div>
                <div class="px-4 py-2.5 hover:bg-slate-50 cursor-pointer">
                  <p class="font-semibold text-slate-800">Konsul Dokter Gigi</p>
                  <p class="text-[11px] text-slate-500">Poli Gigi memulai sesi antrean B-009.</p>
                </div>
              </div>
            </div>
          </div>

        </div>
      </header>

      <main class="flex-1 p-4 sm:p-6 lg:p-8 space-y-6 max-w-7xl mx-auto w-full">
        
        <!-- Poliklinik Operational Status Strip -->
        <div class="bg-white rounded-2xl p-4 border border-slate-200/80 shadow-subtle flex flex-col md:flex-row md:items-center justify-between gap-4">
          <div class="flex items-center gap-3">
            <span class="w-3 h-3 rounded-full bg-emerald-500 badge-pulse shrink-0"></span>
            <div>
              <p class="text-xs font-bold text-slate-900 uppercase tracking-wider">Status Poliklinik MQ Aktif</p>
              <p class="text-xs text-slate-500">Semua ruang periksa terkoneksi dengan Sistem SatuSehat Kemenkes RI.</p>
            </div>
          </div>
          <div class="flex flex-wrap items-center gap-2 text-xs">
            <span class="px-3 py-1 bg-teal-50 border border-teal-200 text-teal-700 rounded-lg font-medium flex items-center gap-1.5">
              <span class="w-1.5 h-1.5 rounded-full bg-teal-500"></span> Poli Umum: Buka
            </span>
            <span class="px-3 py-1 bg-cyan-50 border border-cyan-200 text-cyan-700 rounded-lg font-medium flex items-center gap-1.5">
              <span class="w-1.5 h-1.5 rounded-full bg-cyan-500"></span> Poli Gigi: Buka
            </span>
            <span class="px-3 py-1 bg-indigo-50 border border-indigo-200 text-indigo-700 rounded-lg font-medium flex items-center gap-1.5">
              <span class="w-1.5 h-1.5 rounded-full bg-indigo-500"></span> Poli Anak: Buka
            </span>
            <span class="px-3 py-1 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-lg font-medium flex items-center gap-1.5">
              <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Penyakit Dalam: Buka
            </span>
          </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
          
          <!-- KPI 1 -->
          <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-subtle hover:shadow-card-hover transition">
            <div class="flex items-center justify-between">
              <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Total Pasien Hari Ini</span>
              <div class="w-10 h-10 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center">
                <i data-lucide="users" class="w-5 h-5"></i>
              </div>
            </div>
            <div class="mt-4 flex items-baseline justify-between">
              <span id="kpiTotalPasien" class="text-3xl font-extrabold text-slate-900 tracking-tight">48</span>
              <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-md flex items-center gap-0.5">
                <i data-lucide="trending-up" class="w-3 h-3"></i> +14.2%
              </span>
            </div>
            <p class="mt-1 text-xs text-slate-400">Dibandingkan kemarin (42 pasien)</p>
          </div>

          <!-- KPI 2 -->
          <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-subtle hover:shadow-card-hover transition">
            <div class="flex items-center justify-between">
              <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Sedang Diperiksa</span>
              <div class="w-10 h-10 rounded-xl bg-cyan-50 text-cyan-600 flex items-center justify-center">
                <i data-lucide="activity" class="w-5 h-5"></i>
              </div>
            </div>
            <div class="mt-4 flex items-baseline justify-between">
              <span id="kpiSedangPeriksa" class="text-3xl font-extrabold text-slate-900 tracking-tight">4</span>
              <span class="text-xs font-medium text-cyan-600 bg-cyan-50 px-2 py-0.5 rounded-md">
                4 Poli Aktif
              </span>
            </div>
            <p class="mt-1 text-xs text-slate-400">Sedang konsultasi tatap muka</p>
          </div>

          <!-- KPI 3 -->
          <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-subtle hover:shadow-card-hover transition">
            <div class="flex items-center justify-between">
              <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Menunggu di Ruang Tunggu</span>
              <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center">
                <i data-lucide="clock-4" class="w-5 h-5"></i>
              </div>
            </div>
            <div class="mt-4 flex items-baseline justify-between">
              <span id="kpiAntreanMenunggu" class="text-3xl font-extrabold text-amber-600 tracking-tight">7</span>
              <span class="text-xs font-medium text-slate-500 bg-slate-100 px-2 py-0.5 rounded-md">
                Est. 12 Menit/Poli
              </span>
            </div>
            <p class="mt-1 text-xs text-slate-400">Menunggu panggilan antrean</p>
          </div>

          <!-- KPI 4 -->
          <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-subtle hover:shadow-card-hover transition">
            <div class="flex items-center justify-between">
              <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Resep E-Farmasi</span>
              <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center">
                <i data-lucide="pill" class="w-5 h-5"></i>
              </div>
            </div>
            <div class="mt-4 flex items-baseline justify-between">
              <span id="kpiFarmasiProses" class="text-3xl font-extrabold text-slate-900 tracking-tight">29</span>
              <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-md">
                25 Selesai
              </span>
            </div>
            <p class="mt-1 text-xs text-slate-400">4 resep sedang diracik</p>
          </div>

        </div>

        <section id="queueSection" class="bg-white rounded-3xl p-5 sm:p-6 border border-slate-200/80 shadow-subtle">
          <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-5 border-b border-slate-100 gap-2">
            <div>
              <div class="flex items-center gap-2">
                <h2 class="text-lg font-bold text-slate-900">Panggilan Antrean Real-time (Live Queue Board)</h2>
                <span class="w-2 h-2 rounded-full bg-emerald-500 badge-pulse"></span>
              </div>
              <p class="text-xs text-slate-500">Monitor dan kendalikan pemanggilan pasien pada masing-masing ruang poliklinik.</p>
            </div>
            <div class="flex items-center gap-2">
              <button onclick="testChimeSound()" class="text-xs px-3 py-1.5 rounded-xl border border-slate-200 hover:bg-slate-50 text-slate-600 flex items-center gap-1.5 transition">
                <i data-lucide="volume" class="w-3.5 h-3.5"></i>
                <span>Cek Suara Bell</span>
              </button>
            </div>
          </div>

          <!-- Queue Unit Cards Grid -->
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mt-5">
            
            <!-- Poli Umum -->
            <div class="p-4 rounded-2xl border border-teal-200/80 bg-gradient-to-b from-teal-50/40 to-white relative overflow-hidden flex flex-col justify-between">
              <div>
                <div class="flex items-center justify-between text-xs mb-2">
                  <span class="font-bold text-teal-800">POLI UMUM</span>
                  <span class="px-2 py-0.5 bg-teal-100 text-teal-800 rounded font-semibold text-[10px]">Ruang 01</span>
                </div>
                <div class="text-center py-3">
                  <span class="text-[10px] text-slate-400 font-semibold uppercase tracking-wider">Antrean Saat Ini</span>
                  <p id="queueNumUmum" class="text-4xl font-extrabold text-teal-600 tracking-tight font-mono mt-0.5">A-014</p>
                  <p id="patientNameUmum" class="text-xs font-semibold text-slate-800 mt-1 truncate">Ahmad Fauzi (Umum)</p>
                </div>
              </div>
              <div class="mt-3 grid grid-cols-2 gap-2">
                <button onclick="callQueue('A-014', 'Poli Umum', 'Ahmad Fauzi')" class="py-2 px-2.5 rounded-xl bg-teal-600 hover:bg-teal-700 text-white text-xs font-semibold flex items-center justify-center gap-1 shadow-sm transition">
                  <i data-lucide="volume-2" class="w-3.5 h-3.5"></i> Panggil
                </button>
                <button onclick="nextQueue('Umum')" class="py-2 px-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold flex items-center justify-center gap-1 transition">
                  Lanjut <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                </button>
              </div>
            </div>

            <!-- Poli Gigi -->
            <div class="p-4 rounded-2xl border border-cyan-200/80 bg-gradient-to-b from-cyan-50/40 to-white relative overflow-hidden flex flex-col justify-between">
              <div>
                <div class="flex items-center justify-between text-xs mb-2">
                  <span class="font-bold text-cyan-800">POLI GIGI & MULUT</span>
                  <span class="px-2 py-0.5 bg-cyan-100 text-cyan-800 rounded font-semibold text-[10px]">Ruang 02</span>
                </div>
                <div class="text-center py-3">
                  <span class="text-[10px] text-slate-400 font-semibold uppercase tracking-wider">Antrean Saat Ini</span>
                  <p id="queueNumGigi" class="text-4xl font-extrabold text-cyan-600 tracking-tight font-mono mt-0.5">B-008</p>
                  <p id="patientNameGigi" class="text-xs font-semibold text-slate-800 mt-1 truncate">Kartika Wulandari</p>
                </div>
              </div>
              <div class="mt-3 grid grid-cols-2 gap-2">
                <button onclick="callQueue('B-008', 'Poli Gigi', 'Kartika Wulandari')" class="py-2 px-2.5 rounded-xl bg-cyan-600 hover:bg-cyan-700 text-white text-xs font-semibold flex items-center justify-center gap-1 shadow-sm transition">
                  <i data-lucide="volume-2" class="w-3.5 h-3.5"></i> Panggil
                </button>
                <button onclick="nextQueue('Gigi')" class="py-2 px-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold flex items-center justify-center gap-1 transition">
                  Lanjut <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                </button>
              </div>
            </div>

            <!-- Poli Penyakit Dalam -->
            <div class="p-4 rounded-2xl border border-emerald-200/80 bg-gradient-to-b from-emerald-50/40 to-white relative overflow-hidden flex flex-col justify-between">
              <div>
                <div class="flex items-center justify-between text-xs mb-2">
                  <span class="font-bold text-emerald-800">PENYAKIT DALAM</span>
                  <span class="px-2 py-0.5 bg-emerald-100 text-emerald-800 rounded font-semibold text-[10px]">Ruang 03</span>
                </div>
                <div class="text-center py-3">
                  <span class="text-[10px] text-slate-400 font-semibold uppercase tracking-wider">Antrean Saat Ini</span>
                  <p id="queueNumDalam" class="text-4xl font-extrabold text-emerald-600 tracking-tight font-mono mt-0.5">C-005</p>
                  <p id="patientNameDalam" class="text-xs font-semibold text-slate-800 mt-1 truncate">H. Bambang Soetrisno</p>
                </div>
              </div>
              <div class="mt-3 grid grid-cols-2 gap-2">
                <button onclick="callQueue('C-005', 'Poli Penyakit Dalam', 'H. Bambang Soetrisno')" class="py-2 px-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-semibold flex items-center justify-center gap-1 shadow-sm transition">
                  <i data-lucide="volume-2" class="w-3.5 h-3.5"></i> Panggil
                </button>
                <button onclick="nextQueue('Dalam')" class="py-2 px-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold flex items-center justify-center gap-1 transition">
                  Lanjut <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                </button>
              </div>
            </div>

            <!-- Poli Anak (KIA) -->
            <div class="p-4 rounded-2xl border border-indigo-200/80 bg-gradient-to-b from-indigo-50/40 to-white relative overflow-hidden flex flex-col justify-between">
              <div>
                <div class="flex items-center justify-between text-xs mb-2">
                  <span class="font-bold text-indigo-800">POLI ANAK & KIA</span>
                  <span class="px-2 py-0.5 bg-indigo-100 text-indigo-800 rounded font-semibold text-[10px]">Ruang 04</span>
                </div>
                <div class="text-center py-3">
                  <span class="text-[10px] text-slate-400 font-semibold uppercase tracking-wider">Antrean Saat Ini</span>
                  <p id="queueNumAnak" class="text-4xl font-extrabold text-indigo-600 tracking-tight font-mono mt-0.5">D-003</p>
                  <p id="patientNameAnak" class="text-xs font-semibold text-slate-800 mt-1 truncate">Ananda Kinan (BPJS)</p>
                </div>
              </div>
              <div class="mt-3 grid grid-cols-2 gap-2">
                <button onclick="callQueue('D-003', 'Poli Anak & KIA', 'Ananda Kinan')" class="py-2 px-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold flex items-center justify-center gap-1 shadow-sm transition">
                  <i data-lucide="volume-2" class="w-3.5 h-3.5"></i> Panggil
                </button>
                <button onclick="nextQueue('Anak')" class="py-2 px-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold flex items-center justify-center gap-1 transition">
                  Lanjut <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                </button>
              </div>
            </div>

          </div>
        </section>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
          
          <!-- Chart Widget -->
          <div class="lg:col-span-8 bg-white p-5 sm:p-6 rounded-3xl border border-slate-200/80 shadow-subtle">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-4 border-b border-slate-100 gap-2">
              <div>
                <h3 class="text-base font-bold text-slate-900">Tren Kunjungan Pasien per Jam</h3>
                <p class="text-xs text-slate-500">Monitoring kepadatan poli untuk antisipasi lonjakan pendaftaran.</p>
              </div>
              <div class="flex items-center gap-2">
                <span class="text-xs font-semibold px-2.5 py-1 rounded-lg bg-slate-100 text-slate-700">Hari Ini: Senin</span>
              </div>
            </div>
            <div class="h-64 sm:h-72 mt-4 relative">
              <canvas id="patientTrendChart"></canvas>
            </div>
          </div>

          <!-- Doctor On-Duty Widget -->
          <div id="doctorSection" class="lg:col-span-4 bg-white p-5 sm:p-6 rounded-3xl border border-slate-200/80 shadow-subtle flex flex-col justify-between">
            <div>
              <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                <h3 class="text-base font-bold text-slate-900">Ketersediaan Dokter</h3>
                <span class="text-[11px] font-bold text-brand-700 bg-brand-50 px-2 py-0.5 rounded">4 Dokter Aktif</span>
              </div>

              <div class="mt-4 space-y-3.5">
                
                <div class="flex items-center justify-between p-2.5 rounded-xl bg-slate-50 border border-slate-100">
                  <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-full bg-teal-100 text-teal-700 font-bold flex items-center justify-center text-xs">
                      RP
                    </div>
                    <div>
                      <p class="text-xs font-bold text-slate-800">dr. Rahmat Pratama, Sp.PD</p>
                      <p class="text-[11px] text-slate-500">Penyakit Dalam (Ruang 03)</p>
                    </div>
                  </div>
                  <span class="px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-700 text-[10px] font-bold">Praktek</span>
                </div>

                <div class="flex items-center justify-between p-2.5 rounded-xl bg-slate-50 border border-slate-100">
                  <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-full bg-cyan-100 text-cyan-700 font-bold flex items-center justify-center text-xs">
                      SF
                    </div>
                    <div>
                      <p class="text-xs font-bold text-slate-800">drg. Siti Fadhilah</p>
                      <p class="text-[11px] text-slate-500">Poli Gigi (Ruang 02)</p>
                    </div>
                  </div>
                  <span class="px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-700 text-[10px] font-bold">Praktek</span>
                </div>

                <div class="flex items-center justify-between p-2.5 rounded-xl bg-slate-50 border border-slate-100">
                  <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-full bg-indigo-100 text-indigo-700 font-bold flex items-center justify-center text-xs">
                      AH
                    </div>
                    <div>
                      <p class="text-xs font-bold text-slate-800">dr. Arif Hidayat</p>
                      <p class="text-[11px] text-slate-500">Poli Umum (Ruang 01)</p>
                    </div>
                  </div>
                  <span class="px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-700 text-[10px] font-bold">Praktek</span>
                </div>

                <div class="flex items-center justify-between p-2.5 rounded-xl bg-slate-50 border border-slate-100">
                  <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-full bg-amber-100 text-amber-700 font-bold flex items-center justify-center text-xs">
                      NN
                    </div>
                    <div>
                      <p class="text-xs font-bold text-slate-800">dr. Nurul Nisa, Sp.A</p>
                      <p class="text-[11px] text-slate-500">Poli Anak & KIA (Ruang 04)</p>
                    </div>
                  </div>
                  <span class="px-2 py-0.5 rounded-full bg-amber-100 text-amber-700 text-[10px] font-bold">Istirahat</span>
                </div>

              </div>
            </div>

            <div class="mt-4 pt-3 border-t border-slate-100 text-center">
              <a href="javascript:void(0)" onclick="showToast('Jadwal Dokter', 'Membuka seluruh roster dokter poliklinik.', 'info')" class="text-xs font-semibold text-brand-600 hover:text-brand-700">
                Lihat Jadwal Lengkap Minggu Ini &rarr;
              </a>
            </div>
          </div>

        </div>

        <section id="patientListSection" class="bg-white rounded-3xl border border-slate-200/80 shadow-subtle overflow-hidden">
          
          <!-- Table Header Controls -->
          <div class="p-5 sm:p-6 border-b border-slate-100 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
              <h2 class="text-lg font-bold text-slate-900">Daftar Pasien & Rekam Medis (EMR) Hari Ini</h2>
              <p class="text-xs text-slate-500">Klik "Periksa / EMR" untuk membuka rekam medis, anamnesis klinis, dan e-resep pasien.</p>
            </div>

            <!-- Filter Tabs & Local Search -->
            <div class="flex flex-wrap items-center gap-3">
              <!-- Filter Buttons -->
              <div class="flex p-1 bg-slate-100 rounded-xl text-xs font-semibold">
                <button onclick="filterPatientTable('ALL')" id="filterBtn-ALL" class="filter-tab-btn active px-3 py-1.5 rounded-lg bg-white shadow-xs text-teal-800 transition">Semua</button>
                <button onclick="filterPatientTable('MENUNGGU')" id="filterBtn-MENUNGGU" class="filter-tab-btn px-3 py-1.5 rounded-lg text-slate-600 hover:text-slate-900 transition">Menunggu</button>
                <button onclick="filterPatientTable('PERIKSA')" id="filterBtn-PERIKSA" class="filter-tab-btn px-3 py-1.5 rounded-lg text-slate-600 hover:text-slate-900 transition">Sedang Periksa</button>
                <button onclick="filterPatientTable('SELESAI')" id="filterBtn-SELESAI" class="filter-tab-btn px-3 py-1.5 rounded-lg text-slate-600 hover:text-slate-900 transition">Selesai</button>
              </div>

              <!-- Quick Table Search -->
              <div class="relative w-48">
                <input 
                  type="text" 
                  id="tableSearchInput" 
                  oninput="handleTableSearch(this.value)"
                  placeholder="Filter nama/RM..." 
                  class="w-full pl-8 pr-3 py-1.5 text-xs rounded-xl bg-slate-50 border border-slate-200 focus:bg-white focus:border-brand-500 outline-none transition"
                >
                <i data-lucide="search" class="w-3.5 h-3.5 absolute left-2.5 top-2.5 text-slate-400"></i>
              </div>
            </div>
          </div>

          <!-- Table Container -->
          <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
              <thead class="bg-slate-50/75 border-b border-slate-100 text-slate-500 uppercase tracking-wider font-semibold">
                <tr>
                  <th class="px-5 py-3.5">No. Antrean</th>
                  <th class="px-5 py-3.5">No. RM & Nama Pasien</th>
                  <th class="px-5 py-3.5">Poli Tujuan</th>
                  <th class="px-5 py-3.5">Dokter Pemeriksa</th>
                  <th class="px-5 py-3.5">Penjamin</th>
                  <th class="px-5 py-3.5">Status</th>
                  <th class="px-5 py-3.5 text-right">Tindakan</th>
                </tr>
              </thead>
              <tbody id="patientTableBody" class="divide-y divide-slate-100 font-medium text-slate-700">
                <!-- Dynamically Rendered via JS -->
              </tbody>
            </table>
          </div>

          <!-- Table Footer Pagination Mock -->
          <div class="p-4 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
            <span id="showingEntriesText">Menampilkan 5 dari 5 antrean terdaftar</span>
            <div class="flex items-center gap-1">
              <button class="px-2.5 py-1 rounded-lg border border-slate-200 hover:bg-slate-50 text-slate-600">Sebelumnya</button>
              <button class="px-2.5 py-1 rounded-lg bg-teal-600 text-white font-bold">1</button>
              <button class="px-2.5 py-1 rounded-lg border border-slate-200 hover:bg-slate-50 text-slate-600">2</button>
              <button class="px-2.5 py-1 rounded-lg border border-slate-200 hover:bg-slate-50 text-slate-600">Selanjutnya</button>
            </div>
          </div>

        </section>

      </main>

      <footer class="bg-white border-t border-slate-200/80 py-4 px-6 sm:px-8 text-xs text-slate-500 flex flex-col sm:flex-row items-center justify-between gap-2 mt-8">
        <div class="flex items-center gap-2">
          <span class="font-bold text-slate-700">SIPOLI MQ</span>
          <span>•</span>
          <span>Sistem Informasi Poliklinik Terintegrasi SatuSehat</span>
        </div>
        <p>&copy; 2026 SIPOLI MQ v2.4. Seluruh Hak Cipta Dilindungi.</p>
      </footer>

    </div>

  </div>

  <div id="emrModal" class="fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-xs hidden items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-2xl w-full shadow-2xl border border-slate-100 overflow-hidden flex flex-col max-h-[92vh]">
      
      <!-- Modal Header -->
      <div class="p-5 border-b border-slate-100 bg-slate-50/60 flex items-center justify-between">
        <div class="flex items-center gap-3">
          <div class="w-10 h-10 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center">
            <i data-lucide="file-medical" class="w-5 h-5"></i>
          </div>
          <div>
            <h3 class="text-base font-bold text-slate-900 flex items-center gap-2">
              <span id="emrModalPatientName">Nama Pasien</span>
              <span id="emrModalPatientRM" class="text-xs font-mono font-normal text-slate-500 bg-white px-2 py-0.5 rounded border border-slate-200">RM-000</span>
            </h3>
            <p id="emrModalPoliInfo" class="text-xs text-slate-500">Poli Penyakit Dalam - dr. Rahmat Pratama, Sp.PD</p>
          </div>
        </div>
        <button onclick="closeEmrModal()" class="text-slate-400 hover:text-slate-600 p-1 rounded-lg">
          <i data-lucide="x" class="w-5 h-5"></i>
        </button>
      </div>

      <!-- Modal Body (EMR Form) -->
      <div class="p-6 overflow-y-auto space-y-5 text-xs">
        
        <!-- Vital Signs Strip -->
        <div class="bg-teal-50/60 rounded-2xl p-4 border border-teal-100">
          <p class="font-bold text-teal-900 uppercase tracking-wider text-[11px] mb-3">Tanda-Tanda Vital (TTV)</p>
          <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
            <div class="bg-white p-2.5 rounded-xl border border-teal-200/60">
              <span class="text-slate-400 block text-[10px]">Tekanan Darah</span>
              <input type="text" id="emrTensi" value="120/80 mmHg" class="font-bold text-slate-800 w-full outline-none mt-0.5">
            </div>
            <div class="bg-white p-2.5 rounded-xl border border-teal-200/60">
              <span class="text-slate-400 block text-[10px]">Suhu Badan</span>
              <input type="text" id="emrSuhu" value="36.8 °C" class="font-bold text-slate-800 w-full outline-none mt-0.5">
            </div>
            <div class="bg-white p-2.5 rounded-xl border border-teal-200/60">
              <span class="text-slate-400 block text-[10px]">Detak Nadi</span>
              <input type="text" id="emrNadi" value="78 x/mnt" class="font-bold text-slate-800 w-full outline-none mt-0.5">
            </div>
            <div class="bg-white p-2.5 rounded-xl border border-teal-200/60">
              <span class="text-slate-400 block text-[10px]">Berat Badan</span>
              <input type="text" id="emrBb" value="64 Kg" class="font-bold text-slate-800 w-full outline-none mt-0.5">
            </div>
          </div>
        </div>

        <!-- Anamnesis & Keluhan -->
        <div>
          <label class="block font-bold text-slate-700 mb-1">Anamnesis & Keluhan Utama Pasien</label>
          <textarea id="emrKeluhan" rows="2" class="w-full p-3 rounded-xl border border-slate-200 focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 outline-none text-slate-700 bg-white">Pasien mengeluhkan demam ringan 3 hari disertai batuk kering dan sakit tenggorokan terutama di malam hari.</textarea>
        </div>

        <!-- Diagnosis ICD-10 -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div>
            <label class="block font-bold text-slate-700 mb-1">Diagnosis Primer (ICD-10)</label>
            <input type="text" id="emrDiagnosis" value="J06.9 - Acute upper respiratory infection" class="w-full p-2.5 rounded-xl border border-slate-200 focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 outline-none font-semibold text-slate-800">
          </div>
          <div>
            <label class="block font-bold text-slate-700 mb-1">Rencana Tindakan / Anjuran</label>
            <input type="text" id="emrTindakan" value="Istirahat cukup, edukasi hidrasi, kontrol 5 hari" class="w-full p-2.5 rounded-xl border border-slate-200 focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 outline-none text-slate-800">
          </div>
        </div>

        <!-- E-Resep Farmasi -->
        <div>
          <div class="flex items-center justify-between mb-1">
            <label class="block font-bold text-slate-700">Elektronik Resep Obat (E-Resep)</label>
            <span class="text-[10px] text-teal-600 bg-teal-50 px-2 py-0.5 rounded font-bold">Terkoneksi Instalasi Farmasi</span>
          </div>
          <textarea id="emrResep" rows="2" class="w-full p-3 rounded-xl border border-slate-200 focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 outline-none text-slate-700 font-mono text-xs">R/ Paracetamol 500mg No. X | 3 x 1 tab pc
R/ Dextromethorphan Syr No. I | 3 x 1 cth</textarea>
        </div>

      </div>

      <!-- Modal Footer -->
      <div class="p-4 border-t border-slate-100 bg-slate-50/60 flex items-center justify-between gap-3">
        <button onclick="closeEmrModal()" class="px-4 py-2.5 rounded-xl border border-slate-200 hover:bg-slate-100 text-xs font-semibold text-slate-600 transition">
          Batal
        </button>
        <div class="flex items-center gap-2">
          <button onclick="sendToPharmacy()" class="px-4 py-2.5 rounded-xl bg-cyan-600 hover:bg-cyan-700 text-white text-xs font-semibold shadow transition flex items-center gap-1.5">
            <i data-lucide="send" class="w-3.5 h-3.5"></i> Kirim ke Farmasi
          </button>
          <button onclick="saveEmrRecord()" class="px-4 py-2.5 rounded-xl bg-teal-600 hover:bg-teal-700 text-white text-xs font-semibold shadow transition flex items-center gap-1.5">
            <i data-lucide="check" class="w-3.5 h-3.5"></i> Simpan & Selesaikan
          </button>
        </div>
      </div>

    </div>
  </div>

  <div id="newPatientModal" class="fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-xs hidden items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-md w-full shadow-2xl border border-slate-100 overflow-hidden">
      
      <div class="p-5 border-b border-slate-100 flex items-center justify-between">
        <div class="flex items-center gap-2.5">
          <div class="w-9 h-9 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center">
            <i data-lucide="user-plus" class="w-5 h-5"></i>
          </div>
          <h3 class="text-base font-bold text-slate-900">Pendaftaran Antrean Pasien</h3>
        </div>
        <button onclick="closeNewPatientModal()" class="text-slate-400 hover:text-slate-600 p-1">
          <i data-lucide="x" class="w-5 h-5"></i>
        </button>
      </div>

      <form id="newPatientForm" onsubmit="submitNewPatient(event)" class="p-6 space-y-4 text-xs">
        
        <div>
          <label class="block font-bold text-slate-700 mb-1">Nama Lengkap Pasien *</label>
          <input type="text" id="regName" required placeholder="Contoh: Budi Gunawan" class="w-full p-2.5 rounded-xl border border-slate-200 focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 outline-none">
        </div>

        <div class="grid grid-cols-2 gap-3">
          <div>
            <label class="block font-bold text-slate-700 mb-1">NIK (16 Digit)</label>
            <input type="text" id="regNik" placeholder="3201..." maxlength="16" class="w-full p-2.5 rounded-xl border border-slate-200 focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 outline-none">
          </div>
          <div>
            <label class="block font-bold text-slate-700 mb-1">Jenis Kelamin</label>
            <select id="regGender" class="w-full p-2.5 rounded-xl border border-slate-200 focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 outline-none bg-white">
              <option value="L">Laki-Laki</option>
              <option value="P">Perempuan</option>
            </select>
          </div>
        </div>

        <div class="grid grid-cols-2 gap-3">
          <div>
            <label class="block font-bold text-slate-700 mb-1">Poli Tujuan *</label>
            <select id="regPoli" class="w-full p-2.5 rounded-xl border border-slate-200 focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 outline-none bg-white">
              <option value="Poli Umum">Poli Umum</option>
              <option value="Poli Gigi">Poli Gigi & Mulut</option>
              <option value="Penyakit Dalam">Penyakit Dalam</option>
              <option value="Poli Anak & KIA">Poli Anak & KIA</option>
            </select>
          </div>

          <div>
            <label class="block font-bold text-slate-700 mb-1">Penjamin / Biaya</label>
            <select id="regPayer" class="w-full p-2.5 rounded-xl border border-slate-200 focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 outline-none bg-white">
              <option value="BPJS Kesehatan">BPJS Kesehatan</option>
              <option value="Umum / Mandiri">Umum / Mandiri</option>
              <option value="Asuransi Swasta">Asuransi Swasta</option>
            </select>
          </div>
        </div>

        <div>
          <label class="block font-bold text-slate-700 mb-1">Keluhan Singkat</label>
          <input type="text" id="regKeluhan" placeholder="Contoh: Pusing berputar sejak kemarin" class="w-full p-2.5 rounded-xl border border-slate-200 focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 outline-none">
        </div>

        <div class="pt-3 flex gap-2">
          <button type="button" onclick="closeNewPatientModal()" class="w-1/2 py-2.5 rounded-xl border border-slate-200 font-semibold text-slate-600 hover:bg-slate-50 transition">
            Batal
          </button>
          <button type="submit" class="w-1/2 py-2.5 rounded-xl bg-teal-600 hover:bg-teal-700 font-semibold text-white shadow transition flex items-center justify-center gap-1">
            <i data-lucide="plus" class="w-4 h-4"></i> Cetak Antrean
          </button>
        </div>

      </form>
    </div>
  </div>

  <script>
    // Primary Patient Data List
    let patients = [
      {
        id: 1,
        queue: 'A-014',
        rm: 'RM-2026-0811',
        name: 'Ahmad Fauzi',
        gender: 'L',
        age: 34,
        poli: 'Poli Umum',
        doctor: 'dr. Arif Hidayat',
        payer: 'Umum / Mandiri',
        status: 'PERIKSA',
        keluhan: 'Batuk kering berdahak 3 hari dan badan meriang',
        tensi: '120/80 mmHg',
        suhu: '37.8 °C',
        diagnosis: 'J06.9 - Acute upper respiratory infection',
        resep: 'R/ Paracetamol 500mg No. X (3x1)\nR/ Ambroxol 30mg No. X (3x1)'
      },
      {
        id: 2,
        queue: 'B-008',
        rm: 'RM-2026-0422',
        name: 'Kartika Wulandari',
        gender: 'P',
        age: 28,
        poli: 'Poli Gigi',
        doctor: 'drg. Siti Fadhilah',
        payer: 'BPJS Kesehatan',
        status: 'PERIKSA',
        keluhan: 'Nyeri gigi geraham bawah kanan berdenyut sejak malam',
        tensi: '115/75 mmHg',
        suhu: '36.6 °C',
        diagnosis: 'K04.0 - Pulpitis Akut',
        resep: 'R/ Asam Mefenamat 500mg No. X (3x1)\nR/ Amoxicillin 500mg No. XV (3x1)'
      },
      {
        id: 3,
        queue: 'C-005',
        rm: 'RM-2026-0104',
        name: 'H. Bambang Soetrisno',
        gender: 'L',
        age: 62,
        poli: 'Penyakit Dalam',
        doctor: 'dr. Rahmat Pratama, Sp.PD',
        payer: 'BPJS Kesehatan',
        status: 'PERIKSA',
        keluhan: 'Kontrol rutin hipertensi dan nyeri tengkuk leher',
        tensi: '145/90 mmHg',
        suhu: '36.5 °C',
        diagnosis: 'I10 - Essential (primary) hypertension',
        resep: 'R/ Amlodipine 10mg No. XXX (1x1 malam)'
      },
      {
        id: 4,
        queue: 'D-003',
        rm: 'RM-2026-0955',
        name: 'Ananda Kinan',
        gender: 'P',
        age: 6,
        poli: 'Poli Anak & KIA',
        doctor: 'dr. Nurul Nisa, Sp.A',
        payer: 'BPJS Kesehatan',
        status: 'MENUNGGU',
        keluhan: 'Demam hari ke-2 dan ruam kemerahan di pipi',
        tensi: '95/60 mmHg',
        suhu: '38.4 °C',
        diagnosis: 'B08.4 - Enteroviral vesicular stomatitis',
        resep: 'R/ Paracetamol Syr 120mg/5ml No. I (3x1 cth prn)'
      },
      {
        id: 5,
        queue: 'A-015',
        rm: 'RM-2026-1102',
        name: 'Siti Rahmawati',
        gender: 'P',
        age: 41,
        poli: 'Poli Umum',
        doctor: 'dr. Arif Hidayat',
        payer: 'Umum / Mandiri',
        status: 'MENUNGGU',
        keluhan: 'Migrain dan mual ringan',
        tensi: '110/70 mmHg',
        suhu: '36.7 °C',
        diagnosis: 'G43.9 - Migraine, unspecified',
        resep: 'R/ Ibuprofen 400mg No. X (2x1 pc)'
      },
      {
        id: 6,
        queue: 'C-006',
        rm: 'RM-2026-0245',
        name: 'Dedi Kurniawan',
        gender: 'L',
        age: 49,
        poli: 'Penyakit Dalam',
        doctor: 'dr. Rahmat Pratama, Sp.PD',
        payer: 'Asuransi Swasta',
        status: 'MENUNGGU',
        keluhan: 'Pemeriksaan lanjutan hasil lab gula darah',
        tensi: '130/80 mmHg',
        suhu: '36.6 °C',
        diagnosis: 'E11.9 - Type 2 diabetes mellitus',
        resep: 'R/ Metformin 500mg No. LX (2x1 pc)'
      },
      {
        id: 7,
        queue: 'A-013',
        rm: 'RM-2026-0799',
        name: 'Rudi Hartono',
        gender: 'L',
        age: 39,
        poli: 'Poli Umum',
        doctor: 'dr. Arif Hidayat',
        payer: 'BPJS Kesehatan',
        status: 'SELESAI',
        keluhan: 'Pemeriksaan luka lecet lengan setelah terjatuh',
        tensi: '120/80 mmHg',
        suhu: '36.5 °C',
        diagnosis: 'T14.0 - Superficial injury',
        resep: 'R/ Povidone Iodine 10% Salep No. I'
      }
    ];

    let currentFilter = 'ALL';
    let selectedPatientForEmr = null;

    function playClinicChime() {
      try {
        const AudioContext = window.AudioContext || window.webkitAudioContext;
        const ctx = new AudioContext();
        
        const playTone = (freq, startTime, duration) => {
          const osc = ctx.createOscillator();
          const gain = ctx.createGain();
          
          osc.type = 'sine';
          osc.frequency.setValueAtTime(freq, startTime);
          
          gain.gain.setValueAtTime(0, startTime);
          gain.gain.linearRampToValueAtTime(0.25, startTime + 0.04);
          gain.gain.exponentialRampToValueAtTime(0.0001, startTime + duration);
          
          osc.connect(gain);
          gain.connect(ctx.destination);
          
          osc.start(startTime);
          osc.stop(startTime + duration);
        };

        const now = ctx.currentTime;
        playTone(554.37, now, 0.45);        // C#5
        playTone(659.25, now + 0.22, 0.45); // E5
        playTone(830.61, now + 0.44, 0.7);  // G#5
      } catch (err) {
        console.warn('Web Audio playback failed or blocked:', err);
      }
    }

    function testChimeSound() {
      playClinicChime();
      showToast('Uji Coba Pengeras Suara', 'Bell antrean poliklinik berhasil berbunyi normal.', 'info');
    }

    function renderPatientTable(dataToRender = null) {
      const tbody = document.getElementById('patientTableBody');
      const list = dataToRender || getFilteredPatients();
      tbody.innerHTML = '';

      if (list.length === 0) {
        tbody.innerHTML = `
          <tr>
            <td colspan="7" class="px-5 py-8 text-center text-slate-400">
              <i data-lucide="inbox" class="w-8 h-8 mx-auto mb-2 opacity-50"></i>
              Tidak ada data antrean pasien yang sesuai filter.
            </td>
          </tr>
        `;
        lucide.createIcons();
        document.getElementById('showingEntriesText').textContent = `Menampilkan 0 antrean`;
        return;
      }

      list.forEach(item => {
        let statusBadge = '';
        if (item.status === 'PERIKSA') {
          statusBadge = '<span class="px-2.5 py-1 rounded-full bg-cyan-50 text-cyan-700 border border-cyan-200 text-[11px] font-bold inline-flex items-center gap-1.5"><span class="w-1.5 h-1.5 rounded-full bg-cyan-500 animate-pulse"></span>Sedang Periksa</span>';
        } else if (item.status === 'MENUNGGU') {
          statusBadge = '<span class="px-2.5 py-1 rounded-full bg-amber-50 text-amber-700 border border-amber-200 text-[11px] font-bold">Menunggu</span>';
        } else {
          statusBadge = '<span class="px-2.5 py-1 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200 text-[11px] font-bold flex-inline items-center gap-1">✓ Selesai</span>';
        }

        const tr = document.createElement('tr');
        tr.className = 'hover:bg-slate-50/80 transition';
        tr.innerHTML = `
          <td class="px-5 py-3.5 font-mono font-bold text-slate-900">${item.queue}</td>
          <td class="px-5 py-3.5">
            <div class="font-bold text-slate-900">${item.name}</div>
            <div class="text-[11px] text-slate-400 font-mono">${item.rm} • ${item.gender === 'L' ? 'Laki-Laki' : 'Perempuan'}, ${item.age} thn</div>
          </td>
          <td class="px-5 py-3.5 font-medium text-slate-700">${item.poli}</td>
          <td class="px-5 py-3.5 text-slate-600">${item.doctor}</td>
          <td class="px-5 py-3.5">
            <span class="px-2 py-0.5 rounded text-[11px] font-semibold ${item.payer.includes('BPJS') ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-slate-100 text-slate-600'}">
              ${item.payer}
            </span>
          </td>
          <td class="px-5 py-3.5">${statusBadge}</td>
          <td class="px-5 py-3.5 text-right">
            <button onclick="openEmrModal(${item.id})" class="px-3 py-1.5 rounded-xl bg-teal-50 hover:bg-teal-600 text-teal-700 hover:text-white border border-teal-200 hover:border-transparent font-semibold text-xs transition inline-flex items-center gap-1">
              <i data-lucide="stethoscope" class="w-3.5 h-3.5"></i>
              <span>Periksa / EMR</span>
            </button>
          </td>
        `;
        tbody.appendChild(tr);
      });

      document.getElementById('showingEntriesText').textContent = `Menampilkan ${list.length} dari ${patients.length} antrean terdaftar`;
      lucide.createIcons();
    }

    function getFilteredPatients() {
      if (currentFilter === 'ALL') return patients;
      return patients.filter(p => p.status === currentFilter);
    }

    function filterPatientTable(status) {
      currentFilter = status;
      document.querySelectorAll('.filter-tab-btn').forEach(b => {
        b.classList.remove('bg-white', 'text-teal-800', 'shadow-xs');
        b.classList.add('text-slate-600');
      });
      const activeBtn = document.getElementById(`filterBtn-${status}`);
      if (activeBtn) {
        activeBtn.classList.remove('text-slate-600');
        activeBtn.classList.add('bg-white', 'text-teal-800', 'shadow-xs');
      }
      renderPatientTable();
    }

    function handleTableSearch(term) {
      const q = term.toLowerCase().trim();
      const filtered = getFilteredPatients().filter(p => 
        p.name.toLowerCase().includes(q) ||
        p.rm.toLowerCase().includes(q) ||
        p.queue.toLowerCase().includes(q) ||
        p.poli.toLowerCase().includes(q)
      );
      renderPatientTable(filtered);
    }

    function handleGlobalSearch(term) {
      const q = term.toLowerCase().trim();
      if (!q) {
        renderPatientTable();
        return;
      }
      const filtered = patients.filter(p => 
        p.name.toLowerCase().includes(q) ||
        p.rm.toLowerCase().includes(q) ||
        p.queue.toLowerCase().includes(q)
      );
      renderPatientTable(filtered);
    }

    function callQueue(queueNumber, poliName, patientName) {
      playClinicChime();
      showToast(
        `Memanggil Antrean: ${queueNumber}`,
        `Pasien ${patientName} dipersilakan menuju ke ruang ${poliName}.`,
        'success'
      );
    }

    function nextQueue(poliType) {
      playClinicChime();
      const waiting = patients.find(p => p.poli.toLowerCase().includes(poliType.toLowerCase()) && p.status === 'MENUNGGU');
      if (waiting) {
        waiting.status = 'PERIKSA';
        if (poliType === 'Umum') {
          document.getElementById('queueNumUmum').textContent = waiting.queue;
          document.getElementById('patientNameUmum').textContent = waiting.name;
        } else if (poliType === 'Gigi') {
          document.getElementById('queueNumGigi').textContent = waiting.queue;
          document.getElementById('patientNameGigi').textContent = waiting.name;
        } else if (poliType === 'Dalam') {
          document.getElementById('queueNumDalam').textContent = waiting.queue;
          document.getElementById('patientNameDalam').textContent = waiting.name;
        } else if (poliType === 'Anak') {
          document.getElementById('queueNumAnak').textContent = waiting.queue;
          document.getElementById('patientNameAnak').textContent = waiting.name;
        }
        showToast('Antrean Baru Dipanggil', `${waiting.queue} (${waiting.name}) sedang diperiksa.`, 'success');
        renderPatientTable();
      } else {
        showToast('Antrean Selesai', `Tidak ada pasien menunggu lagi di Poli ${poliType}.`, 'info');
      }
    }

    function callNextDirectly() {
      const nextP = patients.find(p => p.status === 'MENUNGGU');
      if (nextP) {
        callQueue(nextP.queue, nextP.poli, nextP.name);
      } else {
        showToast('Semua Selesai', 'Tidak ada pasien dalam status menunggu antrean saat ini.', 'info');
      }
    }

    function openEmrModal(patientId) {
      const p = patients.find(x => x.id === patientId);
      if (!p) return;
      selectedPatientForEmr = p;

      document.getElementById('emrModalPatientName').textContent = p.name;
      document.getElementById('emrModalPatientRM').textContent = p.rm;
      document.getElementById('emrModalPoliInfo').textContent = `${p.poli} • Pemeriksa: ${p.doctor}`;

      document.getElementById('emrTensi').value = p.tensi || '120/80 mmHg';
      document.getElementById('emrSuhu').value = p.suhu || '36.7 °C';
      document.getElementById('emrKeluhan').value = p.keluhan || '';
      document.getElementById('emrDiagnosis').value = p.diagnosis || '';
      document.getElementById('emrResep').value = p.resep || '';

      const modal = document.getElementById('emrModal');
      modal.classList.remove('hidden');
      modal.classList.add('flex');
    }

    function closeEmrModal() {
      const modal = document.getElementById('emrModal');
      modal.classList.add('hidden');
      modal.classList.remove('flex');
      selectedPatientForEmr = null;
    }

    function saveEmrRecord() {
      if (!selectedPatientForEmr) return;
      selectedPatientForEmr.tensi = document.getElementById('emrTensi').value;
      selectedPatientForEmr.suhu = document.getElementById('emrSuhu').value;
      selectedPatientForEmr.keluhan = document.getElementById('emrKeluhan').value;
      selectedPatientForEmr.diagnosis = document.getElementById('emrDiagnosis').value;
      selectedPatientForEmr.resep = document.getElementById('emrResep').value;
      selectedPatientForEmr.status = 'SELESAI';

      closeEmrModal();
      renderPatientTable();
      showToast('Rekam Medis Tersimpan', `Pemeriksaan untuk ${selectedPatientForEmr.name} selesai dan tersinkronisasi.`, 'success');
    }

    function sendToPharmacy() {
      if (!selectedPatientForEmr) return;
      showToast('Resep Dikirim ke Farmasi', `E-Resep pasien ${selectedPatientForEmr.name} berhasil diteruskan ke Instalasi Farmasi.`, 'info');
    }

    function openNewPatientModal() {
      document.getElementById('newPatientModal').classList.remove('hidden');
      document.getElementById('newPatientModal').classList.add('flex');
    }

    function closeNewPatientModal() {
      document.getElementById('newPatientModal').classList.add('hidden');
      document.getElementById('newPatientModal').classList.remove('flex');
      document.getElementById('newPatientForm').reset();
    }

    function submitNewPatient(e) {
      e.preventDefault();
      const name = document.getElementById('regName').value.trim();
      const poli = document.getElementById('regPoli').value;
      const payer = document.getElementById('regPayer').value;
      const keluhan = document.getElementById('regKeluhan').value.trim();
      const gender = document.getElementById('regGender').value;

      let prefix = 'A';
      let doctor = 'dr. Arif Hidayat';
      if (poli.includes('Gigi')) { prefix = 'B'; doctor = 'drg. Siti Fadhilah'; }
      else if (poli.includes('Dalam')) { prefix = 'C'; doctor = 'dr. Rahmat Pratama, Sp.PD'; }
      else if (poli.includes('Anak')) { prefix = 'D'; doctor = 'dr. Nurul Nisa, Sp.A'; }

      const nextNum = Math.floor(Math.random() * 80) + 20;
      const queueNumber = `${prefix}-0${nextNum}`;
      const rmNumber = `RM-2026-${Math.floor(1000 + Math.random() * 9000)}`;

      const newEntry = {
        id: Date.now(),
        queue: queueNumber,
        rm: rmNumber,
        name: name,
        gender: gender,
        age: 30,
        poli: poli,
        doctor: doctor,
        payer: payer,
        status: 'MENUNGGU',
        keluhan: keluhan || 'Pemeriksaan rutin berkala',
        tensi: '120/80 mmHg',
        suhu: '36.5 °C',
        diagnosis: 'Z00.0 - General medical examination',
        resep: 'R/ Multivitamin Tab No. X (1x1)'
      };

      patients.unshift(newEntry);
      closeNewPatientModal();
      renderPatientTable();
      showToast('Pendaftaran Berhasil', `Nomor Antrean ${queueNumber} tercetak untuk pasien ${name}.`, 'success');
      playClinicChime();

      // Update KPI
      const totalKpi = document.getElementById('kpiTotalPasien');
      totalKpi.textContent = parseInt(totalKpi.textContent) + 1;
      const waitKpi = document.getElementById('kpiAntreanMenunggu');
      waitKpi.textContent = parseInt(waitKpi.textContent) + 1;
    }

    function updateLiveClock() {
      const now = new Date();
      const optionsDate = { weekday: 'long', year: 'numeric', month: 'short', day: 'numeric' };
      const dateString = now.toLocaleDateString('id-ID', optionsDate);
      
      const hours = String(now.getHours()).padStart(2, '0');
      const minutes = String(now.getMinutes()).padStart(2, '0');
      const seconds = String(now.getSeconds()).padStart(2, '0');
      
      document.getElementById('currentDateDisplay').textContent = dateString;
      document.getElementById('currentTimeDisplay').textContent = `${hours}:${minutes}:${seconds} WIB`;
    }

    function toggleSidebar() {
      const sidebar = document.getElementById('sidebar');
      const backdrop = document.getElementById('sidebarBackdrop');
      sidebar.classList.toggle('-translate-x-full');
      backdrop.classList.toggle('hidden');
    }

    function toggleNotifDropdown() {
      const dd = document.getElementById('notifDropdown');
      dd.classList.toggle('hidden');
    }

    let toastTimer = null;
    function showToast(title, message, type = 'success') {
      const toast = document.getElementById('toastNotification');
      const tTitle = document.getElementById('toastTitle');
      const tMsg = document.getElementById('toastMessage');
      const iconContainer = document.getElementById('toastIconContainer');
      const icon = document.getElementById('toastIcon');

      tTitle.textContent = title;
      tMsg.textContent = message;

      if (type === 'error') {
        iconContainer.className = 'w-9 h-9 rounded-xl flex items-center justify-center bg-rose-50 text-rose-600 shrink-0';
        icon.setAttribute('data-lucide', 'alert-triangle');
      } else if (type === 'info') {
        iconContainer.className = 'w-9 h-9 rounded-xl flex items-center justify-center bg-cyan-50 text-cyan-600 shrink-0';
        icon.setAttribute('data-lucide', 'info');
      } else {
        iconContainer.className = 'w-9 h-9 rounded-xl flex items-center justify-center bg-teal-50 text-teal-600 shrink-0';
        icon.setAttribute('data-lucide', 'check-circle-2');
      }
      lucide.createIcons();

      toast.classList.remove('translate-y-[-140%]', 'opacity-0', 'pointer-events-none');
      toast.classList.add('translate-y-0', 'opacity-100');

      if (toastTimer) clearTimeout(toastTimer);
      toastTimer = setTimeout(dismissToast, 4000);
    }

    function dismissToast() {
      const toast = document.getElementById('toastNotification');
      toast.classList.add('translate-y-[-140%]', 'opacity-0', 'pointer-events-none');
      toast.classList.remove('translate-y-0', 'opacity-100');
    }

    // Chart.js Hourly Trend Setup
    function initChart() {
      const ctx = document.getElementById('patientTrendChart').getContext('2d');
      
      const gradientTeal = ctx.createLinearGradient(0, 0, 0, 300);
      gradientTeal.addColorStop(0, 'rgba(13, 148, 136, 0.4)');
      gradientTeal.addColorStop(1, 'rgba(13, 148, 136, 0.0)');

      new Chart(ctx, {
        type: 'line',
        data: {
          labels: ['08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00'],
          datasets: [{
            label: 'Jumlah Pasien Masuk',
            data: [4, 11, 19, 14, 6, 9, 16, 12, 7, 3],
            borderColor: '#0d9488',
            backgroundColor: gradientTeal,
            borderWidth: 2.5,
            fill: true,
            tension: 0.35,
            pointBackgroundColor: '#0f766e',
            pointRadius: 4,
            pointHoverRadius: 6
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: { display: false },
            tooltip: {
              backgroundColor: '#0f172a',
              titleFont: { family: 'Plus Jakarta Sans', size: 12, weight: 'bold' },
              bodyFont: { family: 'Plus Jakarta Sans', size: 12 },
              padding: 10,
              cornerRadius: 10
            }
          },
          scales: {
            y: {
              beginAtZero: true,
              grid: { color: 'rgba(226, 232, 240, 0.6)' },
              ticks: { font: { family: 'Plus Jakarta Sans', size: 10 }, color: '#64748b' }
            },
            x: {
              grid: { display: false },
              ticks: { font: { family: 'Plus Jakarta Sans', size: 10 }, color: '#64748b' }
            }
          }
        }
      });
    }

    // Bootstrap app on window load
    window.onload = function() {
      lucide.createIcons();
      renderPatientTable();
      updateLiveClock();
      setInterval(updateLiveClock, 1000);
      initChart();
    };
  </script>
</body>
</html>