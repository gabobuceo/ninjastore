 <?php
 	require_once ('../logica/funciones.php');
	require_once ('../clases/Categoria.class.php');
	session_start();
 	$config = include('../config/config.php');
 	$id=trim($_GET['id'][0]); //vaya saber uno porque da array
 	$idselect=trim($_GET['idselect']);
 	$idselect++;
 	$conex=conectar();
 	$cat= new Categoria('',$id);
 	$datos_cat=$cat->consultaHijos($conex);
 	echo "<div id='selcat".$idselect."' class='col-md-3'>";
 	if (empty($datos_cat)){ 		
 		unset($_SESSION['CATEGORIA']);
 		$_SESSION['CATEGORIA'][]=$id;
 		echo "<img src='".$config->staticsrv."/images/ok.png' style='max-height: 70px;'>";
 		echo "<button onclick='btnselect(".$idselect.")' class='btn btn-primary btn-xs'><i class='fa fa-arrow-left' aria-hidden='true'>Atras</i></button>";
 	}else{
 		echo "<select id='selsel".$idselect."' multiple class='form-control' onclick='addselect(".$idselect.")'>";
 		echo "<option onclick='remselect(".$idselect.")'>Atras</option>'";
 		for ($i=0;$i<count($datos_cat);$i++) {
 		echo "<option onclick='addselect(".$idselect.")' value='".$datos_cat[$i]["ID"]."'>".$datos_cat[$i]["TITULO"]."</option>'";
 		}
 		echo "</select>";
 	}
 	echo "</div>";
 ?>