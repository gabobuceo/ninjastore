<?php 
session_start();
if (!isset($_SESSION['id'])){
	header('Location: ../view/index.php');
}
require('definitions.php');
/*-----------------------------------------------------------------------------------------------------------*/
/* Agregar todo script, puntual para esta pagina.*/
/*-----------------------------------------------------------------------------------------------------------*/
?>
<script type="text/javascript" src="<?php echo $staticsrv; ?>/js/canvasjs.min.js"></script>

<link rel='stylesheet' href='<?php echo $staticsrv; ?>/css/dataTables.bootstrap.min.css'>
<script type="text/javascript" src="<?php echo $staticsrv; ?>/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo $staticsrv; ?>/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#tablapublicacionesActivas').DataTable();
		$('#tablaventas').DataTable();
		$('#tablacompras').DataTable();
		$('#tablapendientes').DataTable();
		$('#tablaabiertas').DataTable();
	} );
</script>
<?php 
/*-----------------------------------------------------------------------------------------------------------*/
/* Fin scripts de esta pagina.*/
/*-----------------------------------------------------------------------------------------------------------*/
/* Agregar todo control, puntual para esta pagina (Como la sesion).*/
/*-----------------------------------------------------------------------------------------------------------*/
require('header.php');
$datos_publicacion_activas = require_once('../logica/procesarListadoPublicacionesActivas.php');
$datos_ventas = require_once('../logica/procesarListadoVentas.php');
$datos_compras = require_once('../logica/procesarListadoCompras.php');
$datos_facturas_pendientes = require_once('../logica/procesarListadoFacturasPendientes.php');
$datos_abiertas = require_once('../logica/procesarListadoDenunciasAbiertas.php');
/*-----------------------------------------------------------------------------------------------------------*/
/* Agregar todo el contenido de esta pagina aqui.*/
/*-----------------------------------------------------------------------------------------------------------*/
?>
<div class="row affix-row">
	<div class="col-sm-3 col-md-2 affix-sidebar">
		<?php 
		$_SESSION['menu']=1;
		require('menu.php');
		unset($_SESSION['menu']);
		?>
	</div>
	<div class="col-sm-9 col-md-10">
		<div class="row maincpanel">
			<div class="col-md-7">
				<div class="single-page main-grid-border">
					<div class="leftcpanel">
						<h4>Publicaciones Activas</h4>
						<?php				
						if (isset($datos_publicacion_activas["this"])) {
							?>
							<p>No tienes publicaciones activas.</p>
							<?php
						}else{
							/*print_r($datos_publicacion_activas);*/
							?>
							<div class="table-responsive">
								<table id="tablapublicacionesActivas" class="table table-condensed table-striped table-bordered" cellspacing="0" width="100%">
									<thead>
										<tr>
											<td><strong>Publicacion</strong></td>
											<td class="text-center"><strong>Categoria</strong></td>
											<td class="text-center"><strong>Precio</strong></td>
											<td class="text-center"><strong>Estado</strong></td>
											<td class="text-center"><strong>Cant</strong></td>
											<td class="text-center"><strong>Oferta</strong></td>
											<td class="text-center"><strong>Desac.</strong></td>
											<td class="text-right"><strong>Ver</strong></td>
										</tr>
									</thead>
									<tbody>
										<?php
										for ($i=0; $i < count($datos_publicacion_activas); $i++) { 
											/*DATOS_PUBLICACIONES.ID,CATEGORIA.TITULO,DATOS_PUBLICACIONES.TITULO,DATOS_PUBLICACIONES.PRECIO, DATOS_PUBLICACIONES.OFERTA*/
											?>
											<tr>
												<td><?php echo utf8_encode($datos_publicacion_activas[$i]['TITULO']) ?></td>
												<td class="text-center"><?php echo utf8_encode($datos_publicacion_activas[$i]['CATEGORIA']) ?></td>
												<td class="text-center"><?php echo $datos_publicacion_activas[$i]['PRECIO'] ?></td>
												<td class="text-center"><?php echo $datos_publicacion_activas[$i]['ESTADOA'] ?></td>
												<td class="text-center"><?php echo $datos_publicacion_activas[$i]['CANTIDAD'] ?></td>
												<td class="text-center"><?php echo $datos_publicacion_activas[$i]['OFERTA'] ?></td>
												<td class="text-center">
													<a href="../logica/procesarDesactivarPublicacion.php?id=<?php echo $datos_publicacion_activas[$i]['ID'] ?>">
														<button class="btn btn-xs btn-warning">
															<i class="fa fa-times" aria-hidden="true"></i>
														</button>
													</a>
												</td>
												<td class="text-right">
													<a target="_blank" href="../view/publication.php?id=<?php echo $datos_publicacion_activas[$i]['ID'] ?>">
														<button class="btn btn-xs btn-info">
															<i class="fa fa-external-link"></i>
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
				<div class="single-page main-grid-border">
					<div class="leftcpanel">
						<h4>Listado de Ventas</h4>
						<?php				
						if (isset($datos_ventas["this"])) {
							?>
							<p>No has realizado ninguna compra.</p>
							<?php
						}else{
							?>
							<div class="table-responsive">
								<table id="tablaventas" class="table table-condensed table-striped table-bordered" cellspacing="0" width="100%">
									<thead>
										<tr>
											<td><strong>Publicacion</strong></td>
											<td class="text-center"><strong>Fecha</strong></td>
											<td class="text-center"><strong>Cantidad</strong></td>
											<td class="text-center"><strong>Total</strong></td>
											<td class="text-right"><strong>Ver</strong></td>
										</tr>
									</thead>
									<tbody>
										<?php
										for ($i=0; $i < count($datos_ventas); $i++) { 
											?>
											<tr>
												<td><?php echo utf8_encode($datos_ventas[$i]['TITULO']) ?></td>
												<td class="text-center"><?php echo date("d/m/Y", strtotime($datos_ventas[$i]['FECHACOMPRA'])) ?></td>
												<td class="text-center"><?php echo $datos_ventas[$i]['CANTIDAD'].' x $'.$datos_ventas[$i]['TOTAL'] ?></td>
												<td class="text-center"><?php echo '$'.($datos_ventas[$i]['TOTAL'] * $datos_ventas[$i]['CANTIDAD']) ?></td>
												<td class="text-right">
													<a target="_blank" href="../view/buyconfirmation.php?id=<?php echo $datos_ventas[$i]['ID'] ?>">
														<button class="btn btn-xs btn-info">
															<i class="fa fa-external-link"></i>
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
							<!--  </form> -->
							<?php
						}
						?>
					</div>
				</div>
				<div class="single-page main-grid-border">
					<div class="leftcpanel">
						<h4>Listado de Compras</h4>
						<?php				
						if (isset($datos_compras["this"])) {
							?>
							<p>No has realizado ninguna compra.</p>
							<?php
						}else{
							?>
							<div class="table-responsive">
								<table id="tablacompras" class="table table-condensed table-striped table-bordered" cellspacing="0" width="100%">
									<thead>
										<tr>
											<td><strong>Publicacion</strong></td>
											<td class="text-center"><strong>Fecha</strong></td>
											<td class="text-center"><strong>Cantidad</strong></td>
											<td class="text-center"><strong>Total</strong></td>
											<td class="text-right"><strong>Ver</strong></td>
										</tr>
									</thead>
									<tbody>
										<?php
										for ($i=0; $i < count($datos_compras); $i++) { 
											?>
											<tr>
												<td><?php echo utf8_encode($datos_compras[$i]['TITULO']) ?></td>
												<td class="text-center"><?php echo date("d/m/Y", strtotime($datos_compras[$i]['FECHACOMPRA'])) ?></td>
												<td class="text-center"><?php echo $datos_compras[$i]['CANTIDAD'].' x $'.$datos_compras[$i]['TOTAL'] ?></td>
												<td class="text-center"><?php echo '$'.($datos_compras[$i]['TOTAL'] * $datos_compras[$i]['CANTIDAD']) ?></td>
												<td class="text-right">
													<a target="_blank" href="../view/buyconfirmation.php?id=<?php echo $datos_compras[$i]['ID'] ?>">
														<button class="btn btn-xs btn-info">
															<i class="fa fa-external-link"></i>
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
							<!--  </form> -->
							<?php
						}
						?>
					</div>
				</div>
			</div>
			<div class="col-md-5">
				<div class="single-page main-grid-border">
					<?php
					if ($_SESSION['tipo']=="COMUN") {
						?>
						<div class="rightcpanel">
							<h4 data-fontsize="18" data-lineheight="28">Si fueras Premium</h4>
							<table class="table table-condensed">
								<tbody>
									<tr>
										<td>Tendrias articulos llamativos</td>
										<td><div class="aligncenter"><i class="fa fa-check" style="font-size:19px;margin-left:0;margin-right:0;color:#f15922;"></i></div></td>
									</tr>
									<tr>
										<td>Preferencia en el indexado de busqueda</td>
										<td><div class="aligncenter"><i class="fa fa-check" style="font-size:19px;margin-left:0;margin-right:0;color:#f15922;"></i></div></td>
									</tr>
									<tr>
										<td>Tendrias preferencia en Atención al Usuario</td>
										<td><div class="aligncenter"><i class="fa fa-check" style="font-size:19px;margin-left:0;margin-right:0;color:#f15922;"></i></div></td>
									</tr>
									<tr>
										<td>Tendrias reporte de ventas mensual</td>
										<td><div class="aligncenter"><i class="fa fa-check" style="font-size:19px;margin-left:0;margin-right:0;color:#f15922;"></i></div></td>
									</tr>
									<tr>
										<td>Tendrias control de stock</td>
										<td><div class="aligncenter"><i class="fa fa-check" style="font-size:19px;margin-left:0;margin-right:0;color:#f15922;"></i></div></td>
									</tr>
									<tr>
										<td class="no-line"></td>
										<td class="no-line"></td>
									</tr>
								</tbody>
							</table>
							<form action="premium.php" method="POST">
								<div class="buy-in-form">
									<input type="submit" value="Quiero ser Premium">
								</div>
							</form>
						</div>
						<?php
					}else{
						?>
						<div class="rightcpanel">
							<h4>Eres Premum</h4>
							<img class="img-responsive" src="<?php echo $staticsrv; ?>/img/premium.png" />
						</div>
						<?php
					}
					?>
				</div>
				<div class="single-page main-grid-border">
					<div class="rightcpanel">
						<h4>Facturas Pendientes</h4>
						<?php				
						if (isset($datos_facturas_pendientes["this"])) {
							?>
							<p>No tienes calificaciones como vendedor.</p>
							<?php
						}else{
							?>
							<div class="table-responsive">
								<table id="tablapendientes" class="table table-condensed table-striped table-bordered" cellspacing="0" width="100%">
									<thead>
										<tr>
											<td><strong>Articulo</strong></td>
											<td class="text-center"><strong>Creada</strong></td>
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
												<td><?php echo utf8_encode($datos_facturas_pendientes[$i]['TITULO']) ?></td>
												<td class="text-center"><?php echo date("d/m/Y", strtotime($datos_facturas_pendientes[$i]['FECHAC'])) ?></td>
												<td class="text-center"><?php echo date("d/m/Y", strtotime($datos_facturas_pendientes[$i]['FECHAV'])) ?></td>
												<td class="text-right">
													<a href="../view/mybills.php?id=<?php echo $datos_facturas_pendientes[$i]['ID'] ?>">
														<button class="btn btn-xs btn-info">
															<i class="fa fa-external-link"></i>
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
				<div class="single-page main-grid-border">
					<div class="rightcpanel">
						<h4>Denuncias abiertass</h4>
						<?php				
						if (isset($datos_abiertas["this"])) {
							?>
							<p>No tienes denuncias abiertas.</p>
							<?php
						}else{
							?>
							<div class="table-responsive">
								<table id="tablaabiertas" class="table table-condensed table-striped table-bordered" cellspacing="0" width="100%">
									<thead>
										<tr>
											<td><strong>Tipo</strong></td>
											<td class="text-center"><strong>Fecha</strong></td>
											<td class="text-center"><strong>Estado</strong></td>
											<td class="text-right"><strong>Ver</strong></td>
										</tr>
									</thead>
									<tbody>
										<?php
										for ($i=0; $i < count($datos_abiertas); $i++) { 
											?>
											<tr>
												<td><?php echo $datos_abiertas[$i]['TIPO'] ?></td>
												<td class="text-center"><?php echo date("d/m/Y H:i", strtotime($datos_abiertas[$i]['FECHADENUNCIA'])); ?></td>
												<td class="text-center"><?php echo $datos_abiertas[$i]['ESTADO']; ?></td>
												<td class="text-right">
													<a href="../view/myreports.php?id=<?php echo $datos_abiertas[$i]['IDDENUNCIA'] ?>">
														<button class="btn btn-xs btn-info">
															<i class="fa fa-external-link"></i>
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
	$('#tablapublicacionesActivas').DataTable( {
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
	$('#tablaventas').DataTable( {
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
	$('#tablaabiertas').DataTable( {
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