<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ResepDetail extends Model
{
    protected $table = 'resep_details';

    protected $fillable = [
        'resep_id',
        'obat_id',
        'jumlah',
        'dosis',
        'frekuensi',
        'aturan_pakai',
        'keterangan',
    ];

    protected $casts = [
        'jumlah' => 'integer',
    ];

    public function resep(): BelongsTo
    {
        return $this->belongsTo(Resep::class);
    }

    public function obat(): BelongsTo
    {
        return $this->belongsTo(Obat::class);
    }
}