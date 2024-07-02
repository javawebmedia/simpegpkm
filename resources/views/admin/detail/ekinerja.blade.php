@include('admin/detail/flow')
@include('admin/kehadiran/profil-pegawai')

<div class="card">
	<div class="card-header bg-light">
		<strong>DATA EKINERJA PEGAWAI</strong>
	</div>
	<div class="card-body">
		<!-- data -->
		<table class="table table-sm tabelku" id="example1">
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
					
				</tr>
				<?php $no++; } ?>
			</tbody>
		</table>
		<!-- end data -->
	</div>
</div>