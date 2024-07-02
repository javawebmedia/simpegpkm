@include('admin/kehadiran/profil-pegawai')

		<div class="card">
			<div class="card-header bg-light"><strong>UPDATE DATA KEHADIRAN PEGAWAI</strong></div>
			<div class="card-body">

				<div class="row">
					<?php 
					foreach($kehadiran as $kehadiran) { 
						$hadir 	= $m_status_absen->jenis_status_absen('Kehadiran');
						$absen 	= $m_status_absen->jenis_status_absen('Absensi');
					?>
						<div class="col-md-1">
							<small>
						 	<div class="card <?php if($kehadiran->day_off=='Ya') { echo 'disabled'; } ?>">
						 		<div class="card-header p-1 text-center" style="background-color: <?php echo $kehadiran->warna ?>;">
						 			
						 			<?php if($kehadiran->nama_status_absen=='') { ?>

					 					<?php if(strlen($kehadiran->tanggal_jam_masuk) > 6 && strlen($kehadiran->tanggal_jam_keluar) > 6) { ?>
					 						<i class="fa fa-check-circle text-success"></i> 
					 					<?php }elseif(strlen($kehadiran->tanggal_jam_masuk) < 6 && strlen($kehadiran->tanggal_jam_keluar) < 6) { ?>
					 						<i class="fa fa-times-circle text-danger"></i> 
					 					<?php }elseif(strlen($kehadiran->tanggal_jam_masuk) < 6 && strlen($kehadiran->tanggal_jam_keluar) > 6) { ?>
					 						<i class="fa fa-moon text-primary"></i>  
					 					<?php }elseif(strlen($kehadiran->tanggal_jam_masuk) > 6 && strlen($kehadiran->tanggal_jam_keluar) < 6) { ?>
					 						<i class="fa fa-sun text-primary"></i>  
					 					<?php }else{ ?>

					 					<?php } ?>
					 				<?php }else{ ?>
					 					<i class="fa fa-envelope text-success"></i> 
					 				<?php } ?>
				 					<?php echo $kehadiran->kode; ?>


						 				
						 		</div>
						 		<div class="card-body p-1">
						 			<div class="text-center">
						 			<?php echo date('d',strtotime($kehadiran->tanggal_masuk)); ?>


						 				
						 			
						 			<input type="hidden" name="id_kehadiran_<?php echo $kehadiran->id_kehadiran ?>" value="<?php echo $kehadiran->id_kehadiran ?>">
						 			</div>

									@include('admin/kehadiran/update')
								</div>
								<div class="card-footer p-2">
									<?php if($kehadiran->day_off=='Ya') { ?>
										<button type="button" class="btn btn-secondary btn-xs w-100 disabled">
										  Update
										</button>
									<?php }else{ ?>
										<button type="button" class="btn btn-secondary btn-xs w-100" data-toggle="modal" data-target="#modal-update-<?php echo $kehadiran->id_kehadiran ?>">
										  Update
										</button>
									<?php } ?>

						 		</div>
						 	</div>
						 	</small>
						 </div>
					<?php } ?>
				</div>

			</div>
		</div>
	








