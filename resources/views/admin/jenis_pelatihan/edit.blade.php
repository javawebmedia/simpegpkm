@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ asset('admin/jenis-pelatihan/proses-edit') }}" method="post" accept-charset="utf-8">
{{ csrf_field() }}

<input type="hidden" name="id_jenis_pelatihan" value="{{ $jenis_pelatihan->id_jenis_pelatihan }}">

<div class="form-group row">
  <label class="col-md-3">Rumpun</label>
  <div class="col-md-9">
    <select name="id_rumpun" class="form-control">
      <option value="">Pilih Rumpun</option>
      <?php foreach($rumpun as $rumpun) { ?>
        <option value="<?php echo $rumpun->id_rumpun ?>" <?php if($rumpun->id_rumpun==$jenis_pelatihan->id_rumpun) { echo 'selected'; } ?>>
          <?php echo $rumpun->nama_rumpun ?>
        </option>
      <?php } ?>
    </select>
  </div>
</div>

<div class="form-group row">
  <label class="col-md-3">Nama Jenis Pelatihan</label>
  <div class="col-md-9">
    <input type="text" name="nama_jenis_pelatihan" class="form-control" placeholder="Nama jenis_pelatihan" value="{{ $jenis_pelatihan->nama_jenis_pelatihan }}" required>
  </div>
</div>

<div class="form-group row">
  <label class="col-md-3">Keterangan</label>
  <div class="col-md-9">
    <textarea name="keterangan" class="form-control">{{ $jenis_pelatihan->keterangan }}</textarea>
  </div>
</div>

<div class="form-group row">
  <label class="col-md-3">No urut tampil</label>
  <div class="col-md-9">
    <input type="number" name="urutan" class="form-control" placeholder="No urut tampil" value="{{ $jenis_pelatihan->urutan }}" required>
  </div>
</div>

<div class="form-group row">
  <label class="col-md-3"></label>
  <div class="col-md-9">

    <a href="{{ asset('admin/jenis_pelatihan') }}" class="btn btn-secondary">
      <i class="fa fa-arrow-left"></i> Kembali
    </a>

    <button type="submit" class="btn btn-primary">Simpan</button>
  </div>
</div>

</form>

