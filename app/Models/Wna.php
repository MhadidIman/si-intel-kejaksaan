<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wna extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_lengkap',
        'nomor_paspor',
        'kebangsaan',
        'tanggal_tiba',
        'masa_berlaku_izin_tinggal',
        'tujuan_kunjungan',
        'sponsor',
        'alamat_menginap',
        'foto_dokumen',
    ];

    protected $casts = [
        'tanggal_tiba' => 'date',
        'masa_berlaku_izin_tinggal' => 'date',
    ];

    // Helper untuk mengecek Overstay
    public function getIsOverstayAttribute()
    {
        return $this->masa_berlaku_izin_tinggal < now();
    }
}
