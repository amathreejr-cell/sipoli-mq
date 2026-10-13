<?php

namespace Database\Seeders;

use App\Models\Kunjungan;
use App\Models\Diagnosa;
use Illuminate\Database\Seeder;

class KunjunganDiagnosaSeeder extends Seeder
{
    public function run(): void
    {
        $kunjungan1 = Kunjungan::find(1);
        $kunjungan2 = Kunjungan::find(2);
        $kunjungan3 = Kunjungan::find(3);
        $kunjungan4 = Kunjungan::find(4);
        $kunjungan5 = Kunjungan::find(5);

        $demam = Diagnosa::find(1);
        $batuk = Diagnosa::find(2);
        $flu = Diagnosa::find(3);
        $sakitKepala = Diagnosa::find(4);
        $sakitPerut = Diagnosa::find(5);
        $lukaRingan = Diagnosa::find(8);

        $kunjungan1->diagnosas()->attach($demam->id, [
            'catatan' => 'Data dummy untuk testing sistem.',
        ]);

        $kunjungan2->diagnosas()->attach([
            $batuk->id,
            $flu->id,
        ]);

        $kunjungan3->diagnosas()->attach($sakitKepala->id, [
            'catatan' => 'Data dummy untuk testing sistem.',
        ]);

        $kunjungan4->diagnosas()->attach($sakitPerut->id);

        $kunjungan5->diagnosas()->attach($lukaRingan->id);
    }
}