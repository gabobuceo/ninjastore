<?php
require_once('../logica/funciones.php');
require_once('../clases/Compra.class.php');
$config = include('../config/config.php');
// -------- GET DATA ----
$idcompra = $_SESSION['ComID'];
unset($_SESSION['ComID']);
try {          
  $conex = conectar();			
  $c= new Compra($idcompra);
  $datos_c=$c->consultaUno($conex);
  if (!empty($datos_c)){
    return $datos_c;
  }else{
    return array('this'=>'No existe la compra');
  }
} catch (PDOException $e) {
  return "Error: ".$e->getMessage();
  exit();
}
?>

