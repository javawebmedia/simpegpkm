<?php 
use Illuminate\Support\Facades\DB;
$site_config = DB::table('konfigurasi')->first();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $title }}</title>

  <!-- ICON -->
  <link rel="icon" href="{{ asset('assets/upload/image/'.$site_config->icon) }}">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('assets/admin/dist/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/css-admin.css') }}">
    <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/summernote/summernote-bs4.min.css') }}">
  <!-- jQuery -->
  <script src="{{ asset('assets/admin/plugins/jquery/jquery.min.js') }}"></script>
  <!-- jquery chained -->
  <script src="{{ asset('assets/js/jquery.chained.js') }}"></script>
  <!-- sweetalert -->
  <script src="{{ asset('assets/sweetalert/js/sweetalert.min.js') }}"></script>
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/sweetalert/css/sweetalert.css') }}">
  <!-- jQuery UI CSS -->
  <link rel="stylesheet" href="{{ asset('assets/jquery-ui/jquery-ui.min.css') }}">
  <!-- jquery time picker -->
  <script type="text/javascript" src="{{ asset('assets/jquery-timepicker/jquery.timepicker.min.js') }}"></script>
  <link rel="stylesheet" href="{{ asset('assets/jquery-timepicker/jquery.timepicker.min.css') }}" type="text/css"/>
  <style type="text/css" media="screen">
    .ui-timepicker-container{ 
         z-index:1151 !important; 
    }
  </style>

  <!-- Bootstrap Switch -->
  <script src="{{ asset('assets/admin/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>

  <!-- LORD ICON -->
  <script src="https://cdn.lordicon.com/xdjxvujz.js"></script>

  <!-- RTL Time Picker -->
  <link rel="stylesheet" href="{{ asset('assets/rtl-time/mdtimepicker.css') }}" />
  <script src="{{ asset('assets/rtl-time/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/rtl-time/mdtimepicker.js') }}"></script>

</head>

<body class="hold-transition sidebar-mini sidebar-collapse">
<div class="wrapper">