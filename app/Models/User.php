<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Atribut yang dapat diisi secara massal.
     */
    protected $fillable = [
        'name',
        'nip',      // NIP Pegawai Kejaksaan
        'email',
        'password',
        'role',     // Role: admin atau staff
    ];

    /**
     * Atribut yang disembunyikan untuk serialisasi.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Cast atribut ke tipe data tertentu.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Helper: Cek apakah user adalah Admin
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }



    /**
     * Helper: Cek apakah user adalah Staff
     */
    public function isStaff(): bool
    {
        return $this->role === 'staff';
    }

    /**
     * RELASI UNTUK MONITORING PRODUKTIVITAS STAFF
     * Menghubungkan User ke data yang mereka input.
     */

    public function lapinhars(): HasMany
    {
        return $this->hasMany(Lapinhar::class, 'user_id');
    }

    public function dpos(): HasMany
    {
        return $this->hasMany(Dpo::class, 'user_id');
    }

    public function wnas(): HasMany
    {
        return $this->hasMany(Wna::class, 'user_id');
    }

    public function lapdus(): HasMany
    {
        return $this->hasMany(Lapdu::class, 'user_id');
    }

    public function kerawanans(): HasMany
    {
        return $this->hasMany(Kerawanan::class, 'user_id');
    }
}
