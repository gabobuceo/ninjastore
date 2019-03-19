<?php
session_start();
var_dump($_POST);
echo "<hr>";
var_dump($_GET);
echo "<hr>";
var_dump($_SESSION);
echo "<hr>";
var_dump($_SERVER)

?>
<?php
/*MENSAJE DEMO - Importante ID*/
if (isset($_SESSION['mobjetivo']) && $_SESSION['mobjetivo']=="micontraseña"){
	echo "<div id='mensajealerta' class='alert ".$_SESSION['mtipo']." alert-dismissable'>
	<button type='button' class='close' data-dismiss='alert'>&times;</button>".$_SESSION['mtexto']."</div>";
	unset($_SESSION['mobjetivo']);
	unset($_SESSION['mtipo']);
	unset($_SESSION['mtexto']);	
	unset($_SESSION['debugeame']);				
}
?>