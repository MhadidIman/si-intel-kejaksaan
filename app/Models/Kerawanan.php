<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kerawanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'kecamatan',
        'bidang',
        'potensi_ancaman',
        'sumber_informasi',
        'tingkat_rawan',
        'upaya_pencegahan',
        'status_verifikasi', // Status Admin
    ];
}
