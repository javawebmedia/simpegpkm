<?php 
use App\Libraries\Website;
$website = new App\Libraries\Website(); 
?>


<div class="row">
	<div class="col-md-8">
		<div class="card">
			<div class="card-header bg-light"><strong>DATA PEGAWAI</strong></div>
			<div class="card-body">
				<table class="table table-sm tabelku"> 
					<tbody>
						<tr>
							<td class="bg-light" width="25%">Nama Pegawai</td>
							<td><?php echo $pegawai->nama_lengkap ?></td>
						</tr>
						<tr>
							<td class="bg-light">NIP / PIN</td>
							<td><?php echo $pegawai->nip ?> / <?php echo $pegawai->pin ?></td>
						</tr>
						<tr>
							<td class="bg-light">Nama Divisi</td>
							<td><?php echo $pegawai->nama_divisi ?></td>
						</tr>
						<tr>
							<td class="bg-light">Nama Jabatan</td>
							<td><?php echo $pegawai->nama_jabatan ?></td>
						</tr>
						<tr>
							<td class="bg-light">Shift &amp; Periode Jadwal Kerja</td>
							<td><?php echo $pegawai->status_shift ?> / 
								<?php 
								if($bulan=='01') {
									echo 'Januari';
								}elseif($bulan=='02') {
									echo 'Februari';
								}elseif($bulan=='03') {
									echo 'Maret';
								}elseif($bulan=='04') {
									echo 'April';
								}elseif($bulan=='05') {
									echo 'Mei';
								}elseif($bulan=='06') {
									echo 'Juni';
								}elseif($bulan=='07') {
									echo 'Juli';
								}elseif($bulan=='08') {
									echo 'Agustus';
								}elseif($bulan=='09') {
									echo 'September';
								}elseif($bulan=='10') {
									echo 'Oktober';
								}elseif($bulan=='11') {
									echo 'November';
								}elseif($bulan=='12') {
									echo 'Desember';
								}
								?>
								<?php echo $tahun ?>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="card">
			<div class="card-header bg-light"><strong>REKAP KEHADIRAN &amp; ABSENSI</strong></div>
			<div class="card-body">
				<?php 
				$total 	= $m_kehadiran->pegawai_thbl($pegawai->pin,$thbl);
				$hadir 	= $m_kehadiran->pegawai_thbl_status($pegawai->pin,$thbl,'Hadir');
				$alpa 	= $m_kehadiran->pegawai_thbl_status($pegawai->pin,$thbl,'Alpa');
				$sakit 	= $m_kehadiran->pegawai_thbl_status($pegawai->pin,$thbl,'Sakit');
				$izin 	= $m_kehadiran->pegawai_thbl_status($pegawai->pin,$thbl,'Izin'); 
				$total_all 	= $hadir->total_status_kehadiran + $izin->total_status_kehadiran + $sakit->total_status_kehadiran + $alpa->total_status_kehadiran;
				?>
				<table class="table table-sm tabelku">
					<tbody>
						<tr>
							<td width="40%">Hadir</td>
							<td><?php echo $hadir->total_status_kehadiran ?></td>
						</tr>
						<tr>
							<td>Izin</td>
							<td><?php echo $izin->total_status_kehadiran ?></td>
						</tr>
						<tr>
							<td>Sakit</td>
							<td><?php echo $sakit->total_status_kehadiran ?></td>
						</tr>
						<tr>
							<td>Alpa</td>
							<td><?php echo $alpa->total_status_kehadiran ?></td>
						</tr>
						<tr class="font-weight-bold bg-light">
							<td>Total</td>
							<td><?php echo $total_all ?></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
