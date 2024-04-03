<div class="row">
  <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box">
      <span class="info-box-icon bg-info elevation-1"><i class="fas fa-calendar-check"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Kuota Cuti</span>
        <span class="info-box-number">
          <?php if($kuota_cuti) { echo $kuota_cuti->kuota; }else{ echo 0; } ?>
          <small>Hari</small>
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>

  <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box">
      <span class="info-box-icon bg-info elevation-1"><i class="fas fa-check-circle"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Cuti Digunakan</span>
        <span class="info-box-number">
          <?php if($kuota_cuti) { echo $kuota_cuti->kuota; }else{ echo 0; } ?>
          <small>Hari</small>
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>


  <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box">
      <span class="info-box-icon bg-info elevation-1"><i class="fas fa-plus-circle"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Sisa Cuti</span>
        <span class="info-box-number">
          <?php if($kuota_cuti) { echo $kuota_cuti->kuota; }else{ echo 0; } ?>
          <small>Hari</small>
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>

  <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box">
      <span class="info-box-icon bg-info elevation-1"><i class="fas fa-clock"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Status Pengajuan</span>
        <span class="info-box-number">
          <?php if($kuota_cuti) { echo $kuota_cuti->kuota; }else{ echo 0; } ?>
          <small>Hari</small>
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>

</div>


<div class="row mb-2">

  <div class="col-md-12 mb-2">

    <form action="{{ asset('pegawai/cuti') }}" method="get" accept-charset="utf-8" class="alert alert-light">
      {{ csrf_field() }}

      <div class="input-group">

              <select name="id_jenis_cuti" class="form-control" required>

                <option value="">Pilih Jenis Cuti</option>
                <?php foreach($jenis_cuti as $jenis_cuti) { ?>
                <option value="<?php echo $jenis_cuti->id_jenis_cuti ?>">
                  <?php echo $jenis_cuti->nama_jenis_cuti ?>
                </option>}
                <?php } ?>

              </select>

             <input type="number" name="total_hari" class="form-control" placeholder="Total hari cuti" value="<?php echo old('total_hari') ?>" min="1" max="<?php if($kuota_cuti) { echo $kuota_cuti->kuota; }else{ echo 0; } ?>" required>

              <span class="input-group-append">
                <button type="submit" name="cari" value="cari" class="btn btn-dark"><i class="fa fa-edit"></i> Ajukan Cuti</button>
                
              </span>
            </div>

    </form>
  </div>
  
</div>

<table class="table table-bordered table-sm mt-3">
  <thead>
    <tr>
      <th>No</th>
      <th>Tahun</th>
      <th>Tanggal Pengajuan</th>
      <th>Tanggal Cuti</th>
      <th>Total Hari</th>
      <th>Status Pengajuan</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>data</td>
      <td>data</td>
      <td>data</td>
      <td>data</td>
      <td>data</td>
      <td>data</td>
    </tr>
  </tbody>
</table>
