<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Administrator SIPOLI-MQ',
            'username' => 'admin',
            'email' => 'admin@sipoli-mq.test',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'is_active' => true,
        ]);

        User::create([
            'name' => 'Petugas Poliklinik',
            'username' => 'petugas',
            'email' => 'petugas@sipoli-mq.test',
            'password' => Hash::make('password'),
            'role' => 'petugas',
            'is_active' => true,
        ]);

        User::create([
            'name' => 'Pimpinan',
            'username' => 'pimpinan',
            'email' => 'pimpinan@sipoli-mq.test',
            'password' => Hash::make('password'),
            'role' => 'pimpinan',
            'is_active' => true,
        ]);
    }
}