<p class="text-right">
	<a href="{{ asset('pegawai/diklat') }}" class="btn btn-outline-info btn-sm">
		<i class="fa fa-arrow-left"></i> Kembali
	</a>
	<a href="{{ asset('pegawai/diklat/edit/'.$diklat->id_diklat) }}" class="btn btn-outline-warning btn-sm">
		<i class="fa fa-edit"></i> Edit
	</a>
</p>

<div class="row mt-2">
	<dib class="col-md-5">
		<div class="card">
			<div class="card-header bg-light">
				<strong>DETAIL PEGAWAI</strong>
			</div>
			<div class="card-body">
				<table class="table table-sm tabelku">
					<tbody>
						<tr>
							<td width="40%">Nama lengkap</td>
							<td>{{ $pegawai->nama_lengkap }}</td>
						</tr>
						<tr>
							<td>NIP</td>
							<td>{{ $pegawai->nip }}</td>
						</tr>
						<tr>
							<td>NRK</td>
							<td>{{ $pegawai->nrk }}</td>
						</tr>
						<tr>
							<td>NIK</td>
							<td>{{ $pegawai->nik }}</td>
						</tr>
						<tr>
							<td>Jenis Pegawai</td>
							<td>{{ $pegawai->jenis_pegawai }}</td>
						</tr>
						<tr>
							<td>Status Pegawai</td>
							<td>{{ $pegawai->status_pegawai }}</td>
						</tr>
						<tr>
							<td>Status Perkawinan</td>
							<td>{{ $pegawai->status_perkawinan }}</td>
						</tr>
						<tr>
							<td>Tempat, tanggal lahir</td>
							<td>{{ $pegawai->tempat_lahir }}, {{ date('d-m-Y',strtotime($pegawai->tanggal_lahir)) }}</td>
						</tr>
						<tr>
							<td>TMT Pegawai</td>
							<td>{{ date('d-m-Y',strtotime($pegawai->tmt_masuk)) }}</td>
						</tr>
					</tbody>
				</table>


			</div>
		</div>
	</dib>
	<dib class="col-md-7">
		<div class="card">
			<div class="card-header bg-light">
				<strong>DETAIL DIKLAT</strong>
			</div>
			<div class="card-body">
				<table class="table table-sm tabelku">
					<tbody>
						<tr>
							<td width="40%">Nama Diklat</td>
							<td>{{ $diklat->nama_diklat }}</td>
						</tr>
						<tr>
							<td>Jenis Metode</td>
							<td>{{ $diklat->jenis_metode }} - {{ $diklat->nama_metode_diklat }}</td>
						</tr>
						<tr>
							<td>Rumpun</td>
							<td>{{ $diklat->nama_rumpun }}</td>
						</tr>
						<tr>
							<td>Jenis Pelatihan</td>
							<td>{{ $diklat->nama_jenis_pelatihan }}</td>
						</tr>
						<tr>
							<td>Kode Diklat</td>
							<td>{{ $diklat->kode_diklat }}</td>
						</tr>
						<tr>
							<td>Nama Kode Diklat</td>
							<td>{{ $diklat->nama_kode_diklat }}</td>
						</tr>
						<tr>
							<td>Status Diklat</td>
							<td>{{ $diklat->status_diklat }}</td>
						</tr>
						<tr>
							<td>Tanggal Mulai</td>
							<td>{{ $diklat->tanggal_awal }}</td>
						</tr>
						<tr>
							<td>Tanggal Selesai</td>
							<td>{{ $diklat->tanggal_akhir }}</td>
						</tr>
						<tr>
							<td>Penyelenggara</td>
							<td>{{ $diklat->tempat_pelaksanaan }}</td>
						</tr>
						<tr>
							<td>Durasi</td>
							<td>{{ $diklat->durasi }}</td>
						</tr>
						<tr>
							<td>JPL</td>
							<td>{{ $diklat->jpl }}</td>
						</tr>
						<tr>
							<td>Nomor Sertifikat</td>
							<td>{{ $diklat->nomor_sertifikat }}</td>
						</tr>
						<tr>
							<td>Tanggal Sertifikat</td>
							<td>{{ $diklat->tanggal_sertifikat }}</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</dib>
</div>