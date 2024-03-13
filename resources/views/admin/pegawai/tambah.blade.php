@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ asset('admin/pegawai/proses-tambah') }}" method="post" accept-charset="utf-8" enctype="multipart/form-data">
{{ csrf_field() }}

<div class="form-group row">
  <label class="col-md-3">Nama Lengkap</label>
  <div class="col-md-9">
    <input type="text" name="nama_lengkap" class="form-control" placeholder="Nama lengkap" value="{{ old('nama_lengkap') }}" required>
  </div>
</div>

<div class="form-group row">
  <label class="col-md-3">Nama Panggilan</label>
  <div class="col-md-9">
    <input type="text" name="nama_panggilan" class="form-control" placeholder="Nama panggilan" value="{{ old('nama_panggilan') }}">
  </div>
</div>

<div class="form-group row">
  <label class="col-md-3">NIP &amp; NRK</label>
  <div class="col-md-4">
    <input type="text" name="nip" class="form-control" placeholder="NIP" value="{{ old('nip') }}" required>
    <small class="text-danger">Digunakan sebagai username.</small>
  </div>
  <div class="col-md-5">
    <input type="text" name="nrk" class="form-control" placeholder="NRK" value="{{ old('nrk') }}" required>
  </div>
</div>

<div class="form-group row">
  <label class="col-md-3">Akses Level dan Password</label>
  <div class="col-md-4">
    <select name="akses_level" id="akses_level" class="form-control" required>
      <option value="">Pilih akses level</option>
      <option value="Admin">Admin</option>
      <option value="Pimpinan">Pimpinan</option>
      <option value="User">User</option>
      <option value="Pegawai">Pegawai</option>
    </select>
    <small class="text-danger">Pilih hak akses pegawai</small>
  </div>

  <div class="col-md-5">
    <input type="text" name="password" class="form-control" placeholder="Password" value="{{ old('password') }}" required>
    <small class="text-danger">Masukkan NIP sebagai password standar</small>
  </div>
</div>

<div class="form-group row">
  <label class="col-md-3">NIK</label>
  <div class="col-md-9">
    <input type="text" name="nik" class="form-control" placeholder="NIK" value="{{ old('nik') }}" required>
  </div>
</div>

<div class="form-group row">
  <label class="col-md-3">Gelar Depan &amp; Belakang</label>
  <div class="col-md-4">
    <input type="text" name="gelar_depan" class="form-control" placeholder="Gelar depan" value="{{ old('gelar_depan') }}">
  </div>
  <div class="col-md-5">
    <input type="text" name="gelar_belakang" class="form-control" placeholder="Gelar belakang" value="{{ old('gelar_belakang') }}">
  </div>
</div>

<div class="form-group row">
  <label class="col-md-3">NPWP dan Nomor Rekening</label>
  <div class="col-md-4">
    <input type="text" name="npwp" class="form-control" placeholder="NPWP" value="{{ old('npwp') }}">
  </div>
  <div class="col-md-5">
    <input type="text" name="rekening" class="form-control" placeholder="Nomor Rekening" value="{{ old('rekening') }}">
  </div>
</div>

<div class="form-group row">
  <label class="col-md-3">Tempat &amp; Tanggal Lahir</label>
  <div class="col-md-4">
    <input type="text" name="tempat_lahir" class="form-control" placeholder="Tempat lahir" value="{{ old('tempat_lahir') }}" required>
  </div>
  <div class="col-md-5">
    <input type="text" name="tanggal_lahir" class="form-control datepicker" placeholder="HH-BB-TTTT" value="{{ old('tanggal_lahir') }}" readonly="" required>
  </div>
</div>

<div class="form-group row">
  <label class="col-md-3">Jenis Kelamin</label>
  <div class="col-md-9">
    <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
      <option value="">Pilih jenis kelamin</option>
      <option value="L">Laki-laki</option>
      <option value="P">Perempuan</option>
    </select>
  </div>
</div>

