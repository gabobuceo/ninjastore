<?php
//session_start();
require_once ('../logica/funciones.php');
require_once('../clases/Usuario.class.php');
// -------- GET DATA ----

try {          
  $conex = conectar();      
  $pu= new Usuario($_GET['id']);
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