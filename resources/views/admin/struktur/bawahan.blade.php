<p class="mb-5">
	<a href="{{ asset('admin/struktur') }}" class="btn btn-default float-right">
		<i class="fa fa-backward"></i> Kembali
	</a>
</p>
<div class="clearfix"></div>

<div class="alert alert-light">
	<form action="{{ asset('admin/struktur/tambah-bawahan') }}" method="POST" accept-charset="utf-8">
		<input type="hidden" name="id_atasan" value="{{ $atasan->id_atasan }}">
		@csrf
		<strong>Ketik NIP/ Nama Pegawai untuk mencari data pegawai</strong>
		<div class="form-group">
			<div class="input-group">
				<select name="id_pegawai" id="id_pegawai" class="form-control select2bs4" required>
					<option value="">Pilih pegawai</option>
					@foreach($pegawai as $pegawai)
					<option value="{{ $pegawai->id_pegawai }}">{{ $pegawai->nip . ' - ' . $pegawai->nama_lengkap }}</option>
					@endforeach
				</select>
				<span class="input-group-append">
					<button class="btn btn-success">
						<i class="fas fa-plus"></i> Tambah Data Bawahan
					</button>
				</span>
			</div>
		</div>
	</form>
</div>

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<table class="table table-sm tabelku" id="example1">
	<thead>
		<tr>
			<th width="5%">No</th>
			<th>NIP - Nama Pegawai</th>
			<th>Status</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php $no=1; foreach($bawahan as $bawahan) { ?>
		<tr>
			<td>{{ $no }}</td>
			<td>
				{{ $bawahan->nip . '-' . $bawahan->nama_lengkap }}
			</td>
			<td>{{ $bawahan->status_bawahan }}</td>
			<td>
				<a href="{{ asset('admin/struktur/edit-bawahan/'.$bawahan->id_bawahan) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>

				<a href="{{ asset('admin/struktur/delete-bawahan/'.$bawahan->id_bawahan.'/'.$bawahan->id_atasan) }}" class="btn btn-danger btn-sm delete-link"><i class="fa fa-trash"></i></a>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>