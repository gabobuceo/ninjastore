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
//$datos_rol = require_once('../logica/procesarCargaRol.php');
/*-----------------------------------------------------------------------------------------------------------*/
/* Agregar todo el contenido de esta pagina aqui.*/
/*-----------------------------------------------------------------------------------------------------------*/
//$datos_usuario = require_once('../logica/procesarCargaUsuario.php');
//$_SESSION['IDVENDEDOR']=$_SESSION['id'];
//$datos_telefono = require_once('../logica/procesarCargaTelefonos.php');
// if (is_null($datos_usuario[0]['GEOY'])) {
// 	$datos_usuario[0]['GEOX']="-34.871116";
// 	$datos_usuario[0]['GEOY']="-56.167731";
// }
/*var_dump($_SESSION);
var_dump($datos_telefono);*/
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
						<form class="form-horizontal" action="../logica/procesarAltaUsuarioAdmin.php" method="POST">
							<fieldset>
								<h4>Crear Usuario</h4>
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
									<label class="col-md-5 control-label">Cedula de Identidad</label>
									<div class="col-md-5">
										<div class="input-group">
											<input name="cedula" type="text" class="form-control" value="" required="required">
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-5 control-label">Usuario</label>
									<div class="col-md-5">
										<div class="input-group">
											<input name="usuario" type="text" class="form-control" value="" required="required">
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-5 control-label">Contraseña</label>
									<div class="col-md-5">
										<div class="input-group">
											<input name="password" type="password" class="form-control" value="" required="required">
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-5 control-label">Primer Nombre</label>
									<div class="col-md-5">
										<div class="input-group">
											<input name="pnombre" type="text" class="form-control" value="" required="required">
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-5 control-label">Segundo Nombre</label>
									<div class="col-md-5">
										<div class="input-group">
											<input name="snombre" type="text" class="form-control" value="">
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-5 control-label">Primer Apellido</label>
									<div class="col-md-5">
										<div class="input-group">
											<input name="papellido" type="text" class="form-control" value="" required="required">
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-5 control-label">Segundo Apellido</label>
									<div class="col-md-5">
										<div class="input-group">
											<input name="sapellido" type="text" class="form-control" value="" required="required">
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-5 control-label">Fecha de Nacimiento</label>
									<div class="col-md-5">
										<div class="input-group">
											<input name="fnacimiento" type="date" class="form-control input-md" value="" required="required">
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-5 control-label">Correo Electronico</label>
									<div class="col-md-5">
										<div class="input-group">
											<input name="email" type="email" class="form-control" value="" required="required">
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-5 control-label">Dirección</label>
									<div class="col-md-5">
										<div class="input-group">
											<input name="calle" type="text" class="form-control" value="" required="required">
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-5 control-label">Número</label>
									<div class="col-md-5">
										<div class="input-group">
											<input name="numero" type="number" min="1" max="9999" class="form-control" value="" required="required">
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-5 control-label">Esquina</label>
									<div class="col-md-5">
										<div class="input-group">
											<input name="esquina" type="text" class="form-control" value="" required="required">
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-5 control-label">Código Postal</label>
									<div class="col-md-5">
										<div class="input-group">
											<input name="cpostal" type="text" class="form-control" value="" required="required">
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-5 control-label">Departamento</label>
									<div class="col-md-5">
										<div class="input-group">
											<select name="departamento" type="text" class="form-control">
												<option class="form-control" value="Artigas">ARTIGAS</option>
												<option class="form-control" value="Canelones">CANELONES</option>
												<option class="form-control" value="Cerro Largo">CERRO LARGO</option>
												<option class="form-control" value="Colonia">COLONIA</option>
												<option class="form-control" value="Durazno">DURAZNO</option>
												<option class="form-control" value="Flores">FLORES</option>
												<option class="form-control" value="Flores">FLORIDA</option>
												<option class="form-control" value="Lavalleja">LAVALLEJA</option>
												<option class="form-control" value="Maldonado">MALDONADO</option>
												<option class="form-control" value="Montevideo">MONTEVIDEO</option>
												<option class="form-control" value="Paysandu">PAYSANDU</option>
												<option class="form-control" value="Rio Negro">RIO NEGRO</option>
												<option class="form-control" value="Rivera">RIVERA</option>
												<option class="form-control" value="Rocha">ROCHA</option>
												<option class="form-control" value="Salto">SALTO</option>
												<option class="form-control" value="San Jose">SAN JOSE</option>
												<option class="form-control" value="Soriano">ROCHA</option>
												<option class="form-control" value="Tacuarembo">TACUAREMBO</option>
												<option class="form-control" value="Treinta y Tres">TREINTA Y TRES</option>
											</select>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-5 control-label">Localidad</i></label>
									<div class="col-md-5">
										<div class="input-group">
											<input name="localidad" type="text" class="form-control" value="" required="required">
										</div>
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-5 control-label">Tipo de cuenta</label>
									<div class="col-md-5">
										<div class="input-group">
											<select name="tipo" type="text" class="form-control">
												<option class="form-control" value="COMUN" checked>COMUN</option>
												<option class="form-control" value="VIP">VIP</option>
											</select>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-5 control-label">Rol</label>
									<div class="col-md-5">
										<div class="input-group">
											<select name="rol" class="form-control col-md-5">
												<option class="form-control" value="MODERADOR" checked>MODERADOR</option>
												<option class="form-control" value="ADMINISTRADOR">ADMINISTRADOR</option>
												<option class="form-control" value="CLIENTE">CLIENTE</option>
												
											</select>
										</div>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-5 control-label" ></label>
									<div class="col-md-5">
										<button type="submit" class="btn btn-success">
											<span class="glyphicon glyphicon-thumbs-up"></span> Guardar Cambios
										</button>
										<td><a class="btn btn-success" href="../view/sumary.php"</a> <i class="glyphicon glyphicon-chevron-left" aria-hidden="true"></i> Atras</a> </td>
									</div>
								</div>
							</fieldset>
						</form>
					</div>
				</div>
			</div>
			<!-- <div class="col-md-5">
				<div class="single-page main-grid-border">
					<div class="rightcpanel">
						<form class="form-horizontal" action="../logica/procesarModificarUsuarioPassword.php" method="POST">
							<fieldset>
								<h4>Cambiar Contraseña</h4>
								<?php
								if (isset($_SESSION['mobjetivo']) && $_SESSION['mobjetivo']=="micontraseña"){
									echo "<div id='mensajealerta' class='alert ".$_SESSION['mtipo']." alert-dismissable'>
									<button type='button' class='close' data-dismiss='alert'>&times;</button>".$_SESSION['mtexto']."</div>";
									unset($_SESSION['mobjetivo']);
									unset($_SESSION['mtipo']);
									unset($_SESSION['mtexto']);
									unset($_SESSION['debugeame']);
								}
								?>
								<div class="form-group">
									<label class="col-md-5 control-label">Contraseña Actual</label>
									<div class="col-md-5">
										<div class="input-group">
											<input name="oldpassword" type="password" class="form-control">
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-5 control-label">Nueva Contraseña</label>
									<div class="col-md-5">
										<div class="input-group">
											<input name="newpassword" type="password" class="form-control">
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-5 control-label">Confirmar</label>
									<div class="col-md-5">
										<div class="input-group">
											<input name="confirmpassword" type="password" class="form-control">
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-5 control-label" ></label>
									<div class="col-md-5">
										<button type="submit" class="btn btn-success">
											<span class="glyphicon glyphicon-thumbs-up"></span> Cambiar Contraseña
										</button>
									</div>
								</div>
							</fieldset>
						</form>
					</div>
				</div> -->
				<div class="single-page main-grid-border col-md-5">
					<div class="rightcpanel">
						<h4>Telefonos</h4>
						<?php
						if (isset($_SESSION['mobjetivo']) && $_SESSION['mobjetivo']=="mitelefono"){
							echo "<div id='mensajealerta' class='alert ".$_SESSION['mtipo']." alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert'>&times;</button>".$_SESSION['mtexto']."</div>";
							unset($_SESSION['mobjetivo']);
							unset($_SESSION['mtipo']);
							unset($_SESSION['mtexto']);
							unset($_SESSION['debugeame']);
						}
						?>
						<form id='formphoneadd' class="form-horizontal" action='../logica/procesarAltaTelefono.php' method="POST">
							<fieldset>
								<div class="form-group">
									<label class="col-md-5 control-label">Agregar Telefono</label>
									<div class="col-md-5">
										<div class="input-group">
											<input type="number" class="form-control" id="newphone" name="newphone">
											<div class="input-group-addon btn btn-success" onClick="document.forms['formphoneadd'].submit();">
												<i class="fa fa-plus" aria-hidden="true"></i>
											</div>
										</div>
									</div>
								</div>
							</fieldset>
						</form>
						<form id='formphoneremove' class="form-horizontal" action='../logica/procesarBajaTelefono.php' method="POST">
							<fieldset>
								<div class="form-group">
									<label class="col-md-5 control-label">Sus Telefonos</label>
									<?php
									if (isset($datos_telefono["this"])) {
										?>
										<label class="col-md-5 control-label">No tiene telefonos agregados</label>
										<?php
									}else{
										?>
										<div class="col-md-5">
											<div class="input-group">
												<select class="form-control" name="listphones">
													<?php
													for ($i=0; $i < count($datos_telefono); $i++) {
														?>
														<option value="<?php echo utf8_encode($datos_telefono[$i]['TELEFONO']) ?>"><?php echo utf8_encode($datos_telefono[$i]['TELEFONO']) ?></option>
														<?php
													}
													?>
												</select>
												<div class="input-group-addon btn btn-warning" onClick="document.forms['formphoneremove'].submit();">
													<i class="fa fa-minus" aria-hidden="true"></i>
												</div>
											</div>
										</div>
										<?php
									}
									?>
								</div>
							</fieldset>
						</form>
					</div>
				</div>
				<div class="single-page main-grid-border">
					<div class="rightcpanel">
						<form class="form-horizontal" action="../logica/procesarModificarUsuarioGeo.php" method="POST">
							<fieldset>
								<h4>Mi Geolocalizacion</h4>
								<?php
								if (isset($_SESSION['mobjetivo']) && $_SESSION['mobjetivo']=="migeo"){
									echo "<div id='mensajealerta' class='alert ".$_SESSION['mtipo']." alert-dismissable'>
									<button type='button' class='close' data-dismiss='alert'>&times;</button>".$_SESSION['mtexto']."</div>";
									unset($_SESSION['mobjetivo']);
									unset($_SESSION['mtipo']);
									unset($_SESSION['mtexto']);
									unset($_SESSION['debugeame']);
								}
								?>
								<div id='map' style="height: 350px;margin-bottom: 10px;"></div>
								<div class="form-group">
									<label class="col-md-5 control-label">Latitud</label>
									<div class="col-md-5">
										<div id='latitud' class="input-group">
											<input name="latitud" type="text" class="form-control" value="<?php echo utf8_encode($datos_usuario[0]['GEOX']) ?>">
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-5 control-label">Longitud</label>
									<div class="col-md-5">
										<div id='longitud' class="input-group">
											<input name="longitud" type="text" class="form-control" value="<?php echo utf8_encode($datos_usuario[0]['GEOY']) ?>">
										</div>
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
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	mapboxgl.accessToken = 'pk.eyJ1IjoiZ2Fib2J1Y2VvIiwiYSI6ImNqdGVvemt1cTAweDg0NHBkNG9xbnFidWwifQ.uGa2jaTYPH0kxdRLhhYjGA';
//var coordinates = document.getElementById('coordinates');
var map = new mapboxgl.Map({
	container: 'map',
	style: 'mapbox://styles/mapbox/streets-v9',
	center: [<?php echo utf8_encode($datos_usuario[0]['GEOY']) ?>, <?php echo utf8_encode($datos_usuario[0]['GEOX']) ?>],
	zoom: 15
});

var marker = new mapboxgl.Marker({
	draggable: true
})
.setLngLat([<?php echo utf8_encode($datos_usuario[0]['GEOY']) ?>, <?php echo utf8_encode($datos_usuario[0]['GEOX']) ?>])
.addTo(map);

function onDragEnd() {
	var lngLat = marker.getLngLat();
//coordinates.style.display = 'block';
latitud.innerHTML = "<input name='latitud' type='text' class='form-control' value='" + lngLat.lat + "'>";
longitud.innerHTML = "<input name='longitud' type='text' class='form-control' value='" + lngLat.lng + "'>";
}

marker.on('dragend', onDragEnd);
</script>
<?php
/*-----------------------------------------------------------------------------------------------------------*/
/* Fin contenido de esta pagina.*/
/*-----------------------------------------------------------------------------------------------------------*/
require('footer.php');
?>