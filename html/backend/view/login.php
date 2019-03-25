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
/*-----------------------------------------------------------------------------------------------------------*/
/* Agregar todo control, puntual para esta pagina (Como la sesion).*/
/*-----------------------------------------------------------------------------------------------------------*/
if (isset($_SESSION['USERNAME'])){
	header("Location: index.php");
}
if (isset($_POST) and !empty($_POST)){
	/*$sender_name = stripslashes($_POST["sender_name"]);
	$sender_email = stripslashes($_POST["sender_email"]);
	$sender_message = stripslashes($_POST["sender_message"]);*/
	$response = $_POST["g-recaptcha-response"];
	$url = 'https://www.google.com/recaptcha/api/siteverify';
	$data = array(
		'secret' => '6LdtADUUAAAAALtcAR75IR2sJxLfpvbb1M0yoAZb',
		'response' => $_POST["g-recaptcha-response"]
	);
	$options = array(
		'http' => array (
			'method' => 'POST',
			'content' => http_build_query($data)
		)
	);
	$context  = stream_context_create($options);
	$verify = file_get_contents($url, false, $context);
	$captcha_success=json_decode($verify);
	if ($captcha_success->success==false) {
		$errmess=1;

	} else if ($captcha_success->success==true) {
		$_SESSION['USERNAME']=$_POST['user'];
		$_SESSION['PASSWORD']=$_POST['pass'];
		header("Location: index.php");
		exit();
	}
}
require('header.php');
/*-----------------------------------------------------------------------------------------------------------*/
/* Agregar todo el contenido de esta pagina aqui.*/
/*-----------------------------------------------------------------------------------------------------------*/
?>
<!-- ::::::::::::::  LOGIN  :::::::::::::: -->
<section>
	<div id="page-wrapper" class="sign-in-wrapper">
		<div class="graphs">
			<?php
			if ((isset($errmess)) and ($errmess>0)){
				echo errmessages($errmess);
			}
			?>
			<div class="sign-in-form">
				<div class="sign-in-form-top">
					<h1>Iniciar Sesion</h1>
				</div>
				<div class="signin">
					<?php
					if (isset($_SESSION['mobjetivo']) && $_SESSION['mobjetivo']=="login.php"){
						/*debugconsola($_SESSION['debugeame']);
						debugconsola($_SESSION['mobjetivo']);*/
						echo "<div class='alert ".$_SESSION['mtipo']." alert-dismissable'>
						<button type='button' class='close' data-dismiss='alert'>&times;</button>".$_SESSION['mtexto']."</div>";
						unset($_SESSION['mobjetivo']);
						unset($_SESSION['mtipo']);
						unset($_SESSION['mtexto']);
						unset($_SESSION['debugeame']);
					}
					?>
					<form action="../logica/procesarLogin.php" method="POST">
						<div class="log-input">
							<div class="log-input-left">
								<input type="text" name="usuario" class="user" placeholder="Usuario" />
							</div>
							<div class="clearfix"> </div>
						</div>
						<div class="log-input">
							<div class="log-input-left">
								<input type="password" name="password" class="lock" placeholder="Contraseña" />
							</div>
							<div class="clearfix"> </div>
						</div>
						<div class="captchaweapper">
							<div class="g-recaptcha" data-sitekey="6LdtADUUAAAAAEWxW3NrYhsHPteqlpiezGNGwWS-"></div>
						</div>
						<input type="submit" value="Acceder">
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
