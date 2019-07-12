<?php
session_start();
require_once('../../logica/funciones.php');
require_once('../clases/PublicacionImg.class.php');
require_once('../clases/commit.class.php');
// -------- CHECK AND GET DATA ----
//Seteados
  $idimg=$_POST['idimg'];
  $idpub=$_POST['idpub'];
  $imagen=$_POST['imagen'];
  try {
    $conex = conectar();
    $commiteo= new Commit();
    $commiteo->AutoCommitOFF($conex);
    $commiteo->TransactionStart($conex);
    $c= new PublicacionImg($idimg,$imagen);
    if ($c->baneo($conex)!= TRUE){
      $commiteo->Rollbackeo($conex);
      $_SESSION['mobjetivo']="misdatos";
      $_SESSION['mtipo']="alert-warning";
      $_SESSION['mtexto']="<strong>!Problema! </strong>No se pudo dar de baja los datos de la categoria";
      header("Location: ../view/mgmtpublicaciones.php?id=".$idpub);
    }else{
      $commiteo->Commiteo($conex);
      $_SESSION['mobjetivo']="misdatos";
      $_SESSION['mtipo']="alert-info";
      $_SESSION['mtexto']="<strong>!Se dió de baja la categoría con exito! </strong>";
      header("Location: ../view/mgmtpublicaciones.php?id=".$idpub);

    }
  } catch (PDOException $e) {
    $commiteo->Rollbackeo($conex);
    $_SESSION['mobjetivo']="misdatos";
    $_SESSION['mtipo']="alert-danger";
    $_SESSION['mtexto']="<strong>!Error! </strong>".$e->getMessage();
    header("Location: ../view/mgmtpublicaciones.php?id=".$idpub);
  }

?>