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

<!--<link rel='stylesheet' href='<?php echo $staticsrv; ?>/css/jquery.dataTables.min.css'>-->
<link rel='stylesheet' href='<?php echo $staticsrv; ?>/css/dataTables.bootstrap.min.css'>

<script type="text/javascript" src="<?php echo $staticsrv; ?>/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo $staticsrv; ?>/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#tablacomprassinconfirmar').DataTable();
		$('#tablacomprassincalificar').DataTable();
		$('#tablacomprascerradas').DataTable();
		$('#tablacompras').DataTable();
	} );
</script>
<?php 
/*-----------------------------------------------------------------------------------------------------------*/
/* Fin scripts de esta pagina.*/
/*-----------------------------------------------------------------------------------------------------------*/
/* Agregar todo control, puntual para esta pagina (Como la sesion).*/
/*-----------------------------------------------------------------------------------------------------------*/
require('header.php');
$datos_compras_sinconfirmar = require_once('../logica/procesarListadoComprasSinConfirmar.php');
$datos_compras_sincalificar = require_once('../logica/procesarListadoComprasSinCalificar.php');
$datos_compras_cerradas = require_once('../logica/procesarListadoComprasCerradas.php');
$datos_compras = require_once('../logica/procesarListadoCompras.php');
/*var_dump($datos_compras);
echo "<hr>";
var_dump($datos_compras_sincalificar);
echo "<hr>";
var_dump($datos_compras_cerradas);
echo "<hr>";
*/
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
						<h4>Compras Sin Confirmar</h4>
						<?php				
						if (isset($datos_compras_sinconfirmar["this"])) {
							?>
							<p>No tienes compras sin confirmar.</p>
							<?php
						}else{
							?>
							<div class="table-responsive">
								<table id="tablacomprassinconfirmar" class="table table-condensed table-striped table-bordered" cellspacing="0" width="100%">
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
										for ($i=0; $i < count($datos_compras_sinconfirmar); $i++) { 
											?>
											<tr>
												<td><?php echo utf8_encode($datos_compras_sinconfirmar[$i]['TITULO']) ?></td>
												<td class="text-center"><?php echo date("d/m/Y", strtotime($datos_compras_sinconfirmar[$i]['FECHACOMPRA'])) ?></td>
												<td class="text-center"><?php echo $datos_compras_sinconfirmar[$i]['CANTIDAD'].' x $'.$datos_compras_sinconfirmar[$i]['TOTAL'] ?></td>
												<td class="text-center"><?php echo '$'.($datos_compras_sinconfirmar[$i]['TOTAL'] * $datos_compras_sinconfirmar[$i]['CANTIDAD']) ?></td>
												<td class="text-center">
													<a href="../logica/procesarConfirmarCompra.php?idcompra=<?php echo $datos_compras_sinconfirmar[$i]['ID'] ?>">
														<button class="btn btn-xs btn-success">
															<i class="fa fa-thumbs-up"></i>
														</button>
													</a>
												</td>
												<td class="text-right">
													<a target="_blank" href="../view/buyconfirmation.php?id=<?php echo $datos_compras_sinconfirmar[$i]['ID'] ?>">
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
						<h4>Compras Sin Calificar</h4>
						<?php				
						if (isset($datos_compras_sincalificar["this"])) {
							?>
							<p>No tienes compras sin calificar.</p>
							<?php
						}else{
							?>
							<div class="table-responsive">
								<table id="tablacomprassincalificar" class="table table-condensed table-striped table-bordered" cellspacing="0" width="100%">
									<thead>
										<tr>
											<td><strong>Publicacion</strong></td>
											<td class="text-center"><strong>Fecha Confirmado</strong></td>
											<td class="text-center"><strong>Tu Calificacion</strong></td>
											<td class="text-center"><strong>Cal. del Vendedor</strong></td>
											<td class="text-right"><strong>Ver</strong></td>
										</tr>
									</thead>
									<tbody>
										<?php
										for ($i=0; $i < count($datos_compras_sincalificar); $i++) { 
											?>
											<tr>
												<td><?php echo utf8_encode($datos_compras_sincalificar[$i]['TITULO']) ?></td>
												<td class="text-center"><?php echo date("d/m/Y", strtotime($datos_compras_sincalificar[$i]['FECHACOMPRACONCRETADO'])) ?></td>
												<td class="text-center">
													<?php
													if (is_null($datos_compras_sincalificar[$i]['IDCALCOMPRADOR'])) {
														?> Pendiente
														<button name="idcompra" type="submit" class="btn btn-xs btn-warning" value="<?php echo $datos_compras_sincalificar[$i]['ID']; ?>">
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
													if (is_null($datos_compras_sincalificar[$i]['IDCALVENDEDOR'])) {
														?> Pendiente
														<button name="idcompra" type="submit" class="btn btn-xs btn-warning" value="<?php echo $datos_compras_sincalificar[$i]['ID']; ?>">
															<i class="fa fa-star"></i>
														</button>
														<?php
													}else{
														echo "Calificado";												
													}
													?>
												</td>
												<td class="text-right">
													<a href="../view/buyconfirmation.php?id=<?php echo $datos_compras_sincalificar[$i]['ID'] ?>">
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
						<h4>Compras Cerradas</h4>
						<?php				
						if (isset($datos_compras_cerradas["this"])) {
							?>
							<p>No tienes ventas cerradas.</p>
							<?php
						}else{
							?>
							<div class="table-responsive">
								<table id="tablacomprascerradas" class="table table-condensed table-striped table-bordered" cellspacing="0" width="100%">
									<thead>
										<tr>
											<td><strong>Publicacion</strong></td>
											<td class="text-center"><strong>Fecha Confirmado</strong></td>
											<td class="text-center"><strong>Tu Calificacion</strong></td>
											<td class="text-center"><strong>Cal. del Vendedor</strong></td>
											<td class="text-right"><strong>Ver</strong></td>
										</tr>
									</thead>
									<tbody>
										<?php
										for ($i=0; $i < count($datos_compras_cerradas); $i++) { 
											?>
											<tr>
												<td><?php echo utf8_encode($datos_compras_cerradas[$i]['TITULO']) ?></td>
												<td class="text-center"><?php echo date("d/m/Y", strtotime($datos_compras_cerradas[$i]['FECHAVENTACONCRETADO'])) ?></td>
												<td class="text-center">
													<?php
													if (is_null($datos_compras_cerradas[$i]['IDCALVENDEDOR'])) {
														?> Pendiente
														<button name="idcompra" type="submit" class="btn btn-xs btn-warning" value="<?php echo $datos_compras_cerradas[$i]['ID']; ?>">
															<i class="fa fa-star"></i>
														</button>
														<?php
													}else{
														for ($j=1; $j < 6; $j++) { 
															if ($j <= $datos_compras_cerradas[$i]['CALCOMPRADOR']) {
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
													if (is_null($datos_compras_cerradas[$i]['IDCALCOMPRADOR'])) {
														?> Pendiente
														<button name="idcompra" type="submit" class="btn btn-xs btn-warning" value="<?php echo $datos_compras_cerradas[$i]['ID']; ?>">
															<i class="fa fa-star"></i>
														</button>
														<?php
													}else{
														for ($j=1; $j < 6; $j++) { 
															if ($j <= $datos_compras_cerradas[$i]['CALVENDEDOR']) {
																echo "<i class='fa fa-star' style='color: var(--Principal);' aria-hidden='true'></i>";
															}else{
																echo "<i class='fa fa-star-o' style='color: var(--Terciario);' aria-hidden='true'></i>";
															}
														}											
													}
													?>
												</td>
												<td class="text-right">
													<a href="../view/buyconfirmation.php?id=<?php echo $datos_compras_cerradas[$i]['ID'] ?>">
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
				<!--<div class="single-page main-grid-border">
					<div class="rightcpanel">
						<h4>Calificacion</h4>
						<div id="chartseller" style="height: 370px;"></div>
					</div>
				</div>
				<div class="single-page main-grid-border">
					<div class="rightcpanel">
						<h4>Grafica de Compras</h4>
						<div id="chartselling" style="height: 370px;"></div>
					</div>
				</div>-->
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
	$('#tablacomprascerradas').DataTable( {
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
	$('#tablacomprassincalificar').DataTable( {
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
	$('#tablacomprassinconfirmar').DataTable( {
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