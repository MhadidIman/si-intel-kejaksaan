<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lapdu extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',                  // Relasi ke User (Petugas Input)
        'nomor_surat',
        'tanggal_terima',
        'status_verifikasi',        // pending / disetujui / ditolak
        'nama_pelapor',
        'nik',
        'no_hp_pelapor',            // Sesuai migration
        'nama_terlapor',            // Sesuai migration
        'kategori_laporan',         // Korupsi / Umum / Pegawai
        'uraian_pengaduan',
        'bukti_dukung',             // File Upload
        'status_laporan',           // menunggu / proses / selesai
        'keterangan_tindak_lanjut',
    ];

    protected $casts = [
        'tanggal_terima' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relasi ke tabel User.
     * Menggunakan nama 'user' agar konsisten dengan model lain (DPO, WNA, dll)
     * sehingga mudah dipanggil di Dashboard ($lapdu->user->name).
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
