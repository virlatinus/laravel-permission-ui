@extends('PermissionsUI::layout')

@section('content_general')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid card">
            <div class="row mt-4 mb-2 justify-content-md-center">
                <div class="col col-lg-4">
                    <h2 class="card-title text-center">@yield('title')</h2>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-md-center">
                <div class="col col-lg-12">
                    @yield('content')
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection
