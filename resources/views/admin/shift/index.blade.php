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

@include('admin/shift/tambah')

<table class="table table-sm tabelku" id="example1">
	<thead>
		<tr>
			<th width="5%">No</th>
			<th>Kode</th>
			<th>Nama</th>
			<th>Datang - Pulang</th>
			<th>Default</th>
			<th>Ganti Hari</th>
			<th>Status</th>
			<th>Day-Off</th>
			<th>Jumat</th>
			<th>Keterangan</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php $no=1; foreach($shift as $shift) { ?>
		<tr>
			<td>{{ $no }}</td>
			<td>{{ $shift->kode }}</td>
			<td>{{ $shift->nama }}</td>
			<td>{{ $shift->jam_mulai }} - {{ $shift->jam_selesai }}</td>
			<td>{{ $shift->shift_default }}</td>
			<td>{{ $shift->ganti_hari }}</td>
			<td><?php echo $shift->status ?></td>
			<td>
				<?php echo $shift->day_off ?>
			</td>
			<td>
				<?php echo $shift->jumat ?>
			</td>
			<td>{{ $shift->keterangan }}</td>
			<td>
				<a href="{{ asset('admin/shift/edit/'.$shift->id_shift) }}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>

				<a href="{{ asset('admin/shift/delete/'.$shift->id_shift) }}" class="btn btn-dark btn-sm delete-link"><i class="fa fa-trash"></i></a>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>

<script>
  $("[name='my-checkbox']").bootstrapSwitch();
  $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    })
</script>

<script>
  $('.timepicker').timepicker({
    timeFormat: 'H:mm',
    interval: 15,
    defaultTime: '07:00',
    dynamic: true,
    dropdown: true,
    scrollbar: true
  });
</script>