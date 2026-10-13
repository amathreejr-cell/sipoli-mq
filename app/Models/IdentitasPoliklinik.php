<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IdentitasPoliklinik extends Model
{
    protected $table = 'identitas_poliklinik';

    protected $fillable = [
        'nama',
        'alamat',
        'telepon',
        'email',
        'logo',
        'nama_penandatangan',
        'jabatan_penandatangan',
    ];
}