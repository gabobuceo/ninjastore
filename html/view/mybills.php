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
<link rel='stylesheet' href='<?php echo $staticsrv; ?>/css/dataTables.bootstrap.min.css'>
<script type="text/javascript" src="<?php echo $staticsrv; ?>/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo $staticsrv; ?>/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#tablapendientes').DataTable();
		$('#tablafacturas').DataTable();
	} );
</script>
<?php 
/*-----------------------------------------------------------------------------------------------------------*/
/* Fin scripts de esta pagina.*/
/*-----------------------------------------------------------------------------------------------------------*/
/* Agregar todo control, puntual para esta pagina (Como la sesion).*/
/*-----------------------------------------------------------------------------------------------------------*/
require('header.php');

$datos_facturas_todas = require_once('../logica/procesarListadoFacturas.php');
//var_dump($datos_facturas_todas);

$datos_facturas_pendientes = require_once('../logica/procesarListadoFacturasPendientes.php');
//var_dump($datos_facturas_pendientes);

/*-----------------------------------------------------------------------------------------------------------*/
/* Agregar todo el contenido de esta pagina aqui.*/
/*-----------------------------------------------------------------------------------------------------------*/
?>
<div class="row affix-row">
	<div class="col-sm-3 col-md-2 affix-sidebar">
		<?php 
		$_SESSION['menu']=11;
		require('menu.php');
		unset($_SESSION['menu']);
		?>
	</div>
	<div class="col-sm-9 col-md-10">
		<div class="row maincpanel">
			<div class="col-md-7">
				<div class="single-page main-grid-border">
					<div class="leftcpanel">
						<h4>Ver Factura</h4>
						<?php
						if (isset($_GET['id'])) {
							$_SESSION["facid"]=$_GET["id"];	
							$datos_factura = require_once('../logica/procesarCargarFactura.php');
							unset($_SESSION["facid"]);
							//var_dump($_SESSION);
							?>
							<div>
								<object data="../logica/procesarCargaPDF.php?id=<?php echo $_GET['id']; ?>" type="application/pdf" width="100%" height="500">
									Tu dispositivo no admite ver la factura desde la Web. Para descargar la factura y verla precione <a href="../logica/procesarCargaPDF.php">aquí</a>
								</object>
							</div>
							<?php 
							unset($_GET['id']);
							?>
							<?php
						}else{
							?>
							<div class="row">
								<div class="col-md-12 product_img">
									<p>Para cargar la vista previa de la factura haga click en su enlace</p>
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
					<div class="rightcpanel">
						<h4>Historial de facturas</h4>
						<?php				
						if (isset($datos_facturas_todas["this"])) {
							?>
							<p>No tienes calificaciones como vendedor.</p>
							<?php
						}else{
							?>
							<div class="table-responsive">
								<table id="tablafacturas" class="table table-condensed table-striped table-bordered" cellspacing="0" width="100%">
									<thead>
										<tr>
											<td><strong>Articulo</strong></td>
											<td class="text-center"><strong>Estado</strong></td>
											<td class="text-center"><strong>Fecha</strong></td>
											<td class="text-right"><strong>Ver</strong></td>
										</tr>
									</thead>
									<tbody>
										<?php
										for ($i=0; $i < count($datos_facturas_todas); $i++) { 
											/*DATOS_PUBLICACIONES.ID,CATEGORIA.TITULO,DATOS_PUBLICACIONES.TITULO,DATOS_PUBLICACIONES.PRECIO, DATOS_PUBLICACIONES.OFERTA*/
											?>
											<tr>
												<td><?php echo utf8_encode($datos_facturas_todas[$i]['TITULO']) ?></td>
												<td class="text-center"><?php echo $datos_facturas_todas[$i]['ESTADO'] ?></td>
												<?php
												if (is_null($datos_facturas_todas[$i]["FECHAP"])) {
													?>
													<td class="text-center"><?php echo $datos_facturas_todas[$i]['ESTADO'] ?></td>
													<?php
												}else{
													?>
													<td class="text-center"><?php echo date("d/m/Y", strtotime($datos_facturas_todas[$i]['FECHAP'])) ?></td>
													<?php
												}
												?>
												<td class="text-right">
													<a href="../view/mybills.php?id=<?php echo $datos_facturas_todas[$i]['ID'] ?>">
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
	$('#tablafacturas').DataTable( {
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