@if($errors->any())
<div class="alert alert-danger">
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif

<form action="{{ asset('admin/panduan/proses-edit') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
  {{ csrf_field() }}

  <input type="hidden" name="id_panduan" value="{{ $panduan->id_panduan }}">

  <div class="form-group row">
    <label class="col-md-3">Nama Panduan</label>
    <div class="col-md-9">
      <input type="text" name="nama_panduan" class="form-control" placeholder="Nama panduan" value="{{ $panduan->nama_panduan }}" required>
    </div>
  </div>

  <div class="form-group row">
    <label class="col-md-3">Upload Manual Book</label>
    <div class="col-md-9">
      <input type="file" name="gambar" class="form-control" placeholder="Upload manual book" value="{{ $panduan->gambar }}">
    </div>
  </div>

  <div class="form-group row">
    <label class="col-md-3">Link Video Panduan</label>
    <div class="col-md-9">
      <input type="text" name="video" class="form-control" placeholder="Link Video panduan" value="{{ $panduan->video }}">
    </div>
  </div>

  <div class="form-group row">
    <label class="col-md-3">Keterangan</label>
    <div class="col-md-9">
      <textarea name="keterangan" class="form-control">{{ $panduan->keterangan }}</textarea>
    </div>
  </div>

  <div class="form-group row">
    <label class="col-md-3">Panduan untuk</label>
    <div class="col-md-9">
      <select name="pengguna" class="form-control">
        <option value="Pegawai">Pegawai</option>
        <option value="Administrator" <?php if($panduan->pengguna=='Administrator') { echo 'selected'; } ?>>Administrator</option>
        <option value="Umum" <?php if($panduan->pengguna=='Umum') { echo 'selected'; } ?>>Umum</option>
      </select>
    </div>
  </div>

  <div class="form-group row">
    <label class="col-md-3"></label>
    <div class="col-md-9">

      <a href="{{ asset('admin/panduan') }}" class="btn btn-secondary">
        <i class="fa fa-arrow-left"></i> Kembali
      </a>

      <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
  </div>

</form>

