<?php
require_once('../logica/funciones.php');
require_once('../clases/Pregunta.class.php');

require_once('../clases/commit.class.php');
require_once('../clases/Historial.class.php');
require_once('../clases/Notificacion.class.php');
// -------- GET DATA ----
session_start();
 // ----------- PROCESO COMPRA --------------------
  try {
    $fin=true;
    $conex = conectar();
    $commiteo= new Commit();
    $commiteo->AutoCommitOFF($conex);
    $commiteo->TransactionStart($conex);

    $id=$_GET['id'];
    $c= new Pregunta($id,'','','','',$_POST['respuesta']);
    if ($c->ResponderPregunta($conex)!== TRUE){
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
// ----------- PROCESO NOTIFICACION --------------------
  try {          
    $c= new Pregunta($id);
    $datos_c=$c->consultaUno($conex);
    $_SESSION['PubID']=$datos_c[0]['IDPUBLICACION'];
    $datos_vendedor = require_once('../logica/procesarDatosVendedor.php');
    $idvendedor=$datos_vendedor[0][0];

    $commiteo= new Commit();
    $commiteo->AutoCommitOFF($conex);
    $commiteo->TransactionStart($conex);
    $c= new notificacion('',$datos_vendedor[0]['ID'],'Has respondido una pregunta',$id,$datos_c[0]['IDPUBLICACION']); 
    if ($c->altarespuesta($conex)!== TRUE){
      $commiteo->Rollbackeo($conex);
      $fin=false;
    }else{
      $c= new notificacion('',$datos_c[0]['IDUSUARIO'],'Has recibido una respuesta',$id,$datos_c[0]['IDPUBLICACION']); 
      if ($c->altarespuesta($conex)!== TRUE){
        $commiteo->Rollbackeo($conex);
        $fin=false;
      }else{
        $commiteo->Commiteo($conex);
      }
    } 
    $commiteo->AutoCommitON($conex);
    /*
    var_dump($datos_c);
    echo "<hr>";
    var_dump($datos_vendedor);
    exit();*/
  } catch (PDOException $e) {
    print "Error: ".$e->getMessage();
    exit();
  }
/* RESULTADO FINAL */
  if ($fin){
    header('Location: ../view/mymessages.php?idmensaje='.$id);
  }else{
    $_SESSION['mobjetivo']="chat";
    $_SESSION['mtipo']="alert-warning";
    $_SESSION['mtexto']="<strong>!Problema! </strong>La respuesta no fue ingresada";
    header('Location: ../view/mymessages.php?idmensaje='.$id);
  }

?>