<?php
session_start();
require('definitions.php');
/*-----------------------------------------------------------------------------------------------------------*/
/* Agregar todo script, puntual para esta pagina.*/
/*-----------------------------------------------------------------------------------------------------------*/
?>
<link rel='stylesheet' href='../../static/css/jquery.dataTables.min.css'>
<link rel='stylesheet' href='../../static/css/marcaagua.css'>
<script type="text/javascript" src="../../static/js/canvasjs.min.js"></script>

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
						<li class="active"><a href="index.php"><h4><i class="fa fa-book" aria-hidden="true"></i> Resumen</h4></a></li>
						<li><a href="myprofile.php"><i class="fa fa-id-card" aria-hidden="true"></i> Perfil</a></li>
						<li><a href="mypublication.php"><i class="fa fa-shopping-bag" aria-hidden="true"></i> Publicaciones</a></li>
						<li><a href="mybuys.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Compras</a></li>
						<li><a href="myexchanges.php"><i class="fa fa-gavel" aria-hidden="true"></i> Permutas</a></li>
						<li><a href="mymessages.php"><i class="fa fa-commenting" aria-hidden="true"></i> Mensajes</a></li>
						<li><a href="myqualification.php"><i class="fa fa-star-half-o" aria-hidden="true"></i> Calficaciones</a></li>
						<li><a href="mybills.php"><i class="fa fa-money" aria-hidden="true"></i> Facturas</a></li>
						<li><a href="myreports.php"><i class="fa fa-bug" aria-hidden="true"></i> Denuncias</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<body>
		<br>
		<br>
		<br>
		<br>
		<br>
			<center> <img src="../../static/img/fondoopacidad.png" alt="Paris" class="imageness">
		</div>
		</body>

	
<?php
/*-----------------------------------------------------------------------------------------------------------*/
/* Fin contenido de esta pagina.*/
/*-----------------------------------------------------------------------------------------------------------*/
require('footer.php');
?>
