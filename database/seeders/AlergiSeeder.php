<?php

namespace Database\Seeders;

use App\Models\Alergi;
use Illuminate\Database\Seeder;

class AlergiSeeder extends Seeder
{
    public function run(): void
    {
        $alergis = [
            [
                'santri_id' => 1,
                'jenis' => 'Obat',
                'nama' => 'Contoh Obat A',
                'reaksi' => 'Gatal',
                'keterangan' => 'Data dummy untuk testing sistem.',
            ],
            [
                'santri_id' => 1,
                'jenis' => 'Makanan',
                'nama' => 'Udang',
                'reaksi' => 'Gatal',
                'keterangan' => 'Data dummy untuk testing sistem.',
            ],
            [
                'santri_id' => 2,
                'jenis' => 'Makanan',
                'nama' => 'Telur',
                'reaksi' => 'Ruam',
                'keterangan' => 'Data dummy untuk testing sistem.',
            ],
            [
                'santri_id' => 3,
                'jenis' => 'Lingkungan',
                'nama' => 'Debu',
                'reaksi' => 'Bersin',
                'keterangan' => 'Data dummy untuk testing sistem.',
            ],
        ];

        foreach ($alergis as $data) {
            Alergi::create($data);
        }
    }
}