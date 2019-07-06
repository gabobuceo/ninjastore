<?php
require_once('../logica/funciones.php');
require_once('../clases/Permuta.class.php');
$config = include('../config/config.php');
// -------- GET DATA ----
$idpermuta = $_SESSION['ExcID'];

try {          
  $conex = conectar();			
  $pu= new Permuta($idpermuta);
  $datos_pu=$pu->consultaUno($conex);
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

