@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ asset('admin/pekerjaan/proses-edit') }}" method="post" accept-charset="utf-8">
{{ csrf_field() }}

<input type="hidden" name="id_pekerjaan" value="{{ $pekerjaan->id_pekerjaan }}">

<div class="form-group row">
  <label class="col-md-3">Nama Pekerjaan</label>
  <div class="col-md-9">
    <input type="text" name="nama_pekerjaan" class="form-control" placeholder="Nama pekerjaan" value="{{ $pekerjaan->nama_pekerjaan }}" required>
  </div>
</div>

<div class="form-group row">
  <label class="col-md-3">No urut tampil</label>
  <div class="col-md-9">
    <input type="number" name="urutan" class="form-control" placeholder="No urut tampil" value="{{ $pekerjaan->urutan }}" required>
  </div>
</div>

<div class="form-group row">
  <label class="col-md-3"></label>
  <div class="col-md-9">

    <a href="{{ asset('admin/pekerjaan') }}" class="btn btn-secondary">
      <i class="fa fa-arrow-left"></i> Kembali
    </a>

    <button type="submit" class="btn btn-primary">Simpan</button>
  </div>
</div>

</form>

