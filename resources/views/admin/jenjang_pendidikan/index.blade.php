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

@include('admin/jenjang_pendidikan/tambah')

<table class="table table-bordered" id="example1">
	<thead>
		<tr>
			<th width="5%">No</th>
			<th>Nama</th>
			<th>No. Urut</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php $no=1; foreach($jenjang_pendidikan as $jenjang_pendidikan) { ?>
		<tr>
			<td>{{ $no }}</td>
			<td>{{ $jenjang_pendidikan->nama_jenjang_pendidikan }}</td>
			<td>{{ $jenjang_pendidikan->urutan }}</td>
			<td>
				<a href="{{ asset('admin/jenjang-pendidikan/edit/'.$jenjang_pendidikan->id_jenjang_pendidikan) }}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>

				<a href="{{ asset('admin/jenjang-pendidikan/delete/'.$jenjang_pendidikan->id_jenjang_pendidikan) }}" class="btn btn-dark btn-sm delete-link"><i class="fa fa-trash"></i></a>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>