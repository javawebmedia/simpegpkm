<p class="text-right">
	<a href="<?php echo asset('admin/jenis-dokumen') ?>" class="btn btn-outline-info btn-sm">
		<i class="fa fa-arrow-left"></i> Kembali
	</a>
</p>

<div class="row">
	<div class="col-md-4">
		<div class="card">
			<div class="card-header bg-light">
				<strong>DETAIL JENIS DOKUMEN</strong>
			</div>
			<div class="card-body">
				<table class="table table-sm tabelku">
					<thead>
						<tr>
							<th width="25%">Nama</th>
							<th><?php echo $jenis_dokumen->nama_jenis_dokumen ?></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Kode</td>
							<td><?php echo $jenis_dokumen->kode_jenis_dokumen ?></td>
						</tr>
						<tr>
							<td>Keterangan</td>
							<td><?php echo $jenis_dokumen->keterangan ?></td>
						</tr>
						<tr>
							<td>Status</td>
							<td><?php echo $jenis_dokumen->status_jenis_dokumen ?></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="col-md-8">
		<div class="card">
			<div class="card-header bg-light">
				<strong>KELOLA SUB JENIS DOKUMEN</strong>
			</div>
			<div class="card-body">
				@if ($errors->any())
				<div class="alert alert-danger">
				    <ul>
				        @foreach ($errors->all() as $error)
				        <li>{{ $error }}</li>
				        @endforeach
				    </ul>
				</div>
				@endif
				<p>
					<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default">
		                <i class="fa fa-plus-circle"></i> Tambah Sub Jenis Dokumen
		            </button>
				</p>
				<p>
				    @include('admin/jenis_dokumen/tambah-sub')
				</p>

				<table class="tabelnya table-sm tabelku">
			        <thead>
			            
			                <th width="5%">NO</th>
			                <th width="30%">NAMA</th>
			                <th width="15%">KODE</th>
			                <th width="10%">NO.URUT</th>
			                <th>STATUS</th>
			                <th>ACTION</th>
			            </tr>
			        </thead>
			        <tbody>

			            <?php $i = 1;
			            foreach ($sub_jenis_dokumen as $sub_jenis_dokumen) { ?>

			                <td class="text-center"><?php echo $i ?></td>
			                <td><?php echo $sub_jenis_dokumen->nama_sub_jenis_dokumen ?></td>
			                <td><?php echo $sub_jenis_dokumen->kode_sub_jenis_dokumen ?></td>
			                <td><?php echo $sub_jenis_dokumen->urutan ?></td>
			                <td class="text-center">
			                    <?php if ($sub_jenis_dokumen->status_sub_jenis_dokumen == 'Aktif') { ?>
			                        <span class="badge bg-success">{{ $sub_jenis_dokumen->status_sub_jenis_dokumen }}</span>
			                    <?php } else { ?>
			                        <span class="badge bg-danger">{{ $sub_jenis_dokumen->status_sub_jenis_dokumen }}</span>
			                    <?php } ?>
			                </td>
			                <td>

			                    <button type="button" class="btn btn-secondary btn-xs" data-toggle="modal" data-target="#edit-sub<?php echo $sub_jenis_dokumen->id_sub_jenis_dokumen ?>">
					                <i class="fa fa-edit"></i>
					            </button>

			                    <a href="{{ asset('admin/jenis-dokumen/delete-sub/'.$sub_jenis_dokumen->id_jenis_dokumen.'/'.$sub_jenis_dokumen->id_sub_jenis_dokumen) }}" class="btn btn-secondary btn-xs delete-link">
			                        <i class="fa fa-trash"></i></a>

			                        @include('admin/jenis_dokumen/edit-sub')
			                </td>
			                </tr>

			            <?php $i++;
			            } ?>

			        </tbody>
			    </table>
			</div>
		</div>
	</div>
</div>
