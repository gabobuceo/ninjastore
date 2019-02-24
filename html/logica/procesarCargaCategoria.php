<?php
require_once('../logica/funciones.php');
require_once('../clases/Favorito.class.php');
// -------- GET DATA ----
$idpublicacion = $_SESSION['PubID'];
try {          
  $conex = conectar();      
  $c= new Favorito('',$idpublicacion);
  $datos_c=$c->consultaTodos($conex);
  if (!empty($datos_c)){
    return true; 
  }else{
    return false;
  }
} catch (PDOException $e) {
  return $e;
}
?>