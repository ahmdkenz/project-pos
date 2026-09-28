<?php

namespace Database\Seeders;

use App\Models\User;
use App\Support\Access;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    /**
     * Sinkronkan permission & role bawaan dari config/access.php. Aman dijalankan berulang kali.
     */
    public function run(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        foreach (Access::permissions() as $name) {
            Permission::findOrCreate($name);
        }

        foreach (array_keys(config('access.default_roles')) as $name) {
            $role = Role::findOrCreate($name);

            // Default hanya untuk role baru, supaya hasil edit di UI tidak tertimpa.
            if ($role->wasRecentlyCreated) {
                $role->syncPermissions(Access::defaultPermissions($name));
            }
        }

        // Admin selalu memegang semua permission (termasuk yang baru ditambahkan di config).
        Role::findByName(Access::superAdminRole())->syncPermissions(Access::permissions());

        // Sebelum fitur ini ada, semua user berhak penuh. Jadikan admin agar tidak ada yang terkunci.
        User::doesntHave('roles')->get()->each->assignRole(Access::superAdminRole());
    }
}
