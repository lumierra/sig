@extends('admin.layouts')

@section('title', 'Management Pengguna')

@section('subtitle', 'Management Pengguna')

@section('content')
    <link href="{{ asset('ext/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

    @section('button')
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">@yield('subtitle')</h1>
        </div>
    @endsection

    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <button id="createNewProduct" name="btn_add" type="button" class="btn btn-sm btn-success btn-add float-right btn-icon-split">
                    <span class="icon text-white-50"> <i class="fas fa-plus-circle"></i></span>
                    <span class="text">Tambah Pengguna</span>
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered yajra-datatable" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr class="text-success">
                            <th>No</th>
                            <th>Nama User</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="ajaxModel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading"></h4>
                </div>
                <div class="modal-body">
                    <form id="productForm" name="productForm" class="form-horizontal">
                        <input type="hidden" name="product_id" id="product_id">
                        <div class="form-group">
                            <label for="role" class="col-sm-5 control-label">Role</label>
                            <div class="col-sm-12">
                                <select class="form-control @error('role') is-invalid @enderror" name="role" id="role" required>
                                    <option selected disabled value="">Pilih</option>
                                    @foreach($roles as $role)
                                      <option value="{{ $role->id }}"> {{ ucfirst($role->name) }}</option>
                                    @endforeach
                                </select>
                                @error('role')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-5 control-label">Nama Lengkap</label>
                            <div class="col-sm-12">
                                <select class="form-control " name="employee" id="employee" required>
                                    <option selected disabled value="">Pilih</option>
                                    @foreach($employees as $employee)
                                      <option value="{{ $employee->KD_KARYAWAN }}" name="{{ $employee->NAMA }}">{{ $employee->GELAR_DEPAN}} {{ $employee->NAMA }} {{ $employee->GELAR_BELAKANG}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- <div class="form-group">
                            <label for="name" class="col-sm-5 control-label">Email</label>
                            <div class="col-sm-12">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="" maxlength="50" required="" autocomplete="off">
                            </div>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div> -->


                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-success" id="saveBtn" value="create">Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<div class="modal fade" id="exampleModal" data-keyboard="false" data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-success" id="exampleModalLabel">Tambah Ruangan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="test">
                <form id="formRoom" name="formRoom" class="form-horizontal">
                    <input type="hidden" name="product_id" id="product_id">
                    <div class="form-group">
                        <label for="name" class="col-sm-5 control-label">Nama Lengkap</label>
                        <div class="col-sm-6">
                            <!-- <input disabled value="{{ $user->name }}" type="text" class="form-control" id="name" name="name"> -->
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-5 control-label">Role</label>
                        <div class="col-sm-12">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-success" id="simpanRoom" value="room">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

    <script type="text/javascript">
        $(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var table = $('.yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.management-user.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'role', name: 'role'},
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
                ]
            })

            $('#createNewProduct').click(function () {
                $('#saveBtn').val("create-product");
                $('#product_id').val('');
                $('#productForm').trigger("reset");
                $('#modelHeading').html("Form Tambah Pengguna");
                $('#ajaxModel').modal('show');
            });

            $('body').on('click', '.editProduct', function () {
                var product_id = $(this).data('id');
                $.get("{{ route('admin.management-user.index') }}" +'/' + product_id + '/edit', function (data) {
                    $('#modelHeading').html("Edit Pengguna");
                    $('#saveBtn').val("edit-user");
                    $('#ajaxModel').modal('show');
                    $('#product_id').val(data.user.id);
                    // $('#name').val(data.user.name);
                    // $('#role').val(data.role);
                    // $('#email').val(data.user.email);
                })
            });

            $('#saveBtn').click(function (e) {
                e.preventDefault();
                $(this).html('Simpan');

                $.ajax({
                    data: $('#productForm').serialize(),
                    url: "{{ route('admin.management-user.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        swal({
                            type: 'success',
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Berhasil Tambah Pengguna'
                        })
                        $('#productForm').trigger("reset");
                        $('#ajaxModel').modal('hide');
                        table.draw();

                    },
                    error: function (data) {
                        swal({
                            type: 'error',
                            title: 'Data Belum Lengkap'
                        })
                        $('#saveBtn').html('Simpan');
                    }
                });
            })

            $('body').on('click', '.deleteProduct', function () {

                var product_id = $(this).data("id");
                // confirm("Are You sure want to delete !");
                swal({
                    title: "Apakah Anda Yakin ?",
                    // text: "",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        swal("Data Makanan Berhasil di Hapus", {
                            icon: "success",
                        });
                        $.ajax({
                            type: "DELETE",
                            url: "{{ route('admin.management-user.store') }}"+'/'+product_id,
                            success: function (data) {
                                table.draw();
                            },
                            error: function (data) {
                                console.log('Error:', data);
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
