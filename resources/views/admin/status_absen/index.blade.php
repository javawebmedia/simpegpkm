<p>
	<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default">
	  <i class="fa fa-plus-circle"></i> Tambah Baru
	</button>
</p>

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@include('admin/status_absen/tambah')

<table class="table table-sm tabelku" id="example1">
	<thead>
		<tr>
			<th width="5%">No</th>
			<th>Kode</th>
			<th>Nama</th>
			<th class="text-center">Jenis</th>
			<th class="text-center">Aktif</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php $no=1; foreach($status_absen as $status_absen) { ?>
		<tr>
			<td>{{ $no }}</td>
			<td><i class="far fa-square" style="background-color: <?php echo $status_absen->warna_status_absen ?>;"></i> {{ $status_absen->kode_status_absen }}</td>
			<td>{{ $status_absen->nama_status_absen }}</td>
			<td class="text-center">
				<?php if($status_absen->jenis_status_absen=='Absensi') { ?>
					<span class="badge badge-danger"><i class="fa fa-calendar-times"></i> <?php echo $status_absen->jenis_status_absen ?></span>
				<?php }else{ ?>
					<span class="badge badge-info"><i class="fa fa-calendar-check"></i> <?php echo $status_absen->jenis_status_absen ?></span>
				<?php } ?>
			</td>
			<td class="text-center">
				<?php if($status_absen->aktif_status_absen=='Aktif') { ?>
					<span class="badge badge-success"><i class="fa fa-check-circle"></i> <?php echo $status_absen->aktif_status_absen ?></span>
				<?php }else{ ?>
					<span class="badge badge-secondary"><i class="fa fa-times-circle"></i> <?php echo $status_absen->aktif_status_absen ?></span>
				<?php } ?>
			</td>
			<td>
				<a href="{{ asset('admin/status-absen/edit/'.$status_absen->id_status_absen) }}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>

				<a href="{{ asset('admin/status-absen/delete/'.$status_absen->id_status_absen) }}" class="btn btn-dark btn-sm delete-link"><i class="fa fa-trash"></i></a>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>