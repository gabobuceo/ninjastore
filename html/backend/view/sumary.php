<?php
session_start();
require('definitions.php');
unset($_SESSION['idUsuMod']);
/*-----------------------------------------------------------------------------------------------------------*/
/* Agregar todo script, puntual para esta pagina.*/
/*-----------------------------------------------------------------------------------------------------------*/
?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<link rel='stylesheet' href='../../static/css/jquery.dataTables.min.css'>
<link rel='stylesheet' href='../../static/css/marcaagua.css'>
<script type="text/javascript" src="../../static/js/canvasjs.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="css/custom.css">
<?php
/*-----------------------------------------------------------------------------------------------------------*/
/* Fin scripts de esta pagina.*/
/*-----------------------------------------------------------------------------------------------------------*/
/* Agregar todo control, puntual para esta pagina (Como la sesion).<div class="row affix-row">

	<div class="col-xs-6 col-sm-2">*/
/*-----------------------------------------------------------------------------------------------------------*/
require('header.php');
/*-----------------------------------------------------------------------------------------------------------*/
/* Agregar todo el contenido de esta pagina aqui.*/
/*-------------------------//col-xs-6 col-sm-3-----------col-sm-3 col-md-2 affix-sidebar----------------------------------------------------------------------*/
?>

		<div class="row affix-row">
	<div class="col-sm-3 col-md-2 affix-sidebar">
		<?php
		$_SESSION['menu']=1;
		require('menu.php');
		unset($_SESSION['menu']);
		?>
	</div>

	<body>
		<br>
		<br>
		<br>
		<br>
			<center><img src="../../backend/static/img/fondoopacidad.png"  class="img-responsive" alt="opacidad" width="620" height="460"></center>
	</body>
</div>
<?php
/*-----------------------------------------------------------------------------------------------------------*/
/* Fin contenido de esta pagina.*/
/*-----------------------------------------------------------------------------------------------------------*/
require('footer.php');
?>
