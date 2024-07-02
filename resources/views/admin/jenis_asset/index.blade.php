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

@include('admin/jenis_asset/tambah')

<table class="table table-sm tabelku" id="example1">
	<thead>
		<tr>
			<th width="5%">No</th>
			<th>Jenis Asset</th>
			<th>Tipe</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php $no=1; foreach($jenis_asset as $jenis_asset) { ?>
		<tr>
			<td>{{ $no }}</td>
			<td>{{ $jenis_asset->jenis_asset }}</td>
			<td>{{ $jenis_asset->tipe }}</td>
			<td>
				<a href="{{ asset('admin/jenis-asset/edit/'.$jenis_asset->id_jenis_asset) }}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>

				<a href="{{ asset('admin/jenis-asset/delete/'.$jenis_asset->id_jenis_asset) }}" class="btn btn-dark btn-sm delete-link"><i class="fa fa-trash"></i></a>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>