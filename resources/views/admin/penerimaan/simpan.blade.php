<div id="showForm2">
    <div class="row" id="formSatu">
        <div class="col-md-10">
            <div class="row">
                <div class="col-md-5">
                    <label for="vendors">Vendor</label>
                    <select class="form-control custom-select" id="vendors" name="vendors" required>
                        <option selected disabled >Pilih Vendor</option>
                        @foreach ($vendors as $vendor)
                            <option value="{{$vendor->id}}" name="{{$vendor->name}}">{{ Str::ucfirst($vendor->name) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-5">
                    <label for="heads">Penanggung Jawab</label>
                    <select class="form-control custom-select" id="heads" name="heads" required>
                        <option selected disabled>Pilih</option>
                        @foreach ($heads as $head)
                            <option value="{{$head->id}}" name="{{$head->name}}">{{ Str::ucfirst($head->name) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="panel panel-default" id="formDua">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="pTable">
                            <thead>
                            <tr class="text-center">
                                <th width="5%">No</th>
                                <th width="25%">Nama Bahan</th>
                                <th width="7%">Jumlah</th>
                                <th>Nama Satuan</th>
                                <th>Keterangan</th>
                                <th width="7%">Aksi</th>
                            </tr>
                            </thead>
                            <tbody id="addBody">
                            </tbody>
                        </table>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <thead>
                            </thead>
                            <tbody>
                            <tr>
                                <td width="79%">
                                    <a class="btn btn-primary btn-icon-split btn-sm" id="addRow">
                                                                                <span class="icon text-white-50">
                                                                                  <i class="fas fa-times-circle"></i>
                                                                                </span>
                                        <span class="text text-white">Tambah</span>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.penerimaan.index') }}" class="btn btn-danger btn-icon-split btn-sm">
                                                                                <span class="icon text-white-50">
                                                                                  <i class="fas fa-times-circle"></i>
                                                                                </span>
                                        <span class="text">Batal</span>
                                    </a>
                                    <button class="btn btn-success btn-sm btn-icon-split" onclick="validateForm()">
                                                                                <span class="icon text-white-50">
                                                                                  <i class="fas fa-save"></i>
                                                                                </span>
                                        <span class="text">Simpan</span>
                                    </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
