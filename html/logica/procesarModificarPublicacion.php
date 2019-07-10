<?php
session_start();
require_once('../logica/funciones.php');
require_once('../clases/Publicacion.class.php');
require_once('../clases/PublicacionImg.class.php');
require_once('../clases/commit.class.php');
$debug=0;
//error_reporting(1);
$imatenes="";
if (isset($_SESSION["IMAGEN"])) {
	$imatenes=$_SESSION["IMAGEN"];
}

//------------ V A L I D A C I O N E S ------------------

$error=false;
if (isset($_POST['titulopublicacion']) and !empty($_POST['titulopublicacion'])){
	$titulo = utf8_decode(strip_tags($_POST['titulopublicacion']));
}else{
	$titulo='';
	$error=true;
	$mensaje[] = "No se ingreso el Titulo"."<br/>";      
}    

$error=false;
if (isset($_POST['idpublicacion']) and !empty($_POST['idpublicacion'])){
	$idpublicacion = strip_tags($_POST['idpublicacion']);
}else{
	$idpublicacion='';
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
if (isset($_POST["options"])) {
	if ($_POST["options"] == "Nuevo"){
		$tipo="NUEVO";
	}else{
		$tipo="USADO";
	}
}else{
	$tipo='';
	$error=true;
	$mensaje[] = "No se ingreso el tipo"."<br/>";      
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
if (isset($_POST["options"])) {
	if ( $_POST["boton"] == "Actualizar"){
		$boton="Actualizar"; /* CAMBIO DE ESTADO */
	}else{
		$boton="Canelar";
	}
}else{
	$boton='';
	$error=true;
	$mensaje[] = "No se ingreso la opcion"."<br/>";      
} 

if (isset($_SESSION["IMAGEN"]) and !empty($_SESSION["IMAGEN"])){
	$imagenes = $_SESSION["IMAGEN"];
}
else{
	$imagenes='VACIO';      
} 

//------------ D E B U G ------------------
$debug=1;
if ($debug==1){
	$debugmsg ="DEBUG MODE ON <br />------------<br />id=$idpublicacion<br />titulo = $titulo<br />desc = $desc<br />precio = $precio<br />cantidad = $cantidad<br />tipo = $tipo<br />categoria = $categoria[0]<br />boton = $boton";
	/*echo $debugmsg . "<br />Imagenes<br />";
	var_dump($imagenes);
	echo "<br />Categoria<br />";
	var_dump($categoria);
	echo "<br />Post<br />";
	var_dump($_POST);
	exit();*/
}

//------------ A C C I O N E S ------------------

if ($error) {
	echo "<script>alert(\"$debugmsg\"); console.log(".var_dump($mensaje).");</script>";
}else{  
	try {          
		$conex = conectar();
		$commiteo= new Commit();
		$commiteo->AutoCommitOFF($conex);
		$commiteo->TransactionStart($conex);
		if (is_array($imagenes)) {
			$p = new Publicacion($idpublicacion,'',$categoria,$titulo,$desc,$precio,'','','','',$tipo,$cantidad,$imagenes[0]);
			if ($p->modificacion($conex)!== TRUE){
				$commiteo->Rollbackeo($conex);
			}else{
				$p = new PublicacionImg($idpublicacion);
				if ($p->baja($conex)!== TRUE){
					$commiteo->Rollbackeo($conex);
				}else{
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
						$commiteo->Commiteo($conex);	

						session_start();
						header('Location: ../view/mypublication.php');
					}
				}
			}
		}else{
			$p = new Publicacion($idpublicacion,'',$categoria,$titulo,$desc,$precio,'','','','',$tipo,$cantidad);
			if ($p->modificacion($conex)!== TRUE){
				$commiteo->Rollbackeo($conex);
			}else{
				$commiteo->Commiteo($conex);	
				session_start();
				header('Location: ../view/mypublication.php');
			}
		}
		$commiteo->AutoCommitON($conex);
	} catch (PDOException $e) {
		print "Error: ".$e->getMessage();
		exit();
	}
}
?>