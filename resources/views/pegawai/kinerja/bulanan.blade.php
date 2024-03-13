<table class="table table-bordered">
	<tbody>
		<tr>
			<th class="bg-light" width="25%">Tahun Kinerja</th>
			<td>{{ $tahun }}</td>
		</tr>
		<tr>
			<th class="bg-light">Bulan Kinerja</th>
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

<form action="{{ asset('pegawai/kinerja/bulanan') }}" method="get">

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
			<i class="fa fa-arrow-right"></i> Lihat Data Kinerja
		</button>

		

	</span>

</div>
</form>

<div class="card mt-5">
	<div class="card-body">


		<table class="table table-bordered table-striped table-sm" id="example1">
			<thead>
				<tr class="bg-secondary text-center">
					<th width="2%">No</th>
					<th width="20%">Aktivitas</th>
					<th width="5%">Standar</th>
					<th width="15%">Mulai</th>
					<th width="15%">Selesai</th>
					<th width="5%">Menit</th>
					<th width="5%">Volume</th>
					<th width="10%">Catatan</th>
					<th width="5%">Jenis</th>
					<th width="5%">Status</th>
					<th></th>
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
					<td>
						<?php if($kinerja->status_approval=='Disetujui') { ?>
							<a href="<?php echo asset('pegawai/kinerja/detail/'.$kinerja->id_kinerja.'/'.$kinerja->tanggal_kinerja) ?>" class="btn btn-success btn-sm" title="Detail"><i class="fa fa-eye"></i> Detail</a>
						<?php }else{ ?>
							<a href="<?php echo asset('pegawai/kinerja/edit/'.$kinerja->id_kinerja) ?>" class="btn btn-success btn-sm mb-1" title="Edit"><i class="fa fa-edit"></i></a>
							
							<a href="<?php echo asset('pegawai/kinerja/delete/'.$kinerja->id_kinerja.'/'.$kinerja->tanggal_kinerja) ?>" class="btn btn-warning btn-sm mb-1 delete-link" title="Hapus"><i class="fa fa-trash"></i></a>
						<?php } ?>
					</td>
				</tr>
				<?php $no++; } ?>
			</tbody>
		</table>

	</div>
</div>