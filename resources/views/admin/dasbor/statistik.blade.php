<?php 
use App\Models\Dasbor_model;
$m_dasbor       = new Dasbor_model();
$total_pegawai  = $m_dasbor->pegawai();
$total_pns      = $m_dasbor->total_jenis_pegawai('PNS');
$total_p3k      = $m_dasbor->total_jenis_pegawai('P3K');
$total_non_pns  = $m_dasbor->total_jenis_pegawai('Non PNS');
$total_pjlp     = $m_dasbor->total_jenis_pegawai('PJLP');
$total_cpns     = $m_dasbor->total_jenis_pegawai('CPNS');
$total_lainnya  = $m_dasbor->total_jenis_pegawai('Lainnya');
?>
<script src="{{ asset('assets/amcharts5') }}/index.js"></script>
<script src="{{ asset('assets/amcharts5') }}/percent.js"></script>
<script src="{{ asset('assets/amcharts5') }}/themes/Animated.js"></script>
<!-- Info boxes -->
<div class="container">
  <div class="row justify-content-center text-center">
    <div class="col-12 col-sm-9 col-md-4">
      <div class="info-box mb-3">
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
    <div class="col-12 col-sm-9 col-md-4">
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
    <div class="col-12 col-sm-9 col-md-4">
      <div class="info-box mb-3">
        <span class="info-box-icon bg-fuchsia elevation-1"><i class="fas fa-thumbs-up"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Pegawai P3K</span>
          <span class="info-box-number"><?php echo $total_p3k ?></span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- fix for small devices only -->
    <div class="clearfix hidden-md-up"></div>
    <div class="col-12 col-sm-9 col-md-4">
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
    <div class="col-12 col-sm-9 col-md-4">
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
</div>
<!-- /.container -->

        <!-- /.row -->

        <hr>
<div class="row">
  <!-- 6 -->
  <div class="col-md-6">
    <div class="card">
      <div class="card-header bg-light">REKAP JENIS PEGAWAI</div>
      <div class="card-body">
         @include('admin/dasbor/grafik')
      </div>
    </div>
  </div>
  <!-- /6 -->
   <!-- 6 -->
  <div class="col-md-6">
    <div class="card">
      <div class="card-header bg-light">REKAP JPL DIKLAT PEGAWAI</div>
      <div class="card-body">
         @include('admin/dasbor/diklat')
      </div>
    </div>
  </div>
  <!-- /6 -->
</div>
       

        