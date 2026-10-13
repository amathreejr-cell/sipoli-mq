<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Obat extends Model
{
    protected $table = 'obats';

    protected $fillable = [
        'kode',
        'nama',
        'bentuk',
        'satuan',
        'stok',
        'stok_minimum',
        'keterangan',
        'is_active',
    ];

    protected $casts = [
        'stok' => 'integer',
        'stok_minimum' => 'integer',
        'is_active' => 'boolean',
    ];

    public function resepDetails(): HasMany
    {
        return $this->hasMany(ResepDetail::class);
    }

    public function mutasiStoks(): HasMany
    {
        return $this->hasMany(MutasiStok::class);
    }
}
