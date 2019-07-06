<?php
session_start();
require('definitions.php');
require_once('../logica/funciones.php');
//require('../logica/funciones.php');
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
// $hijas = cargarCategoriasHijos($datos_categoria[0]['ID']);
// var_dump($datos_categoria);
// var_dump($hijas);
//die();


if (!(is_null($_GET['padre']))) {
	$esPadre = $_GET['padre'];
}else {
	$esPadre = 0;
}
unset($_GET['padre']);
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
						<fieldset>
							<h4>Dar de baja una categoría</h4>
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
								<label class="col-md-5 control-label">Titulo</label>
								<div class="col-md-5">
                    <label class="col-md-5 control-label"><?php echo utf8_encode($datos_categoria[0]['TITULO']) ?></label>
								</div>
							<!--Comienzo if es padre no puede dar de baja-->
							<?php
							 	if ($esPadre==0) {
									?>
                  <form class="form-horizontal" action="../logica/procesarBajaCategoria.php" method="POST">
										<input type="hidden" name="idCatMod" value="<?php echo utf8_encode($datos_categoria[0]['ID'])?>">
                    <div class="form-group">
                      <label class="col-md-5 control-label">Tipo de categoría:</label>
                      <div class="col-md-3">
                        <label class="col-md-3 control-label">Hija</label>
                      </div>
                      <div class="col-md-7">
                        <label class="col-md-7 control-label">Titulo de categoria padre</label>
                      </div>
                      <div class="col-md-9">
                        <label class="col-md-9 control-label"><?php echo utf8_encode($tituloPadre[0]['TITULO'])?></label>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-5 control-label" ></label>
                      <div class="col-md-5">
                        <button type="submit" class="btn btn-danger">
                          <span class="glyphicon glyphicon-remove"></span> Dar de baja
                        </button>
                      </div>
                    </div>
                  </form>
									<?php
							 	} else {
									//Ya sabemos que es padre, ahora consultamos si tiene hijas, de lo contrario se puede dar de baja.
									if (!empty(cargarCategoriasHijos($datos_categoria[0]['ID']))) {
										// tiene hijas, debe eliminarlas
										?>
											<label class="col-md-5 control-label">Para dar de baja esta categoría, debe cambiar de padre sus categorías hijas</label>
                      <a href="../view/categorysearch.php"</a><span class="glyphicon glyphicon-thumbs-down"></span> Volver</td>
										<?php
									} else {
										// No tiene hijas se puede dar de baja
										?>
											<form class="form-horizontal" action="../logica/procesarBajaCategoria.php" method="POST">
												<input type="hidden" name="idCatMod" value="<?php echo utf8_encode($datos_categoria[0]['ID'])?>">
	                      <div class="form-group">
	                        <label class="col-md-5 control-label">Tipo de categoría:</label>
	                        <div class="col-md-3">
	                          <label class="col-md-3 control-label">Padre</label>
	                        </div>
	                        <div class="col-md-7">
	                          <label class="col-md-7 control-label">Esta categoría actualmente no tiene hijas, se puede dar de baja.</label>
	                        </div>
	                      <div class="form-group">
	                        <label class="col-md-5 control-label" ></label>
	                        <div class="col-md-5">
	                          <button type="submit" class="btn btn-success">
	                            <span class="glyphicon glyphicon-thumbs-down"></span> Dar de baja
	                          </button>
	                        </div>
	                      </div>
	                    </form>
										<?php
									}
							 	}
							?>
              </div>
						</fieldset>
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
