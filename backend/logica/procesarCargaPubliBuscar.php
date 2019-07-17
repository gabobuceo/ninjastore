<?php
require_once('../logica/funciones.php');
require_once('../clases/Publicacion.class.php');
$config = include('../config/config.php');
// -------- GET DATA ----

try {          
  $conex = conectar();			
  /*
  $datos_pu=$pu->consultaPublicacionesBuscar($conex);
  if (!empty($datos_pu)){
    return $datos_pu;
  }else{
    return array('this'=>'Vacio');
  }*/
  $a = explode(" ", trim($_SESSION['buscar']));
  $b=null;
  foreach ($a as $clave => $valor) {

    //print_r($valor);
    //echo "<br>";
    if (textovalido($valor)) {
      $b[]=trim($valor);
    }
    //echo "Se ingreso $valor --> Resultado ".$_SESSION['eee'];
    //print_r($_SESSION['eee']);
  }
  $sqlfinal=null;
  if (count($b)<1) {
    return array('this'=>'Vacio');
  }else{
    if (count($b)<2) {
      $sqlfinal="SELECT * FROM (
      SELECT * FROM (
      SELECT * FROM DATOS_PRODUCTO_INDEX WHERE TITULO LIKE CONCAT('%".$b[0]."%')) as t 
      WHERE TITULO LIKE CONCAT('%".$b[0]."%')) as tt 
      WHERE TITULO LIKE CONCAT('%".$b[0]."%')";
    }else{
      for ($i=0; $i < count($b); $i++) { 
        $sqlfinal=$sqlfinal."SELECT * FROM (
        SELECT * FROM (
        SELECT * FROM DATOS_PRODUCTO_INDEX WHERE TITULO LIKE CONCAT('%".$b[$i]."%')) as t 
        WHERE TITULO LIKE CONCAT('%".$b[$i]."%')) as tt 
        WHERE TITULO LIKE CONCAT('%".$b[$i]."%')";
        if ($i!=count($b)-1) {
          $sqlfinal=$sqlfinal." UNION ";
        }
      }
    }
    $pu= new publicacion('','','',$sqlfinal);
    $datos_pu=$pu->consultaPublicacionesBuscar($conex);
    if (!empty($datos_pu)){
      return $datos_pu;
    }else{
      return array('this'=>'Vacio');
    }
  }
/*echo "<br>";
  print_r($b);
  echo "<br>";
  print_r($clave);
  echo "<br>";
 /* for ($i=0; $i < ; $i++) { 
    
 }*/
 print_r($sqlfinal);
  /*

SELECT * FROM (
  SELECT * FROM (
    SELECT * FROM DATOS_PRODUCTO_INDEX WHERE TITULO LIKE CONCAT('%Ca%')) as t 
  WHERE TITULO LIKE CONCAT('%pr%')) as tt 
WHERE TITULO LIKE CONCAT('%img%')





  */
} catch (PDOException $e) {
  return "Error: ".$e->getMessage();
  exit();
}
?>