<?php
require_once('../logica/funciones.php');
require_once('../clases/Usuario.class.php');
$config = include('../config/config.php');
// -------- GET DATA ----


try {    
  if (isset($_SESSION['idbuscar'])) {
    $id=$_SESSION['idbuscar'];
  }else{
    $id=$_SESSION['id'];  
  }      
  $conex = conectar();      
  $pu= new Usuario($id);
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