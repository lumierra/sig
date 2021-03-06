@extends('admin.layouts')

@section('title', 'Tambah Pengeluaran')

@section('subtitle', 'Tambah Pengeluaran')

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
                                <h6 class="m-0 font-weight-bold text-success">Form Pengeluaran</h6>
                            </div>
                            <div class="card-body">
                                <div class="col-lg-12">
                                    <form action="{{ route('admin.pengeluaran.store') }}" method="POST" name="formPendaftaran" id="myForm">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-10">
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <label for="place">Tujuan</label>
                                                        <select class="form-control custom-select @error('place') is-invalid @enderror" id="place" name="place" required>
                                                            <option selected disabled value="">Pilih</option>
                                                            @foreach ($places as $place)
                                                                <option value="{{$place->id}}" name="{{$place->name}}">{{ Str::ucfirst($place->name) }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('place')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
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
                                                                            <select onchange="myFunction(1)" class='form-control @error('material') is-invalid @enderror' name='material[]' id='material1' required >
                                                                                <option selected disabled value="">Pilih</option>
                                                                                @foreach($data as $material)
                                                                                    <option value="{{ $material->id }}" name="{{ $material->name }}">{{ ucfirst($material->name) }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                            @error('material')
                                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                            @enderror
                                                                        </td>
                                                                        <td>
                                                                            <input onkeyup="cekBahan('1')" type='text' class='form-control' name='jumlah[]' id='jumlah1' onkeypress="return hanyaAngka(event)" autocomplete="off">
                                                                        </td>
                                                                        <td>
                                                                            <input type="hidden" value="" name="satuan[]" id="satuan1">
                                                                            <select class='form-control' name='unit[]' id='unit1' required disabled>
                                                                                <option selected disabled value="">Pilih</option>
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
{{--                                                                            <a class="btn btn-warning btn-icon-split btn-sm" id="checkData" onclick="cekData()">--}}
{{--                                                                                <span class="icon text-white-50">--}}
{{--                                                                                  <i class="fas fa-search"></i>--}}
{{--                                                                                </span>--}}
{{--                                                                                <span class="text text-white">Cek</span>--}}
{{--                                                                            </a>--}}
                                                                        </td>
                                                                        <td>
                                                                            <a href="{{ route('admin.pengeluaran.index') }}" class="btn btn-danger btn-icon-split btn-sm">
                                                                                <span class="icon text-white-50">
                                                                                  <i class="fas fa-times-circle"></i>
                                                                                </span>
                                                                                <span class="text">Batal</span>
                                                                            </a>
                                                                            <button class="btn btn-success btn-sm btn-icon-split" type="submit" id="submit" name="submit" onclick="return mySubmit(event)">
                                                                                <span class="icon text-white-50">
                                                                                  <i class="fas fa-save"></i>
                                                                                </span>
                                                                                <span class="text" name="subButton">Simpan</span>
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
    <script src="http://parsleyjs.org/dist/parsley.js"></script>
    <script>

        function mySubmit(event){
            let counter=0;
            $('#pTable tr').each(function() {
                $(this).find(".sNo").html(counter);
                counter++;
            });
            counter = counter-1;
            var counterCek = 0;
            const simpan = document.getElementById('submit');
            const place = $('#place').val();
            const bahan = $('#material1').val();
            const jlh = $('#jumlah1').val();
            const ket = $('#keterangan1').val();
            // console.log('jumlah ' + jlh);
            if (jlh == "" || place == null || bahan == null || ket == ""){
                counterCek++;
            }

            for(i=0; i < counter; i++)
            {
                let id = 'material' + (i+1);
                let jumlahID = 'jumlah' + (i+1);
                const material = document.getElementById(id).value;
                const jumlah = document.getElementById(jumlahID).value;

                var selection = document.getElementById(id);
                var name = selection.options[selection.selectedIndex].getAttribute('name');
                var result;

                $.ajax({
                    url: "/admin/pengeluaran/" + material + '/' + 'kalkulasi',
                    type: 'GET',
                    dataType: 'json',
                    async: false,
                    global: false,
                    data: { 'request': "", 'target': 'arrange_url', 'method': 'method_target' },
                    success: function(data) {
                        result = data;
                        if (jumlah > data){
                            swal({
                                type: 'error',
                                icon: 'error',
                                text: 'Stok ' + name + ' Tidak Tersedia',
                                timer: 3000,
                            });
                            counterCek++;
                        }
                    },
                    error: function(msg) {
                        swal({
                            type: 'warning',
                            icon: 'warning',
                            text: 'Bahan Tidak Tersedia di Stok'
                        });
                    }
                });
            }
            console.log(counterCek);
            if (counterCek >= 1){
                swal({
                    type: 'error',
                    icon: 'error',
                    title: 'Gagal Simpan',
                    text: 'Cek Kembali Jumlah Bahan Yang Di Keluarkan'
                });
                event.preventDefault();
            }
            else {
                // swal({
                //     type: 'success',
                //     icon: 'success',
                //     title: 'Berhasil',
                //     text: 'Pengecekkan Stok Berhasil'
                // });
                $("myForm").submit();
            }
        }

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

        function cekData()
        {

            let counter=0;
            $('#pTable tr').each(function() {
                $(this).find(".sNo").html(counter);
                counter++;
            });
            counter = counter-1;
            var counterCek = 0;
            const simpan = document.getElementById('submit');

            for(i=0; i < counter; i++)
            {
                let id = 'material' + (i+1);
                let jumlahID = 'jumlah' + (i+1);
                const material = document.getElementById(id).value;
                const jumlah = document.getElementById(jumlahID).value;

                var selection = document.getElementById(id);
                var name = selection.options[selection.selectedIndex].getAttribute('name');
                var result;

                $.ajax({
                    url: "/admin/pengeluaran/" + material + '/' + 'kalkulasi',
                    type: 'GET',
                    dataType: 'json',
                    async: false,
                    global: false,
                    data: { 'request': "", 'target': 'arrange_url', 'method': 'method_target' },
                    success: function(data) {
                        result = data;
                        if (jumlah > data){
                            swal({
                                type: 'error',
                                icon: 'error',
                                text: 'Stok ' + name + ' Tidak Tersedia',
                                timer: 3000,
                            });
                            counterCek++;
                        }
                    },
                    error: function(msg) {
                        swal({
                            type: 'warning',
                            icon: 'warning',
                            text: 'Bahan Tidak Tersedia di Stok'
                        });
                    }
                });
            }
            console.log(counterCek);
            if (counterCek > 0){
                swal({
                    type: 'error',
                    icon: 'error',
                    title: 'Gagal',
                    text: 'Pengecekkan Stok Gagal'
                });
                simpan.disabled = true;
            }
            else {
                swal({
                    type: 'success',
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Pengecekkan Stok Berhasil'
                });
                simpan.disabled = false;
            }
        }

        function cekBahan(counter){
            var material = $('#material' + counter + ' option:selected').val();
            material = parseInt(material);
            var jumlah = $('#jumlah' + counter).val();
            jumlah = parseInt(jumlah);

            $.ajax({
                url: "/admin/pengeluaran/" + material + '/' + 'kalkulasi',
                type: 'GET',
                dataType: 'json',
                data: null,
                success: function(msg) {

                    if (jumlah > msg){
                        swal({
                            type: 'error',
                            icon: 'error',
                            text: 'Jumlah Tidak Tersedia'
                        });
                    }
                },
                error: function(msg) {
                    swal({
                        type: 'warning',
                        icon: 'warning',
                        text: 'Bahan Tidak Tersedia di Stok'
                    });
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
                        @foreach($data as $material)
                            <option value="{{ $material->id }}" name="{{ $material->name }}">{{ ucfirst($material->name) }}</option>
                        @endforeach
                    </select>
                </td>
                <td><input onchange="cekBahan(${nos})" type='text' class='form-control' name='jumlah[]' id='jumlah${nos}' onkeypress="return hanyaAngka(event)" autocomplete="off"></td>
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
