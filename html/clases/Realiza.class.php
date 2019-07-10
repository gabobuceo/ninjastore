<?php
/*
CREATE TABLE REALIZA (
	IDDENUNCIA 		BIGINT(20)		UNSIGNED NOT NULL,
	IDUSUARIO 		BIGINT(20)		UNSIGNED NOT NULL,
	BAJA			BOOLEAN			DEFAULT 0,
	PRIMARY KEY		(IDDENUNCIA,IDUSUARIO),
	FOREIGN KEY		(IDUSUARIO) REFERENCES USUARIO(ID),
	FOREIGN KEY		(IDDENUNCIA) REFERENCES DENUNCIA(ID)
);
*/
/*require_once('../persistencia/PersistenciaNotificacion.class.php');*/
require_once('../persistencia/PersistenciaRealiza.class.php');

class Realiza{
	private $iddenuncia;
	private $idusuario;
	private $baja;
	
	function __construct($i='', $iU='', $ba=''){
		$this->iddenuncia= $i;
		$this->idUsuario= $iU;
		$this->baja= $ba;
	}
	//----------------- ------------ ---------------
	//----------------- METODOS SET ----------------
	public function setIdDenuncia($i){
		$this->iddenuncia=$i;
	}
	public function setIdUsuario($iU){
		$this->idUsuario=$iU;
	}
	public function setBaja($ba){
		$this->baja=$ba;
	}
	// ----------- ------------------ -----------
	// -------------- METODOS GET ---------------
	public function getIdDenuncia(){
		return $this->iddenuncia;
	}
	public function getIdUsuario(){
		return $this->idUsuario;
	}
	public function getBaja(){
		return $this->baja;
	}
	// ----------- ----------------- -----------
	//  ----------- OTROS METODOS --------------
	public function alta($conex){
		$pu=new PersistenciaRealiza;
		return ($pu->agregar($this, $conex));
	}
	public function baja($conex){
		$pu=new PersistenciaRealiza;
		return($pu->eliminar($this, $conex));
	}
	public function modificacion($conex){
		$pu=new PersistenciaRealiza;
		return($pu->modificar($this, $conex));
	}
	public function consultaTodos($conex){
		$pu=new PersistenciaRealiza;
		$datos= $pu->consTodos($this,$conex);
		return $datos;
	}
	public function consultaUno($conex){
		$pu=new PersistenciaRealiza;
		$datos= $pu->consUno($this,$conex);
		return $datos;
	}
}
?>
