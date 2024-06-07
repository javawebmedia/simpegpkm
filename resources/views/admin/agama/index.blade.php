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

@include('admin/agama/tambah')

<table class="table table-sm tabelku" id="example1">
	<thead>
		<tr>
			<th width="5%">No</th>
			<th>Nama</th>
			<th>No. Urut</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php $no=1; foreach($agama as $agama) { ?>
		<tr>
			<td>{{ $no }}</td>
			<td>{{ $agama->nama_agama }}</td>
			<td>{{ $agama->urutan }}</td>
			<td>
				<a href="{{ asset('admin/agama/edit/'.$agama->id_agama) }}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>

				<a href="{{ asset('admin/agama/delete/'.$agama->id_agama) }}" class="btn btn-dark btn-sm delete-link"><i class="fa fa-trash"></i></a>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>