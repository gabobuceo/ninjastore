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
if (isset($_POST['search'])) {
	$_SESSION['buscar']=$_POST['search'];
	$datos_publicaciones = require_once('../logica/procesarCargaPubliBuscar.php');
}elseif (isset($_GET['categoria'])){
	$_SESSION['buscar']=$_GET['categoria'];
	$datos_publicaciones = require_once('../logica/procesarCargaPubliBuscarCat.php');
	$_SESSION['buscar']=$datos_publicaciones[0]['CATTITULO'];
}else{
	$_SESSION['buscar']="";
	$datos_publicaciones = require_once('../logica/procesarCargaPubliBuscar.php');
}
require('header.php');
/*-----------------------------------------------------------------------------------------------------------*/
/* Agregar todo el contenido de esta pagina aqui.*/
/*-----------------------------------------------------------------------------------------------------------*/
?>
<?php
/*
select PUBLICACION.* from PUBLICACION where TITULO LIKE "%ubl%" or TITULO LIKE "%cion%" or TITULO LIKE "%Cama%" 
UNION ALL
select P.* from PUBLICACION P, CATEGORIA C where C.ID = P.IDCATEGORIA
and (C.TITULO LIKE "%ubl%" or C.TITULO LIKE "%cion%" or C.TITULO LIKE "%Cama%")
order by locate('ubl', TITULO) asc, locate('cion', TITULO) asc, locate('Cama', TITULO) asc, TITULO asc
*/


/*var_dump($datos_publicaciones);*/
?>
<!--
		<div class="container superdeals-entry">
			<div class="superdeals-top">
				<h2 class="deals-logo">
					<a href="javascript:void(0)">Filtros</a>
				</h2>
				
			</div>
			<div class="superdeals-slider currentBox active">
				
			</div>
		</div>
	-->
	
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
			<div class="col-sm-3 col-md-3">
				<div class="container superdeals-entry" style="width: 100% !important ;">
					<div class="superdeals-top">
						<h2 class="deals-logo">
							<a href="javascript:void(0)">Categorias</a>
						</h2>
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
									echo "</ul></div>";	
								}
								?>
							</div>
						</div>
					</div>
					<div class="col-sm-9 col-md-9">
						<div class="container superdeals-entry"  style="width: 100% !important ;">
							<div class="superdeals-top">
								<h2 class="deals-logo">
									<a href="javascript:void(0)">Busqueda de Artículos: "<?php echo $_SESSION['buscar'] ?>"</a>
								</h2>
							</div>				
							<div class="superdeals-slider currentBox active">
								<div class="trend-ads">
									<?php
									if (!isset($datos_publicaciones['this']) && ($datos_publicaciones[0]['ID']!=null)) {
										for ($i=0; $i < count($datos_publicaciones); $i++) { 
											?>
											<div class="col-md-3 biseller-column">
												<a href="publication.php?id=<?php echo $datos_publicaciones[$i]['ID']; ?>">
													<img src="../imagenes/<?php echo $datos_publicaciones[$i]['IMGDEFAULT']; ?>_tn.webp" onerror="this.onerror=null;this.src='../imagenes/noimage_tn.webp';"/>
													<span class="price">&#36; <?php echo $datos_publicaciones[$i]['PRECIO']; ?></span>
												</a> 
												<div class="ad-info">
													<h5><?php echo $datos_publicaciones[$i]['TITULO']; ?></h5>
													<span><?php echo $datos_publicaciones[$i]['FECHA']; ?></span>
												</div>
											</div>
											<?php
										}
									}else{
										?>
										<h3>No se han encontrado articulos con la descripción</h3>
										<img class="img-responsive error-image" src='../static/img/404.gif' />
										<?php
									}
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- <div class="clearfix"></div> -->




				<?php 
				/*-----------------------------------------------------------------------------------------------------------*/
				/* Fin contenido de esta pagina.*/
				/*-----------------------------------------------------------------------------------------------------------*/
				require('footer.php');
				?>
