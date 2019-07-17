<?php
session_start();
require_once('../logica/funciones.php');
require_once('../clases/Publicacion.class.php');
require_once('../clases/PublicacionImg.class.php');
require_once('../clases/commit.class.php');
$debug=0;
//error_reporting(1);
$imatenes=$_SESSION["IMAGEN"];
//------------ V A L I D A C I O N E S ------------------
$error=false;
if (isset($_POST['titulopublicacion']) and !empty($_POST['titulopublicacion'])){
	$titulo = strip_tags($_POST['titulopublicacion']);
}else{
	$titulo='';
	$error=true;
	$mensaje[] = "No se ingreso el Titulo"."<br/>";      
}    

if (isset($_POST['editor1']) and !empty($_POST['editor1'])){
	$desc = htmlspecialchars($_POST['editor1']);
	/*
		echo '<pre>';
		echo 
		echo '</pre>';
	*/
}else{
	$desc='';
	$error=true;
	$mensaje[] = "No se ingreso la Descripcion"."<br/>";      
} 

if ($_POST["options"] == "Nuevo"){
	$tipo="NUEVO";
}else{
	$tipo="USADO";
}

if (isset($_POST['categoria']) and !empty($_POST['categoria'])){
	$categoria = strip_tags($_POST['categoria']);
}else{
	$categoria='';
	$error=true;
	$mensaje[] = "No se ingreso el categoria"."<br/>";      
} 

if (isset($_POST['precio']) and !empty($_POST['precio'])){
	$precio = strip_tags($_POST['precio']);
}else{
	$precio='';
	$error=true;
	$mensaje[] = "No se ingreso el precio"."<br/>";      
} 

if (isset($_POST['quantity']) and !empty($_POST['quantity'])){
	$cantidad = strip_tags($_POST['quantity']);
}
else{
	$cantidad='';
	$error=true;
	$mensaje[] = "No se ingreso la Cantidad"."<br/>";      
} 

if ($_POST["boton"] == "Guardar"){
	$boton="BORRADOR";
}else{
	$boton="PUBLICADA";
}

if (isset($_SESSION["IMAGEN"]) and !empty($_SESSION["IMAGEN"])){
	$imagenes = $_SESSION["IMAGEN"];
}
else{
	$imagenes='';
	$error=true;
	$mensaje[] = "No se ingreso ninguna imagen"."<br/>";      
} 

//------------ D E B U G ------------------

if ($debug==1){
	$debugmsg ="DEBUG MODE ON <br />------------<br />titulo = $titulo<br />desc = $desc<br />precio = $precio<br />cantidad = $cantidad<br />optradio = $optradio<br />categoria = $categoria[0]<br />imgdef = $imagenes[0]<br />boton = $boton";
	echo $debugmsg . "<br />";
	var_dump($imagenes);
	echo "<br />";
	var_dump($categoria);
	echo "<br />";
	var_dump($_POST);
	exit();
}

//------------ A C C I O N E S ------------------

if ($error) {
	echo "<script>alert(\"$debugmsg\"); console.log(".$mensaje.");</script>";
}else{  
	try {          
		$conex = conectar();
		$commiteo= new Commit();
		$commiteo->AutoCommitOFF($conex);
		$commiteo->TransactionStart($conex);
		$p = new Publicacion('','',$categoria,$titulo,$desc,$precio,'','','',$boton,$tipo,$cantidad,$imagenes[0]);
		if ($p->alta($conex)!== TRUE){
			$commiteo->Rollbackeo($conex);
		}else{
			$obtenerID=$p->consultaMaxID($conex);
			$idpublicacion=$obtenerID[0][0];
			$i=0;
			while ($i < count($imagenes)) {
				$pi = new PublicacionImg($idpublicacion,$imagenes[$i]);
				if ($pi->alta($conex)!== TRUE){
					$i=FALSE;
					break;
				}
				$i++;
			}
			if ($i == FALSE){
				$commiteo->Rollbackeo($conex);
			}else{
				$p = new Publicacion($idpublicacion,$_SESSION['id']);
				if ($p->altacrea($conex)!== TRUE){
					$commiteo->Rollbackeo($conex);
					/*TODO MAL*/
					session_start();
					$_SESSION['mobjetivo']="cpanel.php";
					$_SESSION['mtipo']="alert-danger";
					$_SESSION['mtexto']="<strong>!Error! </strong> No se ha podido crear la publicación";
					header('Location: ../view/cpanel.php');
				}else{
					$commiteo->Commiteo($conex);	
					/*TODO PERFECT*/
					session_start();
					header('Location: ../view/publication.php?id='.$idpublicacion);
				}
			}
		}
		$commiteo->AutoCommitON($conex);
	} catch (PDOException $e) {
		print "Error: ".$e->getMessage();
		exit();
	}
}
?>