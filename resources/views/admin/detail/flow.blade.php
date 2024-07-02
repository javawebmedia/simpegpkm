<?php 
use App\Libraries\Website;
$website = new App\Libraries\Website(); 
if(isset($_GET['tahun'])) {
	$tahun = $_GET['tahun'];
	$bulan = $_GET['bulan'];
}else{
	$tahun = $tahun;
	$bulan = $bulan;
}

if($bulan=='01') {
    $nama_bulan = 'Januari';
}elseif($bulan=='02') {
    $nama_bulan = 'Februari';
}elseif($bulan=='03') {
    $nama_bulan = 'Maret';
}elseif($bulan=='04') {
    $nama_bulan = 'April';
}elseif($bulan=='05') {
    $nama_bulan = 'Mei';
}elseif($bulan=='06') {
    $nama_bulan = 'Juni';
}elseif($bulan=='07') {
    $nama_bulan = 'Juli';
}elseif($bulan=='08') {
    $nama_bulan = 'Agustus';
}elseif($bulan=='09') {
    $nama_bulan = 'September';
}elseif($bulan=='10') {
    $nama_bulan = 'Oktober';
}elseif($bulan=='11') {
    $nama_bulan = 'November';
}elseif($bulan=='12') {
    $nama_bulan = 'Desember';
}
?>
<p class="text-center">
	<a href="{{ asset('admin/dasbor') }}" class="mb-1 btn btn-outline-info btn-sm">
		<i class="fa fa-arrow-left"></i> Cari Pegawai
	</a>
	<a href="#" class="mb-1 btn btn-warning btn-sm">
		<i class="fa fa-check-circle"></i> <?php echo $nama_bulan ?> <?php echo $tahun ?>
	</a>
	<a href="{{ asset('admin/detail/pegawai/'.$pegawai->nip.'/'.$tahun.'/'.$bulan) }}" class="mb-1 btn btn-info btn-sm <?php if($flow=='pegawai') { echo 'text-warning'; } ?>">
		<i class="fa fa-user"></i> Riwayat Pegawai
	</a>
	<a href="{{ asset('admin/detail/jadwal/'.$pegawai->id_pegawai.'/'.$tahun.'/'.$bulan) }}" class="mb-1 btn btn-info btn-sm <?php if($flow=='jadwal') { echo 'text-warning'; } ?>">
		<i class="fa fa-calendar"></i> Jadwal Kerja
	</a>
	<a href="{{ asset('admin/detail/kehadiran/'.$pegawai->pin.'/'.$tahun.'/'.$bulan) }}" class="mb-1 btn btn-info btn-sm <?php if($flow=='kehadiran') { echo 'text-warning'; } ?>">
		<i class="fa fa-calendar-check"></i> Kehadiran
	</a>
	<a href="{{ asset('admin/detail/absensi/'.$pegawai->pin.'/'.$tahun.'/'.$bulan) }}" class="mb-1 btn btn-info btn-sm <?php if($flow=='absensi') { echo 'text-warning'; } ?>">
		<i class="fa fa-tasks"></i> Rekap Absensi
	</a>
	<a href="{{ asset('admin/detail/gaji/'.$pegawai->pin.'/'.$tahun.'/'.$bulan) }}" class="mb-1 btn btn-info btn-sm <?php if($flow=='gaji') { echo 'text-warning'; } ?>">
		<i class="fa fa-dollar-sign"></i> Gaji &amp; TKD
	</a>
	<a href="{{ asset('admin/detail/dokumen/'.$pegawai->pin.'/'.$tahun.'/'.$bulan) }}" class="mb-1 btn btn-info btn-sm <?php if($flow=='dokumen') { echo 'text-warning'; } ?>">
		<i class="fa fa-file-pdf"></i> Dokumen
	</a>
	<a href="{{ asset('admin/detail/ekinerja/'.$pegawai->pin.'/'.$tahun.'/'.$bulan) }}" class="mb-1 btn btn-info btn-sm <?php if($flow=='ekinerja') { echo 'text-warning'; } ?>">
		<i class="fa fa-check-circle"></i> eKinerja
	</a>
	<a href="{{ asset('admin/detail/cuti/'.$pegawai->pin.'/'.$tahun.'/'.$bulan) }}" class="mb-1 btn btn-info btn-sm <?php if($flow=='cuti') { echo 'text-warning'; } ?>">
		<i class="fa fa-person-hiking"></i> Cuti
	</a>
	<a href="{{ asset('admin/detail/diklat/'.$pegawai->pin.'/'.$tahun.'/'.$bulan) }}" class="mb-1 btn btn-info btn-sm <?php if($flow=='diklat') { echo 'text-warning'; } ?>">
		<i class="fa fa-certificate"></i> Diklat
	</a>
	<a href="{{ asset('admin/detail/str-sip/'.$pegawai->pin.'/'.$tahun.'/'.$bulan) }}" class="mb-1 btn btn-info btn-sm <?php if($flow=='str-sip') { echo 'text-warning'; } ?>">
		<i class="fa fa-graduation-cap"></i> STR SIP
	</a>
	<a href="{{ asset('admin/detail/keluarga/'.$pegawai->pin.'/'.$tahun.'/'.$bulan) }}" class="mb-1 btn btn-info btn-sm <?php if($flow=='keluarga') { echo 'text-warning'; } ?>">
		<i class="fa fa-users"></i> Keluarga
	</a>
</p>
<hr>