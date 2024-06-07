<p class="text-right">
	<a href="{{ asset('admin/pegawai/edit/'.$pegawai->id_pegawai) }}" class="btn btn-warning btn-xs">
		<i class="fa fa-edit"></i> Edit
	</a>
	<a href="{{ asset('admin/pegawai/cetak-riwayat/'.$pegawai->id_pegawai) }}" class="btn btn-success btn-xs" target="_blank">
		<i class="fa fa-print"></i> Cetak
	</a>
	<a href="{{ asset('admin/pegawai/unduh-riwayat/'.$pegawai->id_pegawai) }}" class="btn btn-danger btn-xs"  target="_blank">
		<i class="fa fa-file-pdf"></i> Unduh PDF
	</a>
	<a href="{{ asset('admin/pegawai') }}" class="btn btn-outline-info btn-xs">
		<i class="fa fa-arrow-left"></i> Kembali
	</a>
</p>

<div class="row">
	<div class="col-md-2 text-center">
		<div class="card">
			<div class="card-body">
				
				<img src="{{ asset('assets/upload/images/'.$pegawai->foto) }}" alt="{{ $pegawai->nama_lengkap }}" class="img img-thumbnail">
				
				
			</div>
		</div>
	</div>
	<div class="col-md-10">
		<div class="card">
			<div class="card-body">

				<table class="table table-sm tabelku">
					<tbody>
						<tr>
							<td width="25%">Nama lengkap</td>
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
</div>

<div class="card">
	<div class="card-header bg-light">
		<strong>RIWAYAT STR &amp; SIP</strong>
	</div>
	<div class="card-body">
	

	<table class="table table-sm tabelku">
    <thead>
        <tr>
            <th width="5%">No</th>
            <th>Jenis</th>
            <th>Nomor STR/SIP</th>
            <th>Tanggal Terbit</th>
            <th>Tanggal Berakhir</th>
            <th>Status Seumur Hidup</th>
            <th>Status Approval</th>
        </tr>
    </thead>
    <tbody>
        <?php $no=1; foreach($str_sip as $str_sip) { ?>
        <tr>
            <td>{{ $no }}</td>
            <td>{{ $str_sip->jenis_str_sip }}</td>
            <td>{{ $str_sip->nomor_sertifikat }}</td>
            <td>{{ date('d-m-Y',strtotime($str_sip->tanggal_lulus)) }}</td>
            <td>{{ date('d-m-Y',strtotime($str_sip->tanggal_akhir)) }}</td>
            <td>{{ $str_sip->seumur_hidup }}</td>
            <td>{{ $str_sip->status_str_sip }}</td>
        </tr>
        <?php $no++; } ?>
    </tbody>
</table>
</div>
</div>

