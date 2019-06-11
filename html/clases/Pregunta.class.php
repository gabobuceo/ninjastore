<?php

require_once('../persistencia/PersistenciaPregunta.class.php');

class Pregunta
{
	private $id;
	private $idUsuario;
	private $idPublicacion;
	private $mensaje;
	private $fechamensaje;
	private $respuesta;
	private $fecharespuesta;
	private $estado;
	private $baja;
	
	function __construct($i='', $iU='', $iP='', $me='', $fm='', $re='', $fr='', $es='', $ba=''){
		$this->id= $i;
		$this->idUsuario= $iU;
		$this->idPublicacion= $iP;
		$this->mensaje= $me;
		$this->fechamensaje= $fm;
		$this->respuesta= $re;
		$this->fecharespuesta= $fr;
		$this->estado= $es;
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
	
	public function setMensaje($me){
		$this->mensaje= $me;
	}
	public function setFMensaje($fm){
		$this->fechamensaje= $fm;
	}
	public function setRespuesta($re){
		$this->respuesta= $re;
	}
	public function setFRespuesta($fr){
		$this->fecharespuesta= $fr;
	}
	public function setEstado($es){
		$this->estado= $es;
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
	public function getMensaje(){
		return $this->mensaje;
	}
	public function getFMensaje(){
		return $this->fechamensaje;
	}
	public function getRespuesta(){
		return $this->respuesta;
	}
	public function getFRespuesta(){
		return $this->fecharespuesta;
	}
	public function getEstado(){
		return $this->estado;
	}
	public function getBaja(){
		return $this->baja;
	}


	// ----------- ------------------ -----------
	//  ----------- OTROS METODOS --------------
	public function alta($conex)
	{
		$pp=new PersistenciaPregunta;
		return ($pp->agregar($this, $conex));
	}
	public function baja($conex)
	{
		$pp=new PersistenciaPregunta;
		return($pp->eliminar($this, $conex));
	}
	public function modificacion($conex)
	{
		$pp=new PersistenciaPregunta;
		return($pp->modificar($this, $conex));
	}
	//
	public function consultaTodos($conex)
	{
		$pp=new PersistenciaPregunta;
		$datos= $pp->consTodos($this,$conex);
		return $datos;
	}

	public function consultaUno($conex)
	{
		$pp=new PersistenciaPregunta;
		$datos= $pp->consUno($this,$conex);
		return $datos;
	}
	//Devuelve true si el Login y el Password coinciden
	public function coincideLoginPassword($conex)
	{
		$pp= new PersistenciaPregunta;
		return $pp->verificarLoginPassword($this, $conex);

	}
	public function consultaCantidadaPreguntas($conex)
	{
		$pp=new PersistenciaPregunta;
		$datos= $pp->consCantPreg($this,$conex);
		return $datos;
	}
	public function consultaPreguntasPublicacion($conex)
	{
		$pp=new PersistenciaPregunta;
		$datos= $pp->consultaPregPublicacion($this,$conex);
		return $datos;
	}
	public function consultaPregUsuarioPublicacion($conex)
	{
		$pp=new PersistenciaPregunta;
		$datos= $pp->consultaPregUsuPublicacion($this,$conex);
		return $datos;
	}
	public function consultaPregUsuarioVentas($conex)
	{
		$pp=new PersistenciaPregunta;
		$datos= $pp->consultaPregUsuVentas($this,$conex);
		return $datos;
	}
	public function consultaPregUsuarioCompras($conex)
	{
		$pp=new PersistenciaPregunta;
		$datos= $pp->consultaPregUsuCompras($this,$conex);
		return $datos;
	}
	public function ResponderPregunta($conex)
	{
		$pp=new PersistenciaPregunta;
		return($pp->RespPregunta($this, $conex));
	}
	public function consultaMaxID($conex)
	{
		$pp=new PersistenciaPregunta;
		$datos= $pp->consMaxID($conex);
		return $datos;
	}
}

?>
