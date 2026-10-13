<?php

namespace Database\Seeders;

use App\Models\WaliSantri;
use Illuminate\Database\Seeder;

class WaliSantriSeeder extends Seeder
{
    public function run(): void
    {
        $waliSantri = [
            [
                'nama' => 'Bapak Ahmad Fauzi',
                'hubungan' => 'Ayah',
                'no_hp' => '081234567801',
                'alamat' => 'Jombang',
            ],
            [
                'nama' => 'Bapak Muhammad Hadi',
                'hubungan' => 'Ayah',
                'no_hp' => '081234567802',
                'alamat' => 'Mojokerto',
            ],
            [
                'nama' => 'Ibu Siti Aminah',
                'hubungan' => 'Ibu',
                'no_hp' => '081234567803',
                'alamat' => 'Kediri',
            ],
            [
                'nama' => 'Bapak Abdul Rahman',
                'hubungan' => 'Ayah',
                'no_hp' => '081234567804',
                'alamat' => 'Surabaya',
            ],
            [
                'nama' => 'Ibu Nur Hayati',
                'hubungan' => 'Ibu',
                'no_hp' => '081234567805',
                'alamat' => 'Nganjuk',
            ],
        ];

        foreach ($waliSantri as $data) {
            WaliSantri::create($data);
        }
    }
}