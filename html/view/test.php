<?php
session_start();
$config = include('../config/config.php');
echo "POST<br>";
var_dump($_POST);
echo "<hr>GET<br>";
var_dump($_GET);
echo "<hr>FILES<br>";
var_dump($_FILES);
echo "<hr>SESSION<br>";
var_dump($_SESSION);
echo "<hr>SERVER<br>";
var_dump($_SERVER);
echo "<hr>";
?>
<form action="test.php" method="POST" enctype='multipart/form-data'>
	<input type="file" name="pepe">
	<input type="submit" name="a">
</form>
<?php
$src=$_SERVER['SERVER_SOFTWARE'];
$type = strtolower(substr(strrchr($src,"("),1));
$type = substr($type,1);
echo $type;
echo "<hr>";
$ext = explode('.',$src);
echo $ext[count($ext)-1];
var_dump(count($ext));
echo "<hr>";
$str = $_SERVER['SERVER_SOFTWARE'];
$start = strpos ($str, '(');
$end = strpos ($str, ')', $start + 1);
$length = $end - $start;
$result = substr ($str, $start + 1, $length - 1); 
echo $result;
echo "<hr>";
echo $config->serverso;

echo "<hr>";


$directorio = '../imagenes';
$ficheros1  = scandir($directorio);
$datos_imagenes = require_once('../logica/procesarCargaImagenes.php');
for ($i=0; $i < count($datos_imagenes); $i++) { 
	$a[]=$datos_imagenes[$i]['IMAGENES'];
}
for ($i=0; $i < count($ficheros1); $i++) { 
	$tiene = strpos ($ficheros1[$i], '_',0);
	if (($tiene=="") && ($ficheros1[$i]!="..") && ($ficheros1[$i]!=".") && ($ficheros1[$i]!="noimage")) {
		$end = strpos ($ficheros1[$i], '.',0);
		$result = substr ($ficheros1[$i], 0, $end); 
		$b[]=$result;
	}	
}
var_dump($b);
echo "<hr>";
var_dump($a);
echo "<hr>";

$result=array_diff($b,$a);
print_r($result);
?>
