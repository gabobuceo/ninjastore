<?php
require_once('../../logica/funciones.php');
require_once('../clases/Pregunta.class.php');
// -------- GET DATA ----
try {          
  $conex = conectar();      
  $c= new Pregunta('',$_SESSION['IDCOMPRADOR'],$_SESSION['IDPUBLICACION']);
  $datos_c=$c->consultaPregUsuarioPublicacion($conex);
  if (!empty($datos_c)){
    return $datos_c; 
  }else{
    return array('this'=>'No tiene telefonos');
  }
} catch (PDOException $e) {
  return "Error: ".$e->getMessage();
  exit();
}
?>