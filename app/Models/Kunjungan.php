<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Kunjungan extends Model
{
    protected $table = 'kunjungans';

    protected $fillable = [
        'kode_kunjungan',
        'santri_id',
        'petugas_id',
        'tanggal',
        'waktu',
        'keluhan',
        'status',
        'perlu_rujukan',
        'perlu_obat',
        'catatan',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'perlu_rujukan' => 'boolean',
        'perlu_obat' => 'boolean',
    ];

    public function santri(): BelongsTo
    {
        return $this->belongsTo(Santri::class);
    }

    public function petugas(): BelongsTo
    {
        return $this->belongsTo(User::class, 'petugas_id');
    }

    public function pemeriksaan(): HasOne
    {
        return $this->hasOne(Pemeriksaan::class);
    }

    public function diagnosas(): BelongsToMany
    {
        return $this->belongsToMany(
            Diagnosa::class,
            'kunjungan_diagnosa'
        )->withPivot('catatan')
            ->withTimestamps();
    }

    public function tindakans(): BelongsToMany
    {
        return $this->belongsToMany(
            Tindakan::class,
            'kunjungan_tindakan'
        )->withPivot('catatan')
            ->withTimestamps();
    }

    public function resep(): HasOne
    {
        return $this->hasOne(Resep::class);
    }

    public function rujukan(): HasOne
    {
        return $this->hasOne(Rujukan::class);
    }
}
