<?php

namespace virlatinus\PermissionsUI\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Multitenancy\Contracts\IsTenant;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class TenantController extends Controller
{
    public function index(): View
    {
        $tenants = app(IsTenant::class)::with([
            'users' => fn ($query) => $query->orderBy('name', 'asc')
        ])->paginate(config('permission_ui.pagination_page_size', 5));

        $userColors = User::all()->map(function ($user) { return [$user->name => static::stringToColor($user->name)]; })->collapseWithKeys()->toArray();

        return view('PermissionsUI::tenants.index', compact('tenants', 'userColors'), ['hasMultitenancy'=>self::hasMultitenancy()]);
    }

    public function create(): View
    {
        $users = User::pluck('name', 'id');

        return view('PermissionsUI::tenants.create', compact('users'), ['hasMultitenancy'=>self::hasMultitenancy()]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string'],
            'users' => ['array'],
        ]);

        $tenant = app(IsTenant::Class)::create([
            'name' => $request->input('name'),
            ]);

        $column = config('permission_ui.tenant_id_column');
        if (!empty($column) && $request->has('users')) {
            User::whereIn('id', $request->input('users'))->update([$column => $tenant->id]);
        }

        return redirect()->route(config('permission_ui.route_name_prefix') . 'tenants.index');
    }

    public function edit(Request $request): View
    {
        $tenant = app(IsTenant::class)->findOrFail($request->route('tenant'));

        $users = User::pluck('name', 'id');

        return view('PermissionsUI::tenants.edit', compact('tenant', 'users'), ['hasMultitenancy'=>self::hasMultitenancy()]);
    }

    public function update(Request $request): RedirectResponse
    {
        $tenant = app(IsTenant::class)->findOrFail($request->route('tenant'));

        $request->validate([
            'name' => ['required', 'string'],
            'users' => ['required', 'array'],
        ]);
        
        $tenant->update(['name' => $request->input('name')]);

        // change string IDs to int
        $column = config('permission_ui.tenant_id_column');
        if (!empty($column) && $request->has('users')) {
           User::whereIn('id', $request->input('users'))->update([$column => $tenant->id]);
        }

        return redirect()->route(config('permission_ui.route_name_prefix') . 'tenants.index');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $tenant = app(IsTenant::class)->findOrFail($request->route('tenant'));

        if (method_exists($tenant,'forceDelete')) {
            $tenant->forceDelete();
        } else {
            $tenant->delete();
        }

        return redirect()->route(config('permission_ui.route_name_prefix') . 'tenants.index');
    }

    public function deleteUser(Request $request): RedirectResponse
    {
        $user = app(User::class)->findOrFail($request->route('user'));

        $column = config('permission_ui.tenant_id_column');
        if (!empty($column)) {
            $user->update([$column => null]);
        }

        return redirect()->route(config('permission_ui.route_name_prefix') . 'tenants.index');
    }

    public function deleteMultiple(Request $request): RedirectResponse
    {
        $request->validate([
            'tenants' => ['array'],
            'returnUrl' => ['nullable', 'string'],
        ]);

        if (method_exists(app(IsTenant::Class)::class,'forceDestroy')) {
            app(IsTenant::Class)::forceDestroy($request->input('tenants'));
        } else {
            app(IsTenant::Class)::destroy($request->input('tenants'));
        }

        if ($request->has('returnUrl') && !empty($request->input('returnUrl'))) {
            return redirect()->away($request->input('returnUrl'));
        }

        return redirect()->route(config('permission_ui.route_name_prefix') . 'tenants.index');
    }
}
