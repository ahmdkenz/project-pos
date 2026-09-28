<?php

/*
 * Sumber tunggal definisi hak akses aplikasi.
 *
 * - `groups`        : daftar permission (nama => label) per modul. Dipakai seeder,
 *                     validasi form role, dan matriks checkbox di halaman Manajemen Role.
 * - `default_roles` : role bawaan. Hanya diterapkan saat role dibuat pertama kali,
 *                     perubahan dari UI tidak akan ditimpa oleh seeder.
 *
 * Menambah permission baru: tambahkan di `groups`, lalu jalankan
 * `php artisan db:seed --class=RolePermissionSeeder`.
 */
return [

    // Role ini lolos semua pengecekan (Gate::before) dan tidak bisa diedit/dihapus dari UI.
    'super_admin_role' => 'admin',

    'groups' => [
        'dashboard' => [
            'label' => 'Dashboard',
            'permissions' => [
                'dashboard.view' => 'Melihat dashboard',
            ],
        ],
        'products' => [
            'label' => 'Manajemen Produk',
            'permissions' => [
                'products.view' => 'Melihat daftar produk & stok',
                'products.create' => 'Menambah produk',
                'products.update' => 'Mengedit produk',
                'products.delete' => 'Menghapus produk',
                'products.restock' => 'Restock produk',
            ],
        ],
        'sales' => [
            'label' => 'Penjualan',
            'permissions' => [
                'sales.create' => 'Kasir (memproses penjualan)',
                'sales.history' => 'Melihat riwayat penjualan',
            ],
        ],
        'services' => [
            'label' => 'Servis',
            'permissions' => [
                'services.view' => 'Melihat daftar & detail servis',
                'services.create' => 'Menambah servis',
                'services.update' => 'Mengedit servis',
                'services.delete' => 'Menghapus servis',
                'services.history' => 'Melihat riwayat servis',
            ],
        ],
        'reports' => [
            'label' => 'Laporan',
            'permissions' => [
                'reports.profit' => 'Melihat laporan laba/rugi',
            ],
        ],
        'system' => [
            'label' => 'Sistem',
            'permissions' => [
                'audit-log.view' => 'Melihat audit log',
                'users.manage' => 'Mengelola user',
                'roles.manage' => 'Mengelola role & hak akses',
            ],
        ],
    ],

    'default_roles' => [
        'admin' => '*',
        'kasir' => [
            'dashboard.view',
            'products.view',
            'sales.create',
            'sales.history',
        ],
        'teknisi' => [
            'dashboard.view',
            'services.view',
            'services.create',
            'services.update',
            'services.history',
        ],
    ],

];
