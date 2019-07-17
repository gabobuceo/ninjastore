<?php
session_start();
require_once ('../logica/funciones.php');
require_once('../clases/Usuariotel.class.php');
require_once('../clases/commit.class.php');
// -------- CHECK AND GET DATA ----
//Seteados
$error=false;
if (!isset($_POST['listphones'])){
	$mensaje[] =  "No se seleccionó telefono<br>";
	$error=true;
}else{
	if ($_POST['listphones']==""){
		$mensaje[] =  "El telefono no puede estar vacio<br>";
		$error=true;
	}
	if (is_null($_POST['listphones'])){
		$mensaje[] =  "El telefono no puede ser nulo<br>";
		$error=true;
	}
}
if ($error==true){
	$_SESSION['mobjetivo']="mitelefono";
	$_SESSION['mtipo']="alert-info";
	$_SESSION['mtexto']="<strong>!Ojo! </strong>".implode($mensaje);
	header('Location: ../view/myprofile.php');
}else{
// -------- GET DATA ----
	$idusuario = $_POST['idusumod'];
	$listphones = $_POST['listphones'];
	try {          
    $conex = conectar();
    $commiteo= new Commit();
    $commiteo->AutoCommitOFF($conex);
    $commiteo->TransactionStart($conex);
    $c= new UsuarioTel($idusuario,$listphones); 
      if ($c->baja($conex)!= TRUE){
        $commiteo->Rollbackeo($conex);
        $_SESSION['mobjetivo']="mitelefono";
        $_SESSION['mtipo']="alert-warning";
        $_SESSION['mtexto']="<strong>!Problema! </strong>No se pudo borrar el telefono";
        header('Location: ../view/mgmtusers.php?id='.$idusuario);
      }else{
        $commiteo->Commiteo($conex);
        $_SESSION['mobjetivo']="mitelefono";
        $_SESSION['mtipo']="alert-info";
        $_SESSION['mtexto']="<strong>!Telefono borrado! </strong>";
        header('Location: ../view/mgmtusers.php?id='.$idusuario);
      }
    
  } catch (PDOException $e) {
    $commiteo->Rollbackeo($conex);
    $_SESSION['mobjetivo']="mitelefono";
    $_SESSION['mtipo']="alert-danger";
    $_SESSION['mtexto']="<strong>!Error! </strong>".$e->getMessage();;
    header('Location: ../view/mgmtusers.php?id='.$idusuario);
  }
}
?>