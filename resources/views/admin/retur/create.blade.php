@extends('admin.layouts')

@section('title', 'Tambah Pengembalian')

@section('subtitle', 'Pengembalian')

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
                    <div class="col-lg-12">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-success">Form Pengembalian</h6>
                            </div>
                            <div class="card-body">
                                <div class="col-lg-12">
                                    <form action="{{ route('admin.retur.store') }}" method="POST" name="formPendaftaran">
                                        @csrf
{{--                                        <div class="row">--}}
{{--                                            <div class="col-md-10">--}}
{{--                                                <div class="row">--}}
{{--                                                    <div class="col-md-5">--}}
{{--                                                        <label for="demand">Pengeluaran</label>--}}
{{--                                                        <select onchange="myCheck()" class="form-control custom-select" id="spend" name="spend" required>--}}
{{--                                                            <option selected disabled >Pilih</option>--}}
{{--                                                            @foreach ($spends as $spend)--}}
{{--                                                                <option value="{{$spend->id}}" name="{{$spend->name}}">{{ $spend->code }}</option>--}}
{{--                                                            @endforeach--}}
{{--                                                        </select>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <br>--}}
                                        <div class="row">
                                            <div class="col-md-10">
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <label for="places">Dari</label>
                                                        <select class="form-control custom-select" id="place" name="place" required>
                                                            <option selected disabled value="">Pilih</option>
                                                            @foreach ($places as $place)
                                                                <option value="{{$place->id}}" name="{{$place->name}}">{{ Str::ucfirst($place->name) }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="panel panel-default">
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered table-striped" id="pTable">
                                                                <thead>
                                                                <tr class="text-center">
                                                                    <th width="5%">No</th>
                                                                    <th width="25%">Nama Bahan</th>
                                                                    <th width="7%">Jumlah</th>
                                                                    <th>Nama Satuan</th>
                                                                    <th>Keterangan</th>
                                                                    <th width="7%">Aksi</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody id="addBody">
                                                                    <tr class="text-center">
                                                                        <td class="sNo">1</td>
                                                                        <td>
                                                                            <select onchange="myFunction(1)" class='form-control' name='material[]' id='material1' required >
                                                                                <option value="" selected disabled>Pilih</option>
                                                                                @foreach($materials as $material)
                                                                                    <option value="{{ $material->id }}" name="{{ $material->name }}">{{ ucfirst($material->name) }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </td>
                                                                        <td>
                                                                            <input onkeyup="cekBahan('1')" type='text' class='form-control' name='jumlah[]' id='jumlah1' onkeypress="return hanyaAngka(event)" autocomplete="off" required>
                                                                        </td>
                                                                        <td>
                                                                            <input type="hidden" value="" name="satuan[]" id="satuan1">
                                                                            <select class='form-control' name='unit[]' id='unit1' required disabled>
                                                                                <option value="" selected disabled>Pilih</option>
                                                                                @foreach($units as $unit)
                                                                                    <option value="{{ $unit->id }}" name="{{ $unit->name }}">{{ $unit->name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </td>
                                                                        <td>
                                                                            <input type='text' class='form-control' name='keterangan[]' id='keterangan1' autocomplete="off" required>
                                                                        </td>
                                                                        <td>
                                                                            <button  type='button' class='rButton btn btn-sm btn-danger' data-tooltip='tooltip' data-placement='top' title='Hapus'>
                                                                                <i class='fas fa-trash'></i>
                                                                            </button>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="table-responsive">
                                                            <table class="table table-borderless">
                                                                <thead>
                                                                </thead>
                                                                <tbody>
                                                                <tr>
                                                                    <td width="79%">
                                                                        <a class="btn btn-primary btn-icon-split btn-sm" id="addRow">
                                                                                <span class="icon text-white-50">
                                                                                  <i class="fas fa-times-circle"></i>
                                                                                </span>
                                                                            <span class="text text-white">Tambah</span>
                                                                        </a>
                                                                    </td>
                                                                    <td>
                                                                        <a href="{{ route('admin.retur.index') }}" class="btn btn-danger btn-icon-split btn-sm">
                                                                                <span class="icon text-white-50">
                                                                                  <i class="fas fa-times-circle"></i>
                                                                                </span>
                                                                            <span class="text">Batal</span>
                                                                        </a>
                                                                        <button class="btn btn-success btn-sm btn-icon-split" onclick="validateForm()">
                                                                                <span class="icon text-white-50">
                                                                                  <i class="fas fa-save"></i>
                                                                                </span>
                                                                            <span class="text">Simpan</span>
                                                                        </button>
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
    <script>
        function myFunction(angka) {
            id = 'material' + parseInt(angka);
            var material = document.getElementById(id).value;

            $.ajax({
                url: "/admin/permintaan/" + material + '/' + 'cekBahan',
                type: 'GET',
                dataType: 'html',
                data: null,
                success: function(msg) {
                    unitID = 'unit' + angka;
                    satuanId = 'satuan' + angka;
                    var unit = document.getElementById(unitID).value = msg;
                    const satuan = document.getElementById(satuanId).value = msg;
                },
                error: function(msg) {
                    console.log('error');
                }
            });
        }

        function myCheck(){
            var spend = document.getElementById('spend').value;

            $.ajax({
                url: "/admin/retur/" + spend + '/' + 'findSpend',
                type: 'GET',
                dataType: 'json',
                data: null,
                success: function(msg) {
                    const counter = msg.details.length;

                    for(i=0; i<counter;i++){
                        let id = '#tr' + (i+1);
                        $(id).remove();
                    }

                    for(i=0; i<counter;i++){
                        let no = i+1;
                        trow = `<tr class="text-center" id="tr${no}">
                                    <td class='sNo'>${i+1}</td>
                                    <td>
                                        <select class='form-control' name='material[]' id='material${no}' required>
                                            <option selected disabled value="">Pilih Bahan</option>
                                            @foreach($materials as $material)
                        <option value="{{ $material->id }}" name="{{ $material->name }}">{{ ucfirst($material->name) }}</option>
                                            @endforeach
                        </select>
                    </td>
                    <td><input type='text' class='form-control' name='jumlah[]' id='jumlah${no}' onkeypress="return hanyaAngka(event)" required autocomplete="off"></td>
                                    <td>
                                    <input type="hidden" value="" name="satuan[]" id="satuan${no}">
                                        <select class='form-control' name='unit[]' id='unit${no}' required disabled>
                                            <option selected disabled value="">Pilih</option>
                                            @foreach($units as $unit)
                        <option value="{{ $unit->id }}" name="{{ $unit->name }}">{{ $unit->name }}</option>
                                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input type='text' class='form-control' name='keterangan[]' id='keterangan${no}' required autocomplete="off">
                                    </td>
                                    <td>
                                        <button  type='button' class='rButton btn btn-sm btn-danger' data-tooltip='tooltip' data-placement='top' title='Hapus'>
                                            <i class='fas fa-trash'></i>
                                        </button>
                                    </td>
                                </tr>`;

                        $('#pTable').append(trow);
                    }
                },
                error: function(msg) {
                    console.log('error');
                }
            });



            $.ajax({
                url: "/admin/retur/" + spend + '/' + 'findSpend',
                type: 'GET',
                dataType: 'json',
                data: null,
                success: function(msg) {
                    var place = document.getElementById('places').value = msg.place.id;
                    var counter = msg.details.length;

                    // var material = document.getElementById('material1').value = '1';

                    for(i=0; i < counter; i++){

                        let materialID = 'material' + (i+1);
                        let jumlahID = 'jumlah' + (i+1);
                        let unitID = 'unit' + (i+1);
                        let ketID = 'keterangan' + (i+1);

                        dataMaterial = msg.details[i].material_id;
                        dataJumlah = msg.details[i].jumlah;
                        dataUnit = msg.details[i].unit_id;
                        dataKet = msg.details[i].keterangan;

                        var material = document.getElementById(materialID).value = String(dataMaterial);
                        var jumlah = document.getElementById(jumlahID).value = parseInt(dataJumlah);
                        var unit = document.getElementById(unitID).value = String(dataUnit);
                        var ket = document.getElementById(ketID).value = String(dataKet);
                    }
                },
                error: function(msg) {
                    console.log('error');
                }
            });
        }

    </script>
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
    <script type="text/javascript">
        $(document).ready(function(){
            $('#addRow').click(function(){
                var tot=2;
                var totK=1;
                var sno = $('#pTable tr').length;
                var nos = eval(totK + 1);
                trow = `<tr class="text-center">
                <td class='sNo'>${sno}</td>
                <td>
                    <select onchange="myFunction(${sno})" class='form-control' name='material[]' id='material${sno}' required>
                    <option selected>Pilih Bahan</option>
                        @foreach($materials as $material)
                <option value="{{ $material->id }}" name="{{ $material->name }}">{{ ucfirst($material->name) }}</option>
                        @endforeach
                </select>
            </td>
            <td><input type='text' class='form-control' name='jumlah[]' id='jumlah${nos}' onkeypress="return hanyaAngka(event)" autocomplete="off"></td>
                <td>
                <input type="hidden" value="" name="satuan[]" id="satuan${sno}">
                    <select class='form-control' name='unit[]' id='unit${sno}' required disabled>
                        <option selected>Pilih</option>
                        @foreach($units as $unit)
                <option value="{{ $unit->id }}" name="{{ $unit->name }}">{{ $unit->name }}</option>
                        @endforeach
                </select>
            </td>
            <td>
                <input type='text' class='form-control' name='keterangan[]' id='keterangan${nos}' autocomplete="off">
                </td>
                <td>
                    <button  type='button' class='rButton btn btn-sm btn-danger' data-tooltip='tooltip' data-placement='top' title='Hapus'>
                        <i class='fas fa-trash'></i>
                    </button>
                </td>
                </tr>`;

                $('#pTable').append(trow);

                tot=tot+1;
                totK=totK+1;
            });
        });

        $(document).on('click', 'button.rButton', function () {
            $(this).closest('tr').remove();
            arrangeSno();
            var tot=tot-1;

            if(tot==0){
                $('#submit_list').prop('disabled',true);
            }
            return false;
        });

        function arrangeSno() {
            var i=0;
            $('#pTable tr').each(function() {
                $(this).find(".sNo").html(i);
                i++;
            });
        }
    </script>
@endsection
