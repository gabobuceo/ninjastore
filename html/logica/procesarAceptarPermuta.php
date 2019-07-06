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

*/
 // ----------- PROCESO NOTIFICACION --------------------*/

/*var_dump($datos_permutas);*/
try {  
  $commiteo= new Commit();
  $commiteo->AutoCommitOFF($conex);
  $commiteo->TransactionStart($conex);
  $c= new notificacion('',$_SESSION['id'],'Has aceptado una permuta!',$datos_permutas[0]['ID'],$datos_permutas[0]['IDPUBLICACIONORIGEN']);
  if ($c->altapermutaaceptada($conex)!== TRUE){
    $commiteo->Rollbackeo($conex);
    $fin=false;
  }else{
    $c= new notificacion('',$datos_permutas[0]['IDORIGEN'],'El vendedor ha aceptado tu permuta',$datos_permutas[0]['ID'],$datos_permutas[0]['IDPUBLICACIONDESTINO']);
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
// ----------- PROCESO HISTORIAL --------------------
try {          
  $conex = conectar();
  $commiteo= new Commit();
  $commiteo->AutoCommitOFF($conex);
  $commiteo->TransactionStart($conex);

  $h= new Historial('',$_SESSION['id'],'Permuta aceptada','El vendedor '.$_SESSION['id'].' confirmo la permuta '.$datos_permutas[0]['ID']);
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