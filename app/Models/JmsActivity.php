<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JmsActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama_sekolah',
        'tanggal_kegiatan',
        'materi',
        'jumlah_siswa',
        'nama_jaksa',
        'keterangan',
        'foto_kegiatan',
        'status_verifikasi', // Status Admin
    ];

    protected $casts = [
        'tanggal_kegiatan' => 'date',
    ];
}
