<div class="row">
	<div class="col-md-4">
		<div class="alert alert-light text-center">
			<h4>PERHATIAN</h4>
			<hr>
			<p>Pastikan Anda mengimport data kehadiran pegawai menggunakan standar template file Excel yang benar.</p>

			<p>Silakan Unduh <a href="{{ asset('assets/upload/template/import-kehadiran.xlsx') }}" class="text-danger" target="_blank">Template Import Excel.</a></p>

		</div>
	</div>
	<div class="col-md-8">
		<form action="{{ asset('admin/kehadiran/proses-import') }}" method="post" enctype="multipart/form-data" accept-charset="utf-8" class="alert alert-light">
		{{ csrf_field() }}

			<h4>Form Upload dan Import</h4>
			<hr>

			<div class="form-group row">
	          <label class="col-md-3">Tahun dan Bulan Absensi</label>

	          <div class="col-md-3">
	            <input type="number" name="tahun" class="form-control" placeholder="Tahun" value="{{ date('Y') }}" required>
	          </div>

	          <?php 
	          if(isset($_POST['bulan'])) {
	          	$bulan = $_POST['bulan'];
	          }else{
	          	$bulan = date('m');
	          }
	           ?>

	          <div class="col-md-3">
	            <select name="bulan" class="form-control" required>
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
	          </div>

	        </div>
			
			<div class="form-group row">
	          	<label class="col-md-3">Upload File Excel</label>
	          	<div class="col-md-9">
					<input type="file" name="file_excel" value="" placeholder="Upload file excel" class="form-control">
				</div>
			</div>

			<div class="form-group row">
	          	<label class="col-md-3"></label>
	          	<div class="col-md-9">
					<button type="submit" class="btn btn-success">
						<i class="fa fa-upload"></i> Upload dan Import data
					</button>
					<a href="{{ asset('admin/kehadiran') }}" class="btn btn-dark">
						<i class="fa fa-arrow-left"></i> Kembali
					</a>
				</div>
			</div>

		</form>
	</div>
</div>