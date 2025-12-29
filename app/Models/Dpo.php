<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dpo extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',            // <--- WAJIB ADA (Agar terhitung di dashboard)
        'nama_lengkap',       // Sesuai migration
        'tempat_lahir',
        'tanggal_lahir',
        'kasus',
        'status_hukum',
        'ciri_fisik',
        'foto',
        'status_pencarian',   // buron / tertangkap
        'status_verifikasi',  // pending / disetujui / ditolak
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tanggal_lahir' => 'date',
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
