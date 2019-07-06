<?php
	session_start();
	if (isset($_GET['cod'])){
		$_SESSION['activationkey']=$_GET['cod'];
		header('Location: ../logica/procesarActivarCuenta.php');
	}

	require_once('../logica/funciones.php');
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
						<p>La cuenta ha sido activada.</p>
						<form action="../view/login.php" method="POST">
							<input type="submit" value="Entrar">
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php 
	require('footer.php');/*
	unset($_SESSION['MailDestino']);
	unset($_SESSION['MailNombre']);
	unset($_SESSION['MailCod']);*/
	?>