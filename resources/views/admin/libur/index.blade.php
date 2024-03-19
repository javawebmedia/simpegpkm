<p>
	<a href="<?php echo asset('admin/jenis_libur') ?>" class="btn btn-success btn-sm">
		<i class="fa fa-tags"></i> Jenis Libur
	</a>



	<a href="<?php echo asset('admin/libur/weekend') ?>" class="btn btn-info btn-sm">
		<i class="fa fa-calendar"></i> Entri Weekend Sebagai Hari Libur
	</a>
	<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-basic">
		<i class="fa fa-plus-circle"></i> Tambah Baru
	</button>
</p>
@include('admin/libur/tambah')

	<table class="table table-sm table-bordered">
		<thead>
			<tr class=" text-left">
				<th width="5%">No</th>
				
				<th width="10%">Tahun</th>
				<th width="24%">Tanggal</th>
				<th width="20%">Jenis</th>
				<th width="20%">Status</th>
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
					<td>
						
						<a href="<?php echo asset('admin/libur/edit/'.$libur->id_libur) ?>" class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a>
						<a href="<?php echo asset('admin/libur/delete/'.$libur->id_libur) ?>" class="btn btn-dark btn-xs delete-link"><i class="fa fa-trash"></i></a>
						
					</td>
				</tr>
				<?php $no++; } ?>
			</tbody>
		</table>
	

