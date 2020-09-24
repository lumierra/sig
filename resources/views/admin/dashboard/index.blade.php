@extends('admin.layouts')

@section('title', 'Dashboard')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Transaksi</h1>
    </div>
    <div class="row">

        <!-- Transaksi Permintaan -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-bottom-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                <a href="{{ route('admin.permintaan.index') }}" class="text-warning text-lg">Permintaan</a>
                            </div>
                            {{-- <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $demand }}</div> --}}
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-upload fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
            <br>
        </div>

        <!-- Transaksi Penerimaan -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-bottom-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                <a href="{{ route('admin.penerimaan.index') }}" class="text-success text-lg">Penerimaan</a>
                            </div>
                            {{-- <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $receipt }}</div> --}}
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-download fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Transaksi Pengeluaran -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-bottom-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                <a href="{{ route('admin.pengeluaran.index') }}" class="text-danger text-lg">Pengeluaran</a>
                            </div>
                            {{-- <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $spend }}</div> --}}
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-sign-out-alt fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Transaksi Pengembalian -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-bottom-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                <a href="{{ route('admin.retur.index') }}" class="text-info text-lg">Pengembalian</a>
                            </div>
                            {{-- <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $retur }}</div> --}}
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-reply fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Divider -->
    <hr class="sidebar-divider">


    <script src="{{ asset('ext/vendor/jquery/jquery.min.js') }}"></script>
@endsection
