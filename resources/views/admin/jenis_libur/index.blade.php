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

@include('admin/jenis_libur/tambah')

<table class="table table-bordered" id="example1">
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
		<?php $no=1; foreach($jenis_libur as $jenis_libur) { ?>
		<tr>
			<td>{{ $no }}</td>
			<td>{{ $jenis_libur->nama_jenis_libur }}</td>
			<td>{{ nl2br($jenis_libur->keterangan) }}</td>
			<td>{{ $jenis_libur->urutan }}</td>
			<td>
				<a href="{{ asset('admin/jenis-libur/edit/'.$jenis_libur->id_jenis_libur) }}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>

				<a href="{{ asset('admin/jenis-libur/delete/'.$jenis_libur->id_jenis_libur) }}" class="btn btn-dark btn-sm delete-link"><i class="fa fa-trash"></i></a>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>