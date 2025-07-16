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
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}">
</head>
<body class="h-100 w-100 p4 bg-light">
    <main class="wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid card-header">
                <div class="row mt-4 mb-2 justify-content-md-center">
                    <div class="col col-lg-4">
                        <nav class="navbar navbar-expand-lg navbar-light bg-light">
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse justify-content-md-center" id="navbarNav">
                                <ul class="navbar-nav justify-content-center">
                                    <li class="nav-item @yield('active_users')">
                                        <a class="nav-link" href="{{ route(config('permission_ui.route_name_prefix') . 'users.index') }}">{{ __('PermissionsUI::permissions.users.title') }}</a>
                                    </li>
                                    <li class="nav-item @yield('active_roles')">
                                        <a class="nav-link" href="{{ route(config('permission_ui.route_name_prefix') . 'roles.index') }}">{{ __('PermissionsUI::permissions.roles.title') }}</a>
                                    </li>
                                    <li class="nav-item @yield('active_permissions')">
                                        <a class="nav-link" href="{{ route(config('permission_ui.route_name_prefix') . 'permissions.index') }}">{{ __('PermissionsUI::permissions.permissions.title') }}</a>
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
    @vite('resources/js/app.js')
    @stack('child-scripts')
</body>
</html>
