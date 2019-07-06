<?php
require_once('../logica/funciones.php');
require_once('../clases/Categoria.class.php');
// -------- GET DATA ----
$idcategoria = $_SESSION['CatID'];
try {          
  $conex = conectar();      
  $c= new Categoria($idpublicacion);
  $datos_c=$c->consultaBread($conex);
  if (!empty($datos_c)){
    return $datos_c; 
  }else{
    return false;
  }
} catch (PDOException $e) {
  return $e;
}
?>