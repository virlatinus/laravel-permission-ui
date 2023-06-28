<?php

namespace dfumagalli\PermissionsUI\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index(): View
    {
        $permissions = Permission::all();

        return view('PermissionsUI::permissions.index', compact('permissions'));
    }

    public function create(): View
    {
        $roles = Role::pluck('name', 'id');

        return view('PermissionsUI::permissions.create', compact('roles'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string'],
            'roles' => ['array'],
        ]);

        $permissionAttribute = ['name' => $request->input('name')];
        $permission = Permission::create($permissionAttribute);
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

        return view('PermissionsUI::permissions.edit', compact('permission', 'roles'));
    }

    public function update(Request $request, Permission $permission): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string'],
            'roles' => ['array'],
        ]);

        $permissionAttribute = ['name' => $request->input('name')];
        $permission->update($permissionAttribute);
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
        $permission->delete();

        return redirect()->route(config('permission_ui.route_name_prefix') . 'permissions.index');
    }
}
