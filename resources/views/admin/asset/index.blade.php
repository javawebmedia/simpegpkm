

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ asset('admin/asset/proses') }}" method="post" accept-charset="utf-8">
			{{ csrf_field() }}
<div class="row mb-2">
	<div class="col-md-6">
		<div class="input-group"> 
			<a href="{{ asset('admin/asset/tambah') }}" class="btn btn-success">
				<i class="fa fa-plus-circle"></i> Tambah
			</a>
		</div>
	</div>
</div>




<div class="mailbox-controls">
	<div class="table-responsive mailbox-messages">
<table class="table table-sm tabelku" id="example1">
	<thead>
		<tr>
			<th>Kode</th>
			<th>Jenis</th>
			<th>Tipe</th>
			<th>Merek</th>
			<th>Tahun</th>
			<th>Rekening</th>
			<th>Harga</th>
			<th>Lokasi</th>
			<th>Keterangan</th>
			<th>Kondisi</th>
			<th>Status</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php $no=1; foreach($asset as $asset) { ?>
		<tr>
			<td>{{ $asset->kode }}</td>
			<td>{{ $asset->jenis}} <br> <small>{{ $asset->tipe}}</small> </td>
			<td>{{ $asset->tipe }}</td>
			<td>{{ $asset->merek }}</td>
			<td>{{ $asset->tahun }}</td>
			<td>{{ $asset->rekening }}</td>
			<td>{{ $asset->harga }}</td>
			<td>{{ $asset->ruangan}} <br> <small>{{ $asset->lokasi}}</small> </td>
			<td>{{ $asset->keterangan }}</td>
			<td>
				<?php if($asset->status_asset=='Baik') { ?>
					<span class="badge badge-success"><i class="fa fa-check-circle"></i> {{ $asset->status_asset }}</span>
				<?php }elseif($asset->status_asset=='Rusak Ringan') { ?>
					<span class="badge badge-warning"><i class="fa fa-clock"></i> {{ $asset->status_asset }}</span>
				<?php }elseif($asset->status_asset=='Rusak Berat') { ?>
					<span class="badge badge-danger"><i class="fa fa-clock"></i> {{ $asset->status_asset }}</span>
				<?php }else{ ?>	
					<span class="badge badge-dark"><i class="fa fa-times-circle"></i> {{ $asset->status_asset }}</span>
				<?php } ?>
			</td>
			<td>{{ $asset->status }}</td>
			<td>
				<a href="{{ asset('admin/asset/edit/'.$asset->id_asset) }}" class="btn btn-success btn-xs mb-1"><i class="fa fa-edit"></i></a>

				<a href="{{ asset('admin/asset/delete/'.$asset->id_asset) }}" class="btn btn-dark btn-xs mb-1 delete-link"><i class="fa fa-trash"></i></a>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>
</div>
</div>