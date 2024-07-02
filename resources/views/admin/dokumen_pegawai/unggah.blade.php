<p class="text-right">
	<a href="{{ asset('admin/dokumen-pegawai') }}" class="btn btn-outline-info btn-sm"> <i class="fa fa-arrow-left"></i> Kembali</a>
</p>
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>

<div class="row">
	<div class="col-md-4">
		<div class="card">
			<div class="card-header bg-light">
				<strong>TEMPLATE FILE</strong>
			</div>
			<div class="card-body">
				<p>Untuk mengunggah file dalam jumlah banyak sekaligus, maka nama file harus disesuaikan dengan format yang telah disediakan. Berikut adalah format penamaan file:</p>
				<p class="callout callout-danger">
					<strong>Nomor Objek Pegawai-<span class="text-danger">Nomor Urut File</span>.pdf</strong>
					<br>Nomor urut file adalah 2 digit</p>
				</p>
				<p>Berikut adalah contoh nama file yang benar</p>
				<ul>
					<li>31.72.020.001.002.0416.0-<span class="text-danger">01</span>.pdf</li>
					<li>31.72.020.001.002.0416.0-<span class="text-danger">02</span>.pdf</li>
					<li>31.72.020.007.004.0173.0-<span class="text-danger">01</span>.pdf</li>
					<li>31.72.020.007.004.0173.0-<span class="text-danger">02</span>.pdf</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="col-md-8">
		<div class="card">
			<div class="card-header bg-light">
				<strong>FORMULIR UNGGAH DOKUMEN PAJAK</strong>
			</div>
			<div class="card-body">
				<form enctype="multipart/form-data" action="{{ asset('admin/dokumen-pegawai/proses-unggah') }}" method="post" accept-charset="utf-8" class="dropzone" id="image-upload" style="border-radius: 10px; font-weight: bold;">
					{{ csrf_field() }}
		        <div class="form-group row">
		            <label class="col-md-3">Status Dokumen</label>
		            <div class="col-md-9">
		                <select name="status_dokumen_pegawai" class="form-control" required>
		                    <option value="Disetujui">Disetujui</option>
		                    <option value="Ditolak">Ditolak</option>
		                    <option value="Menunggu">Menunggu</option>
		                </select>
		            </div>
		        </div>

		        <div class="form-group row">
		            <label class="col-md-3">Jenis Dokumen</label>
		            <div class="col-md-9">
		                <select name="kode_jenis_dokumen" class="form-control" required>
							<?php foreach($jenis_dokumen as $jenis_dokumen) { ?>
								<option value="<?php echo $jenis_dokumen->kode_jenis_dokumen ?>">
									<?php echo $jenis_dokumen->kode_jenis_dokumen ?> - <?php echo $jenis_dokumen->nama_jenis_dokumen ?>
								</option>
							<?php } ?>
						</select>
		            </div>
		        </div>

		        

		        <div class="bg-light p-2 rounded border-2" style="border-radius: 20px; min-height: 100px;">
		          <div class="dz-default dz-message btn btn-success w-100" data-dz-message><span><i class="fa fa-upload"></i> Klik untuk upload dokumen (Format: PDF, JPG, PNG)</span></div>
		        </div>


		        </form>
		        <small class="text-center">
		          Klik teks di atas untuk upload file. Ukuran maksimal 2MB.
		        </small>
		        <script type="text/javascript">
		          Dropzone.options.imageUpload = {
		            maxFilesize: 2,
		            // uploadMultiple : true,
		            acceptedFiles: ".jpeg,.jpg,.png,.gif,.pdf",
		            init: function() {
		              this.on("addedfile", file => {
		              });
		            }
		          };
		        </script>
			</div>
		</div>
	</div>
</div>