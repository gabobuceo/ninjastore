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
		$('#tablavendedor').DataTable();
		$('#tablacomprador').DataTable();
	} );
</script>
<?php 
/*-----------------------------------------------------------------------------------------------------------*/
/* Fin scripts de esta pagina.*/
/*-----------------------------------------------------------------------------------------------------------*/
/* Agregar todo control, puntual para esta pagina (Como la sesion).*/
/*-----------------------------------------------------------------------------------------------------------*/
require('header.php');
$datos_compras_cerradas = require_once('../logica/procesarListadoComprasCerradas.php');
$datos_ventas_cerradas = require_once('../logica/procesarListadoVentasCerradas.php');
/*-----------------------------------------------------------------------------------------------------------*/
/* Agregar todo el contenido de esta pagina aqui.*/
/*-----------------------------------------------------------------------------------------------------------*/
/*var_dump($datos_compras_cerradas);
echo "<hr>";
var_dump($datos_ventas_cerradas);*/
$ventas1=0;
$ventas2=0;
$ventas3=0;
$ventas4=0;
$ventas5=0;
$compras1=0;
$compras2=0;
$compras3=0;
$compras4=0;
$compras5=0;
if (!isset($datos_compras_cerradas["this"])) {
	for ($i=0; $i < count($datos_compras_cerradas); $i++) { 
		switch ($datos_compras_cerradas[$i]['CALCOMPRADOR']) {
			case '1':
			$compras1++;
			break;
			case '2':
			$compras2++;
			break;
			case '3':
			$compras3++;
			break;
			case '4':
			$compras4++;
			break;
			case '5':
			$compras5++;
			break;
		}
	}
}
if (!isset($datos_ventas_cerradas["this"])) {
	for ($i=0; $i < count($datos_ventas_cerradas); $i++) { 
		switch ($datos_ventas_cerradas[$i]['CALVENDEDOR']) {
			case '1':
			$ventas1++;
			break;
			case '2':
			$ventas2++;
			break;
			case '3':
			$ventas3++;
			break;
			case '4':
			$ventas4++;
			break;
			case '5':
			$ventas5++;
			break;
		}
	}
}
/*
var_dump($compras1);
var_dump($compras2);
var_dump($compras3);
var_dump($compras4);
var_dump($compras5);
var_dump($ventas1);
var_dump($ventas2);
var_dump($ventas3);
var_dump($ventas4);
var_dump($ventas5);
*/
?>
<script>
	window.onload = function () {
		var chartbuy = new CanvasJS.Chart("chartseller", {
			exportEnabled: true,
			animationEnabled: true,
			title:{
				text: "Calificacion como Vendedor"
			}, 
			axisX: {
				title: "Calificacion"
			},
			axisY: {
				title: "Ventas",
				titleFontColor: "#4F81BC",
				lineColor: "#4F81BC",
				labelFontColor: "#4F81BC",
				tickColor: "#4F81BC"
			},
			toolTip: {
				shared: true
			},
			legend: {
				cursor: "pointer",
				itemclick: toggleDataSeries
			},
			data: [{
				type: "column",
				name: "Calificacion",
				showInLegend: true,      
				yValueFormatString: "#,##0.# votos",
				dataPoints: [
				{ label: "Estrella 1",  y: <?php echo $ventas1 ?> },
				{ label: "Estrella 2", y: <?php echo $ventas2 ?> },
				{ label: "Estrella 3", y: <?php echo $ventas3 ?> },
				{ label: "Estrella 4",  y: <?php echo $ventas4 ?> },
				{ label: "Estrella 5",  y: <?php echo $ventas5 ?> }
				]
			}]
		});
		chartbuy.render();

		var chartsell = new CanvasJS.Chart("chartbuyer", {
			exportEnabled: true,
			animationEnabled: true,
			title:{
				text: "Calificacion como Comprador"
			}, 
			axisX: {
				title: "Calificacion"
			},
			axisY: {
				title: "Compras",
				titleFontColor: "#4F81BC",
				lineColor: "#4F81BC",
				labelFontColor: "#4F81BC",
				tickColor: "#4F81BC"
			},
			toolTip: {
				shared: true
			},
			legend: {
				cursor: "pointer",
				itemclick: toggleDataSeries
			},
			data: [{
				type: "column",
				name: "Calificacion",
				showInLegend: true,      
				yValueFormatString: "#,##0.# votos",
				dataPoints: [
				{ label: "Estrella 1",  y: <?php echo $compras1 ?> },
				{ label: "Estrella 2", y: <?php echo $compras2 ?> },
				{ label: "Estrella 3", y: <?php echo $compras3 ?> },
				{ label: "Estrella 4",  y: <?php echo $compras4 ?> },
				{ label: "Estrella 5",  y: <?php echo $compras5 ?> }
				]
			}]
		});
		chartsell.render();
		function toggleDataSeries(e) {
			if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
				e.dataSeries.visible = false;
			} else {
				e.dataSeries.visible = true;
			}
			e.chart.render();
		}
	}
