<?php

//require_once("../logica/sesiones.php");
require_once('funciones.php');
require_once('../clases/Usuario.class.php');
//error_reporting(1);
$debug=0;
//------------ V A L I D A C I O N E S ------------------
$error=false;    
if (empty($_POST['g-recaptcha-response'])) {
  $error=true;
  $mensaje[] = "No se confirmó el captcha"."<br/>";
}
//VALIDO PRIMER NOMBRE
if (isset($_POST['pNombre']) and !empty($_POST['pNombre'])){
  $pNombre = strip_tags($_POST['pNombre']);
}else {
  $pNombre='';
  $error=true;
  $mensaje[] = "No se ingreso el Primer Nombre"."<br/>";      
}    
//VALIDO PRIMER APELLIDO
if (isset($_POST['pApellido']) and !empty($_POST['pApellido'])){
  $pApellido= strip_tags($_POST['pApellido']);
}else {
  $pApellido='';
  $error=true;
  $mensaje[] = "No se ingreso el Primer Apellido"."<br/>";
}
//VALIDO USUARIO
if (isset($_POST['usuario']) and !empty($_POST['usuario'])){
  $usuario = strip_tags($_POST['usuario']);
}else {
  $usuario='';
  $error=true;
  $mensaje[] = "No se ingreso el usuario"."<br/>";
}
//VALIDO PASSWORD
if (isset($_POST['password']) and !empty($_POST['password'])){
  $password = strip_tags($_POST['password']);
}else {
  $password='';
  $error=true;
  $mensaje[] = "No se ingreso Password"."<br/>";
}   
if (isset($_POST['password2']) and !empty($_POST['password2'])){
  $password2 = strip_tags($_POST['password2']);
}else {
  $password2='';
  $error=true;
  $mensaje[] = "No se ingreso password2"."<br/>";
}  
if ($password!==$password2){
  $password='';
  $error=true;
  $mensaje[] = "Paswords no iguales"."<br/>";
}
//VALIDO EMAIL
if (isset($_POST['email']) and !empty($_POST['email'])){
  $email= strip_tags($_POST['email']);
}else {
  $email='';
  $error=true;
  $mensaje[] = "No se ingreso el email"."<br/>";
}
//VALIDO CI
if (isset($_POST['cedula']) and !empty($_POST['cedula'])){
  $cedula= strip_tags($_POST['cedula']);
}else {
  $cedula='';
  $error=true;
  $mensaje[] = "No se ingreso el cedula"."<br/>";
}
//VALIDO FECHA NACIMIENTO
if (isset($_POST['fNacimiento']) and !empty($_POST['fNacimiento'])){
  $fNacimiento = strip_tags($_POST['fNacimiento']);
  if (!calcularEdad($fNacimiento)) {
    $error=true;
  }
}else{
  $fNacimiento='';
  $error=true;
  $mensaje[] = "No se ingreso correctamente la fecha"."<br/>";
}

//-------------F I N    V  A  L  I  D  A  C  I  O  N  E  S ---------------
// MODO DEBUG
if ($debug==1){
  $debugmsg ="DEBUG MODE ON \\n------------\\npNombre = $pNombre \\npApellido = $pApellido \\nusuario = $usuario \\npassword = $password \\npassword2 = $password2 \\nemail = $email \\ncedula = $cedula \\nfNacimiento = $fNacimiento";
}
if ($error==true){
  session_start();
    $_SESSION['mobjetivo']="register.php";
    $_SESSION['mtipo']="alert-warning";
    $_SESSION['mtexto']="<strong>!Problema! </strong>".implode($mensaje);
    header('Location: ../view/register.php');
}else{
try {          
  $conex = conectar();			
  $u = new Usuario('',$cedula,$usuario,$password,$pNombre,'',$pApellido,'',$fNacimiento,$email);
  $ejecucionOK=$u->alta($conex);		
  if ($ejecucionOK){
    session_start();
    $_SESSION['mobjetivo']="login.php";
    $_SESSION['mtipo']="alert-success";
    $_SESSION['mtexto']="<strong>!Felicidades! </strong>El usuario $usuario se ha creado con exito. Favor entre a su correo para confirmar su usuario";
    header('Location: ../view/login.php');
  }else{
      session_start();
    $_SESSION['mobjetivo']="register.php";
    $_SESSION['mtipo']="alert-warning";
    $_SESSION['mtexto']="<strong>!Problema! </strong>No se pudo crear el usuario, comuniquese con el centro de atención al usuario";
    header('Location: ../view/register.php');
  }
  desconectar($conex);
} catch (Exception $e) {
  session_start();
    $_SESSION['mobjetivo']="register.php";
    $_SESSION['mtipo']="alert-danger";
    $_SESSION['mtexto']="<strong>!Error! </strong>".$e->getMessage();
    header('Location: ../view/register.php');
}
}
?>