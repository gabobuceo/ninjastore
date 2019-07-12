<?php
session_start();
if (!isset($_SESSION['idbk'])){
	header('Location: ../view/login.php');
}
require('definitions.php');
//require_once('../../logica/funciones.php');
/*-----------------------------------------------------------------------------------------------------------*/
/* Agregar todo script, puntual para esta pagina.*/
/*-----------------------------------------------------------------------------------------------------------*/
?>
<script src='https://api.tiles.mapbox.com/mapbox-gl-js/v0.53.1/mapbox-gl.js'></script>
<link href='https://api.tiles.mapbox.com/mapbox-gl-js/v0.53.1/mapbox-gl.css' rel='stylesheet' />
<link rel='stylesheet' href='../../static/css/dataTables.bootstrap.min.css'>

<script type="text/javascript" src="../../static/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../../static/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#tablaabiertas').DataTable();
		$('#tablaasignadas').DataTable();
		$('#tablacerradas').DataTable();
		$('#tablahistorial').DataTable();
	} );
</script>
<style>
.thumbnails {
	overflow: hidden;
	margin: 1em 0;
	padding: 0;
}

.thumbnails li {
	display: inline-block;
	width: 50px;
	margin: 0 5px;
}

.thumbnails img {
	display: block;
	min-width: 100%;
	max-width: 100%;
}
</style>
<?php
/*-----------------------------------------------------------------------------------------------------------*/
/* Fin scripts de esta pagina.*/
/*-----------------------------------------------------------------------------------------------------------*/
/* Agregar todo control, puntual para esta pagina (Como la sesion).*/
/*-----------------------------------------------------------------------------------------------------------*/
require('header.php');
$datos_denuncias_abiertas = require_once('../logica/procesarListadoDenunciasAbiertas.php');
$datos_denuncias_asignadas = require_once('../logica/procesarListadoDenunciasAsignadas.php');
$datos_denuncias_cerradas = require_once('../logica/procesarListadoDenunciasCerradas.php');
var_dump($datos_denuncias_abiertas);
echo "<hr>";
var_dump($datos_denuncias_asignadas);
echo "<hr>";
var_dump($datos_denuncias_cerradas);
echo "<hr>";
var_dump($_SESSION);
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
						<h4>Ver Denuncia</h4>
						<?php
						if (isset($_GET['id'])) {
							$_SESSION['DenID']=$_GET['id'];
							$datos_denuncia = require_once('../logica/procesarCargaDenuncia.php');
							$datos_asignado = require_once('../logica/procesarCargaDenunciaAsignado.php');
							/*
							if datos_asignado==Vacio ->
								Asignar al usuario actualmente logeado
								cargar sus datos
							fin if
							*/
							var_dump($datos_denuncia);
							echo "<hr>";
							var_dump($datos_asignado);
							
							unset($_SESSION['DenID']);
							?>
							<h3>Denuncia: </h3>
							<form class="form-horizontal" action="../logica/procesarModificarUsuario.php" method="POST">
								<fieldset>
									<input name="idusumod" type="text" value="<?php echo $_GET['id'] ?>" hidden>
									<div class="form-group">
										<label class="col-md-5 control-label">ID</label>  
										<input name="cedula" type="hidden" class="form-control" value="<?php echo utf8_encode($datos_denuncia[0]['ID']) ?>" hidden >
										<label class="col-md-5 control-label" style="text-align: left;"><?php echo utf8_encode($datos_denuncia[0]['ID']) ?></label>  
									</div>
									<div class="form-group">
										<label class="col-md-5 control-label">FECHA</label>  
										<input name="cedula" type="hidden" class="form-control" value="<?php echo utf8_encode($datos_denuncia[0]['FECHA']) ?>" hidden >
										<label class="col-md-5 control-label" style="text-align: left;"><?php echo utf8_encode($datos_denuncia[0]['FECHA']) ?></label>  
									</div>
									<div class="form-group">
										<label class="col-md-5 control-label">TIPO</label>  
										<input name="cedula" type="hidden" class="form-control" value="<?php echo utf8_encode($datos_denuncia[0]['TIPO']) ?>" hidden >
										<label class="col-md-5 control-label" style="text-align: left;"><?php echo utf8_encode($datos_denuncia[0]['TIPO']) ?></label>  
									</div>
									<div class="form-group">
										<label class="col-md-5 control-label">IDOBJETO</label>  
										<input name="cedula" type="hidden" class="form-control" value="<?php echo utf8_encode($datos_denuncia[0]['IDOBJETO']) ?>" hidden >
										<label class="col-md-5 control-label" style="text-align: left;"><?php echo utf8_encode($datos_denuncia[0]['IDOBJETO']) ?></label>  
									</div>
									<div class="form-group">
										<label class="col-md-5 control-label">COMENTARIO</label>  
										<input name="cedula" type="hidden" class="form-control" value="<?php echo utf8_encode($datos_denuncia[0]['COMENTARIO']) ?>" hidden >
										<label class="col-md-5 control-label" style="text-align: left;"><?php echo utf8_encode($datos_denuncia[0]['COMENTARIO']) ?></label>  
									</div>
									<div class="form-group">
										<label class="col-md-5 control-label">ESTADO</label>  
										<input name="cedula" type="hidden" class="form-control" value="<?php echo utf8_encode($datos_denuncia[0]['ESTADO']) ?>" hidden >
										<label class="col-md-5 control-label" style="text-align: left;"><?php echo utf8_encode($datos_denuncia[0]['ESTADO']) ?></label>  
									</div>
									<div class="form-group">
										<label class="col-md-5 control-label">BAJA</label>  
										<input name="cedula" type="hidden" class="form-control" value="<?php echo utf8_encode($datos_denuncia[0]['BAJA']) ?>" hidden >
										<label class="col-md-5 control-label" style="text-align: left;"><?php echo utf8_encode($datos_denuncia[0]['BAJA']) ?></label>  
									</div>
								</fieldset>
							</form>
							<h3>Historial asignaciones: </h3>
							<?php				
							if (isset($datos_asignado["this"])) {
								?>
								<p>Nunca fue asignada esta denuncia.</p>
								<?php
							}else{
								?>
								<div class="table-responsive">
									<table id="tablahistorial" class="table table-condensed table-striped table-bordered" cellspacing="0" width="100%">
										<thead>
											<tr>
												<td><strong>ID</strong></td>
												<td class="text-center"><strong>IDUSUARIO</strong></td>
												<td class="text-center"><strong>IDDENUNCIA</strong></td>
												<td class="text-center"><strong>FECHA</strong></td>
												<td class="text-center"><strong>DESCRIPCION</strong></td>
												<td class="text-center"><strong>HTML</strong></td>
												<td class="text-right"><strong>BAJA</strong></td>
											</tr>
										</thead>
										<tbody>
											<?php
											for ($i=0; $i < count($datos_asignado); $i++) { 
												/*DATOS_PUBLICACIONES.ID,CATEGORIA.TITULO,DATOS_PUBLICACIONES.TITULO,DATOS_PUBLICACIONES.PRECIO, DATOS_PUBLICACIONES.OFERTA*/
												?>
												<tr>
													<td><?php echo $datos_asignado[$i]['ID'] ?></td>
													<td class="text-center"><?php echo $datos_asignado[$i]['IDUSUARIO'] ?></td>
													<td class="text-center"><?php echo $datos_asignado[$i]['IDDENUNCIA'] ?></td>
													<td class="text-center"><?php echo $datos_asignado[$i]['FECHA'] ?></td>
													<td class="text-center"><?php echo $datos_asignado[$i]['DESCRIPCION'] ?></td>
													<td class="text-center"><?php echo $datos_asignado[$i]['HTML'] ?></td>
													<td class="text-right"><?php echo $datos_asignado[$i]['BAJA'] ?></td>
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
							<h3>Objeto de Denuncia: </h3>
							<?php
							switch ($datos_denuncia[0]['TIPO']) {
								case 'PUBLICACION':
								$_SESSION['PubID']=$datos_denuncia[0]['IDOBJETO'];
								$datos_publicacion = require_once('../logica/procesarCargaPublicacion.php');
								$datos_publicacionimg = require_once('../logica/procesarCargaPublicacionImg.php');
								$_SESSION['CatID']=$datos_publicacion[0]['IDCATEGORIA'];
								$datos_categoria = require_once('../logica/procesarCargaCategoria.php');
								unset($_SESSION['CatID']);
								//var_dump($datos_publicacion);
								?>
								<form class="form-horizontal" action="../logica/procesarModificarPublicacion.php" method="POST">
									<fieldset>
										<input name="idpub" type="text" value="<?php echo $_GET['id'] ?>" hidden>
										<div class="form-group">
											<label class="col-md-5 control-label">Titulo</label>  
											<label class="col-md-7 control-label" style="text-align: left;"><?php echo utf8_encode($datos_publicacion[0]['TITULO']) ?></label>  
										</div>
										<div class="form-group">
											<label class="col-md-5 control-label">Descripcion</label>  
											<label class="col-md-7 control-label" style="text-align: left;"><?php echo htmlspecialchars_decode($datos_publicacion['0']['DESCRIPCION'], ENT_NOQUOTES); ?> </label>
										</div>
										<div class="form-group">
											<label class="col-md-5 control-label">Precio</label>  
											<label class="col-md-7 control-label" style="text-align: left;"><?php echo utf8_encode($datos_publicacion[0]['PRECIO']) ?></label>  
										</div>
										<div class="form-group">
											<label class="col-md-5 control-label">Cantidad</label>  
											<label class="col-md-7 control-label" style="text-align: left;"><?php echo utf8_encode($datos_publicacion[0]['CANTIDAD']) ?></label>  
										</div>
										<div class="form-group">
											<label class="col-md-5 control-label">Categoria</label>
											<label class="col-md-7 control-label" style="text-align: left;"><?php echo utf8_encode($datos_categoria[0]['TITULO']) ?></label>  
										</div>
										<div class="form-group">
											<label class="col-md-5 control-label">Estado Articulo</label> 
											<label class="col-md-7 control-label" style="text-align: left;"><?php echo utf8_encode($datos_publicacion[0]['ESTADOA']) ?></label>   
										</div>
										<div class="form-group">
											<label class="col-md-5 control-label">Estado Publicacion</label>  
											<label class="col-md-7 control-label" style="text-align: left;"><?php echo utf8_encode($datos_publicacion[0]['ESTADOP']) ?></label>  
										</div>
									</fieldset>
								</form>
								<h3>Imagenes: </h3>
								<ul class='thumbnails'>
									<label class="col-md-12 control-label">
										<?php
										for ($i=0; $i < count($datos_publicacionimg); $i++) { 
											?>


											<li>
												<a target="_blank" href='../../imagenes/<?php echo $datos_publicacionimg[$i]['IMAGENES'] ?>.webp' data-standard='../../imagenes/<?php echo $datos_publicacionimg[$i]['IMAGENES'] ?>.webp'>
													<img src='../../imagenes/<?php echo $datos_publicacionimg[$i]['IMAGENES'] ?>_tn.webp' />
												</a>
											</li>

											
											<?php
										}
										?>
									</label> 
								</ul>
								<?php
								unset($_SESSION['PubID']);
								break;
								case 'COMENTARIO':
								$_SESSION['idmensaje']=$datos_denuncia[0]['IDOBJETO'];
								$datos_chat = require_once('../logica/procesarCargaChat.php');
								var_dump($datos_chat);
								unset($_SESSION['idmensaje']);
								break;
								case 'COMPRA':
								$_SESSION['ComID']=$datos_denuncia[0]['IDOBJETO'];
								$datos_compra = require_once('../logica/procesarCargaCompra.php');
								var_dump($datos_compra);
								unset($_SESSION['ComID']);
								break;
								case 'USUARIO':
								$_SESSION['idbuscar']=$datos_denuncia[0]['IDOBJETO'];
								$datos_usuario = require_once('../logica/procesarCargaUsuarios.php');
								var_dump($datos_usuario);
								unset($_SESSION['idbuscar']);
								break;
								default:
									# code...
								break;
							}
							?>
							<h3>Resolucion de incidencia: </h3>
							Radio: Cancelar Denuncia / Banear
							
							<?php
						}else{
							?>
							<div class="row">
								<div class="col-md-12 product_img">
									<p>Para cargar una publicación, haga click en su enlace</p>
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
						<h4>Denuncias Abiertas</h4>
						<?php				
						if (isset($datos_denuncias_abiertas["this"])) {
							?>
							<p>No existen denuncias abiertas.</p>
							<?php
						}else{
							?>
							<div class="table-responsive">
								<table id="tablaabiertas" class="table table-condensed table-striped table-bordered" cellspacing="0" width="100%">
									<thead>
										<tr>
											<td><strong>ID</strong></td>
											<td class="text-center"><strong>Tipo</strong></td>
											<td class="text-center"><strong>Fecha</strong></td>
											<td class="text-right"><strong>Ver</strong></td>
										</tr>
									</thead>
									<tbody>
										<?php
										for ($i=0; $i < count($datos_denuncias_abiertas); $i++) { 
											/*DATOS_PUBLICACIONES.ID,CATEGORIA.TITULO,DATOS_PUBLICACIONES.TITULO,DATOS_PUBLICACIONES.PRECIO, DATOS_PUBLICACIONES.OFERTA*/
											?>
											<tr>
												<td><?php echo $datos_denuncias_abiertas[$i]['IDDENUNCIA'] ?></td>
												<td><?php echo utf8_encode($datos_denuncias_abiertas[$i]['TIPO']) ?></td>
												<td class="text-center"><?php echo date("d/m/Y", strtotime($datos_denuncias_abiertas[$i]['FECHADENUNCIA'])) ?></td>
												<td class="text-right">
													<a href="../view/mgmtreports.php?id=<?php echo $datos_denuncias_abiertas[$i]['IDDENUNCIA'] ?>">
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
					<div class="rightcpanel">
						<h4>Asignadas a Mi</h4>
						<?php				
						if (isset($datos_denuncias_asignadas["this"])) {
							?>
							<p>No tienes denuncias asignadas a vos.</p>
							<?php
						}else{
							?>
							<div class="table-responsive">
								<table id="tablaasignadas" class="table table-condensed table-striped table-bordered" cellspacing="0" width="100%">
									<thead>
										<tr>
											<td><strong>ID</strong></td>
											<td class="text-center"><strong>Tipo</strong></td>
											<td class="text-center"><strong>Fecha</strong></td>
											<td class="text-right"><strong>Ver</strong></td>
										</tr>
									</thead>
									<tbody>
										<?php
										for ($i=0; $i < count($datos_denuncias_asignadas); $i++) { 
											/*DATOS_PUBLICACIONES.ID,CATEGORIA.TITULO,DATOS_PUBLICACIONES.TITULO,DATOS_PUBLICACIONES.PRECIO, DATOS_PUBLICACIONES.OFERTA*/
											?>
											<tr>
												<td><?php echo $datos_denuncias_asignadas[$i]['IDDENUNCIA'] ?></td>
												<td><?php echo utf8_encode($datos_denuncias_asignadas[$i]['TIPO']) ?></td>
												<td class="text-center"><?php echo date("d/m/Y", strtotime($datos_denuncias_asignadas[$i]['FECHADENUNCIA'])) ?></td>
												<td class="text-right">
													<a href="../view/mgmtreports.php?id=<?php echo $datos_denuncias_asignadas[$i]['IDDENUNCIA'] ?>">
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
					<div class="rightcpanel">
						<h4>Denuncias Cerradas</h4>
						<?php				
						if (isset($datos_denuncias_cerradas["this"])) {
							?>
							<p>No existen denuncias cerradas.</p>
							<?php
						}else{
							?>
							<div class="table-responsive">
								<table id="tablacerradas" class="table table-condensed table-striped table-bordered" cellspacing="0" width="100%">
									<thead>
										<tr>
											<td><strong>ID</strong></td>
											<td class="text-center"><strong>Tipo</strong></td>
											<td class="text-center"><strong>Fecha</strong></td>
											<td class="text-right"><strong>Ver</strong></td>
										</tr>
									</thead>
									<tbody>
										<?php
										for ($i=0; $i < count($datos_denuncias_cerradas); $i++) { 
											/*DATOS_PUBLICACIONES.ID,CATEGORIA.TITULO,DATOS_PUBLICACIONES.TITULO,DATOS_PUBLICACIONES.PRECIO, DATOS_PUBLICACIONES.OFERTA*/
											?>
											<tr>
												<td><?php echo $datos_denuncias_cerradas[$i]['IDDENUNCIA'] ?></td>
												<td><?php echo utf8_encode($datos_denuncias_cerradas[$i]['TIPO']) ?></td>
												<td class="text-center"><?php echo date("d/m/Y", strtotime($datos_denuncias_cerradas[$i]['FECHADENUNCIA'])) ?></td>
												<td class="text-right">
													<a href="../view/mgmtreports.php?id=<?php echo $datos_denuncias_cerradas[$i]['IDDENUNCIA'] ?>">
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
	$('#tablaasignadas').DataTable( {
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
	$('#tablahistorial').DataTable( {
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