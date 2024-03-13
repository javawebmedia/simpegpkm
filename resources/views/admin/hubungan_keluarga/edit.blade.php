@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ asset('admin/hubungan-keluarga/proses-edit') }}" method="post" accept-charset="utf-8">
{{ csrf_field() }}

<input type="hidden" name="id_hubungan_keluarga" value="{{ $hubungan_keluarga->id_hubungan_keluarga }}">

<div class="form-group row">
  <label class="col-md-3">Nama Hubungan Keluarga</label>
  <div class="col-md-9">
    <input type="text" name="nama_hubungan_keluarga" class="form-control" placeholder="Nama hubungan_keluarga" value="{{ $hubungan_keluarga->nama_hubungan_keluarga }}" required>
  </div>
</div>

<div class="form-group row">
  <label class="col-md-3">No urut tampil</label>
  <div class="col-md-9">
    <input type="number" name="urutan" class="form-control" placeholder="No urut tampil" value="{{ $hubungan_keluarga->urutan }}" required>
  </div>
</div>

<div class="form-group row">
  <label class="col-md-3"></label>
  <div class="col-md-9">

    <a href="{{ asset('admin/hubungan_keluarga') }}" class="btn btn-secondary">
      <i class="fa fa-arrow-left"></i> Kembali
    </a>

    <button type="submit" class="btn btn-primary">Simpan</button>
  </div>
</div>

</form>

