<?php
session_start();
/*echo "<hr>SERVER<br>";
var_dump($_SERVER);
echo "<hr>SESSION<br>";
var_dump($_SESSION);
echo "<hr>POST<br>";
var_dump($_POST);
echo "<hr>GET<br>";
var_dump($_GET);
echo "<hr>";
exit();*/
$_SESSION['PubID']=substr($_SERVER["HTTP_REFERER"], strpos($_SERVER["HTTP_REFERER"], "?")+4);
switch ($_POST["boton"]) {
	case 'comprar':
		$datos_publicacion = require_once('../logica/procesarCargaPublicacion.php');
		$_SESSION['cantidad']=$_POST['cantidad'];
		$_SESSION['precio']=$datos_publicacion[0]['PRECIO'];
		$_SESSION['estado']=$datos_publicacion[0]['ESTADOA'];
		$accion=require_once('../logica/procesarAltaCompra.php');
		if (is_object($accion)) {
			$_SESSION['mobjetivo']="publication.php";
			$_SESSION['mtipo']="alert-danger";
			$_SESSION['mtexto']="<strong>!Error! contacte a un administrador </strong>".$accion->getMessage();
			header('Location: ../view/publication.php?id='.$_SESSION['PubID']);
		}elseif ($accion==true){
			$_SESSION['mobjetivo']="publication.php";
			$_SESSION['mtipo']="alert-success";
			$_SESSION['mtexto']="<strong>!Felicidades! </strong>has comprado el articulo";
			header('Location: ../view/buyconfirmation.php?id='.$_SESSION['idcompra']);
		}else{
			$_SESSION['mobjetivo']="publication.php";
			$_SESSION['mtipo']="alert-warning";
			$_SESSION['mtexto']="<strong>!Problema! </strong>no se ha comprar agregar este item";
			header('Location: ../view/publication.php?id='.$_SESSION['PubID']);
		}
		
	break;
	case 'permuta':
		$_SESSION['mobjetivo']="publication.php";
		$_SESSION['mtipo']="alert-success";
		$_SESSION['mtexto']="<strong>!Felicidades! </strong>has enviado una solicitud de permuta";
		header('Location: ../view/publication.php?id='.$_SESSION['PubID']);
	break;
	case 'favorito':
		$accion=require_once('../logica/procesarAltaFavoritos.php');
		echo $accion['message'];
		var_dump($accion); 
		if (is_object($accion)) {
			$_SESSION['mobjetivo']="publication.php";
			$_SESSION['mtipo']="alert-danger";
			$_SESSION['mtexto']="<strong>!Error! contacte a un administrador </strong>".$accion->getMessage();
		}elseif ($accion==true){
			$_SESSION['mobjetivo']="publication.php";
			$_SESSION['mtipo']="alert-success";
			$_SESSION['mtexto']="<strong>!Añadido! </strong>este item pertenece a tus favoritos";
		}else{
			$_SESSION['mobjetivo']="publication.php";
			$_SESSION['mtipo']="alert-warning";
			$_SESSION['mtexto']="<strong>!Problema! </strong>no se ha podido agregar este item";
		}
		header('Location: ../view/publication.php?id='.$_SESSION['PubID']);
	break;
	case 'desfavorito':
		$accion=require_once('../logica/procesarBajaFavoritos.php');
		echo $accion['message'];
		var_dump($accion); 
		if (is_object($accion)) {
			$_SESSION['mobjetivo']="publication.php";
			$_SESSION['mtipo']="alert-danger";
			$_SESSION['mtexto']="<strong>!Error! contacte a un administrador </strong>".$accion->getMessage();
		}elseif ($accion==true){
			$_SESSION['mobjetivo']="publication.php";
			$_SESSION['mtipo']="alert-success";
			$_SESSION['mtexto']="<strong>!Borrado! </strong>este item no pertenece a tus favoritos";
		}else{
			$_SESSION['mobjetivo']="publication.php";
			$_SESSION['mtipo']="alert-warning";
			$_SESSION['mtexto']="<strong>!Problema! </strong>no se ha podido agregar este item";
		}
		header('Location: ../view/publication.php?id='.$_SESSION['PubID']);
		break;
		default:
		$_SESSION['mobjetivo']="publication.php";
		$_SESSION['mtipo']="alert-danger";
		$_SESSION['mtexto']="<strong>!Problema! </strong>error en la accion. Contacte a un administrador";
		header('Location: ../view/publication.php?id='.$_SESSION['PubID'].'&#pachamama');
	break;
}
?>
