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

@include('admin/lokasi/tambah')

<table class="table table-sm tabelku" id="example1">
	<thead>
		<tr>
			<th width="5%">No</th>
			<th>Lokasi Puskesmas</th>
			<th>Ruangan</th>
			<th>No. Urut</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php $no=1; foreach($lokasi as $lokasi) { ?>
		<tr>
			<td>{{ $no }}</td>
			<td>{{ $lokasi->lokasi }}</td>
			<td>{{ $lokasi->ruangan }}</td>
			<td>{{ $lokasi->urutan }}</td>
			<td>
				<a href="{{ asset('admin/lokasi/edit/'.$lokasi->id_lokasi) }}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>

				<a href="{{ asset('admin/lokasi/delete/'.$lokasi->id_lokasi) }}" class="btn btn-dark btn-sm delete-link"><i class="fa fa-trash"></i></a>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>