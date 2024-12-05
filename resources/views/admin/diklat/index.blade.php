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
	<?php foreach($rekap_tahunan as $rekap_tahunan) { ?>
		<a href="<?php echo asset('admin/diklat?tahun='.$rekap_tahunan->tahun) ?>" class="btn <?php if($rekap_tahunan->tahun==$tahun) { echo 'btn-info'; }else{ echo 'btn-secondary'; } ?> btn-sm">
			<i class="fa fa-eye"></i> <?php echo $rekap_tahunan->tahun ?> (<?php echo number_format($rekap_tahunan->total_diklat) ?>)
		</a>
	<?php } ?>
</p>


<form action="{{ asset('admin/diklat/proses') }}" method="post" accept-charset="utf-8">
			{{ csrf_field() }}
<div class="row mb-2">
	<div class="col-md-7">
		<div class="input-group">
			<button type="submit" name="submit" value="delete" class="btn btn-secondary"><i class="fa fa-trash"></i></button>
    <select name="status_diklat" class="form-control">
            <option value="Disetujui">Disetujui</option>
            <option value="Menunggu">Menunggu</option>
            <option value="Ditolak">Ditolak</option>
          </select>

    
      <span class="input-group-append">
        <button type="submit" name="submit" value="submit" class="btn btn-secondary">
        	<i class="fa fa-save"></i> Update
        </button>
        
        <a href="{{ asset('admin/diklat/tambah') }}" class="btn btn-success">
			<i class="fa fa-plus-circle"></i> Tambah
		</a>

		<a href="{{ asset('admin/diklat/rekap') }}" class="btn btn-info" target="_blank">
			<i class="fa fa-file-excel"></i> Rekap
		</a>

		<a href="{{ asset('admin/diklat/laporan') }}" class="btn btn-primary" target="_blank">
			<i class="fa fa-file-excel"></i> Buat Laporan
		</a>

      </span>
    </div>
	</div>
	<div class="col-md-5">

	</div>
</div>




<div class="mailbox-controls">
	<div class="table-responsive mailbox-messages">
<table class="table table-sm tabelku" id="example3">
	<thead>
		<tr>
			<th width="5%" class="text-center">
				<button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="far fa-square"></i>
						</button>
			</th>
			<th width="20%">Pegawai</th>
			<th width="30%">Diklat</th>
			<th width="10%">Tanggal</th>
			<th width="5%">TAHUN</th>
			<th width="10%">JPL</th>
			<th width="10%">Status</th>
			<th>Aksi</th>
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
			<td>{{ $diklat->nama_lengkap }}
				<small>
					<br>NIP: {{ $diklat->nip }}
				</small>
			</td>
			<td>{{ $diklat->nama_diklat }}</td>
			<td>{{ date('d-m-Y',strtotime($diklat->tanggal_awal)) }}</td>
			<td>{{ date('Y',strtotime($diklat->tanggal_awal)) }}</td>
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
				<a href="{{ asset('admin/diklat/detail/'.$diklat->id_diklat) }}" class="btn btn-info btn-xs mb-1" title="Detail"><i class="fa fa-eye"></i></a>

				<a href="{{ asset('admin/diklat/edit/'.$diklat->id_diklat) }}" class="btn btn-success btn-xs mb-1"><i class="fa fa-edit"></i></a>

				<a href="{{ asset('admin/diklat/delete/'.$diklat->id_diklat) }}" class="btn btn-dark btn-xs mb-1 delete-link"><i class="fa fa-trash"></i></a>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>
</div>
</div>