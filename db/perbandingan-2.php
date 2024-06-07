<?php 
date_default_timezone_set("Asia/Jakarta");

$tanggal_sekarang = date('Y-m-d');
$tanggal_berakhir = "2024-05-20";

// Membuat objek DateTime dari kedua tanggal
$tanggal_sekarang_obj = new DateTime($tanggal_sekarang);
$tanggal_berakhir_obj = new DateTime($tanggal_berakhir);

// Menghitung selisih antara dua tanggal
$interval = $tanggal_sekarang_obj->diff($tanggal_berakhir_obj);

// Menampilkan selisih hari
echo "Selisih hari: " . $interval->days;
?>
