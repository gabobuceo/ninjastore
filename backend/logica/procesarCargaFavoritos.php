<?php
require_once('../logica/funciones.php');
require_once('../clases/Favorito.class.php');
require_once('../clases/PublicacionImg.class.php');
$config = include('../config/config.php');
// -------- GET DATA ----
$idusuario = $_GET['idusuario'];

try {          
  $conex = conectar();			
  $fa= new Favorito($idusuario);
  $datos_fa=$fa->consultaTodos($conex);
  if (!empty($datos_fa)){
    for ($i=0; $i < count($datos_fa); $i++) { 
      $pi= new PublicacionImg($datos_fa[$i]['ID']);
      $datos_pi=$pi->consultaTodos($conex);
      echo "<div class=media><div class=media-left><img src=".$config->staticsrv . "/" . $datos_pi[0]['IMAGENES'] . " style=width:50px;height:50px/></div><div class=media-body><p>" . $datos_fa[$i]['TITULO'] . "</p></div></div>";
    }
  }else{
    echo "<p>No tienes ningun favorito</p>";
  }
} catch (PDOException $e) {
  print "Error: ".$e->getMessage();
  exit();
}
?>