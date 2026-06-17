<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Akun ADMIN (Role: Admin / Verifikator)
        User::create([
            'name' => 'Administrator Intel',
            'nip' => '199001012020011001',
            'email' => 'admin@kejaribanjarmasin.go.id',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'jabatan' => 'Kasi Intelijen',
            'pangkat' => 'Penata Tk.I (III/d)',
            'satuan_kerja' => 'Kejari Banjarmasin',
            'email_verified_at' => now(),

        ]);


        // 3. Akun STAFF 2 
        User::create([
            'name' => 'Jaksa Fulan, S.H.',
            'nip' => '199505052021011002',
            'email' => 'jaksa@kejaribanjarmasin.go.id',
            'password' => Hash::make('password'),
            'role' => 'staff',
            'jabatan' => 'Jaksa Fungsional',
            'pangkat' => 'Ajun Jaksa Madya (III/a)',
            'satuan_kerja' => 'Kejari Banjarmasin',
            'email_verified_at' => now(),
        ]);

        // 4. Akun STAFF 3 (Untuk Demo Leaderboard Peringkat)
        User::create([
            'name' => 'Andi Pratama, S.H.',
            'nip' => '199303122019021003',
            'email' => 'andi@kejaribanjarmasin.go.id',
            'password' => Hash::make('password'),
            'role' => 'staff',
            'jabatan' => 'Staff Intelijen',
            'pangkat' => 'Pengatur (II/c)',
            'satuan_kerja' => 'Kejari Banjarmasin',
            'email_verified_at' => now(),
        ]);

        // 5. Akun STAFF 4
        User::create([
            'name' => 'Siti Aminah, S.H., M.H.',
            'nip' => '199607222022032004',
            'email' => 'siti@kejaribanjarmasin.go.id',
            'password' => Hash::make('password'),
            'role' => 'staff',
            'jabatan' => 'Staff TU Intelijen',
            'pangkat' => 'Penata Muda (III/a)',
            'satuan_kerja' => 'Kejari Banjarmasin',
            'email_verified_at' => now(),
        ]);
    }
}
