<?php

namespace Database\Seeders;

use App\Models\Angkatan;
use Illuminate\Database\Seeder;

class AngkatanSeeder extends Seeder
{
    public function run(): void
    {
        $angkatan = [
            [
                'nama' => 'Angkatan 2024',
                'tahun_masuk' => 2024,
                'tahun_lulus' => 2027,
                'is_active' => true,
            ],
            [
                'nama' => 'Angkatan 2025',
                'tahun_masuk' => 2025,
                'tahun_lulus' => 2028,
                'is_active' => true,
            ],
            [
                'nama' => 'Angkatan 2026',
                'tahun_masuk' => 2026,
                'tahun_lulus' => 2029,
                'is_active' => true,
            ],
        ];

        foreach ($angkatan as $data) {
            Angkatan::create($data);
        }
    }
}