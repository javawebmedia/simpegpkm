@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ asset('admin/jabatan/proses-edit') }}" method="post" accept-charset="utf-8">
{{ csrf_field() }}

<input type="hidden" name="id_jabatan" value="{{ $jabatan->id_jabatan }}">

<div class="form-group row">
  <label class="col-md-3">Nama Jabatan</label>
  <div class="col-md-9">
    <input type="text" name="nama_jabatan" class="form-control" placeholder="Nama jabatan" value="{{ $jabatan->nama_jabatan }}" required>
  </div>
</div>

<div class="form-group row">
          <label class="col-md-3">Divisi</label>
          <div class="col-md-9">

            <select name="id_divisi" class="form-control" required>
              <option value="">Pilih salah satu</option>
              <?php foreach($divisi as $divisi) { ?>
              <option value="{{ $divisi->id_divisi }}" <?php if($jabatan->id_divisi==$divisi->id_divisi) { echo 'selected'; } ?>>
                {{ $divisi->nama_divisi }}
              </option>
              <?php } ?>
            </select>

          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3">Jenis Jabatan</label>
          <div class="col-md-9">

            <select name="jenis_jabatan" class="form-control" required>
              <option value="">Pilih salah satu</option>
              <option value="Fungsional" <?php if($jabatan->jenis_jabatan=='Fungsional') { echo 'selected'; } ?>>Fungsional</option>
              <option value="Struktural" <?php if($jabatan->jenis_jabatan=='Struktural') { echo 'selected'; } ?>>Struktural</option>
            </select>
            
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3">Keterangan</label>
          <div class="col-md-9">
            <textarea name="keterangan" class="form-control">{{ $jabatan->keterangan }}</textarea>
          </div>
        </div>

<div class="form-group row">
  <label class="col-md-3">No urut tampil</label>
  <div class="col-md-9">
    <input type="number" name="urutan" class="form-control" placeholder="No urut tampil" value="{{ $jabatan->urutan }}" required>
  </div>
</div>

<div class="form-group row">
  <label class="col-md-3"></label>
  <div class="col-md-9">

    <a href="{{ asset('admin/jabatan') }}" class="btn btn-secondary">
      <i class="fa fa-arrow-left"></i> Kembali
    </a>

    <button type="submit" class="btn btn-primary">Simpan</button>
  </div>
</div>

</form>

