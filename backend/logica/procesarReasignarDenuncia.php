<?php
session_start();
$idgestion=$_POST['idgestion'];
$iddenuncia=$_POST['iddenuncia'];
$idadmin=$_POST['idadmin'];
require_once ('../logica/funciones.php');
require_once('../clases/Gestiona.class.php');
require_once('../clases/commit.class.php');
// -------- CHECK AND GET DATA ----
//Seteados

try {          
	$conex = conectar();
	$commiteo= new Commit();
	$commiteo->AutoCommitOFF($conex);
	$commiteo->TransactionStart($conex);
	$c= new Gestiona($idgestion,$idadmin,$iddenuncia);
	if ($c->altaReasignacion($conex)!= TRUE){
		$commiteo->Rollbackeo($conex);
		$_SESSION['mobjetivo']="misdatos";
		$_SESSION['mtipo']="alert-warning";
		$_SESSION['mtexto']="<strong>!Problema! </strong>Error al crear la categoría";
		header("Location: ../view/mgmtreports.php?id=".$iddenuncia);	
	}else{
		$commiteo->Commiteo($conex);
		$commiteo->AutoCommitON($conex);
		$_SESSION['mobjetivo']="misdatos";
		$_SESSION['mtipo']="alert-info";
		$_SESSION['mtexto']="<strong>!Se creó la categoría con exito! </strong>";
		header("Location: ../view/mgmtreports.php?id=".$iddenuncia);	
	}
} catch (PDOException $e) {
	$commiteo->Rollbackeo($conex);
	$_SESSION['mobjetivo']="mailactivate.php";
	$_SESSION['mtipo']="alert-danger";
	$_SESSION['mtexto']="<strong>!Error! </strong>".$e->getMessage();;
	header('Location: ../view/mgmtreports.php?id='.$iddenuncia);
}
?>