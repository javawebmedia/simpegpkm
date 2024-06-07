<?php 
use App\Models\Kinerja_model;
use App\Models\Bawahan_model;
use App\Models\Atasan_model;

$m_kinerja  = new Kinerja_model();
$m_bawahan 	= new Bawahan_model();
$m_atasan 	= new Atasan_model();

// check tanggal
if(isset($_GET['tanggal_kinerja'])) {
	$tanggal_kinerja 	= date('Y-m-d',strtotime($_GET['tanggal_kinerja']));
}else{
	$tanggal_kinerja 	= date('Y-m-d');
}
// end check tanggal
?>

<div class="row">
	<div class="col-md-4">
		<form action="{{ asset('admin/kinerja') }}" method="get" accept-charset="utf-8">
	
			<div class="input-group">

			  <input type="text" class="form-control datepicker" name="tanggal_kinerja" placeholder="dd-mm-yyyy" value="<?php if(isset($_GET['tanggal_kinerja'])) { echo $_GET['tanggal_kinerja']; }else{ echo date('d-m-Y'); } ?>" required>

			  <button class="btn btn-success" type="submit">
			  	<i class="fa fa-save"></i> Pilih tanggal
			  </button>

			</div>

		</form>
	</div>
	<div class="col-md-8">
		<form action="{{ asset('admin/kinerja/setujui-harian') }}" method="get" accept-charset="utf-8">
	
			<div class="input-group">

			  <input type="hidden" name="tanggal_kinerja" value="<?php echo $tanggal_kinerja ?>">
			  <input type="hidden" name="id_pegawai" value="<?php echo Session()->get('id_pegawai') ?>">

			  <button class="btn btn-danger mr-1" type="submit">
			  	<i class="fa fa-check-circle"></i> Setujui Semua Kinerja Pegawai Tgl: <?php echo date('d-m-Y',strtotime($tanggal_kinerja)) ?>
			  </button>

			  <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#modal-default">
				  <i class="fa fa-tasks"></i> Setujui Bulanan
				</button>

			</div>

		</form>
	</div>
</div>


@include('admin/kinerja/approval-bulanan')
<hr>

<table class="table table-sm tabelku" id="example3">
	<thead>
		<tr class="bg-light text-center">
			<th width="5%">No</th>
			<th width="15%">NIP</th>
			<th width="20%">Pegawai</th>
			<th width="15%">Atasan</th>
			<th width="15%">Pengisian</th>
			<th width="15%">Approval</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		$no=1; foreach($bawahan as $bawahan) { 
			// oke
			$id_pegawai 	= $bawahan->id_pegawai;
			$bwh  			= $m_bawahan->pegawai($id_pegawai);
			if($bwh) {
				$atasan 	= $m_atasan->detail($bwh->id_atasan);
				if($atasan) {
					$nama_atasan 	= $atasan->nama_lengkap;
				}else{
					$nama_atasan 	= '-';
				}
			}else{
				$nama_atasan 	= '-';
			}
			// end ok
			$nip 			= $bawahan->nip;
			$jumlah 		= $m_kinerja->pegawai_total($nip,$tanggal_kinerja);
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
			<td class="text-center">{{ $no }}</td>
			<td>{{ $bawahan->nip }}</td>
			<td>{{ $bawahan->nama_lengkap }}</td>
			<td><?php echo $nama_atasan ?></td>
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
				<a href="{{ asset('admin/kinerja/detail/'.$bawahan->nip.'/'.$tanggal_kinerja) }}" class="btn btn-warning btn-sm mb-1"><i class="fa fa-eye"></i> Detail</a>

				<a href="{{ asset('admin/kinerja/setujui/'.$bawahan->nip.'/'.$tanggal_kinerja) }}" class="btn btn-danger btn-sm mb-1 approval-link"><i class="fa fa-check-circle"></i> Setujui</a>

				<a href="{{ asset('admin/kinerja/cetak/'.$bawahan->nip.'/'.$tanggal_kinerja) }}" class="btn btn-dark btn-sm mb-1" title="Cetak" target="_blank"><i class="fa fa-print"></i></a>
			<?php } ?>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>