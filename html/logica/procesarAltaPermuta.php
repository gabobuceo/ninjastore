<?php
session_start();
/*var_dump($_POST);
echo "<hr>";
var_dump($_SERVER);
echo "<hr>";
var_dump($_SESSION);
echo "<hr>";
var_dump($_GET);
echo "<hr>";
exit();*/
require_once('../logica/funciones.php');
require_once('../clases/Permuta.class.php');

require_once('../clases/commit.class.php');
require_once('../clases/Historial.class.php');
require_once('../clases/Notificacion.class.php');
// -------- GET DATA ----
try {
	$fin=true;
	$conex = conectar();
	$commiteo= new Commit();
	$commiteo->AutoCommitOFF($conex);
	$commiteo->TransactionStart($conex);

	$puborigen = $_GET['idcambio'];
	$pubdestino = $_GET['id'];

	$c= new Permuta('',$puborigen,$pubdestino );
	if ($c->alta($conex)!== TRUE){
		$commiteo->Rollbackeo($conex);
		$fin=false;
	}else{
		$commiteo->Commiteo($conex);
	}
	$commiteo->AutoCommitON($conex);
} catch (PDOException $e) {
	print "Error: ".$e->getMessage();
	exit();
}

try {          
	/*Obtener ultimo*/
	$commiteo= new Commit();
	$commiteo->AutoCommitOFF($conex);
	$commiteo->TransactionStart($conex);
	$c= new Permuta();
	$obtenerID=$c->consultaMaxID($conex);
	$_SESSION['ExcID'] = $obtenerID[0][0];
	$datos_permuta = require_once('../logica/procesarCargaPermuta.php');
	unset($_SESSION['ExcID']);
	$c= new notificacion('',$datos_permuta[0]['IDORIGEN'],'Has solicitado una permuta',$datos_permuta[0]['ID'],$datos_permuta[0]['IDPUBLICACIONORIGEN']);  
	if ($c->altapermuta($conex)!== TRUE){
		$commiteo->Rollbackeo($conex);
		$fin=false;
	}else{
		$c= new notificacion('',$datos_permuta[0]['IDDESTINO'],'Te han solicitado una permuta',$datos_permuta[0]['ID'],$datos_permuta[0]['IDPUBLICACIONDESTINO']);  
		if ($c->altapermuta($conex)!== TRUE){
			$commiteo->Rollbackeo($conex);
			$fin=false;
		}else{
			$commiteo->Commiteo($conex);
		}
	}
	$commiteo->AutoCommitON($conex);

} catch (PDOException $e) {
	print "Error: ".$e->getMessage();
	exit();
}
/* RESULTADO FINAL */
if ($fin){
	header('Location: ../view/myexchanges.php?id='.$obtenerID[0][0]);
}else{
	$_SESSION['mobjetivo']="exchanges";
	$_SESSION['mtipo']="alert-warning";
	$_SESSION['mtexto']="<strong>!Problema! </strong>La respuesta no fue ingresada";
	header('Location: ../view/myexchanges.php');
}

?>
