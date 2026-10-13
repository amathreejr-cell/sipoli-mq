<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SantriController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\AngkatanController;
use App\Http\Controllers\WaliSantriController;
use App\Http\Controllers\DiagnosaController;
use App\Http\Controllers\TindakanController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\AlergiController;
use App\Http\Controllers\KunjunganController;
use App\Http\Controllers\PemeriksaanController;
use App\Http\Controllers\KunjunganDiagnosaController;
use App\Http\Controllers\KunjunganTindakanController;
use App\Http\Controllers\KunjunganResepController;
use App\Http\Controllers\MasterRujukanController;
use App\Http\Controllers\RujukanController;
use App\Http\Controllers\KunjunganKeputusanController;
use App\Http\Controllers\KunjunganRingkasanController;
use App\Http\Controllers\MutasiStokController;
use App\Http\Controllers\KunjunganDokumenController;
use App\Http\Controllers\IdentitasPoliklinikController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\KoreksiResepController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman utama

Route::get('/', function () {
    return view('welcome');
});

// Dashboard

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Pengaturan Identitas Poliklinik - hanya admin yang dapat mengakses

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get(
        '/pengaturan/identitas-poliklinik',
        [IdentitasPoliklinikController::class, 'edit']
    )->name('pengaturan.identitas.edit');

    Route::put(
        '/pengaturan/identitas-poliklinik',
        [IdentitasPoliklinikController::class, 'update']
    )->name('pengaturan.identitas.update');

    Route::get('/pengaturan/pengguna', [
        UserManagementController::class,
        'index'
    ])->name('users.index');

    Route::get('/pengaturan/pengguna/tambah', [
        UserManagementController::class,
        'create'
    ])->name('users.create');

    Route::post('/pengaturan/pengguna', [
        UserManagementController::class,
        'store'
    ])->name('users.store');

    Route::get('/pengaturan/pengguna/{user}/edit', [
        UserManagementController::class,
        'edit'
    ])->name('users.edit');

    Route::put('/pengaturan/pengguna/{user}', [
        UserManagementController::class,
        'update'
    ])->name('users.update');

    Route::put('/pengaturan/pengguna/{user}/reset-password', [
        UserManagementController::class,
        'resetPassword'
    ])->name('users.reset-password');

    Route::patch('/pengaturan/pengguna/{user}/status', [
        UserManagementController::class,
        'toggleStatus'
    ])->name('users.toggle-status');

    Route::delete('/pengaturan/pengguna/{user}', [
        UserManagementController::class,
        'destroy'
    ])->name('users.destroy');
});

//DATA SANTRI//

// Data Santri - semua role dapat melihat

Route::middleware(['auth', 'role:admin,petugas,pimpinan'])->group(function () {
    Route::get('/santri', [SantriController::class, 'index'])
        ->name('santri.index');

    Route::get('/santri/search', [SantriController::class, 'search'])
        ->name('santri.search');

    Route::get('/santri/{santri}/data', [SantriController::class, 'data'])
        ->name('santri.data');

    Route::get('/santri/{santri}', [SantriController::class, 'show'])
        ->whereNumber('santri')
        ->name('santri.show');
});

// Data Santri - Admin dan Petugas dapat menambah dan mengedit

Route::middleware(['auth', 'role:admin,petugas'])->group(function () {
    Route::get('/santri/create', [SantriController::class, 'create'])
        ->name('santri.create');

    Route::post('/santri', [SantriController::class, 'store'])
        ->name('santri.store');

    // Import Excel
    Route::get('/santri/import', [SantriController::class, 'importForm'])
        ->name('santri.import.form');

    Route::post('/santri/import', [SantriController::class, 'import'])
        ->name('santri.import');

    Route::get('/santri/import/template', [SantriController::class, 'downloadTemplate'])
        ->name('santri.import.template');

    // Lawas
    Route::get('/santri/{santri}/edit', [SantriController::class, 'edit'])
        ->whereNumber('santri')
        ->name('santri.edit');

    Route::put('/santri/{santri}', [SantriController::class, 'update'])
        ->whereNumber('santri')
        ->name('santri.update');
});

// Data Santri - hanya Admin yang dapat menonaktifkan

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::delete('/santri/{santri}', [SantriController::class, 'destroy'])
        ->whereNumber('santri')
        ->name('santri.destroy');
});

//DATA KAMAR//

// Data Kamar - semua role dapat melihat

