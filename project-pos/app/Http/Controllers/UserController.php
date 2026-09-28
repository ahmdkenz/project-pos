<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Support\Access;
use App\Traits\LogsActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    use LogsActivity;

    /**
     * Daftar user
     */
    public function index(Request $request)
    {
        $query = User::with('roles')->orderBy('name');

        if ($request->filled('q')) {
            $term = $request->q;
            $query->where(function ($q) use ($term) {
                $q->where('name', 'like', "%{$term}%")
                    ->orWhere('username', 'like', "%{$term}%");
            });
        }

        $users = $query->paginate(25)->withQueryString();

        return view('users.index', compact('users'));
    }

    /**
     * Form tambah user
     */
    public function create()
    {
        $roles = Role::orderBy('name')->get();

        return view('users.create', compact('roles'));
    }

    /**
     * Simpan user baru
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:50', 'regex:/^[A-Za-z0-9._-]+$/', 'unique:users,username'],
            'password' => ['required', 'string', 'min:8'],
            'role' => ['required', Rule::exists('roles', 'name')],
        ]);

        $user = User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'password' => $data['password'],
            'is_active' => $request->boolean('is_active'),
        ]);
        $user->syncRoles($data['role']);

        $this->logActivity(
            'security',
            'CREATE',
            'menambahkan user baru <strong>'.e($user->name).'</strong> dengan role <strong>'.e($data['role']).'</strong>'
        );

        return redirect()->route('users.index')->with('status', 'User berhasil ditambahkan.');
    }

    /**
     * Form edit user
     */
    public function edit(User $user)
    {
        $roles = Role::orderBy('name')->get();

        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update user
     */
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:50', 'regex:/^[A-Za-z0-9._-]+$/', Rule::unique('users', 'username')->ignore($user->id)],
            'password' => ['nullable', 'string', 'min:8'],
            'role' => ['required', Rule::exists('roles', 'name')],
        ]);
        $isActive = $request->boolean('is_active');

        if ($error = $this->lockoutError($request, $user, $data['role'], $isActive)) {
            return back()->withInput($request->except('password'))->withErrors(['role' => $error]);
        }

        $oldRole = $user->getRoleNames()->first();
        $wasActive = $user->is_active;

        $user->fill([
            'name' => $data['name'],
            'username' => $data['username'],
            'is_active' => $isActive,
        ]);
        if (! empty($data['password'])) {
            $user->password = $data['password'];
        }
        $user->save();
        $user->syncRoles($data['role']);

        if ($wasActive && ! $isActive) {
            $this->revokeSessions($user);
        }

        $changes = [];
        if ($oldRole !== $data['role']) {
            $changes[] = 'role <strong>'.e($oldRole ?? '-').'</strong> → <strong>'.e($data['role']).'</strong>';
        }
        if ($wasActive !== $isActive) {
            $changes[] = $isActive ? 'diaktifkan' : 'dinonaktifkan';
        }
        if (! empty($data['password'])) {
            $changes[] = 'password direset';
        }

        $this->logActivity(
            'security',
            'UPDATE',
            'mengubah user <strong>'.e($user->name).'</strong>'.($changes ? ' ('.implode(', ', $changes).')' : '')
        );

        return redirect()->route('users.index')->with('status', 'User berhasil diupdate.');
    }

    /**
     * Aktifkan / nonaktifkan user
     */
    public function toggleActive(Request $request, User $user)
    {
        $newActive = ! $user->is_active;

        if ($error = $this->lockoutError($request, $user, (string) $user->getRoleNames()->first(), $newActive)) {
            return back()->with('error', $error);
        }

        $user->update(['is_active' => $newActive]);

        if (! $newActive) {
            $this->revokeSessions($user);
        }

        $this->logActivity(
            'security',
            'UPDATE',
            ($newActive ? 'mengaktifkan' : 'menonaktifkan').' user <strong>'.e($user->name).'</strong>'
        );

        return back()->with('status', $newActive ? 'User diaktifkan.' : 'User dinonaktifkan.');
    }

    /**
     * Pesan error jika perubahan ini mengunci akses: menonaktifkan diri sendiri,
     * atau menonaktifkan / mengganti role admin aktif terakhir.
     */
    private function lockoutError(Request $request, User $user, string $newRole, bool $newActive): ?string
    {
        if (! $newActive && $user->is($request->user())) {
            return 'Anda tidak bisa menonaktifkan akun Anda sendiri.';
        }

        $staysActiveAdmin = $newActive && $newRole === Access::superAdminRole();

        if (! $staysActiveAdmin && $this->isLastActiveAdmin($user)) {
            return 'Minimal harus ada satu admin aktif. Admin terakhir tidak bisa dinonaktifkan atau diganti rolenya.';
        }

        return null;
    }

    private function isLastActiveAdmin(User $user): bool
    {
        if (! $user->is_active || ! $user->isSuperAdmin()) {
            return false;
        }

        return User::role(Access::superAdminRole())
            ->where('is_active', true)
            ->where('id', '!=', $user->id)
            ->doesntExist();
    }

    /**
     * Paksa logout user yang dinonaktifkan (hanya berlaku untuk session driver database).
     */
    private function revokeSessions(User $user): void
    {
        if (config('session.driver') === 'database') {
            DB::table(config('session.table', 'sessions'))->where('user_id', $user->id)->delete();
        }
    }
}
