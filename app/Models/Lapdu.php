<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lapdu extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_surat',
        'tanggal_terima',
        'nama_pelapor',
        'no_hp_pelapor',
        'terlapor',
        'uraian_pengaduan',
        'bukti_pendukung',
        'disposisi_pimpinan',
        'status',
    ];

    protected $casts = [
        'tanggal_terima' => 'date',
    ];
}
