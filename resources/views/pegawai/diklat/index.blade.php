

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<p>
	<button type="button" class="btn btn-info">
		<i class="fa fa-check-circle"></i> Total JPL Disetujui: <?php echo $diklat_jpl->total_jpl ?> JPL
	</button>
        <a href="{{ asset('pegawai/diklat/tambah') }}" class="btn btn-success">
			<i class="fa fa-plus-circle"></i> Tambah Diklat Baru
	</a>
      </p>
<table class="table table-sm tabelku" id="example3">
	<thead>
		<tr>
			<th width="5%" class="text-center">No
			</th>
			<th>Pegawai</th>
			<th>Diklat</th>
			<th>Kode Diklat</th>
			<th>Tanggal</th>
			<th>JPL</th>
			<th>Status</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php $no=1; foreach($diklat as $diklat) { ?>
		<tr>
			<td class="text-center">
				{{ $no }}
			</td>
			<td>{{ $diklat->nama_lengkap }}</td>
			<td>{{ $diklat->nama_diklat }}</td>
			<td>{{ $diklat->nama_kode_diklat }}</td>
			<td>{{ $diklat->tanggal_awal }}</td>
			<td>{{ $diklat->jpl }}</td>
			<td>
				<?php if($diklat->status_diklat=='Disetujui') { ?>
					<span class="badge badge-success"><i class="fa fa-check-circle"></i> {{ $diklat->status_diklat }}</span>
				<?php }elseif($diklat->status_diklat=='Menunggu') { ?>
					<span class="badge badge-warning"><i class="fa fa-clock"></i> {{ $diklat->status_diklat }}</span>
				<?php }else{ ?>	
					<span class="badge badge-dark"><i class="fa fa-times-circle"></i> {{ $diklat->status_diklat }}</span>
				<?php } ?>
			</td>
			<td>
				<a href="{{ asset('pegawai/diklat/detail/'.$diklat->id_diklat) }}" class="btn btn-info btn-xs mb-1" title="Detail"><i class="fa fa-eye"></i></a>

				<?php if($diklat->status_diklat=='Disetujui') { }else{ ?>
					<a href="{{ asset('pegawai/diklat/edit/'.$diklat->id_diklat) }}" class="btn btn-success btn-xs mb-1"><i class="fa fa-edit"></i></a>

					<a href="{{ asset('pegawai/diklat/delete/'.$diklat->id_diklat) }}" class="btn btn-dark btn-xs mb-1 delete-link"><i class="fa fa-trash"></i></a>
				<?php } ?>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>
</div>
</div>