<?php 
use Illuminate\Support\Facades\DB;
$site_config = DB::table('konfigurasi')->first();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>{{ $title }}</title>
  <meta content="{{ $description }}" name="description">
  <meta content="{{ $keywords }}" name="keywords">

  <!-- Favicons -->
  <!-- ICON -->
  <link rel="icon" href="{{ asset('assets/upload/image/'.$site_config->icon) }}">
  <link href="{{ asset('assets/upload/image/'.$site_config->icon) }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/template') }}/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="{{ asset('assets/template') }}/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{ asset('assets/template') }}/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="{{ asset('assets/template') }}/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="{{ asset('assets/template') }}/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="{{ asset('assets/template') }}/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="{{ asset('assets/template') }}/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('assets/template') }}/assets/css/style.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- =======================================================
  * Template Name: Bootslander - v4.7.2
  * Template URL: https://bootstrapmade.com/bootslander-free-bootstrap-landing-page-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  <!-- amcharts -->
  <script src="{{ asset('assets/amcharts5/index.js')}}"></script>
  <script src="{{ asset('assets/amcharts5/percent.js')}}"></script>
  <script src="{{ asset('assets/amcharts5/themes/Animated.js')}}"></script>
  <!-- end amcharts -->
  <script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
</head>

<body>