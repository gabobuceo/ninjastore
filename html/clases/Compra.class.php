<?php
/*
----------------- METODOS SQL ----------------
CREATE TABLE COMPRA(
	ID 						SERIAL 			NOT NULL,
	IDUSUARIO 				BIGINT(20)		UNSIGNED NOT NULL,
	IDPUBLICACION 			BIGINT(20)		UNSIGNED NOT NULL,
	FECHACOMPRA 			TIMESTAMP 		NOT NULL DEFAULT CURRENT_TIMESTAMP,
	VENTACONCRETA 			BOOLEAN			DEFAULT 0,
	FECHAVENTACONCRETADO 	DATETIME,
	COMPRACONCRETA 			BOOLEAN			DEFAULT 0,
	FECHACOMPRACONCRETADO 	DATETIME,
	CANTIDAD 				INT 			DEFAULT 1,
	TOTAL 					DOUBLE(10,2)	NOT NULL,
	COMISION 				DOUBLE(10,2)	NOT NULL,
	BAJA					BOOLEAN			DEFAULT 0,
	PRIMARY KEY		(ID,IDUSUARIO,IDPUBLICACION),
	FOREIGN KEY		(IDUSUARIO) REFERENCES USUARIO(ID),
	FOREIGN KEY		(IDPUBLICACION) REFERENCES PUBLICACION(ID)
);
*/

require_once('../persistencia/PersistenciaCompra.class.php');

class Compra{
	private $id;
	private $idUsuario;
	private $idPublicacion;
	private $fechaCompra;
	private $ventaconcreta;
	private $fechaventaconcretado;
	private $compraconcreta;
	private $fechacompraconcretado;
	private $cantidad;
	private $total;
	private $comision;
	private $baja;
	
	function __construct($i='', $iU='', $iP='', $fCom='', $vcon='', $fvCon='', $ccon='', $fcCon='', $can='',$t='',$com='',$ba=''){
		$this->id= $i;
		$this->idUsuario= $iU;
		$this->idPublicacion= $iP;
		$this->fechaCompra= $fCom;
		$this->ventaconcreta= $vcon;
		$this->fechaventaconcretado= $fvCon;
		$this->compraconcreta= $ccon;
		$this->fechacompraconcretado= $fcCon;
		$this->cantidad= $can;
		$this->total= $t;
		$this->comision= $com;
		$this->baja= $ba;
	}
	//----------------- METODOS SET ----------------
	public function setId($i){
		$this->id=$i;
	}
	public function setIdUsuario($iU){
		$this->idUsuario=$iU;
	}
	public function setIdPublicacion($iP){
		$this->idPublicacion= $iP;
	}
	public function setFechaCompra($fCom){
		$this->fechaCompra= $fCom;
	}
	public function setVentaConcreta($vcon){
		$this->ventaconcreta= $vcon;
	}
	public function setFechaVentaConcretado($fvCon){
		$this->fechaventaconcretado= $fvCon;
	}
	public function setCompraConcreta($ccon){
		$this->compraconcreta= $ccon;
	}
	public function setFechaCompraConcretado($fcCon){
		$this->fechacompraconcretado= $fcCon;
	}
	public function setCantidad($can){
		$this->cantidad= $can;
	}
	public function setTotal($t){
		$this->total= $t;
	}
	public function setComision($com){
		$this->comision= $com;
	}
	public function setBaja($ba){
		$this->baja=$ba;
	}
	// -------------- METODOS GET ---------------
	public function getId(){
		return $this->id;
	}
	public function getIdUsuario(){
		return $this->idUsuario;
	}
	public function getIdPublicacion(){
		return $this->idPublicacion;
	}
	public function getFechaCompra(){
		return $this->fechaCompra;
	}
	public function getVentaConcreta(){
		return $this->ventaconcreta;
	}
	public function getFechaVentaConcretado(){
		return $this->fechaventaconcretado;
	}
	public function getCompraConcreta(){
		return $this->compraconcreta;
	}
	public function getFechaCompraConcretado(){
		return $this->fechacompraconcretado;
	}
	public function getCantidad(){
		return $this->cantidad;
	}
	public function getTotal(){
		return $this->total;
	}
	public function getComision(){
		return $this->comision;
	}
	public function getBaja(){
		return $this->baja;
	}
	//  ----------- OTROS METODOS --------------
	public function alta($conex){
		$pu=new PersistenciaCompra;
		return ($pu->agregar($this, $conex));
	}
	public function baja($conex){
		$pu=new PersistenciaCompra;
		return($pu->eliminar($this, $conex));
	}
	public function modificacion($conex){
		$pu=new PersistenciaCompra;
		return($pu->modificar($this, $conex));
	}
	public function consultaTodos($conex){
		$pu=new PersistenciaCompra;
		$datos= $pu->consTodos($conex);
		return $datos;
	}
	public function consultaUno($conex){
		$pu=new PersistenciaCompra;
		$datos= $pu->consUno($this,$conex);
		return $datos;
	}
	public function consultaVendidos($conex){
		$pu=new PersistenciaCompra;
		$datos= $pu->consVendidos($this,$conex);
		return $datos;
	}
	public function consultaVentas($conex){
		$pu=new PersistenciaCompra;
		$datos= $pu->consVentas($this,$conex);
		return $datos;
	}
	public function consultaMaxID($conex){
		$pu=new PersistenciaCompra;
		$datos= $pu->consMaxID($conex);
		return $datos;
	}
	public function consultaComprasSinCalificar($conex){
		$pu=new PersistenciaCompra;
		$datos= $pu->consComprasSinCalificar($this,$conex);
		return $datos;
	}
	public function consultaComprasSinConfirmar($conex){
		$pu=new PersistenciaCompra;
		$datos= $pu->consComprasSinConfirmar($this,$conex);
		return $datos;
	}
	public function consultaComprasCerradas($conex){
		$pu=new PersistenciaCompra;
		$datos= $pu->consComprasCerradas($this,$conex);
		return $datos;
	}
	public function confirmarCompra($conex){
		$pu=new PersistenciaCompra;
		$datos= $pu->confCompra($this,$conex);
		return $datos;
	}
	public function confirmarVenta($conex){
		$pu=new PersistenciaCompra;
		$datos= $pu->confVenta($this,$conex);
		return $datos;
	}
	public function consultaVentasSinCalificar($conex){
		$pu=new PersistenciaCompra;
		$datos= $pu->consVentasSinCalificar($this,$conex);
		return $datos;
	}
	public function consultaVentasSinConfirmar($conex){
		$pu=new PersistenciaCompra;
		$datos= $pu->consVentasSinConfirmar($this,$conex);
		return $datos;
	}
	public function consultaVentasCerradas($conex){
		$pu=new PersistenciaCompra;
		$datos= $pu->consVentasCerradas($this,$conex);
		return $datos;
	}
	public function consultaCompras($conex){
		$pu=new PersistenciaCompra;
		$datos= $pu->consCompras($this,$conex);
		return $datos;
	}
}

?>
