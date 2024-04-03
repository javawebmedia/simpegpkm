<?php 
date_default_timezone_set('Asia/Jakarta');
include('parse.php');
$IP         = "192.168.1.13";
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
$buffer = Parse_Data($buffer, "<GetAttLogResponse>", "</GetAttLogResponse>");
$buffer = explode("\r\n", $buffer);
for ($a = 0; $a < count($buffer); $a++) {
    $data       = Parse_Data($buffer[$a], "<Row>", "</Row>");
    $PIN        = Parse_Data($data, "<PIN>", "</PIN>");
    $DateTime   = Parse_Data($data, "<DateTime>", "</DateTime>");
    $Verified   = Parse_Data($data, "<Verified>", "</Verified>");
    $Status     = Parse_Data($data, "<Status>", "</Status>");
    $WorkCode   = Parse_Data($data, "<WorkCode>", "</WorkCode>");
    ?>
    <hr>
        PIN: <?= $PIN ?>, DateTime: <?= $DateTime ?>. Verified: <?= $Verified ?>, Status: <?= $Status ?>, WorkCode:<?php echo $WorkCode ?>
    
<?php } ?>
?>