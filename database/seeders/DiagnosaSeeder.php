<?php

namespace Database\Seeders;

use App\Models\Diagnosa;
use Illuminate\Database\Seeder;

class DiagnosaSeeder extends Seeder
{
    public function run(): void
    {
        $diagnosas = [
            [
                'kode' => 'D001',
                'nama' => 'Demam',
                'deskripsi' => 'Peningkatan suhu tubuh di atas kondisi normal.',
                'is_active' => true,
            ],
            [
                'kode' => 'D002',
                'nama' => 'Batuk',
                'deskripsi' => 'Keluhan batuk dengan atau tanpa dahak.',
                'is_active' => true,
            ],
            [
                'kode' => 'D003',
                'nama' => 'Flu',
                'deskripsi' => 'Keluhan pilek, bersin, hidung tersumbat, atau gejala flu.',
                'is_active' => true,
            ],
            [
                'kode' => 'D004',
                'nama' => 'Sakit Kepala',
                'deskripsi' => 'Keluhan nyeri atau rasa tidak nyaman pada kepala.',
                'is_active' => true,
            ],
            [
                'kode' => 'D005',
                'nama' => 'Sakit Perut',
                'deskripsi' => 'Keluhan nyeri atau rasa tidak nyaman pada bagian perut.',
                'is_active' => true,
            ],
            [
                'kode' => 'D006',
                'nama' => 'Diare',
                'deskripsi' => 'Keluhan buang air besar dengan konsistensi lebih cair atau frekuensi meningkat.',
                'is_active' => true,
            ],
            [
                'kode' => 'D007',
                'nama' => 'Mual',
                'deskripsi' => 'Keluhan rasa ingin muntah.',
                'is_active' => true,
            ],
            [
                'kode' => 'D008',
                'nama' => 'Luka Ringan',
                'deskripsi' => 'Cedera atau luka ringan yang membutuhkan penanganan awal.',
                'is_active' => true,
            ],
        ];

        foreach ($diagnosas as $data) {
            Diagnosa::create($data);
        }
    }
}