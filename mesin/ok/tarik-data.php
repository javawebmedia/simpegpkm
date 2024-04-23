<html>
<head><title>Contoh Koneksi Mesin Absensi Mengunakan SOAP Web Service</title></head>
<body bgcolor="#caffcb">

<H3>Download Log Data</H3>

<?php
if(isset($_GET['ip'])) {
	$IP 	= $_GET["ip"];
	$Key 	= $_GET["key"];
	$id 	= $_GET["id"];
	$fn 	= $_GET["fn"];
}else{
	$IP  	= "192.168.1.13";
	$Key  	= "8050";
	$id 	= 3;
	$fn 	= 6;
}
?>

<form action="tarik-data.php">
IP Address: <input type="Text" name="ip" value="<?php echo $IP?>" size=15><BR>
Comm Key: <input type="Text" name="key"  value="<?php echo $Key?>"><BR><BR>

<input type="Submit" value="Download">
</form>
<BR>


	<table cellspacing="2" cellpadding="2" border="1">
	<tr align="center">
	    <td><B>UserID</B></td>
	    <td width="200"><B>Tanggal & Jam</B></td>
	    <td><B>Verifikasi</B></td>
	    <td><B>Status</B></td>
	    <td><B>WorkCode</B></td>
	</tr>
	<?php
	$Connect = @fsockopen($IP, "80", $errno, $errstr, 1);
	if($Connect){
		$soap_request="<GetAttLog><ArgComKey xsi:type=\"xsd:integer\">".$Key."</ArgComKey><Arg><PIN xsi:type=\"xsd:integer\">All</PIN></Arg></GetAttLog>";
		$newLine="\r\n";
		fputs($Connect, "POST /iWsService HTTP/1.0".$newLine);
	    fputs($Connect, "Content-Type: text/xml".$newLine);
	    fputs($Connect, "Content-Length: ".strlen($soap_request).$newLine.$newLine);
	    fputs($Connect, $soap_request.$newLine);
		$buffer="";
		while($Response=fgets($Connect, 1024)){
			$buffer=$buffer.$Response;
		}
	}else echo "Koneksi Gagal";
	
	include("parse.php");
	$buffer=Parse_Data($buffer,"<GetAttLogResponse>","</GetAttLogResponse>");
	$buffer=explode("\r\n",$buffer);
	for($a=0;$a<count($buffer);$a++){
		$data=Parse_Data($buffer[$a],"<Row>","</Row>");
		$PIN=Parse_Data($data,"<PIN>","</PIN>");
		$DateTime=Parse_Data($data,"<DateTime>","</DateTime>");
		$Verified=Parse_Data($data,"<Verified>","</Verified>");
		$Status=Parse_Data($data,"<Status>","</Status>");
		$WorkCode=Parse_Data($data,"<WorkCode>","</WorkCode>");
	?>
	<tr align="center">
		    <td><?php echo $PIN?></td>
		    <td><?php echo $DateTime?></td>
		    <td><?php echo $Verified?></td>
		    <td><?php echo $Status?></td>
		    <td><?php echo $WorkCode?></td>
		</tr>
	<?php } ?>
	</table>


</body>
</html>
