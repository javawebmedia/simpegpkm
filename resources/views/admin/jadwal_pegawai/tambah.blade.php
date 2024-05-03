<?php 
use App\Libraries\Website;
$website = new App\Libraries\Website(); 
?>
<p class="text-right">
	<a href="{{ asset('admin/jadwal-pegawai') }}" class="btn btn-outline-info btn-sm">
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

<form action="{{ asset('admin/jadwal-pegawai/proses-tambah') }}" method="post" accept-charset="utf-8" class="mt-2">
	{{ csrf_field() }}

<input type="hidden" name="thbl" value="<?php echo $thbl ?>">
<input type="hidden" name="tahun" value="<?php echo $tahun ?>">
<input type="hidden" name="bulan" value="<?php echo $bulan ?>">
<input type="hidden" name="pin" value="<?php echo $pegawai->pin ?>">
<input type="hidden" name="nip" value="<?php echo $pegawai->nip ?>">
<input type="hidden" name="id_pegawai" value="<?php echo $pegawai->id_pegawai ?>">

<p class="text-right">
	<button class="btn btn-success" type="submit" name="submit">
					<i class="fa fa-save"></i> Simpan Jadwal Kerja
				</button>
</p>
<div class="row">
<?php 
$jumlah_hari    = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
$semua_tanggal = [];
for ($hari = 1; $hari <= $jumlah_hari; $hari++) {
    $tanggal = sprintf('%04d-%02d-%02d', $tahun, $bulan, $hari);
    $semua_tanggal[] = $tanggal;
}
// Menampilkan semua tanggal
?>


		<?php foreach ($semua_tanggal as $tanggal) {
			$shift 			= $m_shift->listing();
			$shift_default 	= $m_shift->shift_default('Ya');
			$day_off 		= $m_shift->day_off('Ya');
			$hari 			= $website->get_hari($tanggal);
			$libur 			= $m_libur->tanggal_libur($tanggal);
			$jumat 			= $m_shift->jumat('Ya');
			$check_jadwal 	= $m_jadwal_pegawai->check_tanggal($pegawai->pin,$tanggal);
		 ?>
		 <div class="col-md-2">
		 	<div class="card">
		 		<div class="card-header <?php if($libur) { echo 'bg-info opacity-70'; }else{ echo 'bg-light'; } ?>">
		 			<small>
		 				<strong>
		 					<?php echo $website->tanggal_bulan($tanggal) ?></td>
		 				</strong>
		 			</small>
		 		</div>
		 		<div class="card-body">
		 			<?php //print_r($libur); ?>
		 			<select name="id_shift_<?php echo str_replace('-','',$tanggal) ?>" class="form-control form-control-sm" required>
						<option value="">Pilih Shift</option>
						<?php foreach($shift as $shift) { ?>
						<option value="<?php echo $shift->id_shift ?>" 
							<?php 
							if(!empty($check_jadwal)) {
								if($check_jadwal->id_shift==$shift->id_shift) {
									echo 'selected';
								}
							}else{
							// End 
							if($hari=='Senin' || $hari=='Selasa' || $hari=='Rabu' || $hari=='Kamis') { 
								if(!empty($libur)) { 
									if(!empty($day_off)) { 
										if($day_off->id_shift == $shift->id_shift) {
											echo 'selected';
										}
									}
								}elseif(!empty($shift_default)) {
									if($shift_default->id_shift == $shift->id_shift) {
										echo 'selected';
									}
								}
							}elseif($hari=='Jumat') {
								if(!empty($jumat)) { 
									if($jumat->id_shift == $shift->id_shift) {
										echo 'selected';
									}
								}
							}elseif($hari=='Sabtu' || $hari=='Minggu') {
								if(!empty($day_off)) { 
									if($day_off->id_shift == $shift->id_shift) {
										echo 'selected';
									}
								}
							} 
							// end 
						}
							?>
							>
							<?php echo $shift->nama ?> (<?php echo $shift->kode ?>: <?php echo $shift->jam_mulai ?> sd <?php echo $shift->jam_selesai ?>)
						</option>
						<?php } ?>
					</select>
		 		</div>
				
					
				</div>
		</div>
		<?php } ?>
		
</div>
</form>