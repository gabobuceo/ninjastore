<?php 
require('definitions.php');
/*-----------------------------------------------------------------------------------------------------------*/
/* Agregar todo script, puntual para esta pagina.*/
/*-----------------------------------------------------------------------------------------------------------*/
?>

<?php 
/*-----------------------------------------------------------------------------------------------------------*/
/* Fin scripts de esta pagina.*/
require('header.php');
/*-----------------------------------------------------------------------------------------------------------*/
/* Agregar todo el contenido de esta pagina aqui.*/
/*-----------------------------------------------------------------------------------------------------------*/
?>
<!-- ::::::::::::::  404  :::::::::::::: -->
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="error-template">
				<h1>Oops!</h1><h2>Error 404!!!</h2>
				<div class="error-details">
					<p>La pagina que quiere acceder no pudo ser encontrada, puede enviarnos un mensajo apretando <a href='javascript:void(0)'>aqui</a> o intentar luego más tarde</p>
				</div>
				<img class="img-responsive error-image" src='../static/img/404.gif' />
				<div class="error-actions">
					<div class="container">
						<a href='javascript:void(0)' class="btn btn-primary btn-lg"><span class="fa fa-home"></span>
						Volver al inicio </a>
						<a href='javascript:history.back(1)' class="btn btn-default btn-lg"><span class="fa fa-arrow-left"></span> 
						Volver atrás </a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- ::::::::::::::  FIN 404  :::::::::::::: -->
<?php 
/*-----------------------------------------------------------------------------------------------------------*/
/* Fin contenido de esta pagina.*/
/*-----------------------------------------------------------------------------------------------------------*/
require('footer.php');
?>