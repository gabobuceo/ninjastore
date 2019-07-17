<?php
session_start();
require_once ('../logica/funciones.php');
require_once('../clases/Categoria.class.php');
require_once('../clases/commit.class.php');
// -------- CHECK AND GET DATA ----
//Consultamos el modo en que
$error=false;

if (!isset($_POST['titulo'])){
  $mensaje[] =  "No se ingresó el titulo<br>";
  $error=true;
}else{
  if ($_POST['titulo']==""){
    $mensaje[] =  "El titulo no puede estar vacio<br>";
    $error=true;
  }
  if (is_null($_POST['titulo'])){
    $mensaje[] =  "El titulo no puede ser nulo<br>";
    $error=true;
  }
}

if (!isset($_POST['categoria'])){
  $mensaje[] =  "No se ingresó categoría padre<br>";
  $error=true;
}else{
  if ($_POST['categoria']==""){
    $mensaje[] =  "La categoría padre no puede estar vacía<br>";
    $error=true;
  }
  if (is_null($_POST['categoria'])){
    $mensaje[] =  "La categoría padre no puede ser nulo<br>";
    $error=true;
  }
}

if ($error==true){
  $_SESSION['mobjetivo']="misdatos";
  $_SESSION['mtipo']="alert-info";
  $_SESSION['mtexto']="<strong>!Ojo! </strong>".implode($mensaje);
  header("Location: ../view/mgmtcategories.php");
}else{

  $titulo=$_POST['titulo'];
  $categoria=$_POST['categoria'];

  try {
    $conex = conectar();
    $commiteo= new Commit();
    $commiteo->AutoCommitOFF($conex);
    $commiteo->TransactionStart($conex);
    $c= new Categoria('',$categoria,$titulo,'');
    // var_dump($c);
    // die();
    if ($c->altaCategoria($conex)!= TRUE){
      $commiteo->Rollbackeo($conex);
      $_SESSION['mobjetivo']="misdatos";
      $_SESSION['mtipo']="alert-warning";
      $_SESSION['mtexto']="<strong>!Problema! </strong>Error al crear la categoría";
      header("Location: ../view/mgmtcategories.php");
    }else{
      $commiteo->Commiteo($conex);
      $_SESSION['mobjetivo']="misdatos";
      $_SESSION['mtipo']="alert-info";
      $_SESSION['mtexto']="<strong>!Se creó la categoría con exito! </strong>";
      header("Location: ../view/mgmtcategories.php");

    }
  } catch (PDOException $e) {
    $commiteo->Rollbackeo($conex);
    $_SESSION['mobjetivo']="misdatos";
    $_SESSION['mtipo']="alert-danger";
    $_SESSION['mtexto']="<strong>!Error! </strong>".$e->getMessage();;
    header("Location: ../view/mgmtcategories.php");

  }
}
?>
