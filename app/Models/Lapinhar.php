<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lapinhar extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',            // <--- WAJIB ADA (Agar terhitung di dashboard)
        'nomor_surat',
        'tanggal_surat',
        'sumber_informasi',
        'bidang',             // Sesuaikan dengan input form Anda
        'peristiwa',          // Sesuaikan dengan input form Anda
        'pendapat',           // Sesuaikan dengan input form Anda
        'status',             // rahasia/biasa
        'status_verifikasi',  // pending/disetujui
    ];

    /**
     * Casting kolom tanggal agar bisa menggunakan ->format('d M Y') di View.
     * INI SOLUSI ERROR "Call to a member function format() on string"
     */
    protected $casts = [
        'tanggal_surat' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
