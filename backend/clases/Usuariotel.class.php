<?php
require_once('../persistencia/PersistenciaUsuarioTel.class.php');
class UsuarioTel{
  private $id;
  private $telefono;
//----------------- Construct ----------------  
  function __construct($i='',$te=''){
    $this->id= $i;
    $this->telefono= $te;
  }
//----------------- METODOS SET ----------------
  public function setId($i){
    $this->id= $i;
  }

  public function setTelefono($te){
    $this->telefono=$te;
  }
// -------------- METODOS GET ---------------
  public function getId(){
    return $this->id;
  }
  public function getTelefono() {
    return $this->telefono;
  }
//  ----------- OTROS METODOS --------------
  public function alta($conex){
    $put=new PersistenciaUsuarioTel;
    return ($put->agregar($this, $conex));
  }
  public function baja($conex){
    $put=new PersistenciaUsuarioTel;
    return($put->eliminar($this, $conex));
  }
  public function consultaTodos($conex){
    $put=new PersistenciaUsuarioTel;
    $datos= $put->consTodos($this,$conex);
    return $datos;
  }

}
?>
