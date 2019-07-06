<?php
session_start();
require_once('../logica/funciones.php');
require_once('../clases/Notificacion.class.php');

try {          
	$conex = conectar();      
	$pu= new Notificacion($_GET['idnotificacion']);
	$datos_c=$pu->notificacionvisto($conex);
	if (!empty($datos_c)){
		header('Location: '.$_SERVER['HTTP_REFERER']);
	}else{
		return false;
	}
} catch (PDOException $e) {
	return $e;
}
?>