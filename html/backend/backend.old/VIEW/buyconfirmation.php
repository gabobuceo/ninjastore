<?php 
require('definitions.php');
/*-----------------------------------------------------------------------------------------------------------*/
/* Agregar todo script, puntual para esta pagina.*/
/*-----------------------------------------------------------------------------------------------------------*/
?>
<script>
	function myMap() {
		var uluru = {lat: -34.892063, lng: -56.122261};
		var map = new google.maps.Map(document.getElementById('googleMap'), {
			zoom: 15,
			center: uluru
		});
		var marker = new google.maps.Marker({
			position: uluru,
			map: map
		});
	}
	function myNavFunc(){
		if( (navigator.platform.indexOf("iPhone") != -1) 
			|| (navigator.platform.indexOf("iPod") != -1)
			|| (navigator.platform.indexOf("iPad") != -1))
			window.open("maps://maps.google.com/maps?daddr=-34.892063,-56.122261&amp;ll=");
		else
			window.open("http://maps.google.com/maps?daddr=-34.892063,-56.122261&amp;ll=");
	}
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
			<div class="sign-in-form">
				<div class="sign-in-form-top">
					<h1>Felicidades su compra se ha generado</h1>
				</div>
				<div class="signin">
					<div class="buyingdata">
						<h4>Datos de la Compra</h4>
						<div class="row">
							<div class="col-xs-12">
								<p><b>Producto: </b> Titulo de prueba de un producto test</p>
								<p><b>Cantidad: </b> 1 unidad</p>
								<p><b>Total: $</b>75</p>
							</div>
						</div>
					</div>			
					<div class="buyingdata">
						<h4>Datos del Vendedor</h4>
						<div class="row">
							<div class="col-xs-12">
								<p><b>Nombre Completo: </b>Gabriel Fernando Fernandez Safi</p>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12">
								<p><b>Email: </b><a href="mailto:gabriel@gfernandez.uy">gabriel@gfernandez.uy</a></p>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12">
								<p><b>Dirección: </b>Dalmiro Costa 4331</p>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12">
								<p><b>Esquina: </b>Resistencia y Lallemand</p>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12">
								<p><b>Localidad: </b>Montevideo, Uruguay. CP: 11400</p>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12">
								<p><b>Telefonos: </b><a href="tel:26194388">26194388</a> / <a href="tel:094606280">094606280</a></p>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12">
								<p><b>Ubicación: </b><a onclick="myNavFunc()"><i class="fa fa-location-arrow" aria-hidden="true"></i> Llevarme ahi</a></p>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12">
								<div id="googleMap" style="width:100%;height:400px;"></div>
							</div>
						</div>
					</div>
					<h4>Chat de Venta</h4>
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
									<input class="message_input" placeholder="Pregunta algo..." />
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
					<div class="buyingdata">
						<h4>Datos de la venta</h4>
						<div class="row">
							<div class="col-xs-12">
								<form action="buyconfirmation.php?conf=yes" method="GET">						
									<input type="submit" value="Confirmar venta">
								</form>	
							</div> 
						</div>
						<div class="row">
							<div class="col-xs-6 text-center">
								<p><b>Estado de la venta</b></p>
								<p><i class="fa fa-times-circle-o" style="color: var(--Terciario);" aria-hidden="true"></i> No confirmada</p>
							</div>
							<div class="col-xs-6 text-center">
								<p><b>Calificacion de la venta</b></p>
								<p>No calificada</p>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-6 text-center">
								<p><b>Estado de la venta</b></p>
								<p><i class="fa fa-check-circle-o" style="color: var(--Principal);" aria-hidden="true"></i> Confirmada</p>
							</div>
							<div class="col-xs-6 text-center">
								<p><b>Calificacion de la venta</b></p>
								<p>No calificada</p>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-6 text-center">
								<p><b>Estado de la venta</b></p>
								<p><i class="fa fa-check-circle-o" style="color: var(--Principal);" aria-hidden="true"></i> Confirmada</p>
							</div>
							<div class="col-xs-6 text-center">
								<p><b>Calificacion de la venta</b></p>
								<p>
									<i class="fa fa-star" style="color: var(--Principal);" aria-hidden="true"></i>
									<i class="fa fa-star" style="color: var(--Principal);" aria-hidden="true"></i>
									<i class="fa fa-star-half-o" style="color: var(--Secundario);" aria-hidden="true"></i>
									<i class="fa fa-star-o" style="color: var(--Terciario);" aria-hidden="true"></i>
									<i class="fa fa-star-o" style="color: var(--Terciario);" aria-hidden="true"></i>
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- ::::::::::::::  FIN LOGIN  :::::::::::::: -->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAR1MVvIOfmAGOlAqC1WnJ6f-G6Irn-cEc&callback=myMap"></script>
	<?php 
	/*-----------------------------------------------------------------------------------------------------------*/
	/* Fin contenido de esta pagina.*/
	/*-----------------------------------------------------------------------------------------------------------*/
	require('footer.php');
	?>