<?php 
use Illuminate\Support\Facades\DB;
$site_config = DB::table('konfigurasi')->first();
?>
<?php 
use App\Models\Dasbor_model;
$m_dasbor       = new Dasbor_model();
$total_pegawai  = $m_dasbor->pegawai();
?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-teal elevation-4">
  <!-- Brand Logo -->
  <a href="{{ asset('admin/dasbor') }}" class="brand-link">
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

           <!-- dashboard -->
           <li class="nav-item">
            <a href="{{ asset('admin/dasbor') }}" class="nav-link">
              <!-- <i class="nav-icon fas fa-tachometer-alt"></i> -->
              <lord-icon
              src="https://cdn.lordicon.com/hftgdgfo.json"
              trigger="hover"
              style="width:30px;height:30px">
            </lord-icon>
            <p>
              Dashboard Aplikasi
            </p>
          </a>
        </li>

        <!-- Absensi -->
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <lord-icon
            src="https://cdn.lordicon.com/lzgqzxrq.json"
            trigger="hover"
            style="width:30px;height:30px">
          </lord-icon>
          <p>
            Data Absensi
            <i class="fas fa-angle-left right"></i>

          </p>
        </a>
        <ul class="nav nav-treeview">
          
          <li class="nav-item"><a href="{{ asset('admin/kehadiran') }}" class="nav-link"><i class="fas fa-tools nav-icon"></i><p>Data Kehadiran</p></a>
          </li>

          <li class="nav-item"><a href="{{ asset('admin/jadwal-pegawai') }}" class="nav-link"><i class="fas fa-tools nav-icon"></i><p>Data Jadwal Kerja</p></a>
          </li>

          <li class="nav-item"><a href="{{ asset('admin/data-finger') }}" class="nav-link"><i class="fas fa-tools nav-icon"></i><p>Data Rekaman Kehadiran</p></a>
          </li>

          <li class="nav-item"><a href="{{ asset('admin/mesin-absen') }}" class="nav-link"><i class="fas fa-tools nav-icon"></i><p>Mesin Absen</p></a>
          </li>
          <li class="nav-item"><a href="{{ asset('admin/shift') }}" class="nav-link"><i class="fas fa-tools nav-icon"></i><p>Data Master Shift</p></a>
          </li>

        </ul>
      </li>

        <!-- cuti -->
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <lord-icon
            src="https://cdn.lordicon.com/tsnvgrkp.json"
            trigger="hover"
            style="width:30px;height:30px">
          </lord-icon>
          <p>
            Data Cuti
            <i class="fas fa-angle-left right"></i>

          </p>
        </a>
        <ul class="nav nav-treeview">
          
          <li class="nav-item"><a href="{{ asset('admin/cuti/status/Pengajuan') }}" class="nav-link"><i class="fas fa-tools nav-icon"></i><p>Data Pengajuan Cuti</p></a>
          </li>

          <li class="nav-item"><a href="{{ asset('admin/cuti') }}" class="nav-link"><i class="fas fa-tools nav-icon"></i><p>Data Cuti</p></a>
          </li>

          <li class="nav-item"><a href="{{ asset('admin/jenis-cuti') }}" class="nav-link"><i class="fas fa-file-pdf nav-icon"></i><p>Jenis Cuti</p></a>
          </li>

          <li class="nav-item"><a href="{{ asset('admin/libur') }}" class="nav-link"><i class="fa fa-home nav-icon"></i><p>Setting Tanggal Libur</p></a>
          </li>
          <li class="nav-item"><a href="{{ asset('admin/jenis-libur') }}" class="nav-link"><i class="fa fa-upload nav-icon"></i><p>Jenis Libur</p></a>
          </li>

          <li class="nav-item"><a href="{{ asset('admin/kuota-cuti') }}" class="nav-link"><i class="fa fa-upload nav-icon"></i><p>Kuota Cuti Pegawai</p></a>
          </li>
          
        </ul>
      </li>

        <li class="nav-item">
          <a href="{{ asset('admin/kinerja') }}" class="nav-link">
            <!-- <i class="nav-icon fas fa-book"></i> -->
            <lord-icon
            src="https://cdn.lordicon.com/eaawyrxp.json"
            trigger="hover"
            style="width:30px;height:30px">
          </lord-icon>
          <p>
            Kinerja Pegawai
          </p>
        </a>
      </li>

      <!-- Menu Pegawai -->
      <li class="nav-item">
        <a href="#" class="nav-link">
          <!-- <i class="nav-icon fas fa-shopping-cart"></i> -->
          <lord-icon
          src="https://cdn.lordicon.com/wvqpnihn.json"
          trigger="hover"
          style="width:30px;height:30px">
        </lord-icon>
        <p>
          Generate Gaji &amp; TKD
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="{{ asset('admin/gajian') }}" class="nav-link">
            <lord-icon
            src="https://cdn.lordicon.com/iifryyua.json"
            trigger="loop"
            colors="primary:#30c9e8"
            state="hover-1"
            style="width:20px;height:20px">
          </lord-icon></i>
          <p>Data TKD Pegawai</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ asset('admin/gajian/gaji') }}" class="nav-link">
          <lord-icon
          src="https://cdn.lordicon.com/iifryyua.json"
          trigger="loop"
          colors="primary:#30c9e8"
          state="hover-1"
          style="width:20px;height:20px">
        </lord-icon></i>
        <p>Data Gaji Pegawai</p>
      </a>
    </li>


  </ul>
