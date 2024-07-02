@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ asset('admin/dokumen_pegawai/proses_edit') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
{{ csrf_field() }}

<div class="row">
	
	<div class="col-md-9">
		<div class="card">
			<div class="card-header">Update Data</div>
			<div class="card-body p-3">

				<input type="hidden" name="id_dokumen_pegawai" value="<?php echo $dokumen_pegawai->id_dokumen_pegawai ?>">

				<div class="form-group row">
					<label class="col-sm-3 control-label text-right">Nama Panduan</label>
					<div class="col-sm-9">
						<input type="text" name="nama_dokumen_pegawai" class="form-control" placeholder="Nama lengkap" value="{{ $dokumen_pegawai->nama_dokumen_pegawai }}" required>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-sm-3 control-label text-right">Status Panduan</label>
					<div class="col-sm-9">
						<select name="status_dokumen_pegawai" class="form-control">
							<option value="Aktif">Aktif</option>
							<option value="Non Aktif" <?php if($dokumen_pegawai->status_dokumen_pegawai=='Non Aktif') { echo 'selected'; } ?>>Non Aktif</option>
						</select>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-sm-3 control-label text-right">Jenis Panduan &amp; Urutan</label>
					<div class="col-sm-4">
						<input type="text" name="jenis_dokumen_pegawai" class="form-control" placeholder="Kode Panduan" value="{{ $dokumen_pegawai->jenis_dokumen_pegawai }}" required>
						<small class="text-secondary">Kode Panduan</small>
					</div>
					<div class="col-sm-5">
						<input type="number" name="urutan" class="form-control" placeholder="Nomor Urut Panduan" value="{{ $dokumen_pegawai->urutan }}" required>
						<small class="text-secondary">Nomor urut</small>
					</div>
				</div>				

				<div class="form-group row">
					<label class="col-sm-3 control-label text-right">Keterangan</label>
					<div class="col-sm-9">
						<textarea name="keterangan" class="form-control"><?php echo $dokumen_pegawai->keterangan ?></textarea>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-sm-3 control-label text-right">File Panduan (Format PDF)</label>
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
							<a href="{{ asset('admin/dokumen_pegawai') }}" class="btn btn-danger">Kembali</a>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>

			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="card">
			<div class="card-header">FILE PANDUAN</div>
			<div class="card-body p-3 text-center">
				<?php if($dokumen_pegawai->gambar != "") { ?>
		            <a href="{{ asset('assets/upload/dokumen_pegawai/'.$dokumen_pegawai->gambar) }}" class="btn btn-success btn-xs" title="Unduh" target="_blank"><i class="fa fa-download"></i> Unduh</a>
		        <?php }else{ echo '<p class="badge bg-warning text-center">Belum ada</p>'; } ?>
			</div>
		</div>
		
	</div>
</div>

</form>

