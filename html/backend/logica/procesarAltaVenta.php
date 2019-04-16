<?php

//require_once("../logica/sesiones.php");
require_once('funciones.php');
require_once('../clases/Compra.class.php');
require_once('../clases/Publicacion.class.php');
require_once('../clases/Usuario.class.php');
require_once('../clases/Usuariotel.class.php');
require_once('../clases/PublicacionImg.class.php');
require_once('../clases/commit.class.php');
$config = include('../config/config.php');
//error_reporting(1);
$debug=0;
//------------ V A L I D A C I O N E S ------------------
$error=false;    

//VALIDO PRIMER NOMBRE
if (isset($_GET['usuario']) and !empty($_GET['usuario'])){
	$idusuario = strip_tags($_GET['usuario']);
}else {
	$idusuario='';
	$error=true;
	$mensaje[] = "No se ingreso el usuario"."<br/>";      
}    
//VALIDO PRIMER APELLIDO
if (isset($_GET['publicacion']) and !empty($_GET['publicacion'])){
	$idpublicacion= strip_tags($_GET['publicacion']);
}else {
	$idpublicacion='';
	$error=true;
	$mensaje[] = "No se ingreso la publicacion"."<br/>";
}
//VALIDO USUARIO
if (isset($_GET['cantidad']) and !empty($_GET['cantidad'])){
	$cantidad = strip_tags($_GET['cantidad']);
}else {
	$cantidad='';
	$error=true;
	$mensaje[] = "No se ingreso la cantidad"."<br/>";
}
//VALIDO PASSWORD
if (isset($_GET['total']) and !empty($_GET['total'])){
	$total = strip_tags($_GET['total']);
}else {
	$total='';
	$error=true;
	$mensaje[] = "No se ingreso el total"."<br/>";
}   

//-------------F I N    V  A  L  I  D  A  C  I  O  N  E  S ---------------
// MODO DEBUG
if ($debug==1){
	$comision=(($total*1.05)-$total);
	$debugmsg ="DEBUG MODE ON <br />------------usuario = $idusuario <br />publicacion = $idpublicacion <br />cantidad = $cantidad <br />total = $total <br /> comision = $comision";
	echo $debugmsg;
	exit();
}

if ($error) {
	echo "<script>alert(\"$debugmsg\"); console.log(".$mensaje.");</script>";
}else{  
	try {          
		$conex = conectar();
		$commiteo= new Commit();
		$commiteo->AutoCommitOFF($conex);
		$commiteo->TransactionStart($conex);		
		$comision=(($total*1.05)-$total);
		$u = new Compra('',$idusuario,$idpublicacion,'','','',$cantidad,$total,$comision);
		$p = new Publicacion($idpublicacion);
		if ($u->alta($conex)!== TRUE){	
			$commiteo->Rollbackeo($conex);
			$error=1;
		}else{
			$obtenerCantidad=$p->consultaUno($conex);
			$cantactual=$obtenerCantidad[0]['CANTIDAD'];
			if ($cantactual > $cantidad){ 
				$cantidadnueva=$cantactual-$cantidad;   	
				$p = new Publicacion($idpublicacion,'','','','','','','','','','',$cantidadnueva);
				if ($p->modCantidad($conex)!== TRUE){
					$commiteo->Rollbackeo($conex);
					$error=2;
				}else{
					$commiteo->Commiteo($conex);
					$error=0;
				}
			}else{
				$p = new Publicacion($idpublicacion);
				if ($p->modCerrar($conex)!== TRUE){
					$commiteo->Rollbackeo($conex);
					$error=3;
				}else{
					$commiteo->Commiteo($conex);
					$error=0;
				}
			}
		}
		$commiteo->AutoCommitON($conex);
		if ($error>0){
			echo "Se ha producido un error $error";
		}else {
			$p = new Publicacion($idpublicacion);
			$datos_p=$p->consultaUno($conex);

			$u = new Usuario($datos_p[0]['IDUSUARIO']);
			$datos_u=$u->consultaUno($conex);
			
			$img = new PublicacionImg($idpublicacion);
			$datos_img=$img->consultaTodos($conex);
			?>
			<div class="container">
				<div class="row">
					<div class="col-md-offset-2 col-md-8 col-lg-offset-3 col-lg-6">
						<div class="profile">
							<div class="col-sm-12">
								<h2>FELICIDADES POR SU NUEVA COMPRA</h2>
								<div>
									<div class="col-sm-12">
										<div class="col-xs-12 col-sm-8">
											<h4><?php echo $datos_p[0]['TITULO']; ?></h4>
											<p><strong>Vendedor: </strong><?php echo $datos_u[0]['PNOMBRE'] . " " . $datos_u[0]['PAPELLIDO'] . " (". $datos_u[0]['USUARIO'] . ")"; ?></p>
											<p><strong>Correo Electronico: </strong> <?php echo $datos_u[0]['EMAIL']; ?> </p>
											<p><strong>Telefonos: </strong>
											<?php 
											$tt = new UsuarioTel($datos_p[0]['IDUSUARIO']);
											$datos_tt=$tt->consultaTodos($conex);
											for ($i=0; $i < count($datos_tt); $i++) { 
												echo "<span class='tags'> " . $datos_tt[$i]['TELEFONO'] . " </span>";
											}

											?>
											</p>
										</div>             
										<div class="col-xs-12 col-sm-4 text-center">
											<figure>
											<?php
												echo "<img src='".$config->staticsrv."/" . $datos_img[0]['IMAGENES']. "' class='img-circle img-responsive'>";
											?>	
											</figure>
										</div>
									</div>            
									<div class="col-xs-12 divider text-center">
										<div class="col-xs-12 col-sm-4 emphasis">
											<button class="btn btn-success btn-block">
												<span class="fa fa-plus-circle"></span> Confirmar compra 
											</button>
										</div>
										<div class="col-xs-12 col-sm-4 emphasis">
											<button class="btn btn-info btn-block">
												<span class="fa fa-user"></span> Calificar Usuario 
											</button>
										</div>
										<div class="col-xs-12 col-sm-4 emphasis">
											<button class="btn btn-info btn-block">
												<span class="fa fa-user"></span> Comentar Venta 
											</button>
										</div>
									</div>
								</div>                 
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php
		}
	} catch (PDOException $e) {
		print "Error: ".$e->getMessage();
		exit();
	}
}

?>