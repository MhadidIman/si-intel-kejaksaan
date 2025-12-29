<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PamSdo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_pegawai',
        'nip_nrp',
        'pangkat_jabatan',
        'satuan_kerja',
        'permasalahan',
        'keterangan',
        'status_pam',        // Status Operasional
        'foto',
        'status_verifikasi', // Status Admin
    ];


    protected $casts = [
        'tanggal_kegiatan' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
