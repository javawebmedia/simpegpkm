
 <div class="modal fade" id="modal-default">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Tambah Data Sub Sub Jenis Dokumen: {{ $jenis_dokumen->nama_jenis_dokumen }}</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
				<form action="{{ asset('admin/jenis-dokumen/tambah-sub') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
{{ csrf_field() }}

	<input type="hidden" name="id_jenis_dokumen" value="{{ $jenis_dokumen->id_jenis_dokumen }}">
				<div class="form-group row">
					<label class="col-sm-3 control-label text-right">Nama Sub Jenis Dokumen Pegawai</label>
					<div class="col-sm-9">
						<input type="text" name="nama_sub_jenis_dokumen" class="form-control" placeholder="Nama lengkap" value="{{ old('nama_sub_jenis_dokumen') }}" required>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-sm-3 control-label text-right">Kode dan Nomor Urut</label>
					<div class="col-sm-4">
						<input type="text" name="kode_sub_jenis_dokumen" class="form-control" placeholder="Kode Sub Jenis Dokumen Pegawai" value="{{ old('kode_sub_jenis_dokumen') }}" required>
						<small class="text-secondary">Kode Sub Jenis Dokumen Pegawai</small>
					</div>
					<div class="col-sm-5">
						<input type="number" name="urutan" class="form-control" placeholder="Nomor Urut Sub Jenis Dokumen Pegawai" value="{{ $urutan }}" required>
						<small class="text-secondary">Nomor urut</small>
					</div>
				</div>		

				<input type="hidden" name="kode_template" class="form-control" placeholder="Nama Template Sub Jenis Dokumen Pegawai" value="Umum" required>


				<div class="form-group row">
					<label class="col-sm-3 control-label text-right">Keterangan</label>
					<div class="col-sm-9">
						<textarea name="keterangan" class="form-control"><?php echo old('keterangan') ?></textarea>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-sm-3 control-label text-right">Status Sub Jenis Dokumen Pegawai</label>
					<div class="col-sm-9">
						<select name="status_sub_jenis_dokumen" class="form-control">
							<option value="Aktif">Aktif</option>
							<option value="Non Aktif">Non Aktif</option>
						</select>
					</div>
				</div>

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
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
				</form>

			</div>
		</div>
	</div>
</div>

