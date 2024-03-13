<?php 
use App\Models\Dasbor_model;
$m_dasbor       = new Dasbor_model();
$total_pegawai  = $m_dasbor->pegawai();
$total_pns      = $m_dasbor->total_jenis_pegawai('PNS');
$total_non_pns  = $m_dasbor->total_jenis_pegawai('Non PNS');
$total_pjlp     = $m_dasbor->total_jenis_pegawai('PJLP');
$total_cpns     = $m_dasbor->total_jenis_pegawai('CPNS');
$total_lainnya  = $m_dasbor->total_jenis_pegawai('Lainnya');
?>
<!-- Info boxes -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-purple elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Semua Pegawai</span>
                <span class="info-box-number">
                  <?php echo $total_pegawai ?>
                  <small>Orang</small>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-fuchsia elevation-1"><i class="fas fa-thumbs-up"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Pegawai PNS</span>
                <span class="info-box-number"><?php echo $total_pns ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-teal elevation-1"><i class="fas fa-shopping-cart"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Pegawai Non PNS</span>
                <span class="info-box-number"><?php echo $total_non_pns ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-lightblue elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">PJLP</span>
                <span class="info-box-number"><?php echo $total_pjlp ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <hr>
        @include('admin/dasbor/grafik')
        