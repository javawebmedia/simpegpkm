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

@include('admin/panduan/tambah')

<table class="table table-bordered" id="example1">
	<thead>
		<tr>
			<th width="5%">No</th>
			<th>Nama Panduan</th>
			<th>Keterangan</th>
			<th>Pengguna</th>
			<th>Video</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php $no=1; foreach($panduan as $panduan) { ?>
		<tr>
			<td>{{ $no }}</td>
			<td>{{ $panduan->nama_panduan }}</td>
			<td>{{ $panduan->keterangan }}</td>
			<td>{{ $panduan->pengguna }}</td>
			<td>{{ $panduan->video }}</td>
			<td>
				<a href="{{ asset('assets/upload/file/'.$panduan->gambar) }}" class="btn btn-info btn-sm" target="_blank"><i class="fa fa-download"></i> Unduh</a>

				<a href="{{ asset('admin/panduan/edit/'.$panduan->id_panduan) }}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>

				<a href="{{ asset('admin/panduan/delete/'.$panduan->id_panduan) }}" class="btn btn-dark btn-sm delete-link"><i class="fa fa-trash"></i></a>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>