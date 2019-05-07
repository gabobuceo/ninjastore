<?php

require_once('../persistencia/PersistenciaPublicacion.class.php');

class Publicacion
{
	private $id;
	private $idUsuario;
	private $idCategoria;
	private $titulo;
	private $descripcion;
	private $precio;
	private $oferta;
	private $descuento;
	private $fOferta;
	private $estadoP;
	private $estadoA;
	private $cantidad;
	private $imgdef;
	private $visto;
	private $baja;	

	function __construct($i='',$idu='',$ic='',$t='', $d='', $p='', $o='', $de='', $fo='',$ep='',$ea='',$ca='',$im='',$vi='',$ba='')
	
	{
		$this->id= $i;
		$this->idUsuario= $idu;
		$this->idCategoria= $ic;
		$this->titulo= $t;
		$this->descripcion= $d;
		$this->precio= $p;				
		$this->oferta= $o;
		$this->descuento= $de;
		$this->fOferta= $fo;
		$this->estadoP= $ep;
		$this->estadoA= $ea;
		$this->cantidad= $ca;				
		$this->imgdef= $im;
		$this->visto= $vi;
		$this->baja= $ba;
	}

	//----------------- ------------ ---------------
	//----------------- METODOS SET ----------------

	public function setId($i)
	{
		$this->id= $i;
	}
	
	public function setIdUsuario($idu)
	{
		$this->idUsuario= $idu;
	}

	public function setIdCategoria($ic)
	{
		$this->idCategoria= $ic;
	}

	public function setTitulo($t)
	{
		$this->titulo=$t;
	}
	
	public function setDescripcion($d)
	{
		$this->descripcion= $d;
	}

	public function setPrecio($p)
	{
		$this->precio= $p;
	}

	public function setOferta($o)
	{
		$this->oferta= $o;
	}

	public function setDescuento($de)
	{
		$this->descuento= $de;
	}

	public function setFOferta($fo)
	{
		$this->fOferta= $fo;
	}

	public function setEstadoP($ep)
	{
		$this->estadoP= $ep;
	}
	
	public function setEstadoA($ea)
	{
		$this->estadoA=$ea;
	}
		
	public function setCantidad($ca)
	{
		$this->cantidad=$ca;
	}
		
	public function setImgDef($im)
	{
		$this->imgdef=$im;
	}

	public function setVisto($vi)
	{
		$this->visto=$vi;
	}

	public function setBaja($ba)
	{
		$this->baja=$ba;
	}
	
	// -------------- ----------- ---------------
	// -------------- METODOS GET ---------------

	public function getId()
	{
		return $this->id;
	}

	public function getIdUsuario()
	{
		return $this->idUsuario;
	}
	
	public function getIdCategoria()
	{
		return $this->idCategoria;
	}
	
	public function getTitulo()
	{
		return $this->titulo;
	}
	
	public function getDescripcion()
	{
		return $this->descripcion;
	}

	public function getPrecio()
	{
		return $this->precio;
	}

	public function getOferta()
	{
		return $this->oferta;
	}

	public function getDescuento()
	{
		return $this->descuento;
	}

	public function getFOferta()
	{
		return $this->fOferta;
	}

	public function getEstadoP()
	{
		return $this->estadoP;
	}

	public function getEstadoA()
	{
		return $this->estadoA;
	}

	public function getCantidad()
	{
		return $this->cantidad;
	}
	
	public function getImgDef()
	{
		return $this->imgdef;
	}

	public function getVisto()
	{
		return $this->visto;
	}

	public function getBaja()
	{
		return $this->baja;
	}
	
	// ----------- ------------------ -----------
	//  ----------- OTROS METODOS --------------

	public function alta($conex)
	{
		$pp=new PersistenciaPublicacion;
		return ($pp->agregar($this, $conex));
	}

	public function altacrea($conex)
	{
		$pp=new PersistenciaPublicacion;
		return ($pp->agregarcrea($this, $conex));
	} 
	public function baja($conex)
	{
		$pp=new PersistenciaPublicacion;
		return($pp->eliminar($this, $conex));
	}

