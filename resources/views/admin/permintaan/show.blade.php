<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <label for="type">Vendor</label>
                    <input disabled type="text" class="form-control" value="{{ ucfirst($demand->vendor->name) }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <label for="type">Penanggung Jawab</label>
                    <input disabled type="text" class="form-control" value="{{ ($demand->head->name) }}">
                </div>
            </div>
        </div>

        @foreach($demand->detail as $detail)
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
                                <input disabled type="text" class="form-control" value="{{ $detail->jumlah }}">
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

