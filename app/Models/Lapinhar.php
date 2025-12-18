<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lapinhar extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_surat',
        'tanggal_surat',
        'sumber_informasi',
        'bidang',
        'peristiwa',
        'pendapat',
        'status',
    ];

    protected $casts = [
        'tanggal_surat' => 'date',
    ];
}
