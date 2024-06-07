@if($errors->any())
<div class="alert alert-danger">
  <ul>
      @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
      @endforeach
  </ul>
</div>
@endif

<form action="{{ asset('admin/diklat/proses-tambah') }}" method="post" accept-charset="utf-8" enctype="multipart/form-data">
  {{ csrf_field() }}

      <div class="form-group row">
        <label class="col-md-3">Pilih Pegawai &amp; Status Diklat</label>
        <div class="col-md-7">
          <select name="nip" class="form-control select2" required>
            <option value="">Pilih pegawai</option>
            <?php foreach($pegawai as $pegawai) { ?>
              <option value="<?php echo $pegawai->nip ?>">
                <?php echo $pegawai->nama_lengkap ?> - NIP: <?php echo $pegawai->nip ?>
              </option>
            <?php } ?>
          </select>
        </div>
        <div class="col-md-2">
          <select name="status_diklat" class="form-control">
            <option value="Disetujui">Disetujui</option>
            <option value="Menunggu">Menunggu</option>
            <option value="Ditolak">Ditolak</option>
          </select>
        </div>
      </div>

      <div class="form-group row">
        <label class="col-md-3">Jenis Metode Diklat</label>
        <div class="col-md-4">
          <select name="jenis_metode" id="jenis_metode" class="form-control" required>
            <option value="">Pilih Metode</option>
              <?php foreach($jenis_metode as $jenis_metode) { ?>
                <option value="<?php echo $jenis_metode->jenis_metode ?>" >
                  <?php echo $jenis_metode->jenis_metode ?>
                </option>
              <?php } ?>
          </select>
        </div>

        <div class="col-md-5">
          <select name="id_metode_diklat" id="id_metode_diklat" class="form-control" required>
            <option value="">Pilih Jenis Metode</option>
              <?php foreach($metode_diklat as $metode_diklat) { ?>
                <option value="<?php echo $metode_diklat->id_metode_diklat ?>" class="<?php echo $metode_diklat->jenis_metode ?>">
                  <?php echo $metode_diklat->nama_metode_diklat ?>
                </option>
              <?php } ?>
          </select>
        </div>
      </div>

      <script>
        $("#id_metode_diklat").chained("#jenis_metode");
      </script>

        <div class="form-group row">
        <label class="col-md-3">Rumpun dan Jenis Diklat</label>
        <div class="col-md-4">
          <select name="id_rumpun" class="form-control" id="id_rumpun" required>
                <option value="">Pilih Rumpun</option>
                <?php foreach($rumpun as $rumpun2) { ?>
                <option value="<?php echo $rumpun2->id_rumpun ?>">
                  <?php echo $rumpun2->nama_rumpun ?>
                </option>
              <?php } ?>
          </select>
        </div>
     
        <div class="col-md-5">
            <select name="id_jenis_pelatihan" class="form-control" id="id_jenis_pelatihan" required>
              <option value="">Pilih Jenis Pelatihan</option>
              <?php foreach($jenis_pelatihan as $jenis_pelatihan) { ?>
              <option value="<?php echo $jenis_pelatihan->id_jenis_pelatihan ?>"  class="{{ $jenis_pelatihan->id_rumpun }}">
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
        <label class="col-md-3">Pilih Kode Diklat</small></label>
        <div class="col-md-9">
          <select name="id_kode_diklat" class="form-control" id="id_kode_diklat" required>
              <option value="">Pilih Kode Diklat</option>
              <?php foreach($kode_diklat as $kode_diklat) { ?>
                <option value="<?php echo $kode_diklat->id_kode_diklat ?>"  class="{{ $kode_diklat->id_jenis_pelatihan }}">
                  <?php echo $kode_diklat->kode_diklat ?> <?php echo $kode_diklat->nama_kode_diklat ?>
                </option>
              <?php } ?>
            </select>
        </div>
      </div>

      <script>
        $("#id_kode_diklat").chained("#id_jenis_pelatihan");
      </script>

      

      <div class="form-group row">
        <label class="col-md-3">Kategori Diklat</label>
        <div class="col-md-9">
          <select name="id_kategori_diklat" id="kategori_diklat" class="form-control" required>
            <option value="">Pilih Kategori Pengembangan Kompetensi</option>
              <?php foreach($kategori_diklat as $kategori_diklat) { ?>
                <option value="<?php echo $kategori_diklat->id_kategori_diklat ?>" >
                  <?php echo $kategori_diklat->nama_kategori_diklat ?>
                </option>
              <?php } ?>
          </select>
        </div>
      </div>

      <div class="form-group row">
        <label class="col-md-3">Nama Diklat</label>
        <div class="col-md-9">
          <input type="text" name="nama_diklat" class="form-control" placeholder="nama diklat" value="{{ old('nama_diklat') }}" required>
        </div>
      </div>

      <div class="form-group row">
        <label class="col-md-3">Tempat Pelaksanaan</label>
        <div class="col-md-9">
          <input type="text" name="tempat_pelaksanaan" class="form-control" placeholder="tempat pelaksanaan" value="{{ old('tempat_pelaksanaan') }}" required>
        </div>
      </div>

      <div class="form-group row">
        <label class="col-md-3">Tanggal Mulai &amp; Selesai</label>
        <div class="col-md-5">
          <input type="text" name="tanggal_awal" class="form-control datepicker" placeholder="Tanggal Mulai" value="{{ old('tanggal_awal') }}" readonly="" required>
        </div>
        <div class="col-md-4">
          <input type="text" name="tanggal_akhir" class="form-control datepicker" placeholder="Tanggal Selesai" value="{{ old('tanggal_akhir') }}" readonly="" required>
        </div>
      </div>

      <div class="form-group row">
        <label class="col-md-3">Durasi &amp; JPL</label>
        <div class="col-md-5">
          <input type="number" name="durasi" class="form-control" placeholder="durasi" value="{{ old('durasi') }}" required>
        </div>
        <div class="col-md-4">
        <input type="number" name="jpl" class="form-control" placeholder="Total JPL" value="{{ old('jpl') }}" required>
        </div>
      </div>

      <div class="form-group row">
        <label class="col-md-3">Nomor &amp; Tanggal Sertifikat/Surat Tugas</label>
        <div class="col-md-5">
          <input type="text" name="nomor_sertifikat" class="form-control" placeholder="Nomor Sertifikat/Surat Tugas" value="{{ old('nomor_sertifikat') }}" required>
        </div>

        <div class="col-md-4">
          <input type="text" name="tanggal_sertifikat" class="form-control datepicker" placeholder="Tanggal Sertifikat" value="{{ old('tanggal_sertifikat') }}" readonly="" required>
        </div>
      </div>

      <div class="form-group row">
        <label class="col-md-3">Upload Sertifikat</label>
        <div class="col-md-9">
          <input type="file" name="sertifikat" class="form-control">
        </div>
      </div>

  <div class="form-group row">
    <label class="col-md-3"></label>
    <div class="col-md-9">
    <a href="{{ asset('admin/diklat') }}" class="btn btn-secondary">
      <i class="fa fa-arrow-left"></i> Kembali
    </a>
      <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
  </div>

</form>

