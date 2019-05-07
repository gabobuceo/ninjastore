<?php
session_start();
require_once('../logica/funciones.php');
require_once('../clases/Usuario.class.php');
require_once('../clases/commit.class.php');
// -------- CHECK AND GET DATA ----
//Seteados
$error=false;

if (!isset($_POST['latitud'])){
  $mensaje[] =  "No se ingresó la latitud<br>";
  $error=true;
}else{
  if ($_POST['latitud']==""){
    $mensaje[] =  "La latitud no puede estar vacia<br>";
    $error=true;
  }
  if (is_null($_POST['latitud'])){
    $mensaje[] =  "La latitud no puede ser nula<br>";
    $error=true;
  }
}

if (!isset($_POST['longitud'])){
  $mensaje[] =  "No se ingresó la longitud<br>";
  $error=true;
}else{
  if ($_POST['longitud']==""){
    $mensaje[] =  "La longitud no puede estar vacia<br>";
    $error=true;
  }
  if (is_null($_POST['longitud'])){
    $mensaje[] =  "La longitud no puede ser nula<br>";
    $error=true;
  }
}

if ($error==true){
  $_SESSION['mobjetivo']="migeo";
  $_SESSION['mtipo']="alert-info";
  $_SESSION['mtexto']="<strong>!Ojo! </strong>".implode($mensaje);
  header('Location: ../view/myprofile.php');
}else{

  $id=$_SESSION['id'];
  $geox=$_POST['latitud'];
  $geoy=$_POST['longitud'];
  
  try {          
    $conex = conectar();
    $commiteo= new Commit();
    $commiteo->AutoCommitOFF($conex);
    $commiteo->TransactionStart($conex);
    $c= new Usuario($id,'','','','','','','','','','','','','','','','','','','',$geox,$geoy);
    if ($c->CambiarGeoUsuario($conex)!= TRUE){
      $commiteo->Rollbackeo($conex);
      $_SESSION['mobjetivo']="migeo";
      $_SESSION['mtipo']="alert-warning";
      $_SESSION['mtexto']="<strong>!Problema! </strong>No se pudo modificar los datos del usuario";
      header('Location: ../view/myprofile.php');
    }else{
      $commiteo->Commiteo($conex);
      $_SESSION['mobjetivo']="migeo";
      $_SESSION['mtipo']="alert-info";
      $_SESSION['mtexto']="<strong>!Cambios realizados con exito! </strong>";
      header('Location: ../view/myprofile.php');
    }
  } catch (PDOException $e) {
    $commiteo->Rollbackeo($conex);
    $_SESSION['mobjetivo']="migeo";
    $_SESSION['mtipo']="alert-danger";
    $_SESSION['mtexto']="<strong>!Error! </strong>".$e->getMessage();;
    header('Location: ../view/myprofile.php');
  }
}
?>