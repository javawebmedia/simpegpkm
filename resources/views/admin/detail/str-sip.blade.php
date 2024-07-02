@include('admin/detail/flow')
@include('admin/kehadiran/profil-pegawai')

<div class="card">
	<div class="card-header bg-light">
		<strong>DATA STR SIP</strong>
	</div>
	<div class="card-body">
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
			</div>
