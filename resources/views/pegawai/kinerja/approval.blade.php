<?php 
use App\Models\Kinerja_model;
$m_kinerja  = new Kinerja_model();
$nip       	= Session()->get('nip');
// check tanggal
if(isset($_GET['tanggal_kinerja'])) {
	$tanggal_kinerja 	= date('Y-m-d',strtotime($_GET['tanggal_kinerja']));
}else{
	$tanggal_kinerja 	= date('Y-m-d');
}
// end check tanggal
?>

<form action="{{ asset('pegawai/kinerja/approval') }}" method="get" accept-charset="utf-8">
	
	<div class="input-group">

	  <input type="text" class="form-control datepicker" name="tanggal_kinerja" placeholder="dd-mm-yyyy" value="<?php if(isset($_GET['tanggal_kinerja'])) { echo $_GET['tanggal_kinerja']; }else{ echo date('d-m-Y'); } ?>" required>

	  <button class="btn btn-success" type="submit">
	  	<i class="fa fa-save"></i> Pilih tanggal
	  </button>

	</div>

</form>

<table class="table table-bordered mt-3">
	<tbody>
		<tr>
			<th class="bg-light" width="20%">Nama atasan</th>
			<td>{{ Session()->get('nama_lengkap') }}</td>
		</tr>
		<tr>
			<th class="bg-light">Periode</th>
			<td><?php if(isset($_GET['tanggal_kinerja'])) { echo $_GET['tanggal_kinerja']; }else{ echo date('d-m-Y'); } ?></td>
		</tr>
	</tbody>
</table>
<br>

<table class="table table-sm tabelku" id="example1">
	<thead>
		<tr>
			<th width="5%">No</th>
			<th>NIP</th>
			<th>Nama Pegawai</th>
			<th>Status Pengisian</th>
			<th>Status Approval</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		$no=1; foreach($bawahan as $bawahan) { 
			$nip 	= $bawahan->nip;
			$jumlah = $m_kinerja->pegawai_total($nip,$tanggal_kinerja);
			if($jumlah > 0)
			{
				$Disetujui 		= $m_kinerja->pegawai_total_status($nip,$tanggal_kinerja,'Disetujui');
				$Menunggu 		= $m_kinerja->pegawai_total_status($nip,$tanggal_kinerja,'Menunggu');
				$Ditolak 		= $m_kinerja->pegawai_total_status($nip,$tanggal_kinerja,'Ditolak');
				$Dikembalikan 	= $m_kinerja->pegawai_total_status($nip,$tanggal_kinerja,'Dikembalikan');
				if($Disetujui > 0 ) {
					$prosentase 	= $Disetujui/$jumlah*100;
				}else{
					$prosentase 	= 0;
				}
			}
		?>
		<tr>
			<td>{{ $no }}</td>
			<td>{{ $bawahan->nip }}</td>
			<td>{{ $bawahan->nama_lengkap }}</td>
			<td>{{ $jumlah }} Aktivitas</td>
			<td>
				<?php if($jumlah > 0) { ?>
					<div class="progress progress-xs">
	                  <div class="progress-bar bg-success progress-bar-striped" role="progressbar"
	                       aria-valuenow="{{ $prosentase }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $prosentase }}%">
	                  </div>
	                </div>
	                <small>
	                	<div  class="text-center"></span>{{ $Disetujui }} dari {{ $jumlah }} Disetujui</div>
	                	Menunggu: {{ $Menunggu }}
	                	<br>Ditolak: {{ $Ditolak }}
	                	<br>Dikembalikan: {{ $Dikembalikan }}
	                </small>
	            <?php } ?>
			</td>
			<td>
			<?php if($jumlah > 0) { ?>
				<a href="{{ asset('pegawai/kinerja/detail/'.$bawahan->nip.'/'.$tanggal_kinerja) }}" class="btn btn-warning btn-sm"><i class="fa fa-eye"></i> Detail</a>

				<a href="{{ asset('pegawai/kinerja/setujui/'.$bawahan->nip.'/'.$tanggal_kinerja) }}" class="btn btn-danger btn-sm approval-link"><i class="fa fa-check-circle"></i> Setujui</a>

				<a href="{{ asset('pegawai/kinerja/cetak/'.$bawahan->nip.'/'.$tanggal_kinerja) }}" class="btn btn-dark btn-sm" title="Cetak" target="_blank"><i class="fa fa-print"></i></a>
			<?php } ?>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>