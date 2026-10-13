<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pemeriksaan extends Model
{
    protected $table = 'pemeriksaans';

    protected $fillable = [
        'kunjungan_id',
        'tekanan_darah',
        'suhu',
        'nadi',
        'pernapasan',
        'berat_badan',
        'tinggi_badan',
        'pemeriksaan_fisik',
        'catatan',
    ];

    protected $casts = [
        'suhu' => 'decimal:1',
        'berat_badan' => 'decimal:2',
        'tinggi_badan' => 'decimal:2',
        'nadi' => 'integer',
        'pernapasan' => 'integer',
    ];

    public function kunjungan(): BelongsTo
    {
        return $this->belongsTo(Kunjungan::class);
    }
}