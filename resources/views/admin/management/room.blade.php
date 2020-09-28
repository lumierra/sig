@extends('admin.layouts')

@section('title', 'Edit Pengembalian')

@section('subtitle', 'Edit Pengembalian')

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
                                <h6 class="m-0 font-weight-bold text-success">Form Edit Pengembalian</h6>
                            </div>
                            <div class="card-body">
                                <div class="col-lg-12">
                                    <form action="{{ route('admin.management.updateRoom') }}" method="POST">
                                        @csrf
{{--                                        {{ method_field('PUT') }}--}}
                                        <input type="hidden" name="userId" value="{{ $user->id }}">
                                        <div class="row">
                                            <div class="col-md-10">
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <label for="places">Nama Pengguna</label>
                                                        <input class="form-control" type="text" disabled value="{{ ucfirst($user->name) }}" name="name">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-10">
                                                <div class="row">
                                                    <div class="form-group">
                                                        <label for="name" class="col-sm-12 control-label">Pilih Ruangan</label>
                                                        <div class="col-sm-12">
                                                          @foreach($rooms as $room)
                                                              <div class="custom-control custom-checkbox">
                                                                  <input
                                                                      type="checkbox"
                                                                      class="custom-control-input"
                                                                      id="{{ $room->KD_RUANG }}"
                                                                      name="rooms[]"
                                                                      value="{{ $room->KD_RUANG }}"
                                                                  >

                                                                  <label class="custom-control-label" for="{{ $room->ALIAS }}">{{ $room->ALIAS }}</label>
                                                              </div>
                                                          @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <a href="{{ route('admin.management-user.index') }}" class="btn btn-danger btn-icon-split btn-sm">
                                            <span class="icon text-white-50">
                                              <i class="fas fa-times-circle"></i>
                                            </span>
                                            <span class="text">Batal</span>
                                        </a>
                                        <button class="btn btn-success btn-sm btn-icon-split" type="submit">
                                            <span class="icon text-white-50">
                                              <i class="fas fa-save"></i>
                                            </span>
                                            <span class="text">Simpan</span>
                                        </button>
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
@endsection
