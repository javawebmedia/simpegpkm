<?php

// URL tempat data JSON berada
$url = 'tarik.php';

// Mengambil data dari URL
$data = file_get_contents($url);

// Menghilangkan header HTTP dari data
$data = substr($data, strpos($data, '<'));

// Parsing XML
$xml = simplexml_load_string($data);

// Membuat tabel HTML
echo "<table border='1'>";
echo "<tr><th>PIN</th><th>DateTime</th><th>Verified</th><th>Status</th><th>WorkCode</th></tr>";

// Iterasi setiap baris dan menampilkan data dalam tabel
foreach ($xml->Row as $row) {
    echo "<tr>";
    echo "<td>{$row->PIN}</td>";
    echo "<td>{$row->DateTime}</td>";
    echo "<td>{$row->Verified}</td>";
    echo "<td>{$row->Status}</td>";
    echo "<td>{$row->WorkCode}</td>";
    echo "</tr>";
}

echo "</table>";
?>
