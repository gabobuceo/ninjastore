<?php
require_once('../persistencia/PersistenciaCalificacion.class.php');

/*
CREATE TABLE CALIFICACION(
	ID 				SERIAL 		NOT NULL,
	IDCOMPRA		BIGINT(20)	UNSIGNED NOT NULL,
	IDUSUARIO		BIGINT(20)	UNSIGNED NOT NULL,
	IDPUBLICACION	BIGINT(20)	UNSIGNED NOT NULL,
	FECHA 			TIMESTAMP 	NOT NULL DEFAULT CURRENT_TIMESTAMP,
	CALIFICACION 	INT 		NOT NULL,
	MENSAJE 		TEXT 		NOT NULL,
	BAJA			BOOLEAN		DEFAULT 0,
	PRIMARY KEY		(ID,IDCOMPRA,IDUSUARIO,IDPUBLICACION),
	FOREIGN KEY		(IDCOMPRA) REFERENCES COMPRA(ID),
	FOREIGN KEY		(IDUSUARIO) REFERENCES USUARIO(ID),
	FOREIGN KEY		(IDPUBLICACION) REFERENCES PUBLICACION(ID),
	CHECK			(CALIFICACION='1' AND CALIFICACION='2' AND CALIFICACION='3' AND CALIFICACION='4' AND CALIFICACION='5')
);
*/

class Calificacion{
	private $id;
	private $idCompra;
	private $idUsuario;
	private $idPublicacion;
	private $fecha;
	private $calificacion;
	private $mensaje;
	private $baja;

	function __construct($id='',$ic='',$iu='',$ip='',$fe='',$ca='',$me='',$ba=''){
		$this->id= $id;
		$this->idCompra= $ic;
		$this->idUsuario= $iu;
		$this->idPublicacion= $ip;
		$this->fecha= $fe;
		$this->calificacion= $ca;
		$this->mensaje= $me;
		$this->baja= $ba;
	}

	//----------------- ------------ ---------------
	//----------------- METODOS SET ----------------

	public function setId($id){
		$this->id= $id;
	}

	public function setIdCompra($ic){
		$this->idCompra= $ic;
	}
	public function setIdUsuario($iu){
		$this->idUsuario= $iu;
	}
	public function setIdPublicacion($ip){
		$this->idPublicacion= $ip;
	}
	public function setFecha($fe){
		$this->fecha= $fe;
	}
	public function setCalificacion($ca){
		$this->calificacion= $ca;
	}
	public function setMensaje($me){
		$this->mensaje= $me;
	}
	public function setBaja($ba){
		$this->baja=$ba;
	}

	// ----------- ------------------ -----------
	// -------------- METODOS GET ---------------

	public function getId(){
		return $this->id;
	}

	public function getIdCompra(){
		return $this->idCompra;
	}
	public function getIdUsuario(){
		return $this->idUsuario;
	}
	public function getIdPublicacion(){
		return $this->idPublicacion;
	}
	public function getFecha(){
		return $this->fecha;
	}
	public function getCalificacion(){
		return $this->calificacion;
	}
	public function getMensaje(){
		return $this->mensaje;
	}
	public function getBaja(){
		return $this->baja;
	}

	// ----------- ------------------ -----------
	//  ----------- OTROS METODOS --------------
	public function alta($conex){
        $pu=new PersistenciaCalificacion;
        return ($pu->agregar($this, $conex));
    }
	public function consultaTodos($conex){
		$cat=new PersistenciaCalificacion;
		$datos= $cat->consTodos($conex);
		return $datos;
	}

	public function consultaUno($conex){
		$cat=new PersistenciaCalificacion;
		$datos= $cat->consUno($this,$conex);
		return $datos;
	}
	public function consultaVentas($conex){
		$cat=new PersistenciaCalificacion;
		$datos= $cat->consVentas($this,$conex);
		return $datos;
	}
	public function consultaCompras($conex){
		$cat=new PersistenciaCalificacion;
		$datos= $cat->consCompras($this,$conex);
		return $datos;
	}
}

?>