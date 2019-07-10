<?php
require_once('../logica/funciones.php');
require_once('../clases/Compra.class.php');
require_once('../clases/Factura.class.php');

require_once('../clases/commit.class.php');
require_once('../clases/Historial.class.php');
require_once('../clases/Notificacion.class.php');


// -------- GET DATA ----
session_start();
$fin=true;
// ----------- PROCESO COMPRA --------------------

try {
  $fin=true;
  $idcompra=$_GET['idcompra'];
  $conex = conectar();
  $commiteo= new Commit();
  $commiteo->AutoCommitOFF($conex);
  $commiteo->TransactionStart($conex);

  $c= new Compra($idcompra);
  if ($c->confirmarVenta($conex)!== TRUE){
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
/*
TAMBIEN DEBERIA DE CHECKEAR SI EL ARTICULO ES NUEVO PARA MANDARLE A LA FACTURA !!!!!!!!!!!
*/
 // ----------- PROCESO NOTIFICACION --------------------*/


try {   
 /*
  ----------------------------------------------------------------------------------------------------------------------
  */      
  
  $commiteo= new Commit();
  $commiteo->AutoCommitOFF($conex);
  $commiteo->TransactionStart($conex); 
  $_SESSION['ComID']= $_GET['idcompra'];
  $datos_vendedor = require_once('../logica/procesarCargaCompra.php');

  var_dump($datos_vendedor);
  if ($datos_vendedor[0]['COMISION'] > '0'){
    echo "<hr>";

    $date = date("Y-m-d");
    $date = strtotime(date("Y-m-d", strtotime($date)) . " +1 month");
    $date = date("Y-m-d",$date);

    $vence=date("Y-m-t", strtotime($date));
    $vencefin=strtotime(date("Y-m-d", strtotime($vence)) . " +1 day");
    $vencefin = date("Y-m-d",$vencefin);
    echo $vence.'<hr>'.$vencefin;

    $_SESSION['vence']=$vence;
    $_SESSION['vencefin']=$vencefin;

    $datos_factura = require_once('../logica/procesarCargaFacturaFecha.php');
    //var_dump($datos_factura);
    if (isset($datos_factura[0]['ID'])) {
      /*Ya existe una factura en el mes correspondiente de vencimiento*/
      $c= new Factura($datos_factura[0]['ID'],$datos_vendedor[0]['ID'],$datos_vendedor[0]['IDVENDEDOR'],$datos_vendedor[0]['IDPUBLICACION'],'',$vence,'',$datos_vendedor[0]['COMISION']);
    }else{
      /*No existe factura en el mes correspondiente de vencimiento, se crea una nueva factura*/
      $c= new Factura('',$datos_vendedor[0]['ID'],$datos_vendedor[0]['IDVENDEDOR'],$datos_vendedor[0]['IDPUBLICACION'],'',$vence,'',$datos_vendedor[0]['COMISION']);
    }
    if ($c->alta($conex)!== TRUE){
      $commiteo->Rollbackeo($conex);
      $fin=false;
    }else{
      $commiteo->Commiteo($conex);
    }
    $commiteo->AutoCommitON($conex);
  }
} catch (PDOException $e) {
  print "Error: ".$e->getMessage();
  exit();
}

  /*
  ----------------------------------------------------------------------------------------------------------------------
  */
  
  /* $c= new Factura('',$datos_vendedor[0]['ID'],$datos_vendedor[0]['IDVENDEDOR'],$datos_vendedor[0]['IDPUBLICACION'],'','','',$datos_vendedor[0]['COMISION']);*/
try {  
  $idcomprador=$datos_vendedor[0]['IDCOMPRADOR'];
  $idpublicacion=$datos_vendedor[0]['IDPUBLICACION'];
  $commiteo= new Commit();
  $commiteo->AutoCommitOFF($conex);
  $commiteo->TransactionStart($conex);
  $c= new notificacion('',$_SESSION['id'],'Has confirmado una venta!',$_GET['idcompra'],$idpublicacion);
  if ($c->altaconfirmadov($conex)!== TRUE){
    $commiteo->Rollbackeo($conex);
    $fin=false;
  }else{
    $c= new notificacion('',$idcomprador,'El vendedor ha confirmado tu compra',$_GET['idcompra'],$idpublicacion);
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
  header('Location: ../view/mysells.php');
}else{
  $_SESSION['mobjetivo']="mysells.php";
  $_SESSION['mtipo']="alert-warning";
  $_SESSION['mtexto']="<strong>!Problema! </strong>".$e->getMessage();
  header('Location: ../view/mysells.php');
}



?>