<form action="{{ asset('admin/jadwal-pegawai/lihat/'.$tahun.'/'.$bulan) }}" method="get" accept-charset="utf-8" class="mt-2 mb-2">
	{{ csrf_field() }}
	<input type="hidden" name="thbl" value="<?php echo $thbl ?>">
	<div class="input-group">
		<select name="bulan" class="form-control col-md-3 bg-light" required>
			<option value="">Pilih Bulan</option>
			<option value="01" <?php if($bulan=='01') { echo 'selected'; } ?>>Januari</option>
			<option value="02" <?php if($bulan=='02') { echo 'selected'; } ?>>Februari</option>
			<option value="03" <?php if($bulan=='03') { echo 'selected'; } ?>>Maret</option>
			<option value="04" <?php if($bulan=='04') { echo 'selected'; } ?>>April</option>
			<option value="05" <?php if($bulan=='05') { echo 'selected'; } ?>>Mei</option>
			<option value="06" <?php if($bulan=='06') { echo 'selected'; } ?>>Juni</option>
			<option value="07" <?php if($bulan=='07') { echo 'selected'; } ?>>Juli</option>
			<option value="08" <?php if($bulan=='08') { echo 'selected'; } ?>>Agustus</option>
			<option value="09" <?php if($bulan=='09') { echo 'selected'; } ?>>September</option>
			<option value="10" <?php if($bulan=='10') { echo 'selected'; } ?>>Oktober</option>
			<option value="11" <?php if($bulan=='11') { echo 'selected'; } ?>>November</option>
			<option value="12" <?php if($bulan=='12') { echo 'selected'; } ?>>Desember</option>
		</select>
		<input type="number" class="form-control" name="tahun" value="{{ $tahun }}" placeholder="Tahun">
		<span class="input-group-append">
			<button type="submit" class="btn btn-info btn-flat" name="submit" value="submit">
				<i class="fa fa-arrow-right"></i> Lihat Jadwal Kerja
			</button>
			<a href="{{ asset('admin/jadwal-pegawai') }}" class="btn btn-outline-info">
				<i class="fa fa-arrow-left"></i> Kembali
			</a>
		</span>
	</div>
</form>

<?php 
$jumlah_hari    = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
$semua_tanggal = [];
for ($hari = 1; $hari <= $jumlah_hari; $hari++) {
    $tanggal = sprintf('%04d-%02d-%02d', $tahun, $bulan, $hari);
    $semua_tanggal[] = $tanggal;
}
// Menampilkan semua tanggal
?>
<div class="table-responsive">
<table class="table table-sm tabelku mt-3">
	<thead>
		<tr>
			<th>PIN</th>
			<th>NAMA</th>
			<?php foreach ($semua_tanggal as $tanggal) { ?>
				<th class="text-center"><?php echo date('d',strtotime($tanggal)) ?></th>
			<?php } ?>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($pegawai as $pegawai) { ?>
		<tr>
			<td><?php echo $pegawai->pin ?></td>
			<td><?php echo $pegawai->nama_lengkap ?></td>
			<?php foreach ($semua_tanggal as $tanggal) {
				$check              = $m_jadwal_pegawai->check_tanggal($pegawai->pin,$tanggal);
			 ?>
				<th class="text-center">
					<?php if($check) { ?>
					<i class="badge badge-light">
						<i class="far fa-square" style="background-color: <?php echo $check->warna ?>;"></i> <?php echo $check->kode ?>
					</i>
				<?php } ?>
				</th>
			<?php } ?>
			<td>
				<a href="{{ asset('admin/jadwal-pegawai/lihat/'.$pegawai->id_pegawai.'/'.$tahun.'/'.$bulan) }}" class="btn btn-secondary btn-xs"><i class="fa fa-eye"></i></a>
				<a href="{{ asset('admin/jadwal-pegawai/tambah/'.$pegawai->id_pegawai.'/'.$tahun.'/'.$bulan) }}" class="btn btn-secondary btn-xs"><i class="fa fa-calendar-check"></i> Atur Jadwal</a>
			</td>
		</tr>
		<?php } ?>
	</tbody>
</table>
</div>
