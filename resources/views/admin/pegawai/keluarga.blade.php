<?php 
use Illuminate\Support\Facades\DB;
// ambil data master
$jenjang_pendidikan = DB::table('jenjang_pendidikan')->orderBy('urutan', 'ASC')->get();
$hubungan_keluarga = DB::table('hubungan_keluarga')->orderBy('urutan', 'ASC')->get();
$agama = DB::table('agama')->orderBy('urutan', 'ASC')->get();
$pekerjaan = DB::table('pekerjaan')->orderBy('urutan', 'ASC')->get();
?>
<div class="card mb-2 mt-2" id="keluarga">
	<div class="card-header bg-light">
		RIWAYAT KELUARGA
	</div>
	<div class="card-body">

		<p class="text-right">
			<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-keluarga">
			  <i class="fa fa-plus-circle"></i> Tambah Baru
			</button>
		</p>

		@if($errors->any())
		    <div class="alert alert-danger">
		        <ul>
		            @foreach ($errors->all() as $error)
		                <li>{{ $error }}</li>
		            @endforeach
		        </ul>
		    </div>
		@endif

		@include('admin/pegawai/tambah-keluarga')

		<table class="table table-bordered table-striped table-sm">
			<thead>
				<tr class="text-center">
					<th width="2%">No</th>
					<th>Hub. Keluarga</th>
					<th>NIK/ Nama Lengkap</th>
					<th>Tempat &amp; Tanggal Lahir</th>
					<th>Jenis Kelamin</th>
					<th>Agama</th>
					<th>Pendidikan</th>
					<th>Pekerjaan</th>
					<th>Status Perkawinan</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php $no=1; foreach($keluarga as $keluarga) { ?>
				<tr>
					<td class="text-center">{{ $no }}</td>
					<td class="text-center">{{ $keluarga->nama_hubungan_keluarga }}</td>
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
					<td class="text-center">{{ $keluarga->nama_jenjang_pendidikan }}</td>
					<td class="text-center">{{ $keluarga->nama_pekerjaan }}</td>
					<td class="text-center">{{ $keluarga->status_perkawinan }}</td>
					<td>
						<a href="{{ asset('admin/pegawai/lihat-keluarga/'.$pegawai->id_pegawai.'/'.$keluarga->id_keluarga) }}" class="btn btn-warning btn-sm mb-1" title="Edit"><i class="fa fa-edit"></i></a>

						<a href="{{ asset('admin/pegawai/delete-keluarga/'.$pegawai->id_pegawai.'/'.$keluarga->id_keluarga) }}" class="btn btn-dark btn-sm mb-1 delete-link" title="Hapus"><i class="fa fa-trash"></i></a>
					</td>
				</tr>
				<?php $no++; } ?>
			</tbody>
		</table>
	</div>
</div>