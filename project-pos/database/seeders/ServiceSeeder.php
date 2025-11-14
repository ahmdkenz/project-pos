<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;
use App\Models\User;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $firstUser = User::first();

        Service::create([
            'service_code' => 'SVC-001',
            'customer_name' => 'Ahmad Yusuf',
            'customer_phone' => '081234567890',
            'device_type' => 'Laptop',
            'device_brand' => 'Asus ROG Strix G15',
            'complaint' => 'Laptop mati total, tidak ada tanda kehidupan sama sekali. Sudah dicoba charge tapi tetap tidak menyala.',
            'diagnosis' => 'IC Power rusak, perlu diganti. Selain itu ada beberapa komponen yang perlu diperbaiki.',
            'action_taken' => 'Mengganti IC Power dengan yang baru, membersihkan motherboard dari korosi.',
            'status' => 'done',
            'cost' => 450000,
            'created_by' => $firstUser->id ?? 1,
            'completed_at' => now()->subDays(2),
        ]);

        Service::create([
            'service_code' => 'SVC-002',
            'customer_name' => 'Siti Nurhaliza',
            'customer_phone' => '082345678901',
            'device_type' => 'PC',
            'device_brand' => 'Rakitan Core i5',
            'complaint' => 'PC sering restart sendiri saat sedang digunakan, terutama saat bermain game.',
            'diagnosis' => 'PSU tidak stabil, thermal paste CPU sudah kering.',
            'action_taken' => 'Mengganti PSU dengan yang lebih baik, re-paste CPU, membersihkan sistem pendingin.',
            'status' => 'progress',
            'cost' => 650000,
            'created_by' => $firstUser->id ?? 1,
        ]);

        Service::create([
            'service_code' => 'SVC-003',
            'customer_name' => 'Bambang Setiawan',
            'customer_phone' => '083456789012',
            'device_type' => 'Printer',
            'device_brand' => 'Canon Pixma G2010',
            'complaint' => 'Printer tidak bisa menarik kertas, error paper jam terus menerus.',
            'diagnosis' => null,
            'action_taken' => null,
            'status' => 'pending',
            'cost' => 0,
            'created_by' => $firstUser->id ?? 1,
        ]);

        Service::create([
            'service_code' => 'SVC-004',
            'customer_name' => 'Dewi Lestari',
            'customer_phone' => '084567890123',
            'device_type' => 'Laptop',
            'device_brand' => 'HP Pavilion 14',
            'complaint' => 'Layar laptop bergaris-garis, kadang berkedip-kedip.',
            'diagnosis' => 'Kabel flexible LCD kendor, perlu dipasang kembali dengan benar.',
            'action_taken' => 'Membongkar LCD, memasang ulang kabel flexible, testing normal.',
            'status' => 'picked-up',
            'cost' => 200000,
            'created_by' => $firstUser->id ?? 1,
            'completed_at' => now()->subDays(5),
            'picked_up_at' => now()->subDays(1),
        ]);

        Service::create([
            'service_code' => 'SVC-005',
            'customer_name' => 'Eko Prasetyo',
            'customer_phone' => '085678901234',
            'device_type' => 'Monitor',
            'device_brand' => 'LG 24 Inch',
            'complaint' => 'Monitor tidak mau nyala, LED indikator hidup tapi layar gelap.',
            'diagnosis' => 'Backlight inverter rusak, perlu penggantian.',
            'action_taken' => 'Mengganti modul backlight inverter.',
            'status' => 'done',
            'cost' => 350000,
            'created_by' => $firstUser->id ?? 1,
            'completed_at' => now()->subHours(3),
        ]);
    }
}
