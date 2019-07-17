<?php

require_once ('../logica/funciones.php');
require_once('../clases/Gestiona.class.php');
require_once('../clases/Denuncia.class.php');
require_once('../clases/commit.class.php');
// -------- CHECK AND GET DATA ----
//Seteados
/*var_dump($_SESSION);
exit();*/
try {          
	$conex = conectar();
	$commiteo= new Commit();
	$commiteo->AutoCommitOFF($conex);
	$commiteo->TransactionStart($conex);
	$c= new Gestiona('',$_SESSION['idbk'],$_SESSION['DenID']);
	if ($c->altaAsignacion($conex)!= TRUE){
		$commiteo->Rollbackeo($conex);
		$_SESSION['mobjetivo']="misdatos";
		$_SESSION['mtipo']="alert-warning";
		$_SESSION['mtexto']="<strong>!Problema! </strong>Error al crear la categoría";
     // header("Location: ../view/mgmtreports.php?id=".$_SESSION['idbk']);
	}else{

		$c= new Denuncia($_SESSION['DenID']);
		if ($c->altaAsignacion($conex)!= TRUE){
			$commiteo->Rollbackeo($conex);
			$_SESSION['mobjetivo']="misdatos";
			$_SESSION['mtipo']="alert-warning";
			$_SESSION['mtexto']="<strong>!Problema! </strong>Error al crear la categoría";
		}else{
			$commiteo->Commiteo($conex);
			$_SESSION['mobjetivo']="misdatos";
			$_SESSION['mtipo']="alert-info";
			$_SESSION['mtexto']="<strong>!Se creó la categoría con exito! </strong>";
		}
	}
} catch (PDOException $e) {

	$commiteo->Rollbackeo($conex);
	$_SESSION['mobjetivo']="mailactivate.php";
	$_SESSION['mtipo']="alert-danger";
	$_SESSION['mtexto']="<strong>!Error! </strong>".$e->getMessage();;
	//header('Location: ../view/mgmtreports.php?id='.$_SESSION['idbk']);
}
?>