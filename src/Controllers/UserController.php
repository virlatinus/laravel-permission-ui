<?php

namespace dfumagalli\PermissionsUI\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::with('roles')->paginate();

        return view('PermissionsUI::users.index', compact('users'));
    }

    public function edit(User $user): View
    {
        $roles = Role::pluck('name', 'id');

        return view('PermissionsUI::users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $request->validate([
            'roles' => ['required', 'array'],
        ]);

        $roleIds = collect($request->input('roles', []))
            ->map(fn ($id) => (int) $id)
            ->all();
        $user->syncRoles($roleIds);

        return redirect()->route(config('permission_ui.route_name_prefix') . 'users.index');
    }
}
