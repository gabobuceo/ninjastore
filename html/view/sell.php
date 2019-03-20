<?php 
//session_start();
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
<script type="text/javascript" src="../static/ckeditor/ckeditor.js"></script>


<link href="../static/bootstrap-fileinput/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
<link href="../static/bootstrap-fileinput/themes/explorer-fa/theme.css" media="all" rel="stylesheet" type="text/css"/>
<script src="../static/bootstrap-fileinput/js/plugins/sortable.js" type="text/javascript"></script>
<script src="../static/bootstrap-fileinput/js/fileinput.js" type="text/javascript"></script>
<script src="../static/bootstrap-fileinput/js/locales/fr.js" type="text/javascript"></script>
<script src="../static/bootstrap-fileinput/js/locales/es.js" type="text/javascript"></script>
<script src="../static/bootstrap-fileinput/themes/explorer-fa/theme.js" type="text/javascript"></script>
<script src="../static/bootstrap-fileinput/themes/fa/theme.js" type="text/javascript"></script>

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
	<div class="single-page main-grid-border">
		<div class="container">
			<h1>Publicar un producto</h1>
			<div class="product-desc">
				<form action="../logica/procesarAltaPublicacion.php" method="POST">
				<!--<form action="test.php" method="POST">-->
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
									<!--<i class="fa fa-usd fa-2x fa-border" aria-hidden="true"></i> -->
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
										<!--<optgroup label="Dispositivos Moviles">
											<option checked value="3">Celulares</option>
											<option value="4">Tablets</option>
											<option value="5">Accesorios</option>
										</optgroup>
										<optgroup label="Electronica Y Electrodomesticos">
											<option value="6">Computadoras y Accesorios</option>
											<option value="7">TV - Video - Audio</option>
											<option value="8">Camaras y Accesorios</option>
											<option value="9">Juegos y Entretenimiento</option>
											<option value="10">Electrodomesticos de la Cocina</option>
											<option value="11">Electrodomesticos del Baño</option>
										</optgroup>
										<optgroup label="Autos">
											<option>Nuevos</option>
											<option>Usados</option>
											<option>Partes</option>
										</optgroup>
										<optgroup label="Motos">
											<option>Nuevas</option>
											<option>Usadas</option>
											<option>Partes</option>
										</optgroup>
										<optgroup label="Muebles">
											<option>Comedor</option>
											<option>Cuartos</option>
											<option>Hogar y Jardin</option>
											<option>Otros muebles</option>
										</optgroup>
										<optgroup label="Mascotas">
											<option>Perros</option>
											<option>Gatos</option>
											<option>Acuarios</option>
											<option>Alimentos</option>
											<option>Objetos para Mascotas</option>
										</optgroup>
										<optgroup label="Hobbies">
											<option>Libros y Revistas</option>
											<option>Instrumentos Musicales</option>
											<option>Equipamiento deportivo</option>
											<option>Gimnacio y Fitnes</option>
											<option>Otros Hobbies</option>
										</optgroup>
										<optgroup label="Ropa">
											<option>Adultos</option>
											<option>Niños</option>
											<option>Accesorios</option>
										</optgroup>
										<optgroup label="Niños">
											<option>Juguetes</option>
											<option>Accesorios</option>
										</optgroup>
										<optgroup label="Inmuebles">
											<option>Casas</option>
											<option>Apartamentos</option>
											<option>Espacios Comerciales</option>
											<option>Vacaciones</option>
										</optgroup>-->
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
									<!--<i class="fa fa-usd fa-2x fa-border" aria-hidden="true"></i> -->
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
									<!--<i class="fa fa-usd fa-2x fa-border" aria-hidden="true"></i> -->
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


