@extends('PermissionsUI::general')

@section('title')
    {{ __('PermissionsUI::permissions.roles.title') }}
@endsection

@section('active_users', '')

@section('active_roles', 'active')

@section('active_permissions', '')

@section('content')
    <div class="mt-4 mb-4 flex">
        <a class="btn {{ config('permission_ui.save_button_classes') }} px-3 py-2" href="{{ route(config('permission_ui.route_name_prefix') . 'roles.create') }}" role="button">{{ __('PermissionsUI::permissions.global.create') }}</a>
    </div>

    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
            <tr class="bg-light">
                <th class="px-3 py-2">{{ __('PermissionsUI::permissions.roles.fields.id') }}</th>
                <th>{{ __('PermissionsUI::permissions.roles.fields.name') }}</th>
                <th>{{ __('PermissionsUI::permissions.roles.fields.permissions') }}</th>
                <th>{{ __('PermissionsUI::permissions.roles.fields.created_at') }}</th>
                <th></th>
            </tr>
            </thead>

            <tbody class="whitespace-nowrap divide-y">
                @php($formCount = 1)
                @forelse($roles as $role)
                    <tr>
                        <td class="px-3 py-2">{{ $role->id }}</td>
                        <td>{{ __($role->name) }}</td>
                        <td>
                            @foreach($role->permissions as $permission)
                                <span class="rounded-pill bg-primary px-2 py-1 small text-white">{{ __($permission->name) }}</span>
                            @endforeach
                        </td>
                        <td>{{ $role->created_at }}</td>
                        <td class="px-3" style="border-left-width: 2px">
                            <a class="btn {{ config('permission_ui.edit_button_classes') }} px-3 py-2" href="{{ route(config('permission_ui.route_name_prefix') . 'roles.edit', $role) }}" role="button">
                                {{ __('PermissionsUI::permissions.global.edit') }}
                            </a>

                            <form id="form{{ $formCount }}" action="{{ route(config('permission_ui.route_name_prefix') . 'roles.destroy', $role) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button class="btn {{ config('permission_ui.delete_button_classes') }} px-3 py-2 delete-row" type="button" onclick="deleteTableRow('form{{ $formCount++ }}')" data-confirm="{{ __('PermissionsUI::permissions.global.confirm_action') }}">
                                    {{ __('PermissionsUI::permissions.global.delete') }}
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="p-4" colspan="4">{{ __('PermissionsUI::permissions.global.no_records') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection

@push('child-scripts')
@include('PermissionsUI::delete-row')
@endpush
