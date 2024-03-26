<form action="{{ asset('admin/kuota-cuti/proses-edit') }}" method="post" accept-charset="utf-8">
        {{ csrf_field() }}
<input type="hidden" name="id_kuota_cuti" value="<?php echo $kuota_cuti->id_kuota_cuti ?>">
<div class="form-group row">
	<label class="col-3">Nama Pegawai</label>
	<div class="col-3">
		<input type="text" name="nip" class="form-control" placeholder="NIP" value="<?php echo $kuota_cuti->nip ?>" required>
	</div>
	<div class="col-6">
		<input type="text" name="nama_lengkap" class="form-control" placeholder="Nama pegawai" value="<?php echo $pegawai->nama_lengkap ?>" required>
	</div>
</div>

<div class="form-group row">
	<label class="col-3">Tahun dan Kuota</label>
	<div class="col-3">
		<input type="text" name="tahun" class="form-control" placeholder="Tahun" value="<?php echo $kuota_cuti->tahun ?>" required>
	</div>
	<div class="col-3">
		<input type="number" name="kuota" class="form-control" id="kuota" placeholder="Kuota" value="<?php echo $kuota_cuti->kuota ?>" required>
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