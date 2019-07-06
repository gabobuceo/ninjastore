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
						<form class="form-horizontal" action="../logica/procesarActivarCategoria.php" method="POST">
							<fieldset>
								<h4>Desea activar la categoría?</h4>
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
								<input type="hidden" name="idCatMod" value="<?php echo utf8_encode($datos_categoria[0]['ID'])?>">
								 <div class="form-group">
						  	  <label class="col-md-6 control-label">Titulo</label>
						 	  	 <br>
						 	  	 <br>
                    <label class="col-md-8 control-label"><?php echo utf8_encode($datos_categoria[0]['TITULO']) ?></label>
                </div>
                    <br>
                    <br>
                    
                    <div>
                    	 <div class="form-group">
                  		<label class="col-md-5 control-label" ></label>
                 		 <div class="col-md-5">
                    	  <button type="submit" class="btn btn-success">
                        <span class="glyphicon glyphicon-thumbs-up"></span> Activar</button>
                    </div>
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
