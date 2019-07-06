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
				<li <?php if ($_SESSION['menu']==2) { echo "class='active'"; } ?>><a href="myprofile.php"><i class="fa fa-id-card" aria-hidden="true"></i> Mi Perfil</a></li>
        <li <?php if ($_SESSION['menu']==3) { echo "class='active'"; } ?>><a href="profilesearch.php"><i class="fa fa-id-card" aria-hidden="true"></i> Buscar Perfil</a></li>
				<li <?php if ($_SESSION['menu']==4) { echo "class='active'"; } ?>><a href="register.php"><i class="fa fa-shopping-bag" aria-hidden="true"></i> Crear Perfil</a></li>
				<li <?php if ($_SESSION['menu']==5) { echo "class='active'"; } ?>><a href="mymessages.php"><i class="fa fa-commenting" aria-hidden="true"></i> Mensajes</a></li>
				<li <?php if ($_SESSION['menu']==6) { echo "class='active'"; } ?>><a href="myreports.php"><i class="fa fa-user-secret" aria-hidden="true"></i> Denuncias</a></li>
				<li <?php if ($_SESSION['menu']==7) { echo "class='active'"; } ?>><a href="categorysearch.php"><i class="fa fa-edit" aria-hidden="true"></i> Modificar Categoría</a></li>
				<li <?php if ($_SESSION['menu']==8) { echo "class='active'"; } ?>><a href="categoryAlta.php"><i class="fa fa-edit" aria-hidden="true"></i> Alta Categoría</a></li>
			</ul>
		</div>
	</div>
</div>
