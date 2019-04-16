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
		<div class="sidebar-nav">
			<div class="navbar navbar-default" role="navigation">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<span class="visible-xs navbar-brand">Panel de control del Usuario</span>
				</div>
				<div class="navbar-collapse collapse sidebar-navbar-collapse">
					<ul class="nav navbar-nav" id="sidenav01">
						<li><a href="sumary.php"><h4><i class="fa fa-book" aria-hidden="true"></i> Resumen</h4></a></li>
						<li><a href="myprofile.php"><i class="fa fa-id-card" aria-hidden="true"></i> Perfil</a></li>
						<li><a href="mypublication.php"><i class="fa fa-shopping-bag" aria-hidden="true"></i> Publicaciones</a></li>
						<li><a href="mybuys.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Compras</a></li>
						<li class="active"><a href="myexchanges.php"><i class="fa fa-gavel" aria-hidden="true"></i> Permutas</a></li>
						<li><a href="mymessages.php"><i class="fa fa-commenting" aria-hidden="true"></i> Mensajes</a></li>
						<li><a href="myqualification.php"><i class="fa fa-star-half-o" aria-hidden="true"></i> Calficaciones</a></li>
						<li><a href="mybills.php"><i class="fa fa-money" aria-hidden="true"></i> Facturas</a></li>
						<li><a href="myreports.php"><i class="fa fa-bug" aria-hidden="true"></i> Denuncias</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-9 col-md-10">
		<div class="row maincpanel">
			<div class="col-md-7">
				<div class="single-page main-grid-border">
					<div class="leftcpanel">
						<h4>Permutas</h4>
						<div class="row">
							<div class="col-md-6 product_img">
								<img src="images/ss1.jpg" class="img-responsive">
							</div>
							<div class="col-md-6 product_content cppermuta">
								<h4 class="lestitle">Articulo: <span class="subtitle">Celular Full hd 4k</span></h4>
								<h4 class="lestitle">Ofertante: <span class="subtitle">Gabriel Fernandez</span></h4>
								<div class="rating">
									<i class="fa fa-star" aria-hidden="true"></i>
									<i class="fa fa-star" aria-hidden="true"></i>
									<i class="fa fa-star" aria-hidden="true"></i>
									<i class="fa fa-star-half-o" aria-hidden="true"></i>
									<i class="fa fa-star-o" aria-hidden="true"></i>
									(10 Calificaciones)
								</div>
								<p><strong>Se vende</strong>: Celular Samsung Galaxy Note II</p>
								<p><strong>Display</strong>: 1.5 pugadas HD LCD Touch Screen</p>
								<p><strong>Resumen</strong>: Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla .</p>
								<h3 class="cost lestitle">Subtotal: <span class="subtitle"><i class="fa fa-usd" aria-hidden="true"></i><span id="subtotal">75</span></span></h3>
								<div class="space-ten"></div>
							</div>
						</div>
						<h4>A cambio de:</h4>
						<div class="row">
							<div class="col-md-6 product_img">
								<img src="images/ss1.jpg" class="img-responsive">
							</div>
							<div class="col-md-6 product_content cppermuta">
								<h4 class="lestitle">Articulo: <span class="subtitle">Celular Full hd 4k</span></h4>
								<h4 class="lestitle">Vendedor: <span class="subtitle">Gabriel Fernandez</span></h4>
								<div class="rating">
									<i class="fa fa-star" aria-hidden="true"></i>
									<i class="fa fa-star" aria-hidden="true"></i>
									<i class="fa fa-star" aria-hidden="true"></i>
									<i class="fa fa-star-half-o" aria-hidden="true"></i>
									<i class="fa fa-star-o" aria-hidden="true"></i>
									(10 Calificaciones)
								</div>
								<p><strong>Se vende</strong>: Celular Samsung Galaxy Note II</p>
								<p><strong>Display</strong>: 1.5 pugadas HD LCD Touch Screen</p>
								<p><strong>Resumen</strong>: Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla .</p>
								<h3 class="cost lestitle">Subtotal: <span class="subtitle"><i class="fa fa-usd" aria-hidden="true"></i><span id="subtotal">75</span></span></h3>
								<div class="space-ten"></div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 product_img">
								<div class="btn-ground">
									<div class="buy-in-form">
										<form action="buyconfirmation.php" method="POST">						
											<input type="submit" value="Aceptar">
										</form>	
									</div>
								</div>
							</div>
							<div class="col-md-6 product_img">
								<div class="btn-ground">
									<div class="buy-in-form">
										<form action="buyconfirmation.php" method="POST">						
											<input type="submit" value="Cancelar">
										</form>	
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-5">
				<div class="single-page main-grid-border">
					<div class="rightcpanel">
						<h4>Abiertas</h4>
						<div class="table-responsive">
							<table class="table table-condensed">
								<thead>
									<tr>
										<td><strong>Item Ofertado</strong></td>
										<td class="text-center"><strong>Item Ofertante</strong></td>
										<td class="text-center"><strong>Fecha Oferta</strong></td>
										<td class="text-right"><strong>Enlace</strong></td>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Monitor LG 45''</td>
										<td class="text-center">Celular hd4k</td>
										<td class="text-center">01/05/2018</td>
										<td class="text-right"><a href="javascript:void(0)"><i class="fa fa-external-link" aria-hidden="true"></i> ID: 44448</a></td>
									</tr>
									<tr>
										<td>Monitor LG 45''</td>
										<td class="text-center">Celular hd4k</td>
										<td class="text-center">01/05/2018</td>
										<td class="text-right"><a href="javascript:void(0)"><i class="fa fa-external-link" aria-hidden="true"></i> ID: 44448</a></td>
									</tr>
									<tr>
										<td>Monitor LG 45''</td>
										<td class="text-center">Celular hd4k</td>
										<td class="text-center">01/05/2018</td>
										<td class="text-right"><a href="javascript:void(0)"><i class="fa fa-external-link" aria-hidden="true"></i> ID: 44448</a></td>
									</tr>
									<tr>
										<td>Monitor LG 45''</td>
										<td class="text-center">Celular hd4k</td>
										<td class="text-center">01/05/2018</td>
										<td class="text-right"><a href="javascript:void(0)"><i class="fa fa-external-link" aria-hidden="true"></i> ID: 44448</a></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class="rightcpanel">
						<h4>Cerradas</h4>
						<div class="table-responsive">
							<table class="table table-condensed">
								<thead>
									<tr>
										<td><strong>Item Ofertado</strong></td>
										<td class="text-center"><strong>Item Ofertante</strong></td>
										<td class="text-center"><strong>Fecha Oferta</strong></td>
										<td class="text-right"><strong>Enlace</strong></td>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Monitor LG 45''</td>
										<td class="text-center">Celular hd4k</td>
										<td class="text-center">01/05/2018</td>
										<td class="text-right"><a href="javascript:void(0)"><i class="fa fa-external-link" aria-hidden="true"></i> ID: 44448</a></td>
									</tr>
									<tr>
										<td>Monitor LG 45''</td>
										<td class="text-center">Celular hd4k</td>
										<td class="text-center">01/05/2018</td>
										<td class="text-right"><a href="javascript:void(0)"><i class="fa fa-external-link" aria-hidden="true"></i> ID: 44448</a></td>
									</tr>
									<tr>
										<td>Monitor LG 45''</td>
										<td class="text-center">Celular hd4k</td>
										<td class="text-center">01/05/2018</td>
										<td class="text-right"><a href="javascript:void(0)"><i class="fa fa-external-link" aria-hidden="true"></i> ID: 44448</a></td>
									</tr>
									<tr>
										<td>Monitor LG 45''</td>
										<td class="text-center">Celular hd4k</td>
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