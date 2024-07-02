

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ asset('pegawai/diklat/proses') }}" method="post" accept-charset="utf-8">
			{{ csrf_field() }}
<div class="row mb-2">
	<div class="col-md-6">
		<div class="input-group">
			<button type="submit" name="submit" value="delete" class="btn btn-secondary"><i class="fa fa-trash"></i></button>
    <select name="status_diklat" class="form-control">
            <option value="Disetujui">Disetujui</option>
            <option value="Menunggu">Menunggu</option>
            <option value="Ditolak">Ditolak</option>
          </select>

    
      <span class="input-group-append">
        <button type="submit" name="submit" value="submit" class="btn btn-secondary"><i class="fa fa-save"></i> Update</button>
      </span>
    </div>
	</div>
	
</div>




<div class="mailbox-controls">
	<div class="table-responsive mailbox-messages">
<table class="table table-sm tabelku" id="example1">
	<thead>
		<tr>
			<th width="5%" class="text-center">
				<button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="far fa-square"></i>
						</button>
			</th>
			<th>Pegawai</th>
			<th>Diklat</th>
			<th>Kode Diklat</th>
			<th>Tanggal</th>
			<th>JPL</th>
			<th>Status</th>
			<!-- <th>Aksi</th> -->
		</tr>
	</thead>
	<tbody>
		<?php $no=1; foreach($diklat as $diklat) { ?>
		<tr>
			<td class="text-center">
				<div class="icheck-primary">
                    <input type="checkbox" value="<?php echo $diklat->id_diklat ?>" id="check<?php echo $diklat->id_diklat ?>" name="id_diklat[]">
                    <label for="check<?php echo $diklat->id_diklat ?>"></label>
                  </div>
			</td>
			<td>{{ $diklat->nama_lengkap }}</td>
			<td>{{ $diklat->nama_diklat }}</td>
			<td>{{ $diklat->nama_kode_diklat }}</td>
			<td>{{ $diklat->tanggal_awal }}</td>
			<td>{{ $diklat->jpl }}</td>
			<td>
				<?php if($diklat->status_diklat=='Disetujui') { ?>
					<span class="badge badge-success btn-xs mb-1"><i class="fa fa-check-circle"></i> {{ $diklat->status_diklat }}</span>
				<?php }elseif($diklat->status_diklat=='Menunggu') { ?>
					<span class="badge badge-warning btn-xs mb-1"><i class="fa fa-clock"></i> {{ $diklat->status_diklat }}</span>
				<?php }else{ ?>	
					<span class="badge badge-dark btn-xs mb-1"><i class="fa fa-times-circle"></i> {{ $diklat->status_diklat }}</span>
				<?php } ?>
				<a href="{{ asset('pegawai/diklat/detail-pimpinan/'.$diklat->id_diklat) }}" class="btn btn-info btn-xs mb-1" title="Detail"><i class="fa fa-eye"></i></a>
			</td>
			<!-- <td>
				<a href="{{ asset('pegawai/diklat/detail/'.$diklat->id_diklat) }}" class="btn btn-info btn-xs mb-1" title="Detail"><i class="fa fa-eye"></i></a>

				<a href="{{ asset('pegawai/diklat/edit/'.$diklat->id_diklat) }}" class="btn btn-success btn-xs mb-1"><i class="fa fa-edit"></i></a>

				<a href="{{ asset('pegawai/diklat/delete/'.$diklat->id_diklat) }}" class="btn btn-dark btn-xs mb-1 delete-link"><i class="fa fa-trash"></i></a>
			</td> -->
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>
</div>
</div>