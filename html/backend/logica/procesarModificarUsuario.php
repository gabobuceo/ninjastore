<?php
session_start();
require_once('../logica/funciones.php');
require_once('../clases/Usuario.class.php');
require_once('../clases/commit.class.php');
// -------- CHECK AND GET DATA ----
//Seteados
$error=false;
if (!isset($_POST['pnombre'])){
  $mensaje[] =  "No se ingresó primer nombre<br>";
  $error=true;
}else{
  if ($_POST['pnombre']==""){
    $mensaje[] =  "El primer nombre no puede estar vacio<br>";
    $error=true;
  }
  if (is_null($_POST['pnombre'])){
    $mensaje[] =  "El primer nombre no puede ser nulo<br>";
    $error=true;
  }
}

if (!isset($_POST['papellido'])){
  $mensaje[] =  "No se ingresó primer apellido<br>";
  $error=true;
}else{
  if ($_POST['papellido']==""){
    $mensaje[] =  "El primer apellido no puede estar vacio<br>";
    $error=true;
  }
  if (is_null($_POST['papellido'])){
    $mensaje[] =  "El primer apellido no puede ser nulo<br>";
    $error=true;
  }
}

if (!isset($_POST['fnacimiento'])){
  $mensaje[] =  "No se ingresó fecha de nacimiento<br>";
  $error=true;
}else{
  if ($_POST['fnacimiento']==""){
    $mensaje[] =  "La fecha de nacimiento no puede estar vacia<br>";
    $error=true;
  }
  if (is_null($_POST['fnacimiento'])){
    $mensaje[] =  "La fecha de nacimiento no puede ser nula<br>";
    $error=true;
  }
}

if (!isset($_POST['email'])){
  $mensaje[] =  "No se ingresó email<br>";
  $error=true;
}else{
  if ($_POST['email']==""){
    $mensaje[] =  "El email no puede estar vacio<br>";
    $error=true;
  }
  if (is_null($_POST['email'])){
    $mensaje[] =  "El email no puede ser nulo<br>";
    $error=true;
  }
}

if ($error==true){
  $_SESSION['mobjetivo']="misdatos";
  $_SESSION['mtipo']="alert-info";
  $_SESSION['mtexto']="<strong>!Ojo! </strong>".implode($mensaje);
  header("Location: ../view/mgmtusers.php?id=".$_POST['idusumod']);
}


  //El id se define en el if de arriba
$id=$_POST['idusumod'];
$cedula=$_POST['cedula'];
$usuario=$_POST['usuario'];
$pnombre=$_POST['pnombre'];
$snombre=$_POST['snombre'];
$papellido=$_POST['papellido'];
$sapellido=$_POST['sapellido'];
$fnacimiento=$_POST['fnacimiento'];
$email=$_POST['email'];
$calle=$_POST['calle'];
$numero=$_POST['numero'];
$esquina=$_POST['esquina'];
$cpostal=$_POST['cpostal'];
$localidad=$_POST['localidad'];
$departamento=$_POST['departamento'];
/*$tipo=$_POST['tipo'];
$rol=$_POST['rol'];*/
try {
  $conex = conectar();
  $commiteo= new Commit();
  $commiteo->AutoCommitOFF($conex);
  $commiteo->TransactionStart($conex);
  $c= new Usuario($id,$cedula,$usuario,'',$pnombre,$snombre,$papellido,$sapellido,$fnacimiento,$email,$calle,$numero,$esquina,$cpostal,$localidad,$departamento);
  if ($c->adminmodifica($conex)!= TRUE){
    $commiteo->Rollbackeo($conex);
    $_SESSION['mobjetivo']="misdatos";
    $_SESSION['mtipo']="alert-warning";
    $_SESSION['mtexto']="<strong>!Problema! </strong>No se pudo modificar los datos del usuario";
    if ($propio) {
      header('Location: ../view/mgmtusers.php?id=$id');
    } else {
      header("Location: ../view/mgmtusers.php?id=$id");
    }
  }else{
    $commiteo->Commiteo($conex);
    $_SESSION['mobjetivo']="misdatos";
    $_SESSION['mtipo']="alert-info";
    $_SESSION['mtexto']="<strong>!Cambios realizados con exito! </strong>";
    if ($propio) {
      header('Location: ../view/mgmtusers.ph?id=$id');
    } else {
      header("Location: ../view/mgmtusers.php?id=$id");
    }
  }
} catch (PDOException $e) {
  $commiteo->Rollbackeo($conex);
  $_SESSION['mobjetivo']="misdatos";
  $_SESSION['mtipo']="alert-danger";
  $_SESSION['mtexto']="<strong>!Error! </strong>".$e->getMessage();;
  if ($propio) {
    header('Location: ../view/mgmtusers.php?id=$id');
  } else {
    header("Location: ../view/mgmtusers.php?id=$id");
  }
}

?>
