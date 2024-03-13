@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ asset('admin/pegawai/proses-edit') }}" method="post" accept-charset="utf-8" enctype="multipart/form-data">
{{ csrf_field() }}

<input type="hidden" name="id_pegawai" value="{{ $pegawai->id_pegawai }}">

<div class="form-group row">
  <label class="col-md-3">Nama Lengkap</label>
  <div class="col-md-9">
    <input type="text" name="nama_lengkap" class="form-control" placeholder="Nama lengkap" value="{{ $pegawai->nama_lengkap }}" required>
  </div>
</div>

<div class="form-group row">
  <label class="col-md-3">Nama Panggilan</label>
  <div class="col-md-9">
    <input type="text" name="nama_panggilan" class="form-control" placeholder="Nama panggilan" value="{{ $pegawai->nama_panggilan }}">
  </div>
</div>

<div class="form-group row">
  <label class="col-md-3">NIP &amp; NRK</label>
  <div class="col-md-4">
    <input type="text" name="nip" class="form-control" placeholder="NIP" value="{{ $pegawai->nip }}" required>
    <small class="text-danger">Digunakan sebagai username.</small>
  </div>
  <div class="col-md-5">
    <input type="text" name="nrk" class="form-control" placeholder="NRK" value="{{ $pegawai->nrk }}" required>
  </div>
</div>

<div class="form-group row">
  <label class="col-md-3">Akses Level</label>
  <div class="col-md-4">
    <select name="akses_level" id="akses_level" class="form-control" required>
      <option value="">Pilih akses level</option>
      <option value="Admin" <?php if($pegawai->akses_level=='Admin') { echo 'selected'; } ?>>Admin</option>
      <option value="Pimpinan" <?php if($pegawai->akses_level=='Pimpinan') { echo 'selected'; } ?>>Pimpinan</option>
      <option value="User" <?php if($pegawai->akses_level=='User') { echo 'selected'; } ?>>User</option>
      <option value="Pegawai" <?php if($pegawai->akses_level=='Pegawai') { echo 'selected'; } ?>>Pegawai</option>
    </select>
    <small class="text-danger">Pilih hak akses pegawai</small>
  </div>

  <div class="col-md-5">
    <input type="text" name="password" class="form-control" placeholder="Password" value="{{ old('password') }}">
    <small class="text-danger">Minimal 6 dan maksimal 32 karakter, atau biarkan kosong jika tidak ingin mengganti password.</small>
  </div>
</div>

<div class="form-group row">
  <label class="col-md-3">NIK</label>
  <div class="col-md-9">
    <input type="text" name="nik" class="form-control" placeholder="NIK" value="{{ $pegawai->nik }}" required>
  </div>
</div>

<div class="form-group row">
  <label class="col-md-3">Gelar Depan &amp; Belakang</label>
  <div class="col-md-4">
    <input type="text" name="gelar_depan" class="form-control" placeholder="Gelar depan" value="{{ $pegawai->gelar_depan }}">
  </div>
  <div class="col-md-5">
    <input type="text" name="gelar_belakang" class="form-control" placeholder="Gelar belakang" value="{{ $pegawai->gelar_belakang }}">
  </div>
</div>

<div class="form-group row">
  <label class="col-md-3">NPWP dan Nomor Rekening</label>
  <div class="col-md-4">
    <input type="text" name="npwp" class="form-control" placeholder="NPWP" value="{{ $pegawai->npwp }}">
  </div>
  <div class="col-md-5">
    <input type="text" name="rekening" class="form-control" placeholder="Nomor Rekening" value="{{ $pegawai->rekening }}">
  </div>
</div>

<div class="form-group row">
  <label class="col-md-3">Tempat &amp; Tanggal Lahir</label>
  <div class="col-md-4">
    <input type="text" name="tempat_lahir" class="form-control" placeholder="Tempat lahir" value="{{ $pegawai->tempat_lahir }}" required>
  </div>
  <div class="col-md-5">
    <input type="text" name="tanggal_lahir" class="form-control datepicker" placeholder="HH-BB-TTTT" value="{{ date('d-m-Y',strtotime($pegawai->tanggal_lahir)) }}" readonly="" required>
  </div>
</div>

<div class="form-group row">
  <label class="col-md-3">Jenis Kelamin</label>
  <div class="col-md-9">
    <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
      <option value="">Pilih jenis kelamin</option>
      <option value="L" <?php if($pegawai->jenis_kelamin=='L') { echo 'selected'; } ?>>Laki-laki</option>
      <option value="P" <?php if($pegawai->jenis_kelamin=='P') { echo 'selected'; } ?>>Perempuan</option>
    </select>
  </div>
</div>

<div class="form-group row">
  <label class="col-md-3">Agama</label>
  <div class="col-md-9">
    <select name="id_agama" id="id_agama" class="form-control" required>
      <option value="">Pilih agama</option>
      @foreach($agama as $agama)
      <option value="{{ $agama->id_agama }}" <?php if($pegawai->id_agama==$agama->id_agama) { echo 'selected'; } ?>>{{ $agama->nama_agama }}</option>
      @endforeach
    </select>
  </div>
