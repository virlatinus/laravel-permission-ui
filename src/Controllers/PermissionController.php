<?php

namespace virlatinus\PermissionsUI\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index(): View
    {
        $permissions = Permission::with([
            'roles' => fn ($query) => $query->orderBy('name', 'asc')
        ])->paginate(5);

        $roleColors = Role::all()->map(function ($role) { return [$role->name => static::stringToColor($role->name)]; })->collapseWithKeys()->toArray();

        return view('PermissionsUI::permissions.index', compact('permissions', 'roleColors'), ['hasMultitenancy'=>self::hasMultitenancy()]);
    }

    public function create(): View
    {
        $roles = Role::pluck('name', 'id');

        return view('PermissionsUI::permissions.create', compact('roles'), ['hasMultitenancy'=>self::hasMultitenancy()]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string'],
            'roles' => ['array'],
        ]);

        $permission = Permission::create(['name' => $request->input('name')]);
        $roles = $request->input('roles');

        if (!empty($roles)) {
            foreach ($roles as $roleId) {
                $role = Role::findById($roleId);
                $role->givePermissionTo([$permission]);
            }
        }

        return redirect()->route(config('permission_ui.route_name_prefix') . 'permissions.index');
    }

    public function edit(Permission $permission): View
    {
        $roles = Role::pluck('name', 'id');

        return view('PermissionsUI::permissions.edit', compact('permission', 'roles'), ['hasMultitenancy'=>self::hasMultitenancy()]);
    }

    public function update(Request $request, Permission $permission): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string'],
            'roles' => ['array'],
        ]);

        $permission->update(['name' => $request->input('name')]);
        $roles = $request->input('roles');

        // If some roles have been checked off, then all roles need to have their permissions cleared first
        $allRoles = Role::with('permissions')->get();

        foreach ($allRoles as $role) {
            // Remove permissions before eventually assigning the new one
            if ($role->hasPermissionTo($permission)) {
                $role->revokePermissionTo($permission);
            }
        }

        if (!empty($roles)) {
            foreach ($roles as $roleId) {
                $role = Role::findById($roleId);
                $role->givePermissionTo([$permission]);
            }
        }

        return redirect()->route(config('permission_ui.route_name_prefix') . 'permissions.index');
    }

    public function destroy(Permission $permission): RedirectResponse
    {
        if (method_exists($permission,'forceDelete')) {
            $permission->forceDelete();
        } else {
            $permission->delete();
        }

        return redirect()->route(config('permission_ui.route_name_prefix') . 'permissions.index');
    }

    public function deleteRole(Permission $permission, Role $role): RedirectResponse
    {
        $role->revokePermissionTo([$permission]);

        return redirect()->route(config('permission_ui.route_name_prefix') . 'permissions.index');
    }

    public function editMultiple(Request $request): View
    {
        $request->validate([
            'permissions' => ['array'],
            'returnUrl' => ['nullable', 'string'],
        ]);

        $permissions = Permission::find($request->input('permissions'));
        $roles = Role::pluck('name', 'id');

        $returnUrl = $request->input('returnUrl');

        return view('PermissionsUI::permissions.edit-multi', compact('permissions', 'roles', 'returnUrl'), ['hasMultitenancy'=>self::hasMultitenancy()]);
    }

    public function updateMultiple(Request $request): RedirectResponse
    {
        $request->validate([
            'permissions' => ['array'],
            'roles' => ['array'],
            'returnUrl' => ['nullable', 'string'],
        ]);

        $permissions = Permission::find($request->input('permissions'));

        if ($request->has('roles')) {
            // If some roles have been checked off, then all roles need to have their permissions cleared first
            $allRoles = Role::with('permissions')->get();

            foreach ($permissions as $permission) {
                foreach ($allRoles as $role) {
                    // Remove permissions before eventually assigning the new one
                    if ($role->hasPermissionTo($permission)) {
                        $role->revokePermissionTo($permission);
                    }
                }
            }

            foreach($request->input('roles') as $roleId) {
                $role = Role::findById($roleId);
                $role->givePermissionTo($permissions);
            }
        }

        if ($request->has('returnUrl') && !empty($request->input('returnUrl'))) {
            return redirect()->away($request->input('returnUrl'));
        }

        return redirect()->route(config('permission_ui.route_name_prefix') . 'permissions.index');
    }

    public function deleteMultiple(Request $request): RedirectResponse
    {
        $request->validate([
            'permissions' => ['array'],
            'returnUrl' => ['nullable', 'string'],
        ]);

        if (method_exists(Permission::class,'forceDestroy')) {
            Permission::forceDestroy($request->input('permissions'));
        } else {
            Permission::destroy($request->input('permissions'));
        }

        if ($request->has('returnUrl') && !empty($request->input('returnUrl'))) {
            return redirect()->away($request->input('returnUrl'));
        }

        return redirect()->route(config('permission_ui.route_name_prefix') . 'permissions.index');
    }
}
