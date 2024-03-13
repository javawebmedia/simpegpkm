<?php 
use Illuminate\Support\Facades\DB;
// ambil data master
$jenjang_pendidikan = DB::table('jenjang_pendidikan')->orderBy('urutan', 'ASC')->get();
$hubungan_keluarga = DB::table('hubungan_keluarga')->orderBy('urutan', 'ASC')->get();
$agama = DB::table('agama')->orderBy('urutan', 'ASC')->get();
$pekerjaan = DB::table('pekerjaan')->orderBy('urutan', 'ASC')->get();
?>

<form action="{{ asset('pegawai/pegawai/edit-keluarga') }}" method="post" accept-charset="utf-8">
  {{ csrf_field() }}

  <input type="hidden" name="id_pegawai" value="{{ $pegawai->id_pegawai }}">
  <input type="hidden" name="id_keluarga" value="{{ $keluarga->id_keluarga }}">

  <div class="form-group row">
    <label class="col-md-3">Hubungan Keluarga <span class="text-danger">*</span></label>

    <div class="col-md-9">
      <select name="id_hubungan_keluarga" id="id_hubungan_keluarga" class="form-control" required>
        <option value="">Pilih Hubungan Keluarga</option>
        @foreach($hubungan_keluarga as $hubungan_keluarga)
        <option value="{{ $hubungan_keluarga->id_hubungan_keluarga }}" @if($hubungan_keluarga->id_hubungan_keluarga === $keluarga->id_hubungan_keluarga) selected @endif>{{ $hubungan_keluarga->nama_hubungan_keluarga }}</option>
        @endforeach
      </select>
    </div>
  </div>

  <div class="form-group row">
    <label class="col-md-3">Nama Lengkap</label>
    <div class="col-md-9">
      <input type="text" name="nama_lengkap" class="form-control" placeholder="Nama Lengkap" value="{{ $keluarga->nama_lengkap }}" required>
    </div>
  </div>

  <div class="form-group row">
    <label class="col-md-3">NIK</label>
    <div class="col-md-9">
      <input type="text" name="nik" class="form-control" placeholder="NIK" value="{{ $keluarga->nik }}" required>
    </div>
  </div>

  <div class="form-group row">
    <label class="col-md-3">Tempat &amp; Tanggal Lahir</label>
    <div class="col-md-6">
      <input type="text" name="tempat_lahir" class="form-control" placeholder="Tempat lahir" value="{{ $keluarga->tempat_lahir }}" required>
    </div>
    <div class="col-md-3">
      <input type="text" name="tanggal_lahir" class="form-control datepicker" placeholder="Tanggal lahir" value="{{ date('d-m-Y', strtotime($keluarga->tanggal_lahir)) }}" required>
    </div>
  </div>

  <div class="form-group row">
    <label class="col-md-3">Jenis Kelamin</label>
    <div class="col-md-9">
      <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
        <option value="">Pilih jenis kelamin</option>
        <option value="L" @if($keluarga->jenis_kelamin === 'L') selected @endif>Laki-laki</option>
        <option value="P" @if($keluarga->jenis_kelamin === 'P') selected @endif>Perempuan</option>
      </select>
    </div>
  </div>

  <div class="form-group row">
    <label class="col-md-3">Agama</label>
    <div class="col-md-9">
      <select name="id_agama" id="id_agama" class="form-control" required>
        <option value="">Pilih agama</option>
        @foreach($agama as $agama)
        <option value="{{ $agama->id_agama }}" @if($agama->id_agama === $keluarga->id_agama) selected @endif>{{ $agama->nama_agama }}</option>
        @endforeach
      </select>
    </div>
  </div>

  <div class="form-group row">
    <label class="col-md-3">Status Perkawinan</label>
    <div class="col-md-9">
      <select name="status_perkawinan" id="status_perkawinan" class="form-control" required>
        <option value="">Pilih status perkawinan</option>
        <option value="Belum Menikah" @if($keluarga->status_perkawinan === 'Belum Menikah') selected @endif>Belum Menikah</option>
        <option value="Menikah" @if($keluarga->status_perkawinan === 'Menikah') selected @endif>Menikah</option>
        <option value="Cerai Hidup" @if($keluarga->status_perkawinan === 'Cerai Hidup') selected @endif>Cerai Hidup</option>
        <option value="Cerai Mati" @if($keluarga->status_perkawinan === 'Cerai Mati') selected @endif>Duda</option>
      </select>
    </div>
  </div>

  <div class="form-group row">
    <label class="col-md-3">Jenjang Pendidikan<span class="text-danger">*</span></label>
    <div class="col-md-9">
      <select name="id_jenjang_pendidikan" class="form-control" id="id_jenjang_pendidikan">
        <option value="">Pilih Jenjang</option>
        <?php foreach($jenjang_pendidikan as $jenjang_pendidikan) { ?>
          <option value="{{ $jenjang_pendidikan->id_jenjang_pendidikan }}" @if($jenjang_pendidikan->id_jenjang_pendidikan === $keluarga->id_jenjang_pendidikan) selected @endif>{{ $jenjang_pendidikan->nama_jenjang_pendidikan }}</option>
        <?php } ?>
      </select>
    </div>

  </div>

  <div class="form-group row">
    <label class="col-md-3">Pekerjaan<span class="text-danger">*</span></label>
    <div class="col-md-9">
      <select name="id_pekerjaan" class="form-control" id="id_pekerjaan">
        <option value="">Pilih pekerjaan</option>
        <?php foreach($pekerjaan as $pekerjaan) { ?>
          <option value="{{ $pekerjaan->id_pekerjaan }}" @if($pekerjaan->id_pekerjaan === $keluarga->id_pekerjaan) selected @endif>{{ $pekerjaan->nama_pekerjaan }}</option>
        <?php } ?>
      </select>
    </div>

  </div>

  <div class="form-group row">
    <label class="col-md-3"></label>
    <div class="col-md-9">
      <a href="{{ asset('pegawai/pegawai/riwayat') }}#pendidikan" class="btn btn-default">
        <i class="fa fa-undo"></i> Kembali
      </a>
      <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
  </div>

</form>