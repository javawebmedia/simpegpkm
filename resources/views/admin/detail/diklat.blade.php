@include('admin/detail/flow')
@include('admin/kehadiran/profil-pegawai')

<div class="card">
	<div class="card-header bg-light">
		<strong>DATA DIKLAT</strong>
	</div>
	<div class="card-body">
<table class="table table-sm tabelku" id="example3">
	<thead>
		<tr>
			<th width="5%" class="text-center">No
			</th>
			<th>Pegawai</th>
			<th>Diklat</th>
			<th>Tanggal</th>
			<th>JPL</th>
			<th>Status</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php $no=1; foreach($diklat as $diklat) { ?>
		<tr>
			<td class="text-center">
				{{ $no }}
			</td>
			<td>{{ $diklat->nama_lengkap }}</td>
			<td>{{ $diklat->nama_diklat }}</td>
			<td>{{ $diklat->tanggal_awal }}</td>
			<td>{{ $diklat->jpl }}</td>
			<td>
				<?php if($diklat->status_diklat=='Disetujui') { ?>
					<span class="badge badge-success"><i class="fa fa-check-circle"></i> {{ $diklat->status_diklat }}</span>
				<?php }elseif($diklat->status_diklat=='Menunggu') { ?>
					<span class="badge badge-warning"><i class="fa fa-clock"></i> {{ $diklat->status_diklat }}</span>
				<?php }else{ ?>	
					<span class="badge badge-dark"><i class="fa fa-times-circle"></i> {{ $diklat->status_diklat }}</span>
				<?php } ?>
			</td>
			<td>
				<button type="button" class="btn btn-outline-success btn-xs" data-toggle="modal" data-target="#lihat_<?php echo $diklat->id_diklat ?>">
					<i class="fa fa-eye"></i> Lihat
				</button>
				@include('admin/detail/detail-diklat')
			</td>
			
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>
</div>
</div>
