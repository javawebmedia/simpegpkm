<p>
	<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default">
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

@include('admin/periode/tambah')

<table class="table table-bordered" id="example1">
	<thead>
		<tr>
			<th width="5%">No</th>
			<th>THBL</th>
			<th>Bulan</th>
			<th>Tahun</th>
			<th>Jumlah Hari Kerja</th>
			<th>Keterangan</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php $no=1; foreach($periode as $periode) { ?>
		<tr>
			<td>{{ $no }}</td>
			<td>{{ $periode->thbl }}</td>
			<td>{{ $periode->bulan }}</td>
			<td>{{ $periode->tahun }}</td>
			<td>{{ $periode->jumlah_hari }}</td>
			<td>{{ $periode->keterangan }}</td>
			<td>
				<a href="{{ asset('admin/periode/edit/'.$periode->id_periode) }}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>

				<a href="{{ asset('admin/periode/delete/'.$periode->id_periode) }}" class="btn btn-dark btn-sm delete-link"><i class="fa fa-trash"></i></a>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>