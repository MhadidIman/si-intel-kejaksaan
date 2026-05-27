<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kerawanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'kecamatan',
        'bidang',
        'potensi_ancaman',
        'sumber_informasi',

        // --- TAMBAHAN GIS & SPK ---
        'latitude',
        'longitude',
        'kriteria_dampak',
        'kriteria_probabilitas',
        'kriteria_eskalasi',
        'skor_spk',
        // --------------------------

        'tingkat_rawan',
        'upaya_pencegahan',
        'status_verifikasi',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'skor_spk' => 'decimal:2',
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
