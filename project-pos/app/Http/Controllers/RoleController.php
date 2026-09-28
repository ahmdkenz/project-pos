<?php

namespace App\Http\Controllers;

use App\Support\Access;
use App\Traits\LogsActivity;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    use LogsActivity;

    /**
     * Daftar role
     */
    public function index()
    {
        $roles = Role::withCount(['users', 'permissions'])->orderBy('name')->get();

        return view('roles.index', compact('roles'));
    }

    /**
     * Form tambah role
     */
    public function create()
    {
        return view('roles.create', ['groups' => Access::groups()]);
    }

    /**
     * Simpan role baru
     */
    public function store(Request $request)
    {
        $data = $this->validated($request);

        $role = Role::create(['name' => $data['name']]);
        $role->syncPermissions($data['permissions'] ?? []);

        $this->logActivity(
            'security',
            'CREATE',
            'menambahkan role baru <strong>'.e($role->name).'</strong> ('.count($data['permissions'] ?? []).' hak akses)',
            ['permissions' => $data['permissions'] ?? []]
        );

        return redirect()->route('roles.index')->with('status', 'Role berhasil ditambahkan.');
    }

    /**
     * Form edit role
     */
    public function edit(Role $role)
    {
        if ($this->isLocked($role)) {
            return $this->lockedResponse();
        }

        return view('roles.edit', ['role' => $role, 'groups' => Access::groups()]);
    }

    /**
     * Update role
     */
    public function update(Request $request, Role $role)
    {
        if ($this->isLocked($role)) {
            return $this->lockedResponse();
        }

        $data = $this->validated($request, $role);

        $before = $role->permissions->pluck('name')->all();
        $after = $data['permissions'] ?? [];
        $oldName = $role->name;

        $role->update(['name' => $data['name']]);
        $role->syncPermissions($after);

        $added = array_values(array_diff($after, $before));
        $removed = array_values(array_diff($before, $after));

        $this->logActivity(
            'security',
            'UPDATE',
            'mengubah role <strong>'.e($oldName).'</strong>'
                .($oldName !== $role->name ? ' menjadi <strong>'.e($role->name).'</strong>' : '')
                .' (+'.count($added).' / -'.count($removed).' hak akses)',
            ['added' => $added, 'removed' => $removed]
        );

        return redirect()->route('roles.index')->with('status', 'Role berhasil diupdate.');
    }

    /**
     * Hapus role (hanya jika tidak dipakai user)
     */
    public function destroy(Role $role)
    {
        if ($this->isLocked($role)) {
            return $this->lockedResponse();
        }

        if ($role->users()->exists()) {
            return redirect()->route('roles.index')
                ->with('error', 'Role masih dipakai user. Pindahkan user tersebut ke role lain dulu.');
        }

        $name = $role->name;
        $role->delete();

        $this->logActivity('danger', 'DELETE', 'menghapus role <strong>'.e($name).'</strong>');

        return redirect()->route('roles.index')->with('status', 'Role berhasil dihapus.');
    }

    private function validated(Request $request, ?Role $role = null): array
    {
        return $request->validate([
            'name' => [
                'required', 'string', 'max:50',
                Rule::unique('roles', 'name')->where('guard_name', 'web')->ignore($role?->id),
            ],
            'permissions' => ['nullable', 'array'],
            'permissions.*' => ['string', Rule::in(Access::permissions())],
        ]);
    }

    /**
     * Role super-admin tidak bisa diubah/dihapus supaya akses admin tidak bisa hilang dari UI.
     */
    private function isLocked(Role $role): bool
    {
        return $role->name === Access::superAdminRole();
    }

    private function lockedResponse()
    {
        return redirect()->route('roles.index')
            ->with('error', 'Role admin memiliki semua hak akses dan tidak bisa diubah atau dihapus.');
    }
}
