@extends('PermissionsUI::general')

@section('title')
    {{ __('PermissionsUI::permissions.users.title_edit') }}
@endsection

@section('active_users', 'active')

@section('active_roles', '')

@section('active_permissions', '')

@section('content')
    <form class="mt-2 mb-4" action="{{ route('permission_ui.users.update', $user) }}" method="post">
        @csrf
        @method('PATCH')

        <div class="mt-4 xl:text-left">{{ __('PermissionsUI::permissions.users.fields.name') }}: <span class="font-bold">{{ $user->name }}</span></div>

        @if($roles->count())
            <div class="mt-3">
                <label class="block xl:text-left" for="permissions">{{ __('PermissionsUI::permissions.users.fields.roles') }}</label>
                <div class="ml-2">
                    @foreach($roles as $id => $name)
                        <div class="inline-flex ml-3 align-middle">
                            <input class="rounded-full border border-blue-600 mr-2 absolute mt-1 -ml-6" type="checkbox" name="roles[]" id="role-{{ $id }}" value="{{ $id }}" @checked(in_array($id, old('roles', [])) || $user->roles->contains($id))>
                            <label class="text-gray-700 pl-6 mb-0 mr-4" for="role-{{ $id }}">{{ __($name) }}</label>
                        </div>
                    @endforeach
                </div>
                @error('permissions')
                    <span class="text-xs danger">{{ $message }}</span>
                @enderror
            </div>
        @endif

        <button class="inline-block align-middle text-center select-none border font-normal whitespace-nowrap rounded-sm py-1 px-3 leading-none no-underline {{ config('permission_ui.save_button_classes') }} mt-4 px-3 py-2" type="submit">
            {{ __('PermissionsUI::permissions.global.save') }}
        </button>
    </form>
@endsection
