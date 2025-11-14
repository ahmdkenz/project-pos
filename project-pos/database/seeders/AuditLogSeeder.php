<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AuditLog;
use App\Models\User;
use Carbon\Carbon;

class AuditLogSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        $user = User::first();
        $userName = $user ? $user->name : 'Admin';
        $userId = $user ? $user->id : null;

        $logs = [
            [
                'user_id' => $userId,
                'actor' => $userName,
                'type' => 'sales',
                'action' => 'CREATE',
                'message' => 'memproses penjualan baru <strong>(INV/2025/11/002)</strong>',
                'ip_address' => '103.44.1.2',
                'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
                'created_at' => Carbon::now()->subMinutes(2),
            ],
            [
                'user_id' => $userId,
                'actor' => $userName,
                'type' => 'security',
                'action' => 'LOGIN',
                'message' => 'berhasil login ke sistem',
                'ip_address' => '103.44.1.2',
                'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
                'created_at' => Carbon::now()->subMinutes(15),
            ],
            [
                'user_id' => $userId,
                'actor' => $userName,
                'type' => 'product',
                'action' => 'UPDATE',
                'message' => 'mengedit produk <strong>(KB-XPRO-001)</strong>',
                'ip_address' => '103.44.1.2',
                'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
                'created_at' => Carbon::now()->subHour(),
            ],
            [
                'user_id' => $userId,
                'actor' => $userName,
                'type' => 'stock',
                'action' => 'RESTOCK',
                'message' => 'menambahkan stok untuk <strong>Mouse Gaming RGB (50 unit)</strong>',
                'ip_address' => '103.44.1.2',
                'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
                'created_at' => Carbon::now()->subHours(3),
            ],
            [
                'user_id' => $userId,
                'actor' => $userName,
                'type' => 'sales',
                'action' => 'CREATE',
                'message' => 'memproses penjualan baru <strong>(INV/2025/11/001)</strong>',
                'ip_address' => '103.44.1.2',
                'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
                'created_at' => Carbon::now()->subHours(3)->subMinutes(2),
            ],
            [
                'user_id' => $userId,
                'actor' => $userName,
                'type' => 'product',
                'action' => 'CREATE',
                'message' => 'menambahkan produk baru <strong>Keyboard Mechanical RGB</strong>',
                'ip_address' => '103.44.1.2',
                'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
                'created_at' => Carbon::yesterday()->setHour(16)->setMinute(30),
            ],
            [
                'user_id' => $userId,
                'actor' => $userName,
                'type' => 'danger',
                'action' => 'DELETE',
                'message' => 'menghapus produk <strong>(Item-Lama-001)</strong>',
                'ip_address' => '103.44.1.2',
                'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
                'created_at' => Carbon::yesterday()->setHour(17)->setMinute(1),
            ],
            [
                'user_id' => $userId,
                'actor' => $userName,
                'type' => 'security',
                'action' => 'LOGOUT',
                'message' => 'keluar dari sistem',
                'ip_address' => '103.44.1.2',
                'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
                'created_at' => Carbon::yesterday()->setHour(18)->setMinute(0),
            ],
        ];

        foreach ($logs as $log) {
            AuditLog::create($log);
        }

        $this->command->info('✓ Audit logs seeded successfully!');
    }
}
