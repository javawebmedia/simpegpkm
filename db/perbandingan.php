<?php 
date_default_timezone_set("Asia/Jakarta");
$tanggal_berakhir 		= "2024-05-20";

// Menggunakan DateTime untuk mengelola tanggal
$tanggal_berakhir_obj 	= new DateTime($tanggal_berakhir);

// Mengurangi 90 hari dari tanggal berakhir
$tanggal_berikutnya_obj = clone $tanggal_berakhir_obj;
$tanggal_berikutnya_obj->modify('-90 days');

// Menampilkan tanggal berikutnya
echo $tanggal_berikutnya_obj->format('Y-m-d');

// Jika Anda ingin mendapatkan selisih hari antara kedua tanggal
$interval = $tanggal_berakhir_obj->diff($tanggal_berikutnya_obj);
echo "\nSelisih hari: " . $interval->days;
?>
