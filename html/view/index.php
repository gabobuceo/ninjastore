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
<!-- ::::::::::::::  BANNER SITIO  :::::::::::::: -->
<div class="main-banner banner text-center">
	<div class="container">    
		<!--<h1>Bienvenido a   <span class="segment-heading">    Ninja Sotre </span> </h1>
		<p>Tu tienda online donde puedes COMPRAR VENDER Y PERMUTAR!!</p>
		<a href="javascript:void(0)">Vender!</a>-->
	</div>
</div>
<!-- ::::::::::::::  FIN BANNER SITIO  :::::::::::::: -->

<!-- ::::::::::::::  OFERTAS  :::::::::::::: -->
<?php
$datos_ofertas = require_once('../logica/procesarCargaOfertas.php');		
	/*var_dump($datos_ofertas);
	echo "<br><br>";*/
	$datos_publicaciones = require_once('../logica/procesarCargaPubliIndex.php');		
	/*var_dump($datos_publicaciones);
	echo "<br><br>";*/
	?>
	<div class="container superdeals-entry">
		<div class="superdeals-top">
			<h2 class="deals-logo">
				<a href="javascript:void(0)">Las Mejores Ofertas</a>
			</h2>
			<a class="view-more" href="../view/search.php?buscar=ofertas">Ver Todos</a>
		</div>
		<div class="superdeals-slider currentBox active">
			<div class="trend-ads">
				<?php
				if (isset($datos_ofertas['this'])) {
					echo "No hay ofertas";
				}else{
					?>	
					<ul id="flexiselDemo3">
						<?php
						$j=0;
						for ($i=0; $i < count($datos_ofertas); $i++) { 
							if ($j==0) {
								echo "<li>";
							}else if ($j==3) {
								echo "</li><li>";
								$j=0;
							}
							$j++;
							?>
							<div class="col-md-3 biseller-column">
								<a href="publication.php?id=<?php echo $datos_ofertas[$i]['ID']; ?>">
									<img src="../imagenes/<?php echo $datos_ofertas[$i]['IMGDEFAULT']; ?>_tn.<?php echo $_SESSION['EXT']; ?>" onerror="this.onerror=null;this.src='../static/img/noimage_tn.<?php echo $_SESSION['EXT']; ?>';"/>
									<span class="price">&#36; <?php echo $datos_ofertas[$i]['PRECIO']; ?></span>
								</a> 
								<div class="ad-info">
									<h5><?php echo $datos_ofertas[$i]['TITULO']; ?></h5>
									<span><?php echo date("d/m/Y H:i", strtotime($datos_ofertas[$i]['FECHA'])); ?></span>
								</div>
							</div>
							<?php
						}
						?>
					</li>
				</ul>
				<script type="text/javascript">
					$(window).load(function() {
						$("#flexiselDemo3").flexisel({
							visibleItems:1,
							animationSpeed: 1000,
							autoPlay: true,
							autoPlaySpeed: 5000,    		
							pauseOnHover: true,
							enableResponsiveBreakpoints: true,
							responsiveBreakpoints: { 
								portrait: { 
									changePoint:480,
									visibleItems:1
								}, 
								landscape: { 
									changePoint:640,
									visibleItems:1
								},
								tablet: { 
									changePoint:768,
									visibleItems:1
								}
							}
						});

					});
				</script>
				<?php
			}
			?>
		</div>
	</div>
</div>
<!-- ::::::::::::::  FIN OFERTAS  :::::::::::::: -->

<!-- ::::::::::::::  PUBLICACIONES VARIAS  :::::::::::::: -->
<div class="container superdeals-entry">
	<div class="superdeals-top">
		<h2 class="deals-logo">
			<a href="javascript:void(0)">Algunas de las publicaciones</a>
		</h2>
		<a class="view-more" href="../view/search.php">Ver Todas</a>
	</div>
	<div class="superdeals-slider currentBox active">
		<div class="trend-ads">
			<?php
			if (!isset($datos_publicaciones['this'])) {
				for ($i=0; $i < count($datos_publicaciones); $i++) { 
					?>
					<div class="col-md-3 biseller-column">
						<a href="publication.php?id=<?php echo $datos_publicaciones[$i]['ID']; ?>">
							<img src="../imagenes/<?php echo $datos_publicaciones[$i]['IMGDEFAULT']; ?>_tn.<?php echo $_SESSION['EXT']; ?>" onerror="this.onerror=null;this.src='../static/img/noimage_tn.<?php echo $_SESSION['EXT']; ?>';"/>
							<span class="price">&#36; <?php echo $datos_publicaciones[$i]['PRECIO']; ?></span>
						</a> 
						<div class="ad-info">
							<h5><?php echo $datos_publicaciones[$i]['TITULO']; ?></h5>
							<span><?php echo date("d/m/Y H:i", strtotime($datos_publicaciones[$i]['FECHA'])); ?></span>
						</div>
					</div>
					<?php
				}
			}
			?>
		</div>
	</div>
</div>
<!-- ::::::::::::::  FIN PUBLICACIONES VARIAS  :::::::::::::: -->

<!-- ::::::::::::::  CATEGORIAS PRINCIPALES :::::::::::::: -->
<div class="container superdeals-entry">
	<div class="superdeals-top">
		<h2 class="deals-logo">
			<a href="javascript:void(0)">Categorias</a>
		</h2>
		<a class="view-more" href="../view/categories.php">Ver Todas</a>
	</div>
	<div class="superdeals-slider currentBox active">
		<?php
		$a=cargarCategoriasPadres();
		$b=count($a);
		for ($i=0; $i < $b; $i++) { 
			?>
			<div class="categorias">
				<ul>
					<a href="javascript:void(0)"><lh><?php echo utf8_encode($a[$i]['TITULO']) ?></lh></a>
					<?php
					$c=cargarCategoriasHijos($a[$i]['ID']);
					$d=count($c);
					if ($d>5){
						$d=5;
					}
					for ($j=0; $j < $d; $j++) { 
						?>
						<a href="../view/search.php?categoria=<?php echo $c[$j]['ID'] ?>"><li><?php echo utf8_encode($c[$j]['TITULO']) ?> (<?php 
							if (is_null($c[$j]['CANTIDAD'])) {
								echo "0";
							}else{
								echo ($c[$j]['CANTIDAD']); 
							} 
							?>)</li>
						</a>
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
