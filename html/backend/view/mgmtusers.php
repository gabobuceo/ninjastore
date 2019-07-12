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
		$('#tablafrontend').DataTable();
		$('#tablabackend').DataTable();
	} );
</script>
<?php
/*-----------------------------------------------------------------------------------------------------------*/
/* Fin scripts de esta pagina.*/
/*-----------------------------------------------------------------------------------------------------------*/
/* Agregar todo control, puntual para esta pagina (Como la sesion).*/
/*-----------------------------------------------------------------------------------------------------------*/
require('header.php');
$datos_usuarios_frontend = require_once('../logica/procesarCargaUsuariosFrontend.php');
$datos_usuarios_backend = require_once('../logica/procesarCargaUsuariosBackend.php');
/*var_dump($datos_usuarios_frontend);
echo "<hr>";
var_dump($datos_usuarios_backend);*/
/*-----------------------------------------------------------------------------------------------------------*/
/* Agregar todo el contenido de esta pagina aqui.*/
/*-----------------------------------------------------------------------------------------------------------*/
/*$idUsu = $_SESSION['id'];
//$datos_usuario = cargarUnUsuario($_SESSION['id']);
//$datos_usuario = require_once('../logica/procesarCargaUsuario.php');
$datos_telefono = cargaTelefonosMod($_SESSION['id']);
if (is_null($datos_usuario[0]['GEOY'])) {
	$datos_usuario[0]['GEOX']="-34.871116";
	$datos_usuario[0]['GEOY']="-56.167731";
}
var_dump($_SESSION);
var_dump($datos_telefono);
*/
?>
<div class="row affix-row">
	<div class="col-sm-3 col-md-2 affix-sidebar">
		<?php
		$_SESSION['menu']=2;
		require('menu.php');
		unset($_SESSION['menu']);
		?>
	</div>
	<div class="col-sm-9 col-md-10">
		<div class="row maincpanel">
			<div class="col-md-7">
				<div class="single-page main-grid-border">
					<div class="leftcpanel">
						<h4>Ver Usuario</h4>
						<?php
						if (isset($_GET['id'])) {
							$datos_usuario = require_once('../logica/procesarCargaUsuarios.php');
							$datos_telefono = require_once('../logica/procesarCargaTelefonos.php');
							if (is_null($datos_usuario[0]['GEOY'])) {
								$datos_usuario[0]['GEOX']="-34.871116";
								$datos_usuario[0]['GEOY']="-56.167731";
							}
							?>
							<h3>Perfil: </h3>
							<form class="form-horizontal" action="../logica/procesarModificarUsuario.php" method="POST">
								<fieldset>
									<input name="idusumod" type="text" value="<?php echo $_GET['id'] ?>" hidden>
									<div class="form-group">
										<label class="col-md-5 control-label">Cedula</label>  
										<?php 
										if ($_SESSION['rolbk']=="ADMINISTRADOR") {
											?>
											<div class="col-md-5">
												<div class="input-group">
													<input name="cedula" type="text" class="form-control" value="<?php echo utf8_encode($datos_usuario[0]['CEDULA']) ?>">
												</div>
											</div>
											<?php	
										}else{
											?>
											<input name="cedula" type="hidden" class="form-control" value="<?php echo utf8_encode($datos_usuario[0]['CEDULA']) ?>" hidden >
											<label class="col-md-5 control-label" style="text-align: left;"><?php echo utf8_encode($datos_usuario[0]['CEDULA']) ?></label>  
											<?php	
										}
										?>
									</div>
									<div class="form-group">
										<label class="col-md-5 control-label">Usuario</label>  
										<?php 
										if ($_SESSION['rolbk']=="ADMINISTRADOR") {
											?>
											<div class="col-md-5">
												<div class="input-group">
													<input name="usuario" type="text" class="form-control" value="<?php echo utf8_encode($datos_usuario[0]['USUARIO']) ?>">
												</div>
											</div>
											<?php	
										}else{
											?>
											<input name="usuario" type="hidden" class="form-control" value="<?php echo utf8_encode($datos_usuario[0]['USUARIO']) ?>" hidden>
											<label class="col-md-5 control-label" style="text-align: left;"><?php echo utf8_encode($datos_usuario[0]['USUARIO']) ?></label>  
											<?php	
										}
										?>
									</div>
									<div class="form-group">
										<label class="col-md-5 control-label">Primer Nombre</label>  
										<div class="col-md-5">
											<div class="input-group">
												<input name="pnombre" type="text" class="form-control" value="<?php echo utf8_encode($datos_usuario[0]['PNOMBRE']) ?>">
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-5 control-label">Segundo Nombre</label>  
										<div class="col-md-5">
											<div class="input-group">
												<input name="snombre" type="text" class="form-control" value="<?php echo utf8_encode($datos_usuario[0]['SNOMBRE']) ?>">
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-5 control-label">Primer Apellido</label>  
										<div class="col-md-5">
											<div class="input-group">
												<input name="papellido" type="text" class="form-control" value="<?php echo utf8_encode($datos_usuario[0]['PAPELLIDO']) ?>">
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-5 control-label">Segundo Apellido</label>  
										<div class="col-md-5">
											<div class="input-group">
												<input name="sapellido" type="text" class="form-control" value="<?php echo utf8_encode($datos_usuario[0]['SAPELLIDO']) ?>">
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-5 control-label">Fecha de Nacimiento</label>  
										<div class="col-md-5">
											<div class="input-group">
												<input name="fnacimiento" type="date" class="form-control input-md" value="<?php echo utf8_encode(substr($datos_usuario[0]['FNACIMIENTO'],0,10)) ?>">
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-5 control-label">Correo Electronico</label>  
										<div class="col-md-5">
											<div class="input-group">
												<input name="email" type="email" class="form-control" value="<?php echo utf8_encode($datos_usuario[0]['EMAIL']) ?>">
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-5 control-label">Dirección</label>  
										<div class="col-md-5">
											<div class="input-group">
												<input name="calle" type="text" class="form-control" value="<?php echo utf8_encode($datos_usuario[0]['CALLE']) ?>">
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-5 control-label">Número</label>  
										<div class="col-md-5">
											<div class="input-group">
												<input name="numero" type="number" min="1" max="9999" class="form-control" value="<?php echo utf8_encode($datos_usuario[0]['NUMERO']) ?>">
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-5 control-label">Esquina</label>  
										<div class="col-md-5">
											<div class="input-group">
												<input name="esquina" type="text" class="form-control" value="<?php echo utf8_encode($datos_usuario[0]['ESQUINA']) ?>">
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-5 control-label">Código Postal</label>  
										<div class="col-md-5">
											<div class="input-group">
												<input name="cpostal" type="text" class="form-control" value="<?php echo utf8_encode($datos_usuario[0]['CPOSTAL']) ?>">
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-5 control-label">Localidad</i></label>  
										<div class="col-md-5">
											<div class="input-group">
												<input name="localidad" type="text" class="form-control" value="<?php echo utf8_encode($datos_usuario[0]['LOCALIDAD']) ?>">
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-5 control-label">Departamento</label>  
										<div class="col-md-5">
											<div class="input-group">
												<input name="departamento" type="text" class="form-control" value="<?php echo utf8_encode($datos_usuario[0]['DEPARTAMENTO']) ?>">
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
							<h3>Tipo: </h3>
							<form class="form-horizontal" action="../logica/procesarModificarEstado.php" method="POST">
								<fieldset><input name="idusumod" type="text" value="<?php echo $_GET['id'] ?>" hidden>
									<div class="form-group">
										<label class="col-md-5 control-label">Estado: <?php echo utf8_encode($datos_usuario[0]['ESTADO']) ?></label>  
										<div class="col-md-5">
											<div class="input-group my-group"> 
												<select class="selectpicker form-control" name="estadousu">
													<option value="CONFIRMAR EMAIL" <?php if ($datos_usuario[0]['ESTADO']=="CONFIRMAR EMAIL"){ echo "selected"; } ?> >Confirmar email</option>
													<option value="ACTIVADO" <?php if ($datos_usuario[0]['ESTADO']=="ACTIVADO"){ echo "selected"; } ?> >Activado</option>
													<option value="BANEADO" <?php if ($datos_usuario[0]['ESTADO']=="BANEADO"){ echo "selected"; } ?> >Baneado</option>
													<option value="BLOQUEADO" <?php if ($datos_usuario[0]['ESTADO']=="BLOQUEADO"){ echo "selected"; } ?> >Bloqueado</option>
													<option value="DESHABILITADO" <?php if ($datos_usuario[0]['ESTADO']=="DESHABILITADO"){ echo "selected"; } ?> >Deshabilitado</option>
													<option value="MANTENIMIENTO" <?php if ($datos_usuario[0]['ESTADO']=="MANTENIMIENTO"){ echo "selected"; } ?> >Mantenimiento</option>
												</select>
												<span class="input-group-btn">
													<button type="submit" class="btn btn-success">
														<span class="glyphicon glyphicon-thumbs-up"></span> Guardar Cambios
													</button>
												</span>
											</div>
										</div>
									</div>
								</fieldset>
							</form>
							<form class="form-horizontal" action="../logica/procesarModificarTipo.php" method="POST">
								<fieldset><input name="idusumod" type="text" value="<?php echo $_GET['id'] ?>" hidden>
									<div class="form-group">
										<label class="col-md-5 control-label">Tipo de Usuario: <?php echo utf8_encode($datos_usuario[0]['TIPO']) ?></label>  
										<?php 
										if ($_SESSION['rolbk']=="ADMINISTRADOR") {
											?>
											<div class="col-md-5">
												<div class="input-group my-group"> 
													<select name="tipousuario" class="selectpicker form-control">
														<option value='COMUN' <?php if ($datos_usuario[0]['TIPO']=="COMUN"){ echo "selected"; } ?> >Común</option>
														<option value='VIP' <?php if ($datos_usuario[0]['TIPO']=="VIPL"){ echo "selected"; } ?> >VIP</option>
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
							<form class="form-horizontal" action="../logica/procesarModificarRol.php" method="POST">
								<fieldset><input name="idusumod" type="text" value="<?php echo $_GET['id'] ?>" hidden>
									<div class="form-group">
										<label class="col-md-5 control-label">Rol: <?php echo utf8_encode($datos_usuario[0]['ROL']) ?></label>  
										<?php 
										if ($_SESSION['rolbk']=="ADMINISTRADOR") {
											?>
											<div class="col-md-5">
												<div class="input-group my-group"> 
													<select class="selectpicker form-control" name="rolusu">
														<option value="CLIENTE" <?php if ($datos_usuario[0]['ROL']=="CLIENTE"){ echo "selected"; } ?> >Cliente</option>
														<option value="MODERADOR" <?php if ($datos_usuario[0]['ROL']=="MODERADOR"){ echo "selected"; } ?> >Moderador</option>
														<option value="ADMINISTRADOR" <?php if ($datos_usuario[0]['ROL']=="ADMINISTRADOR"){ echo "selected"; } ?> >Administrador</option>
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
							<form class="form-horizontal" action="../logica/procesarBajaUsuario.php" method="POST">
								<fieldset><input name="idusumod" type="text" value="<?php echo $_GET['id'] ?>" hidden>
									<div class="form-group">
										<label class="col-md-5 control-label">Baja: <?php echo utf8_encode($datos_usuario[0]['BAJA']) ?></label>  
										<?php 
										if ($_SESSION['rolbk']=="ADMINISTRADOR") {
											?>
											<div class="col-md-5">
												<div class="input-group my-group"> 
													<select class="selectpicker form-control" name="bajausu">
														<option value="1" <?php if ($datos_usuario[0]['BAJA']=="0"){ echo "selected"; } ?> >Eliminar</option>
														<option value="0" <?php if ($datos_usuario[0]['BAJA']=="1"){ echo "selected"; } ?> >Reactivar</option>
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
							<h3>Telefonos: </h3>
							<form id='formphoneadd' class="form-horizontal" action='../logica/procesarAltaTelefono.php' method="POST">
								<fieldset><input name="idusumod" type="text" value="<?php echo $_GET['id'] ?>" hidden>
									<div class="form-group">
										<label class="col-md-5 control-label">Agregar Telefono</label>  
										<div class="col-md-5">
											<div class="input-group">
												<input type="text" class="form-control" id="newphone" name="newphone">
												<div class="input-group-addon btn btn-success" onClick="document.forms['formphoneadd'].submit();">
													<i class="fa fa-plus" aria-hidden="true"></i>
												</div>
											</div>
										</div>
									</div>
								</fieldset>
							</form>
							<form id='formphoneremove' class="form-horizontal" action='../logica/procesarBajaTelefono.php' method="POST">
								<fieldset><input name="idusumod" type="text" value="<?php echo $_GET['id'] ?>" hidden>
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
							<h3>Geolocalizacion: </h3>
							<form class="form-horizontal" action="../logica/procesarModificarUsuarioGeo.php" method="POST">
								<fieldset>
									<input name="idusumod" type="text" value="<?php echo $_GET['id'] ?>" hidden>					
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
										<label class="col-md-5 control-label">Latitud Actual</label>  
										<div class="col-md-5">
											<div id='' class="input-group">
												<label class="col-md-5 control-label" style="text-align: left;"><?php echo utf8_encode($datos_usuario[0]['GEOX']) ?></label>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-5 control-label">Longitud Actual</label>  
										<div class="col-md-5">
											<div id='' class="input-group">
												<label class="col-md-5 control-label" style="text-align: left;"><?php echo utf8_encode($datos_usuario[0]['GEOY']) ?></label>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-5 control-label">Latitud Nueva</label>  
										<div class="col-md-5">
											<div id='latitud' class="input-group">
												<input name="latitud" type="text" class="form-control" value="<?php echo utf8_encode($datos_usuario[0]['GEOX']) ?>">
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-5 control-label">Longitud Nueva</label>  
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
							<?php
						}else{
							?>
							<div class="row">
								<div class="col-md-12 product_img">
									<p>Para cargar un usuario. haga click en su enlace</p>
								</div>
							</div>
							<?php
						}
						?>
					</div>
				</div>
			</div>


			<div class="col-md-5">
				<?php
				if ($_SESSION['rolbk']=="ADMINISTRADOR") {
					?>
					<div class="single-page main-grid-border">
						<div class="rightcpanel">
							<form class="form-horizontal" action="../logica/procesarAltaUsuario.php" method="POST">
								<fieldset>
									<h4>Alta de usuarios Backend</h4>
									<div class="form-group">
										<label class="col-md-5 control-label">Usuario</label>  
										<div class="col-md-5">
											<div class="input-group">
												<input name="usuario" type="text" class="form-control">
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-5 control-label">Contraseña</label>  
										<div class="col-md-5">
											<div class="input-group">
												<input name="password" type="password" class="form-control">
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-5 control-label">Cédula</label>  
										<div class="col-md-5">
											<div class="input-group">
												<input name="cedula" type="text" class="form-control input-md">
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-5 control-label">Nombre</label>  
										<div class="col-md-5">
											<div class="input-group">
												<input name="pNombre" type="text" class="form-control">
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-5 control-label">Apellido</label>  
										<div class="col-md-5">
											<div class="input-group">
												<input name="pApellido" type="text" class="form-control">
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-5 control-label">Fecha de Nacimiento</label>  
										<div class="col-md-5">
											<div class="input-group">
												<input name="fNacimiento" type="date" class="form-control input-md">
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-5 control-label">Correo Electronico</label>  
										<div class="col-md-5">
											<div class="input-group">
												<input name="email" type="email" class="form-control"">
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-5 control-label">Rol</label>  
										<div class="col-md-5">
											<div class="input-group">
												<select class="form-control" name="rol">
													<option val="MODERADOR">Moderador</option>
													<option val="ADMINISTRADOR">Administrador</option>
												</select>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-5 control-label" ></label>  
										<div class="col-md-5">
											<button type="submit" class="btn btn-success">
												<span class="glyphicon glyphicon-thumbs-up"></span> Crear Usuario
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
						if (isset($datos_usuarios_frontend["this"])) {
							?>
							<p>No existen usuarios en el frontend.</p>
							<?php
						}else{
							?>
							<h4>Listado usuarios FrontEnd</h4>
							<div class="table-responsive">
								<table id="tablafrontend" class="table table-condensed table-striped table-bordered" cellspacing="0" width="100%">
									<thead>
										<tr>
											<td><strong>Usuario</strong></td>
											<td class="text-center"><strong>Cedula</strong></td>
											<td class="text-center"><strong>Nombre</strong></td>
											<td class="text-center"><strong>Apellido</strong></td>
											<td class="text-center"><strong>Email</strong></td>
											<td class="text-right"><strong>Ver</strong></td>
										</tr>
									</thead>
									<tbody>
										<?php
										for ($i=0; $i < count($datos_usuarios_frontend); $i++) { 
											?>
											<tr>
												<td><?php echo utf8_encode($datos_usuarios_frontend[$i]['USUARIO']) ?></td>
												<td class="text-center"><?php echo $datos_usuarios_frontend[$i]['CEDULA']; ?></td>
												<td class="text-center"><?php echo utf8_encode($datos_usuarios_frontend[$i]['PNOMBRE']); ?></td>
												<td class="text-center"><?php echo utf8_encode($datos_usuarios_frontend[$i]['PAPELLIDO']); ?></td>
												<td class="text-center"><?php echo $datos_usuarios_frontend[$i]['EMAIL']; ?></td>
												<td class="text-right">
													<a href="../view/mgmtusers.php?id=<?php echo $datos_usuarios_frontend[$i]['ID'] ?>">
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
				<div class="single-page main-grid-border">
					<div class="rightcpanel">
						<?php				
						if (isset($datos_usuarios_backend["this"])) {
							?>
							<p>No existen usuarios en el backend.</p>
							<?php
						}else{
							?>
							<h4>Listado usuarios BackEnd</h4>
							<div class="table-responsive">
								<table id="tablabackend" class="table table-condensed table-striped table-bordered" cellspacing="0" width="100%">
									<thead>
										<tr>
											<td><strong>Usuario</strong></td>
											<td class="text-center"><strong>Cedula</strong></td>
											<td class="text-center"><strong>Nombre</strong></td>
											<td class="text-center"><strong>Apellido</strong></td>
											<td class="text-center"><strong>Email</strong></td>
											<td class="text-right"><strong>Ver</strong></td>
										</tr>
									</thead>
									<tbody>
										<?php
										for ($i=0; $i < count($datos_usuarios_backend); $i++) { 
											?>
											<tr>
												<td><?php echo utf8_encode($datos_usuarios_backend[$i]['USUARIO']) ?></td>
												<td class="text-center"><?php echo $datos_usuarios_backend[$i]['CEDULA']; ?></td>
												<td class="text-center"><?php echo utf8_encode($datos_usuarios_backend[$i]['PNOMBRE']); ?></td>
												<td class="text-center"><?php echo utf8_encode($datos_usuarios_backend[$i]['PAPELLIDO']); ?></td>
												<td class="text-center"><?php echo $datos_usuarios_backend[$i]['EMAIL']; ?></td>
												<td class="text-right">
													<a href="../view/mgmtusers.php?id=<?php echo $datos_usuarios_backend[$i]['ID'] ?>">
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
<script>
	$('#tablafrontend').DataTable( {
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
	$('#tablabackend').DataTable( {
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
