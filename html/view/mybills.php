<?php 
session_start();
require('definitions.php');
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
/*-----------------------------------------------------------------------------------------------------------*/
/* Agregar todo el contenido de esta pagina aqui.*/
/*-----------------------------------------------------------------------------------------------------------*/
?>
<div class="row affix-row">
	<div class="col-sm-3 col-md-2 affix-sidebar">
		<?php 
		$_SESSION['menu']=9;
		require('menu.php');
		unset($_SESSION['menu']);
		?>
	</div>
	<div class="col-sm-9 col-md-10">
		<div class="row maincpanel">
			<div class="col-md-7">
				<div class="single-page main-grid-border">
					<div class="leftcpanel">
						<h4>Ver Factura</h4>
						<div>
							
							<object data="showpdf.php" type="application/pdf" width="100%" height="500">
								Tu dispositivo no admite ver la factura desde la Web. Para descargar la factura y verla precione <a href="showpdf.php">aquí</a>
							</object>
							<!--
							<object data="../static/fpdf/examples/invoce/ex.pdf" type="application/pdf" width="100%" height="500">
								alt : <a href="../static/fpdf/examples/invoce/ex.pdf">test.pdf</a>
							</object>-->
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-5">
				<div class="single-page main-grid-border">
					<div class="rightcpanel">
						<h4>Facturas Pendientes</h4>
						<div class="table-responsive">
							<table class="table table-condensed">
								<thead>
									<tr>
										<td><strong>Articulo</strong></td>
										<td class="text-center"><strong>Vencimiento</strong></td>
										<td class="text-right"><strong>Enlace</strong></td>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Celular HP 4k</td>
										<td class="text-center">01/05/2018</td>
										<td class="text-right"><a href="javascript:void(0)"><i class="fa fa-external-link" aria-hidden="true"></i> ID: 44448</a></td>
									</tr>
									<tr>
										<td>Celular HP 4k</td>
										<td class="text-center">01/05/2018</td>
										<td class="text-right"><a href="javascript:void(0)"><i class="fa fa-external-link" aria-hidden="true"></i> ID: 44448</a></td>
									</tr>
									<tr>
										<td>Celular HP 4k</td>
										<td class="text-center">01/05/2018</td>
										<td class="text-right"><a href="javascript:void(0)"><i class="fa fa-external-link" aria-hidden="true"></i> ID: 44448</a></td>
									</tr>
									<tr>
										<td>Celular HP 4k</td>
										<td class="text-center">01/05/2018</td>
										<td class="text-right"><a href="javascript:void(0)"><i class="fa fa-external-link" aria-hidden="true"></i> ID: 44448</a></td>
									</tr>
									<tr>
										<td>Celular HP 4k</td>
										<td class="text-center">01/05/2018</td>
										<td class="text-right"><a href="javascript:void(0)"><i class="fa fa-external-link" aria-hidden="true"></i> ID: 44448</a></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class="rightcpanel">
						<h4>Historial de facturas</h4>
						<div class="table-responsive">
							<table class="table table-condensed">
								<thead>
									<tr>
										<td><strong>Articulo</strong></td>
										<td class="text-center"><strong>Pagada</strong></td>
										<td class="text-right"><strong>Enlace</strong></td>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Celular HP 4k</td>
										<td class="text-center">01/05/2018</td>
										<td class="text-right"><a href="javascript:void(0)"><i class="fa fa-external-link" aria-hidden="true"></i> ID: 44448</a></td>
									</tr>
									<tr>
										<td>Celular HP 4k</td>
										<td class="text-center">01/05/2018</td>
										<td class="text-right"><a href="javascript:void(0)"><i class="fa fa-external-link" aria-hidden="true"></i> ID: 44448</a></td>
									</tr>
									<tr>
										<td>Celular HP 4k</td>
										<td class="text-center">01/05/2018</td>
										<td class="text-right"><a href="javascript:void(0)"><i class="fa fa-external-link" aria-hidden="true"></i> ID: 44448</a></td>
									</tr>
									<tr>
										<td>Celular HP 4k</td>
										<td class="text-center">01/05/2018</td>
										<td class="text-right"><a href="javascript:void(0)"><i class="fa fa-external-link" aria-hidden="true"></i> ID: 44448</a></td>
									</tr>
									<tr>
										<td>Celular HP 4k</td>
										<td class="text-center">01/05/2018</td>
										<td class="text-right"><a href="javascript:void(0)"><i class="fa fa-external-link" aria-hidden="true"></i> ID: 44448</a></td>
									</tr>
								</tbody>
							</table>
						</div>
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