<?php
session_start();
/*var_dump($_POST);
exit();*/
require_once('../logica/funciones.php');
require_once('../clases/Factura.class.php');
require_once('../clases/Compra.class.php');
require_once('../clases/commit.class.php');
// -------- CHECK AND GET DATA ----
//Seteados
$idfac=$_POST['idfac'];
$idusu=$_POST['idusu'];
$idpublicacion = 2;
$cantidad = 1;
$precio=$_POST['subtotal']*0.1;
$comision=0;
/*
GENERAR COMPRA(usuariofactura,idpublicacion,now(),1,now(),1,1,totalCALCULAR,)
Obtener ID
Crear Factura con ID factura ID usuario ID publicacion ID compra
Cambiar estado factura id a pediente y vencimiento a 30 dias a partir de hoy mes que viene

*/

try {          
  $fin=true;
  $conex = conectar();
  $commiteo= new Commit();
  $commiteo->AutoCommitOFF($conex);
  $commiteo->TransactionStart($conex);
  /* GENERAR COMPRA */
  $c= new Compra('',$idusu,$idpublicacion,'','','','','',$cantidad,$precio,$comision);
  if ($c->alta($conex)!== TRUE){
    $commiteo->Rollbackeo($conex);
    $fin=false;
  }else{
    /* OBTENER ID COMPRA */
    $obtenerID=$c->consultaMaxID($conex);
    $c= new Compra($obtenerID[0][0]);
    if ($c->confirmarVenta($conex)!== TRUE){
      $commiteo->Rollbackeo($conex);
      $fin=false;
    }else{
      if ($c->confirmarCompra($conex)!== TRUE){
        $commiteo->Rollbackeo($conex);
        $fin=false;
      }else{
        $commiteo->Commiteo($conex);
      }
    }
  }
  $commiteo->AutoCommitON($conex);
} catch (PDOException $e) {
  print "Error: ".$e->getMessage();
  exit();
}

try {          
  $fin=true;
  $conex = conectar();
  $commiteo= new Commit();
  $commiteo->AutoCommitOFF($conex);
  $commiteo->TransactionStart($conex);
  /* GENERAR COMPRA */
  /*$_SESSION['ComID']=$obtenerID[0][0];
  $datos_compra = require_once('../logica/procesarCargaCompra.php');
  /*var_dump($datos_compra);
  echo "<hr>";*/

  $date = date("Y-m-d");
  $date = strtotime(date("Y-m-d", strtotime($date)) . " +1 month");
  $date = date("Y-m-d",$date);

  $vence=date("Y-m-t", strtotime($date));
  $vencefin=strtotime(date("Y-m-d", strtotime($vence)) . " +1 day");
  $vencefin = date("Y-m-d",$vencefin);
  echo $vence.'<hr>'.$vencefin;
/*
  $_SESSION['vence']=$vence;
  $_SESSION['vencefin']=$vencefin;
*/
  
  $c= new Factura($idfac,$obtenerID[0][0],$idusu,$idpublicacion,'',$vence,'',$precio);
  
  if ($c->alta($conex)!== TRUE){
    $commiteo->Rollbackeo($conex);
    $fin=false;
  }else{
    if ($c->mora($conex)!== TRUE){
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

if ($fin){
  header('Location: ../view/mgmtbills.php?id='.$idfac);
}else{
  $_SESSION['mobjetivo']="chat";
  $_SESSION['mtipo']="alert-warning";
  $_SESSION['mtexto']="<strong>!Problema! </strong>La pregunta no fue ingresada";
  header('Location: ../view/mgmtbills.php?id='.$idfac);
}
?>
