<?php
if(session_id() == '') { 
	session_start(); 
}
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('../logica/funciones.php');
$ua=getBrowser();
$_SESSION['CLIENT_SETTINGS_BROWSER']=$ua['name'];
$_SESSION['CLIENT_SETTINGS_VERSION']=$ua['version'];
$_SESSION['CLIENT_SETTINGS_SO']=$ua['platform'];
if ($ua['name']=="Google Chrome") {
	$_SESSION['EXT']="webp";
}else{
	$_SESSION['EXT']="jpg";
}

header('Content-Type: text/html; charset=UTF-8');
header("Access-Control-Allow-Origin: *");

$config = include('../config/config.php');
$staticsrv=$config->staticsrv;

?>


<!DOCTYPE html>
<html lang="es" xml:lang="es" xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Ninja Store 2019</title>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Tienda online responsiva, estore, Ninja Store" />

	<!-- CSS del sitio Ninja Store -->
	<link rel="icon" href="<?php echo $staticsrv; ?>/img/ico.<?php echo $_SESSION['EXT']; ?>" />
	<link rel="stylesheet" href="<?php echo $staticsrv; ?>/css/bootstrap.min.css" />
	<link rel="stylesheet" href="<?php echo $staticsrv; ?>/css/bootstrap-select.css" />
	<link rel="stylesheet" href="<?php echo $staticsrv; ?>/css/font-awesome.css" />
	<link rel="stylesheet" href="<?php echo $staticsrv; ?>/css/style.css"/>

	<!-- FONTS del sitio Ninja Store -->
	<link href='//fonts.googleapis.com/css?family=Ubuntu+Condensed' rel='stylesheet' type='text/css'>
	<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>

	<!-- JS del sitio Ninja Store -->
	<script src="<?php echo $staticsrv; ?>/js/jquery-1.10.2.js"></script>
	<script type="application/x-javascript"> 
		addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ 
			window.scrollTo(0,1); 
		}
	</script>
	<script src='<?php echo $staticsrv; ?>/js/bootstrap.min.js'></script>
	<script src='<?php echo $staticsrv; ?>/js/bootstrap-select.js'></script>
	<script src='<?php echo $staticsrv; ?>/js/script.js'></script>