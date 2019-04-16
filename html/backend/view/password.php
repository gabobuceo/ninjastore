<?php 
session_start();
require('definitions.php');
/*-----------------------------------------------------------------------------------------------------------*/
/* Agregar todo script, puntual para esta pagina.*/
/*-----------------------------------------------------------------------------------------------------------*/
?>
<script src='https://www.google.com/recaptcha/api.js'></script>
<script type="text/javascript">
	var onloadCallback = function() {
		alert("grecaptcha is ready!");
	};
</script>
<?php 
/*-----------------------------------------------------------------------------------------------------------*/
/* Fin scripts de esta pagina.*/
require('header.php');
/*-----------------------------------------------------------------------------------------------------------*/
/* Agregar todo el contenido de esta pagina aqui.*/
/*-----------------------------------------------------------------------------------------------------------*/
?>
<!-- ::::::::::::::  PASSWORD  :::::::::::::: -->
<section>
	<div id="page-wrapper" class="sign-in-wrapper">
		<div class="graphs">
			<div class="sign-in-form">
				<?php
				if (isset($_SESSION['mobjetivo']) && $_SESSION['mobjetivo']=="password.php"){
					debugconsola($_SESSION['debugeame']);
					debugconsola($_SESSION['mobjetivo']);
					echo "<div class='alert ".$_SESSION['mtipo']." alert-dismissable'>
					<button type='button' class='close' data-dismiss='alert'>&times;</button>".$_SESSION['mtexto']."</div>";
					unset($_SESSION['mobjetivo']);
					unset($_SESSION['mtipo']);				
					unset($_SESSION['mtexto']);	
					unset($_SESSION['debugeame']);
				}
				if(isset($_SESSION['confirmacion']) and $_SESSION['confirmacion']=="S"){
					?>
					<div class="sign-in-form-top">
						<h1>Prceso de recuperacion iniciado</h1>
					</div>
					<div class="signin">
						<p>Se ha enviado el codigo de activacion a su correo electrónico</p>
						<p>favor ingrese para continuar con el proceso de recuperacion.</p>
					</div>
					<?php
					unset($_SESSION['confirmacion']);
				}elseif(isset($_SESSION['confirmacion']) and $_SESSION['confirmacion']=="E"){
					?>
					<div class="sign-in-form-top">
						<h1>Error de recuperacion</h1>
					</div>
					<div class="signin">
						<p>El codigo proporcionado no existe en el sistema.</p>
						<p>Favor inicar la recuperacion nuevamente.</p>
					</div>
					<?php
					unset($_SESSION['confirmacion']);
				}elseif(isset($_SESSION['confirmacion']) and $_SESSION['confirmacion']=="F"){
					?>
					<div class="sign-in-form-top">
						<h1>Contraseña Cambiada</h1>
					</div>
					<div class="signin">
						<p>Su contraseña ha sido cambiada exitosamente.</p>
						<p>Favor inicar sesión.</p>
					</div>
					<?php
					unset($_SESSION);
				}elseif(isset($_SESSION['confirmacion']) and $_SESSION['confirmacion']=="A"){
					?>
					<div class="sign-in-form-top">
						<h1>Cambiar Contraseña</h1>
					</div>
					<div class="signin">
						<form action="../logica/procesarCambiarPassword.php" method="GET">
							<div class="log-input">
								<div class="log-input-left">
									<input type="password" name="pass1" class="lock" placeholder="Nueva Contraseña" />
								</div>
								<div class="clearfix"> </div>
							</div>
							<div class="log-input">
								<div class="log-input-left">
									<input type="password" name="pass2" class="lock" placeholder="Confirmar Contraseña" />
								</div>
								<div class="clearfix"> </div>
							</div>
							<div class="captchaweapper">
								<div class="g-recaptcha" data-sitekey="6LdtADUUAAAAAEWxW3NrYhsHPteqlpiezGNGwWS-"></div>
							</div>
							<input type="submit" value="Confirmar cambio">
						</form>	 
					</div>
					<?php
					unset($_SESSION['confirmacion']);
				}else{
					?>
					<div class="sign-in-form-top">
						<h1>Recuperar Contraseña</h1>
					</div>
					<div class="signin">
						<form action="../logica/procesarRecuperar.php" method="GET">
							<div class="log-input">
								<div class="log-input-left">
									<input type="text" name="recusuario" class="user" placeholder="Usuario" />
								</div>
								<div class="clearfix"> </div>
							</div>
							<div class="captchaweapper">
								<div class="g-recaptcha" data-sitekey="6LdtADUUAAAAAEWxW3NrYhsHPteqlpiezGNGwWS-"></div>
							</div>
							<input type="submit" value="Recuperar">
						</form>	 
					</div>
					<?php
				}
				?>
			</div>
		</div>
	</div>
</section>
<!-- ::::::::::::::  FIN PASSWORD  :::::::::::::: -->
<?php 
/*-----------------------------------------------------------------------------------------------------------*/
/* Fin contenido de esta pagina.*/
/*-----------------------------------------------------------------------------------------------------------*/
require('footer.php');
?>