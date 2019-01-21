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
		<div class="sidebar-nav">
			<div class="navbar navbar-default" role="navigation">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<span class="visible-xs navbar-brand">Panel de control del Usuario</span>
				</div>
				<div class="navbar-collapse collapse sidebar-navbar-collapse">
					<ul class="nav navbar-nav" id="sidenav01">
						<li class="active"><a href="sumary.php"><h4><i class="fa fa-book" aria-hidden="true"></i> Resumen</h4></a></li>
						<li><a href="myprofile.php"><i class="fa fa-id-card" aria-hidden="true"></i> Perfil</a></li>
						<li><a href="mypublication.php"><i class="fa fa-shopping-bag" aria-hidden="true"></i> Publicaciones</a></li>
						<li><a href="mybuys.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Compras</a></li>
						<li><a href="myexchanges.php"><i class="fa fa-gavel" aria-hidden="true"></i> Permutas</a></li>
						<li><a href="mymessages.php"><i class="fa fa-commenting" aria-hidden="true"></i> Mensajes</a></li>
						<li><a href="myqualification.php"><i class="fa fa-star-half-o" aria-hidden="true"></i> Calficaciones</a></li>
						<li><a href="mybills.php"><i class="fa fa-money" aria-hidden="true"></i> Facturas</a></li>
						<li><a href="myreports.php"><i class="fa fa-bug" aria-hidden="true"></i> Denuncias</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-9 col-md-10">
		<div class="row maincpanel">
			<div class="col-md-7">
				<div class="single-page main-grid-border">
					<div class="leftcpanel">
						<h4>Publicaciones</h4>
						<div class="table-responsive">
							<table class="table table-condensed">
								<thead>
									<tr>
										<td><strong>Item</strong></td>
										<td class="text-center"><strong>Categoria</strong></td>
										<td class="text-center"><strong>Estado</strong></td>
										<td class="text-center"><strong>Disponibles</strong></td>
										<td class="text-center"><strong>Precio</strong></td>
										<td class="text-right"><strong>Enlace</strong></td>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Monitor LG 45''</td>
										<td class="text-center">Monitores</td>
										<td class="text-center">Borrador</td>
										<td class="text-center">200</td>
										<td class="text-center">$500</td>
										<td class="text-right"><a href="javascript:void(0)"><i class="fa fa-external-link" aria-hidden="true"></i> ID: 44448</a></td>
									</tr>
									<tr>
										<td>Monitor LG 45''</td>
										<td class="text-center">Monitores</td>
										<td class="text-center">Borrador</td>
										<td class="text-center">200</td>
										<td class="text-center">$500</td>
										<td class="text-right"><a href="javascript:void(0)"><i class="fa fa-external-link" aria-hidden="true"></i> ID: 44448</a></td>
									</tr>
									<tr>
										<td>Monitor LG 45''</td>
										<td class="text-center">Monitores</td>
										<td class="text-center">Borrador</td>
										<td class="text-center">200</td>
										<td class="text-center">$500</td>
										<td class="text-right"><a href="javascript:void(0)"><i class="fa fa-external-link" aria-hidden="true"></i> ID: 44448</a></td>
									</tr>
									<tr>
										<td>Monitor LG 45''</td>
										<td class="text-center">Monitores</td>
										<td class="text-center">Borrador</td>
										<td class="text-center">200</td>
										<td class="text-center">$500</td>
										<td class="text-right"><a href="javascript:void(0)"><i class="fa fa-external-link" aria-hidden="true"></i> ID: 44448</a></td>
									</tr>
									<tr>
										<td>Monitor LG 45''</td>
										<td class="text-center">Monitores</td>
										<td class="text-center">Borrador</td>
										<td class="text-center">200</td>
										<td class="text-center">$500</td>
										<td class="text-right"><a href="javascript:void(0)"><i class="fa fa-external-link" aria-hidden="true"></i> ID: 44448</a></td>
									</tr>
								</tbody>
							</table>
						</div>
						<form action="mypublication.php" method="POST">
							<div class="buy-in-form">
								<input type="submit" value="Ver Más">
							</div>
						</form>
					</div>
				</div>
				<div class="single-page main-grid-border">
					<div class="leftcpanel">
						<h4>Compras</h4>
						<div class="table-responsive">
							<table class="table table-condensed">
								<thead>
									<tr>
										<td><strong>Item</strong></td>
										<td class="text-center"><strong>Estado</strong></td>
										<td class="text-center"><strong>Cantidad</strong></td>
										<td class="text-center"><strong>Total</strong></td>
										<td class="text-right"><strong>Enlace</strong></td>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Monitor LG 45''</td>
										<td class="text-center">Sin Confirmar</td>
										<td class="text-center">2</td>
										<td class="text-center">$500</td>
										<td class="text-right"><a href="javascript:void(0)"><i class="fa fa-external-link" aria-hidden="true"></i> ID: 44448</a></td>
									</tr>
									<tr>
										<td>Monitor LG 45''</td>
										<td class="text-center">Confirmado, Sin Calificar</td>
										<td class="text-center">2</td>
										<td class="text-center">$500</td>
										<td class="text-right"><a href="javascript:void(0)"><i class="fa fa-external-link" aria-hidden="true"></i> ID: 44448</a></td>
									</tr>
									<tr>
										<td>Monitor LG 45''</td>
										<td class="text-center">Confirmado y Calificado</td>
										<td class="text-center">2</td>
										<td class="text-center">$500</td>
										<td class="text-right"><a href="javascript:void(0)"><i class="fa fa-external-link" aria-hidden="true"></i> ID: 44448</a></td>
									</tr>
									<tr>
										<td>Monitor LG 45''</td>
										<td class="text-center">Confirmado</td>
										<td class="text-center">2</td>
										<td class="text-center">$500</td>
										<td class="text-right"><a href="javascript:void(0)"><i class="fa fa-external-link" aria-hidden="true"></i> ID: 44448</a></td>
									</tr>
									<tr>
										<td>Monitor LG 45''</td>
										<td class="text-center">Confirmado</td>
										<td class="text-center">2</td>
										<td class="text-center">$500</td>
										<td class="text-right"><a href="javascript:void(0)"><i class="fa fa-external-link" aria-hidden="true"></i> ID: 44448</a></td>
									</tr>
								</tbody>
							</table>
						</div>
						<form action="mybuys.php" method="POST">
							<div class="buy-in-form">
								<input type="submit" value="Ver Más">
							</div>
						</form>
					</div>
				</div>
				<div class="single-page main-grid-border">
					<div class="leftcpanel">
						<h4>Permutas</h4>
						<div class="table-responsive">
							<table class="table table-condensed">
								<thead>
									<tr>
										<td><strong>Item Ofertado</strong></td>
										<td class="text-center"><strong>Precio</strong></td>
										<td class="text-center"><strong>Estado</strong></td>
										<td class="text-center"><strong>Total Ofrecido</strong></td>
										<td class="text-right"><strong>Enlace</strong></td>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Monitor LG 45''</td>
										<td class="text-center">$500</td>
										<td class="text-center">Abierta</td>
										<td class="text-center">$552</td>
										<td class="text-right"><a href="javascript:void(0)"><i class="fa fa-external-link" aria-hidden="true"></i> ID: 44448</a></td>
									</tr>
									<tr>
										<td>Monitor LG 45''</td>
										<td class="text-center">$500</td>
										<td class="text-center">Cerrada</td>
										<td class="text-center">$20</td>
										<td class="text-right"><a href="javascript:void(0)"><i class="fa fa-external-link" aria-hidden="true"></i> ID: 44448</a></td>
									</tr>
									<tr>
										<td>Monitor LG 45''</td>
										<td class="text-center">$500</td>
										<td class="text-center">Contraofertada</td>
										<td class="text-center">$220</td>
										<td class="text-right"><a href="javascript:void(0)"><i class="fa fa-external-link" aria-hidden="true"></i> ID: 44448</a></td>
									</tr>
									<tr>
										<td>Monitor LG 45''</td>
										<td class="text-center">$500</td>
										<td class="text-center">Abierta</td>
										<td class="text-center">$552</td>
										<td class="text-right"><a href="javascript:void(0)"><i class="fa fa-external-link" aria-hidden="true"></i> ID: 44448</a></td>
									</tr>
									<tr>
										<td>Monitor LG 45''</td>
										<td class="text-center">$500</td>
										<td class="text-center">Abierta</td>
										<td class="text-center">$552</td>
										<td class="text-right"><a href="javascript:void(0)"><i class="fa fa-external-link" aria-hidden="true"></i> ID: 44448</a></td>
									</tr>
								</tbody>
							</table>
						</div>
						<form action="myexchanges.php" method="POST">
							<div class="buy-in-form">
								<input type="submit" value="Ver Más">
							</div>
						</form>
					</div>
				</div>
				<div class="single-page main-grid-border">
					<div class="leftcpanel">
						<h4>Ultimos Mensajes</h4>
						<div class="table-responsive">
							<table class="table table-condensed">
								<thead>
									<tr>
										<td><strong>Item</strong></td>
										<td class="text-center"><strong>Fecha</strong></td>
										<td class="text-right"><strong>Enlace</strong></td>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Celular Samsung HD</td>
										<td class="text-center">10/11/2017 15:45:23</td>
										<td class="text-right"><a href="javascript:void(0)"><i class="fa fa-external-link" aria-hidden="true"></i> ID: 44441</a></td>
									</tr>
									<tr>
										<td>Monitor LG 45''</td>
										<td class="text-center">11/11/2017 10:24:12</td>
										<td class="text-right"><a href="javascript:void(0)"><i class="fa fa-external-link" aria-hidden="true"></i> ID: 44448</a></td>
									</tr>
									<tr>
										<td>Zapatillas Nike</td>
										<td class="text-center">11/11/2017 23:07:06</td>
										<td class="text-right"><a href="javascript:void(0)"><i class="fa fa-external-link" aria-hidden="true"></i> ID: 98741</a></td>
									</tr>
								</tbody>
							</table>
						</div>
						<form action="mymessages.php" method="POST">
							<div class="buy-in-form">
								<input type="submit" value="Ver Más">
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="col-md-5">
				<div class="single-page main-grid-border">
					<div class="rightcpanel">
						<h4 data-fontsize="18" data-lineheight="28">Si fueras Premium</h4>
						<table class="table table-condensed">
							<tbody>
								<tr>
									<td>Tendrias articulos llamativos</td>
									<td><div class="aligncenter"><i class="fa fa-check" style="font-size:19px;margin-left:0;margin-right:0;color:#f15922;"></i></div></td>
								</tr>
								<tr>
									<td>Tendrias preferencia de busquedas</td>
									<td><div class="aligncenter"><i class="fa fa-check" style="font-size:19px;margin-left:0;margin-right:0;color:#f15922;"></i></div></td>
								</tr>
								<tr>
									<td>Tendrias preferencia en Atención al Usuario</td>
									<td><div class="aligncenter"><i class="fa fa-check" style="font-size:19px;margin-left:0;margin-right:0;color:#f15922;"></i></div></td>
								</tr>
								<tr>
									<td>Tendrias modo de autentificación doble</td>
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
				</div>
				<!--<div class="single-page main-grid-border">
					<div class="rightcpanel">
						<h4>Eres Premum</h4>
						<img class="img-responsive" src="../static/img/premium.png" />
					</div>
				</div>-->
				<div class="single-page main-grid-border">
					<div class="rightcpanel">
						<h4>Calificacion</h4>
						<i class="fa fa-star" aria-hidden="true"></i>
						<i class="fa fa-star" aria-hidden="true"></i>
						<i class="fa fa-star-half-o" aria-hidden="true"></i>
						<i class="fa fa-star-o" aria-hidden="true"></i>
						<i class="fa fa-star-o" aria-hidden="true"></i>
						<div id="chartseller" style="height: 370px;"></div>
						<div id="chartbuyer" style="height: 370px;"></div>
						<form action="myqualification.php" method="POST">
							<div class="buy-in-form">
								<input type="submit" value="Ver Más">
							</div>
						</form>
					</div>
				</div>
				<div class="single-page main-grid-border">
					<div class="rightcpanel">
						<h4>Resumen de Deudas</h4>
						<div class="table-responsive">
							<table class="table table-condensed">
								<thead>
									<tr>
										<td><strong>Item</strong></td>
										<td class="text-center"><strong>Enlace</strong></td>
										<td class="text-right"><strong>Totals</strong></td>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Celular Samsung HD</td>
										<td class="text-center"><a href="javascript:void(0)"><i class="fa fa-external-link" aria-hidden="true"></i> ID: 213213</a></td>
										<td class="text-right">$15</td>
									</tr>
									<tr>
										<td>Monitor LG 45''</td>
										<td class="text-center"><a href="javascript:void(0)"><i class="fa fa-external-link" aria-hidden="true"></i> ID: 454477</a></td>
										<td class="text-right">$100</td>
									</tr>
									<tr>
										<td>Más Gastos</td>
										<td class="text-center"><a href="javascript:void(0)"><i class="fa fa-external-link" aria-hidden="true"></i> Detalles</a></td>
										<td class="text-right">$300</td>
									</tr>
									<tr>
										<td class="no-line"></td>
										<td class="no-line text-center"><strong>Total</strong></td>
										<td class="no-line text-right">$415</td>
									</tr>
								</tbody>
							</table>
						</div>
						<form action="mybills.php" method="POST">
							<div class="buy-in-form">
								<input type="submit" value="Ver Más">
							</div>
						</form>
					</div>
				</div>
				<div class="single-page main-grid-border">
					<div class="rightcpanel">
						<h4>Denuncias</h4>
						<div class="table-responsive">
							<table class="table table-condensed">
								<thead>
									<tr>
										<td><strong>Item</strong></td>
										<td class="text-right"><strong>Enlace</strong></td>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Articulo - Celular Samsung HD</td>
										<td class="text-right"><a href="javascript:void(0)"><i class="fa fa-external-link" aria-hidden="true"></i> ID: 44441</a></td>
									</tr>
									<tr>
										<td>Mensaje - Monitor LG 45''</td>
										<td class="text-right"><a href="javascript:void(0)"><i class="fa fa-external-link" aria-hidden="true"></i> ID: 44448</a></td>
									</tr>
									<tr>
										<td>Usuario - jperez471</td>
										<td class="text-right"><a href="javascript:void(0)"><i class="fa fa-external-link" aria-hidden="true"></i> ID: 98741</a></td>
									</tr>
								</tbody>
							</table>
						</div>
						<form action="myreports.php" method="POST">
							<div class="buy-in-form">
								<input type="submit" value="Ver Más">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$('#billssumary').DataTable( {
		"language": {
			"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ningún dato disponible en esta tabla",
			"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
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
		}
	});
</script>
<?php 
/*-----------------------------------------------------------------------------------------------------------*/
/* Fin contenido de esta pagina.*/
/*-----------------------------------------------------------------------------------------------------------*/
require('footer.php');
?>