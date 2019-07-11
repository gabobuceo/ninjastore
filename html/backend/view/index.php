<?php
session_start();
require('definitions.php');
/*-----------------------------------------------------------------------------------------------------------*/
/* Agregar todo script, puntual para esta pagina.*/
/*-----------------------------------------------------------------------------------------------------------*/
?>
<link rel='stylesheet' href='../../static/css/jquery.dataTables.min.css'>
<link rel='stylesheet' href='../../static/css/marcaagua.css'>
<script type="text/javascript" src="../../static/js/canvasjs.min.js"></script>

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
		<br>
			<center> <img src="../../static/img/fondoopacidad.png" alt="Paris" class="imageness">
		</div>
		</body>

	
<?php
/*-----------------------------------------------------------------------------------------------------------*/
/* Fin contenido de esta pagina.*/
/*-----------------------------------------------------------------------------------------------------------*/
require('footer.php');
?>
