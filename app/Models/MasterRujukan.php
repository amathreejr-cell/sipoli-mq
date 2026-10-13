<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MasterRujukan extends Model
{
    protected $table = 'master_rujukan';

    protected $fillable = [
        'nama_fasilitas',
        'alamat',
        'no_telepon',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function rujukans(): HasMany
    {
        return $this->hasMany(Rujukan::class, 'rujukan_id');
    }
}