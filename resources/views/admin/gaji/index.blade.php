<p class="text-right">
	<a href="{{ asset('admin/gaji') }}" class="btn btn-outline-info btn-sm"><i class="fa fa-arrow-left"></i> Kembali</a>
</p>

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
				}
				?>
			</td>
		</tr>
	</tbody>
</table>

<form action="{{ asset('admin/gaji') }}" method="get">

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
			<i class="fa fa-arrow-right"></i> Lihat Data Gaji
		</button>

		<button type="button" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#modal-default">
		  <i class="fa fa-plus-circle"></i> Tambah/Update Data Gaji
		</button>

		<a href="{{ asset('admin/gaji/import') }}" class="btn btn-success btn-flat">
			<i class="fa fa-file-excel"></i> Import Data Gaji (Excel)
		</a>

	</span>

</div>

 <hr>

<div class="table-responsive mailbox-messages">

<table class="table table-sm tabelku">
	<thead>
		<tr class="bg-secondary text-center align-middle">
			<th width="5%">No</th>
			<th width="15%">Nama</th>
			<th width="10%">Gaji Pokok</th>
			<th width="5%">Pengali</th>
			<th width="10%">TKD</th>
			<!-- <th width="10%">TKD Flat</th> -->
			<th width="10%">Tunj. Keluarga</th>
			<th width="10%">Tunj. Jabatan</th>
			<th width="20%">Potongan</th>
			<th width="10%">PPH21</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php $no=1; foreach($gaji as $gaji) { ?>
		<tr>
			<td class="text-center">{{ $no }}</td>
			<td>{{ $gaji->nama_lengkap }}
					<small>
						<br>NIP: <?php echo $gaji->nip ?>
						<br>TMT: <?php echo date('d-m-Y',strtotime($gaji->tmt)) ?>
						<br>THBL: <?php echo $gaji->thbl ?>
					</small>
			</td>
			<td class="text-center"><?php echo number_format($gaji->gaji) ?></td>
			<td class="text-center"><?php echo $gaji->pengali ?></td>
			<td class="text-center"><?php $tkd = $gaji->gaji*$gaji->pengali; echo number_format($tkd); ?></td>
			<!-- <td class="text-center"><?php echo number_format($gaji->tkd) ?></td> -->
			<td class="text-center"><?php echo number_format($gaji->tunjangan) ?></td>
			<td class="text-center"><?php echo number_format($gaji->tunjangan_jabatan) ?></td>
			<td class="text-left">
				<small>
					BPJS Kes: <?php echo number_format($gaji->bpjs_kes) ?>
					<br>BPJS TK: <?php echo number_format($gaji->bpjs_tk) ?>
					<br>Lainnya: <?php echo number_format($gaji->potongan_lainnya) ?>
				</small>
			</td>
			<td>
				<small>Gaji: <?php echo number_format($gaji->pph_gaji) ?>
					<br>TKD: <?php echo number_format($gaji->pph_tkd) ?></small>
			</td>
			<td>
				<a href="{{ asset('admin/gaji/edit/'.$gaji->id_gaji.'/'.$tahun.'/'.$bulan) }}" class="btn btn-success btn-sm mb-1" title="Edit"><i class="fa fa-edit"></i></a>

				<a href="{{ asset('admin/gaji/delete/'.$gaji->id_gaji.'/'.$tahun.'/'.$bulan) }}" class="btn btn-warning btn-sm delete-link mb-1"><i class="fa fa-trash"></i></a>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>
</div>

</form>

@include('admin/gaji/tambah')