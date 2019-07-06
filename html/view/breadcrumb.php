<ol class="breadcrumb" style="margin-bottom: 5px;">
	<li><a href="../view/index.php">Volver a Inicio</a></li>
	<li><a href="../view/categories.php">Todas las Categorias</a></li>
	<?php
	if (isset($datos_categoria['0']['ID'])){
		if ($datos_categoria['0']['IDPADRE'] != "1"){
			?>
			<li class="active"><a href="../view/search.php?categoria=<?php echo $datos_categoria['0']['IDPADRE'] ?>"><?php echo utf8_encode($datos_categoria['0']['TITULOPADRE']) ?></a></li>
			<?php
		}
		?>
		<li class="active"><a href="../view/search.php?categoria=<?php echo $datos_categoria['0']['ID'] ?>"><?php echo utf8_encode($datos_categoria['0']['TITULO']) ?></a></li>
		<?php	
	}else if(isset($_GET['categoria'])){
		?>
		<li class="active"><a href="../view/search.php?categoria=<?php echo utf8_encode($_GET['categoria']) ?>"><?php echo utf8_encode($_SESSION['buscar']) ?></a></li>
		<?php
	}else if(isset($_SESSION['buscar'])){
		?>
		<li class="active"><?php echo utf8_encode($_SESSION['buscar']) ?></li>
		<?php
	}
	?>
</ol>