<?php 
session_start();
require('definitions.php');
/*-----------------------------------------------------------------------------------------------------------*/
/* Agregar todo script, puntual para esta pagina.*/
/*-----------------------------------------------------------------------------------------------------------*/
?>
<link rel='stylesheet' href='../static/css/dataTables.bootstrap.min.css'>
<script type="text/javascript" src="../static/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../static/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#tablapermutasabiertasOrigen').DataTable();
		$('#tablapermutascerradasOrigen').DataTable();
		$('#tablapermutasabiertasDestino').DataTable();
		$('#tablapermutascerradasDestino').DataTable();
	} );
</script>
<?php 
/*-----------------------------------------------------------------------------------------------------------*/
/* Fin scripts de esta pagina.*/
/*-----------------------------------------------------------------------------------------------------------*/
/* Agregar todo control, puntual para esta pagina (Como la sesion).*/
/*-----------------------------------------------------------------------------------------------------------*/
require('header.php');
$datos_permutas_activas_origen = require_once('../logica/procesarListadoPermutasAbiertasOrigen.php');
$datos_permutas_cerradas_origen = require_once('../logica/procesarListadoPermutasCerradasOrigen.php');
$datos_permutas_activas_destino = require_once('../logica/procesarListadoPermutasAbiertasDestino.php');
$datos_permutas_cerradas_destino = require_once('../logica/procesarListadoPermutasCerradasDestino.php');
/*var_dump($datos_permutas_activas_origen);
echo "<hr>";
var_dump($datos_permutas_cerradas_origen);
echo "<hr>";
var_dump($datos_permutas_activas_destino);
echo "<hr>";
var_dump($datos_permutas_cerradas_destino);
echo "<hr>";
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
						<h4>Vista Previa</h4>
						<?php
						if (isset($_GET['id'])) {
							$_SESSION['ExcID']=$_GET['id'];
							$datos_permutas = require_once('../logica/procesarCargaPermuta.php');		
							/*var_dump($datos_permutas);
							echo "<br><br>";*/
							unset($_SESSION['ExcID']);
							?>
							<div class="row">
								<div class="col-md-6 product_img">
									<?php
									cargarimgtn($datos_permutas[0]['IMGDEFAULTORIGEN']);
									?>
								</div>
								<div class="col-md-6 product_content cppermuta">
									<h4 class="lestitle">Articulo: <span class="subtitle"><?php echo  utf8_encode($datos_permutas[0]['TITULOORIGEN'])?></span></h4>
									<h4 class="lestitle">Ofertante: <span class="subtitle"><?php echo $datos_permutas[0]['USUARIOORIGEN']?></span></h4>
									<h4 class="lestitle">Cantidad: <span class="subtitle"><?php echo $datos_permutas[0]['CANTIDADORIGEN']?></span></h4>
									
									<p>Ver Publicación 
										<a target="_blank" href="../view/publication.php?id=<?php echo $datos_permutas[0]['IDPUBLICACIONORIGEN'] ?>">
											<button class="btn btn-xs btn-info">
												<i class="fa fa-external-link"></i>
											</button>
										</a>
									</p>
									<h3 class="cost lestitle">Subtotal: <span class="subtitle"><i class="fa fa-usd" aria-hidden="true"></i><span id="subtotal"><?php echo $datos_permutas[0]['PRECIOORIGEN']?></span></span></h3>
									<div class="space-ten"></div>
								</div>
							</div>
							<h4>A cambio de:</h4>
							<div class="row">
								<div class="col-md-6 product_img">
									<?php
									cargarimgtn($datos_permutas[0]['IMGDEFAULTDESTINO']);
									?>
								</div>
								<div class="col-md-6 product_content cppermuta">
									<h4 class="lestitle">Articulo: <span class="subtitle"><?php echo  utf8_encode($datos_permutas[0]['TITULODESTINO'])?></span></h4>
									<h4 class="lestitle">Ofertante: <span class="subtitle"><?php echo $datos_permutas[0]['USUARIODESTINO']?></span></h4>
									<h4 class="lestitle">Cantidad: <span class="subtitle"><?php echo $datos_permutas[0]['CANTIDADDESTINO']?></span></h4>
									
									<p>Ver Publicación 
										<a target="_blank" href="../view/publication.php?id=<?php echo $datos_permutas[0]['IDPUBLICACIONDESTINO'] ?>">
											<button class="btn btn-xs btn-info">
												<i class="fa fa-external-link"></i>
											</button>
										</a>
									</p>
									<h3 class="cost lestitle">Subtotal: <span class="subtitle"><i class="fa fa-usd" aria-hidden="true"></i><span id="subtotal"><?php echo $datos_permutas[0]['PRECIODESTINO']?></span></span></h3>
									<div class="space-ten"></div>
								</div>
							</div>
							<h4>Estado de permuta</h4>
							<div class="row">
								<div class="col-md-12 product_content cppermuta">
									<h3 class="cost lestitle">Estado: <span class="subtitle"><span id="subtotal"><?php echo $datos_permutas[0]['ESTADO']?></span></span></h3>
									<h3 class="cost lestitle">Aceptada: <span class="subtitle"><span id="subtotal">
										<?php 
										if ($datos_permutas[0]['ACEPTADA']==1) {
											echo "Si";
										}else{
											echo "No";
										}
										?>
									</span></span></h3>
									<div class="space-ten"></div>
								</div>
							</div>
							<?php
							if (($_SESSION['id']==$datos_permutas[0]['IDDESTINO']) && ($datos_permutas[0]['ESTADO']=='ACTIVA')) {
								?>
								<div class="row">
									<?php
									if ($datos_permutas[0]['CANTIDADDESTINO']>0) {
										?>
										<div class="col-md-6 product_img">
											<div class="btn-ground">
												<div class="buy-in-form">
													<form action="../logica/procesarAceptarPermuta.php" method="POST">						
														<input type="text" name="id" value="<?php echo $datos_permutas[0]['ID']?>" hidden />
														<input type="submit" value="Aceptar Permuta">
													</form>	
												</div>
											</div>
										</div>
										<?php 
									}
									?>
									<div class="col-md-6 product_img">
										<div class="btn-ground">
											<div class="buy-in-form">
												<form action="../logica/procesarCancelarPermuta.php" method="POST">						
													<input type="text" name="id" value="<?php echo $datos_permutas[0]['ID']?>" hidden />
													<input type="submit" value="Cancelar Permuta">
												</form>	
											</div>
										</div>
									</div>
								</div>
								<?php
							}
						}else{
							?>
							<div class="row">
								<div class="col-md-12 product_img">
									<p>Para cargar la vista previa del producto haz click en su enlace</p>
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
						<h4>Solicitadas por Mi</h4>
						<?php				
						if (isset($datos_permutas_activas_origen["this"])) {
							?>
							<p>No has realizado ninguna solicitud.</p>
							<?php
						}else{
							?>
							<div class="table-responsive">
								<table id="tablapermutasabiertasOrigen" class="table table-condensed table-striped table-bordered" cellspacing="0" width="100%">
									<thead>
										<tr>
											<td><strong>Item Ofertado</strong></td>
											<td class="text-center"><strong>Item Ifertante</strong></td>
											<td class="text-center"><strong>Fecha Oferta</strong></td>
											<td class="text-right"><strong>Ver</strong></td>
										</tr>
									</thead>
									<tbody>
										<?php
										for ($i=0; $i < count($datos_permutas_activas_origen); $i++) { 
											?>
											<tr>
												<td><?php echo utf8_encode($datos_permutas_activas_origen[$i]['TITULOORIGEN']) ?></td>
												<td class="text-center"><?php echo utf8_encode($datos_permutas_activas_origen[$i]['TITULODESTINO']) ?></td>
												<td class="text-center"><?php echo date("d/m/Y", strtotime($datos_permutas_activas_origen[$i]['FECHAP'])) ?></td>
												<td class="text-right">
													<a href="../view/myexchanges.php?id=<?php echo $datos_permutas_activas_origen[$i]['ID'] ?>">
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
						<h4>Mis Solicitudes Cerradas</h4>
						<?php				
						if (isset($datos_permutas_cerradas_origen["this"])) {
							?>
							<p>No has realizado ninguna solicitud.</p>
							<?php
						}else{
							?>
							<div class="table-responsive">
								<table id="tablapermutascerradasOrigen" class="table table-condensed table-striped table-bordered" cellspacing="0" width="100%">
									<thead>
										<tr>
											<td><strong>Item Ofertado</strong></td>
											<td class="text-center"><strong>Item Ifertante</strong></td>
											<td class="text-center"><strong>Fecha Oferta</strong></td>
											<td class="text-right"><strong>Ver</strong></td>
										</tr>
									</thead>
									<tbody>
										<?php
										for ($i=0; $i < count($datos_permutas_cerradas_origen); $i++) { 
											?>
											<tr>
												<td><?php echo utf8_encode($datos_permutas_cerradas_origen[$i]['TITULOORIGEN']) ?></td>
												<td class="text-center"><?php echo utf8_encode($datos_permutas_cerradas_origen[$i]['TITULODESTINO']) ?></td>
												<td class="text-center"><?php echo date("d/m/Y", strtotime($datos_permutas_cerradas_origen[$i]['FECHAP'])) ?></td>
												<td class="text-right">
													<a href="../view/myexchanges.php?id=<?php echo $datos_permutas_cerradas_origen[$i]['ID'] ?>">
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
						<h4>Solicitudes para Mi</h4>
						<?php				
						if (isset($datos_permutas_activas_destino["this"])) {
							?>
							<p>No has realizado ninguna solicitud.</p>
							<?php
						}else{
							?>
							<div class="table-responsive">
								<table id="tablapermutasabiertasDestino" class="table table-condensed table-striped table-bordered" cellspacing="0" width="100%">
									<thead>
										<tr>
											<td><strong>Item Ofertado</strong></td>
											<td class="text-center"><strong>Item Ifertante</strong></td>
											<td class="text-center"><strong>Fecha Oferta</strong></td>
											<td class="text-right"><strong>Ver</strong></td>
										</tr>
									</thead>
									<tbody>
										<?php
										for ($i=0; $i < count($datos_permutas_activas_destino); $i++) { 
											?>
											<tr>
												<td><?php echo utf8_encode($datos_permutas_activas_destino[$i]['TITULOORIGEN']) ?></td>
												<td class="text-center"><?php echo utf8_encode($datos_permutas_activas_destino[$i]['TITULODESTINO']) ?></td>
												<td class="text-center"><?php echo date("d/m/Y", strtotime($datos_permutas_activas_destino[$i]['FECHAP'])) ?></td>
												<td class="text-right">
													<a href="../view/myexchanges.php?id=<?php echo $datos_permutas_activas_destino[$i]['ID'] ?>">
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
						<h4>Cerradas por Mi</h4>
						<?php				
						if (isset($datos_permutas_cerradas_destino["this"])) {
							?>
							<p>No has realizado ninguna solicitud.</p>
							<?php
						}else{
							?>
							<div class="table-responsive">
								<table id="tablapermutascerradasDestino" class="table table-condensed table-striped table-bordered" cellspacing="0" width="100%">
									<thead>
										<tr>
											<td><strong>Item Ofertado</strong></td>
											<td class="text-center"><strong>Item Ifertante</strong></td>
											<td class="text-center"><strong>Fecha Oferta</strong></td>
											<td class="text-right"><strong>Ver</strong></td>
										</tr>
									</thead>
									<tbody>
										<?php
										for ($i=0; $i < count($datos_permutas_cerradas_destino); $i++) { 
											?>
											<tr>
												<td><?php echo utf8_encode($datos_permutas_cerradas_destino[$i]['TITULOORIGEN']) ?></td>
												<td class="text-center"><?php echo utf8_encode($datos_permutas_cerradas_destino[$i]['TITULODESTINO']) ?></td>
												<td class="text-center"><?php echo date("d/m/Y", strtotime($datos_permutas_cerradas_destino[$i]['FECHAP'])) ?></td>
												<td class="text-right">
													<a href="../view/myexchanges.php?id=<?php echo $datos_permutas_cerradas_destino[$i]['ID'] ?>">
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
	$('#tablapermutasabiertasOrigen').DataTable( {
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
	$('#tablapermutascerradasOrigen').DataTable( {
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
	$('#tablapermutasabiertasDestino').DataTable( {
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
	$('#tablapermutascerradasDestino').DataTable( {
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