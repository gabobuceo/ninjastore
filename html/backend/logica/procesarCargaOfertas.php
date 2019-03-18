<?php
require_once('../logica/funciones.php');
require_once('../clases/Publicacion.class.php');
$config = include('../config/config.php');
// -------- GET DATA ----

try {          
  $conex = conectar();      
  $pu= new publicacion();
  $datos_pu=$pu->consultaPublicacionesOfertas($conex);
  if (!empty($datos_pu)){
    return $datos_pu;
  }else{
    return array('this'=>'Vacio');
  }
} catch (PDOException $e) {
  return "Error: ".$e->getMessage();
  exit();
}
?>