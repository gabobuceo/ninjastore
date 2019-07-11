<?php
session_start();
require_once('../../logica/funciones.php');
require_once('../clases/Categoria.class.php');
require_once('../clases/commit.class.php');
// -------- CHECK AND GET DATA ----
$error=false;
if (!isset($_POST['categoria'])){
  $mensaje[] =  "No se ingresó el categoria<br>";
  $error=true;
}else{
  if ($_POST['categoria']==""){
    $mensaje[] =  "El categoria no puede estar vacio<br>";
    $error=true;
  }
  if (is_null($_POST['categoria'])){
    $mensaje[] =  "El categoria no puede ser nulo<br>";
    $error=true;
  }
}

if ($error==true){
  $_SESSION['mobjetivo']="misdatos";
  $_SESSION['mtipo']="alert-info";
  $_SESSION['mtexto']="<strong>!Ojo! </strong>".implode($mensaje);
  header("Location: ../view/mgmtcategories.php?id=".$_POST['idcat']);
}else{
  $idcat=$_POST['idcat'];
  $categoria=$_POST['categoria'];

  try {
    $conex = conectar();
    $commiteo= new Commit();
    $commiteo->AutoCommitOFF($conex);
    $commiteo->TransactionStart($conex);
    $c= new Categoria($idcat,$categoria);
    if ($c->modificarPadre($conex)!= TRUE){
      $commiteo->Rollbackeo($conex);
      $_SESSION['mobjetivo']="misdatos";
      $_SESSION['mtipo']="alert-warning";
      $_SESSION['mtexto']="<strong>!Problema! </strong>No se pudo modificar los datos de la categoria";
      header("Location: ../view/mgmtcategories.php?id=".$idcat);
    }else{
      $commiteo->Commiteo($conex);
      $_SESSION['mobjetivo']="misdatos";
      $_SESSION['mtipo']="alert-info";
      $_SESSION['mtexto']="<strong>!Cambios realizados con exito! </strong>";
      header("Location: ../view/mgmtcategories.php?id=".$idcat);

    }
  } catch (PDOException $e) {
    $commiteo->Rollbackeo($conex);
    $_SESSION['mobjetivo']="misdatos";
    $_SESSION['mtipo']="alert-danger";
    $_SESSION['mtexto']="<strong>!Error! </strong>".$e->getMessage();;
    header("Location: ../view/mgmtcategories.php?id=".$idcat);

  }
}
?>
