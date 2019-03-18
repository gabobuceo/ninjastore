<?php
require_once('../logica/funciones.php');
require_once('../clases/Publicacion.class.php');
$config = include('../config/config.php');
// -------- GET DATA ----
$idpublicacion = $_SESSION['PubID'];

try {          
  $conex = conectar();			
  $pu= new Publicacion($idpublicacion);
  $datos_pu=$pu->consultaVisto($conex);
  if (!empty($datos_pu)){
    $visto=$datos_pu['0']['VISTO']+1;
    $pu1= new Publicacion($idpublicacion,'','','','','','','','','','','','',$visto);
    $datos_pu1=$pu1->modificarVisto($conex);
/*    if (!empty($datos_pu1)){
      
    }else{
      
    }*/
  }else{
    return array('this'=>'No existe la publicacion');
  }
} catch (PDOException $e) {
  return "Error: ".$e->getMessage();
  exit();
}
?>

