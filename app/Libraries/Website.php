<?php
namespace App\Libraries; // Adjust the namespace based on your directory structure

class Website
{

	// tanggal_bulan_id
	public function tanggal_id($tanggal)
	{
		$bulan 	= date('m',strtotime($tanggal));
		$hari 	= date('l',strtotime($tanggal));

		if($hari=='Sunday') {
			$nama_hari = 'Minggu';
		}elseif($hari=='Monday') {
			$nama_hari = 'Senin';
		}elseif($hari=='Tuesday') {
			$nama_hari = 'Selasa';
		}elseif($hari=='Wednesday') {
			$nama_hari = 'Rabu';
		}elseif($hari=='Thursday') {
			$nama_hari = 'Kamis';
		}elseif($hari=='Friday') {
			$nama_hari = 'Jumat';
		}elseif($hari=='Saturday') {
			$nama_hari = 'Sabtu';
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

		$hasil = date('d',strtotime($tanggal)).' '.$nama_bulan.' '.date('Y',strtotime($tanggal));
		return $hasil;
	}

	// tanggal_bulan_id
	public function tanggal_bulan_id($tanggal)
	{
		$bulan 	= date('m',strtotime($tanggal));
		$hari 	= date('l',strtotime($tanggal));

		if($hari=='Sunday') {
			$nama_hari = 'Minggu';
		}elseif($hari=='Monday') {
			$nama_hari = 'Senin';
		}elseif($hari=='Tuesday') {
			$nama_hari = 'Selasa';
		}elseif($hari=='Wednesday') {
			$nama_hari = 'Rabu';
		}elseif($hari=='Thursday') {
			$nama_hari = 'Kamis';
		}elseif($hari=='Friday') {
			$nama_hari = 'Jumat';
		}elseif($hari=='Saturday') {
			$nama_hari = 'Sabtu';
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

		$hasil = $nama_hari.', '.date('d',strtotime($tanggal)).' '.$nama_bulan.' '.date('Y',strtotime($tanggal));
		return $hasil;
	}

	// tanggal_bulan
	public function tanggal_bulan($tanggal)
	{
		$bulan 	= date('m',strtotime($tanggal));
		$hari 	= date('l',strtotime($tanggal));

		if($hari=='Sunday') {
			$nama_hari = 'Minggu';
		}elseif($hari=='Monday') {
			$nama_hari = 'Senin';
		}elseif($hari=='Tuesday') {
			$nama_hari = 'Selasa';
		}elseif($hari=='Wednesday') {
			$nama_hari = 'Rabu';
		}elseif($hari=='Thursday') {
			$nama_hari = 'Kamis';
		}elseif($hari=='Friday') {
			$nama_hari = 'Jumat';
		}elseif($hari=='Saturday') {
			$nama_hari = 'Sabtu';
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

		$hasil = $nama_hari.', '.date('d',strtotime($tanggal)).' '.$nama_bulan.' '.date('Y',strtotime($tanggal));
		return $hasil;
	}

	// get_hari
	public function get_hari($tanggal)
	{
		$bulan 	= date('m',strtotime($tanggal));
		$hari 	= date('l',strtotime($tanggal));

		if($hari=='Sunday') {
			$nama_hari = 'Minggu';
		}elseif($hari=='Monday') {
			$nama_hari = 'Senin';
		}elseif($hari=='Tuesday') {
			$nama_hari = 'Selasa';
		}elseif($hari=='Wednesday') {
			$nama_hari = 'Rabu';
		}elseif($hari=='Thursday') {
			$nama_hari = 'Kamis';
		}elseif($hari=='Friday') {
			$nama_hari = 'Jumat';
		}elseif($hari=='Saturday') {
			$nama_hari = 'Sabtu';
		}

		return $nama_hari;
	}

	// angka
	public function angka($angka)
	{
		$hasil = number_format($angka,'0',',','.');
		return $hasil;
	}

	// angka
	public function desimal($angka)
	{
		$hasil = number_format($angka,'2',',','.');
		return $hasil;
	}
}

