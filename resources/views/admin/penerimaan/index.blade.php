@extends('admin.layouts')

@section('title', 'Data Penerimaan')

@section('subtitle', 'Data Penerimaan')

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
            <a href="{{ route('admin.penerimaan.create') }}" class="btn btn-sm btn-success float-right btn-icon-split">
                <span class="icon text-white-50"> <i class="fas fa-plus-circle"></i></span>
                <span class="text">Tambah Penerimaan</span>
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered yajra-datatable" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr class="text-success">
                        <th width="100px">No. Penerimaan</th>
                        <th width="120px">Tgl. Penerimaan</th>
                        <th>Vendor</th>
                        <th width="120px">Penanggung Jawab</th>
                        <th width="50px">Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
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
                <h5 class="modal-title text-success" id="exampleModalLabel">Detail Penerimaan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="test">
                <input type="hidden" name="product_id" id="product_id">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
            ajax: "{{ route('admin.penerimaan.index') }}",
            columns: [
                {data: 'code', name: 'code'},
                {
                    data: 'date',
                    type: 'num',
                    render: {
                        _: 'display',
                        sort: 'timestamp'
                    }
                },
                {data: 'vendor', name: 'vendor'},
                {data: 'head', name: 'head'},
                {
                    data: null,
                    render: function (data){
                        if (data.status == 'proses'){
                            var badge = '<span class="badge badge-danger">proses</span>';
                        }
                        else {
                            var badge = '<span class="badge badge-success">selesai</span>';
                        }
                        return badge;
                    }
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true
                },
            ],
            select: true,
        })

        $('#createNewProduct').click(function () {
            $('#saveBtn').val("create-product");
            $('#product_id').val('');
            $('#productForm').trigger("reset");
            $('#modelHeading').html("Form Permintaan");
            $('#ajaxModel').modal('show');
        });

        $('body').on('click', '.editProduct', function () {
            var product_id = $(this).data('id');
            $.get("{{ route('admin.permintaan.index') }}" +'/' + product_id +'/edit', function (data) {
                $('#modelHeading').html("Edit Data");
                $('#saveBtn').val("edit-user");
                $('#ajaxModel').modal('show');
                $('#product_id').val(data.id);
                $('#vendors option:selected').val(data.vendors);
            })
        });

        $('body').on('click', '.showProduct', function () {
            var product_id = $(this).data('id');
            $.ajax({
                url: "/admin/penerimaan/" + product_id + '/' + 'showReceipt',
                type: 'GET',
                dataType: 'html',
                data: null,
                success: function(msg) {
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
                url: "{{ route('admin.permintaan.store') }}",
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
                url: "{{ route('admin.permintaan.store') }}"+'/'+product_id,
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
