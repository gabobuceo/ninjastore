<?php

require_once('../persistencia/PersistenciaHistorial.class.php');

class Historial
{
	private $id;
	private $usuario;
	private $accion;
	private $descripcion;
	private $baja;
	
	function __construct($i='', $u='', $a='', $d='', $b=''){
		$this->id= $i;
		$this->usuario= $u;
		$this->accion= $a;
		$this->descripcion= $d;
		$this->baja= $b;
	}
	//----------------- ------------ ---------------
	//----------------- METODOS SET ----------------
	public function setId($i){
		$this->id=$i;
	}
	public function setUsuario($u){
		$this->usuario= $u;
	}
	public function setAccion($a){
		$this->accion=$a;
	}
	public function setDescripcion($d){
		$this->descripcion= $d;
	}
	public function setBaja($b){
		$this->baja= $b;
	}
	// ----------- ------------------ -----------
	// -------------- METODOS GET ---------------
	public function getId(){
		return $this->id;
	}
	public function getUsuario(){
		return $this->usuario;
	}
	public function getAccion(){
		return $this->accion;
	}
	public function getDescripcion(){
		return $this->descripcion;
	}
	public function getBaja(){
		return $this->baja;
	}
	// ----------- ------------------ -----------
	//  ----------- OTROS METODOS --------------
	public function alta($conex){
		$pu=new PersistenciaHistorial;
		return ($pu->agregar($this, $conex));
	}
	public function baja($conex){
		$pu=new PersistenciaHistorial;
		return($pu->eliminar($this, $conex));
	}
	public function consultaTodos($conex){
		$pu=new PersistenciaHistorial;
		$datos= $pu->consTodos($this,$conex);
		return $datos;
	}
	public function consultaUno($conex){
		$pu=new PersistenciaHistorial;
		$datos= $pu->consUno($this,$conex);
		return $datos;
	}
}

?>