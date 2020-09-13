<div class="row">
    <div class="col-md-12">
        <div class="row">
            <table class="table table-borderless">
                <thead>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-lg font-weight-bold" width="100px">Dari</td>
                        <td width="10px">:</td>
                        <td class="font-weight-bold">{{ ucfirst($retur->place->name) }}</td>
                    </tr>
                </tbody>
            </table>
            <table class="table table-hover">
                <thead>
                <tr class="text-success">
                    <th scope="col">#</th>
                    <th scope="col">Bahan Makanan</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Satuan</th>
                    <th scope="col">Keterangan</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($retur->detail as $detail)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ ucfirst($detail->material->name) }}</td>
                            <td>{{ $detail->jumlah }}</td>
                            <td>{{ ucfirst($detail->unit->name) }}</td>
                            <td>{{ $detail->keterangan }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

