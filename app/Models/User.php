<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Atribut yang dapat diisi secara massal (Mass Assignable).
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'nip',           // Nomor Induk Pegawai
        'role',          // admin / staff
        'satuan_kerja',  // Kejaksaan Negeri Banjarmasin
        'pangkat',       // Jaksa Pratama, dll
        'jabatan',       // Kasubsi, Staff, dll
        'no_hp',         // Nomor WhatsApp
    ];

    /**
     * Atribut yang disembunyikan saat serialisasi.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casting atribut ke tipe data tertentu.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Helper untuk mengecek apakah user adalah Admin.
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /*
    |--------------------------------------------------------------------------
    | LANGKAH NOMOR 2: RELASI LOG AKTIVITAS
    |--------------------------------------------------------------------------
    */

    /**
     * Menghubungkan User dengan catatan Log Aktivitas (Login, dll).
     */
    public function activityLogs()
    {
        return $this->hasMany(ActivityLog::class);
    }

    /*
    |--------------------------------------------------------------------------
    | RELASI BANK DATA (STATISTIK KINERJA)
    |--------------------------------------------------------------------------
    */

    public function lapinhars()
    {
        return $this->hasMany(Lapinhar::class);
    }

    public function dpos()
    {
        return $this->hasMany(Dpo::class);
    }

    public function wnas()
    {
        return $this->hasMany(Wna::class);
    }

    public function ormas()
    {
        return $this->hasMany(Ormas::class);
    }

    public function pamSdos()
    {
        return $this->hasMany(PamSdo::class);
    }

    public function jmsActivities()
    {
        return $this->hasMany(JmsActivity::class);
    }

    public function kerawanans()
    {
        return $this->hasMany(Kerawanan::class);
    }

    public function lapdus()
    {
        return $this->hasMany(Lapdu::class);
    }
}
