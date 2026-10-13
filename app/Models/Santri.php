<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Santri extends Model
{
    use HasFactory;

    protected $table = 'santri';

    protected $fillable = [
        'nomor_induk',
        'nama',
        'tempat_lahir',
        'jenis_kelamin',
        'tanggal_lahir',
        'kamar',
        'sekolah',
        'kelas',
        'alamat',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_lahir' => 'date',
        ];
    }

    public function alergis()
    {
        return $this->hasMany(Alergi::class);
    }

    public function kunjungans()
    {
        return $this->hasMany(Kunjungan::class);
    }
}