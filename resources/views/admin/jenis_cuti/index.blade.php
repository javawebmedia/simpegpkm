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

@include('admin/jenis_cuti/tambah')

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
		<?php $no=1; foreach($jenis_cuti as $jenis_cuti) { ?>
		<tr>
			<td>{{ $no }}</td>
			<td>{{ $jenis_cuti->nama_jenis_cuti }}</td>
			<td>{{ nl2br($jenis_cuti->keterangan) }}</td>
			<td>{{ $jenis_cuti->urutan }}</td>
			<td>
				<a href="{{ asset('admin/jenis-cuti/edit/'.$jenis_cuti->id_jenis_cuti) }}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>

				<a href="{{ asset('admin/jenis-cuti/delete/'.$jenis_cuti->id_jenis_cuti) }}" class="btn btn-dark btn-sm delete-link"><i class="fa fa-trash"></i></a>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>