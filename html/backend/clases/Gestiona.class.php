<?php
/*
CREATE TABLE GESTIONA(
	ID 	SERIAL NOT NULL,
	IDUSUARIO 		BIGINT(20)		UNSIGNED NOT NULL,
	IDDENUNCIA 		BIGINT(20)		UNSIGNED NOT NULL,
	FECHA 			DATETIME 		NOT NULL,
	DESCRIPCION 	TEXT,
	HTML 			TEXT,
	BAJA			BOOLEAN			DEFAULT 0,
	PRIMARY KEY		(IDUSUARIO,IDDENUNCIA),
	FOREIGN KEY		(IDUSUARIO) REFERENCES USUARIO(ID),
	FOREIGN KEY		(IDDENUNCIA) REFERENCES DENUNCIA(ID)
);
*/
require_once('../persistencia/PersistenciaGestiona.class.php');

class Gestiona
{
	private $id;
	private $idusuario;
	private $iddenuncia;
	private $fecha;
	private $descripcion;
	private $html;
	private $baja;
	
	function __construct($i='', $iU='', $de='', $li='', $pu='', $ti='', $ba=''){
		$this->id= $i;
		$this->idusuario= $iU;
		$this->iddenuncia= $de;
		$this->fecha= $li;
		$this->descripcion= $pu;
		$this->html= $ti;
		$this->baja= $ba;
	}
	//----------------- ------------ ---------------
	//----------------- METODOS SET ----------------
	public function setId($i){
		$this->id=$i;
	}
	public function setIdUsuario($iU){
		$this->idusuario=$iU;
	}
	public function setDenuncia($de){
		$this->iddenuncia= $de;
	}
	public function setFecha($li){
		$this->fecha= $li;
	}
	public function setDescripcion($pu){
		$this->descripcion= $pu;
	}
	public function setHtml($ti){
		$this->html= $ti;
	}
	public function setBaja($ba){
		$this->baja=$ba;
	}
	// ----------- ------------------ -----------
	// -------------- METODOS GET ---------------
	public function getId(){
		return $this->id;
	}
	public function getIdUsuario(){
		return $this->idusuario;
	}
	public function getDenuncia(){
		return $this->iddenuncia;
	}
	public function getFecha(){
		return $this->fecha;
	}
	public function getDescripcion(){
		return $this->descripcion;
	}
	public function getHtml(){
		return $this->html;
	}
	public function getBaja(){
		return $this->baja;
	}
	// ----------- ----------------- -----------
	//  ----------- OTROS METODOS --------------
	public function alta($conex){
		$pu=new PersistenciaGestiona;
		return ($pu->agregar($this, $conex));
	}
	public function baja($conex){
		$pu=new PersistenciaGestiona;
		return($pu->eliminar($this, $conex));
	}
	public function modificacion($conex){
		$pu=new PersistenciaGestiona;
		return($pu->modificar($this, $conex));
	}
	public function consultaTodos($conex){
		$pu=new PersistenciaGestiona;
		$datos= $pu->consTodos($this,$conex);
		return $datos;
	}
	public function consultaUno($conex){
		$pu=new PersistenciaGestiona;
		$datos= $pu->consUno($this,$conex);
		return $datos;
	}
	public function consultaAsignado($conex){
		$pu=new PersistenciaGestiona;
		$datos= $pu->consAsignado($this,$conex);
		return $datos;
	}
}
?>
