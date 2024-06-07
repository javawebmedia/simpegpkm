<table class="table table-sm tabelku">
	<tbody>
		<tr>
			<th class="bg-light" width="25%">Tahun Gaji</th>
			<td>{{ $tahun }}</td>
		</tr>
		<tr>
			<th class="bg-light">Bulan Gaji</th>
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
				}else{
					echo 'Semua Bulan';
				}
				?>
			</td>
		</tr>
	</tbody>
</table>

<form action="{{ asset('pegawai/gaji') }}" method="get">

<hr>

<div class="input-group">

	<select name="bulan" class="form-control col-md-3 bg-light" required>
		<option value="Semua">Semua Bulan</option>
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
		<button type="submit" class="btn btn-info btn-flat" name="thbl" value="submit">
			<i class="fa fa-arrow-right"></i> Lihat Data Gaji
		</button>

		

	</span>

</div>


<?php if($gaji_pegawai) { ?>

<hr>
<h3>Data Gaji</h3>

<table class="table table-sm tabelku table-striped">
	<thead class="text-center bg-secondary align-middle">
		<tr>
			<th width="5%" class="align-middle">NPWP</th>
			<th width="5%" class="align-middle">REKENING</th>
			<th width="5%" class="align-middle">GAJI</th>
			<th width="5%" class="align-middle">TUNJ. KELUARGA</th>
			<th width="5%" class="align-middle">TUNJ. JABATAN</th>
			<th width="5%" class="align-middle">JML BRUTO</th>
			<th width="5%" class="align-middle">PPH21</th>
			<th width="5%" class="align-middle">TOTAL POTONGAN</th>
			<th width="5%" class="align-middle">JML TERIMA</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td><?php echo $gaji_pegawai->npwp;  ?></td>
			<td><?php echo $gaji_pegawai->rekening;  ?></td>
			<td class="text-right"><?php echo number_format($gaji_pegawai->gaji); ?></td>
			<td class="text-right"><?php echo number_format($gaji_pegawai->tunjangan_keluarga); ?></td>
			<td class="text-right"><?php echo number_format($gaji_pegawai->tunjangan_jabatan); ?></td>
			<td class="text-right"><?php echo number_format($gaji_pegawai->gaji_bruto);  ?></td>
			<td class="text-right"><?php echo number_format($gaji_pegawai->pph21);  ?></td>
			<td class="text-right"><?php echo number_format($gaji_pegawai->total_potongan);  ?></td>
			<td class="text-right"><?php  echo number_format($gaji_pegawai->jumlah_diterima); ?>
			</td>
		</tr>
	</tbody>
</table>

<?php }  if($tkd) { ?>

<hr>
<h3>Data TKD</h3>
<table class="table table-sm tabelku table-striped">
	<thead class="text-center bg-secondary align-middle">
		<tr>
			<th rowspan="2" width="5%" class="align-middle">GAPOK</th>
			<th rowspan="2" width="5%" class="align-middle">PENGALI</th>
			<th colspan="4"width="16%" class="align-middle">KEHADIRAN</th>
			<th rowspan="2" width="5%" class="align-middle">KINERJA</th>
			<th rowspan="2" width="5%" class="align-middle">TKD</th>
			<th rowspan="2" width="5%" class="align-middle">POTONGAN</th>
			<th rowspan="2" width="5%" class="align-middle">TKD BRUTO</th>
			<th colspan="4"width="16%" class="align-middle">POTONGAN</th>
			<th rowspan="2" width="5%" class="align-middle">TKD NET</th>
		</tr>
		<tr>
			<th class="text-center" width="4%">T</th>
			<th class="text-center" width="4%">S</th>
			<th class="text-center" width="4%">I</th>
			<th class="text-center" width="4%">A</th>
			<th class="text-center">PPH 21</th>
			<th class="text-center">BPJS KES</th>
			<th class="text-center">BPJS TK</th>
			<th class="text-center">TOTAL</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td class="text-right"><?php echo number_format($tkd->gapok); ?></td>
			<td><?php echo number_format($tkd->pengali,2) ?></td>
			
			<td class="text-center"><?php echo $tkd->terlambat; ?></td>
			<td class="text-center"><?php echo $tkd->sakit; ?></td>
			<td class="text-center"><?php echo $tkd->izin;  ?></td>
			<td class="text-center"><?php echo $tkd->alpa;  ?></td>
			<td class="text-center"><?php echo number_format($tkd->kinerja,2); ?>%</td>
			<td class="text-right"><?php echo number_format($tkd->tkd_kotor); ?></td>
			<td class="text-right"><?php echo number_format($tkd->potongan_absen); ?></td>
			<td class="text-right"><?php echo number_format($tkd->tkd_kotor); ?></td>
			<td class="text-right"><?php echo number_format($tkd->pph21); ?></td>
			<td class="text-right"><?php echo number_format($tkd->potongan_bpjs);  ?></td>
			<td class="text-right"><?php echo number_format($tkd->potongan_bpjs_tk);  ?></td>
			<td class="text-right"><?php echo number_format($tkd->total_potongan);  ?></td>
			<td class="text-right"><?php echo number_format($tkd->tkd_bersih);  ?></td>
		</tr>
	</tbody>
</table>

<?php } ?>

</form>