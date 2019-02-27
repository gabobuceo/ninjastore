<?php
session_start();
var_dump($_SERVER);
echo "<hr>";
var_dump($_SESSION);
echo "<hr>";
var_dump($_GET);
echo "<hr>";
exit();
require_once('../logica/funciones.php');
require_once('../clases/Favorito.class.php');
// -------- GET DATA ----
$idusuario = $_SESSION['id'];
$idpublicacion = $_SESSION['PubID'];
try {          
  $conex = conectar();			
  $c= new Favorito($idusuario,$idpublicacion);
  $datos_c=$c->alta($conex);
  if (!empty($datos_c)){
    return true; 
  }else{
    return false;
  }
} catch (PDOException $e) {
  return $e;
}



ID de mi publicacion -> Verificar item Usado y Cantidad > 0
ID de Publicacion a permutar -> verificar item usado y cantidad > 0
Realizar permuta -> alta en tabla permuta estado pendiente


?>
