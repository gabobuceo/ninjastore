<?php
	session_start();
	require_once('../logica/funciones.php');

	$MailDestino=$_SESSION['MailDestino'];
	$MailTipo='activarcuenta';
	$MailNombre=$_SESSION['MailNombre'];
	$MailCod=$_SESSION['MailCod'];

	if(EnviarMail($MailDestino,$MailTipo,$MailNombre,$MailCod)){
		/*echo "Mail enviado";*/
	}else{
		/*echo "Mail no enviado";*/
	}

	require('definitions.php');
	require('header.php');
?>
<section>
	<div id="page-wrapper" class="sign-in-wrapper">
		<div class="graphs">
			<div class="sign-in-form">
				<div class="sign-in-form-top">
					<h1>Felicidades</h1>
				</div>
				<div class="signin">
					<p>La cuenta ha sido creada.</p>
					<p>Antes de ingresar al sitio, por politicas de seguridad, te hemos enviado un correo de activacion a la cuenta que ingresaste.</p>
					<p>Ingresa al enlace o copialo en tu navegador para poder iniciar</p>
				</div>
			</div>
		</div>
	</div>
</section>
<?php 
	require('footer.php');
	unset($_SESSION['MailDestino']);
	unset($_SESSION['MailNombre']);
	unset($_SESSION['MailCod']);
?>