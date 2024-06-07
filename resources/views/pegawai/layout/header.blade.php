<!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ asset('pegawai/dasbor') }}" class="nav-link">Dashboard</a>
      </li>

      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ asset('/') }}" class="nav-link" target="_blank">Beranda</a>
      </li>
      
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      

      
      
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-user"></i>
          {{ Session()->get('gelar_depan') }} {{ Session()->get('nama_lengkap') }} {{ Session()->get('gelar_belakang') }} - {{ Session()->get('akses_level') }} 
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">MENU PEGAWAI</span>

          <div class="dropdown-divider"></div>
          <a href="{{ asset('pegawai/pegawai/edit') }}" class="dropdown-item">
            <i class="fas fa-user mr-2"></i> Update Profil
          </a>

          <div class="dropdown-divider"></div>
          <a href="{{ asset('pegawai/pegawai/riwayat') }}" class="dropdown-item">
            <i class="fas fa-tasks mr-2"></i> Riwayat Pegawai
          </a>
          
          <div class="dropdown-divider"></div>
          <a href="{{ asset('logout') }}" class="dropdown-item dropdown-footer"><i class="fa fa-sign-out-alt text-danger"></i> Logout</a>
        </div>
      </li>
      <!-- logout -->
      <li class="nav-item">
        <a class="nav-link" href="{{ asset('logout') }}">
          <i class="fa fa-sign-out-alt text-danger"></i>
        </a>
      </li>
      
    </ul>
  </nav>
  <!-- /.navbar