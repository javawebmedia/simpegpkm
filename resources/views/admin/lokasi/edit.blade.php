@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ asset('admin/lokasi/proses-edit') }}" method="post" accept-charset="utf-8">
{{ csrf_field() }}

<input type="hidden" name="id_lokasi" value="{{ $lokasi->id_lokasi }}">

<div class="form-group row">
  <label class="col-md-3">Lokasi Puskesmas</label>
  <div class="col-md-9">
    <input type="text" name="lokasi" class="form-control" placeholder="Lokasi Puskesmas" value="{{ $lokasi->lokasi }}" required>
  </div>
</div>

<div class="form-group row">
  <label class="col-md-3">Ruangan</label>
  <div class="col-md-9">
    <input type="text" name="ruangan" class="form-control" placeholder="Ruangan" value="{{ $lokasi->ruangan }}">
  </div>
</div>

<div class="form-group row">
  <label class="col-md-3">No urut tampil</label>
  <div class="col-md-9">
    <input type="number" name="urutan" class="form-control" placeholder="No urut tampil" value="{{ $lokasi->urutan }}" required>
  </div>
</div>

<div class="form-group row">
  <label class="col-md-3"></label>
  <div class="col-md-9">

    <a href="{{ asset('admin/lokasi') }}" class="btn btn-secondary">
      <i class="fa fa-arrow-left"></i> Kembali
    </a>

    <button type="submit" class="btn btn-primary">Simpan</button>
  </div>
</div>

</form>

