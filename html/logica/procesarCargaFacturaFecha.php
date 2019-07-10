<?php
require_once('../logica/funciones.php');
require_once('../clases/Factura.class.php');
$config = include('../config/config.php');
// -------- GET DATA ----

try {          
  $conex = conectar();      
  $pu= new Factura('','',$_SESSION["id"],'',$_SESSION['vence'],$_SESSION['vencefin']);
  $datos_pu=$pu->consultaUnoFechas($conex);
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