Route::middleware(['auth', 'role:admin,petugas,pimpinan'])->group(function () {
    Route::get('/kamar', [KamarController::class, 'index'])
        ->name('kamar.index');

    Route::get('/kamar/{kamar}', [KamarController::class, 'show'])
        ->whereNumber('kamar')
        ->name('kamar.show');
});

// Data Kamar - Admin dan Petugas dapat menambah dan mengedit

Route::middleware(['auth', 'role:admin,petugas'])->group(function () {
    Route::get('/kamar/create', [KamarController::class, 'create'])
        ->name('kamar.create');

    Route::post('/kamar', [KamarController::class, 'store'])
        ->name('kamar.store');

    Route::get('/kamar/{kamar}/edit', [KamarController::class, 'edit'])
        ->whereNumber('kamar')
        ->name('kamar.edit');

    Route::put('/kamar/{kamar}', [KamarController::class, 'update'])
        ->whereNumber('kamar')
        ->name('kamar.update');
});

// Data Kamar - hanya Admin yang dapat menonaktifkan

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::delete('/kamar/{kamar}', [KamarController::class, 'destroy'])
        ->whereNumber('kamar')
        ->name('kamar.destroy');
});

//ANGKATAN//

// Data Angkatan - semua role dapat melihat

Route::middleware(['auth', 'role:admin,petugas,pimpinan'])->group(function () {
    Route::get('/angkatan', [AngkatanController::class, 'index'])
        ->name('angkatan.index');

    Route::get('/angkatan/{angkatan}', [AngkatanController::class, 'show'])
        ->whereNumber('angkatan')
        ->name('angkatan.show');
});

// Data Angkatan - Admin dan Petugas dapat menambah dan mengedit

Route::middleware(['auth', 'role:admin,petugas'])->group(function () {
    Route::get('/angkatan/create', [AngkatanController::class, 'create'])
        ->name('angkatan.create');

    Route::post('/angkatan', [AngkatanController::class, 'store'])
        ->name('angkatan.store');

    Route::get('/angkatan/{angkatan}/edit', [AngkatanController::class, 'edit'])
        ->whereNumber('angkatan')
        ->name('angkatan.edit');

    Route::put('/angkatan/{angkatan}', [AngkatanController::class, 'update'])
        ->whereNumber('angkatan')
        ->name('angkatan.update');
});

// Data Angkatan - hanya Admin yang dapat menonaktifkan

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::delete('/angkatan/{angkatan}', [AngkatanController::class, 'destroy'])
        ->whereNumber('angkatan')
        ->name('angkatan.destroy');
});

//WALI SANTRI//

// Wali Santri - semua role dapat melihat

Route::middleware(['auth', 'role:admin,petugas,pimpinan'])->group(function () {
    Route::get('/wali-santri', [WaliSantriController::class, 'index'])
        ->name('wali-santri.index');

    Route::get('/wali-santri/{waliSantri}', [WaliSantriController::class, 'show'])
        ->whereNumber('waliSantri')
        ->name('wali-santri.show');
});

// Wali Santri - admin dan petugas dapat menambah/mengedit

Route::middleware(['auth', 'role:admin,petugas'])->group(function () {
    Route::get('/wali-santri/create', [WaliSantriController::class, 'create'])
        ->name('wali-santri.create');

    Route::post('/wali-santri', [WaliSantriController::class, 'store'])
        ->name('wali-santri.store');

    Route::get('/wali-santri/{waliSantri}/edit', [WaliSantriController::class, 'edit'])
        ->whereNumber('waliSantri')
        ->name('wali-santri.edit');

    Route::put('/wali-santri/{waliSantri}', [WaliSantriController::class, 'update'])
        ->whereNumber('waliSantri')
        ->name('wali-santri.update');
});

// Wali Santri - hanya admin yang dapat menghapus

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::delete('/wali-santri/{waliSantri}', [WaliSantriController::class, 'destroy'])
        ->whereNumber('waliSantri')
        ->name('wali-santri.destroy');
});

// DIAGNOSA//

// Diagnosa - semua role dapat melihat

Route::middleware(['auth', 'role:admin,petugas,pimpinan'])->group(function () {
    Route::get('/diagnosa', [DiagnosaController::class, 'index'])
        ->name('diagnosa.index');

    Route::get('/diagnosa/{diagnosa}', [DiagnosaController::class, 'show'])
        ->whereNumber('diagnosa')
        ->name('diagnosa.show');
});

