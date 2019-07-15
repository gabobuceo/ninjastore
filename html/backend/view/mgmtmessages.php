<?php
session_start();
if (!isset($_SESSION['idbk'])){
	header('Location: ../view/login.php');
}
require('definitions.php');
//require_once('../../logica/funciones.php');
/*-----------------------------------------------------------------------------------------------------------*/
/* Agregar todo script, puntual para esta pagina.*/
/*-----------------------------------------------------------------------------------------------------------*/
?>
<link rel='stylesheet' href='../../static/css/dataTables.bootstrap.min.css'>
<script type="text/javascript" src="../../static/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../../static/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#tablamensajes').DataTable();
		$('#tablapublicaciones').DataTable();
		$('#tablabaneadas').DataTable();
	} );
</script>
<?php
/*-----------------------------------------------------------------------------------------------------------*/
/* Fin scripts de esta pagina.*/
/*-----------------------------------------------------------------------------------------------------------*/
/* Agregar todo control, puntual para esta pagina (Como la sesion).*/
/*-----------------------------------------------------------------------------------------------------------*/
require('header.php');
$datos_mensajes_activos = require_once('../logica/procesarListadoMensajesActivos.php');
$datos_publicaciones = require_once('../logica/procesarListadoMensajesPublicaciones.php');
$datos_mensajes_baneados = require_once('../logica/procesarListadoMensajesBaneados.php');
/*-----------------------------------------------------------------------------------------------------------*/
/* Debug de Datos.
CREATE TABLE PREGUNTA(
	ID 				SERIAL			NOT NULL,
	IDUSUARIO 		BIGINT(20)		UNSIGNED NOT NULL,
	IDPUBLICACION 	BIGINT(20)		UNSIGNED NOT NULL,
	MENSAJE 		VARCHAR(150) 	NOT NULL,
	FECHAM 			TIMESTAMP 		NOT NULL DEFAULT CURRENT_TIMESTAMP,
	RESPUESTA 		VARCHAR(150),
	FECHAR 			TIMESTAMP 		NOT NULL,
	ESTADO			VARCHAR(15) 	DEFAULT 'ACTIVO',
	BAJA			BOOLEAN			DEFAULT 0,
	PRIMARY KEY		(ID,IDUSUARIO,IDPUBLICACION),
	FOREIGN KEY		(IDUSUARIO) REFERENCES USUARIO(ID),
	FOREIGN KEY		(IDPUBLICACION) REFERENCES PUBLICACION(ID),
	CHECK			(ESTADO='ACTIVO' AND ESTADO='BANEADO')
);
/*-----------------------------------------------------------------------------------------------------------*/
/*
var_dump($datos_mensajes_activos);
echo "<hr>";
var_dump($datos_publicaciones);
echo "<hr>";
var_dump($datos_mensajes_baneados);
echo "<hr>";
/*var_dump($datos_denuncias_cerradas);
echo "<hr>";
var_dump($datos_asignado);
echo "<hr>";
var_dump($_SESSION);
echo "<hr>";
var_dump($_POST);
echo "<hr>";
var_dump($_GET);
echo "<hr>";
var_dump($_SERVER);
echo "<hr>";

/*-----------------------------------------------------------------------------------------------------------*/
/* Agregar todo el contenido de esta pagina aqui.*/
/*-----------------------------------------------------------------------------------------------------------*/
?>
<div class="row affix-row">
	<div class="col-sm-3 col-md-2 affix-sidebar">
		<?php 
		$_SESSION['menu']=5;
		require('menu.php');
		unset($_SESSION['menu']);
		?>
	</div>
	<div class="col-sm-9 col-md-10">
		<div class="row maincpanel">
			<div class="col-md-7">
				<div class="single-page main-grid-border">
					<div class="leftcpanel">
						<h4>Chat</h4>
						<?php
						if (isset($_GET['id'])) {
							$_SESSION['idmensaje']=$_GET['id'];
							$datos_mensaje = require_once('../logica/procesarCargaChat.php');					
							unset($_SESSION['idmensaje']);
							//var_dump($datos_mensaje);
							?>
							<div class="product-mesages">
								<div class="chat_window">
									<ul class="messages">
										<li class="message left appeared">
											<div class="text_wrapper">
												<div class="text">Pregunta: <?php echo utf8_encode($datos_mensaje[0]['MENSAJE']); ?></div>
											</div>
										</li>
										<?php
										if (!is_null($datos_mensaje[0]['RESPUESTA'])) {
											?>
											<li class="message right appeared">
												<div class="text_wrapper">
													<div class="text">Respuesta: <?php echo utf8_encode($datos_mensaje[0]['RESPUESTA']); ?></div>
												</div>
											</li>
											<?php
										}
										?>								
									</ul>
								</div>
							</div>
							<form class="form-horizontal" action="../logica/procesarBanearPregunta.php" method="POST">
								<fieldset>
									<input name="idpre" type="text" value="<?php echo $_GET['id'] ?>" hidden>
									<div class="form-group">
										<label class="col-md-5 control-label">ID</label>  
										<label class="col-md-5 control-label" style="text-align: left;"><?php echo utf8_encode($_GET['id']) ?></label>  
									</div>
									<div class="form-group">
										<label class="col-md-5 control-label">Publicacion</label>  
										<div class="col-md-5">
											<label class="control-label" style="text-align: left;">
												<a target="_Blank" href="../view/mgmtpublicaciones.php?id=<?php echo $datos_mensaje[0]['IDPUBLICACION'] ?>">
													<input class="btn btn-xs btn-info" type="button" value="Ver"/>
												</a>
												<?php echo utf8_encode(" ".$datos_mensaje['0']['TITULO'])?>
											</label>
										</div>  
									</div>

									<div class="form-group">
										<label class="col-md-5 control-label">Preguntado por</label>  
										<div class="col-md-5">
											<label class="control-label" style="text-align: left;">
												<a target="_Blank" href="../view/mgmtusers.php?id=<?php echo $datos_mensaje[0]['IDCOMPRADOR'] ?>">
													<input class="btn btn-xs btn-info" type="button" value="Ver"/>
												</a>
												<?php echo " ".utf8_encode($datos_mensaje['0']['USUCOMPRADOR'])?>
											</label>
										</div> 
									</div>

									<div class="form-group">
										<label class="col-md-5 control-label">Fecha de pregunta</label>  
										<label class="col-md-5 control-label" style="text-align: left;"><?php echo date("d/m/Y", strtotime($datos_mensaje['0']['FECHAM'])) ?></label> 
									</div>

									<div class="form-group">
										<label class="col-md-5 control-label">Respondido por</label>  
										<?php 
										if ($datos_mensaje['0']['RESPUESTA']!='') {
											?> 
											<label class="col-md-5 control-label" style="text-align: left;">
												<a target="_Blank" href="../view/mgmtusers.php?id=<?php echo $datos_mensaje[0]['IDVENDEDOR'] ?>">
													<input class="btn btn-xs btn-info" type="button" value="Ver"/>
												</a>
												<?php echo " ".utf8_encode($datos_mensaje['0']['USUVENDEDOR']) ?>
											</label> 
											<?php 
										} else {
											?> 
											<label class="col-md-5 control-label" style="text-align: left;">Pendiente</label> 
											<?php 
										}
										?> 
									</div>

									<div class="form-group">
										<label class="col-md-5 control-label">Fecha de respuesta</label> 
										<?php 
										if ($datos_mensaje['0']['FECHAR']!='0000-00-00 00:00:00') {
											?> 
											<label class="col-md-5 control-label" style="text-align: left;"><?php echo date("d/m/Y", strtotime($datos_mensaje['0']['FECHAR'])) ?></label> 
											<?php 
										} else {
											?> 
											<label class="col-md-5 control-label" style="text-align: left;">Pendiente</label> 
											<?php 
										}
										?> 
									</div>

									<div class="form-group">
										<label class="col-md-5 control-label">Estado del Mensaje</label>  
										<div class="col-md-5">
											<div class="input-group my-group"> 
												<select class="selectpicker form-control" data-live-search="true" name="estadop">
													<option value="ACTIVO" <?php if ($datos_mensaje['0']['ESTADO']=="ACTIVO"){ echo "selected"; } ?> >Activo</option>
													<option value="BANEADA" <?php if ($datos_mensaje['0']['ESTADO']=="BANEADA"){ echo "selected"; } ?> >Baneada</option>
												</select>
												<span class="input-group-btn">
													<button type="submit" class="btn btn-success">
														<span class="glyphicon glyphicon-thumbs-up"></span> Guardar Cambios
													</button>
												</span>
											</div>
										</div>
									</div>
								</fieldset>
							</form>
							<?php
						}elseif (isset($_GET['idpub'])) {
							$_SESSION['PubID']=$_GET['idpub'];
							$datos_mensaje = require_once('../logica/procesarCargaPreguntas.php');					
							unset($_SESSION['PubID']);
							//var_dump($datos_mensaje);
							?>
							<form class="form-horizontal" action="../logica/procesarBanearPregunta.php" method="POST">
								<fieldset>
									<div class="form-group">
										<label class="col-md-5 control-label" style="text-align: right";>Publicacion</label>  
										<div class="col-md-5">
											<label class="control-label" style="text-align: left;">
												<a target="_Blank" href="../view/mgmtpublicaciones.php?id=<?php echo $datos_mensaje[0]['IDPUBLICACION'] ?>">
													<input class="btn btn-xs btn-info" type="button" value="Ver"/>
												</a>
											</label>
										</div>  
									</div>
								</fieldset>
							</form>
							<!--<div class="product-mesages">
								<div class="chat_window">-->
									<ul class="messages" style="overflow: unset !important; max-height: unset !important;">
										<?php 
										for ($i=0; $i < count($datos_mensaje); $i++) { 
											?>
											<form class="form-horizontal" action="../logica/procesarBanearPregunta.php" method="POST">
												<fieldset>
													<div class="form-group">
														<div class="col-md-12">
															<li class="message left appeared">
																<div class="text_wrapper">
																	<div class="text">Pregunta: <?php echo utf8_encode($datos_mensaje[$i]['MENSAJE']); ?></div>
																</div>
															</li>
															<?php
															if (!is_null($datos_mensaje[$i]['RESPUESTA'])) {
																?>
																<li class="message right appeared">
																	<div class="text_wrapper">
																		<div class="text">Respuesta: <?php echo utf8_encode($datos_mensaje[$i]['RESPUESTA']); ?></div>
																	</div>
																</li>
																<?php
															}
															?>	
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-5 control-label">Mensaje</label>  
														<label class="col-md-5 control-label" style="text-align: left;">
															<a target="_Blank" href="../view/mgmtmessages.php?id=<?php echo $datos_mensaje[$i]['ID'] ?>">
																<input class="btn btn-xs btn-info" type="button" value="Ver"/>
															</a>
														</label>
													</div>
													<hr>
												</fieldset>
											</form>
											<?php
										}
										?>
									</ul>								
								<!--</div>
								</div>-->

								<?php
							}else{
								?>
								<div class="row">
									<div class="col-md-12 product_img">
										<p>Para cargar los mensajes haga click en su enlace</p>
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
							<h4>Listado de Mensajes</h4>
							<?php				
							if (isset($datos_mensajes_activos["this"])) {
								?>
								<p>No existen mensajes.</p>
								<?php
							}else{
								?>
								<div class="table-responsive">
									<table id="tablamensajes" class="table table-condensed table-striped table-bordered" cellspacing="0" width="100%">
										<thead>
											<tr>
												<td><strong>ID</strong></td>
												<td class="text-center"><strong>Publicacion</strong></td>
												<td class="text-center"><strong>Fecha</strong></td>
												<td class="text-right"><strong>Ver</strong></td>
											</tr>
										</thead>
										<tbody>
											<?php
											for ($i=0; $i < count($datos_mensajes_activos); $i++) { 
												/*DATOS_PUBLICACIONES.ID,CATEGORIA.TITULO,DATOS_PUBLICACIONES.TITULO,DATOS_PUBLICACIONES.PRECIO, DATOS_PUBLICACIONES.OFERTA*/
												?>
												<tr>
													<td><?php echo $datos_mensajes_activos[$i]['IDPREGUNTA'] ?></td>
													<td><?php echo utf8_encode($datos_mensajes_activos[$i]['TITULO']) ?></td>
													<td class="text-center"><?php echo date("d/m/Y", strtotime($datos_mensajes_activos[$i]['FECHAM'])) ?></td>
													<td class="text-right">
														<a href="../view/mgmtmessages.php?id=<?php echo $datos_mensajes_activos[$i]['IDPREGUNTA'] ?>">
															<button class="btn btn-xs btn-info">
																<i class="fa fa-external-link" aria-hidden="true"></i>
															</button>
														</a>
													</td>
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
						<div class="rightcpanel">
							<h4>Mensajes de Publicaciones</h4>
							<?php				
							if (isset($datos_publicaciones["this"])) {
								?>
								<p>No existen publicaciones con mensajes.</p>
								<?php
							}else{
								?>
								<div class="table-responsive">
									<table id="tablapublicaciones" class="table table-condensed table-striped table-bordered" cellspacing="0" width="100%">
										<thead>
											<tr>
												<td><strong>ID</strong></td>
												<td class="text-center"><strong>Titulo</strong></td>
												<td class="text-center"><strong>Mensajes</strong></td>
												<td class="text-right"><strong>Ver</strong></td>
											</tr>
										</thead>
										<tbody>
											<?php
											for ($i=0; $i < count($datos_publicaciones); $i++) { 
												/*DATOS_PUBLICACIONES.ID,CATEGORIA.TITULO,DATOS_PUBLICACIONES.TITULO,DATOS_PUBLICACIONES.PRECIO, DATOS_PUBLICACIONES.OFERTA*/
												?>
												<tr>
													<td><?php echo $datos_publicaciones[$i]['IDPUBLICACION'] ?></td>
													<td><?php echo utf8_encode($datos_publicaciones[$i]['TITULO']) ?></td>
													<td class="text-center"><?php echo $datos_publicaciones[$i]['CANTIDAD'] ?></td>
													<td class="text-right">
														<a href="../view/mgmtmessages.php?idpub=<?php echo $datos_publicaciones[$i]['IDPUBLICACION'] ?>">
															<button class="btn btn-xs btn-info">
																<i class="fa fa-external-link" aria-hidden="true"></i>
															</button>
														</a>
													</td>
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
						<div class="rightcpanel">
							<h4>Mensajes Baneadas</h4>
							<?php				
							if (isset($datos_mensajes_baneados["this"])) {
								?>
								<p>No existen mensajes baneados.</p>
								<?php
							}else{
								?>
								<div class="table-responsive">
									<table id="tablabaneadas" class="table table-condensed table-striped table-bordered" cellspacing="0" width="100%">
										<thead>
											<tr>
												<td><strong>ID</strong></td>
												<td class="text-center"><strong>Publicacion</strong></td>
												<td class="text-center"><strong>Fecha</strong></td>
												<td class="text-right"><strong>Ver</strong></td>
											</tr>
										</thead>
										<tbody>
											<?php
											for ($i=0; $i < count($datos_mensajes_baneados); $i++) { 
												/*DATOS_PUBLICACIONES.ID,CATEGORIA.TITULO,DATOS_PUBLICACIONES.TITULO,DATOS_PUBLICACIONES.PRECIO, DATOS_PUBLICACIONES.OFERTA*/
												?>
												<tr>
													<td><?php echo $datos_mensajes_baneados[$i]['IDPREGUNTA'] ?></td>
													<td><?php echo utf8_encode($datos_mensajes_baneados[$i]['TITULO']) ?></td>
													<td class="text-center"><?php echo date("d/m/Y", strtotime($datos_mensajes_baneados[$i]['FECHAM'])) ?></td>
													<td class="text-right">
														<a href="../view/mgmtmessages.php?id=<?php echo $datos_mensajes_baneados[$i]['IDPREGUNTA'] ?>">
															<button class="btn btn-xs btn-info">
																<i class="fa fa-external-link" aria-hidden="true"></i>
															</button>
														</a>
													</td>
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
	<script>
		$('#tablamensajes').DataTable( {
			"language": {
				"sProcessing":     "Procesando...",
				"sLengthMenu":     "Mostrar _MENU_ registros",
				"sZeroRecords":    "No se encontraron resultados",
				"sEmptyTable":     "Ningún dato disponible en esta tabla",
				"sInfo":           "Total: _TOTAL_ registros",
				"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
				"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
				"sInfoPostFix":    "",
				"sSearch":         "Buscar:",
				"sUrl":            "",
				"sInfoThousands":  ",",
				"sLoadingRecords": "Cargando...",
				"oPaginate": {
					"sFirst":    "Primero",
					"sLast":     "Último",
					"sNext":     "Siguiente",
					"sPrevious": "Anterior"
				},
				"oAria": {
					"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
					"sSortDescending": ": Activar para ordenar la columna de manera descendente"
				}
			},
			"responsive": "true",
			"select": "true",
			"buttons": [
			'copy', 'excel', 'pdf'
			]
		});
		$('#tablapublicaciones').DataTable( {
			"language": {
				"sProcessing":     "Procesando...",
				"sLengthMenu":     "Mostrar _MENU_ registros",
				"sZeroRecords":    "No se encontraron resultados",
				"sEmptyTable":     "Ningún dato disponible en esta tabla",
				"sInfo":           "Total: _TOTAL_ registros",
				"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
				"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
				"sInfoPostFix":    "",
				"sSearch":         "Buscar:",
				"sUrl":            "",
				"sInfoThousands":  ",",
				"sLoadingRecords": "Cargando...",
				"oPaginate": {
					"sFirst":    "Primero",
					"sLast":     "Último",
					"sNext":     "Siguiente",
					"sPrevious": "Anterior"
				},
				"oAria": {
					"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
					"sSortDescending": ": Activar para ordenar la columna de manera descendente"
				}
			},
			"responsive": "true",
			"select": "true",
			"buttons": [
			'copy', 'excel', 'pdf'
			]
		});
		$('#tablabaneadas').DataTable( {
			"language": {
				"sProcessing":     "Procesando...",
				"sLengthMenu":     "Mostrar _MENU_ registros",
				"sZeroRecords":    "No se encontraron resultados",
				"sEmptyTable":     "Ningún dato disponible en esta tabla",
				"sInfo":           "Total: _TOTAL_ registros",
				"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
				"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
				"sInfoPostFix":    "",
				"sSearch":         "Buscar:",
				"sUrl":            "",
				"sInfoThousands":  ",",
				"sLoadingRecords": "Cargando...",
				"oPaginate": {
					"sFirst":    "Primero",
					"sLast":     "Último",
					"sNext":     "Siguiente",
					"sPrevious": "Anterior"
				},
				"oAria": {
					"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
					"sSortDescending": ": Activar para ordenar la columna de manera descendente"
				}
			},
			"responsive": "true",
			"select": "true",
			"buttons": [
			'copy', 'excel', 'pdf'
			]
		});
	</script>
	<?php 
	/*-----------------------------------------------------------------------------------------------------------*/
	/* Fin contenido de esta pagina.*/
	/*-----------------------------------------------------------------------------------------------------------*/
	require('footer.php');
	?>