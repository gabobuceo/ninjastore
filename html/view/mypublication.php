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
<script type="text/javascript" src="../static/js/canvasjs.min.js"></script>

<!--<link rel='stylesheet' href='../static/css/jquery.dataTables.min.css'>-->
<link rel='stylesheet' href='../static/css/dataTables.bootstrap.min.css'>
<script type="text/javascript" src="../static/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../static/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#tablapublicacionesActivas').DataTable();
		$('#tablapublicacionesDesactivadas').DataTable();
		$('#tablapublicacionesFinalizadas').DataTable();
		$('#tablapublicaciones').DataTable();
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
$datos_publicacion_guardadas = require_once('../logica/procesarListadoPublicacionesGuardadas.php');
$datos_publicacion_cerradas = require_once('../logica/procesarListadoPublicacionesCerradas.php');
$datos_publicacion = require_once('../logica/procesarListadoPublicaciones.php');
/*var_dump($datos_publicacion_activas);
echo "<hr>";
var_dump($datos_publicacion_guardadas);
echo "<hr>";
var_dump($datos_publicacion_cerradas);
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
		$_SESSION['menu']=3;
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
						<h4>Publicaciones Desactivadas</h4>
						<?php				
						if (isset($datos_publicacion_guardadas["this"])) {
							?>
							<p>No tienes publicaciones desactivadas.</p>
							<?php
						}else{
							?>
							<div class="table-responsive">
								<table id="tablapublicacionesDesactivadas" class="table table-condensed table-striped table-bordered" cellspacing="0" width="100%">
									<thead>
										<tr>
											<td><strong>Publicacion</strong></td>
											<td class="text-center"><strong>Categoria</strong></td>
											<td class="text-center"><strong>Precio</strong></td>
											<td class="text-center"><strong>Estado</strong></td>
											<td class="text-center"><strong>Oferta</strong></td>
											<td class="text-center"><strong>Act.</strong></td>
											<td class="text-center"><strong>Editar</strong></td>
											<td class="text-right"><strong>Ver</strong></td>
										</tr>
									</thead>
									<tbody>
										<?php
										for ($i=0; $i < count($datos_publicacion_guardadas); $i++) { 
											/*DATOS_PUBLICACIONES.ID,CATEGORIA.TITULO,DATOS_PUBLICACIONES.TITULO,DATOS_PUBLICACIONES.PRECIO, DATOS_PUBLICACIONES.OFERTA*/
											?>
											<tr>
												<td><?php echo utf8_encode($datos_publicacion_guardadas[$i]['TITULO']) ?></td>
												<td class="text-center"><?php echo utf8_encode($datos_publicacion_guardadas[$i]['CATEGORIA']) ?></td>
												<td class="text-center"><?php echo $datos_publicacion_guardadas[$i]['PRECIO'] ?></td>
												<td class="text-center"><?php echo $datos_publicacion_guardadas[$i]['ESTADOA'] ?></td>
												<td class="text-center"><?php echo $datos_publicacion_guardadas[$i]['OFERTA'] ?></td>
												<td class="text-center">
													<a href="../logica/procesarActivarPublicacion.php?id=<?php echo $datos_publicacion_guardadas[$i]['ID'] ?>">
														<button class="btn btn-xs btn-success">
															<i class="fa fa-check" aria-hidden="true"></i>
														</button>
													</a>
												</td>
												<td class="text-center">
													<a href="../view/sell.php?edit=y&&id=<?php echo $datos_publicacion_guardadas[$i]['ID'] ?>">
														<button class="btn btn-xs btn-warning">
															<i class="fa fa-pencil" aria-hidden="true"></i>
														</button>
													</a>
												</td>
												<td class="text-right">
													<a target="_blank" href="../view/publication.php?id=<?php echo $datos_publicacion_guardadas[$i]['ID'] ?>">
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
						<h4>Publicaciones Finalizadas</h4>
						<?php				
						if (isset($datos_publicacion_cerradas["this"])) {
							?>
							<p>No tienes publicaciones finalizadas.</p>
							<?php
						}else{
							?>
							<div class="table-responsive">
								<table id="tablapublicacionesFinalizadas" class="table table-condensed table-striped table-bordered" cellspacing="0" width="100%">
									<thead>
										<tr>
											<td><strong>Publicacion</strong></td>
											<td class="text-center"><strong>Categoria</strong></td>
											<td class="text-center"><strong>Precio</strong></td>
											<td class="text-center"><strong>Estado</strong></td>
											<td class="text-center"><strong>Oferta</strong></td>
											<td class="text-right"><strong>Enlace</strong></td>
										</tr>
									</thead>
									<tbody>
										<?php
										for ($i=0; $i < count($datos_publicacion_cerradas); $i++) { 
											/*DATOS_PUBLICACIONES.ID,CATEGORIA.TITULO,DATOS_PUBLICACIONES.TITULO,DATOS_PUBLICACIONES.PRECIO, DATOS_PUBLICACIONES.OFERTA*/
											?>
											<tr>
												<td><?php echo utf8_encode($datos_publicacion_cerradas[$i]['TITULO']) ?></td>
												<td class="text-center"><?php echo utf8_encode($datos_publicacion_cerradas[$i]['CATEGORIA']) ?></td>
												<td class="text-center"><?php echo $datos_publicacion_cerradas[$i]['PRECIO'] ?></td>
												<td class="text-center"><?php echo $datos_publicacion_cerradas[$i]['ESTADOA'] ?></td>
												<td class="text-center"><?php echo $datos_publicacion_cerradas[$i]['OFERTA'] ?></td>
												<td class="text-right"><a href="../view/publication.php?id=<?php echo $datos_publicacion_cerradas[$i]['ID'] ?>"><i class="fa fa-external-link" aria-hidden="true"></i> ID: <?php echo $datos_publicacion_cerradas[$i]['ID'] ?></a></td>
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
			<div class="col-md-5">
				<div class="single-page main-grid-border">
					<div class="rightcpanel">
						<h4>Listado de Publicaciones</h4>
						<?php				
						if (isset($datos_publicacion["this"])) {
							?>
							<p>No tienes publicaciones desactivadas.</p>
							<?php
						}else{
							?>
							<div class="table-responsive">
								<table id="tablapublicaciones" class="table table-condensed table-striped table-bordered" cellspacing="0" width="100%">
									<thead>
										<tr>
											<td><strong>Publicacion</strong></td>
											<td class="text-center"><strong>Fecha</strong></td>
											<td class="text-right"><strong>Ver</strong></td>
										</tr>
									</thead>
									<tbody>
										<?php
										for ($i=0; $i < count($datos_publicacion); $i++) { 
											/*DATOS_PUBLICACIONES.ID,CATEGORIA.TITULO,DATOS_PUBLICACIONES.TITULO,DATOS_PUBLICACIONES.PRECIO, DATOS_PUBLICACIONES.OFERTA*/
											?>
											<tr>
												<td><?php echo utf8_encode($datos_publicacion[$i]['TITULO']) ?></td>
												<td class="text-center"><?php echo date("d/m/Y", strtotime($datos_publicacion[$i]['FECHA'])) ?></td>
												<td class="text-right">
													<a target="_blanck" href="../view/publication.php?id=<?php echo $datos_publicacion[$i]['ID'] ?>">
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
	$('#tablapublicacionesDesactivadas').DataTable( {
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
	$('#tablapublicacionesFinalizadas').DataTable( {
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
</script>
<?php 
/*-----------------------------------------------------------------------------------------------------------*/
/* Fin contenido de esta pagina.*/
/*-----------------------------------------------------------------------------------------------------------*/
require('footer.php');
?>