// Diagnosa - admin dan petugas dapat menambah/mengedit

Route::middleware(['auth', 'role:admin,petugas'])->group(function () {
    Route::get('/diagnosa/create', [DiagnosaController::class, 'create'])
        ->name('diagnosa.create');

    Route::post('/diagnosa', [DiagnosaController::class, 'store'])
        ->name('diagnosa.store');

    Route::get('/diagnosa/{diagnosa}/edit', [DiagnosaController::class, 'edit'])
        ->whereNumber('diagnosa')
        ->name('diagnosa.edit');

    Route::put('/diagnosa/{diagnosa}', [DiagnosaController::class, 'update'])
        ->whereNumber('diagnosa')
        ->name('diagnosa.update');
});

// Diagnosa - hanya admin yang dapat menonaktifkan

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::delete('/diagnosa/{diagnosa}', [DiagnosaController::class, 'destroy'])
        ->whereNumber('diagnosa')
        ->name('diagnosa.destroy');
});

// TINDAKAN//

// Tindakan - semua role dapat melihat

Route::middleware(['auth', 'role:admin,petugas,pimpinan'])->group(function () {
    Route::get('/tindakan', [TindakanController::class, 'index'])
        ->name('tindakan.index');

    Route::get('/tindakan/{tindakan}', [TindakanController::class, 'show'])
        ->whereNumber('tindakan')
        ->name('tindakan.show');
});

// Tindakan - admin dan petugas dapat menambah/mengedit

Route::middleware(['auth', 'role:admin,petugas'])->group(function () {
    Route::get('/tindakan/create', [TindakanController::class, 'create'])
        ->name('tindakan.create');

    Route::post('/tindakan', [TindakanController::class, 'store'])
        ->name('tindakan.store');

    Route::get('/tindakan/{tindakan}/edit', [TindakanController::class, 'edit'])
        ->whereNumber('tindakan')
        ->name('tindakan.edit');

    Route::put('/tindakan/{tindakan}', [TindakanController::class, 'update'])
        ->whereNumber('tindakan')
        ->name('tindakan.update');
});

// Tindakan - hanya admin yang dapat menonaktifkan

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::delete('/tindakan/{tindakan}', [TindakanController::class, 'destroy'])
        ->whereNumber('tindakan')
        ->name('tindakan.destroy');
});

// OBAT//

// Obat - semua role dapat melihat

Route::middleware(['auth', 'role:admin,petugas,pimpinan'])->group(function () {
    Route::get('/obat', [ObatController::class, 'index'])
        ->name('obat.index');

    Route::get('/obat/{obat}', [ObatController::class, 'show'])
        ->whereNumber('obat')
        ->name('obat.show');
});

// Obat - admin dan petugas dapat menambah/mengedit

Route::middleware(['auth', 'role:admin,petugas'])->group(function () {
    Route::get('/obat/create', [ObatController::class, 'create'])
        ->name('obat.create');

    Route::post('/obat', [ObatController::class, 'store'])
        ->name('obat.store');

    Route::get('/obat/{obat}/edit', [ObatController::class, 'edit'])
        ->whereNumber('obat')
        ->name('obat.edit');

    Route::put('/obat/{obat}', [ObatController::class, 'update'])
        ->whereNumber('obat')
        ->name('obat.update');
});

// Obat - hanya admin yang dapat menonaktifkan

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::delete('/obat/{obat}', [ObatController::class, 'destroy'])
        ->whereNumber('obat')
        ->name('obat.destroy');
});

//ALERGI//

// Alergi - semua role dapat melihat

Route::middleware(['auth', 'role:admin,petugas,pimpinan'])->group(function () {
    Route::get('/alergi', [AlergiController::class, 'index'])
        ->name('alergi.index');

    Route::get('/alergi/{alergi}', [AlergiController::class, 'show'])
        ->whereNumber('alergi')
        ->name('alergi.show');
});

// Alergi - admin dan petugas dapat menambah/mengedit

Route::middleware(['auth', 'role:admin,petugas'])->group(function () {
    Route::get('/alergi/create', [AlergiController::class, 'create'])
        ->name('alergi.create');

    Route::post('/alergi', [AlergiController::class, 'store'])
        ->name('alergi.store');

    Route::get('/alergi/{alergi}/edit', [AlergiController::class, 'edit'])
        ->whereNumber('alergi')
        ->name('alergi.edit');

    Route::put('/alergi/{alergi}', [AlergiController::class, 'update'])
        ->name('alergi.update');
});

