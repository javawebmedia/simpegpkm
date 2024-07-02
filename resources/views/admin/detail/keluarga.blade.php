@include('admin/detail/flow')
@include('admin/kehadiran/profil-pegawai')

<div class="card">
	<div class="card-header bg-light">
		<strong>DATA KELUARGA PEGAWAI</strong>
	</div>
	<div class="card-body">
		<table class="table table-sm tabelku">
			<thead>
				<tr>
					<th width="2%">No</th>
					<th>Hub. Keluarga</th>
					<th>NIK/ Nama Lengkap</th>
					<th>Tempat &amp; Tanggal Lahir</th>
					<th>Jenis Kelamin</th>
					<th>Agama</th>
					<th>Pendidikan</th>
					<th>Pekerjaan</th>
					<th>Status Perkawinan</th>
				</tr>
			</thead>
			<tbody>
				<?php $no=1; foreach($keluarga as $keluarga) { ?>
				<tr>
					<td class="text-center">{{ $no }}</td>
					<td>{{ $keluarga->nama_hubungan_keluarga }}</td>
					<td>
						{{ $keluarga->nama_lengkap }} <br>
						<strong class="text-primary">{{ $keluarga->nik }}</strong>
					</td>
					<td>
						{{ $keluarga->tempat_lahir }}, <br>
						{{ date('d-m-Y',strtotime($keluarga->tanggal_lahir) )}}
					</td>
					<td>{{ $keluarga->jenis_kelamin }}</td>
					<td>{{ $keluarga->nama_agama }}</td>
					<td>{{ $keluarga->nama_jenjang_pendidikan }}</td>
					<td>{{ $keluarga->nama_pekerjaan }}</td>
					<td>{{ $keluarga->status_perkawinan }}</td>
					
				</tr>
				<?php $no++; } ?>
			</tbody>
		</table>
	</div>
</div>
