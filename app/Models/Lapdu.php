<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lapdu extends Model
{
    use HasFactory;

    /**
     * Atribut yang dapat diisi secara massal.
     * Ditambahkan 'user_id' untuk pencatatan penginput data.
     */
    protected $fillable = [
        'user_id',
        'nomor_surat',
        'tanggal_terima',
        'nama_pelapor',
        'no_hp_pelapor',
        'terlapor',
        'uraian_pengaduan',
        'bukti_pendukung',
        'disposisi_pimpinan',
        'status',
    ];

    /**
     * Cast atribut ke tipe data tertentu.
     */
    protected $casts = [
        'tanggal_terima' => 'date',
    ];

    /**
     * RELASI: Menghubungkan Laporan Pengaduan ke Staff yang menginputnya.
     * Digunakan oleh Admin untuk memantau produktivitas staff di Dashboard.
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
