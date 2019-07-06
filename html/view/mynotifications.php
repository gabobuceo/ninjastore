<?php 
session_start();
require('definitions.php');
require_once ('../logica/funciones.php');
/*-----------------------------------------------------------------------------------------------------------*/
/* Agregar todo script, puntual para esta pagina.*/
/*-----------------------------------------------------------------------------------------------------------*/
?>
<?php 
/*-----------------------------------------------------------------------------------------------------------*/
/* Fin scripts de esta pagina.*/
/*-----------------------------------------------------------------------------------------------------------*/
/* Agregar todo control, puntual para esta pagina (Como la sesion).*/
/*-----------------------------------------------------------------------------------------------------------*/
require('header.php');
/*$datos_notificaciones = require_once('../logica/procesarCargaNotificaciones.php'); --> No es necesario ya esta cargado en el header
/*-----------------------------------------------------------------------------------------------------------*/
/* Agregar todo el contenido de esta pagina aqui.*/
/*-----------------------------------------------------------------------------------------------------------*/
?>
<div class="row affix-row">
	<div class="col-sm-3 col-md-2 affix-sidebar">
		<?php 
		$_SESSION['menu']=8;
		require('menu.php');
		unset($_SESSION['menu']);
		?>
	</div>
	<div class="col-sm-9 col-md-10">
		<div class="row maincpanel">
			<div class="col-md-7">
				<div class="single-page main-grid-border">
					<div class="leftcpanel">
						<h4>Vista Previa</h4>
						<?php
						$datos_notificaciones = require_once('../logica/procesarCargaNotificaciones.php');
						if (isset($_GET['id'])) {
							$_SESSION['NotificacionID']=$_GET['id'];
							$datos_notificacion = require_once('../logica/procesarCargaNotificacion.php');
							/*var_dump($datos_notificacion);
							echo "<br><br>";
							var_dump($datos_notificaciones);*/
							unset($_SESSION['NotificacionID']);
							switch ($datos_notificacion[0]["TIPO"]) {
								case 'PREGUNTA':
								$_SESSION['idmensaje']=$datos_notificacion[0]['LINK'];
								$datos_mensaje = require_once('../logica/procesarCargaChat.php');					
								unset($_SESSION['idmensaje']);
								/*var_dump($datos_mensaje);*/
								?>
								<div class="col-md-6 product_img">
									<?php
									cargarimgtn($datos_notificacion[0]['IMGDEFAULT']);
									?>
								</div>
								<div class="col-md-6 product_content cppermuta">
									<div class="buyingdata">
										<h4>Pregunta:</h4>
										<div class="row">
											<div class="col-xs-12">
												<p><?php echo utf8_encode($datos_mensaje[0]['MENSAJE'])?></p>
											</div>
										</div>
										<div class="row">
											<div class="col-xs-12">
												<div class="btn-ground">
													<div class="buy-in-form">
														<form action="../view/mymessages.php?idmensaje=<?php echo $datos_mensaje['0']['ID']; ?>" method="POST">	
															<button name="boton" type="submit" class="btn btn-warning" value="comprar">
																<i class="fa fa-external-link"></i> Ir al mensaje
															</button>
														</form>	
													</div>
												</div>
											</div>
										</div>
									</div>			
								</div>
								<div class="row">

								</div>
								<?php
								break;
								case 'RESPUESTA':
									$_SESSION['idmensaje']=$datos_notificacion[0]['LINK'];
									$datos_mensaje = require_once('../logica/procesarCargaChat.php');					
									unset($_SESSION['idmensaje']);
									/*var_dump($datos_mensaje);*/
									?>
									<div class="col-md-6 product_img">
										<?php
										cargarimgtn($datos_notificacion[0]['IMGDEFAULT']);
										?>
									</div>
									<div class="col-md-6 product_content cppermuta">
										<div class="buyingdata">
											<h4>Respuesta:</h4>
											<div class="row">
												<div class="col-xs-12">
													<p><?php echo utf8_encode($datos_mensaje[0]['RESPUESTA'])?></p>
												</div>
											</div>
											<div class="row">
												<div class="col-xs-12">
													<div class="btn-ground">
														<div class="buy-in-form">
															<form action="../view/mymessages.php?idmensaje=<?php echo $datos_mensaje['0']['ID']; ?>" method="POST">	
																<button name="boton" type="submit" class="btn btn-warning" value="comprar">
																	<i class="fa fa-external-link"></i> Ir al mensaje
																</button>
															</form>	
														</div>
													</div>
												</div>
											</div>
										</div>			
									</div>
									<div class="row">

									</div>
									<?php
								break;
								case 'COMPRA':
								case 'VENTA':
								case 'CONFIRMADOV':
								case 'CONFIRMADOC':
								case 'CALIFICACIONC':
								case 'CALIFICACIONV':
									$_SESSION['ComID']=$datos_notificacion[0]['LINK'];
									$datos_compra = require_once('../logica/procesarCargaCompra.php');
									/*var_dump($datos_compra);*/
									unset($_SESSION['ComID']);
									$_SESSION['IDVENDEDOR']=$datos_compra[0]['IDVENDEDOR'];
									$datos_telefono = require_once('../logica/procesarCargaTelefonos.php');
									$nombrecompleto = $datos_compra[0]['PNOMBRE'];
									if (is_null($datos_compra[0]['SNOMBRE'])){
										$nombrecompleto = $nombrecompleto." ".$datos_compra[0]['SNOMBRE'];
									}
									$nombrecompleto = $nombrecompleto." ".$datos_compra[0]['PAPELLIDO'];
									if (is_null($datos_compra[0]['SAPELLIDO'])){
										$nombrecompleto = $nombrecompleto." ".$datos_compra[0]['SAPELLIDO'];
									}
									?>
									<div class="col-md-6 product_img">
										<?php
										cargarimgtn($datos_notificacion[0]['IMGDEFAULT']);
										?>
									</div>
									<div class="col-md-6 product_content cppermuta">
										<div class="buyingdata">
											<h4>Datos de la Compra</h4>
											<div class="row">
												<div class="col-xs-12">
													<p><b>Producto: </b> <?php echo utf8_encode($datos_compra[0]['TITULO'])?></p>
													<p><b>Precio Unitario: $</b><?php echo $datos_compra[0]['TOTAL']?></p>
													<p><b>Cantidad: </b> <?php echo $datos_compra[0]['CANTIDAD']?> unidad/es</p>
													<p><b>Total: $</b><?php echo $datos_compra[0]['TOTAL'] * $datos_compra[0]['CANTIDAD']?></p>
												</div>
											</div>
										</div>			
										<div class="buyingdata">
											<h4>Datos del Vendedor</h4>
											<div class="row">
												<div class="col-xs-12">
													<p><b>Nombre Completo: </b><?php echo utf8_encode($nombrecompleto) ?></p>
												</div>
											</div>
											<div class="row">
												<div class="col-xs-12">
													<p><b>Teléfono: </b>
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
													<p><b>Cédula: </b><?php echo $datos_compra[0]['CEDULA']?></p>
												</div>
											</div>
											<div class="row">
												<div class="col-xs-12">
													<p><b>Correo: </b><a href="mailto:<?php echo $datos_compra[0]['EMAIL']?>"><?php echo $datos_compra[0]['EMAIL']?></a></p>
												</div>
											</div>
										</div>
										<div class="buyingdata">
											<h4>Estado de Compra</h4>
											<div class="row">
												<div class="col-xs-12">
													<p><b>Fecha de Compra: </b><?php echo date("d/m/Y", strtotime($datos_compra[0]['FECHACOMPRA'])); ?></p>
												</div>
											</div>
											<div class="row">
												<div class="col-xs-12">
													<p>
														<b>Venta Concretada: </b>
														<?php 
														if ($datos_compra[0]['VENTACONCRETA']=='0') {
															echo "Sin Concretar";
														}else{
															echo "Concrtetado el dia ".date("d/m/Y", strtotime($datos_compra[0]['FECHAVENTACONCRETADO']));
														}
														?>
													</p>
												</div>
												<div class="col-xs-12">
													<p>
														<b>Compra Concretada: </b>
														<?php 
														if ($datos_compra[0]['COMPRACONCRETA']=='0') {
															echo "Sin Concretar";
														}else{
															echo "Concrtetado el dia ".date("d/m/Y", strtotime($datos_compra[0]['FECHACOMPRACONCRETADO']));
														}
														?>
													</p>
												</div>
												<div class="col-xs-12">
													<p>
														<b>Calificacion del Vendedor: </b>
														<?php 
														if (is_null($datos_compra[0]['IDCALVENDEDOR'])) {
															echo "Sin Calificar";
														}else{
															echo "Calificado el dia ".date("d/m/Y", strtotime($datos_compra[0]['FECHACALVENDEDOR']));
														}
														?>
													</p>
												</div>
												<div class="col-xs-12">
													<p>
														<b>Calificacion del Comprador: </b>
														<?php 
														if (is_null($datos_compra[0]['IDCALCOMPRADOR'])) {
															echo "Sin Calificar";
														}else{
															echo "Calificado el dia ".date("d/m/Y", strtotime($datos_compra[0]['FECHACALCOMPRADOR']));
														}
														?>
													</p>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12 product_img">
											<div class="btn-ground">
												<div class="buy-in-form">
													<form action="../view/mybuys.php?idcompra=<?php echo $datos_compra['0']['ID']; ?>" method="POST">						
														<button name="boton" type="submit" class="btn btn-warning" value="comprar">
															<i class="fa fa-external-link"></i> Ver Compra completa
														</button>
													</form>	
												</div>
											</div>
										</div>
									</div>
									<?php
								break;
								case 'BANEADO':
									# code...mypublication.php?idpub
								break;
								case 'FINALIZADO':
									$_SESSION['PubID']=$datos_notificacion[0]['LINK'];
									$datos_publicacion = require_once('../logica/procesarCargaPublicacion.php');
									unset($_SESSION['PubID']);
									?>
									<div class="col-md-6 product_img">
										<?php
										cargarimgtn($datos_notificacion[0]['IMGDEFAULT']);
										?>
									</div>
									<div class="col-md-6 product_content cppermuta">
										<div class="buyingdata">
											<h4>Datos de la Publicacion</h4>
											<div class="row">
												<div class="col-xs-12">
													<p><b>Producto: </b> <?php echo utf8_encode($datos_publicacion[0]['TITULO'])?></p>
													<p><b>Estado: </b> <?php echo $datos_publicacion[0]['ESTADOA']?></p>
													<p><b>Precio: $</b><?php echo $datos_publicacion[0]['PRECIO']?></p>
												</div>
											</div>
											<div class="row">
												<div class="col-xs-12">
													<div class="btn-ground">
														<div class="buy-in-form">
															<form action="../view/mypublication.php" method="POST">						
																<button name="boton" type="submit" class="btn btn-warning" value="comprar">
																	<i class="fa fa-external-link"></i> Ir a publicaciones
																</button>
															</form>	
														</div>
													</div>
												</div>
											</div>
										</div>			
									</div>
									<div class="row">

									</div>
									<?php
								break;
								case 'PERMUTA':
								$_SESSION['ExcID']=$datos_notificacion[0]['LINK'];
								$datos_permutas = require_once('../logica/procesarCargaPermuta.php');		
								unset($_SESSION['ExcID']);
								?>
								<div class="row">
									<div class="col-md-6 product_img">
										<?php
										cargarimgtn($datos_permutas[0]['IMGDEFAULTORIGEN']);
										?>
									</div>
									<div class="col-md-6 product_content cppermuta">
										<h4 class="lestitle">Articulo: <span class="subtitle"><?php echo  utf8_encode($datos_permutas[0]['TITULOORIGEN'])?></span></h4>
										<h4 class="lestitle">Ofertante: <span class="subtitle"><?php echo $datos_permutas[0]['USUARIOORIGEN']?></span></h4>
										<h4 class="lestitle">Cantidad: <span class="subtitle"><?php echo $datos_permutas[0]['CANTIDADORIGEN']?></span></h4>

										<p>Ver Publicación 
											<a target="_blank" href="../view/publication.php?id=<?php echo $datos_permutas[0]['IDPUBLICACIONORIGEN'] ?>">
												<button class="btn btn-xs btn-info">
													<i class="fa fa-external-link"></i>
												</button>
											</a>
										</p>
										<h3 class="cost lestitle">Subtotal: <span class="subtitle"><i class="fa fa-usd" aria-hidden="true"></i><span id="subtotal"><?php echo $datos_permutas[0]['PRECIOORIGEN']?></span></span></h3>
										<div class="space-ten"></div>
									</div>
								</div>
								<h4>A cambio de:</h4>
								<div class="row">
									<div class="col-md-6 product_img">
										<?php
										cargarimgtn($datos_permutas[0]['IMGDEFAULTDESTINO']);
										?>
									</div>
									<div class="col-md-6 product_content cppermuta">
										<h4 class="lestitle">Articulo: <span class="subtitle"><?php echo  utf8_encode($datos_permutas[0]['TITULODESTINO'])?></span></h4>
										<h4 class="lestitle">Ofertante: <span class="subtitle"><?php echo $datos_permutas[0]['USUARIODESTINO']?></span></h4>
										<h4 class="lestitle">Cantidad: <span class="subtitle"><?php echo $datos_permutas[0]['CANTIDADDESTINO']?></span></h4>

										<p>Ver Publicación 
											<a target="_blank" href="../view/publication.php?id=<?php echo $datos_permutas[0]['IDPUBLICACIONDESTINO'] ?>">
												<button class="btn btn-xs btn-info">
													<i class="fa fa-external-link"></i>
												</button>
											</a>
										</p>
										<h3 class="cost lestitle">Subtotal: <span class="subtitle"><i class="fa fa-usd" aria-hidden="true"></i><span id="subtotal"><?php echo $datos_permutas[0]['PRECIODESTINO']?></span></span></h3>
										<div class="space-ten"></div>
									</div>
								</div>
								<h4>Estado de permuta</h4>
								<div class="row">
									<div class="col-md-12 product_content cppermuta">
										<h3 class="cost lestitle">Estado: <span class="subtitle"><span id="subtotal"><?php echo $datos_permutas[0]['ESTADO']?></span></span></h3>
										<h3 class="cost lestitle">Aceptada: <span class="subtitle"><span id="subtotal">
											<?php 
											if ($datos_permutas[0]['ACEPTADA']==1) {
												echo "Si";
											}else{
												echo "No";
											}
											?>
										</span></span></h3>
										<div class="space-ten"></div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12 product_img">
										<div class="btn-ground">
											<div class="buy-in-form">
												<form action="../view/myexchanges.php?id=<?php echo $datos_permutas['0']['ID']; ?>" method="POST">						
													<button name="boton" type="submit" class="btn btn-warning" value="comprar">
														<i class="fa fa-external-link"></i> Ver Permuta
													</button>
												</form>	
											</div>
										</div>
									</div>
								</div>
								<?php 
								break;

								default:
									# code...
								break;
							}
						}else{
							?>
							<div class="row">
								<div class="col-md-12 product_img">
									<p>Para cargar la vista previa de la notificación, haz click en su enlace</p>
								</div>
							</div>
							<?php
						}
						?>
					</div>
				</div>
			</div>
			<div class="col-md-5">
				<div class="single-page main-grid-border">
					<div class="rightcpanel">
						<h4>Listado</h4>
						<?php				
						if (isset($datos_notificaciones["this"])) {
							?>
							<p>No tienes Notificaciones.</p>
							<?php
						}else{
							?>
							<div class="table-responsive">
								<table class="table table-condensed">
									<thead>
										<tr>
											<td><strong>Tipo</strong></td>
											<td class="text-center"><strong>Descripcion</strong></td>
											<td class="text-center"><strong>Fecha</strong></td>
											<td class="text-center"><strong>Estado</strong></td>
											<td class="text-right"><strong>Vista Previa</strong></td>
										</tr>
									</thead>
									<tbody>
										<?php
										for ($i=0; $i < count($datos_notificaciones); $i++) { 
											?>
											<tr>
												<td>
													<?php 
													switch ($datos_notificaciones[$i]['TIPO']) {
														case 'CONFIRMADOV':
														case 'CONFIRMADOC':
														echo "CONFIRMACION";
														break;
														case 'CALIFICACIONC':
														case 'CALIFICACIONV':
														echo "CALIFICACION";
														break;
														default:
														echo $datos_notificaciones[$i]['TIPO']; 
														break;
													}
													?>
												</td>

												<td class="text-center"><?php echo $datos_notificaciones[$i]['DESCRIPCION']; ?></td>
												<td class="text-center"><?php echo date("d/m/Y", strtotime($datos_notificaciones[$i]['FECHA'])); ?></td>
												<td class="text-center">
													<?php if ($datos_notificaciones[$i]['VISTO'] == "0"){
														echo "Nuevo";
													}else{
														echo "Leido";
													}
													?>														
												</td>
												<td class="text-right"><a href="../view/mynotifications.php?id=<?php echo $datos_notificaciones[$i]['ID']; ?>"><i class="fa fa-external-link" aria-hidden="true"></i> ID: <?php echo $datos_notificaciones[$i]['ID']; ?></a></td>
											</tr>
											<?php
										}
										?>
									</tbody>
								</table>
							</div>
							<?php
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php 
/*-----------------------------------------------------------------------------------------------------------*/
/* Fin contenido de esta pagina.*/
/*-----------------------------------------------------------------------------------------------------------*/
require('footer.php');
?>
