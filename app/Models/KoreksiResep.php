<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KoreksiResep extends Model
{
    protected $table = 'koreksi_reseps';

    protected $fillable = [
        'resep_id',
        'user_id',
        'alasan',
        'resep_sebelum',
        'resep_sesudah',
        'dikoreksi_pada',
    ];

    protected $casts = [
        'resep_sebelum' => 'array',
        'resep_sesudah' => 'array',
        'dikoreksi_pada' => 'datetime',
    ];

    public function resep(): BelongsTo
    {
        return $this->belongsTo(Resep::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
