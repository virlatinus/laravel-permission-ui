{{ Vite::useBuildDirectory('vendor/permission_ui/build') }}
@php
    $menu = [
        [
            'class' => 'active_users',
            'link' => route(config('permission_ui.route_name_prefix') . 'users.index'),
            'label' => __('PermissionsUI::permissions.users.title'),
        ],
        [
            'class' => 'active_roles',
            'link' => route(config('permission_ui.route_name_prefix') . 'roles.index'),
            'label' => __('PermissionsUI::permissions.roles.title'),
        ],
        [
            'class' => 'active_permissions',
            'link' => route(config('permission_ui.route_name_prefix') . 'permissions.index'),
            'label' => __('PermissionsUI::permissions.permissions.title'),
        ],
    ];
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Permissions - {{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    @vite('resources/css/app.css')
    @stack('scripts')
</head>
<body>
<div class="min-h-full">
    <nav class="bg-indigo-600">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-center">
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        @foreach($menu as $item)
                            <a aria-current="page"
                               class="rounded-md  px-3 py-2 text-sm font-medium @yield($item['class'])"
                               href="{{ $item['link'] }}">{{ $item['label'] }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile menu, show/hide based on menu state. -->
        <div id="mobile-menu" class="md:hidden">
            <div class="space-y-1 px-2 pt-2 pb-3 sm:px-3">
                @foreach($menu as $item)
                    <a aria-current="page"
                       class="block rounded-md px-3 py-2 text-base font-medium @yield($item['class'])"
                       href="{{ $item['link'] }}">{{ $item['label'] }}</a>
                @endforeach
            </div>
        </div>
    </nav>

    <header class="bg-white shadow-sm">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8 flex justify-center">
            <h1 class="text-3xl font-bold tracking-tight text-gray-900">@yield('title')</h1>
        </div>
    </header>

    <main>
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            @yield('content')
        </div>
    </main>
</div>
@stack('child-scripts')
</body>
</html>
