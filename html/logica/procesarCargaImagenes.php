<?php
require_once('../logica/funciones.php');
require_once('../clases/PublicacionImg.class.php');
// -------- GET DATA ----
try {          
  $conex = conectar();      
  $c= new PublicacionImg();
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