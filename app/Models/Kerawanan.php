<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kerawanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'kecamatan',
        'desa',
        'jenis_ancaman',
        'tokoh_kunci',
        'deskripsi_singkat',
        'tingkat_rawan',
    ];
}
