<?php
session_start();
require('definitions.php');
require_once('../../logica/funciones.php');
/*-----------------------------------------------------------------------------------------------------------*/
/* Agregar todo script, puntual para esta pagina.*/
/*-----------------------------------------------------------------------------------------------------------*/
?>
<script src='https://api.tiles.mapbox.com/mapbox-gl-js/v0.53.1/mapbox-gl.js'></script>
<link href='https://api.tiles.mapbox.com/mapbox-gl-js/v0.53.1/mapbox-gl.css' rel='stylesheet' />
<?php
/*-----------------------------------------------------------------------------------------------------------*/
/* Fin scripts de esta pagina.*/
require('header.php');
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
            <form class="form-horizontal" action="categoryAlta.php?tipo" method="GET">
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
              <fieldset>
                <h4>Seleccione el tipo de categoría</h4>
                <div class="form-group">
                  <label class="col-md-5 control-label">Tipo de categoría</label>
                  <div class="col-md-5">
                    <div class="input-group">
                      <select name="tipo" class="form-control col-md-5">
                        <option class="form-control" selected disabled hidden></option>
                        <option class="form-control" value="padre">Padre</option>
                        <option class="form-control" value="hija">Hija</option>
                      </select>
                    </div>
                  </div>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                <div class="form-group">
                  <label class="col-md-5 control-label" ></label>
                  <div class="col-md-5">
                    <button type="submit" class="btn btn-success">
                      <span class="glyphicon glyphicon-thumbs-up"></span> Seleccionar</a>
                    </button>
                  </div>
                </div>
              </fieldset>
            </form>
						<?php
								if (isset($_GET['tipo'])){
										$cargaPregunta=true;
								}else{
										$cargaPregunta=false;
								}
								unset($_GET['estado']);
								//Debe seleccionar tipo de categoría para continuar
								if ($cargaPregunta) {
									if ($_GET['tipo'] == "padre"){
										?>
											<form class="form-horizontal" action="../logica/procesarAltaCategoria.php" method="POST">
												<fieldset>
													<h4>Crear Categoria</h4>
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
													<div class="form-group">
														<label class="col-md-5 control-label">Tipo de categoria seleccionada</label>
														<div class="col-md-5">
															<div class="input-group">
																<input type="tipomuestra" name="tipomuestra" disabled placeholder="<?php echo ($_GET['tipo']); ?>">
																<input name="modo" type="hidden" value="padre">
														   <br>
														</div>
													</div>
												</div>
												<div class="form-group">
												<label class="control-label col-md-5">Ingrese el nombre de la categoria</label>
														<div class="col-md-5">
															<input name="titulo" type="text" class="form-control" value="">
															<br>
														<button type="submit" class="btn btn-success">
																<span class="glyphicon glyphicon-thumbs-up"></span> Guardar Cambios
															</button>
														</div>
														</div>
														</div>
													</div>
												</fieldset>
											</form>
										<?php
									}else{
									?>
										<form class="form-horizontal" action="../logica/procesarAltaCategoria.php" method="POST">
											<fieldset>
												<h4>Crear Categoria</h4>
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
												<input name="modo" type="hidden" value="hija">
												<div class="form-group">
													<label class="col-md-5 control-label">Tipo de categoria</label>
													<div class="col-md-5">
														<div class="input-group">
															<input type="text" name="tipomuestra" disabled placeholder="<?php echo ($_GET['tipo']); ?>">
															</div>
														</div>
													</div>
												<div class="form-group">
												<label class="control-label col-md-5">Ingrese el nombre de la categoria hija</label>
														<div class="col-md-5">
															<input name="titulo" type="text" class="form-control" value="" required="required">
													</div>
													<br>
												<div class="form-group">
													
													<br>
													<br>
													<label class="col-md-5 control-label">Elija la categoría padre</label>
													<div class="col-md-5">
														<div class="input-group">
															<select name="idPadre" class="form-control col-md-5">
																<option class="form-control" selected disabled hidden></option>
																<?php
																	//cargo categorias activas
																	$datosCatPadres = cargarCategoriasPadreActivas();
																	for ($i=0; $i < count($datosCatPadres); $i++) {
																		?>
																			<option class="form-control" value="<?php echo utf8_encode($datosCatPadres[$i]['ID'])?>"><?php echo utf8_encode($datosCatPadres[$i]['TITULO'])?></option>
																		<?php
																	}
																?>
															</select>
														</div>
													</div>
												<div class="form-group">
													<label class="col-md-5 control-label" ></label>
													<br>
													<br>
													<button type="submit" class="btn btn-success">
															<span class="glyphicon glyphicon-thumbs-up"></span> Guardar Cambios
														</button>
													</div>
												</div>
											</fieldset>
										</form>
									<?php
									}
								}
						?>
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
