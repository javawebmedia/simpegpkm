<div class="row mb-2">

	<div class="col-md-6 mb-2">
		<form action="{{ asset('admin/pegawai') }}" method="get" accept-charset="utf-8">
			{{ csrf_field() }}

			<div class="input-group">
             <input type="text" name="keywords" class="form-control" placeholder="NIP atau Nama" value="<?php if(isset($_GET['keywords'])) { echo $_GET['keywords']; } ?>">
              <span class="input-group-append">
                <button type="submit" name="cari" value="cari" class="btn btn-secondary"><i class="fa fa-search"></i> Cari</button>
                <?php if(isset($_GET['keywords'])) { ?>
                	<a href="{{ asset('admin/pegawai') }}" class="btn btn-outline-secondary">
			<i class="fa fa-arrow-left"></i> 
		</a>
		<?php } ?>
              </span>
            </div>

		</form>
	</div>
	<div class="col-md-6 mb-2">
		<a href="{{ asset('admin/pegawai/tambah') }}" class="btn btn-success">
			<i class="fa fa-plus-circle"></i> Tambah Baru
		</a>
		<a href="{{ asset('admin/pegawai/import') }}" class="btn btn-primary">
			<i class="fa fa-file-excel"></i> Import Data Pegawai (Excel)
		</a>

	</div>
</div>

<form action="{{ asset('admin/pegawai/proses') }}" method="post" accept-charset="utf-8">
			{{ csrf_field() }}
<div class="row mb-2">
	<div class="col-md-6">
        <button type="submit" name="status_shift" value="Ya" class="btn btn-secondary"><i class="fa fa-eye-slash"></i> Pegawai Shift</button>
     
        <button type="submit" name="status_shift" value="Tidak" class="btn btn-secondary"><i class="fa fa-eye"></i> Pegawai Non Shift</button>
	</div>
	<div class="col-md-6">
	</div>
</div>

<div class="mailbox-controls">
	<div class="table-responsive mailbox-messages">
		<table class="table table-bordered table-sm">
			<thead>
				<tr class="bg-secondary text-center">
					<th>
						<!-- Check all button -->
						<button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="far fa-square"></i>
						</button>
					</th>
					<th>Nama</th>
					<th>TMT</th>
					<th>TTL</th>
					<th>Divisi</th>
					<th>Jabatan</th>
					<th>Agama</th>
					<th>L/P</th>
					<th>Status</th>
					<th>Jenis</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php $no=1; foreach($pegawai as $pegawai) { ?>
					<tr>
						<td class="text-center">
							<div class="icheck-primary">
		                        <input type="checkbox" value="<?php echo $pegawai->id_pegawai ?>" id="check<?php echo $pegawai->id_pegawai ?>" name="id_pegawai[]">
		                        <label for="check<?php echo $pegawai->id_pegawai ?>"></label>
		                      </div>
							<?php echo $no ?></td>
						<td><?php echo $pegawai->nama_lengkap ?>
						<br><small>NIP: <?php echo $pegawai->nip ?>
							<br>Shift: 
							<?php if($pegawai->status_shift=='Ya') { ?>
								<span class="badge badge-secondary"><i  class="fa fa-eye"></i> <?php echo $pegawai->status_shift ?></span> 
							<?php }else{ ?>
								<span class="badge badge-secondary"><i  class="fa fa-eye-slash"></i> <?php echo $pegawai->status_shift ?></span> 
							<?php } ?>
						</small>
					</td>
					<td><?php echo $pegawai->tmt_masuk ?></td>
					<td><?php echo $pegawai->tempat_lahir ?>, <?php echo $pegawai->tanggal_lahir ?></td>
					<td><?php echo $pegawai->nama_divisi ?></td>
					<td><?php echo $pegawai->nama_jabatan ?></td>
					<td><?php echo $pegawai->nama_agama ?></td>
					<td><?php echo $pegawai->jenis_kelamin ?></td>
					<td><?php echo $pegawai->status_pegawai ?></td>
					<td><?php echo $pegawai->jenis_pegawai ?></td>
					<td>
						<a href="{{ asset('admin/pegawai/detail/'.$pegawai->id_pegawai) }}" class="btn btn-info btn-sm mb-1" title="Detail"><i class="fa fa-eye"></i></a>

						<a href="{{ asset('admin/pegawai/riwayat/'.$pegawai->id_pegawai) }}" class="btn btn-primary btn-sm mb-1" title="Riwayat Pegawai"><i class="fa fa-tasks"></i></a>

						<a href="{{ asset('admin/pegawai/cetak/'.$pegawai->id_pegawai) }}" class="btn btn-success btn-sm mb-1" title="Cetak" target="_blank">
							<i class="fa fa-print"></i>
						</a>

						<a href="{{ asset('admin/pegawai/unduh/'.$pegawai->id_pegawai) }}" class="btn btn-danger btn-sm mb-1" title="Unduh PDF"  target="_blank">
							<i class="fa fa-file-pdf"></i>
						</a>

						<a href="{{ asset('admin/pegawai/edit/'.$pegawai->id_pegawai) }}" class="btn btn-warning btn-sm mb-1" title="Edit"><i class="fa fa-edit"></i></a>

						<a href="{{ asset('admin/pegawai/delete/'.$pegawai->id_pegawai) }}" class="btn btn-dark btn-sm mb-1 delete-link" title="Hapus"><i class="fa fa-trash"></i></a>
					</td>
				</tr>
				<?php $no++; } ?>
			</tbody>
		</table>
	</div>
</div>
</form>