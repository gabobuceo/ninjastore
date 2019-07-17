<?php 
//session_start();
require('definitions.php');
/*-----------------------------------------------------------------------------------------------------------*/
/* Agregar todo script, puntual para esta pagina.*/
/*-----------------------------------------------------------------------------------------------------------*/
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
<script type="text/javascript" src="<?php echo $staticsrv; ?>/ckeditor/ckeditor.js"></script>


<link href="<?php echo $staticsrv; ?>/bootstrap-fileinput/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
<link href="<?php echo $staticsrv; ?>/bootstrap-fileinput/themes/explorer-fa/theme.css" media="all" rel="stylesheet" type="text/css"/>
<script src="<?php echo $staticsrv; ?>/bootstrap-fileinput/js/plugins/sortable.js" type="text/javascript"></script>
<script src="<?php echo $staticsrv; ?>/bootstrap-fileinput/js/fileinput.js" type="text/javascript"></script>
<script src="<?php echo $staticsrv; ?>/bootstrap-fileinput/js/locales/fr.js" type="text/javascript"></script>
<script src="<?php echo $staticsrv; ?>/bootstrap-fileinput/js/locales/es.js" type="text/javascript"></script>
<script src="<?php echo $staticsrv; ?>/bootstrap-fileinput/themes/explorer-fa/theme.js" type="text/javascript"></script>
<script src="<?php echo $staticsrv; ?>/bootstrap-fileinput/themes/fa/theme.js" type="text/javascript"></script>

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
			<h1>Imagen</h1>
			<div class="product-desc">
				<form action="../logica/procesarAltaPublicacion.php" method="POST">
					<h2>Imagenes</h2>
					<input id="escanneo" multiple type="file" name="imagen[]" accept="img/*">
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


