<?php
require_once('../persistencia/PersistenciaCategoria.class.php');

class Categoria
{
	private $id;
	private $idPadre;
	private $titulo;
	private $baja;

	function __construct($id='',$idp='',$ti='',$ba='')
	{
		$this->id= $id;
		$this->idPadre= $idp;
		$this->titulo= $ti;
		$this->baja= $ba;
	}

	//----------------- ------------ ---------------
	//----------------- METODOS SET ----------------

	public function setId($id)
	{
		$this->id= $id;
	}
	
	public function setIdPadre($id)
	{
		$this->idPadre= $idp;
	}

	public function setTitulo($ti)
	{
		$this->titulo= $ti;
	}

	public function setBaja($ba)
	{
		$this->baja=$ba;
	}

	// ----------- ------------------ -----------
	// -------------- METODOS GET ---------------

	public function getId()
	{
		return $this->id;
	}
	
	public function getIdPadre()
	{
		return $this->idPadre;
	}
	
	public function getTitulo()
	{
		return $this->titulo;
	}
	
	public function getBaja()
	{
		return $this->baja;
	}

	// ----------- ------------------ -----------
	//  ----------- OTROS METODOS --------------

	public function consultaTodos($conex){
		$cat=new PersistenciaCategoria;
		$datos= $cat->consTodos($conex);
		return $datos;
	}

	public function consultaUno($conex){
		$cat=new PersistenciaCategoria;
		$datos= $cat->consUno($this,$conex);
		return $datos;
	}

	public function consultaBread($conex){
		$cat=new PersistenciaCategoria;
		$datos= $cat->consBread($this,$conex);
		return $datos;
	}
	
	public function consultaPadres($conex)
	{
		$cat=new PersistenciaCategoria;
		$datos= $cat->consPadres($conex);
		return $datos;
	}
	
	public function consultaHijos($conex)
	{
		$cat=new PersistenciaCategoria;
		$datos= $cat->consHijos($this, $conex);
		return $datos;
	}
}

?>