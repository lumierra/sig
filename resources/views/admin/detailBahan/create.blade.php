@extends('admin.layouts')

@section('title', 'Detail Bahan Makanan')

@section('subtitle', 'Detail Bahan Makanan')

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
                                <h6 class="m-0 font-weight-bold text-success">Form Detail Bahan Makanan</h6>
                            </div>
                            <div class="card-body">
                                <div class="col-lg-12">
                                    <form action="{{ route('admin.detail-makanan.store') }}" method="POST" class="needs-validation" novalidate>
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-7">
                                                <div class="form-group">
                                                    <label for="jenis">Jenis Makanan</label>
                                                    <select class="form-control custom-select" id="type" name="type" required>
                                                        <option selected>Pilih Jenis</option>
                                                        @foreach ($types as $type)
                                                            <option value="{{$type->id}}" name="{{$type->name}}">{{ Str::ucfirst($type->name) }}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="valid-feedback">
                                                        Looks good!
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        Please choose a username.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-7">
                                                <div class="form-group">
                                                    <label for="makanan">Makanan</label>
                                                    <select class="form-control custom-select" id="food" name="food" required>
                                                        <option selected>Pilih Makanan</option>
                                                        @foreach ($foods as $food)
                                                            <option value="{{$food->id}}" name="{{$food->name}}">{{ Str::ucfirst($food->name) }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="inputFormRow">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="material">Bahan</label>
                                                                <select class="form-control" id="material[]" name="material[]" required>
                                                                    <option selected>Pilih Bahan</option>
                                                                    @foreach ($materials as $material)
                                                                        <option value="{{$material->id}}" name="{{$material->name}}">{{ Str::ucfirst($material->name) }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <div class="form-group">
                                                                <label for="unit">Satuan</label>
                                                                <input type="text" class="form-control" id="jumlah[]" name="jumlah[]" autocomplete="off">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <label for="unit">Nama Satuan</label>
                                                                <select class="form-control" name="unit[]" id="unit[]">
                                                                    <option selected>Pilih Satuan</option>
                                                                    @foreach ($units as $unit)
                                                                        <option value="{{$unit->id}}" name="{{$unit->name}}">{{ Str::ucfirst($unit->name) }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="deskripsi">Keterangan</label>
                                                                <input type="text" class="form-control" id="keterangan[]" name="keterangan[]" autocomplete="off">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <label for="deskripsi">Action</label>
                                                            <button id="removeRow" type="button" class="btn btn-danger rounded">
                                                                <i class="fas fa-trash fa-sm"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="newRow"></div>
                                        <button id="addRow" type="button" class="btn btn-primary">
                                            <i class="fa fa-plus-circle"></i>
                                        </button><br><br>

                                        <a href="{{ route('admin.detail-makanan.index') }}" class="btn btn-danger">Batal</a>
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
            html += '<div id="inputFormRow">';
            html += '<div class="row">';
            html += '<div class="col-md-12">';
            html += '<div class="row">';
            html += '<div class="col-md-3">';
            html += '<div class="form-group">';
            html += '<label for="material">Bahan</label>';
            html += '<select class="form-control" id="material[]" name="material[]" required>';
            html += '<option selected>Pilih Bahan</option>';
            html += '@foreach ($materials as $material)';
            html += '<option value="{{$material->id}}" name="{{$material->name}}">{{ Str::ucfirst($material->name) }}</option>';
            html += '@endforeach';
            html += '</select>';
            html += '</div>';
            html += '</div>';
            html += '<div class="col-md-1">';
            html += '<div class="form-group">';
            html += '<label for="unit">Satuan</label>';
            html += '<input type="text" class="form-control" id="jumlah[]" name="jumlah[]" autocomplete="off">';
            html += '</div>';
            html += '</div>';
            html += '<div class="col-md-2">\n' +
                '<div class="form-group">\n' +
                '<label for="unit">Nama Satuan</label>\n' +
                '<select class="form-control" name="unit[]" id="unit[]">\n' +
                '<option selected>Pilih Satuan</option>\n' +
                '@foreach ($units as $unit)\n' +
                '<option value="{{$unit->id}}" name="{{$unit->name}}">{{ Str::ucfirst($unit->name) }}</option>\n' +
                '@endforeach\n' +
                '</select>\n' +
                '</div>\n' +
                '</div>';
            html += '<div class="col-md-4">\n' +
                '<div class="form-group">\n' +
                '<label for="deskripsi">Keterangan</label>\n' +
                '<input type="text" class="form-control" id="keterangan[]" name="keterangan[]" autocomplete="off">\n' +
                '</div>\n' +
                '</div>\n' +
                '<div class="col-md-1">\n' +
                '<label for="action">Action</label>\n' +
                '<button id="removeRow" type="button" class="btn btn-danger rounded">\n' +
                '<i class="fas fa-trash fa-sm"></i>\n' +
                '</button>\n' +
                '</div>';
            html += '</div>';
            html += '</div>';
            html += '</div>';
            html += '</div>';

            $('#newRow').append(html);
        });

        // remove row
        $(document).on('click', '#removeRow', function () {
            $(this).closest('#inputFormRow').remove();
        });
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
    <script>

        $("#satuan").on('keyup', function(){
            var n = parseInt($(this).val().replace(/\D/g,''),10);
            $(this).val(n.toLocaleString());
        });

        $(document).ready(function(){
            var i=1;
            $('#add').click(function(){
                i++;
                $('#dynamic_field').append('\
              <tr >\
                <td>\
                    <div class="row" id="row'+i+'">\
                        <div class="col-md-12">\
                            <div class="row">\
                                <div class="col-md-3">\
                                    <div class="form-group">\
                                        <label for="makanan">Bahan</label>\
                                        <select class="form-control" id="bahan" name="bahan[]" required>\
                                            <option selected>Pilih Bahan</option>\
                                            @foreach ($materials as $material)\
                                                <option value="{{$material->id}}" name="{{$material->name}}">{{ Str::ucfirst($material->name) }}</option>\
                                            @endforeach\
                                        </select>\
                                    </div>\
                                </div>\
                                <div class="col-md-2">\
                                    <div class="form-group">\
                                        <label for="satuan">Satuan</label>\
                                        <input type="number" class="form-control" id="satuan" name="satuan[]" autocomplete="off">\
                                    </div>\
                                </div>\
                                <div class="col-md-3">\
                                    <div class="form-group">\
                                        <label for="nama_satuan">Nama Satuan</label>\
                                        <select class="form-control" name="nama_satuan[]" id="">\
                                            <option selected>Pilih Bahan</option>\
                                            @foreach ($units as $unit)\
                                                <option value="{{$unit->id}}" name="{{$unit->name}}">{{ Str::ucfirst($unit->name) }}</option>\
                                            @endforeach\
                                        </select>\
                                    </div>\
                                </div>\
                                <div class="col">\
                                    <div class="form-group">\
                                        <label for="deskripsi">Keterangan</label>\
                                        <input type="type" class="form-control" id="satuan" name="satuan[]" autocomplete="off">\
                                    </div>\
                                </div>\
                            </div>\
                        </div>\
                    </div>\
                </td>\
                <td>\
                    <button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button>\
                </td>\
            </tr>\
            ');
            });
            $(document).on('click', '.btn_remove', function(){
                var button_id = $(this).attr("id");
                $('#row'+button_id+'').remove();
            });
            //  $('#submit').click(function(){
            //       $.ajax({
            //            url:"name.php",
            //            method:"POST",
            //            data:$('#add_name').serialize(),
            //            success:function(data)
            //            {
            //                 alert(data);
            //                 $('#add_name')[0].reset();
            //            }
            //       });
            //  });
        });
    </script>

@endsection
