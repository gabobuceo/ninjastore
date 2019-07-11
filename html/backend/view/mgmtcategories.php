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
		$('#tablacategorias').DataTable();
	} );
</script>
<?php
/*-----------------------------------------------------------------------------------------------------------*/
/* Fin scripts de esta pagina.*/
/*-----------------------------------------------------------------------------------------------------------*/
/* Agregar todo control, puntual para esta pagina (Como la sesion).*/
/*-----------------------------------------------------------------------------------------------------------*/
require('header.php');
$datos_categorias = require_once('../logica/procesarListadoCategorias.php');
/*-----------------------------------------------------------------------------------------------------------*/
/* Agregar todo el contenido de esta pagina aqui.*/
/*-----------------------------------------------------------------------------------------------------------*/
?>
<!-- ::::::::::::::  CATEGORIAS PRINCIPALES :::::::::::::: -->
<div class="row affix-row">
	<div class="col-sm-3 col-md-2 affix-sidebar">
		<?php
		$_SESSION['menu']=3;
		require('menu.php');
		unset($_SESSION['menu']);
		?>
	</div>
	<div class="col-sm-9 col-md-10">
		<div class="row maincpanel">
			<div class="col-md-7">
				<div class="single-page main-grid-border">
					<div class="leftcpanel">
						<?php
						if (isset($_GET['id'])) {
							$_SESSION['CatID']=$_GET['id'];
							$datos_categoria = require_once('../logica/procesarCargaCategoria.php');
							$datos_categorias_padre = require_once('../logica/procesarCargaPadres.php');
							unset($_SESSION['CatID']);
							if ($datos_categoria[0]['TITULOPADRE']=="Categorias Padre"){
								$_SESSION['CatID']=$datos_categoria[0]['ID'];
								$datos_categorias_hijas = require_once('../logica/procesarCargaHijas.php');
								unset($_SESSION['CatID']);
								/*var_dump($datos_categorias_hijas);
								echo "<hr>";*/
							}
							/*
							var_dump($datos_categoria);
							echo "<hr>";
							
							var_dump($datos_categorias_padre);
							*/
							?>
							<h4>Configuración de Categoría</h4>
							<form class="form-horizontal" action="../logica/procesarModificarCategoria.php" method="POST">
								<fieldset>
									<input name="idcat" type="text" value="<?php echo $_GET['id'] ?>" hidden>
									<div class="form-group">
										<label class="col-md-5 control-label">Titulo</label>  
										<?php 
										if ($_SESSION['rolbk']=="ADMINISTRADOR") {
											?>
											<div class="col-md-5">
												<div class="input-group">
													<input name="titulo" type="text" class="form-control" value="<?php echo utf8_encode($datos_categoria[0]['TITULO']) ?>">
													<span class="input-group-btn">
														<button type="submit" class="btn btn-success">
															<span class="glyphicon glyphicon-thumbs-up"></span> Guardar Cambios
														</button>
													</span>
												</div>
											</div>
											<?php	
										}else{
											?>
											<input name="cedula" type="hidden" class="form-control" value="<?php echo utf8_encode($datos_categoria[0]['TITULO']) ?>" hidden >
											<label class="col-md-5 control-label" style="text-align: left;"><?php echo utf8_encode($datos_categoria[0]['TITULO']) ?></label>  
											<?php	
										}
										?>
									</div>
								</fieldset>
							</form>
							<form class="form-horizontal" action="../view/test.php" method="POST">
								<fieldset><input name="idcat" type="text" value="<?php echo $_GET['id'] ?>" hidden>
									<div class="form-group">
										<label class="col-md-5 control-label">Cantidad de Publicaciones</label>  
										<label class="col-md-5 control-label" style="text-align: left;">
											<?php 
											if (is_null($datos_categoria[0]['CANTIDAD'])) {
												echo "0 Publicaciones";
											}else{
												echo utf8_encode($datos_categoria[0]['CANTIDAD'])." Publicaciones" ;
											}
											?>

										</label>  
									</div>
								</fieldset>
							</form>
							<form class="form-horizontal" action="../logica/procesarModificarPadre.php" method="POST">
								<fieldset><input name="idcat" type="text" value="<?php echo $_GET['id'] ?>" hidden>
									<div class="form-group">
										<label class="col-md-5 control-label">Categoria Padre</label>  
										<?php 
										if ($_SESSION['rolbk']=="ADMINISTRADOR") { 
											if (isset($datos_categorias_hijas["this"])) {
												?>
												<div class="form-group">
													<div class="col-md-5">
														<div class="input-group my-group"> 
															<label class="control-label" style="text-align: left;">Es padre no tiene categorias hijas</label> 
														</div>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-5 control-label">Hacerla hija de</label>
													<div class="col-md-5">
														<div class="input-group my-group"> 
															<select class="selectpicker form-control" data-live-search="true" name="categoria">
																<?php 
																for ($i=0; $i < count($datos_categorias_padre); $i++) { 
																	?>
																	<option value="<?php echo $datos_categorias_padre[$i]['ID']; ?>" <?php if ($datos_categorias_padre[$i]['ID']==$datos_categoria[0]['PADRE']){ echo "selected"; } ?> ><?php echo utf8_encode($datos_categorias_padre[$i]['TITULO']); ?></option>
																	<?php
																}
																?>
															</select>
															<span class="input-group-btn">
																<button type="submit" class="btn btn-success">
																	<span class="glyphicon glyphicon-thumbs-up"></span> Guardar Cambios
																</button>
															</span>
														</div>
													</div>
												</div>
												<?php
											}else{
												if ($datos_categoria[0]['TITULOPADRE']=="Categorias Padre"){
													?>
													<div class="form-group">
														<div class="col-md-5">
															<div class="input-group my-group"> 
																<label class="control-label" style="text-align: left;">Es padre con <?php echo count($datos_categorias_hijas); ?> categorias hijas</label> 
																<select class="selectpicker form-control" data-live-search="true" name="categoria">
																	<?php 
																	for ($i=0; $i < count($datos_categorias_hijas); $i++) { 
																		?>
																		<option value="<?php echo $datos_categorias_hijas[$i]['ID']; ?>" ><?php echo utf8_encode($datos_categorias_hijas[$i]['TITULO']); ?></option>
																		<?php
																	}
																	?>
																</select> 
															</div>
														</div>
													</div>
													<?php
												} else{
													?>
													<div class="col-md-5">
														<div class="input-group my-group"> 
															<select class="selectpicker form-control" data-live-search="true" name="categoria">
																<?php 
																for ($i=0; $i < count($datos_categorias_padre); $i++) { 
																	?>
																	<option value="<?php echo $datos_categorias_padre[$i]['ID']; ?>" <?php if ($datos_categorias_padre[$i]['ID']==$datos_categoria[0]['PADRE']){ echo "selected"; } ?> ><?php echo utf8_encode($datos_categorias_padre[$i]['TITULO']); ?></option>
																	<?php
																}
																?>
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
											}
										}else{
											?>
											<input name="usuario" type="hidden" class="form-control" value="<?php echo utf8_encode($datos_categoria[0]['TITULOPADRE']) ?>" hidden>
											<label class="col-md-5 control-label" style="text-align: left;"><?php echo utf8_encode($datos_categoria[0]['TITULOPADRE']) ?></label>  
											<?php	
										}
										?>
									</div>
								</fieldset>
							</form>
							<form class="form-horizontal" action="../logica/procesarBajaCategoria.php" method="POST">
								<fieldset><input name="idcat" type="text" value="<?php echo $_GET['id'] ?>" hidden>
									<div class="form-group">
										<label class="col-md-5 control-label">Baja: <?php echo utf8_encode($datos_categoria[0]['BAJA']) ?></label>  
										<?php 
										if ((($_SESSION['rolbk']=="ADMINISTRADOR") AND ($datos_categoria[0]['TITULOPADRE']!="Categorias Padre")) OR (isset($datos_categorias_hijas["this"])) ){
											?>
											<div class="col-md-5">
												<div class="input-group my-group"> 
													<select class="selectpicker form-control" name="bajacat">
														<option value="1" <?php if ($datos_categoria[0]['BAJA']=="0"){ echo "selected"; } ?> >Eliminar</option>
														<option value="0" <?php if ($datos_categoria[0]['BAJA']=="1"){ echo "selected"; } ?> >Reactivar</option>
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
							<?php
						}else{
							?>
							<h4>Árbol de Categorias</h4>
							<?php
							$a=cargarCategoriasPadres();
							$b=count($a);
							for ($i=0; $i < $b; $i++) {
								?>
								<div class="categorias">
									<ul>
										<a href="javascript:void(0)"><lh><?php echo utf8_encode($a[$i]['TITULO']) ?></lh></a>
										<?php
										$c=cargarCategoriasHijos($a[$i]['ID']);
										$d=count($c);
										for ($j=0; $j < $d; $j++) {
											?>
											<a href="javascript:void(0)"><li><?php echo utf8_encode($c[$j]['TITULO']) ?></li></a>
											<?php
										}
										?>
									</ul>
								</div>
								<?php
							}
						}
						?>
						<div class="clearfix">...</div>
					</div>
				</div>
			</div>
			<div class="col-md-5">
				<?php
				if ($_SESSION['rolbk']=="ADMINISTRADOR") {
					?>
					<div class="single-page main-grid-border">
						<div class="rightcpanel">
							<form class="form-horizontal" action="../logica/procesarAltaCategoria.php" method="POST">
								<fieldset>
									<h4>Alta de Categoria</h4>
									<div class="form-group">
										<label class="col-md-5 control-label">Titulo</label>  
										<div class="col-md-5">
											<div class="input-group">
												<input name="titulo" type="text" class="form-control">
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-5 control-label">Padre</label>
										<div class="col-md-5">
											<div class="input-group my-group"> 
												<select class="col-md-5 selectpicker form-control" data-live-search="true" name="categoria">
													<option value="1>">Categoria Padre</option>
													<?php 
													if (!isset($_GET['id'])) {
														$_SESSION['CatID']=1;
														$datos_categorias_padre = require_once('../logica/procesarCargaPadres.php');
														unset($_SESSION['CatID']);
													}
													for ($i=0; $i < count($datos_categorias_padre); $i++) { 
														?>
														<option value="<?php echo $datos_categorias_padre[$i]['ID']; ?>"><?php echo utf8_encode($datos_categorias_padre[$i]['TITULO']); ?></option>
														<?php
													}
													?>
												</select>

											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-5 control-label" ></label>  
										<div class="col-md-5">
											<button type="submit" class="btn btn-success">
												<span class="glyphicon glyphicon-thumbs-up"></span> Crear Categoria
											</button> 
										</div>
									</div>
								</fieldset>
							</form>
						</div>
					</div>
					<?php
				}
				?>
				<div class="single-page main-grid-border">
					<div class="rightcpanel">
						<?php	
						if (isset($datos_categorias["this"])) {
							?>
							<p>No existen categorias.</p>
							<?php
						}else{
							?>
							<h4>Listado de Categorias</h4>
							<div class="table-responsive">
								<table id="tablacategorias" class="table table-condensed table-striped table-bordered" cellspacing="0" width="100%">
									<thead>
										<tr>
											<td><strong>ID</strong></td>
											<td class="text-center"><strong>Categoria</strong></td>
											<td class="text-right"><strong>Ver</strong></td>
										</tr>
									</thead>
									<tbody>
										<?php
										for ($i=0; $i < count($datos_categorias); $i++) { 
											?>
											<tr>
												<td><?php echo utf8_encode($datos_categorias[$i]['ID']) ?></td>
												<td><?php echo utf8_encode($datos_categorias[$i]['TITULO']) ?></td>
												<td class="text-right">
													<a href="../view/mgmtcategories.php?id=<?php echo $datos_categorias[$i]['ID'] ?>">
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
</div>
<script>
	$('#tablacategorias').DataTable( {
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
<!-- ::::::::::::::  FIN PUBLICACIONES VARIAS  :::::::::::::: -->

<?php
/*-----------------------------------------------------------------------------------------------------------*/
/* Fin contenido de esta pagina.*/
/*-----------------------------------------------------------------------------------------------------------*/
/*echo "<br><br><br><br><br><br><br><br><br><br>";*/
require('footer.php');
?>