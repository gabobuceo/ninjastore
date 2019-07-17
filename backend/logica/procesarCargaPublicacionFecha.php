<?php
require_once ('../logica/funciones.php');
require_once('../clases/Publicacion.class.php');
$config = include('../config/config.php');
// -------- GET DATA ----
$idpublicacion = $_SESSION['PubID'];

try {          
  $conex = conectar();			
  $pu= new Publicacion($idpublicacion);
  $datos_pu=$pu->consultaFecha($conex);
  if (!empty($datos_pu)){
    return $datos_pu;
  }else{
    return array('this'=>'No existen imagenes');
  }
} catch (PDOException $e) {
  return "Error: ".$e->getMessage();
  exit();
}
?>