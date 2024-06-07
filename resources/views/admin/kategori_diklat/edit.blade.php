@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ asset('admin/kategori-diklat/proses-edit') }}" method="post" accept-charset="utf-8">
{{ csrf_field() }}

<input type="hidden" name="id_kategori_diklat" value="{{ $kategori_diklat->id_kategori_diklat }}">

<div class="form-group row">
  <label class="col-md-3">Nama Kategori Diklat</label>
  <div class="col-md-9">
    <input type="text" name="nama_kategori_diklat" class="form-control" placeholder="Nama kategori_diklat" value="{{ $kategori_diklat->nama_kategori_diklat }}" required>
  </div>
</div>

<div class="form-group row">
  <label class="col-md-3">Keterangan</label>
  <div class="col-md-9">
    <textarea name="keterangan" class="form-control">{{ $kategori_diklat->keterangan }}</textarea>
  </div>
</div>

<div class="form-group row">
  <label class="col-md-3">No urut tampil</label>
  <div class="col-md-9">
    <input type="number" name="urutan" class="form-control" placeholder="No urut tampil" value="{{ $kategori_diklat->urutan }}" required>
  </div>
</div>

<div class="form-group row">
  <label class="col-md-3"></label>
  <div class="col-md-9">

    <a href="{{ asset('admin/kategori-diklat') }}" class="btn btn-secondary">
      <i class="fa fa-arrow-left"></i> Kembali
    </a>

    <button type="submit" class="btn btn-primary">Simpan</button>
  </div>
</div>

</form>

