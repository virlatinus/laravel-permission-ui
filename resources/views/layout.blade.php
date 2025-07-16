<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Permissions - {{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/permission_ui/build/assets/app-BVG9CApL.css') }}">
    <!-- Font Awesome -->
    <!-- <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}"> -->
</head>
<body class="h-full w-full p4 bg-gray-100">
    <main class="wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container mx-auto sm:px-4 max-w-full mx-auto sm:px-4 py-3 px-6 mb-0 bg-gray-200 border-b-1 border-gray-300 text-gray-900">
                <div class="flex flex-wrap  mt-4 mb-2 md:justify-center">
                    <div class="relative grow max-w-full flex-1 px-4 lg:w-1/3 pr-4 pl-4">
                        <nav class="relative flex flex-wrap items-center content-between py-3 px-4  text-black bg-gray-100">
                            <div class="grow items-center md:justify-center" id="navbarNav">
                                <ul class="flex flex-wrap list-none pl-0 mb-0 justify-center">
                                    <li class=" @yield('active_users')">
                                        <a class="inline-block py-2 px-4 no-underline" href="{{ route(config('permission_ui.route_name_prefix') . 'users.index') }}">{{ __('PermissionsUI::permissions.users.title') }}</a>
                                    </li>
                                    <li class=" @yield('active_roles')">
                                        <a class="inline-block py-2 px-4 no-underline" href="{{ route(config('permission_ui.route_name_prefix') . 'roles.index') }}">{{ __('PermissionsUI::permissions.roles.title') }}</a>
                                    </li>
                                    <li class=" @yield('active_permissions')">
                                        <a class="inline-block py-2 px-4 no-underline" href="{{ route(config('permission_ui.route_name_prefix') . 'permissions.index') }}">{{ __('PermissionsUI::permissions.permissions.title') }}</a>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <div class="content-wrapper">
            @yield('content_general')
        </div>
    </main>
<!--    @ vite('resources/js/app.js') -->
    @stack('child-scripts')
</body>
</html>