</li>

<!-- Menu Pegawai -->
<li class="nav-item">
  <a href="#" class="nav-link">
    <!-- <i class="nav-icon fas fa-users"></i> -->
    <lord-icon
    src="https://cdn.lordicon.com/ljvjsnvh.json"
    trigger="hover"
    style="width:30px;height:30px">
  </lord-icon>
  <p>
    Data Pegawai
    <i class="right fas fa-angle-left"></i>
    <span class="right badge badge-danger"><?php echo $total_pegawai ?></span>
  </p>
</a>
<ul class="nav nav-treeview">
  <li class="nav-item">
    <a href="{{ asset('admin/pegawai') }}" class="nav-link">
      <lord-icon
      src="https://cdn.lordicon.com/iifryyua.json"
      trigger="loop"
      colors="primary:#30c9e8"
      state="hover-1"
      style="width:20px;height:20px">
    </lord-icon></i>
    <p>Data Pegawai</p>
  </a>
</li>
<li class="nav-item">
  <a href="{{ asset('admin/pegawai/tambah') }}" class="nav-link">
    <lord-icon
    src="https://cdn.lordicon.com/iifryyua.json"
    trigger="loop"
    colors="primary:#30c9e8"
    state="hover-1"
    style="width:20px;height:20px">
  </lord-icon></i>
  <p>Tambah Pegawai Baru</p>
</a>
</li>
<li class="nav-item">
  <a href="{{ asset('admin/pegawai/import') }}" class="nav-link">
    <lord-icon
    src="https://cdn.lordicon.com/iifryyua.json"
    trigger="loop"
    colors="primary:#30c9e8"
    state="hover-1"
    style="width:20px;height:20px">
  </lord-icon></i>
  <p>Import Data Pegawai</p>
</a>
</li>

</ul>
</li>

<!-- Menu Gaji dan Absensi -->
<li class="nav-item">
  <a href="#" class="nav-link">
    <!-- <i class="nav-icon fas fa-calendar-check"></i> -->
    <lord-icon
    src="https://cdn.lordicon.com/nqwqiffl.json"
    trigger="hover"
    style="width:30px;height:30px">
  </lord-icon>
  <p>
    Data Gaji dan Absensi
    <i class="right fas fa-angle-left"></i>
  </p>
