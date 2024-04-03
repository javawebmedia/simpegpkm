<?php 
date_default_timezone_set('Asia/Jakarta');
$IP         = "192.168.1.13";
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
// header('Content-Type: application/json; charset=utf-8');
// $hasil = json_encode($buffer);
// header("Content-type: text/xml");
// echo htmlentities($buffer);
// print_r($buffer);
// echo $hasil;
$json_string = json_encode($buffer);
// Mengubah string JSON menjadi array PHP
$data_array = json_decode('['.str_replace(['\r','\n'],'',$json_string).']', true);

// Membuat tabel horizontal
echo '<table border="1">';
foreach ($data_array as $row) {
    preg_match_all('/<([^>]+)>([^<]+)<\/([^>]+)>/', $row, $matches, PREG_SET_ORDER);
    
    $no=1; foreach ($matches as $match) {
        
        // $i=1; foreach($match[1] as $match2) {
        //     echo '<td>'.$match2['PIN'].'</td>';
        // }
        echo '<tr>';
        echo '<td>'.$match[1].'</td>';
        if ($match[1] == 'PIN' || $match[1] == 'DateTime' || $match[1] == 'Verified' || $match[1] == 'Status' || $match[1] == 'WorkCode') {
            echo '<td>' . $match[2] . '</td>';
        }
        echo '</tr>';
    $no++; }
    
}
echo '</table>';
?>