<div class="form-group row">
  <label class="col-md-3">Agama</label>
  <div class="col-md-9">
    <select name="id_agama" id="id_agama" class="form-control" required>
      <option value="">Pilih agama</option>
      @foreach($agama as $agama)
      <option value="{{ $agama->id_agama }}">{{ $agama->nama_agama }}</option>
      @endforeach
    </select>
  </div>
</div>

<div class="form-group row">
  <label class="col-md-3">Status Perkawinan</label>
  <div class="col-md-9">
    <select name="status_perkawinan" id="status_perkawinan" class="form-control" required>
      <option value="">Pilih status perkawinan</option>
      <option value="Belum Menikah">Belum Menikah</option>
      <option value="Menikah">Menikah</option>
      <option value="Cerai Hidup">Cerai Hidup</option>
      <option value="Cerai Mati">Cerai Mati</option>
    </select>
  </div>
</div>

<div class="form-group row">
  <label class="col-md-3">No Telepon</label>
  <div class="col-md-9">
    <input type="text" name="telepon" class="form-control" placeholder="No Telepon" value="{{ old('telepon') }}" required>
  </div>
</div>

<div class="form-group row">
  <label class="col-md-3">Email</label>
  <div class="col-md-9">
    <input type="text" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
  </div>
</div>

<div class="form-group row">
  <label class="col-md-3">Alamat</label>
  <div class="col-md-9">
    <textarea name="alamat" id="alamat" class="form-control" rows="5" placeholder="Alamat" required>{{ old('alamat') }}</textarea>
  </div>
</div>
<div class="row"><div class="col-md-12"><hr></div></div>

<div class="form-group row">
  <label class="col-md-3">Jenis Pegawai</label>
  <div class="col-md-9">
    <select name="jenis_pegawai" id="jenis_pegawai" class="form-control" required>
      <option value="">Pilih jenis pegawai</option>
      <option value="PNS">PNS</option>
      <option value="CPNS">CPNS</option>
      <option value="PJLP">PJLP</option>
      <option value="Non PNS">Non PNS</option>
      <option value="Lainnya">Lainnya</option>
    </select>
  </div>
</div>

<div class="form-group row">
  <label class="col-md-3">Divisi</label>
  <div class="col-md-9">
    <select name="id_divisi" id="id_divisi" class="form-control" required>
      <option value="">Pilih divisi</option>
      @foreach($divisi as $divisi)
      <option value="{{ $divisi->id_divisi }}">{{ $divisi->nama_divisi }}</option>
      @endforeach
    </select>
  </div>
</div>

<div class="form-group row">
  <label class="col-md-3">TMT Masuk</label>
  <div class="col-md-9">
    <input type="text" name="tmt_masuk" class="form-control datepicker" placeholder="HH-BB-TTTT" value="{{ old('tmt_masuk') }}" readonly="" required>
  </div>
</div>

<div class="form-group row">
  <label class="col-md-3">Keterangan</label>
  <div class="col-md-9">
    <textarea name="keterangan" id="keterangan" class="form-control" rows="5" placeholder="Keterangan">{{ old('keterangan') }}</textarea>
  </div>
</div>



<div class="form-group row">
  <label class="col-md-3">Status Pegawai</label>
  <div class="col-md-9">
    <select name="status_pegawai" id="status_pegawai" class="form-control" required>
      <option value="">Pilih status pegawai</option>
      <option value="Aktif">Aktif</option>
      <option value="Non Aktif">Non Aktif</option>
      <option value="Pensiun">Pensiun</option>
      <option value="Mati">Mati</option>
    </select>
  </div>
</div>

<div class="form-group row">
  <label class="col-md-3">Upload Foto</label>
  <div class="col-md-9">
    <input type="file" name="foto" class="form-control">
  </div>
</div>

<div class="form-group row">
  <label class="col-md-3"></label>
  <div class="col-md-9">

    <a href="{{ asset('admin/pegawai') }}" class="btn btn-secondary">
      <i class="fa fa-arrow-left"></i> Kembali
    </a>

    <button type="submit" class="btn btn-primary">Simpan</button>
  </div>
</div>

</form>