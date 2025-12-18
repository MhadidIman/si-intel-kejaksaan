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
        User::create([
            'name' => 'Administrator Intel',
            'nip' => '199001012020011001',
            'email' => 'admin@kejaksaan.go.id',
            'password' => Hash::make('password'), // password default
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Jaksa Fulan',
            'nip' => '199505052021011002',
            'email' => 'jaksa@kejaksaan.go.id',
            'password' => Hash::make('password'),
            'role' => 'staff',
        ]);
    }
}
