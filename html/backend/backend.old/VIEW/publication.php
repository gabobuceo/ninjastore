<?php 
require('definitions.php');
/*-----------------------------------------------------------------------------------------------------------*/
/* Agregar todo script, puntual para esta pagina.*/
/*-----------------------------------------------------------------------------------------------------------*/
?>
<link rel="stylesheet" href="../static/css/flexslider.css" type="text/css" media="screen" />

<script type="text/javascript" src="../static/js/jquery.flexslider.js"></script>
<script type="text/javascript" src="../static/js/jquery.flexisel.js"></script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$(".select2-myitems").select2({
			width: 'resolve'
		});
		$(".select2-otheritems").select2({
			width: 'resolve'
		});
	});	
</script>

<link rel='stylesheet' href='../static/css/dataTables.bootstrap.min.css'>
<script type="text/javascript" src="../static/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../static/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#listopen').DataTable();
	} );
</script>
<script src="../static/EasyZoom/dist/easyzoom.js"></script>

<link rel="stylesheet" href="../static/EasyZoom/css/easyzoom.css" />
<style>
.thumbnails {
	overflow: hidden;
	margin: 1em 0;
	padding: 0;
}

.thumbnails li {
	display: inline-block;
	width: 50px;
	margin: 0 5px;
}

.thumbnails img {
	display: block;
	min-width: 100%;
	max-width: 100%;
}
</style>
<?php 
/*-----------------------------------------------------------------------------------------------------------*/
/* Fin scripts de esta pagina.*/
require('header.php');
/*-----------------------------------------------------------------------------------------------------------*/
/* Agregar todo el contenido de esta pagina aqui.*/
/*-----------------------------------------------------------------------------------------------------------*/
?>
<!-- ::::::::::::::  PUBLICATION  :::::::::::::: -->
<section>
	<?php
	if (isset($_GET['id'])) {
		$_SESSION['PubID']=$_GET['id'];
		//añadir visita
		require_once('../logica/procesarVistoPublicacion.php');		
		/*var_dump($_SESSION);
		echo "<br><br>";*/
		$datos_publicacion = require_once('../logica/procesarCargaPublicacion.php');		
		/*var_dump($datos_publicacion);
		echo "<br><br>";*/
		$datos_publicacionfecha = require_once('../logica/procesarCargaPublicacionFecha.php');		
		/*var_dump($datos_publicacionfecha);
		echo "<br><br>";*/
		$datos_publicacionimg = require_once('../logica/procesarCargaPublicacionImg.php');		
		/*var_dump($datos_publicacionimg);
		echo "<br><br>";*/
		$datos_producto = require_once('../logica/procesarCompraPublicacion.php');
		/*var_dump($datos_producto);
		echo "<br><br>";*/
		$datos_vendedor = require_once('../logica/procesarDatosVendedor.php');
		/*var_dump($datos_vendedor);
		echo "<br><br>";*/
		$datos_preguntas = require_once('../logica/procesarCargaPreguntas.php');
		/*var_dump($datos_preguntas);
		echo "<br><br>";*/
		$_SESSION['CatID']=$datos_publicacion[0]['IDCATEGORIA'];
		$datos_categoria = require_once('../logica/procesarCargaCategoria.php');
		/*var_dump($datos_categoria);
		echo "<br><br>";*/
		$datos_masproductosvendedor = require_once ('../logica/procesarCargaProductosVendedor.php');
		/*var_dump($datos_masproductosvendedor);
		echo "<br><br>";*/
		$datos_productossimilares = require_once ('../logica/procesarCargaProductosSimilares.php');
		/*var_dump($datos_productossimilares);
		echo "<br><br>";*/

		obtenerFechaSistema();
		?>
		<div class="single-page main-grid-border">
			<div class="container">
				<?php 
				/*-----------------------------------------------------------------------------------------------------------*/
				/* Zona de categorias.*/
				require('breadcrumb.php');
				/*-----------------------------------------------------------------------------------------------------------*/
				/* Fin zona Categorias.*/
				/*-----------------------------------------------------------------------------------------------------------*/
				?>
				<div class="product-desc">
					<div class="col-md-7 product-view">
						<h2><?php echo $datos_publicacion['0']['TITULO']; ?></h2>
						<p><i class="fa fa-flag" aria-hidden="true"></i><a href="report.php?id=<?php echo $datos_publicacion['0']['ID']; ?>">denunciar publicacion</a>| creado el <?php echo date("d/m/Y", strtotime($datos_publicacionfecha['0']['FECHA'])); ?> a las <?php echo date("H:m", strtotime($datos_publicacionfecha['0']['FECHA'])); ?>, Publicacion: <?php echo $datos_publicacion['0']['ID']; ?></p>
						<div class="easyzoom easyzoom--overlay easyzoom--with-thumbnails">
							<?php
							if (count($datos_publicacionimg)>1){
								$thum=1;
								$start=0;
							}else{
								$thum=0;
								$start=0;
							}
							for ($i=0; $i < count($datos_publicacionimg); $i++) { 
								if ($start==0){
									echo "
									<a href='../imagenes/".$datos_publicacionimg[$i]['IMAGENES'].".webp'>
									<img src='../imagenes/".$datos_publicacionimg[$i]['IMAGENES']."_di.webp' />
									</a>
									</div>
									<ul class='thumbnails'>
									<li>
									<a href='../imagenes/".$datos_publicacionimg[$i]['IMAGENES'].".webp' data-standard='../imagenes/".$datos_publicacionimg[$i]['IMAGENES']."_di.webp'>
									<img src='../imagenes/".$datos_publicacionimg[$i]['IMAGENES']."_tn.webp' />
									</a>
									</li>";
									$start=1;
								}else{
									if ($start==1){
										echo "
										<li>
										<a href='../imagenes/".$datos_publicacionimg[$i]['IMAGENES'].".webp' data-standard='../imagenes/".$datos_publicacionimg[$i]['IMAGENES']."_di.webp'>
										<img src='../imagenes/".$datos_publicacionimg[$i]['IMAGENES']."_tn.webp' />
										</a>
										</li>";
									}			
								}
							}
							echo "</ul>";
							?>
							<div class="product-details">
								<?php echo htmlspecialchars_decode($datos_publicacion['0']['DESCRIPCION'], ENT_NOQUOTES); ?>
							</div>
						</div>
						<div class="col-md-5 product-details-grid">
							<div class="item-price">
								<div class="product-price">
									<p class="p-price">Precio</p>
									<h4 class="rate">$U <?php echo $datos_publicacion['0']['PRECIO']; ?></h4>
									<div class="clearfix"></div>
								</div>
								<div class="condition">
									<p class="p-price">Estado</p>
									<h4><?php echo $datos_publicacion['0']['ESTADOA']; ?></h4>
									<div class="clearfix"></div>
								</div>
								<div class="itemtype">
									<p class="p-price">Unidades</p>
									<h4><?php echo $datos_publicacion['0']['CANTIDAD']; ?></h4>
									<div class="clearfix"></div>
								</div>
							</div>
							<div class="interested text-center">
								<h4>Lo quieres?</h4>
								<?php
								echo "<img src='../imagenes/".$datos_publicacion['0']['IMGDEFAULT']."_tn.webp' /><br />";
								if ((isset($_SESSION['id'])) AND ($_SESSION['id']!=$datos_vendedor['0']['ID']) AND (isset($_GET['perm']))) {
							//es permuta
									?>
									<div class="buy-in-form">
										<input type="submit" value="Comprar" data-toggle="modal" data-target="#product_view">
										<input type="submit" value="Permutar" data-toggle="modal" data-target="#exchange_view">
									</div>
									<?php
								}else{
							//no se admite permuta
									?>
									<div class="buy-in-form">
										<input type="submit" value="LO QUIERO!" data-toggle="modal" data-target="#product_view">
									</div>
									<?php
								}
								?>
							</div>
							<div class="tips">
								<div class="row">
									<div class="col-xs-12">
										<h4>Producto</h4><br />
									</div>
								</div>
								<div class="row">
									<div class="col-xs-4">
										<p>
											<b>Vistas</b><br />
											<?php echo $datos_publicacion['0']['VISTO']; ?>
										</p>
									</div>
									<div class="col-xs-4">
										<p>
											<b>Vendidos</b><br />
											<?php 
											if ($datos_producto['0']['VENTAS']=="") {
												echo "0";
											}else{
												echo $datos_producto['0']['VENTAS']; 
											}
											?>
										</p>
									</div>
									<div class="col-xs-4">
										<p>
											<b>Preguntas</b><br />
											<?php 
											if ($datos_producto['0']['PREGUNTAS']=="") {
												echo "0";
											}else{
												echo $datos_producto['0']['PREGUNTAS']; 
											}
											?>
										</p>
									</div>
								</div>
							</div>
							<div class="tips">
								<div class="row">
									<div class="col-xs-6">
										<h4>Vendedor</h4><br />
									</div>
									<div class="col-xs-6">
										<p>
											<b>Gabriel Fernandez</b><br />
											<?php
											for ($i=0; $i < 5; $i++) { 
												if ($i<$datos_vendedor['0']['NOTA']) {
													echo "<i class='fa fa-star' aria-hidden='true'></i>";
												}else{
													echo "<i class='fa fa-star-o' aria-hidden='true'></i>";
												}
											}
											?>
										</p>
									</div>
								</div>
								<div class="row">
									<div class="col-xs-4">
										<p>
											<b>Publicaciones</b><br />
											<?php echo $datos_vendedor['0']['PUBLICACIONES']; ?>
										</p>
									</div>
									<div class="col-xs-4">
										<p>
											<b>Ventas</b><br />
											<?php echo $datos_vendedor['0']['VENTAS']; ?>
										</p>
									</div>
									<div class="col-xs-4">
										<p>
											<b>Calificaciones</b><br />
											<?php echo $datos_vendedor['0']['CALIFICACION']; ?>
										</p>
									</div>
								</div>
							</div>

						</div>
						<div class="col-md-12 product-mesages">
							<h2>Preguntas</h2>
							<div class="chat_window">
								<?php
								if (!isset($datos_preguntas['this'])) {
									?>
									<ul class="messages">
										<?php
										for ($i=0; $i < count($datos_preguntas); $i++) { 
											?>
											<li class="message left appeared">
												<div class="text_wrapper">
													<div class="text"><?php echo $datos_preguntas[$i]['MENSAJE']; ?></div>
													<p><i class="fa fa-flag" aria-hidden="true"></i><a href="report.php?id=<?php echo $datos_preguntas[$i]['ID']; ?>"> denunciar </a>| creado el <?php echo $datos_preguntas[$i]['FECHAM']; ?>, Pregunta: <?php echo $datos_preguntas[$i]['ID']; ?></p>
												</div>
											</li>
											<?php
											if (!empty($datos_preguntas[$i]['RESPUESTA'])) {
												?>
												<li class="message right appeared">
													<div class="text_wrapper">
														<div class="text"><?php echo $datos_preguntas[$i]['RESPUESTA']; ?></div>
														<p><i class="fa fa-flag" aria-hidden="true"></i><a href="report.php?id=<?php echo $datos_preguntas[$i]['ID']; ?>"> denunciar </a>| creado el <?php echo $datos_preguntas[$i]['FECHAR']; ?>, Pregunta: <?php echo $datos_preguntas[$i]['ID']; ?></p>
													</div>
												</li>
												<?php
											}
											?>
											<?php
										}
										?>
									</ul>
									<?php
								}
								if ((!isset($_SESSION['id'])) OR ($_SESSION['id']!=$datos_vendedor['0']['ID'])) {
									?>
									<div class="bottom_wrapper clearfix">
										<form name="hola" action="../logica/procesarAltaPregunta.php?idpublicacion=<?php echo $datos_publicacion['0']['ID']; ?>" method="POST">
											<div class="message_input_wrapper">
												<input name="pregunta" class="message_input" placeholder="Pregunta algo..." />
											</div>
											<div class="send_message">
												<div class="icon">
												</div>
												<div class="text" onclick="hola.submit()">
												Preguntar</div>
											</div>
										</form>
										<?php
										if (isset($_SESSION['mobjetivo']) && $_SESSION['mobjetivo']=="publication.php"){
											echo "<div name='popup' class='alert ".$_SESSION['mtipo']." alert-dismissable'>
											<button type='button' class='close' data-dismiss='alert'>&times;</button>".$_SESSION['mtexto']."</div>";
											unset($_SESSION['mobjetivo']);
											unset($_SESSION['mtipo']);
											unset($_SESSION['mtexto']);	
											unset($_SESSION['debugeame']);				
										}
										?>
									</div>
									<?php
								}
								?>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
				<div class="container superdeals-entry">
					<div class="superdeals-top">
						<h2 class="deals-logo">
							<a href="javascript:void(0)">Mas productos del vendedor</a>
						</h2>
						<a class="view-more" href="javascript:void(0)">Ver Todos</a>
					</div>
					<div class="superdeals-slider currentBox active">
						<div class="trend-ads">
							<?php
							if (isset($datos_masproductosvendedor['this'])) {
								echo "No hay ofertas";
							}else{
								?>	
								<ul id="flexiselDemo3">
									<?php
									$j=0;
									for ($i=0; $i < count($datos_masproductosvendedor); $i++) { 
										if ($j==0) {
											echo "<li>";
										}else if ($j==4) {
											echo "</li><li>";
											$j=0;
										}
										$j++;
										?>
										<div class="col-md-3 biseller-column">
											<a href="publication.php?id=<?php echo $datos_masproductosvendedor[$i]['ID']; ?>">
												<img src="../imagenes/<?php echo $datos_masproductosvendedor[$i]['IMGDEFAULT']; ?>_tn.<?php echo $_SESSION['EXT']; ?>" onerror="this.onerror=null;this.src='../static/img/noimage_tn.<?php echo $_SESSION['EXT']; ?>';"/>
												<span class="price">&#36; <?php echo $datos_masproductosvendedor[$i]['PRECIO']; ?></span>
											</a> 
											<div class="ad-info">
												<h5><?php echo $datos_masproductosvendedor[$i]['TITULO']; ?></h5>
												<span><?php echo $datos_masproductosvendedor[$i]['FECHA']; ?></span>
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
			<div class="container superdeals-entry">
				<div class="superdeals-top">
					<h2 class="deals-logo">
						<a href="javascript:void(0)">Otros productos similares</a>
					</h2>
					<a class="view-more" href="javascript:void(0)">Ver Todos</a>
				</div>
				<div class="superdeals-slider currentBox active">
					<div class="trend-ads">
						<?php
						if (isset($datos_productossimilares['this'])) {
							echo "No hay ofertas";
						}else{
							?>	
							<ul id="flexiselDemo2">
								<?php
								$j=0;
								for ($i=0; $i < count($datos_productossimilares); $i++) { 
									if ($j==0) {
										echo "<li>";
									}else if ($j==4) {
										echo "</li><li>";
										$j=0;
									}
									$j++;
									?>
									<div class="col-md-3 biseller-column">
										<a href="publication.php?id=<?php echo $datos_productossimilares[$i]['ID']; ?>">
											<img src="../imagenes/<?php echo $datos_productossimilares[$i]['IMGDEFAULT']; ?>_tn.<?php echo $_SESSION['EXT']; ?>" onerror="this.onerror=null;this.src='../static/img/noimage_tn.<?php echo $_SESSION['EXT']; ?>';"/>
											<span class="price">&#36; <?php echo $datos_productossimilares[$i]['PRECIO']; ?></span>
										</a> 
										<div class="ad-info">
											<h5><?php echo $datos_productossimilares[$i]['TITULO']; ?></h5>
											<span><?php echo $datos_productossimilares[$i]['FECHA']; ?></span>
										</div>
									</div>
									<?php
								}
								?>
							</li>
						</ul>
						<script type="text/javascript">
							$(window).load(function() {
								$("#flexiselDemo2").flexisel({
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
	</div>
	<?php
}else{
	?>
	<div class="single-page main-grid-border">
		<div class="container">
			<?php 
			/*-----------------------------------------------------------------------------------------------------------*/
			/* Zona de categorias.*/
			require('breadcrumb.php');
			/*-----------------------------------------------------------------------------------------------------------*/
			/* Fin zona Categorias.*/
			/*-----------------------------------------------------------------------------------------------------------*/
			?>
			<div class="product-desc">
				<div class="col-md-7 product-view">
					<h2>Titulo de prueba de un producto test</h2>
					<p><i class="fa fa-flag" aria-hidden="true"></i><a href="javascript:void(0)">denunciar publicacion</a>| creado el 19/10/2017 a las 06:55 pm, Publicacion: 987654321</p>
					<div class="flexslider">
						<ul class="slides">
							<li data-thumb="images/ss1.jpg">
								<img src="images/ss1.jpg" />
							</li>
							<li data-thumb="images/ss2.jpg">
								<img src="images/ss2.jpg" />
							</li>
							<li data-thumb="images/ss3.jpg">
								<img src="images/ss3.jpg" />
							</li>
							<li data-thumb="images/ss2.jpg">
								<img src="images/ss2.jpg" />
							</li>
							<li data-thumb="images/ss3.jpg">
								<img src="images/ss3.jpg" />
							</li>
						</ul>
					</div>
					<script type="text/javascript">
						$(window).load(function() {
							$('.flexslider').flexslider({
								animation: "slide",
								controlNav: "thumbnails"
							});
						});
					</script>
					<div class="product-details">
						<h4>Se vende: Celular Samsung Galaxy Note II</h4>
						<p><strong>Display</strong>: 1.5 pugadas HD LCD Touch Screen</p>
						<p><strong>Resumen</strong>: Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla .</p>
					</div>
				</div>
				<div class="col-md-5 product-details-grid">
					<div class="item-price">
						<div class="product-price">
							<p class="p-price">Precio</p>
							<h4 class="rate">$U 259</h4>
							<div class="clearfix"></div>
						</div>
						<div class="condition">
							<p class="p-price">Estado</p>
							<h4>Nuevo</h4>
							<div class="clearfix"></div>
						</div>
						<div class="itemtype">
							<p class="p-price">Unidades</p>
							<h4>8</h4>
							<div class="clearfix"></div>
						</div>
					</div>
					<div class="interested text-center">
						<h4>Lo quieres?</h4><br />
						<?php
						if (isset($_GET['perm'])) {
							//es permuta
							?>
							<div class="buy-in-form">
								<input type="submit" value="Comprar" data-toggle="modal" data-target="#product_view">
								<input type="submit" value="Permutar" data-toggle="modal" data-target="#exchange_view">
							</div>
							<?php
						}else{
							//no se admite permuta
							?>
							<div class="buy-in-form">
								<input type="submit" value="LO QUIERO!" data-toggle="modal" data-target="#product_view">
							</div>
							<?php
						}
						?>
					</div>
					<div class="tips">
						<div class="row">
							<div class="col-xs-6">
								<h4>Vendedor</h4><br />
							</div>
							<div class="col-xs-6">
								<p>
									<b>Gabriel Fernandez</b><br />
									<i class="fa fa-star" aria-hidden="true"></i>
									<i class="fa fa-star" aria-hidden="true"></i>
									<i class="fa fa-star" aria-hidden="true"></i>
									<i class="fa fa-star-half-o" aria-hidden="true"></i>
									<i class="fa fa-star-o" aria-hidden="true"></i>
								</p>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-4">
								<p>
									<b>Publicaciones</b><br />
									1
								</p>
							</div>
							<div class="col-xs-4">
								<p>
									<b>Ventas</b><br />
									2
								</p>
							</div>
							<div class="col-xs-4">
								<p>
									<b>Calificaciones</b><br />
									3
								</p>
							</div>
						</div>
					</div>
					<div class="tips">
						<div class="row">
							<div class="col-xs-12">
								<h4>Producto</h4><br />
							</div>
						</div>
						<div class="row">
							<div class="col-xs-4">
								<p>
									<b>Vistas</b><br />
									1
								</p>
							</div>
							<div class="col-xs-4">
								<p>
									<b>Vendidos</b><br />
									2
								</p>
							</div>
							<div class="col-xs-4">
								<p>
									<b>Preguntas</b><br />
									3
								</p>
							</div>
						</div>
					</div>
					<div class="tips">
						<div class="row">
							<div class="col-xs-12">
								<h4>Calificaciones</h4><br />
							</div>
						</div>
						<div class="row">
							<div class="col-xs-3">
								<p>
									<b>Positivas</b><br />
									1
								</p>
							</div>
							<div class="col-xs-3">
								<p>
									<b>Negativas</b><br />
									2
								</p>
							</div>
							<div class="col-xs-3">
								<p>
									<b>Neutras</b><br />
									3
								</p>
							</div>
							<div class="col-xs-3">
								<p>
									<b>Sin Calificar</b><br />
									4
								</p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12 product-mesages">
					<h2>Preguntas</h2>
					<div class="chat_window">
						<ul class="messages">
							<li class="message left appeared">
								<div class="text_wrapper">
									<div class="text">
									Buenas tengo unas heladeras para ofrecer</div>
									<p><i class="fa fa-flag" aria-hidden="true"></i><a href="javascript:void(0)"> denunciar </a>| creado el 26/10/2017 a las 18:55 pm, Pregunta: 4584134</p>
								</div>
							</li>
							<li class="message right appeared">
								<div class="text_wrapper">
									<div class="text">
									Buenos dias, lamentablemente solo busco la plata. Gracias</div>
									<p><i class="fa fa-flag" aria-hidden="true"></i><a href="javascript:void(0)"> denunciar </a>| creado el 26/10/2017 a las 19:0 pm, Respuesta: 4584134</p>
								</div>
							</li>
						</ul>
						<div class="bottom_wrapper clearfix">
							<div class="message_input_wrapper">
								<input class="message_input" placeholder="Pregunta algo..." />
							</div>
							<div class="send_message">
								<div class="icon">
								</div>
								<div class="text">
								Enviar</div>
							</div>
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
		<div class="container superdeals-entry">
			<div class="superdeals-top">
				<h2 class="deals-logo">
					<a href="javascript:void(0)">Mas productos del vendedor</a>
				</h2>
				<a class="view-more" href="javascript:void(0)">Ver Todos</a>
			</div>
			<div class="superdeals-slider currentBox active">
				<div class="trend-ads">
					<ul id="flexiselDemo3">
						<li>
							<div class="col-md-3 biseller-column">
								<a href="publication.php">
									<img src="images/p1.jpg"/>
									<span class="price">&#36; 450</span>
								</a> 
								<div class="ad-info">
									<h5>There are many variations of passages</h5>
									<span>1 hour ago</span>
								</div>
							</div>
							<div class="col-md-3 biseller-column">
								<a href="publication.php">
									<img src="images/p2.jpg"/>
									<span class="price">&#36; 399</span>
								</a> 
								<div class="ad-info">
									<h5>Lorem Ipsum is simply dummy</h5>
									<span>3 hour ago</span>
								</div>
							</div>
							<div class="col-md-3 biseller-column">
								<a href="publication.php">
									<img src="images/p3.jpg"/>
									<span class="price">&#36; 199</span>
								</a> 
								<div class="ad-info">
									<h5>It is a long established fact that a reader</h5>
									<span>8 hour ago</span>
								</div>
							</div>
							<div class="col-md-3 biseller-column">
								<a href="publication.php">
									<img src="images/p4.jpg"/>
									<span class="price">&#36; 159</span>
								</a> 
								<div class="ad-info">
									<h5>passage of Lorem Ipsum you need to be</h5>
									<span>19 hour ago</span>
								</div>
							</div>
						</li>
						<li>
							<div class="col-md-3 biseller-column">
								<a href="publication.php">
									<img src="images/p5.jpg"/>
									<span class="price">&#36; 1599</span>
								</a> 
								<div class="ad-info">
									<h5>There are many variations of passages</h5>
									<span>1 hour ago</span>
								</div>
							</div>
							<div class="col-md-3 biseller-column">
								<a href="publication.php">
									<img src="images/p6.jpg"/>
									<span class="price">&#36; 1099</span>
								</a> 
								<div class="ad-info">
									<h5>passage of Lorem Ipsum you need to be</h5>
									<span>1 day ago</span>
								</div>
							</div>
							<div class="col-md-3 biseller-column">
								<a href="publication.php">
									<img src="images/p7.jpg"/>
									<span class="price">&#36; 109</span>
								</a> 
								<div class="ad-info">
									<h5>It is a long established fact that a reader</h5>
									<span>9 hour ago</span>
								</div>
							</div>
							<div class="col-md-3 biseller-column">
								<a href="publication.php">
									<img src="images/p8.jpg"/>
									<span class="price">&#36; 189</span>
								</a> 
								<div class="ad-info">
									<h5>Lorem Ipsum is simply dummy</h5>
									<span>3 hour ago</span>
								</div>
							</div>
						</li>
						<li>
							<div class="col-md-3 biseller-column">
								<a href="publication.php">
									<img src="images/p9.jpg"/>
									<span class="price">&#36; 2599</span>
								</a> 
								<div class="ad-info">
									<h5>Lorem Ipsum is simply dummy</h5>
									<span>3 hour ago</span>
								</div>
							</div>
							<div class="col-md-3 biseller-column">
								<a href="publication.php">
									<img src="images/p10.jpg"/>
									<span class="price">&#36; 3999</span>
								</a> 
								<div class="ad-info">
									<h5>It is a long established fact that a reader</h5>
									<span>9 hour ago</span>
								</div>
							</div>
							<div class="col-md-3 biseller-column vip-pub">
								<a href="publication.php">
									<img src="images/p11.jpg"/>
									<span class="price">&#36; 2699</span>
								</a> 
								<div class="ad-info">
									<h5>passage of Lorem Ipsum you need to be</h5>
									<span>1 day ago</span>
								</div>
							</div>
							<div class="col-md-3 biseller-column">
								<a href="publication.php">
									<img src="images/p12.jpg"/>
									<span class="price">&#36; 899</span>
								</a> 
								<div class="ad-info">
									<h5>There are many variations of passages</h5>
									<span>1 hour ago</span>
								</div>
							</div>
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
				</div>
			</div>
		</div>
		<div class="container superdeals-entry">
			<div class="superdeals-top">
				<h2 class="deals-logo">
					<a href="javascript:void(0)">Otros productos similares</a>
				</h2>
				<a class="view-more" href="javascript:void(0)">Ver Todos</a>
			</div>
			<div class="superdeals-slider currentBox active">
				<div class="trend-ads">
					<ul id="flexiselDemo2">
						<li>
							<div class="col-md-3 biseller-column">
								<a href="publication.php">
									<img src="images/p1.jpg"/>
									<span class="price">&#36; 450</span>
								</a> 
								<div class="ad-info">
									<h5>There are many variations of passages</h5>
									<span>1 hour ago</span>
								</div>
							</div>
							<div class="col-md-3 biseller-column">
								<a href="publication.php">
									<img src="images/p2.jpg"/>
									<span class="price">&#36; 399</span>
								</a> 
								<div class="ad-info">
									<h5>Lorem Ipsum is simply dummy</h5>
									<span>3 hour ago</span>
								</div>
							</div>
							<div class="col-md-3 biseller-column">
								<a href="publication.php">
									<img src="images/p3.jpg"/>
									<span class="price">&#36; 199</span>
								</a> 
								<div class="ad-info">
									<h5>It is a long established fact that a reader</h5>
									<span>8 hour ago</span>
								</div>
							</div>
							<div class="col-md-3 biseller-column">
								<a href="publication.php">
									<img src="images/p4.jpg"/>
									<span class="price">&#36; 159</span>
								</a> 
								<div class="ad-info">
									<h5>passage of Lorem Ipsum you need to be</h5>
									<span>19 hour ago</span>
								</div>
							</div>
						</li>
						<li>
							<div class="col-md-3 biseller-column">
								<a href="publication.php">
									<img src="images/p5.jpg"/>
									<span class="price">&#36; 1599</span>
								</a> 
								<div class="ad-info">
									<h5>There are many variations of passages</h5>
									<span>1 hour ago</span>
								</div>
							</div>
							<div class="col-md-3 biseller-column">
								<a href="publication.php">
									<img src="images/p6.jpg"/>
									<span class="price">&#36; 1099</span>
								</a> 
								<div class="ad-info">
									<h5>passage of Lorem Ipsum you need to be</h5>
									<span>1 day ago</span>
								</div>
							</div>
							<div class="col-md-3 biseller-column">
								<a href="publication.php">
									<img src="images/p7.jpg"/>
									<span class="price">&#36; 109</span>
								</a> 
								<div class="ad-info">
									<h5>It is a long established fact that a reader</h5>
									<span>9 hour ago</span>
								</div>
							</div>
							<div class="col-md-3 biseller-column">
								<a href="publication.php">
									<img src="images/p8.jpg"/>
									<span class="price">&#36; 189</span>
								</a> 
								<div class="ad-info">
									<h5>Lorem Ipsum is simply dummy</h5>
									<span>3 hour ago</span>
								</div>
							</div>
						</li>
						<li>
							<div class="col-md-3 biseller-column">
								<a href="publication.php">
									<img src="images/p9.jpg"/>
									<span class="price">&#36; 2599</span>
								</a> 
								<div class="ad-info">
									<h5>Lorem Ipsum is simply dummy</h5>
									<span>3 hour ago</span>
								</div>
							</div>
							<div class="col-md-3 biseller-column">
								<a href="publication.php">
									<img src="images/p10.jpg"/>
									<span class="price">&#36; 3999</span>
								</a> 
								<div class="ad-info">
									<h5>It is a long established fact that a reader</h5>
									<span>9 hour ago</span>
								</div>
							</div>
							<div class="col-md-3 biseller-column vip-pub">
								<a href="publication.php">
									<img src="images/p11.jpg"/>
									<span class="price">&#36; 2699</span>
								</a> 
								<div class="ad-info">
									<h5>passage of Lorem Ipsum you need to be</h5>
									<span>1 day ago</span>
								</div>
							</div>
							<div class="col-md-3 biseller-column">
								<a href="publication.php">
									<img src="images/p12.jpg"/>
									<span class="price">&#36; 899</span>
								</a> 
								<div class="ad-info">
									<h5>There are many variations of passages</h5>
									<span>1 hour ago</span>
								</div>
							</div>
						</li>
					</ul>
					<script type="text/javascript">
						$(window).load(function() {
							$("#flexiselDemo2").flexisel({
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
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade product_view" id="product_view">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<a href="javascript:void()" data-dismiss="modal" class="class pull-right"><span class="glyphicon glyphicon-remove"></span></a>
					<h3 class="modal-title titles">Titulo de prueba de un producto test</h3>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6 product_img">
							<img src="images/ss1.jpg" class="img-responsive">
						</div>
						<div class="col-md-6 product_content">
							<h4 class="lestitle">Vendedor: <span class="subtitle">Gabriel Fernandez</span></h4>
							<div class="rating">
								<i class="fa fa-star" aria-hidden="true"></i>
								<i class="fa fa-star" aria-hidden="true"></i>
								<i class="fa fa-star" aria-hidden="true"></i>
								<i class="fa fa-star-half-o" aria-hidden="true"></i>
								<i class="fa fa-star-o" aria-hidden="true"></i>
								(10 Calificaciones)
							</div>
							<h4>Se vende: Celular Samsung Galaxy Note II</h4>
							<p><strong>Display</strong>: 1.5 pugadas HD LCD Touch Screen</p>
							<p><strong>Resumen</strong>: Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla .</p>
							<h3 class="cost lestitle">Cantidad: <input id="quantity" class="subtitle" type="number" name="quantity" min="1" max="8" value="1"></h3>
							<h3 class="cost lestitle">Subtotal: <span class="subtitle"><i class="fa fa-usd" aria-hidden="true"></i><span id="subtotal">75</span></span> <small class="pre-cost" style="visibility: hidden;"><span class="glyphicon glyphicon-usd"></span> 60.00</small></h3>
							<script type="text/javascript">
								var input = document.querySelector('#quantity');

								var messages = document.querySelector('#subtotal');

								input.addEventListener('input', function()
								{
									messages.textContent = (input.value * 75) + '\n';
								});

							</script>
							<div class="space-ten"></div>
							<div class="btn-ground">
								<div class="buy-in-form">
									<form action="buyconfirmation.php" method="POST">						
										<input type="submit" value="Comprar">
									</form>	
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>	
	<?php
	if (isset($_GET['perm'])) {
							//es permuta
		?>
		<div class="modal fade product_view" id="exchange_view">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<a href="javascript:void()" data-dismiss="modal" class="class pull-right"><span class="glyphicon glyphicon-remove"></span></a>
						<h3 class="modal-title titles">Gestion de permuta de articulos</h3>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-md-12 product_content">
								<div class="alert alert-warning" id="warning-alert">
									<button type="button" class="close" data-dismiss="alert">x</button>
									<strong>Error! </strong>
									Bla bla
								</div>

								<h4>Selecciona el Items a Permutar</h4>
								<div class="container superdeals-entry" style="width: 100%;">
									<div class="superdeals-slider currentBox active">
										<div class="trend-ads">
											<div id="item1" name="itemperm" class="col-md-3 biseller-column">
												<a onclick="marksel(1)">
													<img src="images/p1.jpg"/>
													<span class="price">&#36; 450</span>
												</a> 
												<div class="ad-info">
													<h5>There are many variations of passages</h5>
													<span>1 hour ago</span>
												</div>
											</div>
											<div id="item2" name="itemperm" class="col-md-3 biseller-column">
												<a onclick="marksel(2)">
													<img src="images/p1.jpg"/>
													<span class="price">&#36; 450</span>
												</a> 
												<div class="ad-info">
													<h5>There are many variations of passages</h5>
													<span>1 hour ago</span>
												</div>
											</div>
											<div id="item3" name="itemperm" class="col-md-3 biseller-column">
												<a onclick="marksel(3)">
													<img src="images/p1.jpg"/>
													<span class="price">&#36; 450</span>
												</a> 
												<div class="ad-info">
													<h5>There are many variations of passages</h5>
													<span>1 hour ago</span>
												</div>
											</div>
											<div id="item4" name="itemperm" class="col-md-3 biseller-column">
												<a onclick="marksel(4)">
													<img src="images/p1.jpg"/>
													<span class="price">&#36; 450</span>
												</a> 
												<div class="ad-info">
													<h5>There are many variations of passages</h5>
													<span>1 hour ago</span>
												</div>
											</div>
											<div id="item5" name="itemperm" class="col-md-3 biseller-column">
												<a onclick="marksel(5)">
													<img src="images/p1.jpg"/>
													<span class="price">&#36; 450</span>
												</a> 
												<div class="ad-info">
													<h5>There are many variations of passages</h5>
													<span>1 hour ago</span>
												</div>
											</div>
											<div id="item6" name="itemperm" class="col-md-3 biseller-column">
												<a onclick="marksel(6)">
													<img src="images/p1.jpg"/>
													<span class="price">&#36; 450</span>
												</a> 
												<div class="ad-info">
													<h5>There are many variations of passages</h5>
													<span>1 hour ago</span>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="space-ten"></div>
								<div class="btn-ground">
									<div class="buy-in-form">
										<form action="buyconfirmation.php" method="POST">						
											<input type="submit" value="Enviar Permuta">
										</form>	
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}
?>
</section>
<script type="text/javascript">
	function marksel(id){
		$('div[name=itemperm]').removeClass("vip-pub");
		$('#item'+id).addClass("vip-pub");
	}
</script>
<script>
		// Instantiate EasyZoom instances
		var $easyzoom = $('.easyzoom').easyZoom();

		// Setup thumbnails example
		var api1 = $easyzoom.filter('.easyzoom--with-thumbnails').data('easyZoom');

		$('.thumbnails').on('click', 'a', function(e) {
			var $this = $(this);

			e.preventDefault();

			// Use EasyZoom's `swap` method
			api1.swap($this.data('standard'), $this.attr('href'));
		});
	</script>

	<!-- ::::::::::::::  FIN PUBLICATION  :::::::::::::: -->
	<?php 
	/*-----------------------------------------------------------------------------------------------------------*/
	/* Fin contenido de esta pagina.*/
	/*-----------------------------------------------------------------------------------------------------------*/
	require('footer.php');
	?>


