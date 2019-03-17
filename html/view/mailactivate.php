<?php 
session_start();
if (isset($_SESSION['USERNAME'])){
	header("Location: index.php");
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
/*-----------------------------------------------------------------------------------------------------------*/
/* Agregar todo control, puntual para esta pagina (Como la sesion).*/
/*-----------------------------------------------------------------------------------------------------------*/
require('header.php');
/*-----------------------------------------------------------------------------------------------------------*/
/* Agregar todo el contenido de esta pagina aqui.*/
/*-----------------------------------------------------------------------------------------------------------*/
?>
<!-- ::::::::::::::  LOGIN  :::::::::::::: -->
<section>
	<div id="page-wrapper" class="sign-in-wrapper">
		<div class="graphs">
			<div class="sign-in-form">
				<div class="sign-in-form-top">
					<h1>Activar Cuenta</h1>
				</div>
				<div class="signin">
					<?php
					if (isset($_SESSION['mobjetivo']) && $_SESSION['mobjetivo']=="mailactivate.php"){
						echo "<div class='alert ".$_SESSION['mtipo']." alert-dismissable'>
						<button type='button' class='close' data-dismiss='alert'>&times;</button>".$_SESSION['mtexto']."</div>";
						unset($_SESSION['mobjetivo']);
						unset($_SESSION['mtipo']);
						unset($_SESSION['mtexto']);	
					}
					?>
					<form action="../logica/procesarActivarUsuario.php" method="POST">
						<div class="log-input">
							<div class="log-input-left">
								Ingrese su usuario
								<input type="text" name="usuario" class="user" placeholder="Usuario" />
							</div>
							<div class="clearfix"> </div>
						</div>
						<div class="log-input">
							<div class="log-input-left">
								Ingrese el codigo enviado por mail
								<input type="text" name="codigo" class="user" placeholder="codigo" <?php 
								if (isset($_SESSION['activationkey'])){ 
									echo "value='".$_SESSION['activationkey']."'";
								} 
								?> 
								/>
							</div>
							<div class="clearfix"> </div>
						</div>
						<div class="captchaweapper">
							<div class="g-recaptcha" data-sitekey="6LdtADUUAAAAAEWxW3NrYhsHPteqlpiezGNGwWS-"></div>
						</div>
						<input type="submit" value="Activar">
					</form>	 
				</div>
			</div>
		</div>
	</div>
</section>
<!-- ::::::::::::::  FIN LOGIN  :::::::::::::: -->
<?php 
/*-----------------------------------------------------------------------------------------------------------*/
/* Fin contenido de esta pagina.*/
/*-----------------------------------------------------------------------------------------------------------*/
require('footer.php');
?>