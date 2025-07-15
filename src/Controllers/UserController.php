<?php

namespace virlatinus\PermissionsUI\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::with([
            'roles' => fn ($query) => $query->orderBy('name', 'asc')
        ])->paginate(5);

        $roleColors = Role::all()->map(function ($role) { return [$role->name => static::stringToColor($role->name)]; })->collapseWithKeys()->toArray();

        return view('PermissionsUI::users.index', compact('users', 'roleColors'));
    }

    public function create(): View
    {
        $roles = Role::pluck('name', 'id');

        return view('PermissionsUI::users.create', compact('roles'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'string'],
            'password' => ['required', 'string'],
            'verify' => ['sometimes', 'accepted'],
            'roles' => ['array'],
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            ]);

        if ($request->has('verify')) {
            $user->email_verified_at = now();
            $user->save();
        }

        if ($request->has('roles')) {
            $user->assignRole(array_map(static function ($i) { return (int)$i; }, $request->input('roles')));
        }

        return redirect()->route(config('permission_ui.route_name_prefix') . 'users.index');
    }

    public function edit(User $user): View
    {
        $roles = Role::pluck('name', 'id');

        return view('PermissionsUI::users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'string'],
            'password' => ['nullable', 'string'],
            'roles' => ['required', 'array'],
        ]);

        $arr = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ];

        if ($request->has('password') && !empty($request->input('password'))) {
            $arr['password'] = Hash::make($request->input('password'));
        }

        $user->update($arr);

        // change string IDs to int
        if ($request->has('roles')) {
            $user->syncRoles(array_map(static function ($i) { return (int)$i; }, $request->input('roles')));
        }

        return redirect()->route(config('permission_ui.route_name_prefix') . 'users.index');
    }

    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        return redirect()->route(config('permission_ui.route_name_prefix') . 'users.index');
    }

    public function deleteRole(User $user, Role $role): RedirectResponse
    {
        $user->removeRole($role);

        return redirect()->route(config('permission_ui.route_name_prefix') . 'users.index');
    }

    public function editMultiple(Request $request): View
    {
        $request->validate([
            'users' => ['array'],
            'returnUrl' => ['nullable', 'string'],
        ]);

        $users = User::find($request->input('users'));
        $roles = Role::pluck('name', 'id');

        $returnUrl = $request->input('returnUrl');

        return view('PermissionsUI::users.edit-multi', compact('users', 'roles', 'returnUrl'));
    }

    public function updateMultiple(Request $request): RedirectResponse
    {
        $request->validate([
            'users' => ['array'],
            'roles' => ['array'],
            'returnUrl' => ['nullable', 'string'],
        ]);

        $users = User::find($request->input('users'));

        if ($request->has('roles')) {
            $roles = array_map(static function ($i) {
                return (int)$i;
            }, $request->input('roles'));
            foreach ($users as $user) {
                $user->syncRoles($roles);
            }
        }

        if ($request->has('returnUrl') && !empty($request->input('returnUrl'))) {
            return redirect()->away($request->input('returnUrl'));
        }

        return redirect()->route(config('permission_ui.route_name_prefix') . 'users.index');
    }

    public function deleteMultiple(Request $request): RedirectResponse
    {
        $request->validate([
            'users' => ['array'],
            'returnUrl' => ['nullable', 'string'],
        ]);

        User::destroy($request->input('users'));

        if ($request->has('returnUrl') && !empty($request->input('returnUrl'))) {
            return redirect()->away($request->input('returnUrl'));
        }

        return redirect()->route(config('permission_ui.route_name_prefix') . 'users.index');
    }
}
