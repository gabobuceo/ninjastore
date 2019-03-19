<?php
session_start();
require_once('../logica/funciones.php');
require_once('../clases/Usuario.class.php');
require_once('../clases/commit.class.php');
// -------- CHECK AND GET DATA ----
//Seteados
$error=false;

if (!isset($_POST['oldpassword'])){
  $mensaje[] =  "No se ingresó la contraseña actual<br>";
  $error=true;
}else{
  if ($_POST['oldpassword']==""){
    $mensaje[] =  "La contraseña actual no puede estar vacia<br>";
    $error=true;
  }
  if (is_null($_POST['oldpassword'])){
    $mensaje[] =  "La contraseña actual no puede ser nula<br>";
    $error=true;
  }
}

if (!isset($_POST['newpassword'])){
  $mensaje[] =  "No se ingresó la nueva contraseña<br>";
  $error=true;
}else{
  if ($_POST['newpassword']==""){
    $mensaje[] =  "La nueva contraseña no puede estar vacia<br>";
    $error=true;
  }
  if (is_null($_POST['newpassword'])){
    $mensaje[] =  "La nueva contraseña no puede ser nula<br>";
    $error=true;
  }
}

if (!isset($_POST['confirmpassword'])){
  $mensaje[] =  "No se ingresó la confirmación<br>";
  $error=true;
}else{
  if ($_POST['confirmpassword']==""){
    $mensaje[] =  "La confirmación no puede estar vacia<br>";
    $error=true;
  }
  if (is_null($_POST['confirmpassword'])){
    $mensaje[] =  "La confirmación no puede ser nula<br>";
    $error=true;
  }
}

if ($error==true){
  $_SESSION['mobjetivo']="micontraseña";
  $_SESSION['mtipo']="alert-info";
  $_SESSION['mtexto']="<strong>!Ojo! </strong>".implode($mensaje);
  header('Location: ../view/myprofile.php');
}else{

  $id=$_SESSION['id'];
  $oldpassword=$_POST['oldpassword'];
  $newpassword=$_POST['newpassword'];
  $confirmpassword=$_POST['confirmpassword'];

  if ($newpassword!=$confirmpassword) {
    $_SESSION['mobjetivo']="micontraseña";
    $_SESSION['mtipo']="alert-info";
    $_SESSION['mtexto']="<strong>!Ojo! </strong> Las contraseñas no coinciden";
    header('Location: ../view/myprofile.php');
  }  

  try {          
    $conex = conectar();
    $commiteo= new Commit();
    $commiteo->AutoCommitOFF($conex);
    $commiteo->TransactionStart($conex);
    $c= new Usuario($id,'','',$oldpassword); 
    $datos_c=$c->consultaPasswordUsuario($conex);
    /*var_dump($datos_c);
    exit();*/
    if (empty($datos_c)){
      $commiteo->Rollbackeo($conex);
      $_SESSION['mobjetivo']="micontraseña";
      $_SESSION['mtipo']="alert-warning";
      $_SESSION['mtexto']="<strong>!Problema! </strong>Contraseña actual incorrecta";
      header('Location: ../view/myprofile.php');
    }else{ /**/
      $c= new Usuario($id,'','',$newpassword); 
      if ($c->CambiarPasswordUsuario($conex)!= TRUE){
        $commiteo->Rollbackeo($conex);
        $_SESSION['mobjetivo']="micontraseña";
        $_SESSION['mtipo']="alert-warning";
        $_SESSION['mtexto']="<strong>!Problema! </strong>No se pudo modificar los datos del usuario";
        header('Location: ../view/myprofile.php');
      }else{
        $commiteo->Commiteo($conex);
        $_SESSION['mobjetivo']="micontraseña";
        $_SESSION['mtipo']="alert-info";
        $_SESSION['mtexto']="<strong>!Cambios realizados con exito! </strong>";
        header('Location: ../view/myprofile.php');
      }
    }
  } catch (PDOException $e) {
    $commiteo->Rollbackeo($conex);
    $_SESSION['mobjetivo']="micontraseña";
    $_SESSION['mtipo']="alert-danger";
    $_SESSION['mtexto']="<strong>!Error! </strong>".$e->getMessage();;
    header('Location: ../view/myprofile.php');
  }
}
?>