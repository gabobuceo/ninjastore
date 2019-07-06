<?php 
session_start();
if(isset($_GET['cod'])){
	$_SESSION['activationkey']=$_GET['cod'];
	unset($_GET['cod']);
	header('Location: ../logica/procesarRecuperarCuenta.php');
}
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
				if(isset($_SESSION['MailDestino'])){
					require_once('../logica/funciones.php');
					$MailDestino=$_SESSION['MailDestino'];
					$MailTipo='recuperarcuenta';
					$MailNombre=$_SESSION['MailNombre'];
					$MailCod=$_SESSION['MailCod'];
					if(EnviarMail($MailDestino,$MailTipo,$MailNombre,$MailCod)){
						/*echo "Mail enviado";*/
					}else{
						/*echo "Mail no enviado";*/
					}
					?>
					<div class="sign-in-form-top">
						<h1>Prceso de recuperacion iniciado</h1>
					</div>
					<div class="signin">
						<p>Se ha enviado el codigo de activacion a su correo electrónico</p>
						<p>favor ingrese para continuar con el proceso de recuperacion.</p>
					</div>
					<?php
					unset($_SESSION['MailDestino']);
					unset($_SESSION['MailCod']);
					unset($_SESSION['MailNombre']);
				}elseif(isset($_SESSION['activationid'])){
					?>
					<div class="sign-in-form-top">
						<h1>Cambiar Contraseña</h1>
					</div>
					<div class="signin">
						<form action="../logica/procesarCambiarPassword.php" method="GET">
							<div class="log-input">
								<div class="log-input-left">
									<input type="password" class="lock" value="Nueva Contraseña" />
								</div>
								<div class="clearfix"> </div>
							</div>
							<div class="log-input">
								<div class="log-input-left">
									<input type="password" class="lock" value="Confirmar Contraseña" />
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
	/**********************************************************************************************************************/
	/**********************************************************************************************************************/
	/**********************************************************************************************************************/
	/**********************************************************************************************************************/
				}else{
					?>
					<div class="sign-in-form-top">
						<h1>Recuperar Contraseña</h1>
					</div>
					<div class="signin">
						<form action="../logica/procesarRecuperar.php" method="GET">
							<div class="log-input">
								<div class="log-input-left">
									<input type="text" name="recusuario" class="user" value="Usuario" />
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