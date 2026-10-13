<?php

namespace Database\Seeders;

use App\Models\Pemeriksaan;
use Illuminate\Database\Seeder;

class PemeriksaanSeeder extends Seeder
{
    public function run(): void
    {
        $pemeriksaans = [
            [
                'kunjungan_id' => 1,
                'tekanan_darah' => '110/70',
                'suhu' => 38.2,
                'nadi' => 88,
                'pernapasan' => 20,
                'berat_badan' => 45.50,
                'tinggi_badan' => 155.00,
                'pemeriksaan_fisik' => 'Kondisi umum cukup, suhu tubuh meningkat.',
                'catatan' => 'Data dummy untuk testing sistem.',
            ],
            [
                'kunjungan_id' => 2,
                'tekanan_darah' => '115/75',
                'suhu' => 37.4,
                'nadi' => 82,
                'pernapasan' => 21,
                'berat_badan' => 47.00,
                'tinggi_badan' => 157.00,
                'pemeriksaan_fisik' => 'Keluhan batuk dan pilek.',
                'catatan' => 'Data dummy untuk testing sistem.',
            ],
            [
                'kunjungan_id' => 3,
                'tekanan_darah' => '120/80',
                'suhu' => 36.8,
                'nadi' => 78,
                'pernapasan' => 18,
                'berat_badan' => 50.00,
                'tinggi_badan' => 160.00,
                'pemeriksaan_fisik' => 'Kondisi umum baik.',
                'catatan' => 'Data dummy untuk testing sistem.',
            ],
            [
                'kunjungan_id' => 4,
                'tekanan_darah' => '118/76',
                'suhu' => 37.0,
                'nadi' => 80,
                'pernapasan' => 19,
                'berat_badan' => 48.50,
                'tinggi_badan' => 158.00,
                'pemeriksaan_fisik' => 'Pemeriksaan fisik umum dilakukan.',
                'catatan' => 'Data dummy untuk testing sistem.',
            ],
            [
                'kunjungan_id' => 5,
                'tekanan_darah' => '120/80',
                'suhu' => 36.7,
                'nadi' => 76,
                'pernapasan' => 18,
                'berat_badan' => 46.00,
                'tinggi_badan' => 156.00,
                'pemeriksaan_fisik' => 'Terdapat luka ringan pada bagian tubuh.',
                'catatan' => 'Data dummy untuk testing sistem.',
            ],
        ];

        foreach ($pemeriksaans as $data) {
            Pemeriksaan::create($data);
        }
    }
}