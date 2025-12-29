<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wna extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama_lengkap', // <--- PASTIKAN TULISANNYA INI (Bukan 'nama_wna')
        'nomor_paspor',
        'kebangsaan',
        'tanggal_tiba',
        'masa_berlaku_izin_tinggal',
        'tujuan_kunjungan',
        'sponsor',
        'alamat_menginap',
        'foto_dokumen',
        'status_verifikasi',
    ];

    // Casting tanggal agar tidak error format() di dashboard
    protected $casts = [
        'tanggal_tiba' => 'date',
        'masa_berlaku_izin_tinggal' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
