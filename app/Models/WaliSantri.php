<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WaliSantri extends Model
{
    protected $table = 'wali_santri';

    protected $fillable = [
        'nama',
        'hubungan',
        'no_hp',
        'alamat',
    ];

    public function santris(): HasMany
    {
        return $this->hasMany(Santri::class);
    }
}