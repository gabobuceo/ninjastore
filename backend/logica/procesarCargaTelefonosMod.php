<?php
require_once('../logica/funciones.php');
require_once('../clases/Usuariotel.class.php');

// -------- GET DATA ----
$idUsu = $_SESSION['idUsuMod'];
#unset($_SESSION['idUsu']);

try {
  $conex = conectar();
  $c= new UsuarioTel($idUsu);
  $datos_c=$c->consultaTodos($conex);
  if (!empty($datos_c)){
    return $datos_c;
  }else{
    return array('this'=>'No tiene telefonos');
  }
} catch (PDOException $e) {
  return "Error: ".$e->getMessage();
  exit();
}
?>
