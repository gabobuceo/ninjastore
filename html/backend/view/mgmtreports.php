<?php
session_start();
if (!isset($_SESSION['idbk'])){
	header('Location: ../view/login.php');
}
require('definitions.php');
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
		$('#tablatodas').DataTable();
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
$datos_denuncias = require_once('../logica/procesarListadoDenuncias.php');
$datos_denuncias_abiertas = require_once('../logica/procesarListadoDenunciasAbiertas.php');
$datos_denuncias_asignadas = require_once('../logica/procesarListadoDenunciasAsignadas.php');
$datos_denuncias_cerradas = require_once('../logica/procesarListadoDenunciasCerradas.php');
if (isset($_GET['id'])) {
	$_SESSION['DenID']=$_GET['id'];
	$datos_asignado = require_once('../logica/procesarCargaDenunciaAsignado.php');
	if (isset($datos_asignado["this"])) {
		$datos_asignado = require_once('../logica/procesarAsignarDenuncia.php');
		header("Refresh:0");
	}
}
/*-----------------------------------------------------------------------------------------------------------*/
/* Debug de Datos.*/
/*-----------------------------------------------------------------------------------------------------------*/
/*
var_dump($datos_denuncias);
echo "<hr>";
var_dump($datos_denuncias_abiertas);
echo "<hr>";
var_dump($datos_denuncias_asignadas);
echo "<hr>";
var_dump($datos_denuncias_cerradas);
echo "<hr>";
var_dump($datos_asignado);
echo "<hr>";
var_dump($_SESSION);
echo "<hr>";
var_dump($_POST);
echo "<hr>";
var_dump($_GET);
echo "<hr>";
var_dump($_SERVER);
echo "<hr>";
*/
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
							//var_dump($datos_asignado);
							unset($_SESSION['DenID']);
							?>
							<h3>Denuncia: </h3>
							<form class="form-horizontal" action="../logica/procesarReasignarDenuncia.php" method="POST">
								<fieldset>
									<input name="iddenuncia" type="text" value="<?php echo $_GET['id'] ?>" hidden>
									<input name="idgestion" type="text" value="<?php echo $datos_asignado[0]['IDGESTIONA'] ?>" hidden>
									<div class="form-group">
										<label class="col-md-5 control-label">ID</label>  
										<label class="col-md-5 control-label" style="text-align: left;"><?php echo utf8_encode($datos_denuncia[0]['IDDENUNCIA']) ?></label>  
									</div>
									<div class="form-group">
										<label class="col-md-5 control-label">FECHA</label>  
										<label class="col-md-5 control-label" style="text-align: left;"><?php echo utf8_encode($datos_denuncia[0]['FECHADENUNCIA']) ?></label>  
									</div>
									<div class="form-group">
										<label class="col-md-5 control-label">TIPO</label>  
										<label class="col-md-5 control-label" style="text-align: left;"><?php echo utf8_encode($datos_denuncia[0]['TIPO']) ?></label>  
									</div>
									<div class="form-group">
										<label class="col-md-5 control-label">IDOBJETO</label>  
										<label class="col-md-5 control-label" style="text-align: left;"><?php echo utf8_encode($datos_denuncia[0]['IDOBJETO']) ?></label>  
									</div>
									<div class="form-group">
										<label class="col-md-5 control-label">COMENTARIO</label>  
										<label class="col-md-5 control-label" style="text-align: left;"><?php echo utf8_encode($datos_denuncia[0]['COMENTARIO']) ?></label>  
									</div>
									<div class="form-group">
										<label class="col-md-5 control-label">ESTADO</label>  
										<label class="col-md-5 control-label" style="text-align: left;"><?php echo utf8_encode($datos_denuncia[0]['ESTADO']) ?></label>  
									</div>
									<div class="form-group">
										<label class="col-md-5 control-label">Asignado a</label>  
										<label class="col-md-5 control-label" style="text-align: left;"><?php echo utf8_encode($datos_asignado[0]['USUARIO']) ?></label>  
									</div>
									<?php
									/*si sos admin*/
									$datos_admins = require_once('../logica/procesarCargaUsuariosBackend.php');
									//var_dump($datos_admins);
									if (($_SESSION['rolbk']=="ADMINISTRADOR") && ($datos_denuncia[0]['ESTADO']=='EN PROCESO')) {
										?>
										<div class="form-group">
											<label class="col-md-5 control-label">Reasignar</label>  
											<div class="col-md-5">
												<div class="input-group">
													<select class="selectpicker form-control" data-live-search="true" name="idadmin">
														<?php
														for ($i=0; $i < count($datos_admins); $i++) {
															?>
															<option value="<?php echo utf8_encode($datos_admins[$i]['ID']) ?>"><?php echo utf8_encode($datos_admins[$i]['USUARIO']) ?></option>
															<?php
														}
														?>
													</select>
													<span class="input-group-btn">
														<button type="submit" class="btn btn-success">
															<span class="glyphicon glyphicon-thumbs-up"></span> Asignar
														</button>
													</span>
												</div>
											</div>
										</div>
										<?php 
									}
									?>
								</fieldset>
							</form>
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
								<form class="form-horizontal" action="../view/mgmtpublicaciones.php" method="GET">
									<fieldset>
										<input name="id" type="text" value="<?php echo $datos_denuncia[0]['IDOBJETO'] ?>" hidden>
										<div class="form-group">
											<label class="col-md-5 control-label">Titulo</label>  
											<label class="col-md-7 control-label" style="text-align: left;"><?php echo utf8_encode($datos_publicacion[0]['TITULO']) ?></label>  
										</div>
										<div class="form-group">
											<label class="col-md-5 control-label">Ver</label>  
											<div class="col-md-5">
												<a href="../view/mgmtpublicaciones.php?id=<?php echo $datos_denuncia[0]['IDOBJETO'] ?>">
													<button class="btn btn-xs btn-info">
														<i class="fa fa-external-link" aria-hidden="true"></i>
													</button>
												</a>

											</div>
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
									$datos_mensaje = require_once('../logica/procesarCargaChat.php');
									//var_dump($datos_mensaje);//
									unset($_SESSION['idmensaje']);
									$_SESSION['idmensaje']=$_GET['id'];
									?>
									<div class="product-mesages">
										<div class="chat_window">
											<ul class="messages">
												<li class="message left appeared">
													<div class="text_wrapper">
														<div class="text">Pregunta: <?php echo utf8_encode($datos_mensaje[0]['MENSAJE']); ?></div>
													</div>
												</li>
												<?php
												if (!is_null($datos_mensaje[0]['RESPUESTA'])) {
													?>
													<li class="message right appeared">
														<div class="text_wrapper">
															<div class="text">Respuesta: <?php echo utf8_encode($datos_mensaje[0]['RESPUESTA']); ?></div>
														</div>
													</li>
													<?php
												}
												?>								
											</ul>
										</div>
									</div>
									<form class="form-horizontal" action="" method="POST">
										<fieldset>
											<div class="form-group">
												<label class="col-md-5 control-label">Mensaje</label>  
												<div class="col-md-5">
													<label class="control-label" style="text-align: left;">
														<a target="_Blank" href="../view/mgmtmessages.php?id=<?php echo $datos_mensaje[0]['IDPREGUNTA'] ?>">
															<input class="btn btn-xs btn-info" type="button" value="Ver"/>
														</a>
													</label>
												</div>  
											</div>
										</fieldset>
									</form>
									<?php
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
							if (($_SESSION['idbk']==$datos_asignado[0]['IDUSUARIOADMIN']) && ($datos_denuncia[0]['ESTADO']=='EN PROCESO')) {
								?>
								<h3>Resolucion de incidencia: </h3>
								<form class="form-horizontal" action="../logica/procesarCerrarDenuncia.php" method="POST">
									<fieldset>
										<input name="iddenuncia" type="text" value="<?php echo $_GET['id'] ?>" hidden>
										<input name="idgestion" type="text" value="<?php echo $datos_asignado[0]['IDGESTIONA'] ?>" hidden>
										<!-- 
											<input name="idobjeto" type="text" value="<?php echo $datos_denuncia[0]['IDOBJETO'] ?>" hidden>
											<input name="tipo" type="text" value="<?php echo $datos_denuncia[0]['TIPO'] ?>" hidden>
										-->
										<div class="form-group">
											<label class="col-md-5 control-label">Veredicto:</label>  
											<div class="col-md-7">
												<div class="input-group">
													<label>
														<input type="radio" class="radio-icon" name="options" value="no" id="option1" autocomplete="off" checked><label for="option1">Sin Efecto </label>
													</label>
													<br>
													<label>
														<input type="radio" class="radio-icon" name="options" value="si" id="option2" autocomplete="off"><label for="option2">Baneado</label>
													</label>
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-5 control-label">Comentario:</label>  
											<div class="col-md-7">
												<div class="input-group">
													<textarea class="form-control" rows="5" name="comentario"></textarea>
													<div class="space-ten"></div>
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="col-md-5">

											</div>
											<div class="col-md-5">
												<button type="submit" class="btn btn-success">
													<span class="glyphicon glyphicon-thumbs-up"></span> Guardar Cambios
												</button> 
											</div>
										</div>
									</fieldset>
								</form>
								<?php
							}elseif ($datos_denuncia[0]['ESTADO']=='CERRADA'){
								?>
								<h3>Resolucion de incidencia: </h3>
								<form class="form-horizontal" action="" method="POST">
									<fieldset>
										<div class="form-group">
											<label class="col-md-5 control-label">Veredicto</label> 
											<?php 
											if ($datos_denuncia[0]['HTML']=='si') {
												?> 
												<label class="col-md-5 control-label" style="text-align: left;">Baneado</label>  		
												<?php 
											}else{
												?> 
												<label class="col-md-5 control-label" style="text-align: left;">Sin Efecto</label>  		
												<?php 
											}
											?> 
										</div>
										<div class="form-group">
											<label class="col-md-5 control-label">Comentario</label>  
											<label class="col-md-7 control-label" style="text-align: left;"><?php echo htmlspecialchars_decode($datos_denuncia['0']['DESCRIPCION'], ENT_NOQUOTES); ?> </label>
										</div>
									</fieldset>
								</form>
								<?php
							}
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
					<?php
					if ($_SESSION['rolbk']=="ADMINISTRADOR") {
						?>
						<div class="rightcpanel">
							<h4>Listado de Denuncias</h4>
							<?php
							if (isset($datos_denuncias["this"])) {
								?>
								<p>No existen denuncias abiertas.</p>
								<?php
							}else{
								?>
								<div class="table-responsive">
									<table id="tablatodas" class="table table-condensed table-striped table-bordered" cellspacing="0" width="100%">
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
											for ($i=0; $i < count($datos_denuncias); $i++) { 
												/*DATOS_PUBLICACIONES.ID,CATEGORIA.TITULO,DATOS_PUBLICACIONES.TITULO,DATOS_PUBLICACIONES.PRECIO, DATOS_PUBLICACIONES.OFERTA*/
												?>
												<tr>
													<td><?php echo $datos_denuncias[$i]['IDDENUNCIA'] ?></td>
													<td><?php echo utf8_encode($datos_denuncias[$i]['TIPO']) ?></td>
													<td class="text-center"><?php echo date("d/m/Y", strtotime($datos_denuncias[$i]['FECHADENUNCIA'])) ?></td>
													<td class="text-right">
														<a href="../view/mgmtreports.php?id=<?php echo $datos_denuncias[$i]['IDDENUNCIA'] ?>">
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
						<?php
					}
					?>
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
	$('#tablatodas').DataTable( {
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