<?php
require_once('../logica/funciones.php');
require_once('../clases/Compra.class.php');
require_once('../clases/Usuario.class.php');
require_once('../clases/Publicacion.class.php');

require_once('../clases/commit.class.php');
require_once('../clases/Historial.class.php');
require_once('../clases/Notificacion.class.php');
// -------- Obtener la Info ----
$idusuario = $_SESSION['id'];
$idpublicacion = $_SESSION['PubID'];
$cantidad = $_SESSION['cantidad'];
$precio = $_SESSION['precio'];
$estado = $_SESSION['estado'];
$total=$cantidad*$precio;
$config = include('../config/config.php');
$comi = $config->comisiones;
if ($estado=="NUEVO") {
	$comision=$total * $comi;
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

// ----------- PROCESO COMPRA --------------------
try {          
	$fin=true;
	$conex = conectar();
	$commiteo= new Commit();
	$commiteo->AutoCommitOFF($conex);
	$commiteo->TransactionStart($conex);
	/* VALIDAR CANTIDADES */
	$p= new Publicacion($idpublicacion);
	$consultaCantidad=$p->consultaCantidad($conex);
	if ($consultaCantidad<$cantidad) {
		$commiteo->Rollbackeo($conex);
		$fin=false;
	}else{
		/* GENERAR COMPRA */
		$c= new Compra('',$idusuario,$idpublicacion,'','','','','',$cantidad,$precio,$comision);
		if ($c->alta($conex)!== TRUE){
			$commiteo->Rollbackeo($conex);
			$fin=false;
		}else{
			/* OBTENER ID COMPRA */
			$obtenerID=$c->consultaMaxID($conex);
			$_SESSION['idcompra']=$obtenerID[0][0];
			$cantidadfinal=$consultaCantidad[0][0]-$cantidad;
			/* RESTAR CANTIDADES */
			$p= new Publicacion($idpublicacion,'','','','','','','','','','',$cantidadfinal);
			if ($p->modificarCantidad($conex)!== TRUE){
				$commiteo->Rollbackeo($conex);
				$fin=false;
			}else{
				/*SI CANTIDAD = 0 FINALIZAR PUBLICACION*/
				if ($cantidadfinal==0){
					$p= new Publicacion($idpublicacion,'','','','','','','','','CANCELADA');
					if ($p->modificarEstadoP($conex)!== TRUE){
						$commiteo->Rollbackeo($conex);
						$fin=false;
					}else{
						$commiteo->Commiteo($conex);
					}
				}else{
					$commiteo->Commiteo($conex);
				}				
			}
		}
	} 
	$commiteo->AutoCommitON($conex);
} catch (PDOException $e) {
	print "Error: ".$e->getMessage();
	exit();
}
// ----------- PROCESO NOTIFICACION --------------------
try {          
	// $idusuario -> comprador	
	// $idpublicacion -> bjeto comprado
	// $_SESSION['idcompra'] -> enlace
	$_SESSION['PubID']=$idpublicacion;
	$datos_vendedor = require_once('../logica/procesarDatosVendedor.php');
	$idvendedor=$datos_vendedor[0][0];
	
	//$conex = conectar();
	$commiteo= new Commit();
	$commiteo->AutoCommitOFF($conex);
	$commiteo->TransactionStart($conex);
	$c= new notificacion('',$idusuario,'Has comprado un articulo!',$_SESSION['idcompra'],$idpublicacion);
	if ($c->altacompra($conex)!== TRUE){
		$commiteo->Rollbackeo($conex);
		$fin=false;
	}else{
		$c= new notificacion('',$idvendedor,'Has vendido un articulo!',$_SESSION['idcompra'],$idpublicacion);
		if ($c->altaventa($conex)!== TRUE){
			$commiteo->Rollbackeo($conex);
			$fin=false;
		}else{
			if ($cantidadfinal==0){
				$c= new notificacion('',$idvendedor,'Ha finalizado un articulo!',$idpublicacion,$idpublicacion);
				if ($c->altafinalizado($conex)!== TRUE){
					$commiteo->Rollbackeo($conex);
					$fin=false;
				}else{
					$commiteo->Commiteo($conex);
//					return true;	
				}
			}else{
				$commiteo->Commiteo($conex);
//				return true;
			}
		}
	} 
	$commiteo->AutoCommitON($conex);
} catch (PDOException $e) {
	print "Error: ".$e->getMessage();
	exit();
}
// ----------- PROCESO HISTORIAL --------------------
try {          
	$conex = conectar();
	$commiteo= new Commit();
	$commiteo->AutoCommitOFF($conex);
	$commiteo->TransactionStart($conex);
	
	$h= new Historial('',$idusuario,'Alta en Compra','El usuario '.$idusuario.' generó la compra (id='.$_SESSION['idcompra'].') con la candidad de '.$cantidad.' unidades del articulo '.$idpublicacion.' por el total de '.$precio);
	if ($h->alta($conex)!== TRUE){
		$commiteo->Rollbackeo($conex);
		$fin=false;
	}else{
		if ($cantidadfinal==0){
			$h= new Historial('',$idusuario,'Publicacion Finalizada por Compra','El usuario '.$idusuario.' compro el ultimo articulo de '.$idpublicacion);
			if ($h->alta($conex)!== TRUE){
				$commiteo->Rollbackeo($conex);
				$fin=false;
			}else{
				$commiteo->Commiteo($conex);
				//return true;	
			}
		}else{
			$commiteo->Commiteo($conex);
			//return true;
		}
	} 
	$commiteo->AutoCommitON($conex);
} catch (PDOException $e) {
	print "Error: ".$e->getMessage();
	exit();
}
return $fin;
?>