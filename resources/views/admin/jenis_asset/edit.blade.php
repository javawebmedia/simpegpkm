@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ asset('admin/jenis-asset/proses-edit') }}" method="post" accept-charset="utf-8">
{{ csrf_field() }}

<input type="hidden" name="id_jenis_asset" value="{{ $jenis_asset->id_jenis_asset }}">

<div class="form-group row">
  <label class="col-md-3">Jenis Asset</label>
  <div class="col-md-9">
    <input type="text" name="jenis_asset" class="form-control" placeholder="Jenis Asset" value="{{ $jenis_asset->jenis_asset }}" required>
  </div>
</div>

<div class="form-group row">
  <label class="col-md-3">Tipe</label>
  <div class="col-md-9">
    <input type="text" name="tipe" class="form-control" placeholder="Tipe" value="{{ $jenis_asset->tipe }}">
  </div>
</div>

<div class="form-group row">
  <label class="col-md-3"></label>
  <div class="col-md-9">

    <a href="{{ asset('admin/jenis-asset') }}" class="btn btn-secondary">
      <i class="fa fa-arrow-left"></i> Kembali
    </a>

    <button type="submit" class="btn btn-primary">Simpan</button>
  </div>
</div>

</form>

