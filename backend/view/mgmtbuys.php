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
<!--
<script src='https://api.tiles.mapbox.com/mapbox-gl-js/v0.53.1/mapbox-gl.js'></script>
<link href='https://api.tiles.mapbox.com/mapbox-gl-js/v0.53.1/mapbox-gl.css' rel='stylesheet' />
-->
<link rel='stylesheet' href='<?php echo $staticsrv; ?>/css/dataTables.bootstrap.min.css'>

<script type="text/javascript" src="<?php echo $staticsrv; ?>/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo $staticsrv; ?>/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#tablacompras').DataTable();
		$('#tablabaneadas').DataTable();
	} );
</script>
<!--
<script type="text/javascript" src="../static/ckeditor/ckeditor.js"></script>

<style>
.thumbnails {
	overflow: hidden;
	margin: 1em 0;
	padding: 0;
}

.thumbnails li {
	display: inline-block;
	width: 50px;
	margin: 0 5px;
}

.thumbnails img {
	display: block;
	min-width: 100%;
	max-width: 100%;
}
</style>
-->
<?php
/*-----------------------------------------------------------------------------------------------------------*/
/* Fin scripts de esta pagina.*/
/*-----------------------------------------------------------------------------------------------------------*/
/* Agregar todo control, puntual para esta pagina (Como la sesion).*/
/*-----------------------------------------------------------------------------------------------------------*/
require('header.php');
$datos_compras = require_once('../logica/procesarListadoCompras.php');
$datos_compras_baneadas = require_once('../logica/procesarListadoComprasBaneadas.php');
/*
var_dump($datos_compras);
echo "<hr>";
var_dump($datos_compras_baneadas);
echo "<hr>";
/*var_dump($datos_publicacion_cerradas);
echo "<hr>";
/*$datos_publicacion = require_once('../logica/procesarListadoPublicaciones.php');
$datos_publicacion = require_once('../logica/procesarListadoPublicaciones.php');*/
/*-----------------------------------------------------------------------------------------------------------*/
/* Agregar todo el contenido de esta pagina aqui.*/
/*-----------------------------------------------------------------------------------------------------------*/
?>
<div class="row affix-row">
	<div class="col-sm-3 col-md-2 affix-sidebar">
		<?php 
		$_SESSION['menu']=6;
		require('menu.php');
		unset($_SESSION['menu']);
		?>
	</div>
	<div class="col-sm-9 col-md-10">
		<div class="row maincpanel">
			<div class="col-md-7">
				<div class="single-page main-grid-border">
					<div class="leftcpanel">
						<h4>Ver Compra</h4>
						<?php
						if (isset($_GET['id'])) {
							$_SESSION['ComID']=$_GET['id'];
							$datos_compra = require_once('../logica/procesarCargaCompra.php');
							$_SESSION['IDVENDEDOR']=$datos_compra[0]['IDVENDEDOR'];
							$_SESSION['IDCOMPRADOR']=$datos_compra[0]['IDCOMPRADOR'];
							$datos_telefono = require_once('../logica/procesarCargaTelefonos.php');
							$_SESSION['IDPUBLICACION']=$datos_compra[0]['IDPUBLICACION'];
							$datos_chat = require_once('../logica/procesarCargaChatCompra.php');
							$nombrecompleto = $datos_compra[0]['PNOMBRE'];
							if (is_null($datos_compra[0]['SNOMBRE'])){
								$nombrecompleto = $nombrecompleto." ".$datos_compra[0]['SNOMBRE'];
							}
							$nombrecompleto = $nombrecompleto." ".$datos_compra[0]['PAPELLIDO'];
							if (is_null($datos_compra[0]['SAPELLIDO'])){
								$nombrecompleto = $nombrecompleto." ".$datos_compra[0]['SAPELLIDO'];
							}
							/* UNSETEO */
							unset($_SESSION['ComID']);
							unset($_SESSION['IDVENDEDOR']);
							unset($_SESSION['IDCOMPRADOR']);
							unset($_SESSION['IDPUBLICACION']);
							/* VARDUMPS */
							/*
							var_dump($_SESSION);
							echo "<hr>";
							var_dump($datos_compra);
							echo "<hr>";
							var_dump($datos_telefono);
							echo "<hr>";
							var_dump($datos_chat);
							echo "<hr>";
							*/
							?>
							<form class="form-horizontal" action="../logica/procesarBanearCompra.php" method="POST">
								<fieldset>
									<h3>Datos de la Compra</h3>
									<input name="idcomp" type="text" value="<?php echo $_GET['id'] ?>" hidden>

									<div class="form-group">
										<label class="col-md-5 control-label">Producto</label>  
										<label class="col-md-5 control-label" style="text-align: left;">
											<a target="_Blank" href="../view/mgmtpublicaciones.php?id=<?php echo $datos_compra[0]['IDPUBLICACION'] ?>">
												<input class="btn btn-xs btn-info" type="button" value="Ver"/>
											</a>
											<?php echo utf8_encode($datos_compra['0']['TITULO']) ?>
										</label> 
									</div>
									<div class="form-group">
										<label class="col-md-5 control-label">Precio unitario</label>  
										<label class="col-md-5 control-label" style="text-align: left;"><?php echo utf8_encode($datos_compra['0']['TOTAL']); ?></label> 
									</div>
									<div class="form-group">
										<label class="col-md-5 control-label">Cantidad</label>  
										<label class="col-md-5 control-label" style="text-align: left;"><?php echo utf8_encode($datos_compra['0']['CANTIDAD']); ?></label> 
									</div>
									<div class="form-group">
										<label class="col-md-5 control-label">Total</label>  
										<label class="col-md-5 control-label" style="text-align: left;"><?php echo utf8_encode($datos_compra['0']['TOTAL']); ?></label> 
									</div>
									<div class="form-group">
										<label class="col-md-5 control-label">Venta confirmada</label>  
										<label class="col-md-5 control-label" style="text-align: left;">
											<?php
											if ( $datos_compra[0]['VENTACONCRETA'] == 0) {
												?>
												No confirmada
												<?php 
											}else{
												?>
												Confirmada
												<?php
											}
											?>
										</label> 
									</div>
									<div class="form-group">
										<label class="col-md-5 control-label">Compra confirmada</label> 
										<label class="col-md-5 control-label" style="text-align: left;">
											<?php
											if ( $datos_compra[0]['COMPRACONCRETA'] == 0) {
												?>
												No confirmada
												<?php 
											}else{
												?>
												Confirmada
												<?php
											}
											?>
										</label> 
									</div>
									<div class="form-group">
										<label class="col-md-5 control-label">Calificacion del vendedor</label>  
										<label class="col-md-5 control-label" style="text-align: left;">
											<?php
											if ( $datos_compra[0]['IDCALVENDEDOR'] == 0) {
												?>
												No calificada
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
										</label> 
									</div>
									<div class="form-group">
										<label class="col-md-5 control-label">Calificacion del comprador</label> 
										<label class="col-md-5 control-label" style="text-align: left;">
											<?php
											if ( $datos_compra[0]['IDCALCOMPRADOR'] == 0) {
												?>
												<p>No calificada</p>
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
										</label> 
									</div>
									<h3>Datos del Vendedor</h3>
									<div class="form-group">
										<label class="col-md-5 control-label">Nombre Completo</label>  
										<label class="col-md-5 control-label" style="text-align: left;">
											<a target="_Blank" href="../view/mgmtusers.php?id=<?php echo $datos_compra[0]['IDVENDEDOR'] ?>">
												<input class="btn btn-xs btn-info" type="button" value="Ver"/>
											</a>
											<?php echo utf8_encode($nombrecompleto) ?>
										</label> 
									</div>
									<div class="form-group">
										<label class="col-md-5 control-label">Cedula</label>  
										<label class="col-md-5 control-label" style="text-align: left;"><?php echo utf8_encode($datos_compra['0']['CEDULA']); ?></label> 
									</div>
									<h3>Datos del Comprador</h3>
									<div class="form-group">
										<label class="col-md-5 control-label">Nombre Completo</label>  
										<label class="col-md-5 control-label" style="text-align: left;">
											<a target="_Blank" href="../view/mgmtusers.php?id=<?php echo $datos_compra[0]['IDVENDEDOR'] ?>">
												<input class="btn btn-xs btn-info" type="button" value="Ver"/>
											</a>
											<?php echo utf8_encode($datos_compra[0]['PNOMBRECOMPRADOR'].' '.$datos_compra[0]['PAPELLIDOCOMPRADOR']) ?>
										</label> 
									</div>
									<div class="form-group">
										<label class="col-md-5 control-label">Cedula</label>  
										<label class="col-md-5 control-label" style="text-align: left;"><?php echo utf8_encode($datos_compra[0]['CEDULACOMPRADOR']); ?></label> 
									</div>
									<h3>Chat de Venta</h3>
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
									<h3>Estado</h3>
									<div class="form-group">
										<label class="col-md-5 control-label">Estado de la Compra</label>  
										<div class="col-md-5">
											<div class="input-group my-group"> 
												<select class="selectpicker form-control" data-live-search="true" name="estadop">
													<option value="ACTIVO" <?php if ($datos_compra['0']['ESTADO']=="ACTIVO"){ echo "selected"; } ?> >Activo</option>
													<option value="BANEADO" <?php if ($datos_compra['0']['ESTADO']=="BANEADO"){ echo "selected"; } ?> >Baneado</option>
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
						}else{
							?>
							<div class="row">
								<div class="col-md-12 product_img">
									<p>Para cargar una compra, haga click en su enlace</p>
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
						<h4>Listado de Compras</h4>
						<?php				
						if (isset($datos_compras["this"])) {
							?>
							<p>No existen compras realizadas.</p>
							<?php
						}else{
							?>
							<div class="table-responsive">
								<table id="tablacompras" class="table table-condensed table-striped table-bordered" cellspacing="0" width="100%">
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
										for ($i=0; $i < count($datos_compras); $i++) { 
											/*DATOS_PUBLICACIONES.ID,CATEGORIA.TITULO,DATOS_PUBLICACIONES.TITULO,DATOS_PUBLICACIONES.PRECIO, DATOS_PUBLICACIONES.OFERTA*/
											?>
											<tr>
												<td><?php echo $datos_compras[$i]['ID'] ?></td>
												<td><?php echo utf8_encode($datos_compras[$i]['TITULO']) ?></td>
												<td class="text-center"><?php echo date("d/m/Y", strtotime($datos_compras[$i]['FECHACOMPRA'])) ?></td>
												<td class="text-right">
													<a href="../view/mgmtbuys.php?id=<?php echo $datos_compras[$i]['ID'] ?>">
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
						<h4>Compras Baneadas</h4>
						<?php				
						if (isset($datos_compras_baneadas["this"])) {
							?>
							<p>No existen compras baneadas.</p>
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
										for ($i=0; $i < count($datos_compras_baneadas); $i++) { 
											/*DATOS_PUBLICACIONES.ID,CATEGORIA.TITULO,DATOS_PUBLICACIONES.TITULO,DATOS_PUBLICACIONES.PRECIO, DATOS_PUBLICACIONES.OFERTA*/
											?>
											<tr>
												<td><?php echo $datos_compras_baneadas[$i]['ID'] ?></td>
												<td><?php echo utf8_encode($datos_compras_baneadas[$i]['TITULO']) ?></td>
												<td class="text-center"><?php echo date("d/m/Y", strtotime($datos_compras_baneadas[$i]['FECHACOMPRA'])) ?></td>
												<td class="text-right">
													<a href="../view/mgmtbuys.php?id=<?php echo $datos_compras_baneadas[$i]['ID'] ?>">
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
	$('#tablacompras').DataTable( {
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