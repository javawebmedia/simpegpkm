<html>
<head><title>Contoh Koneksi Mesin Absensi Menggunakan SOAP Web Service</title></head>
<body bgcolor="#caffcb">

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

<form action="tarik-data.php" method="GET">
IP Address: <input type="Text" name="ip" value="<?= htmlspecialchars($IP) ?>" size=15><BR>
Comm Key: <input type="Text" name="key" size="5" value="<?= htmlspecialchars($Key) ?>"><BR><BR>

<input type="Submit" value="Download">
</form>
<BR>

<?php
if (!empty($_GET["ip"])) {
    ?>
    <table cellspacing="2" cellpadding="2" border="1">
        <tr align="center">
            <td><B>UserID</B></td>
            <td width="200"><B>Tanggal & Jam</B></td>
            <td><B>Verifikasi</B></td>
            <td><B>Status</B></td>
            <td><B>Keterangan</B></td>
        </tr>
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
        for ($a = 0; $a < count($buffer); $a++) {
            $data       = Parse_Data($buffer[$a], "<Row>","</Row>");
            // echo $data.'<br>';
            print_r($data).'<BR>';
            $PIN        = Parse_Data($data, "<PIN>", "</PIN>");
            $DateTime   = Parse_Data($data, "<DateTime>", "</DateTime>");
            $Verified   = Parse_Data($data, "<Verified>", "</Verified>");
            $Status     = Parse_Data($data, "<Status>", "</Status>");
            $Time       = Parse_Data($data, "<Date>", "</Date>");
            ?>
            <tr align="center">
                <td><?= $PIN ?></td>
                <td><?= $data ?></td>
                <td><?= $Verified ?></td>
                <td><?= $Status ?></td>
                <td><?php echo $Time ?></td>
            </tr>
        <?php } ?>
    </table>
<?php } ?>

</body>
</html>
