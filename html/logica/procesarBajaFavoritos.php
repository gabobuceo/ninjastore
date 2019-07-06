<?php
session_start();
require_once('../logica/funciones.php');
require_once('../clases/Favorito.class.php');

$idusuario = $_SESSION['id'];
if (isset($_POST['idfavorito'])) {
	$idpublicacion = $_POST['idfavorito'];
}else{
	$idpublicacion = $_SESSION['PubID'];
}
try {          
	$conex = conectar();      
	$c= new Favorito($idusuario,$idpublicacion);
	$datos_c=$c->baja($conex);
	if (!empty($datos_c)){
		if (isset($_POST['idfavorito'])) {
			header('Location: '.$_SERVER['HTTP_REFERER']);
		}else{
			return true; 	
		}
	}else{
		return false;
	}

} catch (PDOException $e) {
	return $e;
}
?>