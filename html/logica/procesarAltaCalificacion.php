<?php
session_start();
require_once('../logica/funciones.php');
require_once('../clases/Calificacion.class.php');
// -------- GET DATA ----

$idcompra=$_POST['idcompra'];
$idusuario=$_SESSION['id'];
$calificacion=$_POST['selected_rating'];
$mensaje=$_POST['comentario'];
try {          
  $conex = conectar();			
  $c= new Calificacion('',$idcompra,$idusuario,'','',$calificacion,$mensaje);
  $datos_c=$c->alta($conex);
  if (!empty($datos_c)){
	header('Location: ../view/buyconfirmation.php?id='.$idcompra);
  }else{
  	$_SESSION['mobjetivo']="buyconfirmation.php";
  	$_SESSION['mtipo']="alert-warning";
    $_SESSION['mtexto']="<strong>!Problema! </strong>La Nota no fue ingresada";
    header('Location: ../view/buyconfirmation.php?id='.$idcompra);
  }
} catch (PDOException $e) {
  return $e;
}
?>