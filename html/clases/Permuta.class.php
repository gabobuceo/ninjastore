<?php
require_once('../persistencia/PersistenciaPermuta.class.php');

/*
CREATE TABLE PERMUTA(
	IDPUBLICACIONORIGEN 	BIGINT(20)		UNSIGNED NOT NULL,
	IDPUBLICACIONDESTINO 	BIGINT(20)		UNSIGNED NOT NULL,
	ESTADO 			VARCHAR(15) 	DEFAULT 'ACTIVA',
	FECHAP 			DATETIME 		NOT NULL,
	ACEPTADA 		BOOLEAN			DEFAULT 0,
	FECHAC 			DATETIME,
	BAJA			BOOLEAN			DEFAULT 0,
	PRIMARY KEY		(IDPUBLICACIONORIGEN,IDPUBLICACIONDESTINO),
	FOREIGN KEY		(IDPUBLICACIONORIGEN) REFERENCES PUBLICACION(ID),
	FOREIGN KEY		(IDPUBLICACIONDESTINO) REFERENCES PUBLICACION(ID),
	CHECK			(ESTADO='ACTIVA' AND ESTADO='CERRADA')
);
*/

class Permuta{
	private $id;
	private $idPublicacionOrigen;
	private $idPublicacionDestino;
	private $estado;
	private $fechap;
	private $aceptada;
	private $fechac;
	private $baja;

	function __construct($i='',$po='',$pd='',$es='',$fp='',$ac='',$fc='',$ba=''){
		$this->id= $i;
		$this->idPublicacionOrigen= $po;
		$this->idPublicacionDestino= $pd;
		$this->estado= $es;
		$this->fechap= $fp;
		$this->aceptada= $ac;
		$this->fechac= $fc;
		$this->baja= $ba;
	}

	//----------------- ------------ ---------------
	//----------------- METODOS SET ----------------
	public function setId($i){
		$this->id= $i;
	}
	public function setIdPublicacionOrigen($po){
		$this->idPublicacionOrigen= $po;
	}
	public function setIdPublicacionDestino($pd){
		$this->idPublicacionDestino= $pd;
	}
	public function setEstado($es){
		$this->estado= $es;
	}
	public function setFechap($fp){
		$this->fechap= $fp;
	}
	public function setAceptada($ac){
		$this->aceptada= $ac;
	}
	public function setFechac($fc){
		$this->fechac= $fc;
	}
	public function setBaja($ba){
		$this->baja=$ba;
	}

	// ----------- ------------------ -----------
	// -------------- METODOS GET ---------------
	public function getId(){
		return $this->id;
	}

	public function getIdPublicacionOrigen(){
		return $this->idPublicacionOrigen;
	}

	public function getIdPublicacionDestino(){
		return $this->idPublicacionDestino;
	}
	public function getEstado(){
		return $this->estado;
	}
	public function getFechap(){
		return $this->fechap;
	}
	public function getAceptada(){
		return $this->aceptada;
	}
	public function getFechac(){
		return $this->calificacion;
	}
	public function getBaja(){
		return $this->baja;
	}

	// ----------- ------------------ -----------
	//  ----------- OTROS METODOS --------------
	public function alta($conex){
        $pu=new PersistenciaPermuta;
        return ($pu->agregar($this, $conex));
    }
    public function aceptar($conex){
        $pu=new PersistenciaPermuta;
        return ($pu->acept($this, $conex));
    }
    public function cancelar($conex){
        $pu=new PersistenciaPermuta;
        return ($pu->cancel($this, $conex));
    }
	public function consultaTodos($conex){
		$cat=new PersistenciaPermuta;
		$datos= $cat->consTodos($conex);
		return $datos;
	}

	public function consultaUno($conex){
		$cat=new PersistenciaPermuta;
		$datos= $cat->consUno($this,$conex);
		return $datos;
	}
	public function consultaAbiertasOrigen($conex){
		$cat=new PersistenciaPermuta;
		$datos= $cat->consAbiertasOrigen($this,$conex);
		return $datos;
	}
	public function consultaCerradasOrigen($conex){
		$cat=new PersistenciaPermuta;
		$datos= $cat->consCerradasOrigen($this,$conex);
		return $datos;
	}
	public function consultaAbiertasDestino($conex){
		$cat=new PersistenciaPermuta;
		$datos= $cat->consAbiertasDestino($this,$conex);
		return $datos;
	}
	public function consultaCerradasDestino($conex){
		$cat=new PersistenciaPermuta;
		$datos= $cat->consCerradasDestino($this,$conex);
		return $datos;
	}
	public function consultaMaxID($conex){
		$pu=new PersistenciaPermuta;
		$datos= $pu->consMaxID($conex);
		return $datos;
	}
}

?>