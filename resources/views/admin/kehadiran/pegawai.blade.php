@include('admin/kehadiran/profil-pegawai')
<?php 
use App\Libraries\Website;
$website = new App\Libraries\Website(); 
?>
<div class="card">
	<div class="card-header bg-light"><strong>REKAP DATA KEHADIRAN PEGAWAI</strong></div>
	<div class="card-body">

		<table class="table table-sm tabelku" id="example1">
			<thead>
				<tr>
					<th>Hari</th>
					<th>Tanggal</th>
					<th>Jadwal</th>
					<th>Aktifitas</th>
					<th>Datang</th>
					<th>Pulang</th>
					<th>Terlambat</th>
					<th>Pulang Cepat</th>
					<th>Lembur</th>
					<th>Total Jam</th>
					<th>No Surat</th>
					<th>Catatan</th>
				</tr>
			</thead>
			<tbody>

				<?php 
				foreach($kehadiran as $kehadiran) { 
					$hadir 	= $m_status_absen->jenis_status_absen('Kehadiran');
					$absen 	= $m_status_absen->jenis_status_absen('Absensi');
				?>
				<tr>
					<td><?php echo $website->get_hari($kehadiran->tanggal_masuk) ?></td>
					<td><?php echo $website->tanggal_id($kehadiran->tanggal_masuk) ?></td>
					<td><?php echo date('H:i',strtotime($kehadiran->jam_mulai)) ?> - <?php echo date('H:i',strtotime($kehadiran->jam_selesai)) ?></td>
					<td><?php echo $kehadiran->kehadiran ?></td>
					<td><?php if($kehadiran->kehadiran != 'OFF') { echo date('H:i:s',strtotime($kehadiran->tanggal_jam_masuk)); } ?></td>
					<td><?php if($kehadiran->kehadiran != 'OFF') { echo date('H:i:s',strtotime($kehadiran->tanggal_jam_keluar)); } ?></td>
					<td><?php if($kehadiran->kehadiran != 'OFF') { if($kehadiran->jumlah_menit_terlambat >= 1) { echo $website->angka($kehadiran->jumlah_menit_terlambat); }} ?></td>
					<td><?php if($kehadiran->kehadiran != 'OFF') { if($kehadiran->jumlah_menit_pulang_cepat >= 1) { echo $website->angka($kehadiran->jumlah_menit_pulang_cepat); }} ?></td>
					<td><?php if($kehadiran->kehadiran != 'OFF') { if($kehadiran->lembur >= 1) { echo $website->angka($kehadiran->lembur); }} ?></td>
					<td><?php if($kehadiran->kehadiran != 'OFF') { echo $website->angka($kehadiran->total_jam_kerja); } ?></td>
					<td class="text-sm"><?php if($kehadiran->kehadiran != 'OFF') { echo $kehadiran->nomor_surat; } ?></td>
					<td class="text-sm"><?php if($kehadiran->kehadiran != 'OFF') { echo $kehadiran->nama_status_absen; } ?></td>
				</tr>
					
				<?php } ?>
			</tbody>
		</table>
		

	</div>
</div>









