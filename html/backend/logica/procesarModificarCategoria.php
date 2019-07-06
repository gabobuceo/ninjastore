<?php
session_start();
require_once('../logica/funciones.php');
require_once('../clases/Categoria.class.php');
require_once('../clases/commit.class.php');
// -------- CHECK AND GET DATA ----
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

$esPadre = ($_POST['padre']);
//si la varialble "esPadre" equivale a 1 dejamos de lado la comprobación de
//los campos referidos a la modificación del padre de dicha categoría
if ($esPadre==1) {
    $error=false;
} else {

  if (!isset($_POST['idPadre'])){
    $mensaje[] =  "No se ingresó la categoria padre<br>";
    $error=true;

  }else{
    if ($_POST['idPadre']==""){
      $mensaje[] =  "La categoria padre no puede estar vacio<br>";
      $error=true;
    }
    if (is_null($_POST['idPadre'])){
      $mensaje[] =  "La categoria padre no puede ser nulo<br>";
      $error=true;
    }
  }
}

if ($error==true){
  $_SESSION['mobjetivo']="misdatos";
  $_SESSION['mtipo']="alert-info";
  $_SESSION['mtexto']="<strong>!Ojo! </strong>".implode($mensaje);
  header("Location: ../view/categoryMod.php?idCatMod=$idCat");
}else{
  $idCat=$_POST['idCatMod'];
  $titulo=$_POST['titulo'];
  $idPadre=$_POST['idPadre'];
  unset($_POST['padre']);
  unset($_POST['titulo']);
  unset($_POST['idCatMod']);
  try {
    $conex = conectar();
    $commiteo= new Commit();
    $commiteo->AutoCommitOFF($conex);
    $commiteo->TransactionStart($conex);
    if ($esPadre==1) {
        $c= new Categoria($idCat,'1',$titulo);
    } else {
        $c= new Categoria($idCat,$idPadre,$titulo);
    }
    if ($c->modificarCategoria($conex)!= TRUE){
      $commiteo->Rollbackeo($conex);
      $_SESSION['mobjetivo']="misdatos";
      $_SESSION['mtipo']="alert-warning";
      $_SESSION['mtexto']="<strong>!Problema! </strong>No se pudo modificar los datos de la categoria";

    }else{
      $commiteo->Commiteo($conex);
      $_SESSION['mobjetivo']="misdatos";
      $_SESSION['mtipo']="alert-info";
      $_SESSION['mtexto']="<strong>!Cambios realizados con exito! </strong>";
      header("Location: ../view/categorysearch.php");

    }
  } catch (PDOException $e) {
    $commiteo->Rollbackeo($conex);
    $_SESSION['mobjetivo']="misdatos";
    $_SESSION['mtipo']="alert-danger";
    $_SESSION['mtexto']="<strong>!Error! </strong>".$e->getMessage();;
    header("Location: ../view/categoryMod.php?idCatMod=$idCat");

  }
}
?>
