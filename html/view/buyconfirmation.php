<?php 
if (!isset($_GET['id'])){
	header('Location: ../view/index.php');
}
if (!isset($_SESSION['id'])){
	header('Location: ../view/index.php');
}
require('definitions.php');
/*-----------------------------------------------------------------------------------------------------------*/
/* Agregar todo script, puntual para esta pagina.*/
/*-----------------------------------------------------------------------------------------------------------*/
$_SESSION['ComID']=$_GET['id'];
$datos_compra = require_once('../logica/procesarCargaCompra.php');
$_SESSION['IDVENDEDOR']=$datos_compra[0]['IDVENDEDOR'];
$_SESSION['IDCOMPRADOR']=$datos_compra[0]['IDCOMPRADOR'];
$datos_telefono = require_once('../logica/procesarCargaTelefonos.php');
$_SESSION['IDPUBLICACION']=$datos_compra[0]['IDPUBLICACION'];
$datos_chat = require_once('../logica/procesarCargaChatCompra.php');
/*var_dump($datos_compra);*/
/* UNSETEO */
unset($_SESSION['ComID']);
unset($_SESSION['IDVENDEDOR']);
unset($_SESSION['IDCOMPRADOR']);
unset($_SESSION['IDPUBLICACION']);
/*-----------------------------------------------------------------------------------------------------------*/

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
<script>
	jQuery(document).ready(function($){
		$(".btnrating").on('click',(function(e) {
			var previous_value = $("#selected_rating").val();
			var selected_value = $(this).attr("data-attr");
			$("#selected_rating").val(selected_value);
			$(".selected-rating").empty();
			$(".selected-rating").html(selected_value);
			for (i = 1; i <= selected_value; ++i) {
				$("#rating-star-"+i).toggleClass('btn-warning');
				$("#rating-star-"+i).toggleClass('btn-default');
			}
			for (ix = 1; ix <= previous_value; ++ix) {
				$("#rating-star-"+ix).toggleClass('btn-warning');
				$("#rating-star-"+ix).toggleClass('btn-default');
			}
		}));
		$("#rating-star-3").click();
	});
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
					<h1>
						Comprobante compra / venta / permuta
						<button name="idcompra" class="btn btn-xg btn-default" onclick="window.print();">
							<i class="fa fa-print"></i>
						</button>
						<?php
						if (isset($_SESSION['mobjetivo']) && $_SESSION['mobjetivo']=="buyconfirmation.php"){
							echo "<div class='alert ".$_SESSION['mtipo']." alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert'>&times;</button>".$_SESSION['mtexto']."</div>";
							unset($_SESSION['mobjetivo']);
							unset($_SESSION['mtipo']);
							unset($_SESSION['mtexto']);	
							unset($_SESSION['debugeame']);				
						}
						?>
					</h1>
				</div>
				<div class="signin">
					<div class="buyingdata">
						<h4 style="float: left;">Datos de la Compra</h4><h4 style="float: right; text-align: right;"><a data-toggle="modal" data-target="#DenunciaCompraModal" href="javascript:void(0)">Denunciar Compra</a></h4> 
						<div class="row">
							<div class="col-xs-12">
								<p><b>Producto: </b> <?php echo utf8_encode($datos_compra[0]['TITULO'])?></p>
								<p><b>Precio unitario: $</b><?php echo $datos_compra[0]['TOTAL']?></p>
								<p><b>Cantidad: </b> <?php echo $datos_compra[0]['CANTIDAD']?> unidad/es</p>
								<p><b>Total: $</b><?php echo $datos_compra[0]['TOTAL'] * $datos_compra[0]['CANTIDAD']?></p>
							</div>
						</div>
					</div>			
					<div class="buyingdata">
						<h4 style="float: left;">Datos del Vendedor</h4><h4 style="float: right; text-align: right;"><a data-toggle="modal" data-target="#DenunciaVendedorModal" href="javascript:void(0)">Denunciar Vendedor</a></h4> 
						<div class="row">
							<div class="col-xs-12">
								<p><b>Nombre Completo: </b><?php echo utf8_encode($nombrecompleto) ?></p>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12">
								<p><b>Email: </b><a href="mailto:<?php echo $datos_compra[0]['EMAIL']?>"><?php echo $datos_compra[0]['EMAIL']?></a></p>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12">
								<p><b>Dirección: </b><?php echo $datos_compra[0]['CALLE']?> <?php echo utf8_encode($datos_compra[0]['NUMERO'])?></p>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12">
								<p><b>Esquina: </b><?php echo utf8_encode($datos_compra[0]['ESQUINA'])?></p>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12">
								<p><b>Localidad: </b><?php echo utf8_encode($datos_compra[0]['LOCALIDAD'])?>, <?php echo utf8_encode($datos_compra[0]['DEPARTAMENTO'])?>. CP: <?php echo $datos_compra[0]['CPOSTAL']?></p>
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
					<div class="buyingdata">
						<h4 style="float: left;">Datos del Comprador</h4><h4 style="float: right; text-align: right;"><a data-toggle="modal" data-target="#DenunciaCompradorModal" href="javascript:void(0)">Denunciar Vendedor</a></h4>
						<div class="row">
							<div class="col-xs-12">
								<p><b>Nombre Completo: </b><?php echo utf8_encode($datos_compra[0]['PNOMBRECOMPRADOR'].' '.$datos_compra[0]['PAPELLIDOCOMPRADOR']) ?></p>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12">
								<p><b>Email: </b><a href="mailto:<?php echo $datos_compra[0]['EMAILCOMPRADOR']?>"><?php echo $datos_compra[0]['EMAILCOMPRADOR']?></a></p>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12">
								<p><b>Cedula: </b><?php echo $datos_compra[0]['CEDULACOMPRADOR']?></p>
							</div>
						</div>
					</div>	
					<h4>Chat de Venta</h4>
					<div class="product-mesages">
						<div class="chat_window">
							<ul class="messages">
								<?php
								if (!isset($datos_chat['this'])) {
									for ($i=0; $i < count($datos_chat); $i++) { 
										?>
										<li class="message left appeared">
											<div class="text_wrapper">
												<div class="text"><?php echo utf8_encode($datos_chat[$i]['USUCOMPRADOR'].': '.$datos_chat[$i]['MENSAJE']); ?></div>
												<p><i class="fa fa-flag" aria-hidden="true"></i><a href="report.php?id=<?php echo $datos_chat[$i]['ID']; ?>"> denunciar </a>| creado el <?php echo date("d/m/Y H:i", strtotime($datos_chat[$i]['FECHAM'])); ?></p>
											</div>
										</li>
										<?php
										if (!empty($datos_chat[$i]['RESPUESTA'])) {
											?>
											<li class="message right appeared">
												<div class="text_wrapper">
													<div class="text"><?php echo utf8_encode($datos_chat[$i]['USUVENDEDOR'].': '.$datos_chat[$i]['RESPUESTA']); ?></div>
													<p><i class="fa fa-flag" aria-hidden="true"></i><a href="report.php?id=<?php echo $datos_chat[$i]['ID']; ?>"> denunciar </a>| creado el <?php echo date("d/m/Y H:i", strtotime($datos_chat[$i]['FECHAR'])); ?></p>
												</div>
											</li>
											<?php
										}
										?>
										<?php
									}
								}else{
									?>
									<p>No se realizaron preguntas</p>
									<?php
								}
								?>
							</ul>
						</div>
					</div>
					<div class="buyingdata">
						<h4>Datos de la venta</h4>
						<div class="row">
							<div class="col-xs-12">
								<div class="row">
									<div class="col-xs-6 text-center">
										<p><b>Venta confirmada?: </b></p>
										<?php
										if ( $datos_compra[0]['VENTACONCRETA'] == 0) {
											?>
											<p><i class="fa fa-times-circle-o" style="color: var(--Terciario);" aria-hidden="true"></i> No confirmada</p>
											<?php 
										}else{
											?>
											<p><i class="fa fa-check-circle-o" style="color: var(--Principal);" aria-hidden="true"></i> Confirmada</p>
											<?php
										}
										?>
									</div>
									<div class="col-xs-6 text-center">
										<p><b>Compra confirmada?: </b></p>
										<?php
										if ( $datos_compra[0]['COMPRACONCRETA'] == 0) {
											?>
											<p><i class="fa fa-times-circle-o" style="color: var(--Terciario);" aria-hidden="true"></i> No confirmada</p>
											<?php 
										}else{
											?>
											<p><i class="fa fa-check-circle-o" style="color: var(--Principal);" aria-hidden="true"></i> Confirmada</p>
											<?php
										}
										?>
									</div>
								</div>
							</div>
							<div class="col-xs-12">
								<div class="row">
									<div class="col-xs-6 text-center">
										<p><b>Calificacion del vendedor: </b></p>
										<?php
										if ( $datos_compra[0]['IDCALVENDEDOR'] == 0) {
											?>
											<p><i class="fa fa-times-circle-o" style="color: var(--Terciario);" aria-hidden="true"></i> No calificada</p>
											<?php 
										}else{
											for ($i=1; $i < 6; $i++) { 
												if ($i <= $datos_compra[0]['CALVENDEDOR']) {
													echo "<i class='fa fa-star' style='color: var(--Principal);' aria-hidden='true'></i>";
												}else{
													echo "<i class='fa fa-star-o' style='color: var(--Principal);' aria-hidden='true'></i>";
												}
												
												
											}
										}
										?>
									</div>
									<div class="col-xs-6 text-center">
										<p><b>Calificacion del comprador: </b></p>
										<?php
										if ( $datos_compra[0]['IDCALCOMPRADOR'] == 0) {
											?>
											<p><i class="fa fa-times-circle-o" style="color: var(--Terciario);" aria-hidden="true"></i> No calificada</p>
											<?php 
										}else{
											for ($i=1; $i < 6; $i++) { 
												if ($i <= $datos_compra[0]['CALCOMPRADOR']) {
													echo "<i class='fa fa-star' style='color: var(--Principal);' aria-hidden='true'></i>";
												}else{
													echo "<i class='fa fa-star-o' style='color: var(--Principal);' aria-hidden='true'></i>";
												}
												
												
											}
										}
										?>
									</div>
								</div>
							</div>
							<div class="col-xs-12">
								<?php
								if ( $_SESSION['id'] == $datos_compra[0]['IDCOMPRADOR'] ) {
									if ( $datos_compra[0]['COMPRACONCRETA'] == 0) {
										?>
										<form action="../logica/procesarConfirmarCompra.php?" method="GET">
											<button name="idcompra" type="submit" class="btn btn-lg btn-success" value="<?php echo $datos_compra[0]['ID']; ?>">
												<i class="fa fa-thumbs-up"></i> Confirmar compra
											</button>
										</form>	
										<?php
									}elseif ( is_null($datos_compra[0]['IDCALCOMPRADOR']) ) {									
										?>
										<form action="../logica/procesarAltaCalificacion.php" style="text-align: center;" method="POST">
											<div class="form-group" id="rating-ability-wrapper">
												<label class="control-label" for="rating">
													<span class="field-label-header">Cómo calificaria usted al vendedor?</span><br>
													<span class="field-label-info"></span>
													<input type="hidden" id="selected_rating" name="selected_rating" value="" required="required">
												</label>
												<h2 class="bold rating-header" style="">
													<span class="selected-rating">0</span><small> / 5</small>
												</h2>
												<button type="button" class="btnrating btn btn-default btn-lg " data-attr="1" id="rating-star-1">
													<i class="fa fa-star" aria-hidden="true"></i>
												</button>
												<button type="button" class="btnrating btn btn-default btn-lg" data-attr="2" id="rating-star-2">
													<i class="fa fa-star" aria-hidden="true"></i>
												</button>
												<button type="button" class="btnrating btn btn-default btn-lg" data-attr="3" id="rating-star-3">
													<i class="fa fa-star" aria-hidden="true"></i>
												</button>
												<button type="button" class="btnrating btn btn-default btn-lg" data-attr="4" id="rating-star-4">
													<i class="fa fa-star" aria-hidden="true"></i>
												</button>
												<button type="button" class="btnrating btn btn-default btn-lg" data-attr="5" id="rating-star-5">
													<i class="fa fa-star" aria-hidden="true"></i>
												</button>
												<div class="form-group">
													<label for="comment">Comentario:</label>
													<textarea class="form-control" rows="5" name="comentario"></textarea>
												</div>
												<button name="idcompra" type="submit" class="btn btn-lg btn-success" value="<?php echo $datos_compra[0]['ID']; ?>">
													<i class="fa fa-thumbs-up"></i> Calificar compra
												</button>
											</div>
										</form>	
										<?php
									}else{
										if ((($_SESSION['id'] == $datos_compra[0]['IDCOMPRADOR'] ) || ( $_SESSION['id'] == $datos_compra[0]['IDVENDEDOR'])) && ((!is_null($datos_compra[0]['IDCALCOMPRADOR'])) && (!is_null($datos_compra[0]['IDCALVENDEDOR'])))){
											?>
											<div class="col-xs-12">
												<h4>Comentarios de la Compra / Venta / Permuta</h4>
												<div class="product-mesages">
													<div class="chat_window">
														<ul class="messages">
															<li class="message left appeared">
																<div class="text_wrapper">
																	<div class="text"><?php echo utf8_encode('Vendedor: '.$datos_compra[0]['MENSAJECALVENDEDOR']); ?></div>
																	<p><i class="fa fa-flag" aria-hidden="true"></i><a href="report.php?id=<?php echo $datos_compra[0]['ID']; ?>"> denunciar </a>| creado el <?php echo date("d/m/Y H:i", strtotime($datos_compra[0]['FECHACALVENDEDOR'])); ?></p>
																</div>
															</li>
															<li class="message right appeared">
																<div class="text_wrapper">
																	<div class="text"><?php echo utf8_encode('Comprador: '.$datos_compra[0]['MENSAJECALCOMPRADOR']); ?></div>
																	<p><i class="fa fa-flag" aria-hidden="true"></i><a href="report.php?id=<?php echo $datos_compra[0]['ID']; ?>"> denunciar </a>| creado el <?php echo date("d/m/Y H:i", strtotime($datos_compra[0]['FECHACALCOMPRADOR'])); ?></p>
																</div>
															</li>

														</ul>
													</div>
												</div>
											</div>
											<?php 
										}
										?>
										<div class="col-xs-12">
											<form action="../view/mybuys.php" method="POST">
												<button class="btn btn-lg" type="submit" >
													<i class="fa fa-external-link"></i> Ir a Mis Compras
												</button>
											</form>		
										</div>
										<?php
									}
								}elseif ( $_SESSION['id'] == $datos_compra[0]['IDVENDEDOR'] ){
									if ( $datos_compra[0]['VENTACONCRETA'] == 0) {
										?>
										<form action="../logica/procesarConfirmarVenta.php?" method="GET">
											<button name="idcompra" type="submit" class="btn btn-lg btn-success" value="<?php echo $datos_compra[0]['ID']; ?>">
												<i class="fa fa-thumbs-up"></i> Confirmar venta
											</button>
										</form>	
										<?php
									}elseif ( is_null($datos_compra[0]['IDCALVENDEDOR']) ) {
										?>
										<form action="../logica/procesarAltaCalificacion.php" style="text-align: center;" method="POST">
											<div class="form-group" id="rating-ability-wrapper">
												<label class="control-label" for="rating">
													<span class="field-label-header">Cómo calificaria usted al comprador?</span><br>
													<span class="field-label-info"></span>
													<input type="hidden" id="selected_rating" name="selected_rating" value="" required="required">
												</label>
												<h2 class="bold rating-header" style="">
													<span class="selected-rating">0</span><small> / 5</small>
												</h2>
												<button type="button" class="btnrating btn btn-default btn-lg " data-attr="1" id="rating-star-1">
													<i class="fa fa-star" aria-hidden="true"></i>
												</button>
												<button type="button" class="btnrating btn btn-default btn-lg" data-attr="2" id="rating-star-2">
													<i class="fa fa-star" aria-hidden="true"></i>
												</button>
												<button type="button" class="btnrating btn btn-default btn-lg" data-attr="3" id="rating-star-3">
													<i class="fa fa-star" aria-hidden="true"></i>
												</button>
												<button type="button" class="btnrating btn btn-default btn-lg" data-attr="4" id="rating-star-4">
													<i class="fa fa-star" aria-hidden="true"></i>
												</button>
												<button type="button" class="btnrating btn btn-default btn-lg" data-attr="5" id="rating-star-5">
													<i class="fa fa-star" aria-hidden="true"></i>
												</button>
												<div class="form-group">
													<label for="comment">Comentario:</label>
													<textarea class="form-control" rows="5" name="comentario"></textarea>
												</div>
												<button name="idcompra" type="submit" class="btn btn-lg btn-success" value="<?php echo $datos_compra[0]['ID']; ?>">
													<i class="fa fa-thumbs-up"></i> Calificar venta
												</button>
											</div>
										</form>	
										<?php
									}else{
										if ((($_SESSION['id'] == $datos_compra[0]['IDCOMPRADOR'] ) || ( $_SESSION['id'] == $datos_compra[0]['IDVENDEDOR'])) && ((!is_null($datos_compra[0]['IDCALCOMPRADOR'])) && (!is_null($datos_compra[0]['IDCALVENDEDOR'])))){
											?>
											<div class="col-xs-12">
												<h4>Comentarios de la Compra / Venta / Permuta</h4>
												<div class="product-mesages">
													<div class="chat_window">
														<ul class="messages">
															<li class="message left appeared">
																<div class="text_wrapper">
																	<div class="text"><?php echo utf8_encode('Vendedor: '.$datos_compra[0]['MENSAJECALVENDEDOR']); ?></div>
																	<p><i class="fa fa-flag" aria-hidden="true"></i><a href="report.php?id=<?php echo $datos_compra[0]['ID']; ?>"> denunciar </a>| creado el <?php echo date("d/m/Y H:i", strtotime($datos_compra[0]['FECHACALVENDEDOR'])); ?></p>
																</div>
															</li>
															<li class="message right appeared">
																<div class="text_wrapper">
																	<div class="text"><?php echo utf8_encode('Comprador: '.$datos_compra[0]['MENSAJECALCOMPRADOR']); ?></div>
																	<p><i class="fa fa-flag" aria-hidden="true"></i><a href="report.php?id=<?php echo $datos_compra[0]['ID']; ?>"> denunciar </a>| creado el <?php echo date("d/m/Y H:i", strtotime($datos_compra[0]['FECHACALCOMPRADOR'])); ?></p>
																</div>
															</li>

														</ul>
													</div>
												</div>
											</div>
											<?php 
										}
										?>
										<div class="col-xs-12">
											<form action="../view/mysells.php" method="POST">
												<button class="btn btn-lg" type="submit" >
													<i class="fa fa-external-link"></i> Ir a Mis Ventas
												</button>
											</form>		
										</div>
										<?php
									}
								}
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- *********************************************************************************************************************************************  -->
<div class="modal fade" id="DenunciaCompraModal" tabindex="-1" role="dialog" aria-labelledby="DenunciaPublicacionModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<form action="../logica/procesarAltaDenuncia.php" method="POST">
					<div class="row">
						<div class="col-md-12 product_img">
							<h4 class="lestitle" style="text-align: center;">Denuncia de Compra</h4>
							<hr>
						</div>
						<div class="col-md-6 product_img">
							<h4">Datos de la Compra</h4>
							<div class="row">
								<div class="col-xs-12">
									<p><b>Producto: </b> <?php echo utf8_encode($datos_compra[0]['TITULO'])?></p>
									<p><b>Precio unitario: $</b><?php echo $datos_compra[0]['TOTAL']?></p>
									<p><b>Cantidad: </b> <?php echo $datos_compra[0]['CANTIDAD']?> unidad/es</p>
									<p><b>Total: $</b><?php echo $datos_compra[0]['TOTAL'] * $datos_compra[0]['CANTIDAD']?></p>
								</div>
							</div>
						</div>
						<div class="col-md-6 product_content cppermuta">
							<h4 class="lestitle">Cuentanos porque denuncias la publicacion:</h4>
							<textarea class="form-control" rows="5" name="comentario"></textarea>
							<input type="text" name="pubid" value="<?php echo $datos_compra['0']['ID']; ?>" hidden>
							<input type="text" name="tipo" value="compra" hidden>
							<div class="space-ten"></div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button name="boton" type="submit" class="btn btn-success" value="permuta">
						<i class="fa fa-handshake-o"></i> Denunciar
					</button>
					<button type="button" class="btn btn-warning" data-dismiss="modal">Cancelar</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- *********************************************************************************************************************************************  -->
