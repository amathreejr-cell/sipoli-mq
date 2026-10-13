<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rujukan extends Model
{
    protected $table = 'rujukans';

    protected $fillable = [
        'kunjungan_id',
        'rujukan_id',
        'tanggal_rujukan',
        'fasilitas_tujuan',
        'alasan',
        'keterangan',
        'status',
    ];

    protected $casts = [
        'tanggal_rujukan' => 'date',
    ];

    public function kunjungan(): BelongsTo
    {
        return $this->belongsTo(Kunjungan::class);
    }

    public function masterRujukan(): BelongsTo
    {
        return $this->belongsTo(
            MasterRujukan::class,
            'rujukan_id'
        );
    }
}