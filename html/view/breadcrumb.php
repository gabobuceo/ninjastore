<ol class="breadcrumb" style="margin-bottom: 5px;">
	<li><a href="/view/index.php">Volver a Inicio</a></li>
	<li><a href="/view/categories.php">Todas las Categorias</a></li>
	<?php
		if (isset($datos_categoria['0']['ID'])){
		?>
			<li class="active"><a href="../view/search.php?categoria=<?php echo $datos_categoria['0']['ID'] ?>"><?php echo $datos_categoria['0']['TITULO'] ?></a></li>
		<?php	
		}else if(isset($_GET['categoria'])){
			?>
			<li class="active"><a href="../view/search.php?categoria=<?php echo $_GET['categoria'] ?>"><?php echo $_SESSION['buscar'] ?></a></li>
		<?php
		}else if(isset($_SESSION['buscar'])){
			?>
			<li class="active"><?php echo $_SESSION['buscar'] ?></li>
		<?php
		}
	?>
</ol>
