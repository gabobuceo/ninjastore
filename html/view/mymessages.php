<?php 
session_start();
require('definitions.php');
/*-----------------------------------------------------------------------------------------------------------*/
/* Agregar todo script, puntual para esta pagina.*/
/*-----------------------------------------------------------------------------------------------------------*/
?>
<link rel='stylesheet' href='../static/css/dataTables.bootstrap.min.css'>
<script type="text/javascript" src="../static/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../static/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#tablaventas').DataTable();
		$('#tablacompras').DataTable();
	} );
</script>
<?php 
/*-----------------------------------------------------------------------------------------------------------*/
/* Fin scripts de esta pagina.*/
/*-----------------------------------------------------------------------------------------------------------*/
/* Agregar todo control, puntual para esta pagina (Como la sesion).*/
/*-----------------------------------------------------------------------------------------------------------*/
require('header.php');
$datos_compras = require_once('../logica/procesarCargarPreguntasCompras.php');
$datos_ventas = require_once('../logica/procesarCargarPreguntasVentas.php');
var_dump($datos_compras);
echo "<hr>";
var_dump($datos_ventas);
echo "<hr>";
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
						<h4>Chat</h4>
						<?php
						if (isset($_GET['idmensaje'])) {
							$_SESSION['idmensaje']=$_GET['idmensaje'];					
							unset($_SESSION['idmensaje']);
							?>
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
							<?php
						}else{
							?>
							<div class="row">
								<div class="col-md-12 product_img">
									<p>Para cargar los mensajes haga click en su enlace</p>
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
						<h4>Compras</h4>
						<div class="table-responsive">
							<table id="tablacompras" class="table table-condensed table-striped table-bordered" cellspacing="0" width="100%">
								<thead>
									<tr>
										<td><strong>Publicacion</strong></td>
										<td class="text-center"><strong>Usuario</strong></td>
										<td class="text-center"><strong>Estado</strong></td>
										<td class="text-center"><strong>Fecha</strong></td>
										<td class="text-right"><strong>Leer</strong></td>
									</tr>
								</thead>
								<tbody>
									<?php
									for ($i=0; $i < count($datos_compras); $i++) { 
										?>
										<tr>
											<td><?php echo $datos_compras[$i]['TITULO'] ?></td>
											<td class="text-center"><?php echo $datos_compras[$i]['USUARIO'] ?></td>
											<td class="text-center"><?php echo $datos_compras[$i]['ESTADO'] ?></td>
											<td class="text-center"><?php echo date("d/m/Y H:m", strtotime($datos_compras[$i]['FECHAM'])); ?></td>
											<td class="text-right"><a href="../view/mymessages.php?idmensaje=<?php echo $datos_compras[$i]['ID'] ?>"><i class="fa fa-external-link" aria-hidden="true"></i> ID: <?php echo $datos_compras[$i]['ID'] ?></a></td>
										</tr>
										<?php
									}
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="single-page main-grid-border">
					<div class="rightcpanel">
						<h4>Ventas</h4>
						<div class="table-responsive">
							<table id="tablaventas" class="table table-condensed table-striped table-bordered" cellspacing="0" width="100%">
								<thead>
									<tr>
										<td><strong>Publicacion</strong></td>
										<td class="text-center"><strong>Usuario</strong></td>
										<td class="text-center"><strong>Estado</strong></td>
										<td class="text-center"><strong>Fecha</strong></td>
										<td class="text-right"><strong>Leer</strong></td>
									</tr>
								</thead>
								<tbody>
									<?php
									for ($i=0; $i < count($datos_ventas); $i++) { 
										?>
										<tr>
											<td><?php echo $datos_ventas[$i]['TITULO'] ?></td>
											<td class="text-center"><?php echo $datos_ventas[$i]['USUARIO'] ?></td>
											<td class="text-center"><?php echo $datos_ventas[$i]['ESTADO'] ?></td>
											<td class="text-center"><?php echo date("d/m/Y H:m", strtotime($datos_ventas[$i]['FECHAM'])); ?></td>
											<td class="text-right"><a href="../view/mymessages.php?idmensaje=<?php echo $datos_ventas[$i]['ID'] ?>"><i class="fa fa-external-link" aria-hidden="true"></i> ID: <?php echo $datos_ventas[$i]['ID'] ?></a></td>
										</tr>
										<?php
									}
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$('#tablaventas').DataTable( {
		"language": {
			"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ningún dato disponible en esta tabla",
			"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
			"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
			"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":    "",
			"sSearch":         "Buscar:",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
				"sFirst":    "Primero",
				"sLast":     "Último",
				"sNext":     "Siguiente",
				"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}
		},
		"responsive": "true",
		"select": "true",
		"buttons": [
		'copy', 'excel', 'pdf'
		]
	});
	$('#tablacompras').DataTable( {
		"language": {
			"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ningún dato disponible en esta tabla",
			"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
			"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
			"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":    "",
			"sSearch":         "Buscar:",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
				"sFirst":    "Primero",
				"sLast":     "Último",
				"sNext":     "Siguiente",
				"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}
		},
		"responsive": "true",
		"select": "true",
		"buttons": [
		'copy', 'excel', 'pdf'
		]
	});
</script>
<?php 
/*-----------------------------------------------------------------------------------------------------------*/
/* Fin contenido de esta pagina.*/
/*-----------------------------------------------------------------------------------------------------------*/
require('footer.php');
?>
