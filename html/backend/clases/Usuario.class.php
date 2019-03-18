<?php
require_once('../persistencia/PersistenciaUsuario.class.php');
// $u = new Usuario('id','cedula','usuario','password','pNombre','sNombre','pApellido','sApellido','fNacimiento','email','calle','numero','esquina','cPostal','localidad','departamento','tipo','estado','rol','passwordadm','activacion','baja');

class Usuario 
{
    private $id;
    private $cedula;
    private $usuario;
    private $password;
    private $pNombre;
    private $sNombre;
    private $pApellido;
    private $sApellido;
    private $fNacimiento;
    private $email;
    private $calle;
    private $numero;
    private $esquina;
    private $cPostal;
    private $localidad;
    private $departamento;
    private $tipo;
    private $estado;
    private $rol;
    private $passwordadm;
    private $activacion;
    private $baja;
  
    function __construct($i='',$ce='', $us='', $pass='',$pN='', $sN='', $pA='', $sA='',$fN='',$em='',
    		$ca='',$nu='',$esq='',$cP='',$lo='',$de='',$ti='',$est='',$ro='',$pasa='',$ac='',$ba='')
    {
        $this->id= $i;
        $this->cedula= $ce;
        $this->usuario= $us;
        $this->password= $pass;
        $this->pNombre= $pN;
        $this->sNombre= $sN;
        $this->pApellido= $pA;
        $this->sApellido= $sA;
        $this->fNacimiento= $fN;
        $this->email= $em;
        $this->calle= $ca;
        $this->numero= $nu;
        $this->esquina=$esq;
        $this->cPostal=$cP;
        $this->localidad= $lo;
        $this->departamento= $de;
        $this->tipo= $ti;
        $this->estado= $est;
        $this->rol= $ro;
        $this->passwordadm= $pasa;
        $this->activacion= $ac;
        $this->baja= $ba;
    }
    
    //----------------- ------------ ---------------
    //----------------- METODOS SET ----------------
    
    public function setId($i)
    {
      $this->id= $i;
    }

    public function setCedula($ce)
    {
      $this->cedula=$ce;
    }
    
    public function setUsuario($us)
    {
      $this->usuario= $us;
    }
    
    public function setPassword($pass)
    {
    	$this->password= $pass;
    }
    
    public function setPNombre($pN)
    {
      $this->pNombre= $pN;
    }
    
	public function setSNombre($sN)
    {
      $this->sNombre= $sN;
    }
    
     public function setPApellido($pA)
    {
      $this->pApellido= $pA;
    }

    public function setSApellido($sA)
    {
      $this->sApellido= $sA;
    }

    public function setFecNac($fN)
    {
      $this->fNacimiento=$fN;
    }

    public function setEmail($em)
    {
      $this->email= $em;
    }
         
    public function setCalle($ca)
    {
      $this->calle=$ca;
    }
    
 	public function setNumero($nu)
    {
      $this->numero=$nu;
    }
    
	public function setEsquina($esq)
    {
      $this->esquina=$esq;
    }
    
	public function setCPostal($cP)
    {
      $this->cPostal=$cP;
    }
    
    public function setLocalidad($lo)
    {
      $this->localidad=$lo;
    }
    
    public function setDepartamento($de)
    {
      $this->departamento=$de;
    }

    public function setTipo($ti)
    {
      $this->tipo=$ti;
    }

    public function setEstado($est)
    {
      $this->estado=$est;
    }

    public function setRol($ro)
    {
      $this->rol=$ro;
    }

    public function setPasswordADm($pasa)
    {
      $this->passwordadm=$pasa;
    }

