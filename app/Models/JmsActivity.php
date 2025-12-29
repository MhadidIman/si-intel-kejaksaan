<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JmsActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',            // <--- WAJIB ADA (Agar terhitung di dashboard)
        'nama_sekolah',
        'tanggal_kegiatan',
        'materi',
        'jumlah_siswa',
        'nama_jaksa',
        'keterangan',
        'foto_kegiatan',
        'status_verifikasi',  // pending / disetujui / ditolak
    ];

    protected $casts = [
        'tanggal_kegiatan' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relasi ke tabel User
     * Agar kita tahu siapa pegawai yang menginput laporan ini.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
