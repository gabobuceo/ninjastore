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
<script src='https://api.tiles.mapbox.com/mapbox-gl-js/v0.53.1/mapbox-gl.js'></script>
<link href='https://api.tiles.mapbox.com/mapbox-gl-js/v0.53.1/mapbox-gl.css' rel='stylesheet' />
<link rel='stylesheet' href='<?php echo $staticsrv; ?>/css/dataTables.bootstrap.min.css'>

<script type="text/javascript" src="<?php echo $staticsrv; ?>/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo $staticsrv; ?>/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#tablapendientes').DataTable();
		$('#tablavencidas').DataTable();
		$('#tablapagas').DataTable();
	} );
</script>

<!--<script type="text/javascript" src="../static/ckeditor/ckeditor.js"></script>

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
</style>-->
<?php
/*-----------------------------------------------------------------------------------------------------------*/
/* Fin scripts de esta pagina.*/
/*-----------------------------------------------------------------------------------------------------------*/
/* Agregar todo control, puntual para esta pagina (Como la sesion).*/
/*-----------------------------------------------------------------------------------------------------------*/
require('header.php');
$datos_facturas_pendientes = require_once('../logica/procesarListadoFacturasPendientes.php');
$datos_facturas_vencidas = require_once('../logica/procesarListadoFacturasVencidas.php');
$datos_facturas_pagas = require_once('../logica/procesarListadoFacturasPagas.php');
/*var_dump($datos_facturas_pendientes);
echo "<hr>";
var_dump($datos_facturas_vencidas);
echo "<hr>";
var_dump($datos_facturas_pagas);
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
						<h4>Ver Facturas</h4>
						<?php
						if (isset($_GET['id'])) {
							$_SESSION["facid"]=$_GET["id"];	
							$datos_factura = require_once('../logica/procesarCargarFactura.php');
							unset($_SESSION["facid"]);
							/*var_dump($datos_factura);*/
							?>
							<div>
								<object data="../logica/procesarCargaPDF.php?id=<?php echo $_GET['id']; ?>" type="application/pdf" width="100%" height="500">
									Tu dispositivo no admite ver la factura desde la Web. Para descargar la factura y verla precione <a href="../logica/procesarCargaPDF.php">aquí</a>
								</object>
							</div>
							<?php 
							if ($_SESSION['rolbk']=="ADMINISTRADOR") {
								switch ($datos_factura[0]['ESTADO']) {
									case 'PENDIENTE':
										/*
										*/
										?>
										<br>
										<form class="form-horizontal" action="../logica/procesarPagoFactura.php" method="POST">
											<fieldset>
												<input name="idfac" type="text" value="<?php echo $_GET['id'] ?>" hidden>
												<div class="form-group">
													<label class="col-md-5 control-label" ></label>  
													<div class="col-md-5">
														<button type="submit" class="btn btn-success">
															<span class="glyphicon glyphicon-thumbs-up"></span> Confirmar Pago
														</button> 
													</div>
												</div>
											</fieldset>
										</form>
										<?php
									/*
									*/
									break;
									case 'VENCIDA':
										/*
										*/
										//var_dump($datos_factura);
										$subtotal=0;
										for ($i=0; $i < count($datos_factura); $i++) { 
											$subtotal=$subtotal+$datos_factura[$i]['SUBTOTAL'];
										}
										?>
										<br>
										<form class="form-horizontal" action="../logica/procesarFacturaVencida.php" method="POST">
											<fieldset>
												<input name="idfac" type="text" value="<?php echo $_GET['id'] ?>" hidden>
												<input name="idusu" type="text" value="<?php echo $datos_factura[0]['IDUSUARIO'] ?>" hidden>
												<input name="subtotal" type="text" value="<?php echo $subtotal ?>" hidden>

												<div class="form-group">
													<label class="col-md-5 control-label" ></label>  
													<div class="col-md-5">
														<button type="submit" class="btn btn-success">
															<span class="glyphicon glyphicon-thumbs-up"></span> Confirmar y agregar mora
														</button> 
													</div>
												</div>
											</fieldset>
										</form>
										<?php
									/*
									*/
									break;
								}
							}
						}else{
							?>
							<div class="row">
								<div class="col-md-12 product_img">
									<p>Para cargar una factura, haga click en su enlace</p>
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
						<h4>Facturas Pendientes</h4>
						<?php				
						if (isset($datos_facturas_pendientes["this"])) {
							?>
							<p>No existen facturas pendientes.</p>
							<?php
						}else{
							?>
							<div class="table-responsive">
								<table id="tablapendientes" class="table table-condensed table-striped table-bordered" cellspacing="0" width="100%">
									<thead>
										<tr>
											<td><strong>ID</strong></td>
											<td class="text-center"><strong>Publicacion</strong></td>
											<td class="text-center"><strong>Fecha Venta</strong></td>
											<td class="text-center"><strong>Vencimiento</strong></td>
											<td class="text-right"><strong>Ver</strong></td>
										</tr>
									</thead>
									<tbody>
										<?php
										for ($i=0; $i < count($datos_facturas_pendientes); $i++) { 
											/*DATOS_PUBLICACIONES.ID,CATEGORIA.TITULO,DATOS_PUBLICACIONES.TITULO,DATOS_PUBLICACIONES.PRECIO, DATOS_PUBLICACIONES.OFERTA*/
											?>
											<tr>
												<td><?php echo $datos_facturas_pendientes[$i]['ID'] ?></td>
												<td><?php echo utf8_encode($datos_facturas_pendientes[$i]['TITULO']) ?></td>
												<td class="text-center"><?php echo date("d/m/Y", strtotime($datos_facturas_pendientes[$i]['FECHAC'])) ?></td>
												<td class="text-center"><?php echo date("d/m/Y", strtotime($datos_facturas_pendientes[$i]['FECHAV'])) ?></td>
												<td class="text-right">
													<a href="../view/mgmtbills.php?id=<?php echo $datos_facturas_pendientes[$i]['ID'] ?>">
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
						<h4>Facturas Vencidas</h4>
						<?php				
						if (isset($datos_facturas_vencidas["this"])) {
							?>
							<p>No existen facturas vencidas.</p>
							<?php
						}else{
							?>
							<div class="table-responsive">
								<table id="tablavencidas" class="table table-condensed table-striped table-bordered" cellspacing="0" width="100%">
									<thead>
										<tr>
											<td><strong>ID</strong></td>
											<td class="text-center"><strong>Publicacion</strong></td>
											<td class="text-center"><strong>Compra</strong></td>
											<td class="text-center"><strong>Vencimiento</strong></td>
											<td class="text-right"><strong>Ver</strong></td>
										</tr>
									</thead>
									<tbody>
										<?php
										for ($i=0; $i < count($datos_facturas_vencidas); $i++) { 
											/*DATOS_PUBLICACIONES.ID,CATEGORIA.TITULO,DATOS_PUBLICACIONES.TITULO,DATOS_PUBLICACIONES.PRECIO, DATOS_PUBLICACIONES.OFERTA*/
											?>
											<tr>
												<td><?php echo $datos_facturas_vencidas[$i]['ID'] ?></td>
												<td><?php echo utf8_encode($datos_facturas_vencidas[$i]['TITULO']) ?></td>
												<td class="text-center"><?php echo date("d/m/Y", strtotime($datos_facturas_vencidas[$i]['FECHAC'])) ?></td>
												<td class="text-center"><?php echo date("d/m/Y", strtotime($datos_facturas_vencidas[$i]['FECHAV'])) ?></td>
												<td class="text-right">
													<a href="../view/mgmtbills.php?id=<?php echo $datos_facturas_vencidas[$i]['ID'] ?>">
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
						<h4>Facturas Pagas</h4>
						<?php				
						if (isset($datos_facturas_pagas["this"])) {
							?>
							<p>No existen facturas pagas.</p>
							<?php
						}else{
							?>
							<div class="table-responsive">
								<table id="tablapagas" class="table table-condensed table-striped table-bordered" cellspacing="0" width="100%">
									<thead>
										<tr>
											<td><strong>ID</strong></td>
											<td class="text-center"><strong>Publicacion</strong></td>
											<td class="text-center"><strong>Fecha Pago</strong></td>
											<td class="text-right"><strong>Ver</strong></td>
										</tr>
									</thead>
									<tbody>
										<?php
										for ($i=0; $i < count($datos_facturas_pagas); $i++) { 
											/*DATOS_PUBLICACIONES.ID,CATEGORIA.TITULO,DATOS_PUBLICACIONES.TITULO,DATOS_PUBLICACIONES.PRECIO, DATOS_PUBLICACIONES.OFERTA*/
											?>
											<tr>
												<td><?php echo $datos_facturas_pagas[$i]['ID'] ?></td>
												<td><?php echo utf8_encode($datos_facturas_pagas[$i]['TITULO']) ?></td>
												<td class="text-center"><?php echo date("d/m/Y", strtotime($datos_facturas_pagas[$i]['FECHAP'])) ?></td>
												<td class="text-right">
													<a href="../view/mgmtbills.php?id=<?php echo $datos_facturas_pagas[$i]['ID'] ?>">
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
	$('#tablapendientes').DataTable( {
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
	$('#tablavencidas').DataTable( {
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
	$('#tablapagas').DataTable( {
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