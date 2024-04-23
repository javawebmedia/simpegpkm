<?php 
date_default_timezone_set('Asia/Jakarta');
include("parse.php");
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

$buffer = Parse_Data($buffer, "<GetAttLogResponse>","</GetAttLogResponse>");
$buffer = explode("\r\n", $buffer);
$hasil  = json_encode($buffer);

// Mengonversi JSON ke array PHP
$data = json_decode($hasil);

// Menginisialisasi array untuk hasil ekstraksi
$extracted_data = [];
// Melewati setiap elemen array, mulai dari indeks 1 karena elemen pertama kosong
for ($i = 1; $i < count($data); $i++) {
	// $xml_string 		= '<Row>' . $data[$i] . '</Row>';
    $xml    			= @simplexml_load_string($data[$i]);
    $row_data           = json_decode(json_encode($xml), true);
    $extracted_data[]   = $row_data;
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Hasil</title>
	<link rel="stylesheet" href="">
	<style type="text/css" media="screen">
	    table {
	        width: 100%;
	        border: solid thin #eee;
	        border-collapse: collapse;
	    }
	    th {
	        background-color: #f5f5f5;
	        font-weight: bold;
	    }
	    td, th {
	        border: solid thin #eee;
	        padding: 6px 12px;
	    }
	</style>
</head>
<body>
	<h1><?php echo 'Jumlah: '.count($data); ?></h1>
	<table>
	    <thead>
	        <tr>
	            <th>NO</th>
	            <th>PIN</th>
	            <th>DateTime</th>
	            <th>Verified</th>
	            <th>Status</th>
	            <th>WorkCode</th>
	        </tr>
	    </thead>
	    <tbody>
	        <?php $no=1;foreach($extracted_data as $row) { if(empty($row)) { ?>
	        	<tr>
	        		<td colspan="6"><?php echo 'Data tidak ditemukan'; ?></td>
	        	</tr>
	        <?php }else{ ?>
	        <tr>
	            <td><?php echo $no ?></td>
	            <td><?php echo $row['PIN']; ?></td>
	            <td><?php echo $row['DateTime']; ?></td>
	            <td><?php echo $row['Verified']; ?></td>
	            <td><?php echo $row['Status']; ?></td>
	            <td><?php echo $row['WorkCode']; ?></td>
	        </tr>
	    <?php } $no++; } ?>
	    </tbody>
	</table>

</body>
</html>