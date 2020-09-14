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
            box-shadow: 0 0 3px rgba(0, 0, 0, 0.2);
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
            box-shadow: 0 10px 10px rgba(0, 0, 0, 0.5);
            content: "";
            height: 20px;
            left: 10px;
            position: absolute;
            right: 10px;
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
                    @foreach($users->rooms as $room)
                        <div class="col-md-3">
                            <div class="box box-4">
                                <div class="box-content">
                                    <a href="{{ route('admin.ahli-gizi.create') }}" class="text-success h4">{{ ucfirst($room->name) }}</a>
                                    <p>Content</p>
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
