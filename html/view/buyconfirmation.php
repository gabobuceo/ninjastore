<?php 
if (!isset($_GET['id'])){
	header('Location: ../view/index.php');
}
require('definitions.php');
/*-----------------------------------------------------------------------------------------------------------*/
/* Agregar todo script, puntual para esta pagina.*/
/*-----------------------------------------------------------------------------------------------------------*/
$_SESSION['ComID']=$_GET['id'];
$datos_compra = require_once('../logica/procesarCargaCompra.php');
var_dump($datos_compra);
$_SESSION['IDVENDEDOR']=$datos_compra[0]['IDVENDEDOR'];
$_SESSION['IDCOMPRADOR']=$datos_compra[0]['IDCOMPRADOR'];
$datos_telefono = require_once('../logica/procesarCargaTelefonos.php');
//var_dump($datos_telefono);
$datos_chat = require_once('../logica/procesarCargaTelefonos.php');
var_dump($datos_chat); /*
echo "<hr>";
var_dump($_GET);
echo "<hr>";
var_dump($_POST);
echo "<hr>";
var_dump($_SERVER);
echo "<hr>";
var_dump($_SERVER);
echo "<hr>";

var_dump($datos_compra);*/
$nombrecompleto = $datos_compra[0]['PNOMBRE'];
if (is_null($datos_compra[0]['SNOMBRE'])){
	$nombrecompleto = $nombrecompleto." ".$datos_compra[0]['SNOMBRE'];
}
$nombrecompleto = $nombrecompleto." ".$datos_compra[0]['PAPELLIDO'];
if (is_null($datos_compra[0]['SAPELLIDO'])){
	$nombrecompleto = $nombrecompleto." ".$datos_compra[0]['SAPELLIDO'];
}
?>
<script>
	function myNavFunc(){
		if( (navigator.platform.indexOf("iPhone") != -1) 
			|| (navigator.platform.indexOf("iPod") != -1)
			|| (navigator.platform.indexOf("iPad") != -1))
			window.open("maps://maps.google.com/maps?daddr=<?php echo $datos_compra[0]['GEOX']?>,<?php echo $datos_compra[0]['GEOY']?>&amp;ll=");
		else
			window.open("http://maps.google.com/maps?daddr=<?php echo $datos_compra[0]['GEOX']?>,<?php echo $datos_compra[0]['GEOY']?>&amp;ll=");
	}
