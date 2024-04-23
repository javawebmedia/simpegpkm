<?php 
date_default_timezone_set('Asia/Jakarta');
$IP         = "192.168.1.14";
$Key        = "8050";
$Connect    = @fsockopen($IP, "80", $errno, $errstr, 1);
if ($Connect) {
    $soap_request = "<GetAttLog><ArgComKey xsi:type=\"xsd:integer\">" . $Key . "</ArgComKey><Arg><PIN xsi:type=\"xsd:integer\">All</PIN></Arg></GetAttLog>";
    $newLine = "\r\n";
    // $newLine = '';
    fputs($Connect, "POST /iWsService HTTP/1.0" . $newLine);
    fputs($Connect, "Content-Type: text/xml" . $newLine);
    fputs($Connect, "Content-Length: " . strlen($soap_request) . $newLine . $newLine);
    fputs($Connect, $soap_request . $newLine);
    $buffer = "";
    while ($Response = fgets($Connect, 1024)) {
        $buffer .= $Response;
    }
} else {
    $buffer     = '';
    echo "Koneksi Gagal";
}
// print_r($buffer);
$json_string = json_encode($buffer);
// Mengubah string JSON menjadi array PHP
$data_array = json_decode('['.str_replace(['\r','\n'],'',$json_string).']', true);

// Membuat tabel horizontal
$no=0;
foreach ($data_array as $row) {
    preg_match_all('/<([^>]+)>([^<]+)<\/([^>]+)>/', $row, $matches, PREG_SET_ORDER);
    foreach($matches as $match) {
        echo $match[1].': '.$match[0].'<br>';
    }
$no++; }
?>