	public function modificacion($conex)
	{
		$pp=new PersistenciaPublicacion;
		return($pp->modificar($this, $conex));
	}
	public function modCantidad($conex)
	{
		$pp=new PersistenciaPublicacion;
		return($pp->modificarCantidad($this, $conex));
	}
	public function modCerrar($conex)
	{
		$pp=new PersistenciaPublicacion;
		return($pp->modificarCerrar($this, $conex));
	}
	public function consultaMaxID($conex)
	{
		$pp=new PersistenciaPublicacion;
		$datos= $pp->consMaxID($conex);
		return $datos;
	}
	public function consultaTodos($conex)
	{
		$pp=new PersistenciaPublicacion;
		$datos= $pp->consTodos($conex);
		return $datos;
	}
	public function consultaPublicados($conex)
	{
		$pp=new PersistenciaPublicacion;
		$datos= $pp->consPublicados($conex);
		return $datos;
	}
	public function consultaPublicadosFiltro($conex)
	{
		$pp=new PersistenciaPublicacion;
		$datos= $pp->consPublicadosFiltro($this,$conex);
		return $datos;
	}
	public function consultaPublicaciones($conex)
	{
		$pp=new PersistenciaPublicacion;
		$datos= $pp->consPublicaciones($this,$conex);
		return $datos;
	}
	public function consultaCategorias($conex)
	{
		$pp=new PersistenciaPublicacion;
		$datos= $pp->consCategorias($this,$conex);
		return $datos;
	}
	public function consultaUno($conex)
	{
		$pp=new PersistenciaPublicacion;
		$datos= $pp->consUno($this,$conex);
		return $datos;
	}
	
	public function consultaTodosUsuarioCerradas($conex)
	{
		$pp=new PersistenciaPublicacion;
		$datos= $pp->consTodosUsuCerradas($this,$conex);
		return $datos;
	}
	public function consultaTodosUsuarioPublicadas($conex)
	{
		$pp=new PersistenciaPublicacion;
		$datos= $pp->consTodosUsuPublicadas($this,$conex);
		return $datos;
	}
	public function consultaTodosUsuarioGuardadas($conex)
	{
		$pp=new PersistenciaPublicacion;
		$datos= $pp->consTodosUsuGuardadas($this,$conex);
		return $datos;
	}

	public function consultaFecha($conex)
	{
		$pp=new PersistenciaPublicacion;
		$datos= $pp->consFecha($this,$conex);
		return $datos;
	}
	public function consultaVisto($conex)
	{
		$pp=new PersistenciaPublicacion;
		$datos= $pp->consVisto($this,$conex);
		return $datos;
	}
	public function modificarVisto($conex)
	{
		$pp=new PersistenciaPublicacion;
		return($pp->modVisto($this, $conex));
	}	
	public function consultaPublicacionesIndex($conex)
	{
		$pp=new PersistenciaPublicacion;
		$datos= $pp->consPubliIndex($conex);
		return $datos;
	}
	public function consultaPublicacionesOfertas($conex)
	{
		$pp=new PersistenciaPublicacion;
		$datos= $pp->consPubliOfertas($conex);
		return $datos;
	}
	public function consultaPublicacionesBuscar($conex)
	{
		$pp=new PersistenciaPublicacion;
		$datos= $pp->consPubliBusc($this,$conex);
		return $datos;
	}
	public function consultaPublicacionesBuscarCategoria($conex)
	{
		$pp=new PersistenciaPublicacion;
		$datos= $pp->consPubliBuscCat($this,$conex);
		return $datos;
	}
	public function consultaPublicacionesVendedor($conex)
	{
		$pp=new PersistenciaPublicacion;
		$datos= $pp->consPubliVend($this,$conex);
		return $datos;
	}
	public function consultaPublicacionesUsadas($conex)
	{
		$pp=new PersistenciaPublicacion;
		$datos= $pp->consPubliUsadas($this,$conex);
		return $datos;
	}
	public function consultaCantidad($conex)
	{
		$pp=new PersistenciaPublicacion;
		$datos= $pp->consultaCant($this,$conex);
		return $datos;
	}
	public function modificarCantidad($conex)
	{
		$pp=new PersistenciaPublicacion;
		return($pp->modificarCant($this, $conex));
	}
	public function modificarEstadoP($conex)
	{
		$pp=new PersistenciaPublicacion;
		return($pp->modificarEstP($this, $conex));
	}	
}

?>