<?php
require_once('../logica/funciones.php');
require_once('../clases/Compra.class.php');
require_once('../clases/commit.class.php');
// -------- Obtener la Info ----
$idusuario = $_SESSION['id'];
$idpublicacion = $_SESSION['PubID'];
$cantidad = $_SESSION['cantidad'];
$precio = $_SESSION['precio'];
$estado = $_SESSION['estado'];
$total=$cantidad*$precio;
if ($estado=="NUEVO") {
	$comision=$total * 0.05;
} else {
	$comision=0;
}
// ----------- DEBUG -----------------

/*var_dump($idusuario);
echo "<br>";
var_dump($idpublicacion);
echo "<br>";
var_dump($cantidad);
echo "<br>";
var_dump($precio);
echo "<br>";
var_dump($estado);
echo "<br>";
var_dump($total);
echo "<br>";
var_dump($comision);
exit();*/

// ----------- VALIDACIONES ------------------

// ----------- EJECUCIONES --------------------
try {          
	$conex = conectar();
	$commiteo= new Commit();
	$commiteo->AutoCommitOFF($conex);
	$commiteo->TransactionStart($conex);
	$c= new Compra('',$idusuario,$idpublicacion,'','','',$cantidad,$precio,$comision);
	if ($c->alta($conex)!== TRUE){
		$commiteo->Rollbackeo($conex);
		return false;
	}else{
		$obtenerID=$c->consultaMaxID($conex);
		$_SESSION['idcompra']=$obtenerID[0][0];
		$commiteo->Commiteo($conex);
		return true;
	}
	$commiteo->AutoCommitON($conex);
} catch (PDOException $e) {
	print "Error: ".$e->getMessage();
	exit();
}
?>