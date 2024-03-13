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

@include('admin/pangkat/tambah')

<table class="table table-bordered" id="example1">
	<thead>
		<tr>
			<th width="5%">No</th>
			<th>Nama</th>
			<th>Golongan</th>
			<th>Ruang</th>
			<th>No. Urut</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php $no=1; foreach($pangkat as $pangkat) { ?>
		<tr>
			<td>{{ $no }}</td>
			<td>{{ $pangkat->nama_pangkat }}</td>
			<td>{{ $pangkat->golongan }}</td>
			<td>{{ $pangkat->ruang }}</td>
			<td>{{ $pangkat->urutan }}</td>
			<td>
				<a href="{{ asset('admin/pangkat/edit/'.$pangkat->id_pangkat) }}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>

				<a href="{{ asset('admin/pangkat/delete/'.$pangkat->id_pangkat) }}" class="btn btn-dark btn-sm delete-link"><i class="fa fa-trash"></i></a>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>