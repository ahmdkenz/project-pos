<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username', 50)->nullable()->unique()->after('name');
        });

        // User lama: username diambil dari bagian sebelum "@" pada email (dibuat unik bila bentrok)
        $taken = [];
        foreach (DB::table('users')->orderBy('id')->get(['id', 'email']) as $user) {
            $base = preg_replace('/[^A-Za-z0-9._-]/', '', strstr((string) $user->email, '@', true) ?: (string) $user->email);
            $base = substr($base !== '' ? $base : 'user', 0, 40);

            $username = $base;
            if (isset($taken[strtolower($username)])) {
                $username = $base.$user->id;
            }
            $taken[strtolower($username)] = true;

            DB::table('users')->where('id', $user->id)->update(['username' => $username]);
        }

        Schema::table('users', function (Blueprint $table) {
            $table->string('username', 50)->nullable(false)->change();
            // Email tidak lagi dipakai untuk login, jadi tidak wajib diisi
            $table->string('email')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Email boleh kosong sejak up(); isi dulu agar kolom bisa dikembalikan menjadi NOT NULL
        foreach (DB::table('users')->whereNull('email')->get(['id', 'username']) as $user) {
            DB::table('users')->where('id', $user->id)->update(['email' => $user->username.'@local.invalid']);
        }

        Schema::table('users', function (Blueprint $table) {
            $table->string('email')->nullable(false)->change();
            $table->dropUnique(['username']);
            $table->dropColumn('username');
        });
    }
};