// Alergi - hanya admin yang dapat menghapus

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::delete('/alergi/{alergi}', [AlergiController::class, 'destroy'])
        ->whereNumber('alergi')
        ->name('alergi.destroy');
});

//KUNJUNGAN//

// Kunjungan - semua role dapat melihat

Route::middleware(['auth', 'role:admin,petugas,pimpinan'])->group(function () {
    Route::get('/kunjungan', [KunjunganController::class, 'index'])
        ->name('kunjungan.index');

    Route::get('/rekam-medis', [KunjunganController::class, 'rekamMedis'])
        ->name('rekam-medis.index');

    Route::get('/laporan', [KunjunganController::class, 'laporan'])
        ->name('laporan.index');

    Route::get('/laporan/pdf', [KunjunganController::class, 'laporanPdf'])
        ->name('laporan.pdf');

    Route::get('/laporan/excel', [KunjunganController::class, 'laporanExcel'])
        ->name('laporan.excel');

    Route::get('/kunjungan/{kunjungan}', [KunjunganController::class, 'show'])
        ->whereNumber('kunjungan')
        ->name('kunjungan.show');

    // Cetak surat izin berobat // Cetak surat rujukan // Cetak rekam medis
    Route::get(
        '/kunjungan/{kunjungan}/surat-izin',
        [KunjunganDokumenController::class, 'suratIzin']
    )->name('kunjungan.surat-izin');

    Route::get(
        '/kunjungan/{kunjungan}/surat-rujukan',
        [KunjunganDokumenController::class, 'suratRujukan']
    )->name('kunjungan.surat-rujukan');

    Route::get(
        '/kunjungan/{kunjungan}/rekam-medis',
        [KunjunganDokumenController::class, 'rekamMedis']
    )->name('kunjungan.rekam-medis');
});

// Kunjungan - admin dan petugas dapat menambah/mengedit

Route::middleware(['auth', 'role:admin,petugas'])->group(function () {
    Route::get('/kunjungan/create', [KunjunganController::class, 'create'])
        ->name('kunjungan.create');

    Route::post('/kunjungan', [KunjunganController::class, 'store'])
        ->name('kunjungan.store');

    Route::get('/kunjungan/{kunjungan}/edit', [KunjunganController::class, 'edit'])
        ->whereNumber('kunjungan')
        ->name('kunjungan.edit');

    Route::put('/kunjungan/{kunjungan}', [KunjunganController::class, 'update'])
        ->name('kunjungan.update');

    Route::get('/santri/{santri}/riwayat-kunjungan', [KunjunganController::class, 'riwayatSantri'])
        ->name('santri.riwayat-kunjungan');
});

// Kunjungan - hanya admin yang dapat membatalkan

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::delete('/kunjungan/{kunjungan}', [KunjunganController::class, 'destroy'])
        ->whereNumber('kunjungan')
        ->name('kunjungan.destroy');
});


/*
|--------------------------------------------------------------------------
| Alur Pelayanan Kunjungan
|--------------------------------------------------------------------------
*/

