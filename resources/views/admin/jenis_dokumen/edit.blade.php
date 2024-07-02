@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ asset('admin/jenis-dokumen/proses_edit') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
{{ csrf_field() }}

<div class="row">
	<div class="col-md-3">
		<div class="card">
			<div class="card-header">File/Gambar</div>
			<div class="card-body p-3 text-center">
				<?php if($jenis_dokumen->gambar != "") { ?>
		            <a href="{{ asset('assets/upload/jenis_dokumen/'.$jenis_dokumen->gambar) }}" class="btn btn-outline-info">
		            	<i class="fa fa-download"></i> Unduh File
		            </a>
		        <?php }else{ echo '<p class="badge bg-warning text-center">Belum ada</p>'; } ?>
			</div>
		</div>
		
	</div>
	<div class="col-md-9">
		<div class="card">
			<div class="card-header">Update Data</div>
			<div class="card-body p-3">

				<input type="hidden" name="id_jenis_dokumen" value="<?php echo $jenis_dokumen->id_jenis_dokumen ?>">

				<div class="form-group row">
					<label class="col-sm-3 control-label text-right">Nama Jenis Dokumen Pegawai</label>
					<div class="col-sm-9">
						<input type="text" name="nama_jenis_dokumen" class="form-control" placeholder="Nama lengkap" value="{{ $jenis_dokumen->nama_jenis_dokumen }}" required>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-sm-3 control-label text-right">Kode dan Nomor Urut</label>
					<div class="col-sm-4">
						<input type="text" name="kode_jenis_dokumen" class="form-control" placeholder="Kode Jenis Dokumen Pegawai" value="{{ $jenis_dokumen->kode_jenis_dokumen }}" required>
						<small class="text-secondary">Kode Jenis Dokumen Pegawai</small>
					</div>
					<div class="col-sm-5">
						<input type="number" name="urutan" class="form-control" placeholder="Nomor Urut Jenis Dokumen Pegawai" value="{{ $jenis_dokumen->urutan }}" required>
						<small class="text-secondary">Nomor urut</small>
					</div>
				</div>	

				<div class="form-group row">
					<label class="col-sm-3 control-label text-right">Nama Template Jenis Dokumen Pegawai</label>
					<div class="col-sm-9">
						<input type="text" name="kode_template" class="form-control" placeholder="Nama Template Jenis Dokumen Pegawai" value="{{ $jenis_dokumen->kode_template }}" required>
						<small><strong>Note: </strong> Template blade laravel.</small>
					</div>
				</div>				

				<div class="form-group row">
					<label class="col-sm-3 control-label text-right">Keterangan</label>
					<div class="col-sm-9">
						<textarea name="keterangan" class="form-control"><?php echo $jenis_dokumen->keterangan ?></textarea>
					</div>
				</div>

				<input type="hidden" name="kode_template" class="form-control" placeholder="Nama Template Jenis Dokumen Pegawai" value="Umum" required>

				<!-- <div class="form-group row">
					<label class="col-sm-3 control-label text-right">Status Jenis Dokumen Pegawai</label>
					<div class="col-sm-9">
						<select name="status_jenis_dokumen" class="form-control">
							<option value="Aktif">Aktif</option>
							<option value="Non Aktif" <?php if($jenis_dokumen->status_jenis_dokumen=='Non Aktif') { echo 'selected'; } ?>>Non Aktif</option>
						</select>
					</div>
				</div> -->

				<div class="form-group row">
					<label class="col-sm-3 control-label text-right">File/Gambar</label>
					<div class="col-sm-9">
						<input type="file" name="gambar" class="form-control" placeholder="Upload Foto" value="{{ old('gambar') }}">
					</div>
				</div>

				<div class="form-group row">
					<label class="col-sm-3 control-label text-right"></label>
					<div class="col-sm-9">
						<div class="form-group pull-right btn-group">
							<input type="submit" name="submit" class="btn btn-primary " value="Simpan Data">
							<input type="reset" name="reset" class="btn btn-success " value="Reset">
							<a href="{{ asset('admin/jenis-dokumen') }}" class="btn btn-danger">Kembali</a>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>

			</div>
		</div>
	</div>
</div>

</form>

