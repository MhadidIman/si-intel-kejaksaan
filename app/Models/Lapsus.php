<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lapsus extends Model
{
    use HasFactory;

    protected $table = 'lapsus';

    protected $fillable = [
        'user_id',
        'tanggal_laporan',
        'tingkat_kerahasiaan',
        'siapa',
        'apa',
        'kapan',
        'dimana',
        'mengapa',
        'bagaimana',
        'analisa',
        'saran',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
