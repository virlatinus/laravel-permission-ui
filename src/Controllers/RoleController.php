<?php

namespace virlatinus\PermissionsUI\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index(): View
    {
        $roles = Role::with([
            'permissions' => fn ($query) => $query->orderBy('name', 'asc')
        ])->paginate(5);

        $permissionColors = Permission::all()->map(function ($p) { return [$p->name => static::stringToColor($p->name)]; })->collapseWithKeys()->toArray();

        return view('PermissionsUI::roles.index', compact('roles', 'permissionColors'));
    }

    public function create(): View
    {
        $permissions = Permission::pluck('name', 'id');

        return view('PermissionsUI::roles.create', compact('permissions'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string'],
            'permissions' => ['array'],
        ]);

        $role = Role::create(['name' => $request->input('name')]);

        if ($request->has('permissions')) {
            $role->givePermissionTo(array_map(static function ($i) { return (int)$i; }, $request->input('permissions')));
        }

        return redirect()->route(config('permission_ui.route_name_prefix') . 'roles.index');
    }

    public function edit(Role $role): View
    {
        $permissions = Permission::pluck('name', 'id');

        return view('PermissionsUI::roles.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, Role $role): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string'],
            'permissions' => ['array'],
        ]);

        $role->update(['name' => $request->input('name')]);

        // change string IDs to int
        if ($request->has('permissions')) {
            $role->syncPermissions(array_map(static function ($i) { return (int)$i; }, $request->input('permissions')));
        }

        return redirect()->route(config('permission_ui.route_name_prefix') . 'roles.index');
    }

    public function destroy(Role $role): RedirectResponse
    {
        $role->delete();

        return redirect()->route(config('permission_ui.route_name_prefix') . 'roles.index');
    }

    public function deletePermission(Role $role, Permission $permission): RedirectResponse
    {
        $role->revokePermissionTo([$permission]);

        return redirect()->route(config('permission_ui.route_name_prefix') . 'roles.index');
    }

    public function editMultiple(Request $request): View
    {
        $request->validate([
            'roles' => ['array'],
            'returnUrl' => ['nullable', 'string'],
        ]);

        $roles = Role::find($request->input('roles'));
        $permissions = Permission::pluck('name', 'id');

        $returnUrl = $request->input('returnUrl');

        return view('PermissionsUI::roles.edit-multi', compact('roles', 'permissions', 'returnUrl'));
    }

    public function updateMultiple(Request $request): RedirectResponse
    {
        $request->validate([
            'roles' => ['array'],
            'permissions' => ['array'],
            'returnUrl' => ['nullable', 'string'],
        ]);

        $roles = Role::find($request->input('roles'));

        if ($request->has('permissions')) {
            $perms = array_map(static function ($i) {
                return (int)$i;
            }, $request->input('permissions'));
            foreach ($roles as $role) {
                $role->syncPermissions($perms);
            }
        }

        if ($request->has('returnUrl') && !empty($request->input('returnUrl'))) {
            return redirect()->away($request->input('returnUrl'));
        }

        return redirect()->route(config('permission_ui.route_name_prefix') . 'roles.index');
    }

    public function deleteMultiple(Request $request): RedirectResponse
    {
        $request->validate([
            'roles' => ['array'],
            'returnUrl' => ['nullable', 'string'],
        ]);

        Role::destroy($request->input('roles'));

        if ($request->has('returnUrl') && !empty($request->input('returnUrl'))) {
            return redirect()->away($request->input('returnUrl'));
        }

        return redirect()->route(config('permission_ui.route_name_prefix') . 'roles.index');
    }
}
