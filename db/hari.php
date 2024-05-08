<?php 
date_default_timezone_set("Asia/Jakarta");
$tanggal_kemarin = "2024-05-03";

// Mendapatkan tanggal 1 hari setelah $tanggal_kemarin
$tanggal_berikutnya = date("Y-m-d", strtotime($tanggal_kemarin . " +1 day"));

echo "Tanggal berikutnya setelah $tanggal_kemarin adalah: $tanggal_berikutnya";

 ?>