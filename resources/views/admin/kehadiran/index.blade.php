<p class="text-right">
	<a href="{{ asset('admin/kehadiran') }}" class="btn btn-outline-info btn-sm"><i class="fa fa-arrow-left"></i> Kembali</a>
	<a href="{{ asset('admin/kehadiran/import') }}" class="btn btn-outline-success btn-sm"><i class="fa fa-file-excel"></i> Import</a>
</p>

<table class="table table-sm tabelku">
	<tbody>
		<tr>
			<th class="bg-light" width="25%">Tahun Absensi</th>
			<td>{{ $tahun }}</td>
		</tr>
		<tr>
			<th class="bg-light">Bulan Absensi</th>
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
			</td>
		</tr>
	</tbody>
</table>

<form action="{{ asset('admin/kehadiran/tambah') }}" method="get" accept-charset="utf-8" class="mt-2">
	{{ csrf_field() }}

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
			<button type="submit" class="btn btn-success btn-flat" name="submit" value="lihat">
				<i class="fa fa-eye"></i> Lihat Data Kehadiran
			</button>

			<button type="submit" class="btn btn-info btn-flat" name="submit" value="submit">
				<i class="fa fa-arrow-right"></i> Generate Data Kehadiran
			</button>

		</span>

	</div>

	<hr>

	<div class="table-responsive mailbox-messages">

		<table class="table table-sm tabelku" id="example1">
			<thead>
				<tr class="bg-secondary text-center align-middle">
					<th width="5%" class="align-middle">No</th>
					<th width="30%" class="align-middle">Nama</th>
					<th width="10%" class="align-middle text-center">Jam Kerja (Menit)</th>
					<th width="10%" class="align-middle text-center">Terlambat</th>
					<th width="10%" class="align-middle text-center">Pulang Cepat</th>
					<th width="10%" class="align-middle text-center">Kehadiran</th>
					<th width="10%" class="align-middle text-center">Sakit</th>
					<th width="10%" class="align-middle text-center">Izin</th>
					<th width="10%" class="align-middle text-center">Alpa</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$no=1; foreach($pegawai as $pegawai) { 
					$total 	= $m_kehadiran->pegawai_thbl($pegawai->pin,$thbl);
					$hadir 	= $m_kehadiran->pegawai_thbl_status($pegawai->pin,$thbl,'Hadir');
					$alpa 	= $m_kehadiran->pegawai_thbl_status($pegawai->pin,$thbl,'Alpa');
					$sakit 	= $m_kehadiran->pegawai_thbl_status($pegawai->pin,$thbl,'Sakit');
					$izin 	= $m_kehadiran->pegawai_thbl_status($pegawai->pin,$thbl,'Izin');
					?>
					<tr>
						<td class="text-center">{{ $no }}</td>
						<td>{{ $pegawai->nama_lengkap }} (PIN: <?php echo $pegawai->pin ?>)</td>
						<td class="text-center"><?php echo $total->total_jam_kerja ?></td>
						<td class="text-center"><?php echo $total->total_jumlah_menit_terlambat ?></td>
						<td class="text-center"><?php echo $total->total_jumlah_menit_pulang_cepat ?></td>
						<td class="text-center"><?php echo $hadir->total_status_kehadiran ?></td>
						<td class="text-center"><?php echo $sakit->total_status_kehadiran ?></td>
						<td class="text-center"><?php echo $izin->total_status_kehadiran ?></td>
						<td class="text-center"><?php echo $alpa->total_status_kehadiran ?></td>
						<td>
						<?php if($total->total_jam_kerja =='') { ?>
							<a href="#" class="btn btn-secondary disabled btn-xs"><i class="fa fa-eye"></i></a>
						<?php }else{ ?>
							<a href="{{ asset('admin/kehadiran/detail/'.$pegawai->pin.'/'.$tahun.'/'.$bulan) }}" class="btn btn-warning btn-xs"><i class="fa fa-eye"></i></a>
						<?php } ?>
						</td>
					</tr>
					<?php $no++; } ?>
				</tbody>
			</table>
		</div>

	</form>

