<?php 
if (!isset($_GET['id'])){
	header('Location: ../view/index.php');
}
require('definitions.php');
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
require('header.php');
$_SESSION['PubID']=$_GET['id'];
$datos_publicacion = require_once('../logica/procesarCargaPublicacion.php');
unset($_SESSION['PubID']);
if (isset($_GET['idcambio'])) {
	$_SESSION['PubID']=$_GET['idcambio'];
	$datos_oferto = require('../logica/procesarCargaPublicacion.php');
	/*var_dump($datos_publicacion);
	var_dump($datos_oferto);*/
	unset($_SESSION['PubID']);
}else{
	$datos_oferto = require_once('../logica/procesarCargaProductosUsados.php');
}
?>

<!-- ::::::::::::::  PUBLICACIONES VARIAS  :::::::::::::: -->
<div class="row maincpanel" style="margin: 0px;"">
	<div class="col-md-6">
		<div class="single-page main-grid-border">
			<div class="leftcpanel">
				<div class="row">
					<?php
					if (isset($_GET['idcambio'])) {
						?>
						<div class="col-md-12 product_img">
							<h4 class="lestitle" style="text-align: center;">Tu item <br><span class="subtitle"><?php echo  utf8_encode($datos_oferto['0']['TITULO']); ?></span></h4>
						</div>
						<div class="col-md-6 product_img">
							<?php
							cargarimgtn($datos_oferto[0]['IMGDEFAULT']);
							?>
						</div>
						<div class="col-md-6 product_content cppermuta">
							<h4 class="lestitle">Estado: <span class="subtitle"><?php echo $datos_oferto['0']['ESTADOA']; ?></span></h4>
							<h4 class="lestitle">Cantidad: <span class="subtitle"><?php echo $datos_oferto['0']['CANTIDAD']; ?></span></h4>
							<h5 class="lestitle">Descripcion: </h5>
							<div class="product-details">
								<?php echo htmlspecialchars_decode($datos_oferto['0']['DESCRIPCION'], ENT_NOQUOTES); ?>
							</div>
							<h3 class="cost lestitle">Precio: <span class="subtitle"><i class="fa fa-usd" aria-hidden="true"></i><span id="subtotal"><?php echo $datos_oferto['0']['PRECIO']; ?></span></span></h3>
							<div class="space-ten"></div>
						</div>
						<?php
					}else{
						?>
						<div class="col-md-12 product_img">
							<h4 class="lestitle" style="text-align: center;">Tu item <br><span class="subtitle">Item aún no seleccionado</span></h4>
						</div>
						<div class="col-md-12 product_img">
							<?php
							/*var_dump($_SESSION);
							var_dump($datos_oferto);*/
							if (isset($datos_oferto["this"])) {
								?>
								<p>No tienes publicaciones usadas para permutar por este producto.</p>
								<?php
							}else{
								?>
								<label>Seleccione una publicacion</label>
								<form class="form-inline" action="../view/exchange.php?id=" metod="GET">
									<div class="form-group">
										
										<input type="text" name="id" value="<?php echo $datos_publicacion[0]['ID']?>" hidden />
										<select class="form-control" name="idcambio">
											<?php
											for ($i=0; $i < count($datos_oferto); $i++) { 
												?>	
												<option value="<?php echo $datos_oferto[$i]['ID']?>"><?php echo utf8_encode($datos_oferto[$i]['TITULO'])?> ($ <?php echo $datos_oferto[$i]['PRECIO']." | ".$datos_oferto[$i]['CANTIDAD'].' unidad/es'?>)</option>
												<?php
											}
											?>
										</select>
									</div>
									<button type="submit" class="btn btn-success">
										<i class="fa fa-cart-arrow-down"></i> Cargar publicacion
									</button>
								</form>
								<?php
							}
							?>
						</div>
						<?php
					}
					?>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="single-page main-grid-border">
			<div class="rightcpanel">
				<div class="row">
					<div class="col-md-12 product_img">
						<h4 class="lestitle" style="text-align: center;">A cambio de este item <br><span class="subtitle"><?php echo utf8_encode($datos_publicacion['0']['TITULO']); ?></span></h4>
					</div>
					<div class="col-md-6 product_img">
						<?php
						cargarimgtn($datos_publicacion[0]['IMGDEFAULT']);
						?>
					</div>
					<div class="col-md-6 product_content cppermuta">

						<h4 class="lestitle">Estado: <span class="subtitle"><?php echo $datos_publicacion['0']['ESTADOA']; ?></span></h4>
						<h4 class="lestitle">Cantidad: <span class="subtitle"><?php echo $datos_publicacion['0']['CANTIDAD']; ?></span></h4>
						<h5 class="lestitle">Descripcion: </h5>
						<div class="product-details">
							<?php echo htmlspecialchars_decode($datos_publicacion['0']['DESCRIPCION'], ENT_NOQUOTES); ?>
						</div>
						<h3 class="cost lestitle">Precio: <span class="subtitle"><i class="fa fa-usd" aria-hidden="true"></i><span id="subtotal"><?php echo $datos_publicacion['0']['PRECIO']; ?></span></span></h3>
						<div class="space-ten"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
	if (isset($_GET['idcambio'])) {
		?>
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-6 product_img">
					<div class="btn-ground">
						<div class="buy-in-form">
							<form action="../view/publication.php?id=<?php echo $datos_publicacion['0']['ID']; ?>" method="POST" style="text-align: right;">						
								<button name="boton" type="submit" class="btn btn-warning" value="Volver">
									<i class="fa fa-external-link"></i> Volver a la Publicacion
								</button>
							</form>	
						</div>
					</div>
				</div>
				<div class="col-md-6 product_img">
					<div class="btn-ground">
						<div class="buy-in-form">
							<form action="../logica/procesarAltaPermuta.php?id=<?php echo $_GET['id']?>&idcambio=<?php echo $_GET['idcambio']?>" method="GET">	
								<button name="boton" type="submit" class="btn btn-success" value="permuta">
									<i class="fa fa-shopping-cart"></i> Confirmar Permuta
								</button>
								<input hidden name=id value="<?php echo $_GET['id']?>">
								<input hidden name=idcambio value="<?php echo $_GET['idcambio']?>">
							</form>	
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php 
	}
	?>	
</div>
<?php 

require('footer.php');
?>
