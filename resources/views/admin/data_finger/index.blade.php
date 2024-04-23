<p>
	<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default">
	  <i class="fa fa-plus-circle"></i> Tarik Data Kehadiran dari Mesin Absen
	</button>
</p>

@include('admin/data_finger/mesin')

<table class="table table-sm tabelku">
	<thead>
		<tr>
			<th></th>
			<th>PEGAWAI</th>
			<th>TANGGAL</th>
			<th>JAM</th>
			<th>MESIN</th>
			<th>VERIFIKASI</th>
			<th>STATUS</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php $no=1; foreach($data_finger as $data_finger) { ?>
		<tr>
			<td></td>
			<td><?php echo $data_finger->nama_lengkap ?></td>
			<td><?php echo date('d-m-Y',strtotime($data_finger->waktu_finger)) ?></td>
			<td><?php echo date('H:i:s',strtotime($data_finger->waktu_finger)) ?></td>
			<td><?php echo $data_finger->ip_mesin_absen ?></td>
			<td><span class="badge badge-secondary"><?php echo $data_finger->verified ?></span> 
				<?php if($data_finger->verified==1) { ?>
					<span class="badge badge-secondary"><i class="fa fa-fingerprint"></i> Finger Print</span>
				<?php }elseif($data_finger->verified==3) { ?>
					<span class="badge badge-secondary"><i class="fa fa-key"></i> PIN</span>
				<?php }elseif($data_finger->verified==4) { ?>
					<span class="badge badge-secondary"><i class="fa fa-wifi"></i> NFC</span>
				<?php }elseif($data_finger->verified==15) { ?>
					<span class="badge badge-secondary"><i class="fa fa-kiss-wink-heart"></i> Wajah</span>
				<?php }elseif($data_finger->verified==25) { ?>
					<span class="badge badge-secondary"><i class="fa fa-palm"></i> Telapak Tangan</span>
				<?php }else{ ?>
					<span class="badge badge-secondary"><i class="fa fa-question"></i> Lainnya</span>
				<?php } ?>
			</td>
			<td><span class="badge badge-secondary"><?php echo $data_finger->status_data_finger ?></span> 
				<?php if($data_finger->status_data_finger==0) { ?>
					<span class="badge badge-secondary"><i class="fa fa-sign-in-alt"></i> Masuk</span>
				<?php }elseif($data_finger->status_data_finger==1) { ?>
					<span class="badge badge-secondary"><i class="fa fa-sign-out-alt"></i> Pulang</span>
				<?php }elseif($data_finger->status_data_finger==2) { ?>
					<span class="badge badge-secondary"><i class="fa fa-door-open"></i> Keluar</span>
				<?php }elseif($data_finger->status_data_finger==3) { ?>
					<span class="badge badge-secondary"><i class="fa fa-door-closed"></i> Kembali</span>
				<?php }elseif($data_finger->status_data_finger==4) { ?>
					<span class="badge badge-secondary"><i class="fa fa-user-clock"></i> Lembur</span>
				<?php }elseif($data_finger->status_data_finger==5) { ?>
					<span class="badge badge-secondary"><i class="fa fa-clock"></i> Pulang Lembur</span>
				<?php }else{ ?>
					<span class="badge badge-secondary"><i class="fa fa-question"></i> Lainnya</span>
				<?php } ?>
			</td>
			<td></td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>