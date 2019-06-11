<?php
require_once('../logica/funciones.php');
require_once('../clases/Pregunta.class.php');

require_once('../clases/commit.class.php');
require_once('../clases/Historial.class.php');
require_once('../clases/Notificacion.class.php');

// -------- GET DATA ----
session_start();
if (!isset($_SESSION['id'])) {
  $_SESSION['mobjetivo']="login.php";
  $_SESSION['mtipo']="alert-warning";
  $_SESSION['mtexto']="<strong>!Problema! </strong>Debes estar logeado para poder enviar preguntas";
  header('Location: ../view/login.php');
}else{
  // ----------- PROCESO COMPRA --------------------
  try {
    $fin=true;
    $conex = conectar();
    $commiteo= new Commit();
    $commiteo->AutoCommitOFF($conex);
    $commiteo->TransactionStart($conex);

    $idpublicacion=$_GET['idpublicacion'];
    $c= new Pregunta("",$_SESSION['id'],$idpublicacion,$_POST['pregunta']);
    /*$datos_c=$c->alta($conex);*/
    if ($c->alta($conex)!== TRUE){
      $commiteo->Rollbackeo($conex);
      $fin=false;
    }else{
      $obtenerID=$c->consultaMaxID($conex);
      $commiteo->Commiteo($conex);
    }
    $commiteo->AutoCommitON($conex);
  } catch (PDOException $e) {
    print "Error: ".$e->getMessage();
    exit();
  }
  // ----------- PROCESO NOTIFICACION --------------------
  try {          

    $_SESSION['PubID']=$idpublicacion;
    $datos_vendedor = require_once('../logica/procesarDatosVendedor.php');
    $idvendedor=$datos_vendedor[0][0];


    $commiteo= new Commit();
    $commiteo->AutoCommitOFF($conex);
    $commiteo->TransactionStart($conex);
    $c= new notificacion('',$_SESSION['id'],'Has realizado una pregunta',$obtenerID[0][0],$idpublicacion); /* OBTENER y CAMBIAR EL ID DE PREGUNTA*/
    if ($c->altapregunta($conex)!== TRUE){
      $commiteo->Rollbackeo($conex);
      $fin=false;
    }else{
      $c= new notificacion('',$idvendedor,'Has recibido una pregunta',$obtenerID[0][0],$idpublicacion); /* OBTENER y CAMBIAR EL ID DE PREGUNTA*/
      if ($c->altapregunta($conex)!== TRUE){
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

    $h= new Historial('',$_SESSION['id'],'Alta en Pregunta','El usuario '.$idusuario.' generó la pregunta (id='.$obtenerID[0][0].')');
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
    header('Location: ../view/publication.php?id='.$idpublicacion);
  }else{
    $_SESSION['mobjetivo']="chat";
    $_SESSION['mtipo']="alert-warning";
    $_SESSION['mtexto']="<strong>!Problema! </strong>La pregunta no fue ingresada";
    header('Location: ../view/publication.php?id='.$idpublicacion);
  }

}

?>