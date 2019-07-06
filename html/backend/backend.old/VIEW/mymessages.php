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
						<li><a href="myexchanges.php"><i class="fa fa-gavel" aria-hidden="true"></i> Permutas</a></li>
						<li class="active"><a href="mymessages.php"><i class="fa fa-commenting" aria-hidden="true"></i> Mensajes</a></li>
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
						<h4>Chat</h4>
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
						<h4>Listado</h4>
						<div class="table-responsive">
							<table class="table table-condensed">
								<thead>
									<tr>
										<td><strong>Tipo</strong></td>
										<td class="text-center"><strong>Objeto</strong></td>
										<td class="text-center"><strong>Leido</strong></td>
										<td class="text-center"><strong>Ultima Fecha</strong></td>
										<td class="text-right"><strong>Enlace</strong></td>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Mensaje de Compra</td>
										<td class="text-center">Celular HP 4k</td>
										<td class="text-center">No</td>
										<td class="text-center">01/05/2018</td>
										<td class="text-right"><a href="javascript:void(0)"><i class="fa fa-external-link" aria-hidden="true"></i> ID: 44448</a></td>
									</tr>
									<tr>
										<td>Mensaje de Venta</td>
										<td class="text-center">Monitor LG 45'</td>
										<td class="text-center">No</td>
										<td class="text-center">01/05/2018</td>
										<td class="text-right"><a href="javascript:void(0)"><i class="fa fa-external-link" aria-hidden="true"></i> ID: 44448</a></td>
									</tr>
									<tr>
										<td>Mensaje de Compra</td>
										<td class="text-center">Celular HP 4k</td>
										<td class="text-center">No</td>
										<td class="text-center">01/05/2018</td>
										<td class="text-right"><a href="javascript:void(0)"><i class="fa fa-external-link" aria-hidden="true"></i> ID: 44448</a></td>
									</tr>
									<tr>
										<td>Mensaje de Venta</td>
										<td class="text-center">Monitor LG 45'</td>
										<td class="text-center">No</td>
										<td class="text-center">01/05/2018</td>
										<td class="text-right"><a href="javascript:void(0)"><i class="fa fa-external-link" aria-hidden="true"></i> ID: 44448</a></td>
									</tr>
									<tr>
										<td>Mensaje de Compra</td>
										<td class="text-center">Celular HP 4k</td>
										<td class="text-center">No</td>
										<td class="text-center">01/05/2018</td>
										<td class="text-right"><a href="javascript:void(0)"><i class="fa fa-external-link" aria-hidden="true"></i> ID: 44448</a></td>
									</tr>
									<tr>
										<td>Mensaje de Venta</td>
										<td class="text-center">Monitor LG 45'</td>
										<td class="text-center">No</td>
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
