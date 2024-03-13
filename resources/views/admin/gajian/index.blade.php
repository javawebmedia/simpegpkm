<form action="{{ asset('admin/gajian') }}" method="get">

<hr>

<div class="input-group col-md-8">

	<select name="thbl" class="form-control" required>
		<option value="">Pilih Periode TKD</option>
		<?php foreach($periode as $periode) { ?>
			<option value="<?php echo $periode->thbl ?>" <?php if(isset($_GET['thbl']) && $_GET['thbl']==$periode->thbl) { echo 'selected'; } ?>>
				<?php 
				$bulan = $periode->bulan;
				if($bulan=='01') {
					echo 'Januari';
				}elseif($bulan=='02') {
					echo 'Februari';
				}elseif($bulan=='03') {
					echo 'Maret';
				}elseif($bulan=='04') {
					echo 'April';
				}elseif($bulan=='05') {
					echo 'Mei';
				}elseif($bulan=='06') {
					echo 'Juni';
				}elseif($bulan=='07') {
					echo 'Juli';
				}elseif($bulan=='08') {
					echo 'Agustus';
				}elseif($bulan=='09') {
					echo 'September';
				}elseif($bulan=='10') {
					echo 'Oktober';
				}elseif($bulan=='11') {
					echo 'November';
				}elseif($bulan=='12') {
					echo 'Desember';
				}
			?> <?php echo $periode->tahun ?> (<?php echo $periode->jumlah_hari ?> Hari Kerja)
			</option>
		<?php } ?>
	</select>

	<span class="input-group-append">
		

		<button type="submit" class="btn btn-success btn-flat" name="lihat" value="submit">
			<i class="fa fa-arrow-right"></i> Lihat data TKD
		</button>

		<button type="submit" class="btn btn-info btn-flat" name="submit" value="submit">
			<i class="fa fa-arrow-right"></i> Generate TKD
		</button>

	</span>

</div>
</form>
<hr>