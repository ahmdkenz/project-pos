<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // <-- 1. Import model User
use App\Support\Access;
use Illuminate\Support\Facades\Hash; // <-- 2. Import Hash

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 3. Gunakan updateOrCreate sehingga password akan diperbarui
        $admin = User::updateOrCreate(
            [ 'username' => 'admin' ], // kunci unik untuk pengecekan
            [
                'name' => 'Admin',
                'email' => 'admin@mustika.com',
                // Set password ke 'password123' sesuai permintaan (terenkripsi)
                'password' => Hash::make('password123')
            ]
        );

        $admin->syncRoles(Access::superAdminRole());
    }
}