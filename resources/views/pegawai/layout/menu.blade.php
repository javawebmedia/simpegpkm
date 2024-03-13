
<?php 
use Illuminate\Support\Facades\DB;
$site_config = DB::table('konfigurasi')->first();
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
              <lord-icon
              src="https://cdn.lordicon.com/rnuzkjnk.json"
              trigger="loop"
              style="width:40px;height:40px">
            </lord-icon>
            <p>
              Dashboard
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ asset('pegawai/kinerja') }}" class="nav-link">
            <lord-icon
            src="https://cdn.lordicon.com/rfbqeber.json"
            trigger="loop"
            state="loop"
            style="width:40px;height:40px">
          </lord-icon>
          <p>
            Input Kinerja Harian
          </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ asset('pegawai/kinerja/bulanan') }}" class="nav-link">
          <lord-icon
          src="https://cdn.lordicon.com/ckatldkn.json"
          trigger="loop"
          style="width:40px;height:40px">
        </lord-icon>
        <p>
          Data Kinerja Bulanan
        </p>
      </a>
    </li>

    <?php 
    use App\Models\Atasan_model;
    $m_atas       = new Atasan_model();
    $id_pegawai   = Session()->get('id_pegawai');
    $atas         = $m_atas->pegawai($id_pegawai);
          // kalau statusnya atasan, maka menu keluar
    if($atas) {
      ?>

      <li class="nav-item">
        <a href="{{ asset('pegawai/kinerja/approval') }}" class="nav-link">
          <lord-icon
          src="https://cdn.lordicon.com/hrqqslfe.json"
          trigger="loop"
          style="width:40px;height:40px">
        </lord-icon>
        <p>
          Approval Kinerja
        </p>
      </a>
    </li>

  <?php } ?>


  <li class="nav-item">
    <a href="{{ asset('pegawai/aktivitas-utama') }}" class="nav-link">
      <lord-icon
      src="https://cdn.lordicon.com/pjibjvxa.json"
      trigger="loop"
      style="width:40px;height:40px">
    </lord-icon>
    <p>
      Rencana Kinerja
    </p>
  </a>
</li>

<li class="nav-item">
  <a href="{{ asset('pegawai/gaji') }}" class="nav-link">
    <lord-icon
    src="https://cdn.lordicon.com/qmcsqnle.json"
    trigger="loop"
    style="width:40px;height:40px">
  </lord-icon>
  <p>
    Gaji dan TKD
  </p>
</a>
</li>

<li class="nav-item">
  <a href="{{ asset('pegawai/pegawai/riwayat') }}" class="nav-link">
    <lord-icon
    src="https://cdn.lordicon.com/dxoycpzg.json"
    trigger="loop"
    colors="primary:#f24c00,secondary:#646e78,tertiary:#4bb3fd,quaternary:#ebe6ef,quinary:#f9c9c0"
    state="loop"
    style="width:40px;height:40px">
  </lord-icon>
  <p>
   Profil dan Riwayat
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