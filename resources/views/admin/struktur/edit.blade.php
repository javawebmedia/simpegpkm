@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ asset('admin/struktur/proses-edit') }}" method="post" accept-charset="utf-8">
{{ csrf_field() }}

<input type="hidden" name="id_atasan" value="{{ $atasan->id_atasan }}">

<div class="form-group row">
  <label class="col-md-3">Nama Pegawai</label>
  <div class="col-md-9">
    <select name="id_pegawai" id="id_pegawai" class="form-control select2bs4" required>
      <option value="">Pilih pegawai</option>
      @foreach($pegawai as $pegawai)
      <option value="{{ $pegawai->id_pegawai }}" @if($atasan->id_pegawai === $pegawai->id_pegawai) selected @endif>{{ $pegawai->nip . ' - ' . $pegawai->nama_lengkap }}</option>
      @endforeach
    </select>
  </div>
</div>

<div class="form-group row">
  <label class="col-md-3">Keterangan</label>
  <div class="col-md-9">
    <textarea name="keterangan" id="keterangan" rows="5" class="form-control" placeholder="Keterangan">{{ $atasan->keterangan }}</textarea>
  </div>
</div>

<div class="form-group row">
  <label class="col-md-3">Status</label>
  <div class="col-md-9">
    <select name="status_atasan" id="status_atasan" class="form-control" required>
      <option value="Aktif" @if($atasan->status_atasan === 'Aktif') selected @endif>Aktif</option>
      <option value="Nonaktif" @if($atasan->status_atasan === 'Nonaktif') selected @endif>Nonaktif</option>
    </select>
  </div>
</div>

<div class="form-group row">
  <label class="col-md-3"></label>
  <div class="col-md-9">

    <a href="{{ asset('admin/struktur') }}" class="btn btn-secondary">
      <i class="fa fa-arrow-left"></i> Kembali
    </a>

    <button type="submit" class="btn btn-primary">Simpan</button>
  </div>
</div>

</form>

