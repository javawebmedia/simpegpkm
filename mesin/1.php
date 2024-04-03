<?php
$hasil = '<Nama>Andoyo</Nama>';

$pattern = '/<Nama>(.*?)<\/Nama>/';

// Lakukan pencocokan dengan pola regex
if (preg_match($pattern, $hasil, $matches)) {
    // $matches[0] berisi seluruh string yang cocok
    // $matches[1] berisi teks yang ada di antara tag <Nama> dan </Nama>
    $nama = $matches[1];
    echo "Nama: $nama";
} else {
    echo "Data Andoyo tidak ditemukan.";
}