<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JmsActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_sekolah',
        'tanggal_kegiatan',
        'materi',
        'jumlah_siswa',
        'nama_jaksa',
        'keterangan',
        'foto_kegiatan',
    ];

    protected $casts = [
        'tanggal_kegiatan' => 'date',
    ];
}
