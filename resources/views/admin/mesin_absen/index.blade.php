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

@include('admin/mesin_absen/tambah')

<table class="table table-bordered table-sm" id="example1">
	<thead>
		<tr>
			<th width="5%">No</th>
			<th width="20%">Lokasi</th>
			<th width="10%">Serial</th>
			<th width="10%">IP Address</th>
			<th width="10%">Key</th>
			<th width="10%">Status</th>
			<th width="15%">Jml Pegawai</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php $no=1; foreach($mesin_absen as $mesin_absen) { ?>
		<tr>
			<td>{{ $no }}</td>
			<td>{{ $mesin_absen->lokasi }}</td>
			<td>{{ $mesin_absen->serial_number }}</td>
			<td>{{ $mesin_absen->ip_mesin_absen }}</td>
			<td>{{ $mesin_absen->key_mesin_absen }}</td>
			<td>{{ $mesin_absen->status_mesin_absen }}</td>
			<td></td>
			<td>
				<a href="{{ asset('admin/data-finger/tarik/'.$mesin_absen->id_mesin_absen) }}" class="btn btn-success btn-xs mb-1"><i class="fa fa-sync"></i> Tarik Data Absensi</a>

				<a href="{{ asset('admin/mesin-absen/unggah/'.$mesin_absen->id_mesin_absen) }}" class="btn btn-info btn-xs mb-1"><i class="fa fa-upload"></i> Upload Pegawai ke Mesin Absen</a>

				<a href="{{ asset('admin/mesin-absen/biometrik/'.$mesin_absen->id_mesin_absen) }}" class="btn btn-secondary btn-xs mb-1"><i class="fa fa-download"></i> Unduh Biometrik</a>

				<a href="{{ asset('admin/mesin-absen/edit/'.$mesin_absen->id_mesin_absen) }}" class="btn btn-success btn-xs mb-1"><i class="fa fa-edit"></i></a>

				<a href="{{ asset('admin/mesin-absen/delete/'.$mesin_absen->id_mesin_absen) }}" class="btn btn-dark btn-xs mb-1 delete-link"><i class="fa fa-trash"></i></a>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>