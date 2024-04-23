@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ asset('admin/mesin-absen/proses-edit') }}" method="post" accept-charset="utf-8">
{{ csrf_field() }}

<input type="hidden" name="id_mesin_absen" value="{{ $mesin_absen->id_mesin_absen }}">

<div class="form-group row">
          <label class="col-md-3">IP Mesin Absen</label>
          <div class="col-md-9">
            <input type="text" name="ip_mesin_absen" class="form-control" placeholder="IP Mesin Absen" value="{{ $mesin_absen->ip_mesin_absen }}" required>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3">Key Mesin Absen</label>
          <div class="col-md-9">
            <input type="text" name="key_mesin_absen" class="form-control" placeholder="Key Mesin Absen" value="{{ $mesin_absen->key_mesin_absen }}" required>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3">Serial Number Mesin Absen</label>
          <div class="col-md-9">
            <input type="text" name="serial_number" class="form-control" placeholder="Serial Number Mesin Absen" value="{{ $mesin_absen->serial_number }}" required>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3">Lokasi Mesin Absen</label>
          <div class="col-md-9">
            <input type="text" name="lokasi" class="form-control" placeholder="Lokasi Mesin Absen" value="{{ $mesin_absen->lokasi }}" required>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3">Status Mesin Absen</label>
          <div class="col-md-9">
            <select name="status_mesin_absen" class="form-control">
              <option value="Aktif">Aktif</option>
              <option value="Non Aktif" <?php if($mesin_absen->status_mesin_absen == 'Non Aktif') { echo 'selected'; } ?>>Non Aktif</option>
            </select>
          </div>
        </div>

<div class="form-group row">
  <label class="col-md-3"></label>
  <div class="col-md-9">

    <a href="{{ asset('admin/mesin_absen') }}" class="btn btn-secondary">
      <i class="fa fa-arrow-left"></i> Kembali
    </a>

    <button type="submit" class="btn btn-primary">Simpan</button>
  </div>
</div>

</form>

