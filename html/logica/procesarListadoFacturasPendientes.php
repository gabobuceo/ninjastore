<?php
require_once('../logica/funciones.php');
require_once('../clases/Factura.class.php');
$config = include('../config/config.php');
// -------- GET DATA ----
try {          
  $conex = conectar();      
  $pu= new Factura('','',$_SESSION['id']);
  $datos_pu=$pu->consultaPendientes($conex);
  if (!empty($datos_pu)){
    return $datos_pu;
  }else{
    return array('this'=>'No existen Ventas');
  }
} catch (PDOException $e) {
  return "Error: ".$e->getMessage();
  exit();
}
?>