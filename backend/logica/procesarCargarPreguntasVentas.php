<?php
require_once('../logica/funciones.php');
require_once('../clases/Pregunta.class.php');
$config = include('../config/config.php');
// -------- GET DATA ----

$idusuario = $_SESSION['id'];

try {          
  $conex = conectar();			
  $co= new Pregunta('',$idusuario);
  $datos_co=$co->consultaPregUsuarioVentas($conex);
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