<?php
$config = include('../config/config.php');
require_once('../clases/Usuario.class.php');
require_once('funciones.php');
session_start();
//Obtiene los datos ingresados
$usuario= strip_tags(trim($_POST['usuario']));
$password = strip_tags(trim($_POST['password']));
/*var_dump($config);
exit();*/
if (empty($_POST['g-recaptcha-response']) and $config->modotest==false) {
	$_SESSION['mobjetivo']="login.php";
	$_SESSION['mtipo']="alert-warning";
	$_SESSION['mtexto']="<strong>!Problema! </strong>No fue comprobado el capcha";
	header('Location: ../view/login.php');
}else{
	try {
		$conex = conectar();
		$u= new Usuario ('','',$usuario,$password);
		$datos_u=$u->coincideLoginPassword($conex);
		if (!empty($datos_u)){
			/*var_dump($datos_u);
			exit();*/
			$_SESSION["usu"]=$datos_u[0]["USUARIO"];
			$_SESSION["name"]=$datos_u[0]["PNOMBRE"];
			$_SESSION["sname"]=$datos_u[0]["PAPELLIDO"];
			$_SESSION["id"]=$datos_u[0]["ID"];
			$_SESSION["tipo"]=$datos_u[0]["TIPO"];
			$_SESSION["rol"]=$datos_u[0]["ROL"];
			header('Location: ../view/index.php');
		} else {
			$_SESSION['mobjetivo']="login.php";
			$_SESSION['mtipo']="alert-warning";
			$_SESSION['mtexto']="<strong>!Problema! </strong>El Usuario o la contraseña no son correctas";
			header('Location: ../view/login.php');
		}
		desconectar($conex);
	} catch (Exception $e) {
		$_SESSION['mobjetivo']="login.php";
		$_SESSION['mtipo']="alert-danger";
		$_SESSION['mtexto']="<strong>!Error! </strong>".$e->getMessage();
		header('Location: ../view/login.php');
	}
}
?>
