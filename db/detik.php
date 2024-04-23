<?php
$detik = 20115;

// Menghitung jumlah jam
$jam = floor($detik / 3600);

// Sisa detik setelah dihitung untuk jam
$sisa_detik = $detik % 3600;

// Menghitung jumlah menit
$menit = floor($sisa_detik / 60);

// Sisa detik setelah dihitung untuk menit
$sisa_detik = $sisa_detik % 60;

// Format output
$output = sprintf("%d jam : %d menit : %d detik", $jam, $menit, $sisa_detik);

// Menampilkan hasil
echo $output;
?>
