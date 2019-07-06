<?php
session_start();
require_once('../logica/funciones.php');
require_once('../clases/Usuario.class.php');
require_once('../clases/commit.class.php');
// -------- CHECK AND GET DATA ----
//Seteados
$error=false;
if (!isset($_POST['usuario'])){
	$mensaje[] =  "No se ingresó usuario<br>";
	$error=true;
}else{
	if ($_POST['usuario']==""){
		$mensaje[] =  "El usuario no puede estar vacio<br>";
		$error=true;
	}
	if (is_null($_POST['usuario'])){
		$mensaje[] =  "El usuario no puede ser nulo<br>";
		$error=true;
	}
}
if (!isset($_POST['codigo'])){
	$mensaje[] =  "No se ingresó codigo<br>";
	$error=true;
}else{
	if ($_POST['codigo']==""){
		$mensaje[] =  "El codigo no puede estar vacio<br>";
		$error=true;
	}
	if (is_null($_POST['codigo'])){
		$mensaje[] =  "El codigo no puede ser nulo<br>";
		$error=true;
	}
}
if (!isset($_POST['g-recaptcha-response'])){
	$mensaje[] =  "No existe Captcha<br>";
	$error=true;
}else{
	if ($_POST['g-recaptcha-response']==""){
		$mensaje[] =  "No se verifico el Captcha<br>";
		$error=true;
	}
	if (is_null($_POST['g-recaptcha-response'])){
		$mensaje[] =  "El Captcha no puede ser nulo<br>";
		$error=true;
	}
}
if ($error==true){
	$_SESSION['mobjetivo']="mailactivate.php";
	$_SESSION['mtipo']="alert-info";
	$_SESSION['mtexto']="<strong>!Ojo! </strong>".implode($mensaje);
	header('Location: ../view/mailactivate.php');
}else{
	$usuario=$_POST['usuario'];
	$codigo=$_POST['codigo'];
	try {          
		$conex = conectar();
		$commiteo= new Commit();
		$commiteo->AutoCommitOFF($conex);
		$commiteo->TransactionStart($conex);
		$c= new Usuario('','',$usuario,'','','','','','','','','','','','','','','','','',$codigo);
		$datos_c=$c->BuscarUsuarioActivar($conex);
		if (empty($datos_c)){
			$commiteo->Rollbackeo($conex);
				$_SESSION['mobjetivo']="mailactivate.php";
				$_SESSION['mtipo']="alert-warning";
				$_SESSION['mtexto']="<strong>!Problema! </strong> Usuario o Código no válido";
				header('Location: ../view/mailactivate.php');
		}else{
			$c= new Usuario($datos_c[0]['ID']);
			$datos_c=$c->activarUsuario($conex);
			if (!empty($datos_c)){
				$commiteo->Commiteo($conex);
				$_SESSION['mobjetivo']="login.php";
				$_SESSION['mtipo']="alert-success";
				$_SESSION['mtexto']="<strong>!Felicidades! </strong>El usuario $usuario se ha activado con exito";
				header('Location: ../view/login.php');
			}else{
				$commiteo->Rollbackeo($conex);
				$_SESSION['mobjetivo']="mailactivate.php";
				$_SESSION['mtipo']="alert-warning";
				$_SESSION['mtexto']="<strong>!Problema! </strong>".implode($mensaje);
				header('Location: ../view/mailactivate.php');
			}			
		}
		$commiteo->AutoCommitON($conex);
	} catch (PDOException $e) {
		$commiteo->Rollbackeo($conex);
		$_SESSION['mobjetivo']="mailactivate.php";
		$_SESSION['mtipo']="alert-danger";
		$_SESSION['mtexto']="<strong>!Error! </strong>".$e->getMessage();;
		header('Location: ../view/mailactivate.php');
	}
}
?>