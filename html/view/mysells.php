<?php 
session_start();
require('definitions.php');
/*-----------------------------------------------------------------------------------------------------------*/
/* Agregar todo script, puntual para esta pagina.*/
/*-----------------------------------------------------------------------------------------------------------*/
?>
<script type="text/javascript" src="../static/js/canvasjs.min.js"></script>
<script>
	/*
	window.onload = function () {
		var chartbuy = new CanvasJS.Chart("chartseller", {
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
				name: "Compras",
				showInLegend: true,      
				yValueFormatString: "#,##0.# votos",
				dataPoints: [
				{ label: "Estrella 1",  y: 2 },
				{ label: "Estrella 2", y: 1 },
				{ label: "Estrella 3", y: 4 },
				{ label: "Estrella 4",  y: 8 },
				{ label: "Estrella 5",  y: 200 }
				]
			}]
		});
		chartbuy.render();
		var chartselling = new CanvasJS.Chart("chartselling", {
			theme: "light2",
			animationEnabled: true,
			title:{
				text: "Grafica de compras mensuales - 2017"   
			},
			axisX: {
				interval: 1,
				intervalType: "month",
				valueFormatString: "MMM"
			},
			axisY:{
				title: "Gastos (en $U)",
				valueFormatString: "$#0"
			},
			data: [{        
				type: "line",
				markerSize: 12,
				xValueFormatString: "MMM, YYYY",
				yValueFormatString: "$###.#",
				dataPoints: [        
				{ x: new Date(2016, 00, 1), y: 61, indexLabel: "gain", markerType: "triangle",  markerColor: "#6B8E23" },
				{ x: new Date(2016, 01, 1), y: 71, indexLabel: "gain", markerType: "triangle",  markerColor: "#6B8E23" },
				{ x: new Date(2016, 02, 1) , y: 55, indexLabel: "loss", markerType: "cross", markerColor: "tomato" },
				{ x: new Date(2016, 03, 1) , y: 50, indexLabel: "loss", markerType: "cross", markerColor: "tomato" },
				{ x: new Date(2016, 04, 1) , y: 65, indexLabel: "gain", markerType: "triangle", markerColor: "#6B8E23" },
				{ x: new Date(2016, 05, 1) , y: 85, indexLabel: "gain", markerType: "triangle", markerColor: "#6B8E23" },
				{ x: new Date(2016, 06, 1) , y: 68, indexLabel: "loss", markerType: "cross", markerColor: "tomato" },
				{ x: new Date(2016, 07, 1) , y: 28, indexLabel: "loss", markerType: "cross", markerColor: "tomato" },
				{ x: new Date(2016, 08, 1) , y: 34, indexLabel: "gain", markerType: "triangle", markerColor: "#6B8E23" },
				{ x: new Date(2016, 09, 1) , y: 24, indexLabel: "loss", markerType: "cross", markerColor: "tomato" },
				{ x: new Date(2016, 10, 1) , y: 44, indexLabel: "gain", markerType: "triangle", markerColor: "#6B8E23" },
				{ x: new Date(2016, 11, 1) , y: 34, indexLabel: "loss", markerType: "cross", markerColor: "tomato" }
				]}]
			});
		chartselling.render();
		function toggleDataSeries(e) {
			if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
				e.dataSeries.visible = false;
			} else {
				e.dataSeries.visible = true;
			}
			e.chart.render();
		}
	}
	*/
</script>

<!--<link rel='stylesheet' href='../static/css/jquery.dataTables.min.css'>-->
<link rel='stylesheet' href='../static/css/dataTables.bootstrap.min.css'>

<script type="text/javascript" src="../static/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../static/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#tablaventassinconfirmar').DataTable();
		$('#tablaventassincalificar').DataTable();
		$('#tablaventascerradas').DataTable();
		$('#tablaventas').DataTable();
	} );
</script>
<?php 
/*-----------------------------------------------------------------------------------------------------------*/
/* Fin scripts de esta pagina.*/
/*-----------------------------------------------------------------------------------------------------------*/
/* Agregar todo control, puntual para esta pagina (Como la sesion).*/
/*-----------------------------------------------------------------------------------------------------------*/
require('header.php');
$datos_ventas_sinconfirmar = require_once('../logica/procesarListadoVentasSinConfirmar.php');
$datos_ventas_sincalificar = require_once('../logica/procesarListadoVentasSinCalificar.php');
$datos_ventas_cerradas = require_once('../logica/procesarListadoVentasCerradas.php');
$datos_ventas = require_once('../logica/procesarListadoVentas.php');
/*var_dump($datos_ventas_sinconfirmar);
echo "<hr>";
var_dump($datos_ventas_sincalificar);
echo "<hr>";
var_dump($datos_ventas_cerradas);
echo "<hr>";*/

