<?php
require_once('../../logica/funciones.php');
require_once('../clases/Gestiona.class.php');
// -------- GET DATA ----
$id = $_SESSION['DenID'];
try {          
  $conex = conectar();			
  $co= new Gestiona('','',$id);
  $datos_co=$co->consultaAsignado($conex);
  if (!empty($datos_co)){
    return $datos_co;
  }else{
    return array('this'=>'Vacio');
  }
} catch (PDOException $e) {
  return "Error: ".$e->getMessage();
  exit();
}
?>
