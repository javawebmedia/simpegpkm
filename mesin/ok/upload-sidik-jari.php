<html>
<head><title>Contoh Koneksi Mesin Absensi Mengunakan SOAP Web Service</title></head>
<body bgcolor="#caffcb">

<H3>Upload Sidik Jari</H3>

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

<form action="upload-sidik-jari.php">
IP Address: <input type="Text" name="ip" value="<?php echo $IP?>" size=15><BR>
Comm Key: <input type="Text" name="key"  value="<?php echo $Key?>"><BR><BR>

UserID: <input type="Text" name="id"  value="<?php echo $id?>"><BR>
Finger No: <input type="Text" name="fn" value="<?php echo $fn?>"><BR><BR>
Template Sidik jari: <BR>
<textarea name="temp" rows="7" name="isi" cols="40"><?php echo $temp ?></textarea><BR><BR>

<input type="Submit" value="Upload">
</form>
<BR>


	<?php
	$Connect = @fsockopen($IP, "80", $errno, $errstr, 1);
	if($Connect){
		$soap_request="<SetUserTemplate><ArgComKey xsi:type=\"xsd:integer\">".$Key."</ArgComKey><Arg><PIN xsi:type=\"xsd:integer\">".$id."</PIN><FingerID xsi:type=\"xsd:integer\">".$fn."</FingerID><Size>".strlen($temp)."</Size><Valid>1</Valid><Template>".$temp."</Template></Arg></SetUserTemplate>";
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
	$buffer=Parse_Data($buffer,"<SetUserTemplateResponse>","</SetUserTemplateResponse>");
	$buffer=Parse_Data($buffer,"<Information>","</Information>");
	echo "<B>Result:</B><BR>".$buffer;
	
	//Refresh DB
	$Connect = @fsockopen($IP, "80", $errno, $errstr, 1);
	$soap_request="<RefreshDB><ArgComKey xsi:type=\"xsd:integer\">".$Key."</ArgComKey></RefreshDB>";
	$newLine="\r\n";
	fputs($Connect, "POST /iWsService HTTP/1.0".$newLine);
    fputs($Connect, "Content-Type: text/xml".$newLine);
    fputs($Connect, "Content-Length: ".strlen($soap_request).$newLine.$newLine);
    fputs($Connect, $soap_request.$newLine);

?>


</body>
</html>
