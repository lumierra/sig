<div class="panel panel-default">
    <div class="panel-body">
        <h4>List Hutang</h4>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="pTable">
                        <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="25%">Hutang</th>
                            <th>Nilai Hutang</th>
                            <th>Jumlah Potongan</th>
                            <th>Total Hutang</th>
                            <th width="7%">Aksi</th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
                <a class="btn btn-primary" id="addButId"><i class="glyphicon glyphicon-plus"></i> Tambah Data</a>
            </div>
        </div>
    </div>
</div>

javascript

<script type="text/javascript">
    $(document).ready(function(){

        $('#addButId').click(function(){
            var tot=1;
            var totK=1;
            var sno = $('#pTable tr').length;
            var nos = eval(totK + 1);
            trow = `<tr>
                <td class='sNo'>${sno}</td>
                <td><select onchange='pilih_hutang(${nos},this.value)' class='form-control hutangs1' name='kd_hutang[]' id='kd_hutang${nos}' required></select></td>
                <td><input type='text' class='form-control' name='jumlah_hutang[]' id='jumlah_hutang${nos}' readonly='readonly'></td>
                <td><input type='text' class='form-control' name='jumlah_potongan[]' id='jumlah_potongan${nos}' readonly='readonly'></td>
                <td><input type='text' class='form-control' name='total_hutang[]' id='total_hutang${nos}' readonly='readonly'></td>
                <td><button  type='button' class='rButton btn btn-sm btn-danger' data-tooltip='tooltip' data-placement='top' title='Hapus'><i class='glyphicon glyphicon-trash'></i></button></td></tr>`;

            $('#pTable').append(trow);

            {{--$(".hutangs1").select2({--}}
            {{--    placeholder: "Pilih Hutang",--}}
            {{--    width: "100%",--}}
            {{--    ajax: {--}}
            {{--        url: '<?php echo site_url('himpunan/getHutang'); ?>',--}}
            {{--        url: '{{ route('admin.') }}'--}}
            {{--        dataType: 'json',--}}
            {{--        data: function (params){--}}
            {{--            return{--}}
            {{--                q: $.trim(params.term),--}}
            {{--                tahun:$('#tahun').val(),--}}
            {{--                kd_renja_keg:$('#kegiatan_b').val(),--}}
            {{--                kd_belanja:$('#rekening_b').val(),--}}
            {{--                jenis_belanja:$('#jenis').val(),--}}
            {{--                uraian_belanja:$('#uraian').val(),--}}
            {{--                detail_belanja:$('#detail').val(),--}}
            {{--            };--}}
            {{--        },--}}
            {{--        processResults: function (data){--}}
            {{--            console.log(data);--}}
            {{--            return{--}}
            {{--                results: data--}}
            {{--            };--}}
            {{--        },--}}
            {{--        cache: true--}}
            {{--    }--}}
            {{--});--}}

            tot=tot+1;
            totK=totK+1;
        });

    });
</script>
