@extends('PermissionsUI::general')

@section('title')
    {{ __('PermissionsUI::permissions.users.title') }}
@endsection

@section('active_users', "active")

@section('active_roles', '')

@section('active_permissions', '')

@section('content')
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr class="bg-light">
                    <th class="px-3 py-2">{{ __('PermissionsUI::permissions.users.fields.id') }}</th>
                    <th>{{ __('PermissionsUI::permissions.users.fields.name') }}</th>
                    <th>{{ __('PermissionsUI::permissions.users.fields.email') }}</th>
                    <th>{{ __('PermissionsUI::permissions.users.fields.roles') }}</th>
                    <th>{{ __('PermissionsUI::permissions.users.fields.created_at') }}</th>
                    <th class="px-3"></th>
                </tr>
            </thead>

            <tbody class="whitespace-nowrap divide-y">
                @forelse($users as $user)
                    <tr>
                        <td class="px-3 py-2">{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @foreach($user->roles as $role)
                                <span class="rounded-pill bg-primary px-2 py-1 small text-white">{{ __($role->name) }}</span>
                            @endforeach
                        </td>
                        <td>{{ $user->created_at }}</td>
                        <td class="px-3">
                            <a class="btn {{ config('permission_ui.edit_button_classes') }} px-3 py-2" href="{{ route(config('permission_ui.route_name_prefix') . 'users.edit', $user) }}" role="button">
                                {{ __('PermissionsUI::permissions.global.edit') }}
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="p-3" colspan="4">{{ __('PermissionsUI::permissions.global.no_records') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if($users->links())
            <div class="mt-3">
                {{ $users->links() }}
            </div>
        @endif
    </div>
@endsection
