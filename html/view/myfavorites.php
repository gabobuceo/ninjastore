<?php 
session_start();
require('definitions.php');
require_once ('../logica/funciones.php');
/*-----------------------------------------------------------------------------------------------------------*/
/* Agregar todo script, puntual para esta pagina.*/
/*-----------------------------------------------------------------------------------------------------------*/
?>
<?php 
/*-----------------------------------------------------------------------------------------------------------*/
/* Fin scripts de esta pagina.*/
/*-----------------------------------------------------------------------------------------------------------*/
/* Agregar todo control, puntual para esta pagina (Como la sesion).*/
/*-----------------------------------------------------------------------------------------------------------*/
require('header.php');
/*$datos_favoritos = require_once('../logica/procesarCargaFavoritos.php'); ----> no es necesario ya que se encuentra en el HEADER!!!!!
/*-----------------------------------------------------------------------------------------------------------*/
/* Agregar todo el contenido de esta pagina aqui.*/
/*-----------------------------------------------------------------------------------------------------------*/
?>
<div class="row affix-row">
	<div class="col-sm-3 col-md-2 affix-sidebar">
		<?php 
		$_SESSION['menu']=7;
		require('menu.php');
		unset($_SESSION['menu']);
		?>
	</div>
	<div class="col-sm-9 col-md-10">
		<div class="row maincpanel">
			<div class="col-md-7">
				<div class="single-page main-grid-border">
					<div class="leftcpanel">
						<h4>Vista Previa</h4>
						<?php
						if (isset($_GET['idpubli'])) {
							$_SESSION['PubID']=$_GET['idpubli'];
							$datos_publicacion = require_once('../logica/procesarCargaPublicacion.php');		
							/*var_dump($datos_publicacion);
							echo "<br><br>";*/
							unset($_SESSION['PubID']);
							?>
							<div class="row">
								<div class="col-md-6 product_img">
									<?php
									cargarimgtn($datos_publicacion[0]['IMGDEFAULT']);
									?>
								</div>
								<div class="col-md-6 product_content cppermuta">
									<h4 class="lestitle">Articulo: <span class="subtitle"><?php echo $datos_publicacion['0']['TITULO']; ?></span></h4>
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
							<div class="row">
								<div class="col-md-6 product_img">
									<div class="btn-ground">
										<div class="buy-in-form">
											<form action="../view/publication.php?id=<?php echo $datos_publicacion['0']['ID']; ?>" method="POST">						
												<button name="boton" type="submit" class="btn btn-warning" value="comprar">
													<i class="fa fa-external-link"></i> Ir a Publicacion
												</button>
											</form>	
										</div>
									</div>
								</div>
								<div class="col-md-6 product_img">
									<div class="btn-ground">
										<div class="buy-in-form">
											<form action="#" method="POST">						
												<button name="boton" type="submit" class="btn btn-success" value="favorito">
													<i class="fa fa-shopping-cart"></i> Comprar
												</button>
											</form>	
										</div>
									</div>
								</div>
							</div>
							<?php
						}else{
							?>
							<div class="row">
								<div class="col-md-12 product_img">
									<p>Para cargar la vista previa del producto haz click en su enlace</p>
								</div>
							</div>
							<?php
						}
						?>
					</div>
				</div>
			</div>
			<div class="col-md-5">
				<div class="single-page main-grid-border">
					<div class="rightcpanel">
						<h4>Listado</h4>
						<?php				
						if (isset($datos_favoritos["this"])) {
							?>
							<p>No tienen favoritos.<br>Agrega tus favoritos y síguelos desde acá.</p>
							<?php
						}else{
							?>
							<div class="table-responsive">
								<table class="table table-condensed">
									<thead>
										<tr>
											<td><strong>Titulo</strong></td>
											<td class="text-center"><strong>Precio</strong></td>
											<td class="text-center"><strong>Vista Previa</strong></td>
											<td class="text-right"><strong>Quitar</strong></td>
										</tr>
									</thead>
									<tbody>
										<?php
										for ($i=0; $i < count($datos_favoritos); $i++) { 
											?>
											<tr>
												<form action="../logica/procesarBajaFavoritos.php" method="POST">
													<td><?php echo $datos_favoritos[$i]['TITULO']; ?></td>
													<td class="text-center">$ <?php echo $datos_favoritos[$i]['PRECIO']; ?></td>
													<td class="text-center"><a href="../view/myfavorites.php?idpubli=<?php echo $datos_favoritos[$i]['IDPUBLICACION']; ?>"><i class="fa fa-external-link" aria-hidden="true"></i> ID: <?php echo $datos_favoritos[$i]['IDPUBLICACION']; ?></a></td>
													<td class="text-right">
														<button name="idfavorito" type="submit" class="btn btn-xs btn-danger pull-right" value="<?php echo $datos_favoritos[$i]['IDPUBLICACION']; ?>">
															<i class="fa fa-trash"></i>
														</button>
													</td>
												</form>
											</tr>
											<?php
										}
										?>
									</tbody>
								</table>
							</div>
							<?php
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php 
/*-----------------------------------------------------------------------------------------------------------*/
/* Fin contenido de esta pagina.*/
/*-----------------------------------------------------------------------------------------------------------*/
require('footer.php');
?>
