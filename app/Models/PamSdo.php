<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PamSdo extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',            // <--- WAJIB ADA (Agar terhitung di dashboard)
        'nama_pegawai',       // Sesuai migration
        'nip_nrp',
        'pangkat_jabatan',
        'satuan_kerja',
        'permasalahan',
        'keterangan',
        'status_pam',         // clear / diawasi / ditindak
        'foto',
        'status_verifikasi',  // pending / disetujui / ditolak
    ];

    protected $casts = [
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
