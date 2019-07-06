<?php
session_start();
require('definitions.php');
/*-----------------------------------------------------------------------------------------------------------*/
/* Agregar todo script, puntual para esta pagina.*/
/*-----------------------------------------------------------------------------------------------------------*/
?>
<?php
/*-----------------------------------------------------------------------------------------------------------*/
/* Fin scripts de esta pagina.*/
/*-----------------------------------------------------------------------------------------------------------*/
/* Agregar todo control, puntual para esta pagina (Como la sesion).*/
/*-----------------------------------------------------------------------------------------------------------*/
require('header.php');
/*-----------------------------------------------------------------------------------------------------------*/
/* Agregar todo el contenido de esta pagina aqui.*/
/*-----------------------------------------------------------------------------------------------------------*/
?>
<div class="row affix-row">
	<div class="col-sm-3 col-md-2 affix-sidebar">
		<div class="sidebar-nav">
			<div class="navbar navbar-default" role="navigation">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<span class="visible-xs navbar-brand">Panel de control del Usuario</span>
				</div>
				<div class="navbar-collapse collapse sidebar-navbar-collapse">
					<ul class="nav navbar-nav" id="sidenav01">
						<li><a href="index.php"><h4><i class="fa fa-book" aria-hidden="true"></i> Resumen</h4></a></li>
						<li class="active"><a href="myprofile.php"><i class="fa fa-id-card" aria-hidden="true"></i>Mi Perfil</a></li>
						<li><a href="searchprofile.php"><i class="fa fa-id-card" aria-hidden="true"></i>Buscar Perfil</a></li>
						<li><a href="mypublication.php"><i class="fa fa-shopping-bag" aria-hidden="true"></i> Publicaciones</a></li>
						<li><a href="mybuys.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Compras</a></li>
						<li><a href="myexchanges.php"><i class="fa fa-gavel" aria-hidden="true"></i> Permutas</a></li>
						<li><a href="mymessages.php"><i class="fa fa-commenting" aria-hidden="true"></i> Mensajes</a></li>
						<li><a href="myqualification.php"><i class="fa fa-star-half-o" aria-hidden="true"></i> Calficaciones</a></li>
						<li><a href="mybills.php"><i class="fa fa-money" aria-hidden="true"></i> Facturas</a></li>
						<li><a href="myreports.php"><i class="fa fa-bug" aria-hidden="true"></i> Denuncias</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-9 col-md-10">
		<div class="row maincpanel">
			<div class="col-md-7">
				<div class="single-page main-grid-border">
					<div class="leftcpanel">
						<form class="form-horizontal">
							<fieldset>
								<h4>Mis Datos</h4>
								<div class="form-group">
									<label class="col-md-5 control-label">Primer Nombre</label>
									<div class="col-md-5">
										<div class="input-group">
											<input name="pnombre" type="text" class="form-control">
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-5 control-label">Segundo Nombre</label>
									<div class="col-md-5">
										<div class="input-group">
											<input name="snombre" type="text" class="form-control">
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-5 control-label">Primer Apellido</label>
									<div class="col-md-5">
										<div class="input-group">
											<input name="papellido" type="text" class="form-control">
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-5 control-label">Segundo Apellido</label>
									<div class="col-md-5">
										<div class="input-group">
											<input name="sapellido" type="text" class="form-control">
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-5 control-label">Fecha de Nacimiento</label>
									<div class="col-md-5">
										<div class="input-group">
											<input name="fnacimiento" type="date" class="form-control input-md">
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-5 control-label">Correo Electronico</label>
									<div class="col-md-5">
										<div class="input-group">
											<input name="email" type="email" class="form-control">
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-5 control-label" for="Gender">Sexo</label>
									<div class="col-md-5">
										<label class="radio-inline" for="Gender-0">
											<input type="radio" name="sexo" id="m" value="1">
											Masculino
										</label>
										<label class="radio-inline" for="Gender-1">
											<input type="radio" name="sexo" id="f" value="2">
											Femenino
										</label>
										<label class="radio-inline" for="Gender-2">
											<input type="radio" name="sexo" id="o" value="3" checked="checked">
											Otro
										</label>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-5 control-label">Dirección</label>
									<div class="col-md-5">
										<div class="input-group">
											<input name="calle" type="text" class="form-control">
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-5 control-label">Número</label>
									<div class="col-md-5">
										<div class="input-group">
											<input name="numero" type="number" min="1" max="9999" class="form-control">
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-5 control-label">Esquina</label>
									<div class="col-md-5">
										<div class="input-group">
											<input name="esquina" type="text" class="form-control">
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-5 control-label">Código Postal</label>
									<div class="col-md-5">
										<div class="input-group">
											<input name="cpostal" type="text" class="form-control">
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-5 control-label">Localidad</label>
									<div class="col-md-5">
										<div class="input-group">
											<input name="localidad" type="text" class="form-control">
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-5 control-label">Departamento</label>
									<div class="col-md-5">
										<div class="input-group">
											<input name="departamento" type="text" class="form-control">
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-5 control-label" ></label>
									<div class="col-md-5">
										<a href="#" class="btn btn-success"><span class="glyphicon glyphicon-thumbs-up"></span> Guardar Cambios</a>
									</div>
								</div>
							</fieldset>
						</form>
					</div>
				</div>
			</div>
			<div class="col-md-5">
				<div class="single-page main-grid-border">
					<div class="rightcpanel">
						<form class="form-horizontal">
							<fieldset>
								<h4>Cambiar Contraseña</h4>
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
										<a href="#" class="btn btn-success"><span class="glyphicon glyphicon-thumbs-up"></span> Cambiar Contraseña</a>
									</div>
								</div>
							</fieldset>
						</form>
					</div>
				</div>
				<div class="single-page main-grid-border">
					<div class="rightcpanel">
						<form class="form-horizontal">
							<fieldset>
								<h4>Telefonos</h4>
								<div class="form-group">
									<label class="col-md-5 control-label">Agregar Telefono</label>
									<div class="col-md-5">
										<div class="input-group">
											<input type="text" class="form-control" id="newphone" name="newphone">
											<div class="input-group-addon btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i></div>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-5 control-label">Mis Telefonos</label>
									<div class="col-md-5">
										<div class="input-group">
											<select class="form-control" id="listphones">
												<option value="094606280">094606280</option>
											</select>
											<div class="input-group-addon btn btn-warning"><i class="fa fa-minus" aria-hidden="true"></i></div>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-5 control-label" ></label>
									<div class="col-md-5">
										<a href="#" class="btn btn-success"><span class="glyphicon glyphicon-thumbs-up"></span> Guardar Cambios</a>
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
<?php
/*-----------------------------------------------------------------------------------------------------------*/
/* Fin contenido de esta pagina.*/
/*-----------------------------------------------------------------------------------------------------------*/
require('footer.php');
?>
