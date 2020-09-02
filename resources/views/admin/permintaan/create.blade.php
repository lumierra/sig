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
                                    <form action="{{ route('admin.permintaan.store') }}" method="POST" class="needs-validation" novalidate>
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-7">
                                                <div class="form-group">
                                                    <label for="jenis">Vendor</label>
                                                    <select class="form-control custom-select" id="vendors" name="vendors" required>
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
                                                    <select class="form-control custom-select" id="heads" name="heads" required>
                                                        <option selected>Pilih</option>
                                                        @foreach ($heads as $head)
                                                            <option value="{{$head->id}}" name="{{$head->name}}">{{ Str::ucfirst($head->name) }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="inputFormRow">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="table-responsive">
                                                        <table class="table table-borderless">
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
                                                                                <option selected>Bahan</option>
                                                                                @foreach ($materials as $material)
                                                                                    <option value="{{$material->id}}" name="{{$material->name}}">{{ Str::ucfirst($material->name) }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </td>
                                                                    <td width="100px">
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control" id="jumlah[]" name="jumlah[]" autocomplete="off">
                                                                        </div>
                                                                    </td>
                                                                    <td width="150px">
                                                                        <div class="form-group">
                                                                            <select class="form-control custom-select" name="unit[]" id="unit[]">
                                                                                <option selected>Satuan</option>
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
            var html = '';
            html += '';

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
