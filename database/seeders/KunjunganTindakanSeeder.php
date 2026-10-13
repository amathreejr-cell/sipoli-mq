<?php

namespace Database\Seeders;

use App\Models\Kunjungan;
use App\Models\Tindakan;
use Illuminate\Database\Seeder;

class KunjunganTindakanSeeder extends Seeder
{
    public function run(): void
    {
        $kunjungan1 = Kunjungan::find(1);
        $kunjungan2 = Kunjungan::find(2);
        $kunjungan3 = Kunjungan::find(3);
        $kunjungan4 = Kunjungan::find(4);
        $kunjungan5 = Kunjungan::find(5);

        $pemeriksaan = Tindakan::find(1);
        $pemberianObat = Tindakan::find(2);
        $perawatanLuka = Tindakan::find(3);
        $observasi = Tindakan::find(5);
        $edukasi = Tindakan::find(6);

        $kunjungan1->tindakans()->attach([
            $pemeriksaan->id,
            $pemberianObat->id,
            $observasi->id,
        ]);

        $kunjungan2->tindakans()->attach([
            $pemeriksaan->id,
            $edukasi->id,
        ]);

        $kunjungan3->tindakans()->attach([
            $pemeriksaan->id,
            $observasi->id,
        ]);

        $kunjungan4->tindakans()->attach([
            $pemeriksaan->id,
            $edukasi->id,
        ]);

        $kunjungan5->tindakans()->attach([
            $pemeriksaan->id,
            $perawatanLuka->id,
        ]);
    }
}