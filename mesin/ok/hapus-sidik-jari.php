<html>
<head><title>Contoh Koneksi Mesin Absensi Mengunakan SOAP Web Service</title></head>
<body bgcolor="#caffcb">

<H3>Hapus Sidik Jari</H3>

<?php
if(isset($_GET['ip'])) {
	$IP 	= $_GET['ip'];
	$Key 	= $_GET['key'];
	$fn 	= $_GET['fn'];
	$id 	= $_GET['id'];
	$temp  	= $_GET['temp'];
}else{
	$IP 	= "192.168.1.13";
	$Key 	= "8050";
	$fn 	= '';
	$id 	= '';
	$temp 	= '';
}
?>

<form action="hapus-sidik-jari.php">
IP Address: <input type="Text" name="ip" value="<?php echo $IP?>" size=15><BR>
Comm Key: <input type="Text" name="key"  value="<?php echo $Key?>"><BR><BR>

UserID: <input type="Text" name="id"  value="<?php echo $id?>"><BR>
<BR>

<input type="Submit" value="Hapus">
</form>
<BR>

<?
if($HTTP_GET_VARS["ip"]!=""){?>

	<?php
	$Connect = @fsockopen($IP, "80", $errno, $errstr, 1);
	if($Connect){
		$soap_request="<DeleteTemplate><ArgComKey xsi:type=\"xsd:integer\">".$Key."</ArgComKey><Arg><PIN xsi:type=\"xsd:integer\">".$id."</PIN></Arg></DeleteTemplate>";
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
//	echo $buffer;
	$buffer=Parse_Data($buffer,"<DeleteTemplateResponse>","</DeleteTemplateResponse>");
	$buffer=Parse_Data($buffer,"<Information>","</Information>");
	echo "<B>Result:</B><BR>".$buffer;
	
}?>


</body>
</html>
