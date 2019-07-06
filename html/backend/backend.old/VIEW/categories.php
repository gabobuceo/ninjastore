<?php 
session_start();
require('definitions.php');
/*-----------------------------------------------------------------------------------------------------------*/
/* Agregar todo script, puntual para esta pagina.*/
/*-----------------------------------------------------------------------------------------------------------*/
?>
<link rel="stylesheet" href="../static/css/flexslider.css" type="text/css" media="screen" />
<script type="text/javascript" src="../static/js/jquery.flexisel.js"></script>
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
<div class="row"  style="width: 100% !important ;">
	<div class="col-sm-12 col-md-12">
		<div class="container superdeals-entry" style="width: 100% !important ;">
			<div class="superdeals-top">
				<h2 class="deals-logo">
					<a href="javascript:void(0)">Breadcums</a>
				</h2>
			</div>
			<div class="superdeals-slider currentBox active">
				<?php
				require('breadcrumb.php');
				?>
			</div>
		</div>
	</div>
</div>
<!-- ::::::::::::::  CATEGORIAS PRINCIPALES :::::::::::::: -->
<div class="container superdeals-entry">
	<div class="superdeals-top">
		<h2 class="deals-logo">
			<a href="javascript:void(0)">Categorias</a>
		</h2>
		<!--<a class="view-more" href="javascript:void(0)">Ver Todas</a>-->
	</div>
	<div class="superdeals-slider currentBox active">
		<?php
		$a=cargarCategoriasPadres();
		$b=count($a);
		for ($i=0; $i < $b; $i++) { 
			?>
			<div class="categorias">
				<ul>
					<a href="javascript:void(0)"><lh><?php echo $a[$i]['TITULO'] ?></lh></a>
					<?php
					$c=cargarCategoriasHijos($a[$i]['ID']);
					$d=count($c);
					for ($j=0; $j < $d; $j++) { 
						?>
						<a href="../view/search.php?categoria=<?php echo $c[$j]['ID'] ?>"><li><?php echo $c[$j]['TITULO'] ?></li></a>
						<?php
					}
					echo "</ul>
					</div>";	
				}
				?>
			</div>
		</div>
		<!-- ::::::::::::::  FIN PUBLICACIONES VARIAS  :::::::::::::: -->

		<?php 
		/*-----------------------------------------------------------------------------------------------------------*/
		/* Fin contenido de esta pagina.*/
		/*-----------------------------------------------------------------------------------------------------------*/
		require('footer.php');
		?>
