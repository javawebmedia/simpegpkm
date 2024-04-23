<html>
<head><title>Contoh Koneksi Mesin Absensi Mengunakan SOAP Web Service</title></head>
<body bgcolor="#caffcb">

<H3>Restart Device</H3>

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

<form action="restart.php">
IP Address: <input type="Text" name="ip" value="<?php echo $IP?>" size=15><BR>
Comm Key: <input type="Text" name="key"  value="<?php echo $Key?>"><BR><BR>

<input type="Submit" value="Restart">
</form>
<BR>

<?php
	$Connect = @fsockopen($IP, "80", $errno, $errstr, 1);
	if($Connect){
		$id=$HTTP_GET_VARS["id"];
		$nama=$HTTP_GET_VARS["nama"];
		$soap_request="<Restart><ArgComKey Xsi:type=\"xsd:integer\">".$Key."</ArgComKey></Restart>";
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
	echo $buffer;
	$buffer=Parse_Data($buffer,"<Information>","</Information>");
	echo "<B>Result:</B><BR>";
	echo $buffer;
?>

</body>
</html>

