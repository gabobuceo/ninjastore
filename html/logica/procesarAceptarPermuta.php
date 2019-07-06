<?php
require_once('../logica/funciones.php');
require_once('../clases/Compra.class.php');
require_once('../clases/Permuta.class.php');
require_once('../clases/Publicacion.class.php');

require_once('../clases/commit.class.php');
require_once('../clases/Historial.class.php');
require_once('../clases/Notificacion.class.php');


// -------- GET DATA ----
session_start();
//var_dump($_POST);
//exit();
$fin=true;
// ----------- PROCESO COMPRA --------------------
try {
  $fin=true;
  $idpermuta=$_POST['id'];

  /*CHECKEO de Cantidades*/

  $conex = conectar();
  $commiteo= new Commit();
  $commiteo->AutoCommitOFF($conex);
  $commiteo->TransactionStart($conex);

  $_SESSION['ExcID']=$_POST['id'];
  $datos_permutas = require_once('../logica/procesarCargaPermuta.php');   
  unset($_SESSION['ExcID']);
//var_dump($datos_permutas);

  $p= new Publicacion($datos_permutas[0]['IDPUBLICACIONORIGEN']);
  $CantidadOrigen=$p->consultaCantidad($conex);
  if ($CantidadOrigen<1) {
    $commiteo->Rollbackeo($conex);
    $fin=false;
  }else{
    $p= new Publicacion($datos_permutas[0]['IDPUBLICACIONDESTINO']);
    $CantidadDestino=$p->consultaCantidad($conex);
    if ($CantidadDestino<1) {
      $commiteo->Rollbackeo($conex);
      $fin=false;
    }else{
      $c= new Permuta($idpermuta);
      if ($c->aceptar($conex)!== TRUE){
        $commiteo->Rollbackeo($conex);
        $fin=false;
      }else{
        /*Hacer las 2 bajas de items*/
        $p= new Publicacion($datos_permutas[0]['IDPUBLICACIONORIGEN'],'','','','','','','','','','',$CantidadOrigen[0][0]-1);
        if ($p->modificarCantidad($conex)!== TRUE){
          $commiteo->Rollbackeo($conex);
          $fin=false;
        }else{
          $p= new Publicacion($datos_permutas[0]['IDPUBLICACIONDESTINO'],'','','','','','','','','','',$CantidadDestino[0][0]-1);
          if ($p->modificarCantidad($conex)!== TRUE){
            $commiteo->Rollbackeo($conex);
            $fin=false;
          }else{
            if (($CantidadOrigen[0][0]-1)==0){
              $p= new Publicacion($datos_permutas[0]['IDPUBLICACIONORIGEN'],'','','','','','','','','CANCELADA');
              if ($p->modificarEstadoP($conex)!== TRUE){
                $commiteo->Rollbackeo($conex);
                $fin=false;
              }
            }
            if (($CantidadDestino[0][0]-1)==0){
              $p= new Publicacion($datos_permutas[0]['IDPUBLICACIONDESTINO'],'','','','','','','','','CANCELADA');
              if ($p->modificarEstadoP($conex)!== TRUE){
                $commiteo->Rollbackeo($conex);
                $fin=false;
              }
            }
            $commiteo->Commiteo($conex);
          }
        }
      }
    }
  }
  //var_dump($fin);
  //exit();
  $commiteo->AutoCommitON($conex);
} catch (PDOException $e) {
  print "Error: ".$e->getMessage();
  exit();
}





/*
TAMBIEN DEBERIA DE CHECKEAR SI EL ARTICULO ES NUEVO PARA MANDARLE A LA FACTURA !!!!!!!!!!!
*/
 // ----------- PROCESO NOTIFICACION --------------------*/
/*
$_SESSION['ComID']= $_GET['idcompra'];
  $datos_vendedor = require_once('../logica/procesarCargaCompra.php');

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
  header('Location: ../view/myexchanges.php?id='.$_POST['id']);
}else{
  $_SESSION['mobjetivo']="myexchanges.php";
  $_SESSION['mtipo']="alert-warning";
  $_SESSION['mtexto']="<strong>!Problema! </strong>".$e->getMessage();
  header('Location: ../view/myexchanges.php');
}



?>