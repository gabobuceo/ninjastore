<?php
session_start();
require_once('../logica/funciones.php');
require_once('../clases/Publicacion.class.php');

try {          
	$id = $_GET['id'];
	$conex = conectar();      
	$c= new Publicacion($id,'','','','','','','','','BORRADOR');
	$datos_c=$c->modificarEstadoP($conex);
	if (!empty($datos_c)){
		header('Location: ../view/mypublication.php');
	}else{
		$_SESSION['mobjetivo']="chat";
		$_SESSION['mtipo']="alert-warning";
		$_SESSION['mtexto']="<strong>!Problema! </strong>La pregunta no fue ingresada";
		header('Location: ../view/mypublication.php');
	}
} catch (PDOException $e) {
	return $e;
}
?>