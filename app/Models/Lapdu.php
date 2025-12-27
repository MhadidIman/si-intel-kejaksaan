<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lapdu extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nomor_surat',
        'tanggal_terima', // Pastikan sesuai database
        'nama_pelapor',
        'no_hp_pelapor',
        'nik',            // Tambahan sesuai form baru
        'terlapor',       // Di controller baru kita pakai 'nama_terlapor', tapi di db lama 'terlapor'. Kita samakan jadi 'nama_terlapor' agar konsisten.
        'nama_terlapor',  // <-- Gunakan ini jika di migration pakai nama_terlapor
        'kategori_laporan',
        'uraian_pengaduan',
        'bukti_dukung',   // Ganti bukti_pendukung jadi bukti_dukung
        'status_laporan', // <-- PENTING: Ganti 'status' jadi 'status_laporan'
        'keterangan_tindak_lanjut',
        'disposisi_pimpinan',
        'status_verifikasi', // Tambahan wajib untuk admin
    ];

    protected $casts = [
        'tanggal_terima' => 'date',
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
