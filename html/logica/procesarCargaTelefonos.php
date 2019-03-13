<?php
require_once('../logica/funciones.php');
require_once('../clases/Usuariotel.class.php');
// -------- GET DATA ----
$id = $_SESSION['IDVENDEDOR'];
unset($_SESSION['IDVENDEDOR']);
try {          
  $conex = conectar();      
  $c= new UsuarioTel($id);
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