@extends('admin.layouts')

@section('title', 'Data Satuan Bahan')

@section('subtitle', 'Data Satuan Bahan')

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
                <button id="createNewProduct" name="btn_add" type="button" class="btn btn-success btn-sm float-right btn-icon-split">
                    <span class="icon text-white-50">
                          <i class="fas fa-plus-circle"></i>
                    </span>
                    <span class="text">Tambah Satuan</span>
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered yajra-datatable" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr class="text-success">
                            <th>No</th>
                            <th width="200px">Singkatan Satuan</th>
                            <th>Deskripsi</th>
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
                            <label for="name" class="col-sm-5 control-label">Nama Satuan Bahan</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Kg, Gr, Bks" required="" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-5 control-label">Deskripsi</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="deskripsi" name="deskripsi" placeholder="(Kilogram, Gram, Bungkus)" required="" autocomplete="off">
                            </div>
                        </div>

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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
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
                ajax: "{{ route('admin.satuan-makanan.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    {data: 'deskripsi', name: 'deskripsi'},
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
                $('#modelHeading').html("Form Satuan Bahan");
                $('#ajaxModel').modal('show');
            });

            $('body').on('click', '.editProduct', function () {
                var product_id = $(this).data('id');
                $.get("{{ route('admin.satuan-makanan.index') }}" +'/' + product_id +'/edit', function (data) {
                    $('#modelHeading').html("Edit Satuan Bahan");
                    $('#saveBtn').val("edit-user");
                    $('#ajaxModel').modal('show');
                    $('#product_id').val(data.id);
                    $('#name').val(data.name);
                    $('#deskripsi').val(data.deskripsi);
                })
            });

            $('#saveBtn').click(function (e) {
                e.preventDefault();
                $(this).html('Simpan');

                $.ajax({
                    data: $('#productForm').serialize(),
                    url: "{{ route('admin.satuan-makanan.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        swal({
                            type: 'success',
                            icon: 'success',
                            title: 'Berhasil',
                            // text: 'Anda Berhasil Menambah Satuan'
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
            });

            $('body').on('click', '.deleteProduct', function () {

                var product_id = $(this).data("id");
                swal({
                    title: "Apakah Anda Yakin ?",
                    // text: "",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        swal("Data Satuan Berhasil di Hapus", {
                            icon: "success",
                        });
                        $.ajax({
                            type: "DELETE",
                            url: "{{ route('admin.satuan-makanan.store') }}"+'/'+product_id,
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
