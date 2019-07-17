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
<link rel='stylesheet' href='<?php echo $staticsrv; ?>/css/dataTables.bootstrap.min.css'>

<script type="text/javascript" src="<?php echo $staticsrv; ?>/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo $staticsrv; ?>/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#tablapublicaciones').DataTable();
		$('#tablabaneadas').DataTable();
	} );
</script>

<script type="text/javascript" src="<?php echo $staticsrv; ?>/ckeditor/ckeditor.js"></script>

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
$datos_publicacion_activas = require_once('../logica/procesarListadoPublicacionesActivas.php');
$datos_publicacion_baneadas = require_once('../logica/procesarListadoPublicacionesBaneadas.php');
/*var_dump($datos_publicacion_activas);
echo "<hr>";
var_dump($datos_publicacion_baneadas);
echo "<hr>";
/*var_dump($datos_publicacion_cerradas);
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
						<h4>Ver Publicacion</h4>
						<?php
						if (isset($_GET['id'])) {
							$_SESSION['PubID']=$_GET['id'];
							$datos_publicacion = require_once('../logica/procesarCargaPublicacion.php');
							$datos_publicacionimg = require_once('../logica/procesarCargaPublicacionImg.php');
							$datos_preguntas = require_once('../logica/procesarCargaPreguntas.php');
							
							$datos_categorias_hijas = require_once('../logica/procesarCargaCatHijas.php');
							//consultaCatHijas
							/*var_dump($datos_publicacion);
							var_dump($datos_categorias_hijas);
							var_dump($_SESSION);*/
							unset($_SESSION['PubID']);
							?>
							<h3>Publicacion: </h3>
							<form class="form-horizontal" action="../logica/procesarModificarPublicacion.php" method="POST">
								<fieldset>
									<input name="idpub" type="text" value="<?php echo $_GET['id'] ?>" hidden>
									<div class="form-group">
										<label class="col-md-5 control-label">Titulo</label>  
										<div class="col-md-7">
											<div class="input-group">
												<input name="titulo" type="text" class="form-control" value="<?php echo utf8_encode($datos_publicacion['0']['TITULO']); ?>">
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-5 control-label">Descripcion</label>  
										<div class="col-md-7">
											<div class="input-group">
												<textarea name="editor1" id="editor1" rows="10" cols="80" >
													<?php echo $datos_publicacion[0]['DESCRIPCION'];?>
												</textarea>
												<script>
													CKEDITOR.replace( 'editor1' );
												</script>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-5 control-label">Precio</label>  
										<div class="col-md-7">
											<div class="input-group">
												<input name="precio" type="number" class="form-control" value="<?php echo $datos_publicacion['0']['PRECIO']; ?>">
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-5 control-label">Cantidad</label>  
										<div class="col-md-7">
											<div class="input-group">
												<input name="cantidad" type="number" class="form-control" value="<?php echo $datos_publicacion['0']['CANTIDAD']; ?>">
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-5 control-label">Categoria</label>
										<div class="col-md-7">
											<select class="selectpicker form-control" data-live-search="true" name="categoria">
												<?php 
												for ($i=0; $i < count($datos_categorias_hijas); $i++) { 
													?>
													<option value="<?php echo $datos_categorias_hijas[$i]['ID']; ?>" <?php if ($datos_categorias_hijas[$i]['ID']==$datos_publicacion[0]['IDCATEGORIA']){ echo "selected"; } ?> ><?php echo utf8_encode($datos_categorias_hijas[$i]['TITULO']); ?></option>
													<?php
												}
												?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-5 control-label">Estado Articulo</label>  
										<div class="col-md-7">
											<select class="selectpicker form-control" data-live-search="true" name="estadoa">
												<option value="NUEVO" <?php if ($datos_publicacion['0']['ESTADOA']=="NUEVO"){ echo "selected"; } ?> >Nuevo</option>
												<option value="USADO" <?php if ($datos_publicacion['0']['ESTADOA']=="USADO"){ echo "selected"; } ?> >Usado</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-5 control-label">Estado Publicacion</label>  
										<div class="col-md-7">
											<select class="selectpicker form-control" data-live-search="true" name="estadop">
												<option value="PUBLICADA" <?php if ($datos_publicacion['0']['ESTADOP']=="PUBLICADA"){ echo "selected"; } ?> >Publicada</option>
												<option value="BORRADOR" <?php if ($datos_publicacion['0']['ESTADOP']=="BORRADOR"){ echo "selected"; } ?> >Borrador</option>
												<option value="FINALIZADO" <?php if ($datos_publicacion['0']['ESTADOP']=="FINALIZADO"){ echo "selected"; } ?> >Finalizado</option>
												<option value="BANEADA" <?php if ($datos_publicacion['0']['ESTADOP']=="BANEADA"){ echo "selected"; } ?> >Baneada</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-5 control-label" ></label>  
										<div class="col-md-5">
											<button type="submit" class="btn btn-success">
												<span class="glyphicon glyphicon-thumbs-up"></span> Guardar Cambios
											</button> 
										</div>
									</div>
								</fieldset>
							</form>
							<h3>Baja: </h3>
							<form class="form-horizontal" action="../logica/procesarBajaPublicacion.php" method="POST">
								<fieldset>
									<input name="idpub" type="text" value="<?php echo $_GET['id'] ?>" hidden>
									<div class="form-group">
										<label class="col-md-5 control-label">Baja: <?php echo utf8_encode($datos_publicacion[0]['BAJA']) ?></label>  
										<?php 
										if ($_SESSION['rolbk']=="ADMINISTRADOR") {
											?>
											<div class="col-md-5">
												<div class="input-group my-group"> 
													<select class="selectpicker form-control" name="bajapub">
														<option value="1" <?php if ($datos_publicacion[0]['BAJA']=="0"){ echo "selected"; } ?> >Eliminar</option>
														<option value="0" <?php if ($datos_publicacion[0]['BAJA']=="1"){ echo "selected"; } ?> >Reactivar</option>
													</select>
													<span class="input-group-btn">
														<button type="submit" class="btn btn-success">
															<span class="glyphicon glyphicon-thumbs-up"></span> Guardar Cambios
														</button>
													</span>
												</div>
											</div>
											<?php
										}
										?>
									</div>
								</fieldset>
							</form>
							<h3>Imagenes: </h3>
							<ul class='thumbnails'>
								<?php
								for ($i=0; $i < count($datos_publicacionimg); $i++) { 
									?>
									<form class="form-horizontal" action="../logica/procesarBanearImagen.php" method="POST">
										<fieldset>
											<input name="idpub" type="text" value="<?php echo $_GET['id'] ?>" hidden>
											<input name="idimg" type="text" value="<?php echo $datos_publicacionimg[$i]['ID'] ?>" hidden>
											<input name="imagen" type="text" value="<?php echo $datos_publicacionimg[$i]['IMAGENES'] ?>" hidden>
											<div class="form-group">
												<label class="col-md-5 control-label">
													<li>
														<a target="_blank" href='<?php echo $staticsrv; ?>/imagenes/<?php echo $datos_publicacionimg[$i]['IMAGENES'] ?>.webp' data-standard='<?php echo $staticsrv; ?>/imagenes/<?php echo $datos_publicacionimg[$i]['IMAGENES'] ?>.webp'>
															<img src='<?php echo $staticsrv; ?>/imagenes/<?php echo $datos_publicacionimg[$i]['IMAGENES'] ?>_tn.webp' />
														</a>
													</li>
												</label> 
												<?php 
												if ($datos_publicacionimg[$i]['IMAGENES']!="noimage") {
													?> 	
													<div class="col-md-5" style="padding-top: 13px !important;">
														<button type="submit" class="btn btn-warning">
															<span class="glyphicon glyphicon-remove-circle"></span> Banear
														</button> 
													</div>
													<?php 
												}
												?> 
											</div>
										</fieldset>
									</form>
									<?php
								}
								?>
							</ul>
							<?php
							if (!isset($datos_preguntas['this'])) {
								?>
								<h3>Preguntas: <?php echo count($datos_preguntas) ?></h3>
								<hr>
								<?php
								for ($i=0; $i < count($datos_preguntas); $i++) { 
									?>
									<form class="form-horizontal" action="../view/test.php" method="POST">
										<fieldset>
											<input name="idpub" type="text" value="<?php echo $_GET['id'] ?>" hidden>
											<div class="form-group">
												<label class="col-md-5 control-label">Pregunta: <br><?php echo utf8_encode($datos_preguntas[$i]['MENSAJE']); ?></label>
												<label class="col-md-5 control-label" style="text-align: left;">Respuesta: <br><?php echo utf8_encode($datos_preguntas[$i]['RESPUESTA']); ?></label>
												<div class="col-md-2">
													<button type="submit" class="btn btn-warning">
														<span class="glyphicon glyphicon-remove-circle"></span> Banear
													</button> 
												</div>
											</div>
										</fieldset>
									</form>
									<hr>
									<?php
								}
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
					<div class="rightcpanel">
						<h4>Listado de Publicaciones</h4>
						<?php				
						if (isset($datos_publicacion_activas["this"])) {
							?>
							<p>No tienes publicaciones desactivadas.</p>
							<?php
						}else{
							?>
							<div class="table-responsive">
								<table id="tablapublicaciones" class="table table-condensed table-striped table-bordered" cellspacing="0" width="100%">
									<thead>
										<tr>
											<td><strong>ID</strong></td>
											<td class="text-center"><strong>Publicacion</strong></td>
											<td class="text-center"><strong>Fecha</strong></td>
											<td class="text-right"><strong>Ver</strong></td>
										</tr>
									</thead>
									<tbody>
										<?php
										for ($i=0; $i < count($datos_publicacion_activas); $i++) { 
											/*DATOS_PUBLICACIONES.ID,CATEGORIA.TITULO,DATOS_PUBLICACIONES.TITULO,DATOS_PUBLICACIONES.PRECIO, DATOS_PUBLICACIONES.OFERTA*/
											?>
											<tr>
												<td><?php echo $datos_publicacion_activas[$i]['ID'] ?></td>
												<td><?php echo utf8_encode($datos_publicacion_activas[$i]['TITULO']) ?></td>
												<td class="text-center"><?php echo date("d/m/Y", strtotime($datos_publicacion_activas[$i]['FECHA'])) ?></td>
												<td class="text-right">
													<a href="../view/mgmtpublicaciones.php?id=<?php echo $datos_publicacion_activas[$i]['ID'] ?>">
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
						<h4>Publicaciones Baneadas</h4>
						<?php				
						if (isset($datos_publicacion_baneadas["this"])) {
							?>
							<p>No existen publicaciones baneadas.</p>
							<?php
						}else{
							?>
							<div class="table-responsive">
								<table id="tablabaneadas" class="table table-condensed table-striped table-bordered" cellspacing="0" width="100%">
									<thead>
										<tr>
											<td><strong>ID</strong></td>
											<td class="text-center"><strong>Publicacion</strong></td>
											<td class="text-center"><strong>Fecha</strong></td>
											<td class="text-right"><strong>Ver</strong></td>
										</tr>
									</thead>
									<tbody>
										<?php
										for ($i=0; $i < count($datos_publicacion_baneadas); $i++) { 
											/*DATOS_PUBLICACIONES.ID,CATEGORIA.TITULO,DATOS_PUBLICACIONES.TITULO,DATOS_PUBLICACIONES.PRECIO, DATOS_PUBLICACIONES.OFERTA*/
											?>
											<tr>
												<td><?php echo $datos_publicacion_baneadas[$i]['ID'] ?></td>
												<td><?php echo utf8_encode($datos_publicacion_baneadas[$i]['TITULO']) ?></td>
												<td class="text-center"><?php echo date("d/m/Y", strtotime($datos_publicacion_baneadas[$i]['FECHA'])) ?></td>
												<td class="text-right">
													<a href="../view/mgmtpublicaciones.php?id=<?php echo $datos_publicacion_baneadas[$i]['ID'] ?>">
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
	$('#tablabaneadas').DataTable( {
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