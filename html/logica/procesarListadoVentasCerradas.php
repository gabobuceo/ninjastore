<?php
require_once('../logica/funciones.php');
require_once('../clases/Compra.class.php');
$config = include('../config/config.php');
// -------- GET DATA ----
try {          
  $conex = conectar();      
  $pu= new Compra('',$_SESSION['id']);
  $datos_pu=$pu->consultaVentasCerradas($conex);
  if (!empty($datos_pu)){
    return $datos_pu;
  }else{
    return array('this'=>'No existe la publicacion');
  }
} catch (PDOException $e) {
  return "Error: ".$e->getMessage();
  exit();
}
?>

