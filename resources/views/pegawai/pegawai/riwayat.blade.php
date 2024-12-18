<p class="text-right">
	<a href="{{ asset('pegawai/pegawai/edit') }}" class="btn btn-warning btn-sm">
		<i class="fa fa-edit"></i> Edit
	</a>
	<a href="{{ asset('pegawai/pegawai/cetak-riwayat') }}" class="btn btn-success btn-sm" target="_blank">
		<i class="fa fa-print"></i> Cetak
	</a>
	<a href="{{ asset('pegawai/pegawai/unduh-riwayat') }}" class="btn btn-danger btn-sm"  target="_blank">
		<i class="fa fa-file-pdf"></i> Unduh PDF
	</a>
	<a href="{{ asset('pegawai/pegawai') }}" class="btn btn-outline-info btn-sm">
		<i class="fa fa-arrow-left"></i> Kembali
	</a>
</p>

<div class="row">
	<div class="col-md-3 text-center">
		<div class="card">
			<div class="card-body">
				<p>
					<img src="{{ asset('assets/upload/images/'.$pegawai->foto) }}" alt="{{ $pegawai->nama_lengkap }}" class="img img-thumbnail">
				</p>
				<p>
					<strong>{{$pegawai->gelar_depan}} {{$pegawai->nama_lengkap}} {{$pegawai->gelar_belakang }}</strong>
					<br>NIP: {{ $pegawai->nip }}
				</p>
			</div>
		</div>
	</div>
	<div class="col-md-9">
		<div class="card">
			<div class="card-body">

				<table class="table table-sm tabelku">
					<tbody>
						<tr>
							<td width="25%">Nama lengkap</td>
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
	</div>

	<!-- load data riwayat -->
	<div class="col-md-12 mt-5 mb-5">
		@include('pegawai/pegawai/jabatan')
		@include('pegawai/pegawai/pendidikan')
		@include('pegawai/pegawai/keluarga')
	</div>
	<!-- end load -->
</div>

