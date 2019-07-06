<?php
require_once('../logica/funciones.php');
require_once('../clases/Compra.class.php');
require_once('../clases/Permuta.class.php');

require_once('../clases/commit.class.php');
require_once('../clases/Historial.class.php');
require_once('../clases/Notificacion.class.php');


// -------- GET DATA ----
session_start();
$fin=true;
// ----------- PROCESO COMPRA --------------------
try {
  $fin=true;
  $idpermuta=$_POST['id'];
  $conex = conectar();
  $commiteo= new Commit();
  $commiteo->AutoCommitOFF($conex);
  $commiteo->TransactionStart($conex);
  $c= new Permuta($idpermuta);
  if ($c->cancelar($conex)!== TRUE){
    $commiteo->Rollbackeo($conex);
    $fin=false;
  }else{
    $commiteo->Commiteo($conex);
  }
  $commiteo->AutoCommitON($conex);*/
} catch (PDOException $e) {
  print "Error: ".$e->getMessage();
  exit();
}
/*
TAMBIEN DEBERIA DE CHECKEAR SI EL ARTICULO ES NUEVO PARA MANDARLE A LA FACTURA !!!!!!!!!!!
*/
 // ----------- PROCESO NOTIFICACION --------------------*/
try {  
  $commiteo= new Commit();
  $commiteo->AutoCommitOFF($conex);
  $commiteo->TransactionStart($conex);
  $_SESSION['ExcID']=$_POST['id'];
  $datos_permutas = require_once('../logica/procesarCargaPermuta.php');   
  unset($_SESSION['ExcID']);
  $c= new notificacion('',$_SESSION['id'],'Has cancelado una permuta!',$datos_permutas[0]['ID'],$datos_permutas[0]['IDPUBLICACIONORIGEN']);
  if ($c->altapermutaaceptada($conex)!== TRUE){
    $commiteo->Rollbackeo($conex);
    $fin=false;
  }else{
    $c= new notificacion('',$datos_permutas[0]['IDORIGEN'],'El vendedor ha cancelado tu permuta',$datos_permutas[0]['ID'],$datos_permutas[0]['IDPUBLICACIONDESTINO']);
    if ($c->altapermutaaceptada($conex)!== TRUE){
      $commiteo->Rollbackeo($conex);
      $fin=false;
    }else{
      $commiteo->Commiteo($conex);
    }
  } 
  $commiteo->AutoCommitON($conex);
} catch (PDOException $e) {
  print "Error: ".$e->getMessage();
  exit();
}
try {          
  $conex = conectar();
  $commiteo= new Commit();
  $commiteo->AutoCommitOFF($conex);
  $commiteo->TransactionStart($conex);

  $h= new Historial('',$_SESSION['id'],'Permuta Cancelada','El vendedor '.$_SESSION['id'].' cancelo la permuta '.$datos_permutas[0]['ID']);
  if ($h->alta($conex)!== TRUE){
    $commiteo->Rollbackeo($conex);
    $fin=false;
  }else{
    $commiteo->Commiteo($conex);
  } 
  $commiteo->AutoCommitON($conex);
} catch (PDOException $e) {
  print "Error: ".$e->getMessage();
  exit();
}
  // ----------- PROCESO HISTORIAL --------------------
try {          
  $conex = conectar();
  $commiteo= new Commit();
  $commiteo->AutoCommitOFF($conex);
  $commiteo->TransactionStart($conex);

  $h= new Historial('',$_SESSION['id'],'Update en Compra','El vendedor '.$_SESSION['id'].' confirmo la compra '.$_GET['idcompra']);
  if ($h->alta($conex)!== TRUE){
    $commiteo->Rollbackeo($conex);
    $fin=false;
  }else{
    $commiteo->Commiteo($conex);
  } 
  $commiteo->AutoCommitON($conex);
} catch (PDOException $e) {
  print "Error: ".$e->getMessage();
  exit();
}
/* RESULTADO FINAL */
if ($fin){
  header('Location: ../view/myexchanges.php?id='.$_POST['id']);
}else{
  $_SESSION['mobjetivo']="mysells.php";
  $_SESSION['mtipo']="alert-warning";
  $_SESSION['mtexto']="<strong>!Problema! </strong>".$e->getMessage();
  header('Location: ../view/myexchanges.php');
}



?>