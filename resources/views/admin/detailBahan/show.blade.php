{{--@foreach($food->detail as $detail)--}}
{{--    {{ $detail->type->name }}--}}
{{--@endforeach--}}

<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <label for="type">Jenis Makanan</label>
                    <input disabled type="text" class="form-control" value="{{ ucfirst($food->type->name) }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <label for="type">Makanan</label>
                    <input disabled type="text" class="form-control" value="{{ ucfirst($food->name) }}">
                </div>
            </div>
        </div>

        @foreach($food->detail as $detail)
{{--            {{ $detail }}--}}
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="type">Bahan Makanan</label>
                                <input disabled type="text" class="form-control" value="{{ ucfirst($detail->material->name) }}">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="type">Jumlah</label>
                                <input disabled type="text" class="form-control" value="{{ $detail->satuan }}">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="type">Satuan</label>
                                <input disabled type="text" class="form-control" value="{{ $detail->unit->name }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="type">Keterangan</label>
                                <input disabled type="text" class="form-control" value="{{ $detail->keterangan }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
</div>
