<?php 
use Illuminate\Support\Facades\DB;
$site_config = DB::table('konfigurasi')->first();
?>
<!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center header-transparent">
    <div class="container d-flex align-items-center justify-content-between">

      <div class="logo">
        <h1><a href="{{ asset('/') }}"><span>
          <img src="{{ asset('assets/upload/image/'.$site_config->logo) }}" class="img img-fluid" alt="{{ $site_config->namaweb }}">
        </span></a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="{{ asset('/') }}">BERANDA</a></li>
          <li><a class="nav-link scrollto" href="{{ asset('tentang-aplikasi') }}">TENTANG APLIKASI</a></li>
          <li><a class="nav-link scrollto" href="{{ asset('panduan') }}">PANDUAN</a></li>
          <li><a class="nav-link scrollto" href="{{ asset('kontak') }}">KONTAK</a></li>

          <?php if(Session()->get('username') == '') { ?>
            <li><a class="nav-link scrollto text-warning" href="{{ asset('login') }}">LOGIN</a></li>
          <?php }else{ 
            
            if(Session()->get('akses_level')=='Pegawai') 
            {
              $dasbor = asset('pegawai/dasbor');
            }else{
              $dasbor = asset('admin/dasbor');
            }
            ?>
            <li><a class="nav-link scrollto text-warning" href="{{ $dasbor }}">
              <i class="fa fa-user"></i>&nbsp;<?php echo strtoupper(Session()->get('nama_lengkap')); ?>
            </a></li>
            <li><a class="nav-link scrollto text-warning" href="{{ asset('logout') }}">
              <i class="fa fa-sign-out-alt"></i>&nbsp;
            </a></li>
          <?php } ?>
          
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->