@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ asset('admin/metode-diklat/proses-edit') }}" method="post" accept-charset="utf-8">
{{ csrf_field() }}

<input type="hidden" name="id_metode_diklat" value="{{ $metode_diklat->id_metode_diklat }}">

<div class="form-group row">
          <label class="col-md-3">Jenis Metode Diklat</label>
          <div class="col-md-9">
            <select name="jenis_metode" class="form-control" required>
              <option value="">Pilih Jenis Metode</option>
              <option value="Klasikal">Klasikal</option>
              <option value="Non-Klasikal" <?php if($metode_diklat->jenis_metode=='Non-Klasikal') { echo 'selected'; } ?>>Non-Klasikal</option>
            </select>
          </div>
        </div>

<div class="form-group row">
  <label class="col-md-3">Nama Metode Diklat</label>
  <div class="col-md-9">
    <input type="text" name="nama_metode_diklat" class="form-control" placeholder="Nama metode_diklat" value="{{ $metode_diklat->nama_metode_diklat }}" required>
  </div>
</div>

<div class="form-group row">
  <label class="col-md-3">Jumlah JP</label>
  <div class="col-md-9">
    <input type="number" name="jp" class="form-control" placeholder="Jumlah JP" value="{{ $metode_diklat->jp }}">
  </div>
</div>

<div class="form-group row">
  <label class="col-md-3">No urut tampil</label>
  <div class="col-md-9">
    <input type="number" name="urutan" class="form-control" placeholder="No urut tampil" value="{{ $metode_diklat->urutan }}">
  </div>
</div>

<div class="form-group row">
  <label class="col-md-3">Keterangan</label>
  <div class="col-md-9">
    <textarea name="keterangan" class="form-control">{{ $metode_diklat->keterangan }}</textarea>
  </div>
</div>



<div class="form-group row">
  <label class="col-md-3"></label>
  <div class="col-md-9">

    <a href="{{ asset('admin/metode_diklat') }}" class="btn btn-secondary">
      <i class="fa fa-arrow-left"></i> Kembali
    </a>

    <button type="submit" class="btn btn-primary">Simpan</button>
  </div>
</div>

</form>