<div class="modal fade" id="DenunciaVendedorModal" tabindex="-1" role="dialog" aria-labelledby="DenunciaPublicacionModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<form action="../logica/procesarAltaDenuncia.php" method="POST">
					<div class="row">
						<div class="col-md-12 product_img">
							<h4 class="lestitle" style="text-align: center;">Denuncia de Usuario</h4>
							<hr>
						</div>
						<div class="col-md-6 product_img">
							<h4>Datos del Vendedor</h4>
							<div class="row">
								<div class="col-xs-12">
									<p><b>Nombre Completo: </b><?php echo utf8_encode($nombrecompleto) ?></p>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12">
									<p><b>Email: </b><a href="mailto:<?php echo $datos_compra[0]['EMAIL']?>"><?php echo $datos_compra[0]['EMAIL']?></a></p>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12">
									<p><b>Dirección: </b><?php echo $datos_compra[0]['CALLE']?> <?php echo utf8_encode($datos_compra[0]['NUMERO'])?></p>
								</div>
							</div>
						</div>
						<div class="col-md-6 product_content cppermuta">
							<h4 class="lestitle">Cuentanos porque denuncias la publicacion:</h4>
							<textarea class="form-control" rows="5" name="comentario"></textarea>
							<input type="text" name="pubid" value="<?php echo $datos_compra['0']['IDVENDEDOR']; ?>" hidden>
							<input type="text" name="tipo" value="usuario" hidden>
							<div class="space-ten"></div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button name="boton" type="submit" class="btn btn-success" value="permuta">
						<i class="fa fa-handshake-o"></i> Denunciar
					</button>
					<button type="button" class="btn btn-warning" data-dismiss="modal">Cancelar</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- *********************************************************************************************************************************************  -->
