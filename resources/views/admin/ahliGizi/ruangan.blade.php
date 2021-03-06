@extends('admin.layouts')

@section('title', 'Detail Ruangan')

@section('subtitle', 'Detail Ruangan')

@section('content')

    <style>
        .asd{
            padding : 1000px;
        }
    </style>

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
                    <div class="col">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h5 class="m-0 font-weight-bold text-success text-center">Data Pasien Di {{ $bed->NAMA_RUANG }}</h5>
                            </div>
                            <div class="card-body">
                                <div class="col-md-12">
                                    <div class="box box-danger">
                                        <div class="box-body">
                                            <small><b>Catatatn: Jika pasien sudah ada diruangan tetapi data pasien belum tersedia di sistem, silakan menghubungi operator ruangan masing-masing.</b></small>
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center align-middle" rowspan="2">No</th>
                                                            <th class="text-center align-middle" rowspan="2">Aksi</th>
                                                            <th class="text-center align-middle" rowspan="2">Identitas Pasien</th>
                                                            <th class="text-center align-middle" rowspan="2" >Diagnosa</th>
                                                            <th class="text-center align-middle" colspan="3" >Tindakan</th>
                                                            <th class="text-center align-middle" colspan="5" >Infeksi Rumah Sakit</th>
                                                            <th class="text-center align-middle" rowspan="2">Tirah Baring</th>
                                                            <th class="text-center align-middle" rowspan="2">Dekub</th>
                                                            <th class="text-center align-middle" rowspan="2">Antibiotik</th>
                                                        </tr>
                                                        <tr>
                                                            <th class="text-center">UC</th>
                                                            <th class="text-center">IVL</th>
                                                            <th class="text-center">CVL</th>
                                                            <th class="text-center">HAP</th>
                                                            <th class="text-center">VAP</th>
                                                            <th class="text-center">ISK</th>
                                                            <th class="text-center">IAD</th>
                                                            <th class="text-center">PLB</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($rooms as $room)
                                                            <tr>
                                                                <td colspan="53" class="font-weight-bold text-white bg-success">{{ $room->NAMA_KAMAR }}</td>
                                                            </tr>
                                                            @foreach ($patients as $patient)
                                                                @if ($room->NAMA_KAMAR == $patient->NAMA_KAMAR)
                                                                    <tr>
                                                                        <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                                                        <td class="text-center align-middle">
                                                                            <a class="btn btn-circle btn-danger" href="{{ route('admin.ahli-gizi.show', $patient->KD_PASIEN) }}"
                                                                            data-toggle="tooltip" data-placement="top" title="Isi Formulir"
                                                                            >
                                                                                <i class="fas fa-location-arrow"></i>
                                                                            </a>
                                                                        </td>
                                                                        <td width="10000px">
                                                                            {{ $patient->KD_PASIEN }}
                                                                            {{-- <br> --}}
                                                                            <label class="font-weight-bold">
                                                                                {{ $patient->NAMA }}</label>
                                                                                {{ $patient->JENIS }}  58 Thn. <br>
                                                                                Tgl. Masuk : {{ \Carbon\Carbon::parse($patient->TGL_MASUK)->format('d-m-Y')}}
                                                                                <br>DPJP : {{ $patient->getDokter($patient->KD_PASIEN) }}
                                                                        </td>
                                                                        <td class="text-left align-middle">
                                                                            {{-- <span id="kdDiagnosa">Test</span> --}}
                                                                            @foreach ($patient->getDiagnosa($patient->KD_PASIEN) as $item)
                                                                                {{ $item->KD_PENYAKIT}} - {{ $item->PENYAKIT }}
                                                                            @endforeach
                                                                            {{-- <span id="namaDiagnosa"> {{ $patient->getDiagnosa($patient->KD_PASIEN) }}</span> --}}

                                                                        </td>
                                                                        <td class="text-center align-middle">0</td>
                                                                        <td class="text-center align-middle">0</td>
                                                                        <td class="text-center align-middle">0</td>
                                                                        <td class="text-center align-middle">0</td>
                                                                        <td class="text-center align-middle">0</td>
                                                                        <td class="text-center align-middle">0</td>
                                                                        <td class="text-center align-middle">0</td>
                                                                        <td class="text-center align-middle">0</td>
                                                                        <td class="text-center align-middle">0</td>
                                                                        <td class="text-center align-middle">0</td>
                                                                        <td class="text-center align-middle">0</td>
                                                                    </tr>
                                                                {{-- @else
                                                                    <tr>
                                                                        <td class="text-center" colspan="15">Tidak Ada Pasien</td>
                                                                    </tr> --}}
                                                                @endif
                                                            @endforeach
                                                        @endforeach

                                                        {{-- @foreach ($patients as $patient)


                                                            <tr>
                                                                <td colspan="53" class="font-weight-bold text-white bg-success">RK-01 KLS I</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-center" colspan="15">Tidak Ada Pasien</td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="53" class="font-weight-bold text-white bg-success">RK-02 KLS I</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                                                <td class="text-center align-middle">
                                                                    <a class="btn btn-circle btn-danger" href="{{ route('admin.ahli-gizi.show', 1) }}"
                                                                    data-toggle="tooltip" data-placement="top" title="Isi Formulir"
                                                                    >
                                                                        <i class="fas fa-location-arrow"></i>
                                                                    </a>
                                                                </td>
                                                                <td width="10000px">
                                                                    {{ $patient->KD_PASIEN }}
                                                                    <br>
                                                                    <label class="font-weight-bold">
                                                                        {{ $patient->NAMA }}</label> ;
                                                                        {{ $patient->JENIS }} ; 58 Thn. <br>
                                                                        Tgl. Masuk : {{ \Carbon\Carbon::parse($patient->TGL_MASUK)->format('d-m-Y')}}
                                                                        <br>DPJP : dr. Erik A. Rahman, Sp.OG
                                                                </td>
                                                                <td class="text-left align-middle">C56 - Malignant neoplasm of ovary</td>
                                                                <td class="text-center align-middle">0</td>
                                                                <td class="text-center align-middle">0</td>
                                                                <td class="text-center align-middle">0</td>
                                                                <td class="text-center align-middle">0</td>
                                                                <td class="text-center align-middle">0</td>
                                                                <td class="text-center align-middle">0</td>
                                                                <td class="text-center align-middle">0</td>
                                                                <td class="text-center align-middle">0</td>
                                                                <td class="text-center align-middle">0</td>
                                                                <td class="text-center align-middle">0</td>
                                                                <td class="text-center align-middle">0</td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="53" class="font-weight-bold text-white bg-success">RK-05</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-center" colspan="15">Tidak Ada Pasien</td>
                                                            </tr>
                                                        @endforeach --}}
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
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
    <script>
        // console.log({{ $rooms[0] }})
    </script>
    <script type="text/javascript">
        $(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            const room = {{ $rooms }}
            var asd = {{ $rooms }}
            console.log({{ $rooms }});

            // $.ajax({
            //     url: "/admin/ahli-gizi/" + '0-60-05-17' + '/' + 'diagnosa',
            //     type: 'GET',
            //     dataType: 'html',
            //     data: null,
            //     success: function(msg) {
            //         $('#namaDiagnosa').html(msg);
            //     },
            //     error: function(msg) {
            //         alert('msg');
            //     }
            // });

        });
    </script>
@endsection
