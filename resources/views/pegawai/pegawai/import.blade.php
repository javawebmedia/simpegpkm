<div class="row">
	<div class="col-md-6">
		<div class="alert alert-light text-center">
			<h4>PERHATIAN</h4>
			<hr>
			<p>Pastikan Anda mengimport data pegawai menggunakan standar template file Excel yang benar.</p>

			<p>Silakan Unduh <a href="{{ asset('assets/upload/template/import.xlsx') }}" class="text-danger" target="_blank">Template Import Excel.</a></p>

		</div>
	</div>
	<div class="col-md-6">
		<form action="{{ asset('pegawai/pegawai/proses-import') }}" method="post" enctype="multipart/form-data" accept-charset="utf-8" class="alert alert-light">
		{{ csrf_field() }}

			<h4>Form Upload dan Import</h4>
			<hr>
			
			<div class="form-group">
				<label>Upload File Excel</label>
				<input type="file" name="file_excel" value="" placeholder="Upload file excel" class="form-control">
			</div>

			<div class="form-group">
				<button type="submit" class="btn btn-success">
					<i class="fa fa-upload"></i> Upload dan Import data
				</button>
				<a href="{{ asset('pegawai/pegawai') }}" class="btn btn-dark">
					<i class="fa fa-arrow-left"></i> Kembali
				</a>
			</div>

		</form>
	</div>
</div>