<?php
require_once('../logica/funciones.php');
require_once('../clases/Compra.class.php');

require_once('../clases/commit.class.php');
require_once('../clases/Historial.class.php');
require_once('../clases/Notificacion.class.php');

// -------- GET DATA ----
session_start();
  // ----------- PROCESO COMPRA --------------------
try {
  $fin=true;
  $idcompra=$_GET['idcompra'];
  $conex = conectar();
  $commiteo= new Commit();
  $commiteo->AutoCommitOFF($conex);
  $commiteo->TransactionStart($conex);

  $c= new Compra($idcompra);
  if ($c->confirmarCompra($conex)!== TRUE){
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
/* / ----------- PROCESO NOTIFICACION --------------------*/
try {          
  $_SESSION['ComID']= $_GET['idcompra'];
  $datos_vendedor = require_once('../logica/procesarCargaCompra.php');
  $idvendedor=$datos_vendedor[0]['IDVENDEDOR'];
  $idpublicacion=$datos_vendedor[0]['IDPUBLICACION'];
  
  $commiteo= new Commit();
  $commiteo->AutoCommitOFF($conex);
  $commiteo->TransactionStart($conex);
  $c= new notificacion('',$_SESSION['id'],'Has confirmado una compra!',$_GET['idcompra'],$idpublicacion);
  if ($c->altaconfirmadoc($conex)!== TRUE){
    $commiteo->Rollbackeo($conex);
    $fin=false;
  }else{
    $c= new notificacion('',$idvendedor,'El comprador ha confirmado tu venta',$_GET['idcompra'],$idpublicacion);
    if ($c->altaconfirmadoc($conex)!== TRUE){
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
// ----------- PROCESO HISTORIAL --------------------
try {          
  $conex = conectar();
  $commiteo= new Commit();
  $commiteo->AutoCommitOFF($conex);
  $commiteo->TransactionStart($conex);

  $h= new Historial('',$_SESSION['id'],'Update en Compra','El comprador '.$_SESSION['id'].' confirmo la compra '.$_GET['idcompra']);
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
  header('Location: ../view/mybuys.php');
}else{
  $_SESSION['mobjetivo']="chat";
  $_SESSION['mtipo']="alert-warning";
  $_SESSION['mtexto']="<strong>!Problema! </strong>La pregunta no fue ingresada";
  header('Location: ../view/mybuys.php');
}



?>