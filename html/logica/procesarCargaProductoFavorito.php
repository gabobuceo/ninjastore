<?php
require_once('../logica/funciones.php');
require_once('../clases/Favorito.class.php');
// -------- GET DATA ----
$idusuario = $_SESSION['id'];
$idpublicacion = $_SESSION['PubID'];
try {          
  $conex = conectar();			
  $c= new Favorito($idusuario,$idpublicacion);
  $datos_c=$c->consultaUno($conex);
  if (!empty($datos_c)){
    return true; 
  }else{
    return false;
  }
} catch (PDOException $e) {
  return $e;
}
?>