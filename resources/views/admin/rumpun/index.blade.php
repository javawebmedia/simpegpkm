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

@include('admin/rumpun/tambah')

<table class="table table-sm tabelku" id="example1">
	<thead>
		<tr>
			<th width="5%">No</th>
			<th>Nama</th>
			<th>Keterangan</th>
			<th>No. Urut</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php $no=1; foreach($rumpun as $rumpun) { ?>
		<tr>
			<td>{{ $no }}</td>
			<td>{{ $rumpun->nama_rumpun }}</td>
			<td>{{ $rumpun->keterangan }}</td>
			<td>{{ $rumpun->urutan }}</td>
			<td>
				<a href="{{ asset('admin/rumpun/edit/'.$rumpun->id_rumpun) }}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>

				<a href="{{ asset('admin/rumpun/delete/'.$rumpun->id_rumpun) }}" class="btn btn-dark btn-sm delete-link"><i class="fa fa-trash"></i></a>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>