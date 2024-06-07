<form action="{{ asset('pegawai/ekinerja/approval') }}" method="get" accept-charset="utf-8">
{{ csrf_field() }}
	
	<div class="input-group">

	  <input type="text" class="form-control datepicker" name="tanggal" placeholder="dd-mm-yyyy" value="<?php if(isset($_GET['tanggal'])) { echo $_GET['tanggal']; } ?>" required>

	  <button class="btn btn-success" type="submit">
	  	<i class="fa fa-save"></i> Pilih tanggal
	  </button>

	</div>

</form>

<table class="table table-bordered mt-3">
	<tbody>
		<tr>
			<th class="bg-light" width="20%">Nama atasan</th>
			<td>{{ Session()->get('nama_lengkap') }}</td>
		</tr>
		<tr>
			<th class="bg-light">Periode</th>
			<td>{{ $tanggal }}</td>
		</tr>
	</tbody>
</table>

<table class="table table-sm tabelku" id="example1">
	<thead>
		<tr>
			<th width="5%">No</th>
			<th>NIP</th>
			<th>Nama Pegawai</th>
			<th>Status Pengisian</th>
			<th>Status Approval</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php $no=1; foreach($bawahan as $bawahan) { ?>
		<tr>
			<td>{{ $no }}</td>
			<td>{{ $bawahan->nip }}</td>
			<td>{{ $bawahan->nama_lengkap }}</td>
			<td></td>
			<td></td>
			<td>
				<a href="{{ asset('pegawai/ekinerja/detail/'.$bawahan->id_bawahan) }}" class="btn btn-warning btn-sm"><i class="fa fa-eye"></i> Detail</a>

				<a href="{{ asset('pegawai/ekinerja/setujui/'.$bawahan->id_bawahan.'/'.$bawahan->id_atasan) }}" class="btn btn-danger btn-sm delete-link"><i class="fa fa-check-circle"></i> Setujui</a>

				<a href="{{ asset('pegawai/ekinerja/tolak/'.$bawahan->id_bawahan.'/'.$bawahan->id_atasan) }}" class="btn btn-dark btn-sm delete-link"><i class="fa fa-times"></i> Tolak</a>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>