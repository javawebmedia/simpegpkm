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

@include('admin/jenis_pelatihan/tambah')

<table class="table table-sm tabelku" id="example1">
	<thead>
		<tr>
			<th width="5%">No</th>
			<th>Nama</th>
			<th>Rumpun</th>
			<th>Keterangan</th>
			<th>No. Urut</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php $no=1; foreach($jenis_pelatihan as $jenis_pelatihan) { ?>
		<tr>
			<td>{{ $no }}</td>
			<td>{{ $jenis_pelatihan->nama_jenis_pelatihan }}</td>
			<td>{{ $jenis_pelatihan->nama_rumpun }}</td>
			<td>{{ $jenis_pelatihan->keterangan }}</td>
			<td>{{ $jenis_pelatihan->urutan }}</td>
			<td>
				<a href="{{ asset('admin/jenis-pelatihan/edit/'.$jenis_pelatihan->id_jenis_pelatihan) }}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>

				<a href="{{ asset('admin/jenis-pelatihan/delete/'.$jenis_pelatihan->id_jenis_pelatihan) }}" class="btn btn-dark btn-sm delete-link"><i class="fa fa-trash"></i></a>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>