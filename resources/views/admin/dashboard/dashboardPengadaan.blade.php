@extends('admin.layouts')

@section('title', 'Dashboard Pengadaan')

@section('content')
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                <a href="{{ route('admin.makanan.index') }}" class="sidebar-brand text-success">Data Vendor</a>
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $vendors }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-paste fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                <a href="{{ route('admin.permintaan.index') }}" class="sidebar-brand text-info">Data Permintaan</a>
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">1</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-bars fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
{{--        <div class="col-xl-3 col-md-6 mb-4">--}}
{{--            <div class="card border-left-info shadow h-100 py-2">--}}
{{--                <div class="card-body">--}}
{{--                    <div class="row no-gutters align-items-center">--}}
{{--                        <div class="col mr-2">--}}
{{--                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">--}}
{{--                                <a href="{{ route('admin.bahan-makanan.index') }}" class="sidebar-brand text-info">Data Bahan Makanan</a>--}}
{{--                            </div>--}}
{{--                            <div class="row no-gutters align-items-center">--}}
{{--                                <div class="col-auto">--}}
{{--                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $materials }}</div>--}}
{{--                                </div>--}}
{{--                                --}}{{-- <div class="col">--}}
{{--                                    <div class="progress progress-sm mr-2">--}}
{{--                                    <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                                    </div>--}}
{{--                                </div> --}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-auto">--}}
{{--                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <div class="col-xl-3 col-md-6 mb-4">--}}
{{--            <div class="card border-left-success shadow h-100 py-2">--}}
{{--                <div class="card-body">--}}
{{--                    <div class="row no-gutters align-items-center">--}}
{{--                        <div class="col mr-2">--}}
{{--                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">--}}
{{--                                <a href="{{ route('admin.satuan-makanan.index') }}" class="sidebar-brand text-success">Data Satuan Makanan</a>--}}
{{--                            </div>--}}
{{--                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $units }}</div>--}}
{{--                        </div>--}}
{{--                        <div class="col-auto">--}}
{{--                            <i class="fas fa-bars fa-2x text-gray-300"></i>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

        <!-- Pending Requests Card Example -->
{{--        <div class="col-xl-3 col-md-6 mb-4">--}}
{{--            <div class="card border-left-warning shadow h-100 py-2">--}}
{{--                <div class="card-body">--}}
{{--                    <div class="row no-gutters align-items-center">--}}
{{--                        <div class="col mr-2">--}}
{{--                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">--}}
{{--                                <a href="{{ route('admin.detail-makanan.index') }}" class="sidebar-brand text-warning">Data Detail Bahan Makanan</a>--}}
{{--                            </div>--}}
{{--                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $details }}</div>--}}
{{--                        </div>--}}
{{--                        <div class="col-auto">--}}
{{--                            <i class="fas fa-list-alt fa-2x text-gray-300"></i>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                <a href="{{ route('admin.penerimaan.index') }}" class="sidebar-brand text-danger">Data Penerimaan</a>
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">1</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-list-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('ext/vendor/jquery/jquery.min.js') }}"></script>
@endsection
