<div class="row mb-2">

	<div class="col-md-6">
		<form action="{{ asset('admin/kuota-cuti') }}" method="get" accept-charset="utf-8">
			{{ csrf_field() }}

			<div class="input-group">
              <select name="tahun" class="form-control">

              	<option value="Semua">Semua</option>
              	<?php foreach($list_tahun as $list_tahun) { ?>
              	<option value="<?php echo $list_tahun->tahun ?>" <?php if(isset($_GET['tahun']) && $_GET['tahun']==$list_tahun->tahun) { echo 'selected'; } ?>>
              		<?php echo $list_tahun->tahun ?>
              	</option>
              	<?php } ?>

              </select>

              <select name="nip" class="form-control select2">

              	<option value="Semua">Semua</option>

              	<?php foreach($pegawai as $pegawai) { ?>
              		<option value="<?php echo $pegawai->nip ?>" <?php if(isset($_GET['nip']) && $_GET['nip']==$pegawai->nip) { echo "selected"; } ?>>
              			<?php echo $pegawai->nip ?> - <?php echo $pegawai->nama_lengkap ?>
              		</option>
              	<?php } ?>

              </select>

              <span class="input-group-append">
                <button type="submit" class="btn btn-info btn-flat">Lihat Kuota</button>
              </span>
            </div>

		</form>
	</div>

	<div class="col-md-6">
		<a href="<?php echo asset('admin/kuota-cuti/import') ?>" class="btn btn-success">
		<i class="fa fa-file-excel"></i> Import Kuota Cuti
		</a>
		
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-basic">
			<i class="fa fa-plus-circle"></i> Tambah Kuota Cuti
		</button>
	</div>
</div>


@include('admin/kuota_cuti/tambah')

<table class="table table-sm table-bordered" id="example1">
<thead>
	<tr class=" text-left">
		<th width="5%">No</th>
		<th width="5%">Tahun</th>
		<th width="10%">NIP</th>
		<th width="20%">Pegawai</th>
		<th width="15%">Keterangan</th>
		<th width="10%">Kuota</th>
		<th width="10%">Digunakan</th>
		<th width="10%">Sisa</th>
		<th></th>
	</tr>
</thead>
<tbody>
	<?php 
	$no=1; 
	foreach($kuota_cuti as $kuota_cuti) { 
	?>
		<tr>
			<td class="text-center"><?php echo $no ?></td>
			<td><?php echo $kuota_cuti->tahun ?></td>
			<td><?php echo $kuota_cuti->nip ?></td>
			<td><?php echo $kuota_cuti->nama_lengkap ?></td>
			<td><?php echo $kuota_cuti->keterangan ?></td>
			<td><?php echo $kuota_cuti->kuota ?></td>
			<td></td>
			<td></td>
			<td>
				<a href="<?php echo asset('admin/kuota-cuti/edit/'.$kuota_cuti->id_kuota_cuti) ?>" class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a>
				<a href="<?php echo asset('admin/kuota-cuti/delete/'.$kuota_cuti->id_kuota_cuti) ?>" class="btn btn-dark btn-xs delete-link"><i class="fa fa-trash"></i></a>
				
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>
	

