<?php 
session_start();
require('definitions.php');
/*-----------------------------------------------------------------------------------------------------------*/
/* Agregar todo script, puntual para esta pagina.*/
/*-----------------------------------------------------------------------------------------------------------*/
?>
<link rel='stylesheet' href='../static/css/jquery.dataTables.min.css'>
<script type="text/javascript" src="../static/js/canvasjs.min.js"></script>
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
				{ label: "Estrella 1",  y: 2 },
				{ label: "Estrella 2", y: 1 },
				{ label: "Estrella 3", y: 4 },
				{ label: "Estrella 4",  y: 8 },
				{ label: "Estrella 5",  y: 200 }
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
				{ label: "Estrella 1",  y: 200 },
				{ label: "Estrella 2", y: 20 },
				{ label: "Estrella 3", y: 4 },
				{ label: "Estrella 4",  y: 50 },
				{ label: "Estrella 5",  y: 10 }
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
<script type="text/javascript" src="../static/js/jquery.dataTables.min.js"></script>
<?php 
/*-----------------------------------------------------------------------------------------------------------*/
/* Fin scripts de esta pagina.*/
/*-----------------------------------------------------------------------------------------------------------*/
/* Agregar todo control, puntual para esta pagina (Como la sesion).*/
/*-----------------------------------------------------------------------------------------------------------*/
require('header.php');
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
						<div class="table-responsive">
							<table class="table table-condensed">
								<thead>
									<tr>
										<td><strong>Articulo</strong></td>
										<td class="text-center"><strong>Calificación</strong></td>
										<td class="text-center"><strong>Ultima Fecha</strong></td>
										<td class="text-right"><strong>Enlace</strong></td>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Celular HP 4k</td>
										<td class="text-center">Negativa</td>
										<td class="text-center">01/05/2018</td>
										<td class="text-right"><a href="javascript:void(0)"><i class="fa fa-external-link" aria-hidden="true"></i> ID: 44448</a></td>
									</tr>
									<tr>
										<td>Celular HP 4k</td>
										<td class="text-center">Positiva</td>
										<td class="text-center">01/05/2018</td>
										<td class="text-right"><a href="javascript:void(0)"><i class="fa fa-external-link" aria-hidden="true"></i> ID: 44448</a></td>
									</tr>
									<tr>
										<td>Celular HP 4k</td>
										<td class="text-center">Negativa</td>
										<td class="text-center">01/05/2018</td>
										<td class="text-right"><a href="javascript:void(0)"><i class="fa fa-external-link" aria-hidden="true"></i> ID: 44448</a></td>
									</tr>
									<tr>
										<td>Celular HP 4k</td>
										<td class="text-center">Positiva</td>
										<td class="text-center">01/05/2018</td>
										<td class="text-right"><a href="javascript:void(0)"><i class="fa fa-external-link" aria-hidden="true"></i> ID: 44448</a></td>
									</tr>
									<tr>
										<td>Celular HP 4k</td>
										<td class="text-center">Negativa</td>
										<td class="text-center">01/05/2018</td>
										<td class="text-right"><a href="javascript:void(0)"><i class="fa fa-external-link" aria-hidden="true"></i> ID: 44448</a></td>
									</tr>
									<tr>
										<td>Celular HP 4k</td>
										<td class="text-center">Positiva</td>
										<td class="text-center">01/05/2018</td>
										<td class="text-right"><a href="javascript:void(0)"><i class="fa fa-external-link" aria-hidden="true"></i> ID: 44448</a></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class="rightcpanel">
						<h4>Listado de Calificaciones como Comprador</h4>
						<div class="table-responsive">
							<table class="table table-condensed">
								<thead>
									<tr>
										<td><strong>Articulo</strong></td>
										<td class="text-center"><strong>Calificación</strong></td>
										<td class="text-center"><strong>Ultima Fecha</strong></td>
										<td class="text-right"><strong>Enlace</strong></td>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Celular HP 4k</td>
										<td class="text-center">Negativa</td>
										<td class="text-center">01/05/2018</td>
										<td class="text-right"><a href="javascript:void(0)"><i class="fa fa-external-link" aria-hidden="true"></i> ID: 44448</a></td>
									</tr>
									<tr>
										<td>Celular HP 4k</td>
										<td class="text-center">Positiva</td>
										<td class="text-center">01/05/2018</td>
										<td class="text-right"><a href="javascript:void(0)"><i class="fa fa-external-link" aria-hidden="true"></i> ID: 44448</a></td>
									</tr>
									<tr>
										<td>Celular HP 4k</td>
										<td class="text-center">Negativa</td>
										<td class="text-center">01/05/2018</td>
										<td class="text-right"><a href="javascript:void(0)"><i class="fa fa-external-link" aria-hidden="true"></i> ID: 44448</a></td>
									</tr>
									<tr>
										<td>Celular HP 4k</td>
										<td class="text-center">Positiva</td>
										<td class="text-center">01/05/2018</td>
										<td class="text-right"><a href="javascript:void(0)"><i class="fa fa-external-link" aria-hidden="true"></i> ID: 44448</a></td>
									</tr>
									<tr>
										<td>Celular HP 4k</td>
										<td class="text-center">Negativa</td>
										<td class="text-center">01/05/2018</td>
										<td class="text-right"><a href="javascript:void(0)"><i class="fa fa-external-link" aria-hidden="true"></i> ID: 44448</a></td>
									</tr>
									<tr>
										<td>Celular HP 4k</td>
										<td class="text-center">Positiva</td>
										<td class="text-center">01/05/2018</td>
										<td class="text-right"><a href="javascript:void(0)"><i class="fa fa-external-link" aria-hidden="true"></i> ID: 44448</a></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class="rightcpanel">
						<h4>Listado de Calificaciones Pendientes</h4>
						<div class="table-responsive">
							<table class="table table-condensed">
								<thead>
									<tr>
										<td><strong>Articulo</strong></td>
										<td class="text-center"><strong>Calificación</strong></td>
										<td class="text-center"><strong>Ultima Fecha</strong></td>
										<td class="text-right"><strong>Enlace</strong></td>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Celular HP 4k</td>
										<td class="text-center">Pendiente</td>
										<td class="text-center">01/05/2018</td>
										<td class="text-right"><a href="javascript:void(0)"><i class="fa fa-external-link" aria-hidden="true"></i> ID: 44448</a></td>
									</tr>
									<tr>
										<td>Celular HP 4k</td>
										<td class="text-center">Pendiente</td>
										<td class="text-center">01/05/2018</td>
										<td class="text-right"><a href="javascript:void(0)"><i class="fa fa-external-link" aria-hidden="true"></i> ID: 44448</a></td>
									</tr>
									<tr>
										<td>Celular HP 4k</td>
										<td class="text-center">Pendiente</td>
										<td class="text-center">01/05/2018</td>
										<td class="text-right"><a href="javascript:void(0)"><i class="fa fa-external-link" aria-hidden="true"></i> ID: 44448</a></td>
									</tr>
									<tr>
										<td>Celular HP 4k</td>
										<td class="text-center">Pendiente</td>
										<td class="text-center">01/05/2018</td>
										<td class="text-right"><a href="javascript:void(0)"><i class="fa fa-external-link" aria-hidden="true"></i> ID: 44448</a></td>
									</tr>
									<tr>
										<td>Celular HP 4k</td>
										<td class="text-center">Pendiente</td>
										<td class="text-center">01/05/2018</td>
										<td class="text-right"><a href="javascript:void(0)"><i class="fa fa-external-link" aria-hidden="true"></i> ID: 44448</a></td>
									</tr>
									<tr>
										<td>Celular HP 4k</td>
										<td class="text-center">Pendiente</td>
										<td class="text-center">01/05/2018</td>
										<td class="text-right"><a href="javascript:void(0)"><i class="fa fa-external-link" aria-hidden="true"></i> ID: 44448</a></td>
									</tr>
								</tbody>
							</table>
						</div>
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