<?php 
use Illuminate\Support\Facades\DB;
$site_config = DB::table('konfigurasi')->first();
?>
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
		<h1>{{ $site_config->namaweb }}
			<br>{{ $site_config->tagline }}</h1>
			<br>

		<table class="printer">
			<tbody>
				<tr>
					<th class="bg-light" width="25%">Nama pegawai</th>
					<td>{{ $bawahan->nama_lengkap }}</td>
				</tr>
				<tr>
					<th class="bg-light">NIP / NRK</th>
					<td>{{ $bawahan->nip }} / {{ $bawahan->nrk }}</td>
				</tr>
				<tr>
					<th class="bg-light">Divisi</th>
					<td>{{ $bawahan->nama_divisi }}</td>
				</tr>
				<tr>
					<th class="bg-light">Jabatan</th>
					<td>{{ $bawahan->nama_jabatan }}</td>
				</tr>
			</tbody>
		</table>

		<table class="printer">
			<thead>
				<tr class="bg-secondary text-center align-middle">
					<th width="2%">No</th>
					<th width="20%">Aktivitas</th>
					<th width="5%">Standar</th>
					<th width="13%">Mulai</th>
					<th width="13%">Selesai</th>
					<th width="5%">Menit</th>
					<th width="5%">Volume</th>
					<th width="10%">Catatan</th>
					<th width="5%">Jenis</th>
					<th width="5%">Status</th>
					<th>Jumlah Menit Disetujui</th>
				</tr>
			</thead>
			<tbody>
				<?php $no=1; foreach($kinerja as $kinerja) { ?>
				<tr>
					<td class="text-center">{{ $no }}</td>
					<td>{{ $kinerja->nama_aktivitas }}</td>
					<td class="text-center">{{ $kinerja->waktu }}</td>
					<td class="text-center">{{ date('d-m-Y',strtotime($kinerja->tanggal_kinerja)) }}<br>{{ $kinerja->jam_mulai }}</td>
					<td class="text-center">{{ date('d-m-Y',strtotime($kinerja->tanggal_selesai)) }}<br>{{ $kinerja->jam_selesai }}</td>
					<td class="text-center">{{ $kinerja->jumlah_menit }}</td>
					<td class="text-center">{{ $kinerja->volume }}</td>
					<td>{{ $kinerja->keterangan }}</td>
					<td>{{ $kinerja->jenis_aktivitas }}</td>
					<td class="text-center">
						<?php 
						if($kinerja->status_approval=='Disetujui') {
							$warna = 'success';
							$icon 	= 'fa fa-check-circle';
						}elseif($kinerja->status_approval=='Ditolak') {
							$warna = 'danger';
							$icon 	= 'fa fa-times-circle';
						}elseif($kinerja->status_approval=='Menunggu') {
							$warna = 'info';
							$icon 	= 'fa fa-clock';
						}elseif($kinerja->status_approval=='Dikembalikan') {
							$warna = 'warning';
							$icon 	= 'fas fa-exclamation-circle';
						}  
						?>
						<small class="badge badge-{{ $warna; }}"><i class="{{ $icon; }}"></i> 
							{{ $kinerja->status_approval }} </small>
						<small class="text-danger"><br>{{ $kinerja->catatan_atasan }}</small>
					</td>
					<td>{{ $kinerja->jumlah_menit_disetujui }}</td>
				</tr>
				<?php $no++; } ?>
			</tbody>
		</table>
	</page>
</body>
</html>