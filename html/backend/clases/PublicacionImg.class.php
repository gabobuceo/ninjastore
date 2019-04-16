<?php
require_once('../persistencia/PersistenciaPublicacionImg.class.php');
class PublicacionImg{
  private $id;
  private $imagen;
//----------------- Construct ----------------  
  function __construct($i='',$im=''){
    $this->id= $i;
    $this->imagen= $im;
  }
//----------------- METODOS SET ----------------
  public function setId($i){
    $this->id= $i;
  }

  public function setImagen($im){
    $this->imagen=$im;
  }
// -------------- METODOS GET ---------------
  public function getId(){
    return $this->id;
  }
  public function getImagen() {
    return $this->imagen;
  }
//  ----------- OTROS METODOS --------------
  public function alta($conex){
    $ppi=new PersistenciaPublicacionImg;
    return ($ppi->agregar($this, $conex));
  }
  public function baja($conex){
    $ppi=new PersistenciaPublicacionImg;
    return($ppi->eliminar($this, $conex));
  }
  public function consultaTodos($conex){
    $ppi=new PersistenciaPublicacionImg;
    $datos= $ppi->consTodos($this,$conex);
    return $datos;
  }
}
?>
