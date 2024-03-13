<p class="text-right">
	<a href="{{ asset('admin/kinerja/approval?tanggal_kinerja='.$tanggal_kinerja) }}" class="btn btn-outline-info btn-sm"><i class="fa fa-arrow-left"></i> Kembali</a>
</p>

<table class="table table-bordered">
	<tbody>
		<tr>
			<th class="bg-light" width="25%">Nama pegawai</th>
			<td>{{ $bawahan->nama_lengkap }}</td>
		</tr>
		<tr>
			<th class="bg-light">NIP / NRK</th>
			<td>{{ $bawahan->nip }} / {{ $bawahan->nrk }}</td>
		</tr>
		<tr>
			<th class="bg-light">Divisi</th>
			<td>{{ $bawahan->nama_divisi }}</td>
		</tr>
		<tr>
			<th class="bg-light">Jabatan</th>
			<td>{{ $bawahan->nama_jabatan }}</td>
		</tr>
	</tbody>
</table>

<form action="{{ asset('admin/kinerja/proses') }}" method="post">
{{ csrf_field() }}

<input type="hidden" name="tanggal_kinerja" value="{{ $tanggal_kinerja }}">
<input type="hidden" name="id_atasan" value="{{ Session()->get('id_pegawai') }}">
<input type="hidden" name="nip" value="{{ $bawahan->nip }}">

<hr>

<div class="input-group">

	<select name="status_approval" class="form-control col-md-3 bg-light" required>
		<option value="Disetujui">Disetujui</option>
		<option value="Ditolak">Ditolak</option>
		<option value="Dikembalikan">Dikembalikan</option>
	</select>

	<input type="text" class="form-control" name="catatan_atasan" value="{{ old('catatan_atasan') }}" placeholder="Catatan atasan">

	<span class="input-group-append">
		<button type="submit" class="btn btn-info btn-flat">
			<i class="fa fa-save"></i> Simpan Status
		</button>

		<a href="{{ asset('admin/kinerja/approval?tanggal_kinerja='.$tanggal_kinerja) }}" class="btn btn-outline-success btn-flat"><i class="fa fa-arrow-left"></i> Kembali</a>

	</span>

</div>

 <hr>

<div class="table-responsive mailbox-messages">

<table class="table table-bordered table-sm">
			<thead>
				<tr class="bg-secondary text-center align-middle">
					<th width="2%">
						<div class="mailbox-controls">
			                <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="far fa-square"></i>
			                </button>
			            </div>
					</th>
					<th width="20%">Aktivitas</th>
					<th width="5%">Standar</th>
					<th width="13%">Mulai</th>
					<th width="13%">Selesai</th>
					<th width="5%">Menit</th>
					<th width="5%">Volume</th>
					<th width="10%">Catatan</th>
					<th width="5%">Jenis</th>
					<th width="5%">Status</th>
					<th>Jumlah Menit Disetujui</th>
				</tr>
			</thead>
			<tbody>
				<?php $no=1; foreach($kinerja as $kinerja) { ?>
				<tr>
					<td class="text-center">
						<div class="icheck-primary">
	                        <input type="checkbox" name="id_kinerja[]" value="{{ $kinerja->id_kinerja }}" id="check{{ $no }}">
	                        <label for="check{{ $no }}"></label>
	                      </div>
					{{ $no }}</td>
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
						<input type="number" name="jumlah_menit_disetujui[]" value="{{ $kinerja->jumlah_menit_disetujui }}" class="form-control" placeholder="Jumlah menit disetujui">
					</td>
				</tr>
				<?php $no++; } ?>
			</tbody>
		</table>
</div>

</form>