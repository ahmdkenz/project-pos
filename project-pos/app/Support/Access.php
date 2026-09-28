<?php

namespace App\Support;

/**
 * Akses baca ke definisi hak akses di config/access.php.
 */
class Access
{
    public static function superAdminRole(): string
    {
        return config('access.super_admin_role');
    }

    /**
     * Grup permission untuk matriks checkbox: [key => ['label' => ..., 'permissions' => [name => label]]]
     */
    public static function groups(): array
    {
        return config('access.groups');
    }

    /**
     * Semua nama permission yang dikenal aplikasi.
     *
     * @return list<string>
     */
    public static function permissions(): array
    {
        return collect(static::groups())
            ->flatMap(fn (array $group) => array_keys($group['permissions']))
            ->values()
            ->all();
    }

    /**
     * Permission bawaan untuk sebuah role ('*' berarti semua permission).
     *
     * @return list<string>
     */
    public static function defaultPermissions(string $role): array
    {
        $defaults = config("access.default_roles.{$role}", []);

        return $defaults === '*' ? static::permissions() : $defaults;
    }
}
