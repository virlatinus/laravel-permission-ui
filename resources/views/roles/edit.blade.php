@extends('PermissionsUI::general')

@section('title')
    {{ __('PermissionsUI::permissions.roles.title_edit') }}
@endsection

@section('active_users', '')

@section('active_roles', 'active')

@section('active_permissions', '')

@section('content')
    <form class="mt-2 form-group" action="{{ route(config('permission_ui.route_name_prefix') . 'roles.update', $role) }}" method="post">
        @csrf
        @method('PATCH')

        <div class="mt-4 text-xl-left">
            <div class="mt-3">
                <label class="d-block text-xl-left" for="name">{{ __('PermissionsUI::permissions.roles.fields.name') }}</label>
                    <input class="px-2 py-1" type="text" name="name" id="name" value="{{ old('name', $role->name) }}" required />
                @error('name')
                    <span class="small danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        @if($permissions->count())
            <div class="mt-3">
                <label class="d-block text-xl-left" for="permissions">{{ __('PermissionsUI::permissions.roles.fields.permissions') }}</label>
                <div class="ml-2">
                    @foreach($permissions as $id => $name)
                        <div class="d-inline-flex ml-3 align-middle">
                            <input class="rounded-circle border border-primary mr-2 form-check-input" type="checkbox" name="permissions[]" id="permission-{{ $id }}" value="{{ $id }}" @checked(in_array($id, old('permissions', [])) || $role->permissions->contains($id))>
                            <label class="form-check-label mr-4"  for="permission-{{ $id }}">{{ __($name) }}</label>
                        </div>
                    @endforeach
                </div>
                @error('permissions')
                    <span class="small danger">{{ $message }}</span>
                @enderror
            </div>
        @endif

        <button class="btn {{ config('permission_ui.save_button_classes') }} mt-4 px-3 py-2" type="submit">
            {{ __('PermissionsUI::permissions.global.save') }}
        </button>
    </form>
@endsection
