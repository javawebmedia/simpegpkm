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

@include('admin/aktivitas/tambah')

<table class="table table-bordered table-sm" id="example1">
	<thead>
		<tr class="text-center">
			<th width="5%">No</th>
			<th width="5%">Kode</th>
			<th>Nama</th>
			<th>Satuan</th>
			<th>Waktu</th>
			<th>Kategori</th>
			<th>Tingkat Kesulitan</th>
			<th>Bobot</th>
			<th>Divisi</th>
			<th>status</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php $no=1; foreach($aktivitas as $aktivitas) { ?>
		<tr>
			<td class="text-center">{{ $no }}</td>
			<td class="text-center">{{ $aktivitas->kode_aktivitas }}</td>
			<td>{{ $aktivitas->nama_aktivitas }}</td>
			<td>{{ $aktivitas->nama_satuan }}</td>
			<td class="text-center">{{ $aktivitas->waktu }}</td>
			<td>{{ $aktivitas->kategori }}</td>
			<td class="text-center">{{ $aktivitas->tingkat_kesulitan }}</td>
			<td class="text-center">{{ $aktivitas->bobot }}</td>
			<td>{{ $aktivitas->nama_divisi }}</td>
			<td class="text-center">{{ $aktivitas->status_aktivitas }}</td>
			<td>
				<a href="{{ asset('admin/aktivitas/edit/'.$aktivitas->id_aktivitas) }}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>

				<a href="{{ asset('admin/aktivitas/delete/'.$aktivitas->id_aktivitas) }}" class="btn btn-dark btn-sm delete-link"><i class="fa fa-trash"></i></a>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>