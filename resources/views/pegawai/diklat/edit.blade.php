@if($errors->any())
<div class="alert alert-danger">
  <ul>
      @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
      @endforeach
  </ul>
</div>
@endif

<form action="{{ asset('pegawai/diklat/proses-edit') }}" method="post" accept-charset="utf-8" enctype="multipart/form-data">
  {{ csrf_field() }}

  <input type="hidden" name="id_diklat" value="<?php echo $diklat->id_diklat ?>">


      <div class="form-group row">
        <label class="col-md-3">Jenis Metode Diklat</label>
        <div class="col-md-4">
          <select name="jenis_metode" id="jenis_metode" class="form-control" required>
            <option value="">Pilih Metode</option>
              <?php foreach($jenis_metode as $jenis_metode) { ?>
                <option value="<?php echo $jenis_metode->jenis_metode ?>"  <?php if($diklat->jenis_metode==$jenis_metode->jenis_metode) { echo 'selected'; } ?>>
                  <?php echo $jenis_metode->jenis_metode ?>
                </option>
              <?php } ?>
          </select>
        </div>

        <div class="col-md-5">
          <select name="id_metode_diklat" id="id_metode_diklat" class="form-control" required>
            <option value="">Pilih Jenis Metode</option>
              <?php foreach($metode_diklat as $metode_diklat) { ?>
                <option value="<?php echo $metode_diklat->id_metode_diklat ?>" class="<?php echo $metode_diklat->jenis_metode ?>"  <?php if($diklat->id_metode_diklat==$metode_diklat->id_metode_diklat) { echo 'selected'; } ?>>
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
        <label class="col-md-3">Pilih Kode Diklat</small></label>
        <div class="col-md-9">
          <select name="id_kode_diklat" class="form-control select2" id="id_kode_diklat" required>
              <option value="">Pilih Kode Diklat</option>
              <?php foreach($kode_diklat as $kode_diklat) { ?>
                <option value="<?php echo $kode_diklat->id_kode_diklat ?>"  class="{{ $kode_diklat->id_jenis_pelatihan }}" <?php if($diklat->id_kode_diklat==$kode_diklat->id_kode_diklat) { echo 'selected'; } ?>>
                  <?php echo $kode_diklat->kode_diklat ?> <?php echo $kode_diklat->nama_kode_diklat ?> 
                  (<?php echo $kode_diklat->nama_jenis_pelatihan ?> - <?php echo $kode_diklat->nama_rumpun ?>)
                </option>
              <?php } ?>
            </select>
        </div>
      </div>


      

      <div class="form-group row">
        <label class="col-md-3">Kategori Diklat</label>
        <div class="col-md-9">
          <select name="id_kategori_diklat" id="kategori_diklat" class="form-control" required>
            <option value="">Pilih Kategori Pengembangan Kompetensi</option>
              <?php foreach($kategori_diklat as $kategori_diklat) { ?>
                <option value="<?php echo $kategori_diklat->id_kategori_diklat ?>" <?php if($diklat->id_kategori_diklat==$kategori_diklat->id_kategori_diklat) { echo 'selected'; } ?>>
                  <?php echo $kategori_diklat->nama_kategori_diklat ?>
                </option>
              <?php } ?>
          </select>
        </div>
      </div>

      <div class="form-group row">
        <label class="col-md-3">Nama Diklat</label>
        <div class="col-md-9">
          <input type="text" name="nama_diklat" class="form-control" placeholder="nama diklat" value="{{ $diklat->nama_diklat }}" required>
        </div>
      </div>

      <div class="form-group row">
        <label class="col-md-3">Tempat Pelaksanaan</label>
        <div class="col-md-9">
          <input type="text" name="tempat_pelaksanaan" class="form-control" placeholder="tempat pelaksanaan" value="{{ $diklat->tempat_pelaksanaan }}" required>
        </div>
      </div>

      <div class="form-group row">
        <label class="col-md-3">Tanggal Mulai &amp; Selesai</label>
        <div class="col-md-5">
          <input type="text" name="tanggal_awal" class="form-control datepicker" placeholder="Tanggal Mulai" value="{{ date('d-m-Y',strtotime($diklat->tanggal_awal)); }}" readonly="" required>
        </div>
        <div class="col-md-4">
          <input type="text" name="tanggal_akhir" class="form-control datepicker" placeholder="Tanggal Selesai" value="{{ date('d-m-Y',strtotime($diklat->tanggal_akhir)); }}" readonly="" required>
        </div>
      </div>

      <div class="form-group row">
        <label class="col-md-3">Durasi &amp; JPL</label>
        <div class="col-md-5">
          <input type="number" name="durasi" class="form-control" placeholder="durasi" value="{{ $diklat->durasi }}" required>
        </div>
        <div class="col-md-4">
        <input type="number" name="jpl" class="form-control" placeholder="Total JPL" value="{{ $diklat->jpl }}" required>
        </div>
      </div>

      <div class="form-group row">
        <label class="col-md-3">Nomor &amp; Tanggal Sertifikat/Surat Tugas</label>
        <div class="col-md-5">
          <input type="text" name="nomor_sertifikat" class="form-control" placeholder="Nomor Sertifikat/Surat Tugas" value="{{ $diklat->nomor_sertifikat }}" required>
        </div>

        <div class="col-md-4">
          <input type="text" name="tanggal_sertifikat" class="form-control datepicker" placeholder="Tanggal Sertifikat" value="{{ date('d-m-Y',strtotime($diklat->tanggal_sertifikat)); }}" readonly="" required>
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
    <a href="{{ asset('pegawai/diklat') }}" class="btn btn-secondary">
      <i class="fa fa-arrow-left"></i> Kembali
    </a>
      <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
  </div>

</form>

