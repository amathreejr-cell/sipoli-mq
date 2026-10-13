<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tindakan extends Model
{
    protected $table = 'tindakans';

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
            'kunjungan_tindakan'
        )->withPivot('catatan')
         ->withTimestamps();
    }
}