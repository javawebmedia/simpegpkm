<p class="text-right">
	<a href="{{ asset('pegawai/pegawai/edit/'.$pegawai->id_pegawai) }}" class="btn btn-warning btn-sm">
		<i class="fa fa-edit"></i> Edit
	</a>
	<a href="{{ asset('pegawai/pegawai/cetak-riwayat/'.$pegawai->id_pegawai) }}" class="btn btn-success btn-sm" target="_blank">
		<i class="fa fa-print"></i> Cetak
	</a>
	<a href="{{ asset('pegawai/pegawai/unduh-riwayat/'.$pegawai->id_pegawai) }}" class="btn btn-danger btn-sm"  target="_blank">
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
					<strong>{{ $pegawai->nama_lengkap }}</strong>
					<br>NIP: {{ $pegawai->nip }}
				</p>
			</div>
		</div>
	</div>
	<div class="col-md-9">
		<div class="card">
			<div class="card-body">

				<table class="table table-bordered table-striped table-sm">
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
						<tr>
							<td>NPWP</td>
							<td>{{ $pegawai->npwp }}</td>
						</tr>
						<tr>
							<td>Nomor Rekening</td>
							<td>{{ $pegawai->rekening }}</td>
						</tr>

					</tbody>
				</table>

			</div>
		</div>
	</div>
	<!-- data riwayat -->
	<div class="col-md-12">
		<h3>Riwayat Jabatan</h3>
		<hr>
		
		<table class="table table-bordered table-striped table-sm">
			<thead>
				<tr class="text-center">
					<th width="2%">No</th>
					<th>TMT</th>
					<th>Jabatan</th>
					<th>Jenis</th>
					<th>Divisi</th>
					<th>Eselon</th>
					<th>Pangkat</th>
					<th>No SK</th>
					<th>Tgl SK</th>
				</tr>
			</thead>
			<tbody>
				<?php $no=1; foreach($riwayat_jabatan as $riwayat_jabatan) { ?>
				<tr>
					<td class="text-center">{{ $no }}</td>
					<td class="text-center">{{ date('d-m-Y',strtotime($riwayat_jabatan->tmt) )}}</td>
					<td>{{ $riwayat_jabatan->nama_jabatan }}</td>
					<td>{{ $riwayat_jabatan->jenis_jabatan }}</td>
					<td>{{ $riwayat_jabatan->nama_divisi }}</td>
					<td class="text-center">{{ $riwayat_jabatan->eselon }}</td>
					<td class="text-center">{{ $riwayat_jabatan->golongan }}/{{ $riwayat_jabatan->ruang }}</td>
					<td class="text-center">{{ $riwayat_jabatan->nomor_sk }}</td>
					<td class="text-center">{{ date('d-m-Y',strtotime($riwayat_jabatan->tanggal_sk) )}}</td>
				</tr>
				<?php $no++; } ?>
			</tbody>
		</table>
	</div>

	<div class="col-md-12">
		<h3>Riwayat Pendidikan</h3><hr>

		<table class="table table-bordered table-striped table-sm">
			<thead>
				<tr class="text-center">
					<th width="2%">No</th>
					<th>Tgl Lulus</th>
					<th>Sekolah/Institusi</th>
					<th>Jenjang</th>
					<th>Jenis</th>
					<th>No. Ijazah</th>
					<th>Kota</th>
					<th>Tahun Masuk</th>
					<th>Tahun Lulus</th>
				</tr>
			</thead>
			<tbody>
				<?php $no=1; foreach($pendidikan as $pendidikan) { ?>
				<tr>
					<td class="text-center">{{ $no }}</td>
					<td class="text-center">{{ date('d-m-Y',strtotime($pendidikan->tanggal_lulus) )}}</td>
					<td>{{ $pendidikan->nama_sekolah }}</td>
					<td>{{ $pendidikan->nama_jenjang_pendidikan }}</td>
					<td>{{ $pendidikan->jenis_pendidikan }}</td>
					<td>{{ $pendidikan->nomor_ijazah }}</td>
					<td class="text-center">{{ $pendidikan->kota_sekolah }}</td>
					<td class="text-center">{{ $pendidikan->tahun_masuk }}</td>
					<td class="text-center">{{ $pendidikan->tahun_lulus }}</td>
				</tr>
				<?php $no++; } ?>
			</tbody>
		</table>
	</div>

	<div class="col-md-12">
		<h3>Data Keluarga</h3><hr>

		<table class="table table-bordered table-striped table-sm">
			<thead>
				<tr class="text-center">
					<th width="2%">No</th>
					<th>Hub. Keluarga</th>
					<th>NIK/ Nama Lengkap</th>
					<th>Tempat &amp; Tanggal Lahir</th>
					<th>Jenis Kelamin</th>
					<th>Agama</th>
					<th>Pendidikan</th>
					<th>Pekerjaan</th>
					<th>Status Perkawinan</th>
				</tr>
			</thead>
			<tbody>
				<?php $no=1; foreach($keluarga as $keluarga) { ?>
				<tr>
					<td class="text-center">{{ $no }}</td>
					<td class="text-center">{{ $keluarga->nama_hubungan_keluarga }}</td>
					<td>
						{{ $keluarga->nama_lengkap }} <br>
						<strong class="text-primary">{{ $keluarga->nik }}</strong>
					</td>
					<td>
						{{ $keluarga->tempat_lahir }}, <br>
						{{ date('d-m-Y',strtotime($keluarga->tanggal_lahir) )}}
					</td>
					<td>{{ $keluarga->jenis_kelamin }}</td>
					<td>{{ $keluarga->nama_agama }}</td>
					<td class="text-center">{{ $keluarga->nama_jenjang_pendidikan }}</td>
					<td class="text-center">{{ $keluarga->nama_pekerjaan }}</td>
					<td class="text-center">{{ $keluarga->status_perkawinan }}</td>
				</tr>
				<?php $no++; } ?>
			</tbody>
		</table>
	</div>
</div>