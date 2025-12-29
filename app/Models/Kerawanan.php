<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kerawanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',            // <--- WAJIB ADA (Agar terhitung di dashboard)
        'kecamatan',
        'bidang',
        'potensi_ancaman',
        'sumber_informasi',
        'tingkat_rawan',      // Tinggi / Sedang / Rendah
        'upaya_pencegahan',
        'status_verifikasi',  // pending / disetujui / ditolak
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relasi ke tabel User
     * Agar kita tahu siapa pegawai yang menginput data ini.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
