@extends('PermissionsUI::general')

@section('title')
    {{ __('PermissionsUI::permissions.users.title_edit') }}
@endsection

@section('active_users', 'active')

@section('active_roles', '')

@section('active_permissions', '')

@section('content')
    <form class="mt-2 form-group" action="{{ route('permission_ui.users.update', $user) }}" method="post">
        @csrf
        @method('PATCH')

        <div class="mt-4 text-xl-left">{{ __('PermissionsUI::permissions.users.fields.name') }}: <span class="font-weight-bold">{{ $user->name }}</span></div>

        @if($roles->count())
            <div class="mt-3">
                <label class="d-block text-xl-left" for="permissions">{{ __('PermissionsUI::permissions.users.fields.roles') }}</label>
                <div class="ml-2">
                    @foreach($roles as $id => $name)
                        <div class="d-inline-flex ml-3 align-middle">
                            <input class="rounded-circle border border-primary mr-2 form-check-input" type="checkbox" name="roles[]" id="role-{{ $id }}" value="{{ $id }}" @checked(in_array($id, old('roles', [])) || $user->roles->contains($id))>
                            <label class="form-check-label mr-4" for="role-{{ $id }}">{{ __($name) }}</label>
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
