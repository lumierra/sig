@extends('admin.layouts')

@section('title', 'Formulir Surveilans')

@section('subtitle', 'Formulir Surveilans')

@section('content')

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
                    <div class="col">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h5 class="m-0 font-weight-bold text-success text-center">Formulir Surveilans</h5>
                            </div>
                            <div class="card-body">
                                <div>
                                    <table class="table table-borderless">
                                        <thead>
                                            {{-- <tr>
                                                <th scope="col">No. RM</th>
                                                <th scope="col"></th>
                                                <th scope="col">Last</th>
                                                <th scope="col">Handle</th>
                                            </tr> --}}
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">No. RM</th>
                                                <td>: {{ $patient->KD_PASIEN }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row" width="130px">Nama Pasien</th>
                                                <td>: {{ $patient->NAMA }}  </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Umur</th>
                                                <td>: 63</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Tgl. Masuk</th>
                                                <td>: {{ \Carbon\Carbon::parse($patient->TGL_MASUK)->format('d-m-Y')}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">DPJP</th>
                                                <td>: dr. Shira Nour Rizana, Sp.P, M.Ked</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Unit</th>
                                                <td>: {{ $patient->NAMA_UNIT }}</td>
                                            </tr>
                                        </tbody>
                                      </table>
                                      <hr class="sidebar-divider my-0"><br><br>

                                      <span class="h6 font-weight-bold">Diagnosa</span><br>

                                      <table class="table table-striped">
                                        <thead>
                                          <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Diagnosa</th>
                                            <th scope="col">Ruangan</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <th scope="row">1</th>
                                            <td>J90 - Pleural effusion, not elsewhere classified</td>
                                            <td>{{ $patient->NAMA_UNIT }} -
                                                Tgl. {{ \Carbon\Carbon::parse($patient->TGL_MASUK)->format('d-m-Y')}}</td>
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

    <script src="{{ asset('ext/vendor/jquery/jquery.min.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

@endsection
