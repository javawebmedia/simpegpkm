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
        echo 'Jumlah: '.count($data).'<hr>';
        // Menginisialisasi array untuk hasil ekstraksi
        $extracted_data = [];
        // Melewati setiap elemen array, mulai dari indeks 1 karena elemen pertama kosong
        for ($i = 1; $i < count($data); $i++) {
            $xml                = simplexml_load_string($data[$i]);
            $row_data           = json_decode(json_encode($xml), true);
            $extracted_data[]   = $row_data;
        }
        // echo json_encode($extracted_data);
?>
<hr>
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
        <?php $no=1;foreach($extracted_data as $row) { if(!empty($row)) { ?>
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
<?php } ?>

</body>
</html>
