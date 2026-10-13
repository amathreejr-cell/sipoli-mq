<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Angkatan extends Model
{
    protected $table = 'angkatan';

    protected $fillable = [
        'nama',
        'tahun_masuk',
        'tahun_lulus',
        'is_active',
    ];

    public function santris(): HasMany
    {
        return $this->hasMany(Santri::class);
    }
}