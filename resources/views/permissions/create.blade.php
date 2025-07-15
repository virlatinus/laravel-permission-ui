@extends('PermissionsUI::layouts.layout')

@section('title')
  {{ __('PermissionsUI::permissions.permissions.title_create') }}
@endsection

@section('active_users', 'inactive')

@section('active_roles', 'inactive')

@section('active_permissions', 'active')

@section('content')
  <div class="min-h-full flex flex-col justify-center sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-lg">
      <div class="px-6 py-12 bg-white shadow-sm sm:rounded-lg sm:px-12">
        <form action="{{ route(config('permission_ui.route_name_prefix') . 'permissions.store') }}" method="post">
          @csrf
          <div class="pb-12 border-b border-gray-900/10">

            <div class="space-y-6">

              <div>
                <label for="name"
                       class="block font-medium text-sm/6 text-gray-900">{{ __('PermissionsUI::permissions.permissions.fields.name') }}</label>
                <div class="mt-2">
                  <input id="name" type="text" name="name" required autocomplete="name"
                         placeholder="{{ __('PermissionsUI::permissions.permissions.fields.name') }}"
                         class="block w-full px-3 py-1.5 bg-white rounded-md outline-1 outline-gray-300 text-base text-gray-900 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6 -outline-offset-1 placeholder:text-gray-400"/>
                </div>
                @error('name')
                <p id="name-error" class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
              </div>

              @if($roles->count())
                <fieldset>
                  <legend
                      class="font-semibold text-sm/6 text-gray-900">{{ __('PermissionsUI::permissions.permissions.fields.roles') }}</legend>
                  <div class="mt-6 space-y-4">

                    @foreach($roles as $id => $name)
                      <div class="flex gap-3">
                        <div class="h-6 flex shrink-0 items-center">
                          <div class="grid grid-cols-1 group size-4">
                            <input type="checkbox" name="roles[]" id="role-{{ $id }}"
                                   aria-describedby="{{ $name }}-description"
                                   value="{{ $id }}"
                                   class="col-start-1 row-start-1 bg-white border border-gray-300 rounded-sm disabled:border-gray-300 disabled:bg-gray-100 disabled:checked:bg-gray-100 appearance-none checked:border-indigo-600 checked:bg-indigo-600 indeterminate:border-indigo-600 indeterminate:bg-indigo-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 forced-colors:appearance-auto"/>
                            <svg viewBox="0 0 14 14"
                                 class="col-start-1 row-start-1 justify-self-center pointer-events-none size-3.5 self-center stroke-white group-has-disabled:stroke-gray-950/25">
                              <path d="M3 8L6 11L11 3.5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    class="opacity-0 group-has-checked:opacity-100"/>
                              <path d="M3 7H11" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    class="opacity-0 group-has-indeterminate:opacity-100"/>
                            </svg>
                          </div>
                        </div>
                        <div class="text-sm/6">
                          <label class="font-medium text-gray-900" for="role-{{ $id }}">{{ __($name) }}</label>
                        </div>
                      </div>
                    @endforeach

                  </div>
                </fieldset>
              @endif

            </div>
          </div>

          <div class="mt-6 flex gap-x-6 justify-end items-center">
            <a class="rounded-sm bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-xs ring-1 ring-gray-300 ring-inset hover:bg-gray-50"
               href="{{ route(config('permission_ui.route_name_prefix').'permissions.index') }}"
               role="button">{{ __('PermissionsUI::permissions.global.cancel') }}</a>
            <button type="submit"
                    class="px-3 py-2 bg-indigo-600 rounded-md shadow-xs font-semibold text-sm text-white hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
              {{ __('PermissionsUI::permissions.global.save') }}
            </button>
          </div>

        </form>
      </div>
    </div>
  </div>

@endsection
