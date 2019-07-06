<?php
require_once('../logica/funciones.php');
require_once('../clases/Publicacion.class.php');
$config = include('../config/config.php');
// -------- GET DATA ----
$idusuario = $_SESSION['id'];
try {          
  $conex = conectar();			
  $pu= new publicacion('',$idusuario);
  $datos_pu=$pu->consultaPublicacionesUsadas($conex);
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