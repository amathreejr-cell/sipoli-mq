<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            DiagnosaSeeder::class,
            TindakanSeeder::class,
            ObatSeeder::class,
            SantriSeeder::class,
            AlergiSeeder::class,
            KunjunganSeeder::class,
            PemeriksaanSeeder::class,
            KunjunganDiagnosaSeeder::class,
            KunjunganTindakanSeeder::class,
            ResepSeeder::class,
            RujukanSeeder::class,
        ]);
    }
}