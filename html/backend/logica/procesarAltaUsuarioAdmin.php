<?php
session_start();
require_once('../logica/funciones.php');
require_once('../clases/Usuario.class.php');
require_once('../clases/commit.class.php');
// -------- CHECK AND GET DATA ----
//Seteados
$error=false;
if (!isset($_POST['cedula'])){
  $mensaje[] =  "No se ingresó cedula<br>";
  $error=true;
}else{
  if ($_POST['cedula']==""){
    $mensaje[] =  "Cedula no puede estar vacio<br>";
    $error=true;
  }
  if (is_null($_POST['cedula'])){
    $mensaje[] =  "Cedula no puede ser nulo<br>";
    $error=true;
  }
}
if (!isset($_POST['usuario'])){
  $mensaje[] =  "No se ingresó usuario<br>";
  $error=true;
}else{
  if ($_POST['usuario']==""){
    $mensaje[] =  "Usuario no puede estar vacio<br>";
    $error=true;
  }
  if (is_null($_POST['usuario'])){
    $mensaje[] =  "Usuario no puede ser nulo<br>";
    $error=true;
  }
}
if (!isset($_POST['password'])){
  $mensaje[] =  "No se ingresó contraseña<br>";
  $error=true;
}else{
  if ($_POST['password']==""){
    $mensaje[] =  "Contraseña no puede estar vacio<br>";
    $error=true;
  }
  if (is_null($_POST['password'])){
    $mensaje[] =  "Contraseña no puede ser nulo<br>";
    $error=true;
  }
}
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
if (!isset($_POST['snombre'])){
  $mensaje[] =  "No se ingresó segundo nombre<br>";
  $error=true;
}else{
  if ($_POST['snombre']==""){
    $mensaje[] =  "El segundo nombre no puede estar vacio<br>";
    $error=true;
  }
  if (is_null($_POST['snombre'])){
    $mensaje[] =  "El segundo nombre no puede ser nulo<br>";
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
if (!isset($_POST['sapellido'])){
  $mensaje[] =  "No se ingresó segundo apellido<br>";
  $error=true;
}else{
  if ($_POST['sapellido']==""){
    $mensaje[] =  "El segundo apellido no puede estar vacio<br>";
    $error=true;
  }
  if (is_null($_POST['sapellido'])){
    $mensaje[] =  "El segundo apellido no puede ser nulo<br>";
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
if (!isset($_POST['esquina'])){
  $mensaje[] =  "No se ingresó esquina<br>";
  $error=true;
}else{
  if ($_POST['esquina']==""){
    $mensaje[] =  "La esquina no puede estar vacio<br>";
    $error=true;
  }
  if (is_null($_POST['esquina'])){
    $mensaje[] =  "La esquina no puede ser nulo<br>";
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


if (!isset($_POST['tipo'])){
  $mensaje[] =  "No se ingresó el tipo de cuenta<br>";
  $error=true;
}else{
  if ($_POST['tipo']==""){
    $mensaje[] =  "El tipo de cuenta no puede estar vacio<br>";
    $error=true;
  }
  if (is_null($_POST['tipo'])){
    $mensaje[] =  "El tipo de cuenta no puede ser nulo<br>";
    $error=true;
  }
}
if (!isset($_POST['rol'])){
  $mensaje[] =  "No se ingresó el rol<br>";
  $error=true;
}else{
  if ($_POST['rol']==""){
    $mensaje[] =  "El rol no puede estar vacio<br>";
    $error=true;
  }
  if (is_null($_POST['rol'])){
    $mensaje[] =  "El rol no puede ser nulo<br>";
    $error=true;
  }
}
// El siguiente IF determina si este procesar esta siendo llamado por el archivo modprofile o myprofile,
// al igual que los que se encuentran antes de cada devolucion de funciones y headers
// cumple el mismo error por si hay un error, ya setea la variable POST y lo envía a

if ($error==true){
  $_SESSION['mobjetivo']="misdatos";
  $_SESSION['mtipo']="alert-info";
  $_SESSION['mtexto']="<strong>!Ojo! </strong>".implode($mensaje);
  header('Location: ../view/register.php');

}else{
  $password=$_POST['password'];
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
  $tipo=$_POST['tipo'];
  $rol=$_POST['rol'];
  try {
    $conex = conectar();
    $commiteo= new Commit();
    $commiteo->AutoCommitOFF($conex);
    $commiteo->TransactionStart($conex);
    $c= new Usuario('',$cedula,$usuario,$password,$pnombre,$snombre,$papellido,$sapellido,$fnacimiento,$email,$calle,$numero,$esquina,$cpostal,$localidad,$departamento,$tipo,'',$rol);
    if ($c->adminalta($conex)!= TRUE){
      $commiteo->Rollbackeo($conex);
      $_SESSION['mobjetivo']="misdatos";
      $_SESSION['mtipo']="alert-warning";
      $_SESSION['mtexto']="<strong>¡Error! </strong>No se pudo dar el alta del usuario";
      header('Location: ../view/register.php');
    }else{
      $commiteo->Commiteo($conex);
      $_SESSION['mobjetivo']="misdatos";
      $_SESSION['mtipo']="alert-info";
      $_SESSION['mtexto']="<strong>¡Los cambios se realizaron con exito! </strong>";
     header('Location: ../view/register.php');
    }
  } catch (PDOException $e) {
    $commiteo->Rollbackeo($conex);
    $_SESSION['mobjetivo']="misdatos";
    $_SESSION['mtipo']="alert-danger";
    $_SESSION['mtexto']="<strong>¡Error! </strong>".$e->getMessage();;
    header('Location: ../view/register.php');
  }
}
?>
