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
		$_SESSION['menu']=7;
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
											<h4>Pregunta:</h4>
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
									$_SESSION['ComID']=$datos_notificacion[0]['LINK'];
									$datos_compra = require_once('../logica/procesarCargaCompra.php');
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
													<p><b>Cantidad: </b> <?php echo $datos_compra[0]['CANTIDAD']?> unidad/es</p>
													<p><b>Total: $</b><?php echo $datos_compra[0]['TOTAL']?></p>
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
														if ($datos_compra[0]['CONCRETADO']=='0') {
															echo "Sin Concretar";
														}else{
															echo "Concrtetado el dia ".date("d/m/Y", strtotime($datos_compra[0]['FECHACONCRETADO']));
														}
														?>
													</p>
												</div>
											</div>
											<div class="row">
												<div class="col-xs-12">
													<p>
														<b>Calificacion: </b>
														<?php 
															if (is_null($datos_compra[0]['CALIFICACION'])) {
																echo "Sin Calificar";
															}else{
																echo $datos_compra[0]['CALIFICACION'];
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
								case 'VENTA':
									$_SESSION['ComID']=$datos_notificacion[0]['LINK'];
									$datos_compra = require_once('../logica/procesarCargaCompra.php');
									unset($_SESSION['ComID']);
									$nombrecompleto = $datos_compra[0]['PNOMBRECOMPRADOR'];
									$nombrecompleto = $nombrecompleto." ".$datos_compra[0]['PAPELLIDOCOMPRADOR'];
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
													<p><b>Cantidad: </b> <?php echo $datos_compra[0]['CANTIDAD']?> unidad/es</p>
													<p><b>Total: $</b><?php echo $datos_compra[0]['TOTAL']?></p>
												</div>
											</div>
										</div>			
										<div class="buyingdata">
											<h4>Datos del Comprador</h4>
											<div class="row">
												<div class="col-xs-12">
													<p><b>Nombre Completo: </b><?php echo utf8_encode($nombrecompleto) ?></p>
												</div>
											</div>
											<div class="row">
												<div class="col-xs-12">
													<p><b>Cédula: </b><a href="mailto:<?php echo $datos_compra[0]['EMAIL']?>"><?php echo $datos_compra[0]['CEDULACOMPRADOR']?></a></p>
												</div>
											</div>
											<div class="row">
												<div class="col-xs-12">
													<p><b>Correo: </b><a href="mailto:<?php echo $datos_compra[0]['EMAIL']?>"><?php echo $datos_compra[0]['EMAILCOMPRADOR']?></a></p>
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
														if ($datos_compra[0]['CONCRETADO']=='0') {
															echo "Sin Concretar";
														}else{
															echo "Concrtetado el dia ".date("d/m/Y", strtotime($datos_compra[0]['FECHACONCRETADO']));
														}
														?>
													</p>
												</div>
											</div>
											<div class="row">
												<div class="col-xs-12">
													<p>
														<b>Calificacion: </b>
														<?php 
															if (is_null($datos_compra[0]['CALIFICACION'])) {
																echo "Sin Calificar";
															}else{
																echo $datos_compra[0]['CALIFICACION'];
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
													<form action="../view/mypublication.php" method="POST">						
														<button name="boton" type="submit" class="btn btn-warning" value="comprar">
															<i class="fa fa-external-link"></i> Ir a publicaciones
														</button>
													</form>	
												</div>
											</div>
										</div>
									</div>
									<?php
								break;
								case 'CONFIRMADOC':
									# code...mypublication.php?idventa
								break;
								case 'CONFIRMADOV':
									# code...mybuys.php?idcompra
								break;
								case 'CALIFICACIONC':
									# code...mypublication.php?idventa
								break;
								case 'CALIFICACIONV':
									# code...mybuys.php?idcompra
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
												<td><?php echo $datos_notificaciones[$i]['TIPO']; ?></td>
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
