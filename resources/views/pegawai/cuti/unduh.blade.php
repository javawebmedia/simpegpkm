<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo $title ?></title>
	<link rel="stylesheet" href="<?php echo asset('assets/css/css-print.css') ?>">
</head>

<body>
	<page size="F4">

		<table>
			<tbody>
				<tr>
					<td width="40%"></td>
					<td width="12%">
						Lampiran II:
					</td>
					<td width="50%">
						Peraturan Gubernur Provinsi Daerah Khusus
						<br>Ibukota Jakarta
						<br>Nomor 15 TAHUN 2018
						<br>Tanggal 26 Februari 2018
						<br>
						<br>Jakarta, 2 Januari 2024
						<br>Kepada
						<br>Yth. Kepala Puskesmas Kramat Jati
						<br>di Jakarta
					</td>
				</tr>
			</tbody>
		</table>
		<br>
		<h1>FORMULIR PERMINTAAN DAN PEMBERIAN CUTI</h1>
		<table class="printer">
			<thead>
				<tr>
					<th colspan="4">I. DATA PEGAWAI</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td width="15%">Nama</td>
					<td width="35%"><?php echo $pegawai->nama_lengkap ?></td>
					<td width="15%">NIP</td>
					<td width="35%"><?php echo $pegawai->nip ?></td>
				</tr>
				<tr>
					<td>Jabatan</td>
					<td><?php echo $pegawai->nama_jabatan ?></td>
					<td>Masa Kerja</td>
					<td>12 Tahun 3 Hari</td>
				</tr>
				<tr>
					<td>Unit Kerja</td>
					<td><?php echo $pegawai->nama_divisi ?></td>
					<td></td>
					<td></td>
				</tr>
			</tbody>
		</table>

		<table class="printer">
			<thead>
				<tr>
					<th colspan="4">II. JENIS CUTI YANG DIAMBIL</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td width="35%">1. Cuti Tahunan</td>
					<td width="15%"></td>
					<td width="35%">2. Cuti Besar</td>
					<td width="15%"></td>
				</tr>
				<tr>
					<td>3. Cuti Sakit</td>
					<td></td>
					<td>4. Cuti Melahirkan</td>
					<td></td>
				</tr>
				<tr>
					<td>5. Cuti Karena Alasan Penting</td>
					<td></td>
					<td>6. Cuti di Luar Tanggungan Negara</td>
					<td></td>
				</tr>
			</tbody>
		</table>

		<table class="printer">
			<thead>
				<tr>
					<th>III. ALASAN CUTI</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><?php if($cuti->alasan_cuti=='') { echo '-'; }else{ echo $cuti->alasan_cuti; } ?></td>
				</tr>
			</tbody>
		</table>

		<table class="printer">
			<thead>
				<tr>
					<th colspan="6">IV. LAMANYA CUTI</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td width="15%">Selama</td>
					<td width="15%"><?php echo $cuti->total_hari ?> Hari</td>
					<td width="10%">Tanggal</td>
					<td width="15%"></td>
					<td width="5%">s/d</td>
					<td width="15%"></td>
				</tr>
			</tbody>
		</table>

		<table class="printer">
			<thead>
				<tr>
					<th colspan="5">V. CATATAN CUTI</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td colspan="5">1. CUTI TAHUNAN</td>
				</tr>
				<tr>
					<td width="15%">Tahun</td>
					<td width="10%">Sisa</td>
					<td width="15%">Keterangan</td>
					<td width="45%">2. CUTI BESAR</td>
					<td></td>
				</tr>
				<tr>
					<td>N-2</td>
					<td></td>
					<td></td>
					<td>3. CUTI SAKIT</td>
					<td></td>
				</tr>
				<tr>
					<td>N-1</td>
					<td></td>
					<td></td>
					<td>4. CUTI MELAHIRKAN</td>
					<td></td>
				</tr>
				<tr>
					<td>N</td>
					<td></td>
					<td></td>
					<td>5. CUTI KARENA ALASAN PENTING</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td>6. CUTI DI LUAR TANGGUNGAN NEGARA</td>
					<td></td>
				</tr>
			</tbody>
		</table>

		<table class="printer">
			<thead>
				<tr>
					<th>VI. ALAMAT SELAMA MENJALANKAN CUTI</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>-</td>
				</tr>
			</tbody>
		</table>

		<table class="printer">
			<tbody>
				<tr>
					<td width="50%" class="text-center">
						Selama menjalankan cuti, tugas diserahkan:
						<br><br>
						( Aditiyas Rahadi )
						<br>NIP 10205219910428201303076
					</td>
					<td class="text-center">
						Hormat saya,
						<br><br>
						( <?php echo $pegawai->nama_lengkap ?> )
						<br>NIP <?php echo $pegawai->nip ?>
					</td>
				</tr>
			</tbody>
		</table>

		<table class="printer">
			<thead>
				<tr>
					<th colspan="4">VII. PERTIMBANGAN ATASAN LANGSUNG</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td width="15%">DISETUJUI</td>
					<td width="15%">PERUBAHAN</td>
					<td width="15%">DITANGGUHKAN</td>
					<td width="55%">TIDAK DISETUJUI</td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td>
						Ka Sub Bag Tata Usaha Puskesmas Kramat Jati
						<br><br><br><br>
						(Ns. Antik Rachmawati P, S.Kep.,)
						<br>NIP 197211081997032006
					</td>
				</tr>
			</tbody>
		</table>
		<table class="printer">
			<thead>
				<tr>
					<th colspan="4">VIII. KEPUTUSAN PEJABAT YANG BERWENANG MEMBERIKAN CUT</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td width="15%">DISETUJUI</td>
					<td width="15%">PERUBAHAN</td>
					<td width="15%">DITANGGUHKAN</td>
					<td width="55%">TIDAK DISETUJUI</td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td>
						Kepala Puskesmas Puskesmas Kramat Jati
						<br><br><br><br>
						(Ns. Antik Rachmawati P, S.Kep.,)
						<br>NIP 197211081997032006
					</td>
				</tr>
			</tbody>
		</table>
		<table>
			<tbody>
				<tr>
					<td colspan="2">
						<strong>
								Catatan:
							</strong>
					</td>
				</tr>
				<tr>
					<td width="60%">
						<small>
							* Coret yang tidak perlu
							<br>** Pilih salah satu dengan memberi tanda centang (√)
							<br>*** Diisi oleh pejabat yang menangani bidang kepegawaian sebelum PNS mengajukan cuti
							<br>**** Diberi tanda centang dan alasannya.
						</small>
					</td>
					<td>
						<small>
							N = Cuti tahun berjalan
							<br>N-1 = Sisa cuti 1 tahun sebelumnya 
							<br>N = Cuti tahun berjalan
							<br>N-2 = Sisa cuti 2 tahun sebelumnya
						</small>
					</td>
				</tr>
			</tbody>
		</table>
		
			
		</small>
	</page>
</body>
</html>