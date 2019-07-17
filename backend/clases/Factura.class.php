<?php
require_once('../persistencia/PersistenciaFactura.class.php');

/*
	CREATE TABLE FACTURA(
	ID 				SERIAL 			NOT NULL,
	IDCOMPRA		BIGINT(20)		UNSIGNED NOT NULL,
	IDUSUARIO		BIGINT(20)		UNSIGNED NOT NULL,
	IDPUBLICACION		BIGINT(20)		UNSIGNED NOT NULL,
	FECHAC 			DATETIME 		NOT NULL,
	FECHAV 			DATETIME 		NOT NULL,
	ESTADO 			VARCHAR(15) 	NOT NULL,
	SUBTOTAL 		DOUBLE(10,2) 	NOT NULL,
	BAJA			BOOLEAN			DEFAULT 0,
	PRIMARY KEY		(ID,IDCOMPRA,IDUSUARIO,IDPUBLICACION),
	FOREIGN KEY		(IDCOMPRA) REFERENCES COMPRA(ID),
	FOREIGN KEY		(IDUSUARIO) REFERENCES USUARIO(ID),
	FOREIGN KEY		(IDPUBLICACION) REFERENCES PUBLICACION(ID),
	CHECK			(ESTADO='PENDIENTE' AND ESTADO='PAGA' AND ESTADO='VENCIDA')
);
*/

class Factura{
	private $id;
	private $idCompra;
	private $idUsuario;
	private $idPublicacion;
	private $fechac;
	private $fechav;
	private $estado;
	private $subtotal;
	private $fechap;
	private $baja;

	function __construct($id='',$ic='',$iu='',$ip='',$fc='',$fv='',$es='',$su='',$fp='',$ba=''){
		$this->id= $id;
		$this->idCompra= $ic;
		$this->idUsuario= $iu;
		$this->idPublicacion= $ip;
		$this->fechac= $fc;
		$this->fechav= $fv;
		$this->estado= $es;
		$this->subtotal= $su;
		$this->fechap= $fp;
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
	public function setFechac($fc){
		$this->fechac= $fc;
	}
	public function setFechav($fv){
		$this->fechav= $fv;
	}
	public function setEstado($es){
		$this->estado= $es;
	}
	public function setSubtotal($su){
		$this->subtotal= $su;
	}
	public function setFechap($fp){
		$this->fechap= $fp;
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
	public function getFechac(){
		return $this->fechac;
	}
	public function getFechav(){
		return $this->fechav;
	}
	public function getEstado(){
		return $this->estado;
	}
	public function getSubtotal(){
		return $this->subtotal;
	}
	public function getFechap(){
		return $this->fechap;
	}
	public function getBaja(){
		return $this->baja;
	}

	// ----------- ------------------ -----------
	//  ----------- OTROS METODOS --------------
	public function alta($conex){
        $pu=new PersistenciaFactura;
        return ($pu->agregar($this, $conex));
    }
	public function consultaTodos($conex){
		$cat=new PersistenciaFactura;
		$datos= $cat->consTodos($this,$conex);
		return $datos;
	}

	public function consultaUno($conex){
		$cat=new PersistenciaFactura;
		$datos= $cat->consUno($this,$conex);
		return $datos;
	}
	/*public function consultaPendientes($conex){
		$cat=new PersistenciaFactura;
		$datos= $cat->consPendientes($this,$conex);
		return $datos;
	}*/
	public function consultaUnoFechas($conex){
		$cat=new PersistenciaFactura;
		$datos= $cat->consUnoFechas($this,$conex);
		return $datos;
	}
	public function consultaPendientes($conex){
		$cat=new PersistenciaFactura;
		$datos= $cat->consPendientes($conex);
		return $datos;
	}
	public function consultaVencidas($conex){
		$cat=new PersistenciaFactura;
		$datos= $cat->consVencidas($conex);
		return $datos;
	}
	public function consultaPagas($conex){
		$cat=new PersistenciaFactura;
		$datos= $cat->consPagas($conex);
		return $datos;
	}
	public function pagarFactura($conex){
        $pu=new PersistenciaFactura;
        return ($pu->pagFactura($this, $conex));
    }
    public function mora($conex){
        $pu=new PersistenciaFactura;
        return ($pu->morar($this, $conex));
    }
}

?>