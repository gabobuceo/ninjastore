<?php
require_once('../logica/funciones.php');
require_once('../clases/Notificacion.class.php');
// -------- GET DATA ----
$idusuario = $_SESSION['id'];
try {          
  $conex = conectar();      
  $c= new Notificacion('',$idusuario);
  $datos_c=$c->consultaTodos($conex);
  if (!empty($datos_c)){
    return $datos_c; 
  }else{
    return array('this'=>'Vacio');
  }
} catch (PDOException $e) {
  return $e;
}
?>