<?php

namespace Database\Seeders;

use App\Models\Rujukan;
use App\Models\Kunjungan;
use Illuminate\Database\Seeder;

class RujukanSeeder extends Seeder
{
    public function run(): void
    {
        $kunjungan = Kunjungan::find(5);

        Rujukan::create([
            'kunjungan_id' => $kunjungan->id,
            'tanggal_rujukan' => '2026-09-09',
            'fasilitas_tujuan' => 'Fasilitas Kesehatan Rujukan',
            'alasan' => 'Memerlukan pemeriksaan lebih lanjut.',
            'keterangan' => 'Data dummy untuk testing sistem.',
            'status' => 'direncanakan',
        ]);
    }
}