<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Resep extends Model
{
    protected $table = 'reseps';

    protected $fillable = [
        'kunjungan_id',
        'nomor_resep',
        'catatan',
    ];

    public function kunjungan(): BelongsTo
    {
        return $this->belongsTo(Kunjungan::class);
    }

    public function details(): HasMany
    {
        return $this->hasMany(ResepDetail::class);
    }

    public function koreksiReseps(): HasMany
    {
        return $this->hasMany(KoreksiResep::class);
    }
}
