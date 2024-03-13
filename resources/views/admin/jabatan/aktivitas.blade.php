<div class="alert alert-light">
	<form action="{{ asset('admin/jabatan/tambah-aktivitas') }}" method="POST" accept-charset="utf-8">
		@csrf
		<input type="hidden" name="id_jabatan" value="{{ $jabatan->id_jabatan }}">
		<div class="form-group">
			<label for="nip">Pegawai</label>
			<select name="nip" id="nip" class="form-control select2">
				<option value="">Pilih Pegawai</option>
				@foreach($pegawai as $pegawai)
				<option value="{{ $pegawai->nip }}">{{ $pegawai->nip . ' - ' . $pegawai->nama_lengkap }}</option>
				@endforeach
			</select>
		</div>

		<div class="form-group">
			<label for="id_aktivitas">Aktivitas</label>
			<select name="id_aktivitas" id="id_aktivitas" class="form-control select2" required>
				<option value="">Pilih Aktivitas</option>
				@foreach($aktivitas as $aktivitas)
				<option value="{{ $aktivitas->id_aktivitas }}">{{ $aktivitas->nama_aktivitas . ' - ' . $aktivitas->waktu }} Menit</option>
				@endforeach
			</select>
		</div>

		<div class="form-group">
			<label for="jenis_aktivitas_utama">Jenis Aktivitas</label>
			<select name="jenis_aktivitas_utama" id="jenis_aktivitas_utama" class="form-control">
				<option value="">Pilih Jenis Aktivitas</option>
				<option value="Utama">Aktivitas Utama</option>
				<option value="Tambahan">Aktivitas Tambahan</option>
				<option value="Lainnya">Aktivitas Lainnya</option>
			</select>
		</div>

		<div class="form-group">
			<button class="btn btn-success float-right">
				<i class="fas fa-plus"></i> Tambah Aktivitas
			</button>
		</div>
		<div class="clearfix"></div>
	</form>
</div>


<table class="table table-bordered table-sm" id="example1">
	<thead>
		<tr class="text-center">
			<th width="5%">No</th>
			<th>Nama Pegawai</th>
			<th width="5%">Kode</th>
			<th>Nama Aktivitas</th>
			<th>Satuan</th>
			<th>Waktu</th>
			<th>Kategori</th>
			<th>Tingkat Kesulitan</th>
			<th>Bobot</th>
			<th>status</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php $no=1; foreach($aktivitas_utama as $aktivitas) { ?>
		<tr>
			<td class="text-center">{{ $no }}</td>
			<td>{{ $aktivitas->nama_lengkap }}</td>
			<td class="text-center">{{ $aktivitas->kode_aktivitas }}</td>
			<td>{{ $aktivitas->nama_aktivitas }}</td>
			<td>{{ $aktivitas->nama_satuan }}</td>
			<td class="text-center">{{ $aktivitas->waktu }}</td>
			<td>{{ $aktivitas->kategori }}</td>
			<td class="text-center">{{ $aktivitas->tingkat_kesulitan }}</td>
			<td class="text-center">{{ $aktivitas->bobot }}</td>
			<td class="text-center">{{ $aktivitas->status_aktivitas }}</td>
			<td>
				<a href="{{ asset('admin/jabatan/edit-aktivitas/'.$aktivitas->id_aktivitas_utama) }}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>

				<a href="{{ asset('admin/jabatan/delete-aktivitas/'.$aktivitas->id_aktivitas_utama . '/' . $aktivitas->id_jabatan) }}" class="btn btn-dark btn-sm delete-link"><i class="fa fa-trash"></i></a>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>