    public function setActivacion($ac)
    {
      $this->actuvacion=$ac;
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

    public function getCedula()
    {
      return $this->cedula;
    }
    
    public function getUsuario()
    {
       return $this->usuario;
    }
    
    public function getPassword()
    {
    	return $this->password;
    }
    
    public function getPNombre()
    {
       return $this->pNombre;
    }
    
    public function getSNombre()
    {
       return $this->sNombre;
    }
    
     public function getPApellido()
    {
       return $this->pApellido;
    }

    public function getSApellido()
    {
       return $this->sApellido;
    }

    public function getFecNac()
    {
      return $this->fNacimiento;
    }

    public function getEmail()
    {
      return $this->email;
    }
         
    public function getCalle()
    {
      return $this->calle;
    }
    
  public function getNumero()
    {
       return $this->numero;
    }
    
  public function getEsquina()
    {
      return $this->esquina;
    }
    
  public function getCPostal()
    {
      return $this->cPostal;
    }
    
    public function getLocalidad()
    {
      return $this->localidad;
    }
    
    public function getDepartamento()
    {
       return $this->departamento;
    }

    public function getTipo()
    {
      return $this->tipo;
    }

    public function getEstado()
    {
      return $this->estado;
    }

    public function getRol()
    {
      return $this->rol;
    }

    public function getPasswordADm()
    {
      return $this->passwordadm;
    }

    public function getActivacion()
    {
      return $this->activacion;
    }

    public function getBaja()
    {
      return $this->baja;
    }

    // ----------- ------------------ -----------
    //  ----------- OTROS METODOS --------------
    public function alta($conex)
    {
        $pu=new PersistenciaUsuario;
        return ($pu->agregar($this, $conex));
    }
    
   
    public function baja($conex)
    {
        $pu=new PersistenciaUsuario;
        return($pu->eliminar($this, $conex));
    }
    
    
    public function modificacion($conex)
    {
      $pu=new PersistenciaUsuario;
      return($pu->modificar($this, $conex));
    }
    
    public function consultaTodos($conex)
    {
      $pu=new PersistenciaUsuario;
      $datos= $pu->consTodos($conex);
      return $datos;
    }
    
	public function consultaUno($conex)
    {
      $pu=new PersistenciaUsuario;
      $datos= $pu->consUno($this,$conex);
      return $datos;
    }
    
    //Devuelve true si el Login y el Password coinciden
    public function coincideLoginPassword($conex)
    {
        $pu= new PersistenciaUsuario;
        return $pu->verificarLoginPassword($this, $conex);       
    }
    
    public function consultaEmail($conex)
    {
    	$pu=new PersistenciaUsuario();
    	$datos= $pu->consEmail($this,$conex);
    	return $datos;
    }
    public function consultaCalificacion($conex)
    {
      $pu=new PersistenciaUsuario();
      $datos= $pu->consCalificacion($this,$conex);
      return $datos;
    }
    public function activarUsuario($conex)
    {
      $pu=new PersistenciaUsuario();
      $datos= $pu->actUsuario($this,$conex);
      return $datos;
    }
    public function BuscarUsuarioActivar($conex)
    {
      $pu=new PersistenciaUsuario();
      $datos= $pu->BusActUsuario($this,$conex);
      return $datos;
    }
    public function BuscarUsuarioRecuperar($conex)
    {
      $pu=new PersistenciaUsuario();
      $datos= $pu->BusRecUsuario($this,$conex);
      return $datos;
    }
    public function BuscarEmailUsuario($conex)
    {
      $pu=new PersistenciaUsuario();
      $datos= $pu->BusEmUsuario($this,$conex);
      return $datos;
    }
    public function CambiarEstado($conex)
    {
      $pu=new PersistenciaUsuario();
      $datos= $pu->CamEstado($this,$conex);
      return $datos;
    }
    public function CambiarPasswordUsuario($conex)
    {
      $pu=new PersistenciaUsuario();
      $datos= $pu->CamPassUsuario($this,$conex);
      return $datos;
    }
    public function consultaDatosVendedor($conex)
    {
      $pu=new PersistenciaUsuario;
      $datos= $pu->consDatosVendedor($this,$conex);
      return $datos;
    }
}

?>
