<?php 
use App\Libraries\Website;
$website = new App\Libraries\Website(); 
?>
<p class="text-right">
	<a href="{{ asset('admin/kehadiran?bulan='.$bulan.'&tahun='.$tahun.'&submit=lihat') }}" class="btn btn-outline-info btn-sm">
		<i class="fa fa-arrow-left"></i> Kembali
	</a>
</p>

<table class="table table-sm tabelku"> 
	<tbody>
		<tr>
			<td class="bg-light" width="25%">Nama Pegawai</td>
			<td><?php echo $pegawai->nama_lengkap ?></td>
		</tr>
		<tr>
			<td class="bg-light">NIP</td>
			<td><?php echo $pegawai->nip ?></td>
		</tr>
		<tr>
			<td class="bg-light">PIN</td>
			<td><?php echo $pegawai->pin ?></td>
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
			<td class="bg-light">Shift?</td>
			<td><?php echo $pegawai->status_shift ?></td>
		</tr>
		<tr>
			<td class="bg-light">Periode Jadwal Kerja</td>
			<td>
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

<form action="{{ asset('admin/kehadiran/proses-rekap') }}" method="post" accept-charset="utf-8" class="mt-2">
	{{ csrf_field() }}

<input type="hidden" name="thbl" value="<?php echo $thbl ?>">
<input type="hidden" name="tahun" value="<?php echo $tahun ?>">
<input type="hidden" name="bulan" value="<?php echo $bulan ?>">
<input type="hidden" name="pin" value="<?php echo $pegawai->pin ?>">
<input type="hidden" name="nip" value="<?php echo $pegawai->nip ?>">
<input type="hidden" name="id_pegawai" value="<?php echo $pegawai->id_pegawai ?>">

<p class="text-right">
	<button class="btn btn-success" type="submit" name="submit">
		<i class="fa fa-save"></i> Simpan Data Kehadiran
	</button>
</p>

<div class="row">
	<?php 
	foreach($kehadiran as $kehadiran) { 
		$hadir 	= $m_status_absen->jenis_status_absen('Kehadiran');
		$absen 	= $m_status_absen->jenis_status_absen('Absensi');
	?>
		<div class="col-md-1">
			<small>
		 	<div class="card <?php if($kehadiran->day_off=='Ya') { echo 'disabled'; } ?>">
		 		<div class="card-header" style="background-color: <?php echo $kehadiran->warna ?>;">
		 			
 					<?php if(strlen($kehadiran->tanggal_jam_masuk) > 6 && strlen($kehadiran->tanggal_jam_keluar) > 6) { ?>
 						<i class="fa fa-check-circle text-success"></i> 
 					<?php }elseif(strlen($kehadiran->tanggal_jam_masuk) < 6 && strlen($kehadiran->tanggal_jam_keluar) < 6) { ?>
 						<i class="fa fa-times-circle text-danger"></i> 
 					<?php }elseif(strlen($kehadiran->tanggal_jam_masuk) < 6 && strlen($kehadiran->tanggal_jam_keluar) > 6) { ?>
 						<i class="fa fa-moon text-primary"></i>  
 					<?php }elseif(strlen($kehadiran->tanggal_jam_masuk) > 6 && strlen($kehadiran->tanggal_jam_keluar) < 6) { ?>
 						<i class="fa fa-sun text-primary"></i>  
 					<?php }else{ ?>

 					<?php } 
 					echo $kehadiran->kode; 
 					?>


		 				
		 		</div>
		 		<div class="card-body text-center p-2">
		 			<?php echo date('d',strtotime($kehadiran->tanggal_masuk)); ?>

		 			<input type="hidden" name="id_kehadiran_<?php echo $kehadiran->id_kehadiran ?>" value="<?php echo $kehadiran->id_kehadiran ?>">

					@include('admin/kehadiran/update')
				</div>
				<div class="card-footer p-2">
					<button type="button" class="btn btn-secondary btn-xs w-100" data-toggle="modal" data-target="#modal-update-<?php echo $kehadiran->id_kehadiran ?>">
					  <i class="fa fa-edit"></i>
					</button>
					

		 		</div>
		 	</div>
		 	</small>
		 </div>
	<?php } ?>
</div>

</form>