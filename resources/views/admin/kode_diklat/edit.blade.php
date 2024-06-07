@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ asset('admin/kode-diklat/proses-edit') }}" method="post" accept-charset="utf-8">
{{ csrf_field() }}

<input type="hidden" name="id_kode_diklat" value="{{ $kode_diklat->id_kode_diklat }}">

        <div class="form-group row">
          <label class="col-md-3">Status Diklat</label>
          <div class="col-md-9">
            <select name="status_aktif" class="form-control select2" required>
              <option value="Aktif">Aktif</option>
              <option value="Non Aktif" <?php if($kode_diklat->status_aktif=='Non Aktif') { echo 'selected'; } ?>>Non Aktif</option>
            </select>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3">Rumpun</label>
          <div class="col-md-9">
            <select name="id_rumpun" class="form-control" id="id_rumpun" required>
              <option value="">Pilih Rumpun</option>
              <?php foreach($rumpun as $rumpun) { ?>
              <option value="<?php echo $rumpun->id_rumpun ?>" <?php if($kode_diklat->id_rumpun==$rumpun->id_rumpun) { echo 'selected'; } ?>>
                <?php echo $rumpun->nama_rumpun ?>
              </option>
            <?php } ?>
            </select>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3">Jenis Pelatihan</label>
          <div class="col-md-9">
            <select name="id_jenis_pelatihan" class="form-control" id="id_jenis_pelatihan" required>
              <option value="">Pilih Jenis Pelatihan</option>
              <?php foreach($jenis_pelatihan as $jenis_pelatihan) { ?>
              <option value="<?php echo $jenis_pelatihan->id_jenis_pelatihan ?>"  class="{{ $jenis_pelatihan->id_rumpun }}" <?php if($kode_diklat->id_jenis_pelatihan==$jenis_pelatihan->id_jenis_pelatihan) { echo 'selected'; } ?>>
                <?php echo $jenis_pelatihan->nama_jenis_pelatihan ?>
              </option>
            <?php } ?>
            </select>
          </div>
        </div>

        <script>
            $("#id_jenis_pelatihan").chained("#id_rumpun");
          </script>

        <div class="form-group row">
          <label class="col-md-3">Kode Diklat</label>
          <div class="col-md-9">
            <input type="number" name="kode_diklat" class="form-control" placeholder="Kode diklat" value="{{ $kode_diklat->kode_diklat; }}" required>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3">Nama Diklat</label>
          <div class="col-md-9">
            <input type="text" name="nama_kode_diklat" class="form-control" placeholder="Nama Diklat" value="{{ $kode_diklat->nama_kode_diklat; }}" required>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3">Keterangan</label>
          <div class="col-md-9">
            <textarea name="keterangan" class="form-control">{{ $kode_diklat->keterangan; }}</textarea>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3">No urut tampil</label>
          <div class="col-md-9">
            <input type="number" name="urutan" class="form-control" placeholder="No urut tampil" value="{{ $kode_diklat->urutan; }}" required>
          </div>
        </div>

<div class="form-group row">
  <label class="col-md-3"></label>
  <div class="col-md-9">

    <a href="{{ asset('admin/kode_diklat') }}" class="btn btn-secondary">
      <i class="fa fa-arrow-left"></i> Kembali
    </a>

    <button type="submit" class="btn btn-primary">Simpan</button>
  </div>
</div>

</form>

