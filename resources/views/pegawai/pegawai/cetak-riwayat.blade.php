<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>{{ $title }}</title>
	<!-- css screen -->
	<link rel="stylesheet" media="screen" href="{{ asset('assets/css/css-print.css') }}">
	<!-- css print -->
	<link rel="stylesheet" media="print" href="{{ asset('assets/css/css-print.css') }}">
</head>
<body onload="print()">
	<page size="A4">
		<h1>SISTEM INFORMASI PEGAWAI
			<br>PUSKESMAS KECAMATAN KRAMAT JATI</h1>
			<br>

		<table class="printer">
			<tbody>
				<tr>
					<td rowspan="9" style="width: 4cm; text-align: center; vertical-align:top;">
						<img src="{{ asset('assets/upload/images/'.$pegawai->foto) }}" alt="{{ $pegawai->nama_lengkap }}" style="width: 3.8cm; height: auto;">
					</td>
					<td width="25%" class="bg-gray">Nama lengkap</td>
					<td>{{ $pegawai->nama_lengkap }}</td>
				</tr>
				<tr>
					<td class="bg-gray">NIP</td>
					<td>{{ $pegawai->nip }}</td>
				</tr>
				<tr>
					<td class="bg-gray">NRK</td>
					<td>{{ $pegawai->nrk }}</td>
				</tr>
				<tr>
					<td class="bg-gray">NIK</td>
					<td>{{ $pegawai->nik }}</td>
				</tr>
				<tr>
					<td class="bg-gray">Jenis Pegawai</td>
					<td>{{ $pegawai->jenis_pegawai }}</td>
				</tr>
				<tr>
					<td class="bg-gray">Status Pegawai</td>
					<td>{{ $pegawai->status_pegawai }}</td>
				</tr>
				<tr>
					<td class="bg-gray">Status Perkawinan</td>
					<td>{{ $pegawai->status_perkawinan }}</td>
				</tr>
				<tr>
					<td class="bg-gray">Tempat, tanggal lahir</td>
					<td>{{ $pegawai->tempat_lahir }}, {{ date('d-m-Y',strtotime($pegawai->tanggal_lahir)) }}</td>
				</tr>
				<tr>
					<td class="bg-gray">TMT Pegawai</td>
					<td>{{ date('d-m-Y',strtotime($pegawai->tmt_masuk)) }}</td>
				</tr>
			</tbody>
		</table>

		<h4>Riwayat Jabatan</h4>
		<table class="printer">
			<thead>
				<tr class="text-center">
					<th >No</th>
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

		<h4>Riwayat Pendidikan</h4>
		<table class="printer">
			<thead>
				<tr class="text-center">
					<th >No</th>
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

			<h3>Data Keluarga</h3>
			<table class="printer">
				<thead>
					<tr class="text-center">
						<th >No</th>
						<th>Hubungan</th>
						<th>NIK/ Nama Lengkap</th>
						<th>TTL</th>
						<th>L/P</th>
						<th>Agama</th>
						<th>Pendidikan</th>
						<th>Pekerjaan</th>
						<th>Perkawinan</th>
					</tr>
				</thead>
				<tbody>
					<?php $no=1; foreach($keluarga as $keluarga) { ?>
						<tr>
							<td class="text-center">{{ $no }}</td>
							<td class="text-center">{{ $keluarga->nama_hubungan_keluarga }}</td>
							<td>{{ $keluarga->nama_lengkap }} <br>
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
	</page>
</body>
</html>