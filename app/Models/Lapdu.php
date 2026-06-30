<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lapdu extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_tiket',
        'nama_pelapor',
        'is_anonim',
        'nik',
        'email_pelapor', // <-- INI DIA YANG DITAMBAHKAN
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'pekerjaan',
        'foto_ktp',
        'alamat_pelapor',
        'no_hp_pelapor',
        'nama_terlapor',
        'jabatan_terlapor',
        'alamat_terlapor',
        'kontak_terlapor',
        'kategori_laporan',
        'judul_laporan',
        'waktu_kejadian',
        'tempat_kejadian',
        'uraian_pengaduan',
        'bukti_dukung',
        'status_laporan',
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
