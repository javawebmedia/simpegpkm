<?php
// Tahun dan bulan yang ingin Anda tentukan
$tahun = 2024;
$bulan = '05'; // Untuk bulan April, gunakan angka 4

// Mendapatkan jumlah hari dalam bulan tersebut
$jumlah_hari = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);

// Membuat array untuk menyimpan semua tanggal
$semua_tanggal = [];

// Loop untuk menambahkan tanggal ke dalam array
for ($hari = 1; $hari <= $jumlah_hari; $hari++) {
    // Format tanggal dalam bentuk YYYY-MM-DD
    $tanggal = sprintf('%04d-%02d-%02d', $tahun, $bulan, $hari);
    // Menyimpan tanggal ke dalam array
    $semua_tanggal[] = $tanggal;
}

// Menampilkan semua tanggal
echo "Seluruh tanggal pada bulan $bulan tahun $tahun:<br>";
foreach ($semua_tanggal as $tanggal) {
    echo $tanggal . "<br>";
}
?>