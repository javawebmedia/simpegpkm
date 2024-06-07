<style type="text/css" media="screen">
	.ui-autocomplete-loading { background:url('<?php echo asset("assets/images/spinner-2.gif") ?>') no-repeat right center }
</style>

<?php 
$bulan 	= date('m');
$tahun 	= date('Y');
?>

<form action="{{ asset('admin/dasbor') }}" method="get" accept-charset="utf-8">
        {{ csrf_field() }}

<div class="row">
	<div class="col-md-10">

		<div class="form-group row">
			<label class="col-md-3">Periode Data</label>
			<div class="col-md-9">
				<!-- mulai -->
				<div class="input-group">

					<select name="bulan" class="form-control col-md-3 bg-light" required>
						<option value="">Pilih Bulan</option>
						<option value="01" <?php if($bulan=='01') { echo 'selected'; } ?>>Januari</option>
						<option value="02" <?php if($bulan=='02') { echo 'selected'; } ?>>Februari</option>
						<option value="03" <?php if($bulan=='03') { echo 'selected'; } ?>>Maret</option>
						<option value="04" <?php if($bulan=='04') { echo 'selected'; } ?>>April</option>
						<option value="05" <?php if($bulan=='05') { echo 'selected'; } ?>>Mei</option>
						<option value="06" <?php if($bulan=='06') { echo 'selected'; } ?>>Juni</option>
						<option value="07" <?php if($bulan=='07') { echo 'selected'; } ?>>Juli</option>
						<option value="08" <?php if($bulan=='08') { echo 'selected'; } ?>>Agustus</option>
						<option value="09" <?php if($bulan=='09') { echo 'selected'; } ?>>September</option>
						<option value="10" <?php if($bulan=='10') { echo 'selected'; } ?>>Oktober</option>
						<option value="11" <?php if($bulan=='11') { echo 'selected'; } ?>>November</option>
						<option value="12" <?php if($bulan=='12') { echo 'selected'; } ?>>Desember</option>
					</select>

					<input type="number" class="form-control" name="tahun" value="{{ $tahun }}" placeholder="Tahun">
				</div>
				<!-- end -->
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-3">Kata kunci pencarian</label>
			<div class="col-md-9">
				<input type="text" name="keywords" class="form-control text-uppercase" id="nama" placeholder="Cari Nama/NRK/NIP..." minlength="4" required value="">
				<small class="text-gray">Minimal 4 karakter</small>
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-3">Nama lengkap</label>
			<div class="col-md-9">
				<input type="text" name="nama_lengkap" class="form-control" id="nama_lengkap" value="" required readonly="readonly">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-3">NRK, NIP, &amp; PIN</label>
			<div class="col-md-3">
				<input type="text" name="nrk" class="form-control" id="nrk" value="" required readonly="readonly">
			</div>
			<div class="col-md-4">
				<input type="text" name="nip" class="form-control" id="nip" value="" required readonly="readonly">
			</div>
			<div class="col-md-2">
				<input type="text" name="pin" class="form-control" id="pin" value="" required readonly="readonly">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-3">Tempat tanggal lahir</label>
			<div class="col-md-3">
				<input type="text" name="tempat_lahir" class="form-control" id="tempat_lahir" value="" required readonly="readonly">
			</div>
			<div class="col-md-6">
				<input type="text" name="tanggal_lahir" class="form-control" id="tanggal_lahir" value="" required readonly="readonly">
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-3"></label>
			<div class="col-md-9">
				<button class="btn btn-outline-info" type="reset" name="reset" value="reset">
					<i class="fa fa-sync"></i> 
				</button>

				<button class="btn btn-success" type="submit" name="submit" value="generate">
					<i class="fa fa-calendar-check"></i> Generate Kehadiran
				</button>
				
				<button class="btn btn-info" type="submit" name="submit" value="lihat">
					<i class="fa fa-file-pdf"></i> Lihat Informasi Pegawai
				</button>

			</div>
		</div>
	</div>

	<div class="col-md-2">
		<div id="gambar">
			
		</div>
	</div>
</div>

</form>

<script type='text/javascript'>
$(document).ready(function(){

 // Initialize 
 $( "#nama" ).autocomplete({
 	minLength: 4,
    source: function( request, response ) {
      // Fetch data
      $.ajax({
        url: "<?php echo asset('admin/dasbor/cari') ?>",
        type: 'GET',
        dataType: "json",
        data: {
          search: request.term
        },
        success: function( data ) {
          response( data );
        }
      });
    },
    select: function (event, ui) {
      // Set selection
      $('#nama').val(ui.item.label); // display the selected text
      $('#nrk').val(ui.item.nrk); // save selected id to input
      $('#nama_lengkap').val(ui.item.nama_lengkap); // save selected id to input
      $('#nip').val(ui.item.nip); // save selected id to input
      $('#tempat_lahir').val(ui.item.tempat_lahir); // save selected id to input
      $('#tanggal_lahir').val(ui.item.tanggal_lahir); // save selected id to input
      $('#pin').val(ui.item.pin); // save selected id to input
      $('#gambar').html('<img src="' + ui.item.gambar + '" alt="Gambar Pegawai" class="img-fluid img-thumbnail"/>'); // set image
      return false;
    }
  });

});
</script>
