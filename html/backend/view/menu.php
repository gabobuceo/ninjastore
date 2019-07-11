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
				<li <?php if ($_SESSION['menu']==1) { echo "class='active'"; } ?>><a href="sumary.php"><i class="fa fa-book" aria-hidden="true"></i> Inicio</a></li>
				<li <?php if ($_SESSION['menu']==2) { echo "class='active'"; } ?>><a href="mgmtusers.php"><i class="fa fa-id-card" aria-hidden="true"></i> Gestion de Usuarios</a></li>
        		<li <?php if ($_SESSION['menu']==3) { echo "class='active'"; } ?>><a href="mgmtcategories.php"><i class="fa fa-id-card" aria-hidden="true"></i> Gestion de Categorias</a></li>
				<li <?php if ($_SESSION['menu']==4) { echo "class='active'"; } ?>><a href="register.php"><i class="fa fa-shopping-bag" aria-hidden="true"></i> Gestion de Publicaciones</a></li>
				<li <?php if ($_SESSION['menu']==5) { echo "class='active'"; } ?>><a href="mymessages.php"><i class="fa fa-usd" aria-hidden="true"></i> Gestion de Ventas</a></li>
				<li <?php if ($_SESSION['menu']==6) { echo "class='active'"; } ?>><a href="myreports.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Gestion de Compras</a></li>
				<li <?php if ($_SESSION['menu']==7) { echo "class='active'"; } ?>><a href="categorysearch.php"><i class="fa fa-money" aria-hidden="true"></i> Gestion de Facturas</a></li>
				<li <?php if ($_SESSION['menu']==8) { echo "class='active'"; } ?>><a href="categoryAlta.php"><i class="fa fa-bug" aria-hidden="true"></i> Gestion de Denuncias</a></li>
			</ul>
		</div>
	</div>
</div>
