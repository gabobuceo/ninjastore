<?php
require_once('../logica/funciones.php');
require_once('../clases/Usuario.class.php');
$config = include('../config/config.php');
// -------- GET DATA ----

try {          
  $conex = conectar();      
  $pu= new Usuario($_SESSION['id']);
  $datos_pu=$pu->consultaUno($conex);
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