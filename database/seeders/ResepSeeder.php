<?php

namespace Database\Seeders;

use App\Models\Resep;
use App\Models\Kunjungan;
use App\Models\Obat;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResepSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {

            $kunjungan1 = Kunjungan::find(1);
            $kunjungan2 = Kunjungan::find(2);

            $paracetamol = Obat::find(1);
            $vitamin = Obat::find(3);
            $obatBatuk = Obat::find(4);

            $resep1 = Resep::create([
                'kunjungan_id' => $kunjungan1->id,
                'nomor_resep' => 'RSP-20260911-001',
                'catatan' => 'Data dummy untuk testing sistem.',
            ]);

            $resep1->details()->create([
                'obat_id' => $paracetamol->id,
                'jumlah' => 10,
                'dosis' => '500 mg',
                'frekuensi' => '3x sehari',
                'aturan_pakai' => 'Sesuai instruksi petugas',
                'keterangan' => 'Data dummy untuk testing sistem.',
            ]);

            $resep1->details()->create([
                'obat_id' => $vitamin->id,
                'jumlah' => 10,
                'dosis' => '1 tablet',
                'frekuensi' => '1x sehari',
                'aturan_pakai' => 'Sesuai instruksi petugas',
                'keterangan' => 'Data dummy untuk testing sistem.',
            ]);

            $resep2 = Resep::create([
                'kunjungan_id' => $kunjungan2->id,
                'nomor_resep' => 'RSP-20260911-002',
                'catatan' => 'Data dummy untuk testing sistem.',
            ]);

            $resep2->details()->create([
                'obat_id' => $obatBatuk->id,
                'jumlah' => 1,
                'dosis' => 'Sesuai etiket',
                'frekuensi' => 'Sesuai instruksi petugas',
                'aturan_pakai' => 'Sesuai instruksi petugas',
                'keterangan' => 'Data dummy untuk testing sistem.',
            ]);
        });
    }
}