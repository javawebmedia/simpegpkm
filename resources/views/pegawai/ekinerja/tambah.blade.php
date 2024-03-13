
@if($errors->any())
<div class="alert alert-danger">
	<ul>
		@foreach ($errors->all() as $error)
		<li>{{ $error }}</li>
		@endforeach
	</ul>
</div>
@endif


<form action="{{ asset('pegawai/ekinerja/input-ekinerja') }}" method="post" accept-charset="utf-8">
	{{ csrf_field() }}

	<input type="hidden" name="id_pegawai" value="{{ Session()->get('id_pegawai') }}">
	<input type="hidden" name="jenis_aktivitas" value="Utama">

	<div class="form-group row">
		<label class="col-md-3">Jenis Aktivitas</label>
		<div class="col-md-9">
			<select name="jenis_aktivitas" class="form-control select2" id="jenis_aktivitas" required>
				<option value="Utama">Utama</option>
				<option value="Umum">Umum</option>
			</select>
		</div>
	</div>

	<div class="form-group row">
		<label class="col-md-3">Pilih Aktivitas Utama</label>
		<div class="col-md-9">
			<select name="id_aktivitas" class="form-control select2" id="id_aktivitas" required>
				<option value="">Pilih Aktivitas</option>

				<?php foreach($aktivitas as $aktivitas) { ?>
					<option value="<?php echo $aktivitas->nama_aktivitas ?>">
						<?php echo $aktivitas->nama_aktivitas ?> - <?php echo $aktivitas->waktu ?> Menit (<?php echo $aktivitas->nama_satuan ?>)
					</option>
				<?php } ?>
				
			</select>
		</div>
	</div>

	<div class="form-group row">
		<label class="col-md-3">Tanggal &amp; Waktu Aktivitas</label>

		<div class="col-md-3">
			<input type="text" name="tanggal_kinerja" class="form-control datepicker" placeholder="dd-mm-yyyy" value="{{ old('tanggal_kinerja') }}" required>
			<small>Tanggal Aktivitas</small>
		</div>

		<div class="col-md-3">
			<input type="text" name="jam_mulai" class="form-control timepicker" placeholder="hh:mm" value="{{ old('jam_mulai') }}" required>
			<small>Jam Mulai</small>
		</div>

		<div class="col-md-3">
			<input type="text" name="jam_selesai" class="form-control timepicker" placeholder="hh:mm" value="{{ old('jam_selesai') }}" required>
			<small>Jam Selesai</small>
		</div>

	</div>

	<div class="form-group row">
		<label class="col-md-3">Catatan</label>
		<div class="col-md-9">
			<textarea name="keterangan" class="form-control" placeholder="Keterangan">{{ old('keterangan') }}</textarea>
		</div>
	</div>

	<div class="form-group row">
		<label class="col-md-3"></label>
		<div class="col-md-9">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			<button type="submit" class="btn btn-primary">Simpan</button>
		</div>
	</div>

</form>


<script>
	$('.timepicker').timepicker({
		timeFormat: 'H:mm',
		interval: 15,
		defaultTime: '07:00',
		dynamic: true,
		dropdown: true,
		scrollbar: true
	});
</script>
