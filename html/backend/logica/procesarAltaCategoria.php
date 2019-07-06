<?php
session_start();
require_once('../logica/funciones.php');
require_once('../clases/Categoria.class.php');
require_once('../clases/commit.class.php');
// -------- CHECK AND GET DATA ----
//Consultamos el modo en que
$error=false;
if (isset($_POST['modo'])){
  $modo = $_POST['modo'];
}else{
    $mensaje[] =  "El modo no está siendo seteado<br>";
}
if ($modo=="padre") {
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
} else {
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
  if (!isset($_POST['idPadre'])){
    $mensaje[] =  "No se ingresó categoría padre<br>";
    $error=true;
  }else{
    if ($_POST['idPadre']==""){
      $mensaje[] =  "La categoría padre no puede estar vacía<br>";
      $error=true;
    }
    if (is_null($_POST['idPadre'])){
      $mensaje[] =  "La categoría padre no puede ser nulo<br>";
      $error=true;
    }
  }
}


if ($error==true){
  $_SESSION['mobjetivo']="misdatos";
  $_SESSION['mtipo']="alert-info";
  $_SESSION['mtexto']="<strong>!Ojo! </strong>".implode($mensaje);
  header("Location: ../view/categoryAlta.php?");
}else{

  $titulo=$_POST['titulo'];
  $idPadre=$_POST['idPadre'];
  unset($_POST['padre']);
  unset($_POST['titulo']);
  try {
    $conex = conectar();
    $commiteo= new Commit();
    $commiteo->AutoCommitOFF($conex);
    $commiteo->TransactionStart($conex);
    if ($modo=="padre") {
        $c= new Categoria('','1',$titulo,'');
    } else {
        $c= new Categoria('',$idPadre,$titulo,'');
    }
    // var_dump($c);
    // die();
    if ($c->altaCategoria($conex)!= TRUE){
      $commiteo->Rollbackeo($conex);
      $_SESSION['mobjetivo']="misdatos";
      $_SESSION['mtipo']="alert-warning";
      $_SESSION['mtexto']="<strong>!Problema! </strong>Error al crear la categoría";

    }else{
      $commiteo->Commiteo($conex);
      $_SESSION['mobjetivo']="misdatos";
      $_SESSION['mtipo']="alert-info";
      $_SESSION['mtexto']="<strong>!Se creó la categoría con exito! </strong>";
      header("Location: ../view/categoryAlta.php");

    }
  } catch (PDOException $e) {
    $commiteo->Rollbackeo($conex);
    $_SESSION['mobjetivo']="misdatos";
    $_SESSION['mtipo']="alert-danger";
    $_SESSION['mtexto']="<strong>!Error! </strong>".$e->getMessage();;
    header("Location: ../view/categoryAlta.php");

  }
}
?>
