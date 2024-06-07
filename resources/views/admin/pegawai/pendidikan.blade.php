<?php 
use Illuminate\Support\Facades\DB;
// ambil data master
$jenjang_pendidikan = DB::table('jenjang_pendidikan')->get();
?>
<div class="card mb-2 mt-2" id="pendidikan">
	<div class="card-header bg-light">
		RIWAYAT PENDIDIKAN
	</div>
	<div class="card-body">

		<p class="text-right">
			<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-pendidikan">
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

		@include('admin/pegawai/tambah-pendidikan')

		<table class="table table-sm tabelku">
			<thead>
				<tr class="text-center">
					<th width="2%">No</th>
					<th>Tgl Lulus</th>
					<th>Sekolah/Institusi</th>
					<th>Jenjang</th>
					<th>Jenis</th>
					<th>No. Ijazah</th>
					<th>Kota</th>
					<th>Tahun Masuk</th>
					<th>Tahun Lulus</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php $no=1; foreach($pendidikan as $pendidikan) { ?>
				<tr>
					<td class="text-center">{{ $no }}</td>
					<td class="text-center">{{ date('d-m-Y',strtotime($pendidikan->tanggal_lulus) )}}</td>
					<td>{{ $pendidikan->nama_sekolah }}</td>
					<td>{{ $pendidikan->nama_jenjang_pendidikan }}</td>
					<td>{{ $pendidikan->jenis_pendidikan }}</td>
					<td>{{ $pendidikan->nomor_ijazah }}</td>
					<td class="text-center">{{ $pendidikan->kota_sekolah }}</td>
					<td class="text-center">{{ $pendidikan->tahun_masuk }}</td>
					<td class="text-center">{{ $pendidikan->tahun_lulus }}</td>
					<td>
						<a href="{{ asset('admin/pegawai/lihat-pendidikan/'.$pegawai->id_pegawai.'/'.$pendidikan->id_pendidikan) }}" class="btn btn-warning btn-sm mb-1" title="Edit"><i class="fa fa-edit"></i></a>

						<a href="{{ asset('admin/pegawai/delete-pendidikan/'.$pegawai->id_pegawai.'/'.$pendidikan->id_pendidikan) }}" class="btn btn-dark btn-sm mb-1 delete-link" title="Hapus"><i class="fa fa-trash"></i></a>
					</td>
				</tr>
				<?php $no++; } ?>
			</tbody>
		</table>
	</div>
</div>