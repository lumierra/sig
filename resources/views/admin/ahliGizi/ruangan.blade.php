@extends('admin.layouts')

@section('title', 'Detail Ruangan')

@section('subtitle', 'Detail Ruangan')

@section('content')

    <style>
    </style>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Content Row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h5 class="m-0 font-weight-bold text-success text-center">Data Pasien Di Ruang Perawatan Kebidanan</h5>
                            </div>
                            <div class="card-body">
                                <div class="col-md-12">
                                    <div class="box box-danger">
                                        <div class="box-body">
                                            <small><b>Catatatn: Jika pasien sudah ada diruangan tetapi data pasien belum tersedia di sistem, silakan menghubungi operator ruangan masing-masing.</b></small>
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center align-middle" rowspan="2">No</th>
                                                            <th class="text-center align-middle" rowspan="2">Aksi</th>
                                                            <th class="text-center align-middle" rowspan="2">Identitas Pasien</th>
                                                            <th class="text-center align-middle" rowspan="2" >Diagnosa</th>
                                                            <th class="text-center align-middle" colspan="3" >Tindakan</th>
                                                            <th class="text-center align-middle" colspan="5" >Infeksi Rumah Sakit</th>
                                                            <th class="text-center align-middle" rowspan="2">Tirah Baring</th>
                                                            <th class="text-center align-middle" rowspan="2">Dekub</th>
                                                            <th class="text-center align-middle" rowspan="2">Antibiotik</th>
                                                        </tr>
                                                        <tr>
                                                            <th class="text-center">UC</th>
                                                            <th class="text-center">IVL</th>
                                                            <th class="text-center">CVL</th>
                                                            <th class="text-center">HAP</th>
                                                            <th class="text-center">VAP</th>
                                                            <th class="text-center">ISK</th>
                                                            <th class="text-center">IAD</th>
                                                            <th class="text-center">PLB</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                            <tr>
                                                                <td colspan="53" class="font-weight-bold text-white bg-success">RK-01 KLS I</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-center" colspan="15">Tidak Ada Pasien</td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="53" class="font-weight-bold text-white bg-success">RK-02 KLS I</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-center align-middle">1</td>
                                                                <td class="text-center align-middle">
                                                                    <a class="btn btn-circle btn-danger" href="http://localhost/hais/input/MC02Ny0yMS01MQ=="
                                                                    data-toggle="tooltip" data-placement="top" title="Isi Formulir"
                                                                    >
                                                                        <i class="fas fa-location-arrow"></i>
                                                                    </a>
                                                                </td>
                                                                <td>
                                                                    0-67-21-51<br>
                                                                    <label style="font-weight:bold;">SYAMSIDAR</label> ; Wanita ; 58 Thn.<br>Tgl. Masuk : 15-09-2020<br>DPJP : dr. Erik A. Rahman, Sp.OG
                                                                </td>
                                                                <td class="text-left align-middle">C56 - Malignant neoplasm of ovary</td>
                                                                <td class="text-center align-middle">0</td>
                                                                <td class="text-center align-middle">0</td>
                                                                <td class="text-center align-middle">0</td>
                                                                <td class="text-center align-middle">0</td>
                                                                <td class="text-center align-middle">0</td>
                                                                <td class="text-center align-middle">0</td>
                                                                <td class="text-center align-middle">0</td>
                                                                <td class="text-center align-middle">0</td>
                                                                <td class="text-center align-middle">0</td>
                                                                <td class="text-center align-middle">0</td>
                                                                <td class="text-center align-middle">0</td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="53" class="font-weight-bold text-white bg-success">RK-05</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-center" colspan="15">Tidak Ada Pasien</td>
                                                            </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>

    <script src="{{ asset('ext/vendor/jquery/jquery.min.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

@endsection
