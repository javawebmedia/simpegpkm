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

@include('admin/metode_diklat/tambah')

<table class="table table-sm tabelku" id="example1">
	<thead>
		<tr>
			<th width="5%">No</th>
			<th>Metode</th>
			<th>Nama</th>
			<th>JP</th>
			<th>Keterangan</th>
			<th>No. Urut</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php $no=1; foreach($metode_diklat as $metode_diklat) { ?>
		<tr>
			<td>{{ $no }}</td>
			<td>{{ $metode_diklat->jenis_metode }}</td>
			<td>{{ $metode_diklat->nama_metode_diklat }}</td>
			<td>{{ $metode_diklat->jp }}</td>
			<td>{{ $metode_diklat->keterangan }}</td>
			<td>{{ $metode_diklat->urutan }}</td>
			<td>
				<a href="{{ asset('admin/metode-diklat/edit/'.$metode_diklat->id_metode_diklat) }}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>

				<a href="{{ asset('admin/metode-diklat/delete/'.$metode_diklat->id_metode_diklat) }}" class="btn btn-dark btn-sm delete-link"><i class="fa fa-trash"></i></a>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>