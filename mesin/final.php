<?php 
date_default_timezone_set('Asia/Jakarta');
// include('parse.php');
$IP         = "192.168.1.14";
$Key        = "8050";
$Connect    = @fsockopen($IP, "80", $errno, $errstr, 1);
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
    $buffer     = '';
    echo "Koneksi Gagal";
}
// hasil parse
$xml=simplexml_load_string($buffer) or die("Error: Cannot create object");
print_r($xml);
?>