<div class="card">
	<div class="card-header bg-light">
		<strong>RIWAYAT DIKLAT</strong>
	</div>
	<div class="card-body">
	

	<table class="table table-sm tabelku">
	<thead>
		<tr>
			<th width="5%" class="text-center">No
			</th>
			<th>Diklat</th>
			<th>Tanggal</th>
			<th>JPL</th>
			<th>Status</th>
		</tr>
	</thead>
	<tbody>
		<?php $no=1; foreach($diklat as $diklat) { ?>
		<tr>
			<td class="text-center">
				{{ $no }}
			</td>
			<td>{{ $diklat->nama_diklat }}</td>
			<td>{{ $diklat->tanggal_awal }}</td>
			<td>{{ $diklat->jpl }}</td>
			<td>
				<?php if($diklat->status_diklat=='Disetujui') { ?>
					<span class="badge badge-success"><i class="fa fa-check-circle"></i> {{ $diklat->status_diklat }}</span>
				<?php }elseif($diklat->status_diklat=='Menunggu') { ?>
					<span class="badge badge-warning"><i class="fa fa-clock"></i> {{ $diklat->status_diklat }}</span>
				<?php }else{ ?>	
					<span class="badge badge-dark"><i class="fa fa-times-circle"></i> {{ $diklat->status_diklat }}</span>
				<?php } ?>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>
</div>
</div>

<div class="card">
	<div class="card-header bg-light">
		<strong>RIWAYAT JABATAN</strong>
	</div>
	<div class="card-body">
	

	<table class="table table-sm tabelku">
		<thead>
			<tr class="text-center">
				<th width="2%">No</th>
				<th>TMT</th>
				<th>Jabatan</th>
				<th>Jenis</th>
				<th>Divisi</th>
				<th>Eselon</th>
				<th>Pangkat</th>
				<th>No SK</th>
				<th>Tgl SK</th>
			</tr>
		</thead>
		<tbody>
			<?php $no=1; foreach($riwayat_jabatan as $riwayat_jabatan) { ?>
				<tr>
					<td class="text-center">{{ $no }}</td>
					<td class="text-center">{{ date('d-m-Y',strtotime($riwayat_jabatan->tmt) )}}</td>
					<td>{{ $riwayat_jabatan->nama_jabatan }}</td>
					<td>{{ $riwayat_jabatan->jenis_jabatan }}</td>
					<td>{{ $riwayat_jabatan->nama_divisi }}</td>
					<td class="text-center">{{ $riwayat_jabatan->eselon }}</td>
					<td class="text-center">{{ $riwayat_jabatan->golongan }}/{{ $riwayat_jabatan->ruang }}</td>
					<td class="text-center">{{ $riwayat_jabatan->nomor_sk }}</td>
					<td class="text-center">{{ date('d-m-Y',strtotime($riwayat_jabatan->tanggal_sk) )}}</td>
				</tr>
				<?php $no++; } ?>
			</tbody>
		</table>
</div>
</div>

<div class="card">
	<div class="card-header bg-light">
		<strong>RIWAYAT PENDIDIKAN</strong>
	</div>
	<div class="card-body">

		<table class="table table-sm tabelku">
			<thead>
				<tr class="text-center">
					<th width="2%">No</th>
					<th>Tgl Lulus</th>
					<th>Sekolah/Institusi</th>
					<th>Jenjang</th>
					<th>Jenis</th>
					<th>No. Ijazah</th>
					<th>Kota</th>
					<th>Tahun Masuk</th>
					<th>Tahun Lulus</th>
				</tr>
			</thead>
			<tbody>
				<?php $no=1; foreach($pendidikan as $pendidikan) { ?>
					<tr>
						<td class="text-center">{{ $no }}</td>
						<td class="text-center">{{ date('d-m-Y',strtotime($pendidikan->tanggal_lulus) )}}</td>
						<td>{{ $pendidikan->nama_sekolah }}</td>
						<td>{{ $pendidikan->nama_jenjang_pendidikan }}</td>
						<td>{{ $pendidikan->jenis_pendidikan }}</td>
						<td>{{ $pendidikan->nomor_ijazah }}</td>
						<td class="text-center">{{ $pendidikan->kota_sekolah }}</td>
						<td class="text-center">{{ $pendidikan->tahun_masuk }}</td>
						<td class="text-center">{{ $pendidikan->tahun_lulus }}</td>
					</tr>
					<?php $no++; } ?>
				</tbody>
			</table>
</div>
</div>

<div class="card">
	<div class="card-header bg-light">
		<strong>RIWAYAT KELUARGA</strong>
	</div>
	<div class="card-body">

			<table class="table table-sm tabelku">
				<thead>
					<tr class="text-center">
						<th width="2%">No</th>
						<th>Hub. Keluarga</th>
						<th>NIK/ Nama Lengkap</th>
						<th>Tempat &amp; Tanggal Lahir</th>
						<th>Jenis Kelamin</th>
						<th>Agama</th>
						<th>Pendidikan</th>
						<th>Pekerjaan</th>
						<th>Status Perkawinan</th>
					</tr>
				</thead>
				<tbody>
					<?php $no=1; foreach($keluarga as $keluarga) { ?>
						<tr>
							<td class="text-center">{{ $no }}</td>
							<td class="text-center">{{ $keluarga->nama_hubungan_keluarga }}</td>
							<td>
								{{ $keluarga->nama_lengkap }} <br>
								<strong class="text-primary">{{ $keluarga->nik }}</strong>
							</td>
							<td>
								{{ $keluarga->tempat_lahir }}, <br>
								{{ date('d-m-Y',strtotime($keluarga->tanggal_lahir) )}}
							</td>
							<td>{{ $keluarga->jenis_kelamin }}</td>
							<td>{{ $keluarga->nama_agama }}</td>
							<td class="text-center">{{ $keluarga->nama_jenjang_pendidikan }}</td>
							<td class="text-center">{{ $keluarga->nama_pekerjaan }}</td>
							<td class="text-center">{{ $keluarga->status_perkawinan }}</td>
						</tr>
						<?php $no++; } ?>
					</tbody>
				</table>
			</div>
		</div>

