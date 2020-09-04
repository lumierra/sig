<div class="form-group">
    <label for="name" class="col-sm-5 control-label">Kategori</label>
    <div class="col-sm-12">
        <select class="form-control custom-select" id="category" name="category" required>
            <option selected>Pilih</option>
            @foreach($categories as $category)
                <option value="{{$category->id}}"  {{$material->category->id == $category->id  ? 'selected' : ''}} name="{{$category->name}}">{{ Str::ucfirst($category->name) }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-group">
    <label for="name" class="col-sm-5 control-label">Nama Bahan Makanan</label>
    <div class="col-sm-12">
        <input type="text" class="form-control" id="name" name="name" placeholder="Ayam, Ikan, Beras" value="" maxlength="50" required="" autocomplete="off">
    </div>
</div>

<div class="form-group">
    <label for="name" class="col-sm-5 control-label">Satuan</label>
    <div class="col-sm-12">
        <select class="form-control" id="unit" name="unit" required>
            <option selected>Pilih</option>
            @foreach($units as $unit)
                <option value="{{$unit->id}}"  {{$material->unit->id == $unit->id  ? 'selected' : ''}} name="{{$unit->name}}">{{ $unit->name }}</option>
            @endforeach
        </select>
    </div>
</div>
