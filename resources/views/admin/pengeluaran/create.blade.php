@extends('admin.layouts')

@section('title', 'Buat Pengeluaran')

@section('subtitle', 'Buat Pengeluaran')

@section('content')

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
                                <h6 class="m-0 font-weight-bold text-success">Form Pengeluaran</h6>
                            </div>
                            <div class="card-body">
                                <div class="col-lg-12">
                                    <form action="{{ route('admin.pengeluaran.store') }}" method="POST" class="needs-validation" novalidate>
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-7">
                                                <div class="form-group">
                                                    <label for="jenis">Tujuan</label>
                                                    <select class="form-control custom-select" id="tujuan" name="tujuan" required>
                                                        <option selected>Pilih Tujuan</option>
                                                        @foreach($places as $place)
                                                            <option value="{{ $place->name }}" name="{{ $place->name }}">{{ $place->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="inputFormRow">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="table-responsive">
                                                        <table class="table table-borderless" id="inputFormRow2">
                                                            <thead>
                                                            <tr>
                                                                <th>Bahan</th>
                                                                <th>Jumlah</th>
                                                                <th>Nama Satuan</th>
                                                                <th>Keterangan</th>
                                                                <th>Action</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <td width="200px">
                                                                    <div class="form-group">
                                                                        <select class="form-control custom-select material" id="material0" name="material[]" required>
                                                                            <option selected disabled>Bahan</option>
                                                                            @foreach ($materials as $material)
                                                                                <option value="{{$material->id}}" name="{{$material->name}}">{{ Str::ucfirst($material->name) }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td width="100px">
                                                                    <div class="form-group">
                                                                        <input onkeyup="myFunction('0')" type="text" class="form-control" id="jumlah0" name="jumlah[]" autocomplete="off" onkeypress="return hanyaAngka(event)">
                                                                    </div>
                                                                </td>
                                                                <td width="150px">
                                                                    <div class="form-group">
                                                                        <select class="form-control custom-select" name="unit" id="unit[]">
                                                                            <option selected disabled>Satuan</option>
                                                                            @foreach ($units as $unit)
                                                                                <option value="{{$unit->id}}" name="{{$unit->name}}">{{ Str::ucfirst($unit->name) }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td width="300px">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="keterangan" name="keterangan[]" autocomplete="off" placeholder="Keterangan">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <button id="removeRow" type="button" class="btn btn-danger rounded">
                                                                        <i class="fas fa-trash fa-sm"></i>
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="newRow"></div>
                                        <button id="addRow" type="button" class="btn btn-primary">
                                            <i class="fa fa-plus-circle"></i>
                                        </button><br><br>

                                        <a href="{{ route('admin.pengeluaran.index') }}" class="btn btn-danger">Batal</a>
                                        <button type="submit" class="btn btn-success" onclick="cekStok">Simpan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('ext/vendor/jquery/jquery.min.js') }}"></script>
    <script type="text/javascript">
        // add row
        var material = 1;
        $("#addRow").click(function () {
            var html = '';
            html += '<table class="table table-borderless" id="inputFormRow2">\n' +
                '                                                            <tbody>\n' +
                '                                                                <tr>\n' +
                '                                                                    <td width="200px">\n' +
                '                                                                        <div class="form-group">\n' +
                '                                                                            <select class="form-control custom-select material" id="material' + material + '" name="material[]" required>\n' +
                '                                                                                <option selected disabled>Bahan</option>\n' +
                '                                                                                @foreach ($materials as $material)\n' +
                '                                                                                    <option value="{{$material->id}}" name="{{$material->name}}">{{ Str::ucfirst($material->name) }}</option>\n' +
                '                                                                                @endforeach\n' +
                '                                                                            </select>\n' +
                '                                                                        </div>\n' +
                '                                                                    </td>\n' +
                '                                                                    <td width="100px">\n' +
                '                                                                        <div class="form-group">\n' +
                '                                                                           <input onkeyup="myFunction(' + material + ')" type="text" class="form-control" id="jumlah' + material + '" name="jumlah[]" autocomplete="off" onkeypress="return hanyaAngka(event)">\n' +
                '                                                                        </div>\n' +
                '                                                                    </td>\n' +
                '                                                                    <td width="150px">\n' +
                '                                                                        <div class="form-group">\n' +
                '                                                                            <select class="form-control custom-select" name="unit" id="unit[]">\n' +
                '                                                                                <option selected disabled>Satuan</option>\n' +
                '                                                                                @foreach ($units as $unit)\n' +
                '                                                                                    <option value="{{$unit->id}}" name="{{$unit->name}}">{{ Str::ucfirst($unit->name) }}</option>\n' +
                '                                                                                @endforeach\n' +
                '                                                                            </select>\n' +
                '                                                                        </div>\n' +
                '                                                                    </td>\n' +
                '                                                                    <td width="300px">\n' +
                '                                                                        <div class="form-group">\n' +
                '                                                                            <input type="text" class="form-control" id="keterangan" name="keterangan[]" autocomplete="off" placeholder="Keterangan">\n' +
                '                                                                        </div>\n' +
                '                                                                    </td>\n' +
                '                                                                    <td>\n' +
                '                                                                        <button id="removeRow" type="button" class="btn btn-danger rounded">\n' +
                '                                                                            <i class="fas fa-trash fa-sm"></i>\n' +
                '                                                                        </button>\n' +
                '                                                                    </td>\n' +
                '                                                                </tr>\n' +
                '                                                            </tbody>\n' +
                '                                                        </table>';

            $('#newRow').append(html);
            material++;
        });

        // remove row
        $(document).on('click', '#removeRow', function () {
            $(this).closest('#inputFormRow2').remove();
        });
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
    <script>

        var jumlah = document.getElementById('jumlah');

        var	reverse = jumlah.toString().split('').reverse().join('');
        ribuan 	= reverse.match(/\d{1,3}/g);
        ribuan	= ribuan.join('.').split('').reverse().join('');

        document.write(jumlah);

        function hanyaAngka(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
        }
    </script>
    <script type="text/javascript">

        function myFunction(counter){
            console.log('counter ' + counter);
            var material = $('#material' + counter + ' option:selected').val();
            // var test = $('#');
            material = parseInt(material);
            var jumlah = $('#jumlah' + counter).val();
            jumlah = parseInt(jumlah);
            // var material = document.getElementsById('material[]');
            console.log('bahan ' + material);
            console.log('jumlah ' + jumlah);

            $.ajax({
                url: "/admin/pengeluaran/" + material + '/' + 'cekBahan',
                type: 'GET',
                dataType: 'html',
                data: null,
                success: function(msg) {
                    // console.log('bahan ' + msg);
                    console.log('msg ' + msg);
                    if (jumlah > msg){
                        swal({
                            type: 'error',
                            icon: 'error',
                            text: 'Jumlah Tidak Tersedia'
                        });
                    }

                },
                error: function(msg) {
                    // alert('msg');
                    swal({
                        type: 'warning',
                        icon: 'warning',
                        text: 'Bahan Tidak Tersedia'
                    });
                }
            });
        }

        $(document).ready(function(){
            $("select.material").change(function(){
                var material = $(this).children("option:selected").val();
                var jumlah = $('#jumlah').val();
                jumlah = parseInt(jumlah);
                material = parseInt(material);

                $.ajax({
                    url: "/admin/pengeluaran/" + material + '/' + 'cekBahan',
                    type: 'GET',
                    dataType: 'html',
                    data: null,
                    success: function(msg) {
                        // console.log('bahan ' + msg);
                        if (jumlah > material){
                            swal({
                                type: 'error',
                                icon: 'error',
                                text: 'Jumlah Tidak Tersedia'
                            });
                        }

                    },
                    error: function(msg) {
                        // alert('msg');
                        swal({
                            type: 'warning',
                            icon: 'warning',
                            text: 'Bahan Tidak Tersedia'
                        });
                    }
                });

                // alert("You have selected the country - " + selectedCountry);
            });
        });
    </script>

@endsection
