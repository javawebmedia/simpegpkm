@include('admin/detail/flow')
@include('admin/kehadiran/profil-pegawai')
<div class="row">
	<div class="col-md-6">
		<div class="card">
			<div class="card-header bg-light">
				<strong>DATA GAJI</strong>
			</div>
			<div class="card-body">
				<?php if(!empty($gaji)) { ?>
				<table class="table table-sm tabelku">
					<tbody>
						<tr>
							<td>Gaji</td>
							<td><?php echo number_format($gaji->gaji) ?></td>
						</tr>
						<tr>
							<td>Tunjangan</td>
							<td><?php echo $gaji->tunjangan ?></td>
						</tr>
						<tr>
							<td>TKD</td>
							<td><?php echo $gaji->tkd ?></td>
						</tr>
						<tr>
							<td>Pengali</td>
							<td><?php echo $gaji->pengali ?></td>
						</tr>
						<tr>
							<td>BPJS Kesehatan</td>
							<td><?php echo $gaji->bpjs_kes ?></td>
						</tr>
						<tr>
							<td>BPJS Tenaga Kerja</td>
							<td><?php echo $gaji->bpjs_tk ?></td>
						</tr>
						<tr>
							<td>Potongan Lainnya</td>
							<td><?php echo $gaji->potongan_lainnya ?></td>
						</tr>
						<tr>
							<td>PPH Gaji</td>
							<td><?php echo $gaji->pph_gaji ?></td>
						</tr>
						<tr>
							<td>PPH TKD</td>
							<td><?php echo $gaji->pph_tkd ?></td>
						</tr>
						
					</tbody>
				</table>
			<?php }else{ ?>
				<div class="callout callout-warning">
					Data gaji belum dibuat.
				</div>
			<?php } ?>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="card">
			<div class="card-header bg-light">
				<strong>DATA TKD</strong>
			</div>
			<div class="card-body">
				<?php if(!empty($tkd)) { ?>
				<table class="table table-sm tabelku">
					<tbody>
						<tr>
							<td>Gaji</td>
							<td><?php echo number_format($tkd->gapok) ?></td>
						</tr>
						<tr>
							<td>Pengali</td>
							<td><?php echo $tkd->pengali ?></td>
						</tr>
						<tr>
							<td>PPH 21</td>
							<td><?php echo $tkd->pph21 ?></td>
						</tr>
						<tr>
							<td>Potongan BPJS</td>
							<td><?php echo $tkd->potongan_bpjs ?></td>
						</tr>
						<tr>
							<td>Potongan Lain</td>
							<td><?php echo $tkd->potongan_lain ?></td>
						</tr>
						<tr>
							<td>Potongan Absen</td>
							<td><?php echo $tkd->potongan_absen ?></td>
						</tr>
						<tr class="bg-light">
							<td>TKD Bersih</td>
							<td><?php echo $tkd->tkd_bersih ?></td>
						</tr>
					</tbody>
				</table>
				<?php }else{ ?>
				<div class="callout callout-warning">
					Data TKD belum dibuat.
				</div>
			<?php } ?>
			</div>
		</div>
	</div>
</div>