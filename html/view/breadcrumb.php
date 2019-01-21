<ol class="breadcrumb" style="margin-bottom: 5px;">
	<li><a href="index.html">Volver a Inicio</a></li>
	<li><a href="/view/search.php">Todas las Categorias</a></li>
	<?php
		if (isset($datos_categoria['0']['ID'])){
		?>
			<li class="active"><a href="/view/search.php?categoria=<?php echo $datos_categoria['0']['ID'] ?>"><?php echo $datos_categoria['0']['TITULO'] ?></a></li>
		<?php	
		}
	?>
</ol>