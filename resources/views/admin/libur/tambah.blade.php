
<form action="{{ asset('admin/libur/proses-tambah') }}" method="post" accept-charset="utf-8">
        {{ csrf_field() }}
        <input type="hidden" name="weekend" value="Tidak">
<div class="modal-basic modal fade show" id="modal-basic" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content modal-bg-white ">
			<div class="modal-header">
				<h6 class="modal-title">Tambah Data</h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<i class="fa fa-times"></i>
				</button>
			</div>
			<div class="modal-body">

				<div class="form-group row">
					<label class="col-3">Nama Jenis &amp; Libur</label>
					<div class="col-6">
						<select name="id_jenis_libur" class="form-control select2">
							<?php foreach($jenis_libur as $jenis_libur) { ?>
							<option value="<?php echo $jenis_libur->id_jenis_libur ?>">
								<?php echo $jenis_libur->nama_jenis_libur ?>
							</option>
							<?php } ?>
						</select>
					</div>
					<div class="col-3">
						<select name="status_libur" class="form-control">
							<option value="Publish">Publish</option>
							<option value="Draft">Draft</option>
						</select>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3">Tanggal Libur</label>
					<div class="col-6">
						<input type="text" name="tanggal_libur" class="form-control datepicker" placeholder="dd-mm-yyyy" value="<?php echo old('tanggal_libur') ?>" required>
					</div>
					<div class="col-3">
						<input type="number" name="tahun" class="form-control" id="tahun" placeholder="Tahun" value="<?php echo old('tahun') ?>" required readonly>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3">Keterangan</label>
					<div class="col-9">
						<textarea name="keterangan" class="form-control" placeholder="Keterangan"><?php echo old('keterangan') ?></textarea>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3"></label>
					<div class="col-9">
						
						<button type="submit" class="btn btn-success">Simpan&nbsp;<i class="fa fa-arrow-right"></i> </button>
					</div>
				</div>

			</div>
		</div>
	</div>
	<!-- ends: .modal-Basic -->
</div>
<!-- /.modal -->
</form>