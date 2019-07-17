<?php
require_once ('../logica/funciones.php');
require_once('../clases/Categoria.class.php');
// -------- GET DATA ----
$idcategoria = $_SESSION['CatID'];

try {          
  $conex = conectar();			
  $co= new Categoria($idcategoria);
  $datos_co=$co->consultaUno($conex);
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