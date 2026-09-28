<?php

namespace Tests\Feature;

use App\Models\AuditLog;
use App\Models\User;
use App\Support\Access;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\Attributes\DataProvider;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class RoleAccessTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(RolePermissionSeeder::class);
    }

    private function userWithRole(string $role, array $attributes = []): User
    {
        $user = User::factory()->create($attributes);
        $user->assignRole($role);

        return $user;
    }

    // ------------------------------------------------------------------
    // Matriks akses halaman per role (spesifikasi, sengaja ditulis eksplisit)
    // ------------------------------------------------------------------

    public static function pageAccess(): iterable
    {
        $pages = [
            '/dashboard', '/inventory', '/products/create', '/sales', '/sales/history',
            '/services', '/services/create', '/services/history',
            '/reports/profit', '/audit-log', '/users', '/roles',
        ];

        $allowed = [
            'admin' => $pages,
            'kasir' => ['/dashboard', '/inventory', '/sales', '/sales/history'],
            'teknisi' => ['/dashboard', '/services', '/services/create', '/services/history'],
        ];

        foreach ($allowed as $role => $uris) {
            foreach ($pages as $uri) {
                yield "{$role} {$uri}" => [$role, $uri, in_array($uri, $uris, true)];
            }
        }
    }

    #[DataProvider('pageAccess')]
    public function test_page_access_follows_role_matrix(string $role, string $uri, bool $allowed): void
    {
        $response = $this->actingAs($this->userWithRole($role))->get($uri);

        $allowed ? $response->assertOk() : $response->assertForbidden();
    }

    public function test_guests_are_redirected_to_login(): void
    {
        $protected = [
            '/dashboard', '/inventory', '/products/create', '/products/autocomplete', '/sales', '/sales/history',
            '/services', '/services/create', '/services/history', '/reports/profit', '/reports/profit/data',
            '/audit-log', '/users', '/roles',
        ];

        foreach ($protected as $uri) {
            $this->get($uri)->assertRedirect('/login');
        }

        $this->post('/sales/process', [])->assertRedirect('/login');
        $this->post('/inventory/restock', [])->assertRedirect('/login');
    }

    public function test_write_actions_are_forbidden_without_permission(): void
    {
        $kasir = $this->userWithRole('kasir');
        $teknisi = $this->userWithRole('teknisi');

        $this->actingAs($kasir)->post('/products', [])->assertForbidden();
        $this->actingAs($kasir)->post('/inventory/restock', [])->assertForbidden();
        $this->actingAs($kasir)->delete('/products/1')->assertForbidden();
        $this->actingAs($kasir)->post('/services', [])->assertForbidden();
        $this->actingAs($kasir)->delete('/services/1')->assertForbidden();

        $this->actingAs($teknisi)->post('/sales/process', [])->assertForbidden();
        $this->actingAs($teknisi)->delete('/services/1')->assertForbidden();
        $this->actingAs($teknisi)->get('/reports/profit/data')->assertForbidden();
        $this->actingAs($teknisi)->get('/products/autocomplete')->assertForbidden();
        $this->actingAs($teknisi)->post('/users', [])->assertForbidden();
    }

    public function test_permitted_write_action_reaches_validation_not_forbidden(): void
    {
        // Teknisi boleh membuat servis: request kosong gagal validasi (302), bukan 403
        $this->actingAs($this->userWithRole('teknisi'))
            ->post('/services', [])
            ->assertSessionHasErrors('customer_name');
    }

    // ------------------------------------------------------------------
    // Tampilan mengikuti permission
    // ------------------------------------------------------------------

    public function test_sidebar_only_lists_permitted_menus(): void
    {
        $this->actingAs($this->userWithRole('kasir'))->get('/dashboard')
            ->assertSee('Kasir (POS)')
            ->assertSee('Riwayat Penjualan')
            ->assertDontSee('Manajemen User')
            ->assertDontSee('Manajemen Role')
            ->assertDontSee('Audit Log System')
            ->assertDontSee('Manajemen Servis');

        $this->actingAs($this->userWithRole('admin'))->get('/dashboard')
            ->assertSee('Manajemen User')
            ->assertSee('Manajemen Role');
    }

    public function test_header_shows_logged_in_user_and_role(): void
    {
        $this->actingAs($this->userWithRole('teknisi', ['name' => 'Budi Teknisi']))->get('/dashboard')
            ->assertSee('Budi Teknisi')
            ->assertSee('Teknisi');
    }

    public function test_dashboard_widgets_are_filtered_by_permission(): void
    {
        $this->actingAs($this->userWithRole('teknisi'))->get('/dashboard')
            ->assertSee('Pendapatan Servis')
            ->assertDontSee('Penjualan Hari Ini')
            ->assertDontSee('Barang Stok Kritis')
            ->assertDontSee('Aktivitas Terbaru');

        $this->actingAs($this->userWithRole('kasir'))->get('/dashboard')
            ->assertSee('Penjualan Hari Ini')
            ->assertSee('Barang Stok Kritis')
            ->assertDontSee('Pendapatan Servis')
            ->assertDontSee('Aktivitas Terbaru');

        $this->actingAs($this->userWithRole('admin'))->get('/dashboard')
            ->assertSee('Pendapatan Servis')
            ->assertSee('Penjualan Hari Ini')
            ->assertSee('Aktivitas Terbaru');
    }

    public function test_inventory_is_read_only_for_kasir(): void
    {
        $this->actingAs($this->userWithRole('kasir'))->get('/inventory')
            ->assertOk()
            ->assertDontSee('Tambah Produk Baru')
            ->assertDontSee('Harga Beli (Modal)')
            ->assertDontSee('Barang Masuk / Restock');

        $this->actingAs($this->userWithRole('admin'))->get('/inventory')
            ->assertSee('Tambah Produk Baru')
            ->assertSee('Harga Beli (Modal)')
            ->assertSee('Barang Masuk / Restock');
    }

    // ------------------------------------------------------------------
    // Login & user nonaktif
    // ------------------------------------------------------------------

    public function test_active_user_can_login(): void
    {
        $user = $this->userWithRole('kasir');

        $this->post('/login', ['username' => $user->username, 'password' => 'password'])
            ->assertRedirect('/dashboard');
        $this->assertAuthenticatedAs($user);
    }

    public function test_inactive_user_cannot_login(): void
    {
        $user = $this->userWithRole('kasir', ['is_active' => false]);

        $this->post('/login', ['username' => $user->username, 'password' => 'password'])
            ->assertSessionHasErrors('username');
        $this->assertGuest();
    }

    // ------------------------------------------------------------------
    // Manajemen User
    // ------------------------------------------------------------------

    public function test_admin_can_create_user_with_role_and_it_is_audited(): void
    {
        $this->actingAs($this->userWithRole('admin'))
            ->post('/users', [
                'name' => 'Sari Kasir',
                'username' => 'sari.kasir',
                'password' => 'rahasia123',
                'role' => 'kasir',
                'is_active' => '1',
            ])
            ->assertRedirect('/users');

        $created = User::where('username', 'sari.kasir')->firstOrFail();
        $this->assertTrue($created->hasRole('kasir'));
        $this->assertTrue($created->is_active);
        $this->assertTrue(Hash::check('rahasia123', $created->password));
        $this->assertDatabaseHas('audit_logs', ['type' => 'security', 'action' => 'CREATE']);
    }

    public function test_user_creation_rejects_unknown_role_and_duplicate_username(): void
    {
        $admin = $this->userWithRole('admin');

        $this->actingAs($admin)->post('/users', [
            'name' => 'X', 'username' => 'x.user', 'password' => 'rahasia123', 'role' => 'tidak-ada',
        ])->assertSessionHasErrors('role');

        $this->actingAs($admin)->post('/users', [
            'name' => 'X', 'username' => $admin->username, 'password' => 'rahasia123', 'role' => 'kasir',
        ])->assertSessionHasErrors('username');
    }

    public function test_password_is_optional_on_update_and_kept_when_blank(): void
    {
        $admin = $this->userWithRole('admin');
        $kasir = $this->userWithRole('kasir');
        $oldHash = $kasir->password;

        $this->actingAs($admin)->put("/users/{$kasir->id}", [
            'name' => 'Nama Baru', 'username' => $kasir->username, 'password' => '', 'role' => 'teknisi', 'is_active' => '1',
        ])->assertRedirect('/users');

        $kasir->refresh();
        $this->assertSame('Nama Baru', $kasir->name);
        $this->assertSame($oldHash, $kasir->password);
        $this->assertTrue($kasir->hasRole('teknisi'));
        $this->assertFalse($kasir->hasRole('kasir'));
    }

    public function test_admin_cannot_deactivate_self(): void
    {
        $admin = $this->userWithRole('admin');

        $this->actingAs($admin)->patch("/users/{$admin->id}/toggle-active")
            ->assertSessionHas('error');

        $this->assertTrue($admin->fresh()->is_active);
    }

    public function test_last_active_admin_cannot_be_deactivated_or_demoted(): void
    {
        // Role kustom yang boleh mengelola user, supaya ada "orang lain" yang mengedit admin
        $manager = Role::create(['name' => 'hr'])->syncPermissions(['users.manage']);
        $hr = User::factory()->create();
        $hr->assignRole($manager);
        $admin = $this->userWithRole('admin');

        $this->actingAs($hr)->patch("/users/{$admin->id}/toggle-active")->assertSessionHas('error');
        $this->assertTrue($admin->fresh()->is_active);

        $this->actingAs($hr)->put("/users/{$admin->id}", [
            'name' => $admin->name, 'username' => $admin->username, 'role' => 'kasir', 'is_active' => '1',
        ])->assertSessionHasErrors('role');
        $this->assertTrue($admin->fresh()->hasRole('admin'));

        // Dengan admin kedua, admin pertama boleh dinonaktifkan
        $this->userWithRole('admin');
        $this->actingAs($hr)->patch("/users/{$admin->id}/toggle-active")->assertSessionHas('status');
        $this->assertFalse($admin->fresh()->is_active);
    }

    public function test_deactivating_user_is_audited(): void
    {
        $admin = $this->userWithRole('admin');
        $kasir = $this->userWithRole('kasir');

        $this->actingAs($admin)->patch("/users/{$kasir->id}/toggle-active")->assertSessionHas('status');

        $this->assertFalse($kasir->fresh()->is_active);
        $this->assertTrue(AuditLog::where('type', 'security')->where('message', 'like', '%menonaktifkan user%')->exists());
    }

    // ------------------------------------------------------------------
    // Manajemen Role
    // ------------------------------------------------------------------

    public function test_admin_can_create_role_with_permissions(): void
    {
        $this->actingAs($this->userWithRole('admin'))
            ->post('/roles', ['name' => 'supervisor', 'permissions' => ['sales.history', 'reports.profit']])
            ->assertRedirect('/roles');

        $role = Role::findByName('supervisor');
        $this->assertEqualsCanonicalizing(['sales.history', 'reports.profit'], $role->permissions->pluck('name')->all());
    }

    public function test_role_rejects_unknown_permission_and_duplicate_name(): void
    {
        $admin = $this->userWithRole('admin');

        $this->actingAs($admin)->post('/roles', ['name' => 'x', 'permissions' => ['bikin.sendiri']])
            ->assertSessionHasErrors('permissions.0');
        $this->actingAs($admin)->post('/roles', ['name' => 'kasir'])
            ->assertSessionHasErrors('name');
    }

    public function test_editing_role_permissions_takes_effect_for_its_users(): void
    {
        $admin = $this->userWithRole('admin');
        $kasir = $this->userWithRole('kasir');
        $role = Role::findByName('kasir');

        $this->actingAs($kasir)->get('/reports/profit')->assertForbidden();

        $this->actingAs($admin)->put("/roles/{$role->id}", [
            'name' => 'kasir',
            'permissions' => array_merge($role->permissions->pluck('name')->all(), ['reports.profit']),
        ])->assertRedirect('/roles');

        $this->actingAs($kasir->fresh())->get('/reports/profit')->assertOk();
    }

    public function test_admin_role_cannot_be_edited_or_deleted(): void
    {
        $admin = $this->userWithRole('admin');
        $role = Role::findByName('admin');

        $this->actingAs($admin)->get("/roles/{$role->id}/edit")->assertRedirect('/roles');
        $this->actingAs($admin)->put("/roles/{$role->id}", ['name' => 'boss'])->assertSessionHas('error');
        $this->actingAs($admin)->delete("/roles/{$role->id}")->assertSessionHas('error');

        $this->assertSame('admin', $role->fresh()->name);
        $this->assertCount(count(Access::permissions()), $role->fresh()->permissions);
    }

    public function test_role_in_use_cannot_be_deleted_but_unused_can(): void
    {
        $admin = $this->userWithRole('admin');
        $this->userWithRole('kasir');

        $this->actingAs($admin)->delete('/roles/'.Role::findByName('kasir')->id)
            ->assertSessionHas('error');
        $this->assertNotNull(Role::where('name', 'kasir')->first());

        $unused = Role::create(['name' => 'sementara']);
        $this->actingAs($admin)->delete("/roles/{$unused->id}")->assertSessionHas('status');
        $this->assertNull(Role::where('name', 'sementara')->first());
        $this->assertTrue(AuditLog::where('type', 'danger')->where('message', 'like', '%menghapus role%')->exists());
    }

    // ------------------------------------------------------------------
    // Seeder
    // ------------------------------------------------------------------

    public function test_seeder_is_idempotent_and_does_not_overwrite_edited_roles(): void
    {
        Role::findByName('kasir')->syncPermissions(['dashboard.view']);
        $legacy = User::factory()->create(); // user lama tanpa role

        $this->seed(RolePermissionSeeder::class);

        $this->assertSame(['dashboard.view'], Role::findByName('kasir')->permissions->pluck('name')->all());
        $this->assertTrue($legacy->fresh()->hasRole('admin'));
        $this->assertSame(3, Role::count());
    }

    public function test_default_role_permissions_match_agreed_matrix(): void
    {
        $permissions = fn (string $role) => Role::findByName($role)->permissions->pluck('name')->all();

        $this->assertEqualsCanonicalizing(
            ['dashboard.view', 'products.view', 'sales.create', 'sales.history'],
            $permissions('kasir')
        );
        $this->assertEqualsCanonicalizing(
            ['dashboard.view', 'services.view', 'services.create', 'services.update', 'services.history'],
            $permissions('teknisi')
        );
    }
}