<div class="modal fade" id="DenunciaCompradorModal" tabindex="-1" role="dialog" aria-labelledby="DenunciaPublicacionModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<form action="../logica/procesarAltaDenuncia.php" method="POST">
					<div class="row">
						<div class="col-md-12 product_img">
							<h4 class="lestitle" style="text-align: center;">Denuncia de Usuario</h4>
							<hr>
						</div>
						<div class="col-md-6 product_img">
							<h4>Datos del Comprador</h4>
							<div class="row">
								<div class="col-xs-12">
									<p><b>Nombre Completo: </b><?php echo utf8_encode($datos_compra[0]['PNOMBRECOMPRADOR'].' '.$datos_compra[0]['PAPELLIDOCOMPRADOR']) ?></p>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12">
									<p><b>Email: </b><a href="mailto:<?php echo $datos_compra[0]['EMAILCOMPRADOR']?>"><?php echo $datos_compra[0]['EMAILCOMPRADOR']?></a></p>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12">
									<p><b>Cedula: </b><?php echo $datos_compra[0]['CEDULACOMPRADOR']?></p>
								</div>
							</div>
						</div>
						<div class="col-md-6 product_content cppermuta">
							<h4 class="lestitle">Cuentanos porque denuncias la publicacion:</h4>
							<textarea class="form-control" rows="5" name="comentario"></textarea>
							<input type="text" name="pubid" value="<?php echo $datos_compra['0']['IDCOMPRADOR']; ?>" hidden>
							<input type="text" name="tipo" value="usuario" hidden>
							<div class="space-ten"></div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button name="boton" type="submit" class="btn btn-success" value="permuta">
						<i class="fa fa-handshake-o"></i> Denunciar
					</button>
					<button type="button" class="btn btn-warning" data-dismiss="modal">Cancelar</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- ::::::::::::::  FIN LOGIN  :::::::::::::: -->
<?php 
/*-----------------------------------------------------------------------------------------------------------*/
/* Fin contenido de esta pagina.*/
/*-----------------------------------------------------------------------------------------------------------*/
require('footer.php');
?>