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

if (!isset($_POST['calle'])){
  $mensaje[] =  "No se ingresó la calle<br>";
  $error=true;
}else{
  if ($_POST['calle']==""){
    $mensaje[] =  "La calle no puede estar vacia<br>";
    $error=true;
  }
  if (is_null($_POST['calle'])){
    $mensaje[] =  "La calle no puede ser nula<br>";
    $error=true;
  }
}

if (!isset($_POST['numero'])){
  $mensaje[] =  "No se ingresó numero<br>";
  $error=true;
}else{
  if ($_POST['numero']==""){
    $mensaje[] =  "El numero no puede estar vacio<br>";
    $error=true;
  }
  if (is_null($_POST['numero'])){
    $mensaje[] =  "El numero no puede ser nulo<br>";
    $error=true;
  }
}

if (!isset($_POST['cpostal'])){
  $mensaje[] =  "No se ingresó cpostal<br>";
  $error=true;
}else{
  if ($_POST['cpostal']==""){
    $mensaje[] =  "El cpostal no puede estar vacio<br>";
    $error=true;
  }
  if (is_null($_POST['cpostal'])){
    $mensaje[] =  "El cpostal no puede ser nulo<br>";
    $error=true;
  }
}

if (!isset($_POST['localidad'])){
  $mensaje[] =  "No se ingresó la localidad<br>";
  $error=true;
}else{
  if ($_POST['localidad']==""){
    $mensaje[] =  "La localidad no puede estar vacia<br>";
    $error=true;
  }
  if (is_null($_POST['localidad'])){
    $mensaje[] =  "La localidad no puede ser nula<br>";
    $error=true;
  }
}

if (!isset($_POST['departamento'])){
  $mensaje[] =  "No se ingresó departamento<br>";
  $error=true;
}else{
  if ($_POST['departamento']==""){
    $mensaje[] =  "El departamento no puede estar vacio<br>";
    $error=true;
  }
  if (is_null($_POST['departamento'])){
    $mensaje[] =  "El departamento no puede ser nulo<br>";
    $error=true;
  }
}

if ($error==true){
  $_SESSION['mobjetivo']="misdatos";
  $_SESSION['mtipo']="alert-info";
  $_SESSION['mtexto']="<strong>!Ojo! </strong>".implode($mensaje);
  header('Location: ../view/myprofile.php');
}else{
  $id=$_SESSION['id'];
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
  try {          
    $conex = conectar();
    $commiteo= new Commit();
    $commiteo->AutoCommitOFF($conex);
    $commiteo->TransactionStart($conex);
    $c= new Usuario($id,'','','',$pnombre,$snombre,$papellido,$sapellido,$fnacimiento,$email,$calle,$numero,$esquina,$cpostal,$localidad,$departamento);
    if ($c->modificacion($conex)!= TRUE){
      $commiteo->Rollbackeo($conex);
      $_SESSION['mobjetivo']="misdatos";
      $_SESSION['mtipo']="alert-warning";
      $_SESSION['mtexto']="<strong>!Problema! </strong>No se pudo modificar los datos del usuario";
      header('Location: ../view/myprofile.php');
    }else{
      $commiteo->Commiteo($conex);
      $_SESSION['mobjetivo']="misdatos";
      $_SESSION['mtipo']="alert-info";
      $_SESSION['mtexto']="<strong>!Cambios realizados con exito! </strong>";
      header('Location: ../view/myprofile.php');
    }
  } catch (PDOException $e) {
    $commiteo->Rollbackeo($conex);
    $_SESSION['mobjetivo']="misdatos";
    $_SESSION['mtipo']="alert-danger";
    $_SESSION['mtexto']="<strong>!Error! </strong>".$e->getMessage();;
    header('Location: ../view/myprofile.php');
  }
}
?>