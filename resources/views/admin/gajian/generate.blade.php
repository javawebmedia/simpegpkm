<?php 
use App\Models\Gaji_model;
use App\Models\Kinerja_model;
use App\Models\Absensi_model;
$m_gaji 	= new Gaji_model();
$m_kinerja 	= new Kinerja_model();
$m_absensi 	= new Absensi_model();
?>
<p class="text-right">
	<a href="{{ asset('admin/gajian') }}" class="btn btn-outline-info">
		<i class="fa fa-arrow-left"></i> Kembali
	</a>
</p>

<form action="{{ asset('admin/gajian/proses-gaji-dan-tkd')}}" method="post" accept-charset="utf-8">
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
		<i class="fa fa-save"></i> Ya, Generate TKD Sekarang
	</button>
</p>

<div class="table-responsive">
<table class="table table-bordered table-sm table-striped">
	<thead class="text-center bg-secondary align-middle">
		<tr>
			<th width="2%" rowspan="2" class="align-middle">NO</th>
			<th rowspan="2" width="10%" class="align-middle">PEGAWAI</th>
			<th rowspan="2" width="5%" class="align-middle">GAPOK</th>
			<th rowspan="2" width="5%" class="align-middle">PENGALI</th>
			<th colspan="4"width="16%" class="align-middle">KEHADIRAN</th>
			<th rowspan="2" width="5%" class="align-middle">MENIT KERJA</th>
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
		$thbl 	= $periode->thbl;
		$no=1; foreach($pegawai as $pegawai) { 
			$nip 		= $pegawai->nip;
			$gaji 		= $m_gaji->thbl_pegawai($thbl,$nip);
			$absensi 	= $m_absensi->thbl_pegawai($thbl,$nip);
			$kinerja 	= $m_kinerja->total_menit_bulan($nip,$thbl);
			// hitung kinerja
			if($kinerja->total_menit >0) {
				if($absensi) {
					$menit 	= $site->max_menit_bulanan-$absensi->menit_terlambat;
				}else{
					$menit 	= $site->max_menit_bulanan;
				}
				$nkinerja 	= $kinerja->total_menit/$menit;
				if($nkinerja > 100) {
					$nilai_kinerja = 100;
				}else{
					$nilai_kinerja = $nkinerja;
				}
			}else{
				$nilai_kinerja = 0;
			}
		?>
		<tr>
			<td class="text-center">{{ $no }}</td>
			<td>{{ $pegawai->nama_lengkap }}
				<small>
					<br>NIP: {{ $pegawai->nip }}
				</small>
			</td>
			<td class="text-right"><?php if($gaji) { echo number_format($gaji->gaji); } ?></td>
			<td><?php if($gaji) { echo number_format($gaji->pengali,2); } ?></td>
			
			<td class="text-center"><?php if($absensi) { echo $absensi->menit_terlambat; } ?></td>
			<td class="text-center"><?php if($absensi) { echo $absensi->sakit; } ?></td>
			<td class="text-center"><?php if($absensi) { echo $absensi->izin; } ?></td>
			<td class="text-center"><?php if($absensi) { echo $absensi->alpa; } ?></td>
			<td class="text-center"><?php echo number_format($kinerja->total_menit); ?></td>
			<td class="text-center"><?php echo $nilai_kinerja*100; ?>%</td>
			<td class="text-right">
				<?php 
				if($gaji) { 
					$tkd = $gaji->pengali*$gaji->gaji*$nilai_kinerja; 
				}else{ 
					$tkd= 0;
				} 
				echo number_format($tkd); 
				?>
			</td>
			<td class="text-right">
				<?php 
				if($absensi) {
					if($absensi->sakit > 0) {
						$pot_sakit = $tkd*$absensi->sakit*1/100;
					}else{
						$pot_sakit = 0;
					} 
					if($absensi->izin > 0) {
						$pot_izin = $tkd*$absensi->izin*2/100;
					}else{
						$pot_izin = 0;
					} 
					if($absensi->alpa > 0) {
						$pot_alpa = $tkd*$absensi->alpa*1/100;
					}else{
						$pot_alpa = 0;
					} 
					$potongan = $pot_sakit+$pot_izin+$pot_alpa;
				}else{
					$potongan = 0;
				}
				$tkd_bruto = $tkd-$potongan;
				echo number_format($potongan);
				?>
			</td>
			<td class="text-right"><?php echo number_format($tkd_bruto); ?></td>
			<td class="text-right"><?php if($gaji) { echo number_format($gaji->pph_tkd); } ?></td>
			<td class="text-right"><?php if($gaji) { echo number_format($gaji->bpjs_kes); } ?></td>
			<td class="text-right"><?php if($gaji) { echo number_format($gaji->bpjs_tk); } ?></td>
			<td class="text-right"><?php if($gaji) { $total_potongan = $gaji->pph_tkd+$gaji->bpjs_kes+$gaji->bpjs_tk; }else{ $total_potongan= 0; } echo number_format($total_potongan);  ?></td>
			<td class="text-right"><?php $tkd_net = $tkd_bruto-$total_potongan;
			echo number_format($tkd_net);  ?></td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>
</div>

<p class="text-right">
	<button class="btn btn-success btn-lg" name="submit" value="submit">
		<i class="fa fa-save"></i> Ya, Generate TKD Sekarang
	</button>
</p>
</form>