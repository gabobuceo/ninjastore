</head>
<body>

	<header>		
		<div id='store-navbar'>
			<div class='row fila'>
				<div class='col-sm-2'>
					<a href='index.php'>
						<img class='img-responsive logoempresa' src='../static/img/storefullsma.<?php echo $_SESSION['EXT']; ?>'>
					</a>
				</div>
				
				<div class='col-sm-9 store-menu'>
					<div class='navbar-right'>
						<?php
						if (isset($_SESSION['usu'])) {
							?>
							<div><span style="right">
							<ul  class="nav navbar-nav pull-right">
								<li class="dropdown pull-left">
									<a align="right" href="javascript:void(0)" class="navbar-link store-main-button dropdown-toggle " data-toggle="dropdown">
										<span align="right"class='glyphicon glyphicon-user' aria-hidden='true'></span>
										     <?php echo $_SESSION['usu']; ?> 
										 </span>
										</div>
										<b class="caret"></b>
									</a>

									<ul class="dropdown-menu">
										<li><a href="sumary.php"><i class="icon-cog"></i> Panel del Usuario</a></li>
										<li class="divider"></li>
										<li><a href="logout.php"><i class="icon-off"></i> Cerrar Sesión</a></li>
									</ul>
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