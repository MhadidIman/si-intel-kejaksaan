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
            'nip' => '19900101 202001 1 001',
            'email' => 'admin@kejaksaan.go.id',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // 2. Akun STAFF 1 (Role: Staff / Penginput)
        User::create([
            'name' => 'Jaksa Fulan, S.H.',
            'nip' => '19950505 202101 1 002',
            'email' => 'jaksa@kejaksaan.go.id',
            'password' => Hash::make('password'),
            'role' => 'staff',
        ]);

        // 3. Akun STAFF 2 (Untuk Demo Leaderboard Peringkat)
        User::create([
            'name' => 'Andi Pratama, S.H.',
            'nip' => '19930312 201902 1 003',
            'email' => 'andi@kejaksaan.go.id',
            'password' => Hash::make('password'),
            'role' => 'staff',
        ]);

        // 4. Akun STAFF 3
        User::create([
            'name' => 'Siti Aminah, S.H., M.H.',
            'nip' => '19960722 202203 2 004',
            'email' => 'siti@kejaksaan.go.id',
            'password' => Hash::make('password'),
            'role' => 'staff',
        ]);

        // 5. Akun STAFF 4
        User::create([
            'name' => 'Budi Santoso, S.Kom.',
            'nip' => '19981130 202301 1 005',
            'email' => 'budi@kejaksaan.go.id',
            'password' => Hash::make('password'),
            'role' => 'staff',
        ]);
    }
}