// Pemeriksaan, diagnosa, tindakan, resep, rujukan,
// keputusan pelayanan, dan ringkasan hanya untuk Admin/Petugas.
Route::middleware(['auth', 'role:admin,petugas'])->group(function () {

    // Pemeriksaan
    Route::get(
        '/kunjungan/{kunjungan}/pemeriksaan/create',
        [PemeriksaanController::class, 'create']
    )->whereNumber('kunjungan')
        ->name('pemeriksaan.create');

    Route::post(
        '/kunjungan/{kunjungan}/pemeriksaan',
        [PemeriksaanController::class, 'store']
    )->whereNumber('kunjungan')
        ->name('pemeriksaan.store');

    // Diagnosa kunjungan
    Route::get(
        '/kunjungan/{kunjungan}/diagnosa/create',
        [KunjunganDiagnosaController::class, 'create']
    )->whereNumber('kunjungan')
        ->name('kunjungan-diagnosa.create');

    Route::post(
        '/kunjungan/{kunjungan}/diagnosa',
        [KunjunganDiagnosaController::class, 'store']
    )->whereNumber('kunjungan')
        ->name('kunjungan-diagnosa.store');

    // Tindakan kunjungan
    Route::get(
        '/kunjungan/{kunjungan}/tindakan/create',
        [KunjunganTindakanController::class, 'create']
    )->whereNumber('kunjungan')
        ->name('kunjungan-tindakan.create');

    Route::post(
        '/kunjungan/{kunjungan}/tindakan',
        [KunjunganTindakanController::class, 'store']
    )->whereNumber('kunjungan')
        ->name('kunjungan-tindakan.store');

    // Resep kunjungan
    Route::get(
        '/kunjungan/{kunjungan}/resep/create',
        [KunjunganResepController::class, 'create']
    )->whereNumber('kunjungan')
        ->name('kunjungan-resep.create');

    Route::post(
        '/kunjungan/{kunjungan}/resep',
        [KunjunganResepController::class, 'store']
    )->whereNumber('kunjungan')
        ->name('kunjungan-resep.store');

    // Rujukan kunjungan
    Route::get(
        '/kunjungan/{kunjungan}/rujukan/create',
        [RujukanController::class, 'create']
    )->whereNumber('kunjungan')
        ->name('rujukan.create');

    Route::post(
        '/kunjungan/{kunjungan}/rujukan',
        [RujukanController::class, 'store']
    )->whereNumber('kunjungan')
        ->name('rujukan.store');

    // Keputusan pelayanan
    Route::get(
        '/kunjungan/{kunjungan}/keputusan',
        [KunjunganKeputusanController::class, 'create']
    )->whereNumber('kunjungan')
        ->name('kunjungan-keputusan.create');

    Route::post(
        '/kunjungan/{kunjungan}/keputusan',
        [KunjunganKeputusanController::class, 'store']
    )->whereNumber('kunjungan')
        ->name('kunjungan-keputusan.store');

    // Ringkasan dan penyelesaian kunjungan
    Route::get(
        '/kunjungan/{kunjungan}/ringkasan',
        [KunjunganRingkasanController::class, 'show']
    )->whereNumber('kunjungan')
        ->name('kunjungan-ringkasan.show');

    Route::post(
        '/kunjungan/{kunjungan}/selesai',
        [KunjunganRingkasanController::class, 'selesai']
    )->whereNumber('kunjungan')
        ->name('kunjungan-ringkasan.selesai');
});


Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get(
        '/kunjungan/{kunjungan}/resep/koreksi',
        [KoreksiResepController::class, 'create']
    )->name('kunjungan-resep.koreksi.create');

    Route::post(
        '/kunjungan/{kunjungan}/resep/koreksi',
        [KoreksiResepController::class, 'store']
    )->name('kunjungan-resep.koreksi.store');
});

/*
|--------------------------------------------------------------------------
| Master Rujukan
|--------------------------------------------------------------------------
*/

// Semua role dapat melihat daftar dan detail fasilitas rujukan.
Route::middleware(['auth', 'role:admin,petugas,pimpinan'])->group(function () {
    Route::resource('master-rujukan', MasterRujukanController::class)
        ->only(['index', 'show']);
});

// Admin dan Petugas dapat menambah serta mengedit fasilitas rujukan.
Route::middleware(['auth', 'role:admin,petugas'])->group(function () {
    Route::resource('master-rujukan', MasterRujukanController::class)
        ->except(['index', 'show', 'destroy']);
});

// Hanya Admin yang dapat menghapus fasilitas rujukan.
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::delete(
        '/master-rujukan/{master_rujukan}',
        [MasterRujukanController::class, 'destroy']
    )->name('master-rujukan.destroy');
});


/*
|--------------------------------------------------------------------------
| Mutasi Stok Obat
|--------------------------------------------------------------------------
*/

// Semua role yang berwenang dapat melihat riwayat mutasi stok.
Route::middleware(['auth', 'role:admin,petugas,pimpinan'])->group(function () {
    Route::get(
        '/obat/mutasi-stok',
        [MutasiStokController::class, 'index']
    )->name('obat.mutasi-stok.index');
});

// Hanya Admin dan Petugas yang dapat mencatat stok masuk.
Route::middleware(['auth', 'role:admin,petugas'])->group(function () {
    Route::get(
        '/obat/stok-masuk',
        [MutasiStokController::class, 'create']
    )->name('obat.stok-masuk.create');

    Route::post(
        '/obat/stok-masuk',
        [MutasiStokController::class, 'store']
    )->name('obat.stok-masuk.store');
});


/*
|--------------------------------------------------------------------------
| Profile
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';
