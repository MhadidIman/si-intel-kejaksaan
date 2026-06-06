<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lapdu extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',                 // Relasi ke User (Petugas Input - bisa null untuk publik)
        'nomor_surat',
        'tanggal_terima',
        'status_verifikasi',       // pending / disetujui / ditolak
        'nama_pelapor',            // Cukup tulis satu kali
        'nik',
        'no_hp_pelapor',           
        'nama_terlapor',           
        'kategori_laporan',        // Korupsi / Umum / Pegawai
        'uraian_pengaduan',
        'bukti_dukung',  
        'nomor_tiket',             // Fitur pelacakan publik
        'status_laporan',          // menunggu / proses / selesai
        'keterangan_tindak_lanjut',
    ];

    protected $casts = [
        'tanggal_terima' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relasi ke tabel User.
     * Tips: Gunakan 'optional' saat memanggil di Blade, 
     * contoh: {{ $lapdu->user->name ?? 'Masyarakat' }}
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}