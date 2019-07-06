<?php
/*
CREATE TABLE NOTIFICACION(
	ID 				SERIAL 			NOT NULL,
	USUARIO 		VARCHAR(15) 	NOT NULL,
	DESCRIPCION		TEXT			NOT NULL,
	LINK			TEXT			NOT NULL,
	TIPO 			VARCHAR(15) 	NOT NULL,
	FECHA 			DATETIME 		NOT NULL DEFAULT CURRENT_TIMESTAMP,
	VISTO			BOOLEAN			DEFAULT 0,
	BAJA			BOOLEAN			DEFAULT 0,
	PRIMARY KEY		(ID),
	CHECK			(TIPO='PREGUNTA' AND TIPO='RESPUESTA' AND TIPO='COMPRA' AND TIPO='VENTA' AND TIPO='CONFIRMADO' AND TIPO='CALIFICACION' AND TIPO='BANEADO' AND TIPO='FINALIZADO'),
	INDEX			(USUARIO)
);
*/
/*require_once('../persistencia/PersistenciaNotificacion.class.php');*/
require_once('../persistencia/PersistenciaNotificacion.class.php');

class Notificacion
{
	private $id;
	private $idUsuario;
	private $descripcion;
	private $link;
	private $publicacion;
	private $tipo;
	private $fecha;
	private $visto;
	private $baja;
	
	function __construct($i='', $iU='', $de='', $li='', $pu='', $ti='', $fe='', $vi='',$ba=''){
		$this->id= $i;
		$this->idUsuario= $iU;
		$this->descripcion= $de;
		$this->link= $li;
		$this->publicacion= $pu;
		$this->tipo= $ti;
		$this->fecha= $fe;
		$this->visto= $vi;
		$this->baja= $ba;
	}
	//----------------- ------------ ---------------
	//----------------- METODOS SET ----------------
	public function setId($i){
		$this->id=$i;
	}
	public function setIdUsuario($iU){
		$this->idUsuario=$iU;
	}
	public function setDescripcion($de){
		$this->descripcion= $de;
	}
	public function setLink($li){
		$this->link= $li;
	}
	public function setPublicacion($pu){
		$this->publicacion= $pu;
	}
	public function setTipo($ti){
		$this->tipo= $ti;
	}
	public function setFecha($fe){
		$this->fecha= $fe;
	}
	public function setVisto($vi){
		$this->visto= $vi;
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
		return $this->idUsuario;
	}
	public function getDescripcion(){
		return $this->descripcion;
	}
	public function getLink(){
		return $this->link;
	}
	public function getPublicacion(){
		return $this->publicacion;
	}
	public function getTipo(){
		return $this->tipo;
	}
	public function getFecha(){
		return $this->fecha;
	}
	public function getVisto(){
		return $this->visto;
	}
	public function getBaja(){
		return $this->baja;
	}
	// ----------- ----------------- -----------
	//  ----------- OTROS METODOS --------------
	public function alta($conex){
		$pu=new PersistenciaNotificacion;
		return ($pu->agregar($this, $conex));
	}
	public function baja($conex){
		$pu=new PersistenciaNotificacion;
		return($pu->eliminar($this, $conex));
	}
	public function modificacion($conex){
		$pu=new PersistenciaNotificacion;
		return($pu->modificar($this, $conex));
	}
	public function consultaTodos($conex){
		$pu=new PersistenciaNotificacion;
		$datos= $pu->consTodos($this,$conex);
		return $datos;
	}
	public function consultaTodosNoLeidos($conex){
		$pu=new PersistenciaNotificacion;
		$datos= $pu->consTodosNoLeidos($this,$conex);
		return $datos;
	}
	public function consultaUno($conex){
		$pu=new PersistenciaNotificacion;
		$datos= $pu->consUno($this,$conex);
		return $datos;
	}
	public function altapregunta($conex){
		$pu=new PersistenciaNotificacion;
		return ($pu->agregarpregunta($this, $conex));
	}
	public function altarespuesta($conex){
		$pu=new PersistenciaNotificacion;
		return ($pu->agregarrespuesta($this, $conex));
	}
	public function altacompra($conex){
		$pu=new PersistenciaNotificacion;
		return ($pu->agregarcompra($this, $conex));
	}
	public function altaventa($conex){
		$pu=new PersistenciaNotificacion;
		return ($pu->agregarventa($this, $conex));
	}

	public function altaconfirmadoc($conex){
		$pu=new PersistenciaNotificacion;
		return ($pu->agregarconfirmadoc($this, $conex));
	}
	public function altacalificacionc($conex){
		$pu=new PersistenciaNotificacion;
		return ($pu->agregarcalificacionc($this, $conex));
	}
	public function altaconfirmadov($conex){
		$pu=new PersistenciaNotificacion;
		return ($pu->agregarconfirmadov($this, $conex));
	}
	public function altacalificacionv($conex){
		$pu=new PersistenciaNotificacion;
		return ($pu->agregarcalificacionv($this, $conex));
	}
	public function altapermuta($conex){
		$pu=new PersistenciaNotificacion;
		return ($pu->agregarpermuta($this, $conex));
	}
	public function altapermutaaceptada($conex){
		$pu=new PersistenciaNotificacion;
		return ($pu->agregarpermutaaceptada($this, $conex));
	}
	public function altapermutacancelada($conex){
		$pu=new PersistenciaNotificacion;
		return ($pu->agregarpermutacancelada($this, $conex));
	}
	public function altabaneado($conex){
		$pu=new PersistenciaNotificacion;
		return ($pu->agregarbaneado($this, $conex));
	}
	public function altafinalizado($conex){
		$pu=new PersistenciaNotificacion;
		return ($pu->agregarfinalizado($this, $conex));
	}
	public function notificacionvisto($conex){
		$pu=new PersistenciaNotificacion;
		return ($pu->notivisto($this, $conex));
	}
}
?>
