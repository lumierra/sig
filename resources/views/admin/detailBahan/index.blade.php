@extends('admin.layouts')

@section('title', 'Data Detail Bahan Makanan')

@section('subtitle', 'Data Detail Bahan Makanan')

@section('content')

    <link href="{{ asset('ext/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

    @section('button')
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">@yield('subtitle')</h1>
        </div>
    @endsection

<div class="container-fluid">
    <!-- Page Heading -->
{{--    <h1 class="h3 mb-2 text-gray-800">Users</h1>--}}
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="{{ route('admin.detail-makanan.create') }}" class="btn btn-success btn-add float-right btn-icon-split">
                <span class="icon text-white-50"> <i class="fas fa-plus-circle"></i></span>
                <span class="text">Tambah Detail Bahan</span>
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered yajra-datatable" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr class="text-success">
                        <th>No</th>
                        <th>Nama Makanan</th>
                        <th>Jenis Makanan</th>
{{--                        <th>Detail Bahan Makanan</th>--}}
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody class="text-capitalize">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-success" id="exampleModalLabel">Detail Bahan Makanan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="test">
                <input type="hidden" name="product_id" id="product_id">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
{{--                <button type="button" class="btn btn-primary">Save changes</button>--}}
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="productForm" name="productForm" class="form-horizontal">
                    <input type="hidden" name="product_id" id="product_id">
                    <div class="form-group">
                        <label for="name" class="col-sm-5 control-label">Nama Bahan Makanan</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Ayam, Ikan, Beras" value="" maxlength="50" required="" autocomplete="off">
                        </div>
                    </div>

                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-success" id="saveBtn" value="create">Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
{{--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>--}}
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
            ajax: "{{ route('admin.detail-makanan.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name'},
                {data: 'type', name: 'type'},
                // {data: 'test', name: 'test'},
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
            $('#modelHeading').html("Form Bahan Makanan");
            $('#ajaxModel').modal('show');
        });

        $('body').on('click', '.editProduct', function () {
            var product_id = $(this).data('id');
            $.get("{{ route('admin.detail-makanan.index') }}" +'/' + product_id +'/edit', function (data) {
                $('#modelHeading').html("Edit Product");
                $('#saveBtn').val("edit-user");
                $('#ajaxModel').modal('show');
                $('#product_id').val(data.id);
                // $('#name').val(data.name);
                // $('#type').val('asd');
            })
        });

        $('body').on('click', '.showProduct', function () {
            var product_id = $(this).data('id');
            $.ajax({
                url: "/admin/detail-makanan/" + product_id + '/' + 'edit',
                type: 'GET',
                dataType: 'html',
                data: null,
                success: function(msg) {
                    // alert(segitiga);
                    $('#test').html(msg);
                },
                error: function(msg) {
                    alert('msg');
                }
            });
        });

        $('#saveBtn').click(function (e) {
            e.preventDefault();
            $(this).html('Sending..');

            $.ajax({
                data: $('#productForm').serialize(),
                url: "{{ route('admin.detail-makanan.store') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {

                    $('#productForm').trigger("reset");
                    $('#ajaxModel').modal('hide');
                    table.draw();

                },
                error: function (data) {
                    console.log('Error:', data);
                    $('#saveBtn').html('Save Changes');
                }
            });
        });

        $('body').on('click', '.deleteProduct', function () {

            var product_id = $(this).data("id");
            confirm("Are You sure want to delete !");

            $.ajax({
                type: "DELETE",
                url: "{{ route('admin.detail-makanan.store') }}"+'/'+product_id,
                success: function (data) {
                    table.draw();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });


    });
</script>
@endsection
