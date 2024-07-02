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

@include('admin/menu_pegawai/tambah')

<table class="table table-sm tabelku" id="example1">
	<thead>
		<tr>
			<th width="5%">No</th>
			<th>Pegawai yang Boleh Akses</th>
			<th>Nama</th>
			<th>Keterangan</th>
			<th>No. Urut</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php $no=1; foreach($menu_pegawai as $menu_pegawai) { ?>
		<tr>
			<td>{{ $no }}</td>
			<td>{{ $menu_pegawai->nama_lengkap }}
				<small>
					<br>NIP: {{ $menu_pegawai->nip }}
					<br>NRK: {{ $menu_pegawai->nrk }}
				</small></td>
			<td>{{ $menu_pegawai->nama_menu }}
				<small class="text-secondary"><br>{{ nl2br($menu_pegawai->keterangan) }}</small></td>
			<td>{{ asset($menu_pegawai->link) }}</td>
			<td>{{ $menu_pegawai->urutan }}</td>
			<td>
				<a href="{{ asset('admin/menu-pegawai/edit/'.$menu_pegawai->id_menu_pegawai) }}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>

				<a href="{{ asset('admin/menu-pegawai/delete/'.$menu_pegawai->id_menu_pegawai) }}" class="btn btn-dark btn-sm delete-link"><i class="fa fa-trash"></i></a>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>