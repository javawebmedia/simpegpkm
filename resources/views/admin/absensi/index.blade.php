<p class="text-right">
	<a href="{{ asset('admin/absensi') }}" class="btn btn-outline-info btn-sm"><i class="fa fa-arrow-left"></i> Kembali</a>
</p>

<table class="table table-sm tabelku">
	<tbody>
		<tr>
			<th class="bg-light" width="20%">Tahun Absensi</th>
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

<form action="{{ asset('admin/absensi') }}" method="get">

<hr>

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
		<button type="submit" class="btn btn-info btn-flat" name="thbl" value="submit">
			<i class="fa fa-eye"></i> Lihat Absensi
		</button>

		<button type="submit" class="btn btn-success btn-flat" name="rekap" value="rekap">
			<i class="fa fa-sync"></i> Buat Rekap
		</button>

		<button type="button" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#modal-default">
		  <i class="fa fa-plus-circle"></i> Tambah/Update Absensi
		</button>

		<a href="{{ asset('admin/absensi/import') }}" class="btn btn-secondary btn-flat">
			<i class="fa fa-file-excel"></i> Import Absensi (Excel)
		</a>

	</span>

</div>

 <hr>

<div class="table-responsive mailbox-messages">

<table class="table table-sm tabelku" id="example1">
	<thead>
		<tr class="bg-secondary text-center align-middle">
			<th width="5%">No</th>
			<th width="20%">Nama</th>
			<th width="10%">Menit Terlambat</th>
			<th width="10%">Nilai Perilaku</th>
			<th width="10%">Nilai Serapan</th>
			<th width="10%">Sakit</th>
			<th width="10%">Izin</th>
			<th width="10%">Alpa</th>
			<th width="10%">Keterangan</th>
			<th></th>
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
			<td class="text-center"><?php echo number_format($absensi->nilai_perilaku,2) ?></td>
			<td class="text-center"><?php echo $absensi->nilai_serapan ?>%</td>
			<td class="text-center"><?php echo $absensi->sakit ?></td>
			<td class="text-center"><?php echo $absensi->izin ?></td>
			<td class="text-center"><?php echo $absensi->alpa ?></td>
			<td>{{ $absensi->keterangan }}</td>
			<td>

				<a href="{{ asset('admin/absensi/delete/'.$absensi->id_absensi.'/'.$tahun.'/'.$bulan) }}" class="btn btn-warning btn-sm delete-link mb-1"><i class="fa fa-trash"></i></a>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>
</div>

</form>

@include('admin/absensi/tambah')