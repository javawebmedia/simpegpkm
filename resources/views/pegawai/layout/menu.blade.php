
<?php 
use Illuminate\Support\Facades\DB;
$site_config    = DB::table('konfigurasi')->first();
$id_pegawaix    = Session()->get('id_pegawai');
$menu_pegawaix  = DB::table('menu_pegawai')->where('id_pegawai',$id_pegawaix)->get();
?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="{{ asset('pegawai/dasbor') }}" class="brand-link">
    <img src="{{ asset('assets/upload/image/'.$site_config->icon) }}" alt="SIMPEG" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">{{ $site_config->singkatan }}</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->

           <li class="nav-item">
            <a href="{{ asset('pegawai/dasbor') }}" class="nav-link">
            <i class="fa-solid fa-house"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>

        <li class="nav-item">
            <a href="{{ asset('pegawai/dokumen') }}" class="nav-link">
            <i class="fa-regular fa-folder-open"></i>
            <p>
              Dokumen Pegawai
            </p>
          </a>
        </li>

        <?php foreach($menu_pegawaix as $menu_pegawaix) { ?>
          <li class="nav-item">
            <a href="{{ asset($menu_pegawaix->link) }}" class="nav-link">
            <i class="{{ $menu_pegawaix->icon }}"></i>
            <p>
              {{ $menu_pegawaix->nama_menu }}
            </p>
          </a>
        </li>
      <?php } ?>

        <li class="nav-item">
          <a href="{{ asset('pegawai/kinerja') }}" class="nav-link">
          <i class="fa-solid fa-file-signature"></i>
          <p>
            Input Kinerja Harian
          </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ asset('pegawai/kinerja/bulanan') }}" class="nav-link">
        <i class="fa-regular fa-pen-to-square"></i>
        <p>
          Data Kinerja Bulanan
        </p>
      </a>
    </li>

    <!-- pengajuan cuti -->
     <li class="nav-item">
        <a href="{{ asset('pegawai/cuti') }}" class="nav-link">
        <i class="fa-regular fa-calendar-days"></i>
        <p>
          Pengajuan Cuti
        </p>
      </a>
    </li>

     <li class="nav-item">
        <a href="{{ asset('pegawai/diklat') }}" class="nav-link">
        <i class="fa-solid fa-graduation-cap"></i>
        <p>
          Data Diklat
        </p>
      </a>
    </li>

    <?php 
    use App\Models\Atasan_model;
    $m_atas       = new Atasan_model();
    
    $atas         = $m_atas->pegawai($id_pegawaix);
          // kalau statusnya atasan, maka menu keluar
    if($atas) {
      ?>

      <li class="nav-item">
        <a href="{{ asset('pegawai/kinerja/approval') }}" class="nav-link">
        <i class="fa-solid fa-clipboard-check"></i>
        <p>
          Approval Kinerja
        </p>
      </a>
    </li>

  <?php } ?>

    <?php 
    use App\Models\Pegawai_model;
    $nip   = Session()->get('nip');
    // kalau statusnya atasan, maka menu keluar
    
    if($nip =='199007042019032015') { ?>

      <li class="nav-item">
          <a href="{{ asset('pegawai/diklat/approval') }}" class="nav-link">
          <i class="fa-solid fa-file-circle-check"></i>
          <p>
            Approval Diklat
          </p>
        </a>
      </li>

    <?php } ?>


  <li class="nav-item">
    <a href="{{ asset('pegawai/aktivitas-utama') }}" class="nav-link">
    <i class="fa-solid fa-arrows-to-circle"></i>  
    <p>
      Rencana Kinerja
    </p>
  </a>
</li>

<li class="nav-item">
  <a href="{{ asset('pegawai/gaji') }}" class="nav-link">
  <i class="fa-solid fa-rupiah-sign"></i>
  <p>
    Gaji dan TKD
  </p>
</a>
</li>

<li class="nav-item">
  <a href="{{ asset('pegawai/pegawai/riwayat') }}" class="nav-link">
  <i class="fa-regular fa-user"></i>
  <p>
   Profil dan Riwayat
 </p>
</a>
</li>

<li class="nav-item">
  <a href="{{ asset('pegawai/str-sip') }}" class="nav-link">
  <i class="fa-regular fa-newspaper"></i>
  <p>
   Riwayat STR &amp; SIP
 </p>
</a>
</li>

</ul>
</nav>
<!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <h1>{{ $title }}</h1>
        </div>

      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">{{ $title }}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">