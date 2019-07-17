<?php 
session_start();
if (!isset($_SESSION['id'])){
	header('Location: ../view/index.php');
}
require('definitions.php');
/*-----------------------------------------------------------------------------------------------------------*/
/* Agregar todo script, puntual para esta pagina.*/
/*-----------------------------------------------------------------------------------------------------------*/
?>
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

<?php 
/*-----------------------------------------------------------------------------------------------------------*/
/* Fin scripts de esta pagina.*/
require('header.php');
/*-----------------------------------------------------------------------------------------------------------*/
/* Agregar todo el contenido de esta pagina aqui.*/
/*------------------------------------------           -----------------------------------------------------------------*/
?>
<!-- ::::::::::::::  LOGIN  :::::::::::::: -->
<section>
	<div id="page-wrapper" class="sign-in-wrapper">
		<div class="graphs">
			<div class="container">
				<div class="row db-padding-btm db-attached">
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
						<div class="db-wrapper">
							<div class="db-pricing-eleven db-bk-color-one">
								<div class="price">
									<sup>$</sup>0
									<small>por mes</small>
								</div>
								<div class="type">
									PLAN GRATUITO
								</div>
								<ul>
									<li>
										<div class="row">
											<div class="col-md-3 text-right">
												<i class="glyphicon glyphicon-usd"></i>
											</div>
											<div class="col-md-9 text-left">
												Comprar Articulos
											</div>
										</div>
									</li>
									<li>
										<div class="row">
											<div class="col-md-3 text-right">
												<i class="glyphicon glyphicon-shopping-cart"></i>
											</div>
											<div class="col-md-9 text-left">
												Vender Articulos
											</div>
										</div>
									</li>
									<li>
										<div class="row">
											<div class="col-md-3 text-right">
												<i class="glyphicon glyphicon-lock"></i>
											</div>
											<div class="col-md-9 text-left">
												Permutar Articulos
											</div>
										</div>
									</li>
									<li>
										<div class="row">
											<div class="col-md-3 text-right">
												<i class="glyphicon glyphicon-ok"></i>
											</div>
											<div class="col-md-9 text-left">
												Calificaciones
											</div>
										</div>
									</li>
									<li>
										<div class="row">
											<div class="col-md-3 text-right">
												<i class="glyphicon glyphicon-envelope"></i>
											</div>
											<div class="col-md-9 text-left">
												Mensajes
											</div>
										</div>
									</li>
									<li>
										<div class="row">
											<div class="col-md-3 text-right">
												<i class="glyphicon glyphicon-print"></i>
											</div>
											<div class="col-md-9 text-left">
												Reportes
											</div>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
							<div class="db-wrapper">
								<div class="db-pricing-eleven db-bk-color-two">
									<div class="price">
										<sup>$</sup>159
										<small>por mes</small>
									</div>
									<div class="type">
										PLAN VIP
									</div>
									<ul>
										<li>
											<div class="row">
												<div class="col-md-3 text-right">
													<i class="glyphicon glyphicon-envelope"></i>
												</div>
												<div class="col-md-9 text-left">
													Articulos llamativos
												</div>
											</div>
										</li>
										<li>
											<div class="row">
												<div class="col-md-3 text-right">
													<i class="glyphicon glyphicon-envelope"></i>
												</div>
												<div class="col-md-9 text-left">
													Preferencia en el indexado de busqueda
												</div>
											</div>
										</li>
										<li>Preferencia en el indexado de busqueda
											<div class="row">
												<div class="col-md-3 text-right">
													<i class="glyphicon glyphicon-envelope"></i>
												</div>
												<div class="col-md-9 text-left">
													Preferencia en Atención al Usuario
												</div>
											</div>
										</li>
										<li>
											<div class="row">
												<div class="col-md-3 text-right">
													<i class="glyphicon glyphicon-envelope"></i>
												</div>
												<div class="col-md-9 text-left">
													Reporte de ventas mensual
												</div>
											</div>
										</li>
										<li>
											<div class="row">
												<div class="col-md-3 text-right">
													<i class="glyphicon glyphicon-envelope"></i>
												</div>
												<div class="col-md-9 text-left">
													Control de stock
												</div>
											</div>
										</li>
										<li>
											<div class="row">
												<div class="col-md-3 text-right">
													<i class="glyphicon glyphicon-envelope"></i>
												</div>
												<div class="col-md-9 text-left">
													Graficas de Ventas
												</div>
											</div>
										</li>
									</ul>							
								</div>
								<form action="../logica/procesarAltaPremium.php" method="POST">
									<select name="servicio" class="selectpicker" style="float: left;">
										<option value="1">1 mes x $159</option>
										<option value="3">3 meses x $477</option>
										<option value="6">6 meses x $954</option>
										<option value="12">12 meses x $1528 (20% Off)</option>
									</select>
									<button type="submit" class="btn btn-success">
										<span class="glyphicon glyphicon-thumbs-up"></span> VOLVERME VIP
									</button> 
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- ::::::::::::::  FIN LOGIN  :::::::::::::: -->
	<?php 
	/*-----------------------------------------------------------------------------------------------------------*/
	/* Fin contenido de esta pagina.*/
	/*-----------------------------------------------------------------------------------------------------------*/
	require('footer.php');
	?>