<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Alergi extends Model
{
    protected $table = 'alergis';

    protected $fillable = [
        'santri_id',
        'jenis',
        'nama',
        'reaksi',
        'keterangan',
    ];

    public function santri(): BelongsTo
    {
        return $this->belongsTo(Santri::class);
    }
}