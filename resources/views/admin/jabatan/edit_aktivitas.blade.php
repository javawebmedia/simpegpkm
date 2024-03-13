@if($errors->any())
<div class="alert alert-danger">
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif

<form action="{{ asset('admin/jabatan/update-aktivitas') }}" method="post" accept-charset="utf-8">
  {{ csrf_field() }}

  @csrf
  <input type="hidden" name="id_aktivitas_utama" value="{{ $aktivitas_utama->id_aktivitas_utama }}">
  <div class="form-group">
    <label for="nip">Pegawai</label>
    <select name="nip" id="nip" class="form-control select2">
      <option value="">Pilih Pegawai</option>
      @foreach($pegawai as $pegawai)
      <option value="{{ $pegawai->nip }}" @if($pegawai->nip === $aktivitas_utama->nip) selected @endif>{{ $pegawai->nip . ' - ' . $pegawai->nama_lengkap }}</option>
      @endforeach
    </select>
  </div>

  <div class="form-group">
    <label for="id_aktivitas">Aktivitas</label>
    <select name="id_aktivitas" id="id_aktivitas" class="form-control select2" required>
      <option value="">Pilih Aktivitas</option>
      @foreach($aktivitas as $aktivitas)
      <option value="{{ $aktivitas->id_aktivitas }}" @if($aktivitas->id_aktivitas === $aktivitas_utama->id_aktivitas) selected @endif>{{ $aktivitas->nama_aktivitas . ' - ' . $aktivitas->waktu }} Menit</option>
      @endforeach
    </select>
  </div>

  <div class="form-group">
    <label for="jenis_aktivitas_utama">Jenis Aktivitas</label>
    <select name="jenis_aktivitas_utama" id="jenis_aktivitas_utama" class="form-control">
      <option value="">Pilih Jenis Aktivitas</option>
      <option value="Utama" @if($aktivitas_utama->jenis_aktivitas_utama === 'Utama') selected @endif>Aktivitas Utama</option>
      <option value="Tambahan" @if($aktivitas_utama->jenis_aktivitas_utama === 'Tambahan') selected @endif>Aktivitas Tambahan</option>
      <option value="Lainnya" @if($aktivitas_utama->jenis_aktivitas_utama === 'Lainnya') selected @endif>Aktivitas Lainnya</option>
    </select>
  </div>

  <div class="form-group row">
    <label class="col-md-3"></label>
    <div class="col-md-9">

      <a href="{{ asset('admin/jabatan/aktivitas/' . $aktivitas_utama->id_jabatan) }}" class="btn btn-secondary">
        <i class="fa fa-arrow-left"></i> Kembali
      </a>

      <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
  </div>

</form>

