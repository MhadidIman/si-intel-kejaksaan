<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ormas extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_organisasi',
        'ketua',
        'alamat_sekretariat',
        'bentuk_organisasi',
        'nomor_legalitas',
        'jumlah_anggota',
        'kegiatan_terakhir',
        'status',
    ];
}
