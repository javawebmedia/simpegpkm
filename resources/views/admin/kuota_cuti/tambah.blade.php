
<form action="{{ asset('admin/kuota-cuti/proses-tambah') }}" method="post" accept-charset="utf-8">
        {{ csrf_field() }}
<div class="modal-basic modal fade show" id="modal-basic" role="dialog" aria-hidden="true">
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
					<label class="col-3">Nama Pegawai</label>
					<div class="col-9">
						<select name="nip" class="form-control select2">
							<?php foreach($pegawai2 as $pegawai) { ?>
							<option value="<?php echo $pegawai->nip ?>">
								<?php echo $pegawai->nip ?> <?php echo $pegawai->nama_lengkap ?>
							</option>
							<?php } ?>
						</select>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3">Tahun dan Kuota Cuti</label>
					<div class="col-3">
						<input type="number" name="tahun" class="form-control" placeholder="<?php echo date('Y') ?>" value="<?php if(isset($_POST['tahun'])) { echo old('tahun'); }else{ echo date('Y'); } ?>" required>
					</div>
					<div class="col-3">
						<input type="number" name="kuota" class="form-control" id="kuota" placeholder="Kuota" value="<?php if(isset($_POST['tahun'])) { echo old('kuota'); }else{ echo 12; } ?>" required>
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