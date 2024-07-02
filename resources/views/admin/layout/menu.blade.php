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
            <i class="fa-solid fa-house"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>

        <!-- statistik -->
        <li class="nav-item">
          <a href="{{ asset('admin/dasbor/statistik') }}" class="nav-link">
            <!-- <i class="nav-icon fas fa-tachometer-alt"></i> -->
            <i class="fa-solid fa-chart-pie"></i>
            <p>
              Statistik Pegawai
            </p>
          </a>
        </li>

        <!-- Menu Pegawai -->
         <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="fa-solid fa-print"></i>
            <p>
              Buat Laporan
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ asset('admin/laporan/diklat') }}" class="nav-link">
                <i class="fa-solid fa-angles-right"></i>
                <p>Data Diklat</p>
              </a>
            </li>
            
            <li class="nav-item">
              <a href="{{ asset('admin/laporan/keterlambatan') }}" class="nav-link">
                <i class="fa-solid fa-angles-right"></i>
                <p>Rekap Keterlambatan</p>
              </a>
            </li>
          </ul>
        </li>

        <hr style="text-align:center; border-top: solid thin #333;" class="mb-1 mt-1 w-100">

         <!-- Menu Pegawai -->
         <li class="nav-item">
          <a href="#" class="nav-link">
            <!-- <i class="nav-icon fas fa-users"></i> -->
            <i class="fa-solid fa-user-tie"></i>
            <p>
              Data Pegawai
              <i class="right fas fa-angle-left"></i>
              <span class="right badge badge-danger"><?php echo $total_pegawai ?></span>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ asset('admin/pegawai') }}" class="nav-link">
                <i class="fa-solid fa-angles-right"></i>
                <p>Data Pegawai</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ asset('admin/pegawai/tambah') }}" class="nav-link">
                <i class="fa-solid fa-angles-right"></i>
                <p>Tambah Pegawai Baru</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ asset('admin/pegawai/import') }}" class="nav-link">
                <i class="fa-solid fa-angles-right"></i>
                <p>Import Data Pegawai</p>
              </a>
            </li>
          </ul>
        </li>
        
        <!-- Menu Master -->
        <li class="nav-item">
          <a href="#" class="nav-link">
            <!-- <i class="nav-icon fas fa-tasks"></i> -->
            <i class="fa-solid fa-building-columns"></i>
            <p>
              Master Data Pegawai
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ asset('admin/divisi') }}" class="nav-link">
                <i class="fa-solid fa-angles-right"></i>
                <p>Data Divisi</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ asset('admin/jabatan') }}" class="nav-link">
                <i class="fa-solid fa-angles-right"></i>
                <p>Data Jabatan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ asset('admin/pangkat') }}" class="nav-link">
                <i class="fa-solid fa-angles-right"></i>
                <p>Data Pangkat</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ asset('admin/jenjang-pendidikan') }}" class="nav-link">
                <i class="fa-solid fa-angles-right"></i>
                <p>Data Jenjang Pendidikan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ asset('admin/agama') }}" class="nav-link">
                <i class="fa-solid fa-angles-right"></i>
                <p>Data Agama</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ asset('admin/pekerjaan') }}" class="nav-link">
                <i class="fa-solid fa-angles-right"></i>
                <p>Data Pekerjaan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ asset('admin/hubungan-keluarga') }}" class="nav-link">
                <i class="fa-solid fa-angles-right"></i>
                <p>Data Hubungan Keluarga</p>
              </a>
            </li>
          </ul>
        </li>

        <!-- dokumen -->
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="fa-regular fa-folder-open"></i>
            <p>
              Dokumen Pegawai
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item"><a href="{{ asset('admin/dokumen-pegawai') }}" class="nav-link"><i class="fa-solid fa-angles-right"></i>
                <p>Dokumen Pegawai</p>
              </a>
            </li>
            <li class="nav-item"><a href="{{ asset('admin/jenis-dokumen') }}" class="nav-link"><i class="fa-solid fa-angles-right"></i>
                <p>Jenis Dokumen</p>
              </a>
            </li>
          </ul>
        </li>

        <hr style="text-align:center; border-top: solid thin #333;" class="mb-1 mt-1 w-100">


        <li class="nav-item">
          <a href="{{ asset('admin/kinerja') }}" class="nav-link">
            <!-- <i class="nav-icon fas fa-sitemap"></i> -->
            <i class="fa-solid fa-file-signature"></i>
            <p>
             Data Kinerja Pegawai
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ asset('admin/struktur') }}" class="nav-link">
            <!-- <i class="nav-icon fas fa-sitemap"></i> -->
            <i class="fa-solid fa-users-gear"></i>
            <p>
             Setting Struktur
            </p>
          </a>
        </li>

        <!-- Menu Gaji Dan TKD -->
        <li class="nav-item">
          <a href="#" class="nav-link">
            <!-- <i class="nav-icon fas fa-shopping-cart"></i> -->
            <i class="fa-solid fa-user-clock"></i>
            <p>
              Data Absensi
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">

            <li class="nav-item"><a href="{{ asset('admin/jadwal-pegawai') }}" class="nav-link"><i class="fa-solid fa-angles-right "></i>
                <p>Data Jadwal Kerja</p>
              </a>
            </li>

            <li class="nav-item"><a href="{{ asset('admin/data-finger') }}" class="nav-link"><i class="fa-solid fa-angles-right"></i>
                <p>Data Rekaman Kehadiran</p>
              </a>
            </li>

            <li class="nav-item"><a href="{{ asset('admin/kehadiran') }}" class="nav-link"><i class="fa-solid fa-angles-right"></i>
                <p>Data Kehadiran</p>
              </a>
            </li>

            <li class="nav-item"><a href="{{ asset('admin/absensi') }}" class="nav-link"><i class="fa-solid fa-angles-right"></i>
                <p>Rekap Absensi Semua</p>
              </a>
            </li>

          </ul>
        </li>
        
        <!-- Menu Gaji Dan TKD -->
        <li class="nav-item">
          <a href="#" class="nav-link">
            <!-- <i class="nav-icon fas fa-shopping-cart"></i> -->
            <i class="fa-solid fa-rupiah-sign"></i>
            <p>
              Data Gaji &amp; TKD
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">

          <li class="nav-item">
              <a href="{{ asset('admin/periode') }}" class="nav-link">
                <i class="fa-solid fa-angles-right"></i>
                <p>Periode Gaji Pegawai</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ asset('admin/gaji') }}" class="nav-link">
                <i class="fa-solid fa-angles-right"></i>
                <p>Data Gaji &amp; TKD Pegawai</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ asset('admin/gajian/gaji') }}" class="nav-link">
                <i class="fa-solid fa-angles-right"></i>
                <p>Generate Gaji Pegawai</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ asset('admin/gajian') }}" class="nav-link">
                <i class="fa-solid fa-angles-right"></i>
                <p>Generate TKD Pegawai</p>
              </a>
            </li>

          </ul>
        </li>

        <!-- Master Absensi dan kinerja -->
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="fa-regular fa-calendar-check"></i>
            <p>
              Master Absen &amp; Kinerja
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">

            <li class="nav-item">
              <a href="{{ asset('admin/aktivitas') }}" class="nav-link">
                <i class="fas fa-tools nav-icon"></i>
                <p>Aktivitas Umum</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ asset('admin/satuan') }}" class="nav-link">
                <i class="fas fa-tools nav-icon"></i>
                <p>Master Satuan Output</p>
              </a>
            </li>

            <li class="nav-item"><a href="{{ asset('admin/mesin-absen') }}" class="nav-link"><i class="fas fa-tools nav-icon"></i>
                <p>Mesin Absen</p>
              </a>
            </li>

            <li class="nav-item"><a href="{{ asset('admin/shift') }}" class="nav-link"><i class="fas fa-tools nav-icon"></i>
                <p>Data Master Shift</p>
              </a>
            </li>

            <li class="nav-item"><a href="{{ asset('admin/status-absen') }}" class="nav-link"><i class="fas fa-tools nav-icon"></i>
                <p>Master Hadir/Absensi</p>
              </a>
            </li>

          </ul>
        </li>

        <hr style="text-align:center; border-top: solid thin #333;" class="mb-1 mt-1 w-100">

        <li class="nav-item">
          <a href="{{ asset('admin/asset') }}" class="nav-link">
            <!-- <i class="nav-icon fas fa-sitemap"></i> -->
            <i class="fa-solid fa-users-gear"></i>
            <p>
             Management Asset
            </p>
          </a>
        </li>

        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="fa-regular fa-calendar-check"></i>
            <p>
              Master Data Asset
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">

            <li class="nav-item">
              <a href="{{ asset('admin/lokasi') }}" class="nav-link">
                <i class="fa-solid fa-angles-right"></i>
                <p>Lokasi Asset</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ asset('admin/jenis-asset') }}" class="nav-link">
                <i class="fa-solid fa-angles-right"></i>
                <p>Jenis Asset</p>
              </a>
            </li>

          </ul>
        </li>

        <hr style="text-align:center; border-top: solid thin #333;" class="mb-1 mt-1 w-100">

        <!-- cuti -->
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="fa-regular fa-calendar-days"></i>
            <p>
              Data Cuti
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item"><a href="{{ asset('admin/cuti/status/Pengajuan') }}" class="nav-link"><i class="fas fa-tools nav-icon"></i>
                <p>Data Pengajuan Cuti</p>
              </a>
            </li>

            <li class="nav-item"><a href="{{ asset('admin/cuti') }}" class="nav-link"><i class="fas fa-tools nav-icon"></i>
                <p>Data Cuti</p>
              </a>
            </li>

            <li class="nav-item"><a href="{{ asset('admin/jenis-cuti') }}" class="nav-link"><i class="fas fa-file-pdf nav-icon"></i>
                <p>Jenis Cuti</p>
              </a>
            </li>

            <li class="nav-item"><a href="{{ asset('admin/libur') }}" class="nav-link"><i class="fa fa-home nav-icon"></i>
                <p>Setting Tanggal Libur</p>
              </a>
            </li>
            <li class="nav-item"><a href="{{ asset('admin/jenis-libur') }}" class="nav-link"><i class="fa fa-upload nav-icon"></i>
                <p>Jenis Libur</p>
              </a>
            </li>

            <li class="nav-item"><a href="{{ asset('admin/kuota-cuti') }}" class="nav-link"><i class="fa fa-upload nav-icon"></i>
                <p>Kuota Cuti Pegawai</p>
              </a>
            </li>

          </ul>
        </li>

        <!-- Menu Diklat -->
        <li class="nav-item">
          <a href="#" class="nav-link">
            <!-- <i class="nav-icon fas fa-users"></i> -->
            <i class="fa-solid fa-graduation-cap"></i>
            <p>
              Kediklatan
              <i class="right fas fa-angle-left"></i>
              <!-- <span class="right badge badge-danger"><?php echo $total_pegawai ?></span> -->
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ asset('admin/diklat') }}" class="nav-link">
                <i class="fa-solid fa-angles-right"></i>
                <p>Dasbor Diklat</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ asset('admin/diklat/tambah') }}" class="nav-link">
                <i class="fa-solid fa-angles-right"></i>
                <p>Tambah Data Diklat</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ asset('admin/kode-diklat') }}" class="nav-link">
                <i class="fa-solid fa-angles-right"></i>
                <p>Master Data Kodifikasi</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ asset('admin/jenis-pelatihan') }}" class="nav-link">
                <i class="fa-solid fa-angles-right"></i>
                <p>Master Jenis Pelatihan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ asset('admin/rumpun') }}" class="nav-link">
                <i class="fa-solid fa-angles-right"></i>
                <p>Master Rumpun</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ asset('admin/metode-diklat') }}" class="nav-link">
                <i class="fa-solid fa-angles-right"></i>
                <p>Master Metode Diklat</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ asset('admin/kategori-diklat') }}" class="nav-link">
                <i class="fa-solid fa-angles-right"></i>
                <p>Master Kategori Diklat</p>
              </a>
            </li>

          </ul>
        </li>

        <hr style="text-align:center; border-top: solid thin #333;" class="mb-1 mt-1 w-100">

        <!-- MENU -->
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="fa-solid fa-wrench"></i>
            <p>
              Konfigurasi
              <i class="fas fa-angle-left right"></i>

            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item"><a href="{{ asset('admin/konfigurasi') }}" class="nav-link"><i class="fas fa-tools nav-icon"></i>
                <p>Konfigurasi Umum</p>
              </a>
            </li>

            <li class="nav-item"><a href="{{ asset('admin/menu-pegawai') }}" class="nav-link"><i class="fas fa-file-pdf nav-icon"></i>
                <p>Menu Khusus</p>
              </a>
            </li>

            <li class="nav-item"><a href="{{ asset('admin/panduan') }}" class="nav-link"><i class="fas fa-file-pdf nav-icon"></i>
                <p>Unggah Panduan</p>
              </a>
            </li>

            <li class="nav-item"><a href="{{ asset('admin/konfigurasi/logo') }}" class="nav-link"><i class="fa fa-home nav-icon"></i>
                <p>Ganti Logo</p>
              </a>
            </li>
            <li class="nav-item"><a href="{{ asset('admin/konfigurasi/icon') }}" class="nav-link"><i class="fa fa-upload nav-icon"></i>
                <p>Ganti Icon</p>
              </a>
            </li>
            <li class="nav-item"><a href="{{ asset('admin/konfigurasi/email') }}" class="nav-link"><i class="fa fa-envelope nav-icon"></i>
                <p>Email Setting</p>
              </a>
            </li>
            <li class="nav-item"><a href="{{ asset('admin/konfigurasi/gambar') }}" class="nav-link"><i class="fas fa-book nav-icon"></i>
                <p>Ganti Gambar Banner</p>
              </a>
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
            <div class="card-body" style="min-height: 500px;">