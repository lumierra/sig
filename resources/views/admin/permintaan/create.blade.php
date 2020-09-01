@extends('admin.layouts')

@section('title', 'Permintaan')

@section('subtitle', 'Permintaan')

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
                                <h6 class="m-0 font-weight-bold text-success">Form Permintaan</h6>
                            </div>
                            <div class="card-body">
                                <div class="col-lg-12">
                                    <form action="{{ route('admin.permintaan.store') }}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-7">
                                                <div class="form-group">
                                                    <label for="jenis">Vendor</label>
                                                    <select class="form-control" id="vendors" name="vendors" required>
                                                        <option selected>Pilih Vendor</option>
                                                        @foreach ($vendors as $vendor)
                                                            <option value="{{$vendor->id}}" name="{{$vendor->name}}">{{ Str::ucfirst($vendor->name) }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-7">
                                                <div class="form-group">
                                                    <label for="makanan">Penanggung Jawab</label>
                                                    <select class="form-control" id="heads" name="heads" required>
                                                        <option selected>Pilih Kepala Gizi</option>
                                                        @foreach ($heads as $head)
                                                            <option value="{{$head->id}}" name="{{$head->name}}">{{ Str::ucfirst($head->name) }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="inputFormRow">
                                            <div class="input-group mb-12">
                                                <select class="form-control" id="material" name="material[]" required>
                                                    <option selected>Pilih Bahan</option>
                                                    @foreach ($materials as $material)
                                                        <option value="{{$material->id}}" name="{{$material->name}}">{{ Str::ucfirst($material->name) }}</option>
                                                    @endforeach
                                                </select>
                                                <input type="text" name="jumlah[]" class="form-control m-input" placeholder="Jumlah" autocomplete="off">
                                                <select class="form-control" name="unit[]" id="unit">
                                                    <option selected>Pilih Satuan</option>
                                                    @foreach ($units as $unit)
                                                        <option value="{{$unit->id}}" name="{{$unit->name}}">{{ Str::ucfirst($unit->name) }}</option>
                                                    @endforeach
                                                </select>
                                                <input type="text" name="keterangan[]" class="form-control m-input" placeholder="Keterangan" autocomplete="off">
                                                <div class="input-group-append">
                                                    <button id="removeRow" type="button" class="btn btn-danger rounded">
                                                        <i class="fas fa-trash fa-sm"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="newRow"></div>
                                        <button id="addRow" type="button" class="btn btn-primary">
                                            <i class="fa fa-plus-circle"></i>
                                        </button><br><br>

                                        <a href="{{ route('admin.permintaan.index') }}" class="btn btn-danger">Batal</a>
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
            var html = '<br>';
            html += '<div id="inputFormRow">';
            html += '<div class="input-group mb-12">';
            html += '<select class="form-control m-input" id="material" name="material[]" required>';
            html += '<option selected>Pilih Bahan</option>';
            html += '@foreach ($materials as $material)';
            html += '<option value="{{$material->id}}" name="{{$material->name}}">{{ Str::ucfirst($material->name) }}</option>';
            html += '@endforeach';
            html += '</select>';
            html += '<input type="text" name="jumlah[]" class="form-control m-input" placeholder="Jumlah" autocomplete="off">';
            html += '<select class="form-control" name="unit[]" id="unit">';
            html += '<option selected>Pilih Satuan</option>';
            html += '@foreach ($units as $unit)';
            html += '<option value="{{$unit->id}}" name="{{$unit->name}}">{{ Str::ucfirst($unit->name) }}</option>';
            html += '@endforeach'
            html += '</select>';
            html += '<input type="text" name="keterangan[]" class="form-control m-input" placeholder="Keterangan" autocomplete="off">';
            html += '<div class="input-group-append">';
            html += '<button id="removeRow" type="button" class="btn btn-danger rounded"><i class="fa fa-trash fa-sm"></i></button>';
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
