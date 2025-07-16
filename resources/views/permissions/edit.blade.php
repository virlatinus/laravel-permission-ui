@extends('PermissionsUI::general')

@section('title')
    {{ __('PermissionsUI::permissions.permissions.title_edit') }}
@endsection

@section('active_users', '')

@section('active_roles', '')

@section('active_permissions', 'active')

@section('content')
    <form class="mt-2 mb-4" action="{{ route(config('permission_ui.route_name_prefix') . 'permissions.update', $permission) }}" method="post">
        @csrf
        @method('PATCH')

        <div class="mt-4 xl:text-left">
            <div class="mt-3">
                <label class="block xl:text-left" for="name">{{ __('PermissionsUI::permissions.permissions.fields.name') }}</label>
                <input class="px-2 py-1" type="text" name="name" id="name" value="{{ old('name', $permission->name) }}" required />
                @error('name')
                    <span class="text-xs danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        @if($roles->count())
            <div class="mt-3">
                <label class="block xl:text-left" for="roles">{{ __('PermissionsUI::permissions.roles.title') }}</label>
                <div class="ml-2">
                    @foreach($roles as $id => $name)
                        <div class="inline-flex ml-3 align-middle">
                            <input class="rounded-full border border-blue-600 mr-2 absolute mt-1 -ml-6" type="checkbox" name="roles[]" id="role-{{ $id }}" value="{{ $id }}" @checked(in_array($id, old('role', [])) || $permission->roles->contains($id))>
                            <label class="text-gray-700 pl-6 mb-0 mr-4"  for="role-{{ $id }}">{{ __($name) }}</label>
                        </div>
                    @endforeach
                </div>
                @error('roles')
                    <span class="text-xs danger">{{ $message }}</span>
                @enderror
            </div>
        @endif

        <button class="inline-block align-middle text-center select-none border font-normal whitespace-nowrap rounded-sm py-1 px-3 leading-none no-underline {{ config('permission_ui.save_button_classes') }} mt-4 px-3 py-2" type="submit">
            {{ __('PermissionsUI::permissions.global.save') }}
        </button>
    </form>
@endsection
