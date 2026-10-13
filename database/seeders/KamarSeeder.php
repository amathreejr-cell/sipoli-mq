<?php

namespace Database\Seeders;

use App\Models\Kamar;
use Illuminate\Database\Seeder;

class KamarSeeder extends Seeder
{
    public function run(): void
    {
        $kamar = [
            [
                'kode' => 'KMR-01',
                'nama' => 'Kamar 01',
                'keterangan' => 'Data awal kamar',
                'is_active' => true,
            ],
            [
                'kode' => 'KMR-02',
                'nama' => 'Kamar 02',
                'keterangan' => 'Data awal kamar',
                'is_active' => true,
            ],
            [
                'kode' => 'KMR-03',
                'nama' => 'Kamar 03',
                'keterangan' => 'Data awal kamar',
                'is_active' => true,
            ],
            [
                'kode' => 'KMR-04',
                'nama' => 'Kamar 04',
                'keterangan' => 'Data awal kamar',
                'is_active' => true,
            ],
            [
                'kode' => 'KMR-05',
                'nama' => 'Kamar 05',
                'keterangan' => 'Data awal kamar',
                'is_active' => true,
            ],
        ];

        foreach ($kamar as $data) {
            Kamar::create($data);
        }
    }
}