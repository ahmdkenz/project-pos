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
        // 3. Gunakan updateOrCreate sehingga password akan diperbarui
        User::updateOrCreate(
            [ 'email' => 'admin@mustika.com' ], // kunci unik untuk pengecekan
            [
                'name' => 'Admin',
                // Set password ke 'password123' sesuai permintaan (terenkripsi)
                'password' => Hash::make('password123')
            ]
        );
    }
}