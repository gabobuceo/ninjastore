<?php

require_once('../persistencia/PersistenciaFavorito.class.php');

class Favorito
{
	private $idUsuario;
	private $idPublicacion;
	
	function __construct($iU='', $iP=''){
		$this->idUsuario= $iU;
		$this->idPublicacion= $iP;
	}

	//----------------- ------------ ---------------
	//----------------- METODOS SET ----------------
	public function setIdUsuario($iU){
		$this->idUsuario=$iU;
	}
	public function setIdPublicacion($iP){
		$this->idPublicacion= $iP;
	}

	// ----------- ------------------ -----------
	// -------------- METODOS GET ---------------
	public function getIdUsuario(){
		return $this->idUsuario;
	}
	public function getIdPublicacion(){
		return $this->idPublicacion;
	}


	// ----------- ------------------ -----------
	//  ----------- OTROS METODOS --------------
	public function alta($conex){
		$pu=new PersistenciaFavorito;
		return ($pu->agregar($this, $conex));
	}
	public function baja($conex){
		$pu=new PersistenciaFavorito;
		return($pu->eliminar($this, $conex));
	}
	public function consultaTodos($conex){
		$pu=new PersistenciaFavorito;
		$datos= $pu->consTodos($this,$conex);
		return $datos;
	}
	public function consultaUno($conex){
		$pu=new PersistenciaFavorito;
		$datos= $pu->consUno($this,$conex);
		return $datos;
	}
}

?>