if ((isset($_SESSION['mobjetivo'])) && ($_SESSION['mobjetivo'] == "mysells.php")){
	var_dump($_SESSION['mtexto']);
	unset($_SESSION['mobjetivo']);
}

/*-----------------------------------------------------------------------------------------------------------*/
/* Agregar todo el contenido de esta pagina aqui.*/
/*-----------------------------------------------------------------------------------------------------------*/
?>
<div class="row affix-row">
	<div class="col-sm-3 col-md-2 affix-sidebar">
		<?php 
		$_SESSION['menu']=4;
		require('menu.php');
		unset($_SESSION['menu']);
		?>
	</div>
	<div class="col-sm-9 col-md-10">
		<div class="row maincpanel">
			<div class="col-md-7">
				<div class="single-page main-grid-border">
					<div class="leftcpanel">
						<h4>Ventas Sin Confirmar</h4>
						<?php				
						if (isset($datos_ventas_sinconfirmar["this"])) {
							?>
							<p>No tienes ventas sin confirmar.</p>
							<?php
						}else{
							?>
							<div class="table-responsive">
								<table id="tablaventassinconfirmar" class="table table-condensed table-striped table-bordered" cellspacing="0" width="100%">
									<thead>
										<tr>
											<td><strong>Publicacion</strong></td>
											<td class="text-center"><strong>Fecha</strong></td>
											<td class="text-center"><strong>Cantidad</strong></td>
											<td class="text-center"><strong>Total</strong></td>
											<td class="text-center"><strong>Conf</strong></td>
											<td class="text-right"><strong>Ver</strong></td>
										</tr>
									</thead>
									<tbody>
										<?php
										for ($i=0; $i < count($datos_ventas_sinconfirmar); $i++) { 
											?>
											<tr>
												<td><?php echo utf8_encode($datos_ventas_sinconfirmar[$i]['TITULO']) ?></td>
												<td class="text-center"><?php echo date("d/m/Y", strtotime($datos_ventas_sinconfirmar[$i]['FECHACOMPRA'])) ?></td>
												<td class="text-center"><?php echo $datos_ventas_sinconfirmar[$i]['CANTIDAD'].' x $'.$datos_ventas_sinconfirmar[$i]['TOTAL'] ?></td>
												<td class="text-center"><?php echo '$'.($datos_ventas_sinconfirmar[$i]['TOTAL'] * $datos_ventas_sinconfirmar[$i]['CANTIDAD']) ?></td>
												<td class="text-center">
													<a href="../logica/procesarConfirmarVenta.php?idcompra=<?php echo $datos_ventas_sinconfirmar[$i]['ID'] ?>">
														<button class="btn btn-xs btn-success">
															<i class="fa fa-thumbs-up"></i>
														</button>
													</a>
												</td>
												<td class="text-right">
													<a target="_blank" href="../view/buyconfirmation.php?id=<?php echo $datos_ventas_sinconfirmar[$i]['ID'] ?>">
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
						<h4>Ventas Sin Calificar</h4>
						<?php				
						if (isset($datos_ventas_sincalificar["this"])) {
							?>
							<p>No tienes ventas sin calificar.</p>
							<?php
						}else{
							?>
							<div class="table-responsive">
								<table id="tablaventassincalificar" class="table table-condensed table-striped table-bordered" cellspacing="0" width="100%">
									<thead>
										<tr>
											<td><strong>Publicacion</strong></td>
											<td class="text-center"><strong>Fecha Confirmado</strong></td>
											<td class="text-center"><strong>Tu Calificacion</strong></td>
											<td class="text-center"><strong>Cal. del Comprador</strong></td>
											<td class="text-right"><strong>Ver</strong></td>
										</tr>
									</thead>
									<tbody>
										<?php
										for ($i=0; $i < count($datos_ventas_sincalificar); $i++) { 
											?>
											<tr>
												<td><?php echo utf8_encode($datos_ventas_sincalificar[$i]['TITULO']) ?></td>
												<td class="text-center"><?php echo date("d/m/Y", strtotime($datos_ventas_sincalificar[$i]['FECHAVENTACONCRETADO'])) ?></td>
												<td class="text-center">
													<?php
													if (is_null($datos_ventas_sincalificar[$i]['IDCALVENDEDOR'])) {
														?> Pendiente
														<button name="idcompra" type="submit" class="btn btn-xs btn-warning" value="<?php echo $datos_ventas_sincalificar[$i]['ID']; ?>">
															<i class="fa fa-star"></i>
														</button>
														<?php
													}else{
														echo "Calificado";												
													}
													?>
												</td>
												<td class="text-center">
													<?php
													if (is_null($datos_ventas_sincalificar[$i]['IDCALCOMPRADOR'])) {
														?> Pendiente
														<button name="idcompra" type="submit" class="btn btn-xs btn-warning" value="<?php echo $datos_ventas_sincalificar[$i]['ID']; ?>">
															<i class="fa fa-star"></i>
														</button>
														<?php
													}else{
														echo "Calificado";												
													}
													?>
												</td>
												<td class="text-right">
													<a href="../view/buyconfirmation.php?id=<?php echo $datos_ventas_sincalificar[$i]['ID'] ?>">
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
						<h4>Ventas Cerradas</h4>
						<?php				
						if (isset($datos_ventas_cerradas["this"])) {
							?>
							<p>No tienes ventas cerradas.</p>
							<?php
						}else{
							/*print_r($datos_publicacion_activas);*/
							?>
							<div class="table-responsive">
								<table id="tablaventascerradas" class="table table-condensed table-striped table-bordered" cellspacing="0" width="100%">
									<thead>
										<tr>
											<td><strong>Publicacion</strong></td>
											<td class="text-center"><strong>Fecha Confirmado</strong></td>
											<td class="text-center"><strong>Tu Calificacion</strong></td>
											<td class="text-center"><strong>Cal. del Comprador</strong></td>
											<td class="text-right"><strong>Ver</strong></td>
										</tr>
									</thead>
									<tbody>
										<?php
										for ($i=0; $i < count($datos_ventas_cerradas); $i++) { 
											?>
											<tr>
												<td><?php echo utf8_encode($datos_ventas_cerradas[$i]['TITULO']) ?></td>
												<td class="text-center"><?php echo date("d/m/Y", strtotime($datos_ventas_cerradas[$i]['FECHAVENTACONCRETADO'])) ?></td>
												<td class="text-center">
													<?php
													if (is_null($datos_ventas_cerradas[$i]['IDCALVENDEDOR'])) {
														?> Pendiente
														<button name="idcompra" type="submit" class="btn btn-xs btn-warning" value="<?php echo $datos_ventas_cerradas[$i]['ID']; ?>">
															<i class="fa fa-star"></i>
														</button>
														<?php
													}else{
														for ($j=1; $j < 6; $j++) { 
															if ($j <= $datos_ventas_cerradas[$i]['CALVENDEDOR']) {
																echo "<i class='fa fa-star' style='color: var(--Principal);' aria-hidden='true'></i>";
															}else{
																echo "<i class='fa fa-star-o' style='color: var(--Terciario);' aria-hidden='true'></i>";
															}
														}
													}
													?>
												</td>
												<td class="text-center">
													<?php
													if (is_null($datos_ventas_cerradas[$i]['IDCALCOMPRADOR'])) {
														?> Pendiente
														<button name="idcompra" type="submit" class="btn btn-xs btn-warning" value="<?php echo $datos_ventas_cerradas[$i]['ID']; ?>">
															<i class="fa fa-star"></i>
														</button>
														<?php
													}else{
														for ($j=1; $j < 6; $j++) { 
															if ($j <= $datos_ventas_cerradas[$i]['CALCOMPRADOR']) {
																echo "<i class='fa fa-star' style='color: var(--Principal);' aria-hidden='true'></i>";
															}else{
																echo "<i class='fa fa-star-o' style='color: var(--Terciario);' aria-hidden='true'></i>";
															}
														}											
													}
													?>
												</td>
												<td class="text-right">
													<a href="../view/buyconfirmation.php?id=<?php echo $datos_ventas_cerradas[$i]['ID'] ?>">
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
			<div class="col-md-5">
				<div class="single-page main-grid-border">
					<div class="rightcpanel">
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
				<!--
				<div class="single-page main-grid-border">
					<div class="rightcpanel">
						<h4>Calificacion</h4>
						<div id="chartseller" style="height: 370px;"></div>
					</div>
				</div>
				<div class="single-page main-grid-border">
					<div class="rightcpanel">
						<h4>Grafica de Ventas</h4>
						<div id="chartselling" style="height: 370px;"></div>
					</div>
				</div>
			-->
			</div>
		</div>
	</div>
</div>
<script>
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
	$('#tablaventascerradas').DataTable( {
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
	$('#tablaventassincalificar').DataTable( {
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
	$('#tablaventassinconfirmar').DataTable( {
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