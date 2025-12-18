<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PamSdo extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal_laporan',
        'kategori',
        'target',
        'nip_atau_nomor',
        'uraian_masalah',
        'tindakan_pam',
        'keterangan',
        'status',
    ];

    protected $casts = [
        'tanggal_laporan' => 'date',
    ];
}
