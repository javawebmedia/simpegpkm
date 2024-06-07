<?php 
date_default_timezone_set("Asia/Jakarta");
?>
<!--start Pengumuman -->
<div class="modal hide fade" id="myModal">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Pengumuman Kepegawaian: <?php echo date('d M Y') ?></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>{{ $site->pengumuman }}&hellip;</p>
			  		

						<table class="table tabelku table-sm">
							<thead>
								<tr>
									<td>Keterangan</td>
									<td>Capaian</td>
									<td>Status</td>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td width="35%">Total JPL</td>
									<td>
										<?php
					if ($diklat_jpl) {
						if($diklat_jpl->total_jpl=='') {
							echo 0;
						}elseif($diklat_jpl->total_jpl < 40) {
							echo $diklat_jpl->total_jpl;
						} else {
							echo $diklat_jpl->total_jpl;
						}
					} else {
						echo 0;
					}
					?> JPL
									</td>
									<td>
										<?php
								if ($diklat_jpl) {
									if($diklat_jpl->total_jpl=='') {
										echo '<span class="badge badge-danger"><i class="fa fa-times-circle"></i> Belum tercapai</span>';
									}elseif($diklat_jpl->total_jpl < 40) {
										echo '<span class="badge badge-warning"><i class="fa fa-times-circle"></i> Belum tercapai</span>';
									} else {
										echo '<span class="badge badge-success"><i class="fa fa-check-circle"></i> Belum tercapai</span>';
									}
								} else {
									echo '<span class="badge badge-danger"><i class="fa fa-times-circle"></i> Belum tercapai</span>';
								}
								?> 
									</td>
								</tr>
								<tr>
									<td>Keterlambatan Harian</td>
									<td>
										<?php
										if ($telat_harian) {
											if($telat_harian->total=='') {
												echo 0;
											} else {
												echo $telat_harian->total;
											}
										} else {
											echo 0;
										}
										?> 
										Menit
									</td>
									<td>
										<?php
										if ($telat_harian) {
											if($telat_harian->total=='') {
												echo '<span class="badge badge-success"><i class="fa fa-check-circle"></i> Tidak terlambat</span>';
											} else {
												echo '<span class="badge badge-warning"><i class="fa fa-times-circle"></i> Anda terlambat</span>';
											}
										} else {
											echo '<span class="badge badge-success"><i class="fa fa-check-circle"></i> Tidak  terlambat</span>';
										}
										?> 
									</td>
								</tr>
								<tr>
									<td>Keterlambatan Bulanan</td>
									<td>
										<?php
										if ($telat_bulanan) {
											if($telat_bulanan->total=='') {
												echo 0;
											} else {
												echo $telat_bulanan->total;
											}
										} else {
											echo 0;
										}
										?> 
										Menit
									</td>
									<td>
										<?php
										if ($telat_bulanan) {
											if($telat_bulanan->total=='') {
												echo '<span class="badge badge-success"><i class="fa fa-check-circle"></i> Bulan ini Tidak terlambat</span>';
											} else {
												echo '<span class="badge badge-warning"><i class="fa fa-times-circle"></i> Bulan ini Anda terlambat</span>';
											}
										} else {
											echo '<span class="badge badge-success"><i class="fa fa-check-circle"></i> Bulan ini Tidak  terlambat</span>';
										}
										?> 
									</td>
								</tr>
								<tr>
									<td>Keterlambatan Tahunan</td>
									<td>
										<?php
										if ($telat_tahunan) {
											if($telat_tahunan->total=='') {
												echo 0;
											} else {
												echo $telat_tahunan->total;
											}
										} else {
											echo 0;
										}
										?> 
										Menit
									</td>
									<td>
										<?php
										if ($telat_tahunan) {
											if($telat_tahunan->total=='') {
												echo '<span class="badge badge-success"><i class="fa fa-check-circle"></i> Tahun ini Tidak terlambat</span>';
											} else {
												echo '<span class="badge badge-warning"><i class="fa fa-times-circle"></i> Tahun ini Anda terlambat</span>';
											}
										} else {
											echo '<span class="badge badge-success"><i class="fa fa-check-circle"></i> Tahun ini Tidak terlambat</span>';
										}
										?> 
									</td>
								</tr>
							</tbody>
						</table>

						<h4>STR dan SIP Anda</h4>

						<table class="table table-sm tabelku">
    <thead>
        <tr>
            <th>Jenis</th>
            <th>Nomor</th>
            <th>Tgl Terbit</th>
            <th>Tgl Berakhir</th>
            <th>Seumur Hidup</th>
            <th>Status</th>
            <th>Note</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        
        $no=1; 
        foreach($str_sip as $str_sip) {
        	$tanggal_sekarang = date('Y-m-d');
					$tanggal_berakhir 	= $str_sip->tanggal_akhir;

					// Membuat objek DateTime dari kedua tanggal
					$tanggal_sekarang_obj = new DateTime($tanggal_sekarang);
					$tanggal_berakhir_obj = new DateTime($tanggal_berakhir);

					// Menghitung selisih antara dua tanggal
					$interval 						= $tanggal_sekarang_obj->diff($tanggal_berakhir_obj);

					// Menampilkan selisih hari
					$selisih_hari =  $interval->days;
         ?>
        <tr>
            <td>{{ $str_sip->jenis_str_sip }}</td>
            <td>{{ $str_sip->nomor_sertifikat }}</td>
            <td>{{ date('d-m-Y',strtotime($str_sip->tanggal_lulus)) }}</td>
            <td>{{ date('d-m-Y',strtotime($str_sip->tanggal_akhir)) }}</td>
            <td>
            	<?php if($str_sip->seumur_hidup=='Ya') { ?>
            		<span class="badge badge-success"><i class="fa fa-check-circle"></i> Ya</span>
            	<?php }else{ ?>
            		<span class="badge badge-secondary"><i class="fa fa-times-circle"></i> Tidak</span>
            	<?php } ?>
            </td>
            <td>
            	<?php if($str_sip->seumur_hidup=='Ya') { ?>
            		<span class="badge badge-success"><i class="fa fa-check-circle"></i> Aktif</span>
            	<?php }else{ 
            		if(strtotime($str_sip->tanggal_akhir) <= strtotime(date('Y-m-d'))) { ?>
            			<span class="badge badge-danger"><i class="fa fa-times-circle"></i> Expired</span>
            		<?php }else{ if($selisih_hari < 0) {
            		?>
            		<span class="badge badge-danger"><i class="fa fa-times-circle"></i> Expired</span>
            	<?php }elseif($selisih_hari <= 90) { ?>
            		<span class="badge badge-warning"><i class="fa fa-clock"></i> Menjelang Expired</span>
            	<?php }else{ ?>
            		<span class="badge badge-success"><i class="fa fa-check-circle"></i> Aktif</span>
            	<?php }}} ?>
            </td>
            <td>
            	<?php 
            		if($str_sip->seumur_hidup=='Ya') {
            	 	}else{ 
            			if($selisih_hari > 0) {
            				echo $selisih_hari.' hari';
            		 	}elseif($selisih_hari >= -90) { 
            		 		echo $selisih_hari.' Menjelang Expired'; 
            		 	}else{  }} ?>
            </td>
        </tr>
        <?php $no++; } ?>
    </tbody>
</table>
		       </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
 <!-- end pengumuman -->