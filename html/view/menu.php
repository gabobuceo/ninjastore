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
				<li <?php if ($_SESSION['menu']==1) { echo "class='active'"; } ?>><a href="sumary.php"><i class="fa fa-book" aria-hidden="true"></i> Resumen</a></li>
				<li <?php if ($_SESSION['menu']==2) { echo "class='active'"; } ?>><a href="myprofile.php"><i class="fa fa-id-card" aria-hidden="true"></i> Perfil</a></li>
				<li <?php if ($_SESSION['menu']==3) { echo "class='active'"; } ?>><a href="mypublication.php"><i class="fa fa-shopping-bag" aria-hidden="true"></i> Publicaciones</a></li>
				<li <?php if ($_SESSION['menu']==4) { echo "class='active'"; } ?>><a href="mysells.php"><i class="fa fa-usd" aria-hidden="true"></i> Ventas</a></li>
				<li <?php if ($_SESSION['menu']==5) { echo "class='active'"; } ?>><a href="mybuys.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Compras</a></li>
				<li <?php if ($_SESSION['menu']==6) { echo "class='active'"; } ?>><a href="myexchanges.php"><i class="fa fa-gavel" aria-hidden="true"></i> Permutas</a></li>
				<li <?php if ($_SESSION['menu']==7) { echo "class='active'"; } ?>><a href="myfavorites.php"><i class="fa fa-heart" aria-hidden="true"></i> Favoritos</a></li>
				<li <?php if ($_SESSION['menu']==8) { echo "class='active'"; } ?>><a href="mynotifications.php"><i class="fa fa-heart" aria-hidden="true"></i> Notificaciones</a></li>
				<li <?php if ($_SESSION['menu']==9) { echo "class='active'"; } ?>><a href="mymessages.php"><i class="fa fa-commenting" aria-hidden="true"></i> Mensajes</a></li>
				<li <?php if ($_SESSION['menu']==10) { echo "class='active'"; } ?>><a href="myqualification.php"><i class="fa fa-star-half-o" aria-hidden="true"></i> Calficaciones</a></li>
				<li <?php if ($_SESSION['menu']==11) { echo "class='active'"; } ?>><a href="mybills.php"><i class="fa fa-money" aria-hidden="true"></i> Facturas</a></li>
				<li <?php if ($_SESSION['menu']==12) { echo "class='active'"; } ?>><a href="myreports.php"><i class="fa fa-bug" aria-hidden="true"></i> Denuncias</a></li>
			</ul>
		</div>
	</div>
</div>