</a>
<ul class="nav nav-treeview">
  <li class="nav-item">
    <a href="{{ asset('admin/gaji') }}" class="nav-link">
      <lord-icon
      src="https://cdn.lordicon.com/iifryyua.json"
      trigger="loop"
      colors="primary:#30c9e8"
      state="hover-1"
      style="width:20px;height:20px">
    </lord-icon></i>
    <p>Riwayat Gaji Pegawai</p>
  </a>
</li>
<li class="nav-item">
  <a href="{{ asset('admin/periode') }}" class="nav-link">
    <lord-icon
    src="https://cdn.lordicon.com/iifryyua.json"
    trigger="loop"
    colors="primary:#30c9e8"
    state="hover-1"
    style="width:20px;height:20px">
  </lord-icon></i>
  <p>Periode Gaji Pegawai</p>
</a>
</li>
<li class="nav-item">
  <a href="{{ asset('admin/absensi') }}" class="nav-link">
    <lord-icon
    src="https://cdn.lordicon.com/iifryyua.json"
    trigger="loop"
    colors="primary:#30c9e8"
    state="hover-1"
    style="width:20px;height:20px">
  </lord-icon></i>
  <p>Riwayat Absensi Pegawai</p>
</a>
</li>
</ul>
</li>

<!-- Menu Master Ekin -->
<li class="nav-item">
  <a href="#" class="nav-link">
    <!-- <i class="nav-icon fas fa-check-circle"></i> -->
    <lord-icon
    src="https://cdn.lordicon.com/xqgancly.json"
    trigger="hover"
    style="width:30px;height:30px">
  </lord-icon>
  <p>
    Master eKinerja
    <i class="right fas fa-angle-left"></i>
  </p>
</a>
<ul class="nav nav-treeview">
  <li class="nav-item">
    <a href="{{ asset('admin/aktivitas') }}" class="nav-link">
      <lord-icon
      src="https://cdn.lordicon.com/iifryyua.json"
      trigger="loop"
      colors="primary:#30c9e8"
      state="hover-1"
      style="width:20px;height:20px">
    </lord-icon></i>
    <p>Aktivitas Umum</p>
  </a>
</li>
             <!--  <li class="nav-item">
                <a href="{{ asset('admin/jabatan') }}" class="nav-link">
                  <lord-icon
    src="https://cdn.lordicon.com/iifryyua.json"
    trigger="loop"
    colors="primary:#30c9e8"
    state="hover-1"
    style="width:20px;height:20px">
</lord-icon></i>
                  <p>Aktivitas Utama</p>
                </a>
              </li> -->
              <li class="nav-item">
                <a href="{{ asset('admin/satuan') }}" class="nav-link">
                  <lord-icon
                  src="https://cdn.lordicon.com/iifryyua.json"
                  trigger="loop"
                  colors="primary:#30c9e8"
                  state="hover-1"
                  style="width:20px;height:20px">
                </lord-icon></i>
                <p>Master Satuan Output</p>
              </a>
            </li>
          </ul>
        </li>

        <!-- Menu Master -->
        <li class="nav-item">
          <a href="#" class="nav-link">
            <!-- <i class="nav-icon fas fa-tasks"></i> -->
            <lord-icon
            src="https://cdn.lordicon.com/hursldrn.json"
            trigger="hover"
            style="width:30px;height:30px">
          </lord-icon>
          <p>
            Master Data
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ asset('admin/divisi') }}" class="nav-link">
              <lord-icon
              src="https://cdn.lordicon.com/iifryyua.json"
              trigger="loop"
              colors="primary:#30c9e8"
              state="hover-1"
              style="width:20px;height:20px">
            </lord-icon></i>
            <p>Data Divisi</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ asset('admin/jabatan') }}" class="nav-link">
            <lord-icon
            src="https://cdn.lordicon.com/iifryyua.json"
            trigger="loop"
            colors="primary:#30c9e8"
            state="hover-1"
            style="width:20px;height:20px">
          </lord-icon></i>
          <p>Data Jabatan</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ asset('admin/pangkat') }}" class="nav-link">
          <lord-icon
          src="https://cdn.lordicon.com/iifryyua.json"
          trigger="loop"
          colors="primary:#30c9e8"
          state="hover-1"
          style="width:20px;height:20px">
        </lord-icon></i>
        <p>Data Pangkat</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ asset('admin/jenjang-pendidikan') }}" class="nav-link">
        <lord-icon
        src="https://cdn.lordicon.com/iifryyua.json"
        trigger="loop"
        colors="primary:#30c9e8"
        state="hover-1"
        style="width:20px;height:20px">
      </lord-icon></i>
      <p>Data Jenjang Pendidikan</p>
    </a>
  </li>
  <li class="nav-item">
    <a href="{{ asset('admin/agama') }}" class="nav-link">
      <lord-icon
      src="https://cdn.lordicon.com/iifryyua.json"
      trigger="loop"
      colors="primary:#30c9e8"
      state="hover-1"
      style="width:20px;height:20px">
    </lord-icon></i>
    <p>Data Agama</p>
  </a>
