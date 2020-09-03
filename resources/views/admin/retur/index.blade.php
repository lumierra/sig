@extends('admin.layouts')

@section('title', 'Data Retur')

@section('subtitle', 'Data Retur')

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
            <a href="{{ route('admin.retur.create') }}" class="btn btn-success btn-sm float-right btn-icon-split">
                <span class="icon text-white-50"> <i class="fas fa-plus-circle"></i></span>
                <span class="text">Tambah Retur</span>
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered yajra-datatable" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr class="text-success">
                        <th>No. Retur</th>
                        <th>Tgl. Retur</th>
                        <th>Dari</th>
                        <th>Status</th>
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
                <h5 class="modal-title text-success" id="exampleModalLabel">Detail Retur</h5>
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
            ajax: "{{ route('admin.retur.index') }}",
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
                {data: 'dari', name: 'dari'},
                {
                    data: null,
                    render: function (data){
                        if (data.status == 'keluar'){
                            var badge = '<span class="badge badge-danger">'+ data.status + '</span>';
                        }
                        else {
                            var badge = '<span class="badge badge-success">'+ data.status + '</span>';
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

        $('body').on('click', '.showProduct', function () {
            var product_id = $(this).data('id');
            $.ajax({
                url: "/admin/retur/" + product_id + '/' + 'showRetur',
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
                    swal("Data Pengeluaran Berhasil di Hapus", {
                        icon: "success",
                    });
                    $.ajax({
                        type: "DELETE",
                        url: "{{ route('admin.pengeluaran.index') }}" + '/' + product_id + '/delete',
                        success: function (data) {
                            table.draw();
                        },
                        error: function (data) {
                            console.log('Error:', data);
                        }
                    });
                    location.load();
                }
            });
        });
    });
</script>
@endsection
