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
  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/fontawesome-free/css/solid.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/fontawesome-free/css/brand.min.css') }}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
   <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}">
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
<script src="<?php echo asset('assets/viewerjs/pdf.js') ?>" type="text/javascript" charset="utf-8" async defer></script>
  <!-- LORD ICON -->
  <script src="https://cdn.lordicon.com/xdjxvujz.js"></script>

  <!-- RTL Time Picker -->
  <link rel="stylesheet" href="{{ asset('assets/rtl-time/mdtimepicker.css') }}" />
  <script src="{{ asset('assets/rtl-time/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/rtl-time/mdtimepicker.js') }}"></script>

</head>

<body>
<div class="container-fluid">
	
	<h1><?php echo $title ?></h1>

	<table class="table table-sm tabelku" id="example1">
		<thead>
			<tr>
				<th>NO</th>
				<th>NIK</th>
				<th>NAMA LENGKAP</th>
				<th>NAMA FASYANKES</th>
				<th>JENIS SDMK</th>
				<th>STATUS KEPEGAWAIAN</th>
				<th>KODE DIKLAT</th>
				<th>RUMPUN DIKLAT</th>
				<th>DETAIL JENIS DIKLAT</th>
				<th>JENIS DIKLAT</th>
				<th>JENIS PELATIHAN</th>
				<th>NAMA DIKLAT</th>
				<th>AKREDITASI DIKLAT</th>
				<th>TEMPAT PELAKSANAAN</th>
				<th>TANGGAL AWAL PELAKSANAAN</th>
				<th>TANGGAL AKHIR PELAKSANAAN</th>
				<th>LAMA PELATIHAN</th>
				<th>JAM/HARI</th>
				<th>TOTAL JPL</th>
			</tr>
		</thead>
		<tbody>
			<?php $no=1; foreach($diklat as $diklat) { ?>
			<tr>
				<td><?php echo $no ?></td>
				<td>{{ $diklat->nik }}</td>
				<td>{{ $diklat->nama_lengkap }}</td>
				<td>PUSKESMAS KRAMAT JATI</td>
				<td></td>
				<td>{{ $diklat->jenis_pegawai }}</td>
				<td>{{ $diklat->kode_diklat }}</td>
				<td>{{ $diklat->nama_rumpun }}</td>
				<td>{{ $diklat->nama_kode_diklat }}</td>
				<td>{{ $diklat->nama_jenis_pelatihan }}</td>
				<td></td>
				<td>{{ $diklat->nama_diklat }}</td>
				<td></td>
				<td>{{ $diklat->tempat_pelaksanaan }}</td>
				<td>{{ $diklat->tanggal_awal }}</td>
				<td>{{ $diklat->tanggal_akhir }}</td>
				<td>{{ $diklat->durasi }}</td>
				<td>{{ $diklat->durasi }}/hari</td>
				<td>{{ $diklat->jpl }}</td>
			</tr>
			<?php $no++; } ?>
		</tbody>
	</table>

</div>

<!-- Bootstrap 4 -->
<script src="{{ asset('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset('assets/admin/plugins/select2/js/select2.full.min.js') }}"></script>
<!-- DataTables  & Plugins -->
<script src="{{ asset('assets/admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<!-- bootstrap color picker -->
<script src="{{ asset('assets/admin/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
<!-- Time And Date Picker -->
<script src="{{ asset('assets/admin/plugins/daterangepicker/daterangepicker.js')}}"></script>

<!-- AdminLTE App -->
<script src="{{ asset('assets/admin/dist/js/adminlte.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('assets/admin/plugins/summernote/summernote-bs4.min.js') }}"></script>
<script>
  $(function () {
    // Summernote
    $('.tinymce-editor').summernote()

    // CodeMirror
    CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
      mode: "htmlmixed",
      theme: "monokai"
    });
  })
</script>
<!-- jQuery UI JS -->
<script src="{{ asset('assets/jquery-ui/jquery-ui.min.js') }}"></script>

<?php
$sekarang = date('Y');
$awal     = $sekarang - 100;
?>
<script>
  $( function() {
    $( ".datepicker" ).datepicker({
      dateFormat: 'dd-mm-yy',
      changeMonth: true,
      changeYear: true,
      yearRange: "<?php echo $awal . ':' . $akhir = date('Y') + 2 ?>"
    });
  } );
</script>

<!-- .timepicker -->
<!-- <script>
  $('.timepicker').timepicker({
    timeFormat: 'H:mm',
    interval: 15,
    defaultTime: '07:00',
    dynamic: true,
    dropdown: true,
    scrollbar: true
  });
</script> -->

<!-- <script>
  //Timepicker
  $('#timepicker').datetimepicker({
      format: 'LT'
    })
</script> -->

<script>
  $(function () {
    // color picker
    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
      $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    })
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements Bootstrap
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    // Initialize DataTables
    $("#example1").DataTable({
      "responsive": true, 
      "lengthChange": false, 
      "autoWidth": false,
      "lengthMenu": [[1000, 2500, 5000, -1], [1000, 2500, 5000, "All"]],
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });

    // EXAMPLE 3
    $('#example3').DataTable({
      "paging": false,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "responsive": true,
    });
    // END EXAMPLE 3
    // EXAMPLE 4
    $('#example4').DataTable({
      "paging": false,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example4_wrapper .col-md-6:eq(0)');
    // END EXAMPLE 4
  });
</script>
<!-- Page specific script -->
<script>
  $(function () {
    //Enable check and uncheck all functionality
    $('.checkbox-toggle').click(function () {
      var clicks = $(this).data('clicks')
      if (clicks) {
        //Uncheck all checkboxes
        $('.mailbox-messages input[type=\'checkbox\']').prop('checked', false)
        $('.checkbox-toggle .far.fa-check-square').removeClass('fa-check-square').addClass('fa-square')
      } else {
        //Check all checkboxes
        $('.mailbox-messages input[type=\'checkbox\']').prop('checked', true)
        $('.checkbox-toggle .far.fa-square').removeClass('fa-square').addClass('fa-check-square')
      }
      $(this).data('clicks', !clicks)
    })

    //Handle starring for font awesome
    $('.mailbox-star').click(function (e) {
      e.preventDefault()
      //detect type
      var $this = $(this).find('a > i')
      var fa    = $this.hasClass('fa')

      //Switch states
      if (fa) {
        $this.toggleClass('fa-star')
        $this.toggleClass('fa-star-o')
      }
    })
  })
</script>	
</body>
</html>