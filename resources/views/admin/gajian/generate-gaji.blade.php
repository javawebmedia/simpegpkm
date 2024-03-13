<?php 
use App\Models\Gaji_model;
$m_gaji 	= new Gaji_model();
?>
<p class="text-right">
	<a href="{{ asset('admin/gajian') }}" class="btn btn-outline-info">
		<i class="fa fa-arrow-left"></i> Kembali
	</a>
</p>

<form action="{{ asset('admin/gajian/proses-gaji')}}" method="post" accept-charset="utf-8">
{{ csrf_field() }}

<input type="hidden" name="thbl" value="{{ $periode->thbl }}">

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

<p class="text-right">
	<button class="btn btn-success btn-lg" name="submit" value="submit">
		<i class="fa fa-save"></i> Ya, Generate Gaji Sekarang
	</button>
</p>

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
		$thbl 	= $periode->thbl;
		$no=1; foreach($pegawai as $pegawai) { 
			$nip 		= $pegawai->nip;
			$gaji 		= $m_gaji->thbl_pegawai($thbl,$nip);
		?>
		<tr>
			<td class="text-center">{{ $no }}</td>
			<td>{{ $pegawai->nama_lengkap }}
				<small>
					<br>NIP: {{ $pegawai->nip }}
				</small>
			</td>
			<td><?php echo $pegawai->npwp;  ?></td>
			<td><?php echo $pegawai->rekening;  ?></td>
			<td class="text-right"><?php if($gaji) { echo number_format($gaji->gaji); } ?></td>
			<td class="text-right"><?php if($gaji) { echo number_format($gaji->tunjangan); } ?></td>
			<td class="text-right"><?php if($gaji) { echo number_format($gaji->tunjangan_jabatan); } ?></td>
			<td class="text-right"><?php if($gaji) { $jml_bruto = $gaji->gaji+$gaji->tunjangan+$gaji->tunjangan_jabatan; echo number_format($jml_bruto); } ?></td>
			<td class="text-right"><?php if($gaji) { echo number_format($gaji->pph_gaji); } ?></td>
			<td class="text-right"><?php if($gaji) { $total_potongan = $gaji->pph_gaji; echo number_format($total_potongan); } ?></td>
			<td class="text-right">
				<?php if($gaji) { $jml_terima = $jml_bruto-$total_potongan; echo number_format($jml_terima); } ?>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>
</div>

<p class="text-right">
	<button class="btn btn-success btn-lg" name="submit" value="submit">
		<i class="fa fa-save"></i> Ya, Generate Gaji Sekarang
	</button>
</p>
</form>