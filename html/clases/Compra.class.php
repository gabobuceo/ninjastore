<?php

require_once('../persistencia/PersistenciaCompra.class.php');

class Compra
{
	private $id;
	private $idUsuario;
	private $idPublicacion;
	private $fechaCompra;
	private $concretado;
	private $fechaConcretado;
	private $cantidad;
	private $total;
	private $comision;
	private $calificacion;
	private $baja;
	
	function __construct($i='', $iU='', $iP='', $fCom='', $con='', $fCon='', $can='',$t='',$com='',$cal='',
			$ba=''){
		$this->id= $i;
		$this->idUsuario= $iU;
		$this->idPublicacion= $iP;
		$this->fechaCompra= $fCom;
		$this->concretado= $con;
		$this->fechaConcretado= $fCon;
		$this->cantidad= $can;
		$this->total= $t;
		$this->comision= $com;
		$this->calificacion= $cal;
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
	public function setIdPublicacion($iP){
		$this->idPublicacion= $iP;
	}
	public function setFechaCompra($fCom){
		$this->fechaCompra= $fCom;
	}
	public function setConcretado($con){
		$this->concretado= $con;
	}
	public function setFechaConcretado($fCon){
		$this->fechaConcretado= $fCon;
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
	public function setCalificacion($cal){
		$this->calificacion= $cal;
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
	public function getIdPublicacion(){
		return $this->idPublicacion;
	}
	public function getFechaCompra(){
		return $this->fechaCompra;
	}
	public function getConcretado(){
		return $this->concretado;
	}
	public function getFechaConcretado(){
		return $this->fechaConcretado;
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
	public function getCalificacion(){
		return $this->calificacion;
	}
	public function getBaja(){
		return $this->baja;
	}
	// ----------- ----------------- -----------
	//  ----------- OTROS METODOS --------------
	public function alta($conex)
	{
		$pu=new PersistenciaCompra;
		return ($pu->agregar($this, $conex));
	}

	 
	public function baja($conex)
	{
		$pu=new PersistenciaCompra;
		return($pu->eliminar($this, $conex));
	}


	public function modificacion($conex)
	{
		$pu=new PersistenciaCompra;
		return($pu->modificar($this, $conex));
	}

	public function consultaTodos($conex)
	{
		$pu=new PersistenciaCompra;
		$datos= $pu->consTodos($conex);
		return $datos;
	}

	public function consultaUno($conex)
	{
		$pu=new PersistenciaCompra;
		$datos= $pu->consUno($this,$conex);
		return $datos;
	}
	public function consultaVendidos($conex)
	{
		$pu=new PersistenciaCompra;
		$datos= $pu->consVendidos($this,$conex);
		return $datos;
	}
}

?>