</script>
<div class="row affix-row">
	<div class="col-sm-3 col-md-2 affix-sidebar">
		<?php 
		$_SESSION['menu']=10;
		require('menu.php');
		unset($_SESSION['menu']);
		?>
	</div>
	<div class="col-sm-9 col-md-10">
		<div class="row maincpanel">
			<div class="col-md-7">
				<div class="single-page main-grid-border">
					<div class="leftcpanel">
						<h4>Calificación como Vendedor</h4>
						<div id="chartseller" style="height: 370px;"></div>
					</div>
					<div class="leftcpanel">
						<h4>Calificación como Comprador</h4>
						<div id="chartbuyer" style="height: 370px;"></div>
					</div>
				</div>
			</div>
			<div class="col-md-5">
				<div class="single-page main-grid-border">
					<div class="rightcpanel">
						<h4>Listado de Calificaciones como Vendedor</h4>
						<?php				
						if (isset($datos_ventas_cerradas["this"])) {
							?>
							<p>No tienes calificaciones como vendedor.</p>
							<?php
						}else{
							/*print_r($datos_publicacion_activas);*/
							?>
							<div class="table-responsive">
								<table id="tablavendedor" class="table table-condensed table-striped table-bordered" cellspacing="0" width="100%">
									<thead>
										<tr>
											<td><strong>Articulo</strong></td>
											<td class="text-center"><strong>Calificación</strong></td>
											<td class="text-center"><strong>Ultima Fecha</strong></td>
											<td class="text-right"><strong>Enlace</strong></td>
										</tr>
									</thead>
									<tbody>
										<?php
										for ($i=0; $i < count($datos_ventas_cerradas); $i++) { 
											/*DATOS_PUBLICACIONES.ID,CATEGORIA.TITULO,DATOS_PUBLICACIONES.TITULO,DATOS_PUBLICACIONES.PRECIO, DATOS_PUBLICACIONES.OFERTA*/
											?>
											<tr>
												<td><?php echo utf8_encode($datos_ventas_cerradas[$i]['TITULO']) ?></td>
												<td class="text-center"><?php echo $datos_ventas_cerradas[$i]['CALCOMPRADOR'] ?></td>
												<td class="text-center"><?php echo date("d/m/Y", strtotime($datos_ventas_cerradas[$i]['FECHACALCOMPRADOR'])) ?></td>
												<td class="text-right">
													<a target="_blank" href="../view/publication.php?id=<?php echo $datos_compras_cerradas[$i]['IDPUBLICACION'] ?>">
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
						<h4>Listado de Calificaciones como Comprador</h4>
						<?php				
						if (isset($datos_compras_cerradas["this"])) {
							?>
							<p>No tienes calificaciones como vendedor.</p>
							<?php
						}else{
							/*print_r($datos_publicacion_activas);*/
							?>
							<div class="table-responsive">
								<table id="tablacomprador" class="table table-condensed table-striped table-bordered" cellspacing="0" width="100%">
									<thead>
										<tr>
											<td><strong>Articulo</strong></td>
											<td class="text-center"><strong>Calificación</strong></td>
											<td class="text-center"><strong>Ultima Fecha</strong></td>
											<td class="text-right"><strong>Enlace</strong></td>
										</tr>
									</thead>
									<tbody>
										<?php
										for ($i=0; $i < count($datos_compras_cerradas); $i++) { 
											/*DATOS_PUBLICACIONES.ID,CATEGORIA.TITULO,DATOS_PUBLICACIONES.TITULO,DATOS_PUBLICACIONES.PRECIO, DATOS_PUBLICACIONES.OFERTA*/
											?>
											<tr>
												<td><?php echo utf8_encode($datos_compras_cerradas[$i]['TITULO']) ?></td>
												<td class="text-center"><?php echo $datos_compras_cerradas[$i]['CALCOMPRADOR'] ?></td>
												<td class="text-center"><?php echo date("d/m/Y", strtotime($datos_compras_cerradas[$i]['FECHACALCOMPRADOR'])) ?></td>
												<td class="text-right">
													<a target="_blank" href="../view/publication.php?id=<?php echo $datos_compras_cerradas[$i]['IDPUBLICACION'] ?>">
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
	$('#tablavendedor').DataTable( {
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
	$('#tablacomprador').DataTable( {
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