<?php
require_once('../../logica/funciones.php');
require_once('../clases/Usuario.class.php');
require_once('../clases/Usuariotel.class.php');
$config = include('../config/config.php');
// -------- GET DATA ----

try {          
  $conex = conectar();      
  $pu= new Usuario($_SESSION['id']);
  $datos_pu=$pu->consultaPerfil($conex);
  $pu= new UsuarioTel($_SESSION['id']);
  $datos_pt=$pu->consultaTodos($conex);
  if (is_null($datos_pu[0]['PNOMBRE']) ||  is_null($datos_pu[0]['PAPELLIDO']) ||  is_null($datos_pu[0]['FNACIMIENTO']) ||  is_null($datos_pu[0]['EMAIL']) ||  is_null($datos_pu[0]['CALLE']) ||  is_null($datos_pu[0]['NUMERO']) || is_null($datos_pu[0]['ESQUINA']) ||  is_null($datos_pu[0]['CPOSTAL']) ||  is_null($datos_pu[0]['LOCALIDAD']) ||  is_null($datos_pu[0]['DEPARTAMENTO']) ||  is_null($datos_pu[0]['GEOX']) ||  is_null($datos_pu[0]['GEOY']) || count($datos_pt)==0) {
    return false;
  }else{
    return true;
  }
} catch (PDOException $e) {
  return "Error: ".$e->getMessage();
  exit();
}
?>