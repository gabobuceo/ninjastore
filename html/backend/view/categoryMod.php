<?php
session_start();
require('definitions.php');
/*-----------------------------------------------------------------------------------------------------------*/
/* Agregar todo script, puntual para esta pagina.*/
/*-----------------------------------------------------------------------------------------------------------*/
?>
<script src='https://api.tiles.mapbox.com/mapbox-gl-js/v0.53.1/mapbox-gl.js'></script>
<link href='https://api.tiles.mapbox.com/mapbox-gl-js/v0.53.1/mapbox-gl.css' rel='stylesheet' />
<?php
/*-----------------------------------------------------------------------------------------------------------*/
/* Fin scripts de esta pagina.*/
/*-----------------------------------------------------------------------------------------------------------*/
/* Agregar todo control, puntual para esta pagina (Como la sesion).*/
/*-----------------------------------------------------------------------------------------------------------*/
require('header.php');
/*-----------------------------------------------------------------------------------------------------------*/
/* Agregar todo el contenido de esta pagina aqui.*/
$datos_categoria = cargarUnaCategoria($_GET['idCatMod']);
$tituloPadre = cargarTituloCategoria($datos_categoria[0]['PADRE']);
$categorias_padre = cargarCategoriasPadreActivas();
if (!(is_null($_GET['padre']))) {
	$esPadre = $_GET['padre'];
}else {
	$esPadre = 0;
}
unset($_SESSION['idCatMod']);
unset($_GET['padre']);
// var_dump($esPadre);
// die();
?>
<div class="row affix-row">
	<div class="col-sm-3 col-md-2 affix-sidebar">
		<?php
			$_SESSION['menu']=7;
			require('menu.php');
			unset($_SESSION['menu']);
		?>
	</div>
	<div class="col-sm-9 col-md-10">
		<div class="row maincpanel">
			<div class="col-md-7">
				<div class="single-page main-grid-border">
					<div class="leftcpanel">
						<form class="form-horizontal" action="../logica/procesarModificarCategoria.php" method="POST">
							<fieldset>
								<h4>Modificar datos de la categoría</h4>
								<?php
								if (isset($_SESSION['mobjetivo']) && $_SESSION['mobjetivo']=="misdatos"){
									echo "<div id='mensajealerta' class='alert ".$_SESSION['mtipo']." alert-dismissable'>
									<button type='button' class='close' data-dismiss='alert'>&times;</button>".$_SESSION['mtexto']."</div>";
									unset($_SESSION['mobjetivo']);
									unset($_SESSION['mtipo']);
									unset($_SESSION['mtexto']);
									unset($_SESSION['debugeame']);
								}
								?>
								<!-- En la variable hidden guardo el id de la categoria para enviar por post al procesar -->
								<input type="hidden" name="idCatMod" value="<?php echo utf8_encode($datos_categoria[0]['ID'])?>">
								<div class="form-group">
									<label class="col-md-5 control-label">Titulo</label>
									<div class="col-md-5">
										<div class="input-group">
											<input name="titulo" type="text" class="form-control" value="<?php echo utf8_encode($datos_categoria[0]['TITULO']) ?>">
										</div>
									</div>
								<!--Comienzo if es padre no puede modificar su padre -->
								<?php
								 	if ($esPadre==0) {
										?>
											<div class="form-group">
												<label class="col-md-5 control-label">Cambiar Padre</label>
												<div class="col-md-5">
													<div class="input-group">
														<select name="idPadre" class="form-control col-md-5">
															<option class="form-control" value="<?php echo utf8_encode($datos_categoria[0]['PADRE']) ?>"><?php echo utf8_encode($tituloPadre[0]['TITULO'])?></option>
															<?php
																//Recorre todas las catorias padre y carga el select con todas menos la
																for ($i=0; $i < count($categorias_padre) ; $i++) {
																	if (($categorias_padre[$i]['ID']) != ($datos_categoria[0]['ID'])) {
																		?>
																					<option class="form-control" value="<?php echo utf8_encode($categorias_padre[$i]['ID'])?>"><?php echo utf8_encode($categorias_padre[$i]['TITULO'])?></option>
																		<?php
																	}
																}
															?>
															<input type="hidden" name="padre" value="<?php echo utf8_encode($esPadre)?>">
														</select>
													</div>
												</div>
											</div>
										<?php
								 	} else {
								 		?>
											<label>Esta categoria es padre, solo puede modificar su titulo</label>
											<input type="hidden" name="padre" value="<?php echo utf8_encode($esPadre)?>">
										<?php
								 	}
								?>
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
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
<?php
/*-----------------------------------------------------------------------------------------------------------*/
/* Fin contenido de esta pagina.*/
/*-----------------------------------------------------------------------------------------------------------*/
require('footer.php');
?>
