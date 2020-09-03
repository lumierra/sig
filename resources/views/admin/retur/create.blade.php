@extends('admin.layouts')

@section('title', 'Form Pengembalian')

@section('subtitle', 'Form Pengembalian')

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
                                <h6 class="m-0 font-weight-bold text-success">Form Pengembalian</h6>
                            </div>
                            <div class="card-body">
                                <div class="col-lg-12">
                                    <form action="{{ route('admin.retur.store') }}" method="POST" class="needs-validation" novalidate>
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-7">
                                                <div class="form-group">
                                                    <label for="jenis">Dari</label>
                                                    <select class="form-control custom-select" id="dari" name="dari" required>
                                                        <option selected>Pilih</option>
                                                        <option name="dapur">Dapur</option>
                                                        <option name="ruangan">Ruangan</option>
                                                        <option name="dll">Dan lain-lain</option>
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
                                                                        <select class="form-control custom-select" id="material[]" name="material[]" required>
                                                                            <option selected disabled>Bahan</option>
                                                                            @foreach ($materials as $material)
                                                                                <option value="{{$material->id}}" name="{{$material->name}}">{{ Str::ucfirst($material->name) }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td width="100px">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="jumlah" name="jumlah[]" autocomplete="off" onkeypress="return hanyaAngka(event)" maxlength="5">
                                                                    </div>
                                                                </td>
                                                                <td width="150px">
                                                                    <div class="form-group">
                                                                        <select class="form-control custom-select" name="unit[]" id="unit[]">
                                                                            <option selected disabled>Satuan</option>
                                                                            @foreach ($units as $unit)
                                                                                <option value="{{$unit->id}}" name="{{$unit->name}}">{{ Str::ucfirst($unit->name) }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td width="300px">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="keterangan[]" name="keterangan[]" autocomplete="off" placeholder="Keterangan">
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

                                        <a href="{{ route('admin.retur.index') }}" class="btn btn-danger">Batal</a>
                                        <button type="submit" class="btn btn-success">Simpan</button>
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
        $("#addRow").click(function () {
            var html = '';
            html += '<table class="table table-borderless" id="inputFormRow2">\n' +
                '                                                            <tbody>\n' +
                '                                                                <tr>\n' +
                '                                                                    <td width="200px">\n' +
                '                                                                        <div class="form-group">\n' +
                '                                                                            <select class="form-control custom-select" id="material[]" name="material[]" required>\n' +
                '                                                                                <option selected disabled>Bahan</option>\n' +
                '                                                                                @foreach ($materials as $material)\n' +
                '                                                                                    <option value="{{$material->id}}" name="{{$material->name}}">{{ Str::ucfirst($material->name) }}</option>\n' +
                '                                                                                @endforeach\n' +
                '                                                                            </select>\n' +
                '                                                                        </div>\n' +
                '                                                                    </td>\n' +
                '                                                                    <td width="100px">\n' +
                '                                                                        <div class="form-group">\n' +
                '                                                                            <input type="text" class="form-control" id="jumlah" name="jumlah[]" autocomplete="off" onkeypress="return hanyaAngka(event)" maxlength="5">\n' +
                '                                                                        </div>\n' +
                '                                                                    </td>\n' +
                '                                                                    <td width="150px">\n' +
                '                                                                        <div class="form-group">\n' +
                '                                                                            <select class="form-control custom-select" name="unit[]" id="unit[]">\n' +
                '                                                                                <option selected disabled>Satuan</option>\n' +
                '                                                                                @foreach ($units as $unit)\n' +
                '                                                                                    <option value="{{$unit->id}}" name="{{$unit->name}}">{{ Str::ucfirst($unit->name) }}</option>\n' +
                '                                                                                @endforeach\n' +
                '                                                                            </select>\n' +
                '                                                                        </div>\n' +
                '                                                                    </td>\n' +
                '                                                                    <td width="300px">\n' +
                '                                                                        <div class="form-group">\n' +
                '                                                                            <input type="text" class="form-control" id="keterangan[]" name="keterangan[]" autocomplete="off" placeholder="Keterangan">\n' +
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

        var	reverse = jumlah.toString().split('').reverse().join(''),
        ribuan 	= reverse.match(/\d{1,3}/g);
        ribuan	= ribuan.join('.').split('').reverse().join('');

        // Cetak hasil
        document.write(jumlah); // Hasil: 23.456.789

        function hanyaAngka(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
        }
    </script>

@endsection
