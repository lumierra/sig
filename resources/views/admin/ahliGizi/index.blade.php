@extends('admin.layouts')

@section('title', 'Ahli Gizi')

@section('subtitle', 'Ahli Gizi')

@section('content')
    <style>
        /*body {*/
        /*    font-family: Gotham, "Helvetica Neue", Helvetica, Arial, sans-serif;*/
        /*    font-size: 1em;*/
        /*}*/

        .box *:last-child {
            margin-bottom: 0;
        }

        .box-4 {
            /* box-shadow: 0 0 3px rgba(0, 0, 0, 0.2); */
            box-shadow: 0 0 5px rgba(28, 200, 138, 1);
            position: relative;
            /*width: 30%;*/
            /*margin: 20px 0px 0px 40px;*/
            margin-bottom: 20px;
        }

        .box-content {
            background: none repeat scroll 0 0 #FFFFFF;
            background-color: #f3f3f3;
            padding: 25px 55px 45px 55px;
            position: relative;
            z-index: 1;
        }
        .box-4:after {
            border-radius: 0 0 50% 50% / 0 0 20px 20px;
            bottom: 0;
            box-shadow: 0 10px 10px rgba(28,200,138,1);
            /* box-shadow: : 0 10px 10px rgba(0,0,0,0.5); */
            content: "";
            height: 20px;
            left: 10px;
            position: absolute;
            right: 10px;
        }
        .brd{
            border-bottom: 1px solid #000;
        }
    </style>

    @section('button')
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">@yield('subtitle')</h1>
        </div>
    @endsection

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    @foreach($beds as $bed)
                        <div class="col-md-5">
                            <div class="box box-4">
                                <div class="box-content">
                                    <table class="myTables">
                                        <tbody>
                                            <tr>
                                                <th colspan="2" class="text-center border-bottom border-dark">
                                                    <a href="{{ route('admin.ahli-gizi.ruangan', $bed->KD_RUANG) }}" class="text-success">{{ $bed->ALIAS }}</a>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th class="text-center border-right border-dark px-2">{{ $bed->JUMLAH_KAMAR }} Jumlah Kamar</th>
                                                <th class="text-center">{{ $bed->JUMLAH_BED }} Tempat Tidur</th>
                                            </tr>
                                            <tr>
                                                <td class="text-center border-right border-dark px-2">
                                                    {{ ($bed->KAMAR_TERSEDIA - $bed->DIGUNAKAN ) }} Tersedia<br>{{ $bed->DIGUNAKAN }} Penuh<br>{{ $bed->KAMAR_PEMELIHARAAN }} Pemeliharaan
                                                </td>
                                                <td class="text-center px-2">
                                                    {{ $bed->TERSEDIA }} Tersedia<br>{{ $bed->DIGUNAKAN }} Digunakan<br>{{ $bed->PEMELIHARAAN }} Pemeliharaan
                                                </td>
                                            </tr>
                                      </tbody>
                                    </table>
                                    {{-- <a href="{{ route('admin.ahli-gizi.create') }}" class="text-success h6">{{ ucfirst($room->name) }}</a>
                                    <p>Content</p> --}}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>


@endsection
