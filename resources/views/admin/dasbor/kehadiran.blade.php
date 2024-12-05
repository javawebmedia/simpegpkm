<?php 
use App\Models\Pegawai_model;
use App\Models\Absensi_model;
$tahun 			= date('Y');
$bulan 			= date('m');
$hari 		= date('d');
$thbl			= $tahun.$bulan;
$m_kehadiran 	= new Absensi_model();
$absensi 		= $m_kehadiran->ranking($thbl);
$absensi2 		= $m_kehadiran->ranking($thbl);
$absensi_hari 	= $m_kehadiran->ranking_hari($hari);
$absensi_bulan	= $m_kehadiran->ranking_bulan($bulan);
//echo $thbl;
?>

<table class="table table-sm tabelku" id="example1">
	<thead>
		<tr class="bg-secondary text-center align-middle">
			<th width="5%">No</th>
			<th width="20%">Nama</th>
			<th width="10%">Menit Terlambat</th>
			
		</tr>
	</thead>
	<tbody>
		<?php $no=1; foreach($absensi as $absensi) { ?>
		<tr>
			<td class="text-center">{{ $no }}</td>
			<td>{{ $absensi->nama_lengkap }}
					<small>
						<br>NIP: <?php echo $absensi->nip ?>
					</small>
			</td>
			<td class="text-center"><?php echo $absensi->menit_terlambat ?></td>
			
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>
</div>

</form>