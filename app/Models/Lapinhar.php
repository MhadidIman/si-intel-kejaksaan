<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lapinhar extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',            // Pastikan ini ada jika menggunakan relasi user
        'nomor_surat',
        'tanggal_surat',
        'sumber_informasi',
        'bidang',
        'peristiwa',
        'pendapat',
        'status',             // Status kerahasiaan
        'status_verifikasi',  // <--- WAJIB DITAMBAHKAN
    ];

    protected $casts = [
        'tanggal_surat' => 'date',
    ];

    // Opsional: Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
