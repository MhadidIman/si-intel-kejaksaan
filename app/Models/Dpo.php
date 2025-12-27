<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dpo extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', // Tambahan
        'nama_lengkap',
        'tempat_lahir',
        'tanggal_lahir',
        'kasus',
        'status_hukum',
        'ciri_fisik',
        'foto',
        'status_pencarian',
        'status_verifikasi', // Tambahan Wajib
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];
}
