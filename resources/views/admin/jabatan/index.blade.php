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

@include('admin/jabatan/tambah')

<table class="table table-sm tabelku" id="example1">
	<thead>
		<tr>
			<th width="5%">No</th>
			<th>Nama</th>
			<th>Jenis</th>
			<th>Divisi</th>
			<th>No. Urut</th>
			<th>Aktivitas</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php $no=1; foreach($jabatan as $jabatan) { ?>
		<tr>
			<td>{{ $no }}</td>
			<td>{{ $jabatan->nama_jabatan }}</td>
			<td>{{ $jabatan->jenis_jabatan }}</td>
			<td>{{ $jabatan->nama_divisi }}</td>
			<td>{{ $jabatan->urutan }}</td>
			<td></td>
			<td>
				<a href="{{ asset('admin/jabatan/aktivitas/'.$jabatan->id_jabatan) }}" class="btn btn-info btn-sm mb-2"><i class="fa fa-tasks"></i> Aktivitas Utama</a>

				<br>

				<a href="{{ asset('admin/jabatan/edit/'.$jabatan->id_jabatan) }}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>

				<a href="{{ asset('admin/jabatan/delete/'.$jabatan->id_jabatan) }}" class="btn btn-dark btn-sm delete-link"><i class="fa fa-trash"></i></a>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>