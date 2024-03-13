<form action="{{ asset('pegawai/kinerja') }}" method="get" accept-charset="utf-8">

	<div class="input-group mb-3">
	  <input type="text" class="form-control datepicker" placeholder="dd-mm-yyyy" name="tanggal_kinerja" value="<?php if(isset($_GET['tanggal_kinerja'])) { echo $_GET['tanggal_kinerja']; }else{ echo $tanggal; } ?>">
	  <button class="btn btn-success" type="submit" id="button-addon2">Lihat Kinerja</button>
	</div>

</form>

<div class="alert alert-light text-center">
	Berikut ini adalah data Aktivitas Anda pada tanggal: <strong>{{ $tanggal }}</strong>. 
	<br>Klik tombol <strong>Input Aktivitas Utama</strong> atau <strong>Input Aktivitas Umum</strong> untuk menambah aktivitas sesuai tanggal.
</div>

<div class="card">
	<div class="card-header bg-light">Aktivitas tanggal: {{ $tanggal }}</div>
	<div class="card-body">

		<p>
		    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default">
		      <i class="fa fa-plus-circle"></i> Tambah Aktivitas Utama
		    </button>
		    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-umum">
		      <i class="fa fa-plus-circle"></i> Tambah Aktivitas Umum
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

		@include('pegawai/kinerja/tambah-utama')
		@include('pegawai/kinerja/tambah-umum')

		<table class="table table-bordered table-striped table-sm" id="example1">
			<thead>
				<tr class="bg-secondary text-center">
					<th width="2%">No</th>
					<th width="20%">Aktivitas</th>
					<th width="5%">Standar</th>
					<th width="15%">Mulai</th>
					<th width="15%">Selesai</th>
					<th width="5%">Menit</th>
					<th width="5%">Volume</th>
					<th width="10%">Catatan</th>
					<th width="5%">Jenis</th>
					<th width="5%">Status</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php $no=1; foreach($kinerja as $kinerja) { ?>
				<tr>
					<td class="text-center">{{ $no }}</td>
					<td>{{ $kinerja->nama_aktivitas }}</td>
					<td class="text-center">{{ $kinerja->waktu }}</td>
					<td class="text-center">{{ date('d-m-Y',strtotime($kinerja->tanggal_kinerja)) }}<br>{{ $kinerja->jam_mulai }}</td>
					<td class="text-center">{{ date('d-m-Y',strtotime($kinerja->tanggal_selesai)) }}<br>{{ $kinerja->jam_selesai }}</td>
					<td class="text-center">{{ $kinerja->jumlah_menit }}</td>
					<td class="text-center">{{ $kinerja->volume }}</td>
					<td>{{ $kinerja->keterangan }}</td>
					<td>{{ $kinerja->jenis_aktivitas }}</td>
					<td class="text-center">
						<?php 
						if($kinerja->status_approval=='Disetujui') {
							$warna = 'success';
							$icon 	= 'fa fa-check-circle';
						}elseif($kinerja->status_approval=='Ditolak') {
							$warna = 'danger';
							$icon 	= 'fa fa-times-circle';
						}elseif($kinerja->status_approval=='Menunggu') {
							$warna = 'info';
							$icon 	= 'fa fa-clock';
						}elseif($kinerja->status_approval=='Dikembalikan') {
							$warna = 'warning';
							$icon 	= 'fas fa-exclamation-circle';
						}  
						?>
						<small class="badge badge-{{ $warna; }}"><i class="{{ $icon; }}"></i> 
							{{ $kinerja->status_approval }} </small>
						<small class="text-danger"><br>{{ $kinerja->catatan_atasan }}</small>
					</td>
					<td>
						<?php if($kinerja->status_approval=='Disetujui') { ?>
							<a href="<?php echo asset('pegawai/kinerja/detail/'.$kinerja->id_kinerja.'/'.$tanggal) ?>" class="btn btn-success btn-sm" title="Detail"><i class="fa fa-eye"></i> Detail</a>
						<?php }else{ ?>
							<a href="<?php echo asset('pegawai/kinerja/edit/'.$kinerja->id_kinerja) ?>" class="btn btn-success btn-sm mb-1" title="Edit"><i class="fa fa-edit"></i></a>
							
							<a href="<?php echo asset('pegawai/kinerja/delete/'.$kinerja->id_kinerja.'/'.$tanggal) ?>" class="btn btn-warning btn-sm mb-1 delete-link" title="Hapus"><i class="fa fa-trash"></i></a>
						<?php } ?>
					</td>
				</tr>
				<?php $no++; } ?>
			</tbody>
		</table>

	</div>
</div>