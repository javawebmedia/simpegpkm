<p class="text-right">
	<a href="{{ asset('admin/pegawai') }}" class="btn btn-outline-info">
		<i class="fa fa-arrow-left"></i> Kembali
	</a>
</p>

<div class="row">
	<div class="col-md-5">
		<div class="card">
			<div class="card-header bg-light">
				<strong>DATA PEGAWAI</strong>
			</div>
			<div class="card-body">
				<table class="table table-sm tabelku">
					<tbody>
						<tr>
							<td width="30%">Nama lengkap</td>
							<td>{{ $pegawai->nama_lengkap }}</td>
						</tr>
						<tr>
							<td>NIP</td>
							<td>{{ $pegawai->nip }}</td>
						</tr>
						<tr>
							<td>NRK</td>
							<td>{{ $pegawai->nrk }}</td>
						</tr>
						<tr>
							<td>NIK</td>
							<td>{{ $pegawai->nik }}</td>
						</tr>
						<tr>
							<td>Jenis Pegawai</td>
							<td>{{ $pegawai->jenis_pegawai }}</td>
						</tr>
						<tr>
							<td>Status Pegawai</td>
							<td>{{ $pegawai->status_pegawai }}</td>
						</tr>
						<tr>
							<td>Status Perkawinan</td>
							<td>{{ $pegawai->status_perkawinan }}</td>
						</tr>
						<tr>
							<td>Tempat, tanggal lahir</td>
							<td>{{ $pegawai->tempat_lahir }}, {{ date('d-m-Y',strtotime($pegawai->tanggal_lahir)) }}</td>
						</tr>
						<tr>
							<td>TMT Pegawai</td>
							<td>{{ date('d-m-Y',strtotime($pegawai->tmt_masuk)) }}</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<!-- mesin absen -->
	<div class="col-md-7">
		<div class="card">
			<div class="card-header bg-light">
				<strong>SETTING AKSES MESIN ABSENSI</strong>
			</div>
			<div class="card-body">
				<form action="{{ asset('admin/pegawai/proses-mesin') }}" method="post" accept-charset="utf-8">
							{{ csrf_field() }}

				<input type="hidden" name="id_pegawai" value="<?php echo $pegawai->id_pegawai ?>">
				<input type="hidden" name="nip" value="<?php echo $pegawai->nip ?>">

				<div class="row mb-2">
					<div class="col-md-6">
				        <button type="submit" name="aktifkan" value="Ya" class="btn btn-secondary"><i class="fa fa-check-circle"></i> Aktifkan</button>
				     
				        <!-- <button type="submit" name="non_aktif" value="Ya" class="btn btn-secondary"><i class="fa fa-times-circle"></i> Non Aktifkan</button> -->
				        
					</div>
					<div class="col-md-6">
					</div>
				</div>

				<div class="mailbox-controls">
					<div class="table-responsive mailbox-messages">
						<table class="table table-sm tabelku">
							<thead>
								<tr class="text-left">
									<th class="text-center">
										<!-- Check all button -->
										<button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="far fa-square"></i>
										</button>
									</th>
									<th>Lokasi</th>
									<th>Serial Number</th>
									<th>IP Address</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<?php $no=1; foreach($mesin_absen as $mesin_absen) { 
									
									$nip 				= $pegawai->nip;
									$id_mesin_absen 	= $mesin_absen->id_mesin_absen;
									$check 				= $m_pin_pegawai->check_pegawai_mesin($nip,$id_mesin_absen);

									?>
									<tr>
										<td class="text-center">
											<div class="icheck-primary">
						                        <input type="checkbox" value="<?php echo $mesin_absen->id_mesin_absen ?>" id="check<?php echo $mesin_absen->id_mesin_absen ?>" name="id_mesin_absen[]" <?php if(!empty($check)) { echo 'checked="checked"'; } ?>>
						                        <label for="check<?php echo $mesin_absen->id_mesin_absen ?>"></label>
						                      </div>
											</td>
										
									<td><?php echo $mesin_absen->lokasi ?></td>
									<td><?php echo $mesin_absen->serial_number ?></td>
									<td><?php echo $mesin_absen->ip_mesin_absen ?></td>
									<td>
										<?php if(!empty($check)) { ?>
											<a href="{{ asset('admin/pegawai/delete-mesin/'.$mesin_absen->id_mesin_absen.'/'.$pegawai->id_pegawai) }}" class="btn btn-secondary btn-xs delete-link">
												<i class="fa fa-trash"></i> Non Aktifkan
											</a>
										<?php } ?>
									</td>
								</tr>
								<?php $no++; } ?>
							</tbody>
						</table>
					</div>
				</div>
				</form>
			</div>
		</div>
	</div>
	<!-- end mesin -->
</div>


