<p>
	<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default">
	  <i class="fa fa-plus-circle"></i> Tambah Baru
	</button>

	<!-- <a href="{{ asset('admin/kode-diklat/import') }}" class="btn btn-primary">
			<i class="fa fa-file-excel"></i> Import Kodifikasi (Excel)
	</a> -->
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

@include('admin/kode_diklat/tambah')

<form action="{{ asset('admin/kode-diklat/proses') }}" method="post" accept-charset="utf-8">
			{{ csrf_field() }}
<div class="row mb-2">
	<div class="input-group">
    <select name="id_rumpun" class="form-control" id="id_rumpun2" required>
          <option value="">Pilih Rumpun</option>
          <?php foreach($rumpun2 as $rumpun2) { ?>
          <option value="<?php echo $rumpun2->id_rumpun ?>">
            <?php echo $rumpun2->nama_rumpun ?>
          </option>
        <?php } ?>
    </select>

    <select name="id_jenis_pelatihan" class="form-control" id="id_jenis_pelatihan2" required>
      <option value="">Pilih Jenis Pelatihan</option>
      <?php foreach($jenis_pelatihan as $jenis_pelatihan) { ?>
      <option value="<?php echo $jenis_pelatihan->id_jenis_pelatihan ?>"  class="{{ $jenis_pelatihan->id_rumpun }}">
        <?php echo $jenis_pelatihan->nama_jenis_pelatihan ?>
      </option>
    <?php } ?>
    </select>
      <span class="input-group-append">
        <button type="submit" name="submit" value="submit" class="btn btn-secondary"><i class="fa fa-save"></i> Update</button>
        
      </span>
    </div>
</div>

 <script>
            $("#id_jenis_pelatihan2").chained("#id_rumpun2");
          </script>

<div class="mailbox-controls">
	<div class="table-responsive mailbox-messages">
<table class="table table-sm tabelku" id="example1">
	<thead>
		<tr>
			<th width="5%" class="text-center">
				<button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="far fa-square"></i>
						</button>
			</th>
			<th width="10%">Kode</th>
			<th width="20%">Nama</th>
			<th width="20%">Jenis</th>
			<th width="20%">Rumpun</th>
			<th width="10%">Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php $no=1; foreach($kode_diklat as $kode_diklat) { ?>
		<tr>
			<td class="text-center">
				<div class="icheck-primary">
                    <input type="checkbox" value="<?php echo $kode_diklat->id_kode_diklat ?>" id="check<?php echo $kode_diklat->id_kode_diklat ?>" name="id_kode_diklat[]">
                    <label for="check<?php echo $kode_diklat->id_kode_diklat ?>"></label>
                  </div>
			</td>
			<td>{{ $kode_diklat->kode_diklat }}</td>
			<td>{{ $kode_diklat->nama_kode_diklat }}</td>
			<td>{{ $kode_diklat->nama_rumpun }}</td>
			<td>{{ $kode_diklat->nama_jenis_pelatihan }}</td>
			<td>
				<a href="{{ asset('admin/kode-diklat/edit/'.$kode_diklat->id_kode_diklat) }}" class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a>

				<a href="{{ asset('admin/kode-diklat/delete/'.$kode_diklat->id_kode_diklat) }}" class="btn btn-dark btn-xs delete-link"><i class="fa fa-trash"></i></a>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>
</div>
</div>