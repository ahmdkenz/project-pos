<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Panggil UserSeeder Anda di sini
        $this->call([
            UserSeeder::class,
            // Anda bisa menambahkan seeder lain di sini nanti
            // ProductSeeder::class, 
        ]);
    }
}