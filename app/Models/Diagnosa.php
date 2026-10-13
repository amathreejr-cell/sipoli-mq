<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Diagnosa extends Model
{
    protected $table = 'diagnosas';

    protected $fillable = [
        'kode',
        'nama',
        'deskripsi',
        'is_active',
    ];

    public function kunjungans(): BelongsToMany
    {
        return $this->belongsToMany(
            Kunjungan::class,
            'kunjungan_diagnosa'
        )->withPivot('catatan')
         ->withTimestamps();
    }
}