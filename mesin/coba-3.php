<html>
<head><title>Contoh Koneksi Mesin Absensi Menggunakan SOAP Web Service</title></head>
<body>

<H3>Download Log Data</H3>

<?php
date_default_timezone_set('Asia/Jakarta');
$IP = $_GET["ip"] ?? "192.168.1.13";
$Key = $_GET["key"] ?? "8050";

if ($IP === "") {
    $IP = "192.168.1.13";
}

if ($Key === "") {
    $Key = "8050";
}
?>

<form action="coba.php" method="GET">
IP Address: <input type="Text" name="ip" value="<?= htmlspecialchars($IP) ?>" size=15><BR>
Comm Key: <input type="Text" name="key" size="5" value="<?= htmlspecialchars($Key) ?>"><BR><BR>

<input type="Submit" value="Download">
</form>
<BR>

<?php
if (!empty($_GET["ip"])) {
    ?>

        <?php
        $Connect = @fsockopen($IP, "80", $errno, $errstr, 1);
        if ($Connect) {
            $soap_request = "<GetAttLog><ArgComKey xsi:type=\"xsd:integer\">" . $Key . "</ArgComKey><Arg><PIN xsi:type=\"xsd:integer\">All</PIN></Arg></GetAttLog>";
            $newLine = "\r\n";
            fputs($Connect, "POST /iWsService HTTP/1.0" . $newLine);
            fputs($Connect, "Content-Type: text/xml" . $newLine);
            fputs($Connect, "Content-Length: " . strlen($soap_request) . $newLine . $newLine);
            fputs($Connect, $soap_request . $newLine);
            $buffer = "";
            while ($Response = fgets($Connect, 1024)) {
                $buffer .= $Response;
            }
            
        } else {
            echo "Koneksi Gagal";
        }

        include("parse.php");
        $buffer = Parse_Data($buffer, "<GetAttLogResponse>", "</GetAttLogResponse>");
        $buffer = explode("\r\n", $buffer);
        $hasil  = json_encode($buffer);

        // Mengonversi JSON ke array PHP
$data = json_decode($hasil);

// Menginisialisasi array untuk hasil ekstraksi
$extracted_data = [];

// Melewati setiap elemen array, mulai dari indeks 1 karena elemen pertama kosong
for ($i = 1; $i < count($data); $i++) {
    // Parsing string XML dalam elemen array menggunakan simplexml_load_string
    $xml    = simplexml_load_string($data[$i]);

    // Mengonversi objek SimpleXMLElement ke array menggunakan fungsi json_encode dan json_decode
    $row_data = json_decode(json_encode($xml), true);

    // Menambahkan data ke array hasil ekstraksi
    $extracted_data[] = $row_data;
}
print_r($extracted_data);
?>

<?php } ?>

</body>
</html>
