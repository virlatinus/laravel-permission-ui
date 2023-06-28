@extends('PermissionsUI::general')

@section('title')
    {{ __('PermissionsUI::permissions.permissions.title') }}
@endsection

@section('active_users', '')

@section('active_roles', '')

@section('active_permissions', 'active')

@section('content')
    <div class="mt-4 mb-4 flex">
        <a class="btn {{ config('permission_ui.save_button_classes') }} px-3 py-2" href="{{ route(config('permission_ui.route_name_prefix') . 'permissions.create') }}">{{ __('PermissionsUI::permissions.global.create') }}</a>
    </div>

    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr class="bg-light">
                    <th class="px-3 py-2">{{ __('PermissionsUI::permissions.permissions.fields.id') }}</th>
                    <th>{{ __('PermissionsUI::permissions.permissions.fields.name') }}</th>
                    <th>{{ __('PermissionsUI::permissions.permissions.fields.created_at') }}</th>
                    <th></th>
                </tr>
            </thead>

            <tbody class="whitespace-nowrap divide-y">
                @php($formCount = 1)
                @forelse($permissions as $permission)
                    <tr>
                        <td class="px-3 py-2">{{ $permission->id }}</td>
                        <td>{{ __($permission->name) }}</td>
                        <td>{{ $permission->created_at }}</td>
                        <td class="px-3" style="border-left-width: 2px">
                            <a class="btn {{ config('permission_ui.edit_button_classes') }} px-3 py-2" href="{{ route(config('permission_ui.route_name_prefix') . 'permissions.edit', $permission) }}" role="button">
                                {{ __('PermissionsUI::permissions.global.edit') }}
                            </a>

                            <form id="form{{ $formCount }}" action="{{ route(config('permission_ui.route_name_prefix') . 'permissions.destroy', $permission) }}" method="POST" style="display: inline-block;">
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
