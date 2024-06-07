<?php 
use Illuminate\Support\Facades\DB;
use App\Models\Jabatan_model;
// ambil data master
$m_jabatan 			= new Jabatan_model();
$jabatan  			= $m_jabatan->listing();
$divisi 			= DB::table('divisi')->get();
$jenjang_pendidikan = DB::table('jenjang_pendidikan')->get();
$pangkat 			= DB::table('pangkat')->get();
?>
<div class="card mb-2 mt-2" id="jabatan">
	<div class="card-header bg-light">
		RIWAYAT JABATAN
	</div>
	<div class="card-body">

		@if($errors->any())
		    <div class="alert alert-danger">
		        <ul>
		            @foreach ($errors->all() as $error)
		                <li>{{ $error }}</li>
		            @endforeach
		        </ul>
		    </div>
		@endif

		@include('pegawai/pegawai/tambah-jabatan')

		<table class="table table-sm tabelku">
			<thead>
				<tr class="text-center">
					<th width="2%">No</th>
					<th>TMT</th>
					<th>Jabatan</th>
					<th>Jenis</th>
					<th>Divisi</th>
					<th>Eselon</th>
					<th>Pangkat</th>
					<th>No SK</th>
					<th>Tgl SK</th>
				</tr>
			</thead>
			<tbody>
				<?php $no=1; foreach($riwayat_jabatan as $riwayat_jabatan) { ?>
				<tr>
					<td class="text-center">{{ $no }}</td>
					<td class="text-center">{{ date('d-m-Y',strtotime($riwayat_jabatan->tmt) )}}</td>
					<td>{{ $riwayat_jabatan->nama_jabatan }}</td>
					<td>{{ $riwayat_jabatan->jenis_jabatan }}</td>
					<td>{{ $riwayat_jabatan->nama_divisi }}</td>
					<td class="text-center">{{ $riwayat_jabatan->eselon }}</td>
					<td class="text-center">{{ $riwayat_jabatan->golongan }}/{{ $riwayat_jabatan->ruang }}</td>
					<td class="text-center">{{ $riwayat_jabatan->nomor_sk }}</td>
					<td class="text-center">{{ date('d-m-Y',strtotime($riwayat_jabatan->tanggal_sk) )}}</td>
					
				</tr>
				<?php $no++; } ?>
			</tbody>
		</table>
	</div>
</div>