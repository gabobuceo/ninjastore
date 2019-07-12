<?php
/*
CREATE TABLE DENUNCIA(
	ID 				SERIAL 			NOT NULL,
	FECHA			TIMESTAMP 		NOT NULL DEFAULT CURRENT_TIMESTAMP,
	TIPO			VARCHAR(15) 	NOT NULL,
	IDOBJETO		BIGINT(20)		UNSIGNED NOT NULL,
	COMENTARIO 		VARCHAR(150),
	ESTADO 			VARCHAR(10) 	DEFAULT 'ABIERTA',
	BAJA			BOOLEAN			DEFAULT 0,
	PRIMARY KEY		(ID),
	INDEX			(IDOBJETO),
	CHECK			(TIPO='PUBLICACION' AND TIPO='COMENTARIO' AND TIPO='COMPRA' AND TIPO='CATEGORIAS' AND TIPO='USUARIO'),
	CHECK			(ESTADO='ABIERTA' AND ESTADO='CERRADA' AND ESTADO='EN PROCESO')
);
*/
/*require_once('../persistencia/PersistenciaNotificacion.class.php');*/
require_once('../persistencia/PersistenciaDenuncia.class.php');

class Denuncia{
	private $id;
	private $fecha;
	private $tipo;
	private $idobjeto;
	private $comentario;
	private $estado;
	private $baja;
	
	function __construct($i='', $iU='', $de='', $li='', $pu='', $ti='',$ba=''){
		$this->id= $i;
		$this->fecha= $iU;
		$this->tipo= $de;
		$this->idobjeto= $li;
		$this->comentario= $pu;
		$this->estado= $ti;
		$this->baja= $ba;
	}
	//----------------- ------------ ---------------
	//----------------- METODOS SET ----------------
	public function setId($i){
		$this->id=$i;
	}
	public function setFecha($iU){
		$this->fecha=$iU;
	}
	public function setTipo($de){
		$this->tipo= $de;
	}
	public function setIdobjeto($li){
		$this->idobjeto= $li;
	}
	public function setComentario($pu){
		$this->comentario= $pu;
	}
	public function setEstado($ti){
		$this->estado= $ti;
	}
	public function setBaja($ba){
		$this->baja=$ba;
	}
	// ----------- ------------------ -----------
	// -------------- METODOS GET ---------------
	public function getId(){
		return $this->id;
	}
	public function getFecha(){
		return $this->fecha;
	}
	public function getTipo(){
		return $this->tipo;
	}
	public function getIdobjeto(){
		return $this->idobjeto;
	}
	public function getComentario(){
		return $this->comentario;
	}
	public function getEstado(){
		return $this->estado;
	}
	public function getBaja(){
		return $this->baja;
	}
	// ----------- ----------------- -----------
	//  ----------- OTROS METODOS --------------
	public function alta($conex){
		$pu=new PersistenciaDenuncia;
		return ($pu->agregar($this, $conex));
	}
	public function baja($conex){
		$pu=new PersistenciaDenuncia;
		return($pu->eliminar($this, $conex));
	}
	public function modificacion($conex){
		$pu=new PersistenciaDenuncia;
		return($pu->modificar($this, $conex));
	}
	public function consultaTodos($conex){
		$pu=new PersistenciaDenuncia;
		$datos= $pu->consTodos($this,$conex);
		return $datos;
	}
	public function consultaUno($conex){
		$pu=new PersistenciaDenuncia;
		$datos= $pu->consUno($this,$conex);
		return $datos;
	}
	public function consultaAbiertas($conex){
		$pu=new PersistenciaDenuncia;
		$datos= $pu->consAbiertas($conex);
		return $datos;
	}
	public function consultaAsignadas($conex){
		$pu=new PersistenciaDenuncia;
		$datos= $pu->consAsignadas($this,$conex);
		return $datos;
	}
	public function consultaCerradas($conex){
		$pu=new PersistenciaDenuncia;
		$datos= $pu->consCerradas($conex);
		return $datos;
	}
	public function consultaMaxID($conex){
		$pu=new PersistenciaDenuncia;
		$datos= $pu->consMaxID($conex);
		return $datos;
	}
	
}
?>
