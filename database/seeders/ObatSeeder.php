<?php

namespace Database\Seeders;

use App\Models\Obat;
use Illuminate\Database\Seeder;

class ObatSeeder extends Seeder
{
    public function run(): void
    {
        $obats = [
            [
                'kode' => 'OBT-001',
                'nama' => 'Paracetamol',
                'bentuk' => 'Tablet',
                'satuan' => 'Tablet',
                'stok' => 100,
                'stok_minimum' => 20,
                'keterangan' => 'Data obat untuk keperluan testing sistem.',
                'is_active' => true,
            ],
            [
                'kode' => 'OBT-002',
                'nama' => 'Oralit',
                'bentuk' => 'Serbuk',
                'satuan' => 'Sachet',
                'stok' => 50,
                'stok_minimum' => 10,
                'keterangan' => 'Data obat untuk keperluan testing sistem.',
                'is_active' => true,
            ],
            [
                'kode' => 'OBT-003',
                'nama' => 'Vitamin',
                'bentuk' => 'Tablet',
                'satuan' => 'Tablet',
                'stok' => 100,
                'stok_minimum' => 20,
                'keterangan' => 'Data obat untuk keperluan testing sistem.',
                'is_active' => true,
            ],
            [
                'kode' => 'OBT-004',
                'nama' => 'Obat Batuk',
                'bentuk' => 'Sirup',
                'satuan' => 'Botol',
                'stok' => 20,
                'stok_minimum' => 5,
                'keterangan' => 'Data obat untuk keperluan testing sistem.',
                'is_active' => true,
            ],
            [
                'kode' => 'OBT-005',
                'nama' => 'Salep Luka',
                'bentuk' => 'Salep',
                'satuan' => 'Tube',
                'stok' => 15,
                'stok_minimum' => 5,
                'keterangan' => 'Data obat untuk keperluan testing sistem.',
                'is_active' => true,
            ],
        ];

        foreach ($obats as $data) {
            Obat::create($data);
        }
    }
}