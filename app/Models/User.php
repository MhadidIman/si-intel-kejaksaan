<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * Atribut yang dapat diisi secara massal (Mass Assignable).
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'nik',
        'nip',
        'role',
        'satuan_kerja',
        'pangkat',
        'jabatan',
        'no_hp',
        'foto_profile',
        'email_verified_at', // <--- TAMBAHKAN BARIS INI
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
    public function isMasyarakat()
    {
        return $this->role === 'masyarakat';
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

    public function lapsuses()
    {
        return $this->hasMany(Lapsus::class);
    }
}
