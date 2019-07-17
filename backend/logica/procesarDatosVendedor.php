<?php
require_once ('../logica/funciones.php');
require_once('../clases/Publicacion.class.php');
require_once('../clases/Usuario.class.php');
$config = include('../config/config.php');
// -------- GET DATA ----
$idpublicacion = $_SESSION['PubID'];
// Obtener en base al idpublicacion consultar en crea y obtener la id del usuario. Luego ejecutar un selec en la vista para obtener los otros 4 datos que son necesarios para datos del usuario
//usuario($id,$cedula,$usuario,$password,$pNombre,$sNombre,$pApellido,$sApellido,$fNacimiento,$email,$calle,$numero,$esquina,$cPostal,$localidad,$departamento,$tipo,$estado,$rol,$passwordadm,$activacion,$baja)
//publicacion($id,$idUsuario,$idCategoria,$titulo,$descripcion,$precio,$oferta,$descuento,$fOferta,$estadoP,$estadoA,$cantidad,$imgdef,$visto,$baja)

try {          
  $conex = conectar();			
  $p= new Publicacion($idpublicacion);
  $datos_p=$p->consultaFecha($conex);
  if (!empty($datos_p)){
    $u= new Usuario($datos_p['0']['IDUSUARIO']);
    $datos_u=$u->consultaDatosVendedor($conex);
    return $datos_u;
  }else{
    return array('this'=>'No existe la publicacion');
  }
} catch (PDOException $e) {
  return "Error: ".$e->getMessage();
  exit();
}
?>

