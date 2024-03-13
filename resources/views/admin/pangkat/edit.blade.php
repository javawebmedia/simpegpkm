@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ asset('admin/pangkat/proses-edit') }}" method="post" accept-charset="utf-8">
{{ csrf_field() }}

<input type="hidden" name="id_pangkat" value="{{ $pangkat->id_pangkat }}">

<div class="form-group row">
  <label class="col-md-3">Nama Pangkat</label>
  <div class="col-md-9">
    <input type="text" name="nama_pangkat" class="form-control" placeholder="Nama pangkat" value="{{ $pangkat->nama_pangkat }}" required>
  </div>
</div>

<div class="form-group row">
  <label class="col-md-3">Golongan</label>
  <div class="col-md-9">
    <input type="text" name="golongan" class="form-control" placeholder="Golongan" value="{{ $pangkat->golongan }}" required>
  </div>
</div>

<div class="form-group row">
  <label class="col-md-3">Ruang</label>
  <div class="col-md-9">
    <input type="text" name="ruang" class="form-control" placeholder="Ruang" value="{{ $pangkat->ruang }}" required>
  </div>
</div>

<div class="form-group row">
  <label class="col-md-3">No urut tampil</label>
  <div class="col-md-9">
    <input type="number" name="urutan" class="form-control" placeholder="No urut tampil" value="{{ $pangkat->urutan }}" required>
  </div>
</div>

<div class="form-group row">
  <label class="col-md-3"></label>
  <div class="col-md-9">

    <a href="{{ asset('admin/pangkat') }}" class="btn btn-secondary">
      <i class="fa fa-arrow-left"></i> Kembali
    </a>

    <button type="submit" class="btn btn-primary">Simpan</button>
  </div>
</div>

</form>

