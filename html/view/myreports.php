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
		$('#tablacerradas').DataTable();
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
$datos_abiertas = require_once('../logica/procesarListadoDenunciasAbiertas.php');
$datos_cerradas = require_once('../logica/procesarListadoDenunciasCerradas.php');
/*var_dump($datos_abiertas);
echo "<hr>";
var_dump($datos_cerradas);
echo "<hr>";*/
/*-----------------------------------------------------------------------------------------------------------*/
/* Agregar todo el contenido de esta pagina aqui.*/
/*-----------------------------------------------------------------------------------------------------------*/
?>
<div class="row affix-row">
	<div class="col-sm-3 col-md-2 affix-sidebar">
		<?php 
		$_SESSION['menu']=12;
		require('menu.php');
		unset($_SESSION['menu']);
		?>
	</div>
	<div class="col-sm-9 col-md-10">
		<div class="row maincpanel">
			<div class="col-md-7">
				<div class="single-page main-grid-border">
					<div class="leftcpanel">
						<h4>Denuncia</h4>
						<?php
						if (isset($_GET['id'])) {
							$_SESSION['iddenuncia']=$_GET['id'];
							$datos_denuncia = require_once('../logica/procesarCargaDenuncia.php');					
							unset($_SESSION['iddenuncia']);
							//var_dump($datos_denuncia);
							switch ($datos_denuncia[0]['TIPO']) {
								case 'chat':
									$_SESSION['idmensaje']=$datos_denuncia[0]['IDOBJETO'];
									$datos_preguntas = require_once('../logica/procesarCargaChat.php');
									unset($_SESSION['idmensaje']);
												//var_dump($datos_preguntas);
									?>
									<ul class="messages">
										<li class="message left appeared">
											<div class="text_wrapper">
												<div class="text">Cliente: <?php echo utf8_encode($datos_preguntas[0]['MENSAJE']); ?></div>
												<p><i class="fa fa-flag" aria-hidden="true"></i> creado el <?php echo date("d/m/Y H:i", strtotime($datos_preguntas[0]['FECHAM'])); ?></p>
											</div>
										</li>
										<?php
										if (!empty($datos_preguntas[0]['RESPUESTA'])) {
											?>
											<li class="message right appeared">
												<div class="text_wrapper">
													<div class="text">Vendedor: <?php echo utf8_encode($datos_preguntas[0]['RESPUESTA']); ?></div>
													<p><i class="fa fa-flag" aria-hidden="true"></i> creado el <?php echo date("d/m/Y H:i", strtotime($datos_preguntas[0]['FECHAR'])); ?></p>
												</div>
											</li>
											<?php 
										}
										?>
									</ul>
									<?php
								break;
								case 'compra':
									$_SESSION['ComID']=$datos_denuncia[0]['IDOBJETO'];
									$datos_compra = require_once('../logica/procesarCargaCompra.php');
									unset($_SESSION['ComID']);
									?>
									<h3>Datos de la Compra</h3>
									<div class="row">
										<div class="col-xs-12">
											<p><b>Producto: </b> <?php echo utf8_encode($datos_compra[0]['TITULO'])?></p>
											<p><b>Precio unitario: $</b><?php echo $datos_compra[0]['TOTAL']?></p>
											<p><b>Cantidad: </b> <?php echo $datos_compra[0]['CANTIDAD']?> unidad/es</p>
											<p><b>Total: $</b><?php echo $datos_compra[0]['TOTAL'] * $datos_compra[0]['CANTIDAD']?></p>
										</div>
									</div>
									<?php
								break;
								case 'publicacion':
									$_SESSION['PubID']=$datos_denuncia[0]['IDOBJETO'];
									$datos_publicacion = require_once('../logica/procesarCargaPublicacion.php');
									unset($_SESSION['PubID']);
									?>
									<div class="row">
										<div class="col-md-6 product_img">
											<?php
											cargarimgtn($datos_publicacion[0]['IMGDEFAULT']);
											?>
										</div>
										<div class="col-md-6 product_content cppermuta">
											<h4 class="lestitle">Estado: <span class="subtitle"><?php echo $datos_publicacion['0']['ESTADOA']; ?></span></h4>
											<h4 class="lestitle">Cantidad: <span class="subtitle"><?php echo $datos_publicacion['0']['CANTIDAD']; ?></span></h4>
											<h5 class="lestitle">Descripcion: </h5>
											<div class="product-details">
												<?php echo htmlspecialchars_decode($datos_publicacion['0']['DESCRIPCION'], ENT_NOQUOTES); ?>
											</div>
											<h3 class="cost lestitle">Precio: <span class="subtitle"><i class="fa fa-usd" aria-hidden="true"></i><span id="subtotal"><?php echo $datos_publicacion['0']['PRECIO']; ?></span></span></h3>
											<div class="space-ten"></div>
										</div>
									</div>
									<?php
								break;
								case 'usuario':
									$_SESSION['idbuscar']=$datos_denuncia[0]['IDOBJETO'];
									$datos_usuario = require_once('../logica/procesarCargaUsuario.php');
									unset($_SESSION['idbuscar']);
									//var_dump($datos_usuario);
									?>
									<h3>Datos del Usuario</h3>
									<div class="row">
										<div class="col-xs-12">
											<p><b>Nombre Completo: </b><?php echo utf8_encode($datos_usuario[0]['PNOMBRE'].' '.$datos_usuario[0]['PAPELLIDO']) ?></p>
										</div>
									</div>
									<div class="row">
										<div class="col-xs-12">
											<p><b>Email: </b><a href="mailto:<?php echo $datos_usuario[0]['EMAIL']?>"><?php echo $datos_usuario[0]['EMAIL']?></a></p>
										</div>
									</div>
									<div class="row">
										<div class="col-xs-12">
											<p><b>Cedula: </b><?php echo $datos_usuario[0]['CEDULA']?></p>
										</div>
									</div>
									<?php
								break;
							}
							?>
							<h3>Comentario:</h3>
							<p><?php echo $datos_denuncia[0]['COMENTARIO']; ?></p>
							<h3>Fecha de Denuncia:</h3>
							<p><?php echo date("d/m/Y H:i", strtotime($datos_denuncia[0]['FECHA'])); ?></p>
							<h3>Estado de la Denuncia:</h3>
							<p><?php echo $datos_denuncia[0]['ESTADO']; ?></p>
							<?php
						}else{
							?>
							<div class="row">
								<div class="col-md-12 product_img">
									<p>Para ver la denuncia haga click en su enlace</p>
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
					<div class="rightcpanel">
						<h4>Denuncias Cerradas</h4>
						<?php				
						if (isset($datos_cerradas["this"])) {
							?>
							<p>No tienes denuncias cerradas.</p>
							<?php
						}else{
							?>
							<div class="table-responsive">
								<table id="tablacerradas" class="table table-condensed table-striped table-bordered" cellspacing="0" width="100%">
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
										for ($i=0; $i < count($datos_cerradas); $i++) { 
											?>
											<tr>
												<td><?php echo $datos_cerradas[$i]['TIPO'] ?></td>
												<td class="text-center"><?php echo date("d/m/Y H:i", strtotime($datos_cerradas[$i]['FECHADENUNCIA'])); ?></td>
												<td class="text-center"><?php echo $datos_cerradas[$i]['ESTADO']; ?></td>
												<td class="text-right">
													<a href="../view/myreports.php?id=<?php echo $datos_cerradas[$i]['IDDENUNCIA'] ?>">
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
	$('#tablacerradas').DataTable( {
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