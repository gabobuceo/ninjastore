<?php
session_start();
require_once('../logica/funciones.php');
require_once('../clases/Compra.class.php');
require_once('../clases/Usuario.class.php');
require_once('../clases/Publicacion.class.php');

require_once('../clases/commit.class.php');
require_once('../clases/Historial.class.php');
require_once('../clases/Notificacion.class.php');
// -------- Obtener la Info ----
var_dump($_SESSION);
echo "<hr>";
var_dump($_POST);
//exit();

$idusuario = $_SESSION['id'];
$idpublicacion = 1;
$cantidad = $_POST['servicio'];
$precio = 159;
$estado = 'NUEVO';
if ($_POST['servicio']!=4) {
  $total=$cantidad*$precio;  
}else{
  $total=1528;
}
$comision=0;

// ----------- DEBUG -----------------

/*var_dump($idusuario);
echo "<br>";
var_dump($idpublicacion);
echo "<br>";
var_dump($cantidad);
echo "<br>";
var_dump($precio);
echo "<br>";
var_dump($estado);
echo "<br>";
var_dump($total);
echo "<br>";
var_dump($comision);
exit();*/

// ----------- PROCESO COMPRA --------------------
try {          
  $fin=true;
  $conex = conectar();
  $commiteo= new Commit();
  $commiteo->AutoCommitOFF($conex);
  $commiteo->TransactionStart($conex);
  /* GENERAR COMPRA */
  $c= new Compra('',$idusuario,$idpublicacion,'','','','','',$cantidad,$precio,$comision);
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
  $_SESSION['ComID']=$obtenerID[0][0];
  $datos_compra = require_once('../logica/procesarCargaCompra.php');
  var_dump($datos_compra);
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

  if (isset($datos_factura[0]['ID'])) {
    $c= new Factura($datos_factura[0]['ID'],$datos_compra[0]['ID'],$datos_compra[0]['IDCOMPRADOR'],$datos_compra[0]['IDPUBLICACION'],'',$vence,'',$total);
  }else{
    $c= new Factura('',$datos_compra[0]['ID'],$datos_compra[0]['IDCOMPRADOR'],$datos_compra[0]['IDPUBLICACION'],'',$vence,'',$total);
  }
  if ($c->alta($conex)!== TRUE){
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
if ($fin){
    header('Location: ../view/mybills.php');
  }else{
    $_SESSION['mobjetivo']="chat";
    $_SESSION['mtipo']="alert-warning";
    $_SESSION['mtexto']="<strong>!Problema! </strong>La pregunta no fue ingresada";
    header('Location: ../view/mybills.php);
  }

}