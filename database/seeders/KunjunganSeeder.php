<?php

namespace Database\Seeders;

use App\Models\Kunjungan;
use Illuminate\Database\Seeder;

class KunjunganSeeder extends Seeder
{
    public function run(): void
    {
        $kunjungans = [
            [
                'kode_kunjungan' => 'KJ-20260911-001',
                'santri_id' => 1,
                'petugas_id' => 2,
                'tanggal' => '2026-09-11',
                'waktu' => '08:15:00',
                'keluhan' => 'Demam dan merasa kurang enak badan.',
                'status' => 'selesai',
                'catatan' => 'Data dummy untuk testing sistem.',
            ],
            [
                'kode_kunjungan' => 'KJ-20260911-002',
                'santri_id' => 2,
                'petugas_id' => 2,
                'tanggal' => '2026-09-11',
                'waktu' => '09:00:00',
                'keluhan' => 'Batuk dan pilek.',
                'status' => 'diperiksa',
                'catatan' => 'Data dummy untuk testing sistem.',
            ],
            [
                'kode_kunjungan' => 'KJ-20260911-003',
                'santri_id' => 3,
                'petugas_id' => 2,
                'tanggal' => '2026-09-10',
                'waktu' => '10:30:00',
                'keluhan' => 'Sakit kepala.',
                'status' => 'selesai',
                'catatan' => 'Data dummy untuk testing sistem.',
            ],
            [
                'kode_kunjungan' => 'KJ-20260910-004',
                'santri_id' => 4,
                'petugas_id' => 2,
                'tanggal' => '2026-09-10',
                'waktu' => '13:15:00',
                'keluhan' => 'Sakit perut.',
                'status' => 'selesai',
                'catatan' => 'Data dummy untuk testing sistem.',
            ],
            [
                'kode_kunjungan' => 'KJ-20260909-005',
                'santri_id' => 5,
                'petugas_id' => 2,
                'tanggal' => '2026-09-09',
                'waktu' => '15:00:00',
                'keluhan' => 'Luka ringan.',
                'status' => 'selesai',
                'catatan' => 'Data dummy untuk testing sistem.',
            ],
        ];

        foreach ($kunjungans as $data) {
            Kunjungan::create($data);
        }
    }
}