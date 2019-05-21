<?php
require_once('../logica/funciones.php');
require_once('../clases/Notificacion.class.php');
$config = include('../config/config.php');
// -------- GET DATA ----
$id = $_SESSION['NotificacionID'];

try {          
  $conex = conectar();			
  $pu= new Notificacion($id);

  //
    $datos_pu=$pu->consultaUno($conex);
    if (!empty($datos_pu)){
      if ($datos_pu[0]['VISTO']==0)
        if ($pu->notificacionvisto($conex)){
  
    echo '<script>parent.window.location.reload(true);</script>';

        }else{
          return array('this'=>'Algo Mal');    
        }
      return $datos_pu;
    }else{
      return array('this'=>'No existe la notificacion');
    }
  /*}else{
    return array('this'=>'No existe la notificacion');
  }*/
} catch (PDOException $e) {
  return "Error: ".$e->getMessage();
  exit();
}
?>

