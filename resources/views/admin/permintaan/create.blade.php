@extends('admin.layouts')

@section('title', 'Tambah Permintaan')

@section('subtitle', 'Tambah Permintaan')

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
                                <h6 class="m-0 font-weight-bold text-success">Form Permintaan</h6>
                            </div>
                            <div class="card-body">
                                <div class="col-lg-12">
                                    <form action="{{ route('admin.permintaan.store') }}" method="POST" name="formPendaftaran">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-10">
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <label for="vendors">Vendor</label>
                                                        <select class="form-control custom-select" id="vendors" name="vendors" required>
                                                            <option selected disabled value="">Pilih Vendor</option>
                                                            @foreach ($vendors as $vendor)
                                                                <option value="{{$vendor->penyedia->kd_vendor}}" name="{{$vendor->penyedia->nama_vendor}}">{{ Str::ucfirst($vendor->penyedia->nama_vendor) }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <label for="heads">Penanggung Jawab</label>
                                                        <select class="form-control custom-select" id="heads" name="heads" required>
                                                            <option selected disabled value="">Pilih</option>
                                                            @foreach ($heads as $head)
                                                                <option value="{{$head->id}}" name="{{$head->name}}">{{ Str::ucfirst($head->name) }}</option>
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
                                                                <tbody>
                                                                    <tr class="text-center">
                                                                        <td class="sNo">1</td>
                                                                        <td>
                                                                            <select onchange="myFunction(1)" class='form-control' name='material[]' id='material1' required>
                                                                                <option selected>Pilih Bahan</option>
                                                                                @foreach($materials as $material)
                                                                                    <option value="{{ $material->id }}" name="{{ $material->name }}">{{ ucfirst($material->name) }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </td>
                                                                        <td>
                                                                            <input type='text' class='form-control' name='jumlah[]' id='jumlah1' onkeypress="return hanyaAngka(event)" autocomplete="off">
                                                                        </td>
                                                                        <td>
                                                                            <select class='form-control' name='unit[]' id='unit1' required>
                                                                                <option selected>Pilih</option>
                                                                                @foreach($units as $unit)
                                                                                    <option value="{{ $unit->id }}" name="{{ $unit->name }}">{{ $unit->name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </td>
                                                                        <td>
                                                                            <input type='text' class='form-control' name='keterangan[]' id='keterangan1' autocomplete="off">
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
                                                                            <a href="{{ route('admin.permintaan.index') }}" class="btn btn-danger btn-icon-split btn-sm">
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
                    var unit = document.getElementById(unitID).value = msg;
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
                    <select class='form-control' name='unit[]' id='unit${sno}' required>
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
