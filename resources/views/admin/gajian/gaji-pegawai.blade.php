<?php 
use App\Models\Gaji_model;
$m_gaji 	= new Gaji_model();
?>
<p class="text-right">
	<a href="{{ asset('admin/gajian/gaji') }}" class="btn btn-outline-info">
		<i class="fa fa-arrow-left"></i> Kembali
	</a>
</p>



<table class="table table-bordered table-sm">
	<thead>
		<tr>
			<th width="25%">THBL</th>
			<th>{{ $periode->thbl }}</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>Bulan</td>
			<td>{{ $periode->bulan }}</td>
		</tr>
		<tr>
			<td>Tahun</td>
			<td>{{ $periode->tahun }}</td>
		</tr>
		<tr>
			<td>Jumlah hari kerja</td>
			<td>{{ $periode->jumlah_hari }}</td>
		</tr>
		<tr>
			<td>Keterangan</td>
			<td>{{ $periode->keterangan }}</td>
		</tr>
	</tbody>
</table>
<br>

<div class="table-responsive">
<table class="table table-bordered table-sm table-striped" id="example4">
	<thead class="text-center bg-secondary align-middle">
		<tr>
			<th width="2%" class="align-middle">NO</th>
			<th width="10%" class="align-middle">PEGAWAI</th>
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
		<?php 
		$no=1; foreach($gaji_pegawai as $gaji_pegawai) { 
		?>
		<tr>
			<td class="text-center">{{ $no }}</td>
			<td>{{ $gaji_pegawai->nama_lengkap }}
				<small>
					<br>NIP: {{ $gaji_pegawai->nip }}
				</small>
			</td>
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
		<?php $no++; } ?>
	</tbody>
</table>
</div>
