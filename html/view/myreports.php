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
		$_SESSION['menu']=11;
		require('menu.php');
		unset($_SESSION['menu']);
		?>
	</div>
	<div class="col-sm-9 col-md-10">
		<div class="row maincpanel">
			<div class="col-md-7">
				<div class="single-page main-grid-border">
					<div class="leftcpanel">
						<h4>Denuncia</h4>
						<div class="product-mesages">
							<div class="chat_window">
								<ul class="messages">
									<li class="message left appeared">
										<div class="text_wrapper">
											<div class="text">
											Buenas, compre el producto el dia de hoy. Queria saber si puedo pasar mañana a las 16hs</div>
											<p><i class="fa fa-flag" aria-hidden="true"></i><a href="javascript:void(0)"> denunciar </a>| creado el 26/10/2017 a las 18:55 pm, Pregunta: 4584134</p>
										</div>
									</li>
									<li class="message right appeared">
										<div class="text_wrapper">
											<div class="text">
											Buenos dias, te estaremos esperando con mucho gusto. Gracias por tu compra IRL SA.</div>
											<p><i class="fa fa-flag" aria-hidden="true"></i><a href="javascript:void(0)"> denunciar </a>| creado el 26/10/2017 a las 19:0 pm, Respuesta: 4584134</p>
										</div>
									</li>
									<li class="message left appeared">
										<div class="text_wrapper">
											<div class="text">
											Buenas, compre el producto el dia de hoy. Queria saber si puedo pasar mañana a las 16hs</div>
											<p><i class="fa fa-flag" aria-hidden="true"></i><a href="javascript:void(0)"> denunciar </a>| creado el 26/10/2017 a las 18:55 pm, Pregunta: 4584134</p>
										</div>
									</li>
								</ul>
								<div class="bottom_wrapper clearfix">
									<div class="message_input_wrapper">
										<input class="message_input" placeholder="Agregar un mensaje..." />
									</div>
									<div class="send_message">
										<div class="icon">
										</div>
										<div class="text">
										Enviar</div>
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
						<h4>Denuncias abiertass</h4>
						<div class="table-responsive">
							<table class="table table-condensed">
								<thead>
									<tr>
										<td><strong>Tipo</strong></td>
										<td class="text-center"><strong>Ultimo Mensaje</strong></td>
										<td class="text-center"><strong>Fecha Actualizacion</strong></td>
										<td class="text-right"><strong>Enlace</strong></td>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Articulo</td>
										<td class="text-center">gfernandez</td>
										<td class="text-center">01/05/2018</td>
										<td class="text-right"><a href="javascript:void(0)"><i class="fa fa-external-link" aria-hidden="true"></i> ID: 44448</a></td>
									</tr>
									<tr>
										<td>Mensaje</td>
										<td class="text-center">Administrador</td>
										<td class="text-center">01/05/2018</td>
										<td class="text-right"><a href="javascript:void(0)"><i class="fa fa-external-link" aria-hidden="true"></i> ID: 44448</a></td>
									</tr>
									<tr>
										<td>Venta</td>
										<td class="text-center">Administrador</td>
										<td class="text-center">01/05/2018</td>
										<td class="text-right"><a href="javascript:void(0)"><i class="fa fa-external-link" aria-hidden="true"></i> ID: 44448</a></td>
									</tr>
									<tr>
										<td>Factura</td>
										<td class="text-center">gfernandez</td>
										<td class="text-center">01/05/2018</td>
										<td class="text-right"><a href="javascript:void(0)"><i class="fa fa-external-link" aria-hidden="true"></i> ID: 44448</a></td>
									</tr>
									<tr>
										<td>Usuario</td>
										<td class="text-center">gfernandez</td>
										<td class="text-center">01/05/2018</td>
										<td class="text-right"><a href="javascript:void(0)"><i class="fa fa-external-link" aria-hidden="true"></i> ID: 44448</a></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class="rightcpanel">
						<h4>Denuncias Cerradas</h4>
						<div class="table-responsive">
							<table class="table table-condensed">
								<thead>
									<tr>
										<td><strong>Tipo</strong></td>
										<td class="text-center"><strong>Ultimo Mensaje</strong></td>
										<td class="text-center"><strong>Fecha Actualizacion</strong></td>
										<td class="text-right"><strong>Enlace</strong></td>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Articulo</td>
										<td class="text-center">gfernandez</td>
										<td class="text-center">01/05/2018</td>
										<td class="text-right"><a href="javascript:void(0)"><i class="fa fa-external-link" aria-hidden="true"></i> ID: 44448</a></td>
									</tr>
									<tr>
										<td>Mensaje</td>
										<td class="text-center">Administrador</td>
										<td class="text-center">01/05/2018</td>
										<td class="text-right"><a href="javascript:void(0)"><i class="fa fa-external-link" aria-hidden="true"></i> ID: 44448</a></td>
									</tr>
									<tr>
										<td>Venta</td>
										<td class="text-center">Administrador</td>
										<td class="text-center">01/05/2018</td>
										<td class="text-right"><a href="javascript:void(0)"><i class="fa fa-external-link" aria-hidden="true"></i> ID: 44448</a></td>
									</tr>
									<tr>
										<td>Factura</td>
										<td class="text-center">gfernandez</td>
										<td class="text-center">01/05/2018</td>
										<td class="text-right"><a href="javascript:void(0)"><i class="fa fa-external-link" aria-hidden="true"></i> ID: 44448</a></td>
									</tr>
									<tr>
										<td>Usuario</td>
										<td class="text-center">gfernandez</td>
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