</script>
<?php 
/*-----------------------------------------------------------------------------------------------------------*/
/* Fin scripts de esta pagina.*/
require('header.php');
/*-----------------------------------------------------------------------------------------------------------*/
/* Agregar todo el contenido de esta pagina aqui.*/
/*------------------------------------------           -----------------------------------------------------------------*/
?>
<!-- ::::::::::::::  LOGIN  :::::::::::::: -->
<section>
	<div id="page-wrapper" class="sign-in-wrapper">
		<div class="graphs">
			<div class="sign-in-form">
				<div class="sign-in-form-top">
					<h1>Felicidades su compra se ha generado</h1>
				</div>
				<div class="signin">
					<div class="buyingdata">
						<h4>Datos de la Compra</h4>
						<div class="row">
							<div class="col-xs-12">
								<p><b>Producto: </b> <?php echo $datos_compra[0]['TITULO']?></p>
								<p><b>Cantidad: </b> <?php echo $datos_compra[0]['CANTIDAD']?> unidad/es</p>
								<p><b>Total: $</b><?php echo $datos_compra[0]['TOTAL']?></p>
							</div>
						</div>
					</div>			
					<div class="buyingdata">
						<h4>Datos del Vendedor</h4>
						<div class="row">
							<div class="col-xs-12">
								<p><b>Nombre Completo: </b><?php echo $nombrecompleto?></p>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12">
								<p><b>Email: </b><a href="mailto:<?php echo $datos_compra[0]['EMAIL']?>"><?php echo $datos_compra[0]['EMAIL']?></a></p>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12">
								<p><b>Dirección: </b><?php echo $datos_compra[0]['CALLE']?> <?php echo $datos_compra[0]['NUMERO']?></p>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12">
								<p><b>Esquina: </b><?php echo $datos_compra[0]['ESQUINA']?></p>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12">
								<p><b>Localidad: </b><?php echo $datos_compra[0]['LOCALIDAD']?>, <?php echo $datos_compra[0]['DEPARTAMENTO']?>. CP: <?php echo $datos_compra[0]['CPOSTAL']?></p>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12">
								<p><b>Telefonos: </b>
									<?php for ($i=0; $i < count($datos_telefono); $i++) { 
										?>
										<a href="tel:<?php echo $datos_telefono[$i]['TELEFONO']?>"><?php echo $datos_telefono[$i]['TELEFONO']?></a> 
										<?php
										if ($i < count($datos_telefono)-1) {
											?> | <?php
										}
									}
									?>
								</p>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12">
								<p><b>Ubicación: </b><a onclick="myNavFunc()"><i class="fa fa-location-arrow" aria-hidden="true"></i> Llevarme ahi</a></p>
							</div>
						</div>
					</div>
					<h4>Chat de Venta</h4>
					<div class="product-mesages">
						<div class="chat_window">
							<ul class="messages">
								<?php
								if (is_array($datos_chat)) {
									for ($i=0; $i < count($datos_chat); $i++) { 
										?>
										<li class="message left appeared">
											<div class="text_wrapper">
												<div class="text"><?php echo $datos_chat[$i]['MENSAJE']; ?></div>
												<p><i class="fa fa-flag" aria-hidden="true"></i><a href="report.php?id=<?php echo $datos_chat[$i]['ID']; ?>"> denunciar </a>| creado el <?php echo $datos_chat[$i]['FECHAM']; ?>, Pregunta: <?php echo $datos_chat[$i]['ID']; ?></p>
											</div>
										</li>
										<?php
										if (!empty($datos_chat[$i]['RESPUESTA'])) {
											?>
											<li class="message right appeared">
												<div class="text_wrapper">
													<div class="text"><?php echo $datos_chat[$i]['RESPUESTA']; ?></div>
													<p><i class="fa fa-flag" aria-hidden="true"></i><a href="report.php?id=<?php echo $datos_chat[$i]['ID']; ?>"> denunciar </a>| creado el <?php echo $datos_chat[$i]['FECHAR']; ?>, Pregunta: <?php echo $datos_chat[$i]['ID']; ?></p>
												</div>
											</li>
											<?php
										}
									}
								}else{
									?>
									<p>No se realizaron preguntas</p>
									<?php
								}
								?>
							</ul>
							<!--
							<div class="bottom_wrapper clearfix">
								<div class="message_input_wrapper">
									<input class="message_input" placeholder="Pregunta algo..." />
								</div>
								<div class="send_message">
									<div class="icon">
									</div>
									<div class="text">
									Enviar</div>
								</div>
							</div>
						-->
						</div>
					</div>
					<div class="buyingdata">
						<h4>Datos de la venta</h4>
						<div class="row">
							<div class="col-xs-6 text-center">
								<p><b>Estado de la venta</b></p>
								<p><i class="fa fa-times-circle-o" style="color: var(--Terciario);" aria-hidden="true"></i> No confirmada</p>
							</div>
							<div class="col-xs-6 text-center">
								<p><b>Calificacion de la venta</b></p>
								<p>No calificada</p>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-6 text-center">
								<p><b>Estado de la venta</b></p>
								<p><i class="fa fa-check-circle-o" style="color: var(--Principal);" aria-hidden="true"></i> Confirmada</p>
							</div>
							<div class="col-xs-6 text-center">
								<p><b>Calificacion de la venta</b></p>
								<p>No calificada</p>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-6 text-center">
								<p><b>Estado de la venta</b></p>
								<p><i class="fa fa-check-circle-o" style="color: var(--Principal);" aria-hidden="true"></i> Confirmada</p>
							</div>
							<div class="col-xs-6 text-center">
								<p><b>Calificacion de la venta</b></p>
								<p>
									<i class="fa fa-star" style="color: var(--Principal);" aria-hidden="true"></i>
									<i class="fa fa-star" style="color: var(--Principal);" aria-hidden="true"></i>
									<i class="fa fa-star-half-o" style="color: var(--Secundario);" aria-hidden="true"></i>
									<i class="fa fa-star-o" style="color: var(--Terciario);" aria-hidden="true"></i>
									<i class="fa fa-star-o" style="color: var(--Terciario);" aria-hidden="true"></i>
								</p>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12">
								<form action="buyconfirmation.php?conf=yes" method="GET">						
									<input type="submit" value="Confirmar venta">
								</form>	
							</div> 
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- ::::::::::::::  FIN LOGIN  :::::::::::::: -->
<!--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAR1MVvIOfmAGOlAqC1WnJ6f-G6Irn-cEc&callback=myMap"></script> -->
<?php 
/*-----------------------------------------------------------------------------------------------------------*/
/* Fin contenido de esta pagina.*/
/*-----------------------------------------------------------------------------------------------------------*/
require('footer.php');
?>