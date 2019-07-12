<?php
session_start();
require_once('../../logica/funciones.php');
require_once('../clases/Publicacion.class.php');
require_once('../clases/PublicacionImg.class.php');
require_once('../clases/commit.class.php');
$debug=0;
//error_reporting(1);
//------------ V A L I D A C I O N E S ------------------

$error=false;
if (isset($_POST['titulo']) and !empty($_POST['titulo'])){
	$titulo = utf8_decode(strip_tags($_POST['titulo']));
}else{
	$titulo='';
	$error=true;
	$mensaje[] = "No se ingreso el Titulo"."<br/>";      
}    

$error=false;
if (isset($_POST['idpub']) and !empty($_POST['idpub'])){
	$idpub = strip_tags($_POST['idpub']);
}else{
	$idpub='';
	$error=true;
	$mensaje[] = "No se ingreso el ID de Publicacion"."<br/>";      
} 

if (isset($_POST['editor1']) and !empty($_POST['editor1'])){
	$desc = htmlspecialchars($_POST['editor1']);
}else{
	$desc='';
	$error=true;
	$mensaje[] = "No se ingreso la Descripcion"."<br/>";      
} 
if (isset($_POST["estadoa"])) {
	if ($_POST["estadoa"] == "NUEVO"){
		$tipo="NUEVO";
	}else{
		$tipo="USADO";
	}
}else{
	$tipo='';
	$error=true;
	$mensaje[] = "No se ingreso el tipo"."<br/>";      
} 
if (isset($_POST['estadop']) and !empty($_POST['estadop'])){
	$estadop = strip_tags($_POST['estadop']);
}else{
	$estadop='';
	$error=true;
	$mensaje[] = "No se ingreso el Estado de Publicacion"."<br/>";      
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

if (isset($_POST['cantidad']) and !empty($_POST['cantidad'])){
	$cantidad = strip_tags($_POST['cantidad']);
}
else{
	$cantidad='';
	$error=true;
	$mensaje[] = "No se ingreso la Cantidad"."<br/>";      
} 
/*
if (isset($_POST["options"])) {
	if ( $_POST["boton"] == "Actualizar"){
		$boton="Actualizar"; 
	}else{
		$boton="Canelar";
	}
}else{
	$boton='';
	$error=true;
	$mensaje[] = "No se ingreso la opcion"."<br/>";      
} 
*/
/*
if (isset($_SESSION["IMAGEN"]) and !empty($_SESSION["IMAGEN"])){
	$imagenes = $_SESSION["IMAGEN"];
}
else{
	$imagenes='VACIO';      
} 
*/
//------------ D E B U G ------------------
/*$debug=1;
if ($debug==1){
	$debugmsg ="DEBUG MODE ON <br />------------<br />id=$idpublicacion<br />titulo = $titulo<br />desc = $desc<br />precio = $precio<br />cantidad = $cantidad<br />tipo = $tipo<br />categoria = $categoria[0]<br />boton = $boton";
	/*echo $debugmsg . "<br />Imagenes<br />";
	var_dump($imagenes);
	echo "<br />Categoria<br />";
	var_dump($categoria);
	echo "<br />Post<br />";
	var_dump($_POST);
	exit();
}*/
var_dump($_POST);
//exit();
//------------ A C C I O N E S ------------------

if ($error) {
	echo "<script>alert(\"$debugmsg\"); console.log(".var_dump($mensaje).");</script>";
}else{  
	try {          
		$conex = conectar();
		$commiteo= new Commit();
		$commiteo->AutoCommitOFF($conex);
		$commiteo->TransactionStart($conex);
		
		$p = new Publicacion($idpub,'',$categoria,$titulo,$desc,$precio,'','','',$estadop,$tipo,$cantidad);
		if ($p->modificacion($conex)!== TRUE){
			$commiteo->Rollbackeo($conex);
		}else{
			$commiteo->Commiteo($conex);	
			session_start();
			header('Location: ../view/mgmtpublicaciones.php?id='.$idpub);
		}
		
		$commiteo->AutoCommitON($conex);
	} catch (PDOException $e) {
		print "Error: ".$e->getMessage();
		exit();
	}
}
?>