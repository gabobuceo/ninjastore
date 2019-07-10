<?php 
session_start();
require('definitions.php');
/*-----------------------------------------------------------------------------------------------------------*/
/* Agregar todo script, puntual para esta pagina.*/
/*-----------------------------------------------------------------------------------------------------------*/
$perfil_completo = require_once('../logica/procesarPerfilCompleto.php');
if ($perfil_completo==false) {
	$_SESSION['mobjetivo']="misdatos";
	$_SESSION['mtipo']="alert-warning";
	$_SESSION['mtexto']="<strong>!Problema! </strong>Para poder publicar algo, debe tener el perfil completo";
	header('Location: ../view/myprofile.php');
}
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
<script type="text/javascript" src="../static/ckeditor/ckeditor.js"></script>


<link href="../static/bootstrap-fileinput/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
<link href="../static/bootstrap-fileinput/themes/explorer-fa/theme.css" media="all" rel="stylesheet" type="text/css"/>
<script src="../static/bootstrap-fileinput/js/plugins/sortable.js" type="text/javascript"></script>
<script src="../static/bootstrap-fileinput/js/fileinput.js" type="text/javascript"></script>
<script src="../static/bootstrap-fileinput/js/locales/fr.js" type="text/javascript"></script>
<script src="../static/bootstrap-fileinput/js/locales/es.js" type="text/javascript"></script>
<script src="../static/bootstrap-fileinput/themes/explorer-fa/theme.js" type="text/javascript"></script>
<script src="../static/bootstrap-fileinput/themes/fa/theme.js" type="text/javascript"></script>

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
if (isset($_GET['edit']) && ($_GET['edit']=='y')) {
	$_SESSION['PubID']=$_GET['id'];
	require_once('../logica/procesarVistoPublicacion.php');		
	$datos_publicacion = require_once('../logica/procesarCargaPublicacion.php');	
	

	/*$datos_publicacionfecha = require_once('../logica/procesarCargaPublicacionFecha.php');	*/	
	$datos_publicacionimg = require_once('../logica/procesarCargaPublicacionImg.php');	
	/*
	$datos_producto = require_once('../logica/procesarCompraPublicacion.php');
	$datos_vendedor = require_once('../logica/procesarDatosVendedor.php');
	$datos_preguntas = require_once('../logica/procesarCargaPreguntas.php');
	$_SESSION['CatID']=$datos_publicacion[0]['IDCATEGORIA'];
	$datos_categoria = require_once('../logica/procesarCargaCategoria.php');
	$datos_masproductosvendedor = require_once ('../logica/procesarCargaProductosVendedor.php');
	
	var_dump($datos_publicacion);
	echo "<hr>";	
	var_dump($datos_publicacionimg);
	*/
	
	?>
	<section>
		<div class="single-page main-grid-border">
			<div class="container">
				<h1>Editar un producto</h1>
				<div class="product-desc">
					<form action="../logica/procesarModificarPublicacion.php" method="POST">
						<div class="col-md-7 product-view" style="border-width: 3px;">
							<h2 st>Titulo de la publicación</h2>
							<p><b><input name="titulopublicacion" class="form-control" type="text" value="<?php echo utf8_encode($datos_publicacion[0]['TITULO']);?>"></b></p>
							<p><b><input name="idpublicacion" type="text" value="<?php echo utf8_encode($datos_publicacion[0]['ID']);?>" hidden ></b></p>
							<h2>Imagenes</h2>
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
								<h3>Si quiere cambiarlas, ingrese imagenes para reemplazarlas</h3>
								<input id="escanneo" multiple type="file" name="imagen[]" accept="img/*">
								<div id="errorBlock43" class="help-block"></div>
								<h2>Descripcion de la publicación</h2>
								<textarea name="editor1" id="editor1" rows="10" cols="80" >
									<?php echo $datos_publicacion[0]['DESCRIPCION'];?>
								</textarea>
								<script>
									CKEDITOR.replace( 'editor1' );
								</script>
							</div>
							<div class="col-md-5 product-details-grid">
								<div class="tips" style="margin-top: 0px;">
									<div class="row">
										<div class="col-xs-12">
											<h4>Estado</h4><br />
										</div>
									</div>
									<div class="row">
										<?php 
										if ($datos_publicacion[0]['ESTADOA']=='NUEVO') {
											?>
											<div class="col-xs-6">
												<label>
													<input type="radio" class="radio-icon" name="options" value="Nuevo" id="option1" autocomplete="off" checked><label for="option1">Nuevo</label>
												</label>
											</div>
											<div class="col-xs-6">
												<label>
													<input type="radio" class="radio-icon" name="options" value="Usado" id="option2" autocomplete="off"><label for="option2">Usado</label>
												</label>
											</div>
											<?php 
										}else{
											?>
											<div class="col-xs-6">
												<label>
													<input type="radio" class="radio-icon" name="options" value="Nuevo" id="option1" autocomplete="off"><label for="option1">Nuevo</label>
												</label>
											</div>
											<div class="col-xs-6">
												<label>
													<input type="radio" class="radio-icon" name="options" value="Usado" id="option2" autocomplete="off" checked><label for="option2">Usado</label>
												</label>
											</div>
											<?php 
										}
										?>

									</div>
								</div>
								<div class="tips">
									<div class="row">
										<div class="col-xs-12">
											<h4>Categoria</h4><br />
										</div>
									</div>
									<div class="row">
										<div class="col-xs-2">
											<span class="fa-stack fa-lg">
												<i class="fa fa-square-o fa-stack-2x"></i>
												<i class="fa fa-calendar-check-o fa-stack-1x"></i>
											</span>
										</div>
										<div class="col-xs-10">
											<select name="categoria" class="selectpicker" data-live-search="true">
												<?php
												$a=cargarCategoriasPadres();
												$b=count($a);
												for ($i=0; $i < $b; $i++) { 
													echo utf8_encode("<optgroup label='".$a[$i]['TITULO']."'>");
													$c=cargarCategoriasHijos($a[$i]['ID']);
													$d=count($c);
													for ($j=0; $j < $d; $j++) { 
														echo utf8_encode("<option value='".$c[$j]['ID']."'>".$c[$j]['TITULO']."</option>");
													}
													echo "</optgroup>";	
												}
												?>

											</select>



										</div>
									</div>
								</div>
								<div class="tips">
									<div class="row">
										<div class="col-xs-12">
											<h4>Cantidad</h4><br />
										</div>
									</div>
									<div class="row">
										<div class="col-xs-2">
											<span class="fa-stack fa-lg">
												<i class="fa fa-square-o fa-stack-2x"></i>
												<i class="fa fa-archive fa-stack-1x"></i>
											</span>
										</div>
										<div class="col-xs-10">
											<p><b><input class="form-control" type="number" name="quantity" min="1" max="9999999" value="<?php echo $datos_publicacion[0]['CANTIDAD'];?>"></b></p>
										</div>
									</div>
								</div>
								<div class="tips">
									<div class="row">
										<div class="col-xs-12">
											<h4>Precio</h4><br />
										</div>
									</div>
									<div class="row">
										<div class="col-xs-2">
											<span class="fa-stack fa-lg">
												<i class="fa fa-square-o fa-stack-2x"></i>
												<i class="fa fa-usd fa-stack-1x"></i>
											</span>
										</div>
										<div class="col-xs-10">
											<p><b><input class="form-control" type="number" name="precio" min="1" max="9999999" value="<?php echo $datos_publicacion[0]['PRECIO'];?>"></b></p>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<input type="submit" class="submitnaranja" name="boton" value="Cancelar" />
								</div>
								<div class="col-md-6">
									<input type="submit" class="submitverde" name="boton" value="Actualizar" />
								</div>
							</div>
							<div class="clearfix"></div>
						</form>
					</div>
				</div>
			</div>
		</section>
		<script type="text/javascript">

			$(document).ready(function() {


				$('select[name=categoria]').val(<?php echo $datos_publicacion[0]['IDCATEGORIA']?>);
				$('.selectpicker').selectpicker('refresh');

			});

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
	}else{
		?>
		<section>
			<div class="single-page main-grid-border">
				<div class="container">
					<h1>Publicar un producto</h1>
					<div class="product-desc">
						<form action="../logica/procesarAltaPublicacion.php" method="POST">
							<div class="col-md-7 product-view" style="border-width: 3px;">
								<h2 st>Titulo de la publicación</h2>
								<p><b><input name="titulopublicacion" class="form-control" type="text"></b></p>
								<h2>Imagenes</h2>
								<input id="escanneo" multiple type="file" name="imagen[]" accept="img/*">
								<div id="errorBlock43" class="help-block"></div>
								<h2>Descripcion de la publicación</h2>
								<textarea name="editor1" id="editor1" rows="10" cols="80"></textarea>
								<script>
									CKEDITOR.replace( 'editor1' );
								</script>
							</div>
							<div class="col-md-5 product-details-grid">
								<div class="tips" style="margin-top: 0px;">
									<div class="row">
										<div class="col-xs-12">
											<h4>Estado</h4><br />
										</div>
									</div>
									<div class="row">
										<div class="col-xs-6">
											<label>
												<input type="radio" class="radio-icon" name="options" value="Nuevo" id="option1" autocomplete="off" checked><label for="option1">Nuevo</label>
											</label>
										</div>
										<div class="col-xs-6">
											<label>
												<input type="radio" class="radio-icon" name="options" value="Usado" id="option2" autocomplete="off"><label for="option2">Usado</label>
											</label>
										</div>
									</div>
								</div>
								<div class="tips">
									<div class="row">
										<div class="col-xs-12">
											<h4>Categoria</h4><br />
										</div>
									</div>
									<div class="row">
										<div class="col-xs-2">
											<span class="fa-stack fa-lg">
												<i class="fa fa-square-o fa-stack-2x"></i>
												<i class="fa fa-calendar-check-o fa-stack-1x"></i>
											</span>
										</div>
										<div class="col-xs-10">
											<select name="categoria" class="selectpicker" data-live-search="true">
												<?php
												$a=cargarCategoriasPadres();
												$b=count($a);
												for ($i=0; $i < $b; $i++) { 
													echo utf8_encode("<optgroup label='".$a[$i]['TITULO']."'>");
													$c=cargarCategoriasHijos($a[$i]['ID']);
													$d=count($c);
													for ($j=0; $j < $d; $j++) { 
														echo utf8_encode("<option value='".$c[$j]['ID']."'>".$c[$j]['TITULO']."</option>");
													}
													echo "</optgroup>";	
												}
												?>
											</select>
										</div>
									</div>
								</div>
								<div class="tips">
									<div class="row">
										<div class="col-xs-12">
											<h4>Cantidad</h4><br />
										</div>
									</div>
									<div class="row">
										<div class="col-xs-2">
											<span class="fa-stack fa-lg">
												<i class="fa fa-square-o fa-stack-2x"></i>
												<i class="fa fa-archive fa-stack-1x"></i>
											</span>
										</div>
										<div class="col-xs-10">
											<p><b><input class="form-control" type="number" name="quantity" value="1" min="1" max="9999999"></b></p>
										</div>
									</div>
								</div>
								<div class="tips">
									<div class="row">
										<div class="col-xs-12">
											<h4>Precio</h4><br />
										</div>
									</div>
									<div class="row">
										<div class="col-xs-2">
											<span class="fa-stack fa-lg">
												<i class="fa fa-square-o fa-stack-2x"></i>
												<i class="fa fa-usd fa-stack-1x"></i>
											</span>
										</div>
										<div class="col-xs-10">
											<p><b><input class="form-control" type="number" name="precio" value="1" min="1" max="9999999"></b></p>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<input type="submit" class="submitnaranja" name="boton" value="Guardar" />
								</div>
								<div class="col-md-6">
									<input type="submit" class="submitverde" name="boton" value="Publicar" />
								</div>
							</div>
							<div class="clearfix"></div>
						</form>
					</div>
				</div>
			</div>
		</section>
		<?php
	}

	?>
	<!-- ::::::::::::::  PUBLICATION  :::::::::::::: -->

	<script type="text/javascript">
		function marksel(id){
			$('div[name=itemperm]').removeClass("vip-pub");
			$('#item'+id).addClass("vip-pub");
		}
		$(document).ready(function() {

			var $input = $('#escanneo');
			$input.fileinput({
				language: 'es',
				browseClass: "btn btn-danger btn-block",
				showCaption: true,
				uploadAsync: false,
				showUpload: false, 
				showRemove: false, 
				minFileCount: 1,
				previewFileType: "image",
				browseIcon: '<i class="glyphicon glyphicon-picture"></i>',
				allowedFileExtensions: ["jpg", "JPG", "jpeg", "JPEG", "png", "PNG", "gif", "GIF"],
				dropZoneEnabled: false,
				uploadAsync: false,
				uploadUrl: "../logica/procesarUploadImagen.php", 
				uploadExtraData: function() {
					return {
						server: "server",
						user: "users"
					};
				}
			}).on("filebatchselected", function(event, files) {
				$input.fileinput("upload");
			});
		});
	</script>
	<!-- ::::::::::::::  FIN PUBLICATION  :::::::::::::: -->
	<?php 
	/*-----------------------------------------------------------------------------------------------------------*/
	/* Fin contenido de esta pagina.*/
	/*-----------------------------------------------------------------------------------------------------------*/
	require('footer.php');
	?>


