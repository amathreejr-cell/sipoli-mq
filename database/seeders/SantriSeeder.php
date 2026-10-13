<?php

namespace Database\Seeders;

use App\Models\Santri;
use Illuminate\Database\Seeder;

class SantriSeeder extends Seeder
{
    public function run(): void
    {
        $santris = [
            [
                'nomor_induk' => 'SMP-2026-001',
                'nama' => 'Ahmad Fauzan',
                'tempat_lahir' => 'Jombang',
                'jenis_kelamin' => 'L',
                'tanggal_lahir' => '2012-05-10',
                'kamar' => 'Maq\'adu Shidqin 12',
                'sekolah' => 'SMP Al Furqan MQ',
                'kelas' => '2 SMP',
                'alamat' => 'Jombang',
                'status' => 'aktif',
            ],
            [
                'nomor_induk' => 'SMP-2026-002',
                'nama' => 'Muhammad Rizky',
                'tempat_lahir' => 'Mojokerto',
                'jenis_kelamin' => 'L',
                'tanggal_lahir' => '2012-08-21',
                'kamar' => 'Maq\'adu Shidqin 12',
                'sekolah' => 'SMP Al Furqan MQ',
                'kelas' => '2 SMP',
                'alamat' => 'Mojokerto',
                'status' => 'aktif',
            ],
            [
                'nomor_induk' => 'SMP-2026-003',
                'nama' => 'Abdullah Fikri',
                'tempat_lahir' => 'Kediri',
                'jenis_kelamin' => 'L',
                'tanggal_lahir' => '2012-03-15',
                'kamar' => 'Maq\'adu Shidqin 12',
                'sekolah' => 'SMP Al Furqan MQ',
                'kelas' => '2 SMP',
                'alamat' => 'Kediri',
                'status' => 'aktif',
            ],
            [
                'nomor_induk' => 'SMP-2026-004',
                'nama' => 'Ali Akbar',
                'tempat_lahir' => 'Nganjuk',
                'jenis_kelamin' => 'L',
                'tanggal_lahir' => '2012-11-02',
                'kamar' => 'Maq\'adu Shidqin 12',
                'sekolah' => 'SMP Al Furqan MQ',
                'kelas' => '2 SMP',
                'alamat' => 'Nganjuk',
                'status' => 'aktif',
            ],
            [
                'nomor_induk' => 'SMP-2026-005',
                'nama' => 'Yusuf Maulana',
                'tempat_lahir' => 'Surabaya',
                'jenis_kelamin' => 'L',
                'tanggal_lahir' => '2012-07-18',
                'kamar' => 'Maq\'adu Shidqin 12',
                'sekolah' => 'SMP Al Furqan MQ',
                'kelas' => '2 SMP',
                'alamat' => 'Surabaya',
                'status' => 'aktif',
            ],
        ];

        foreach ($santris as $data) {
            Santri::create($data);
        }
    }
}