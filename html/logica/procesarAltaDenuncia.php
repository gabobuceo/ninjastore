<?php
session_start();
require_once('../logica/funciones.php');
require_once('../clases/Realiza.class.php');
require_once('../clases/Denuncia.class.php');

require_once('../clases/commit.class.php');
require_once('../clases/Historial.class.php');
require_once('../clases/Notificacion.class.php');
// -------- Obtener la Info ----
var_dump($_POST);
$idusuario = $_SESSION['id'];
$idobjeto = $_POST['pubid'];
$tipo = $_POST['tipo'];
$comentario = $_POST['comentario'];
/*
Insertar en Denuncia
Obtener maxid (ya esta la funcion)
Insertar en Realiza
*/

// ----------- PROCESO COMPRA --------------------
try {          
  $fin=true;
  $conex = conectar();
  $commiteo= new Commit();
  $commiteo->AutoCommitOFF($conex);
  $commiteo->TransactionStart($conex);
  $p= new Denuncia('','',$tipo,$idobjeto,$comentario);
  if ($p->alta($conex)!== TRUE){
    $commiteo->Rollbackeo($conex);
    $fin=false;
  }else{
    $iddenuncia=$p->consultaMaxID($conex);
    $p= new Realiza($iddenuncia[0][0],$idusuario);
    if ($p->alta($conex)!== TRUE){
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
// ----------- PROCESO NOTIFICACION --------------------
try {          
  $commiteo= new Commit();
  $commiteo->AutoCommitOFF($conex);
  $commiteo->TransactionStart($conex);
  $c= new notificacion('',$idusuario,'Has enviado una denuncia',$iddenuncia[0][0],$idobjeto);
  if ($c->altadenuncia($conex)!== TRUE){
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
  $h= new Historial('',$idusuario,'Alta en Denuncia','El usuario '.$idusuario.' generó la denuncia (id='.$iddenuncia[0][0]);
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
  switch ($tipo) {
    case 'publicacion':
    header('Location: ../view/publication.php?id='.$_POST['pubid']);
    break;
    
    default:
      header('Location: ../view/index.php');
    break;
  }
}else{
  $_SESSION['mobjetivo']="exchanges";
  $_SESSION['mtipo']="alert-warning";
  $_SESSION['mtexto']="<strong>!Problema! </strong>La respuesta no fue ingresada";
  header('Location: ../view/myexchanges.php');
}

?>
