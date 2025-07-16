@extends('PermissionsUI::layout')

@section('content_general')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container mx-auto sm:px-4 max-w-full mx-auto sm:px-4 relative flex flex-col min-w-0 rounded-sm break-words border bg-white border-1 border-gray-300">
            <div class="flex flex-wrap  mt-4 mb-2 md:justify-center">
                <div class="relative grow max-w-full flex-1 px-4 lg:w-1/3 pr-4 pl-4">
                    <h2 class="mb-3 text-center">@yield('title')</h2>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
        <div class="container mx-auto sm:px-4 max-w-full mx-auto sm:px-4">
            <div class="flex flex-wrap  md:justify-center">
                <div class="relative grow max-w-full flex-1 px-4 lg:w-full pr-4 pl-4">
                    @yield('content')
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection
