<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // User Admin / Kasubsi (Contoh)
        User::create([
            'name' => 'Jaksa Intel',
            'nip' => '198501012010011001', // Contoh NIP format standar
            'email' => 'admin@kejaribjm.go.id',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'satuan_kerja' => 'Kejari Banjarmasin',
            'pangkat' => 'Jaksa Pratama',
            'jabatan' => 'Kasubsi Ekonomi & Keuangan',
            'no_hp' => '081234567890',
        ]);

        // User Staff Biasa
        User::create([
            'name' => 'Staff Intel',
            'nip' => '199002022015021002',
            'email' => 'staff@kejaribjm.go.id',
            'password' => Hash::make('password'),
            'role' => 'staff',
            'satuan_kerja' => 'Kejari Banjarmasin',
            'pangkat' => 'Pengatur Tingkat I',
            'jabatan' => 'Staff TU',
        ]);
    }
}
