@if($errors->any())
<div class="alert alert-danger">
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif

<form action="{{ asset('admin/aktivitas/proses-edit') }}" method="post" accept-charset="utf-8">
  {{ csrf_field() }}

  <input type="hidden" name="id_aktivitas" value="{{ $aktivitas->id_aktivitas }}">

  <div class="form-group row">
    <label class="col-md-3">Nama Aktivitas</label>

    <div class="col-md-7">
      <input type="text" name="nama_aktivitas" class="form-control" placeholder="Nama aktivitas" value="{{ $aktivitas->nama_aktivitas }}" required>
      <small class="text-secondary">Nama aktivitas</small>
    </div>

    <div class="col-md-2">
      <input type="text" name="kode_aktivitas" class="form-control" placeholder="Kode" value="{{ $aktivitas->kode_aktivitas }}" readonly>
      <small class="text-secondary">Kode aktivitas</small>
    </div>

  </div>

  <div class="form-group row">
    <label class="col-md-3">Divisi</label>
    <div class="col-md-9">

      <select name="id_divisi" class="form-control" required>
        <option value="">Pilih salah satu</option>
        <?php foreach($divisi as $divisi) { ?>
          <option value="{{ $divisi->id_divisi }}" <?php if($aktivitas->id_divisi==$divisi->id_divisi) { echo 'selected'; } ?>>
            {{ $divisi->nama_divisi }}
          </option>
        <?php } ?>
      </select>

    </div>
  </div>

  <div class="form-group row">
    <label class="col-md-3">Satuan Output</label>
    <div class="col-md-9">

      <select name="id_satuan" class="form-control" required>
        <option value="">Pilih Satuan Output</option>
        <?php foreach($satuan as $satuan) { ?>
          <option value="{{ $satuan->id_satuan }}" <?php if($aktivitas->id_satuan==$satuan->id_satuan) { echo 'selected'; } ?>>
            {{ $satuan->nama_satuan }}
          </option>
        <?php } ?>
      </select>

    </div>
  </div>

  <div class="form-group row">
    <label class="col-md-3">Status Aktivitas</label>
    <div class="col-md-9">

      <select name="status_aktivitas" class="form-control" required>
        <option value="Aktif" <?php if($aktivitas->status_aktivitas=='Aktif') { echo 'selected'; } ?>>Aktif</option>
        <option value="Nonaktif" <?php if($aktivitas->status_aktivitas=='Nonaktif') { echo 'selected'; } ?>>Nonaktif</option>
      </select>

    </div>
  </div>

  <div class="form-group row">
    <label class="col-md-3">Waktu, Tingkat Kesulitaan, Bobot</label>

    <div class="col-md-3">
      <input type="number" name="waktu" class="form-control" placeholder="Waktu" value="{{ $aktivitas->waktu }}" required>
      <small class="text-secondary">Waktu dalam menit</small>
    </div>

    <div class="col-md-3">
      <input type="number" name="tingkat_kesulitan" class="form-control" placeholder="Tingkat kesulitan" value="{{ $aktivitas->tingkat_kesulitan }}" required>
      <small class="text-secondary">Tingkat kesulitan</small>
    </div>

    <div class="col-md-3">
      <input type="number" name="bobot" class="form-control" placeholder="Bobot" value="{{ $aktivitas->bobot }}" required>
      <small class="text-secondary">Bobot</small>
    </div>

  </div>

  <div class="form-group row">
    <label class="col-md-3">Keterangan</label>
    <div class="col-md-9">
      <textarea name="keterangan" class="form-control">{{ $aktivitas->keterangan }}</textarea>
    </div>
  </div>

  <div class="form-group row">
    <label class="col-md-3">Kategori dan No urut tampil</label>
    
    <div class="col-md-6">
      <input type="text" name="kategori" class="form-control" placeholder="Kategori" value="{{ $aktivitas->kategori }}" required>
    </div>

    <div class="col-md-3">
      <input type="number" name="urutan" class="form-control" placeholder="No urut tampil" value="{{ $aktivitas->urutan }}" required>
    </div>
  </div>

  <div class="form-group row">
    <label class="col-md-3"></label>
    <div class="col-md-9">

      <a href="{{ asset('admin/aktivitas') }}" class="btn btn-secondary">
        <i class="fa fa-arrow-left"></i> Kembali
      </a>

      <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
  </div>

</form>

