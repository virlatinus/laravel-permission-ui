@extends('PermissionsUI::layouts.layout')

@section('title')
  {{ __('PermissionsUI::permissions.users.title') }}
@endsection

@section('active_users', "active")

@section('active_roles', 'inactive')

@section('active_permissions', 'inactive')

@section('content')
  <div class="px-4 sm:px-6 lg:px-8">
    @include('PermissionsUI::shared.header', [
      'heading' => __('PermissionsUI::permissions.users.heading'),
      'link' => route(config('permission_ui.route_name_prefix') . 'users.create'),
      'action' => __('PermissionsUI::permissions.global.create'),
    ])

    <div class="mt-8 flow-root">
      <div class="sm:-mx-6 lg:-mx-8 -mx-4 -my-2 overflow-x-auto">
        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
          <div class="shadow-sm ring-1 ring-black/5 sm:rounded-lg overflow-hidden">

            <!-- Selected row actions, only show when rows are selected. -->
            @include('PermissionsUI::shared.actions', [
              'editLink' => route(config('permission_ui.route_name_prefix') . 'users.edit_multi'),
              'deleteLink' => route(config('permission_ui.route_name_prefix') . 'users.delete_multi'),
              'arrayVar' => 'users[]',
            ])

            <table class="min-w-full divide-y divide-gray-300">
              <thead class="bg-gray-50">
              <tr>
                <th scope="col" class="relative px-7 sm:w-12 sm:px-6">
                  <div class="group absolute top-1/2 left-4 -mt-2 grid size-4 grid-cols-1">
                    <input type="checkbox"
                           onclick="toggleSelectAll({{count($users)}})"
                           class="col-start-1 row-start-1 appearance-none rounded-sm border border-gray-300 bg-white checked:border-indigo-600 checked:bg-indigo-600 indeterminate:border-indigo-600 indeterminate:bg-indigo-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:checked:bg-gray-100 forced-colors:appearance-auto"/>
                    <svg viewBox="0 0 14 14" fill="none"
                         class="pointer-events-none col-start-1 row-start-1 size-3.5 self-center justify-self-center stroke-white group-has-disabled:stroke-gray-950/25">
                      <path d="M3 8L6 11L11 3.5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="opacity-0 group-has-checked:opacity-100"/>
                      <path d="M3 7H11" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="opacity-0 group-has-indeterminate:opacity-100"/>
                    </svg>
                  </div>
                </th>
                <th scope="col"
                    class="py-3.5 pr-3 pl-4 font-semibold text-left text-sm text-gray-900 sm:pl-6 min-w-[170px]">{{ __('PermissionsUI::permissions.users.fields.name') }}</th>
                <th scope="col"
                    class="hidden py-3.5 pr-3 pl-4 font-semibold text-left text-sm text-gray-900 md:table-cell">{{ __('PermissionsUI::permissions.users.fields.email') }}</th>
                <th scope="col"
                    class="px-3 py-3.5 font-semibold text-left text-sm text-gray-900">{{ __('PermissionsUI::permissions.users.fields.roles') }}</th>
                <th scope="col"
                    class="hidden px-3 py-3.5 font-semibold text-left text-sm text-gray-900 lg:table-cell">{{ __('PermissionsUI::permissions.users.fields.created_at') }}</th>
                <th scope="col" class="relative py-3.5 pr-4 pl-3 sm:pr-6">
                  <span class="sr-only">{{ __('PermissionsUI::permissions.global.edit') }}</span>
                </th>
              </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
              @php($formCount = 1)
              @forelse($users as $user)
                <!-- Selected: "bg-gray-50" -->
                <tr id="tr-{{$formCount}}">
                  <td class="relative px-7 sm:w-12 sm:px-6">
                    <!-- Selected row marker, only show when row is selected. -->
                    <div id="marker-{{$formCount}}" class="hidden absolute inset-y-0 left-0 w-0.5 bg-indigo-600"></div>
                    <div class="group absolute top-1/2 left-4 -mt-2 grid size-4 grid-cols-1">
                      <input type="checkbox"
                             id="check-{{$formCount}}"
                             data-id="{{$user->id}}"
                             onclick="toggleSelected({{$formCount}})"
                             class="col-start-1 row-start-1 appearance-none rounded-sm border border-gray-300 bg-white checked:border-indigo-600 checked:bg-indigo-600 indeterminate:border-indigo-600 indeterminate:bg-indigo-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:checked:bg-gray-100 forced-colors:appearance-auto"/>
                      <svg viewBox="0 0 14 14" fill="none"
                           class="pointer-events-none col-start-1 row-start-1 size-3.5 self-center justify-self-center stroke-white group-has-disabled:stroke-gray-950/25">
                        <path d="M3 8L6 11L11 3.5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                              class="opacity-0 group-has-checked:opacity-100"/>
                        <path d="M3 7H11" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                              class="opacity-0 group-has-indeterminate:opacity-100"/>
                      </svg>
                    </div>
                  </td>
                  <!-- Selected: "text-indigo-600", Not Selected: "text-gray-900" -->
                  <td
                      class="tdh py-4 pr-3 pl-4 font-medium text-sm whitespace-nowrap text-gray-900 sm:pl-6">
                    <div>{{ $user->name }}</div>
                    <div class="tdl text-sm text-gray-500 md:hidden">{{ $user->email }}</div>
                  </td>
                  <td class="tdl hidden py-4 pr-3 pl-4 text-sm whitespace-nowrap text-gray-500 md:table-cell">{{ $user->email }}</td>
                  <td class="px-3 py-4 sm:flex-col lg:whitespace-nowrap">
                    @foreach($user->roles as $role)
                      @include('PermissionsUI::shared.badge', [
                                                'color' => $roleColors[$role->name],
                                                'name' => $role->name,
                                                'link' => route(config('permission_ui.route_name_prefix') . 'users.delete_role', [$user, $role]),
                                              ])
                    @endforeach
                  </td>
                  <td
                      class="tdl hidden px-3 py-5 text-sm whitespace-nowrap text-gray-500 lg:table-cell">{{ $user->created_at }}</td>

                  <!-- Actions -->
                  <td class="relative py-4 pr-4 pl-3 flex justify-center items-center whitespace-nowrap sm:pr-6">
                    <a href="{{ route(config('permission_ui.route_name_prefix') . 'users.edit', $user) }}"
                       class="rounded-sm bg-white px-2 py-1 text-xs font-semibold text-gray-900 shadow-xs ring-1 ring-gray-300 ring-inset hover:bg-gray-50 flex"
                       role="button">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                           stroke="#333333" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                        <path
                            d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z"></path>
                      </svg>
                      <span class="sr-only">{{ __('PermissionsUI::permissions.global.edit') }} {{ $user->name }}</span></a>

                    <form id="form{{ $formCount }}" class="inline-block"
                          action="{{ route(config('permission_ui.route_name_prefix') . 'users.destroy', $user) }}"
                          method="POST">
                      @csrf
                      @method('DELETE')
                      <a href="#"
                         class="rounded-sm bg-white px-2 py-1 text-xs font-semibold text-gray-900 shadow-xs ring-1 ring-gray-300 ring-inset hover:bg-gray-50 flex ml-2"
                         onclick="deleteTableRow('form{{ $formCount++ }}')"
                         data-confirm="{{ __('PermissionsUI::permissions.global.confirm_action') }}"
                         role="button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                             stroke="#333333" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                          <path d="M3 6h18"></path>
                          <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path>
                          <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path>
                          <line x1="10" x2="10" y1="11" y2="17"></line>
                          <line x1="14" x2="14" y1="11" y2="17"></line>
                        </svg>
                        <span
                            class="sr-only">{{ __('PermissionsUI::permissions.global.delete') }} {{ $user->name }}</span></a>
                    </form>
                  </td>
                  <!-- End of Actions -->
                </tr>
              @empty
                <tr>
                  <td class="p-6"
                      colspan="4">{{ __('PermissionsUI::permissions.global.no_records') }}</td>
                </tr>
              @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    @if($users->links())
      <div class="mt-3">
        {{ $users->links() }}
      </div>
    @endif

  </div>
@endsection

@push('child-scripts')
  @include('PermissionsUI::scripts.delete-row')
@endpush

@push('scripts')
  @include('PermissionsUI::scripts.select-row')
@endpush
