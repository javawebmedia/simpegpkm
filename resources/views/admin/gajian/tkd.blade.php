<p class="text-right">
	<a href="{{ asset('admin/gajian') }}" class="btn btn-outline-info">
		<i class="fa fa-arrow-left"></i> Kembali
	</a>
</p>


<table class="table table-bordered table-sm">
	<thead>
		<tr>
			<th width="25%" class="bg-light">THBL</th>
			<th>{{ $periode->thbl }}</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td class="bg-light">Bulan</td>
			<td>{{ $periode->bulan }}</td>
		</tr>
		<tr>
			<td class="bg-light">Tahun</td>
			<td>{{ $periode->tahun }}</td>
		</tr>
		<tr>
			<td class="bg-light">Jumlah hari kerja</td>
			<td>{{ $periode->jumlah_hari }}</td>
		</tr>
		<tr>
			<td class="bg-light">Keterangan</td>
			<td>{{ $periode->keterangan }}</td>
		</tr>
	</tbody>
</table>
<br>
<div class="table-responsive">
<table class="table table-bordered table-sm table-striped" id="example4">
	<thead class="text-center bg-secondary align-middle">
		<tr>
			<th width="2%" rowspan="2" class="align-middle">NO</th>
			<th rowspan="2" width="10%" class="align-middle">PEGAWAI</th>
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
		<?php 
		$no=1; foreach($tkd as $tkd) { 
		?>
		<tr>
			<td class="text-center">{{ $no }}</td>
			<td>{{ $tkd->nama_lengkap }}
				<small>
					<br>NIP: {{ $tkd->nip }}
				</small>
			</td>
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
		<?php $no++; } ?>
	</tbody>
</table>
</div>