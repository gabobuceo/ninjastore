<?php
require_once('../../logica/funciones.php');
require_once('../clases/Compra.class.php');
$config = include('../config/config.php');
// -------- GET DATA ----
$idpublicacion = $_SESSION['PubID'];
// ($id,$idUsuario,$idPublicacion,$fechaCompra,$concretado,$fechaConcretado,$cantidad,$total,$comision,$calificacion,$baja)
//SELECT sum(cantidad) FROM `COMPRA` WHERE IDPUBLICACION=
try {          
  $conex = conectar();			
  $co= new Compra('','',$idpublicacion);
  $datos_co=$co->consultaVendidos($conex);
  if (!empty($datos_co)){
    return $datos_co;
  }else{
    return array('this'=>'No existe la publicacion');
  }
} catch (PDOException $e) {
  return "Error: ".$e->getMessage();
  exit();
}
?>

