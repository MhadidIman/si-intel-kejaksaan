<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;

    /**
     * Kolom yang boleh diisi secara massal.
     * Ini akan memperbaiki error MassAssignmentException.
     */
    protected $fillable = [
        'user_id',
        'activity',
        'description',
        'ip_address',
        'user_agent',
    ];

    /**
     * Relasi balik ke Model User.
     * Agar kita bisa tahu siapa personil yang melakukan aktivitas tersebut.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
