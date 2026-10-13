<?php

namespace Database\Seeders;

use App\Models\Tindakan;
use Illuminate\Database\Seeder;

class TindakanSeeder extends Seeder
{
    public function run(): void
    {
        $tindakans = [
            [
                'kode' => 'T001',
                'nama' => 'Pemeriksaan Umum',
                'deskripsi' => 'Pemeriksaan kondisi kesehatan umum santri.',
                'is_active' => true,
            ],
            [
                'kode' => 'T002',
                'nama' => 'Pemberian Obat',
                'deskripsi' => 'Pemberian obat sesuai hasil pemeriksaan.',
                'is_active' => true,
            ],
            [
                'kode' => 'T003',
                'nama' => 'Perawatan Luka',
                'deskripsi' => 'Penanganan awal dan perawatan luka ringan.',
                'is_active' => true,
            ],
            [
                'kode' => 'T004',
                'nama' => 'Kompres',
                'deskripsi' => 'Pemberian kompres sesuai kebutuhan.',
                'is_active' => true,
            ],
            [
                'kode' => 'T005',
                'nama' => 'Observasi',
                'deskripsi' => 'Pemantauan kondisi santri setelah pemeriksaan.',
                'is_active' => true,
            ],
            [
                'kode' => 'T006',
                'nama' => 'Edukasi Kesehatan',
                'deskripsi' => 'Pemberian edukasi mengenai kondisi dan perawatan kesehatan.',
                'is_active' => true,
            ],
        ];

        foreach ($tindakans as $data) {
            Tindakan::create($data);
        }
    }
}