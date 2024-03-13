<div class="alert alert-light">
	<form action="{{ asset('admin/struktur/tambah') }}" method="POST" accept-charset="utf-8">
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
						<i class="fas fa-plus"></i> Tambah Data Atasan
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

<table class="table table-bordered" id="example1">
	<thead>
		<tr>
			<th width="5%">No</th>
			<th>NIP - Nama Pegawai</th>
			<th>Bawahan</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php $no=1; foreach($atasan as $atasan) { ?>
		<tr>
			<td>{{ $no }}</td>
			<td>
				{{ $atasan->nip . ' - ' . $atasan->nama_lengkap }}
			</td>
			<td>
				<?php
				$bawahan = $m_bawahan->atasan($atasan->id_atasan);
				?>
				<ul>
					@foreach($bawahan as $bawahan)
					<li>{{ $bawahan->nama_lengkap }}</li>
					@endforeach
				</ul>
			</td>
			<td>
				<a href="{{ asset('admin/struktur/bawahan/'.$atasan->id_atasan) }}" class="btn btn-success btn-sm">
					<i class="fa fa-sitemap"></i> Kelola Bawahan
				</a>

				<a href="{{ asset('admin/struktur/edit/'.$atasan->id_atasan) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>

				<a href="{{ asset('admin/struktur/delete/'.$atasan->id_atasan) }}" class="btn btn-danger btn-sm delete-link"><i class="fa fa-trash"></i></a>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>