<?php
require_once('../logica/funciones.php');
require_once('../clases/Favorito.class.php');
// -------- GET DATA ----
$idusuario = $_GET['idusuario'];
$idpublicacion = $_GET['idpublicacion'];

  try {          
    $conex = conectar();			
    $c= new Favorito($idusuario,$idpublicacion);
    $datos_c=$c->alta($conex);
    if (!empty($datos_c)){
      echo "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong>!Exito! </strong><script></script></div>"; 
    }else{
      echo "<div class='alert alert-warning alert-dismissable'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong>!Ojo! </strong></div>";
    }
  } catch (PDOException $e) {
    echo "<div class='alert alert-warning alert-dismissable'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong>Ya fue agregado </strong></div>";
    exit();
  }
?>