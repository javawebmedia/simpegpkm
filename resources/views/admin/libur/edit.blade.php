<form action="{{ asset('admin/libur/proses-edit') }}" method="post" accept-charset="utf-8">
        {{ csrf_field() }}
<input type="hidden" name="id_libur" value="<?php echo $libur->id_libur ?>">
<input type="hidden" name="weekend" value="<?php echo $libur->weekend ?>">
<div class="form-group row">
	<label class="col-3">Nama Jenis Libur</label>
	<div class="col-6">
		<select name="id_jenis_libur" class="form-control select2">
			<?php foreach($jenis_libur as $jenis_libur) { ?>
			<option value="<?php echo $jenis_libur->id_jenis_libur ?>" <?php if($jenis_libur->id_jenis_libur==$libur->id_jenis_libur) { echo 'selected'; } ?>>
				<?php echo $jenis_libur->nama_jenis_libur ?>
			</option>
			<?php } ?>
		</select>
	</div>
	<div class="col-3">
		<select name="status_libur" class="form-control">
			<option value="Publish">Publish</option>
			<option value="Draft" <?php if($libur->status_libur=='Draft') { echo 'selected'; } ?>>Draft</option>
		</select>
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Tanggal Libur</label>
	<div class="col-6">
		<input type="text" name="tanggal_libur" class="form-control datepicker" placeholder="dd-mm-yyyy" value="<?php echo date('d-m-Y',strtotime($libur->tanggal_libur)) ?>" required>
	</div>
	<div class="col-3">
		<input type="number" name="tahun" class="form-control" id="tahun" placeholder="Tahun" value="<?php echo $libur->tahun ?>" required readonly>
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

</form>