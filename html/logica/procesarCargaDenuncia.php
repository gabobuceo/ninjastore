<?php
require_once('../logica/funciones.php');
require_once('../clases/Denuncia.class.php');
$config = include('../config/config.php');
// -------- GET DATA ----
$id = $_SESSION['iddenuncia'];
try {          
  $conex = conectar();			
  $co= new Denuncia($id);
  $datos_co=$co->consultaUno($conex);
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