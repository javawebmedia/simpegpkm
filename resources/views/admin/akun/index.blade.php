<p class="text-right">
	<a href="{{ asset('admin/akun/cetak') }}" class="btn btn-success btn-sm" target="_blank">
		<i class="fa fa-print"></i> Cetak
	</a>
	<a href="{{ asset('admin/akun/unduh') }}" class="btn btn-danger btn-sm"  target="_blank">
		<i class="fa fa-file-pdf"></i> Unduh PDF
	</a>
</p>

<div class="row">
	<div class="col-md-3 text-center">
		<div class="card">
			<div class="card-header bg-success">
				FOTO DAN NAMA ANDA
			</div>
			<div class="card-body">
				<p>
					<img src="{{ asset('assets/upload/images/'.$pegawai->foto) }}" alt="{{ $pegawai->nama_lengkap }}" class="img img-thumbnail">
				</p>
				<p>
					<strong>{{ $pegawai->nama_lengkap }}</strong>
					<br>NIP: {{ $pegawai->nip }}
					<br>Status: {{ $pegawai->status_pegawai }}
					<br>Jenis: {{ $pegawai->jenis_pegawai }}
				</p>
			</div>
		</div>
	</div>
	<div class="col-md-9">
		<div class="card">
			<div class="card-header bg-success">
				UPDATE PROFIL ANDA
			</div>
			<div class="card-body">

				@if($errors->any())
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
				@endif

				<form action="{{ asset('admin/akun/edit') }}" method="post" accept-charset="utf-8" enctype="multipart/form-data">
					{{ csrf_field() }}

					<input type="hidden" name="id_pegawai" value="{{ $pegawai->id_pegawai }}">

					<div class="form-group row">
						<label class="col-md-3">Nama Lengkap</label>
						<div class="col-md-9">
							<input type="text" name="nama_lengkap" class="form-control" placeholder="Nama lengkap" value="{{ $pegawai->nama_lengkap }}" required>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-md-3">Nama Panggilan</label>
						<div class="col-md-9">
							<input type="text" name="nama_panggilan" class="form-control" placeholder="Nama panggilan" value="{{ $pegawai->nama_panggilan }}">
						</div>
					</div>

					<div class="form-group row">
						<label class="col-md-3">NIP &amp; NRK</label>
						<div class="col-md-4">
							<input type="text" name="nip" class="form-control" placeholder="NIP" value="{{ $pegawai->nip }}" readonly>
						</div>
						<div class="col-md-5">
							<input type="text" name="nrk" class="form-control" placeholder="NRK" value="{{ $pegawai->nrk }}" readonly>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-md-3">NIK</label>
						<div class="col-md-9">
							<input type="text" name="nik" class="form-control" placeholder="NIK" value="{{ $pegawai->nik }}" required>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-md-3">Gelar Depan &amp; Belakang</label>
						<div class="col-md-4">
							<input type="text" name="gelar_depan" class="form-control" placeholder="Gelar depan" value="{{ $pegawai->gelar_depan }}">
						</div>
						<div class="col-md-5">
							<input type="text" name="gelar_belakang" class="form-control" placeholder="Gelar belakang" value="{{ $pegawai->gelar_belakang }}">
						</div>
					</div>

					<div class="form-group row">
						<label class="col-md-3">Tempat &amp; Tanggal Lahir</label>
						<div class="col-md-4">
							<input type="text" name="tempat_lahir" class="form-control" placeholder="Tempat lahir" value="{{ $pegawai->tempat_lahir }}" required>
						</div>
						<div class="col-md-5">
							<input type="text" name="tanggal_lahir" class="form-control datepicker" placeholder="HH-BB-TTTT" value="{{ date('d-m-Y',strtotime($pegawai->tanggal_lahir)) }}" readonly="" required>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-md-3">Jenis Kelamin</label>
						<div class="col-md-9">
							<select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
								<option value="">Pilih jenis kelamin</option>
								<option value="L" <?php if($pegawai->jenis_kelamin=='L') { echo 'selected'; } ?>>Laki-laki</option>
								<option value="P" <?php if($pegawai->jenis_kelamin=='P') { echo 'selected'; } ?>>Perempuan</option>
							</select>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-md-3">Agama</label>
						<div class="col-md-9">
							<select name="id_agama" id="id_agama" class="form-control" required>
								<option value="">Pilih agama</option>
								@foreach($agama as $agama)
								<option value="{{ $agama->id_agama }}" <?php if($pegawai->id_agama==$agama->id_agama) { echo 'selected'; } ?>>{{ $agama->nama_agama }}</option>
								@endforeach
							</select>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-md-3">Status Perkawinan</label>
						<div class="col-md-9">
							<select name="status_perkawinan" id="status_perkawinan" class="form-control" required>
								<option value="">Pilih status perkawinan</option>
								<option value="Belum Menikah" <?php if($pegawai->status_perkawinan=='Belum Menikah') { echo 'selected'; } ?>>Belum Menikah</option>
								<option value="Menikah" <?php if($pegawai->status_perkawinan=='Menikah') { echo 'selected'; } ?>>Menikah</option>
								<option value="Cerai Hidup" <?php if($pegawai->status_perkawinan=='Cerai Hidup') { echo 'selected'; } ?>>Cerai Hidup</option>
								<option value="Cerai Mati" <?php if($pegawai->status_perkawinan=='Cerai Mati') { echo 'selected'; } ?>>Cerai Mati</option>
							</select>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-md-3">No Telepon</label>
						<div class="col-md-9">
							<input type="text" name="telepon" class="form-control" placeholder="No Telepon" value="{{ $pegawai->telepon }}" required>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-md-3">Email</label>
						<div class="col-md-9">
							<input type="text" name="email" class="form-control" placeholder="Email" value="{{ $pegawai->email }}">
						</div>
					</div>

					<div class="form-group row">
						<label class="col-md-3">Alamat</label>
						<div class="col-md-9">
							<textarea name="alamat" id="alamat" class="form-control" rows="5" placeholder="Alamat" required>{{ $pegawai->alamat }}</textarea>
						</div>
					</div>
					<div class="row"><div class="col-md-12"><hr></div></div>

					<div class="form-group row">
						<label class="col-md-3">Deskripsi Diri</label>
						<div class="col-md-9">
							<textarea name="keterangan" id="keterangan" class="form-control" rows="5" placeholder="Keterangan">{{ $pegawai->keterangan }}</textarea>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-md-3">Upload Foto</label>
						<div class="col-md-9">
							<input type="file" name="foto" class="form-control">
						</div>
					</div>

					<div class="form-group row">
						<label class="col-md-3"></label>
						<div class="col-md-9">
							<button type="submit" class="btn btn-primary">Simpan</button>
						</div>
					</div>

				</form>

			</div>
		</div>
	</div>
</div>