</div>

<div class="form-group row">
  <label class="col-md-3">Status Perkawinan</label>
  <div class="col-md-9">
    <select name="status_perkawinan" id="status_perkawinan" class="form-control" required>
      <option value="">Pilih status perkawinan</option>
      <option value="Belum Menikah" <?php if($pegawai->status_perkawinan=='Belum Menikah') { echo 'selected'; } ?>>Belum Menikah</option>
      <option value="Menikah" <?php if($pegawai->status_perkawinan=='Menikah') { echo 'selected'; } ?>>Menikah</option>
      <option value="Cerai Hidup" <?php if($pegawai->status_perkawinan=='Cerai Hidup') { echo 'selected'; } ?>>Cerai Hidup</option>
      <option value="Cerai Mati" <?php if($pegawai->status_perkawinan=='Cerai Mati') { echo 'selected'; } ?>>Cerai Mati</option>
    </select>
  </div>
</div>

<div class="form-group row">
  <label class="col-md-3">No Telepon</label>
  <div class="col-md-9">
    <input type="text" name="telepon" class="form-control" placeholder="No Telepon" value="{{ $pegawai->telepon }}" required>
  </div>
</div>

<div class="form-group row">
  <label class="col-md-3">Email</label>
  <div class="col-md-9">
    <input type="text" name="email" class="form-control" placeholder="Email" value="{{ $pegawai->email }}">
  </div>
</div>

<div class="form-group row">
  <label class="col-md-3">Alamat</label>
  <div class="col-md-9">
    <textarea name="alamat" id="alamat" class="form-control" rows="5" placeholder="Alamat" required>{{ $pegawai->alamat }}</textarea>
  </div>
</div>
<div class="row"><div class="col-md-12"><hr></div></div>

<div class="form-group row">
  <label class="col-md-3">Jenis Pegawai</label>
  <div class="col-md-9">
    <select name="jenis_pegawai" id="jenis_pegawai" class="form-control" required>
      <option value="">Pilih jenis pegawai</option>
      <option value="PNS" <?php if($pegawai->jenis_pegawai=='PNS') { echo 'selected'; } ?>>PNS</option>
      <option value="CPNS" <?php if($pegawai->jenis_pegawai=='CPNS') { echo 'selected'; } ?>>CPNS</option>
      <option value="PJLP" <?php if($pegawai->jenis_pegawai=='PJLP') { echo 'selected'; } ?>>PJLP</option>
      <option value="Non PNS" <?php if($pegawai->jenis_pegawai=='Non PNS') { echo 'selected'; } ?>>Non PNS</option>
      <option value="Lainnya" <?php if($pegawai->jenis_pegawai=='Lainnya') { echo 'selected'; } ?>>Lainnya</option>
    </select>
  </div>
</div>

<div class="form-group row">
  <label class="col-md-3">Divisi</label>
  <div class="col-md-9">
    <select name="id_divisi" id="id_divisi" class="form-control" required>
      <option value="">Pilih divisi</option>
      @foreach($divisi as $divisi)
      <option value="{{ $divisi->id_divisi }}"  <?php if($pegawai->id_divisi==$divisi->id_divisi) { echo 'selected'; } ?>>{{ $divisi->nama_divisi }}</option>
      @endforeach
    </select>
  </div>
</div>

<div class="form-group row">
  <label class="col-md-3">TMT Masuk</label>
  <div class="col-md-9">
    <input type="text" name="tmt_masuk" class="form-control datepicker" placeholder="HH-BB-TTTT" value="{{ date('d-m-Y',strtotime($pegawai->tmt_masuk)) }}" readonly="" required>
  </div>
</div>

<div class="form-group row">
  <label class="col-md-3">Keterangan</label>
  <div class="col-md-9">
    <textarea name="keterangan" id="keterangan" class="form-control" rows="5" placeholder="Keterangan">{{ $pegawai->keterangan }}</textarea>
  </div>
</div>



<div class="form-group row">
  <label class="col-md-3">Status Pegawai</label>
  <div class="col-md-9">
    <select name="status_pegawai" id="status_pegawai" class="form-control" required>
      <option value="">Pilih status pegawai</option>
      <option value="Aktif" <?php if($pegawai->status_pegawai=='Aktif') { echo 'selected'; } ?>>Aktif</option>
      <option value="Non Aktif" <?php if($pegawai->status_pegawai=='Non Aktif') { echo 'selected'; } ?>>Non Aktif</option>
      <option value="Pensiun" <?php if($pegawai->status_pegawai=='Pensiun') { echo 'selected'; } ?>>Pensiun</option>
      <option value="Mati" <?php if($pegawai->status_pegawai=='Mati') { echo 'selected'; } ?>>Mati</option>
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