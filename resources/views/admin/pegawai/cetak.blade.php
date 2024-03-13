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
	</page>
</body>
</html>