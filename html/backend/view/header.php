	</head>
	<body>
		<header>
			<div id='store-navbar'>
				<div class='row fila'>
					<div class='col-sm-2'>
						<a href='index.php'>
							<img  class='img-responsive logoempresa' src='../static/img/storefullsma.<?php echo $_SESSION['EXT']; ?>'>
						</a>
					</div>
					<div class='col-sm-9 store-menu'>
						<div class='navbar-right'>
							<?php
							if (isset($_SESSION['usubk'])) {
								?>
								<div>
									<ul  class="nav navbar-nav pull-right">
										<li class="dropdown pull-right">
											<a align="right" href="javascript:void(0)" class="navbar-link store-main-button dropdown-toggle " data-toggle="dropdown">
												<span align="right" class='glyphicon glyphicon-user' aria-hidden='true'></span>
												<?php echo $_SESSION['usubk']; ?> <b class="caret"></b>
												<ul class="dropdown-menu">
													<li><a href="sumary.php"> <i class='glyphicon glyphicon-user'></i> Inicio</a></li>
													<li class="divider"></li>
													<li><a href="logout.php"><i class="icon-off"></i> Cerrar Sesión</a></li>
												</ul>
											</div>  											
										</p>
										<?php
									}else{
										?>
										<body>
											<a href='login.php' class='navbar-link store-main-button'>
												<span class='glyphicon glyphicon-user' aria-hidden='true'></span>
												Entrar
											</a>
										</body>
										<?php
									}
									?>
								</div>
							</div>
						</div>
					</div>
				</header>
