<div class="row mb-2">

	<div class="col-md-6">
		<form action="{{ asset('admin/libur') }}" method="get" accept-charset="utf-8">
			{{ csrf_field() }}

			<div class="input-group input-group-sm">
              <select name="tahun" class="form-control">

              	<?php foreach($list_tahun as $list_tahun) { ?>
              	<option value="<?php echo $list_tahun->tahun ?>" <?php if(isset($_GET['tahun']) && $_GET['tahun']==$list_tahun->tahun) { echo 'selected'; } ?>>
              		<?php echo $list_tahun->tahun ?>
              	</option>
              	<?php } ?>

              </select>
              <span class="input-group-append">
                <button type="submit" class="btn btn-info btn-flat">Lihat Hari Libur</button>
              </span>
            </div>

		</form>
	</div>

	<div class="col-md-6">
		<a href="<?php echo asset('admin/jenis_libur') ?>" class="btn btn-success btn-sm">
		<i class="fa fa-tags"></i> Jenis Libur
		</a>
		<a href="<?php echo asset('admin/libur/weekend') ?>" class="btn btn-info btn-sm">
			<i class="fa fa-calendar"></i> Entri Weekend Sebagai Hari Libur
		</a>
		<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-basic">
			<i class="fa fa-plus-circle"></i> Tambah Baru
		</button>
	</div>
</div>


@include('admin/libur/tambah')

<table class="table table-sm tabelku">
<thead>
	<tr class=" text-left">
		<th width="5%">No</th>
		
		<th width="10%">Tahun</th>
		<th width="24%">Tanggal</th>
		<th width="20%">Jenis</th>
		<th width="20%">Status</th>
		<th width="10%">Sabtu/Minggu<br>Weekend</th>
		<th></th>
	</tr>
</thead>
<tbody>
	<?php 
	$no=1; 
	foreach($libur as $libur) { 
	?>
		<tr>
			<td class="text-center"><?php echo $no ?></td>
			
			<td><?php echo $libur->tahun ?></td>
			<td><?php echo date('d-m-Y',strtotime($libur->tanggal_libur)) ?></td>
			<td><?php echo $libur->nama_jenis_libur ?></td>
			<td><?php echo $libur->status_libur ?></td>
			<td><?php echo $libur->weekend ?></td>
			<td>
				
				<a href="<?php echo asset('admin/libur/edit/'.$libur->id_libur) ?>" class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a>
				<a href="<?php echo asset('admin/libur/delete/'.$libur->id_libur) ?>" class="btn btn-dark btn-xs delete-link"><i class="fa fa-trash"></i></a>
				
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>
	

