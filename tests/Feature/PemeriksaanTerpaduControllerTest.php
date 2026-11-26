<?php

use App\Models\Diagnosa;
use App\Models\Kunjungan;
use App\Models\MasterRujukan;
use App\Models\Obat;
use App\Models\Santri;
use App\Models\Tindakan;
use App\Models\User;

it('shows only active options from the application master models', function () {
    $petugas = User::create([
        'name' => 'Petugas Uji',
        'username' => 'petugas-test',
        'email' => 'petugas-test@example.test',
        'password' => 'password',
        'role' => 'petugas',
        'is_active' => true,
    ]);

    $santri = Santri::create([
        'nomor_induk' => 'SN-TEST-001',
        'nama' => 'Santri Uji',
        'jenis_kelamin' => 'L',
    ]);

    $kunjungan = Kunjungan::create([
        'kode_kunjungan' => 'KJ-TEST-001',
        'santri_id' => $santri->id,
        'petugas_id' => $petugas->id,
        'tanggal' => '2026-10-19',
        'waktu' => '09:00:00',
        'keluhan' => 'Demam',
    ]);

    Diagnosa::create(['kode' => 'D-AKTIF', 'nama' => 'Diagnosa Aktif', 'is_active' => true]);
    Diagnosa::create(['kode' => 'D-NONAKTIF', 'nama' => 'Diagnosa Nonaktif', 'is_active' => false]);
    Tindakan::create(['kode' => 'T-AKTIF', 'nama' => 'Tindakan Aktif', 'is_active' => true]);
    Tindakan::create(['kode' => 'T-NONAKTIF', 'nama' => 'Tindakan Nonaktif', 'is_active' => false]);
    Obat::create([
        'kode' => 'O-AKTIF',
        'nama' => 'Obat Aktif',
        'bentuk' => 'Tablet',
        'satuan' => 'tablet',
        'is_active' => true,
    ]);
    Obat::create([
        'kode' => 'O-NONAKTIF',
        'nama' => 'Obat Nonaktif',
        'bentuk' => 'Tablet',
        'satuan' => 'tablet',
        'is_active' => false,
    ]);
    MasterRujukan::create(['nama_fasilitas' => 'Fasilitas Aktif', 'is_active' => true]);
    MasterRujukan::create(['nama_fasilitas' => 'Fasilitas Nonaktif', 'is_active' => false]);

    $response = $this->actingAs($petugas)
        ->get(route('pemeriksaan-terpadu.create', $kunjungan));

    $response->assertOk()
        ->assertSeeText('Diagnosa Aktif')
        ->assertDontSeeText('Diagnosa Nonaktif')
        ->assertSeeText('Tindakan Aktif')
        ->assertDontSeeText('Tindakan Nonaktif')
        ->assertSeeText('Obat Aktif')
        ->assertDontSeeText('Obat Nonaktif')
        ->assertSeeText('Fasilitas Aktif')
        ->assertDontSeeText('Fasilitas Nonaktif');
});

it('stores a prescription using the active application models and adjusts stock', function () {
    $petugas = User::create([
        'name' => 'Petugas Resep Uji',
        'username' => 'petugas-resep-test',
        'email' => 'petugas-resep-test@example.test',
        'password' => 'password',
        'role' => 'petugas',
        'is_active' => true,
    ]);

    $santri = Santri::create([
        'nomor_induk' => 'SN-TEST-002',
        'nama' => 'Santri Resep',
        'jenis_kelamin' => 'P',
    ]);

    $kunjungan = Kunjungan::create([
        'kode_kunjungan' => 'KJ-TEST-002',
        'santri_id' => $santri->id,
        'petugas_id' => $petugas->id,
        'tanggal' => '2026-10-19',
        'waktu' => '09:30:00',
        'keluhan' => 'Batuk',
    ]);

    $diagnosa = Diagnosa::create([
        'kode' => 'D-RESEP',
        'nama' => 'Diagnosa Resep',
        'is_active' => true,
    ]);
    $tindakan = Tindakan::create([
        'kode' => 'T-RESEP',
        'nama' => 'Tindakan Resep',
        'is_active' => true,
    ]);
    $obat = Obat::create([
        'kode' => 'O-RESEP',
        'nama' => 'Obat Resep',
        'bentuk' => 'Tablet',
        'satuan' => 'tablet',
        'stok' => 10,
        'is_active' => true,
    ]);

    $response = $this->actingAs($petugas)
        ->post(route('pemeriksaan-terpadu.store', $kunjungan), [
            'tekanan_darah' => '120/80',
            'suhu' => 37.5,
            'diagnosa_ids' => [$diagnosa->id],
            'tindakan_ids' => [$tindakan->id],
            'perlu_rujukan' => '0',
            'perlu_obat' => '1',
            'obat_ids' => [$obat->id],
            'jumlah' => [$obat->id => 2],
            'dosis' => [$obat->id => '1 tablet'],
            'frekuensi' => [$obat->id => '3 kali sehari'],
            'aturan_pakai' => [$obat->id => 'Sesudah makan'],
        ]);

    $response->assertRedirect(route('kunjungan.show', $kunjungan));
    $this->assertDatabaseHas('kunjungans', [
        'id' => $kunjungan->id,
        'status' => 'selesai',
        'perlu_rujukan' => false,
        'perlu_obat' => true,
    ]);
    $this->assertDatabaseHas('pemeriksaans', ['kunjungan_id' => $kunjungan->id]);
    $this->assertDatabaseHas('kunjungan_diagnosa', [
        'kunjungan_id' => $kunjungan->id,
        'diagnosa_id' => $diagnosa->id,
    ]);
    $this->assertDatabaseHas('kunjungan_tindakan', [
        'kunjungan_id' => $kunjungan->id,
        'tindakan_id' => $tindakan->id,
    ]);
    $this->assertDatabaseHas('obats', ['id' => $obat->id, 'stok' => 8]);
    $this->assertDatabaseHas('mutasi_stoks', [
        'obat_id' => $obat->id,
        'jenis' => 'keluar',
        'jumlah' => 2,
    ]);
});
