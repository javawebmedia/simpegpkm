<p>
	<a href="{{ asset('pegawai/pegawai/tambah') }}" class="btn btn-success">
		<i class="fa fa-plus-circle"></i> Tambah Baru
	</a>
	<a href="{{ asset('pegawai/pegawai/import') }}" class="btn btn-primary">
		<i class="fa fa-file-excel"></i> Import Data Pegawai (Excel)
	</a>
</p>


<table class="table table-bordered table-striped table-sm" id="example1">
	<thead>
		<tr class="bg-secondary text-center">
			<th>No</th>
			<th>Nama</th>
			<th>TMT</th>
			<th>TTL</th>
			<th>Divisi</th>
			<th>Jabatan</th>
			<th>Agama</th>
			<th>L/P</th>
			<th>Status</th>
			<th>Jenis</th>
			<th>NPWP</th>
			<th>Nomor Rekening</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php $no=1; foreach($pegawai as $pegawai) { ?>
		<tr>
			<td><?php echo $no ?></td>
			<td><?php echo $pegawai->nama_lengkap ?></td>
			<td><?php echo $pegawai->tmt_masuk ?></td>
			<td><?php echo $pegawai->tempat_lahir ?>, <?php echo $pegawai->tanggal_lahir ?></td>
			<td><?php echo $pegawai->nama_divisi ?></td>
			<td><?php echo $pegawai->nama_jabatan ?></td>
			<td><?php echo $pegawai->nama_agama ?></td>
			<td><?php echo $pegawai->jenis_kelamin ?></td>
			<td><?php echo $pegawai->status_pegawai ?></td>
			<td><?php echo $pegawai->jenis_pegawai ?></td>
			<td><?php echo $pegawai->npwp ?></td>
			<td><?php echo $pegawai->rekening ?></td>
			<td>
				<a href="{{ asset('pegawai/pegawai/detail/'.$pegawai->id_pegawai) }}" class="btn btn-info btn-sm mb-1" title="Detail"><i class="fa fa-eye"></i></a>

				<a href="{{ asset('pegawai/pegawai/riwayat/'.$pegawai->id_pegawai) }}" class="btn btn-primary btn-sm mb-1" title="Riwayat Pegawai"><i class="fa fa-tasks"></i></a>

				<a href="{{ asset('pegawai/pegawai/cetak/'.$pegawai->id_pegawai) }}" class="btn btn-success btn-sm mb-1" title="Cetak" target="_blank">
					<i class="fa fa-print"></i>
				</a>

				<a href="{{ asset('pegawai/pegawai/unduh/'.$pegawai->id_pegawai) }}" class="btn btn-danger btn-sm mb-1" title="Unduh PDF"  target="_blank">
					<i class="fa fa-file-pdf"></i>
				</a>

				<a href="{{ asset('pegawai/pegawai/edit/'.$pegawai->id_pegawai) }}" class="btn btn-warning btn-sm mb-1" title="Edit"><i class="fa fa-edit"></i></a>

				<a href="{{ asset('pegawai/pegawai/delete/'.$pegawai->id_pegawai) }}" class="btn btn-dark btn-sm mb-1 delete-link" title="Hapus"><i class="fa fa-trash"></i></a>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>