</li>
<li class="nav-item">
  <a href="{{ asset('admin/pekerjaan') }}" class="nav-link">
    <lord-icon
    src="https://cdn.lordicon.com/iifryyua.json"
    trigger="loop"
    colors="primary:#30c9e8"
    state="hover-1"
    style="width:20px;height:20px">
  </lord-icon></i>
  <p>Data Pekerjaan</p>
</a>
</li>
<li class="nav-item">
  <a href="{{ asset('admin/hubungan-keluarga') }}" class="nav-link">
    <lord-icon
    src="https://cdn.lordicon.com/iifryyua.json"
    trigger="loop"
    colors="primary:#30c9e8"
    state="hover-1"
    style="width:20px;height:20px">
  </lord-icon></i>
  <p>Data Hubungan Keluarga</p>
</a>
</li>
</ul>
</li>
<!--           <li class="nav-item">
            <a href="{{ asset('admin/pegawai') }}" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Data Pegawai
                <span class="right badge badge-danger"><?php echo $total_pegawai ?></span>
              </p>
            </a>
          </li> -->

          <li class="nav-item">
            <a href="{{ asset('admin/struktur') }}" class="nav-link">
              <!-- <i class="nav-icon fas fa-sitemap"></i> -->
              <lord-icon
              src="https://cdn.lordicon.com/yrxnwkni.json"
              trigger="hover"
              style="width:30px;height:30px">
            </lord-icon>
            <p>
              Setting Struktur
            </p>
          </a>
        </li>

        <!-- MENU -->
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <lord-icon
            src="https://cdn.lordicon.com/tsnvgrkp.json"
            trigger="hover"
            style="width:30px;height:30px">
          </lord-icon>
          <p>
            Konfigurasi
            <i class="fas fa-angle-left right"></i>

          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item"><a href="{{ asset('admin/konfigurasi') }}" class="nav-link"><i class="fas fa-tools nav-icon"></i><p>Konfigurasi Umum</p></a>
          </li>

          <li class="nav-item"><a href="{{ asset('admin/panduan') }}" class="nav-link"><i class="fas fa-file-pdf nav-icon"></i><p>Panduan Penggunaan Sistem</p></a>
          </li>

          <li class="nav-item"><a href="{{ asset('admin/konfigurasi/logo') }}" class="nav-link"><i class="fa fa-home nav-icon"></i><p>Ganti Logo</p></a>
          </li>
          <li class="nav-item"><a href="{{ asset('admin/konfigurasi/icon') }}" class="nav-link"><i class="fa fa-upload nav-icon"></i><p>Ganti Icon</p></a>
          </li>
          <li class="nav-item"><a href="{{ asset('admin/konfigurasi/email') }}" class="nav-link"><i class="fa fa-envelope nav-icon"></i><p>Email Setting</p></a>
          </li>
          <li class="nav-item"><a href="{{ asset('admin/konfigurasi/gambar') }}" class="nav-link"><i class="fas fa-book nav-icon"></i><p>Ganti Gambar Banner</p></a>
          </li>
        </ul>
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