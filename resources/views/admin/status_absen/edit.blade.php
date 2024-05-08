@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ asset('admin/status-absen/proses-edit') }}" method="post" accept-charset="utf-8">
{{ csrf_field() }}

<input type="hidden" name="id_status_absen" value="{{ $status_absen->id_status_absen }}">

<div class="form-group row">
  <label class="col-md-3">Kode dan Warna Status Absen</label>
  <div class="col-md-3">
    <input type="text" name="kode_status_absen" class="form-control" placeholder="Kode status absen" value="{{ $status_absen->kode_status_absen }}" required>
  </div>
  <div class="col-md-5">
    <div class="input-group my-colorpicker2">
      <input type="text" name="warna_status_absen" class="form-control" placeholder="Warna Status Absen" value="{{ $status_absen->warna_status_absen }}" required>
      <div class="input-group-append">
        <span class="input-group-text"><i class="fas fa-square"></i></span>
      </div>
    </div>
  </div>
</div>


<div class="form-group row">
  <label class="col-md-3">Nama Status Absen</label>
  <div class="col-md-9">
    <input type="text" name="nama_status_absen" class="form-control" placeholder="Nama status_absen" value="{{ $status_absen->nama_status_absen }}" required>
  </div>
</div>

<div class="form-group row">
  <label class="col-md-3">Pilih Jenis Absen</label>
  <div class="col-md-9">
    <select name="jenis_status_absen" id="jenis_status_absen" class="form-control" required>
      <option value="">Pilih Jenis</option>
      <option value="Absensi" <?php if($status_absen->jenis_status_absen=='Absensi') { echo 'selected'; } ?>>Absensi</option>
      <option value="Kehadiran" <?php if($status_absen->jenis_status_absen=='Kehadiran') { echo 'selected'; } ?>>Kehadiran</option>
    </select>
  </div>
</div>

<div class="form-group row">
  <label class="col-md-3">Aktif ?</label>
  <div class="col-md-9">
    <select name="aktif_status_absen" id="aktif_status_absen" class="form-control" required>
      <option value="">Pilih Status Absensi</option>
      <option value="Aktif" <?php if($status_absen->aktif_status_absen=='Aktif') { echo 'selected'; } ?>>Aktif</option>
      <option value="Non Aktif" <?php if($status_absen->aktif_status_absen=='Non Aktif') { echo 'selected'; } ?>>Non Aktif</option>
    </select>
  </div>
</div>

<div class="form-group row">
  <label class="col-md-3"></label>
  <div class="col-md-9">

    <a href="{{ asset('admin/status-absen') }}" class="btn btn-secondary">
      <i class="fa fa-arrow-left"></i> Kembali
    </a>

    <button type="submit" class="btn btn-primary">Simpan</button>
  </div>
</div>

</form>

