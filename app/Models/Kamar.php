<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kamar extends Model
{
    protected $table = 'kamar';

    protected $fillable = [
        'kode',
        'nama',
        'keterangan',
        'is_active',
    ];

    public function santris(): HasMany
    {
        return $this->hasMany(Santri::class);
    }
}