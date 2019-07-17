<?php
session_start();
require('definitions.php');
//unset($_SESSION['idUsuMod']);
/*-----------------------------------------------------------------------------------------------------------*/
/* Agregar todo script, puntual para esta pagina.*/
/*-----------------------------------------------------------------------------------------------------------*/
?>

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

	<div class="col-sm-9 col-md-10">
		<br>
		<br>
		<br>
		<br>
		<center><img src="<?php echo $staticsrv; ?>/img/fondoopacidad.png"  class="img-responsive" alt="opacidad" width="620" height="460"></center>
	</div>
</div>
<?php
/*-----------------------------------------------------------------------------------------------------------*/
/* Fin contenido de esta pagina.*/
/*-----------------------------------------------------------------------------------------------------------*/
require('footer.php');
?>
