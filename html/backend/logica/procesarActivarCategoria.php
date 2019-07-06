<?php
session_start();
require_once('../logica/funciones.php');
require_once('../clases/Categoria.class.php');
require_once('../clases/commit.class.php');
// -------- CHECK AND GET DATA ----
//Seteados
$error=false;
if (!isset($_POST['idCatMod'])){
  $mensaje[] =  "La categoría no está seteada<br>";
  $error=true;
  }else{
    if ($_POST['idCatMod']==""){
      $mensaje[] =  "La categoria puede estar vacía<br>";
      $error=true;
    }
    if (is_null($_POST['idCatMod'])){
      $mensaje[] =  "La categoria no puede ser nulo<br>";
      $error=true;
    }
  }

if ($error==true){
  $_SESSION['mobjetivo']="misdatos";
  $_SESSION['mtipo']="alert-info";
  $_SESSION['mtexto']="<strong>!Ojo! </strong>".implode($mensaje);
  header("Location: ../view/categorysearch.php?");
}else{

  $idCat=$_POST['idCatMod'];
  unset($_POST['idCatMod']);
  try {
    $conex = conectar();
    $commiteo= new Commit();
    $commiteo->AutoCommitOFF($conex);
    $commiteo->TransactionStart($conex);
    $c= new Categoria($idCat);
    if ($c->activaCategoria($conex)!= TRUE){
      $commiteo->Rollbackeo($conex);
      $_SESSION['mobjetivo']="misdatos";
      $_SESSION['mtipo']="alert-warning";
      $_SESSION['mtexto']="<strong>!Problema! </strong>No se pudo activar la categoria";

    }else{
      $commiteo->Commiteo($conex);
      $_SESSION['mobjetivo']="misdatos";
      $_SESSION['mtipo']="alert-info";
      $_SESSION['mtexto']="<strong>!Categoria activada con exito! </strong>";
      header("Location: ../view/categorysearch.php");

    }
  } catch (PDOException $e) {
    $commiteo->Rollbackeo($conex);
    $_SESSION['mobjetivo']="misdatos";
    $_SESSION['mtipo']="alert-danger";
    $_SESSION['mtexto']="<strong>!Error! </strong>".$e->getMessage();;
    header("Location: ../view/categorysearch.php");

  }
}
?>
