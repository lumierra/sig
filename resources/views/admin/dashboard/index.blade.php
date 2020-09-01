@extends('admin.layouts')

@section('title', 'Dashboard')

@section('content')
    <div class="row">

        <!-- Master Makanan -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-bottom-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                <a href="{{ route('admin.dashboard-makanan.index') }}" class="text-success text-lg">Master Makanan</a>
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">6 Fitur</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-th-large fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
            <br>
        </div>

        <!-- Master Pengadaan -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-bottom-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                <a href="{{ route('admin.dashboard-pengadaan.index') }}" class="text-info text-lg">Master Pengadaan</a>
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">4 Fitur</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-th-large fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('ext/vendor/jquery/jquery.min.js') }}"></script>
@endsection
