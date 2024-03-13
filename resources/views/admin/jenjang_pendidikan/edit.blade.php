@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ asset('admin/jenjang-pendidikan/proses-edit') }}" method="post" accept-charset="utf-8">
{{ csrf_field() }}

<input type="hidden" name="id_jenjang_pendidikan" value="{{ $jenjang_pendidikan->id_jenjang_pendidikan }}">

<div class="form-group row">
  <label class="col-md-3">Nama Jenjang Pendidikan</label>
  <div class="col-md-9">
    <input type="text" name="nama_jenjang_pendidikan" class="form-control" placeholder="Nama jenjang_pendidikan" value="{{ $jenjang_pendidikan->nama_jenjang_pendidikan }}" required>
  </div>
</div>

<div class="form-group row">
  <label class="col-md-3">No urut tampil</label>
  <div class="col-md-9">
    <input type="number" name="urutan" class="form-control" placeholder="No urut tampil" value="{{ $jenjang_pendidikan->urutan }}" required>
  </div>
</div>

<div class="form-group row">
  <label class="col-md-3"></label>
  <div class="col-md-9">

    <a href="{{ asset('admin/jenjang_pendidikan') }}" class="btn btn-secondary">
      <i class="fa fa-arrow-left"></i> Kembali
    </a>

    <button type="submit" class="btn btn-primary">Simpan</button>
  </div>
</div>

</form>

