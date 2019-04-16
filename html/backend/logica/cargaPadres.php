<?php
require_once('../logica/funciones.php');
require_once('../clases/Categoria.class.php');

function getPadres(){
	try {
		$conex=conectar();
		$cat= new Categoria();
		$datos_cat=$cat->consultaPadres($conex);
	
	} catch (Exception $e) {
		print "Error: ".$e->getMessage();
		exit();
	}
	die(var_dump($datos_cat));
	$padres = '<option value="0">Elige una opción</option>';
	while($row = $datos_cat){
		$padres .= "<option value='$row[ID]'>'$row[TITULO]'</option>";
	}
	return $padres;
}

//echo getPadres();