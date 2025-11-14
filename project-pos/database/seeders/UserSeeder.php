<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // <-- 1. Import model User
use Illuminate\Support\Facades\Hash; // <-- 2. Import Hash

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 3. Gunakan firstOrCreate untuk membuat admin
        User::firstOrCreate(
            [
                'email' => 'admin@mustika.com' // Kunci unik untuk pengecekan
            ],
            [
                'name' => 'Admin',
                'password' => Hash::make('admin123') // <-- GANTI DENGAN PASSWORD AMAN
            ]
        );
    }
}