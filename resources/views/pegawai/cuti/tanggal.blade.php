<!-- jQuery -->
  <script src="{{ asset('assets/admin/plugins/jquery/jquery.min.js') }}"></script>
  <!-- jQuery UI CSS -->
  <link rel="stylesheet" href="{{ asset('assets/jquery-ui/jquery-ui.min.css') }}">
<?php $no = 1; do{ ?>
    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text">Hari <?php echo $no ?></span>
      </div>
      <input type="text" class="form-control datepicker" name="tanggal_cuti[]" placeholder="dd-mm-yyyy" required>
    </div>
<?php $no++; }while($no <= $total_hari); ?>
<!-- jQuery UI JS -->
<script src="{{ asset('assets/jquery-ui/jquery-ui.min.js') }}"></script>
<?php
$sekarang = date('Y');
$awal     = $sekarang - 50;
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