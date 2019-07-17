<?php 
if (!isset($_GET['id'])){
	header('Location: ../view/index.php');
}
require('definitions.php');
?>
<link rel="stylesheet" href="<?php echo $staticsrv; ?>/css/flexslider.css" type="text/css" media="screen" />
<script type="text/javascript" src="<?php echo $staticsrv; ?>/js/jquery.flexslider.js"></script>
<script type="text/javascript" src="<?php echo $staticsrv; ?>/js/jquery.flexisel.js"></script>
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
<link rel='stylesheet' href='<?php echo $staticsrv; ?>/css/dataTables.bootstrap.min.css'>
<script type="text/javascript" src="<?php echo $staticsrv; ?>/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo $staticsrv; ?>/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#listopen').DataTable();
	} );
</script>
<script src="<?php echo $staticsrv; ?>/EasyZoom/dist/easyzoom.js"></script>
<link rel="stylesheet" href="<?php echo $staticsrv; ?>/EasyZoom/css/easyzoom.css" />
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
require('header.php');
?>
<!-- ********************************************************************************************************************************************* -->
<section>
	<?php
	$_SESSION['PubID']=$_GET['id'];
	require_once('../logica/procesarVistoPublicacion.php');		
	$datos_publicacion = require_once('../logica/procesarCargaPublicacion.php');	
		/*var_dump($datos_publicacion);*/

	$datos_publicacionfecha = require_once('../logica/procesarCargaPublicacionFecha.php');		
	$datos_publicacionimg = require_once('../logica/procesarCargaPublicacionImg.php');		
	$datos_producto = require_once('../logica/procesarCompraPublicacion.php');
	$datos_vendedor = require_once('../logica/procesarDatosVendedor.php');
	$datos_preguntas = require_once('../logica/procesarCargaPreguntas.php');
	$_SESSION['CatID']=$datos_publicacion[0]['IDCATEGORIA'];
	$datos_categoria = require_once('../logica/procesarCargaCategoria.php');
	$datos_masproductosvendedor = require_once ('../logica/procesarCargaProductosVendedor.php');
	$datos_productossimilares = require_once ('../logica/procesarCargaProductosSimilares.php');
	if (isset($_SESSION['usu'])) {
		$datos_productofavorito = require_once ('../logica/procesarCargaProductoFavorito.php');
	}
	obtenerFechaSistema();
	?>
	<div class="single-page main-grid-border">
		<div class="container">
			<?php 
			require('breadcrumb.php');
			?>
			<div class="product-desc">
				<div class="col-md-7 product-view">
					<h2><?php echo utf8_encode($datos_publicacion['0']['TITULO']); ?></h2>
					<p><i class="fa fa-flag" aria-hidden="true"></i><a data-toggle="modal" data-target="#DenunciaPublicacionModal" href="javascript:void(0)">denunciar publicacion</a>| creado el <?php echo date("d/m/Y", strtotime($datos_publicacionfecha['0']['FECHA'])); ?> a las <?php echo date("H:i", strtotime($datos_publicacionfecha['0']['FECHA'])); ?>, Publicacion: <?php echo $datos_publicacion['0']['ID']; ?></p>
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
								<a href='".$staticsrv."/imagenes/".$datos_publicacionimg[$i]['IMAGENES'].".webp'>
								<img src='".$staticsrv."/imagenes/".$datos_publicacionimg[$i]['IMAGENES']."_di.webp' />
								</a>
								</div>
								<ul class='thumbnails'>
								<li>
								<a href='".$staticsrv."/imagenes/".$datos_publicacionimg[$i]['IMAGENES'].".webp' data-standard='".$staticsrv."/imagenes/".$datos_publicacionimg[$i]['IMAGENES']."_di.webp'>
								<img src='".$staticsrv."/imagenes/".$datos_publicacionimg[$i]['IMAGENES']."_tn.webp' />
								</a>
								</li>";
								$start=1;
							}else{
								if ($start==1){
									echo "
									<li>
									<a href='".$staticsrv."/imagenes/".$datos_publicacionimg[$i]['IMAGENES'].".webp' data-standard='".$staticsrv."/imagenes/".$datos_publicacionimg[$i]['IMAGENES']."_di.webp'>
									<img src='".$staticsrv."/imagenes/".$datos_publicacionimg[$i]['IMAGENES']."_tn.webp' />
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
						<div class="interested text-center" name="pachamama" >
							<h4>Lo quieres?</h4>
							<?php
							echo "<img src='".$staticsrv."/imagenes/".$datos_publicacion['0']['IMGDEFAULT']."_tn.webp' style='border: 1px black solid;' /><br />";
							if ($datos_publicacion['0']['ESTADOP']!='PUBLICADA') {
								echo "<h1>Publicación Finalizada</h1>";
							}else{
								if ((isset($_SESSION['id'])) AND ($_SESSION['id']!=$datos_vendedor['0']['ID'])){
									?>
									<div class="buy-in-form">
										<form action="../logica/procesarCompraOfavorito.php" method="POST">
											<button type="button" class="btn btn-success" data-toggle="modal" data-target="#ComprarModal">
												<i class="fa fa-shopping-cart"></i> Comprar
											</button>
											<?php
											if (isset($_SESSION['usu'])) {
												if ($datos_productofavorito==false) {
													?>
													<button name="boton" type="submit" class="btn btm-nofavs" value="favorito">
														<i class="fa fa-heart"></i>
													</button>
													<?php
												}else{
													?>
													<button name="boton" type="submit" class="btn btm-favs" value="desfavorito">
														<i class="fa fa-heart"></i>
													</button>
													<?php	
												}
											}else{
												?>
												<button name="boton" class="btn btm-nofavs" value="favorito">
													<i class="fa fa-heart"></i>
												</button>
												<?php
											}
											?>
										</form>
										<?php
										if ($datos_publicacion['0']['ESTADOA']=="USADO") {
											?>
											<form action="../view/exchange.php" method="GET">
												<button name="id" type="submit" class="btn btn-warning" value="<?php echo $_SESSION['PubID']; ?>">
													<i class="fa fa-handshake-o"></i> Permutar
												</button>
											</form>
											<?php
										}
										?>
									</div>
									<?php
								}
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
								<div class="col-xs-3">
									<p>
										<b>Vistas</b><br />
										<?php echo $datos_publicacion['0']['VISTO']; ?>
									</p>
								</div>
								<div class="col-xs-3">
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
								<div class="col-xs-3">
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
								<div class="col-xs-3">
									<p>
										<b>Favoritos</b><br />
										<?php 
										if ($datos_publicacion['0']['FAV']=="") {
											echo "0";
										}else{
											echo $datos_publicacion['0']['FAV']; 
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
										<b><?php echo utf8_encode( $datos_vendedor['0']['PNOMBRE'].' '.$datos_vendedor['0']['PAPELLIDO']) ?></b><br />
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
										<?php 
										if ($datos_vendedor['0']['VENTAS']==NULL) {
											echo "0";
										}else{
											echo $datos_vendedor['0']['VENTAS']; 
										}
										?>
									</p>
								</div>
								<div class="col-xs-4">
									<p>
										<b>Calificaciones</b><br />
										<?php 
										if ($datos_vendedor['0']['CALIFICACION']==NULL) {
											echo "0";
										}else{
											echo $datos_vendedor['0']['CALIFICACION']; 
										}
										?>
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
												<div class="text"><?php echo utf8_encode($datos_preguntas[$i]['MENSAJE']); ?></div>
												<p><i class="fa fa-flag" aria-hidden="true"></i><a data-toggle="modal" data-target="#DenunciaChatModal<?php echo $i?>" href="javascript:void(0)"> denunciar </a>| creado el <?php echo date("d/m/Y H:i", strtotime($datos_preguntas[$i]['FECHAM'])); ?></p>
											</div>
										</li>
										<?php
										if (!empty($datos_preguntas[$i]['RESPUESTA'])) {
											?>
											<li class="message right appeared">
												<div class="text_wrapper">
													<div class="text"><?php echo utf8_encode($datos_preguntas[$i]['RESPUESTA']); ?></div>
													<p><i class="fa fa-flag" aria-hidden="true"></i><a data-toggle="modal" data-target="#DenunciaChatModal<?php echo $i?>" href="javascript:void(0)"> denunciar </a>| creado el <?php echo date("d/m/Y H:i", strtotime($datos_preguntas[$i]['FECHAR'])); ?></p>
												</div>
											</li>
											<?php
										}
										?>
										<!-- ********************************************************************************************************************************************* -->
										<?php
									}
									?>
								</ul>
								<?php
							}
							if ($datos_publicacion['0']['ESTADOP']=='PUBLICADA') {
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
										if (isset($_SESSION['mobjetivo']) && $_SESSION['mobjetivo']=="chat"){
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
						<a href="javascript:void(0)(0)">Más productos del vendedor</a>
					</h2>
					<a class="view-more" href="javascript:void(0)(0)">Ver Todos</a>
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
											<img src="<?php echo $staticsrv; ?>/imagenes/<?php echo $datos_masproductosvendedor[$i]['IMGDEFAULT']; ?>_tn.<?php echo $_SESSION['EXT']; ?>" onerror="this.onerror=null;this.src='<?php echo $staticsrv; ?>/img/noimage_tn.<?php echo $_SESSION['EXT']; ?>';"/>
											<span class="price">&#36; <?php echo $datos_masproductosvendedor[$i]['PRECIO']; ?></span>
										</a> 
										<div class="ad-info">
											<h5><?php echo utf8_encode($datos_masproductosvendedor[$i]['TITULO']); ?></h5>
											<span><?php echo date("d/m/Y H:i", strtotime($datos_masproductosvendedor[$i]['FECHA'])); ?></span>
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
					<a href="javascript:void(0)(0)">Otros productos similares</a>
				</h2>
				<a class="view-more" href="javascript:void(0)(0)">Ver Todos</a>
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
										<img src="<?php echo $staticsrv; ?>/imagenes/<?php echo $datos_productossimilares[$i]['IMGDEFAULT']; ?>_tn.<?php echo $_SESSION['EXT']; ?>" onerror="this.onerror=null;this.src='<?php echo $staticsrv; ?>/img/noimage_tn.<?php echo $_SESSION['EXT']; ?>';"/>
										<span class="price">&#36; <?php echo $datos_productossimilares[$i]['PRECIO']; ?></span>
									</a> 
									<div class="ad-info">
										<h5><?php echo utf8_encode($datos_productossimilares[$i]['TITULO']); ?></h5>
										<span><?php echo date("d/m/Y H:i", strtotime($datos_productossimilares[$i]['FECHA'])); ?></span>
									</div>
								</div>
								<?php
							}
							echo "</li>";
							?>
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
</section>
<!-- ********************************************************************************************************************************************* -->
<div class="modal fade" id="ComprarModal" tabindex="-1" role="dialog" aria-labelledby="ComprarModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form action="../logica/procesarCompraOfavorito.php" method="POST">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12 product_img">
							<h4 class="lestitle" style="text-align: center;">Confirmacion de compra del articulo <br><span class="subtitle"><?php echo utf8_encode($datos_publicacion['0']['TITULO']); ?></span></h4>
							<hr>
						</div>
						<div class="col-md-6 product_img">
							<?php
							cargarimgtn($datos_publicacion[0]['IMGDEFAULT']);
							?>
						</div>
						<div class="col-md-6 product_content cppermuta">
							<h4 class="lestitle">Estado: <span class="subtitle"><?php echo $datos_publicacion['0']['ESTADOA']; ?></span></h4>
							<h4 class="lestitle">Cantidad: <input type="number" name="cantidad" max="<?php echo $datos_publicacion['0']['CANTIDAD']; ?>" min="1" value="1"> de <span class="subtitle"><?php echo $datos_publicacion['0']['CANTIDAD']; ?></span></h4>
							<h5 class="lestitle">Descripcion: </h5>
							<div class="product-details">
								<?php echo htmlspecialchars_decode($datos_publicacion['0']['DESCRIPCION'], ENT_NOQUOTES); ?>
							</div>
							<h3 class="cost lestitle">Precio: <span class="subtitle"><i class="fa fa-usd" aria-hidden="true"></i><span id="subtotal"><?php echo $datos_publicacion['0']['PRECIO']; ?></span></span></h3>
							<div class="space-ten"></div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button name="boton" type="submit" class="btn btn-success" value="comprar">
						<i class="fa fa-shopping-cart"></i> Comprar
					</button>
					<button type="button" class="btn btn-warning" data-dismiss="modal">Cancelar</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- *********************************************************************************************************************************************  -->
<div class="modal fade" id="DenunciaPublicacionModal" tabindex="-1" role="dialog" aria-labelledby="DenunciaPublicacionModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<form action="../logica/procesarAltaDenuncia.php" method="POST">
					<div class="row">
						<div class="col-md-12 product_img">
							<h4 class="lestitle" style="text-align: center;">Denuncia de publicacion <br><span class="subtitle"><?php echo $datos_publicacion['0']['TITULO']; ?></span></h4>
							<hr>
						</div>
						<div class="col-md-6 product_img">
							<?php
							cargarimgtn($datos_publicacion[0]['IMGDEFAULT']);
							?>
						</div>
						<div class="col-md-6 product_content cppermuta">
							<h4 class="lestitle">Cuentanos porque denuncias la publicacion:</h4>
							<textarea class="form-control" rows="5" name="comentario"></textarea>
							<input type="text" name="pubid" value="<?php echo $datos_publicacion['0']['ID']; ?>" hidden>
							<input type="text" name="tipo" value="PUBLICACION" hidden>
							<div class="space-ten"></div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button name="boton" type="submit" class="btn btn-success" value="permuta">
						<i class="fa fa-handshake-o"></i> Denunciar
					</button>
					<button type="button" class="btn btn-warning" data-dismiss="modal">Cancelar</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- ********************************************************************************************************************************************* -->
<?php
if (!isset($datos_preguntas['this'])) {
	for ($i=0; $i < count($datos_preguntas); $i++) { 
		?>
		<div class="modal fade" id="DenunciaChatModal<?php echo $i?>" tabindex="-1" role="dialog" aria-labelledby="DenunciaChatModal<?php echo $i?>Label" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-body">
						<form action="../logica/procesarAltaDenuncia.php" method="POST">
							<div class="row">
								<div class="col-md-12 product_img">
									<h4 class="lestitle" style="text-align: center;">Denuncia de Chat <br></h4>
									<hr>
								</div>
								<div class="col-md-12 product_img">
									<ul class="messages">
										<li class="message left appeared">
											<div class="text_wrapper">
												<div class="text"><?php echo utf8_encode($datos_preguntas[$i]['MENSAJE']); ?></div>
												<p><i class="fa fa-flag" aria-hidden="true"></i><a data-toggle="modal" data-target="#DenunciaChatModal<?php echo $i?>" href="javascript:void(0)"> denunciar </a>| creado el <?php echo date("d/m/Y H:i", strtotime($datos_preguntas[$i]['FECHAM'])); ?></p>
											</div>
										</li>
										<?php
										if (!empty($datos_preguntas[$i]['RESPUESTA'])) {
											?>
											<li class="message right appeared">
												<div class="text_wrapper">
													<div class="text"><?php echo utf8_encode($datos_preguntas[$i]['RESPUESTA']); ?></div>
													<p><i class="fa fa-flag" aria-hidden="true"></i><a data-toggle="modal" data-target="#DenunciaChatModal<?php echo $i?>" href="javascript:void(0)"> denunciar </a>| creado el <?php echo date("d/m/Y H:i", strtotime($datos_preguntas[$i]['FECHAR'])); ?></p>
												</div>
											</li>
											<?php 
										}
										?>
									</ul>
								</div>
								<div class="col-md-12 product_content cppermuta">
									<h4 class="lestitle">Cuentanos porque denuncias el chat:</h4>
									<textarea class="form-control" rows="5" name="comentario"></textarea>
									<input type="text" name="pubid" value="<?php echo $datos_preguntas[$i]['ID']; ?>" hidden>
									<input type="text" name="tipo" value="COMENTARIO" hidden>
									<div class="space-ten"></div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button name="boton" type="submit" class="btn btn-success" value="permuta">
								<i class="fa fa-handshake-o"></i> Denunciar
							</button>
							<button type="button" class="btn btn-warning" data-dismiss="modal">Cancelar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!-- ********************************************************************************************************************************************* -->
		<?php
	}	
}
?>
<script type="text/javascript">
	function marksel(id){
		$('div[name=itemperm]').removeClass("vip-pub");
		$('#item'+id).addClass("vip-pub");
	}
</script>
<script>
	var $easyzoom = $('.easyzoom').easyZoom();
	var api1 = $easyzoom.filter('.easyzoom--with-thumbnails').data('easyZoom');
	$('.thumbnails').on('click', 'a', function(e) {
		var $this = $(this);
		e.preventDefault();
		api1.swap($this.data('standard'), $this.attr('href'));
	});
</script>
<?php 
require('footer.php');
?>


